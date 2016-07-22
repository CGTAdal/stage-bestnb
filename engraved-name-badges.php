<?php 
require_once('admin/conn/DB.php');
include('admin/conn/tablefuncs.php');
mysql_select_db($database_DB, $ravcodb);
session_start();
$pagetitle = "Engraved Name Tags - Laser - Best Name Badges";
$metadescription = "The best prices on the highest quality laser engraved badges.  Custom shapes and colors, printed logos with engraved text.  Corporate name tags also available.";
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
			$(".engraved_order_submit").each(function(){
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
  
</div>

<div id="content">
     <div id="mainContentFull">
	  <br />

<img src="/images/engraved-name-badges-and-name-tags.jpg" alt="Engraved Name Badges And Corporate Name Tags" width="956" height="241" />
<br />

   <br />



<div style="width: 960px; padding: 5px 0 20px 0; background-color: #fff4d6; text-align: center; float: left;">
<div style="float: left; width: 480px;">
<form action="sign-up.php" id="sign-up" name="sign-up" method="POST">
<p style="font-weight: bold; font-size: 20px;">Start A New Badge Design<br />
  <span style="font-size: 12px;">Use our QuickCreate™ tool and setup your badge in minutes!</span></p>

<a id="6" class="engraved_order_submit" href="javascript:void()"><img src="/images/get-started.jpg" width="244" height="49" /></a>
</div>

<div style="float: right; width: 480px;">
<p style="font-weight: bold; font-size: 20px;">Send Us A Completed Design<br /><span style="font-size: 12px;">Have a design already? Send us the files and we'll do the rest!</span></p>

<a id="8" class="engraved_order_submit" href="javascript:void()"><img src="/images/get-started.jpg" width="244" height="49" /></a>
</div>
<input type="hidden" id="designoption" value="0" name="designoption" />
</form>
</div>
<div style="clear: both;"></div>

<br />
<table width="960" cellpadding="4" cellspacing="4">
<tr>
  <td colspan="3" align="left"><strong style="font-size: 15px;">Engraved Name Badge Pricing:</strong></td>
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
  <td align="center" bgcolor="#edf7e1"><strong>$6.70</strong></td>
  <td align="center" bgcolor="#edf7e1"><strong>$5.90</strong></td>
  <td align="center" bgcolor="#edf7e1"><strong>$5.20</strong></td>
  <td align="center" bgcolor="#edf7e1"><strong>$4.45</strong></td>
  <td align="center" bgcolor="#edf7e1"><strong>$3.46</strong></td>
  <td align="center" bgcolor="#edf7e1"><strong>$2.96</strong></td>
  <td align="center" bgcolor="#edf7e1"><strong>$2.35</strong></td>
  <td align="center" bgcolor="#edf7e1"><strong>$1.97</strong></td>
  <td align="center" bgcolor="#edf7e1"><strong>$1.49</strong></td>
  <td align="center" bgcolor="#edf7e1"><strong>$1.18</strong></td>
  </tr>
  <tr>
  <td colspan="10"><strong style="text-decoration: underline;"><em>Includes Free Shipping. New Customers $19 Setup Fee.</em></strong></td>
  </tr>
</table>
<br />

<hr color="#CCCCCC" />
<br />


<br />
      
      
      
      
      
      
	  <h2>Engraved Name Badges</h2>
  		<h4>Highest Quality Laser Engraving. Lowest Prices.</h4>
   <p>Using our world-class, high resolution laser system - Best Name Badges can create the highest quality engraved name badges available.  With our extensive manufacturing abilities, we are able to provide a higher quality engraved name tag and do it at a lower price than our competitors.  Our 5-star independently rated service will make sure your badge order comes out perfect and is delivered on time, every time.</p>
        <h3>Quality And Durability</h3>
        <p>We use the highest resolution laser system on the market. The quality of our engraving is top-notch.  We can engrave the most detailed logos and even photographs. We don't cut corners on our materials either, using only the finest metals and plastics available.</p>
        <p>We have spent countless hours testing the durability through internal processes as well as customer feedback.  We believe we have perfected the high quality name tag.  Our extensive testimonials from satisfied customers confirms it.</p>
        <h3>Fastener Options</h3>
        <p>We offer many options to fit almost any uniform or situation including: <em>Premium  Magnetic Fastener, Standard Pin, Premium Pin, Pocket Slide, Bulldog Swivel Clip, Strap Clip, Military Clutch, and Adhesive.</em></p>
        
        <img src="/images/name-badge-fasteners.jpg" alt="Name Badge Fasteners - Magnetic Pins Bulldog Clips Pocket Slide" width="904" height="128" />
        
      <h3>Custom Shapes and Sizes, Special Requests</h3>
        <p>Using our advanced laser cutter, we can handle custom shapes with ease. And we'll make them with no minimum.  Need a custom size badge that you don't see on our site?  That's no problem either.  We never charge extra for custom sizes. With our wide array of manufacturing equipment, we can make almost anything.  Don't hesitate to reach out to us with your special requests.</p>
  
  <div style="width: 960px; padding: 5px 0 20px 0; background-color: #fff4d6; text-align: center; float: left;">
<div style="float: left; width: 480px;">
<form action="sign-up.php" id="sign-up" name="sign-up" method="POST">
<p style="font-weight: bold; font-size: 20px;">Start A New Badge Design<br />
  <span style="font-size: 12px;">Use our QuickCreate™ tool and setup your badge in minutes!</span></p>

<a id="6" class="engraved_order_submit" href="javascript:void()"><img src="/images/get-started.jpg" width="244" height="49" /></a>
</div>

<div style="float: right; width: 480px;">
<p style="font-weight: bold; font-size: 20px;">Send Us A Completed Design<br /><span style="font-size: 12px;">Have a design already? Send us the files and we'll do the rest!</span></p>

<a id="8" class="engraved_order_submit" href="javascript:void()"><img src="/images/get-started.jpg" width="244" height="49" /></a>
</div>
<input type="hidden" id="designoption" value="0" name="designoption" />
</form>
</div>
  
  </div>
        
        
<br />
</div><!-- end mainContentFull -->
  
  </div><!-- end content -->
</div><!-- end wrapper -->



<?php include_once 'inc/footer.php' ; ?>
