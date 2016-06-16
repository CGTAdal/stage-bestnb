<?php 
require_once('conn/DB.php');
include('conn/tablefuncs.php');
include('../include/config.php');
mysql_select_db($database_DB, $ravcodb);
session_start();
//if (!$_SESSION["loginid"] || $_SESSION["userlevel"] < 2)
if (!$_SESSION["loginid"])
{?>
<script language="javascript">
parent.parent.location.href='admin.php';
window.close();
</script>
<?php }

if ($_POST["addpromo"]) 
{

		unset($_POST["addpromo"]);
		add_record("promo_codes", $_POST);
		header("location: admin_promo_codes.php");
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Add Promo Code</title>
<?php include("init_top.php");?>
<link href="<?php echo $base_url;?>/admin/includes/cms.css" rel="stylesheet" type="text/css" />

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
<div class="xgrid" >
<div style="min-height: 300px;" class="portlet x12">
	<div class="portlet-header"><h4>Add Promo Code</h4></div>			
		<div class="portlet-content" >
<form action="admin_add_promo.php" enctype="multipart/form-data" method="post" name="addstyle">
<input type="hidden" name="addpromo" value="1">
<table width="800" frame="box" border="0" align="center">
<?php /*
	<tr>
		<td>&nbsp;</td>
		<td align="right" valign="bottom"><h3>Add Promo Code</h3></td>
	</tr>
*/?>
	<?php if ($msg) { ?>
	<tr>
		<td>&nbsp;</td>
		<td><font size="1"><?php echo $msg; ?></font></td>
	</tr>
	<?php } ?>
	<tr>
		<td align="right"><strong>Code:</strong></td>
		<td><input type="text" name="code" value="<?php echo $_POST["code"]; ?>" size="30"/></td>
	</tr>
	<tr>
		<td align="right"><strong>Description:</strong></td>
		<td><input type="text" name="name" value="<?php echo $_POST["name"]; ?>" size="30"/></td>
	</tr>
	<tr>
		<td align="right"><strong>Percentage:</strong></td>
		<td><input type="text" name="percentage" value="<?php echo $_POST["percentage"]; ?>"/></td>
	</tr>
	<tr>
		<td align="right"><strong>Type:</strong></td>
		<td>
		<select name="type">
			<option value="1">Setup Fee Discount</option>
			<option value="2">Total Order Discount</option>
		</select>
		</td>
	</tr>
	<?php /*
	<tr>
		<td colspan="2">&nbsp;</td>
	</tr>
*/?>
	<tr>
		<td>&nbsp;</td>
		<td ><input style="font-size:12px;" class="btn btn-small" type="submit" value="Add Promo Code" /></td>
	</tr>
</table>
</form>
</div>
</div>
</div>
<hr />
</body>
</html>
