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

$per_page = 150; 

if($_GET)
{

	$page=$_GET['page'];
}



$start = ($page-1)*$per_page;

/*$sql = "SELECT printorders.*, customers.id AS custid, customers.firstname AS firstname, customers.lastname AS lastname, customers.companyname AS companyname, customers.street, customers.street2, customers.city, customers.state, customers.zip AS zipcode, customers.email, customers.phone FROM printorders LEFT JOIN customers ON (customers.id = printorders.custid) WHERE printorders.paid = 1 
AND new_old  = 'new'
ORDER BY priority DESC,id DESC LIMIT $start,$per_page";*/
$sql = "SELECT printorders.*, customers.id AS custid, customers.firstname AS firstname, customers.lastname AS lastname, customers.companyname AS companyname, customers.street, customers.street2, customers.city, customers.state, customers.zip AS zipcode, customers.email, customers.phone FROM printorders LEFT JOIN customers ON (customers.id = printorders.custid) WHERE new_old  = 'new'
		ORDER BY priority DESC,id DESC LIMIT $start,$per_page";
$result = mysql_query($sql);

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
?>

<form action="printorder_add_admin.php" enctype="multipart/form-data" method="post" name="addprintorder">
<input type="hidden" name="addprintorderinfo" value="1">
<table width="800" frame="box" border="0" align="center">
	<tr bgcolor="#D8D7E3">
		<td class="fieltable" width="30%" style="height: 25px;"><strong>Customer</strong></td>
		<td class="fieltable" ><strong>Company</strong></td>
		<td class="fieltable" ><strong>Date</strong></td>
        <td class="fieltable" ><strong>Order Date</strong></td>
		<td class="fieltable"><strong>Print Order Number</strong></td>
		<td class="fieltable" width="250"><strong>Operations</strong></td>
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
	if($printorder["priority"] == 1){
		$bgcolor_p = 'red';
	}else{
		$bgcolor_p = 'black';
	}
    
	?>
	<tr bgcolor="<?php echo $bgcolor; ?>">
		<td width="30%" style="height: 25px;"><a href="customer_view_admin.php?customerid=<?php echo $printorder["custid"]; ?>"><?php echo $printorder["firstname"]." ".$printorder["lastname"]; ?></a></td>
		
        
        <td>
            <a href="printorder_view_admin.php?customerid=<?php echo $printorder["custid"]; ?>&orderid=<?php echo $printorder["id"]; ?>"><?php echo $printorder['companyname']?></a>
        </td> 
        <td>
                <a href="printorder_view_admin.php?customerid=<?php echo $printorder["custid"]; ?>&orderid=<?php echo $printorder["id"]; ?>"><?php echo $printorder["timestamp"]; ?></a>
        </td>
        <td>
            <a href="printorder_view_admin.php?customerid=<?php echo $printorder["custid"]; ?>&orderid=<?php echo $printorder["id"]; ?>"><?php echo $printorder["created_time"]; ?></a>
        </td>
		<td align="center"><font color="#FF0000"><strong><?php echo $printorder["id"]; ?></strong></font></td>
		<td><a href="printorder_view_admin.php?delid=<?php echo $printorder["id"]; ?>" onClick="javascript:return confirm('Are you sure you want to delete this print order?')">[X]</a> | <a href="printorder_view_admin.php?proof_prod=0&norderid=<?php echo $printorder["id"]; ?>" style="color:green;">Proof</a> | <a href="printorder_view_admin.php?proof_prod=1&norderid=<?php echo $printorder["id"]; ?>" style="color:red;">Prod</a> | <a href="p-receipt.php?rid=<?php echo $printorder["id"]; ?>" target="_blank">receipt</a> | <a href="printorder_view_admin.php?priority=<?php echo $printorder["priority"]?>&norderid=<?php echo $printorder["id"]; ?>" style="color: <?php echo $bgcolor_p?>">Priority</a></td>
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
		
	}
	?>

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