<?php 
require_once('admin/conn/DB.php');
include('admin/conn/tablefuncs.php');
mysql_select_db($database_DB, $ravcodb);
session_start();

$pagetitle = "Name Badge Pricing - Employee Professional Name Tags";
$metadescription = "The best prices on the highest quality name badges and tags in the industry.  Always free shipping plus free magnetic and pin fasteners.";
$metakeywords = "name badges, name tags, custom name badge, custom name tags, metal name tags, brushed aluminum name badges, plastic name tags, plastic name badges, color name badges, employee name tags, employee name badges, professional name tags, professional name badges"; 
?>
<?php 
if ($_SESSION["customerloginid"])
{
	include_once 'inc/header-auth.php';
} else {
	include_once 'inc/header.php' ;
} ?>



  <div id="hero" class="herobgnone">
    <img src="images/heroBG.jpg"  />
    <div id="heroHeader" class="heroheadrnone">
    	<h1>Best Prices. Best Quality. Best Name Badges.</h1>
        <p>The <strong><u>Highest Quality On The Market</u></strong>. Always The <strong><u>Lowest Prices</u></strong>. Lightning fast <strong><u>1-day turnaround</u></strong>.</p>
    </div>
    <div id="heroButton" class="header-activated-button"><a href="/sign-up.php"><img src="images/getStartedButton.png" width="159" height="35" alt="Get Started" /></a></div>
  </div><!-- end hero -->
  
  <div id="content">
    <div id="leftColumn">
      <?php include_once 'inc/leftcolumn1.php' ; ?>
    </div><!-- end leftColumn -->
    
    <div id="mainContent">
       <div class="b-all-rightdiv">
	  <h2>Name Badge Pricing</h2>
  		<h4>Full Color. Free Magnet or Pin Fasteners. Free Shipping</h4>
        <br />
	<h3 style="text-align: center;">Prices Just Reduced! No Minimum Orders!</h3>
    
    <p style="text-align: center;">We offer <strong>flat rate pricing</strong> on our name badges.  Regardless of lines of text, color, material, or size options - the price remains the same.  We won't "nickel and dime" you either with hidden costs.</p>
    
    <h3 style="text-align: center;">Special!
    <br />Save 10% Off All Orders.<br />
    Use Promo Code <span style="color: #F00;">WINTER10</span> at checkout
    </h3>
    
    <p style="text-align:center;"><span style="font-size: 18px; color: #F00;">WE ACCEPT COMPETITORS COUPONS!</span><br />We'll beat any competitors pricing and even accept their coupons.  Not only that, but you'll receive a better product along with better service and a faster delivery.</p>
    
    <br />

<h3>Pro Name Badges:</h3>
<br />
<div  class="pricing-table-outer">
<table width="565" border="0" align="center" cellpadding="2" cellspacing="3" style="font-size: 11px;">
  <tr>
    <td width="113" align="center" bgcolor="#738539"><strong style="color: #FFF">Badge Quantity</strong></td>
    <td width="126" align="center" bgcolor="#738539"><strong style="color: #FFF">Price</strong></td>
    <td width="82" align="center" bgcolor="#738539"><strong style="color: #FFF">Colors</strong></td>
    <td width="129" align="center" bgcolor="#738539"><strong style="color: #FFF">Fastener<br />
    </strong></td>
    <td width="77" align="center" bgcolor="#738539"><strong style="color: #FFF">Shipping</strong></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#ececec">1 - 10</td>
    <td align="center" bgcolor="#ececec"><span style="text-decoration:line-through;">$<?php echo $pricepro1sale ; ?>/ea</span><br />
      <span style="color:#F00;">$8.43/ea (with coupon)</span></td>
    <td align="center" bgcolor="#ececec">Full Color</td>
    <td align="center" bgcolor="#ececec">Magnet or Pin Included</td>
    <td align="center" bgcolor="#ececec">Free</td>
  </tr>
  <tr>
    <td align="center" bgcolor="#ececec">11-25</td>
    <td align="center" bgcolor="#ececec"><span style="text-decoration:line-through;">$<?php echo $pricepro2sale ; ?>/ea</span><br />
      <span style="color:#F00;">$7.29/ea (with coupon)</span></td>
    <td align="center" bgcolor="#ececec">Full Color</td>
    <td align="center" bgcolor="#ececec">Magnet or Pin Included</td>
    <td align="center" bgcolor="#ececec">Free</td>
  </tr>
  <tr>
    <td align="center" bgcolor="#ececec">26-50</td>
    <td align="center" bgcolor="#ececec"><span style="text-decoration:line-through;">$<?php echo $pricepro3sale ; ?>/ea</span><br />
      <span style="color:#F00;">$6.16/ea (with coupon)</span></td>
    <td align="center" bgcolor="#ececec">Full Color</td>
    <td align="center" bgcolor="#ececec">Magnet or Pin Included</td>
    <td align="center" bgcolor="#ececec">Free</td>
  </tr>
  <tr>
    <td align="center" bgcolor="#ececec">51-100</td>
    <td align="center" bgcolor="#ececec"><span style="text-decoration:line-through;">$<?php echo $pricepro4sale ; ?>/ea</span><br />
      <span style="color:#F00;">$5.35/ea (with coupon)</span></td>
    <td align="center" bgcolor="#ececec">Full Color</td>
    <td align="center" bgcolor="#ececec">Magnet or Pin Included</td>
    <td align="center" bgcolor="#ececec">Free</td>
  </tr>
  <tr>
    <td align="center" bgcolor="#ececec">101-250</td>
    <td align="center" bgcolor="#ececec"><span style="text-decoration:line-through;">$<?php echo $pricepro5sale ; ?>/ea</span><br />
      <span style="color:#F00;">$5.08/ea (with coupon)</span></td>
    <td align="center" bgcolor="#ececec">Full Color</td>
    <td align="center" bgcolor="#ececec">Magnet or Pin Included</td>
    <td align="center" bgcolor="#ececec">Free</td>
  </tr>
  <tr>
    <td align="center" bgcolor="#ececec">251-1000</td>
    <td align="center" bgcolor="#ececec"><span style="text-decoration:line-through;">$<?php echo $pricepro6sale ; ?>/ea</span><br />
      <span style="color:#F00;">$4.41/ea (with coupon)</span></td>
    <td align="center" bgcolor="#ececec">Full Color</td>
    <td align="center" bgcolor="#ececec">Magnet or Pin Included</td>
    <td align="center" bgcolor="#ececec">Free</td>
  </tr>
  <tr>
    <td align="center" bgcolor="#ececec">1001 - 10000</td>
    <td align="center" bgcolor="#ececec"><span style="text-decoration:line-through;">$<?php echo $pricepro7sale ; ?>/ea</span><br />
      <span style="color:#F00;">$3.50/ea (with coupon)</span></td>
    <td align="center" bgcolor="#ececec">Full Color</td>
    <td align="center" bgcolor="#ececec">Magnet or Pin Included</td>
    <td align="center" bgcolor="#ececec">Free</td>
  </tr>
  <tr>
    <td align="center" bgcolor="#738539"><strong style="color:#FFF;">Badge Frames</strong></td>
    <td align="center" bgcolor="#738539"><strong style="color:#FFF;">Price</strong></td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center" bgcolor="#ececec">All Sizes/Colors</td>
    <td align="center" bgcolor="#ececec">$<?php echo $priceframes ;?>/ea</td>
    <td align="center" bgcolor="#ececec">&nbsp;</td>
    <td align="center" bgcolor="#ececec">&nbsp;</td>
    <td align="center" bgcolor="#ececec">&nbsp;</td>
  </tr>
  <tr>
    <td align="center" bgcolor="#738539"><strong style="color:#FFF;">Badge Domes</strong></td>
    <td align="center" bgcolor="#738539"><strong style="color:#FFF;">Price</strong></td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center" bgcolor="#ececec">Polyurethane Domed Lens</td>
    <td align="center" bgcolor="#ececec">$2.75/ea</td>
    <td align="center" bgcolor="#ececec">&nbsp;</td>
    <td align="center" bgcolor="#ececec">&nbsp;</td>
    <td align="center" bgcolor="#ececec">&nbsp;</td>
  </tr>
</table>
</div>
<br />
      <p>Compare us to any competitor and look out for hidden fees! Not only do we include shipping, but we include the fastener as well. Once you purchase your name badge inventory there are no more charges. Plus you can save money by pre-paying for as many as you like.</p>

<h3>Large Name Tag Order?</h3>
<p>No problem. We can handle name tag and name badge orders of any size. We use the latest printing machinery and our production floor is accustomed to high volume badge ordering procedures.  Call us now for a custom quote.</p>

<h3>Ready To Buy Name Badges?</h3>
<p>Our staff is geared up and ready to make your name badges. Let us prove to you why we are the internets #1 source for quality custom name badges. <a href="/order2.php">Click here</a> to order. </p>
     </div>
    </div><!-- end mainContent -->
  
  </div><!-- end content -->
</div><!-- end wrapper -->

<div style="display: none;"><img src="/images/sevenReasonsButtonMinus.png" /></div>

<?php include_once 'inc/footer.php' ; ?>