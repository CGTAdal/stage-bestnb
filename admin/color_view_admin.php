<?php 

require_once('conn/DB.php');
include('conn/tablefuncs.php');
include('../include/config.php');
mysql_select_db($database_DB, $ravcodb);
session_start();
if (!$_SESSION["loginid"] || $_SESSION["userlevel"] < 2)
{?>
<script language="javascript">
parent.parent.location.href='style_view_admin.php';
window.close();
</script>
<?php }

if ($_REQUEST["delid"])
{
	delete_record("colors", $_REQUEST["delid"]);
}
if ($_REQUEST["styleid"])
{
	$styleid=$_REQUEST["styleid"];
}


$qry = "SELECT colors.* FROM colors WHERE styleid=$styleid ORDER BY 'name'";
$colors = mysql_query($qry) or die('Query failed: ' . mysql_error()); 
$color = mysql_fetch_assoc($colors);
	

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>View Colors</title>
<?php include("init_top.php");?>
<link href="includes/cms.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" media="all" href="../calendar/calendar-win2k-1.css"  />


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
	window.location = "color_view_admin.php";
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
	<div class="portlet-header"><h4>View Colors</h4></div>			
		<div class="portlet-content" >
		
<form action="color_add_admin.php" enctype="multipart/form-data" method="post" name="addcolor">
<input type="hidden" name="addcolorinfo" value="1">
<?php /*
<table border="0" cellpadding="0" cellspacing="0" width="96%">

	<tr>
		<td colspan="3"><img src="images/generic_logo.gif"/></td>
	  <td width="458" align="right" valign="bottom"><h3>View Colors</h3></td>
	</tr>

	<tr>
		<td colspan="4"><hr /></td>
	</tr>
	
</table>
*/?>
<a href="color_add_admin.php?styleid=<?php echo $styleid;?>" class="btn btn-small" style="color:#fff">Add Color</a>
<tr>
		<td colspan="4"><hr /></td>
	</tr>
<table width="96%" frame="box" border="0">
	<tr bgcolor="#D8D7E3">
		<td class="fieltable"><strong>Color Name</strong></td>
		<td class="fieltable"><strong>Image Link</strong></td>
		<td class="fieltable"><strong>Action</strong></td>
	</tr>
	<?php 
	$bgcolor = "WHITE";
	if ((mysql_num_rows($colors)) >0)
	{
		do { ?>
		<tr bgcolor="<?php echo $bgcolor; ?>">
			<td><?php echo $color["name"]; ?></td>
			<td><img src='../colorimages/thumbs/<?php echo $color["imglink"]; ?>' id='photo<?php echo $color["id"]; ?>' onclick='enlarge(this);' longdesc='../colorimages/<?php echo $color["imglink"]; ?>' alt='<?php echo $color["imglink"]; ?>'></td>
			<td><a href="color_edit_admin.php?colorid=<?php echo $color["id"]; ?>" rel="gb_page_center[1024, 500]">edit</a>&nbsp;&nbsp; <a href="color_view_admin.php?styleid=<?php echo $styleid;?>&delid=<?php echo $color["id"]; ?>" onClick="javascript:return confirm('Are you sure you want to delete this color?')">delete</a></td>
		</tr>
		<?php 
		if ($bgcolor == "WHITE")
		{
			$bgcolor = "#D8D8D8";
		} else {
			$bgcolor = "WHITE";
		}
		} while ($color = mysql_fetch_assoc($colors));
	} else { ?>
		<tr><td><?php echo "No records to display";?></td></tr> 
<?php	} ?>
</table>
</form>
</div>
</div>
</div>
</body>
</html>
