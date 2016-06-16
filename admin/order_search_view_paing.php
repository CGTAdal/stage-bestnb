<?php 
require_once('conn/DB.php');
include('conn/tablefuncs.php');
include('../include/config.php');
mysql_select_db($database_DB, $ravcodb);
session_start();
//if (!$_SESSION["loginid"] || $_SESSION["userlevel"] < 2) - 11052013 - ha.pham - https://www.assembla.com/spaces/bestnamebadges-com/tickets/272#/activity/ticket:
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

$query_search = "SELECT orders.*, customers.firstname, customers.lastname, custstyle.stylename, custstyle.id AS custstyleid FROM orders LEFT JOIN customers ON (customers.id = orders.customerid) LEFT JOIN custstyle ON (custstyle.id = orders.styleid) WHERE 1=1";
	$param = '';
	if(isset($_REQUEST['customer_name']) && trim($_REQUEST['customer_name'])!=''){
		$customer_name  = trim($_REQUEST['customer_name']);
		$query_search.=" AND (customers.firstname like '%$customer_name%' OR customers.lastname like '%$customer_name%') ";
		$param.='&customer_name='.urlencode($customer_name);
	}
	if(isset($_REQUEST['date']) && trim($_REQUEST['date'])!=''){
		$date  = trim($_REQUEST['date']);
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
	$query_search.=" LIMIT $start,$per_page";
	$orders = mysql_query($query_search);
	$count = mysql_num_rows($orders);
	$pages = ceil($count/$per_page);

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
<table>
<?php /*
	<tr>
		<td width="55" colspan="1">&nbsp;</td>
		<td colspan="6" align="right" valign="bottom"><h3>View Orders</h3></td>
	</tr>
*/?>
	<tr bgcolor="#D8D7E3">
		<td class="fieltable"><strong>Order#</strong></td>
		<td class="fieltable" width=""><strong>Customer</strong></td>
		<td class="fieltable" width=""><strong>Date</strong></td>
		<td class="fieltable" width=""><strong>Qty</strong></td>
		<td class="fieltable" width=""><strong>Style</strong></td>
		<td class="fieltable" width=""><strong>Price</strong></td>
		<td class="fieltable" width=""><strong>Action</strong></td>
	</tr>
	<?php 
	$bgcolor = "WHITE";
	 while ($order = mysql_fetch_assoc($orders)){ ?>
	<tr bgcolor="<?php echo $bgcolor; ?>">
		<td><?php echo $order["id"]; ?></td>
		<td><a href="customer_view_admin.php?customerid=<?php echo $order["customerid"]; ?>"><?php echo $order["firstname"]." ".$order["lastname"]; ?></a></td>
		<td><?php echo $order["timestamp"]; ?></td>
		<td><?php echo $order["qty"]; ?></td>
		<td><?php if ($order["stylename"]){ ?>
        			<a onclick="return GB_showCenter('Customer style', this.href,800,1100)" href="custstyle_viewentry_admin.php?styleid=<?php echo $order["custstyleid"];?>"><?php echo $order["stylename"]; ?></a>
		<?php } else {echo "Inventory Only"; } ?></td>
		<td><?php echo "$".money_format('%(#8.2n', $order["totalprice"]); ?></td>
		<td><a href="order_edit_admin.php?orderid=<?php echo $order["id"]; ?>" onclick="return GB_showCenter('Edit Order', this.href,600,850)">edit</a></a> | <a href="order_view_admin.php?delid=<?php echo $order["id"]; ?>" onClick="javascript:return confirm('Are you sure you want to delete this order?')">[X]</a> | <?php if ($order["status"]) { ?><a href="order_view_admin.php?status=0&orderid=<?php echo $order["id"]; ?>" style="color:green;">complete</a><?php } else { ?><a href="order_view_admin.php?status=1&orderid=<?php echo $order["id"]; ?>" style="color:red;">incomplete</a><?php } ?> | <a href="receipt.php?rid=<?php echo $order["id"]; ?>" target="_blank">receipt</a></td>
	</tr>
	<?php 
	if ($bgcolor == "WHITE")
	{
		$bgcolor = "#D8D8D8";
	} else {
		$bgcolor = "WHITE";
	}
	} ?>
</table>
</form>