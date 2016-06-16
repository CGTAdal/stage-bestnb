<?php 
require_once('admin/conn/DB.php');
include('admin/conn/tablefuncs.php');
include('include/config.php');
mysql_select_db($database_DB, $ravcodb);
session_start();

$pagetitle = "Buy Name Badges - Custom Name Badge Styles and Tags";
$metadescription = "Best Name Badges offers several styles of high quality badges and tags to fit your needs.  Magnetic and Pin fasteners are included free of charge.";
$metakeywords = "name badges, name tags, custom name badge, custom name tags, metal name tags, brushed aluminum name badges, plastic name tags, plastic name badges, color name badges, employee name tags, employee name badges, professional name tags, professional name badges"; 

$qry = "SELECT orders.id, orders.status as ostatus, orders.totalprice, receipts.* FROM 
    orders RIGHT JOIN receipts ON (receipts.oid = orders.id) WHERE     
    orders.customerid = '".$_SESSION["customerloginid"]."'
    AND orders.invoice_id =0     
    ";
//echo $qry;
$receipts = mysql_query($qry);
$receipt = mysql_fetch_assoc($receipts);

// get invoice 
/*$qry_invoice = "SELECT orders.id,orders.invoice_id, invoices.invoice_status as ostatus,invoices.rand_code as code, orders.totalprice, receipts.* FROM orders 
    RIGHT JOIN receipts ON (receipts.oid = orders.id) 
    JOIN invoices ON (invoices.id = orders.invoice_id)
    WHERE     
    orders.customerid = '".$_SESSION["customerloginid"]."'
    AND invoices.is_client_public = 'yes'    
    AND orders.invoice_id !=0   
    ";
*/
$qry_invoice = "SELECT id as invoice_id,invoice_status as ostatus,rand_code as code, data_of_issue as date,state,discount    
    FROM invoices 
    WHERE invoices.is_client_public = 'yes'
    AND customer_id = '".$_SESSION["customerloginid"]."'";
//echo $qry_invoice;


//echo $qry_invoice;
//echo $qry;
$invoice = mysql_query($qry_invoice);
//$invoices = mysql_fetch_assoc($invoice);
// end of get invoice

$qry = "SELECT preceipts.*, printorders.status,printorders.tracking_number, printorders.payment_method FROM printorders RIGHT JOIN preceipts ON (preceipts.oid = printorders.id) WHERE printorders.custid = '".$_SESSION["customerloginid"]."'";
$preceipts = mysql_query($qry);
$preceipt = mysql_fetch_assoc($preceipts);

function formatMoney($number, $cents = 2) { // cents: 0=never, 1=if needed, 2=always
  if (is_numeric($number)) { // a number
    if (!$number) { // zero
      $money = ($cents == 2 ? '0.00' : '0'); // output zero
    } else { // value
      if (floor($number) == $number) { // whole number
        $money = number_format($number, ($cents == 2 ? 2 : 0)); // format
      } else { // cents
        $money = number_format(round($number, 2), ($cents == 0 ? 0 : 2)); // format
      } // integer or decimal
    } // value
    return '$'.$money;
  } // numeric
} // formatMoney

?>
<?php 
if ($_SESSION["customerloginid"])
{
	include_once 'inc/header-auth.php';
} else {
	include_once 'inc/header.php' ;
} ?>


<script type="text/javascript" src="/js/jscolor.js"></script>

    <div id="content">
     
    <div id="mainContentFull">
	  <h2>Your Order Archive</h2>

	  
      <p>Click on an order number to view or print a receipt.</p>
     
      <br />
	  <div id="addNamesLeft">	  
      <div id="logoBox" style="width: 450px;">
      	<div class="boxHeader"><span style="float: left;">Print Orders</span></div>
      	<div class="boxSub" style="border-bottom: none;">
        	  <div class="boxSub2" style="display: none;"></div>
        </div>
        
       <table width="454" border="0" cellspacing="2" cellpadding="5" class="tableOrder">
  <tr style="background-color: #CCC;">
    <td width="137" height="28" align="center" valign="middle"><strong>PRINT ORDER #</strong></td>
    <td width="128" align="center" valign="middle"><strong>DATE</strong></td>
    <td width="147" align="center" valign="middle"><strong>STATUS</strong></td>
    <td width="147" align="center" valign="middle"><strong>TRACKING</strong></td>	
  </tr>
  <?php 
  if ($preceipt) {
  do { 
  ?>
  <tr style="background-color:#ededed;">
    <td align="center" valign="middle"><a href="<?php echo $base_url;?>/p-receipt.php?rid=<?php echo $preceipt["id"]; ?>" target="_blank">P-<?php echo $preceipt["oid"]; ?></a></td>
    <td align="center" valign="middle"><?php echo $preceipt["date"]; ?></td>
    <td align="center" valign="middle"><?php if ($preceipt["status"]) { echo "SHIPPED"; } else { echo "PENDING"; } ?></td>
    <td align="center" valign="middle">	
		<?php 
		if($preceipt['tracking_number']>0 && $preceipt['payment_method']!=''){
			if($preceipt['payment_method'] == 1){
				echo '<a href="http://www.fedex.com/Tracking?tracknumbers='.$preceipt['tracking_number'].'" target="_blank">FedEx</a>';
			}else if($preceipt['payment_method'] == 0) {
				echo '<a href="http://trkcnfrm1.smi.usps.com/PTSInternetWeb/InterLabelInquiry.do?origTrackNum='.$preceipt['tracking_number'].'" target="_blank">USPS</a>';
			}else {
				echo 'Unavailable';
			}
		}else {
		?>
		Unavailable
		<?php
		}
		?>
    </td>	
  </tr>
  <?php } while ($preceipt = mysql_fetch_assoc($preceipts)); 
  } else { ?>
  <tr style="background-color: #ededed;">
  	<td colspan="3">No Print Orders</td>
  </tr>
  <?php } ?>
</table>

      
      </div><!-- end logoBox -->
	  </div>
      
      <div id="addNamesRight">
      	
        
      <div id="logoBox" style="width: 450px;">
      	<div class="boxHeader"><span style="float: left;">Purchase Orders</span></div>
      	<div class="boxSub" style="border-bottom: none;">
        	  <div class="boxSub2" style="display: none;"></div>
        </div>
        
       <table width="454" border="0" cellspacing="2" cellpadding="5" class="tableOrder">
  <tr style="background-color: #CCC;">
    <td width="117" align="center" valign="middle"><strong>ORDER #</strong></td>
    <td width="87" align="center" valign="middle"><strong>DATE</strong></td>
    <td width="99" align="center" valign="middle"><strong>AMOUNT</strong></td>
    <td width="101" align="center" valign="middle"><strong>STATUS</strong></td>
  </tr>
  <?php 
  if ($receipt) {
  do {
  ?>
  <tr style="background-color: #ededed;">
    <td align="center" valign="middle"><a href="<?php echo $base_url;?>/receipt.php?rid=<?php echo $receipt["id"]; ?>" target="_blank">O-<?php echo $receipt["oid"]; ?></a></td>
    <td align="center" valign="middle"><?php echo $receipt["date"]; ?></td>
    <td align="center" valign="middle"><?php echo formatMoney($receipt["totalprice"]); ?></td>
    <td align="center" valign="middle"><?php if($receipt["ostatus"]) { echo "COMPLETE"; } else { echo "PENDING"; } ?></td>
  </tr>
   <?php } while ($receipt = mysql_fetch_assoc($receipts)); 
  } else { ?>
  <tr style="background-color: #ededed;">
  	<td colspan="3">No Purchase Orders</td>
  </tr>
  <?php } ?>
  </table>

      
      </div>
        
      </div>
       <div style="clear: both"></div>
      <div id="addNamesRight">
          <div id="logoBox" style="width: 450px;">
            <div class="boxHeader"><span style="float: left;">Invoiced Orders</span></div>
            <div class="boxSub" style="border-bottom: none;">
                  <div class="boxSub2" style="display: none;"></div>
            </div>
            <table width="454" border="0" cellspacing="2" cellpadding="5" class="tableOrder">
              <tr style="background-color: #CCC;">
                <td width="137" height="28" align="center" valign="middle"><strong>INVOICE #</strong></td>
                <td width="128" align="center" valign="middle"><strong>DATE</strong></td>    
                <td width="99" align="center" valign="middle"><strong>AMOUNT</strong></td>
                <td width="147" align="center" valign="middle"><strong>STATUS</strong></td>                
              </tr>
              <?php 
              if($invoice){
                  while ($rows = mysql_fetch_assoc($invoice)){
                      
                            $sql_total  = "SELECT total FROM item_invoice WHERE invoice_id = '{$rows['invoice_id']}'";
                            //echo $sql_total;
                            $result_total = mysql_query($sql_total);
                            $total_invoice = 0;
                            $total_compare = 0;
                            if($result_total){                                
                                while($row_total = mysql_fetch_assoc($result_total)){
                                    //echo $row_total['total'].'<br />';
                                    $total_item = str_replace(',','',$row_total['total']);
                                    $total_invoice = $total_invoice  +$total_item ;
                                }
                            }
                           $discount  = str_replace('%', '', $rows['discount']);
                          
                           if((int)$discount > 0){                                
                                $total_invoice = $total_invoice  - $total_invoice*$discount/100;
                           } 
                           if ($rows["state"] == "FL") { 			
                                $taxdec = 6/100;
                                $taxtotal = $taxdec * $total_invoice;
                                $total_invoice = $taxtotal + $total_invoice;                                
                           }else {
                                $total_invoice   = $total_invoice;                    
                           }                           
                           
                           $total_invoice =  number_format(str_replace(',', '',$total_invoice),2,'.',',');    
              ?>                  
              <tr style="background-color: #ededed;">
                <td align="center" valign="middle"><a href="invoices.php?code=<?php echo $rows["code"]?>">I-<?php echo $rows["invoice_id"]; ?></a></td>
                <td align="center" valign="middle"><?php echo $rows["date"]; ?></td>  
                <td align="center" valign="middle">$<?php echo $total_invoice;?></td>
                <td align="center" valign="middle"><?php echo $rows["ostatus"];?></td>
              </tr> 
              <?php
                  };
              }
              ?>
            </table>  
         </div>
      </div>

    </div><!-- end mainContentFull -->
  
  </div><!-- end content -->
</div><!-- end wrapper -->
<div style="display: none;"><img src="/images/wizard/continueMinus.png" /></div>

<?php include_once 'inc/footer.php' ; ?>
