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
	
	if (!$err)
	{
		unset($_POST["addcolorinfo"]);
		$where = "id = ".$_POST["colorid"];
		unset($_POST["colorid"]);
		modify_record("colors", $_POST, $where);
		$msg = "<font color='green'>Color Updated</font><br>";
		unset($_POST);?>
		<script language="javascript">
		parent.parent.location.href = "color_view_admin.php";
		window.close();
		</script>
	<?php }
}

if ($_REQUEST["colorid"])
{
	$colorid = $_REQUEST["colorid"];
}
if ($_POST["colorid"])
{
	$colorid = $POST["colorid"];
}


$qry = "SELECT colors.* FROM colors WHERE id = ".$_REQUEST["colorid"]." ORDER BY name";
$colors = mysql_query($qry) or die('Query failed: ' . mysql_error()); 
$color = mysql_fetch_assoc($colors);

$_POST = $color;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Edit Orders</title>
<?php include("init_top.php");?>
<link href="<?php echo $base_url;?>/admin/includes/cms.css" rel="stylesheet" type="text/css" />
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
<div class="xgrid">
		<div style="min-height: 300px;" class="portlet x12">
		<div class="portlet-header"><h4>View Batch</h4></div>			
			<div class="portlet-content" >
<form action="color_edit_admin.php" enctype="multipart/form-data" method="post" name="addcolor">
<input type="hidden" name="addcolorinfo" value="1">
<input type="hidden" name="colorid" value="<?php echo $colorid; ?>">
<?php /*
<table width="100%" frame="box" border="0">
	<tr>
		<td ><img src="images/generic_logo.gif" /></td>
	  	<td width="458" align="right" valign="bottom"><h3>Edit Color</h3></td>
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
		<td align="right"><strong>ColorID:</strong></td>
		<td><?php echo $colorid; ?></td>
	</tr>
	<tr>
		<td align="right"><strong>Color Name:</strong></td>
		<td><input type="text" name="name" value="<?php echo $_POST["name"]; ?>" /></td>
	</tr>
	<tr>
		<td align="right"><strong>Image Link:</strong></td>
		<td><input type="text" name="imglink" value="<?php echo $_POST["imglink"]; ?>" /></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td><input class="btn btn-small" type="submit" value="Modify Color" /></td>
	</tr>
</table>
</form>
</div></div></div>
<hr />
</body>
</html>
