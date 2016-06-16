<?php 
require_once('conn/DB.php');
include('conn/tablefuncs.php');
include('../include/config.php');
mysql_select_db($database_DB, $ravcodb);
session_start();
include('permision.php');
if (!$_SESSION["loginid"] || $_SESSION["userlevel"] < 2)
{?>
<script language="javascript">
parent.parent.location.href='admin.php';
window.close();
</script>
<?php }
if($_REQUEST['delete'] == 1){
	$id_del  = $_REQUEST['id'];
	$sql_del = 'DELETE FROM templates WHERE id='.$id_del;
	mysql_query($sql_del);
}
if($_REQUEST['private'] == 1){
	$active  = $_REQUEST['st'];
	$id_up  = $_REQUEST['id'];
	$sql_up = "UPDATE  templates SET private = $active WHERE id= $id_up";
	mysql_query($sql_up);
}
$sql = 'SELECT *FROM templates';
$result = mysql_query($sql);
$num_rows  = mysql_num_rows($result);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>View Print Orders</title>
<?php include("init_top.php");?>
<link href="<?php echo $base_url?>/admin/includes/cms.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" media="all" href="<?php echo $base_url?>/admin/calendar/calendar-win2k-1.css" title="win2k-1" />

<script type="text/javascript" src="<?php echo $base_url?>/admin/scripts/jquery-1.3.2.min.js"></script>
<!-- main calendar program -->
<script type="text/javascript" src="<?php echo $base_url?>/admin/calendar/calendar.js"></script>

<!-- language for the calendar -->
<script type="text/javascript" src="<?php echo $base_url?>/admin/calendar/lang/calendar-en.js"></script>

<!-- the following script defines the Calendar.setup helper function, which makes
     adding a calendar a matter of 1 or 2 lines of code. -->
<script type="text/javascript" src="<?php echo $base_url?>/admin/calendar/calendar-setup.js"></script>

<script type="text/javascript">
    var GB_ROOT_DIR = "greybox/";
</script>


<script type="text/javascript" src="<?php echo $base_url?>/admin/greybox/AJS.js"></script>
<script type="text/javascript" src="<?php echo $base_url?>/admin/greybox/AJS_fx.js"></script>
<script type="text/javascript" src="<?php echo $base_url?>/admin/greybox/gb_scripts.js"></script>
<script type="text/javascript" src="<?php echo $base_url?>/admin/scripts/jquery-1.3.2.min.js"></script>


<link href="<?php echo $base_url?>/admin/greybox/gb_styles.css" rel="stylesheet" type="text/css" />
<body>

<?php include("header.php"); ?>
<div class="xgrid">
<div style="min-height: 300px;" class="portlet x12">
	<div class="portlet-header"><h4>View Templates</h4></div>			
		<div class="portlet-content" >
<table width="800" frame="box" border="0" align="center">
<tr>
	<td colspan="3"><a href="admin_add_client_templates.php" class="btn btn-small" style="color:#fff">Add Template</a></td>
</tr>
<tr bgcolor="#D8D7E3">
	<td class="fieltable"><strong>Title</strong></td>
	<td class="fieltable"><strong>Status</strong></td>
	<td class="fieltable"><strong>Action</strong></td>
</tr>
<?php 
if($num_rows > 0){
while($row = mysql_fetch_assoc($result)){
	if($row['private'] == 1){
		$st = 0;
	}else {
		$st = 1;
	}
?>
	<tr >
		<td><?php echo $row['title'];?></td>
		<td><a href="?private=1&id=<?php echo $row['id'];?>&st=<?php echo $st;?>"><?php if($row['private'] == 0){echo '<font color="green">public</font>';}else {echo '<font color="red">private</font>';}?></td>
		<td><?php if(check('delete',3)){?><a href="?delete=1&id=<?php echo $row['id'];?>">Delete</a> |<?php }?> <a href="admin_edit_client_templates.php?id=<?php echo $row['id'];?>">Edit</a></td>
	</tr>
<?php
}	
}
?>
</table>
</div>
</div>
</div>
</body>
</html>