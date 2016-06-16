<?php 
require_once('admin/conn/DB.php');
include('admin/conn/tablefuncs.php');
mysql_select_db($database_DB, $ravcodb);
session_start();
$pagetitle = "Promotional Magnets - Refrigerator Magnets - Best Name Badges";
$metadescription = "Stand out with custom promotional refrigerator magnets.  An inexpensive way to promote your business.";
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
			$(".desk-wall-name-plates").each(function(){
				$(this).click(function(){						
					$("#designoption").val($(this).attr('id'));
					//return false;
					$("#sign-up").submit();
				});
				});
		});		
	</script>
    
    
    <div id="hero">
  <div id="heroHeader">
    &nbsp;
  </div>
  
</div
    
    
    ><div id="content">
     <div id="mainContentFull">
	  
      

   
<br />

<img src="/images/small-promotional-magnets.jpg" alt="Small Promotional Magnets" width="956" height="237" />
<br />

   <br />


<div style="width: 960px; padding: 5px 0 20px 0; background-color: #fff4d6; text-align: center; float: left;">
<div style="float: left; width: 480px;">
<p style="font-weight: bold; font-size: 20px;">Get A Free Quote<br />
  <span style="font-size: 12px;">Contact us now and get a quote within minutes.</span></p>

<a id="10" class="photo_order_submit" href="/contact-us.php"><img src="/images/call-or-contact.jpg" width="244" height="49" /></a>
</div>

<div style="float: right; width: 480px;">
<p style="font-weight: bold; font-size: 20px;">Chat With A Live Representative<br />
  <span style="font-size: 12px;">Talk to us right online! We can provide a free quote right away.</span></p>

<!--Start AliveChat Button Code-->
<div style='padding:0px;margin:0px;width:auto'>
<img src="https://images.websitealive.com/images/hosted/upload/47741.jpg" border="0" onClick="javascript:window.open('http://a5.websitealive.com/1572/rRouter.asp?groupid=1572&websiteid=177&departmentid=7727&dl='+escape(document.location.href),'','width=400,height=400');" style="cursor:pointer"><br>
<div style='background-color:; padding:4px; font-size:8px; color:#fff; font-family:Verdana, Helvetica, sans-serif;'><a href='http://www.websitealive.com' style='text-decoration:none; font-size:8px; color:#fff; font-family:Verdana, Helvetica, sans-serif;' target='_blank'>Live Chat</a> by <a href='http://www.websitealive.com' style='text-decoration:none; font-size:8px; color:#fff; font-family:Verdana, Helvetica, sans-serif;' target='_blank'><b>AliveChat</b></a></div>
</div>
<!--End AliveChat Button Code-->

</div>


</div>

<div style="clear: both;"></div>
<table width="960" cellpadding="4" cellspacing="4">
<tr>
  <td colspan="3" align="left"><strong style="font-size: 15px;">Magnet Pricing:</strong></td>
  <td align="center">&nbsp;</td>
  <td align="center">&nbsp;</td>
  <td align="center">&nbsp;</td>
  <td align="center">&nbsp;</td>
  <td colspan="4" align="center"><strong><em>Enterprise Quantities</em></strong></td>
  </tr>
<tr>
  <td width="82" align="center" bgcolor="#ededed"><strong>Quantity:</strong></td>
  <td width="82" align="center" bgcolor="#ededed"><strong>5-10</strong></td>
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
  <td align="center" bgcolor="#edf7e1"><strong>$2.96</strong></td>
  <td align="center" bgcolor="#edf7e1"><strong>$2.31</strong></td>
  <td align="center" bgcolor="#edf7e1"><strong>$1.86</strong></td>
  <td align="center" bgcolor="#edf7e1"><strong>$1.35</strong></td>
  <td align="center" bgcolor="#edf7e1"><strong>$1.07</strong></td>
  <td align="center" bgcolor="#edf7e1"><strong>$0.75</strong></td>
  <td align="center" bgcolor="#edf7e1"><strong>$0.58</strong></td>
  <td align="center" bgcolor="#edf7e1"><strong>$0.49</strong></td>
  <td align="center" bgcolor="#edf7e1"><strong>$0.43</strong></td>
  <td align="center" bgcolor="#edf7e1"><strong>$0.36</strong></td>
  </tr>
  <tr>
  <td colspan="10"><strong style="text-decoration: underline;"><em>2 1/4&quot; Standard Size. Add 12 cents each for 3&quot; size. Includes Free Shipping. $19 Setup Fee May Apply.</em></strong></td>
  </tr>
</table>
<br />
      
      
      
      
      
      
	  <h2>Custom Promotional Magnets</h2>
  		<h4>Full Color Custom Magnets. Multiple Sizes Available. Fast Turnaround</h4>
        
        
         <p>Make a statement with our high quality promotional magnets. Available in both 2 1/4&quot; and 3&quot; sizes.  Great for services companies who want their customers to remember to call them.</p>
       <h3>Why Best Name Badges Magnets?</h3>
       <p>When we make our magnets, we use the highest quality glossy photo paper available. We also use genuine HP inks. By using the highest quality materials and inks, we are able to offer a product that clearly stands out from our competition. Compare our magnets side by side with any competitor and you'll instantly see the difference.</p>
       <p>Did you know that we typically ship within 24 - 48 hours. Standard shipping is just 1 - 3 business days as well. So when you order from Best Name Badges, you know you'll receive your order fast, everytime.</p>
       <p>Our promotional magnets are one of the best ways to promote your business to your existing customers. They always end up on a refigerator or filing cabinet and offer an everyday reminder. By ordering in bulk, these promo items can provide an extremely inexpensive opportunity to help advertise your business.</p>
     <p>&nbsp;</p>
<h3>Graphic Design Professionals</h3>
<p>Need help coming up with a cool design? Best Name Badges has a team of full-time graphic artists working right here in the office. Our artists have years of experience in magnets and small format design, so we know what makes a great promotional magnet. We would love to help you design a new product that really stands out. Just ask!</p>


        
        
  </div>
        
<br />
</div><!-- end mainContentFull -->
  
  </div><!-- end content -->
</div><!-- end wrapper -->



<?php include_once 'inc/footer.php' ; ?>
