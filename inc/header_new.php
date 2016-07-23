<?php
include('include/config.php');
include_once 'inc/prices.php' ;
 ?>
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $pagetitle ; ?></title>
<meta name="description" content="<?php echo $metadescription ; ?>" />
<meta name="keywords" content="<?php echo $metakeywords ; ?>" />

<script type="text/javascript" src="<?php echo $base_url?>/js/slider.js"></script>
<script src="<?php echo $base_url;?>/js/jquery-1.5.1.js"></script>
<script type="text/javascript" src="<?php echo $base_url?>/js/login.js"></script>
<link href="<?php echo $base_url;?>/style.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $base_url;?>/css/style.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $base_url;?>/css/style_new.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $base_url;?>/css/ui-responsive.css" rel="stylesheet" type="text/css" />
		<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<script type="text/javascript">
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
   
</script>
<script>
$(document).ready(function(){
    $(".menudiv-icon").click(function(){
       $("#navigationTop").slideToggle("slow");
    });	  
});
</script>
</head>

<body>
<div id="wrapper">
  <div id="header">
    <div id="topBar" class="desktop-show">
    	<ul>
        	<li style="padding-right: 0;"><a href="<?php echo $base_url;?>/about-us.php">About Us</a></li>
            <li>|</li>
            <li><a href="<?php echo $base_url;?>/whats-new.php">What's New</a></li>
        </ul>
    </div>
    <div id="headerBar">
      <div id="headerBarLeft"><img src="<?php echo $base_url;?>/images/best-name-badges-logo.png" width="228" height="67" alt="Best Name Badges" /></div>
      <div id="topBar" class="responsive-show">
    	<ul>
        	<li style="padding-right: 0;"><a href="<?php echo $base_url;?>/about-us.php">About Us</a></li>
            <li>|</li>
            <li><a href="<?php echo $base_url;?>/whats-new.php">What's New</a></li>
             <li>|</li>
            <li><a href="<?php echo $base_url;?>/blog">Our Blog</a></li>
           
        </ul>
    </div>
      <div id="navigationWrapper">
        <button class="menudiv-icon">
           <span class="icon-bar"></span>
           <span class="icon-bar"></span>
           <span class="icon-bar"></span>
        </button>
        <div id="navigationTop">
        	<ul>
            	<li><a href="<?php echo $base_url;?>">Home</a></li>
                <li><a href="<?php echo $base_url;?>/corporate-name-badges.php">Corporate Ordering</a></li>
                <li><a href="<?php echo $base_url;?>/name-badges.php">Products</a></li>
                <li><a href="<?php echo $base_url;?>/testimonials.php">Testimonials</a></li>
                <li><a href="<?php echo $base_url;?>/contact-us.php">Contact Us</a></li>
            </ul>
        </div>
        <div id="navigationBottom">
          <div id="navigationBottomLeft">
          <!--<img style="float: left;" src="/images/navPhone.png" width="181" height="24" class="res-hide"/>-->
          <span class="desktopknone-mobiletext">toll-free<sub><sup>(</sup>888<sup>)</sup> 445-7601</sub></span>
          <div class="headergraybuttonouter"><div style="text-align:center;width:133px;"><img src='https://a5.websitealive.com/1572/Visitor/vButton_v3.asp?groupid=1572&departmentid=7727&w=400&h=400&icon_online=https%3A%2F%2Fimages%2Ewebsitealive%2Ecom%2Fimages%2Fhosted%2Fupload%2F32674%2Epng&icon_offline=https%3A%2F%2Fimages%2Ewebsitealive%2Ecom%2Fimages%2Fhosted%2Fupload%2F32675%2Epng' border='0' onClick="window.open('https://a5.websitealive.com/1572/rRouter.asp?groupid=1572&websiteid=177&departmentid=7727&dl='+escape(document.location.href),'','width=400,height=400');" style='cursor:pointer;'>
		</div></div></div>
          <div id="navigationBottomRight">
				  <div id="bar">
						<div id="container">
							<!-- Login Starts Here -->
							<div id="loginContainer">
								<a href="#" id="loginButton"><span>Customer Login</span><em></em></a>
								<div style="clear:both"></div>
								<div id="loginBox">                
									<form id="loginForm" name="loginform" method="post" action="<?php echo $base_url;?>/sign-up.php">
										<?php if(isset($_SESSION['redirect'])){?>
										  <input type="hidden" value="<?php echo $_SESSION['redirect'];?>" name="checkredirect" />
										  <?php }else {?>
										  <input type="hidden" value="0" name="checkredirect" />
										 <?php }?>
										<input type="hidden" name="attempt3" id="attempt3" value="1" />
										<input type="hidden" name="location" id="location" value="<?php echo basename($PHP_SELF); ?>" />
										<fieldset id="body">
											<fieldset>
												<label for="email">User name</label>
												 <input type="text" name="username" id="email" value="username" onfocus="this.value=''"/>
											</fieldset>
											<fieldset>
												<label for="password">Password</label>
												 <input type="password" name="password" id="password" value="password" onfocus="this.value=''"/>
											</fieldset>
											<input type="submit" id="login" value="Sign in" />
										</fieldset>
										<span><a href="password-reminder.php">Forgot password?</a></span>
									</form>
								</div>
							</div>
							<!-- Login Ends Here -->
						</div>
				</div>
          </div>
        </div>
      </div>
    </div><!-- end headerBar -->
  </div><!-- end header -->