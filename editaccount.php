<?php 
require_once('admin/conn/DB.php');
include('admin/conn/tablefuncs.php');
mysql_select_db($database_DB, $ravcodb);
session_start();

if (!$_SESSION["customerloginid"])
{
	header("location: sign-up.php");
} 

if ($_POST["editaccount"])
{
	if ($_POST["password1"] != "")
	{
		if ($_POST["password1"] == $_POST["password2"])
		{
			$_POST["password"] = $_POST["password1"];
			unset($_POST["editaccount"]);
			unset($_POST["password1"]);
			unset($_POST["password2"]);
			unset($_POST["x"]);
			unset($_POST["y"]);
			$where = "id=".$_SESSION["customerloginid"];
			modify_record("customers", $_POST, $where);
			$_SESSION["state"] = $_POST["state"];
		} else {
			$errmsg = "<font color='red'>Passwords Don't Match</font>";
		}
	} else {
		unset($_POST["editaccount"]);
		unset($_POST["password1"]);
		unset($_POST["password2"]);
		unset($_POST["x"]);
		unset($_POST["y"]);
		$where = "id=".$_SESSION["customerloginid"];
		modify_record("customers", $_POST, $where);
		$_SESSION["state"] = $_POST["state"];
	}
}

$qry = "SELECT * FROM customers WHERE id = '".$_SESSION["customerloginid"]."'";
$customers = mysql_query($qry);
$customer = mysql_fetch_assoc($customers);

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


<script language="javascript">
function changestatediv(country)
{
	if (country == "CA")
	{
		document.getElementById('statediv').innerHTML = "<div class='signUpFieldRight'><select id=state name=state><option value=AB <?php if ($_SESSION["state"] == "AB") { ?>selected<?php } ?>>AB</option><option value=BC <?php if ($_SESSION["state"] == "BC") { ?>selected<?php } ?>>BC</option><option value=MB <?php if ($_SESSION["state"] == "MB") { ?>selected<?php } ?>>MB</option><option value=NB <?php if ($_SESSION["state"] == "NB") { ?>selected<?php } ?>>NB</option><option value=NL <?php if ($_SESSION["state"] == "NL") { ?>selected<?php } ?>>NL</option><option value=NT <?php if ($_SESSION["state"] == "NT") { ?>selected<?php } ?>>NT</option><option value=NS <?php if ($_SESSION["state"] == "NS") { ?>selected<?php } ?>>NS</option><option value=NU <?php if ($_SESSION["state"] == "NU") { ?>selected<?php } ?>>NU</option><option value=ON <?php if ($_SESSION["state"] == "ON") { ?>selected<?php } ?>>ON</option><option value=PE <?php if ($_SESSION["state"] == "PE") { ?>selected<?php } ?>>PE</option><option value=QC <?php if ($_SESSION["state"] == "QC") { ?>selected<?php } ?>>QC</option><option value=SK <?php if ($_SESSION["state"] == "SI") { ?>selected<?php } ?>>SK</option><option value=YT <?php if ($_SESSION["state"] == "YT") { ?>selected<?php } ?>>YT</option></select></div>";
		document.getElementById('stateprov').innerHTML = "<div class='signUpFieldLeft'>Province:</div>";
	} else if (country == "US")	{
		document.getElementById('statediv').innerHTML = "<div class='signUpFieldRight'><select id=state name=state><option value=AK <?php if ($_SESSION["state"] == "AK") { ?>selected<?php } ?>>AK</option><option value=AL <?php if ($_SESSION["state"] == "AL") { ?>selected<?php } ?>>AL</option><option value=AR <?php if ($_SESSION["state"] == "AR") { ?>selected<?php } ?>>AR</option><option value=AZ <?php if ($_SESSION["state"] == "AZ") { ?>selected<?php } ?>>AZ</option><option value=CA <?php if ($_SESSION["state"] == "CA") { ?>selected<?php } ?>>CA</option><option value=CO <?php if ($_SESSION["state"] == "CO") { ?>selected<?php } ?>>CO</option><option value=CT <?php if ($_SESSION["state"] == "CT") { ?>selected<?php } ?>>CT</option><option value=DC <?php if ($_SESSION["state"] == "DC") { ?>selected<?php } ?>>DC</option><option value=DE <?php if ($_SESSION["state"] == "DE") { ?>selected<?php } ?>>DE</option><option value=FL <?php if ($_SESSION["state"] == "FL") { ?>selected<?php } ?>>FL</option><option value=GA <?php if ($_SESSION["state"] == "GA") { ?>selected<?php } ?>>GA</option><option value=HI <?php if ($_SESSION["state"] == "HI") { ?>selected<?php } ?>>HI</option><option value=IA <?php if ($_SESSION["state"] == "IA") { ?>selected<?php } ?>>IA</option><option value=ID <?php if ($_SESSION["state"] == "ID") { ?>selected<?php } ?>>ID</option><option value=IL <?php if ($_SESSION["state"] == "IL") { ?>selected<?php } ?>>IL</option><option value=IN <?php if ($_SESSION["state"] == "IN") { ?>selected<?php } ?>>IN</option><option value=KS <?php if ($_SESSION["state"] == "KS") { ?>selected<?php } ?>>KS</option><option value=KY <?php if ($_SESSION["state"] == "KY") { ?>selected<?php } ?>>KY</option><option value=LA <?php if ($_SESSION["state"] == "LA") { ?>selected<?php } ?>>LA</option><option value=MA <?php if ($_SESSION["state"] == "MA") { ?>selected<?php } ?>>MA</option><option value=MD <?php if ($_SESSION["state"] == "MD") { ?>selected<?php } ?>>MD</option><option value=ME <?php if ($_SESSION["state"] == "ME") { ?>selected<?php } ?>>ME</option><option value=MI <?php if ($_SESSION["state"] == "MI") { ?>selected<?php } ?>>MI</option><option value=MN <?php if ($_SESSION["state"] == "MN") { ?>selected<?php } ?>>MN</option><option value=MO <?php if ($_SESSION["state"] == "MO") { ?>selected<?php } ?>>MO</option><option value=MS <?php if ($_SESSION["state"] == "MS") { ?>selected<?php } ?>>MS</option><option value=MT <?php if ($_SESSION["state"] == "MT") { ?>selected<?php } ?>>MT</option><option value=NC <?php if ($_SESSION["state"] == "NC") { ?>selected<?php } ?>>NC</option><option value=ND <?php if ($_SESSION["state"] == "ND") { ?>selected<?php } ?>>ND</option><option value=NE <?php if ($_SESSION["state"] == "NE") { ?>selected<?php } ?>>NE</option> <option value=NH <?php if ($_SESSION["state"] == "NH") { ?>selected<?php } ?>>NH</option><option value=NJ <?php if ($_SESSION["state"] == "NJ") { ?>selected<?php } ?>>NJ</option><option value=NM <?php if ($_SESSION["state"] == "NM") { ?>selected<?php } ?>>NM</option><option value=NV <?php if ($_SESSION["state"] == "NV") { ?>selected<?php } ?>>NV</option><option value=NY <?php if ($_SESSION["state"] == "NY") { ?>selected<?php } ?>>NY</option><option value=OH <?php if ($_SESSION["state"] == "OH") { ?>selected<?php } ?>>OH</option><option value=OK <?php if ($_SESSION["state"] == "OK") { ?>selected<?php } ?>>OK</option><option value=OR <?php if ($_SESSION["state"] == "OR") { ?>selected<?php } ?>>OR</option> <option value=PA <?php if ($_SESSION["state"] == "PA") { ?>selected<?php } ?>>PA</option><option value=RI <?php if ($_SESSION["state"] == "RI") { ?>selected<?php } ?>>RI</option><option value=SC <?php if ($_SESSION["state"] == "SC") { ?>selected<?php } ?>>SC</option><option value=SD <?php if ($_SESSION["state"] == "SD") { ?>selected<?php } ?>>SD</option><option value=TN <?php if ($_SESSION["state"] == "TN") { ?>selected<?php } ?>>TN</option><option value=TX <?php if ($_SESSION["state"] == "TX") { ?>selected<?php } ?>>TX</option><option value=UT <?php if ($_SESSION["state"] == "UT") { ?>selected<?php } ?>>UT</option><option value=VA <?php if ($_SESSION["state"] == "VA") { ?>selected<?php } ?>>VA</option><option value=VT <?php if ($_SESSION["state"] == "VT") { ?>selected<?php } ?>>VT</option><option value=WA <?php if ($_SESSION["state"] == "WA") { ?>selected<?php } ?>>WA</option><option value=WI <?php if ($_SESSION["state"] == "WI") { ?>selected<?php } ?>>WI</option><option value=WV <?php if ($_SESSION["state"] == "WV") { ?>selected<?php } ?>>WV</option><option value=WY <?php if ($_SESSION["state"] == "WY") { ?>selected<?php } ?>>WY</option><option value=AA <?php if ($_SESSION["state"] == "AA") { ?>selected<?php } ?>>AA</option> <option value=AE <?php if ($_SESSION["state"] == "AE") { ?>selected<?php } ?>>AE</option><option value=AP <?php if ($_SESSION["state"] == "AP") { ?>selected<?php } ?>>AP</option><option value=AS <?php if ($_SESSION["state"] == "AS") { ?>selected<?php } ?>>AS</option><option value=FM <?php if ($_SESSION["state"] == "FM") { ?>selected<?php } ?>>FM</option><option value=GU <?php if ($_SESSION["state"] == "GU") { ?>selected<?php } ?>>GU</option><option value=MH <?php if ($_SESSION["state"] == "MH") { ?>selected<?php } ?>>MH</option><option value=MP <?php if ($_SESSION["state"] == "MP") { ?>selected<?php } ?>>MP</option><option value=PR <?php if ($_SESSION["state"] == "PR") { ?>selected<?php } ?>>PR</option><option value=PW <?php if ($_SESSION["state"] == "PW") { ?>selected<?php } ?>>PW</option><option value=VI <?php if ($_SESSION["state"] == "VI") { ?>selected<?php } ?>>VI</option></select></div>";
		document.getElementById('stateprov').innerHTML = "<div class='signUpFieldLeft'>State:</div>";
	}
}
</script>
<script type="text/javascript" src="/js/jscolor.js"></script>

    <div id="content">
     
    <div id="mainContentFull">
	  <h2>Edit Account Information</h2>

	  <br /><br />
      
      <div id="signUpLeft">

  		  <div class="boxHeader"><span>Your Account Information</span></div>
  		  <form method="post" action="editaccount.php">
		  <input type="hidden" name="editaccount" value="1" />
		  <?php if ($errmsg) { ?>
		  <div class="signUpField">
            <div class="signUpFieldLeft">&nbsp;</div>
            <div class="signUpFieldRight"><?php echo $errmsg; ?></div>
          </div>
		  <?php } ?>
		  <div class="signUpField">
            <div class="signUpFieldLeft">New Password:</div>
            <div class="signUpFieldRight"><input type="password" id="password1" name="password1" style="width: 200px;" class="signupFieldInput" /></div>
          </div>
          <div class="signUpField">
            <div class="signUpFieldLeft">Repeat Password:</div>
            <div class="signUpFieldRight"><input type="password" id="password2" name="password2" style="width: 200px;" class="signupFieldInput" onchange="checkpass();" /></div>
		  <div id="passworddiv" style="padding-left:150px;"></div>
          </div>
          <div class="signUpField">
            <div class="signUpFieldLeft">Email Address:</div>
            <div class="signUpFieldRight"><input type="text" name="email" value="<?php echo $customer["email"]; ?>" style="width: 200px;" class="signupFieldInput" /></div>
          </div>
           <div class="boxHeader"><span style="float: left;">Customer Information</span><span style="font-size:10px;">(Your Shipping Information)</span></div>
           <div class="signUpField">
            <div class="signUpFieldLeft">First Name:</div>
            <div class="signUpFieldRight"><input type="text" name="firstname" value="<?php echo $customer["firstname"]; ?>" style="width: 200px;" class="signupFieldInput" /></div>
          </div>
          <div class="signUpField">
            <div class="signUpFieldLeft">Last Name:</div>
            <div class="signUpFieldRight"><input type="text" name="lastname" value="<?php echo $customer["lastname"]; ?>" style="width: 200px;" class="signupFieldInput" /></div>
          </div>
          <div class="signUpField">
            <div class="signUpFieldLeft">Company:</div>
            <div class="signUpFieldRight"><input type="text" name="companyname" value="<?php echo $customer["companyname"]; ?>" style="width: 200px;" class="signupFieldInput" /></div>
          </div>
          <div class="signUpField">
            <div class="signUpFieldLeft">Address:</div>
            <div class="signUpFieldRight"><input type="text" name="street" value="<?php echo $customer["street"]; ?>" style="width: 200px;" class="signupFieldInput" /></div>
          </div>
          <div class="signUpField">
            <div class="signUpFieldLeft">Address 2:</div>
            <div class="signUpFieldRight"><input type="text" name="street2" value="<?php echo $customer["street2"]; ?>" style="width: 200px;" class="signupFieldInput" /></div>
          </div>
          <div class="signUpField">
            <div class="signUpFieldLeft">City:</div>
            <div class="signUpFieldRight"><input type="text" name="city" value="<?php echo $customer["city"]; ?>" style="width: 200px;" class="signupFieldInput" /></div>
          </div>
          <div class="signUpField">
            <div class="signUpFieldLeft">Country:</div>
            <div class="signUpFieldRight"><select name="country" class="signupFieldInput" style="height: 20px;" onchange="changestatediv(this.value);"><option value="US">United States</option><option value="CA">Canada</option></select></div>
          </div>
          <div class="signUpField">
            <div id="stateprov">
              <div class="signUpFieldLeft">State:</div></div>
            <div id="statediv"><div class="signUpFieldRight"><input type="text" name="state"  value="<?php echo $customer["state"]; ?>" maxlength="2" style="width: 25px;" class="signupFieldInput" /></div></div>
          </div>
          <div class="signUpField">
            <div class="signUpFieldLeft">Zip:</div>
            <div class="signUpFieldRight"><input type="text" name="zip" value="<?php echo $customer["zip"]; ?>" maxlength="5" style="width: 50px;" class="signupFieldInput" /></div>
          </div>
          <div class="signUpField">
            <div class="signUpFieldLeft">Phone:</div>
            <div class="signUpFieldRight"><input type="text" name="phone" value="<?php echo $customer["phone"]; ?>" style="width: 200px;" class="signupFieldInput" /></div>
          </div>
          <div class="signUpField">
            <div style="height: 30px; text-align: center; line-height: 30px; margin-top:15px; margin-bottom: 15px;"><input type="image" value="submit" src="images/updateButton.png" /></div>
          </div>
          </form>
        </div>
    </div><!-- end mainContentFull -->
  
  </div><!-- end content -->
</div><!-- end wrapper -->
<div style="display: none;"><img src="/images/wizard/continueMinus.png" /></div>

<?php include_once 'inc/footer.php' ; ?>
<script language="javascript">
changestatediv("US");
</script>