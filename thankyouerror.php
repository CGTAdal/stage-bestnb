<?php 
require_once('admin/conn/DB.php');
include('admin/conn/tablefuncs.php');
mysql_select_db($database_DB, $ravcodb);
session_start();

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
	  <h2>Error Processing Order</h2>

	  <br /><br />
      
      <div style="width: 960px;">
      <div style="width: 400px; float: right;">
      
    
    
    
    </div>
    
    <div style="width: 500px; float: left;">
    
    <div id="signUpLeft" style="margin-top: 0px;">
        <div class="boxHeader"><span>Error Processing Order</span></div>
  		  <form method="post" action="sign-up.php">
          
          <div style="width: 500px; float: left; border-right: solid 1px #CCC; border-left: solid 1px #CCC; border-bottom: dashed 1px #CCC;">
            
            <div class="signUpField" style="border: none;">
            <div style="text-align: left; padding: 15px; ">
            <strong>Your Order Is NOT Complete</strong>
            <br />
           <?php echo $_REQUEST["message"]; ?>
            </div>
          
      </div>
            
            <div style="clear: both; padding-bottom: 5px;"></div>
        <div style="clear: both; border-bottom: solid 1px #CCC; height: 15px; margin-bottom: 10px;"></div>
        <div style="clear: both;"></div>
        <div style="width: 500px; text-align: center;">
        
         </div>
     </div>
          
		 
          </form>
        </div>
    
    </div>
    
    
      </div>
    </div><!-- end mainContentFull -->
  
  </div><!-- end content -->
</div><!-- end wrapper -->
<div style="display: none;"><img src="/images/wizard/continueMinus.png" /></div>

<?php include_once 'inc/footer.php' ; ?>