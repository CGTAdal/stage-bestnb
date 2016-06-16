<?php 
require_once('conn/DB.php');
include('conn/tablefuncs.php');
include('../include/config.php');
mysql_select_db($database_DB, $ravcodb);
session_start();
include('permision.php');
//if (!$_SESSION["loginid"] || $_SESSION["userlevel"] < 2)
if (!$_SESSION["loginid"])
{?>
<script language="javascript">
parent.parent.location.href='admin.php';
window.close();
</script>
<?php }

if ($_REQUEST["delid"])
{
	if(check('delete',3)){
		delete_record("promo_codes", $_REQUEST["delid"]);
	}else {
		die('You don\'t have permision to perform this action.');
	}

}

$qry = "SELECT * FROM promo_codes";
$promos = mysql_query($qry) or die('Query failed: ' . mysql_error()); 
$promo = mysql_fetch_assoc($promos);
	

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>View Promo Codes</title>
	<?php include("init_top.php");?>
	<link href="<?php echo $base_url;?>/admin/includes/cms.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css"  href="<?php echo $base_url;?>/admin/calendar/calendar-win2k-1.css" />
	
	
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
</head>

<body>
<?php include("header.php"); ?>
<div class="xgrid">
<div style="min-height: 300px;" class="portlet x12">
	<div class="portlet-header"><h4>View Promo Codes</h4></div>			
		<div class="portlet-content" >
		
<form action="admin_promo_code.php" enctype="multipart/form-data" method="post" name="addstyle">
<table width="800" frame="box" border="0" align="center">
	<tr>
		<td colspan="2"><a href="admin_add_promo.php" title="Add Style" class="btn btn-small" style="color:#fff">Add Promo Code</a></td>
	</tr>
	<tr bgcolor="#D8D7E3">
		<td class="fieltable"><strong>Code</strong></td>
		<td class="fieltable"><strong>Description</strong></td>
		<td class="fieltable"><strong>Percentage</strong></td>
		<td class="fieltable"><strong>Type</strong></td>
		<td class="fieltable"><strong>Action</strong></td>
	</tr>
	<?php 
	$bgcolor = "WHITE";
	do { ?>
	<tr bgcolor="<?php echo $bgcolor; ?>">
		<td><?php echo $promo["code"]; ?></td>
		<td><?php echo $promo["name"]; ?></td>
		<td align="center"><?php echo $promo["percentage"]; ?>%</td>
		<td><?php if ($promo["type"] == 1) { echo "Setup Discount"; } else if ($promo["type"] == 2) { echo "Total Order Discount"; } ?></td>
		<td><a href="admin_edit_promo.php?promoid=<?php echo $promo["id"]; ?>">edit</a>&nbsp;&nbsp; <?php if(check('delete',3)){?><a href="admin_promo_codes.php?delid=<?php echo $promo["id"]; ?>" onClick="javascript:return confirm('Are you sure you want to delete this code?')">delete</a><?php } ?></td>
	</tr>
	<?php 
		if ($bgcolor == "WHITE")
		{
			$bgcolor = "#D8D8D8";
		} else {
			$bgcolor = "WHITE";
		}
	} while ($promo = mysql_fetch_assoc($promos)); ?>
</table>
</form>
</div>
</div>
</div>
</body>
</html>
