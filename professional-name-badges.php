<?php 
require_once('admin/conn/DB.php');
include('admin/conn/tablefuncs.php');
mysql_select_db($database_DB, $ravcodb);
session_start();

$pagetitle = "Professional Name Badges and Tags for Your Company - Best Name Badges";
$metadescription = "Your professional name badges are just a click away.  Employees and companies love our ultra-fast ordering system.";
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
					  <h2>Buy Professional Name Badges</h2>
					  <p>Just ask any manager at a company which incorporates the use of name tags, and they'll tell you that these badges have aided them greatly in various ways. For one, it helps to kick start interaction amongst employees and clients. This naturally will lead to a rise in sales. Secondly, you can also filter away the incompetent ones once they have been identified by your clients. And lastly, it builds a sense of identity amongst your employees.</p><p>
				
				In terms of variety, there is an endless array of options available for you. In fact, it's actually possible for you to get the exact design you're looking for. And this is where we come in. We believe that you won't find any other company that designes badges of the same high quality as us. We aim to achieve 100% satisfaction on your part. And more often then not, our clients praise us for our work. Here's why:
				</p><p>
				We have a great number of years under our belt in this industry. So when it comes to making name tags, most cannot come close to us. We actually design the name tags in a manner they they specifically meet our client's requirements. And if for some reason it doesn't, we will redo them to ensure it does.
				</p><h4>Custom Badges Are Just A Click Away</h4><p>
				The list of designs are really endless. Whether you're looking to have a log printed on the tags, or have them cut in a different shape, we can get it done for you. We are very confident we can produce professional name badges that meet your specific needs. We can even have your company's brand printed on your employees badges. That way, you have hundreds of people advertising your business for you.
				</p><p>
				So there you have it. Professional name badges are really the way to go, and we are the guys who can provide you with the very best in this field.</p>
		</div>
    </div><!-- end mainContent -->
  
  </div><!-- end content -->
</div><!-- end wrapper -->

<div style="display: none;"><img src="/images/sevenReasonsButtonMinus.png" /></div>

<?php include_once 'inc/footer.php' ; ?>