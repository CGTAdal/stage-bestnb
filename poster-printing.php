<?php 
require_once('admin/conn/DB.php');
include('admin/conn/tablefuncs.php');
mysql_select_db($database_DB, $ravcodb);
session_start();
$pagetitle = "Poster Printing - Custom Photos and Artwork - Best Name Badges";
$metadescription = "The highest quality poster printing, using only genuine HP inks and paper.  Last longer, looks better.  Turn your photos into artwork!";
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

<img src="/images/poster-artwork-printing.jpg" alt="Promotional Pin Buttons" width="956" height="237" />
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
  <td colspan="3" align="left"><strong style="font-size: 15px;">Poster Pricing:</strong></td>
  <td align="center">&nbsp;</td>
  <td align="center">&nbsp;</td>
  <td align="center">&nbsp;</td>
  <td align="center">&nbsp;</td>
  <td colspan="4" align="center"><strong><em>Enterprise Quantities</em></strong></td>
  </tr>
<tr>
  <td width="82" align="center" bgcolor="#ededed"><strong>Quantity:</strong></td>
  <td width="82" align="center" bgcolor="#ededed"><strong>1</strong></td>
  <td width="82" align="center" bgcolor="#ededed"><strong>2</strong></td>
  <td width="82" align="center" bgcolor="#ededed"><strong>3</strong></td>
  <td width="82" align="center" bgcolor="#ededed"><strong>4</strong></td>
  <td width="82" align="center" bgcolor="#ededed"><strong>5</strong></td>
  <td width="82" align="center" bgcolor="#ededed"><strong>10</strong></td>
  <td width="82" align="center" bgcolor="#75b61c"><strong style="color: #FFF;">25+</strong></td>
  <td width="82" align="center" bgcolor="#75b61c"><strong style="color: #FFF;">50+</strong></td>
  <td width="82" align="center" bgcolor="#75b61c"><strong style="color: #FFF;">100+</strong></td>
  <td width="92" align="center" bgcolor="#75b61c"><strong style="color: #FFF;">200+</strong></td>
</tr>
<tr>
  <td align="center" bgcolor="#edf7e1"><strong>Price </strong></td>
  <td align="center" bgcolor="#edf7e1"><strong>$8.25</strong></td>
  <td align="center" bgcolor="#edf7e1"><strong>$7.50</strong></td>
  <td align="center" bgcolor="#edf7e1"><strong>$6.45</strong></td>
  <td align="center" bgcolor="#edf7e1"><strong>$6.00</strong></td>
  <td align="center" bgcolor="#edf7e1"><strong>$5.25</strong></td>
  <td align="center" bgcolor="#edf7e1"><strong>$4.60</strong></td>
  <td align="center" bgcolor="#edf7e1"><strong>$3.10</strong></td>
  <td align="center" bgcolor="#edf7e1"><strong>$2.50</strong></td>
  <td align="center" bgcolor="#edf7e1"><strong>$2.10</strong></td>
  <td align="center" bgcolor="#edf7e1"><strong>$1.94</strong></td>
  </tr>
  <tr>
  <td colspan="10"><strong style="text-decoration: underline;"><em>11&quot; x 17&quot; Standard Size.</em></strong> <strong style="text-decoration: underline;"><em>Custom Sizes, No Problem!</em></strong> <strong style="text-decoration: underline;"><em>Shipping Not Included..</em></strong></td>
  </tr>
</table>
<br />
      
      
      
      
      
      
	  <h2>Custom Printed Posters</h2>
  		<h4>Variety Of Paper Stock.  Genuine HP Inks and Papers. Fast Turnaround</h4>
        
        
         <p>Trust Best Name Badges to handle all your poster printing needs. We can print in almost any custom size. We also use only genuine HP inks and Papers, which means your posters will look better and last much longer.</p>
       <h3>Why Best Name Badges Poster Printing Servce?</h3>
        <p>Since we use only Genuine HP Products. Our posters look better and last longer. Other companies cut corners with generic inks that don't look as good and fade quickly. Generic papers will fade as well and don't hold the inks like they should, which gives a poor quality print.</p>
        <p>Many of our clients use our posters in elevators, kiosks, and all sorts of fun locations. Look professional with our ultra-high quality custom poster printing service.</p>
        <p>We can print in any custom size, and other than a small price change for the ink and paper materials, we don't charge any extra fees for non-standard sizes.        </p>
        <p>Our production team can print, cut, and deliver your posters in as fast as 24 hours. We never charge rush fees either. Our standard delivery is just a few business days.</p>
        <h3>Do You Need A Poster Stand Or Holder?</h3>
        
        <p>We stock a variety of stands for indoor or outdoor use.  From small to large, we can provide you with the poster stand you need.  We even have wall mounted advertisement holders as well.</p>
        <p>Just let us know what you are looking for and we can provide you with a variety of options to choose from.  And our pricing simply won't be beat!</p>
        <p>We can also supply you with picture frames of almost any size.</p>
        
        <h3>Why Best Name Badges Poster Printing Servce?</h3>
        <p>Print your artwork and family photos to hang on the walls or in your office. Turn your office party photos into lasting memories. If you need a frame for your artwork or photos, just ask us!</p>
<h3>Graphic Design Professionals</h3>
<p>Need help coming up with a cool design? Best Name Badges has a team of full-time graphic artists working right here in the office. Our artists have years of experience in poster designs, so we know what makes a great design. Our artists are the real deal, with their personal artwork being shown in art galleries. We would love to help you design a new poster that really stands out. Just ask!</p>
  </div>
        
<br />
</div><!-- end mainContentFull -->
  
  </div><!-- end content -->
</div><!-- end wrapper -->



<?php include_once 'inc/footer.php' ; ?>
