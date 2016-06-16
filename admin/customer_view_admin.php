<?php 
require_once('conn/DB.php');
include('conn/tablefuncs.php');
include('../include/config.php');
mysql_select_db($database_DB, $ravcodb);
@session_start();
include('permision.php'); 
if (!$_SESSION["loginid"])
{?>
<script language="javascript">
parent.parent.location.href='admin.php';
window.close();
</script>
<?php }

if (isset($_REQUEST["delid"])){
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

function doPages($page_size, $thepage, $query_string, $total=0) {
	    //per page count
	    $index_limit = 100;
	    //set the query string to blank, then later attach it with $query_string
	    $query='';

	    if(strlen($query_string)>0){
		$query = "&".$query_string;
	    }

	    //get the current page number example: 3, 4 etc: see above method description
	    $current = get_current_page();

	    $total_pages=ceil($total/$page_size);
	    $start=max($current-intval($index_limit/2), 1);
	    $end=$start+$index_limit-1;

	    echo '
	<div class="paging">';

	    if($current==1) {
		echo '<span class="prn">< Previous</span> ';
	    } else {
		$i = $current-1;
		echo '<a class="prn" title="go to page '.$i.'" rel="nofollow" href="'.$thepage.'?page='.$i.$query.'">< Previous</a> ';
		echo '<span class="prn">...</span> ';
	    }

	    if($start > 1) {
		$i = 1;
		echo '<a title="go to page '.$i.'" href="'.$thepage.'?page='.$i.$query.'">'.$i.'</a> ';
	    }

	    for ($i = $start; $i <= $end && $i <= $total_pages; $i++){
		if($i==$current) {
		    echo '<span>'.$i.'</span> ';
		} else {
		    echo '<a title="go to page '.$i.'" href="'.$thepage.'?page='.$i.$query.'">'.$i.'</a> ';
		}
	    }

	    if($total_pages > $end){
		$i = $total_pages;
		echo '<a title="go to page '.$i.'" href="'.$thepage.'?page='.$i.$query.'">'.$i.'</a> ';
	    }

	    if($current < $total_pages) {
		$i = $current+1;
		echo '<span class="prn">...</span> ';
		echo '<a class="prn" title="go to page '.$i.'" rel="nofollow" href="'.$thepage.'?page='.$i.$query.'">Next ></a> ';
	    } else {
		echo '<span class="prn">Next ></span> ';
	    }

	    //if nothing passed to method or zero, then dont print result, else print the total count below:
	    if ($total != 0){
			//prints the total result count just below the paging
			echo '(total '.$total.' results)</div>';
	    }

}//end of method doPages()
//Both of the functions below required
function check_integer($which) {
    if(isset($_REQUEST[$which])){
        if (intval($_REQUEST[$which])>0) {
            //check the paging variable was set or not,
            //if yes then return its number:
            //for example: ?page=5, then it will return 5 (integer)
            return intval($_REQUEST[$which]);
        } else {
            return false;
        }
    }
    return false;
}//end of check_integer()
function get_current_page() {
    if(($var=check_integer('page'))) {
        //return value of 'page', in support to above method
        return $var;
    } else {
        //return 1, if it wasnt set before, page=1
        return 1;
    }
}//end of method get_current_page()
 
if($_REQUEST){
	$query_search = '';
	$page = @$_REQUEST['page'];	
	$operator = $_REQUEST['operator'];	
	if(isset($_REQUEST['customer_name']) && trim($_REQUEST['customer_name'])!=''){
		$customer_name  = trim($_REQUEST['customer_name']);
		switch($operator) {
			case 1:
					//$query_search.=" AND (firstname like '%$customer_name%' OR lastname like '%$customer_name%') ";
					$query_search.=" AND concat_ws(' ',firstname,lastname) = '{$customer_name}'";
				break;
			case 2:
					$query_search.=" AND lower(concat_ws(' ', firstname, lastname)) like lower('%{$customer_name}%')";
				break;
			case 3:
					$query_search.=" AND concat_ws(' ', firstname, lastname) like '%{$customer_name}%'"; 
				break;
			default:
				
		}
		//$query_search.=" AND (firstname like '%$customer_name%' OR lastname like '%$customer_name%') ";
		//$condition = 'OR';
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
			break;
			case '2':
				$query_search.=' '.$condition." email like '%$email%'";
				break; 
			break;
			default:
				$query_search.=' '.$condition." email like '%$email%'";
		}
		
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
			case '2':
				$query_search.=' '.$codition1."  companyname like '%$company_name%'";
				break;
			default:
				$query_search.=' '.$codition1."  companyname like '%$company_name%'";
		}
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
		$condition2 = 'AND';
	} else {
		$condition2 = 'AND';		
	}
}else{
	$query_search = '';
}
$cid = '1=1';
if ($_REQUEST["customerid"]){
	$cid = "id=".$_REQUEST["customerid"]." ";
}
$rec_limit = 100;	
$sql_count = "SELECT count(customers.id) as total FROM customers where ".$cid." ".$query_search." ORDER BY lastname";	 
$retval_count = mysql_query($sql_count);
if(!$retval_count )
{
  die('Could not get data: ' . mysql_error());
}
$row = mysql_fetch_assoc($retval_count);

$rec_count = $row['total'];	
$page = @$_REQUEST['page'];//curent page
if ($page == "")  $page=1;
$start = ($page-1)*$rec_limit;
$total_page = ceil($rec_count/$rec_limit);
//echo $total_page.'AAA';
$left_rec = $rec_count - ($page*$rec_limit);

$sql = "SELECT * FROM customers WHERE ".$cid;
$sql.=$query_search;
$sql.=" ORDER BY lastname 
LIMIT $start,$rec_limit";

$result = mysql_query($sql);
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
<script type="text/javascript" src="<?php echo $base_url?>/admin/scripts/paging.js"></script>
<link href="<?php echo $base_url?>/admin/greybox/gb_styles.css" rel="stylesheet" type="text/css" />

<script language="javascript">
function reloadIt(){
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
		width:259px;
		height:auto;
	}
	/*Paging style*/
	.paging { padding:10px 0px 0px 0px; text-align:center; font-size:13px;}
	.paging.display{text-align:right;}
	.paging a, .paging span {padding:2px 8px 2px 8px;}
	.paging span {font-weight:bold; color:#000; font-size:13px; }
	.paging a {color:#000; text-decoration:none; border:1px solid #dddddd;}
	.paging a:hover { text-decoration:none; background-color:#6C6C6C; color:#fff; border-color:#000;}
	.paging span.prn { font-size:13px; font-weight:normal; color:#aaa; }
	.paging a.prn { border:2px solid #dddddd;}
	.paging a.prn:hover { border-color:#000;}
	.paging p#total_count{color:#aaa; font-size:12px; padding-top:8px; padding-left:18px;}
	.paging p#total_display{color:#aaa; font-size:12px; padding-top:10px;}
</style>
<style>
/*
.resize{width:150px;height:auto;}
#loading{width: 100%;position: absolute;}
li{list-style: none;float: left;margin-right: 16px;padding:5px;border:solid 1px #dddddd;color:#0063DC;}
li:hover{color:#FF0084;cursor: pointer;}
*/
.fieltable{background-color: #263849 !important;color: #FFFFFF; font-weight: bold; font-size:13px;} 
</style>

</head>
<body>
<?php include("header.php"); ?>
<div class="xgrid" >
	<div class="portlet x12">
		<div class="portlet-header"><h4>View Customers</h4></div>			
			<div class="portlet-content" >
				<form action="customer_view_admin.php" method="post" name="customer_search_form" >
					<table align="center" class="search-box-tabletype">
						<tr>
							<td colspan="2"><h3>Search form</h3></td>
						</tr>
						<tr>
							<td class="align-right" width="120px">Customer Name:</td>
							<td>
								<select name="operator">
									<option value="1" <?php echo (@$_REQUEST['operator']==1)?'selected':'';?> >Is</option>
									<option selected value="2" <?php echo (@$_REQUEST['operator']==2)?'selected':'';?> >Like</option>
									<!-- <option value="3">Contains</option>-->
								</select>
								<input type="text" value="<?php echo @$_REQUEST['customer_name']; ?>" name="customer_name" />
							</td>
						</tr>
						<tr>
							<td class="align-right">Email:</td>
							<td>
								<select name="email_operator">
									<option value="1" <?php echo (@$_REQUEST['email_operator']==1)?'selected':'';?> >Is</option>
									<option selected value="2" <?php echo (@$_REQUEST['email_operator']==2)?'selected':'';?> >Like</option>
									<!-- <option value="3">Contains</option> -->
								</select>
								<input type="text" value="<?php echo @$_REQUEST['email']; ?>" name="email"/>
							</td>
						</tr>
						<tr>
							<td class="align-right">Company Name:</td>
							<td>
								<select name="company_name_operator">
									<option value="1" <?php echo (@$_REQUEST['company_name_operator']==1)?'selected':'';?> >Is</option>
									<option selected value="2" <?php echo (@$_REQUEST['company_name_operator']==2)?'selected':'';?> >Like</option>
									<!-- <option value="3">Contains</option>-->
								</select>
								<input type="text" value="<?php echo @$_REQUEST['company_name']; ?>" name="company_name"/>
							</td>
						</tr>
						<tr>
							<td class="align-right">Phone Number:</td>
							<td>
								<select name="phone_operator">
									<option value="1" <?php echo (@$_REQUEST['phone_operator']==1)?'selected':'';?>>Is</option>
									<option selected value="2" <?php echo (@$_REQUEST['phone_operator']==2)?'selected':'';?>>Like</option>
									<!-- <option value="3">Contains</option>-->
								</select>
								<input type="text" value="<?php echo @$_REQUEST['phone_number']; ?>" name="phone_number"/>
							</td>
						</tr>
						<tr>
							<td class="align-right">City:</td>
							<td>
								<select name="city_operator">
									<option value="1" <?php echo (@$_REQUEST['city_operator']==1)?'selected':'';?>>Is</option>
									<option selected value="2" <?php echo (@$_REQUEST['city_operator']==2)?'selected':'';?>>Like</option>
									<!-- <option value="3">Contains</option>-->
								</select>
								<input type="text" value="<?php echo @$_REQUEST['search_city']; ?>" name="search_city"/>
							</td>
						</tr>
						<tr>
							<td></td>
							<td><input type="submit" name="Search" value="Search"  /></td>
						</tr>
					</table>
				</form>	 
	<form action="customer_add_admin.php" enctype="multipart/form-data" method="post" name="addcust">
		<input type="hidden" name="addcustinfo" value="1" />
		<table width="800px" frame="box" border="0" align="center">
			<tr>
				<td colspan="4"><a href="customer_add_admin.php" style="color:#fff" class="btn btn-small">Add Customer</a></td>
			</tr>
			<tr bgcolor="#D8D7E3">
				<td width="7%" class="fieltable">Name</td>
				<td width="12%" class="fieltable"><strong>Company</strong></td>
				<td width="7%" class="fieltable"><strong>Email</strong></td>
		   		<!-- <td width="12%" class="fieltable"><strong>Inventory</strong></td>
				<td width="12%" class="fieltable"><strong>FInventory</strong></td>
				<td width="12%" class="fieltable"><strong>DMInventory</strong></td> -->
		   		<td width="7%" class="fieltable"><strong>City</strong></td>
		   		<td width="6%" class="fieltable"><strong>State</strong></td>
		        <td width="6%" class="fieltable"><strong>Phone</strong></td>
		  	</tr>
		<?
		$bgcolor = "WHITE";
		while($customer = mysql_fetch_assoc($result))
		{
		?>
		<tr bgcolor="<?php echo $bgcolor; ?>">
				<td colspan="8" align="right">
		        	<a href="customer_edit_admin.php?customerid=<?php echo $customer["id"]; ?>" title="Edit Customer" rel="gb_page_center[850, 600]">edit</a> | 
		        	<?php if($_SESSION["userlevel"] > 1){?>
		        		<a href="customer_view_admin.php?delid=<?php echo $customer["id"]; ?>" onClick="javascript:return confirm('Are you sure you want to delete this customer?')">delete</a> | 
		        	<?php } ?>
		        	<a href="admin_custstyle_view.php?customerid=<?php echo $customer["id"]; ?>" title="View Styles" rel="gb_page_center[1100, 800]">styles</a> | 
		        	<a href="order_view_admin.php?customerid=<?php echo $customer["id"]; ?>" title="View Orders">orders</a> | 
		        	<a href="admin_list_invoice.php?customerid=<?php echo $customer['id']; ?>">Invoices</a> | 
		        	<a href="presale_proof_view.php?customerid=<?php echo $customer['id']; ?>">Pre-Sales</a> | 
		        	<a href="printorder_view_admin.php?customerid=<?php echo $customer["id"]; ?>" title="View Print Orders">print orders</a> | 
		        	<a href="batch_view_admin.php?customerid=<?php echo $customer["id"]; ?>&batchstatus=pending" title="View Batches - Pending" rel="gb_page_center[1024, 500]">pending</a>		        	 
		        	 | <a href="customerfolder_admin.php?customerid=<?php echo $customer["id"]; ?>" title="<?php echo $customer["username"]; ?> - File Manager" rel="gb_page_center[1024, 500]">files</a> 
		        	 
		       	</td>
			</tr>
		<tr>
				<td><?php echo $customer["companyname"]; ?></td>
				<td><?php echo $customer["firstname"]." ".$customer["lastname"]; ?></td>
				<td><?php echo $customer["email"]; ?></td>
				<!-- <td><?php //echo $customer["inventory"]; ?></td>
				<td><?php //echo $customer["finventory"]; ?></td>
				<td><?php //echo $customer["dminventory"]; ?></td> -->
				<td><?php echo $customer["city"]; ?></td>
				<td><?php echo $customer["state"]; ?></td>
				<td><?php echo $customer["phone"]; ?></td>
			</tr>
		<?
		if ($bgcolor == "WHITE")
			{
				$bgcolor = "#D8D8D8";
			} else {
				$bgcolor = "WHITE";
			}
		}
		?>
		
		</table>
	</form> 	
	<div>
		<?php	 
			doPages($rec_limit ,'/admin/customer_view_admin.php','',$rec_count);			
		?>
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