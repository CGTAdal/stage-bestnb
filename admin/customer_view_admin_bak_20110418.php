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
		delete_record_secondary("orders", $_REQUEST["delid"], "customerid");	
	delete_record_secondary("batches", $_REQUEST["delid"], "custid");
	delete_record_secondary("printorders", $_REQUEST["delid"], "custid");
	delete_record_secondary("custstyle", $_REQUEST["delid"], "custid");
	delete_record("customers",$_REQUEST["delid"]);
}

if ($_REQUEST["customerid"])
{
	$customerid=$_REQUEST["customerid"];
	$qry = "SELECT customers.* FROM customers WHERE id=$customerid ORDER BY lastname";
} else {
	$qry = "SELECT customers.* FROM customers ORDER BY lastname";
} 

$customers = mysql_query($qry) or die('Query failed: ' . mysql_error()); 
$customer = mysql_fetch_assoc($customers);
	

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>View Customers</title>
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
	window.location = "customer_view_admin.php";
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
<form action="customer_add_admin.php" enctype="multipart/form-data" method="post" name="addcust">
<input type="hidden" name="addcustinfo" value="1">
<table width="800" frame="box" border="0" align="center">
	<tr>
		<td colspan="4"><a href="customer_add_admin.php">Add Customer</a></td>
		<td colspan="3" align="right" valign="bottom"><h3>View Customers</h3></td>
	</tr>
	<tr bgcolor="#D8D7E3">
		<td width="7%"><strong>Name</strong></td>
		<td width="7%"><strong>Email</strong></td>
   		<td width="12%"><strong>Inventory</strong></td>
		<td width="12%"><strong>FInventory</strong></td>
   		<td width="7%"><strong>City</strong></td>
   		<td width="6%"><strong>State</strong></td>
        <td width="6%"><strong>Phone</strong></td>
  	</tr>
	<?php 
	$bgcolor = "WHITE";
	do { ?>
	<tr bgcolor="<?php echo $bgcolor; ?>">
		<td><?php echo $customer["firstname"]." ".$customer["lastname"]; ?></td>
		<td><?php echo $customer["email"]; ?></td>
		<td><?php echo $customer["inventory"]; ?></td>
		<td><?php echo $customer["finventory"]; ?></td>
		<td><?php echo $customer["city"]; ?></td>
		<td><?php echo $customer["state"]; ?></td>
		<td><?php echo $customer["phone"]; ?></td>
	</tr>
	<tr bgcolor="<?php echo $bgcolor; ?>">
		<td colspan="7" align="right">
        	<a href="customer_edit_admin.php?customerid=<?php echo $customer["id"]; ?>" title="Edit Customer" rel="gb_page_center[850, 600]">edit</a> | <a href="customer_view_admin.php?delid=<?php echo $customer["id"]; ?>" onClick="javascript:return confirm('Are you sure you want to delete this customer?')">delete</a> | <a href="admin_custstyle_view.php?customerid=<?php echo $customer["id"]; ?>" title="View Styles" rel="gb_page_center[1100, 800]">styles</a> | <a href="order_view_admin.php?customerid=<?php echo $customer["id"]; ?>" title="View Orders">orders</a> | <a href="printorder_view_admin.php?customerid=<?php echo $customer["id"]; ?>" title="View Print Orders">print orders</a> | <a href="batch_view_admin.php?customerid=<?php echo $customer["id"]; ?>&batchstatus=pending" title="View Batches - Pending" rel="gb_page_center[600, 500]">pending</a> | <a href="admin_change_customer_password.php?id=<?php echo $customer["id"]; ?>" title="Change Password" rel="gb_page_center[300, 110]">change password</a>
       	</td>
	</tr>
	<?php 
	if ($bgcolor == "WHITE")
	{
		$bgcolor = "#D8D8D8";
	} else {
		$bgcolor = "WHITE";
	}
	} while ($customer = mysql_fetch_assoc($customers)); ?>
</table>
</form>

</body>
</html>
