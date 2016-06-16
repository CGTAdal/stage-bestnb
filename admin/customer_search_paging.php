<style>
.additional-field{display:none}
</style>
<?php
require_once('conn/DB.php');
include('conn/tablefuncs.php');
include('../include/config.php');
mysql_select_db($database_DB, $ravcodb);
@session_start();
if (!$_SESSION["loginid"])
{?>
<script language="javascript">
parent.parent.location.href='admin.php';
window.close();
</script>
<script type="text/javascript">
    var GB_ROOT_DIR = "greybox/";
</script>
<script type="text/javascript" src="<?php echo $base_url?>/admin/greybox/AJS.js"></script>
<script type="text/javascript" src="<?php echo $base_url?>/admin/greybox/AJS_fx.js"></script>
<script type="text/javascript" src="<?php echo $base_url?>/admin/greybox/gb_scripts.js"></script>
<link href="<?php echo $base_url?>/admin/greybox/gb_styles.css" rel="stylesheet" type="text/css" />
<?php }

$per_page = 150; 

if($_GET)

{
	$query_search = '';
	$page=$_GET['page'];
	
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

$start = ($page-1)*$per_page;

$sql = "SELECT * FROM customers WHERE 1=1";
$sql.=$query_search;
$sql.=" ORDER BY lastname 
LIMIT $start,$per_page";

$result = mysql_query($sql);
?>
<form action="customer_add_admin.php" enctype="multipart/form-data" method="post" name="addcust">
	<input type="hidden" name="addcustinfo" value="1">
	<table width="800px" frame="box" border="0" align="center">
		<tr bgcolor="#D8D7E3">
			<td width="7%" class="fieltable"><strong>Name</strong></td>
			<td width="7%" class="fieltable"><strong>Email</strong></td>
			<td width="7%" class="fieltable main-field"><strong>Company</strong></td>
	   		<td width="12%"class="fieltable main-field"><strong>Inventory</strong></td>
			<td width="12%" class="fieltable main-field"><strong>FInventory</strong></td>
			<td width="12%" class="fieltable main-field"><strong>DMInventory</strong></td>
			<td width="" class="fieltable additional-field"><strong>Street</strong></td>
			<td width="" class="fieltable additional-field"><strong>Street 2</strong></td>
	   		<td width="7%" class="fieltable"><strong>City</strong></td>
	   		<td width="6%" class="fieltable"><strong>State</strong></td>
	   		<td width="6%" class="fieltable additional-field"><strong>Zip</strong></td>
	        <td width="6%" class="fieltable"><strong>Phone</strong></td>
	  	</tr>
	<?
		$bgcolor = "WHITE";
		while($customer = mysql_fetch_array($result))
		{
		
	?>
	
	<tr bgcolor="<?php echo $bgcolor;?>">
			<td><?php echo $customer["firstname"]." ".$customer["lastname"]; ?></td>
			<td><?php echo $customer["email"]; ?></td>
			<td class="main-field"><?php echo $customer["companyname"]; ?></td>
			<td class="main-field"><?php echo $customer["inventory"]; ?></td>
			<td class="main-field"><?php echo $customer["finventory"]; ?></td>
			<td class="main-field"><?php echo $customer["dminventory"]; ?></td>
			<td class="additional-field"><?php echo $customer['street'];?></td>
			<td class="additional-field"><?php echo $customer['street2'];?></td>
			<td><?php echo $customer["city"]; ?></td>
			<td><?php echo $customer["state"]; ?></td>
			<td class="additional-field"><?php echo $customer['zip'];?></td>
			<td><?php echo $customer["phone"]; ?></td>
		</tr>
		<tr bgcolor="<?php echo $bgcolor;?>">
			<td colspan="12" align="right">
	        	<a href="customer_edit_admin.php?customerid=<?php echo $customer["id"]; ?>" onclick="return GB_showCenter('Edit Customer', this.href,600,850)">edit</a> | <a href="customer_view_admin.php?delid=<?php echo $customer["id"]; ?>" onClick="javascript:return confirm('Are you sure you want to delete this customer?')">delete</a> | <a href="admin_custstyle_view.php?customerid=<?php echo $customer["id"]; ?>" onclick="return GB_showCenter('View Styles', this.href,800,1100)">styles</a>| <a href="order_view_admin.php?customerid=<?php echo $customer["id"]; ?>" title="View Orders">orders</a> | <a href="admin_list_invoice.php?customerid=<?php echo $customer['id']; ?>">Invoices</a> | <a href="printorder_view_admin.php?customerid=<?php echo $customer["id"]; ?>" title="View Print Orders">print orders</a> | <a href="batch_view_admin.php?customerid=<?php echo $customer["id"]; ?>&batchstatus=pending" title="View Batches - Pending" rel="gb_page_center[600, 500]">pending</a> | 
	             <a href="admin_change_customer_password.php?id=<?php echo $customer["id"]; ?>" title="Change Password" rel="gb_page_center[300, 110]">change password</a>
	       	</td>
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
