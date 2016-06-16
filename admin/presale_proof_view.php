<?php 
require_once('conn/DB.php');
include('conn/tablefuncs.php');
mysql_select_db($database_DB, $ravcodb);
session_start();
include('permision.php');
if ($_REQUEST["logout"])
{
	unset($_SESSION["loginid"]);
	unset($_SESSION["userlevel"]);
	unset($_SESSION["username"]);
}
if (!$_SESSION["loginid"] )
{
	header("location: login.php");
}

// get list user to filter by user:
$sql_user  = "SELECT * FROM users ORDER BY username ASC";
$result_user 	= mysql_query($sql_user);		
$arr_user  = array();
if($result_user){
	while($row_user = mysql_fetch_assoc($result_user)){
		$arr_user[] = $row_user;
	}
}
if($_REQUEST['del_pre_sale']){
	$id = $_REQUEST['id'];
	$sql_del =  "DELETE FROM order_wizard WHERE id=".$id;
	mysql_query($sql_del);
?>
	<script language="javascript">
        parent.parent.location.href='pre_sales_proof.php';
        window.close();
    </script>
<?php 
}

function doPages($page_size, $thepage, $query_string, $total=0) {
	    //per page count
	    $index_limit = 10;

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



// get all pre sale


if(isset($_REQUEST['sort_status'])){
    $_SESSION['sort_status'] = trim($_REQUEST['sort_status']);
}else{
	$_SESSION['sort_status'] = $_SESSION['sort_status'];
}

if(!isset($_SESSION['sale_id'])){
	$_SESSION['sale_id'] = 0;
}else {
	$_SESSION['sale_id'] = $_REQUEST['userid'];
}	
	
$rec_limit =100;
$where  = '';
if($_SESSION['sale_id']!='0'){
	$where = " AND order_wizard.sale_id ='".$_SESSION['sale_id']."'";
}
if($_SESSION['sort_status']!='all'){
	$where .= " AND order_wizard.status	 ='".$_SESSION['sort_status']."'";
}

// calc count of pre sale order
$sql_count = "SELECT count(order_wizard.id) as total
			FROM order_wizard 
			LEFT JOIN customers ON (customers.id = order_wizard.customer_id)			
			WHERE 1=1
			{$where}
			{$query_search}
			 AND customer_id = '".$_REQUEST['customerid']."'";
$retval_count = mysql_query($sql_count);

if(!$retval_count )
{
  die('Could not get data: ' . mysql_error());
}
$row = mysql_fetch_assoc($retval_count);

$rec_count = $row['total'];

// end of calc count     
// get list with limit record

$page = $_GET['page'];//curent page
if ($page == "")  $page=1;
$start = ($page-1)*$rec_limit;
$total_page = ceil($rec_count/$rec_limit);
//echo $total_page.'AAA';
$left_rec = $rec_count - ($page*$rec_limit);
$sql_pre_order = "SELECT order_wizard.*, customers.firstname, customers.lastname,customers.companyname,customers.sale_id as cutomer_sale_id
			FROM order_wizard 
			LEFT JOIN customers ON (customers.id = order_wizard.customer_id)			
			WHERE 1=1
			AND customer_id = '".$_REQUEST['customerid']."'
			$where
			{$query_search}
			ORDER BY order_wizard.id DESC 
			LIMIT $start,$rec_limit";		
$result = mysql_query($sql_pre_order);
//echo $sql_pre_order;

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Best Name Badges - Content Management System</title>
<link href="includes/cms.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" media="all" href="<?php echo $base_url;?>/admin/calendar/calendar-win2k-1.css" title="win2k-1" />

<script type="text/javascript" src="<?php echo $base_url;?>/admin/scripts/jquery-1.3.2.min.js"></script>
<!-- main calendar program -->
<script type="text/javascript" src="<?php echo $base_url;?>/admin/calendar/calendar.js"></script>

<!-- language for the calendar -->
<script type="text/javascript" src="<?php echo $base_url;?>/admin/calendar/lang/calendar-en.js"></script>

<!-- the following script defines the Calendar.setup helper function, which makes
     adding a calendar a matter of 1 or 2 lines of code. -->
<script type="text/javascript" src="<?php echo $base_url;?>/admin/calendar/calendar-setup.js"></script>

<script type="text/javascript">
    var GB_ROOT_DIR = "greybox/";
	function update_status(status,id)
	{
		$.ajax({
			url:'<?php echo $base_url;?>/admin/pre_sale_change.php',
			type:'POST',
			data:{
				status: status,
				id: id			
			},
			success: function(){
				
			}
		});
	}


	function update_sale(user_id, pre_sale_id)
	{
		$.ajax({
			url:'<?php echo $base_url;?>/admin/pre_sale_change.php',
			type:'POST',
			data:{
				user_id		: user_id,
				pre_sale_id	: pre_sale_id,
				action  	: 'changesale'			
			},
			success: function(){
				
			}
		});	
	}	
		
</script>


<script type="text/javascript" src="greybox/AJS.js"></script>
<script type="text/javascript" src="greybox/AJS_fx.js"></script>
<script type="text/javascript" src="greybox/gb_scripts.js"></script>
<link href="greybox/gb_styles.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="scripts/jquery-1.3.2.min.js"></script>
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

</head>
<body>
<div align="center">
<?php include("header.php"); ?>
<form action="" enctype="multipart/form-data" method="post" name="pre_sale">

<table width="800" frame="box" border="0" align="center">	 
	<tr>
		<td colspan="4" align="right" valign="bottom"><h4>View Pre Sales Proof</h4></td>
	</tr>
	<tr>
		<td width="336">&nbsp;</td>
	</tr>
	<tr>
		<?php
			$qry = "SELECT customers.id AS custid, customers.firstname AS firstname, customers.lastname AS lastname, customers.companyname AS companyname, customers.street, customers.street2, customers.city, customers.state, customers.zip AS zipcode, customers.email, customers.phone FROM customers
				 WHERE customers.id=".$_REQUEST['customerid'];
			$customer = mysql_query($qry) or die('Query failed: ' . mysql_error()); 
			$customers = mysql_fetch_assoc($customer);
						 
		?>
		<td colspan="1"><a href="customer_view_admin.php?customerid=<?php echo $customers["id"]; ?>"><strong><?php echo $customers["companyname"]."<br>".$customers["firstname"]." ".$customers["lastname"]; ?></strong></a><br /><?php echo $customers["street"]; ?><?php if ($customers["street2"]) { echo "<br>".$customers["street2"]; } ?><br /><?php echo $customers["city"].", ".$customers["state"]." ".$customers["zipcode"]; ?></td>
		<td colspan="5" align="right"><strong><?php echo $customers["email"]."<br>".$customers["phone"]; ?></strong></td>
	</tr>	
	<tr bgcolor="#D8D7E3">
		<td width="30%" style="height: 25px;"><strong>Customer</strong></td>
		<td algin="center"><strong>Company</strong></td>
		<td algin="center"><strong>ORDER Date</strong></td>
		<td algin="center"><strong>Order #</strong></td>
		<td><strong>Product</strong></td>
		<td width="250" algin="center"><strong>Operations</strong></td>
	</tr>
	<?php
	$bgcolor = "WHITE";
	while($row  = mysql_fetch_assoc($result)){   
	?>
	<tr>
		<td>
			<a href="customer_view_admin.php?customerid=<?php echo $row['customer_id'];?>"><?php echo $row['firstname'].' '.$row['lastname'];?></a>
		</td>
		<td>
			<a href="pre_sales_proof_detail.php?pre_id=<?php echo $row['id']?>"><?php echo $row['companyname']?></a>
		</td>
		<td>
			<a href="pre_sales_proof_detail.php?pre_id=<?php echo $row['id']?>"><?php echo $row['created_date'];?></a>
		</td>
		<td>
			<?php echo $row['id'];?>
		</td>
		<td>
			<?php
			echo $row['type'];
			/*if($row['type'] == 'printed') {
				echo 'Printed Badge';
			}else if($row['type'] == 'engraved') {
				echo 'Engraved Badge';
			}else{
				echo 'Reusable Badge';
			}*/
			?>
		</td>
		<td>
			<?php //echo '<pre>'.print_r($row).'</pre>';?>
			<select id="user_id" name="user_id" onchange="update_sale(this.value,'<?php echo $row['id']?>');">
                <option value="0"></option>
                <?php 
                foreach($arr_user as $user){		
                if($row['sale_id'] == $user['id']){
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
            <a href="pre_sales_proof.php?id=<?php echo $row['id'];?>&del_pre_sale=1" onclick="javascript:return confirm('Are you sure you wish to delete?')">[X]</a>
            <select name="status" onchange="update_status(this.value,'<?php echo $row['id'];?>')">
            	<option value="all">All</option>
            	<option <?php echo ($row['status']=='new')?'selected="selected"':''?> value="new">New</option>
            	<option <?php echo ($row['status']=='sent')?'selected="selected"':''?> value="sent">Sent</option>
            	<option <?php echo ($row['status']=='waiting')?'selected="selected"':''?> value="waiting">Waiting</option>
            	<option <?php echo ($row['status']=='complete')?'selected="selected"':''?> value="complete">Complete</option>
            </select>
		</td>
	</tr>
	<?php } ?>
</table>
<div>
	<?php		
		doPages($rec_limit ,'/admin/pre_sales_proof.php','',$rec_count);			
	?>
</div>
</form>	
</div>
</body>
</html>