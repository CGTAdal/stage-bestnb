<?php 
require_once('admin/conn/DB.php');
include('admin/conn/tablefuncs.php');
mysql_select_db($database_DB, $ravcodb);
session_start();
$pagetitle = "Photo ID Cards, Badges, and Tags - Best Name Badges";
$metadescription = "The best prices on the highest quality photo ID cards. Save money and time.  Our photo ID cards are unmatched in quality.";
$metakeywords = "name badges, name tags, custom name badge, custom name tags, metal name tags, brushed aluminum name badges, plastic name tags, plastic name badges, color name badges, employee name tags, employee name badges, professional name tags, professional name badges"; 
?>
<?php 
if ($_SESSION["customerloginid"])
{
	include_once 'inc/header-auth.php';
} else {
	include_once 'inc/header.php' ;
} ?>
	<style>
		.print_order_submit{
			cursor: pointer;
		}
	</style>
	<script type="text/javascript">
		$(document).ready(function(){
			//alert('aa');
			$(".photo_order_submit").each(function(){
				$(this).click(function(){						
					$("#designoption").val($(this).attr('id'));
					//return false;
					$("#sign-up").submit();
				});
				});
		});		
	</script>
    
    
    <div id="hero" class="herobgnone">
    <img src="images/heroBG.jpg"  />
  <div id="heroHeader" class="heroheadrnone">
    &nbsp;
  </div>
  
</div
    
    
    ><div id="content">
     <div id="mainContentFull">
	  
       <br />

<img src="/images/photo-identification-cards.jpg" alt="Photo ID Cards and Badges" width="960" height="237" />
<br />

   <br />



<div style="width: 960px; padding: 5px 0 20px 0; background-color: #fff4d6; text-align: center; float: left;">
<form action="sign-up.php" id="sign-up" name="sign-up" method="POST">
<input type="hidden" id=designoption value="0" name="designoption" />
<div style="float: left; width: 480px;">
<p style="font-weight: bold; font-size: 20px;">Start A New Badge Design<br />
  <span style="font-size: 12px;">Use our QuickCreate™ tool and setup your badge in minutes!</span></p>

<a id="10" class="photo_order_submit" href="javascript:void(0);"><img src="/images/get-started.jpg" width="244" height="49" /></a>
</div>

<div style="float: right; width: 480px;">
<p style="font-weight: bold; font-size: 20px;">Send Us A Completed Design<br /><span style="font-size: 12px;">Have a design already? Send us the files and we'll do the rest!</span></p>

<a id="11" class="photo_order_submit" href="javascript:void(0);"><img src="/images/get-started.jpg" width="244" height="49" /></a>
</div>

</form>
</div>
<div style="clear: both;"></div>

<br />
<table width="960" cellpadding="4" cellspacing="4">
<tr>
  <td colspan="3" align="left"><strong style="font-size: 15px;">Photo ID Badge Pricing:</strong></td>
  <td align="center">&nbsp;</td>
  <td align="center">&nbsp;</td>
  <td align="center">&nbsp;</td>
  <td align="center">&nbsp;</td>
  <td colspan="4" align="center"><strong><em>Enterprise Quantities</em></strong></td>
  </tr>
<tr>
  <td width="82" align="center" bgcolor="#ededed"><strong>Quantity:</strong></td>
  <td width="82" align="center" bgcolor="#ededed"><strong>1-10</strong></td>
  <td width="82" align="center" bgcolor="#ededed"><strong>11-25</strong></td>
  <td width="82" align="center" bgcolor="#ededed"><strong>26-50</strong></td>
  <td width="82" align="center" bgcolor="#ededed"><strong>51-100</strong></td>
  <td width="82" align="center" bgcolor="#ededed"><strong>101-250</strong></td>
  <td width="82" align="center" bgcolor="#ededed"><strong>251-750</strong></td>
  <td width="82" align="center" bgcolor="#75b61c"><strong style="color: #FFF;">750+</strong></td>
  <td width="82" align="center" bgcolor="#75b61c"><strong style="color: #FFF;">1000+</strong></td>
  <td width="82" align="center" bgcolor="#75b61c"><strong style="color: #FFF;">5,000+</strong></td>
  <td width="92" align="center" bgcolor="#75b61c"><strong style="color: #FFF;">10,000+</strong></td>
</tr>
<tr>
  <td align="center" bgcolor="#edf7e1"><strong>Price </strong></td>
  <td align="center" bgcolor="#edf7e1"><strong>$8.90</strong></td>
  <td align="center" bgcolor="#edf7e1"><strong>$8.10</strong></td>
  <td align="center" bgcolor="#edf7e1"><strong>$7.77</strong></td>
  <td align="center" bgcolor="#edf7e1"><strong>$7.30</strong></td>
  <td align="center" bgcolor="#edf7e1"><strong>$6.10</strong></td>
  <td align="center" bgcolor="#edf7e1"><strong>$4.80</strong></td>
  <td align="center" bgcolor="#edf7e1"><strong>$4.30</strong></td>
  <td align="center" bgcolor="#edf7e1"><strong>$3.05</strong></td>
  <td align="center" bgcolor="#edf7e1"><strong>$2.77</strong></td>
  <td align="center" bgcolor="#edf7e1"><strong>$2.32</strong></td>
  </tr>
  <tr>
  <td colspan="10"><strong style="text-decoration: underline;"><em>Includes Free Shipping. New Customers $19 Setup Fee.</em></strong></td>
  </tr>
</table>
<br />

<hr color="#CCCCCC" />
<br />


<br />
      
      
      
      
      
      
	  <h2>Photo ID Badges</h2>
  		<h4>Highest Quality ID Cards. Lowest Prices.</h4>
        
       <p>Using the latest reverse-transfer dye sublimation process, we can provide the highest quality photo ID badges on the market.  Our printing process delivers a vibrant image in full high-definition detail.  We can print both the front and back plus add a hologram and additional laminated protection.</p>
       <h3>Why It's Better To Outsource Your Photo ID Cards To Us</h3>
        <p>Did you know you can save thousands by simply outsourcing your photo ID cards to Best Name Badges?  Don't be fooled into buying an expensive machine to use in house.  These machines are not like your home printer - they require extensive maintenance, calibration, and expensive supplies. Did you know a simple print head can cost you over $1000?  You'll find yourself settling for lower quality cards and a headache by making photo ID badges yourself.  Let our professionals save you money, headaches, and provide you with the absolute highest quality photo ID badges available.</p>
       <p>Just send us your pictures and staff information, we'll process and mail your cards out within 24 hours. Most customers receive their badges in just 1 - 3 days.</p>
         <h3>Lanyards And Strap Clips</h3>
        <p>The most popular way to wear your new photo ID cards are lanyards and strap clips.  We offer lanyards in 10 standard colors.  We can also make custom printed lanyards with your logo and information.</p>
        
        <img src="/images/standard-photo-id-attachments.jpg" alt="10 Colors of Lanyards, Customer Printed Lanyards, and Strap Clips" width="908" height="176" />
        
        
        <h3>Additional Fastener Options</h3>
<p>We offer many options to fit almost any uniform or situation including: <em>Premium  Magnetic Fastener, Standard Pin, Premium Pin, Pocket Slide, Bulldog Swivel Clip, Strap Clip, Military Clutch, and Adhesive.</em></p>
        
        <img src="/images/name-badge-fasteners.jpg" alt="Name Badge Fasteners - Magnetic Pins Bulldog Clips Pocket Slide" width="904" height="128" />
        
      <h3>Custom Shapes and Sizes, Special Requests</h3>
        <p>Using our advanced laser cutter, we can handle custom shapes with ease. And we'll make them with no minimum.  Need a custom size badge that you don't see on our site?  That's no problem either.  We never charge extra for custom sizes. With our wide array of manufacturing equipment, we can make almost anything.  Don't hesitate to reach out to us with your special requests.</p>
        
        <div style="width: 960px; padding: 5px 0 20px 0; background-color: #fff4d6; text-align: center; float: left;">
<form action="sign-up.php" id="sign-up" name="sign-up" method="POST">
<input type="hidden" id=designoption value="0" name="designoption" />
<div style="float: left; width: 480px;">
<p style="font-weight: bold; font-size: 20px;">Start A New Badge Design<br />
  <span style="font-size: 12px;">Use our QuickCreate™ tool and setup your badge in minutes!</span></p>

<a id="10" class="photo_order_submit" href="javascript:void(0);"><img src="/images/get-started.jpg" width="244" height="49" /></a>
</div>

<div style="float: right; width: 480px;">
<p style="font-weight: bold; font-size: 20px;">Send Us A Completed Design<br /><span style="font-size: 12px;">Have a design already? Send us the files and we'll do the rest!</span></p>

<a id="11" class="photo_order_submit" href="javascript:void(0);"><img src="/images/get-started.jpg" width="244" height="49" /></a>
</div>

</form>
</div>
        
        
  </div>
        
<br />
</div><!-- end mainContentFull -->
  
  </div><!-- end content -->
</div><!-- end wrapper -->



<?php include_once 'inc/footer.php' ; ?>
