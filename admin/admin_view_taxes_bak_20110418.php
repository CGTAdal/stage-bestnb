<?php 
require_once('conn/DB.php');
include('conn/tablefuncs.php');
mysql_select_db($database_DB, $ravcodb);
session_start();
if (!$_SESSION["loginid"] || $_SESSION["userlevel"] < 2)
{?>
<script language="javascript">
parent.parent.location.href='admin.php';
window.close();
</script>
<?php }

if ($_REQUEST["orderid"])
{
	$data["status"] = $_REQUEST["status"];
	$where = "id = ".$_REQUEST["orderid"];
	modify_record("orders", $data, $where);
}

if ($_REQUEST["delid"])
{
	delete_record_secondary("orders", $_REQUEST["delid"], "id");
}

$qry = "SELECT * FROM receipts WHERE tax > 0 ORDER BY id DESC";

$orders = mysql_query($qry) or die('Query failed: ' . mysql_error()); 
$order = mysql_fetch_assoc($orders);

$qry = "SELECT sum(tax) as taxtotal FROM receipts";

$taxes = mysql_query($qry) or die('Query failed: ' . mysql_error()); 
$tax = mysql_fetch_assoc($taxes);
	

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>View Orders</title>
<link href="includes/cms.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" media="all" href="../calendar/calendar-win2k-1.css" title="win2k-1" />


<!-- main calendar program -->
<script type="text/javascript" src="../calendar/calendar.js"></script>

<!-- language for the calendar -->
<script type="text/javascript" src="../calendar/lang/calendar-en.js"></script>

<!-- the following script defines the Calendar.setup helper function, which makes
     adding a calendar a matter of 1 or 2 lines of code. -->
<script type="text/javascript" src="../calendar/calendar-setup.js"></script>

<script type="text/javascript">
    var GB_ROOT_DIR = "greybox/";
</script>


<script type="text/javascript" src="greybox/AJS.js"></script>
<script type="text/javascript" src="greybox/AJS_fx.js"></script>
<script type="text/javascript" src="greybox/gb_scripts.js"></script>
<link href="greybox/gb_styles.css" rel="stylesheet" type="text/css" />

<script language="javascript">
function reloadIt()
{
	window.location = "order_view_admin.php";
}
</script>

<style>

.resize
{
	width:150px;
	height:auto;
}
</style>

</head>

<body>
<?php include("header.php"); ?>
<form action="order_add_admin.php" enctype="multipart/form-data" method="post" name="addorder">
<input type="hidden" name="addorderinfo" value="1">
<table width="800" frame="box" border="0" align="center">
	<tr>
		<td colspan="1">&nbsp;</td>
		<td colspan="6" align="right" valign="bottom"><h3>View Taxed Orders</h3></td>
	</tr>
	<tr bgcolor="#D8D7E3">
		<td><strong>Order#</strong></td>
		<td><strong>Customer</strong></td>
		<td><strong>Date</strong></td>
		<td><strong>Qty</strong></td>
		<td><strong>Frame Qty</strong></td>
		<td><strong>Price/Badge</strong></td>
		<td><strong>Tax</strong></td>
	</tr>
	<?php 
	$bgcolor = "WHITE";
	do { ?>
	<tr bgcolor="<?php echo $bgcolor; ?>">
		<td><?php echo $order["oid"]; ?></td>
		<td><?php echo $order["name"]; ?></td>
		<td><?php echo date("m/d/Y", strtotime($order["date"])); ?></td>
		<td><?php echo $order["bqty"]; ?></td>
		<td><?php echo $order["fqty"]; ?></td>
		<td><?php echo "$".money_format('%(#8.2n', $order["bunit"]); ?></td>
	    <td><?php echo "$".money_format('%(#8.2n', $order["tax"]); ?></td>
	</tr>
	<?php 
	if ($bgcolor == "WHITE")
	{
		$bgcolor = "#D8D8D8";
	} else {
		$bgcolor = "WHITE";
	}
	} while ($order = mysql_fetch_assoc($orders)); ?>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td><?php echo "$".money_format('%(#8.2n', $tax["taxtotal"]); ?></td>
	</tr>
</table>
</form>

</body>
</html>
