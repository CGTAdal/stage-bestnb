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
        <div class="customerpanel2-fullcolorouterdiv" >
            	<h4>You have <span class="quantityNumber">24</span> Pro Badges Available- <a href="purchase.php">Purchase More Inventory</a></h4>
                <h4>You have <span class="quantityNumber">24</span> Frames Available- <a href="purchase.php">Purchase More Inventory</a></h4> 
                <h4>Need a new badge design?- <a href="/order.php?product=pro">Purchase A New Style</a></h4> 
            </div>
         </div>
              <div class="boxHeader"><span style="float: left;">Add A Name</span></div>
      <div class="signUpField" style="border-top-width: 1px; border-top-style: dashed; border-top-color: #CCC;">
            <div class="signUpFieldLeft" style="height: 95px;">Text:</div>
            <div class="signUpFieldRight coustmpanel2-rightdiv" style="height: 95px; width: 303px;">
           		Line 1: <input type="text" name="text1"  style="width: 200px;" class="signupFieldInput"/><br />
                Line 2: <input type="text" name="text2"  style="width: 200px;" class="signupFieldInput"/><br />
                Line 3: <input type="text" name="text3"  style="width: 200px;" class="signupFieldInput"/>	
            </div>
          </div>
          
          <div class="signUpField" >
            <div style=" text-align: center; line-height: 30px; margin-top:5px; margin-bottom: 5px;">
            	
                <h4>Select A Badge Style:</h4>
                
                <!-- ITEM -->
                <div  class="customerpanel2-radiooutre">
                	<img src="/images/fillerBadge.jpg" width="185" /><br />

                    <input type="radio" name="badge" value="1" /> <strong>Test Style</strong>
              </div>
                <!-- END ITEM -->

                <!-- ITEM -->
                <div class="customerpanel2-radiooutre"><img src="/images/fillerBadge.jpg" width="185" /><br />

                    <input type="radio" name="badge" value="2" />
                    <strong>Gold Badge</strong>
                </div>
                <!-- END ITEM -->
                           
            </div>
          </div>
          
          <div class="signUpField" style="border-top-width: 1px; border-top-style: dashed; border-top-color: #CCC;">
            <div class="signUpFieldLeft">Fastener:</div>
            <div class="signUpFieldRight" style="width: 303px;">
            <input type="hidden" name="tag" value="1" />
<input type="radio" name="fastener" value="none"/> None&nbsp;&nbsp;<input type="radio" name="fastener" value="magnet" checked /> Magnet&nbsp;&nbsp;<input type="radio" name="fastener" value="pin" /> Pin
            </div>
          </div>
          
          <div class="signUpField" style="border-top-width: 1px; border-top-style: dashed; border-top-color: #CCC;">
            <div class="signUpFieldLeft">Frame:</div>
            <div class="signUpFieldRight" style="width: 303px;">
            <input type="hidden" name="tag" value="1" />
<input type="radio" name="frame" value="none" checked/> None&nbsp;&nbsp;<input type="radio" name="frame" value="silver" /> Silver&nbsp;&nbsp;<input type="radio" name="frame" value="gold" /> Gold
            </div>
          </div>
          
          
          
          <div class="signUpField" >
            <div style="height: 30px; text-align: center; line-height: 30px; margin-top:15px; margin-bottom: 15px;"><input type="image" value="submit" src="images/addNameButton.png" /></div>
          </div>
          
                   
          
     </div><!-- end logoBox -->
	  </div>
      
      <div id="addNamesRight">
      	<div class="boxHeader"><span style="float: left;">Names List</span></div>
        
        <div class="signUpField" >
            <div style="text-align: center; line-height: 30px; margin-top:15px; margin-bottom: 15px;">
            <p style="margin: 0; padding: 0; line-height: 14px;">
            <h4 style="margin:0; padding: 0; line-height: 15px;">Finished?</h4>  Click "Place Order" to submit your order to us for production.</p>
            <br />
            <input type="image" value="submit" src="images/placeOrderButton.png" />
            </div>
          </div>
        
        
       <!-- name -->
        <div class="signUpField" style="border-top-width: 1px; border-top-style: dashed; border-top-color: #CCC;">
            <div class="signUpFieldLeft" style="width: 75px; height: 48px;">Name 1:</div>
            <div class="signUpFieldRight" style="width: 363px; font-size: 11px; height: 48px; line-height: 14px;">
            	<div style="float: left; width: 250px;" class="customerpanel2-name-left">
                <table cellpadding="0" cellspacing="0" height="48"><tr><td valign="middle">
                	<strong>Line 1:</strong>  Testing Name <br />
                	<strong>Line 2:</strong>  Testing Name <br />
                	<strong>Line 3:</strong>  Testing Name <br />
                 </td></tr></table>
                </div>
                <div style="float: right; width: 100px; text-align: center; font-size: 11px;" class="customerpanel2-name-right">
                <table cellpadding="0" cellspacing="0" height="48"><tr>
                  <td valign="middle">
                Fastener: Magnet<br />
                Frame: Silver<br />
                <a href="remove">Remove Name</a>
                </td></tr></table>
                </div>
            </div>
        </div>
       <!-- end name -->
       
       <!-- name -->
       <!-- end name -->
       
       <!-- name -->
       <!-- end name -->
       
       <!-- name -->
      <div class="signUpField" style="border-top-width: 1px; border-top-style: dashed; border-top-color: #CCC;">
            <div class="signUpFieldLeft" style="width: 75px; height: 48px;">Name 2:</div>
            <div class="signUpFieldRight" style="width: 363px; font-size: 11px; height: 48px; line-height: 14px;">
            	<div style="float: left; width: 250px;" class="customerpanel2-name-left">
                <table cellpadding="0" cellspacing="0" height="48"><tr>
                  <td valign="middle"><strong>&lt; BLANK &gt;</strong></td></tr></table>
                </div>
                <div style="float: right; width: 100px; text-align: center; font-size: 11px;" class="customerpanel2-name-right">
                <table cellpadding="0" cellspacing="0" height="48"><tr>
                  <td valign="middle">
                Fastener: Pin<br />
                Frame: None <br />
                <a href="remove">Remove Name</a>
                </td></tr></table>
                </div>
            </div>
        </div>
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