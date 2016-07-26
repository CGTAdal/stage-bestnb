<?php 
require_once('admin/conn/DB.php');
include('admin/conn/tablefuncs.php');
mysql_select_db($database_DB, $ravcodb);
session_start();
$pagetitle = "Custom Lanyards, Printed, Blank Lanyards - Best Name Badges";
$metadescription = "The best prices on the highest quality custom printed and blank lanyards. Unmatched in quality and pricing.";
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
  
</div>

<div id="content">
     <div id="mainContentFull" class="printend-badges-maindiv custom-lanyards-main">
	  
       <br />

<img src="/images/custom-blank-lanyards.jpg" alt="Custom And Blank Lanyards" class="photoid-badges-topimg" />
<br />

   <br />



<div class="custom-lanyards-content" >
<div class="printed-name-badges-left">
<p class="pin-cahtwith-text">Get A Free Quote<br />
  <span style="font-size: 12px;">Contact us now and get a quote within minutes.</span></p>

<a id="10" class="photo_order_submit" href="/contact-us.php"><img src="/images/call-or-contact.jpg" width="244" height="49" /></a>
</div>

<div class="printed-name-badges-right">
<p class="pin-cahtwith-text">Chat With A Live Representative<br />
  <span style="font-size: 12px;">Talk to us right online! We can provide a free quote right away.</span></p>

<!--Start AliveChat Button Code-->
<div class="pinclikhear-button-outer">
<img src="https://images.websitealive.com/images/hosted/upload/47741.jpg" border="0" onClick="javascript:window.open('http://a5.websitealive.com/1572/rRouter.asp?groupid=1572&websiteid=177&departmentid=7727&dl='+escape(document.location.href),'','width=400,height=400');" style="cursor:pointer"><br>
<div style='background-color:; padding:4px; font-size:8px;  font-family:Verdana, Helvetica, sans-serif;'><a href='http://www.websitealive.com' style='text-decoration:none; font-size:8px;  font-family:Verdana, Helvetica, sans-serif;' target='_blank'>Live Chat</a> by <a href='http://www.websitealive.com' style='text-decoration:none; font-size:8px;  font-family:Verdana, Helvetica, sans-serif;' target='_blank'><b>AliveChat</b></a></div>
</div>
<!--End AliveChat Button Code-->

</div>


</div>
<div style="clear: both;"></div>

<br />
<div class="printed-name-badges-table-outer">
<table width="960" cellpadding="4" cellspacing="4">
<tr>
  <td colspan="3" align="left"><strong style="font-size: 15px;">Standard Custom Lanyard Pricing:</strong></td>
  <td align="center">&nbsp;</td>
  <td align="center">&nbsp;</td>
  <td colspan="4" align="center"><strong><em>Enterprise Quantities</em></strong></td>
  </tr>
<tr>
  <td width="82" align="center" bgcolor="#ededed"><strong>Quantity:</strong></td>
  <td width="82" align="center" bgcolor="#ededed"><strong>100-199</strong></td>
  <td width="82" align="center" bgcolor="#ededed"><strong>200-299</strong></td>
  <td width="82" align="center" bgcolor="#ededed"><strong>300-499</strong></td>
  <td width="82" align="center" bgcolor="#ededed"><strong>500-999</strong></td>
  <td width="82" align="center" bgcolor="#75b61c"><strong style="color: #FFF;">1000+</strong></td>
  <td width="82" align="center" bgcolor="#75b61c"><strong style="color: #FFF;">3000+</strong></td>
  <td width="82" align="center" bgcolor="#75b61c"><strong style="color: #FFF;">5,000+</strong></td>
  <td width="92" align="center" bgcolor="#75b61c"><strong style="color: #FFF;">10,000+</strong></td>
</tr>
<tr>
  <td align="center" bgcolor="#edf7e1"><strong>Price </strong></td>
  <td align="center" bgcolor="#edf7e1"><strong>$1.39</strong></td>
  <td align="center" bgcolor="#edf7e1"><strong>$1.23</strong></td>
  <td align="center" bgcolor="#edf7e1"><strong>$1.10</strong></td>
  <td align="center" bgcolor="#edf7e1"><strong>$0.85</strong></td>
  <td align="center" bgcolor="#edf7e1"><strong>$0.77</strong></td>
  <td align="center" bgcolor="#edf7e1"><strong>$0.66</strong></td>
  <td align="center" bgcolor="#edf7e1"><strong>$0.54</strong></td>
  <td align="center" bgcolor="#edf7e1"><strong>$0.50</strong></td>
  </tr>
  <tr>
  <td colspan="8"><strong style="text-decoration: underline;"><em>Standard Polyester 1/2&quot; Lanyard. 1-Color Imprint. New Customers $19 Setup Fee. 5 - 15 Day Production. Free Shipping</em></strong></td>
  </tr>
</table>
</div>
<br />
<div class="printed-name-badges-table-outer">
<table width="960" cellpadding="4" cellspacing="4">
  <tr>
    <td colspan="3" align="left"><strong style="font-size: 15px;">Blank Lanyard Pricing:</strong></td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td colspan="4" align="center"><strong><em>Enterprise Quantities</em></strong></td>
  </tr>
  <tr>
    <td width="82" align="center" bgcolor="#ededed"><strong>Quantity:</strong></td>
    <td width="82" align="center" bgcolor="#ededed"><strong>1-25</strong></td>
    <td width="82" align="center" bgcolor="#ededed"><strong>26-50</strong></td>
    <td width="82" align="center" bgcolor="#ededed"><strong>51-100</strong></td>
    <td width="82" align="center" bgcolor="#ededed"><strong>101-999</strong></td>
    <td width="82" align="center" bgcolor="#75b61c"><strong style="color: #FFF;">1000+</strong></td>
    <td width="82" align="center" bgcolor="#75b61c"><strong style="color: #FFF;">3000+</strong></td>
    <td width="82" align="center" bgcolor="#75b61c"><strong style="color: #FFF;">5,000+</strong></td>
    <td width="92" align="center" bgcolor="#75b61c"><strong style="color: #FFF;">10,000+</strong></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#edf7e1"><strong>Price </strong></td>
    <td align="center" bgcolor="#edf7e1"><strong>$1.15</strong></td>
    <td align="center" bgcolor="#edf7e1"><strong>$1.10</strong></td>
    <td align="center" bgcolor="#edf7e1"><strong>$1.00</strong></td>
    <td align="center" bgcolor="#edf7e1"><strong>$0.85</strong></td>
    <td align="center" bgcolor="#edf7e1"><strong>$0.70</strong></td>
    <td align="center" bgcolor="#edf7e1"><strong>$0.60</strong></td>
    <td align="center" bgcolor="#edf7e1"><strong>$0.50</strong></td>
    <td align="center" bgcolor="#edf7e1"><strong>$0.40</strong></td>
  </tr>
  <tr>
    <td colspan="8"><strong style="text-decoration: underline;"><em>Free Shipping. No Setup Fee. Any Standard Color And Standard Attachment.</em></strong></td>
  </tr>
</table>
</div>
<br />
<div class="printed-name-badges-table-outer">
<table width="960" cellpadding="4" cellspacing="4">
  <tr>
    <td colspan="4" align="left"><strong style="font-size: 15px;">NO MINIMUM Lanyard Pricing: (24 HourTurnaround)</strong></td>
    <td align="center">&nbsp;</td>
    <td colspan="4" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td width="82" align="center" bgcolor="#ededed"><strong>Quantity:</strong></td>
    <td width="82" align="center" bgcolor="#ededed"><strong>1-5</strong></td>
    <td width="82" align="center" bgcolor="#ededed"><strong>6-10</strong></td>
    <td width="82" align="center" bgcolor="#ededed"><strong>11-25</strong></td>
    <td width="82" align="center" bgcolor="#ededed"><strong>26-50</strong></td>
    <td width="82" align="center" bgcolor="#ededed"><strong>51-75</strong></td>
    <td width="82" align="center" bgcolor="#ededed"><strong>76-99</strong></td>
    <td width="82" align="center">&nbsp;</td>
    <td width="92" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center" bgcolor="#edf7e1"><strong>Price </strong></td>
    <td align="center" bgcolor="#edf7e1"><strong>$9.99</strong></td>
    <td align="center" bgcolor="#edf7e1"><strong>$8.49</strong></td>
    <td align="center" bgcolor="#edf7e1"><strong>$4.75</strong></td>
    <td align="center" bgcolor="#edf7e1"><strong>$4.25</strong></td>
    <td align="center" bgcolor="#edf7e1"><strong>$3.75</strong></td>
    <td align="center" bgcolor="#edf7e1"><strong>$3.40</strong></td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="8"><strong style="text-decoration: underline;"><em>5/8&quot;  Full Color Dye Sub. J-Hook Attachment. Breakaway. Single Sided. Free Shipping. New Customers $19 Setup Fee</em></strong></td>
  </tr>
</table>
</div>
<br />

<hr color="#CCCCCC" />
<br />


<br />
      
      
      
      
      
      
	  <h2>Custom Lanyards</h2>
  		<h4>Highest Quality Lanyards. Lowest Prices.</h4>
        
       <p><img src="images/custom-lanyard-options.jpg" width="955" height="215" alt="Custom Lanyard Options" /></p>
       <img src="images/lanyard-attachments.jpg" width="962" height="203" alt="Custom Lanyard Attachments" /><br /><br />
       <img src="images/custom-lanyard-stock-colors.jpg" width="964" height="133" alt="Custom Lanyard Stock Colors" />
<h3>Best Name Badges Is Your Lanyard Headquarters</h3>
        <p>With almost limitless options and production capabilities, we are your one-stop shop for custom lanyards. Our unbeatable quality and quick delivery is just the start. Whether you are looking for a custom printed lanyard or blank lanyard, our seasoned and well-trained staff can assist you right away. Experience the Best Name Badges difference and find out just why thousands of customers trust us with their lanyard orders.</p>
       <p>For custom lanyards, we offer a &quot;NO MINIMUM&quot; option. These lanyards can general be produced the same or next day. For our standard lanyards, production is approximately 2 weeks. We do offer rush production on these lanyards of just 5 days for a small extra cost. Non-custom (blank) lanyards can generally ship the same business day if the order is placed before our scheduled pickups.</p>
         <h3>Easy Lanyard Setup</h3>
        <p>Our staff can provide you with a proof quickly and efficiently. We can even help you come up with a design. Once approved, the order goes right into production and will ship to your door shortly after. Simply contact our friendly staff for a free quote and proof.</p>
        <h3>Are You Looking For Custom Photo ID's?</h3>
<p>We are an industry leader photo ID manufacturer. With factory direct low pricing and the highest quality equipment on the market, we can provide you with all your photo ID needs.<em></em> To order your <a href="/photo-id-badges.php">Photo ID Cards, please click here</a>.</p>
<h3>Don't See It Here?</h3>
<p>While we try and offer as many options on our website as possible, we realize that we may not have listed just what you are looking for. If you are looking for a custom lanyard or product that you don't see here, just reach out to us directly. 99% of the time we will have just what you are looking for.<em></em></p>
<p>&nbsp;</p>
<div class="custom-lanyards-content">
<div class="printed-name-badges-left">
<p class="pin-cahtwith-text">Get A Free Quote<br />
  <span style="font-size: 12px;">Contact us now and get a quote within minutes.</span></p>

<a id="10" class="photo_order_submit" href="/contact-us.php"><img src="/images/call-or-contact.jpg" width="244" height="49" /></a>
</div>

<div class="printed-name-badges-right">
<p class="pin-cahtwith-text">Chat With A Live Representative<br />
  <span style="font-size: 12px;">Talk to us right online! We can provide a free quote right away.</span></p>

<!--Start AliveChat Button Code-->
<div class="pinclikhear-button-outer">
<img src="https://images.websitealive.com/images/hosted/upload/47741.jpg" border="0" onClick="javascript:window.open('http://a5.websitealive.com/1572/rRouter.asp?groupid=1572&websiteid=177&departmentid=7727&dl='+escape(document.location.href),'','width=400,height=400');" style="cursor:pointer"><br>
<div style='background-color:; padding:4px; font-size:8px;  font-family:Verdana, Helvetica, sans-serif;'><a href='http://www.websitealive.com' style='text-decoration:none; font-size:8px;  font-family:Verdana, Helvetica, sans-serif;' target='_blank'>Live Chat</a> by <a href='http://www.websitealive.com' style='text-decoration:none; font-size:8px;  font-family:Verdana, Helvetica, sans-serif;' target='_blank'><b>AliveChat</b></a></div>
</div>
<!--End AliveChat Button Code-->

</div>


</div>
        
        
  </div>
        
<br />
</div><!-- end mainContentFull -->
  
  </div><!-- end content -->
</div><!-- end wrapper -->



<?php include_once 'inc/footer.php' ; ?>
