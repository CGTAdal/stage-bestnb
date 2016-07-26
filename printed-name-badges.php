<?php 
require_once('admin/conn/DB.php');
include('admin/conn/tablefuncs.php');
mysql_select_db($database_DB, $ravcodb);
session_start();
$pagetitle = "Digitally Printed Name Tags - Best Name Badges";
$metadescription = "Our printed name badges offer full color options and our heat infused sublimation printing process means your tags will last for years.";
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
			$(".print_order_submit").each(function(){
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
     <div id="mainContentFull" class="printend-badges-maindiv">
	  
      
   
<br />

<img src="/images/digitally-printed-name-tags.jpg" class="printed-name-badges-topimg" />
<br />

   <br />

<div class="printed-name-badges-content" >
<form action="sign-up.php" id="sign-up" name="sign-up" method="POST">
<div  class="printed-name-badges-left">

<p class="pin-cahtwith-text">Start A New Badge Design<br />
  <span style="font-size: 12px;">Use our QuickCreate™ tool and setup your badge in minutes!</span></p>

<a id="5" class="print_order_submit" href="javascript:void()"><img src="/images/get-started.jpg" width="244" height="49" /></a>
</div>

<div  class="printed-name-badges-right">
<p class="pin-cahtwith-text">Send Us A Completed Design<br /><span style="font-size: 12px;">Have a design already? Send us the files and we'll do the rest!</span></p>

<a id="7" class="print_order_submit" href="javascript:void()"><img src="/images/get-started.jpg" width="244" height="49" /></a>
</div>
<input type="hidden" id="designoption" value="0" name="designoption" />
</form>
</div>
<div style="clear: both;"></div>

<br />
<div class="printed-name-badges-table-outer">
<table  cellpadding="4" cellspacing="4" class="printed-name-badges-table">
<tr>
  <td colspan="3" align="left"><strong style="font-size: 15px;">Printed Name Badge Pricing:</strong></td>
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
  <td align="center" bgcolor="#edf7e1"><strong>$6.85</strong></td>
  <td align="center" bgcolor="#edf7e1"><strong>$6.10</strong></td>
  <td align="center" bgcolor="#edf7e1"><strong>$5.40</strong></td>
  <td align="center" bgcolor="#edf7e1"><strong>$4.55</strong></td>
  <td align="center" bgcolor="#edf7e1"><strong>$3.96</strong></td>
  <td align="center" bgcolor="#edf7e1"><strong>$3.23</strong></td>
  <td align="center" bgcolor="#edf7e1"><strong>$2.60</strong></td>
  <td align="center" bgcolor="#edf7e1"><strong>$2.14</strong></td>
  <td align="center" bgcolor="#edf7e1"><strong>$1.60</strong></td>
  <td align="center" bgcolor="#edf7e1"><strong>$1.29</strong></td>
  </tr>
  <tr>
  <td colspan="10"><strong style="text-decoration: underline;"><em>Includes Free Shipping. New Customers $19 Setup Fee.</em></strong></td>
  </tr>
</table>
</div>
<br />

<hr color="#CCCCCC" />
<br />


<br />
      
      
      
      
      
      
	  <h2>Digitally Printed Name Badges</h2>
  		<h4>Highest Quality Prints. Lowest Prices.</h4>
        <p>Thank you for considering our world-class digitally printed name badges.  We utilize the latest, top of the line equipment to produce the finest quality products available.  Simply put, no competitor offers a better product, and no competitor offers a better price. We can offer our printing on both metal and plastic name tags.</p>
        <h3>Quality And Durability</h3>
        <p>Over the years we have perfected the full color digital printed name badge.  Our processes allow us to provide a colorful, crystal clear print that will far exceed your expectations.</p>
        <p>Through our extensive durability testing, we are able to provide prints that last for years without fading or rubbing off.  We use special coating processes that are unique to Best Name Badges which allows us to provide a higher quality product than any competitor.</p>
        <h3>Fastener Options</h3>
        <p>We offer many options to fit almost any uniform or situation including: <em>Premium  Magnetic Fastener, Standard Pin, Premium Pin, Pocket Slide, Bulldog Swivel Clip, Strap Clip, Military Clutch, and Adhesive.</em></p>
        
        <img src="/images/name-badge-fasteners.jpg" alt="Name Badge Fasteners - Magnetic Pins Bulldog Clips Pocket Slide" class="printed-name-badges-fasterimg"  />
        
      <h3>Custom Shapes and Sizes, Special Requests</h3>
        <p>Using our advanced laser cutter, we can handle custom shapes with ease. And we'll make them with no minimum.  Need a custom size badge that you don't see on our site?  That's no problem either.  We never charge extra for custom sizes. With our wide array of manufacturing equipment, we can make almost anything.  Don't hesitate to reach out to us with your special requests.</p>
       <div class="printed-name-badges-bottomdiv" >
<form action="sign-up.php" id="sign-up" name="sign-up" method="POST">
<div class="printed-name-badges-left" >

<p class="pin-cahtwith-text">Start A New Badge Design<br />
  <span style="font-size: 12px;">Use our QuickCreate™ tool and setup your badge in minutes!</span></p>

<a id="5" class="print_order_submit" href="javascript:void()"><img src="/images/get-started.jpg" width="244" height="49" /></a>
</div>

<div class="printed-name-badges-right">
<p class="pin-cahtwith-text">Send Us A Completed Design<br /><span style="font-size: 12px;">Have a design already? Send us the files and we'll do the rest!</span></p>

<a id="7" class="print_order_submit" href="javascript:void()"><img src="/images/get-started.jpg" width="244" height="49" /></a>
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
