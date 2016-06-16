<?php 
require_once('admin/conn/DB.php');
include('admin/conn/tablefuncs.php');
mysql_select_db($database_DB, $ravcodb);
session_start();

$pagetitle = "The very personal name badge - Best Name Badges";
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
	 <h2>The Very Personal Name Badge</h2>
      <p>Andee loves to personalize her things. Her mobile phone has butterfly stickers on them, her laptop is colored pink because that is her favourite color, her books have these cute and colourful bookmarks on them, she doesn't buy pens that are not colourful and girly. Andee knows how to put color into her world. More importantly, she likes to spice up boring materials in school so that she becomes more inspired to study or read. But one thing is missing with Andee. She likes to personalize her things, but she might have forgotten that cute stuff can actually attract others to just get what isn't theirs. Andee realized she needed name badges.</p>
      <p> She didn't just want to lose her things because she invests time on designing them and these are really personal and very important for her. Andee searched the web for the best way to actually show her ownership of her books, pens, folders and bag and she found name badges! There are a lot of name badge makers all over the internet. Some even offer free shipment. Since Andee is a very personal kind of girl, name badges best suite her because these name badges can actually be personalized according to the style and color that the customers want. What's more interesting is even the shape can be modified. Andee wouldn't want a simple symmetric name badge wouldn't she? Considering that she is a really creative person and is also very particular with details.</p>
      <p>
	There are a whole range of choices from rectangle, circle, square, star and since Valentines' day is just around the corner, you can also have your name badge shaped as a heart. Andee is very keen on details. She loves to modify the details of things like what colour should match her shoes, what pen ink goes for a black page, what hairclip will match her outfit for the day. You can do almost the same thing with the name badges. Since they are very personal and since they carry your name, better make it yours right? You can modify and choose which font you would like to use, what the colour of your name should be, how big should it appear and what is the design of the background. Hmm... should it be a solid colour, patterned or textured? In terms of detail design, what specific elements would you like to use? You can choose from butterflies, stars, hearts, fruits, cats or flowers. There are so many designs to choose from. Would you like your name badge to appear 3D or embossed or do you want an outline for your name or drop shadow?</p><p>
	Andee is definitely getting a name badge! She doesn't want to end up losing her things right? You may ask where I can get those name badges at an affordable price. Well, you are exactly at the right place and at the right time- the internet! Go ahead and surf the net for websites that offer name badge making at an affordable price!


<br />
        <br />
      </p>
    </div><!-- end mainContent -->
  
  </div><!-- end content -->
</div><!-- end wrapper -->

<div style="display: none;"><img src="/images/sevenReasonsButtonMinus.png" /></div>

<?php include_once 'inc/footer.php' ; ?>