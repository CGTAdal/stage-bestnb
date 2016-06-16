<?php 

require_once('admin/conn/DB.php');

include('admin/conn/tablefuncs.php');

mysql_select_db($database_DB, $ravcodb);

session_start();



$pagetitle = "Positive Notes From Our Customers - Best Name Badges";

$metadescription = "";

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

    	

    </div>

    <div id="heroButton"></div>

  </div><!-- end hero -->

  

  <div id="content">

    <div id="leftColumn">

      <?php
      include_once 'inc/leftcolumn3.php' ; 
      ?>

    </div><!-- end leftColumn -->

    

    <div id="mainContent">
    	
	<div class="subright flr">
					  <h2>What Our Customers Have To Say.</h2>
				
				  		<h4>Completely <em>unsolicited</em> testimonials from some of our satisfied customers.</h4>
				
				      <p>We take  pride in our business and the service that we offer.  We live by our core values every single day.  We use the best materials available, the strongest magnets, the newest machines that are expertly maintained daily, and have a commitment to quality customer service that rivals any 5-star hotel.</p>
				
				      <p>We never ask for testimonials, but we get them daily. Below is a collection of unsolicited testimonials sent in by our happy customers.  We hope to see your kind words here too someday.</p>
				
				      <br /><br />
				
			<script src="http://satiswhy.com/widgets/16/load_lib.js" type="text/javascript"></script>
<script src="http://satiswhy.com/widgets/16/provider_references.js" type="text/javascript"></script>
				
				
				
				      </p>
		</div>
    </div><!-- end mainContent -->

  

  </div><!-- end content -->

</div><!-- end wrapper -->



<div style="display: none;"><img src="/images/sevenReasonsButtonMinus.png" /></div>



<?php include_once 'inc/footer.php' ; ?>