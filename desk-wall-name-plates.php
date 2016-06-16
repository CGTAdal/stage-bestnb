<?php 
require_once('admin/conn/DB.php');
include('admin/conn/tablefuncs.php');
mysql_select_db($database_DB, $ravcodb);
session_start();
$pagetitle = "Desk Name Plates, Wall Plates, Wood, Plastic, Metal - Best Name Badges";
$metadescription = "The best prices on exceptional quality desk and wall employee name plates.  Wood, metal, and plastic available.";
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

<img src="/images/desk-name-plates-wall-plates.jpg" width="956" height="237" />
<br />

   <br />


<div style="width: 960px; padding: 5px 0 20px 0; background-color: #fff4d6; text-align: center; float: left;">
<form action="sign-up.php" id="sign-up" name="sign-up" method="POST">
<div style="float: left; width: 480px;">
<p style="font-weight: bold; font-size: 20px;">Start A New Name Plate Design<br />
  <span style="font-size: 12px;">Use our QuickCreate™ tool and setup your name plate in minutes!</span></p>

<a id="12" class="desk-wall-name-plates" href="javascript:void()"><img src="/images/get-started.jpg" width="244" height="49" /></a>
</div>

<div style="float: right; width: 480px;">
<p style="font-weight: bold; font-size: 20px;">Send Us A Completed Design<br /><span style="font-size: 12px;">Have a design already? Send us the files and we'll do the rest!</span></p>

<a id="13" class="desk-wall-name-plates" href="javascript:void()" href="/sign-up.php"><img src="/images/get-started.jpg" width="244" height="49" /></a>
</div>

</div>
<div style="clear: both;"></div>
<input type="hidden" id="designoption" value="0" name="designoption" />
</form>
<br />
<table width="960" cellpadding="4" cellspacing="4">
<tr>
  <td colspan="3" align="left"><strong style="font-size: 15px;">Desk and Wall Plate Pricing:</strong></td>
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
  <td align="center" bgcolor="#edf7e1"><strong>$6.40</strong></td>
  <td align="center" bgcolor="#edf7e1"><strong>$5.35</strong></td>
  <td align="center" bgcolor="#edf7e1"><strong>$4.88</strong></td>
  <td align="center" bgcolor="#edf7e1"><strong>$4.18</strong></td>
  <td align="center" bgcolor="#edf7e1"><strong>$3.60</strong></td>
  <td align="center" bgcolor="#edf7e1"><strong>$3.30</strong></td>
  <td align="center" bgcolor="#edf7e1"><strong>$2.60</strong></td>
  <td align="center" bgcolor="#edf7e1"><strong>$2.35</strong></td>
  <td align="center" bgcolor="#edf7e1"><strong>$2.00</strong></td>
  <td align="center" bgcolor="#edf7e1"><strong>$1.82</strong></td>
  </tr>
  <tr>
  <td colspan="10"><strong style="text-decoration: underline;"><em>Includes Free Shipping. New Customers $19 Setup Fee.</em></strong></td>
  </tr>
</table>

<br />
<br />

<hr color="#CCCCCC" />
<br />


<br />
      
      
      
      
      
      
	  <h2>Desk and Wall Name Plates</h2>
  		<h4>Engraved. Printed. Metal. Plastic. Wood. We Have It All!</h4>
        
        
         <p>Catch the eye of prospective clients with our high quality name plates. We offer several options including aluminum desk holder, executive wood desk stands, aluminum wall plates, mounting brackets, and more.</p>
       <h3>Why Best Name Badges Name Plates?</h3>
        <p>Throughout the years we have developed the finest quality products in the recognition industry. Our metals and plastics are thicker, more durable, and have a better finish. Our hand stained wood is exceptional. We can create name plates in full color or high resolution laser engraving.</p>
       <p>Did you know that Best Name Badges offers the best quality products on the market - yet at the lowest prices? It's an unbeatable combination.</p>
         <h3>Custom Shapes and Sizes, Special Requests</h3>
<p>Using our advanced laser cutter, we can handle custom shapes with ease. And we'll make them with no minimum.  Need a custom size badge that you don't see on our site?  That's no problem either.  We never charge extra for custom sizes. With our wide array of manufacturing equipment, we can make almost anything.  Don't hesitate to reach out to us with your special requests.</p>
        
        
  </div>
        
<br />
</div><!-- end mainContentFull -->
  
  </div><!-- end content -->
</div><!-- end wrapper -->



<?php include_once 'inc/footer.php' ; ?>
