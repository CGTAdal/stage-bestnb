<?php 
require_once('admin/conn/DB.php');
include('admin/conn/tablefuncs.php');
mysql_select_db($database_DB, $ravcodb);
session_start();
$pagetitle = "Thank You - Best Name Badges";
$metadescription = "Our printed name badges offer full color options and our heat infused sublimation printing process means your tags will last for years.";
$metakeywords = "name badges, name tags, custom name badge, custom name tags, metal name tags, brushed aluminum name badges, plastic name tags, plastic name badges, color name badges, employee name tags, employee name badges, professional name tags, professional name badges"; 
?>
<?php 
if ($_SESSION["customerloginid"])
{
	include_once 'inc/header-auth.php';
} else {
	include_once 'inc/header.php' ;
} ?>
<?php
/*echo '<pre>';
print_r($_REQUEST);
echo '</pre>';
die();*/
// process for insert to table order_wizard
$data['size']				= $_REQUEST['size_value'];
$data['badge_color']		= $_REQUEST['badge_color_value'];
$data['frame']				= $_REQUEST['frame_value'];
$data['dome']				= $_REQUEST['dome_value'];
$data['backing_fastener']	= $_REQUEST['backing_fastener_value'];
$data['notes']				= $_REQUEST['note'];
$data['num_baged']			= $_REQUEST['quantity'];
$quantity 					= $data['num_baged']; 
$data['delivery']			= $_REQUEST['Delivery'];
$data['delivered_by']		= $_REQUEST['DeliverBy'];
$data['customer_id']		= $_SESSION["customerloginid"];


	
$data['type']				= $_REQUEST['type'];
$data['velvet_carry_pouch'] = $_REQUEST['VelvetPouch'];

if(isset($_REQUEST['plate_color'])){
	$data['plate_color'] = $_REQUEST['plate_color'];
}

if(isset($_REQUEST['ImprintMethod'])){
	$data['imprint_method'] = $_REQUEST['ImprintMethod'];
}
if(isset($_REQUEST['HolderType'])){
	$data['type_holder'] = $_REQUEST['HolderType'];
	if($_REQUEST['HolderType']=='1'){
		$data['material_holder'] = $_REQUEST['DeskHolderMaterial'];		
		$data['holder_color_first'] =  $_REQUEST['DeskHolderColor'];		
	}
	if($_REQUEST['HolderType']=='0'){
		$data['holder_color_second'] =  $_REQUEST['WallHolderColor'];
	}
}

if(isset($_REQUEST['your_file_name_plate'])){
	$data['your_file_name_plate'] = $_REQUEST['your_file_name_plate'];
}

if(isset($_REQUEST['Orientation'])){
	$data['orientation']	= $_REQUEST['Orientation'];
}

if(isset($_REQUEST['Lanyard'])){
	
	$data['lanyard']		= $_REQUEST['Lanyard'];	
	$data['lanyard_color']	= $_REQUEST['LanyardColor'];
}

if(isset($_REQUEST['your_photo_id_badge'])){
	$data['your_photo_id_badge'] = $_REQUEST['your_photo_id_badge'];
}

if(isset($_REQUEST['WallHolderAttachment']) && isset($_REQUEST['HolderType']) && $_REQUEST['HolderType']!='1'){
	$data['attachment'] = $_REQUEST['WallHolderAttachment'];
}

if(isset($_REQUEST['num_plates'])){
	$data['num_plates'] = $_REQUEST['num_plates'];
}
if(isset($_REQUEST['num_holders'])){
	$data['num_holders'] = $_REQUEST['num_holders'];
	$quantity			 = $data['num_holders']; 	
}
if($_REQUEST['type'] == 'Reusable Name Badges'){
	$data['pre_print_logo'] 	= $_REQUEST['PrintedLogo'];
	$data['software'] 			= $_REQUEST['Software'];	
	$data['printer_type']		= $_REQUEST['Printer'];	
}
$data['created_date']		= date('m/d/Y H:i:s');
/* we need return id of order wirad after insert to insert to table 'lines' and 'logos'*/
$id_wizard_order = add_record("order_wizard", $data);
// process infert to table lines
$email = 'leads@blanknamebadges.com';
//$email = 'hien.nguyenvan@citigo.net';
 //$total = $_POST["total"] + $fedexfee;
$total = $_POST["total"];
// $email = 'hiencoder@gmail.com';
 $subject1 = '[Best Name Badges] New Proof Request';
        
	
$qry = "SELECT customers.id AS custid, customers.firstname AS firstname, customers.lastname AS lastname, customers.companyname AS companyname, customers.street, customers.street2, customers.city, customers.state, customers.zip AS zipcode, customers.email as email, customers.phone as phone FROM customers
	 WHERE customers.id=".$_SESSION["customerloginid"];
$customer = mysql_query($qry) or die('Query failed: ' . mysql_error()); 
$customers = mysql_fetch_assoc($customer);
/*echo '<pre>';
print_r($customers);
echo '</pre>';*/						  
$message1 = "<strong>Best Name Badges has new Proof Request:</strong>       
					<br /> Product #: ".$id_wizard_order."	                                
                    <br />Quantity: ".$quantity."
                    <br />Name: ".$customers["firstname"]." ".$customers["lastname"]." 
                    <br />Phone: ".$customers['phone']."
                    <br />Email: ".$customers['email'];
//echo $message1;
//define the headers we want passed. Note that they are separated with \r\n    
/*add boundary string and mime type specification*/   

$header1s = "MIME-Version: 1.0" . "\r\n";					
$header1s .= "Content-type:text/html; charset=utf-8" . "\r\n";
$header1s .= "X-Mailer: PHP/" . phpversion() . "\r\n";
//$header1s .= "From: sales@bestnamebadges.com \r\n";				    

mail($email, $subject1, $message1, $header1s);       
        


if(isset($_REQUEST['completed'])){
	if(isset($_REQUEST['design1']) && $_REQUEST['design1'] != ''){
		$sql1 = "INSERT INTO logos(path,id_order_wizard) VALUES('".$_REQUEST['design1']."','".$id_wizard_order."')";
		mysql_query($sql1);
	}	
	if(isset($_REQUEST['design2']) && $_REQUEST['design2'] != ''){
		$sql2= "INSERT INTO logos(path,id_order_wizard) VALUES('".$_REQUEST['design2']."','".$id_wizard_order."')";
		mysql_query($sql2);
	}
	if(isset($_REQUEST['design3']) && $_REQUEST['design3'] != ''){
		$sql3 = "INSERT INTO logos(path,id_order_wizard) VALUES('".$_REQUEST['design3']."','".$id_wizard_order."')";
		mysql_query($sql3);
	}
	if(isset($_REQUEST['design4']) && $_REQUEST['design4'] != ''){
		$sql4 = "INSERT INTO logos(path,id_order_wizard) VALUES('".$_REQUEST['design4']."','".$id_wizard_order."')";
		mysql_query($sql4);
	}
	if(isset($_REQUEST['design5']) && $_REQUEST['design5'] != ''){
		$sql5 = "INSERT INTO logos(path,id_order_wizard) VALUES('".$_REQUEST['design5']."','".$id_wizard_order."')";
		mysql_query($sql5);
	}
	if(isset($_REQUEST['design6']) && $_REQUEST['design6'] != ''){
		$sql6 = "INSERT INTO logos(path,id_order_wizard) VALUES('".$_REQUEST['design6']."','".$id_wizard_order."')";
		mysql_query($sql6);
	}
	if(isset($_REQUEST['design7']) && $_REQUEST['design7'] != ''){
		$sql7 = "INSERT INTO logos(path,id_order_wizard) VALUES('".$_REQUEST['design7']."','".$id_wizard_order."')";
		mysql_query($sql7);
	}
	if(isset($_REQUEST['design8']) && $_REQUEST['design8'] != ''){
		$sql8= "INSERT INTO logos(path,id_order_wizard) VALUES('".$_REQUEST['design8']."','".$id_wizard_order."')";
		mysql_query($sql8);
	}
	if(isset($_REQUEST['design9']) && $_REQUEST['design9'] != ''){
		$sql9= "INSERT INTO logos(path,id_order_wizard) VALUES('".$_REQUEST['design9']."','".$id_wizard_order."')";
		mysql_query($sql9);
	}
	if(isset($_REQUEST['design10']) && $_REQUEST['design10'] != ''){
		$sql10= "INSERT INTO logos(path,id_order_wizard) VALUES('".$_REQUEST['design10']."','".$id_wizard_order."')";
		mysql_query($sql10);
	}	
}else {
	// - get total line of text
	$total  					= $_REQUEST['LinesText'];
	for($i=1;$i<=$total;$i++){
		$text 	= $_REQUEST['TextType'.$i];
		$font 	= $_REQUEST['Font'.$i];		
		$color	= $_REQUEST['color'.$i];	
		$sql_text = "INSERT INTO textlines(type,font,color,id_order_wizard) VALUES('".$text."','".$font."','".$color."','".$id_wizard_order."')";
		mysql_query($sql_text);	
	}
	
	// process insert to tables logos
	if(isset($_REQUEST['logo1']) && $_REQUEST['logo1'] != ''){
		if($data['type']=='Engraved Name Tags'){
			$logoengraving = $_REQUEST['LogoEngraving1_value'];
		}else{
			$logoengraving = 0;
		}
		$sql1 = "INSERT INTO logos(path,id_order_wizard,logo_placement,logo_engraving) VALUES('".$_REQUEST['logo1']."','".$id_wizard_order."','".$_REQUEST['LogoPlacement1_value']."','".$logoengraving."')";
		mysql_query($sql1); 
	}
	if(isset($_REQUEST['logo2']) && $_REQUEST['logo2'] != ''){
		if($data['type']=='Engraved Name Tags'){
			$logoengraving = $_REQUEST['LogoEngraving2_value'];
		}else{
			$logoengraving = 0;
		}
		$sql1 = "INSERT INTO logos(path,id_order_wizard,logo_placement,logo_engraving) VALUES('".$_REQUEST['logo2']."','".$id_wizard_order."','".$_REQUEST['LogoPlacement2_value']."','".$logoengraving."')";
		mysql_query($sql1);
	}
	if(isset($_REQUEST['logo3']) && $_REQUEST['logo3'] != ''){
		if($data['type']=='Engraved Name Tags'){
			$logoengraving = $_REQUEST['LogoEngraving3_value'];
		}else{
			$logoengraving = 0;
		}
		$sql1 = "INSERT INTO logos(path,id_order_wizard,logo_placement,logo_engraving) VALUES('".$_REQUEST['logo3']."','".$id_wizard_order."','".$_REQUEST['LogoPlacement3_value']."','".$logoengraving."')";
		mysql_query($sql1);
	}
	if(isset($_REQUEST['logo4']) && $_REQUEST['logo4'] != ''){
		if($data['type']=='Engraved Name Tags'){
			$logoengraving = $_REQUEST['LogoEngraving4_value'];
		}else{
			$logoengraving = 0;
		}
		$sql1 = "INSERT INTO logos(path,id_order_wizard,logo_placement,logo_engraving) VALUES('".$_REQUEST['logo4']."','".$id_wizard_order."','".$_REQUEST['LogoPlacement4_value']."','".$logoengraving."')";
		mysql_query($sql1);
	}
}
?> 

    <div id="content">
     <div id="mainContentFull">
	  <br/>
   <br />
       <div style="width: 100%;">
       <h3  class="wizard-nexttoptext">Your Proof Order Number: <span style="color: #397820;"><?php echo $id_wizard_order;?></span></h3>
       <div style="width: 100%">
       <div  class="wizard-next-left">
       <br />
<br />

      <h3>Thank you for your request:</h3>
       <p>One of our dedicated support team members will reach out to you shortly.
       Usually between 20 minutes and 1 hour.
       <p><strong><br />
         Need immediate assistance?       </strong>       <br />
         <br />
         If you have an immediate question, your order rushed, or would like to speak with our staff right now. Please call us at (888) 445-7601 or email <a href="mailto:support@bestnamebadges.com">support@bestnamebadges.com</a>       
       <h3><br />
         So What's Next?</h3>
       <ul>
       <li>Our Designers will put together a design proof using the information you provided.</li>
       <li>We'll also ask you for the list of names, you can provide this through email in almost any format</li>
       <li>When you are 100% happy with the look of your badges, you can easily pay your invoice online</li>
       <li>Once your invoice is paid, we'll ship your badges out right away.</li>
       </ul>
       <br />
       <h3>When Will I Hear From You?</h3>
       <ul>
       <li>During business hours, you should hear from us within 20 minutes to 1 hour. However, sometimes we are quite busy. If you need to rush your order or speak with someone immediately, please call us. We always answer the phone in just 1 - 2 rings.</li>
       <li>We do not charge rush fees. If you need your order quickly, please let us know - we are here to help.</li>
       </ul>
       
       
       </div>
       <div  class="wizard-next-right">
       <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div class="fb-like-box wizardfb-likebox" data-href="http://www.facebook.com/BestNameBadges"  data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="false" data-show-border="true"></div>
<div style="clear: both; padding-top: 10px;"></div>
<a href="http://www.bnbpromos.com"><img src="images/promos-next.jpg" width="359" height="326" alt="Promotional Products" /></a> </div>
       </div>
      </div>
      <div  class="wizard-next-bottom">
      
       <h2>Save 10%! Add Additional Custom Products To Your Order. </h2>
       <p>We create a variety of products right here in-house.  With only a 5 item minimum, we can meet any budget.  Add any of the products below to your order and save 10% on your additional items.  Simply ask your service representative for a free proof on any of the items below.</p>
  
    <!-- prod 1 -->
<div class="orderBox" style="width: 141px; margin-right: 32px;">
          <div class="boxHeader" style="text-align: center;"><span style="margin-left: 0;">Pin Buttons</span></div>
          <div class="boxSub" style="float: left; height: 120px;"> <a href="pin-buttons.php"><img src="images/prod-pin-buttons.jpg" width="141" height="120" alt="Promotional Pin Buttons" /></a></div>
        <div style="text-align: center; margin-top: 5px; float: left; width: 100%;">  
          <span class="price">$0.24 - $2.88</span><br />
          <a href="pin-buttons.php" style="font-size: 13px; color: #2e4a6e; text-decoration: underline;">View Pin Buttons</a>
          </div>
          
    </div>
        <!-- end prod 1 -->
        
        
            <!-- prod 1 -->
<div class="orderBox" style="width: 141px; margin-right: 32px;">
          <div class="boxHeader" style="text-align: center;"><span style="margin-left: 0;">Small Magnets</span></div>
          <div class="boxSub" style="float: left; height: 120px;"> <a href="promotional-magnets.php"><img src="images/prod-promotional-magnets.jpg" width="141" height="120" alt="Promotional Magnets" /></a></div>
        <div style="text-align: center; margin-top: 5px; float: left; width: 100%;">  
          <span class="price">$0.36 - $2.96</span><br />
          <a href="promotional-magnets.php" style="font-size: 13px; color: #2e4a6e; text-decoration: underline;">View Magnets</a>
          </div>
          
    </div>
        <!-- end prod 1 -->
        
            <!-- prod 1 -->
<div class="orderBox" style="width: 141px; margin-right: 33px;">
          <div class="boxHeader" style="text-align: center;"><span style="margin-left: 0;">Keychains</span></div>
          <div class="boxSub" style="float: left; height: 120px;"><a href="keychains.php"><img src="images/prod-keychains.jpg" width="141" height="120" alt="Giveaway Keychains" /></a></div>
        <div style="text-align: center; margin-top: 5px; float: left; width: 100%;">  
          <span class="price">$0.75 - $3.16</span><br />
          <a href="keychains.php" style="font-size: 13px; color: #2e4a6e; text-decoration: underline;">View Keychains</a>
          </div>
          
    </div>
        <!-- end prod 1 -->
        
        
            <!-- prod 1 -->
<div class="orderBox" style="width: 141px; margin-right: 33px;">
          <div class="boxHeader" style="text-align: center;"><span style="margin-left: 0;">Bottle Openers</span></div>
          <div class="boxSub" style="float: left; height: 120px;"><a href="bottle-openers.php"><img src="images/prod-bottle-openers.jpg" width="141" height="120" alt="Promotional Bottle Openers" /></a></div>
        <div style="text-align: center; margin-top: 5px; float: left; width: 100%;">  
          <span class="price">$0.77 - $3.18</span><br />
          <a href="bottle-openers.php" style="font-size: 13px; color: #2e4a6e; text-decoration: underline;">View Bottle Openers</a>
          </div>
          
    </div>
        <!-- end prod 1 -->
        
        
            <!-- prod 1 -->
<div class="orderBox" style="width: 141px; margin-right: 0px;">
          <div class="boxHeader" style="text-align: center;"><span style="margin-left: 0;">Poster Printing</span></div>
          <div class="boxSub" style="float: left; height: 120px;"><a href="poster-printing.php"><img src="images/prod-poster-printing.jpg" width="141" height="120" alt="Poster Printing" /></a></div>
        <div style="text-align: center; margin-top: 5px; float: left; width: 100%;">  
          <span class="price">$1.51 - $6.30</span><br />
          <a href="poster-printing.php" style="font-size: 13px; color: #2e4a6e; text-decoration: underline;">View Poster Printing</a>
          </div>
          
    </div>
        <!-- end prod 1 -->
        
        </div>
        
        
        
        
        
        <div style="clear: both;"></div>
</div><!-- end mainContentFull -->
  
  </div><!-- end content -->
</div><!-- end wrapper -->




<?php include_once 'inc/footer.php' ; ?>
