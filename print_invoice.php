<?php 
require_once('admin/conn/DB.php');
include('admin/conn/tablefuncs.php');
include('include/config.php');
mysql_select_db($database_DB, $ravcodb);
session_start();
$code = $_REQUEST['code'];
$sql = "SELECT * FROM invoices WHERE rand_code='{$code}'";
$result = mysql_query($sql);
if($result){
    $invoice = mysql_fetch_assoc($result);
}  else {
    $invoice  = array();
}
if(empty ($invoice)){
?>
<script>
    location.href='index.php';
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

function formatMoney2($number, $cents = 2) { // cents: 0=never, 1=if needed, 2=always
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
    return $money;
  } // numeric
} // formatMoney


// calc total of invoices
$sql_total  = "SELECT * FROM item_invoice WHERE invoice_id = '{$invoice['id']}'";
//echo $sql_total;
$result_total = mysql_query($sql_total);
$total_invoice = 0;
$total_compare = 0;
$item  = array();
if($result_total){                                
    while($row_total = mysql_fetch_assoc($result_total)){
        //echo $row_total['total'].'<br />';
        $item[] = $row_total;
        $total_item = str_replace(',','', $row_total['total']);
        $total_invoice = $total_invoice  + $total_item;
    }
}


//echo $total_invoice;
$total_compare = $total_invoice;
//$total_invoice =  number_format(round($total_invoice,2),2,'.',',');

if ($invoice["state"] == "FL" && $invoice["remove_tax"]==0) { 			
    $taxdec = 6/100;
    $taxtotal = $taxdec * $total_invoice;

    $total_invoice = $taxtotal + $total_invoice;
    $tax = '<tr>
        <td align="right" width="200"><strong>FL 6% Sales Tax:</strong></td><td align="right" width="200"><strong>'.formatMoney($taxtotal).'</strong></td></tr>'; 
}else {
    $total_invoice   = $total_invoice; 
    $tax = '<tr><td align="right" width="200"><strong>Sales Tax:</strong></td><td align="right" width="200"><span class="quantityNumber" style="font-size: 14px;"> N/A</span></td>';  
}

$paid_total = $total_invoice-$invoice['paid_to_date'];  
//echo '<pre>';
//print_r($item);
//echo '</pre>'

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"> 
    <head>
    <script type="text/javascript" src="js/slider.js"></script>
    <link type="text/css" rel="stylesheet" href="<?php echo $base_url;?>/style.css">
    <style>
        a{
            text-decoration: none;
        }
        .payment_bgr {
            background: url('admin/images/pay-bg.gif') no-repeat;   
            width: 400px;
            float: left;
            font-size: 18px;
            color: white;
            height: 50px;
            padding-left: 5px;
        }
        .div_left{
            float: left;
            padding-top: 15px;
            padding-left: 200px;
            font-size: 15px;
            width: 250px;
        }
        .img_payment{
            padding-top: 7px;
        }
        .block_pay{
            background-color: #FFF4D6;
            height: 70px;
            padding-top: 25px;
        }
        .print_button{
            background: url('admin/images/print-btn.gif') no-repeat top center;
            border:none;
            width:75px;
            height:30px;
            line-height:30px;
            color:#fff;
            text-align:center;
            font-family: arial;
            font-size: 14px !important;
            font-weight: bold;
        }
        .box_infor{
            border: 1px solid #CCC;
        }
        .table_border{
         border: 1px solid #747474;
         border-collapse: collapse;
        }
        .table_border .td_border{
         border:none;
         padding-left:5px; 
        }
    </style>  
    <script>
        function print_open(){
            window.print();
        }
        window.onload=print_open;
    </script>
    </head>
    <body>
        <div id="wrapper">
            <div id="content">   
            <div id="mainContentFull">
               
                <div>
                   
                    <div style="height: 50px;"></div>
                    <div class="box_infor">
                        <div style="padding-top: 50px;">
                            <div style="float:left;width: 300px;padding-top: 5px;padding-left: 45px;">
                                <p>Best Name Badges <br />
                                1700 NW 65th Ave, Suite 4<br />
                                Plantation, FL 33313<br />
                                Phone: 888-445-7601                                </p>
                            </div>
                            <div style="float:left;width: 200px;padding-top: 5px;padding-left: 5px;"> 
                                 <?php 
                                    if(round($paid_total,2) == 0){
                                 ?>
                                     <img src="<?php echo $base_url?>/images/green_paid_stamp.jpg" />
                                  <?php } ?>
                            </div>
                            <div style="float:right;width: 300px;padding-top: 5px;padding-left: 5px;">

                                <img src="images/best-name-badges-logo.png" />

                            </div>
                            <div style="clear:both"></div>
                        </div>  

                        <div style="padding-top: 50px;">
                            <div style="float: left; padding-left: 45px;width: 400px;">
                                 <strong><?php echo $invoice['companyname'];?></strong> <br />
                                 <strong><?php echo $invoice['firstname'];?>  <?php echo $invoice['lastname']; ?></strong> <br />
                                 <?php if(!empty($invoice['address'])) echo $invoice['address'].'<br />';?> 
                                 <?php  if(!empty($invoice['address2'])) echo $invoice['address2'].' <br />'; ?>
                                 <?php echo $invoice['city'].' '.$invoice['state'].' '.$invoice['zip']; ?> <br />
                            </div>
                            <div style="float: right;width: 351px;padding: 25px;">
                                <table border="1" cellspacing="0" cellpadding="0" width="100%" class="table_border">
                                    <tr class="tr_border">
                                        <td bgcolor="#CCCCCC"><strong>Invoice #:</strong> </td>
                                        <td align="right" style="padding-right: 5px;"><?php echo $invoice['id'];?></td>
                                    </tr>
                                    <tr class="tr_border">
                                        <td bgcolor="#CCCCCC"><strong>PO number:</strong> </td>
                                        <td align="right" style="padding-right: 5px;"><?php echo $invoice['po_number'];?></td>
                                    </tr>
                                    <tr class="tr_border">
                                        <td bgcolor="#CCCCCC"><strong>Date:</strong></td>
                                        <td align="right" style="padding-right: 5px;">
                                            <?php
                                                $data = strtotime($invoice['data_of_issue']);
                                                echo date('F j, Y',$data);
                                            ?>
                                        </td>
                                    </tr>
                                    <tr class="tr_border">
                                        <td bgcolor="#CCCCCC"><strong>Amount Due USD: </strong></td>
                                        <td align="right" style="padding-right: 5px;"><?php echo formatMoney($total_invoice,2);?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                         <div style="clear:both"></div>
                         <div style="padding: 20px 25px;">
                             <table border="1" cellspacing="0" cellpadding="0" width="100%" class="table_border" >
                                 <tr bgcolor="#CCCCCC" style="text-align:center;">
                                     <td width="150"><strong>Item</strong></td>
                                     <td width="400"><strong>Description</strong></td>
                                     <td width="150"><strong>Unit Cost ($)</strong></td>
                                     <td width="100"><strong>Quantity</strong></td>
                                     <td width="70"><strong>Price ($)</strong></td>
                                 </tr>
                                 <?php 
                                 foreach($item as $it){
                                 ?>
                                 <tr>
                                     <td class="td_border">
                                        <?php echo $it['item']?>
                                     </td>
                                     <td  class="td_border"><?php echo $it['description']?></td>
                                     <td  class="td_border"><?php echo $it['unit_cost'];?></td>
                                     <td  class="td_border"><?php echo $it['qty'];?></td>
                                     <td  class="td_border"><?php echo $it['total'];?></td>
                                 </tr>
                                 <?php
                                 }
                                 ?>
                                 <tr>
                                     <td class="td_border" colspan="5"><div style="height: 100px;"></div></td>
                                 </tr>
                                 <tr>
                                     <td class="td_border" colspan="5">
                                         NOTES: <?php echo nl2br($invoice['note_visible_to_client']);?>
                                     </td>
                                 </tr>
                                 <tr>
                                     <td colspan="2" rowspan="4"></td>
                                 </tr>
                                 <tr>
                                     <td  colspan="5">
                                            <div>
                                                <table border="0"  cellspacing="0" cellpadding="0" width="100%"  >
                                                  <tr>
                                                      <td align="right" width="200"><strong>Invoice Subtotal:</strong></td>
                                                      <td align="right" style="padding-right: 5px;"> <strong><?php echo number_format(round($total_invoice,2),2,'.',',');?></strong></td>
                                                  </tr>
                                                  
                                              </table>                                       
                                            </div>
                                     </td>
                                 </tr>
                                  <tr>
                                      <td colspan="5">
                                          <div>
                                              <table border="0"  cellspacing="0" cellpadding="0" width="100%"  >

                                                  <?php 
                                                  if($invoice["remove_tax"]==0){
                                                    echo $tax;
                                                  }?>
                                                  <tr>
                                                      <td align="right" width="200"><strong>Invoice Total:</strong></td>
                                                      <td align="right" style="padding-right: 5px;"><strong>$<?php echo number_format(str_replace(',','', $total_invoice),2,'.',',');?></strong></td>
                                                  </tr>
                                              </table>
                                          </div>
                                          <div style="clear:both;"></div>
                                          <div>
                                              <table border="0"  cellspacing="0" cellpadding="0" width="100%"  >
                                                  <tr>
                                                      <td align="right" width="200"> <strong>Amount Paid:</strong></td>
                                                      <td align="right" style="padding-right: 5px;"><strong><?php echo formatMoney($invoice['paid_to_date'],2);?></strong></td>
                                                  </tr>
                                              </table>
                                          </div>

                                     </td>
                                 </tr>
                                  <tr>
                                      <td  colspan="5">
                                          <div>
                                               <table border="0"  cellspacing="0" cellpadding="0" width="100%"  >
                                                  <tr>
                                                      <td align="right" width="200"> <strong>Balance Due USD: </strong></td>
                                                      <td align="right" style="padding-right: 5px;"><strong><?php echo formatMoney($total_invoice-$invoice['paid_to_date'],2);?></strong></td>
                                                  </tr>
                                              </table>
                                           </div>
                                      </td>
                                 </tr>
                                 <tr>
                                     <td colspan="5" algin="center"><div style="text-align: center;"><strong>Payment due in full</strong></div></td>
                                 </tr>
                             </table>
                         </div>
                    </div>
                   <div style="height: 50px;"></div>                    
                </div>
            </div>
          </div>
      <div style="display: none;"><img src="/images/sevenReasonsButtonMinus.png" /></div>
    </div>  
    </body>
    </html>    
