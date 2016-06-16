<?php 
require_once('conn/DB.php');
include('conn/tablefuncs.php');
include('../include/config.php');
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
if(isset($_REQUEST['customer_name'])){
	//$_SESSION['customer_name']  = trim($_REQUEST['customer_name']);
	//$customer_name = $_SESSION['customer_name'];
	$query_search.=" AND (customers.firstname like '%".$_REQUEST['customer_name']."%' OR customers.lastname like '%".$_REQUEST['customer_name']."%')";
	//$param.='&customer_name='.urlencode($customer_name);
}
/*else {
	$_SESSION['customer_name']  = $_SESSION['customer_name'] ; 
	$query_search.=" AND (customers.firstname like '%".$_SESSION['customer_name']."%' OR customers.lastname like '%".$_SESSION['customer_name']."%')";
}*/
if(isset($_REQUEST['date'])){
		//$_SESSION['date']  = trim($_REQUEST['date']);
		//$data = $_SESSION['date'];
		$query_search.=" AND order_wizard.created_date like '%".trim($_REQUEST['date'])."%'";
		//$param.='&date='.$date;
	}
	/*else{
		$_SESSION['date'] = $_SESSION['date'];
		$query_search.=" AND order_wizard.created_date like '%".$_SESSION['date']."%'";
	}*/
if(isset($_REQUEST['pre_sale_number'])){
		//$_SESSION['pre_sale_number'] = trim($_REQUEST['pre_sale_number']);
		//$print_order_number = $_SESSION['print_order_number'];
		$query_search.=" AND  order_wizard.id like '%".trim($_REQUEST['pre_sale_number'])."%'";
		//$param.='&print_order_number='.urlencode($print_order_number);
	}
	/*else{
		$_SESSION['pre_sale_number'] = $_SESSION['pre_sale_number'];
		$query_search.=" AND  order_wizard.id like '%".$_SESSION['pre_sale_number']."%'";
	}*/
	if(isset($_REQUEST['company_name'])){
		//$_SESSION['company_name'] = trim($_REQUEST['company_name']);
		//$company_name = $_SESSION['company_name'];
		$query_search.=" AND  customers.companyname like '%".trim($_REQUEST['company_name'])."%'";
		//$param.='&company_name='.urlencode($company_name);
	}
	/*else{
		$_SESSION['company_name'] = $_SESSION['company_name'];
		$query_search.=" AND  customers.companyname like '%".$_SESSION['company_name']."%'";
	}*/
	if(!isset($_SESSION['sort_status'])){
    $_SESSION['sort_status'] = 'all';
}
if(isset($_REQUEST['sort_status'])){
    $_SESSION['sort_status'] = trim($_REQUEST['sort_status']);
}else{
	$_SESSION['sort_status'] = $_SESSION['sort_status'];
}

if(!isset($_SESSION['sale_id'])){
	//$_SESSION['sale_id'] = $_SESSION["loginid"];
	$_SESSION['sale_id'] = '0';
}else {
	$_SESSION['sale_id'] = $_REQUEST['userid'];
}	
	
$rec_limit =100;
$where  = '';
if($_SESSION['sale_id']!='0'){
	$where = " AND order_wizard.sale_id ='".$_SESSION['sale_id']."'";
}
if(isset($_REQUEST['sort_status']) && $_REQUEST['sort_status']!='all'){
	$where .= " AND order_wizard.status	 ='".$_REQUEST['sort_status']."'";
}

// calc count of pre sale order
$sql_count = "SELECT count(order_wizard.id) as total
			FROM order_wizard 
			LEFT JOIN customers ON (customers.id = order_wizard.customer_id)			
			WHERE 1=1
			{$where}
			{$query_search}";
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
<?php include("init_top.php");?>
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
<?php
if(isset($_REQUEST['action']) && $_REQUEST['action']== 'del'){
	$presale_id  = $_REQUEST['prs_id'];
	// delete a presale
	$sql_del_pre = 'DELETE * FROM order_wizard WHERE id='.$presale_id;
	mysql_query($sql_del_pre);
	// delete all things of a presale
	
} 
?>
<div id="content" class="xfluid">
<div style="min-height: 300px;" class="portlet x12">
	<div class="portlet-header"><h4>View Pre Sales Proof</h4></div>			
		<div class="portlet-content" >
		
<form action="" enctype="multipart/form-data" method="post" name="pre_sale">
	<div style="float:right;width: 100%;">
		<table class="search-box-tabletype">
			<tbody>
				<tr>
					<td colspan="9"><h3>Search form</h3></td>
				</tr>
				<tr>                                            
					<td>Customer Name</td>
					<td align="left">
						<input type="text" value="<?php if(isset($_REQUEST['customer_name'])){ echo $_REQUEST['customer_name']; }?>" name="customer_name" />
					</td>
					<td>Company Name</td>
					<td align="left"><input type="text" value="<?php if(isset($_REQUEST['company_name'])){ echo $_REQUEST['company_name']; }?>" id="company_name" name="company_name" /></td>
				</tr>
				<tr>                                            
					<td>Order #</td>
					<td align="left">
						<input type="text" value="<?php if(isset($_REQUEST['pre_sale_number'])){ echo $_REQUEST['pre_sale_number']; }?>" name="pre_sale_number" />
					</td>
					<td>Date</td>
					<td align="left"><input type="text" value="<?php if(isset($_REQUEST['date'])){ echo $_REQUEST['date']; }?>" id="date" name="date" /></td>
				</tr>
				<tr>
					<td><input type="submit" value="Search" name="search" /></td>
				</tr>
			</tbody>
		</table>
		<div style="float:right;font-size:12px">
			Sale Person: 
			<select  name="userid" onchange="document.pre_sale.submit();" id="user_id" onchange="document.filterform.submit();">
                <option value="0"></option>
                <?php 
	                foreach($arr_user as $user){
	                	$sl = ($_SESSION['sale_id'] == $user['id'])?'selected="selected"':'';		
                ?>
                		<option value="<?php echo $user['id']?>" <?php echo $sl;?>><?php echo $user['username']?></option>
                <?php
                	}
                ?>	
            </select>
            Status:
            <select onChange="document.pre_sale.submit();" name="sort_status">
				<option <?php echo (isset($_REQUEST['sort_status']) && $_REQUEST['sort_status']=='all')?'selected="selected"':""?> value="all">All</option>
				<option <?php echo (isset($_REQUEST['sort_status']) && $_REQUEST['sort_status']=='new')?'selected="selected"':""?>  value="new">New</option>
            	<option <?php echo (isset($_REQUEST['sort_status']) && $_REQUEST['sort_status']=='sent')?'selected="selected"':""?>  value="sent">Sent</option>
            	<option <?php echo (isset($_REQUEST['sort_status']) && $_REQUEST['sort_status']=='waiting')?'selected="selected"':""?>  value="waiting">Waiting</option>
            	<option <?php echo (isset($_REQUEST['sort_status']) && $_REQUEST['sort_status']=='complete')?'selected="selected"':""?>  value="complete">Complete</option>
			</select>
		</div>
	</div>
	<div style="clear: both;"></div>
	<div style="margin-top: 5px;">
		<table width="800" frame="box" border="0" align="center">
			<tr bgcolor="#D8D7E3">
				<td width="30%" style="height: 25px;" class="fieltable"><strong>Customer</strong></td>
				<td algin="center" class="fieltable"><strong>Company</strong></td>
				<td algin="center" class="fieltable"><strong>ORDER Date</strong></td>
				<td algin="center" class="fieltable"><strong>Order #</strong></td>
				<td class="fieltable"><strong>Product</strong></td>
				<td width="250" algin="center" class="fieltable"><strong>Operations</strong></td>
				<td class="fieltable">Quantity</td>
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
					<select id="user_id" name="user_id" onChange="update_sale(this.value,'<?php echo $row['id']?>');">
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
		          <!--<a href="pre_sales_proof.php?id=<?php echo $row['id'];?>&del_pre_sale=1" onClick="javascript:return confirm('Are you sure you wish to delete?')">[X]</a>-->
		            <select name="status" onChange="update_status(this.value,'<?php echo $row['id'];?>')">
		            	<option value="all">All</option>
		            	<option <?php echo ($row['status']=='new')?'selected="selected"':''?> value="new">New</option>
		            	<option <?php echo ($row['status']=='sent')?'selected="selected"':''?> value="sent">Sent</option>
		            	<option <?php echo ($row['status']=='waiting')?'selected="selected"':''?> value="waiting">Waiting</option>
		            	<option <?php echo ($row['status']=='complete')?'selected="selected"':''?> value="complete">Complete</option>
		            </select>
				</td>
				<td><?php echo ($row['num_baged']>0)?$row['num_baged']:'0'?></td>
			</tr>
			<?php } ?>
		</table>
	</div>
<div>
	<?php		
		doPages($rec_limit ,'/admin/pre_sales_proof.php','',$rec_count);			
	?>
</div>
</form>	
</div>
</div>
</div>
</div>
	<script type="text/javascript">
		Calendar.setup({
			inputField  : "date",         // ID of the input field
			ifFormat    : "%m/%d/%Y",    // the date format
		});
	</script>
</body>
</html>