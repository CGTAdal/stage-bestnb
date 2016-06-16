<?php 


require_once('conn/DB.php');
include('conn/tablefuncs.php');
include('../include/config.php');
mysql_select_db($database_DB, $ravcodb);
session_start();
include('permision.php');
//if (!$_SESSION["loginid"] || $_SESSION["userlevel"] < 2)

if (!$_SESSION["loginid"])
{?>
<script language="javascript">
parent.parent.location.href='admin.php';
window.close();
</script>
<?php }


if ($_REQUEST["orderid"])
{
	$data["status"] = $_REQUEST["status"];
	$where = "id = ".$_REQUEST["orderid"];
	modify_record("orders", $data, $where);
}
//var_dump(check('delete',3));
if ($_REQUEST["delid"])
{
	if(!check('delete',3)){
		die('you haven\'t permision to perform this action.');
	}else{
		delete_record_secondary("orders", $_REQUEST["delid"], "id");
	}
}

if ($_REQUEST["customerid"])
{
	$criteria = $_REQUEST["customerid"];
	$qry = "SELECT orders.*, customers.firstname, customers.lastname, custstyle.stylename, custstyle.id AS custstyleid FROM orders LEFT JOIN customers ON (customers.id = orders.customerid) LEFT JOIN custstyle ON (custstyle.id = orders.styleid) WHERE customerid=$criteria ORDER BY orders.id DESC";
} else {
	$qry = "SELECT orders.*, customers.firstname, customers.lastname, custstyle.stylename, custstyle.id AS custstyleid FROM orders LEFT JOIN customers ON (customers.id = orders.customerid) LEFT JOIN custstyle ON (custstyle.id = orders.styleid) ORDER BY orders.id DESC";
	$per_page = 150;
	$result = mysql_query($qry);
	$count = mysql_num_rows($result);
	$pages = ceil($count/$per_page);
}
//echo $qry;
//* $qry = "SELECT orders.* FROM orders ORDER BY timestamp";
$orders = mysql_query($qry) or die('Query failed: ' . mysql_error()); 
$order = mysql_fetch_assoc($orders);	
//echo $qry;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title>View Orders</title>
<?php include("init_top.php");?>
<link href="<?php echo $base_url;?>/admin/includes/cms.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?php echo $base_url;?>/admin/calendar/calendar-win2k-1.css" />

<script type="text/javascript" src="<?php echo $base_url;?>/admin/scripts/jquery-1.3.2.min.js"></script>
<!-- main calendar program -->
<script type="text/javascript" src="<?php echo $base_url?>/admin/calendar/calendar.js"></script>

<!-- language for the calendar -->
<script type="text/javascript" src="<?php echo $base_url?>/admin/calendar/lang/calendar-en.js"></script>

<!-- the following script defines the Calendar.setup helper function, which makes
     adding a calendar a matter of 1 or 2 lines of code. -->
<script type="text/javascript" src="<?php echo $base_url?>/admin/calendar/calendar-setup.js"></script>

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
	window.location = "order_view_admin.php";
}
$(document).ready(function()

{

	//Display Loading Image
	function Display_Load()

	{

		$("#loading").fadeIn(900,0);

		$("#loading").html('<img src="loadAnm.gif" />');

	}
	//Hide Loading Image
	function Hide_Load()

	{

		$("#loading").fadeOut('slow');

	};


	//Default Starting Page Results
	$("#pagination li:first").css({'color' : '#FF0084'}).css({'border' : 'none'});

	Display_Load();

	$("#order-list").load("order_view_paing.php?page=1", Hide_Load());
	//Pagination Click
	$("#pagination li").click(function(){
		
		Display_Load();
		//CSS Styles
		$("#pagination li")

			.css({'border' : 'solid #dddddd 1px'})

			.css({'color' : '#0063DC'});



		$(this)

		.css({'color' : '#FF0084'})

		.css({'border' : 'none'});
		//Loading Data
		var pageNum = this.id;

		$("#order-list").load("order_view_paing.php?page=" + pageNum,Hide_Load());

	});
});
</script>

<style>
/*
.resize{	width:150px;	height:auto;}
#loading{width: 100%;position: absolute;}
li{list-style: none;float: left;margin-right: 16px;padding:5px;border:solid 1px #dddddd;color:#0063DC;}
li:hover{color:#FF0084;cursor: pointer;}
*/
</style>
</head>

<body>
<?php include("header.php"); ?>
<div class="xgrid">
<div style="min-height: 300px;" class="portlet x12">
	<div class="portlet-header"><h4>View Orders</h4></div>			
		<div class="portlet-content" >
		
		
<form action="order_search_view_admin.php" method="post" name="customer_search_form" >
<table class="search-box-tabletype">
	<tr>
		<td colspan="9"><h3>Search form</h3></td>
	</tr>
	<tr>
		<td>Customer Name:</td>
		<td><input type="text" value="" name="customer_name" /></td>
		<td>Date:</td>
		<td><input type="text" value="" name="date" id="date_search" /></td>
	</tr>
	<tr>
		<td>Order number:</td>
		<td><input type="text" value="" name="order_number" /></td>
		<td>Company name: </td>
		<td><input type="text" name="company_name" value="<?php if(isset($_REQUEST['company_name'])){ echo $_REQUEST['company_name']; }?>" /></td>
	</tr>
	<tr>
		<td colspan="4"><input type="submit" name="Search" value="Search"  /></td>
	</tr>
</table>
<script type="text/javascript">
  Calendar.setup(
    {
      inputField  : "date_search",         // ID of the input field
      ifFormat    : "%Y-%m-%d",    // the date format
    }
  );
</script>
</form>
<?php if(!isset($_REQUEST['customerid'])){?>
<div align="center"  style="margin-left: 260px">
	<ul id="pagination">
	<?php
	//Pagination Numbers

	for($i=1; $i<=$pages; $i++)

	{

	echo '<li id="'.$i.'">'.$i.'</li>';

	}
	?>
	</ul> 
	<h4>Total pages: <?php echo $pages;?></h4> 
</div>
<div style="clear: both;"></div>
<div id="loading" ></div>
<div id="order-list" ></div>
<div align="center"  style="margin-left: 260px">
	<ul id="pagination">
	<?php
	//Pagination Numbers

	for($i=1; $i<=$pages; $i++)

	{

	echo '<li id="'.$i.'">'.$i.'</li>';

	}
	?>
	</ul> 
	<h4>Total pages: <?php echo $pages;?></h4>
</div>
<?php }else { ?>
<form action="order_add_admin.php" enctype="multipart/form-data" method="post" name="addorder">
<input type="hidden" name="addorderinfo" value="1">
<table width="800" frame="box" border="0" align="center">
<?php /*
	<tr>
		<td width="55" colspan="1">&nbsp;</td>
		<td colspan="6" align="right" valign="bottom"><h3>View Orders</h3></td>
	</tr>
*/?>
	<tr bgcolor="#D8D7E3">
		<td class="fieltable"><strong>Order#</strong></td>
		<td class="fieltable" width="134"><strong>Customer</strong></td>
		<td class="fieltable" width="101"><strong>Date</strong></td>
		<td class="fieltable" width="28"><strong>Qty</strong></td>
		<td class="fieltable" width="201"><strong>Style</strong></td>
		<td class="fieltable" width="55"><strong>Price</strong></td>
		<td class="fieltable" width="196"><strong>Action</strong></td>
	</tr>
	<?php 
	$bgcolor = "WHITE";
	do{ 
	?>
	<tr bgcolor="<?php echo $bgcolor; ?>">
		<td><?php echo $order["id"]; ?></td>
		<td><a href="customer_view_admin.php?customerid=<?php echo $order["customerid"]; ?>"><?php echo $order["firstname"]." ".$order["lastname"]; ?></a></td>
		<td><?php echo $order["timestamp"]; ?></td>
		<td><?php echo $order["qty"]; ?></td>
		<td><?php if ($order["stylename"]){ ?>
        			<a href="custstyle_viewentry_admin.php?styleid=<?php echo $order["custstyleid"];?>"><?php echo $order["stylename"]; ?></a>
		<?php } else {echo "Inventory Only"; } ?></td>
		<td><?php echo "$".money_format('%(#8.2n', $order["totalprice"]); ?></td>
		<td>
			<?php if($_SESSION['userlevel'] > 1) {?>
				<a href="order_edit_admin.php?orderid=<?php echo $order["id"]; ?>" title="Edit Order" rel="gb_page_center[500, 400]">edit</a> | 
				<a href="order_view_admin.php?delid=<?php echo $order["id"]; ?>" onClick="javascript:return confirm('Are you sure you want to delete this order?')">[X]</a> | 
			<?php }?>
			<?php if ($order["status"]) { ?>
				<a href="order_view_admin.php?status=0&orderid=<?php echo $order["id"]; ?>&customerid=<?php echo $order["customerid"]?>" style="color:green;">complete</a>
			<?php } else { ?>
				<a href="order_view_admin.php?status=1&orderid=<?php echo $order["id"]; ?>&customerid=<?php echo $order["customerid"]?>" style="color:red;">incomplete</a>
			<?php } ?> | 
            <?php if($order['invoice_id']==0){ ?>
            	<a href="receipt.php?rid=<?php echo $order["id"]; ?>" target="_blank">receipt</a>
			<?php } else {?>
            	<a href="invoice_receipt.php?rid=<?php echo $order["id"]; ?>" target="_blank">receipt</a>
            <?php }?>
		</td>
	</tr>
	<?php 
	if ($bgcolor == "WHITE")
	{
		$bgcolor = "#D8D8D8";
	} else {
		$bgcolor = "WHITE";
	}
	}while ($order = mysql_fetch_assoc($orders))  ?>
</table>
</form>
<?php } ?>
</div>
</div>
</div>
</body>
</html>
