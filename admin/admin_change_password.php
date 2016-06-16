<?php 
require_once('conn/DB.php');
include('conn/tablefuncs.php');
mysql_select_db($database_DB, $ravcodb);
session_start();
if (!$_SESSION["loginid"] || $_SESSION["userlevel"] < 2)
{?>
<script language="javascript">
parent.parent.location.href='admin.php';
window.close();
</script>
<?php }

if ($_POST)
{

	if (!$_POST["password"] && !$_POST["password2"])
	{
		$err = 1;
		$passerr = "<font color='red'>Please Enter a Password!</font>";
	} else {
		if ($_POST["password"] == $_POST["password2"])
		{
			$data["password"] = md5($_POST["password"]);
		} else {
			$err = 1;
			$passerr = "<font color='red'>Passwords Don't Match</font>";
		}
	}
	if (!$err)
	{
		$where = "id = ".$_REQUEST["id"];
		modify_record("users", $data, $where);
		?>
		<script language="javascript">
			parent.parent.location.href='admin_edit_user.php?userid=<?php echo $_REQUEST["id"]; ?>';
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
<title>Untitled Document</title>
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

<form action="admin_change_password.php?id=<?php echo $_REQUEST["id"]; ?>" enctype="multipart/form-data" method="post" name="adduser">
<table border="0" cellpadding="0" cellspacing="0" width="96%">
	<tr>
		<td colspan="2">&nbsp;</td>
	</tr>
	<?php if ($passerr) { ?>
	<tr>
		<td colspan="2"><?php echo $passerr; ?></td>
	</tr>
	<?php } ?>
	<tr>
		<td><strong>Password: </strong></td>
	  	<td><input type="password" name="password" /></td>
	</tr>
	<tr>
		<td><strong>Password (again): </strong></td>
	  	<td><input type="password" name="password2" />&nbsp;&nbsp;<input type="submit" value="Change Password" /></td>
	</tr>
</table>

</form>

</body>
</html>
