<?php 
/**
* Footer template used by the CyberChimps Response Core Framework
*
* Authors: Tyler Cunningham, Trent Lapinski
* Copyright: © 2012
* {@link http://cyberchimps.com/ CyberChimps LLC}
*
* Released under the terms of the GNU General Public License.
* You should have received a copy of the GNU General Public License,
* along with this software. In the main directory, see: /licensing/
* If not, see: {@link http://www.gnu.org/licenses/}.
*
* @package Response
* @since 1.0.5
*/
	global $options, $themeslug // call globals
?>
	
<?php if ($options->get($themeslug.'_disable_footer') != "0"):?>	

</div><!--end container wrap-->

    <div id="footer" class="container">
     		<div class="row" id="footer_container">
    			<div id="footer_wrap">	
					<div id="footer" style="margin-top: 0px; border-top: none;">
  <div id="subFooter">
    <div id="subFooterMain">
      <div id="subFooterMain2">
        <div id="subFooterMain3">
          <div id="subFooterLeft">
          	<h5>Promotional Newsletter</h5>
            <p>Keep up to date with our latest <strong><em>promotional offers</em></strong> and <strong><em>new products.</em></strong></p>
            <form action="http://madmimi.com/signups/subscribe/14548" method="post">
            <input id="signup_email" name="signup[email]" type="text" value="Email Address..." onfocus="this.value=''" /><input type="image" src="/images/subscribeButton.png" value="submit" id="subscribe_button" />
			</form>
          </div>
          <div id="subFooterMiddle"><img src="/images/footerCardsSecure.png" width="135" height="80" alt="We take all major credit cards" /></div>
          <div id="subFooterRight">
          	<h5>More Name Badge Information:</h5>
            <ul id="footerListLeft">
            	<li><a href="/employee-name-badges.php">Employee Name Badges</a></li>
                <li><a href="/professional-name-badges.php">Professional Name Badges</a></li>
                <li><a href="/magnetic-name-tags.php">Magnetic Fastener Tags</a></li>
            </ul>
            <ul id="footerListRight">
            	<li><a href="/name-tags.php">Name Tags</a></li>
                <li><a href="/plastic-name-badges.php">Plastic Name Badges</a></li>
                <li><a href="/reusable-name-badges.php">Reusable Name Badges</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  	<div style="clear:both;"></div>
    
    <ul id="footerMenu">
   	  <li><a href="/" style="margin-left: 5px;">Home</a></li>
      <li class="footerMenuSpacer">|</li>
      <li><a href="/name-badges.php">Products</a></li>
      <li class="footerMenuSpacer">|</li>
      <li><a href="/whats-new.php">What's New</a></li>
      <li class="footerMenuSpacer">|</li>
      <li><a href="/about-us.php">About Us</a></li>
      <li class="footerMenuSpacer">|</li>
      <li><a href="/privacy_policy.php" target="_blank">Privacy Policy</a></li>
      <li class="footerMenuSpacer">|</li>
      <li><a href="/terms_of_service.php" target="_blank">Terms of Service</a></li>
      <li class="footerMenuSpacer">|</li>
      <li><a href="/blog">Blog</a></li>
      <li class="footerMenuSpacer">|</li>
      <li><a href="/contact-us.php">Contact Us</a></li>
    </ul>
    <div id="footerCopyright">
      <div id="copyrightLeft">Copyright <?php echo date(Y) ;?> Best Name Badges. All Rights Reserved</div>
      <div id="copyrightRight">Partners: <a href="http://www.anticoelements.com">AnticoElements.com</a>
      <br/><a href="http://www.bnbpromotionalproducts.com">BNB Promotional Products</a></div>
    </div>
    <div style="clear: both;"></div>
<br />
<br />
<br />

  </div>
</div><!-- end footer -->
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-13144927-1");
pageTracker._trackPageview();
} catch(err) {}</script>

<script type="text/javascript">
function wsa_include_js(){
	var wsa_host = (("https:" == document.location.protocol) ? "https://" : "http://");
	var js = document.createElement('script');
	js.setAttribute('language', 'javascript');
	js.setAttribute('type', 'text/javascript');
	js.setAttribute('src',wsa_host + 'a5.websitealive.com/1572/Visitor/vTracker_v2.asp?websiteid=177&groupid=1572');
	document.getElementsByTagName('head').item(0).appendChild(js);
}
if (window.attachEvent) {window.attachEvent('onload', wsa_include_js);}
else if (window.addEventListener) {window.addEventListener('load', wsa_include_js, false);}
else {document.addEventListener('load', wsa_include_js, false);}
</script>


</body>
</html>
				</div>
	<?php endif;?>
	
			</div><!--end footer_wrap-->
	</div><!--end footer-->
</div> 

<?php if ($options->get($themeslug.'_disable_afterfooter') != "0"):?>

	<div id="afterfooter" class="container">
		<div class="row" id="afterfooterwrap">	
		<!--Begin response_secondary_footer hook-->
			<?php response_secondary_footer(); ?>
		<!--End response_secondary_footer hook-->
				
		</div> <!--end afterfooter-->	
	</div> 	
	<?php endif;?>
	
	<?php wp_footer(); ?>	
</body>

</html>