<?php 
require_once('admin/conn/DB.php');
include('admin/conn/tablefuncs.php');
mysql_select_db($database_DB, $ravcodb);
session_start();
$pagetitle = "Printed Bottle Openers - Best Name Badges";
$metadescription = "The coolest keychain bottle openers.  Full color print.  Entire front can be customized.";
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
    
    
    <div id="hero" class="herobgnone">
    <img src="images/heroBG.jpg"  />
  <div id="heroHeader" class="heroheadrnone">
    &nbsp;
  </div>
  
</div
    
    
    ><div id="content">
     <div id="mainContentFull">
	  
      

   
<br />

<img src="/images/bottle-openers-keychains.jpg" alt="Custom Bottle Opener Keychains" width="956" height="237" />
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
  <td colspan="3" align="left"><strong style="font-size: 15px;">Bottle Opener Pricing:</strong></td>
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
  <td align="center" bgcolor="#edf7e1"><strong>$3.18</strong></td>
  <td align="center" bgcolor="#edf7e1"><strong>$2.56</strong></td>
  <td align="center" bgcolor="#edf7e1"><strong>$2.04</strong></td>
  <td align="center" bgcolor="#edf7e1"><strong>$1.57</strong></td>
  <td align="center" bgcolor="#edf7e1"><strong>$1.49</strong></td>
  <td align="center" bgcolor="#edf7e1"><strong>$1.26</strong></td>
  <td align="center" bgcolor="#edf7e1"><strong>$1.17</strong></td>
  <td align="center" bgcolor="#edf7e1"><strong>$1.04</strong></td>
  <td align="center" bgcolor="#edf7e1"><strong>$0.94</strong></td>
  <td align="center" bgcolor="#edf7e1"><strong>$0.77</strong></td>
  </tr>
  <tr>
  <td colspan="10"><strong style="text-decoration: underline;"><em>2 1/4&quot; Standard Size.  Includes Free Shipping. $19 Setup Fee May Apply.</em></strong></td>
  </tr>
</table>
<br />
      
      
      
      
      
      
	  <h2>Custom Printed Bottle Opener Keychains</h2>
  		<h4>Full Color Custom Bottle Openers.  Fast Turnaround</h4>
        
        
         <p>Don't be caught without a bottle opener! Customers keep these wonderful promotional keychains for years.</p>
       <h3>Why Best Name Badges Bottle Openers?</h3>
        <p>The entire front of the bottle opener is fully customizable, even over the edges. Since we use genuine inks and photo realistic paper, we can create amazing results. Designs are only limited by your imagination. Don't settle for a small logo, go big!</p>
        <p>People who receive these products will add them to their keychains, which means they'll see your business message daily! Our bottle openers are one of the best promotional products available on the market today. Why? Because they are inexpensive and produce real results. Customers love bottle openers!</p>
<p>If you place your order today, you can have your order delivered as early as tomorrow. Though our standard service is just a few days.</p>
<h3>Graphic Design Professionals</h3>
<p>Need help coming up with a cool design? Best Name Badges has a team of full-time graphic artists working right here in the office. Our artists have years of experience in keychain and small format design, so we know what makes a great keychain. We would love to help you design a new product that really stands out. Just ask!</p>
  </div>
        
<br />
</div><!-- end mainContentFull -->
  
  </div><!-- end content -->
</div><!-- end wrapper -->



<?php include_once 'inc/footer.php' ; ?>
