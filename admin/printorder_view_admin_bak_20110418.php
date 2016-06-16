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

if ($_REQUEST["norderid"])
{
	$data["status"] = $_REQUEST["status"];
	$where = "id = ".$_REQUEST["norderid"];
	modify_record("printorders", $data, $where);
}

if ($_REQUEST["delid"])
{
	
	delete_record_secondary("printorders", $_REQUEST["delid"], "id");
	delete_record_secondary("batches", $_REQUEST["delid"], "printorderid");
}

if ($_REQUEST["customerid"])
{
	$criteria = $_REQUEST["customerid"];
	$orderid = $_REQUEST["orderid"];
	
	if ($orderid)
	{
		$qry = "SELECT printorders.*, customers.id AS custid, customers.firstname AS firstname, customers.lastname AS lastname, customers.companyname AS companyname, customers.street, customers.street2, customers.city, customers.state, customers.zip AS zipcode, customers.email, customers.phone FROM printorders LEFT JOIN customers ON (customers.id = printorders.custid) WHERE printorders.custid=$criteria AND printorders.id = $orderid AND printorders.paid = 1 ORDER BY id DESC";
	} else {
		$qry = "SELECT printorders.*, customers.id AS custid, customers.firstname AS firstname, customers.lastname AS lastname, customers.companyname AS companyname, customers.street, customers.street2, customers.city, customers.state, customers.zip AS zipcode, customers.email, customers.phone FROM printorders LEFT JOIN customers ON (customers.id = printorders.custid) WHERE printorders.custid=$criteria AND printorders.paid = 1 ORDER BY id DESC";
	}
} else {
	$qry = "SELECT printorders.*, customers.id AS custid, customers.firstname AS firstname, customers.lastname AS lastname, customers.companyname AS companyname, customers.street, customers.street2, customers.city, customers.state, customers.zip AS zipcode, customers.email, customers.phone FROM printorders LEFT JOIN customers ON (customers.id = printorders.custid) WHERE printorders.paid = 1 ORDER BY id DESC";
}

//echo $qry."<BR>";
$printorders = mysql_query($qry) or die('Query failed: ' . mysql_error()); 
$printorder = mysql_fetch_assoc($printorders);
	

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>View Print Orders</title>
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
	window.location = "printorder_view_admin.php";
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
<?php include("header.php"); ?>
<form action="printorder_add_admin.php" enctype="multipart/form-data" method="post" name="addprintorder">
<input type="hidden" name="addprintorderinfo" value="1">
<table width="800" frame="box" border="0" align="center">
	<tr>
		<td colspan="4" align="right" valign="bottom"><h3>View Print Orders</h3></td>
	</tr>
	<tr>
		<td width="336">&nbsp;</td>
	</tr>
	<?php if ($_REQUEST["customerid"]) { ?>
	<tr>
		<td colspan="1"><a href="customer_view_admin.php?customerid=<?php echo $printorder["custid"]; ?>"><strong><?php echo $printorder["companyname"]."<br>".$printorder["firstname"]." ".$printorder["lastname"]; ?></strong></a><br /><?php echo $printorder["street"]; ?><?php if ($printorder["street2"]) { echo "<br>".$printorder["street2"]; } ?><br /><?php echo $printorder["city"].", ".$printorder["state"]." ".$printorder["zipcode"]; ?></td>
		<td colspan="2" align="right"><strong><?php echo $printorder["email"]."<br>".$printorder["phone"]; ?></strong></td>
	</tr>
	</tr>
	<?php do { ?>
	<tr bgcolor="#D8D7E3">
		<td><strong>Date</strong></td>
		<td width="116"><strong>Print Order Number</strong></td>
		<td width="153"><strong>Operations</strong></td>
	</tr>
	<tr bgcolor="<?php echo $bgcolor; ?>">
		<td><a href="printorder_view_admin.php?customerid=<?php echo $printorder["custid"]; ?>&orderid=<?php echo $printorder["id"]; ?>"><?php echo $printorder["timestamp"]; ?></a></td>
		<td align="center"><font color="#FF0000"><strong><?php echo $printorder["id"]; ?></strong></font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="export_txt_file.php?orderid=<?php echo $printorder["id"]; ?>" title="Export TXT File" rel="gb_page_center[600, 200]">export order to txt file</a></td>
		<td><a href="printorder_view_admin.php?delid=<?php echo $printorder["id"]; ?>" onClick="javascript:return confirm('Are you sure you want to delete this print order?')">delete</a> | <?php if ($printorder["status"]) { ?><a href="printorder_view_admin.php?status=0&customerid=<?php echo $printorder["custid"]; ?>&norderid=<?php echo $printorder["id"]; ?>" style="color:green;">complete</a><?php } else { ?><a href="printorder_view_admin.php?status=1&customerid=<?php echo $printorder["custid"]; ?>&norderid=<?php echo $printorder["id"]; ?>" style="color:red;">incomplete</a><?php } ?> | <a href="p-receipt.php?rid=<?php echo $printorder["id"]; ?>" target="_blank">receipt</a></td>
	</tr>
	<tr bgcolor="<?php echo $bgcolor; ?>">
		<td colspan="3">
		<?php 
	if ($printorder) {
	$qry = "SELECT batches. * , batches.name as bname, batches.subtext as bsubtext, batches.subtext2 as bsubtext2, custstyle. * , custstyle.id AS custid, styles. * , styles.name AS sname, colors. * , colors.name AS cname
FROM batches
LEFT JOIN custstyle ON ( custstyle.id = batches.custstyleid ) 
LEFT JOIN styles ON ( styles.id = custstyle.styleid ) 
LEFT JOIN colors ON ( colors.id = custstyle.color ) 
WHERE batches.printorderid = ".$printorder["id"];
		//echo $qry."<BR>";
		$badges = mysql_query($qry) or die('Query failed: ' . mysql_error()); 
		$badge = mysql_fetch_assoc($badges);
		?>
			<table width="100%">
				<?php if ($badge) { ?>
				<tr>
					<td><strong>Customer Style Name</strong></td>
					<td><strong>Name</strong></td>
					<td><strong>subtext</strong></td>
					<td><strong>subtext 2</strong></td>
					<td><strong>Fastener</strong></td>
					<td><strong>Frame</strong></td>
				</tr>
				<?php do { ?>
				<tr>
					<td><a href="custstyle_viewentry_admin.php?styleid=<?php echo $badge["custid"]; ?>" title="Edit Customer" rel="gb_page_center[850, 600]"><?php echo $badge["stylename"]; ?></a></td>
					<td><?php echo $badge["bname"]; ?></td>
					<td><?php echo $badge["bsubtext"]; ?></td>
					<td><?php echo $badge["bsubtext2"]; ?></td>
					<td><?php echo $badge["fastener"]; ?></td>
					<td><?php echo $badge["frame"]; ?></td>
				</tr>
				<?php } while ($badge = mysql_fetch_assoc($badges)); ?>
				<tr>
					<td>&nbsp;</td>
					<td colspan="6"><strong><?php echo $badge["notes"]; ?></strong></td>
				</tr>
				<?php } else { ?>
				<tr>
					<td><h3>No badges on this order?</td>
				</tr>
				<?php } ?>
			</table>
		<?php } else {?>
		<h3>No Print Orders</h3>
		<?php } ?>
		</td>
	</tr>
	<?php } while ($printorder = mysql_fetch_assoc($printorders)); ?>
	<tr>
		<td colspan="3"><hr></td>
	</tr>
	<?php } else { ?>
	<tr bgcolor="#D8D7E3">
		<td><strong>Customer</strong></td>
		<td><strong>Date</strong></td>
		<td><strong>Print Order Number</strong></td>
		<td width="177"><strong>Operations</strong></td>
	</tr>
	<?php 
	$bgcolor = "WHITE";
	do { ?>
	<tr bgcolor="<?php echo $bgcolor; ?>">
		<td><a href="customer_view_admin.php?customerid=<?php echo $printorder["custid"]; ?>"><?php echo $printorder["companyname"]." - ".$printorder["firstname"]." ".$printorder["lastname"]; ?></a></td>
		<td><a href="printorder_view_admin.php?customerid=<?php echo $printorder["custid"]; ?>&orderid=<?php echo $printorder["id"]; ?>"><?php echo $printorder["timestamp"]; ?></a></td>
		<td align="center"><font color="#FF0000"><strong><?php echo $printorder["id"]; ?></strong></font></td>
		<td><a href="printorder_view_admin.php?delid=<?php echo $printorder["id"]; ?>" onClick="javascript:return confirm('Are you sure you want to delete this print order?')">[X]</a> | <?php if ($printorder["status"]) { ?><a href="printorder_view_admin.php?status=0&norderid=<?php echo $printorder["id"]; ?>" style="color:green;">complete</a><?php } else { ?><a href="printorder_view_admin.php?status=1&norderid=<?php echo $printorder["id"]; ?>" style="color:red;">incomplete</a><?php } ?> | <a href="p-receipt.php?rid=<?php echo $printorder["id"]; ?>" target="_blank">receipt</a></td>
	</tr>
	<?php 
	if ($bgcolor == "WHITE")
	{
		$bgcolor = "#D8D8D8";
	} else {
		$bgcolor = "WHITE";
	}
	} while ($printorder = mysql_fetch_assoc($printorders)); ?>
<?php } ?>
</table>
</form>

</body>
</html>
