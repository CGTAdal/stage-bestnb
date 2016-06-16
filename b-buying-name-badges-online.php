<?php 
require_once('admin/conn/DB.php');
include('admin/conn/tablefuncs.php');
mysql_select_db($database_DB, $ravcodb);
session_start();

$pagetitle = "Buying Name Badges Online - Best Name Badges";
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
	  <h2>Buying Name Badges Online</h2>
      <p>Do you have a huge and important event coming up? Do you want to make a good impression to your boss? Or you just don't have the time to make the name badges on your own? Then buying or purchasing name badges online is the answer for you.</p><p>
	Luckily, nowadays, the Internet is a very useful and powerful tool to use. Everything you want to look for is in the Web. Buying name badges over the Internet can be as easy as ABC. With thousands of companies to choose from, the first thing you have to do is to decide on the best one. In trying to make up your mind on a company, make sure to do research so that you can sleep soundly at night knowing that you put your money in good hands and your product will come out properly.</p><p>
	There are many websites that already make you design the name badges yourselves. This will lessen the chore of calling them up and trying to explain to them what you want to happen. The company can give a number of ideas so take your time in choosing the perfect one. After choosing the design, the size of badge comes next. This is relatively easy because the site can give you the actual layout of your product so there is nothing to worry about. With everything in place, the names come next. Double check the number of guests and the spelling of each name because once you have submitted everything to the company it might be close to impossible to recall the badges once you've placed your order. So now that everything is in place, you have to do the final step, which is to pay for your orders. </p><p>
You might think twice sending them money online because you're not sure if the company can be trusted. This is where research comes in. Purchase badges from companies that are known in the industry. To do this, get hold of a list of companies in the industry and read their company profile because usually the longer they have been in the service means that they have solidified their name in the trade. Don't be afraid to compare prices amongst these companies too. Prices are usually the source of competition amongst them so find a reasonable one. A little tip in payment: A company that supports Paypal can trusted more than those that don't. </p><p>
You have designed, paid, and ordered the product so now read how long the shipment takes. Shipment usually takes 1 -2 days only but it would better if you would order it at least a week before the scheduled event just in case you encounter any delay. When orders are finalized, make sure to keep the receipt because this will be your proof that you placed an order and that you're expecting the product on a specific date.
You have nothing to worry about now, since you've ordered the name badges online and you can concentrate on the other details of the event. Everything can be worry free knowing that in a couple of days the badges will be shipped and the whole thing will come out the way you want it to be. 
<br />
        <br />
      </p>
    </div><!-- end mainContent -->
  
  </div><!-- end content -->
</div><!-- end wrapper -->

<div style="display: none;"><img src="/images/sevenReasonsButtonMinus.png" /></div>

<?php include_once 'inc/footer.php' ; ?>