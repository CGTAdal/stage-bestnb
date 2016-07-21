<?php 
require_once('admin/conn/DB.php');
include('admin/conn/tablefuncs.php');
include('include/config.php');
mysql_select_db($database_DB, $ravcodb);
session_start();

include('include/input.php');

function remove_xss($Str_Input)
    {
    @settype($Str_Input, 'string');
    $Str_Input= @strip_tags($Str_Input);
	    $_Ary_TagsList= array('jav&#x0A;ascript:', 'jav&#x0D;ascript:', 'jav&#x09;ascript:', '<!-', '<', '>', '%3C', '&lt', '&lt;', '&LT', '&LT;', '&#60', '&#060', '&#0060', '&#00060', '&#000060', '&#0000060', '&#60;', '&#060;', '&#0060;', '&#00060;', '&#000060;', '&#0000060;', '&#x3c', '&#x03c', '&#x003c', '&#x0003c', '&#x00003c', '&#x000003c', '&#x3c;', '&#x03c;', '&#x003c;', '&#x0003c;', '&#x00003c;', '&#x000003c;', '&#X3c', '&#X03c', '&#X003c', '&#X0003c', '&#X00003c', '&#X000003c', '&#X3c;', '&#X03c;', '&#X003c;', '&#X0003c;', '&#X00003c;', '&#X000003c;', '&#x3C', '&#x03C', '&#x003C', '&#x0003C', '&#x00003C', '&#x000003C', '&#x3C;', '&#x03C;', '&#x003C;', '&#x0003C;', '&#x00003C;', '&#x000003C;', '&#X3C', '&#X03C', '&#X003C', '&#X0003C', '&#X00003C', '&#X000003C', '&#X3C;', '&#X03C;', '&#X003C;', '&#X0003C;', '&#X00003C;', '&#X000003C;', '\x3c', '\x3C', '\u003c', '\u003C', chr(60), chr(62));
	    $Str_Input= @str_replace($_Ary_TagsList, '', $Str_Input);
	    $Str_Input= @str_replace('', '', $Str_Input);
	    return((string)$Str_Input);
    }


// function use to remove XSS
function strip_javascript_input($filter){
  
    // realign javascript href to onclick
   // $filter = preg_replace("/href=(['\"]).*?javascript:(.*)?\\1/i", "onclick=' $2 '", $filter);
   $filter = preg_replace("/href=(['\"]).*?javascript:(.*)?\\1/i", "'", $filter);	

    //remove javascript from tags
    while( preg_match("/<(.*)?javascript.*?\(.*?((?>[^()]+)|(?R)).*?\)?\)(.*)?>/i", $filter))
       /* $filter = preg_replace("/<(.*)?javascript.*?\(.*?((?>[^()]+)|(?R)).*?\)?\)(.*)?>/i", "<$1$3$4$5>", $filter);*/
	 $filter = preg_replace("/<(.*)?javascript.*?\(.*?((?>[^()]+)|(?R)).*?\)?\)(.*)?>/i", "", $filter);	
            
    // dump expressions from contibuted content
    if(0) $filter = preg_replace("/:expression\(.*?((?>[^(.*?)]+)|(?R)).*?\)\)/i", "", $filter);

    while( preg_match("/<(.*)?:expr.*?\(.*?((?>[^()]+)|(?R)).*?\)?\)(.*)?>/i", $filter))
       /* $filter = preg_replace("/<(.*)?:expr.*?\(.*?((?>[^()]+)|(?R)).*?\)?\)(.*)?>/i", "<$1$3$4$5>", $filter); */
	 $filter = preg_replace("/<(.*)?:expr.*?\(.*?((?>[^()]+)|(?R)).*?\)?\)(.*)?>/i", "", $filter);
       
    // remove all on* events   
    while( preg_match("/<(.*)?\s?on.+?=?\s?.+?(['\"]).*?\\2\s?(.*)?>/i", $filter) )
      /*$filter = preg_replace("/<(.*)?\s?on.+?=?\s?.+?(['\"]).*?\\2\s?(.*)?>/i", "<$1$3>", $filter);*/
	 $filter = preg_replace("/<(.*)?\s?on.+?=?\s?.+?(['\"]).*?\\2\s?(.*)?>/i", "", $filter);

    return htmlentities(strip_tags($filter));
} 
// end of function remove XSS
//$_GET = array_map('strip_javascript',$_GET);

if ($_SESSION["customerloginid"])
{
	if(isset($_POST["designoption"])){
		if(strip_javascript_input($_POST["designoption"]) == 1){
			header("location: $base_url/wizard2.php");
		}
		if(strip_javascript_input($_POST["designoption"]) == 2){
			header("location: $base_url/wizard.php");
		}
		if(strip_javascript_input($_POST["designoption"]) == 3){
			header("location: $base_url/wizard3.php");
		}
		if(strip_javascript_input($_POST["designoption"]) == 5){
			header("location: $base_url/order-wizard-printed.php");
		}
		if(strip_javascript_input($_POST["designoption"]) == 6){
			header("location: $base_url/order-wizard-engraved.php");
		}
		if(strip_javascript_input($_POST["designoption"]) == 7){
			header("location: $base_url/order-complete-printed.php");
		}
		if(strip_javascript_input($_POST["designoption"]) == 8){
			header("location: $base_url/order-complete-engraved.php");
		}
		if(strip_javascript_input($_POST["designoption"]) == 9){
			header("location: $base_url/order-wizard-reusable.php");
		}
		if(strip_javascript_input($_POST["designoption"]) == 10){
			header("location: $base_url/order-wizard-id-badges.php");
		}
		if(strip_javascript_input($_POST["designoption"]) == 11){
			header("location: $base_url/order-complete-id-badges.php");
		}
		
		if(strip_javascript_input($_POST["designoption"]) == 12){
			header("location: $base_url/order-wizard-name-plates.php");
		}
		if(strip_javascript_input($_POST["designoption"]) == 13){
			header("location: $base_url/order-complete-name-plates.php");
		}
	}
	
}else{

	if(isset($_POST["designoption"])){
		$_SESSION['redirect'] = strip_javascript_input($_POST["designoption"]);
	}else {
		$_SESSION['redirect'] = 0;
	}
	if($_REQUEST['template'] == 1){	
		 $_SESSION['add_name_templates']	 = 1;	
		$_SESSION['redirect'] = 4;
	}

}

if(isset($_REQUEST['url']) && ($_REQUEST['url'] == 'add-names') ){
	$url = 	$_REQUEST['url'];
}else {
	$url ='';
}
//echo $_SESSION['redirect'];
if ($_REQUEST["logout"])
{
	unset($_SESSION["customerloginid"]);
	unset($_SESSION["username"]); 
	header("location: $base_url");
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



if ($_POST["attempt2"])
{
	$_POST = array_map('strip_javascript_input',$_POST);
	$qry = "SELECT * FROM customers WHERE username = '".$_POST["username1"]."'";
	$users = mysql_query($qry);
	$user = mysql_fetch_assoc($users);

	
	if ($user)
	{
		$errormsg = "User Name Already Taken<br>";
	}
	$username =$_POST["username1"];
	
	if($username ==''){
		$errormsg = "Please Enter User Name<br>";
	}
	
	$password1 = $_POST["password1"];
	$password2 =$_POST["password1"];
	if ($password1 != $password2)
	{
		$errormsg .= "Passwords Don't Match<br>";
	}
	$firstname = $_POST["firstname"];
	if ($firstname == '')
	{
		$errormsg .= "Please Enter a First Name<br>";
	}
	$lastname = $_POST["lastname"];
	if ($lastname == '')
	{
		$errormsg .= "Please Enter a Last Name<br>";
	}

	$street = $_POST["street"];
	if ($street == '')
	{
		$errormsg .= "Please Enter an Address<br>";
	}
	$city = $_POST["city"];
	if ($city == '')
	{
		$errormsg .= "Please Enter a City<br>";
	}
	$state = $_POST["state"];
	if ($state =='')
	{
		$errormsg .= "Please Enter a State<br>";
	}
	$zip = $_POST["zip"];
	if ($zip=='')
	{
		$errormsg .= "Please Enter a Zip Code<br>";
	}
	
	$phone_number =  $_POST["phone"];
	if ($phone_number=='')
	{
		$errormsg .= "Please Enter a Phone Number<br>";
	}

	
	if (!$errormsg)
	{
		
		$_POST["username"] = $_POST["username1"];
		unset($_POST["username1"]);
		$_POST["password"] = $_POST["password1"];
        unset($_POST["password1"]);
		unset($_POST["password2"]);
		unset($_POST["attempt2"]);
		unset($_POST["x"]);
		unset($_POST["y"]);
		unset($_POST["agree"]);
		$check  = $_POST["checkredirect"];
		unset($_POST["checkredirect"]);
		$_POST["ip"] = $_SERVER['REMOTE_ADDR'];
			//echo '<pre>'.print_r($_POST).'</pre>';
			//die();
			// remove XSS	
			$_user_info = array_map('strip_javascript_input',$_POST);
			// end XSS
			$_SESSION["customerloginid"] = add_record("customers", $_user_info);

			$_SESSION["username"] = $_POST["firstname"]." ".$_POST["lastname"];
			$_SESSION["state"] = $_POST["state"];				
            
            // sent mail 
            
            $subject1 = '[Best Name Badges] New Sign Up';
            $message1 = "<strong>Best Name Badges has received a new Sign Up:</strong><br>
                        ".$_POST["firstname"]." ".$_POST["lastname"]."<br>".$_POST["street"]."<br>".$_POST["city"].", ".$_POST["state"]." ".$_POST["zip"]."
                            <br>".$_POST["phone"]."<br>".$_POST["email"];                                              

                //define the headers we want passed. Note that they are separated with \r\n    
                //add boundary string and mime type specification   
            $header1s = "MIME-Version: 1.0" . "\r\n";					
            $header1s .= "Content-type:text/html; charset=utf-8" . "\r\n";
            $header1s .= "X-Mailer: PHP/" . phpversion() . "\r\n";            
            mail("leads@blanknamebadges.com", $subject1, $message1, $header1s);     
            //       
            // end sent mail
            
			if($check !=0){
				if($check == 1){
					header("location: wizard2.php");
				}
				if($check == 2){
					header("location: $base_url/wizard.php");
				}
				if($check == 3){
					header("location: $base_url/wizard3.php");
				}
				if($check == 4){
					 header("location: add-names.php");
				}
				if($check == 5){
					header("location: $base_url/order-wizard-printed.php");
				}
				if($check == 6){
					header("location: $base_url/order-wizard-engraved.php");
				}
				if($check == 7){
					header("location: $base_url/order-complete-printed.php");
				}
				if($check == 8){
					header("location: $base_url/order-complete-engraved.php");
				}
				if($check == 9){					
					header("location: $base_url/order-wizard-reusable.php");
				}
				if($check == 10){
					header("location: $base_url/order-wizard-id-badges.php");
				}
				if($check == 11){
					header("location: $base_url/order-complete-id-badges.php");
				}
				
				if($check == 12){					
					header("location: $base_url/order-wizard-name-plates.php");
				}
				
				if($check == 13){					
					header("location: $base_url/order-complete-name-plates.php");
				}
				
			}else{
				header("location: $base_url/order2.php");
			}
			//header("location: $base_url/order2.php");

	}
}

if ($_POST["attempt"])
{
	// remove attach XSS
	//$_POST = array_map('remove_xss',$_POST);
	// end XSS
	$qry = "SELECT * FROM customers WHERE username = '".$_POST["username"]."' AND password = '".$_POST["password"]."'";
	$logins = mysql_query($qry);
	$login = mysql_fetch_assoc($logins);
	
	if ($login)
	{
		$_SESSION["customerloginid"] = $login["id"];
		$_SESSION["username"] = $login["firstname"]." ".$login["lastname"];
		$_SESSION["state"] = $login["state"];
		
		if($_REQUEST['checkredirect'] !=0){			
			if($_REQUEST['checkredirect'] == 1){
				header("location: wizard2.php");
			}
			if($_REQUEST['checkredirect'] == 2){
				header("location: wizard.php");
			}
			if($_REQUEST['checkredirect'] == 3){
				header("location: wizard3.php");
			}
			if($_REQUEST['checkredirect'] == 4){
			  
			    header("location: add-names.php");
			}
			if($_REQUEST['checkredirect'] == 5){
					header("location: order-wizard-printed.php");
			}
			if($_REQUEST['checkredirect'] == 6){
					header("location: order-wizard-engraved.php");
			}
			if($_REQUEST['checkredirect'] == 7){
					header("location: $base_url/order-complete-printed.php");
			}
			if($_REQUEST['checkredirect'] == 8){
				header("location: $base_url/order-complete-engraved.php");
			}
			if($_REQUEST['checkredirect'] == 9){
				header("location: $base_url/order-wizard-reusable.php");
			}			
			if($_REQUEST['checkredirect'] == 10){
				header("location: $base_url/order-wizard-id-badges.php");
			}
			if($_REQUEST['checkredirect'] == 11){
				header("location: $base_url/order-complete-id-badges.php");
			}
			
			if($_REQUEST['checkredirect'] == 12){
				header("location: $base_url/order-wizard-name-plates.php");
			}
			if($_REQUEST['checkredirect'] == 13){
				header("location: $base_url/order-complete-name-plates.php");
			}
		}else{
			if($_REQUEST['url'] !=''){
				$url = 	$_REQUEST['url'];
				header("location: '.$url.'.php");
			}else{
				header("location: $base_url/customerpanel.php");
			}	
		}
		
		
	} else {
		$errormsg = "<font color='red'>Sorry, That username/password combination is invalid, please sign up or try logging in again</font>";
	}
}

if ($_POST["attempt3"])
{	
	// remove attach XSS
	//$_POST = array_map('remove_xss',$_POST);		
	// end XSS
	$qry = "SELECT * FROM customers WHERE username = '".mysql_escape_string($_POST["username"])."' AND password = '".mysql_escape_string($_POST["password"])."'";
	$logins = mysql_query($qry);
	$login = mysql_fetch_assoc($logins);
	
	if ($login)
	{
		$_SESSION["customerloginid"] = $login["id"];
		$_SESSION["username"] = $login["firstname"]." ".$login["lastname"];
		$_SESSION["state"] = $login["state"];
		if($_REQUEST['checkredirect'] !=0){
				if($_REQUEST['checkredirect'] == 1){
					header("location: wizard2.php");
				}
				if($_REQUEST['checkredirect'] == 2){
					header("location: wizard.php");
				}
				if($_REQUEST['checkredirect'] == 3){
					header("location: wizard3.php");
				}
				if($_REQUEST['checkredirect'] == 4){
					header("location: add-names.php");
				}
				if($_REQUEST['checkredirect'] == 5){
					header("location: $base_url/order-wizard-printed.php");
				}
				if($_REQUEST['checkredirect'] == 6){
					header("location: $base_url/order-wizard-engraved.php");
				}
				if($_REQUEST['checkredirect'] == 7){
					header("location: $base_url/order-complete-printed.php");
				}
				if($_REQUEST['checkredirect'] == 8){
					header("location: $base_url/order-complete-engraved.php");
				}
				if($_REQUEST['checkredirect'] == 9){
					header("location: $base_url/order-wizard-reusable.php");
				}
				if($_REQUEST['checkredirect'] == 10){
					header("location: $base_url/order-wizard-id-badges.php");
				}
				if($_REQUEST['checkredirect'] == 11){
					header("location: $base_url/order-complete-id-badges.php");
				}
				
				if($_REQUEST['checkredirect'] == 12){
					header("location: $base_url/order-wizard-name-plates.php");
				}
				
				if($_REQUEST['checkredirect'] == 13){
					header("location: $base_url/order-complete-name-plates.php");
				}
				
		}else{
			header("location: $base_url/customerpanel.php");
		}
		//header("location: $base_url/customerpanel.php");
		
	} else {
		$errormsg = "<font color='red'>Sorry, That username/password combination is invalid, please sign up or try logging in again</font>";
	}
}

$pagetitle = "Buy Name Badges - Custom Name Badge Styles and Tags";
$metadescription = "Best Name Badges offers several styles of high quality badges and tags to fit your needs.  Magnetic and Pin fasteners are included free of charge.";
$metakeywords = "name badges, name tags, custom name badge, custom name tags, metal name tags, brushed aluminum name badges, plastic name tags, plastic name badges, color name badges, employee name tags, employee name badges, professional name tags, professional name badges"; 
?>
<?php 
if ($_SESSION["customerloginid"])
{
	if(isset($_POST["designoption"])){
		$_SESSION['redirect'] = strip_javascript_input($_POST["designoption"]);
	}else {
		$_SESSION['redirect'] = 0;
	}
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
				alert("You browser pro\'lly don\'t support AJAX, get the newest version of Firefox");
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

function checkemail(name) {

  
  	url = "ajax/getemail.php?name=" + name;
  
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
				alert("You browser pro\'lly don\'t support AJAX, get the newest version of Firefox");
				return false;
			}
		}
	}
	
	if (req_fifo)
	{
		req_fifo.abort();
		req_fifo.onreadystatechange = gotemail;
	    req_fifo.open("POST", url, true);
		req_fifo.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	   	req_fifo.send(null);
	}

    
	
}

function gotemail() {
// only if req_fifo shows "loaded"
	if (req_fifo.readyState != 4 || req_fifo.status != 200) {
    	return;
    }
	
	var info = req_fifo.responseText;
	
	if (info == "<font color='red'>Email Already Exists, Choose Another</font>")
	{
		document.getElementById("emaildiv").innerHTML=info;
		document.getElementById("email").focus();
	} else {
		document.getElementById("emaildiv").innerHTML=info;
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
		document.getElementById('statediv').innerHTML = "<div class='signUpFieldRight'><select id=state name=state><option selected></option><option value=AB>AB</option><option value=BC>BC</option><option value=MB>MB</option><option value=NB>NB</option><option value=NL>NL</option><option value=NT>NT</option><option value=NS>NS</option><option value=NU>NU</option><option value=ON>ON</option><option value=PE>PE</option><option value=QC>QC</option><option value=SK>SK</option><option value=YT>YT</option></select></div>";
		document.getElementById('stateprov').innerHTML = "<div class='signUpFieldLeft'>Province:</div>";
	} else if (country == "US")	{
		document.getElementById('statediv').innerHTML = "<div class='signUpFieldRight'><select id=state name=state><option selected></option><option value=AK>AK</option><option value=AL>AL</option><option value=AR>AR</option><option value=AZ>AZ</option><option value=CA>CA</option><option value=CO>CO</option><option value=CT>CT</option><option value=DC>DC</option><option value=DE>DE</option><option value=FL>FL</option><option value=GA>GA</option><option value=HI>HI</option><option value=IA>IA</option><option value=ID>ID</option><option value=IL>IL</option><option value=IN>IN</option><option value=KS>KS</option><option value=KY>KY</option><option value=LA>LA</option><option value=MA>MA</option><option value=MD>MD</option><option value=ME>ME</option><option value=MI>MI</option><option value=MN>MN</option><option value=MO>MO</option><option value=MS>MS</option><option value=MT>MT</option><option value=NC>NC</option><option value=ND>ND</option><option value=NE>NE</option> <option value=NH>NH</option><option value=NJ>NJ</option><option value=NM>NM</option><option value=NV>NV</option><option value=NY>NY</option><option value=OH>OH</option><option value=OK>OK</option><option value=OR>OR</option> <option value=PA>PA</option><option value=RI>RI</option><option value=SC>SC</option><option value=SD>SD</option><option value=TN>TN</option><option value=TX>TX</option><option value=UT>UT</option><option value=VA>VA</option><option value=VT>VT</option><option value=WA>WA</option><option value=WI>WI</option><option value=WV>WV</option><option value=WY>WY</option><option value=AA>AA</option> <option value=AE>AE</option><option value=AP>AP</option><option value=AS>AS</option><option value=FM>FM</option><option value=GU>GU</option><option value=MH>MH</option><option value=MP>MP</option><option value=PR>PR</option><option value=PW>PW</option><option value=VI>VI</option></select></div>";
		document.getElementById('stateprov').innerHTML = "<div class='signUpFieldLeft'>State:</div>";
	}
}

</script>
<?php $_POST = array_map('strip_javascript_input',$_POST);?>	
    <div id="content">	
     <div id="mainContentFull">
	  <?php if ($errormsg) { echo "<font color='red'><p>&nbsp</p><center><h3>".$errormsg."</h3></center><p>&nbsp;</p></font>"; } ?>
      
	 <!--<img src="images/sign-up-tout.png" width="954" height="144" />-->
        
               
  		<div id="signUpLeft">
        <h3>New Customers:</h3><br />
		  <?php if ($hackermsg) { echo $hackermsg."<BR><BR>"; }  ?>
  		  <div class="boxHeader"><span>Your Account Information</span></div>
  		  <form method="post" action="sign-up.php">
		  <input type="hidden" value="<?php echo $_SESSION['redirect'];?>" name="checkredirect" />
		  <input type="hidden" name="attempt2" value="1" />
          <div class="signUpField">
            <div class="signUpFieldLeft">Username*:</div>
            <div class="signUpFieldRight"><input type="text" name="username1" id="username1" style="width: 200px;" class="signupFieldInput" value="<?php echo $_POST['username']; ?>" onchange="checkusername(this.value);"/>
			</div>
			<div id="usernamediv" style="padding-left:150px;"></div>
          </div>
		  
          <div class="signUpField">
            <div class="signUpFieldLeft">Password*:</div>
            <div class="signUpFieldRight"><input type="password" id="password1" name="password1" style="width: 200px;" class="signupFieldInput" /></div>
          </div>
          <div class="signUpField">
            <div class="signUpFieldLeft">Repeat Password*:</div>
            <div class="signUpFieldRight"><input type="password" id="password2" name="password2" style="width: 200px;" class="signupFieldInput" onchange="checkpass();" /></div>
		  <div id="passworddiv" style="padding-left:150px;"></div>
          </div>
          <div class="signUpField">
            <div class="signUpFieldLeft">Email Address*:</div>
            <div class="signUpFieldRight"><input type="text" name="email" id="email" value="<?php echo $_POST['email']; ?>" style="width: 200px;" class="signupFieldInput" onchange="checkemail(this.value);" /></div>
			<div id="emaildiv" style="padding-left:150px;"></div>
          </div>
           <div class="boxHeader"><span style="float: left;">Customer Information</span><span style="font-size:10px;">(Your Shipping Information)</span></div>
           <div class="signUpField">
            <div class="signUpFieldLeft">First Name*:</div>
            <div class="signUpFieldRight"><input type="text" name="firstname" value="<?php   echo $_POST['firstname'];  ?>" style="width: 200px;" class="signupFieldInput" /></div>
          </div>
          <div class="signUpField">
            <div class="signUpFieldLeft">Last Name*:</div>
            <div class="signUpFieldRight"><input type="text" name="lastname" value="<?php   echo $_POST['lastname']; ?>" style="width: 200px;" class="signupFieldInput" /></div>
          </div>
          <div class="signUpField">
            <div class="signUpFieldLeft">Company:</div>
            <div class="signUpFieldRight"><input type="text" name="companyname" value="<?php  echo $_POST['companyname']; ?>" style="width: 200px;" class="signupFieldInput" /></div>
          </div>
          <div class="signUpField">
            <div class="signUpFieldLeft">Address*:</div>
            <div class="signUpFieldRight"><input type="text" name="street" value="<?php   echo $_POST['street']; ?>" style="width: 200px;" class="signupFieldInput" /></div>
          </div>
          <div class="signUpField">
            <div class="signUpFieldLeft">Address 2:</div>
            <div class="signUpFieldRight"><input type="text" name="street2" value="<?php   echo $_POST['street2'];?>" style="width: 200px;" class="signupFieldInput" /></div>
          </div>
          <div class="signUpField">
            <div class="signUpFieldLeft">City*:</div>
            <div class="signUpFieldRight"><input type="text" name="city" value="<?php  echo $_POST['city']; ?>" style="width: 200px;" class="signupFieldInput" /></div>
          </div>
          <div class="signUpField">
            <div class="signUpFieldLeft">Country*:</div>
            <div class="signUpFieldRight"><select name="country" class="signupFieldInput" style="height: 20px;" onchange="changestatediv(this.value);"><option value="US">United States</option><option value="CA">Canada</option></select></div>
          </div>
          <div class="signUpField">
            <div id="stateprov"><div class="signUpFieldLeft">State*:</div></div>
            <div id="statediv"><div class="signUpFieldRight"><input type="text" name="state"  value="" maxlength="2" style="width: 25px;" class="signupFieldInput" /></div></div>
          </div>
          <div class="signUpField">
            <div class="signUpFieldLeft">Zip*:</div>
            <div class="signUpFieldRight"><input type="text" name="zip" value="<?php   echo $_POST['zip']; ?>" maxlength="7" style="width: 50px;" class="signupFieldInput" /></div>
          </div>
          <div class="signUpField">
            <div class="signUpFieldLeft">Phone*:</div>
            <div class="signUpFieldRight"><input type="text" name="phone" value="<?php echo $_POST['phone'];?>" style="width: 200px;" class="signupFieldInput" /></div>
          </div>
          <div class="signUpField">
            <div class="singupcheckboxouter" style="height: 30px;  line-height: 30px;"><input type="checkbox" name="agree" value="1" />      I agree to the <a href="/terms_of_service.php" target="_blank">terms of service</a>&nbsp;&nbsp;<?php if ($erragree) { echo $erragree; } ?></div>
            
          </div>
          
          
          <div class="signUpField">
            <div style="height: 30px; text-align: center; line-height: 30px; margin-top:15px; margin-bottom: 15px;"><input type="image" value="submit" src="images/continueButton.png" /></div>
          </div>
          </form>
        </div>
  		<div id="signUpRight" style="width: 425px;">
        
        <img style="margin-top: 33px;" src="/images/sign-up-facts.png" width="425" height="589" />
        
        
        </div>
<br />
</div><!-- end mainContentFull -->
  
  </div><!-- end content -->
</div><!-- end wrapper -->

<div style="display: none;"><img src="/images/sevenReasonsButtonMinus.png" /></div>

<?php include_once 'inc/footer.php' ; ?>
<script language="javascript">
changestatediv("US");
</script>
