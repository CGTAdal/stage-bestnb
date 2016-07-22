<?php 
include_once 'inc/prices.php'; 
include('include/config.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"> 
<head>    
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="pragma" content="no-cache"/> 
<title><?php echo $pagetitle; ?></title>
<meta name="description" content="<?php echo $metadescription ; ?>" />
<meta name="keywords" content="<?php echo $metakeywords ; ?>" />
<script src="<?php echo $base_url;?>/js/jquery-1.5.1.js"></script>
<link href="<?php echo $base_url;?>/style.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $base_url;?>/css/style_new.css" rel="stylesheet" type="text/css" />	
<link href="<?php echo $base_url;?>/css/ui-responsive.css" rel="stylesheet" type="text/css" />
<!-- 
<link href="libupload/uploadify.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="libupload/swfobject.js"></script>
<script type="text/javascript" src="libupload/jquery.uploadify.v2.1.4.min.js"></script>
<script type="text/javascript" src="libupload/flash_detect.1.0.4.js"></script>
 -->
<script>
function downLoad(){ 
        if (document.all){ 
            document.all["layer1"].style.visibility="hidden";           
            document.getElementById("content").style.display='block';
        } else if (document.getElementById){           
            document.getElementById("layer1").style.visibility='hidden';
           document.getElementById("content").style.display='block';           
        }
}
</script>
<script>
$(document).ready(function(){
    $(".menudiv-icon").click(function(){
       $("#navigationTop").slideToggle("slow");
    });	  
});
</script>
</head>

<?php

$a = explode('/',$_SERVER['PHP_SELF']);

if($a[1]=='wizard.php'){
   echo '<body onload="downLoad();">';
}else{
    echo '<body>';
}
?>

<div id="wrapper">
  <div id="header">
    <div id="topBar" class="desktop-show">
    	<ul>
        	<li style="padding-right: 0;"><a href="/about-us.php">About Us</a></li>
            <li>|</li>
            <li><a href="<?php echo $base_url;?>/whats-new.php">What's New</a></li>
          </ul>
    </div>
    <div id="headerBar">
      <div id="headerBarLeft"><img src="/images/best-name-badges-logo.png" width="228" height="67" alt="Best Name Badges" /></div>
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
                <li><a href="<?php echo $base_url;?>/customerpanel.php">Order Badges</a></li>
                <li><a href="<?php echo $base_url;?>/orders.php">Receipts</a></li>
                <li><a href="<?php echo $base_url;?>/editaccount.php">Edit Account</a></li>
                <li><a href="<?php echo $base_url;?>/contact-us.php">Contact Us</a></li>
				<li><a href="<?php echo $base_url;?>/sign-up.php?logout=1&location=<?php echo basename($PHP_SELF); ?>">Logout</a></li>
            </ul>
        </div>
        <div id="navigationBottom">
          <div id="navigationBottomLeft">
          <!--<img style="float: left;" src="images/navPhone.png" width="181" height="24" class="res-hide"/>-->
          <span class="desktopknone-mobiletext">toll-free<sub><sup>(</sup>888<sup>)</sup> 445-7601</sub></span>
          <div style="float:right;"><div style="text-align:center;width:133px;">
          
         <span id="phplive_btn_1430322739" onclick="phplive_launch_chat_3(0)" style="color: #0000FF; text-decoration: underline; cursor: pointer;"></span>
<script type="text/javascript">

(function() {
var phplive_e_1430322739 = document.createElement("script") ;
phplive_e_1430322739.type = "text/javascript" ;
phplive_e_1430322739.async = true ;
phplive_e_1430322739.src = "//www.bnblivechat.com/chat/js/phplive_v2.js.php?v=3|1430322739|0|" ;
document.getElementById("phplive_btn_1430322739").appendChild( phplive_e_1430322739 ) ;
})() ;

</script>
          </div></div></div>
          <div id="navigationBottomRight" style="width: 320px !important;padding-top: 0px">
       			<div style="padding-top: 5px; color: #e4e4e4; text-align: right; padding-right: 25px;font-family:arial; font-size: 13px;">Logged In: <?php echo $_SESSION["username"]; ?></div>
          </div>
        </div>
      </div>
    </div><!-- end headerBar -->
  </div><!-- end header -->