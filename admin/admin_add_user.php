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
	
	if ($_POST["username"])
	{
		$qry = "SELECT * FROM users WHERE username ='".$_POST["username"]."'";
		$users = mysql_query($qry) or die('Query failed: ' . mysql_error()); 
		$user = mysql_fetch_assoc($users);
		
		if ($user)
		{
			$msg = "<font color='red'>User name already chosen!</font><br>";
			$err = 1;
		}
	}
		
	if (!$_POST["username"])
	{
		$msg .= "<font color='red'>Please choose a user name!</font><br>";
		$err = 1;
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
	$_POST["password"] = md5($_POST["password"]);
	if (!$err)
	{
		unset($_POST["adduserinfo"]);
		add_record("users", $_POST);
        
		$msg = "<font color='green'>New User Added</font><br>";
		unset($_POST);
	}
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Add User</title>
<?php include("init_top.php");?>
<link href="includes/cms.css" rel="stylesheet" type="text/css" />

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
<div id="content" class="xfluid">
	<div style="min-height: 300px;" class="portlet x12">
		<div class="portlet-header"><h4>Add Customer</h4></div>
		<form action="admin_add_user.php" enctype="multipart/form-data" method="post" name="adduser">
			<input type="hidden" name="adduserinfo" value="1" />
			<table width="800" frame="box" border="0" align="center">
				<tbody>
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
						<td><input type="text" name="username" value="<?php echo $_POST["username"]; ?>"/></td>
					</tr>
					<tr>
						<td align="right"><strong>Password:</strong></td>
						<td><input type="password" name="password" value="<?php echo $_POST["password"]; ?>" /></td>
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
						<td>&nbsp;</td>
						<td><input type="submit" value="Add New User" /></td>
					</tr>
				</tbody>
			</table>
		</form>
	</div>
</div>
<hr />
</body>
</html>
