<?php 
require_once('admin/conn/DB.php');
include('admin/conn/tablefuncs.php');
mysql_select_db($database_DB, $ravcodb);
session_start();

$pagetitle = "Corporate Name Badge Ordering - Name Tags - Best Name Badges";
$metadescription = "We are the largest supplier of name badges to corporate businesses in North America. We cater to corporate customers with our simple name tag ordering system and inventory systems.";
$metakeywords = "name badges, name tags, custom name badge, custom name tags, metal name tags, brushed aluminum name badges, plastic name tags, plastic name badges, color name badges, employee name tags, employee name badges, professional name tags, professional name badges"; 
?>
<?php 
if ($_SESSION["customerloginid"])
{
	include_once 'inc/header-auth.php';
} else {
	//include_once 'inc/header.php' ;
	include_once 'inc/header_new.php' ;
} ?>

  <div id="hero" class="herobgnone">
  <img src="images/heroBG.jpg"  />
  <!--<div id="heroHeader">
    &nbsp;
  </div>-->
  

</div>
  <!-- end hero -->
  
  <div id="content">
    <div id="leftColumn">
     <?php include_once 'inc/leftcolumn3.php' ; ?>
    </div><!-- end leftColumn -->
    
    <div id="mainContent">
    	
    <div class="subright flr">
		  <h2>Corporate Name Badges</h2>
	  		<h4>Simple And Cost Effective Name Tag Ordering</h4>
	      <p>Thank you for your interest in our corporate offerings.  Best Name Badges is one of the only name badge companies that has fully developed corporate name badge ordering systems in place.</p>
	      <p>We offer the absolute lowest pricing on name badges at any quantity. Our experienced staff provides individualized service and can help you with nearly any request. You will know exactly who to call and you will always work with the same two person customer service team. Why two people? Because you shouldn't be left in the dark when your account representative is on vacation or out sick.</p>
	      <h3>Let Our Experience Make It Easy!</h3>
	      <p>We handle many large corporate clients. From fulfilling pre-made packs to making badges on demand. We are happy to accept PO's and can invoice as needed. Our staff is knowledgeable and always has the answers. We understand that ordering name tags isn't the most important part of your day - so we are happy to customize a plan for you and make the process as simple as possible.</p>
	      <p><img src="images/corporate-ordering.jpg" width="702" height="257" alt="Corporate Name Badge and Bulk Ordering" /></p>
	      <h3>Inventory Based System (Optional)</h3>
<p>Out of the box, we have a simplistic inventory based system, allowing you to purchase in bulk at steep discounts. Imagine, you hire a new employee or need a replacement badge. So you simply log in to the Best Name Badges site, add a name, click &quot;submit&quot; then go on with your day. Your badge shows up in just 1 - 3 days. No additional accounting, no additional charges, no shipping charges, nothing. Many customers purchase bulk inventory then allow their human resources department or assistants to handle the name badges as needed.</p>
<p>This is fully optional, of course, and we are happy to customize a plan to meet your needs.</p>
<h3>Customization, Fulfillment, And More</h3>
<p>Our technology team can create fully custom solutions just for you. Integrating into your existing systems is no problem. We even have our own ecommerce platform that can be rolled out easily, allowing you to setup a company store for your franchises and additional locations to order from a centralized site.</p>
<p>Best Name Badges also offers full <strong>in-house product fulfillment.</strong> We fulfill way more than just name badges. We can store your existing products, or can handle production of a wide range of promotional products, t-shirts, polos, general merchandise, and more! </p>
<p>We have air conditioned, safe storage. All products are securely stored and locked, under video surveillance with GSM offsite monitoring. Take advantage of our highly efficient shipping team who can fulfill orders the same day they are received via FedEx or USPS. We can even handle call center services and phone ordering.</p>
	      <p>&nbsp;</p>
	        
	      </p>
	</div>      
    </div><!-- end mainContent -->
  
  </div><!-- end content -->
</div><!-- end wrapper -->

<div style="display: none;"><img src="/images/sevenReasonsButtonMinus.png" /></div>

<?php include_once 'inc/footer.php' ; ?>