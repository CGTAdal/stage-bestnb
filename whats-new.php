<?php 
require_once('admin/conn/DB.php');
include('admin/conn/tablefuncs.php');
mysql_select_db($database_DB, $ravcodb);
session_start();

$pagetitle = "Whats New at Best Name Badges - Custom Name Tags, Magnetic Name Badges";
$metadescription = "Best Name Badges is always introducing new and exciting products for your name badge needs.  Such as domes and doming, full color prints, name badge frames, and much more.";
$metakeywords = "name badges, name tags, custom name badge, custom name tags, metal name tags, brushed aluminum name badges, plastic name tags, plastic name badges, color name badges, employee name tags, employee name badges, professional name tags, professional name badges"; 
?>
<?php 
if ($_SESSION["customerloginid"])
{
	include_once 'inc/header-auth.php';
} else {
	include_once 'inc/header_new.php' ;
} ?>

<div id="hero" class="herobgnone">
  <img src="images/heroBG.jpg"  />
  <div id="heroHeader" class="heroheadrnone">
    &nbsp;
  </div>
  
 
</div>
<!-- end hero -->
  
  <div id="content">
    <div id="leftColumn">
    <?php include_once 'inc/leftcolumn3.php' ; ?>
    </div><!-- end leftColumn -->
    
    <div id="mainContent">
    
    	
    <div class="subright flr">
	  <h2>What's New?</h2>
  		<br />
<br />

        
        <h3>Laser Engraving!</h3>
        <p>Are you looking for engraved name badges?  Custom shapes and sizes?  Our new, top of the line laser engraver and laser cutter can do the job. </p>
        <p>We have put off adding laser engraving because we were never satisfied with the results.  That is, until now.  Our laser can produce the quality that our customers have come to expect from Best Name Badges.</p>
        <p>If you need engraved badges or custom shapes, place your order today and we'll have them shipped out tomorrow!</p>
        <hr />
  		<br />
      <h3>We Have Added 2 New Printers!</h3>
        <p>In our efforts to stay ahead of the competition and provide badges that far exceed anything else on the market, we are adding 2 additional printers to our setup. </p>
        <p>These  new printers use a high definition technology that is custom built just for Best Name Badges, this means, you won't find this quality anywhere else. Our full color badges of all sizes, including photo IDs, full bleed badges, and regular logo badges are benefiting from our new technology.</p>
        <p>We continue to bring these innovations to our customers at the same low cost. In fact, we have lowered our prices and even introduced promotions to save you more money. We are always looking for ways to decrease costs and provide better and better products. We prefer to innovate rather than follow, and our customers ultimately benefit through better quality badges at prices that seem to just get lower and lower.<br />
        </p>
        <hr />
          <p>Best Name Badges doesn't just have a new look, we have an entire new system! After months of hard work, we are excited to present the new Best Name Badges website.</p>
          <p>The new Best Name Badges website is focused on the customer experience. Every step and every interaction was carefully thought out and implemented to provide the simplest and most logical interactive experience for our customers.</p>
<p>We always had a pen and paper handy when our customers were giving us suggestions. We appreciated all the feedback and have added many new features, several of which were the ideas of our customers.</p>
          <p><strong>Some notable new features include:</strong></p>
          
          <style> ul#listNew li {	padding-bottom: 10px;	} </style>
          <ul id="listNew">
            <li><strong>New Ordering Process.</strong> We have added new options and streamlined the ordering process. Enjoy a faster, simpler, easier way to order your name badges online.</li>
            <li><strong>More Stable.</strong> The new name badge site has been re-coded from the ground up to provide a more stable environment. No more errors.</li>
            <li><strong>Order Receipts.</strong> Get a receipt for all your ordering transactions. Both purchase orders as well as print orders will now be accompanied by a printable receipt.</li>
            <li><strong>Order Archives and Status Updates.</strong> View all your previous orders for both print orders and purchase orders. You can also now view the status of your orders on this page, see when your orders ship.</li>
            <li><strong>New Payment Processor.</strong> We have switched to a new payment processor. The Best Name Badges website is now more secure than ever with full PCI compliance. Our new payment engine gives us several new options, on our short list of updates, we'll be adding a totally secure credit card vault, so you can access your billing information without having to re-enter it.</li>
            <li><strong>Simpler Print Orders.</strong> It's now easier than ever to order new tags from your customer panel.</li>
            <li><strong>Updated Platform.</strong> The new website provides us a much more streamlined platform so we can continue to offer you new products and services. Expect to see several new products in the coming months.</li>
          </ul>
     </div>      
    <div style="clear: both;"></div>
     <div class="testimonials">
        <h2>Customer testimonials</h2>
        <ul>
        	<li>
            	<span class="dot dot1">&nbsp;</span>
                <span class="dot dot2">&nbsp;</span>
                <p>The badges just arrived and we are exceptionally pleased. Thank you for your patience to get everything right and the best they could look. </p>
                <p>Please thank everyone who assisted you at best name badges!!!</p>
				<p align="right"><strong>-L. Flippen, UMEA</strong></p>
            </li>
            <li>
            	<span class="dot dot1">&nbsp;</span>
                <span class="dot dot2">&nbsp;</span>
                <p>The badges just arrived and we are exceptionally pleased. Thank you for your patience to get everything right and the best they could look. </p>
                <p>Please thank everyone who assisted you at best name badges!!!</p>
				<p align="right"><strong>-L. Flippen, UMEA</strong></p>
            </li>
        </ul>
        <p align="right" class="clb"><strong><a href="#"><span style="vertical-align:text-bottom;">&raquo;</span> Read More Testimonials</a></strong></p>
    </div>
           
    </div><!-- end mainContent -->
  
  </div><!-- end content -->
</div><!-- end wrapper -->

<div style="display: none;"><img src="/images/sevenReasonsButtonMinus.png" /></div>

<?php include_once 'inc/footer.php' ; ?>