<?php 
require_once('conn/DB.php');
include('conn/tablefuncs.php');
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
?>
<?php if(check('view',2)){?>
<script language="javascript">
parent.parent.location.href='admin.php';
window.close();
</script>
<?php }?>

<?php
if ($_REQUEST["delid"])
{
	if(check('delete',3)){
		delete_record_secondary("users", $_REQUEST["delid"], "id");
	}else {
		die('You don\'t have permision to perform this action.');
	}	
}


$qry = "SELECT users.* FROM users ORDER BY userlevel";
$users = mysql_query($qry) or die('Query failed: ' . mysql_error()); 
$user = mysql_fetch_assoc($users);
	

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>View Users</title>
<?php include("init_top.php");?>
<link href="includes/cms.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" media="all" href="../calendar/calendar-win2k-1.css" title="win2k-1" />


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
		window.location = "admin_view_user.php";
	}
</script>

<style>
	.resize {width:150px;height:auto;}
</style>
</head>

<body>
<?php include("header.php"); ?>

<div class="xgrid" >
	<div class="portlet x12">
		<div class="portlet-header"><h4>View Users</h4></div>			
		<div class="portlet-content" >
			<div style="float:left">
				<a href="admin_add_user.php" style="color:#fff" class="btn btn-small">Add Customer</a>
			</div>
			<div style="clear: both;padding-bottom:20px;"></div>
			<form action="admin_add_user.php" enctype="multipart/form-data" method="post" name="adduser">
				<input type="hidden" name="adduserinfo" value="1" />
				<table width="800px" frame="box" border="0" align="center">
				<tr bgcolor="#D8D7E3">
					<td width="" class="fieltable">User Name</td>
					<td width="" class="fieltable"><strong>Password</strong></td>
			   		<td width="" class="fieltable"><strong>Name</strong></td>
					<td width="" class="fieltable"><strong>Email</strong></td>
					<td width="" class="fieltable"><strong>Level</strong></td>
			   		<td width="" class="fieltable"><strong>Action</strong></td>
			  	</tr>
			  	<?php 
				$bgcolor = "WHITE";
				do { ?>
					<tr bgcolor="<?php echo $bgcolor; ?>">
						<td><?php echo $user["username"]; ?></td>
						<td>********</td>
						<td><?php echo $user["name"]; ?></td>
						<td><?php echo $user["email"]; ?></td>
						<td><?php echo $user["userlevel"]; ?></td>
						<td><a href="admin_edit_user.php?userid=<?php echo $user["id"]; ?>" title="Edit User" rel="gb_page_center[550, 500]">edit</a>&nbsp;&nbsp;<?php if(check('delete',3)){?> <a href="admin_view_user.php?delid=<?php echo $user["id"]; ?>" onclick="javascript:return confirm('Are you sure you want to delete this user?')">delete</a><?php }?></td>
					</tr>
				<?php
					if ($bgcolor == "WHITE") {
						$bgcolor = "#D8D8D8";
					} else {
						$bgcolor = "WHITE";
					}
				} while ($user = mysql_fetch_assoc($users)); ?>
				</table>
			</form>
		</div>
	</div>
</div>
</body>
</html>
