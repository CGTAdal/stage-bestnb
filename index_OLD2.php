<?php
    
require_once('admin/conn/DB.php');
include('admin/conn/tablefuncs.php');

include('include/config.php');

mysql_select_db($database_DB, $ravcodb);

session_start();



$pagetitle = "Best Name Badges - Custom Name Tags - Magnetic Full Color Badges Plastic";

$metadescription = "Best Prices On high quality full color name badges with the fastest and easiest ordering system available.  Free shipping. Free Magnetic or Pin fasteners for all name tag and badge orders. Plastic and brushed aluminum available.";

$metakeywords = "name badges, name tags, custom name badge, custom name tags, metal name tags, brushed aluminum name badges, plastic name tags, plastic name badges, color name badges, employee name tags, employee name badges, professional name tags, professional name badges"; 

?>
<?php 

if ($_SESSION["customerloginid"])

{

	include_once 'inc/header-auth.php';

} else {

	include_once 'inc/header.php' ;

} ?>
<script type="text/javascript" src="js/slider.js"></script>

<div id="hero">
  <div id="heroHeader">
    &nbsp;
  </div>
  
</div>
<!-- end hero -->
<?php
  /*$referer= $_SERVER['HTTP_REFERER'];

    //find the search query from google that brought them here
    $qref= strpos($referer,'google');

    if($qref!=''){
    $qstart = strpos($referer,'q=');
    $qend = strpos($referer,'&',$qstart);
    $qtext= substr($referer,$qstart+2,$qend-$qstart-2);
    $qtext= str_replace('+',' ',$qtext);
    }
    echo $qtext.'AAA';*/
  
?>
<div id="content">
  <div id="leftColumn">
    <?php include_once 'inc/leftcolumn1_new.php' ; ?>
  </div>
  <!-- end leftColumn -->
  
  <div id="mainContent">
    <h2>Our Products</h2>
    <div class="box-products clb">
        <div class="orderBox">
          <div class="boxHeader"><span style="float: left;">Digitally Printed Pro Badges</span></div>
          <div class="boxSub" style="float: left;">
            <div class="boxSub2">
              <div style="width: 100%; float: left;">
                <div style="width: 253px; float: left;"> <a href="/printed-name-badges.php"><img src="images/digitally-printed-pro-badges.jpg" width="249" height="128" alt="Full Color Digitally Printed Name Badges" /></a></div>
              </div>
              <br />
              <br />
              <div style="float: left; width: 253px; padding-top: 10px;">
                <div style="float: left; width: 250px;">
                  <ul style="margin-top:0; margin-bottom: 0; padding-top:0; padding-bottom: 0;">
                    <li>Full Color Crystal Clear Print </li>
                    <li>Custom Colors, Shapes and Sizes</li>
                    <li>Frames, Doming, Beveling and more!</li>
                  </ul>
                </div>
              </div>
              <div style="text-align: center; float: left; width: 100%; padding-top: 15px;"> <span class="lowAs">Pricing From: </span><span class="price">$0.92 - $6.35</span><br />
                <br />
                <a href="/printed-name-badges.php"><img src="images/view-printed.jpg" width="160" height="35" alt="View Printed Tag Options" /></a><br />
                <br />
              </div>
            </div>
          </div>
        </div>
        <!--End one product-->
        <div class="orderBox">
          <div class="boxHeader"><span style="float: left;">Engraved Name Tags</span></div>
          <div class="boxSub" style="float: left;">
            <div class="boxSub2">
              <div style="width: 100%; float: left;">
                <div style="width: 253px; float: left;"> <a href="/engraved-name-badges.php"><img src="images/engraved-name-tags.jpg" width="249" height="128" alt="Laser Engraved Name Tags" /></a></div>
              </div>
              <br />
              <br />
              <div style="float: left; width: 253px; padding-top: 10px;">
                <div style="float: left; width: 250px;">
                  <ul style="margin-top:0; margin-bottom: 0; padding-top:0; padding-bottom: 0;">
                    <li>Laser Engraved Quality</li>
                    <li>Custom Colors and Sizes</li>
                    <li>Ovals, Frames, and more!</li>
                  </ul>
                </div>
              </div>
              <div style="text-align: center; float: left; width: 100%; padding-top: 15px;"> <span class="lowAs">Pricing From: </span><span class="price">$0.77 - $6.20</span><br />
                <br />
                <a href="/engraved-name-badges.php"><img src="images/view-engraved.jpg" width="160" height="35" alt="View Engraved Name Tags" /></a><br />
                <br />
              </div>
            </div>
          </div>
        </div>
        <!--End one product-->
        <div class="orderBox">
          <div class="boxHeader"><span style="float: left;">Reusable Name Badges</span></div>
          <div class="boxSub" style="float: left;">
            <div class="boxSub2">
              <div style="width: 100%; float: left;">
                <div style="width: 253px; float: left;"> <a href="/reusable-name-badges.php"><img src="images/reusable-name-badges.jpg" width="249" height="128" alt="Reusable Name Badges and Tags" /></a></div>
              </div>
              <br />
              <br />
              <div style="float: left; width: 253px; padding-top: 10px;">
                <div style="float: left; width: 250px;">
                  <ul style="margin-top:0; margin-bottom: 0; padding-top:0; padding-bottom: 0;">
                    <li>8 Shapes and Sizes</li>
                    <li>Super Easy To Use</li>
                    <li>Print On Any InkJet or Laser Printer</li>
                  </ul>
                </div>
              </div>
              <div style="text-align: center; float: left; width: 100%; padding-top: 15px;"> <span class="lowAs">Pricing From: </span><span class="price">$1.75 - $4.35</span><br />
                <br />
                <a href="/reusable-name-badges.php"><img src="images/view-reusable.jpg" width="160" height="35" alt="View Reusable Name Tags" /></a><br />
                <br />
              </div>
            </div>
          </div>
        </div>
        <!--End one product-->
        <div class="orderBox">
          <div class="boxHeader"><span style="float: left;">Photo ID Badges</span></div>
          <div class="boxSub" style="float: left;">
            <div class="boxSub2">
              <div style="width: 100%; float: left;">
                <div style="width: 253px; float: left;"><a href="/photo-id-badges.php"><img src="images/photo-id-badges.jpg" width="249" height="128" alt="Photo ID Badges and Identity Cards" /></a></div>
              </div>
              <br />
              <br />
              <div style="float: left; width: 253px; padding-top: 10px;">
                <div style="float: left; width: 250px;">
                  <ul style="margin-top:0; margin-bottom: 0; padding-top:0; padding-bottom: 0;">
                    <li>High Definition, Full Color Print</li>
                    <li>Lanyards / Clips / Magnets / Pins</li>
                    <li>Clear Protective Coating</li>
                  </ul>
                </div>
              </div>
              <div style="text-align: center; float: left; width: 100%; padding-top: 15px;"> <span class="lowAs">Pricing From: </span><span class="price">$2.32 - $8.90</span><br />
                <br />
                <a href="/photo-id-badges.php"><img src="images/view-photo-id-badges.jpg" width="160" height="35" alt="Photo Identification Ordering Options" /></a><br />
                <br />
              </div>
            </div>
          </div>
        </div>
        <!--End one product-->
        <div class="orderBox">
          <div class="boxHeader"><span style="float: left;">Desk Name Plates and Wall Plates</span></div>
          <div class="boxSub" style="float: left;">
            <div class="boxSub2">
              <div style="width: 100%; float: left;">
                <div style="width: 253px; float: left;"><a href="/desk-wall-name-plates.php"><img src="images/desk-plates-wall-name-plates.jpg" width="249" height="128" alt="Desk Plates and Wall Name Plates" /></a></div>
              </div>
              <br />
              <br />
              <div style="float: left; width: 253px; padding-top: 10px;">
                <div style="float: left; width: 250px;">
                  <ul style="margin-top:0; margin-bottom: 0; padding-top:0; padding-bottom: 0;">
                    <li>Engraving and Full Color</li>
                    <li>Lots Of Options And Designs</li>
                    <li>Wood and Aluminum Available</li>
                  </ul>
                </div>
              </div>
              <div style="text-align: center; float: left; width: 100%; padding-top: 15px;"> <span class="lowAs">Pricing From: </span><span class="price">$1.82 - $6.40</span><br />
                <br />
                <a href="/desk-wall-name-plates.php"><img src="images/view-desk.jpg" width="160" height="35" alt="View Desk And Wall Plates" /></a><br />
                <br />
              </div>
            </div>
          </div>
        </div>
        <!--End one product-->
        <div class="orderBox">
          <div class="boxHeader"><span style="float: left;">Signs - Printed and Engraved</span></div>
          <div class="boxSub" style="float: left;">
            <div class="boxSub2">
              <div style="width: 100%; float: left;">
                <div style="width: 253px; float: left;">  <a href="/printed-engraved-signs.php"><img src="images/signs-engraved-printed.jpg" width="249" height="128" alt="Laser Engrave and Full Color Printed Signs" /></a></div>
              </div>
              <br />
              <br />
              <div style="float: left; width: 253px; padding-top: 10px;">
                <div style="float: left; width: 250px;">
                  <ul style="margin-top:0; margin-bottom: 0; padding-top:0; padding-bottom: 0;">
                    <li>Full Color and/or Engraved</li>
                    <li>Fully Custom Sizes and Designs</li>
                    <li>Lots Of Options</li>
                  </ul>
                </div>
              </div>
              <div style="text-align: center; float: left; width: 100%; padding-top: 15px;"> <span class="lowAs">Pricing Low As: </span><span class="price">$4.10 - $31.80</span><br />
                <br />
                <a href="/printed-engraved-signs.php"><img src="images/view-signs.jpg" width="160" height="35" alt="View Signs" /></a><br />
                <br />
              </div>
            </div>
          </div>
        </div>
        <!--End one product-->
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
                <p>I got the badges today. They look GREAT!!. Thanks for helping me in such short notice.
</p><p>
This will surprise the whole office. Once again thanks for the excellent service and fast shipping.</p>
				<p align="right"><strong>-T. Walker, Summit Tax & Accounting</strong></p>
            </li>
        </ul>
        <p align="right" class="clb"><strong><a href="/testimonials.php">&raquo; Read More Testimonials</a></strong></p>
    </div>
    <div style="clear:both;"></div>
    <div class="what-bestme">
        <h2 style="margin-top: 10px;">Why Best Name Badges?</h2>
        <p>Full color, vibrant name badges is only the start. Best Name Badges offers the highest quality products available today. With the addition of a laser cutter and laser engraver, we are now able to offer custom shaped and sized name tags along with engraved names and logos.</p>
        <p>Our printed badges offer full edge to edge color options. Our sublimation printing process fuses the color into the material for a print that will last for years. We then follow up the print with a clear protective coating just to add additional protection for your name tag. All in all, no one beats the quality of our products.</p>
        <p>Standard shipping is free and your badges come with a standard pin fastener at no additional cost. Magnetic or premium fasteners have a small extra charge. We are able to ship most orders within just 1 business day.</p>
        <p><strong>Experience The Best Name Badges Difference</strong></p>
        <p>We are committed to providing you with the best possible name badge ordering experience.  Our core values are unwavering.  We will provide you with service that rivals a 5-star hotel, a product that exceeds your expectations, and quality materials that simply can't be beat.  Then we'll deliver them faster than anyone else. And we'll do all this at a lower price than any competitor.</p>
        <p>From our team of dedicated name tag professionals here.  We sincerely look forward to serving you soon.</p>
        <br />

    </div>
    <div id="slider">
      <dl class="slider" id="slider2">
        <dt></dt>
        <dd> <span>
          <ul class="top-list">
            <li><strong>Automated Ordering System </strong>- Accounts are instantly created and you can purchase tag inventory whenever you like. Ready to order? Simply log in, add names, select a style and we'll have your badges produced and shipped out within 1 to 2 business days.</li>
            <li><strong>Ordering Simplicity - </strong>Order extra inventory at steep discounts or just order what you need. Some badges have a flat price which includes printing, fasteners, and shipping. If you choose to pre-purchase additional inventory, we'll simply deduct new orders from your inventory level.</li>
            <li><strong>Employee Name Badges -</strong> Supervisors can create an account, purchase inventory, then provide access to their human resources department to order employee badges and tags with no need for additional payment processing. We'll just deduct new orders from your pre-purchased inventory.</li>
            <li><strong>Any Size Orders Welcome - </strong>We take orders from 1 badge to 1,000,000.</li>
            <li><strong>Best Prices - </strong>Never pay a shipping charge, no hidden fees, and the lowest cost per name badge available.</li>
            <li><strong>Fast Turnaround Time - </strong>Most badge orders are completed in 1 - 2 business days, and oftentimes the same day.</li>
            <li><strong>Top Notch Security - </strong>Badge orders and personal information is transferred over a secure SSL enabled, 256-bit encrypted connection. Plus we never store your billing information or credit cards and our site is 100% PCI Compliant.
          </ul>
          </span> </dd>
      </dl>
    </div>
    <script type="text/javascript">



var slider2=new accordion.slider("slider2");

slider2.init("slider2",15,"open");



</script> 
  </div>
  
  <!-- end mainContent --> 
  
</div>
<!-- end content -->

</div>
<!-- end wrapper -->

<div style="display: none;"><img src="/images/sevenReasonsButtonMinus.png" /></div>
<?php include_once 'inc/footer.php' ; ?>