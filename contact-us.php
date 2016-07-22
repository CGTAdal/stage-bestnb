<?php 

require_once('admin/conn/DB.php');

include('admin/conn/tablefuncs.php');

mysql_select_db($database_DB, $ravcodb);

session_start();



$pagetitle = "Contact Us - Best Name Badges and Tags";

$metadescription = "We are easy to get a hold of!  3 convenient ways to contact one of the Best Name Badges professionals.";

$metakeywords = "name badges, name tags, custom name badge, custom name tags, metal name tags, brushed aluminum name badges, plastic name tags, plastic name badges, color name badges, employee name tags, employee name badges, professional name tags, professional name badges"; 

?>

<?php 

if ($_SESSION["customerloginid"])

{

	include_once 'inc/header-auth.php';

} else {

	//include_once 'inc/header.php' ;
	include_once 'inc/header_new.php' ;

} ?>



  <div id="hero" class="herobgnone">
 <img src="images/heroBG.jpg"  />
  <div id="heroHeader" class="heroheadrnone">
    &nbsp;
  </div>

</div>
<!-- end hero -->

  

  <div id="content">
	
    <div id="leftColumn">
	 <?php
      include_once 'inc/leftcolumn3.php' ; 
      
      ?>
    </div><!-- end leftColumn -->

    

    <div id="mainContent">
	 
    <div class="subright flr">
	  <h2>Contact Best Name Badges</h2>

  		<h4>We would love to hear from you.</h4>

        <br />

		<br />

<div  class="contanctus-namebadesouter">

<span id="phplive_btn_1430415007" onclick="phplive_launch_chat_6(0)" style="color: #0000FF; text-decoration: underline; cursor: pointer;"></span>
<script type="text/javascript">

(function() {
var phplive_e_1430415007 = document.createElement("script") ;
phplive_e_1430415007.type = "text/javascript" ;
phplive_e_1430415007.async = true ;
phplive_e_1430415007.src = "//www.bnblivechat.com/chat/js/phplive_v2.js.php?v=6|1430415007|0|" ;
document.getElementById("phplive_btn_1430415007").appendChild( phplive_e_1430415007 ) ;
})() ;

</script>
<img src="images/contact-us-phone-icon.jpg" width="168" height="184" />
<a href="mailto:support@bestnamebadges.com"><img src="images/contact-us-email-icon.jpg" width="168" height="184" /></a>


</div>


<br />

    <div class="contactusaddress-imgouter" >     
       <div  class="contactusaddress-outer">
           <div class="contactusaddress-first" >

         <div style="float: left; width: 110px; font-size: 15px; font-weight: bold; color: #000;">

         Our Address:

         </div>

         <div class="contactaddress-right" >

         Best Name Badges<br/>

         1700 NW 65th Ave, Suite 4<br/>

         Plantation, FL 33313</div>

         </div>
 
           <div class="contactusaddress-first">

         <div style="float: left; width: 110px; font-size: 15px; font-weight: bold; color: #000;">

         Hours:

         </div>

         <div class="contactaddress-right" >

          Monday - Friday:  9AM - 6PM
          Saturday - Sunday:  Closed

        </div>

      </div>

           <div class="contactusaddress-first">

         <div style="float: left; width: 110px; font-size: 15px; font-weight: bold; color: #000;">

        Phone:

         </div>

         <div class="contactaddress-right" >

          (888) 445-7601

        </div>

      </div>
           <div class="contactusaddress-first">

         <div style="float: left; width: 110px; font-size: 15px; font-weight: bold; color: #000;">

         Local Phone:

         </div>

         <div class="contactaddress-right" >

          (954) 691-2400

        </div>

      </div>
   
           <div class="contactusaddress-first">

         <div style="float: left; width: 110px; font-size: 15px; font-weight: bold; color: #000;">Fax:</div>

         <div class="contactaddress-right" >

          (888) 775-5155

        </div>

        </div>
        </div>
        <div class="contactusmapouter" > <a href="https://www.google.com/maps/place/Best+Name+Badges/@26.14663,-80.23574,17z/data=!3m1!4b1!4m2!3m1!1s0x88d90f52e34c51bd:0xd53965fc9344ca0c" target="_blank"><img src="images/contact-us-map.jpg" /></a>
        
        </div>
        
</div>
         

         

	  <div  class="contactusmapbuttomimg">
		<br /><br />
		<img src="/images/contact-us-facility-plantation.jpg" width="616" height="310" style="padding-top: 15px;" />
		
		</div>
	</div>	
    </div>

    <!-- end mainContent -->

  

  </div><!-- end content -->

</div><!-- end wrapper -->



<div style="display: none;"><img src="/images/sevenReasonsButtonMinus.png" /></div>



<?php include_once 'inc/footer.php' ; ?>