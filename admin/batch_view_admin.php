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

if ($_REQUEST["delid"])
{
	delete_record("batches", $_REQUEST["delid"]);

}

if ($_REQUEST["customerid"])
{
	$criteria = $_REQUEST["customerid"];
	if ($_REQUEST["batchstatus"] = "pending")
	{
			$qry = "SELECT batches.*, customers.firstname AS firstname, customers.lastname AS lastname, customers.companyname AS company, custstyle.id as custstyleid, custstyle.stylename AS custstylename FROM batches LEFT JOIN customers ON (customers.id = batches.custid) LEFT JOIN custstyle ON (custstyle.id=custstyleid) WHERE batches.custid=$criteria AND printorderid='0' ORDER BY 'name'";	
	} else {
			$qry = "SELECT batches.*, customers.firstname AS firstname, customers.lastname AS lastname, customers.companyname AS company custstyle.id as custstyleid, custstyle.stylename AS custstylename FROM batches LEFT JOIN customers ON (customers.id = batches.custid) WHERE batches.custid=$criteria ORDER BY 'name'";
	}
} else {
	$qry = "SELECT batches.*, customers.firstname AS firstname, customers.lastname AS lastname, customers.companyname AS company custstyle.id as custstyleid, custstyle.stylename AS custstylename FROM batches LEFT JOIN customers ON (customers.id = batches.custid) ORDER BY printorderid";
}

$batchs = mysql_query($qry) or die('Query failed: ' . mysql_error()); 
$batch = mysql_fetch_assoc($batchs);
	

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>View Customers</title>
<?php include("init_top.php");?>
<link href="<?php echo $base_url;?>/admin/includes/cms.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css"  href="<?php echo $base_url;?>/admin/calendar/calendar-win2k-1.css" />


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
	window.location = "batch_view_admin.php";
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
		<div class="portlet-header"><h4>View Batch</h4></div>			
			<div class="portlet-content" >
			
<form action="batch_add_admin.php" enctype="multipart/form-data" method="post" name="addbatch">
<input type="hidden" name="addbatchinfo" value="1">
<?php /*
<table border="0" cellpadding="0" cellspacing="0" width="96%">

	<tr>
		<td colspan="3"><img src="images/generic_logo.gif"/></td>
	  <td width="458" align="right" valign="bottom"><h3>View Batches</h3></td>
	</tr>

	<tr>
		<td colspan="4"><hr /></td>
	</tr>
</table>
*/?>
<table width="96%" frame="box" border="0">
	<tr bgcolor="#D8D7E3">
		<td class="fieltable"><strong>Customer</strong></td>
		<td class="fieltable"><strong>Name</strong></td>
        <td class="fieltable"><strong>SubText</strong></td>
		<td class="fieltable"><strong>Processed?</strong></td>
		<td class="fieltable"><strong>Fastener</strong></td>
		<td class="fieltable" ><strong>Style</strong></td>
		<td class="fieltable"><strong>Operations</strong></td>
	</tr>
	<?php 
	$bgcolor = "WHITE";
	if ($batch) {
	do { ?>
	<tr bgcolor="<?php echo $bgcolor; ?>">
		<td><?php echo $batch["company"]." - ".$batch["firstname"]." ".$batch["lastname"]; ?></td>
		<td><?php echo $batch["name"]; ?></td>
        <td><?php echo $batch["subtext"]; ?></td>
		<td><?php if ($batch["printorderid"]) {echo "Yes";} else {echo "No";} ?></td>
		<td><?php echo $batch["fastener"]; ?></td>
		<td><a href="custstyle_viewentry_admin.php?styleid=<?php echo $batch["custstyleid"];?>"><?php echo $batch["custstylename"]; ?></a></td>
		<a href="batch_view_admin.php?delid=<?php echo $batch["id"]; ?>" onClick="javascript:return confirm('Are you sure you want to delete this batch?')">delete</a></td>
	</tr>
	<?php 
	if ($bgcolor == "WHITE")
	{
		$bgcolor = "#D8D8D8";
	} else {
		$bgcolor = "WHITE";
	}
	} while ($batch = mysql_fetch_assoc($batchs)); 
	} else {echo "<tr><td><h3>No records to display</h3></td></tr>";}?>
</table>
</form>
</div></div></div>
</body>
</html>
