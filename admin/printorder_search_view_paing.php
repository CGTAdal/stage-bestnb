<?php 
require_once('conn/DB.php');
include('conn/tablefuncs.php');
include('../include/config.php');
mysql_select_db($database_DB, $ravcodb);
session_start();
//if (!$_SESSION["loginid"] || $_SESSION["userlevel"] < 2)
if (!$_SESSION["loginid"])
{?>
<script language="javascript">
parent.parent.location.href='admin.php';
window.close();
</script>
<?php }
$type_list = array(
	'1'		=> 'DTC',
	'2'		=> 'Photo Id',
	'3'		=> 'Direct Jet',
	'4'		=> 'UV',
	'5'		=> 'Laser',
	'6'		=> 'Reusable',
	'0'		=> 'Other'
);
$status_list = array(
	'New'		=> 'New',
	'Printed'	=> 'Printed',
	'Waiting'	=> 'Waiting',
	'See Note'	=> 'See Note'
);
if ($_REQUEST["norderid"])
{
	if(isset($_REQUEST["status"])){
			$data["status"] = $_REQUEST["status"];
	}
	if(isset($_REQUEST['priority'])){
		if($_REQUEST['priority'] == 0){
			$data["priority"] = 1;
		}else{
			$data["priority"] = 0;
		}
	}
	$where = "id = ".$_REQUEST["norderid"];
	modify_record("printorders", $data, $where);
}

if ($_REQUEST["delid"])
{
	
	delete_record_secondary("printorders", $_REQUEST["delid"], "id");
	delete_record_secondary("batches", $_REQUEST["delid"], "printorderid");
}

	$per_page = 150;
	
	
	if($_GET)
	{

		$page=$_GET['page'];
	}



	$start = ($page-1)*$per_page;
	
	$query_search = "SELECT printorders.*, customers.id AS custid, 
	customers.firstname AS firstname, customers.lastname AS lastname, 
	customers.companyname AS companyname, customers.street,
	customers.street2, customers.city, customers.state,
	customers.zip AS zipcode, customers.email, 
	customers.phone 
	FROM printorders 
	LEFT JOIN customers ON (customers.id = printorders.custid) 
	WHERE printorders.paid = 1
	AND new_old  = 'new'
	";
	
	$param = '';
	if(isset($_REQUEST['customer_name']) && trim($_REQUEST['customer_name'])!=''){
		$customer_name  = trim($_REQUEST['customer_name']);
		$query_search.=" AND (firstname like '%$customer_name%' OR lastname like '%$customer_name%')";
		$param.='&customer_name='.urldecode($customer_name);
	}
	if(isset($_REQUEST['date']) && trim($_REQUEST['date'])!=''){
		$date  = trim($_REQUEST['date']);
		$query_search.=" AND printorders.timestamp like '%$date%'";
		$param.='&date='.urlencode($date);
	}
    if(isset($_REQUEST['created_date']) && trim($_REQUEST['created_date'])!=''){
        $created_date  = trim($_REQUEST['created_date']);
        $query_search.=" AND printorders.created_time like '%$created_date%'";
        $param.='&created_date='.urlencode($created_date);
    }
	if(isset($_REQUEST['print_order_number']) && trim($_REQUEST['print_order_number'])!=''){
		$print_order_number = trim($_REQUEST['print_order_number']);
		$query_search.=" AND  printorders.id like '%$print_order_number%'";
		$param.='&print_order_number='.urlencode($print_order_number);
	}
	if(isset($_REQUEST['company_name']) && trim($_REQUEST['company_name'])!=''){
		$company_name = trim($_REQUEST['company_name']);
		$query_search.=" AND  customers.companyname like '%$company_name%'";
		$param.='&company_name='.urlencode($company_name);
	}
	if(isset($_REQUEST['search_type']) && count($_REQUEST['search_type'])>0 && count($_REQUEST['search_type'])<7) {
		$types	= implode(",", $_REQUEST['search_type']);
		$query_search.=" AND printorders.type IN ({$types})";
		
		foreach($_REQUEST['search_type'] as $value) {
			$param.='&search_type[]='.$value;
		}
	}
	
	if(isset($_REQUEST['search_prod_status']) && count($_REQUEST['search_prod_status'])>0 && count($_REQUEST['search_prod_status'])<4) {
		$status_array = array();
		foreach($_REQUEST['search_prod_status'] as $stat) {
			$status_array[] = "'".$stat."'";
		}
		$status_l	= implode(",", $status_array);
		$query_search.=" AND printorders.prod_status IN ({$status_l})";
		
		foreach($_REQUEST['search_prod_status'] as $value) {
			$param.='&search_prod_status[]='.$value;
		}
	}
	
	$query_search.= ' ORDER BY id DESC';
	$query_search.=" LIMIT $start,$per_page";
	
	$result = mysql_query($query_search);
	$count = mysql_num_rows($result);
	$pages = ceil($count/$per_page);

?>

<form action="printorder_add_admin.php" enctype="multipart/form-data" method="post" name="addprintorder">
<input type="hidden" name="addprintorderinfo" value="1">
<table>
	<tr>
		<td width="336">&nbsp;</td>
	</tr>

	<tr bgcolor="#D8D7E3">
		<td class="fieltable" width="30%" style="height: 25px;"><strong>Customer</strong></td>
		<td class="fieltable"><strong>Company</strong></td>
		<td class="fieltable"><strong>Date</strong></td>
        <td class="fieltable"><strong>Order Date</strong></td>
		<td class="fieltable"><strong>Print Order Number</strong></td>
		<td class="fieltable" width="220"><strong>Operations</strong></td>
		<td class="fieltable" width=""><strong>Type</strong></td>
		<td class="fieltable" width=""><strong>Prod Status</strong></td>
	</tr>
	<?php 
	$bgcolor = "WHITE";
	while ($printorder = mysql_fetch_assoc($result)) {
		/*if($printorder["status"]){	
			$bgcolor = "#D8D8D8";
		}else{
			$bgcolor = "WHITE";
		}*/
	?>
	<tr bgcolor="<?php echo $bgcolor; ?>">
		<td width="30%" style="height: 25px;"><a href="customer_view_admin.php?customerid=<?php echo $printorder["custid"]; ?>"><?php echo $printorder["firstname"]." ".$printorder["lastname"]; ?></a></td>
		<td><a href="printorder_view_admin.php?customerid=<?php echo $printorder["custid"]; ?>&orderid=<?php echo $printorder["id"]; ?>"><?php echo $printorder['companyname']?></a></td>
		<td><a href="printorder_view_admin.php?customerid=<?php echo $printorder["custid"]; ?>&orderid=<?php echo $printorder["id"]; ?>"><?php echo $printorder["timestamp"]; ?></a></td>
        <td><a href="printorder_view_admin.php?customerid=<?php echo $printorder["custid"]; ?>&orderid=<?php echo $printorder["id"]; ?>"><?php echo $printorder["created_time"]; ?></a></td>
		<td align="center"><font color="#FF0000"><strong><?php echo $printorder["id"]; ?></strong></font></td>
		<td><a href="printorder_view_admin.php?delid=<?php echo $printorder["id"]; ?>" onClick="javascript:return confirm('Are you sure you want to delete this print order?')">[X]</a> | <?php if ($printorder["status"]) { ?><a href="printorder_view_admin.php?status=0&norderid=<?php echo $printorder["id"]; ?>" style="color:green;">complete</a><?php } else { ?><a href="printorder_view_admin.php?status=1&norderid=<?php echo $printorder["id"]; ?>" style="color:red;">incomplete</a><?php } ?> | <a href="p-receipt.php?rid=<?php echo $printorder["id"]; ?>" target="_blank">receipt</a>  | <a href="printorder_view_admin.php?priority=<?php echo $printorder["priority"]?>&norderid=<?php echo $printorder["id"]; ?>" style="color: <?php echo $bgcolor_p?>">Priority</a></td>
		<td value="<?php echo $printorder['id'];?>">
			<select class="printorder_type">
				<?php foreach($type_list as $key=>$type) {?>
					<option value="<?php echo $key?>" <?php echo $key==$printorder['type']?"selected":"";?>><?php echo $type;?></option>
				<?php }?>
			</select>
		</td>
		<td value="<?php echo $printorder['id'];?>">
			<select class="prod_status">
				<?php foreach($status_list as $key=>$status) {?>
					<option value="<?php echo $key?>" <?php echo $key==$printorder['prod_status']?"selected":"";?>><?php echo $status;?></option>
				<?php }?>
			</select>
		</td>
	</tr>
	<?php 
		if ($bgcolor == "WHITE")
		{
			$bgcolor = "#D8D8D8";
		} else {
			$bgcolor = "WHITE";
		}
	}  ?>

</table>
</form>
<script>
	$(document).ready(function(){
		$('.printorder_type').change(function(){
			var type 	= $(this).val();
			var id		= $(this).parent().attr('value');
			$.post(
				"<?php echo $base_url?>/admin/change_printorder_type.php",
				{id: id, type: type, option: 'change_type'},
				function(data){
					window.location.href="<?php echo $base_url?>/admin/printorder_view_admin.php";
				}
			);
		});
		$('.prod_status').change(function(){
			var status 	= $(this).val();
			var id		= $(this).parent().attr('value');
			$.post(
				"<?php echo $base_url?>/admin/change_printorder_type.php",
				{id: id, status: status, option: 'change_status'},
				function(data){
				}
			);
		});
	});
</script>