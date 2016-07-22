<?php 
require_once('admin/conn/DB.php');
include('admin/conn/tablefuncs.php');
mysql_select_db($database_DB, $ravcodb);
session_start();

$pagetitle = "Who is Best Name Badges - Tag and Badge Production Facilities";
$metadescription = "Best Name Badges is a US based name badge production company serving both the US and Canada.  Our products are widely recognized as the best in the industry.";
$metakeywords = "name badges, name tags, custom name badge, custom name tags, metal name tags, brushed aluminum name badges, plastic name tags, plastic name badges, color name badges, employee name tags, employee name badges, professional name tags, professional name badges"; 
?>
<?php 
if ($_SESSION["customerloginid"])
{
	include_once 'inc/header-auth.php';
} else {
	//include_once 'inc/header.php' ;
	include_once 'inc/header_new.php' ;
} ?>

  <div id="hero">
  <img src="images/heroBG.jpg"  />
  <div id="heroHeader">
    &nbsp;
  </div>
  

</div>
  <!-- end hero -->
  
  <div id="content">
    <div id="leftColumn">
     <?php include_once 'inc/leftcolumn3.php' ; ?>
    </div><!-- end leftColumn -->
    
    <div id="mainContent">
    	
    <div class="subright flr">
		  <h2>Who Is Best Name Badges?</h2>
	  		<h4>A production facility focusing on quality, simplicity, and value.</h4>
	      <p>We live by our values. Best Name Badges has been in business for years bringing name badges to the U.S. and Canada. Our production facility can handle orders from 1 badge to 10,000 or more and our staff is eager to help with any size order. Best Name Badges does not discriminate on order sizes and we view every customer as unique and important.</p>
	
	      <p>Best Name Badges believes "Made In America" means something. Our printers and products are all North American made using materials produced locally. North American Made means a high quality, dependable product with the support that you come to expect.
	
	      Our customers in the U.S. and Canada appreciate the quality of our products.</p>
	      <h3>Customer Service</h3>
	      <p>Our customer service is second to none and the quality of our products simply can't be beat. We strive to meet the needs of our clients, because our clients take deadlines seriously. We don't expect you to put off a trade show because you can't get your badges in time, or miss a sale because a customer couldn't remember your name due to a low quality print. Rest assured that we'll strive to meet the needs of even the most demanding customers. </p>
	      <h3>Education</h3>
	      <p>Best Name Badges has been an active supporter of education and regularly helps with providing name badge products to non-profit and educational events. Please contact us if you have a school or non-profit event that requires badges.
	  	</p>
	        
	      </p>
	</div>      
    </div><!-- end mainContent -->
  
  </div><!-- end content -->
</div><!-- end wrapper -->

<div style="display: none;"><img src="/images/sevenReasonsButtonMinus.png" /></div>

<?php include_once 'inc/footer.php' ; ?>