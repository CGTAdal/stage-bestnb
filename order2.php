<?php 
require_once('admin/conn/DB.php');
include('admin/conn/tablefuncs.php');
include('include/config.php');
mysql_select_db($database_DB, $ravcodb);
session_start();

/*if (!$_SESSION["customerloginid"])
{
	header("location: sign-up.php");
}*/

/*if (!$_SESSION["customerloginid"])
{
	//header("location: sign-up.php");
}*/
/*
if ($_POST["designoption"])
{
	if ($_POST["designoption"] == 1)
	{
		header("location: wizard2.php");
	}
	
	if ($_POST["designoption"] == 2)
	{
		header("location: wizard.php");
	}
	
	if ($_POST["designoption"] == 3)
	{
		header("location: wizard3.php");
	}
}
*/
$pagetitle = "3 Design Options - Best Name Badges and Tags";
$metadescription = "Start your order here.  Ordering name tags is as easy as pressing a few buttons.  We'll have your order shipped out within 24 hours.";
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
	    How would you like to continue?:</h3>
	  <br /><br />
	 <!--  <form method="post" action="order2.php"> -->
	 <form method="post" action="<?php echo $base_url?>/sign-up.php"> 
      <div id="logoBox">
      	<div class="boxHeader"><span style="float: left;">3 Design Options Available</span></div>
      	<div class="boxSub" style="border-bottom: none;">
        	  <div class="boxSub2">
        	    <p>We provide you several options when ordering badges. However, we know some orders may not fall within these guidelines. If you need additional help, please submit your order as best as you can, and provide us additional instructions in the &quot;notes&quot; section on the following page. Or give us a call anytime.</p>
        	  </div>
        </div>
          <div class="signUpField" style="border-top-width: 1px; border-top-style: dashed; border-top-color: #CCC; height: 45px;">
            <div class="signUpFieldLeft" style="height: 45px;">Design My Own:</div>
            <div class="signUpFieldRight" style="line-height: 17px;"><input type="radio" name="designoption" value="2" style="padding-top: 5px;"  checked="checked"/>
            Design my own using the online design tool.<br /><span style="padding-left: 23px;">Upload your logo(s), add text, change colors and more!</span></div>
          </div>
          <div class="signUpField" style="border-top-width: 1px; border-top-style: dashed; border-top-color: #CCC;">
            <div class="signUpFieldLeft">Pro Designer:</div>
            <div class="signUpFieldRight"><input type="radio" name="designoption" value="1" />
            Have a designer create one for me. No additional cost!</div>
          </div>
          <div class="signUpField" style="border-top-width: 1px; border-top-style: dashed; border-top-color: #CCC;">
            <div class="signUpFieldLeft">Upload My Design:</div>
            <div class="signUpFieldRight"><input type="radio" name="designoption" value="3"/>
            I already have a completed design that I wish to send.</div>
          </div>
          
		<div class="signUpField">
          <div style="height: 30px; text-align: center; line-height: 30px; margin-top:15px; margin-bottom: 15px;"><input type="image" value="submit" src="images/continueButton.png" /></div>
        </div>
      </div>
     </form>
    
    
    </div><!-- end mainContentFull -->
  
  </div><!-- end content -->
</div><!-- end wrapper -->

<div style="display: none;"><img src="/images/sevenReasonsButtonMinus.png" /></div>

<?php include_once 'inc/footer.php' ; ?>