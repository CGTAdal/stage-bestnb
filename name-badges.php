<?php 
require_once('admin/conn/DB.php');
include('admin/conn/tablefuncs.php');
mysql_select_db($database_DB, $ravcodb);
session_start();

$pagetitle = "Buy Name Badges - Custom Name Badge Styles and Tags";
$metadescription = "Best Name Badges offers several styles of high quality badges and tags to fit your needs.  Magnetic and Pin fasteners are included free of charge.";
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
				  <h2>Professional Name Badges And Name Tags</h2>
			  		<h4>Ultra High Quality Dye Sublimation Digital Imaging Provides Clear, Full Color Badges
			</h4>
			        <p>Best Name Badges uses the latest high quality badge printing processes. We print with no color restrictions in a cmyk format on a thick and sturdy pvc plastic or brushed aluminum shell. Once the colors and black are printed, we overlay a clear coating to protect the print from everyday wear. Our name tags are the highest quality available today.
			</p>
				
			      <div class="productsContainerTop">
			        <div class="productsContainer-Left"><img src="images/digitally-printed-pro-badges.jpg" alt="Digitally Printed Full Color Name Badges" width="249" height="128" /><br />
			        </div>
			        <div class="productsContainer-right">
			       	  <h3>Digitally Printed Pro Badges</h3>
			            <p>Full color print on a premium thickness, durable PVC Plastic shell. Finished with a clear protective layer to protect the print.</p>
			            <p><strong>Sizes: </strong>Oval, 1&quot; x 3&quot;, 1.25&quot; x 3&quot;, 1.5&quot; x 3&quot;, 2&quot; x 3&quot;, 2 1/8&quot; x 3 3/8&quot;, Custom Sizes FREE!<br />
			              <br />
		                <strong>Colors:</strong> White, Silver, Gold, Brushed Aluminum Silver, Brushed Aluminum Gold. Custom Colors FREE! 
                        <br />
                        <br />
		                <strong>Accessories:</strong> Frames (Gold, Silver, Black), Protective Velvet Carry Pouch, Domed Finish, Variety of Fasteners</p>
                        <br />

                        <a href="/printed-name-badges.php"><img src="images/view-printed.jpg" width="160" height="35" alt="View Printed Tag Options" /></a>
			          
			            
			        </div>
			      </div>
			      
			      <div class="productsContainer">
			        <div class="productsContainer-Left"><img src="images/engraved-name-tags.jpg" alt="Engraved Name Tags" width="249" height="128" /></div>
			        <div class="productsContainer-right">
			       	  <h3>Engraved Name Tags</h3>
			            <p>Simply the highest quality laser engraving available today. Available in a variety of colors, and we can even add your logo in full color.</p>
			            <p><strong>Sizes: </strong>Oval, 1&quot; x 3&quot;, 1.25&quot; x 3&quot;, 1.5&quot; x 3&quot;, 2&quot; x 3&quot;, 2 1/8&quot; x 3 3/8&quot;, Custom Sizes FREE!<br />
			              <br />
		                <strong>Colors:</strong> White, Brushed Aluminum Silver, Brushed Aluminum Gold, Red, Orange, Black, Forest Green, Yellow, Blue. Custom Colors FREE!<br />
		                <br />
                      <strong>Accessories:</strong> Frames (Gold, Silver, Black), Protective Velvet Carry Pouch, Domed Finish, Variety of Fasteners</p>
                        
                          <br />
                <a href="/engraved-name-badges.php"><img src="images/view-engraved.jpg" width="160" height="35" alt="View Engraved Name Tags" /></a>
			            
			        </div>
			      </div>
			      
			      <div class="productsContainer">
			        <div class="productsContainer-Left"><img src="images/reusable-name-badges.jpg" alt="Reusable Name Badges and Tags" width="249" height="128" /></div>
			        <div class="productsContainer-right">
			       	  <h3>Reusable Name Badges</h3>
			            <p>Create your badges at your home or office. Fully reusable and easy to print on any InkJet or Laser printer, our reusable name tags include a domed lens to add that professional look.  Assembly of these badges can be done in just a few seconds.  You have seen our reusable badges being worn by employees everywhere -  including Macy's, Dillards, Coca-Cola, Marriot, Hyatt, and thousands of other businesses.</p>
                         <p><strong>Sizes: </strong>Oval, Thin Oval, Small Oval, .5&quot; x 2.5&quot;, 1&quot; x 3&quot;, 1.5&quot; x 2.75&quot;, 1.5&quot; x 3&quot;,  2 1/8&quot; x 3 3/8&quot;<br />
			              <br />
		                <strong>Colors:</strong> White, Brushed Aluminum Silver, Brushed Aluminum Gold, Custom Colors FREE!<br />
		                <br />
                      <strong>Accessories:</strong>  Protective Velvet Carry Pouch, Domed Finish, Variety of Fasteners</p>
			            <br />
                <a href="/reusable-name-badges.php"><img src="images/view-reusable.jpg" width="160" height="35" alt="View Reusable Name Tags" /></a>
			            
			        </div>
			      </div>
			      
			      <div class="productsContainer">
			        <div class="productsContainer-Left"><img src="images/photo-id-badges.jpg" alt="Photo Identification Badges and ID Cards" width="249" height="128" /><br />
			        </div>
			        <div class="productsContainer-right">
			       	  <h3>Photo ID Badges</h3>
			            <p><strong>Outsource your photo ID badges to us!</strong> Better quality, no machine maintenance, no supplies to stock - and cheaper!</p>
			            <p>We use the absolute best high definition, full color printing process using a reverse lamination procedure. This means you end up with a print you have to see to believe, with durability that outlasts the competition. And we do it for less.</p>
			            <p><strong>Sizes:</strong> 2 1/8&quot; x 3 3/8&quot; (standard ID size). Custom Sizes FREE.</p>
			            <p><strong>Colors: </strong>White (standard). Custom Colors FREE.</p>
			            <p><strong>Accessories:</strong> Lanyards in 10 colors, Strap Clips, Variety of Fasteners, Protective Velvet Carry Pouch</p>
			            <br />
                <a href="/photo-id-badges.php"><img src="images/view-photo-id-badges.jpg" width="160" height="35" alt="Photo Identification Ordering Options" /></a>
			            
			        </div>
			      </div>
                  
                  <div class="productsContainer">
			        <div class="productsContainer-Left"><img src="images/desk-plates-wall-name-plates.jpg" alt="Desk Name Plates and Wall Name Plates" width="249" height="128" /><br />
			        </div>
			        <div class="productsContainer-right">
			       	  <h3>Desk Name Plates and Wall Name Plates</h3>
			            <p>High quality name plates at unbeatable pricing. With several holders and colors available, you are sure to find one just perfect for you. Have us customize the plates with your logo or make them with just the names.</p>
			            <p><strong>Sizes:</strong> 2&quot; x 8&quot; (Standard), Custom Sizes FREE.</p>
			            <p><strong>Imprint: </strong>Full Color Digital and/or Laser Engraved</p>
			            <p><strong>Colors: </strong>White, Brushed Aluminum Silver, Brushed Aluminum Gold. Custom Colors Available</p>
			            <p><strong>Desk Holders: </strong>Aluminum Silver, Aluminum Gold, Aluminum Rose Gold (Copper), Stained Wood</p>
			            <p><strong>Wall Holders: </strong>Aluminum Silver, Aluminum Gold, Aluminum Black, Cubicle Hanger</p>
			            <br />
                <a href="/desk-wall-name-plates.php"><img src="images/view-desk.jpg" width="160" height="35" alt="View Desk And Wall Plates" /></a>
			            
			        </div>
			      </div>
                  
                  <div class="productsContainer">
			        <div class="productsContainer-Left"><img src="images/signs-engraved-printed.jpg" alt="Printed and Engraved Interior Signs" width="249" height="128" /><br />
			        </div>
			        <div class="productsContainer-right">
			       	  <h3>Signs - Printed and/or Engraved</h3>
			            <p>Best Name Badges also does signs! All signs are custom made just for you, at a price so low, you probably won't believe us.</p>
			            <p>Create signs for almost any occassion in a variety of finishes and colors, if you can dream it, we can probably make it. Ask us now for a free design proof and price quote.</p>
			            <br />
                <br />
                <a href="/printed-engraved-signs.php"><img src="images/view-signs.jpg" width="160" height="35" alt="View Signs" /></a>
			            
			        </div>
			      </div>
                  
			      <div style="clear: both;"></div>
			     
			
	  </div>		    
    </div><!-- end mainContent -->
  
  </div><!-- end content -->
</div><!-- end wrapper -->

<div style="display: none;"><img src="/images/sevenReasonsButtonMinus.png" /></div>

<?php include_once 'inc/footer.php' ; ?>