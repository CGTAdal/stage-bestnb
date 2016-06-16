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



//process of make po unpaid invoices
$is_make_po = $_REQUEST['make_po'];
if($is_make_po == 1)
{
	//“Make PO”

	$invoice_id = $_REQUEST['invoice_id'];
	$customer_id = $_REQUEST['customer_id'];

	if($invoice_id && $customer_id)
	{
		//check that invoice po already created or not
		$sql_invoice_po_status = "SELECT count(printorders.id) AS count_po FROM printorders
	                  			WHERE printorders.invoice_id = '{$invoice_id}' AND printorders.custid = '{$customer_id}'";

		$result_invoice_po_status = mysql_query($sql_invoice_po_status);

		if($result_invoice_po_status)
		{
	        $invoice_po_count = mysql_fetch_assoc($result_invoice_po_status);

			if($invoice_po_count["count_po"] == 0)
			{
				$sql_invoice = "SELECT invoices.*,customers.sale_id FROM invoices
	                  			INNER JOIN customers ON customers.id = invoices.customer_id
	                  			WHERE invoices.id = '{$invoice_id}'";

			    $result_invoice = mysql_query($sql_invoice);

				$invoice  = array();

			    if($result_invoice)
			    {
			        $invoice = mysql_fetch_assoc($result_invoice);

			        //Make PO
					$data_printorder = array();
					    $data_printorder["custid"]		= $invoice['customer_id'];
					    $data_printorder['timestamp']	= date('Y-m-d H:i:s');
					    $data_printorder['note']		= $invoice['internal_note'];
					    $data_printorder['customer_note']	= $invoice['note_visible_to_client'];
					    $data_printorder['invoice_id']	= $invoice['id'];
				    
					$printorder_id = add_record("printorders",$data_printorder);
			    }
			}

			//update is_po_created to 1 in invoices table
			$data_invoices = array("is_po_created"=>1);
			$where = "id = ".$invoice_id;
        	modify_record("invoices", $data_invoices, $where);
	    }
	}

	$redirectURL = "admin_list_invoice.php?customerid=$customer_id";
	header('Location: '.$redirectURL);
}
elseif($is_make_po == 2)
{
	//change it back to a non-po/regular invoice

	$invoice_id = $_REQUEST['invoice_id'];
	$customer_id = $_REQUEST['customer_id'];

	if($invoice_id)
	{
		//update is_po_created to 0 in invoices table for it back to non-po invoice
		$data_invoices = array("is_po_created"=>0);
		$where = "id = ".$invoice_id;
		modify_record("invoices", $data_invoices, $where);
	}

	$redirectURL = "admin_list_invoice.php?customerid=$customer_id";
	header('Location: '.$redirectURL);
}
//end Make PO


$customer_id = $_REQUEST['customerid'];
$rec_limit =300;
// calc count of invoice 
$sql_count = "SELECT count(id) FROM invoices WHERE customer_id='{$customer_id}'";
$retval_count = mysql_query($sql_count);
if(!$retval_count )
{
  die('Could not get data: ' . mysql_error());
}
$rec_count = $row[0];	
$page = $_GET['page'];//curent page
if ($page == "")  $page=1;
$start = ($page-1)*$rec_limit;
$total_page = ceil($rec_count/$rec_limit);
//echo $total_page.'AAA';
$left_rec = $rec_count - ($page*$rec_limit);
$sql = "SELECT * FROM invoices WHERE customer_id ='{$customer_id}' ORDER BY id DESC LIMIT $start,$rec_limit";
$result = mysql_query($sql);

?>
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
        parent.parent.location.href='admin_list_invoice.php?customerid=<?php echo $customer_id;?>';
        window.close();
    </script>
<?php
}
?>
</head>
<body>	
	<div align="center">
		<?php include("header.php"); ?>	
		<div class="xgrid">
		<div style="min-height: 300px;" class="portlet x12">
		<div class="portlet-header"><h4>View Invoices</h4></div>			
			<div class="portlet-content" >
		
		<div style="margin-top: 10px;">
			<table border="0" class="customers">
                <?php 
                $customer_id = $_REQUEST['customerid'];
                $qry = "SELECT  customers.id AS custid, customers.firstname AS firstname, customers.lastname AS lastname, customers.companyname AS companyname, customers.street, customers.street2, customers.city, customers.state, customers.zip AS zipcode, customers.email, customers.phone FROM customers WHERE customers.id ='{$customer_id}'";
                //echo $qry;
                $customers_result = mysql_query($qry) or die('Query failed: ' . mysql_error()); 
                $customers = mysql_fetch_assoc($customers_result); 
              //  echo '<pre>'.print_r($customers).'</pre>';
               // die;		
                ?>
                 
                <tr>
					<td colspan="2"><a href="customer_view_admin.php?customerid=<?php echo $customers["custid"]; ?>"><strong><?php echo $customers["companyname"]."<br>".$customers["firstname"]." ".$customers["lastname"]; ?></strong></a><br /><?php echo $customers["street"]; ?><?php if ($customers["street2"]) { echo "<br>".$customers["street2"]; } ?><br /><?php echo $customers["city"].", ".$customers["state"]." ".$customers["zipcode"]; ?></td>
					<td colspan="5" align="right"><strong><?php echo $customers["email"]."<br>".$customers["phone"]; ?></strong></td>
				</tr>
				<tr style="height: 30px; background-color: #CCCCCC;">
					<td colspan="7" style="padding-left: 20px;"> <strong> </strong></td>
				</tr>
				
				<tr>
					<td colspan="2"><a href="admin_add_invoice.php?customer_id=<?php echo $customer_id;?>">Create New Invoice</a></td>
					<td colspan="4"></td>
					<td algin="right">View Invoices</td>
				</tr>
				<tr bgcolor="#D8D7E3">
					<td class="fieltable" width="20" style="height: 25px;"><strong>Invoice#</strong></td>
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
                            if((int)$row['discount'] > 0){                                
                                $total_invoice = $total_invoice  - $total_invoice*$row['discount']/100;
                            } 
                            if ($row["state"] == "FL" && $row["remove_tax"] == '0') { 			
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
					<td align="center"><?php echo $row['data_of_issue'];?></td>
					<td align="center" style="width: 150px;">
						<a href="admin_edit_invoice.php?customer_id=<?php echo $customer_id;?>&invoice_id=<?php echo $row['id'];?>">Edit invoice</a> | <a href="admin_view_invoice.php?invoice_id=<?php echo $row['id'];?>&customer_id=<?php echo $customer_id;?>">View invoice</a>
					</td>
					<td align="center" width="100">
                        <strong><?php echo '$'.$total_invoice;?></strong>
                    </td>        
                    <td align="center">
                        <strong><?php echo '$'.number_format(str_replace(',','',$row['paid_to_date']),2,'.',',');?></strong>                            
                    </td>
                    <td align="center">                           
                        <strong>
                        	<?php 
                        		$blance = $total_compare - str_replace(',','',$row['paid_to_date']); 
                        		echo '$'.number_format(round($blance,2),2,'.',',');
                        	?>
                        </strong>
                    </td>
					<td align="center">
                        <div>
                        	<?php $show_value = ((float)round($row['paid_to_date'],2) >= (float)round(str_replace(',', '',$total_compare),2)) ? 1 : (((float)round($row['paid_to_date'],2)< (float)round(str_replace(',', '',$total_compare),2) && (float)$row['paid_to_date'] > 0) ? 2 : 3) ;?>
                        	<a href="admin_edit_invoice.php?customer_id=<?php echo $customer_id;?>&invoice_id=<?php echo $row['id']?>">Edit</a> |
                        	<?php if($_SESSION['userlevel']>1 || ($show_value==3 && $_SESSION['userlevel']==1 && $row['is_po_created'] == 0)) {?> 
	                        	<a onClick="javascript:return confirm('Are you sure you wish to delete?')" href="admin_list_invoice.php?customer_id=<?php echo $customer_id; ?>&del_invoice=1&invoice_id=<?php echo $row['id'];?>">[X]</a> | 
	                        <?php }?>
                        	<?php
	                            if($show_value==1){                                  
	                                echo '<a href="invoice_payment.php?customer_id='.$customer_id.'&invoice_id='.$row['id'].'&total='.$total_invoice.'" onclick="return GB_showCenter(\'Payment\', this.href,400,600);"><font color="green">Paid</font></a>';                             
	                            }elseif($show_value==2){
	                                echo '<a href="invoice_payment.php?customer_id='.$customer_id.'&invoice_id='.$row['id'].'&total='.$total_invoice.'" onclick="return GB_showCenter(\'Payment\', this.href,400,600);"><font color="orange">Partial</font></a>';           
	                            }else { 
	                                echo '<a href="invoice_payment.php?customer_id='.$customer_id.'&invoice_id='.$row['id'].'&total='.$total_invoice.'" onclick="return GB_showCenter(\'Payment\', this.href,400,600);"><font color="red">Unpaid</a></font>';
	                                if($row['is_po_created'] == 0) {
										echo ' | <a onClick="javascript:return confirm(\'A print order will be generated for this order, are you sure?\')" href="admin_list_invoice.php?customer_id='.$customer_id.'&invoice_id='.$row['id'].'&make_po=1">Make PO</a>';
	                                }
	                                else {
	                                	echo ' | <a href="admin_list_invoice.php?customer_id='.$customer_id.'&invoice_id='.$row['id'].'&make_po=2"><font color="red">PO</font></a>';
	                                }
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
		</div></div></div>
	</div>
</body>
</html>

