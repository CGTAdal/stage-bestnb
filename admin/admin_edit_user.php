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
if ($_POST["adduserinfo"]) 
{
	
	
	if ($_POST["userlevel"])
	{
		if ($_POST["userlevel"] == 1 && !$_POST["m_id"])
		{
			$msg .= "<font color='red'>Level 1 users require a division!</font><br>";
			$err = 1;
		}
	}
	
	
	if (!$_POST["password"])
	{
		$msg .= "<font color='red'>Please enter a password!</font><br>";
		$err = 1;
	}
	if (!$_POST["name"])
	{
		$msg .= "<font color='red'>Please enter full name!</font><br>";
		$err = 1;
	}
	if (!$_POST["email"])
	{
		$msg .= "<font color='red'>Please enter an email!</font><br>";
		$err = 1;
	}
	if (!$_POST["userlevel"])
	{
		$msg .= "<font color='red'>Please choose a user level!</font><br>";
		$err = 1;
	}
	
	if (!$err)
	{
		unset($_POST["adduserinfo"]);
		$where = "id = ".$_POST["userid"];
		unset($_POST["userid"]);
		modify_record("users", $_POST, $where);
		$msg = "<font color='green'>User Updated</font><br>";
		unset($_POST);?>
		<script language="javascript">
		parent.parent.location.href = "admin_view_user.php";
		window.close();
		</script>
	<?php }
}

if ($_REQUEST["userid"])
{
	$userid = $_REQUEST["userid"];
}
if ($_POST["userid"])
{
	$userid = $POST["userid"];
}


$qry = "SELECT users.* FROM users WHERE id = ".$_REQUEST["userid"]." ORDER BY userlevel";
$users = mysql_query($qry) or die('Query failed: ' . mysql_error()); 
$user = mysql_fetch_assoc($users);

$_POST = $user;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Edit User</title>
<?php include("init_top.php");?>
<link href="includes/cms.css" rel="stylesheet" type="text/css" />
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
<div id="content" class="xfluid">
	<div style="min-height: 300px;" class="portlet x12">
		<form action="admin_edit_user.php" enctype="multipart/form-data" method="post" name="adduser">
			<input type="hidden" name="adduserinfo" value="1" />
			<input type="hidden" name="userid" value="<?php echo $userid; ?>" />
			<table width="100%" frame="box" border="0">
				<?php if ($msg) { ?>
					<tr>
						<td>&nbsp;</td>
						<td><font size="1"><?php echo $msg; ?></font></td>
					</tr>
				<?php } else {?>
					<tr>
						<td colspan="2">&nbsp;</td>
					</tr>
				<?php }?>
				<tr>
					<td align="right"><strong>User Name:</strong></td>
					<td><input type="text" name="username" value="<?php echo $_POST["username"]; ?>" disabled="disabled"/></td>
				</tr>
				<tr>
					<td align="right"><strong>Password:</strong></td>
					<td>***********&nbsp;&nbsp;&nbsp;<a href="admin_change_password.php?id=<?php echo $_POST["id"]; ?>" title="Change Password" rel="gb_page_center[300, 150]">change password</a></td>
				</tr>
				<tr>
					<td align="right"><strong>Full Name:</strong></td>
					<td><input type="text" name="name" value="<?php echo $_POST["name"]; ?>" /></td>
				</tr>
				<tr>
					<td align="right"><strong>Email:</strong></td>
					<td><input type="text" name="email" value="<?php echo $_POST["email"]; ?>" /></td>
				</tr>
				<tr>
					<td align="right"><strong>Level:</strong></td>
					<td>
					<select name="userlevel">
						<option value="0">Select One...</option>
						<option value="1" <?php if ($_POST["userlevel"] == 1) echo 'selected';?>>Level 1 - Sales</option>
						<option value="2" <?php if ($_POST["userlevel"] == 2) echo 'selected';?>>Level 2 - Super Admin</option>
			            <option value="3" <?php if ($_POST["userlevel"] == 3) echo 'selected';?>>Level 3 - Root Admin</option>
					</select>
					</td>
				</tr>
				<tr>
					<td colspan="2">&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><input type="submit" value="Add New User" /></td>
				</tr>
			</table>
		</form>
	</div>
</div>
</body>
</html>
