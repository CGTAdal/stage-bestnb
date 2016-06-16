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

if ($_REQUEST["delid"])
{
	if(check('delete',3)){
		delete_record_secondary("orders", $_REQUEST["delid"], "customerid");	
		delete_record_secondary("batches", $_REQUEST["delid"], "custid");
		delete_record_secondary("printorders", $_REQUEST["delid"], "custid");
		delete_record_secondary("custstyle", $_REQUEST["delid"], "custid");
		delete_record("customers",$_REQUEST["delid"]);
	}else {
		die('You don\'t have permision to perform this action.');
	}
}

if ($_REQUEST["customerid"])
{
	$customerid=$_REQUEST["customerid"];
	$qry = "SELECT customers.* FROM customers WHERE id=$customerid ORDER BY lastname";
} else {
	$per_page  = 150;
	$query_search = "SELECT customers.* FROM customers WHERE 1=1 ";
	$param = '';
	$param.='&operator='.urlencode($_REQUEST['operator']);
	$param.='&email_operator='.urlencode($_REQUEST['email_operator']);
	$param.='&company_name_operator='.urlencode($_REQUEST['company_name_operator']);
	$param.='&phone_operator='.urlencode($_REQUEST['phone_operator']);
	$param.='&city_operator='.urlencode($_REQUEST['city_operator']);
	
	if(isset($_REQUEST['customer_name']) && trim($_REQUEST['customer_name'])!=''){
		$customer_name  = trim($_REQUEST['customer_name']);
		$query_search.=" AND (firstname like '%$customer_name%' OR lastname like '%$customer_name%')";
		$param.='&customer_name='.urlencode($customer_name);
		$condition = 'AND';
	}else {
		$condition = 'AND';
	}
	if(isset($_REQUEST['email']) && trim($_REQUEST['email'])!=''){
		$email  = trim($_REQUEST['email']);
		$email_operator = $_REQUEST['email_operator'];
		switch($email_operator) {
			case '1':
				$query_search.=' '.$condition." email = '$email'";
			break;
			case '2':
				$query_search.=' '.$condition." email like '%$email%'"; 
			break;
			default:
				$query_search.=' '.$condition." email = '$email'";
		}
		
		$param.='&email='.urlencode($email);
		$codition1 = 'AND';
	}else{
		$codition1 = 'AND';
	}
	if(isset($_REQUEST['company_name']) && trim($_REQUEST['company_name'])!=''){
		$company_name = trim($_REQUEST['company_name']);
		
		$company_name_operator = $_REQUEST['company_name_operator'];
		switch($company_name_operator) {
			case '1':
				$query_search.=' '.$codition1."  companyname = '$company_name'";
			break;
			case '3':
				$query_search.=' '.$codition1."  companyname like '%$company_name%'"; 
			break;
		}
		
		$param.='&company_name='.urlencode($company_name);
		$condition2 = 'AND';
	} else {
		$condition2 = 'AND';
	}

	if(isset($_REQUEST['phone_number']) && trim($_REQUEST['phone_number'])!=''){
		$phone_number = trim($_REQUEST['phone_number']);
		
		$phone_operator = $_REQUEST['phone_operator'];
		switch($phone_operator) {
			case '1':
				$query_search.=' '.$condition2."  phone = '$phone_number'";
				break;
			case '2':
				$query_search.=' '.$condition2."  phone like '%$phone_number%'";
				break;
			default:
				$query_search.=' '.$condition2."  phone like '%$phone_number%'";
		}
		$param.='&phone_number='.urlencode($phone_number);
		$condition3 = 'AND';
	} else {
		$condition3 = 'AND';		
	}
	
	if(isset($_REQUEST['search_city']) && trim($_REQUEST['search_city'])!=''){
		$search_city = trim($_REQUEST['search_city']);
		
		$city_operator = $_REQUEST['city_operator'];
		switch($city_operator) {
			case '1':
				$query_search.=' '.$condition3."  city = '$search_city'";
				break;
			case '2':
				$query_search.=' '.$condition3."  city like '%$search_city%'";
				break;
			default:
				$query_search.=' '.$condition3."  city like '%$search_city%'";
		}
		$param.='&search_city='.urlencode($search_city);	
	}
	
	$result = mysql_query($query_search);
	$count = mysql_num_rows($result);
	$pages = ceil($count/$per_page);
	//echo $query_search;
} 

$customers = mysql_query($query_search) or die('Query failed: ' . mysql_error()); 
$customer = mysql_fetch_assoc($customers);
	

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>View Customers</title>
<?php include("init_top.php");?>
<link href="<?php echo $base_url?>/admin/includes/cms.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" media="all" href="<?php echo $base_url?>/admin/calendar/calendar-win2k-1.css" title="win2k-1" />

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
<script type="text/javascript" src="<?php echo $base_url?>/admin/scripts/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="<?php echo $base_url?>/admin/scripts/paging_search.js"></script>
<link href="<?php echo $base_url?>/admin/greybox/gb_styles.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $base_url?>/admin/greybox/gb_styles.css" rel="stylesheet" type="text/css" />
<script language="javascript">
function reloadIt()
{
	window.location = "customer_view_admin.php";
}

function check_validate(){
	var email = document.customer_search_form.email.value;	
	if(email!=''){	
		var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
		if(reg.test(email) == false) {	
			alert('Invalid Email Address');	
			document.customer_search_form.email.focus();	
			return false;		
		}
	}
	return true;
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
	<div class="xgrid">
		<div class="portlet x12">
			<div class="portlet-header">
				<h4>View Customers</h4>
			</div>
			<div class="portlet-content">
				<input type="hidden" value="<?php echo $param;?>" id="param_search" name="param_search" />
				<form action="customer_search_view.php" method="post" name="customer_search_form">
					<table align="center" class="search-box-tabletype">
						<tr>
							<td colspan="2"><h3>Search form</h3></td>
						</tr>
						<tr>
							<td class="align-right" width="120px">Customer Name:</td>
							<td>
								<select name="operator">
									<option value="1" <?php echo (isset($_REQUEST['operator'])&&$_REQUEST['operator']=='1')?"selected='selected'":"";?>>Is</option>
									<option value="2" <?php echo (isset($_REQUEST['operator'])&&$_REQUEST['operator']=='2')?"selected='selected'":"";?>>Like</option>
									<?php /*?><option value="3" <?php echo (isset($_REQUEST['operator'])&&$_REQUEST['operator']=='3')?"selected='selected'":"";?>>Contains</option>*/?>
								</select>
								<input type="text" value="<?php if(isset($_REQUEST['customer_name'])){ echo $_REQUEST['customer_name'];}?>" name="customer_name" />
							</td>
						</tr>
						<tr>
							<td class="align-right">Email:</td>
							<td>
								<select name="email_operator">
									<option value="1" <?php echo (isset($_REQUEST['email_operator'])&&$_REQUEST['email_operator']=='1')?"selected='selected'":"";?>>Is</option>
									<option value="2" <?php echo (isset($_REQUEST['email_operator'])&&$_REQUEST['email_operator']=='2')?"selected='selected'":"";?>>Like</option>
									<?php /*?><option value="3" <?php echo (isset($_REQUEST['email_operator'])&&$_REQUEST['email_operator']=='3')?"selected='selected'":"";?>>Contains</option>*/?>
								</select>
								<input type="text" value="<?php if(isset($_REQUEST['email'])){ echo $_REQUEST['email'];}?>" name="email" />
							</td>
						</tr>
						<tr>
							<td class="align-right">Company Name:</td>
							<td>
								<select name="company_name_operator">
									<option value="1" <?php echo (isset($_REQUEST['company_name_operator'])&&$_REQUEST['company_name_operator']=='1')?"selected='selected'":"";?>>Is</option>
									<option value="2" <?php echo (isset($_REQUEST['company_name_operator'])&&$_REQUEST['company_name_operator']=='2')?"selected='selected'":"";?>>Like</option>
									<?php /*?><option value="3" <?php echo (isset($_REQUEST['company_name_operator'])&&$_REQUEST['company_name_operator']=='3')?"selected='selected'":"";?>>Contains</option>*/?>
								</select>
								<input type="text" value="<?php if(isset($_REQUEST['company_name'])){ echo $_REQUEST['company_name'];}?>" name="company_name" />
							</td>
						</tr>
						<tr>
							<td class="align-right">Phone Number:</td>
							<td>
								<select name="phone_operator">
									<option value="1" <?php echo (isset($_REQUEST['phone_operator'])&&$_REQUEST['phone_operator']=='1')?"selected='selected'":"";?>>Is</option>
									<option value="2" <?php echo (isset($_REQUEST['phone_operator'])&&$_REQUEST['phone_operator']=='2')?"selected='selected'":"";?>>Like</option>
								</select>
								<input type="text" value="<?php if(isset($_REQUEST['phone_number'])){ echo $_REQUEST['phone_number'];}?>" name="phone_number" />
							</td>
						</tr>
						<tr>
							<td class="align-right">City:</td>
							<td>
								<select name="city_operator">
									<option value="1" <?php echo (isset($_REQUEST['city_operator'])&&$_REQUEST['city_operator']=='1')?"selected='selected'":"";?>>Is</option>
									<option value="2" <?php echo (isset($_REQUEST['city_operator'])&&$_REQUEST['city_operator']=='2')?"selected='selected'":"";?>>Like</option>
								</select>
								<input type="text" value="<?php if(isset($_REQUEST['search_city'])){ echo $_REQUEST['search_city'];}?>" name="search_city" />
							</td>
						</tr>
						<tr>
							<td></td>
							<td><input type="submit" name="Search" value="Search"  /></td>
						</tr>
					</table>
				</form>
				<div style="float:right">
					<ul id="pagination">
					<?php 
						for($i=1; $i<=$pages; $i++) {
							#echo '<li id="'.$i.'">'.$i.'</li>';
						}
					?>
					</ul> 
					<h4> Total pages: <?php echo $pages;?> </h4>
				</div>
				<div style="float:left">
					<a href="customer_add_admin.php" style="color:#fff" class="btn btn-small">Add Customer</a>
				</div>
				<div style="clear: both;"></div>
				<a href="javascript: void(0);" class="view-full-info">Click to view additional information</a>
				<div id="customer-list" ></div>
				<div style="float:right">
					<ul id="pagination">
					<?php
					for($i=1; $i<=$pages; $i++)
					
					{
					
					#echo '<li id="'.$i.'">'.$i.'</li>';
					
					}
					?>
					</ul> <h4> Total pages: <?php echo $pages;?> </h4>
				</div>
			</div>
		</div>
	</div>
	<script>
		$(document).ready(function(){
			$('.view-full-info').live('click',function(){
				if($(this).html()=='Click to view additional information') {
					$(this).html('Click to view main information');
				} else {
					$(this).html('Click to view additional information');
				}
				$('.additional-field').toggle();
				$('.main-field').toggle();
			})
		});
	</script>
</body>
</html>
