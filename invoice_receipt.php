<?php 
require_once('admin/conn/DB.php');
include('admin/conn/tablefuncs.php');
mysql_select_db($database_DB, $ravcodb);
session_start();

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

$qry = "SELECT * FROM receipts WHERE id = ".$_REQUEST["rid"];
//echo $qry;
$orders = mysql_query($qry);
$order = mysql_fetch_assoc($orders);

$qry = "SELECT customerid FROM orders WHERE id = ".$order["oid"];
$custids = mysql_query($qry);
$custid = mysql_fetch_assoc($custids);

if ($_SESSION["customerloginid"] != $custid["customerid"])
{ 
	header("location: unauthorized.php");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Best Name Badges - Receipt</title>
<style type="text/css">
<!--
body {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 13px;
	color: #000;
}
-->
</style>
</head>

<body>
<table width="698" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="267" height="89" valign="top"><img src="images/best-name-badges-logo.png" width="228" height="67" /><br />
      <br /></td>
    <td width="433" align="right" valign="top"><strong style="font-size: 24px;">PURCHASE ORDER RECEIPT</strong><br />
      <br />
      support@bestnamebadges.com<br />
Phone: 888.445-7601</td>
  </tr>
  <tr>
    <td height="111" valign="top"><p><strong>Customer:</strong><br />
      <?php echo $order["name"]; ?><br />
      <?php echo $order["address"]." ".$order["address2"]; ?><br />
    <?php echo $order["city"]; ?>, <?php echo $order["state"]; ?> <?php echo $order["zip"]; ?></p></td>
    <td align="right" valign="top">Date: <?php echo date("F d, Y", strtotime($order["date"])); ?><br />
    <br />
    Order #: <strong>O-<?php echo $order["oid"]; ?></strong></td>
  </tr>
  <tr>
    <td height="32" colspan="2"><table width="700" border="0" cellspacing="2" cellpadding="5">
      <tr style="background-color: #CCC;">
        <td width="253" align="center" valign="middle"><strong>DESCRIPTION</strong></td>
        <td width="125" align="center" valign="middle"><strong>QUANTITY</strong></td>
        <td width="143" align="center" valign="middle"><strong>UNIT PRICE</strong></td>
        <td width="129" align="center" valign="middle"><strong>TOTAL</strong></td>
      </tr>                
	 <?php 
        // get all item of each invoices 
        $id = $_REQUEST['invoice_id'];
        $sql = "SELECT * FROM invoices WHERE id='{$id}'";       
        //echo $sql;
        $result = mysql_query($sql);
        if($result){
            $invoice = mysql_fetch_assoc($result);
        }  else {
            $invoice  = array();
        }
       
        $sql_total  = "SELECT * FROM item_invoice WHERE invoice_id = '{$invoice['id']}'";
       
        //echo $sql_total;
        $result_total = mysql_query($sql_total);
        $total_invoice = 0;
        $total_compare = 0;
        $item  = array();
        $total_no_discount = 0;
        if($result_total){                                
            while($row_total = mysql_fetch_assoc($result_total)){
                //echo $row_total['total'].'<br />';
                $item[] = $row_total;
                $total_item = str_replace(',','',  $row_total['total']);
                $total_invoice = $total_invoice  +$total_item;
                
            }
        }
        $total_no_discount = $total_invoice;
        $a = str_replace("%","",$invoice['discount']);       
        if($a > 0){           
            $total_invoice = $total_invoice  - $total_invoice* $a/100;        
            
        } 
        $tax = str_replace("$","",$order['tax']);   
        //echo $tax;
        if($tax >0){                           
            $total_compare = $total_invoice + $tax ;
        }else {
            $total_compare = $total_invoice;             
        }
        
        $total_invoice =  number_format(str_replace(',','',$total_invoice),2,'.',',');
        //echo $total_invoice;
        foreach($item as $it){                
     ?>           
      <tr>
          <td align="center" valign="middle"><?php echo $it['description'];?></td>
          <td align="center" valign="middle"><?php echo $it['qty'];?></td>
          <td align="center" valign="middle"><?php echo $it['unit_cost'];?></td>
          <td align="center" valign="middle"><?php echo formatMoney(str_replace(',','',$it['total']));?></td>
      </tr>      
      <?php } ?>    
       
       <tr>
        <td colspan="2" align="center" valign="middle">&nbsp;</td>
        <td align="center" valign="middle" style="font-size: 11px;">DISCOUNT</td>
        <td align="center" valign="middle"><strong><?php echo $invoice['discount']; ?></strong></td>
      </tr>     
      <tr>
        <td colspan="2" align="center" valign="middle">&nbsp;</td>
        <td align="center" valign="middle" style="font-size: 11px;">SUBTOTAL</td>
        <td align="center" valign="middle"><strong>$<?php echo number_format(round($total_invoice,2),2,'.',','); ?></strong></td>
      </tr>
      <tr>
        <td colspan="2" align="center" valign="middle">&nbsp;</td>
        <td align="center" valign="middle" style="font-size: 11px;">SALES TAX</td>
        <td align="center" valign="middle"><?php if ($order["tax"]) { echo formatMoney($order["tax"]); } else { echo "N/A"; } ?></td>
      </tr>
      <tr>
        <td colspan="2" align="center" valign="middle">&nbsp;</td>
        <td align="center" valign="middle" style="font-size: 11px;">TOTAL CHARGED</td>
        <td align="center" valign="middle"><strong>$<?php echo number_format(round($total_compare,2),2,'.',',');  ?></strong></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>