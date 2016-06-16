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
if($_REQUEST['edit'] ==1){
	$url  = 'customer_edit_admin.php?customerid';
}else {
	$url = 'customer_view_admin.php?userid';
}
if ($_POST)
{

	if (!$_POST["password"] && !$_POST["password2"])
	{
		$err = 1;
		$passerr = "<font color='red'>Please Enter a Password!</font>";
	} else {
		if ($_POST["password"] == $_POST["password2"])
		{
			$data["password"] = $_POST["password"];
		} else {
			$err = 1;
			$passerr = "<font color='red'>Passwords Don't Match</font>";
		}
	}
	if (!$err)
	{
		$where = "id = ".$_REQUEST["id"];
		modify_record("customers", $data, $where);
		
		?>
		<script language="javascript">
			parent.parent.location.href='<?php echo $_POST['url'];?>=<?php echo $_REQUEST["id"]; ?>';
			//window.close();
		</script>
	<?php
	}
}
	

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Change Password</title>
<?php include("init_top.php");?>
<link href="<?php echo $base_url;?>/admin/includes/cms.css" rel="stylesheet" type="text/css" />
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

.resize
{
	width:150px;
	height:auto;
}
</style>

</head>

<body>
<br>
<div class="xfluid" style="width: 95%;margin-left: 2.50%;">
		<div style="min-height: 300px;" class="portlet x12">
		<div class="portlet-header"><h4>Change Password</h4></div>			
			<div class="portlet-content" >
			
<form action="admin_change_customer_password.php?id=<?php echo $_REQUEST["id"]; ?>" enctype="multipart/form-data" method="post" name="adduser">
<input type="hidden" value="<?php echo $url?>" name="url" />
<table border="0" cellpadding="0" cellspacing="0" width="96%">	
	<?php if ($passerr) { ?>
	<tr>
		<td colspan="2"><?php echo $passerr; ?></td>
	</tr>
	<?php } ?>
	<tr>
		<td align="right"><strong>Password: </strong></td>
	  	<td><input type="password" name="password" /></td>
	</tr>
	<tr>
		<td align="right"><strong>Password (again): </strong></td>
	  	<td><input type="password" name="password2" /></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	  	<td><input style="font-size:13px;" class="btn btn-small" type="submit" value="Change Password" /></td>
	</tr>
</table>
</form>
</div></div></div>
</body>
</html>
