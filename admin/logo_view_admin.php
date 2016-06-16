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

if ($_REQUEST["delid"])
{
	delete_record("logos", $_REQUEST["delid"]);
}
if ($_REQUEST["customerid"])
{
	$criteria = $_REQUEST["customerid"];
	$qry = "SELECT logos.* FROM logos WHERE custid=$criteria ORDER BY 'name'";
} else {
	$qry = "SELECT logos.* FROM logos ORDER BY 'name'";
}

//* $qry = "SELECT logos.* FROM logos WHERE custid=$_REQUEST["customerid"] ORDER BY 'name'";
$logos = mysql_query($qry) or die('Query failed: ' . mysql_error()); 
$logo = mysql_fetch_assoc($logos);
	

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>View Logos</title>
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
	window.location = "logo_view_admin.php";
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

<form action="logo_add_admin.php" enctype="multipart/form-data" method="post" name="addlogo">
<input type="hidden" name="addlogoinfo" value="1">
<table border="0" cellpadding="0" cellspacing="0" width="96%">
	<tr>
		<td colspan="3"><img src="images/generic_logo.gif"/></td>
	  <td width="458" align="right" valign="bottom"><h3>View Logos</h3></td>
	</tr>
	<tr>
		<td colspan="4"><hr /></td>
	</tr>
</table>
<table width="96%" frame="box" border="0">
	<tr bgcolor="#D8D7E3">
		<td><strong>Customer ID</strong></td>
		<td><strong>Logo Name</strong></td>
		<td><strong>Image Link</strong></td>
	</tr>
	<?php 
	$bgcolor = "WHITE";
	do { ?>
	<tr bgcolor="<?php echo $bgcolor; ?>">
		<td><?php echo $logo["custid"]; ?></td>
		<td><?php echo $logo["name"]; ?></td>
		<td><?php echo $logo["imglink"]; ?></td>
		<td><a href="logo_edit_admin.php?logoid=<?php echo $logo["id"]; ?>" title="Edit Logo" rel="gb_page_center[550, 500]">edit</a>&nbsp;&nbsp; <a href="logo_view_admin.php?delid=<?php echo $logo["id"]; ?>" onClick="javascript:return confirm('Are you sure you want to delete this logo?')">delete</a></td>
	</tr>
	<?php 
	if ($bgcolor == "WHITE")
	{
		$bgcolor = "#D8D8D8";
	} else {
		$bgcolor = "WHITE";
	}
	} while ($logo = mysql_fetch_assoc($logos)); ?>
</table>
</form>

</body>
</html>
