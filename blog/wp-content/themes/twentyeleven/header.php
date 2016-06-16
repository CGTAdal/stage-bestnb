<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<?php

include "../include/config.php";

include_once '../inc/prices.php' ;

 ?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'twentyeleven' ), max( $paged, $page ) );

	?></title>

<meta name="description" content="<?php echo $metadescription ; ?>" />

<meta name="keywords" content="<?php echo $metakeywords ; ?>" />
<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico">


<script type="text/javascript" src="<?php echo $base_url?>/js/slider.js"></script>

<script src="<?php echo $base_url;?>/js/jquery-1.5.1.js"></script>

<script type="text/javascript" src="<?php echo $base_url?>/js/login.js"></script>

<link href="<?php echo $base_url;?>/style.css" rel="stylesheet" type="text/css" />

<link href="<?php echo $base_url;?>/css/style.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
<link rel="profile" href="http://gmpg.org/xfn/11" />

<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>
</head>



<body style="margin-top: -28px;">
<div id="wrapper">
  <div id="header">
    <div id="topBar">
    	<ul>
        	<li style="padding-right: 0;"><a href="<?php echo $base_url;?>/about-us.php">About Us</a></li>
            <li>|</li>
            <li><a href="<?php echo $base_url;?>/whats-new.php">What's New</a></li>
        </ul>
    </div>
    <div id="headerBar">
      <div id="headerBarLeft"><img src="<?php echo $base_url;?>/images/best-name-badges-logo.png" width="228" height="67" alt="Best Name Badges" /></div>
      <div id="navigationWrapper">
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
          <div id="navigationBottomLeft"><img style="float: left;" src="/images/navPhone.png" width="181" height="24" /><div style="float:right;"><div style="text-align:center;width:133px;"><img src='https://a5.websitealive.com/1572/Visitor/vButton_v3.asp?groupid=1572&departmentid=7727&w=400&h=400&icon_online=https%3A%2F%2Fimages%2Ewebsitealive%2Ecom%2Fimages%2Fhosted%2Fupload%2F32674%2Epng&icon_offline=https%3A%2F%2Fimages%2Ewebsitealive%2Ecom%2Fimages%2Fhosted%2Fupload%2F32675%2Epng' border='0' onClick="window.open('https://a5.websitealive.com/1572/rRouter.asp?groupid=1572&websiteid=177&departmentid=7727&dl='+escape(document.location.href),'','width=400,height=400');" style='cursor:pointer;'>
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

<div id="hero" style="margin-bottom: 20px;">
  <div id="heroHeader">
    &nbsp;
  </div>
  
</div>
<!-- end hero -->



	<div id="main">