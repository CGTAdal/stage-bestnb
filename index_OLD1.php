<?php 
require_once('admin/conn/DB.php');
include('admin/conn/tablefuncs.php');
mysql_select_db($database_DB, $ravcodb);
session_start();

$pagetitle = "Best Name Badges - Custom Name Tags - Magnetic Full Color Plastic Badges";
$metadescription = "High quality full color name badges with the fastest and easiest ordering system available.  Free shipping. Free Magnetic or Pin fasteners for all name tag and badge orders. Plastic and brushed aluminum available.";
$metakeywords = "name badges, name tags, custom name badge, custom name tags, metal name tags, brushed aluminum name badges, plastic name tags, plastic name badges, color name badges, employee name tags, employee name badges, professional name tags, professional name badges"; 
?>
<?php 
if ($_SESSION["customerloginid"])
{
	include_once 'inc/header-auth.php';
} else {
	include_once 'inc/header.php' ;
} ?>



  <div id="hero">
    <div id="heroHeader">
    	<h1>NAME BADGE ORDERING... SIMPLIFIED.</h1>
        <p>Easy online ordering. Lightning fast <strong><u>1-day turnaround</u></strong>. Always free standard shipping. Full color.</p>
    </div>
    <div id="heroButton"><a href="/sign-up.php"><img src="images/getStartedButton.png" width="159" height="35" alt="Get Started" /></a></div>
  </div><!-- end hero -->
  
  <div id="content">
    <div id="leftColumn">
      <?php include_once 'inc/leftcolumn1.php' ; ?>
    </div><!-- end leftColumn -->
    
    <div id="mainContent">
	  <h2>Our Products</h2>
  		
        <div class="orderBox" style="width: 565px;">
       	  <div class="boxHeader"><span style="float: left;">Pro Badges</span> <span style="font-size:9px;">1.5&quot; x 3&quot; or 1&quot; x 3&quot;</span></div>
        	<div class="boxSub" style="float: left;">
        	  <div class="boxSub2">
        	    <h4 style="text-align: center; padding-bottom: 10px;">Ultra-PVC Plastic Badges and Brushed Aluminum Name Tags</h4>
        	    
                <div style="width: 100%; float: left;">
               	  <div style="width: 253px; float: left; padding-left: 10px;">
               	    <img src="images/plastic-name-badges.png" width="253" height="112" alt="Plastic Name Badges and Tags" />
                    <span style="padding-top:; display: block; float: left; width: 50px;">colors:</span><img style="float: left;" src="images/products/colors.png" width="127" height="31" alt="Colors" /></div>
                    <div style="width: 253px; float: right; padding-right: 10px;"><img src="images/brushed-aluminum-name-tags-badges.png" width="253" height="112" alt="brushed aluminum metal name tags and badges" />

                    <span style="padding-top:; display: block; float: left; width: 50px;">colors:</span><img style="float: left;" src="images/products/ba-colors.png" width="80" height="29" /></div>
                </div>
                
                <br />
<br />
	
    <div style="float: left; width: 545px; padding-top: 10px;">
    <div style="float: left; width: 250px;">
        	    <ul style="margin-top:0; margin-bottom: 0; padding-top:0; padding-bottom: 0;">
<li>Full Color Print (no restrictions)     	          </li>
<li>Up to 3 lines custom text</li>
        	      <li>Clear Protective Coating</li>
      	        </ul>
            </div>
                <div style="float: right; width: 250px;">
        	    <ul style="margin:0; padding:0; ">
<li>Magnet or Pin Fastener</li>
        	      <li>Several Colors Available</li>
        	      <li>Frames and Borders<br />
      	        </li>
      	        </ul>
          </div>
                </div>
                <div style="text-align: center; float: left; width: 100%; padding-top: 15px;">
                <span class="lowAs">Pricing Low As: </span><span class="price">$4.90</span><br /><br />
                <a href="/sign-up.php"><img src="images/getStartedButton.png" width="159" height="35" alt="Order Now" /></a><br /><br />

</div>
       	    </div></div></div>
        <div id="products" style="display: none;">
  		  <div id="productsTopLeft">
          	<h4>Pro Badges</h4>
            <h5>1.5"x3" and 1"x3"</h5>
          <div id="productsPricesLeft">
          	<span class="lowAs">Low As: </span><span class="price">$4.90</span><br />
            <a href="/sign-up.php?prod=pro"><img src="images/orderNowButton.png" width="131" height="28" alt="Get Started" class="orderButton" /></a>
          </div>
          <div id="productPricesMiddle">
          	<span class="lowAs">Low As: </span><span class="price">$4.90</span><br />
            <a href="/sign-up.php?prod=pro"><img src="images/orderNowButton.png" width="131" height="28" alt="Get Started" class="orderButton" /></a>
          </div>
          </div>
  		  <div id="productsTopRight">
            <h4>Reusable Badges</h4>
            <h5>1.5"x3" and 1"x3"</h5>
            <div id="productPricesRight">
             <span class="lowAs">Low As: </span><span class="price">$3.90</span><br />
             <img src="images/orderNowButton.png" width="131" height="28" alt="Get Started" class="orderButton" />
            </div>
          </div> 		 
        </div><!-- end products -->
        <div style="clear:both;"></div>
		<h2 style="margin-top: 20px;">Why Best Name Badges?</h2>
      <p>We offer the highest quality name badges and name tags available. When printing, we use a full color dye-sub printing process followed by a clear, protective coating to keep your name badges in pristine condition during everyday usage. Nobody beats the quality of our products. </p>
        <p>

All badges are shipped free of charge with your choice of magnetic or pin fastener at no additional cost. Most orders ship out in just 1 day. Order online instantly using our name badge ordering wizard now.
<h3>Experience The Best Name Badges Difference</h3>
<p>We are committed to providing you with the best possible name badge ordering experience.  Our core values are unwavering.  We will provide you with service that rivals a 5-star hotel, a product that exceeds your expectations, and quality materials that simply can't be beat.  Then we'll deliver them faster than anyone else. All at a competitive price.</p>
<p>From our team of dedicated name tag professionals here.  We sincerely look forward to serving you soon.</p>
<br />
<br />
</p>

<div id="slider">
	<dl class="slider" id="slider2">
		<dt></dt>
		<dd>
			<span>
            
             <ul class="top-list">
                 <li><strong>Automated Ordering System </strong>- Accounts are instantly created and you can purchase tag inventory whenever you like. Ready to order? Simply log in, add names, select a style and we'll have your badges produced and shipped out within 1 to 2 business days.</li>
                 <li><strong>Ordering Simplicity - </strong>Order extra inventory at steep discounts or just order what you need. All badges have a flat price which includes printing, fasteners, and shipping. If you choose to pre-purchase additional inventory, we'll simply deduct new orders from your inventory level.</li>
                 <li><strong>Employee Name Badges -</strong> Supervisors can create an account, purchase inventory, then provide access to their human resources department to order employee badges and tags with no need for additional payment processing. We'll just deduct new orders from your pre-purchased inventory.</li>
                 <li><strong>Any Size Orders Welcome - </strong>We take orders from 1 badge to 10,000.</li>
                 <li><strong>Best Prices - </strong>Never pay a shipping charge, no hidden fees, and the lowest cost per name badge available.</li>
                 <li><strong>Fast Turnaround Time - </strong>Most badge orders are completed in 1 - 2 business days, and oftentimes the same day.</li>
                 <li><strong>Top Notch Security - </strong>Badge orders and personal information is transferred over a secure SSL enabled, 256-bit encrypted connection. Plus we never store your billing information or credit cards and our site is 100% PCI Compliant.
              </ul>
            
            </span>
		</dd>
	</dl>
</div>

<script type="text/javascript">

var slider2=new accordion.slider("slider2");
slider2.init("slider2",15,"open");

</script>

       
        
    </div>
    <!-- end mainContent -->
  
  </div><!-- end content -->
</div><!-- end wrapper -->

<div style="display: none;"><img src="/images/sevenReasonsButtonMinus.png" /></div>

<?php include_once 'inc/footer.php' ; ?>