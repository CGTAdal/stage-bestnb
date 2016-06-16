<?php 
require_once('admin/conn/DB.php');
include('admin/conn/tablefuncs.php');
mysql_select_db($database_DB, $ravcodb);
session_start();

if (!$_SESSION["customerloginid"])
{
	header("location: sign-up.php");
}

$pagetitle = "Buy Name Badges - Custom Name Badge Styles and Tags";
$metadescription = "Best Name Badges offers several styles of high quality badges and tags to fit your needs.  Magnetic and Pin fasteners are included free of charge.";
$metakeywords = "name badges, name tags, custom name badge, custom name tags, metal name tags, brushed aluminum name badges, plastic name tags, plastic name badges, color name badges, employee name tags, employee name badges, professional name tags, professional name badges"; 
?>
<?php 
if ($_SESSION["customerloginid"])
{
	include_once 'inc/header-auth.php';
} else {
	include_once 'inc/header.php' ;
} ?>

    <div id="content">
     
    <div id="mainContentFull">
	  <h2>Name Badge Ordering</h2>
	  <h3><br /><br />

	    Select A Product:</h3>
  		
        <div class="orderBox">
       	  <div class="boxHeader"><span style="float: left;">Pro Badges</span> <span style="font-size:9px;">1.5&quot; x 3&quot; or 1&quot; x 3&quot;</span></div>
        	<div class="boxSub">
        	  <div class="boxSub2"><h4 style="text-align: center;">Brushed Aluminum or PVC Plastic</h4>
        	    <div style="text-align: center;"><img src="images/pro-badges.png" width="166" height="83" /></div>
        	    <ul style="margin-top:0; padding-top:0;">
<li>Full Color Print       	          </li>
<li>Up to 3 lines custom text</li>
        	      <li>Clear Protective Coating</li>
        	      <li>Magnet or Pin Fastener</li>
        	      <li>Several Colors Available<br />
      	        </li>
      	        </ul>
                <div style="text-align: center;">
                <span class="lowAs">Low As: </span><span class="price">$4.90</span><br /><br />

                <img src="images/selectButton.png" width="94" height="27" onclick="javascript:location.href='order2.php';"/></div>
       	    </div></div></div>
            
            <div class="orderBox" style="margin-left: 35px; display: none;">
       	  <div class="boxHeader"><span style="float: left;">Reusable Badges</span> <span style="font-size:9px;">1.5&quot; x 3&quot; or 1&quot; x 3&quot;</span></div>
        	<div class="boxSub">
        	  <div class="boxSub2"><h4 style="text-align: center;">Brushed Aluminum or PVC Plastic</h4>
        	    <div style="text-align: center;"><img src="images/reusable-badges.png" width="151" height="83" /></div>
        	    <ul style="margin-top:0; padding-top:0;">
<li>Full Color Print       	          </li>
        	      <li>Clear Protective Coating</li>
        	      <li>Use Labels or Dry-Erase</li>
        	      <li>Magnet or Pin Fastener</li>
        	      <li>Several Colors Available<br />
      	        </li>
      	        </ul>
                <div style="text-align: center;">
                <span class="lowAs">Low As: </span><span class="price">$3.90</span><br /><br />

                <img src="images/selectButton.png" width="94" height="27"/></div>
       	    </div></div></div>
            
            <div class="orderBox" style="margin-left: 35px;">
       	  <div class="boxHeader"><span style="float: left;">Blank  Badges</span> <span style="font-size:9px;">1.5&quot; x 3&quot; or 1&quot; x 3&quot;</span></div>
        	<div class="boxSub">
        	  <div class="boxSub2"><h4 style="text-align: center;">Brushed Aluminum or PVC Plastic</h4>
        	    <div style="text-align: center;"><img src="images/blank-badges.png" width="158" height="82" /></div>
        	    <ul style="margin-top:0; padding-top:0;">
<li>Durable Product</li>
        	      <li>Magnet or Pin Fastener</li>
        	      <li>Several Colors Available</li>
        	      <li>Use labels or Dry-Erase</li>
        	      <li>Economical<br />
      	        </li>
      	        </ul>
                <div style="text-align: center;">
                <span class="lowAs">Low As: </span><span class="price">$1.90</span><br /><br />

                <img src="images/selectButton.png" width="94" height="27" onclick="javascript:location.href='wizardblank.php';"/></div>
       	    </div></div></div>
            
            
            </div><!-- end mainContentFull -->
  
  </div><!-- end content -->
</div><!-- end wrapper -->

<div style="display: none;"><img src="/images/sevenReasonsButtonMinus.png" /></div>

<?php include_once 'inc/footer.php' ; ?>