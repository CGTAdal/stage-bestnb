<?php 
require_once('conn/DB.php');
include('conn/tablefuncs.php');
include('../include/config.php');
mysql_select_db($database_DB, $ravcodb);
session_start();
if (!$_SESSION["loginid"] || $_SESSION["userlevel"] < 2)
{?>
<script language="javascript">
parent.parent.location.href='admin.php';
window.close();
</script>
<?php }

if ($_POST["addcolorinfo"]) 
{
		unset($_POST["addcolorinfo"]);
		add_record("colors", $_POST);
		$msg = "<font color='green'>New Style Added</font><br>";
		unset($_POST);
}
if ($_REQUEST["styleid"]) {$styleid=$_REQUEST["styleid"];}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Add Color</title>
<?php include("init_top.php");?>
<link href="<?php echo base_url;?>/admin/includes/cms.css" rel="stylesheet" type="text/css" />

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
	<div class="portlet-header"><h4>Add Color</h4></div>			
		<div class="portlet-content" >
<form action="color_add_admin.php" enctype="multipart/form-data" method="post" name="addcolor">
<input type="hidden" name="addcolorinfo" value="1">
<input type="hidden" name="styleid" value="<?php echo $styleid; ?>">
<?php /*
<table width="100%" frame="box" border="0">
	<tr>
		<td ><img src="images/generic_logo.gif"/></td>
	  	<td width="458" align="right" valign="bottom"><h3>Add Color</h3></td>
	</tr>
	<tr>
		<td colspan="2"><hr /></td>
	</tr>
</table>
*/?>
<table width="100%" frame="box" border="0">
	<?php if ($msg) { ?>
	<tr>
		<td>&nbsp;</td>
		<td><font size="1"><?php echo $msg; ?></font></td>
	</tr>
	<?php } ?>
	<tr>
		<td align="right"><strong>Color Name:</strong></td>
		<td><input type="text" name="name" value="<?php echo $_POST["name"]; ?>"/></td>
	</tr>
	<tr>
		<td align="right"><strong>Image Link:</strong></td>
		<td><input type="text" name="imglink" value="<?php echo $_POST["imglink"]; ?>"/></td>
	</tr>
	<?php /*
	<tr>
		<td colspan="2">&nbsp;</td>
	</tr>
	*/?>
	<tr>
		<td>&nbsp;</td>
		<td><input style="font-size:13px;" class="btn btn-small" type="submit" value="Submit New Color" /></td>
	</tr>
</table>
</form>
</body>
</html>
