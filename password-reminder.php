<?php 
require_once('admin/conn/DB.php');
include('admin/conn/tablefuncs.php');
mysql_select_db($database_DB, $ravcodb);
session_start();

if ($_REQUEST["logout"])
{
	unset($_SESSION["customerloginid"]);
	unset($_SESSION["username"]);
	header("location: http://www.bestnamebadges.com/".$_REQUEST["location"]);
}

function email_header ($to_id, $from_name, $from_email, $return_path)
{

	$email_headers = sprintf(
	"From: %s <%s>\n".
	"Content-type: text/html; charset=iso-8859-1\n",
	$from_name, $from_email,
	$return_path, md5(EMAIL_HASH_KEY.$to_id), $to_id);

	return ($email_headers);
}

if ($_POST["attempt"])
{
	$qry = "SELECT * FROM customers WHERE email = '".$_POST["email"]."'";
	$users = mysql_query($qry);
	$user = mysql_fetch_assoc($users);
	
	if ($user)
	{
		
		$email_headers = email_header ("info@bestnamebadges.com", "Best Name Badges Forgot Password", "info@bestnamebadges.com", "info@bestnamebadges.com");
		ob_start();
		echo "Your Best Name Badges username/password is - ".$user["username"]."/".$user["password"]." Please <a href='http://www.bestnamebadges.com/sign-up.php'>click here</a> to login";
		$contents1 = ob_get_contents();
		ob_end_clean();
		mail($user["email"], "Best Name Badges Lost Password", $contents1, $email_headers);
	
	} else {
		$errormsg = "There are no accounts with that email address";
	}
}


$pagetitle = "Best Name Badges - Password Reminder";
$metadescription = "Can't remember your password? Simply enter your email here and we'll send your login details right away.";
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
function checkusername(name) {

  
  	url = "ajax/getuser.php?name=" + name;
  
   //alert(id);
    // branch for native XMLHttpRequest object
	req_fifo = false;

	try
	{
	req_fifo = new XMLHttpRequest();
	}
	
	catch (e)
	{
	
		try	{
			req_fifo = new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch (e)
		{
			try
			{
				req_fifo = new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e)
			{
				alert("Your browser pro\'lly don\'t support AJAX, get the newest version of Firefox");
				return false;
			}
		}
	}
	
	if (req_fifo)
	{
		req_fifo.abort();
		req_fifo.onreadystatechange = gotname;
	    req_fifo.open("POST", url, true);
		req_fifo.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	   	req_fifo.send(null);
	}

    
	
}

function gotname() {
// only if req_fifo shows "loaded"
	if (req_fifo.readyState != 4 || req_fifo.status != 200) {
    	return;
    }
	
	var info = req_fifo.responseText;
	
	if (info == "<font color='red'>Name Already Exists, Choose Another</font>")
	{
		document.getElementById("usernamediv").innerHTML=info;
		document.getElementById("username1").focus();
	} else {
		document.getElementById("usernamediv").innerHTML=info;
	}

	
	// Schedule next call to wait for fifo data
   //setTimeout("GetAsyncData()", 100);
   //return;
}
function checkpass()
{
		
	if (document.getElementById("password1").value == document.getElementById("password2").value)
	{
		document.getElementById("passworddiv").innerHTML = "<font color='green'>Passwords Match</font>";
	} else {
		document.getElementById("passworddiv").innerHTML = "<font color='red'>Passwords Don\'t Match</font>";
		document.getElementById("password2").focus();
	}
}

function changestatediv(country)
{
	if (country == "CA")
	{
		document.getElementById('statediv').innerHTML = "<div class='signUpFieldRight'><select id=state name=state><option selected></option><option value=AB>AB</option><option value=MB>MB</option><option value=NB>NB</option><option value=NL>NL</option><option value=NT>NT</option><option value=NS>NS</option><option value=NU>NU</option><option value=ON>ON</option><option value=PE>PE</option><option value=QC>QC</option><option value=SK>SK</option><option value=YT>YT</option></select></div>";
		document.getElementById('stateprov').innerHTML = "<div class='signUpFieldLeft'>Province:</div>";
	} else if (country == "US")	{
		document.getElementById('statediv').innerHTML = "<div class='signUpFieldRight'><select id=state name=state><option selected></option><option value=AK>AK</option><option value=AL>AL</option><option value=AR>AR</option><option value=AZ>AZ</option><option value=CA>CA</option><option value=CO>CO</option><option value=CT>CT</option><option value=DC>DC</option><option value=DE>DE</option><option value=FL>FL</option><option value=GA>GA</option><option value=HI>HI</option><option value=IA>IA</option><option value=ID>ID</option><option value=IL>IL</option><option value=IN>IN</option><option value=KS>KS</option><option value=KY>KY</option><option value=LA>LA</option><option value=MA>MA</option><option value=MD>MD</option><option value=ME>ME</option><option value=MI>MI</option><option value=MN>MN</option><option value=MO>MO</option><option value=MS>MS</option><option value=MT>MT</option><option value=NC>NC</option><option value=ND>ND</option><option value=NE>NE</option> <option value=NH>NH</option><option value=NJ>NJ</option><option value=NM>NM</option><option value=NV>NV</option><option value=NY>NY</option><option value=OH>OH</option><option value=OK>OK</option><option value=OR>OR</option> <option value=PA>PA</option><option value=RI>RI</option><option value=SC>SC</option><option value=SD>SD</option><option value=TN>TN</option><option value=TX>TX</option><option value=UT>UT</option><option value=VA>VA</option><option value=VT>VT</option><option value=WA>WA</option><option value=WI>WI</option><option value=WV>WV</option><option value=WY>WY</option><option value=AA>AA</option> <option value=AE>AE</option><option value=AP>AP</option><option value=AS>AS</option><option value=FM>FM</option><option value=GU>GU</option><option value=MH>MH</option><option value=MP>MP</option><option value=PR>PR</option><option value=PW>PW</option><option value=VI>VI</option></select></div>";
		document.getElementById('stateprov').innerHTML = "<div class='signUpFieldLeft'>State:</div>";
	}
}

</script>
    <div id="content">
     <div id="mainContentFull">
	  <?php if ($errormsg) { echo "<font color='red'><p>&nbsp</p><center><h3>".$errormsg."</h3></center><p>&nbsp;</p></font>"; } ?>
	  <h2>Name Badge Ordering</h2>
  		<h4>Forgot Password</h4>
		<?php if ($user) { ?>
		<div id="signUpLeft">
       		Thank you, your password has been emailed to you. Please check your email.
        </div>
		<?php } else { ?>
  		<div id="signUpLeft">
        <h3>Type in Email to Receive Password:</h3><br />
<div class="boxHeader"><span>Forgot Password</span></div>
  		  <form method="post" action="password-reminder.php">
		  <input type="hidden" name="attempt" value="1" />
		 
          <div class="signUpField">
            <div class="signUpFieldLeft">Email:</div>
            <div class="signUpFieldRight" style="width: 200px;float:left;"><input type="text" name="email" id="email" style="width: 150px;" class="signupFieldInput" /></div>
          </div>
          <div class="signUpField">
            <div style="text-align: center; line-height: 30px; margin-top:15px; margin-bottom: 10px;">
            <input type="image" value="submit" src="images/loginbutton2.png" /><br />
            </div>
          </div>
          </form>
        </div>
		<?php } ?>
<br />
</div><!-- end mainContentFull -->
  
  </div><!-- end content -->
</div><!-- end wrapper -->

<div style="display: none;"><img src="/images/sevenReasonsButtonMinus.png" /></div>

<?php include_once 'inc/footer.php' ; ?>