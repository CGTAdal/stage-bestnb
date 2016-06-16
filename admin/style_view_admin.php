<?php 
require_once('conn/DB.php');
include('conn/tablefuncs.php');
include('../include/config.php');
include('permision.php');
mysql_select_db($database_DB, $ravcodb);
session_start();
if (!$_SESSION["loginid"] || $_SESSION["userlevel"] < 2)
{?>
<script language="javascript">
parent.parent.location.href='admin.php';
window.close();
</script>
<?php }

if ($_REQUEST["delid"])
{
	if(check('delete',3)){
		delete_record("styles", $_REQUEST["delid"]);
		delete_record_secondary("colors", $_REQUEST["delid"],"styleid");
	}else {
		die('You don\'t have permision to perform this action.');
	}
}

if ($_REQUEST["styleid"])
{
	$styleid=$_REQUEST["styleid"];
	$qry = "SELECT styles.* FROM styles WHERE styles.id=$styleid ORDER BY 'name'";
} else {
	$qry = "SELECT styles.* FROM styles ORDER BY 'name'";
}

$styles = mysql_query($qry) or die('Query failed: ' . mysql_error()); 
$style = mysql_fetch_assoc($styles);
	

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>View Styles</title>
<?php include("init_top.php");?>
<link href="<?php echo $base_url;?>/admin/includes/cms.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?php echo $base_url;?>/admin/calendar/calendar-win2k-1.css" />


<!-- main calendar program -->
<script type="text/javascript" src="<?php echo $base_url;?>/admin/calendar/calendar.js"></script>

<!-- language for the calendar -->
<script type="text/javascript" src="<?php echo $base_url;?>/admin/calendar/lang/calendar-en.js"></script>

<!-- the following script defines the Calendar.setup helper function, which makes
     adding a calendar a matter of 1 or 2 lines of code. -->
<script type="text/javascript" src="<?php echo $base_url;?>/admin/calendar/calendar-setup.js"></script>

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
	window.location = "style_view_admin.php";
}
</script>

<script type="text/javascript" src="scripts/enlargeit.js"></script>

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
<div class="xgrid">
<div style="min-height: 300px;" class="portlet x12">
	<div class="portlet-header"><h4>View Styles</h4></div>			
		<div class="portlet-content" >
		
<form action="style_add_admin.php" enctype="multipart/form-data" method="post" name="addstyle">
<input type="hidden" name="addstyleinfo" value="1">
<table width="800" frame="box" border="0" align="center">
	<tr>
		<td colspan="2"><a href="style_add_admin.php" title="Add Style" class="btn btn-small" style="color:#fff">Add Style</a></td>
	</tr>
	<tr bgcolor="#D8D7E3">
		<td class="fieltable"><strong>Style Name</strong></td>
		<td class="fieltable"><strong>Style Size</strong></td>
		<td class="fieltable"><strong>Image</strong></td>
		<td class="fieltable"><strong>Action</strong></td>
	</tr>
	<?php 
	$bgcolor = "WHITE";
	do { ?>
	<tr bgcolor="<?php echo $bgcolor; ?>">
		<td><?php echo $style["name"]; ?></td>
		<td><?php echo $style["size"]; ?></td>
		<td><img src='../badgeimages/thumbs/<?php echo $style["imglink"]; ?>' id='photo<?php echo $style["id"]; ?>' onclick='enlarge(this);' longdesc='../badgeimages/<?php echo $style["imglink"]; ?>' alt='<?php echo $style["imglink"]; ?>'></td>
		<td><a href="style_edit_admin.php?styleid=<?php echo $style["id"]; ?>" rel="gb_page_center[1024, 500]">edit</a>&nbsp;&nbsp;<?php if(check('delete',3)){?> <a href="style_view_admin.php?delid=<?php echo $style["id"]; ?>" onClick="javascript:return confirm('Are you sure you want to delete this style?')">delete</a><?php } ?>&nbsp;&nbsp; <a href="color_view_admin.php?styleid=<?php echo $style["id"]; ?>" >colors</a></td>
	</tr>
	<?php 
	if ($bgcolor == "WHITE")
	{
		$bgcolor = "#D8D8D8";
	} else {
		$bgcolor = "WHITE";
	}
	} while ($style = mysql_fetch_assoc($styles)); ?>
</table>
</form>
</div>
</div>
</div>
</body>
</html>
