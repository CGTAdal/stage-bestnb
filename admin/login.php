<?php require_once('conn/DB.php'); ?>
<?php
include('conn/tablefuncs.php');
session_start();
mysql_select_db($database_DB, $ravcodb);
//echo md5('AdminbestnamebadgE');
if (isset($_POST["attempt"]))
{	
	$username = mysql_real_escape_string($_POST["username"]);
	settype($username, 'string');
	
	$qry = sprintf("SELECT * FROM users WHERE username = '%s' AND password = '%s'",mysql_real_escape_string($_POST["username"]),mysql_real_escape_string(md5($_POST["password"])));
	
	$logins = mysql_query($qry);
	$login = mysql_fetch_assoc($logins);
	
	if ($login)
	{
		$_SESSION["loginid"] = $login["id"];
		$_SESSION["userlevel"] = $login["userlevel"];
		$_SESSION["username"] = $login["name"];
		$_SESSION["m_id"] = $login["m_id"];
		header("location: admin.php");		
		return;
	} else {
		$errormsg = "<font color='red'>Sorry, That username/password combination<BR>is invalid, please try again</font>";
	}
}
?>

 <?php 
   $allow = array('202.78.172.178'); //76.110.187.195
   $current_ip = $_SERVER['REMOTE_ADDR'];
   
   foreach($allow AS $value)
   {
   	$count = strlen($value);
   	$block = substr($current_ip,0,$count);
   
   	if($block != $value)
   	{
   		echo 'You are not allowed here!';
   		//exit(); //temp commented
   	}
   } 
   ?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Login Page</title>
<link href="css/screen.css" rel="stylesheet" type="text/css" />
<link href="css/login.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="login">
	<h1 style="color:#fff">Admin Login</h1>
	<div id="login-body" class="clearfix"> 
		<form name="loginform" method="post" action="login.php">
			<input type="hidden" name="attempt" id="attempt" value="1" />
			<div class="content_front">
				<div class="pad">
					<div class="field">
						<label>Username:</label>
						<div class="">
							<span class="input">
								<input type="text" name="username" id="username" class="text">
							</span>
						</div>
					</div>
					<div class="field">
						<label>Password:</label>
						<div class="">
							<span class="input">
								<input type="password" name="password" id="password" class="text" />
							</span>
						</div>
					</div> 
					<?php if(isset($errormsg)&&$errormsg) {?>
						<div class="field" style="margin-bottom:10px">
							<label></label>
							<div>
								<?php echo $errormsg; ?>
							</div>
						</div>
					<?php }?> 
					<div class="field">
						<span class="label">&nbsp;</span>
						<div class=""><button type="submit" class="btn">Login to CMS</button></div>
					</div> 
	        	</div>
	    	</div>
		</form>
	</div>
</div>
</body>
</html>
