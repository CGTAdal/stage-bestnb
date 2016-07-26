<?php 
require_once('admin/conn/DB.php');
include('admin/conn/tablefuncs.php');
mysql_select_db($database_DB, $ravcodb);
session_start();

$pagetitle = "All Purpose Name Badges - Best Name Badges";
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

  <div id="hero" class="herobgnone">
     <img src="images/heroBG.jpg"  />
    <div id="heroHeader" class="heroheadrnone">
    	<h1>NAME BADGE ORDERING... SIMPLIFIED.</h1>
        <p>Easy online ordering. Lightning fast <strong><u>1-day turnaround</u></strong>. Always free standard shipping. Full color.</p>
    </div>
    <div id="heroButton" class="header-activated-button"><a href="/sign-up.php"><img src="images/getStartedButton.png" width="159" height="35" alt="Get Started" /></a></div>
  </div><!-- end hero -->
  
  <div id="content">
    <div id="leftColumn">
      <?php include_once 'inc/leftcolumn2.php' ; ?>
    </div><!-- end leftColumn -->
    
    <div id="mainContent">
    <div class="b-all-rightdiv">
	 <h2>All-Purpose name badge</h2>
      <p>It's campaign period in the University! Ruthie is busy printing out bookmarks, after that, she has to cut them and attach ribbons on them while Mary, the presidential candidate of the other party only made a 5-minute call to the name badge maker and after that, she's done with the arrangements, she just needs to pick them up early on the day of the campaign. A day before the campaign, Ruthie isn't done with her bookmarks yet,</p><p> Mary is memorizing her campaign speech. Ruthie had to stay up late to memorize her campaign speech. The next day, Mary is ready to give out her name badges while Ruthie, also prepared to give out her bookmarks, but is in a slightly bad mood because she didn't get enough sleep.
	</p><p>The students were excited during the campaign. The campaign period was a big factor for them in determining who to vote for. The speeches, most especially, made a great difference. The next day, after the campaign, Ruthie saw some of the bookmarks she printed out, scattered on the floor, then she meets some of her acquaintances and saw name badges pinned on their uniforms, with the text "Mary for President" on them. She realized now why most of her bookmarks just went on the floor and trash bins. Mary's name badges were durable and very creative, hers was only made of special paper. Most of the students liked Mary's badges and she thought that those who wearing Mary's badges were her supporters, and there were a lot of them.</p><p>
	Always remember, strategy and materials make a big difference. Name badges are durable, customizable and will highly be appreciated. It will last a life time compared to the ordinary bookmark that you use for campaign. However, you would really want to invest on it if you want to use name badges for your campaign, but it will all be worth it in the end because voters will remember your name.  You guessed it, Mary won for the position of president. Mary is not a rich student, in fact, she receives the same amount of allowance as Ruthie does, but she knew she had to prepare well for the campaign period, and so she saved money for the name badges. The position for president was something she really wanted. We can see that Mary prepared really well, a good trait for a soon-to-be-leader, and she knew exactly where to find the tools she needed.
	</p><p>Ruthie was quite disappointed with herself, but being a good student leader, Mary approached her, talked to her and shared to her where she got her name badges. Then she pulled something from her pocket, it was a circular name badge with Ruthie's name on it, printed on a yellow smiley background. It was a name badge that Mary had prepared as a gift for Ruthie, a gift telling her that it was a good fight and that Mary was actually open to working with her even outside of her presidency.
<br />
        <br />
      </p>
      </div>
    </div><!-- end mainContent -->
  
  </div><!-- end content -->
</div><!-- end wrapper -->

<div style="display: none;"><img src="/images/sevenReasonsButtonMinus.png" /></div>

<?php include_once 'inc/footer.php' ; ?>