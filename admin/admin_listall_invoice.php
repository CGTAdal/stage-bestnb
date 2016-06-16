<?php
require_once('conn/DB.php');
include('conn/tablefuncs.php');
include('../include/config.php');
mysql_select_db($database_DB, $ravcodb);
@session_start();

//if (!$_SESSION["loginid"] || $_SESSION["userlevel"] < 2)
if (!$_SESSION["loginid"])
{?>
<script language="javascript">
parent.parent.location.href='admin.php';
window.close();
</script>
<?php }

//unset($_SESSION);
// get list user to filter by user:
$sql_user  = "SELECT * FROM users ORDER BY username ASC";
$result_user 	= mysql_query($sql_user);		
$arr_user  = array();
if($result_user){
	while($row_user = mysql_fetch_assoc($result_user)){
		$arr_user[] = $row_user;
	}
}
if(!isset($_REQUEST['user_id'])){
	#$sale_id = $_SESSION["loginid"];
	$sale_id = 'all';
}else {
	$sale_id = $_REQUEST['user_id'];
}
if(!isset($_SESSION['invoice_stt'])){
    $_SESSION['invoice_stt'] = 'all';
}
if(isset($_REQUEST['invoice_stt'])){
    $_SESSION['invoice_stt'] = trim($_REQUEST['invoice_stt']);
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

$rec_limit =100;
// calc count of invoice 
$where = '';
if(isset($_REQUEST['invoice_id']) && $_REQUEST['invoice_id'] !=''){
    $where.= ' AND invoices.id="'.$_REQUEST['invoice_id'].'"';
}
if(isset($_REQUEST['po_number']) && $_REQUEST['po_number'] !=''){
    $where.= ' AND invoices.po_number LIKE "%'.$_REQUEST['po_number'].'%"';
}
if(isset($_REQUEST['date']) && $_REQUEST['date'] !=''){
    $where.= ' AND invoices.data_of_issue="'.$_REQUEST['date'].'"';
}
if(isset($_REQUEST['total1']) && $_REQUEST['total1'] !=''){
    $where.= ' AND invoices.total>='.$_REQUEST['total1'];
}
if(isset($_REQUEST['total2']) && $_REQUEST['total2'] !=''){
    $where.= ' AND invoices.total<='.$_REQUEST['total2'];
}
if($sale_id !='all'){
    $where.=' AND customers.sale_id='.$sale_id;
}

if(isset($_REQUEST['invoice_stt']) && $_REQUEST['invoice_stt']=='all'){
    $sql_count = "SELECT count(invoices.id) as total FROM invoices 
    INNER JOIN `customers` ON customers.id = invoices.customer_id    
    WHERE 1=1 ".$where;
    //INNER JOIN `users` ON users.id = customers.sale_id
}else {
	$invoice_stt  = !empty($_REQUEST['invoice_stt'])?"invoices.invoice_status='".$_REQUEST['invoice_stt']."'":"1=1";
    $sql_count = "SELECT count(invoices.id) as total FROM invoices 
        INNER JOIN `customers` ON customers.id = invoices.customer_id        
        WHERE ".$invoice_stt." {$where}";
    //INNER JOIN `users` ON users.id = customers.sale_id
}


$retval_count = mysql_query($sql_count);

if(!$retval_count )
{
  die('Could not get data: ' . mysql_error());
}
$row = mysql_fetch_assoc($retval_count);

$rec_count = $row['total'];	

//echo $rec_count.'AAA';
$page = $_GET['page'];//curent page
if ($page == "")  $page=1;
$start = ($page-1)*$rec_limit;
$total_page = ceil($rec_count/$rec_limit);
//echo $total_page.'AAA';
$left_rec = $rec_count - ($page*$rec_limit);
if($_SESSION['invoice_stt'] == 'all'){
    $sql = "SELECT invoices.*,customers.companyname FROM invoices 
    INNER JOIN customers ON invoices.customer_id = customers.id
    
    WHERE 1=1
    {$where}
    ORDER BY invoices.id DESC LIMIT $start,$rec_limit";
    //INNER JOIN `users` ON users.id = customers.sale_id
}else {
     $sql = "SELECT invoices.*,customers.companyname FROM invoices 
        INNER JOIN customers ON invoices.customer_id = customers.id
        
        WHERE invoice_status='".$_SESSION['invoice_stt']."' 
        {$where}                
        ORDER BY invoices.id DESC LIMIT $start,$rec_limit";
        //INNER JOIN `users` ON users.id = customers.sale_id
}

$result = mysql_query($sql);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Best Name Badges - Content Management System</title>
<?php include("init_top.php");?>
<link href="<?php echo $base_url;?>/admin/includes/cms.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" type="text/css" href="<?php echo $base_url?>/admin/calendar/calendar-win2k-1.css"/>

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


<script type="text/javascript" src="<?php echo $base_url?>/greybox/AJS.js"></script>
<script type="text/javascript" src="<?php echo $base_url?>/greybox/AJS_fx.js"></script>
<script type="text/javascript" src="<?php echo $base_url?>/greybox/gb_scripts.js"></script>
<link href="<?php echo $base_url?>/greybox/gb_styles.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo $base_url?>/scripts/jquery-1.3.2.min.js"></script>
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
if($_REQUEST['del_invoice'] == 1){
    $invoice_id = $_REQUEST['invoice_id'];
    $customer_id = $_REQUEST['customer_id'];   
    $sql  = "DELETE FROM invoices WHERE id='{$invoice_id}'";
    
    mysql_query($sql);
    $sql_item = "DELETE FROM item_invoice WHERE invoice_id='{$invoice_id}'";
    mysql_query($sql_item);
    ?>
    <script language="javascript">
        parent.parent.location.href='admin_listall_invoice.php';
        window.close();
    </script>
<?php
}
?>
</head>
<body>	
	<div align="center">
		<?php include("header.php"); ?>	
		<div class="xgrid" >
<div style="width: 97%;margin-left: 1.50%;" class="portlet x12">
	<div class="portlet-header"><h4>View Invoices</h4></div>			
		<div class="portlet-content" >
			<form action="admin_listall_invoice.php" name="filterform" method="post">                                
				<div style="float:right;width: 100%;">
					<table class="search-box-tabletype">
						<tr>
							<td colspan="9"><h3>Search form</h3></td>
						</tr>
						<tr>                                            
							<td>Invoice #:</td>
							<td align="left">
								<input type="text" value="<?php if(isset($_REQUEST['invoice_id'])){echo $_REQUEST['invoice_id'];}?>" name="invoice_id" />
							</td>
                            <td>PO #:</td>
                            <td align="left">
                                <input type="text" value="<?php if(isset($_REQUEST['po_number'])){echo $_REQUEST['po_number'];}?>" name="po_number" />
                            </td>
						</tr>
						<tr>                                            
							<td>From:</td>
							<td align="left">
								<input type="text" value="<?php if(isset($_REQUEST['total1'])){echo $_REQUEST['total1'];}?>" name="total1" /> 
							</td>
							<td>To:</td>
							<td align="left"> <input type="text" value="<?php if(isset($_REQUEST['total2'])){echo $_REQUEST['total2'];}?>" name="total2" /></td>
						</tr>
                        <tr>
                            <td>Date:</td>
                            <td align="left"><input type="text" value="<?php if(isset($_REQUEST['date'])){echo $_REQUEST['date'];}?>" id="date_of_issue" name="date" /></td>
                        </tr>
						<tr>
							<td><input type="submit" value="Search" name="search" /></td>
						</tr>
					</table>
				</div>
				<div style="float:right;font-size:12px">
					Sales Person: 
					<select id="user_id" name="user_id" onchange="document.filterform.submit();">
						<option value="all">All</option>
							<?php 
								foreach($arr_user as $user){		
									$sl = ($sale_id == $user['id'])?'selected="selected"':'';
							?>
									<option value="<?php echo $user['id']?>" <?php echo $sl;?>><?php echo $user['username']?></option>
							<?php
								}
							?>	
					</select>
					Inovice status: 
					<select name="invoice_stt" onchange="document.filterform.submit();">                                    
						<option <?php if($_SESSION['invoice_stt']=='all'){ echo 'selected';}?> value="all">All</option>
						<option <?php if($_SESSION['invoice_stt']=='paid'){ echo 'selected';}?> value="paid">Paid</option>
						<option <?php if($_SESSION['invoice_stt']=='unpaid'){ echo 'selected';}?> value="unpaid">UnPaid</option>
						<option <?php if($_SESSION['invoice_stt']=='partial'){ echo 'selected';}?> value="partial">Partial</option>
					</select>
				</div>    
			</form>
			<div style="clear: both;"></div>
			<div id="" style="margin-top: 5px;" style="float:right;width: 100%;">
	           
				<table border="0" class="customers" style="width: 100%;" style="float:right;width: 100%;">
					<tr bgcolor="#D8D7E3">
						<td class="fieltable" width="20" style="height: 25px;"><strong>Invoice#</strong></td>
	                    <td class="fieltable" align="center"><strong>Company</strong></td>
						<td class="fieltable" align="center"><strong>Date</strong></td>
						<td class="fieltable" align="center" style="width: 170px;"></td>
						<td class="fieltable" align="center"><strong>Total</strong></td>
	                    <td class="fieltable" align="center"><strong>Paid</strong></td>
	                    <td class="fieltable" align="center"><strong>Due</strong></td>
						<td class="fieltable" align="center"><strong>Action</strong></td>	
					</tr>
					<?php 
					$bgcolor = "WHITE";
					while($row  = mysql_fetch_assoc($result)){    
	                 // calc paid total
	                            $sql_total  = "SELECT total FROM item_invoice WHERE invoice_id = '{$row['id']}'";
	                            //echo $sql_total;
	                            $result_total = mysql_query($sql_total);
	                            $total_invoice = 0;
	                            $total_compare = 0;
	                            if($result_total){                                
	                                while($row_total = mysql_fetch_assoc($result_total)){
	                                    //echo $row_total['total'].'<br />';
	                                    $total_item = str_replace(',','',$row_total['total']);
	                                    $total_invoice = $total_invoice  + $total_item;
	                                }
	                            }
	                            /*$discount  = str_replace('%', '', $row['discount']);
	                            if((int)$discount > 0){
	                                
	                                $total_invoice = $total_invoice  - $total_invoice*$discount/100;
	                            } */
	                           
	                            if ($row["state"] == "FL" && $row['remove_tax']==0) { 
	                             //if ($row["state"] == "FL") {
	                                
	                                $taxdec = 6/100;
	                                $taxtotal = $taxdec * $total_invoice;
	
	                                $total_invoice = $taxtotal + $total_invoice;                                
	                            }else {
	                                $total_invoice   = $total_invoice;                    
	                            }
	                            
	                            $total_compare = $total_invoice;
	                            $total_invoice =  number_format(round($total_invoice,2),2,'.',',');
	                            
					?>
					<tr bgcolor="<?php echo $bgcolor;?>">
						<td align="center" width="20" style="height: 25px;"><?php echo $row['id'];?></td>
	                    <td algin="center"><a href="customer_view_admin.php?customerid=<?php echo $row['customer_id'];?>"><?php echo $row['companyname'];?></a></td>
						<td align="center"><?php echo $row['data_of_issue'];?></td>
						<td align="center" style="width: 150px;">
							<a href="admin_edit_invoice.php?customer_id=<?php echo $row['customer_id'];?>&invoice_id=<?php echo $row['id'];?>">Edit invoice</a> | <a href="admin_view_invoice.php?invoice_id=<?php echo $row['id'];?>&customer_id=<?php echo $row['customer_id'];?>">View invoice</a>
						</td>
						<td align="center" width="100">
	                        <strong><?php echo '$'.$total_invoice;?></strong>
	                    </td>        
	                    <td align="center">
	                        <strong><?php echo '$'.number_format(str_replace(',','',$row['paid_to_date']),2,'.',',');?></strong>                            
	                    </td>
	                    <td align="center">                           
	                        <strong><?php $blance = $total_compare - str_replace(',','', $row['paid_to_date']); echo '$'.number_format(round($blance,2),2,'.',',');?></strong>
	                    </td>
						<td align="center">
	                        <div>
	                        	<?php $show_value = ((float)round($row['paid_to_date'],2) >= (float)round(str_replace(',', '',$total_compare),2)) ? 1 : (((float)round($row['paid_to_date'],2)< (float)round(str_replace(',', '',$total_compare),2) && (float)$row['paid_to_date'] > 0) ? 2 : 3) ;?>
	                        	<a href="admin_edit_invoice.php?customer_id=<?php echo $row['customer_id'];?>&invoice_id=<?php echo $row['id']?>">Edit</a> | 
								<?php if($_SESSION['userlevel']>1 || ($show_value==3 && $_SESSION['userlevel']==1)) {?>
		                        	<a onclick="javascript:return confirm('Are you sure you wish to delete?')" href="admin_listall_invoice.php?customer_id=<?php echo $row['customer_id']; ?>&del_invoice=1&invoice_id=<?php echo $row['id'];?>">[X]</a> |
		                        <?php }?> 
	                        	<?php           
		                            if($show_value == 1){  
	                            		echo '<a href="invoice_payment.php?customer_id='.$row['customer_id'].'&invoice_id='.$row['id'].'&total='.$total_invoice.'&redirect=1&page='.$page.'" onclick="return GB_showCenter(\'Payment\', this.href,400,600);"><font color="green">Paid</font></a>';
		                            }elseif($show_value == 2){
		                            	echo '<a href="invoice_payment.php?customer_id='.$row['customer_id'].'&invoice_id='.$row['id'].'&total='.$total_invoice.'&redirect=1&page='.$page.'" onclick="return GB_showCenter(\'Payment\', this.href,400,600);"><font color="orange">Partial</font></a>';           
		                            }else { 
		                                echo '<a href="invoice_payment.php?customer_id='.$row['customer_id'].'&invoice_id='.$row['id'].'&total='.$total_invoice.'&redirect=1&page='.$page.'" onclick="return GB_showCenter(\'Payment\', this.href,400,600);"><font color="red">Unpaid</a></font>';                                 
		                            }
	                        	?>
	                        </div>
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
			 </div>
        <div>
		<?php	 
			doPages($rec_limit ,'/admin/admin_listall_invoice.php','',$rec_count);			
		?>
        </div>
	</div>
	</div>
	</div>
	</div>
	<script type="text/javascript">
		Calendar.setup(
			{
				inputField  : "date_of_issue",         // ID of the input field
				ifFormat    : "%m/%d/%Y",    // the date format
			}
		);
	</script>
</body>
</html>

