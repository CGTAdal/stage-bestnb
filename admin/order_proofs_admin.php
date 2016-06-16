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
<?php include("scripts/collapse.js"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Best Name Badges - Content Management System</title>
<?php include("init_top.php");?>
<link href="<?php echo $base_url;?>/admin/includes/cms.css" rel="stylesheet" type="text/css" />

<script type="text/javascript">
    var GB_ROOT_DIR = "greybox/";
</script>


<script type="text/javascript" src="greybox/AJS.js"></script>
<script type="text/javascript" src="greybox/AJS_fx.js"></script>
<script type="text/javascript" src="greybox/gb_scripts.js"></script>
<link href="greybox/gb_styles.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="scripts/jquery-1.3.2.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo $base_url?>/admin/calendar/calendar-win2k-1.css" />
    <!-- main calendar program -->
    <script type="text/javascript" src="<?php echo $base_url?>/admin/calendar/calendar.js"></script>
    <!-- language for the calendar -->
    <script type="text/javascript" src="<?php echo $base_url?>/admin/calendar/lang/calendar-en.js"></script>
    <!-- the following script defines the Calendar.setup helper function, which makes
         adding a calendar a matter of 1 or 2 lines of code. -->
    <script type="text/javascript" src="<?php echo $base_url?>/admin/calendar/calendar-setup.js"></script>
<script>
	$(document).ready(function(){
		$(".proof").each(function(){			
			$(this).change(function(){
					var filter = $('#filter').val();
					//alert(filter);
					var status = $(this).val();
					var id_order = $(this).attr('id');
					$.ajax({
					 url : "save_proof_status.php",
					 type: 'POST',
					 data: {
						id:id_order,
						status: status
					 },
					 success: function (data){
						//alert(data);
						alert('Changed status success!');										
						location.reload(true);							
					 }
				}); 
			});
		})
	});
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
<?php

	if ($_REQUEST["norderid"])
	{		
		if(isset($_REQUEST['priority'])){
			if($_REQUEST['priority'] == 0){
				$data['priority'] = 1;
			}else{
				$data['priority'] = 0;
			}
		}	
		
		$where = "id = ".$_REQUEST["norderid"];
		modify_record("printorders", $data, $where);
	
	
	}

	if($_REQUEST['sent_to_prod']){
		//echo $_REQUEST['sent_to_prod'];
		$data['proof_product'] = 1;
		$where =  "id =".$_REQUEST["sent_to_prod"];		
		modify_record("printorders", $data, $where);		
	}
	if ($_REQUEST["delid"])
	{
		if(check('delete',3)){
			delete_record_secondary("printorders", $_REQUEST["delid"], "id");
			delete_record_secondary("batches", $_REQUEST["delid"], "printorderid");
		}else {
			die('You don\'t have permision to perform this action.');
		}	
	}
	if(!isset($_REQUEST['proof_status'])){
		$proof_status_quyery = 0;
	}
	if(isset($_REQUEST['proof_status'])){
		$proof_status_quyery = trim($_REQUEST['proof_status']);
	}
	//echo $_SESSION['filter_show'].'aa';
?>
</head>
<body>
	<div align="center">
	<?php include("header.php"); ?>
	<?php 
	$rec_limit =30;
	if(isset($_REQUEST['customer_name'])){
		//$_SESSION['customer_name']  = trim($_REQUEST['customer_name']);
		//$customer_name = $_SESSION['customer_name'];
		$query_search.=" AND (firstname like '%".trim($_REQUEST['customer_name'])."%' OR lastname like '%".trim($_REQUEST['customer_name'])."%')";
		//$param.='&customer_name='.urlencode($customer_name);
	}
	/*else {
		$_SESSION['customer_name']  = $_SESSION['customer_name'] ; 
		$query_search.=" AND (firstname like '%".$_SESSION['customer_name']."%' OR lastname like '%".$_SESSION['customer_name']."%')";
	}*/

	if(isset($_REQUEST['date'])){
		$_SESSION['date']  = trim($_REQUEST['date']);
		//$data = $_SESSION['date'];
		$query_search.=" AND printorders.timestamp like '%".trim($_REQUEST['date'])."%'";
		//$param.='&date='.$date;
	}
    if(isset($_REQUEST['created_date'])){
        $_SESSION['created_date']  = trim($_REQUEST['created_date']);
        //$data = $_SESSION['date'];
        $query_search.=" AND printorders.created_time like '%".trim($_REQUEST['created_date'])."%'";
        //$param.='&date='.$date;
    }
	/*else{
		$_SESSION['date'] = $_SESSION['date'];
		$query_search.=" AND printorders.timestamp like '%".$_SESSION['date']."%'";
	}*/
	if(isset($_REQUEST['print_order_number'])){
		//$_SESSION['print_order_number'] = trim($_REQUEST['print_order_number']);
		//$print_order_number = $_SESSION['print_order_number'];
		$query_search.=" AND  printorders.id like '%".trim($_REQUEST['print_order_number'])."%'";
		//$param.='&print_order_number='.urlencode($print_order_number);
	}
	/*else{
		$_SESSION['print_order_number'] = $_SESSION['print_order_number'];
		$query_search.=" AND  printorders.id like '%".$_SESSION['print_order_number']."%'";
	}*/
	if(isset($_REQUEST['company_name'])){
		//$_SESSION['company_name'] = trim($_REQUEST['company_name']);
		//$company_name = $_SESSION['company_name'];
		$query_search.=" AND  customers.companyname like '%".trim($_REQUEST['company_name'])."%'";
		//$param.='&company_name='.urlencode($company_name);
	}
	
	if(isset($_REQUEST['search_type']) && count($_REQUEST['search_type']) < 7 && count($_REQUEST['search_type']) > 0) {
		$types			= implode(",", $_REQUEST['search_type']);
		$query_search	.=" AND  printorders.type IN ($types)";		
	}
	
	if(isset($_REQUEST['search_prod_status']) && count($_REQUEST['search_prod_status']) < 4 && count($_REQUEST['search_prod_status']) > 0) {
		$status_array = array();
		foreach($_REQUEST['search_prod_status'] as $stat) {
			$status_array[] = "'".$stat."'";
		}
		$status_l	= implode(",", $status_array);
		$query_search.=" AND printorders.prod_status IN ({$status_l})";
	}
	
	/*else{
		$_SESSION['company_name'] = $_SESSION['company_name'];
		$query_search.=" AND  customers.companyname like '%".$_SESSION['company_name']."%'";
	}*/
	
	if($proof_status_quyery=='0'){
		$sql_count = "SELECT count(printorders.id) FROM printorders LEFT JOIN customers ON (customers.id = printorders.custid) WHERE printorders.paid = 1 
			AND proof_product = '0'
			{$query_search}
			AND new_old  = 'old'";													
	}else {
		$status = $proof_status_quyery;
		$sql_count =  "SELECT count(printorders.id) FROM printorders LEFT JOIN customers ON (customers.id = printorders.custid) WHERE printorders.paid = 1 
			AND proof_product = '0'
			AND new_old  = 'old'
			{$query_search}
			AND proof_status = '{$status}'
			";
	}
	//echo $sql_count;
	$retval_count = mysql_query($sql_count);
	if(!$retval_count )
	{
	  die('Could not get data: ' . mysql_error());
	}
	$row = mysql_fetch_array($retval_count,MYSQL_NUM );
	$rec_count = $row[0];	
	$page = $_GET['page'];//curent page
	if ($page == "")  $page=1;
	$start = ($page-1)*$rec_limit;
	$total_page = ceil($rec_count/$rec_limit);
	//echo $total_page.'AAA';
	$left_rec = $rec_count - ($page * $rec_limit);
	if($proof_status_quyery =='0'){	
		$sql = "SELECT printorders.*, customers.id AS custid, customers.firstname AS firstname, customers.lastname AS lastname, customers.companyname AS companyname, customers.street, customers.street2, customers.city, customers.state, customers.zip AS zipcode, customers.email, customers.phone FROM printorders LEFT JOIN customers ON (customers.id = printorders.custid) WHERE printorders.paid = 1 
		AND proof_product = '0'
		AND new_old  = 'old'
		{$query_search}
		ORDER BY priority DESC,id DESC LIMIT $start,$rec_limit";
	}else {
		$proof_status = $proof_status_quyery;
		$sql = "SELECT printorders.*, customers.id AS custid, customers.firstname AS firstname, customers.lastname AS lastname, customers.companyname AS companyname, customers.street, customers.street2, customers.city, customers.state, customers.zip AS zipcode, customers.email, customers.phone FROM printorders LEFT JOIN customers ON (customers.id = printorders.custid) WHERE printorders.paid = 1 
		AND proof_product = '0'
		AND new_old  = 'old'
		{$query_search}
		AND proof_status = '{$proof_status}'
		ORDER BY priority DESC,id DESC LIMIT $start,$rec_limit";
	}
	$result = mysql_query($sql);
?>	
<div class="xgrid">
<div style="min-height: 300px;" class="portlet x12">
	<div class="portlet-header"><h4>View Proofs</h4></div>			
		<div class="portlet-content" >
		
	<div style="margin-top: 25px;">
		<form action="order_proofs_admin.php" method="post" name="print_search_form" >
			<input type="hidden" value="<?php echo $param;?>" id="param_search" name="param_search" />
			<table class="search-box-tabletype">
				<tr>
					<td colspan="7"><h3>Search form</h3></td>
				</tr>
				<tr>
					<td>Customer Name:</td>
					<td><input type="text" value="<?php if(isset($_REQUEST['customer_name'])){ echo $_REQUEST['customer_name']; }?>" name="customer_name" /></td>
					<td>Type:</td>
					<td rowspan="4">
						<select name="search_type[]" multiple size="7" style="width:232px">
							<?php foreach($type_list as $key=>$value) {?>
								<option value="<?php echo $key;?>" <?php echo isset($_REQUEST['search_type']) && in_array($key,$_REQUEST['search_type']) ? 'selected' : '';?>><?php echo $value;?></option>
							<?php }?>
						</select>
					</td>
					<td>Pro Status</td>
					<td rowspan="4">
						<select name="search_prod_status[]" multiple size="4" style="width: 232px">
							<?php foreach($status_list as $key=>$value) {?>
								<option value="<?php echo $key;?>" <?php echo isset($_REQUEST['search_prod_status']) && in_array($key,$_REQUEST['search_prod_status']) ? 'selected' : '';?>>
									<?php echo $value;?>
								</option>
							<?php }?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Date:</td>
					<td><input type="text" value="<?php if(isset($_REQUEST['date'])){ echo $_REQUEST['date']; }?>" name="date" id="date_search" /></td>
				</tr>
                <tr>
                    <td>Order Date:</td>
                    <td><input type="text" value="<?php if(isset($_REQUEST['created_date'])){ echo $_REQUEST['created_date']; }?>" name="created_date" id="created_date_search" /></td>
                </tr>
				<tr>
					<td>Print order number:</td>
					<td><input type="text" value="<?php if(isset($_REQUEST['print_order_number'])){ echo $_REQUEST['print_order_number']; }?>" name="print_order_number" /></td>
				</tr>
				<tr>
					<td>Company name: </td><td><input type="text" name="company_name" value="<?php if(isset($_REQUEST['company_name'])){ echo $_REQUEST['company_name']; }?>" /></td>
				</tr>
				<tr>
					<td><input type="submit" name="Search" value="Search"  /></td>
				</tr>
			</table>
			<script type="text/javascript">
			  Calendar.setup(
			    {
			      inputField  : "date_search",         // ID of the input field
			      ifFormat    : "%Y-%m-%d"    // the date format
			    }
			  );
              Calendar.setup(
                      {
                          inputField  : "created_date_search",         // ID of the input field
                          ifFormat    : "%Y-%m-%d"    // the date format
                      }
              );
			</script>
		</form>
	</div>
	<div style="float:right;font-size:12px" >
		<form action="order_proofs_admin.php" name="filterform" method="post" style="font-size:12px;">
		Filter by:
				<select id="filter" name="proof_status" onchange="document.filterform.submit();">
					<option <?php if(isset($_REQUEST['proof_status']) && $_REQUEST['proof_status']==0){ echo 'selected';}?> value="0">All</option>
					<option <?php if(isset($_REQUEST['proof_status'])  && $_REQUEST['proof_status']=='new'){ echo 'selected';}?> value="new">New</option>
					<option <?php if(isset($_REQUEST['proof_status'])  && $_REQUEST['proof_status']=='waitting'){ echo 'selected';}?> value="waitting">Waitting</option>
					<option <?php if(isset($_REQUEST['proof_status'])  && $_REQUEST['proof_status']=='sent'){ echo 'selected';}?> value="sent">Sent</option>	
				</select> 				
		</form>
									
	</div>
	<div style="clear:both"></div>
	<br>
	<div>
			<table border="0" class="customers">
				<tr bgcolor="#D8D7E3">
					<td class="fieltable" width="20%" style="height: 25px;"><strong>Customer</strong></td>
					<td class="fieltable"><strong>Company</strong></td>
					<td class="fieltable"><strong>Date</strong></td>
                    <td class="fieltable"><strong>Order Date</strong></td>
					<td class="fieltable"><strong>Print Order Number</strong></td>
					<td class="fieltable" width="200"><strong>Operations</strong></td>
					<td class="fieltable" ><strong>Production</strong></td>
					<td class="fieltable" ><strong>Type</strong></td>
					<td class="fieltable" ><strong>Prod Status</strong></td>	
				</tr>
				<?php 
				while($row  = mysql_fetch_assoc($result)){					
					if($row["priority"] == 1){
						$bgcolor_p = 'red';
					}else{
						$bgcolor_p = 'black';
					}
				?>
				<tr>
						<td width="20%" style="height: 25px;"><a href="customer_view_admin.php?customerid=<?php echo $row["custid"]; ?>"><?php echo $row["firstname"]." ".$row["lastname"]; ?></a></td>
						<td>                           
                            <a href="printorder_view_admin.php?customerid=<?php echo $row["custid"]; ?>&orderid=<?php echo $row["id"]; ?>"><?php echo $row['companyname']?></a>                            
                        </td>
						<td>                           
                            <a href="printorder_view_admin.php?customerid=<?php echo $row["custid"]; ?>&orderid=<?php echo $row["id"]; ?>"><?php echo $row["timestamp"]; ?></a>                            
                        </td>
                    <td>
                        <a href="printorder_view_admin.php?customerid=<?php echo $row["custid"]; ?>&orderid=<?php echo $row["id"]; ?>"><?php echo $row["created_time"]; ?></a>
                    </td>
						<td align="center"><font color="#FF0000"><strong><?php echo $row["id"]; ?></strong></font></td>
						<td>
							<a href="order_proofs_admin.php?delid=<?php echo $row["id"]; ?>" onClick="javascript:return confirm('Are you sure you want to delete this print order?')">[X]</a> | 
							<select  class="proof" id="<?php echo $row['id'];?>" name="proof">
								<option <?php if($row['proof_status'] == 'new'){ echo 'selected'; } ?> value="new">New</option>
								<option <?php if($row['proof_status'] == 'waitting'){ echo 'selected'; } ?> value="waitting">Waitting</option>
								<option <?php if($row['proof_status'] == 'sent'){ echo 'selected'; } ?> value="sent">Sent</option>
							</select>
							|
						<a href="order_proofs_admin.php?priority=<?php echo $row["priority"]?>&norderid=<?php echo $row["id"]; ?>" style="color: <?php echo $bgcolor_p?>">Priority</a>
						</td>
						<td>
							<a href="order_proofs_admin.php?sent_to_prod=<?php echo $row['id'];?>">Send To Production</a>
						</td>
						<td value="<?php echo $row['id'];?>">
							<select class="printorder_type">
								<?php foreach($type_list as $key=>$type) {?>
									<option value="<?php echo $key?>" <?php echo $key==$row['type']?"selected":"";?>><?php echo $type;?></option>
								<?php }?>
							</select>
						</td>
						<td value="<?php echo $row['id'];?>">
							<select class="prod_status">
								<?php foreach($status_list as $key=>$status) {?>
									<option value="<?php echo $key?>" <?php echo $key==$row['prod_status']?"selected":"";?>><?php echo $status;?></option>
								<?php }?>
							</select>
						</td>
				</tr>	
				<?php } ?>
				<tr>
					<td colspan="5" style="height: 10px;"></td>
				</tr>
			</table>
	</div>

	<div>
		<?php		
			doPages($rec_limit ,'/admin/order_proofs_admin.php','',$rec_count);			
		?>
	</div>
	</div>
	</div>
	</div>
	</div>
	
<script>
	$(document).ready(function(){
		$('.printorder_type').change(function(){
			var type 	= $(this).val();
			var id		= $(this).parent().attr('value');
			$.post(
				"<?php echo $base_url?>/admin/change_printorder_type.php",
				{id: id, type: type,option:'change_type'},
				function(data){
					window.location.href="<?php echo $base_url;?>/admin/order_proofs_admin.php";
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
</body>
</html>

