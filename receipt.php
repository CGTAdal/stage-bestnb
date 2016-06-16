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
	  <?php if ($order["bqty"]) {
	  $badgestotal = $order["bqty"] * $order["bunit"]; ?>
      <tr style="background-color: #ededed;">
        <td align="center" valign="middle">Pro Badges</td>
        <td align="center" valign="middle"><?php echo $order["bqty"]; ?></td>
        <td align="center" valign="middle"><?php echo formatMoney($order["bunit"]); ?></td>
        <td align="center" valign="middle"><?php echo formatMoney($badgestotal); ?></td>
      </tr>
	  <?php } ?>
	  <?php if ($order["fqty"]) {
	  $framestotal = $order["fqty"] * $order["funit"]; ?>
      <tr style="background-color: #e0e0e0;">
        <td align="center" valign="middle">Badge Frames</td>
        <td align="center" valign="middle"><?php echo $order["fqty"]; ?></td>
        <td align="center" valign="middle"><?php echo formatMoney($order["funit"]); ?></td>
        <td align="center" valign="middle"><?php echo formatMoney($framestotal); ?></td>
      </tr>
	  <?php } ?>
	  <?php if ($order["dmqty"]) {
	  $domestotal = $order["dmqty"] * 2.75; ?>
      <tr style="background-color: #e0e0e0;">
        <td align="center" valign="middle">Domes</td>
        <td align="center" valign="middle"><?php echo $order["dmqty"]; ?></td>
        <td align="center" valign="middle"><?php echo formatMoney(2.75); ?></td>
        <td align="center" valign="middle"><?php echo formatMoney($domestotal); ?></td>
      </tr>
	  <?php } ?>
	  <tr>
        <td colspan="2" align="center" valign="middle">&nbsp;</td>
        <td align="center" valign="middle" style="font-size: 11px;">SETUP Fee</td>
        <td align="center" valign="middle"><?php echo formatMoney($order["setup"]); ?></td>
      </tr>
	  
	  <?php if ($order["discount"]) { ?>
	   <tr>
        <td colspan="2" align="center" valign="middle">&nbsp;</td>
        <td align="center" valign="middle" style="font-size: 11px;"><?php echo $order["promocode"]; ?></td>
        <td align="center" valign="middle">- <?php echo formatMoney($order["discount"]); ?></td>
      </tr>
	  <?php } ?>
      <tr>
        <td colspan="2" align="center" valign="middle">&nbsp;</td>
        <td align="center" valign="middle" style="font-size: 11px;">SUBTOTAL</td>
        <td align="center" valign="middle"><?php echo formatMoney($badgestotal + $framestotal + $domestotal + $order["setup"] - $order["discount"]); ?></td>
      </tr>
      <tr>
        <td colspan="2" align="center" valign="middle">&nbsp;</td>
        <td align="center" valign="middle" style="font-size: 11px;">SALES TAX</td>
        <td align="center" valign="middle"><?php if ($order["tax"]) { echo formatMoney($order["tax"]); } else { echo "N/A"; } ?></td>
      </tr>
      <tr>
        <td colspan="2" align="center" valign="middle">&nbsp;</td>
        <td align="center" valign="middle" style="font-size: 11px;">SHIPPING</td>
        <td align="center" valign="middle">Free</td>
      </tr>
      <tr>
        <td colspan="2" align="center" valign="middle">&nbsp;</td>
        <td align="center" valign="middle" style="font-size: 11px;">TOTAL CHARGED</td>
        <td align="center" valign="middle"><strong><?php echo formatMoney($badgestotal + $framestotal + $domestotal + $order["setup"] + $order["tax"] - $order["discount"]); ?></strong></td>
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