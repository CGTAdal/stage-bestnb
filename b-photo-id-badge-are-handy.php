<?php 
require_once('admin/conn/DB.php');
include('admin/conn/tablefuncs.php');
mysql_select_db($database_DB, $ravcodb);
session_start();

$pagetitle = "Photo ID Badges, Handy Necessities Like Cell Phones - Best Name Badges";
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
	 <h2>Photo ID Badges, Handy Necessities Like Cell Phones</h2>
      <p>What stuffs can you usually find in wallets, pockets, pouches or handbags of almost every individual? Most surveys would definitely result in coins, vanity things, gadgets like cell phones and iPods, but you'll be surprised that identification cards, especially photo ID badges, would be in the top 10.</p><p>

Photo ID badges and other means of identification are indispensable part of our daily lives.  In fact, it has become a necessity that even children are now being subjected to photo ID badges systems as a means to protect and safeguard them.</p><p>
But how exactly do photo ID badges have become a very important part of our daily lives?</p><p>

If you are a student, it is definitely a requirement that you show your photo ID badges to guards or perhaps swipe them through a scanner before you can enter the school premises.  These can also be implemented as access keys to libraries, canteens and other school facilities.</p><p>

Body buffs certainly have photo ID badges as membership cards on their favorite gyms and health spas.  Aside on being a proof of membership, other gyms are tying up with other establishments such as sports wear stores so that their photo ID badges can also serve as discount cards.
</p><p>
 It is a fact that employees would certainly be in frustration if their photo ID badges are left at home. They cannot enter the workplace and thus their day would be unproductive.  Large corporations also use the photo ID badges as security keys on restricted areas such as hazardous areas and places where vaults and other pertinent documents are stored.
</p><p>
Imagine how relieved someone in an emergency situation if health officers, fire marshals or policemen flash their photo ID badges before them.  Anyone in an operating room would want an expert doctor to administer the operations.
</p><p>
In department stores, restaurants and other establishments, photo ID badges such as credit cards, debit cards and electronic cash cards are also valuable to someone who wants cashless transactions.
</p><p>
Government agencies have also implemented the use of photo ID badges as a means of identification of their employees.  The government has long before used photo ID badges when issuing driving license and professional licenses. 
</p><p>
Another great proof of photo ID badges as a necessity is for a multi-chaptered organization.  These types of organizations usually hold meetings and seminars and photo ID badges would be a great way of introducing the members to each and everyone.  The photo ID badges can even be customized to bear the chapter's logo.
</p><p>
The many uses of photo ID badges prove that they have become a necessity to everyone's daily routine.  Photo ID badges of all sorts are now playing an important role in different organizational structures such as educational institutions, corporations, clubs, government agencies, and businesses.  They have even become hot commodities that some individuals or small businesses see them as a potential source of income.  Thus, they have engaged in the production of photo ID badges for others.
</p><p>
Now who needs photo ID badges, anyway?


<br />
        <br />
      </p>
    </div><!-- end mainContent -->
  
  </div><!-- end content -->
</div><!-- end wrapper -->

<div style="display: none;"><img src="/images/sevenReasonsButtonMinus.png" /></div>

<?php include_once 'inc/footer.php' ; ?>