<?php 
require_once('conn/DB.php');
include('conn/tablefuncs.php');
include('../include/config.php');
mysql_select_db($database_DB, $ravcodb);
session_start();
$per_page = 150; 

if($_GET)
{

	$page=$_GET['page'];
}



$start = ($page-1)*$per_page;

$sql = "SELECT orders.*, customers.firstname, customers.lastname, custstyle.stylename, custstyle.id AS custstyleid FROM orders LEFT JOIN customers ON (customers.id = orders.customerid) LEFT JOIN custstyle ON (custstyle.id = orders.styleid) ORDER BY orders.id DESC LIMIT $start,$per_page";
$orders = mysql_query($sql);
//echo $sql;
?>
<script type="text/javascript">
    var GB_ROOT_DIR = "greybox/";
</script>
<script type="text/javascript" src="<?php echo $base_url?>/admin/greybox/AJS.js"></script>
<script type="text/javascript" src="<?php echo $base_url?>/admin/greybox/AJS_fx.js"></script>
<script type="text/javascript" src="<?php echo $base_url?>/admin/greybox/gb_scripts.js"></script>
<link href="<?php echo $base_url?>/admin/greybox/gb_styles.css" rel="stylesheet" type="text/css" />

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
			if ($bgcolor == "WHITE")
			{
				$bgcolor = "#D8D8D8";
			} else {
				$bgcolor = "WHITE";
			}
     if(!empty($order)){       
     
	?>
	<tr bgcolor="<?php echo $bgcolor; ?>">
		<td><?php echo $order["id"]; ?></td>
		<td><a  href="customer_view_admin.php?customerid=<?php echo $order["customerid"]; ?>"><?php echo $order["firstname"]." ".$order["lastname"]; ?></a></td>
		<td><?php echo $order["timestamp"]; ?></td>
		<td><?php echo $order["qty"]; ?></td>
		<td>
			<?php if ($order["stylename"]){ ?>
        		<a onclick="return GB_showCenter('Customer style', this.href,800,1100)" href="custstyle_viewentry_admin.php?styleid=<?php echo $order["custstyleid"];?>">
        			<?php echo $order["stylename"]; ?>
        		</a>
			<?php } else {echo "Inventory Only"; } ?>
		</td>
		<td>
			<?php echo "$".money_format('%(#8.2n', $order["totalprice"]); ?>
		</td>
		<td>
			<?php if($_SESSION['userlevel'] > 1) {?>
				<a href="order_edit_admin.php?orderid=<?php echo $order["id"]; ?>" onclick="return GB_showCenter('Edit Order', this.href,600,850)">edit</a> | 
				<a href="order_view_admin.php?delid=<?php echo $order["id"]; ?>" onClick="javascript:return confirm('Are you sure you want to delete this order?')">[X]</a> | 
			<?php }?>
			<?php if ($order["status"]) { ?>
				<a href="order_view_admin.php?status=0&orderid=<?php echo $order["id"]; ?>" style="color:green;">complete</a>
			<?php } else { ?>
				<a href="order_view_admin.php?status=1&orderid=<?php echo $order["id"]; ?>" style="color:red;">incomplete</a>
			<?php } ?> | 
			<?php if($order['invoice_id']==0){?>
                <a href="receipt.php?rid=<?php echo $order["id"]; ?>" target="_blank">receipt</a>
			<?php }else {?>
				<a href="invoice_receipt_admin.php?rid=<?php echo $order["id"]; ?>" target="_blank">receipt</a>
			<?php }?>
		</td>
	</tr>
	<?php 
     }
	} while ($order = mysql_fetch_assoc($orders))  ?>
</table>
</form>
