<?php 
require_once('admin/conn/DB.php');
include('admin/conn/tablefuncs.php');
mysql_select_db($database_DB, $ravcodb);
session_start();

$pagetitle = "The perfect Valentines gift is name tags - Best Name Badges";
$metadescription = "";
$metakeywords = "name badges, name tags, custom name badge, custom name tags, metal name tags, brushed aluminum name badges, plastic name tags, plastic name badges, color name badges, employee name tags, employee name badges, professional name tags, professional name badges"; 
?>
<?php 
if ($_SESSION["customerloginid"])
{
	include_once 'inc/header-auth.php';
} else {
	include_once 'inc/header.php' ;
} ?>

  <div id="hero">
    <div id="heroHeader">
    	<h1>NAME BADGE ORDERING... SIMPLIFIED.</h1>
        <p>Easy online ordering. Lightning fast <strong><u>1-day turnaround</u></strong>. Always free standard shipping. Full color.</p>
    </div>
    <div id="heroButton"><a href="/sign-up.php"><img src="images/getStartedButton.png" width="159" height="35" alt="Get Started" /></a></div>
  </div><!-- end hero -->
  
  <div id="content">
    <div id="leftColumn">
      <?php include_once 'inc/leftcolumn2.php' ; ?>
    </div><!-- end leftColumn -->
    
    <div id="mainContent">
     <div class="b-all-rightdiv">
	  <h2>The perfect Valentines gift is name tags</h2>
      <p>Valentines' day is just around the corner. Aren't you excited? But wait, one thing, one very important thing that comes into your mind- Valentines gift. What is the perfect Valentines' gift? May it be for a loved one, for friends, for your sweet sister or tough little brother; we have the perfect gift for you. Name tags are the perfect valentines' gift for anyone. Name tags are not exclusively given for girls, but for boys as well. Because we believe that everyone values their belongings, or simply, just wants to show off their name. For the lovers, show your loved one how much you value him or her for his or her name, not only that but more importantly, how proud you are for having met him or her. Name tags will give you that. Name tags are customizable, you can actually show him or her how you feel through the design of the name badge and how you actually want to present it. Do you want to show her the sparkle that you see in her eyes? You can through a metallic name badge, you can also choose from silver or gold. Do you want to tell him how much your heart screams his name, you can give him a name badge that is shaped as a heart and a very big "John" for example. You can also choose the font, you would probably want to choose a thick, bubble like font which is reflective of fun and jolly. Is your boy friend a basketball lover? Then give him a basketball shaped name badge that actually bears his name or how you address each other like "honey" or "baby" or "sweetie". You can actually put your ideas into one name badge. The name badge will say it all.</p><p>
	Well, valentines' day isn't just for the lovers out there, it is for families as well. Do you want to tell your brother that you are thankful for his being tough and that he is always there when you need someone to count on? Well, you could give him a name badge in the shape of a dog tag, similar to that being worn by military men, to tell him that you are thankful that he is your brother. That is something he would really appreciate. How about for your sister? Is she a sweet sister, does she love cats or maybe dogs? Furry name tags are perfect for her. The fur can be additional details. You may ask the name badge maker if they have those designs. Give that to your sister on Valentine's Day and she would surely be sweeter to you. How about for your mom? Most moms are professional, while some choose to stay at home and take care of the family. You can give your mom an executive looking name badge with black and silver details, then her name on it, or nickname or how you like to address her, then for moms who love the kitchen, you can give her a name badge shaped like a pot holder. The name badge is the perfect gift you can give this Valentine's Day!

<br />
        <br />
      </p>
      </div>
    </div><!-- end mainContent -->
  
  </div><!-- end content -->
</div><!-- end wrapper -->

<div style="display: none;"><img src="/images/sevenReasonsButtonMinus.png" /></div>

<?php include_once 'inc/footer.php' ; ?>