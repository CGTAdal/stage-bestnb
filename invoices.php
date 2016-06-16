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
//echo '<pre>';
//print_r($invoice);
//echo '</pre>';
// process customer auto logined


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

unset ($_SESSION["customerloginid"]);
unset ($_SESSION["username"]);
$_SESSION["customerloginid"] = $invoice['customer_id'];
$sql_customer = "SELECT * FROM customers WHERE id=".$invoice['customer_id'];
$result_customer = mysql_query($sql_customer);
$infor_cus = mysql_fetch_assoc($result_customer);
$_SESSION["username"] = $infor_cus["firstname"]." ".$infor_cus["lastname"];

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

$discount_total = trim(str_replace('%','', $invoice['discount']));
if((int)$discount_total > 0){
    $total_no_discount = $total_invoice;
    $total_invoice = $total_invoice  - $total_invoice*$discount_total/100;
} else {
    $total_no_discount = $total_invoice;
}
$total_compare = $total_invoice;

//$total_invoice =  number_format(round($total_invoice,2),2,'.',',');

if ($invoice["state"] == "FL" && $invoice['remove_tax']==0) { 			
    $taxdec = 6/100;
    $taxtotal = $taxdec * $total_invoice;

    $total_invoice = $taxtotal + $total_invoice;
    $tax = '<tr>
        <td align="right" width="200"><strong>FL 6% Sales Tax:</strong></td><td align="right"><strong>'.formatMoney($taxtotal).'</strong></td></tr>'; 
}else {
    $total_invoice   = $total_invoice; 
    $tax = '<tr><td align="right" width="200"><strong>Sales Tax:</strong></td><td align="right"><strong> N/A</strong></td>';  
}

//echo $total_invoice.'---'.$invoice['paid_to_date'];
$paid_total = str_replace(',','',$total_invoice)-str_replace(',', '',$invoice['paid_to_date']);                                            

?>
<?php 
if ($_SESSION["customerloginid"])
{
	include_once 'inc/header-auth.php';
} else {
	include_once 'inc/header.php' ;
} ?>
<script type="text/javascript" src="js/slider.js"></script>

<style>
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
   
  <div id="content">   
    <div id="mainContentFull">
        <div style="padding-top: 50px; padding-bottom: 20px;">
                <table border="0" width="100%">
                    <tr>
                        <td><h1>Invoice: <?php echo $invoice['id'];?></h1></td>
                        <td align="right">
                            <a target="_blank" href="print_invoice.php?code=<?php echo $code;?>"> <input type="button" name="print" class="print_button" value="Print"/></a>
                        </td>
                    </tr>
                </table>
        </div>
        <div>
            <?php 
            
            if(round($paid_total,2) > 0){
            ?>
            <div class="block_pay">
                <div class="div_left"><b>Pay this invoice (<?php echo formatMoney($paid_total,2);?>) online:</b></div>
                <a href="payment_invoice.php?code=<?php echo $code;?>">
                    <div class="payment_bgr img_payment">
                        <div style="float: left; width: 90px;padding-top: 5px;padding-left: 5px;">Pay Online</div>
                        <div style="float: left;"> &nbsp;&nbsp;
                            <img src="admin/images/visa.gif" />
                            <img src="admin/images/mastercart.gif" />
                            <img src="admin/images/american-express.gif" />
                        </div>
                    </div> 
                </a>    
            </div>
            <?php } ?>
            <div style="height: 50px;"></div>
            <div class="box_infor">
                <div style="padding-top: 50px;">
                    <div style="float:left;width: 300px;padding-top: 5px;padding-left: 45px;">
                        Best Name Badges <br />
                        1700 NW 65th Ave, Suite 4<br />
                        Plantation, FL 33313<br />
                        Phone: 888-445-7601
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
                                <td align="right" style="padding-right: 5px;">
                                    $<?php
                                    //echo $total_invoice; 
                                    echo number_format(round($total_invoice,2),2,'.',',');
                                    ?>
                                </td>
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
                                              <td align="right" style="padding-right: 5px;"> <strong>$<?php echo number_format(str_replace(',','',$total_no_discount),2,'.',',');?></strong></td>
                                          </tr>
                                          <?php 
                                          $discount = str_replace('$', '', $invoice['discount']);
                                          if((int)$discount  > 0){
                                          ?>
                                          <tr>
                                              <td align="right" width="200"><strong>Discount:</strong></td>
                                              <td align="right" style="padding-right: 5px;"> <strong><?php echo $invoice['discount'];?></strong></td>
                                          </tr>
                                          <?php } ?>
                                      </table>                                       
                                    </div>
                             </td>
                         </tr>
                          <tr>
                              <td colspan="5">
                                  <div>
                                      <table border="0"  cellspacing="0" cellpadding="0" width="100%"  >
                                          
                                          <?php
                                            if($invoice['remove_tax']==0){
                                                echo $tax;
                                            }
                                          ?>
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
                                              <td align="right" style="padding-right: 5px;"><strong>$<?php echo number_format(round(str_replace(',', '',$invoice['paid_to_date']),2),2,'.',',');?></strong></td>
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
                                              <td align="right" style="padding-right: 5px;"><strong>$<?php echo number_format(round(str_replace(',','', $total_invoice)-str_replace(',','', $invoice['paid_to_date']),2),2,'.',',');?></strong></td>
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
           <?php 
            if(round($paid_total,2) > 0){
            ?>
            <div class="block_pay">
                <div class="div_left"><b>Pay this invoice (<?php echo formatMoney($paid_total,2);?>) online:</b></div>
               <a href="payment_invoice.php?code=<?php echo $code;?>">
                    <div class="payment_bgr img_payment">
                        <div style="float: left; width: 90px;padding-top: 5px;padding-left: 5px;">Pay Online</div>
                        <div style="float: left;"> &nbsp;&nbsp;
                            <img src="admin/images/visa.gif" />
                            <img src="admin/images/mastercart.gif" />
                            <img src="admin/images/american-express.gif" />
                        </div>
                    </div> 
                </a>    
            </div>
           <?php } ?>
        </div>
    </div>
  </div>
  <div style="display: none;"><img src="/images/sevenReasonsButtonMinus.png" /></div>

<?php include_once 'inc/footer.php' ; ?>