<?php
require_once('conn/DB.php');
include('conn/tablefuncs.php');
include('../include/config.php');
mysql_select_db($database_DB,$ravcodb);
session_start();
if (!$_SESSION["loginid"])
{?>
<script language="javascript">
parent.parent.location.href='admin.php';
window.close();
</script>
<?php
}
function formatMoney($number, $cents = 2) { // cents: 0=never, 1=if needed, 2=always
  if (is_numeric($number)) { // a number
    if (!$number) { // zero
      $money = ($cents == 2 ? '0.00' : '0'); // output zero
    } else { // value
      if (floor($number) == $number) { // whole number
        $money = number_format($number, ($cents == 2 ? 2 : 0)); // format
      } else { // cents
        $money = number_format(round($number, 2), ($cents == 0 ? 0 : 2)); // format
      } // integer or decimal
    } // value
    return '$'.$money;
  } // numeric
} // formatMoney

$invoice_id = $_REQUEST['invoice_id'];

$sql = "SELECT invoices.paid_to_date,invoices.rand_code,invoices.customer_id,customers.sale_id
        FROM invoices
        INNER JOIN customers ON customers.id  = invoices.customer_id
        WHERE invoices.id='{$invoice_id}'";
//echo $sql;
$invoice_detail = mysql_query($sql);
if($invoice_detail){
   $invoice = mysql_fetch_array($invoice_detail); 
}else {
    $invoice = array();
}

if($_REQUEST['edit']){   
    $invoice_id = $_REQUEST['invoice_id'];
    // get total from item table 
    $sql_total  = "SELECT total FROM item_invoice WHERE invoice_id = '{$invoice_id}'";
    //echo $sql_total;
    $result_total = mysql_query($sql_total);
    $total_invoice = 0;
    $total_compare = 0;
    if($result_total){                                
        while($row_total = mysql_fetch_assoc($result_total)){
            //echo $row_total['total'].'<br />';
            $total_item = str_replace(',', '',$row_total['total']);
            $total_invoice = $total_invoice  + $total_item;              
        }
    }    
    // get discount from table invoice.
  
    $sql_discount = "SELECT discount,state,remove_tax  FROM invoices WHERE id='{$invoice_id}'";
    $resutl_discount = mysql_query($sql_discount);
    $row_discount = mysql_fetch_assoc($resutl_discount);
    
    /*$discount = str_replace('%','', $row_discount['discount']);
    
    if((int)$discount > 0){    
        
        $total_invoice = $total_invoice  - $total_invoice*$discount/100;
    } */
    
    if ($row_discount["state"] == "FL" && $row_discount['remove_tax']==0) { 			
        $taxdec = 6/100;
        $taxtotal = $taxdec * $total_invoice;        
    }else {
        $taxtotal = 0;    
    }
     
    $total_compare = $total_invoice + $taxtotal;
   
   
    $paid_to_date = str_replace(',','', $_REQUEST['paid_to_date']); 
    
    $sql_update = "UPDATE invoices SET paid_to_date = '{$paid_to_date}' WHERE id='{$invoice_id}'";
    //echo $paid_to_date.''.$total_compare;
    if($paid_to_date >0 &&  round($paid_to_date,2) >= (float)round($total_compare,2)){
        $invoice_stt = 'paid';
    }else if($paid_to_date >0 && round($paid_to_date,2) < (float)round($total_compare,2)){
        $invoice_stt = 'partial';
    }else {
        $invoice_stt = 'unpaid';
    }
    
    // process for orders this invoice 
    
    $sql_order = "SELECT invoices.*,customers.sale_id FROM invoices 
                  INNER JOIN customers ON customers.id  = invoices.customer_id  
                  WHERE invoices.id='{$invoice_id}'";
    $result_order = mysql_query($sql_order);
    
    if($result_order){
        $invoice = mysql_fetch_assoc($result_order);
    }  else {
        $invoice  = array();
    }
    $customer_id = $invoice['customer_id'];   
    /*echo '<pre>';
    print_r($invoice_stt);
    echo '</pre>';
    die();*/
    if($invoice_stt == 'paid'){
        
        if ($invoice['is_po_created'] == 1)
        {
            $invoice_id = $invoice['id'];
            
            if($invoice_id && $customer_id)
            {
                $sql_invoice_po = "SELECT printorders.id FROM printorders
                                WHERE printorders.invoice_id = '{$invoice_id}' AND printorders.custid = '{$customer_id}'";

                $result_invoice_po = mysql_query($sql_invoice_po);

                if($result_invoice_po)
                {
                    $invoice_po = mysql_fetch_assoc($result_invoice_po);
                    $_SESSION["printorderid"] = $invoice_po["id"];
                }
            }
        }
        else
        {
            $printorder['timestamp'] = date('Y-m-d H:i:s');
            $printorder["custid"] = $customer_id;
            $printorder['note'] =  $invoice['internal_note'];
            $printorder['customer_note']     =$invoice['note_visible_to_client'];
            $printorder['invoice_id']     = $invoice['id'];
            $_SESSION["printorderid"] = add_record("printorders",$printorder); 
        }
        

        $data["customerid"] =  $customer_id;		
        $data["qty"] = 1;		
        $data["totalprice"] = $paid_to_date;
        $data['invoice_id'] =  $invoice['id'];
        $orderid = add_record("orders", $data);
        

        $sql_invoice = "UPDATE invoices SET paid_to_date ={$data['totalprice']} WHERE id={$data['invoice_id']}";
        mysql_query($sql_invoice);
        // end of paid to date
        $qry = "SELECT * FROM customers WHERE id = ".$customer_id;

        $customers = mysql_query($qry) or die('Query failed: ' . mysql_error()); 
        $customer = mysql_fetch_assoc($customers);

        $data2["oid"] = $orderid;
        $data2["date"] = date("Y/m/d");
        $data2["name"] = $customer["firstname"]." ".$customer["lastname"];
        $data2["address"] = $customer["street"];
        $data2["address2"] = $customer["street2"];
        $data2["city"] = $customer["city"];
        $data2["state"] = $customer["state"];
        $data2["zip"] = $customer["zip"];		
        $data2["tax"] = '0';		

        $rid = add_record("receipts", $data2);

        $data3["oid"] = $_SESSION["printorderid"];        
        $data3["date"] = date("Y/m/d");
        $data3["name"] = $customer["firstname"]." ".$customer["lastname"];
        $data3["address"] = $customer["street"];
        $data3["address2"] = $customer["street2"];
        $data3["city"] = $customer["city"];
        $data3["state"] = $customer["state"];
        $data3["zip"] = $customer["zip"];
        $pid = add_record("preceipts", $data3);	
        $data5["paid"] = 1;
        /*if($_REQUEST['shippingmethod']=='fedex'){
            $data5['payment_method'] = 1;
        }else{
            $data5['payment_method'] = 0;
        }*/
        $where = "id = ".$_SESSION["printorderid"];
        modify_record("printorders", $data5, $where);
        
        $data6['follow_user_id'] = $invoice['sale_id'];
        $data6['last_order']    = strtotime(date('m/d/Y H:i:s'));
        $where1 = "id =".$customer_id;        
        modify_record("customers", $data6, $where1);
    }    
    $id_customer = $_SESSION["customerloginid"];	
    $sql = "UPDATE customers SET status='Archive' WHERE id='{$id_customer}'";	
    mysql_query($sql);
    // end of process orders     
    
    
    mysql_query($sql_update);
    // update status of invoices
    $sql_stt = "UPDATE invoices SET invoice_status='{$invoice_stt}' WHERE id=".$invoice_id;
   // echo $sql_stt;
   
    mysql_query($sql_stt);
    
    // process nofitation email for customer when paid from admin
    if(isset($_REQUEST['emailnoti'])){
        $invoice_id = $_REQUEST['invoice_id'];
        $customer_id = $_REQUEST['customer_id'];
        //$rand_code   = $_REQUEST['rand_code'];
        $email       = $_REQUEST['customer_email'];
        $total = $_REQUEST['paid_to_date'];
        //$link ='https://bestnamebadges.freshbooks.com/view/WQGKHwwfrRitAAW';
        $link = $base_url.'/invoices.php?code='.$_REQUEST['rand_code'];
        $subject = '[Best Name Badges] Payment Notification Invoice '.$invoice_id;
        $message = 'A payment has been added to your invoice from Best Name Badges in the amount of $'.$total.', to view the invoice and print a copy for your records, click the link below:: <br />
                    <p></p>
                   '.$link.' <br />
                    </br>    
                    Best regards,  <br />
                    Best Name Badges (support@bestnamebadges.com)<br />  ';
            $addition_email = $_REQUEST['additionemail'];            
            //define the headers we want passed. Note that they are separated with \r\n    
            //add boundary string and mime type specification   
            $headers = "MIME-Version: 1.0" . "\r\n";					
            $headers .= "Content-type:text/html; charset=utf-8" . "\r\n";
            $headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
            $headers .= "From: sales@bestnamebadges.com \r\n";				    
            $headers.= "Cc: {$addition_email} \r\n"; 
            mail($email, $subject, $message, $headers);
        //end of nofitation email

    }      
    if(isset($_REQUEST['redirect']) && $_REQUEST['redirect'] ==1){
        $page = $_REQUEST['page'];   
?>
    <script language="javascript">
		parent.parent.location.href = "admin_listall_invoice.php?page=<?php echo $page;?>";
		window.close();
    </script>
<?php
 }else {
?>
<script language="javascript">
		parent.parent.location.href = "admin_list_invoice.php?customerid=<?php echo $customer_id;?>";
		window.close();
 </script>
<?php
 }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Best Name Badges - Content Management System</title>
<link href="includes/cms.css" rel="stylesheet" type="text/css" />


<link href="greybox/gb_styles.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="scripts/jquery-1.3.2.min.js"></script>
<script>
    function check_show()
    {
       
        if ($('#check_email').attr('checked')){
             $(".emailsent").show();
        }else {
            $(".emailsent").hide();
        }
        
    }
</script>
</head>
    <body>	
        <div align="center">
            <?php 
           // echo '<pre>'.print_r($invoice).'</pre>';
            $qry = "SELECT  customers.email FROM customers WHERE customers.id =".$_REQUEST['customer_id'];
            $customers_result = mysql_query($qry) or die('Query failed: ' . mysql_error()); 
            $customers = mysql_fetch_assoc($customers_result); 
            //echo '<pre>'.print_r($customers).'</pre>';
            ?>
            <form action="" name="payment" method="POST">
                <input type="hidden" value="1" name="edit"/>
                <input type="hidden" value="<?php echo $_REQUEST['customer_id'];?>" name="customer_id" />
                <input type="hidden" value="<?php echo $invoice_id;?>" name="invoice_id"/>
                <input type="hidden" value="<?php echo $invoice['rand_code'];?>" name="rand_code" />
                <?php 
                if(isset($_REQUEST['redirect'])){
                 ?>
                <input type="hidden" name="redirect" value="<?php echo $_REQUEST['redirect'];?>" />
                <?php
                }
                ?>
                <?php 
                if(isset($_REQUEST['page'])){
                 ?>
                <input type="hidden" name="page" value="<?php echo $_REQUEST['page'];?>" />
                <?php
                }
                ?>
                <table>
                    <tr>
                        <td><strong>Total</strong></td>
                        <td>$<?php echo $_REQUEST['total'];?></td>
                    </tr>
                    <tr>
                        <td><strong>Amount Payment</strong></td>
                        <td><input type="text" name="paid_to_date" value="<?php echo number_format(str_replace(',','', $invoice['paid_to_date']),2,'.',',');?>" /></td>
                    </tr>
                    <tr>
                        <td><strong>Email payment notifcation</strong></td>
                        <td><input onclick="check_show();" id="check_email" type="checkbox" name="emailnoti" value="1" checked /> </td>                        
                    </tr>
                    <tr class="emailsent">
                        <td><strong>Customer Email</strong></td>
                        <td><input type="text" value="<?php echo $customers['email'] ?>" name="customer_email" /></td>
                    </tr>
                    <tr class="emailsent">
                        <td><strong>Additional emails</strong></td>
                        <td><input type="text" name="additionemail" value="" />
                            <br />(use ',' to determine multiple email) 
                        </td>
                    </tr>
                    <tr>
                        <td><input type="submit" value="Submit Payment" name="payment"></td>
                        <td></td>
                    </tr>
                </table>
            </form>
        </div>
    </body>
</html>