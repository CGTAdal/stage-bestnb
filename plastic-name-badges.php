<?php 
require_once('admin/conn/DB.php');
include('admin/conn/tablefuncs.php');
mysql_select_db($database_DB, $ravcodb);
session_start();

$pagetitle = "Plastic Name Badges and Name Tags - Best Name Badges";
$metadescription = "Our high quality plastic name badges will last a lifetime.  Protective coating keeps the print from wearing during normal wear.";
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
  <!-- end hero -->
  
  <div id="content">
    <div id="leftColumn">
      <?php include_once 'inc/leftcolumn3.php' ; ?>	
    </div><!-- end leftColumn -->
    
    <div id="mainContent">
    	
	     <div class="subright flr">
				  <h2>Plastic Name Badges</h2>
			      <p>Just about every company (regardless of what they specialise in) is bound to have a customer service department. When your clients come down to make enquiries, they usually won't talk to these agents for more then a period of five minutes. As such, having a name tag will allow your clients to identify whom they are dealing with (without having to ask). That way, they will know whom they need to speak to if they were to come back down. It really saves a lot of time in troubleshooting the problem if they work with the same customer service agent who would have served them the last time round. This is why you should have your employees wear name tags.</p>
			      <h4>Business Love Plastic Name Tags</h4>
			      <p>
			Just take a look at the recent trends and you'll notice that plastic name badges are being incorporated by various types of organisations. Be it a voluntary one, an eco one or one that is in the service sector, they are likely to be in the hunt for name tags. After all, they save a great amount of trouble which would normally result from having to identify specific people in a large crowd (be it an audience member in a talk or a large tourist group). Further more, in the case of volunteers, you can also have the title of a person indicated on the badge. That way people will know whom to go to for specific issues.
			</p>
			<h4>Fully Custom Professional Badges</h4>
			<p>
			You can even go one step further and have a colour choding sheme to distinguish between different employees of different posts. For instance, people with orange badges could be for those in the sales department, while people with blue ones could be in the customer service department. It makes life easier for you, as a boss, when you interact with your employees. These badges also make it easier to monitor the movement in the building. It's an added security bonus.
			</p>
		</div>	
    </div><!-- end mainContent -->
  
  </div><!-- end content -->
</div><!-- end wrapper -->

<div style="display: none;"><img src="/images/sevenReasonsButtonMinus.png" /></div>

<?php include_once 'inc/footer.php' ; ?>