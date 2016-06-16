<?php 
require_once('conn/DB.php');
include('conn/tablefuncs.php');
mysql_select_db($database_DB, $ravcodb);
session_start();
if (!$_SESSION["loginid"])
{?>
<script language="javascript">
parent.parent.location.href='admin.php';
window.close();
</script>
<?php }


if ($_REQUEST["paid"])
{
	if ($_REQUEST["paid"] == 1 )
	{
		$data["paid"] = 0;
	} else {
		$data["paid"] = 1;
	}
	$where = "id = ".$_REQUEST["rid"];
	modify_record("custstyle", $data, $where);
}	

if ($_REQUEST["deleteid"])
{
	delete_record_secondary("custstyle", $_REQUEST["deleteid"], "id");
}

if ($_REQUEST["customerid"])
{
	$customerid=$_REQUEST["customerid"];
	$qry = "SELECT custstyle.*, styles.name as sname, styles.size as ssize, colors.name as colorname FROM custstyle LEFT JOIN styles ON (styles.id = custstyle.styleid) LEFT JOIN colors ON (colors.id = custstyle.color) WHERE custstyle.custid=$customerid ORDER BY custstyle.id";
} else if ($_REQUEST["id"]) {
	$qry = "SELECT custstyle.*, styles.name as sname, styles.size as ssize colors.name as colorname FROM custstyle LEFT JOIN styles ON (styles.id = custstyle.styleid) LEFT JOIN colors ON (colors.id = custstyle.color) WHERE custstyle.id=".$_REQUEST["id"];
} else {
	$qry = "SELECT custstyle.*, styles.name as sname, styles.size as ssize, colors.name as colorname FROM custstyle LEFT JOIN styles ON (styles.id = custstyle.styleid) LEFT JOIN colors ON (colors.id = custstyle.color) ORDER BY custstyle.id";
} 
$styles = mysql_query($qry) or die('Query failed: ' . mysql_error()); 
$style = mysql_fetch_assoc($styles);
	

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>View Customers</title>
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
<br />
<div class="xfluid" style="width: 100%;margin-left: 2.50;">
<div style="min-height: 300px;" class="portlet x12">
	<div class="portlet-header"><h4>View Customer Styles</h4></div>			
		<div class="portlet-content" >
<form action="customer_add_admin.php" enctype="multipart/form-data" method="post" name="addcust">
<input type="hidden" name="addcustinfo" value="1">
<?php /*
<table border="0" cellpadding="0" cellspacing="0" width="96%">
	<tr>
		<td colspan="3"><img src="images/generic_logo.gif"/></td>
	  <td width="458" align="right" valign="bottom"><h3>View Customer Styles</h3></td>
	</tr>
	<tr>
		<td colspan="4"><hr /></td>
	</tr>
</table>
*/?>
<?php if ($_REQUEST["customerid"])
{ ?>
<a href="admin_add_cust_style.php?id=<?php echo $customerid; ?>" title="Add Customer Style" rel="gb_page_center[950, 700]">add new style</a><Br /><Br />
<?php } ?>
<table width="96%" frame="box" border="0">
	<tr bgcolor="#D8D7E3">
		<td class="fieltable" width="10%"><strong>Style Name</strong></td>
		<td class="fieltable" width="10%"><strong>Style Type</strong></td>
   		<td class="fieltable" width="12%"><strong>Color</strong></td>
   		<td class="fieltable" width="7%"><strong>Logo 1</strong></td>
   		<td class="fieltable" width="7%"><strong>Logo 2</strong></td>
        <td class="fieltable" width="7%"><strong>Logo 3</strong></td>
		<td class="fieltable" width="6%"><strong>Notes</strong></td>
		<td class="fieltable" width="6%"><strong>Proof</strong></td>
		<td class="fieltable" width="15%"><strong>Remove White Box?</strong></td>
		<td class="fieltable" width="6%"><strong>Tweak?</strong></td>
        <td class="fieltable" width="20%"><strong>Operations</strong></td>
  	</tr>
	<?php 
	$bgcolor = "WHITE";
	if ($style) {
	do { ?>
	<tr bgcolor="<?php echo $bgcolor; ?>">
		<td><?php echo $style["stylename"]; ?></td>
		<td><?php echo $style["sname"]; ?> - <?php echo $style["ssize"]; ?></td>
		<td><?php echo $style["colorname"]; ?></td>
		<td><a href="../logos/<?php echo $style["logo1"]; ?>" target="_blank"><?php echo $style["logo1"]; ?></a></td>
		<td><a href="../logos/<?php echo $style["logo2"]; ?>" target="_blank"><?php echo $style["logo2"]; ?></a></td>
		<td><a href="../logos/<?php echo $style["logo3"]; ?>" target="_blank"><?php echo $style["logo3"]; ?></a></td>
		<td><?php echo $style["notes"]; ?></td>
		<td><a href="../proofs/<?php echo $style["proof"]; ?>" target="_blank"><?php echo $style["proof"]; ?></a></td>
		<td><?php if ($style["whitebox"]) { echo "Yes"; } else { echo "No"; } ?></td>
		<td><?php if ($style["tweak"]) { echo "Yes"; } else { echo "No"; } ?></td>
		<td><a href="admin_upload_proof.php?id=<?php echo $style["id"]; ?>&customerid=<?php echo $_REQUEST["customerid"]; ?>"  title="Upload Proof" rel="gb_page_center[400, 150]">upload proof</a> | <a href="admin_custstyle_view.php?deleteid=<?php echo $style["id"]; ?>&customerid=<?php echo $_REQUEST["customerid"]; ?>">delete</a> | <?php if ($style["paid"]) { ?><a href="admin_custstyle_view.php?paid=1&rid=<?php echo $style["id"]; ?>&customerid=<?php echo $_REQUEST["customerid"]; ?>"><font color='green'>PAID</font></a><?php } else { ?><a href="admin_custstyle_view.php?paid=2&rid=<?php echo $style["id"]; ?>&customerid=<?php echo $_REQUEST["customerid"]; ?>"><font color='red'>UNPAID</font></a><?php } ?></td>
	</tr>
	<?php 
	if ($bgcolor == "WHITE")
	{
		$bgcolor = "#D8D8D8";
	} else {
		$bgcolor = "WHITE";
	}
	} while ($style = mysql_fetch_assoc($styles)); 
	} else { ?>
	<tr>
		<td colspan="9"><h2>No Styles Yet</h2></td>
	</tr>
	
	<?php } ?>
</table>
</form>
</div></div></div>
</body>
</html>
