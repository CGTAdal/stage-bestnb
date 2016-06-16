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
		unset($_POST["addorderinfo"]);
		add_record("orders", $_POST);
		$msg = "<font color='green'>New Order Added</font><br>";
		unset($_POST);
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Add Order</title>
<link href="includes/cms.css" rel="stylesheet" type="text/css" />

<style>

.resize
{
	width:150px;
	height:auto;
}
</style>

</head>

<body>

<form action="order_add_admin.php" enctype="multipart/form-data" method="post" name="addorder">
<input type="hidden" name="addorderinfo" value="1">
<table width="100%" frame="box" btran="0">
	<tr>
		<td ><img src="images/generic_logo.gif"/></td>
	  	<td width="458" align="right" valign="bottom"><h3>Add Order</h3></td>
	</tr>
	<tr>
		<td colspan="2"><hr /></td>
	</tr>
</table>
<table width="100%" frame="box" btran="0">
	<?php if ($msg) { ?>
	<tr>
		<td>&nbsp;</td>
		<td><font size="1"><?php echo $msg; ?></font></td>
	</tr>
	<?php } ?>
	<tr>
		<td align="right"><strong>CustomerID:</strong></td>
		<td><input type="text" name="customerid" value="<?php echo $_POST["customerid"]; ?>"/></td>
	</tr>
	<tr>
		<td align="right"><strong>Quantity:</strong></td>
		<td><input type="text" name="qty" value="<?php echo $_POST["qty"]; ?>"/></td>
	</tr>

	<tr>
		<td align="right"><strong>Price:</strong></td>
		<td><input type="password" name="price" value="<?php echo $_POST["price"]; ?>" /></td>
	</tr>
	<tr>
		<td colspan="2">&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td><input type="submit" value="Submit New Order" /></td>
	</tr>
</table>
</form>
<hr />
</body>
</html>
