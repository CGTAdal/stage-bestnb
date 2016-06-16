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

if ($_POST["addorderinfo"]) 
{
	
	if (!$err)
	{
		unset($_POST["addorderinfo"]);
		$where = "id = ".$_POST["orderid"];
		unset($_POST["orderid"]);
		modify_record("orders", $_POST, $where);
		$msg = "<font color='green'>Order Updated</font><br>";
		unset($_POST);?>
		<script language="javascript">
		parent.parent.location.href = "order_view_admin.php";
		window.close();
		</script>
	<?php }
}

if ($_REQUEST["orderid"])
{
	$colorid = $_REQUEST["orderid"];
}
if ($_POST["orderid"])
{
	$colorid = $POST["orderid"];
}


$qry = "SELECT orders.* FROM orders WHERE id = ".$_REQUEST["orderid"]." ORDER BY timestamp";
$colors = mysql_query($qry) or die('Query failed: ' . mysql_error()); 
$color = mysql_fetch_assoc($colors);

$_POST = $color;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Edit Orders</title>
<link href="includes/cms.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
    var GB_ROOT_DIR = "greybox/";
</script>


<script type="text/javascript" src="greybox/AJS.js"></script>
<script type="text/javascript" src="greybox/AJS_fx.js"></script>
<script type="text/javascript" src="greybox/gb_scripts.js"></script>
<link href="greybox/gb_styles.css" rel="stylesheet" type="text/css" />
<style>

.resize
{
	width:150px;
	height:auto;
}
</style>
</head>

<body>

<form action="order_edit_admin.php" enctype="multipart/form-data" method="post" name="addorder">
<input type="hidden" name="addorderinfo" value="1">
<input type="hidden" name="orderid" value="<?php echo $colorid; ?>">
<table width="100%" frame="box" border="0">
	<tr>
		<td ><img src="images/generic_logo.gif" /></td>
	  	<td width="458" align="right" valign="bottom"><h3>Edit Order</h3></td>
	</tr>
	<tr>
		<td colspan="2"><hr /></td>
	</tr>
</table>
<table width="100%" frame="box" border="0">
	<?php if ($msg) { ?>
	<tr>
		<td>&nbsp;</td>
		<td><font size="1"><?php echo $msg; ?></font></td>
	</tr>
	<?php } ?>
	<tr>
		<td align="right"><strong>Order#:</strong></td>
		<td><?php echo $colorid ?></td>
	</tr>
	<tr>
		<td align="right"><strong>CustomerID</strong></td>
		<td><input type="text" name="customerid" value="<?php echo $_POST["customerid"]; ?>" /></td>
	</tr>
	<tr>
		<td align="right"><strong>OrderID</strong></td>
		<td><input type="text" name="orderid" value="<?php echo $_POST["customerid"]; ?>" /></td>
	</tr>
	<tr>
		<td align="right"><strong>Quantity</strong></td>
		<td><input type="text" name="qty" value="<?php echo $_POST["qty"]; ?>" /></td>
	</tr>
	<tr>
		<td align="right"><strong>Price</strong></td>
		<td><input type="text" name="price" value="<?php echo $_POST["price"]; ?>" /></td>
	</tr>
	<tr>
		<td colspan="2">&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td><input type="submit" value="Modify Order" /></td>
	</tr>
</table>
</form>
<hr />
</body>
</html>
