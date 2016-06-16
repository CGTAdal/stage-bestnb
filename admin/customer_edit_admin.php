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
// get list user for assign sales
$sql_user  = "SELECT * FROM users ORDER BY username ASC";
$result_user 	= mysql_query($sql_user);		
$arr_user  = array();
if($result_user){
	while($row_user = mysql_fetch_assoc($result_user)){
		$arr_user[] = $row_user;
	}
}
// end get saler
if ($_POST["addcustinfo"]) 
{
	
		unset($_POST["addcustinfo"]);
		$where = "id = ".$_POST["customerid"];
		unset($_POST["customerid"]);
		modify_record("customers", $_POST, $where);
		$msg = "<font color='green'>User Updated</font><br>";
		unset($_POST);?>
		<script language="javascript">
		parent.parent.location.href = "customer_view_admin.php";
		window.close();
		</script>
	<?php 
}

if ($_REQUEST["customerid"])
{
	$custid = $_REQUEST["customerid"];
}
if ($_POST["customerid"])
{
	$custid = $POST["customerid"];
}


$qry = "SELECT customers.* FROM customers WHERE id = ".$_REQUEST["customerid"]." ORDER BY timestamp";
$customers = mysql_query($qry) or die('Query failed: ' . mysql_error()); 
$customer = mysql_fetch_assoc($customers);

$_POST = $customer;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Edit Customers</title>
<?php include("init_top.php");?>
<link href="<?php echo $base_url?>/admin/includes/cms.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
    var GB_ROOT_DIR = "greybox/";
</script>


<script type="text/javascript" src="<?php echo $base_url?>/admin/greybox/AJS.js"></script>
<script type="text/javascript" src="<?php echo $base_url?>/admin/greybox/AJS_fx.js"></script>
<script type="text/javascript" src="<?php echo $base_url?>/admin/greybox/gb_scripts.js"></script>
<link href="<?php echo $base_url?>/admin/greybox/gb_styles.css" rel="stylesheet" type="text/css" />
<style>

.resize
{
	width:150px;
	height:auto;
}
</style>
</head>

<body>
<div class="xfluid" style="width: 95%;margin-left: 2.50%;">
<div style="min-height: 300px;" class="portlet x12">
	<div class="portlet-header"><h4>Edit Customer</h4></div>			
		<div class="portlet-content" >
		
<form action="customer_edit_admin.php" enctype="multipart/form-data" method="post" name="addcustomer">
<input type="hidden" name="addcustinfo" value="1">
<input type="hidden" name="customerid" value="<?php echo $custid; ?>">
<?php /*
<table width="100%" frame="box" border="0">
	<tr>
		<td ><img src="images/generic_logo.gif" /></td>
	</tr>
	<tr>
		<td colspan="2"><hr /></td>
	</tr>
</table>
*/?>

<table width="100%" frame="box" border="0">
	<?php if ($msg) { ?>
	<tr>
		<td>&nbsp;</td>
		<td><font size="1"><?php echo $msg; ?></font></td>
	</tr>
	<?php } ?>
	<tr>
		<td align="right"><strong>UserName:</strong></td>
		<td><strong><?php echo $_POST["username"]; ?></strong></td>
	</tr>
     <tr>
        <td align="right"><strong>Assign To Salesperson</strong></td>
        <td>            
            <select id="sale_id" name="sale_id">
				<?php 
					foreach($arr_user as $user){		
						if($user['id'] == $_POST['sale_id']){
							$sl = 'selected="selected"';
						}else{
							$sl = '';
						}
						?>
						<option value="<?php echo $user['id']?>" <?php echo $sl;?>><?php echo $user['username']?></option>
				<?php
					}
				?>	
			 </select> 
        </td>
    </tr>
	<tr>
		<td align="right"><strong>First Name:</strong></td>
		<td><input type="text" name="firstname" value="<?php echo $_POST["firstname"]; ?>" /></td>
	</tr>
	<tr>
		<td align="right"><strong>Last Name:</strong></td>
		<td><input type="text" name="lastname" value="<?php echo $_POST["lastname"]; ?>" /></td>
	</tr>
	<tr>
		<td align="right"><strong>Company Name:</strong></td>
		<td><input type="text" name="companyname" value="<?php echo $_POST["companyname"]; ?>" /></td>
	</tr>
	<tr>
		<td align="right"><strong>Password:</strong></td>
		<td><strong><?php echo $_POST["password"]; ?></strong>&nbsp;&nbsp;<a href="admin_change_customer_password.php?id=<?php echo $_POST["id"]; ?>&edit=1" title="Change Password" rel="gb_page_center[300, 150]">Change Password</a></td>
	</tr>
	<tr>
		<td align="right"><strong>Email:</strong></td>
		<td><input type="text" name="email" value="<?php echo $_POST["email"]; ?>" /></td>
	</tr>
	<tr>
	<tr>
		<td align="right"><strong>Inventory:</strong></td>
		<td><input type="text" name="inventory" value="<?php echo $_POST["inventory"]; ?>" /></td>
	</tr>
	<tr>
		<td align="right"><strong>Frame Inventory:</strong></td>
		<td><input type="text" name="finventory" value="<?php echo $_POST["finventory"]; ?>" /></td>
	</tr>
	<tr>
		<td align="right"><strong>Dome Inventory:</strong></td>
		<td><input type="text" name="dminventory" value="<?php echo $_POST["dminventory"]; ?>" /></td>
	</tr>
	<tr>
		<td align="right"><strong>Street:</strong></td>
		<td><input type="text" name="street" value="<?php echo $_POST["street"]; ?>" /></td>
	</tr>
	<tr>
		<td align="right"><strong>Street 2:</strong></td>
		<td><input type="text" name="street2" value="<?php echo $_POST["street2"]; ?>" /></td>
	</tr>
	<tr>
		<td align="right"><strong>City:</strong></td>
		<td><input type="text" name="city" value="<?php echo $_POST["city"]; ?>" /></td>
	</tr>
	<tr>
		<td align="right"><strong>State:</strong></td>
		<td><input type="text" name="state" value="<?php echo $_POST["state"]; ?>" /></td>
	</tr>
	<tr>
		<td align="right"><strong>Zip:</strong></td>
		<td><input type="text" name="zip" value="<?php echo $_POST["zip"]; ?>" /></td>
	</tr>
	<tr>
		<td align="right"><strong>Phone:</strong></td>
		<td><input type="text" name="phone" value="<?php echo $_POST["phone"]; ?>" /></td>
	</tr>


	<tr>
		<td colspan="2">&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td><input  class="btn btn-small" type="submit" value="Modify Customer" /></td>
	</tr>
</table>
</form>
</div>
</div>
</div>
<hr />
</body>
</html>
