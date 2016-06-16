<?php 
require_once('admin/conn/DB.php');
include('admin/conn/tablefuncs.php');
mysql_select_db($database_DB, $ravcodb);
session_start();
$pagetitle = "Indoor Signs, Printed and Engraved, Custom Sizes - Best Name Badges";
$metadescription = "We offer the best prices on all interior signage.  Our signs come either printed or engraved.  Fully customizable.";
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

<img src="/images/custom-interior-signs-engraved-printed.jpg" width="956" height="237" />
<br />

   <br />


<div style="width: 960px; padding: 5px 0 20px 0; background-color: #fff4d6; text-align: center;">

<p style="font-weight: bold; font-size: 20px;">Would You Like More Information About Our Signs?</p>

<p style="font-size: 15px;">Please <a href="/contact-us.php">contact us</a> right away.  We can provide a custom quote within minutes.</p>

</div>

<div style="clear: both;"></div>

<br />
      
      
      
      
      
      
	  <h2>Custom Signs</h2>
  		<h4>Engraved or Printed. Custom sizes and shapes, we have it all!</h4>
        
        
         <p>Best Name Badges is proud to provide you with simple and inexpensive, yet fully custom signs for your office.</p>
       <h3>Why Best Name Badges Signs?</h3>
        <p>We make the process easy. We will help you create a perfect sign for your business. Our designers will provide you with a proof to review before any payment is requested. We'll modify the design until it's just perfect for you.</p>
        <p>We then produce your custom sign using our state of the art in-house production facility. Using our full color processes we can create rich, vibrant colors that will last for years. We also custom engrave and cut signs in a variety of colors. Some customers even ask us to print their logos in full color, and engrave the text - we are happy to oblige!</p>
         <h3>Custom Shapes and Sizes, Special Requests</h3>
<p>When it comes to your custom signs, nearly all requests are possible. Since we have more equipment and manufacturing techniques than our competitors - we can produce even the most &quot;out there&quot; designs and requests. Contact us right away!</p>
        
        
  </div>
        
<br />
</div><!-- end mainContentFull -->
  
  </div><!-- end content -->
</div><!-- end wrapper -->



<?php include_once 'inc/footer.php' ; ?>
