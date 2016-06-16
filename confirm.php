<?php 
require_once('admin/conn/DB.php');
include('admin/conn/tablefuncs.php');
mysql_select_db($database_DB, $ravcodb);
session_start();

$pagetitle = "Please Confirm";
$metadescription = "Best Name Badges is always introducing new and exciting products for your name badge needs.  Such as domes and doming, full color prints, name badge frames, and much more.";
$metakeywords = "name badges, name tags, custom name badge, custom name tags, metal name tags, brushed aluminum name badges, plastic name tags, plastic name badges, color name badges, employee name tags, employee name badges, professional name tags, professional name badges"; 
?>
<?php 
if ($_SESSION["customerloginid"])
{
	include_once 'inc/header-auth.php';
} else {
	include_once 'inc/header.php' ;
} ?>

  <div id="hero">
    <div id="heroHeader">
    	<h1>YOUR HOME FOR NAME BADGES</h1>
        <p>Lightning fast <strong><u>1-day turnaround</u></strong>. Always free standard shipping. Full color. Easy online ordering.</p>
    </div>
    <div id="heroButton"><a href="/sign-up.php"><img src="images/getStartedButton.png" width="159" height="35" alt="Get Started" /></a></div>
  </div><!-- end hero -->
  
  <div id="content">
    <div id="leftColumn">
     <?php include_once 'inc/leftcolumn1.php' ; ?>
    </div><!-- end leftColumn -->
    
    <div id="mainContent">
	  <h2>Please Confirm</h2>
  		
          <p>To reduce unsolicited junk email. We require that you confirm your email address. Please check your email account and click the link in our confirmation email to activate your newsletter subscription.</p>
        
    </div><!-- end mainContent -->
  
  </div><!-- end content -->
</div><!-- end wrapper -->

<div style="display: none;"><img src="/images/sevenReasonsButtonMinus.png" /></div>

<?php include_once 'inc/footer.php' ; ?>