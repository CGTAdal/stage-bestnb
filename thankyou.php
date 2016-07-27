<?php 
require_once('admin/conn/DB.php');
include('admin/conn/tablefuncs.php');
mysql_select_db($database_DB, $ravcodb);
session_start();

$orderid = $_REQUEST["order"];
$porderid = $_REQUEST["porder"];

$pagetitle = "Buy Name Badges - Custom Name Badge Styles and Tags";
$metadescription = "Best Name Badges offers several styles of high quality badges and tags to fit your needs.  Magnetic and Pin fasteners are included free of charge.";
$metakeywords = "name badges, name tags, custom name badge, custom name tags, metal name tags, brushed aluminum name badges, plastic name tags, plastic name badges, color name badges, employee name tags, employee name badges, professional name tags, professional name badges"; 
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
	  <h2>Thank You For Your Order</h2>

	  <br /><br />
      
    
      
    
   
    
    <div id="signUpLeft" style="margin-top: 0px;">
        <div class="boxHeader"><span>Thank You For Your Order</span></div>
  		  <form method="post" action="sign-up.php">
          
          <div style="width: 100%; float: left; border-right: solid 1px #CCC; border-left: solid 1px #CCC; border-bottom: dashed 1px #CCC;">
            
            <div class="signUpField" style="border: none;">
            <div style="text-align: left; padding: 15px; ">
            <strong>Your Order Is Complete</strong>
            <br />
            We will review your order and contact you shortly. <br />
            <br />            
            <a href="/receipt.php?order=<?php echo $orderid; ?>&rid=<?php echo $_REQUEST["rid"]; ?>" target="_blank">Click Here</a> to print a receipt. <br />            
			<br />
            <a href="/p-receipt.php?order=<?php echo $porderid; ?>&rid=<?php echo $_REQUEST["pid"]; ?>" target="_blank">Click Here</a> to view your Print Order.
            </div>
          
      </div>
            
            <div style="clear: both; padding-bottom: 5px;"></div>
        <div style="clear: both; border-bottom: solid 1px #CCC; height: 15px; margin-bottom: 10px;"></div>
        <div style="clear: both;"></div>
        <div style="width: 100%; text-align: center;">
        	<p class="popBoxSmall">Your Order #: <span class="quantityNumber"><?php echo $orderid; ?></span></p>
            <p class="popBoxSmall">Your Card Was Charged: <span class="quantityNumber">$<?php echo $_REQUEST["total"]; ?></span></p>
            
         </div>
     </div>
          
		 
          </form>
        </div>
    
   
    
    
     
    </div><!-- end mainContentFull -->
  
  </div><!-- end content -->
</div><!-- end wrapper -->
<div style="display: none;"><img src="/images/wizard/continueMinus.png" /></div>

<?php include_once 'inc/footer.php' ; ?>