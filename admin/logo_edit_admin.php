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

if ($_POST["addlogoinfo"]) 
{
	
	if (!$err)
	{
		unset($_POST["addlogoinfo"]);
		$where = "id = ".$_POST["logoid"];
		unset($_POST["logoid"]);
		modify_record("logos", $_POST, $where);
		$msg = "<font color='green'>Logo Updated</font><br>";
		unset($_POST);?>
		<script language="javascript">
		parent.parent.location.href = "logo_view_admin.php";
		window.close();
		</script>
	<?php }
}

if ($_REQUEST["logoid"])
{
	$logoid = $_REQUEST["logoid"];
}
if ($_POST["logoid"])
{
	$logoid = $POST["logoid"];
}


$qry = "SELECT logos.* FROM logos WHERE id = ".$_REQUEST["logoid"]." ORDER BY name";
$logos = mysql_query($qry) or die('Query failed: ' . mysql_error()); 
$logo = mysql_fetch_assoc($logos);

$_POST = $logo;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Edit Orders</title>
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

<form action="logo_edit_admin.php" enctype="multipart/form-data" method="post" name="addlogo">
<input type="hidden" name="addlogoinfo" value="1">
<input type="hidden" name="logoid" value="<?php echo $logoid; ?>">
<table width="100%" frame="box" border="0">
	<tr>
		<td ><img src="images/generic_logo.gif" /></td>
	  	<td width="458" align="right" valign="bottom"><h3>Edit Logo</h3></td>
	</tr>
	<tr>
		<td colspan="2"><hr /></td>
	</tr>
</table>
<table width="100%" frame="box" border="0">
	<?php if ($msg) { ?>
	<tr>
		<td>&nbsp;</td>
		<td><font size="1"><?php echo $msg; ?></font></td>
	</tr>
	<?php } ?>
	<tr>
		<td align="right"><strong>LogoID:</strong></td>
		<td><?php echo $logoid; ?></td>
	</tr>
	<tr>
		<td align="right"><strong>CustomerID:</strong></td>
		<td><input type="text" name="custid" value="<?php echo $_POST["custid"]; ?>" /></td>
	</tr>
	<tr>
		<td align="right"><strong>Logo Name:</strong></td>
		<td><input type="text" name="name" value="<?php echo $_POST["name"]; ?>" /></td>
	</tr>
	<tr>
		<td align="right"><strong>Image Link:</strong></td>
		<td><input type="text" name="imglink" value="<?php echo $_POST["imglink"]; ?>" /></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td><input type="submit" value="Modify Logo" /></td>
	</tr>
</table>
</form>
<hr />
</body>
</html>
