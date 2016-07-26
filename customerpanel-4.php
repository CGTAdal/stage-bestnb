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
	  <h2>Order Name Badges</h2>

	  <br /><br />
      
     
      
	  <div id="addNamesLeft">	  
      <div id="logoBox" style="width: 450px;">
      	<div class="boxHeader"><span style="float: left;">Full Color Pro Name Badges</span></div>
      	<div class="boxSub" style="border-bottom: none;">
        	  <div class="boxSub2" style="display: none;"></div>
        </div>
              
              <div class="signUpField" >
            <div style="height: 30px; text-align: center; line-height: 30px; margin-top:5px; margin-bottom: 5px;"><a href="/customerpanel.php">Select A Different Product</a></div>
          
      </div>
              
         <div class="signUpField" >
        <div class="customerpanel2-fullcolorouterdiv">
            	<h4>You have never purchased a Pro Name Badge before. Please create your first badge by <a href="/order.php?product=pro">clicking here.</a></h4>
        </div>
         </div>
      </div><!-- end logoBox -->
	  </div>
      
      <div id="addNamesRight">
      	<div class="boxHeader"><span style="float: left;">Names List</span></div>
        
        <div class="signUpField" style="border-top-width: 1px; border-top-style: dashed; border-top-color: #CCC;">
            
  <div class="signUpFieldRight" style="width: 363px; font-size: 11px; height: 48px; line-height: 14px;">
            	<div style="float: left; width: 250px;" class="customerpanel2-name-left">
                <table cellpadding="0" cellspacing="0" height="48"><tr>
                  <td valign="middle"><strong>NO NAMES ADDED YET.</strong></td></tr></table>
                </div>
      </div>
        </div>
        
        
       <!-- name -->
       <!-- end name -->
       
       <!-- name -->
       <!-- end name -->
       
       <!-- name -->
       <!-- end name -->
       
       <!-- name -->
       <!-- end name -->
       
       <!-- name -->
       <!-- end name -->
       
       <!-- name -->
       <!-- end name -->
       
       <!-- name -->
       <!-- end name -->
       
       <!-- name -->
       <!-- end name -->
        
      </div>
      

    </div><!-- end mainContentFull -->
  
  </div><!-- end content -->
</div><!-- end wrapper -->
<div style="display: none;"><img src="/images/wizard/continueMinus.png" /></div>

<?php include_once 'inc/footer.php' ; ?>