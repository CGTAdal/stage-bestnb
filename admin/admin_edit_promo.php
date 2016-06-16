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
		$where = "id = ".$_POST["promoid"];
		unset($_POST["promoid"]);
		modify_record("promo_codes", $_POST, $where);
		header("location: admin_promo_codes.php");
}

$qry = "SELECT * FROM promo_codes WHERE id =".$_REQUEST["promoid"];
$promos = mysql_query($qry) or die('Query failed: ' . mysql_error()); 
$promo = mysql_fetch_assoc($promos);
	
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
<div class="xfluid" style="width: 95%;margin-left: 2.50%;">
<div style="min-height: 300px;" class="portlet x12">
	<div class="portlet-header"><h4>Update Promo Code</h4></div>			
		<div class="portlet-content" >
		
<form action="admin_edit_promo.php" enctype="multipart/form-data" method="post" name="addstyle">
<input type="hidden" name="addpromo" value="1">
<input type="hidden" name="promoid" value="<?php echo $_REQUEST["promoid"]; ?>">
<table width="800" frame="box" border="0" align="center">
<?php /*
	<tr>
		<td>&nbsp;</td>
		<td align="right" valign="bottom"><h3>Update Promo Code</h3></td>
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
		<td><input type="text" name="code" value="<?php echo $promo["code"]; ?>" size="30"/></td>
	</tr>
	<tr>
		<td align="right"><strong>Description:</strong></td>
		<td><input type="text" name="name" value="<?php echo $promo["name"]; ?>" size="30"/></td>
	</tr>
	<tr>
		<td align="right"><strong>Percentage:</strong></td>
		<td><input type="text" name="percentage" value="<?php echo $promo["percentage"]; ?>"/></td>
	</tr>
	<tr>
		<td align="right"><strong>Type:</strong></td>
		<td>
		<select name="type">
			<option value="1" <?php if ($promo["type"] == 1) { ?>selected<?php } ?>>Setup Fee Discount</option>
			<option value="2" <?php if ($promo["type"] == 2){ ?>selected<?php } ?>>Total Order Discount</option>
		</select>
		</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td><input style="font-size:12px;" class="btn btn-small"  type="submit" value="Update Promo Code" /></td>
	</tr>
</table>
</form>

</body>
</html>
