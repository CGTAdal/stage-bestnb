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
      	<div class="boxHeader"><span style="float: left;">Blank Name Badges</span></div>
      	<div class="boxSub" style="border-bottom: none;">
        	  <div class="boxSub2" style="display: none;"></div>
        </div>
              
              <div class="signUpField" >
            <div style="height: 30px; text-align: center; line-height: 30px; margin-top:5px; margin-bottom: 5px;"><a href="/customerpanel.php">Select A Different Product</a></div>
          
      </div>
              
         <div class="signUpField" >
        <div style="text-align: left; line-height: 30px; margin-top:5px; margin-bottom: 5px; padding-left: 20px;">
            	<h4>You have <span class="quantityNumber">6</span> Blank Badges Available- <a href="purchase.php">Purchase More Inventory</a></h4>
                <h4>You have <span class="quantityNumber">6</span> Frames Available- <a href="purchase.php">Purchase More Inventory</a></h4> 
            </div>
         </div>
              <div class="boxHeader"><span style="float: left;">Badge Selection</span></div>
         
          <div class="signUpField" style="border-top-width: 1px; border-top-style: dashed; border-top-color: #CCC;">
            <div class="signUpFieldLeft">Select A Style:</div>
            <div class="signUpFieldRight" style="width: 303px;">
            	 <select name="changestyle" id="changestyle" onchange="changecstyle(this.value)" style="height: 22px;" class="signupFieldInput">
	<option value="0">Choose One...</option>
	<?php do { ?>
	<option value="<?php echo $newstyle["id"].",".$newstyle["colorid"]; ?>"><?php echo $newstyle["name"]." - ".$newstyle["size"]." - ".$newstyle["colorname"];?></option>
	<?php } while ($newstyle = mysql_fetch_assoc($newstyles)); ?>
</select>
            </div>
          </div>
          
          <div class="signUpField">
            <div style=" line-height: 30px; margin-top:5px; margin-bottom: 5px;">
            
            <div class="boxSub" style="width: 350px; margin: auto; border: none;">
         <div class="boxSub2" style="text-align: center; float: left;">
              <div id="imageshow" name="imageshow" style="height:133px; width: 330px; float: left; margin-top: 15px;">
  				<img src="/images/loading.gif" width="75" height="75" />
  			  </div>
           <p style="float: left; font-size: 10px; width: 150px; text-align: left;">Badge Style:<br />
             <strong>Brushed Aluminum  - 1" x 3"</strong>
             </p>
             <p style="float: right; font-size: 10px; width: 60px; text-align: left;">Frame:<br />
              <strong>None</strong>
              </p>
              <p style="float: right; font-size: 10px; width: 85px; text-align: left;">Color:<br />
              <strong>Silver</strong>
              </p>
         </div>
            </div>
            
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
          
          <div class="signUpField" style="border-top-width: 1px; border-top-style: dashed; border-top-color: #CCC;">
        <div class="signUpFieldLeft">Quantity:</div>
            <div class="signUpFieldRight" style="width: 303px;">
           <input type="text" name="additionalbadges"  value="1" maxlength="10" style="width: 30px;" class="signupFieldInput" />
            </div>
     </div>
          
          <div class="signUpField" >
            <div style="height: 30px; text-align: center; line-height: 30px; margin-top:15px; margin-bottom: 15px;"><input type="image" value="submit" src="images/addProductButton.png" /></div>
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
            <div class="signUpFieldLeft" style="width: 75px; height: 48px;">Product:</div>
            <div class="signUpFieldRight" style="width: 363px; font-size: 11px; height: 48px; line-height: 14px;">
            	<div style="float: left; width: 250px;">
                <table cellpadding="0" cellspacing="0" height="48"><tr>
                  <td valign="middle"><strong>Blank Name Badges</strong><br />Quantity: 10</td></tr></table>
                </div>
                <div style="float: right; width: 100px; text-align: center; font-size: 11px;">
                <table cellpadding="0" cellspacing="0" height="48"><tr>
                  <td valign="middle">
                Fastener: Pin<br />
                Frame: None <br />
                <a href="remove">Remove</a>
                </td></tr></table>
                </div>
            </div>
        </div>
       <!-- end name -->
        
        
       <!-- name -->
        <div class="signUpField" style="border-top-width: 1px; border-top-style: dashed; border-top-color: #CCC;">
            <div class="signUpFieldLeft" style="width: 75px; height: 48px;">Name 1:</div>
            <div class="signUpFieldRight" style="width: 363px; font-size: 11px; height: 48px; line-height: 14px;">
            	<div style="float: left; width: 250px;">
                <table cellpadding="0" cellspacing="0" height="48"><tr><td valign="middle">
                	<strong>Line 1:</strong>  Testing Name <br />
                	<strong>Line 2:</strong>  Testing Name <br />
                	<strong>Line 3:</strong>  Testing Name <br />
                 </td></tr></table>
                </div>
                <div style="float: right; width: 100px; text-align: center; font-size: 11px;">
                <table cellpadding="0" cellspacing="0" height="48"><tr>
                  <td valign="middle">
                Fastener: Magnet<br />
                Frame: Silver<br />
                <a href="remove">Remove Name</a>
                </td></tr></table>
                </div>
            </div>
        </div>
             
       <!-- name -->
      <div class="signUpField" style="border-top-width: 1px; border-top-style: dashed; border-top-color: #CCC;">
            <div class="signUpFieldLeft" style="width: 75px; height: 48px;">Name 2:</div>
            <div class="signUpFieldRight" style="width: 363px; font-size: 11px; height: 48px; line-height: 14px;">
            	<div style="float: left; width: 250px;">
                <table cellpadding="0" cellspacing="0" height="48"><tr>
                  <td valign="middle"><strong>&lt; BLANK &gt;</strong></td></tr></table>
                </div>
                <div style="float: right; width: 100px; text-align: center; font-size: 11px;">
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
       
      
        
      </div>
      

    </div><!-- end mainContentFull -->
  
  </div><!-- end content -->
</div><!-- end wrapper -->
<div style="display: none;"><img src="/images/wizard/continueMinus.png" /></div>

<?php include_once 'inc/footer.php' ; ?>