<?php 
require_once('admin/conn/DB.php');
include('admin/conn/tablefuncs.php');
mysql_select_db($database_DB, $ravcodb);
session_start();

if (!$_SESSION["customerloginid"])
{
	header("location: sign-up.php");
}

$_SESSION["designoption"] = $_POST["designoption"];

$pagetitle = "Buy Name Badges - Custom Name Badge Styles and Tags";
$metadescription = "Best Name Badges offers several styles of high quality badges and tags to fit your needs.  Magnetic and Pin fasteners are included free of charge.";
$metakeywords = "name badges, name tags, custom name badge, custom name tags, metal name tags, brushed aluminum name badges, plastic name tags, plastic name badges, color name badges, employee name tags, employee name badges, professional name tags, professional name badges"; 
?>
<?php 
if ($_SESSION["customerloginid"])
{
	include_once 'inc/header-auth.php';
} else {
	include_once 'inc/header.php' ;
} ?>

    <div id="content">
     
    <div id="mainContentFull">
	  <h2>Name Badge Ordering</h2>
	  <h3><br /><br />
	    Upload Your Logo(s):</h3>
	  <br /><br />
	  
	  <?php if ($_SESSION["designoption"] == 3) { ?>
	  <form method="post" action="logo.php">
	  <input type="hidden" name="design" value="1" />
	  <div id="logoBox">
      	<div class="boxHeader"><span style="float: left;">Upload Your Design</span></div>
      	<div class="boxSub" style="border-bottom: none;">
        	  <div class="boxSub2">
        	    <p>Send us up your design. We accept <strong>PNG, GIF, or JPG</strong> files.  If you have a high quality version in other formats (PDF, AI, EPS, etc.) please submit an accepted version here, then email us your higher quality version once you have submitted your order. </p>
        	  </div>
          


        </div><div class="signUpField" style="border-top-width: 1px; border-top-style: dashed; border-top-color: #CCC;">
            <div class="signUpFieldLeft">Design Image:</div>
            <div class="signUpFieldRight"><input type="file" value="Upload Image 1" name="image1" style="width: 200px; height: 22px;" class="signupFieldInput" /></div>
          </div>
		<div class="signUpField">
            <div style="height: 30px; text-align: center; line-height: 30px; margin-top:15px; margin-bottom: 15px;"><input type="image" value="submit" src="images/uploadButton.png" /></div>
          </div>
      </div>
	  </form>
	  <?php } else { ?>
	  <form method="post" action="logo.php">
	  <input type="hidden" name="logos" value="1" />
      <div id="logoBox">
      	<div class="boxHeader"><span style="float: left;">Upload Your Logo(s)</span> <span style="font-size:9px;">(Optional)</span></div>
      	<div class="boxSub" style="border-bottom: none;">
        	  <div class="boxSub2">
        	    <p>Send us up to 2 logos. We accept <strong>PNG, GIF, or JPG</strong> files.  If you have a high quality version in other formats (PDF, AI, EPS, etc.) please submit an accepted version here, then email us your higher quality version once you have submitted your order. </p>
        	  </div>
          


        </div><div class="signUpField" style="border-top-width: 1px; border-top-style: dashed; border-top-color: #CCC;">
            <div class="signUpFieldLeft">Logo Image 1:</div>
            <div class="signUpFieldRight"><input type="file" value="Upload Image 1" name="image1" style="width: 200px; height: 22px;" class="signupFieldInput" /></div>
          </div>
          <div class="signUpField">
            <div class="signUpFieldLeft">Logo Image 2:</div>
            <div class="signUpFieldRight"><input type="file" value="Upload Image 2" name="image2" style="width: 200px; height: 22px;" class="signupFieldInput" /></div>
          </div>
		<div class="signUpField">
            <div style="height: 30px; text-align: center; line-height: 30px; margin-top:15px; margin-bottom: 15px;"><input type="image" value="submit" src="images/uploadButton.png" /><input type="image" value="submit" style="margin-left: 15px;" src="images/donothavelogoButton.png" /></div>
          </div>
      </div>
	  </form>
     <?php } ?>
    
    
    </div><!-- end mainContentFull -->
  
  </div><!-- end content -->
</div><!-- end wrapper -->

<div style="display: none;"><img src="/images/sevenReasonsButtonMinus.png" /></div>

<?php include_once 'inc/footer.php' ; ?>