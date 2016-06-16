<?php 
require_once('conn/DB.php');
include('conn/tablefuncs.php');
include('../include/config.php');
mysql_select_db($database_DB, $ravcodb);
session_start();
include('permision.php');
//if (!$_SESSION["loginid"] || $_SESSION["userlevel"] < 2) - 11052013 - ha.pham - https://www.assembla.com/spaces/bestnamebadges-com/tickets/272#/activity/ticket:
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

if ($_REQUEST["delid"])
{
	if(check('delete',3)){
		delete_record_secondary("orders", $_REQUEST["delid"], "id");
	}else {
		die('You don\'t have permision to perform this action.');
	}	
}

	$query_search = "SELECT orders.*, customers.firstname, customers.lastname, custstyle.stylename, custstyle.id AS custstyleid FROM orders LEFT JOIN customers ON (customers.id = orders.customerid) LEFT JOIN custstyle ON (custstyle.id = orders.styleid) WHERE 1=1";
	$param = '';
	if(isset($_REQUEST['customer_name']) && trim($_REQUEST['customer_name'])!=''){
		$customer_name  = trim($_REQUEST['customer_name']);
		$query_search.=" AND (customers.firstname like '%$customer_name%' OR customers.lastname like '%$customer_name%') ";
		$param.='&customer_name='.urlencode($customer_name);
	}
	if(isset($_REQUEST['date']) && trim($_REQUEST['date'])!=''){
		$date  = $_REQUEST['date'];
		$query_search.=" AND orders.timestamp like '%$date%'";
		$param.='&date='.$date;
	}
	if(isset($_REQUEST['order_number']) && trim($_REQUEST['order_number'])!=''){
		$order_number = trim($_REQUEST['order_number']);
		$query_search.=" AND  orders.id like '%$order_number%'";
		$param.='&order_number='.urlencode($order_number);
	}
	if(isset($_REQUEST['company_name']) && trim($_REQUEST['company_name'])!=''){
		$company_name = trim($_REQUEST['company_name']);
		$query_search.=" AND  customers.companyname like '%$company_name%'";
		$param.='&company_name='.urlencode($company_name);
	}
	$query_search.= ' ORDER BY orders.id DESC';

	//echo $query_search; 
	//echo $query_search;
	$per_page = 150;
	$result = mysql_query($query_search);
	$count = mysql_num_rows($result);
	$pages = ceil($count/$per_page);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>View Orders</title>
<?php include("init_top.php");?>
<link href="includes/cms.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css"  href="<?php echo $base_url?>/admin/calendar/calendar-win2k-1.css"/>

<script type="text/javascript" src="<?php echo $base_url?>/admin/scripts/jquery-1.3.2.min.js"></script>
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


<script type="text/javascript" src="<?php echo $base_url?>/admin/greybox/AJS.js"></script>
<script type="text/javascript" src="<?php echo $base_url?>/admin/greybox/AJS_fx.js"></script>
<script type="text/javascript" src="<?php echo $base_url?>/admin/greybox/gb_scripts.js"></script>


<link href="greybox/gb_styles.css" rel="stylesheet" type="text/css" />

<script language="javascript">
function reloadIt()
{
	window.location = "order_view_admin.php";
}
$(document).ready(function()

{

	var param_search = $("#param_search").val();
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

	$("#content").load("order_search_view_paing.php?page=1"+param_search, Hide_Load());
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

		$("#content").load("order_search_view_paing.php?page=" + pageNum+param_search,Hide_Load());

	});
});
</script>

<style>
/*
.resize
{
	width:150px;
	height:auto;
}

li

{ 

list-style: none; 

float: left; 

margin-right: 16px; 

padding:5px; 

border:solid 1px #dddddd;

color:#0063DC; 

}
li:hover

{ 

color:#FF0084; 

cursor: pointer; 

}
*/
#loading
{ 

width: 100%; 

position: absolute;

}
</style>

</head>

<body>
<?php include("header.php"); ?>
<div class="xgrid">
<div style="min-height: 300px;" class="portlet x12">
	<div class="portlet-header"><h4>View Orders</h4></div>			
		<div class="portlet-content" >
<form action="order_search_view_admin.php" method="post" name="customer_search_form" >
<input type="hidden" value="<?php echo $param;?>" id="param_search" name="param_search" />
<table width="800" frame="box" border="0" align="center">
	<tr>
		<td colspan="9"><h3>Search form</h3></td>
	</tr>
	<tr>
		<td>Customer Name:</td>
		<td>
			<input type="text" value="<?php if(isset($_REQUEST['customer_name'])){echo $_REQUEST['customer_name'];}?>" name="customer_name" />
		</td>
		<td>Date:</td>
		<td>
			<input type="text" value="<?php if(isset($_REQUEST['date'])){echo $_REQUEST['date'];}?>" name="date" id="date_search" />
		</td>
	</tr>
	<tr>
		<td>Order number:</td>
		<td><input type="text" value="<?php if(isset($_REQUEST['order_number'])){echo $_REQUEST['order_number'];}?>" name="order_number" /></td>
		<td>Company name: </td>
		<td><input type="text" name="company_name" value="<?php if(isset($_REQUEST['company_name'])){ echo $_REQUEST['company_name']; }?>" /></td>
	</tr>
	<tr>
		<td colspan="4" align="center"><input style="font-size:12px;" class="btn btn-small" type="submit" name="Search" value="Search"  /></td>
	</tr>
	<script type="text/javascript">
  Calendar.setup(
    {
      inputField  : "date_search",         // ID of the input field
      ifFormat    : "%Y-%m-%d",    // the date format
    }
  );
</script>
</table>
</form>
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
<div id="content" style="width:auto;" ></div>
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
</div>
</div>
</div>
</body>
</html>
	