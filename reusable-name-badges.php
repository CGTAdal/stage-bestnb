<?php 
require_once('admin/conn/DB.php');
include('admin/conn/tablefuncs.php');
mysql_select_db($database_DB, $ravcodb);
session_start();
$pagetitle = "Reusable Custom Name Badges and Tags - Best Name Badges";
$metadescription = "Buy your reusable name badges and tags directly from the manufacturer.  Use our quick online ordering system and have your badges in just a few days.";
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
			$(".reusable_name_submit").each(function(){
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

	
<img src="/images/reusable-name-badges-hero.jpg" width="960" height="250" />
        <br />
<br />

<div style="width: 960px; padding: 5px 0 20px 0; background-color: #fff4d6; text-align: center;">

<p style="font-weight: bold; font-size: 20px;">Ready To Start Your Reusable Name Badge Order?</p>
<form action="sign-up.php" id="sign-up" name="sign-up" method="POST">
<a id="9" class="reusable_name_submit" href="javascript:void(0);"><img src="/images/get-started.jpg" width="244" height="49" /></a>

</div>

<br />
<table width="960" cellpadding="4" cellspacing="4">
<tr>
  <td colspan="3" align="left"><strong style="font-size: 15px;">Reusable Name Badge Pricing:</strong></td>
  <td align="center">&nbsp;</td>
  <td align="center">&nbsp;</td>
  <td align="center">&nbsp;</td>
  <td align="center">&nbsp;</td>
  <td colspan="4" align="center"><strong><em>Enterprise Quantities</em></strong></td>
  </tr>
<tr>
  <td width="82" align="center" bgcolor="#ededed"><strong>Quantity:</strong></td>
  <td width="82" align="center" bgcolor="#ededed"><strong>10+</strong></td>
  <td width="82" align="center" bgcolor="#ededed"><strong>20+</strong></td>
  <td width="82" align="center" bgcolor="#ededed"><strong>50+</strong></td>
  <td width="82" align="center" bgcolor="#ededed"><strong>100+</strong></td>
  <td width="82" align="center" bgcolor="#ededed"><strong>200+</strong></td>
  <td width="82" align="center" bgcolor="#ededed"><strong>500+</strong></td>
  <td width="82" align="center" bgcolor="#75b61c"><strong style="color: #FFF;">750+</strong></td>
  <td width="82" align="center" bgcolor="#75b61c"><strong style="color: #FFF;">1000+</strong></td>
  <td width="82" align="center" bgcolor="#75b61c"><strong style="color: #FFF;">5,000+</strong></td>
  <td width="92" align="center" bgcolor="#75b61c"><strong style="color: #FFF;">10,000+</strong></td>
</tr>
<tr>
  <td align="center" bgcolor="#edf7e1"><strong>Price </strong></td>
  <td align="center" bgcolor="#edf7e1"><strong>$4.35</strong></td>
  <td align="center" bgcolor="#edf7e1"><strong>$3.95</strong></td>
  <td align="center" bgcolor="#edf7e1"><strong>$3.25</strong></td>
  <td align="center" bgcolor="#edf7e1"><strong>$2.85</strong></td>
  <td align="center" bgcolor="#edf7e1"><strong>$2.70</strong></td>
  <td align="center" bgcolor="#edf7e1"><strong>$2.40</strong></td>
  <td align="center" bgcolor="#edf7e1"><strong>$2.25</strong></td>
  <td align="center" bgcolor="#edf7e1"><strong>$2.10</strong></td>
  <td align="center" bgcolor="#edf7e1"><strong>$1.96</strong></td>
  <td align="center" bgcolor="#edf7e1"><strong>$1.75</strong></td>
  </tr>
  <tr>
  <td colspan="10"><strong style="text-decoration: underline;"><em>Includes Free Shipping.</em></strong></td>
  </tr>
</table>
<br />

<hr color="#CCCCCC" />
<br />


<br />

  	  <h2>Reusable Name Badges</h2>
	   <h4>Premium Domed Reusable Name Tags</h4>
  <br /><br />
  <h3>7 Different Shapes And Sizes</h3>
  <p>We have <strong>7 sizes and shapes</strong> available to choose from. Our standard backing plate options include <strong>brushed aluminum silver, brushed aluminum gold, and white</strong>.<br /><em>*We are also happy to create custom colors upon request</em>.</p>
  <p><img src="images/reusable-name-badge-sizes.jpg" width="960" height="359" alt="Reusable Name Badges - 8 different shapes and sizes" /></p>
  <br /><br />
  
  

<h3>Easy-Peel Insert Labels</h3>
<p>Customizing your badges can be done in <strong>seconds</strong>.  Our sheets are the size of a standard piece of paper and work with virtually any <strong>InkJet Printer, Laser Printer, or Copier</strong>.  If your printer is a color printer, then you can print in <strong>full color</strong> on the insert!</p>
<p>Our patented insert sheets are even <strong>fully reloadable</strong>.  This means you don't have to print the entire sheet at once.  Print as few as 1 insert at a time.<br />
</p>
<h3>Clear Domed Lenscover</h3>
<p>The badge is ready to come together.  Place the shatterproof lenscover over the insert and snap to the plate.  You now have a professional, permanent looking - yet fully reusable, name badge!</p>

<h3>Name Badge Fastener</h3>
<p>Most of our customers prefer our magnetic 3-disc super grip fastener.  It won't damage your clothing and won't let go of the badge either.  We also stock premium pin fasters and clips if you prefer.</p>
<img src="/images/name-badge-fasteners.jpg" alt="Name Badge Fasteners - Magnetic Pins Bulldog Clips Pocket Slide" width="904" height="128" />
      </div>
        
<br />
<div style="clear: both;"></div>
<div style="width: 960px; padding: 5px 0 20px 0; background-color: #fff4d6; text-align: center;">

<p style="font-weight: bold; font-size: 20px;">Ready To Start Your Reusable Name Badge Order?</p>

<a id="9" class="reusable_name_submit" href="javascript:void(0);"><img src="/images/get-started.jpg" width="244" height="49" /></a>
<input type="hidden" id="designoption" value="0" name="designoption" />
</form>
</div>

</div><!-- end mainContentFull -->
  
  </div><!-- end content -->
</div><!-- end wrapper -->



<?php include_once 'inc/footer.php' ; ?>
