<?php 
require_once('admin/conn/DB.php');
include('admin/conn/tablefuncs.php');
mysql_select_db($database_DB, $ravcodb);
session_start();

$pagetitle = "Employee Name Badges - Custom Name Tags";
$metadescription = "Best Name Badges is a US based name badge production company serving both the US and Canada.  Our products are widely recognized as the best in the industry.";
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


  <div id="hero">
  <div id="heroHeader">
    &nbsp;
  </div>
  

</div>

  <div id="content">
    <div id="leftColumn">
    <?php include_once 'inc/leftcolumn3.php' ; ?>

    </div><!-- end leftColumn -->
    
    <div id="mainContent">
    
    <div class="subright flr">
			  <h2>Employee Name Badges</h2>
		  		<p>If you're looking to have your employees wear name tags, might want to get it done at a company level rather then individually. The reason for this is uniformity. I'm sure you don't want your members of staff to be wearing badges of all sorts of different designs right? After all, when you're in the business world, you need a sense of professionalism. There are also benefits to be gained from doing it at a company level. </p>
		       <h4>Some Advantages Of Using Employee Name Badges</h4> 
		<p>
		First off, you reduce the costs of producing these badges. Simple economic theory tells us that if you were to order in bulk, you would end up saving money on the cost per badge. 
		</p>
		
		<p>
		Secondly, you are free to incorporate a colour coding system in the design of the badges. This way you can differentiate between the employees of different departments. Also, your security guards will also be able to recognise the senior members of your company.
		</p>
		
		<p>
		Lastly, you can even have a metal chip designed within the badges. That way, they kill two birds with one stone. Not only do they make the employees identifiable, they can also be used in the same way you would use a "card key". You won't even have to invest in them! This system would be great for both security and monitoring productivity levels of your employees, as you would know when they come in, and what time they leave.
		</p>
		
		<p>
		On the whole, these benefits most certainly outweight the negatives of purchasing name tags for your employees. Further more, your staff will even feel more valued by the company because of the sense of identity. This would hence make your company more professional and productive. 
		
		      </p>
	</div>	      
    </div><!-- end mainContent -->
  
  </div><!-- end content -->
</div><!-- end wrapper -->

<div style="display: none;"><img src="/images/sevenReasonsButtonMinus.png" /></div>

<?php include_once 'inc/footer.php' ; ?>