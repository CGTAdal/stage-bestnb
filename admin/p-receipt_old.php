<?php 
require_once('admin/conn/DB.php');
include('admin/conn/tablefuncs.php');
mysql_select_db($database_DB, $ravcodb);
session_start();


$qry = "SELECT * FROM preceipts WHERE id = ".$_REQUEST["rid"];
$orders = mysql_query($qry);
$order = mysql_fetch_assoc($orders);

$qry = "SELECT custid FROM printorders WHERE id = ".$order["oid"];
$custids = mysql_query($qry);
$custid = mysql_fetch_assoc($custids);

if ($_SESSION["customerloginid"] != $custid["custid"])
{ 
	header("location: unauthorized.php");
}

$qry = "SELECT batches.*, custstyle.stylename, colors.name as cname FROM batches LEFT JOIN custstyle ON (custstyle.id = batches.custstyleid) LEFT JOIN colors ON (colors.id = custstyle.color) WHERE batches.printorderid = ".$order["oid"];
$items = mysql_query($qry);
$item = mysql_fetch_assoc($items);
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
    <td width="433" align="right" valign="top"><strong style="font-size: 24px;">PRINT ORDER RECEIPT</strong><br />
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
    Order #: <strong>P-<?php echo $order["oid"]; ?></strong></td>
  </tr>
  <tr>
    <td height="32" colspan="2" valign="top"><table width="700" border="0" cellspacing="2" cellpadding="5">
      <tr style="background-color: #CCC;">
        <td width="253" align="center" valign="middle"><strong>TEXT</strong></td>
        <td width="121" align="center" valign="middle"><strong>STYLE</strong></td>
        <td width="87" align="center" valign="middle"><strong>FASTENER</strong></td>
        <td width="115" align="center" valign="middle"><strong>FRAME</strong></td>
        <td width="115" align="center" valign="middle"><strong>DOME</strong></td>		
        <td width="117" align="center" valign="middle"><strong>QUANTITY</strong></td>
      </tr>
	  <?php do { 
	  ?>
      <tr style="background-color: #ededed;">
        <td align="center" valign="middle"><?php echo $item["name"]; ?>
		<?php if ($item["subtext"]) { ?><br /><?php echo $item["subtext"]; ?><?php } ?>
		<?php if ($item["subtext2"]) { ?><br /><?php echo $item["subtext2"]; ?><?php } ?>
        </td>
        <td align="center" valign="middle"><?php echo $item["stylename"]; ?></td>
        <td align="center" valign="middle"><?php echo $item["fastener"]; ?></td>
        <td align="center" valign="middle"><?php echo $item["frame"]; ?></td>
        <td align="center" valign="middle"><?php if($item['dome'] == 1){echo 'Yes';}else {echo 'No';} ?></td>
        <td align="center" valign="middle">1</td>
      </tr>
      <?php } while ($item = mysql_fetch_assoc($items)); ?>
    </table></td>
  </tr>
  
</table>
</body>
</html>