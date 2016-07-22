<?php 
require_once('admin/conn/DB.php');
include('admin/conn/tablefuncs.php');
mysql_select_db($database_DB, $ravcodb);
session_start();

$pagetitle = "Name Tags - Custom Plastic Tags by Best Name Badges";
$metadescription = "High quality plastic name tags can help your organization put the best face forward.  Outsource your tag production and save time and money over traditional methods.";
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

    <div id="hero" class="herobgnone">
    <img src="images/heroBG.jpg"  />
  <div id="heroHeader" class="heroheadrnone">
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
				  <h2>Custom Full Color Name Tags</h2>
			      <p>For a while now, there has been a noticeable increase in the use of name tags by many companies; both big and small. In fact, those that do not provide their staff with such tags are actually looked down upon. It does suggest a lack of transparency after all. This trend isn't limited to corporations though. Just head down to a school near you and you'll probably notice that everyone (from the teachers to clerical staff) has their own name tag. The biggest benefit of these tags is that, simply put, they make things easy for people. For instance, with the help of name tags, a speaker would be able to identify the members of his audience with relative ease.</p>
			<p>
			And of course, we offer a variety of such name tags.                                      
			</p>
			<p>
			<strong>1) </strong>First up we have reusable name tags. As the name suggests, these can be reused by muliple people. All you really have to do is to remove the strip of paper that contains the details of a particular person, and replace it with another's. </p>
			<p>
			<strong>2)</strong> Next are the classic name tags. Classic name tags are probably the most commonly used ones you'd find. These are the ones which have a particular persons name embedded onto the tag itself. While this tag does bring about a perception of proffesionality, you might want to take note that they can't be reused and modified for another person. </p>
			<p>
			<strong>3) </strong>In terms of style, nothing beats a magnetic name tag. Each of these comes with a metal sheet and (you guessed it) a magnet. While they are a tad more expensive, if you're looking to impress your clients with style, then this is one of the first things you can implement amongst your staff. </p>
			<p>
			<strong>4) </strong>Metallic badges are also extremely common. In fact, they are usually confused with the classic name tags. Like the classic, the name is embedded upon the tag. It also comes is a pin to hold it onto the shirt. </p>
			<p>
			<strong>5) </strong>And finally we come to custom name tags. As the name suggests, the design of these name tags can be customized as per your demand. With this, you can bring in a sense of professionality coupled with your own personal touch. And of course, it can be done at a low cost. </p>
		</div>	
    </div><!-- end mainContent -->
  
  </div><!-- end content -->
</div><!-- end wrapper -->

<div style="display: none;"><img src="/images/sevenReasonsButtonMinus.png" /></div>

<?php include_once 'inc/footer.php' ; ?>