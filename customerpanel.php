<?php 
require_once('admin/conn/DB.php');
include('admin/conn/tablefuncs.php');
include('include/config.php');
mysql_select_db($database_DB, $ravcodb);
session_start();

if ($_REQUEST["logout"])
{
 	unset($_SESSION["customerloginid"]);
}
if (!$_SESSION["customerloginid"])
{
	header("location: $base_url/sign-up.php");
}


function email_header ($to_id, $from_name, $from_email, $return_path)
{

	$email_headers = sprintf(
	"From: %s <%s>\n".
	"Content-type: text/html; charset=iso-8859-1\n",
	$from_name, $from_email,
	$return_path, md5(EMAIL_HASH_KEY.$to_id), $to_id);

	return ($email_headers);
}

if ($_POST["process"])
{
	$data["custid"] = $_SESSION["customerloginid"];
	$data["paid"] = 1;
	$data['timestamp'] = date('Y-m-d H:i:s');
	$data['customer_note'] =$_POST['cusotmer_note'];
	$id = add_record("printorders", $data);
	
	$qry = "SELECT * FROM customers WHERE id = '".$_SESSION["customerloginid"]."'";
	$customers = mysql_query($qry);
	$customer = mysql_fetch_assoc($customers);
	$customername = $customer["firstname"]." ".$customer["lastname"];
	
	$where = "custid = ".$_SESSION["customerloginid"]." AND printorderid = 0";
	$data2["printorderid"] = $id;
	modify_record("batches", $data2, $where);
	
	$data3["oid"] = $id;
	$data3["date"] = date("Y/m/d");
	$data3["name"] = $customer["firstname"]." ".$customer["lastname"];
	$data3["address"] = $customer["street"];
	$data3["address2"] = $customer["street2"];
	$data3["city"] = $customer["city"];
	$data3["state"] = $customer["state"];
	$data3["zip"] = $customer["zip"];
	$rid = add_record("preceipts", $data3);
		
	$email_headers = email_header ("support@bestnamebadges.com", "Best Name Badges Print Order", "support@bestnamebadges.com", "support@bestnamebadges.com");
	ob_start();
	echo "Best Name Badges has received a new PRINT order, order number ".$id." from ".$customername.".<br>";
	
	$contents1 = ob_get_contents();
	ob_end_clean();
	mail("support@bestnamebadges.com", "Best Name Badges Print Order", $contents1, $email_headers);
	
	header("location: thankyoup.php?order=".$id."&rid=".$rid);
	
	
}

if ($_POST["addname"])
{
	if ($_POST["badge"])
	{
		$qry = "SELECT inventory, finventory,dminventory FROM customers WHERE id = '".$_SESSION["customerloginid"]."'";
		$inventories = mysql_query($qry);
		$inventory = mysql_fetch_assoc($inventories);
	
		if ($_POST["frame"] == "Gold" || $_POST["frame"] == "Silver")
		{
			$data["finventory"] = $inventory["finventory"] - 1;
		}
		if ($_POST["dome"] == 1)
		{
			$data["dminventory"] = $inventory["dminventory"] - 1;
		}
		if ($inventory["inventory"] > 0 )
		{
			$data["inventory"] = $inventory["inventory"] - 1;
			$where = "id = ".$_SESSION["customerloginid"];
			modify_record("customers", $data, $where);
			
			$data2["custid"] = $_SESSION["customerloginid"];
			$data2["custstyleid"] = $_POST["badge"];
			$data2["name"] = $_POST["text1"];
			$data2["subtext"] = $_POST["text2"];
			$data2["subtext2"] = $_POST["text3"];
			$data2["fastener"] = $_POST["fastener"];
			$data2['dome'] = $_POST['dome'];
			if ($_POST["frame"])
			{
				$data2["frame"] = $_POST["frame"];
			} else {
				$data2["frame"] = "None";
			}
			add_record("batches", $data2);

		} else {
			$invmsg = "<font color='red'>Not Enough Inventory Left, Please Purchase More...</font>";
		}
	} else {
		$invmsg = "<font color='red'>Please choose a badge....</font>";
	}
}

if ($_REQUEST["deleteid"])
{
	
	$qry = "SELECT * FROM batches WHERE id = ".$_REQUEST["deleteid"];
	$batches = mysql_query($qry);
	$batch = mysql_fetch_assoc($batches);
	
	if ($batch)
	{
		delete_record_secondary("batches", $_REQUEST["deleteid"], "id");

	
		$qry = "SELECT inventory, finventory,dminventory FROM customers WHERE id = '".$_SESSION["customerloginid"]."'";
		$invs = mysql_query($qry);
		$inv = mysql_fetch_assoc($invs);
	
		$where = "id = ".$_SESSION["customerloginid"];
		$data["inventory"] = $inv["inventory"] + 1;
		if ($_REQUEST["frame"] == "Gold" || $_REQUEST["frame"] == "Silver")
		{
			$data["finventory"] = $inv["finventory"] + 1;
		}
		if ($_REQUEST["dome"] == 1)
		{
			$data["dminventory"] = $inv["dminventory"] + 1;
		}
		modify_record("customers", $data, $where);
	}
	
}

$pagetitle = "Buy Name Badges - Custom Name Badge Styles and Tags";
$metadescription = "Best Name Badges offers several styles of high quality badges and tags to fit your needs.  Magnetic and Pin fasteners are included free of charge.";
$metakeywords = "name badges, name tags, custom name badge, custom name tags, metal name tags, brushed aluminum name badges, plastic name tags, plastic name badges, color name badges, employee name tags, employee name badges, professional name tags, professional name badges"; 

$qry = "SELECT * FROM customers WHERE id = '".$_SESSION["customerloginid"]."'";
$customers = mysql_query($qry);
$customer = mysql_fetch_assoc($customers);

$qry = "SELECT batches.*, custstyle.stylename FROM batches LEFT JOIN custstyle ON (custstyle.id = batches.custstyleid) WHERE batches.custid = '".$_SESSION["customerloginid"]."' AND batches.printorderid < 1 ORDER BY batches.id";
$badges = mysql_query($qry);
$badge = mysql_fetch_assoc($badges);
$qry = "SELECT batches.*, custstyle.stylename FROM batches LEFT JOIN custstyle ON (custstyle.id = batches.custstyleid) WHERE batches.custid = '".$_SESSION["customerloginid"]."' AND batches.printorderid > 1 ORDER BY batches.printorderid, batches.name";
$archivebadges = mysql_query($qry);
$archivebadge = mysql_fetch_assoc($archivebadges);

$qry = "SELECT custstyle.*, styles.size FROM custstyle LEFT JOIN styles ON (styles.id = custstyle.styleid) WHERE custstyle.custid = '".$_SESSION["customerloginid"]."' AND paid = 1 ORDER BY custstyle.id";
$styles = mysql_query($qry);
$style = mysql_fetch_assoc($styles);

$qry = "SELECT custstyle.*, styles.size FROM custstyle LEFT JOIN styles ON (styles.id = custstyle.styleid) WHERE custstyle.custid = '".$_SESSION["customerloginid"]."' AND reusable = 1 ORDER BY custstyle.id";
$stylers = mysql_query($qry);
$styler = mysql_fetch_assoc($stylers);


?>
<?php 
if ($_SESSION["customerloginid"])
{
	include_once 'inc/header-auth.php';
} else {
	include_once 'inc/header.php' ;
} ?>

<script type="text/javascript" src="/js/jscolor.js"></script>

    <div id="content">
     
    <div id="mainContentFull">
	  <h2>Order Name Badges</h2>

	  <br /><br />
      
     
      
	  <div id="addNamesLeft">	  
      <div id="logoBox" style="width: 450px;">
      	<div class="boxHeader"><span style="float: left;">Full Color Pro Name Badges</span></div>
      	<div class="boxSub" style="border-bottom: none;">
        	  <div class="boxSub2" style="display: none;"></div>
        </div>
      	<?php if ($style) { ?>
         <div class="signUpField" >
        <div style="text-align: left; line-height: 30px; margin-top:5px; margin-bottom: 5px; padding-left: 20px;">
            	<h4>You have <span class="quantityNumber"><?php echo $customer["inventory"]; ?></span> Pro Badges Available- <a href="<?php echo $base_url?>/purchase.php">Purchase More Inventory</a></h4>
                <h4>You have <span class="quantityNumber"><?php echo $customer["finventory"]; ?></span> Frames Available- <a href="<?php echo $base_url?>/purchase.php">Purchase More Inventory</a></h4> 
				<h4>You have <span class="quantityNumber"><?php echo $customer["dminventory"]; ?></span> Domes Available- <a href="<?php echo $base_url?>/purchase.php">Purchase More Inventory</a></h4> 
                <h4>Need a new badge design?- <a href="<?php echo $base_url?>//name-badges.php">Purchase A New Style</a></h4> 
            </div>
         </div>
		 <?php } else { ?>
		 <div class="signUpField" >
        <div style="text-align: left; line-height: 30px; margin-top:5px; margin-bottom: 5px; padding-left: 20px; padding-right: 20px;">
            	<h4>You have never purchased a Pro Name Badge before. Please create your first badge by <a href="/name-badges.php">clicking here.</a></h4>
        </div>
         </div>
		 <?php } ?>
	  <?php if ($customer["inventory"] > 0 ) { ?>
	  <form method="post" action="customerpanel.php">
	  <input type="hidden" name="addname" value="1" />
      <div class="boxHeader"><span style="float: left;">Add A Name</span></div>
	  <?php if ($invmsg) { ?>
	   <div class="signUpField" >
            <div style=" text-align: center; line-height: 30px; margin-top:5px; margin-bottom: 5px;">
				<?php echo $invmsg; ?>
			</div>
		</div>
	  <?php } ?>
      <div class="signUpField" style="border-top-width: 1px; border-top-style: dashed; border-top-color: #CCC;">
            <div class="signUpFieldLeft" style="height: 95px;">Text:</div>
            <div class="signUpFieldRight" style="height: 95px; width: 303px;">
           		Line 1: <input type="text" name="text1"  style="width: 200px;" class="signupFieldInput"/><br />
                Line 2: <input type="text" name="text2"  style="width: 200px;" class="signupFieldInput"/><br />
                Line 3: <input type="text" name="text3"  style="width: 200px;" class="signupFieldInput"/>	
            </div>
          </div>
          
          <div class="signUpField" >
            <div style=" text-align: center; line-height: 30px; margin-top:5px; margin-bottom: 5px;">
            	
                <h4>Select A Badge Style:</h4>
                <?php 
				if ($style) {
				do { ?>
                <!-- ITEM -->
                <div style="float: left; padding-left: 25px;">
                	<img src="proofs/<?php echo $style["proof"]; ?>" width="185" /><br />

                    <input type="radio" name="badge" value="<?php echo $style["id"]; ?>" /> <strong><?php echo $style["stylename"]; ?></strong>
              </div>
                <!-- END ITEM -->
				<?php } while ($style = mysql_fetch_assoc($styles)); 
				} else {
				?>
				 <!-- ITEM -->
                <div style="float:left; padding-left: 25px;">
                	<h3 align="center">No badges designed yet</h3>
              </div>
                <!-- END ITEM -->
				<?php } ?>
              
            </div>
          </div>
          
          <div class="signUpField" style="border-top-width: 1px; border-top-style: dashed; border-top-color: #CCC;">
            <div class="signUpFieldLeft">Fastener:</div>
            <div class="signUpFieldRight" style="width: 303px;">
<input type="radio" name="fastener" value="none"/> None&nbsp;&nbsp;<input type="radio" name="fastener" value="magnet" checked /> Magnet&nbsp;&nbsp;<input type="radio" name="fastener" value="pin" /> Pin
            </div>
          </div>
          
          <div class="signUpField" style="border-top-width: 1px; border-top-style: dashed; border-top-color: #CCC;">
            <div class="signUpFieldLeft">Frame:</div>
            <div class="signUpFieldRight" style="width: 303px;">
			<?php if ($customer["finventory"] > 0) { ?>
<input type="radio" name="frame" value="None" checked/> None&nbsp;&nbsp;<input type="radio" name="frame" value="Silver" /> Silver&nbsp;&nbsp;<input type="radio" name="frame" value="Gold" /> Gold
			<?php } else { ?>
				<h3>No Frames Left, Please Purchase More</h3>
			<?php } ?>
            </div>
          </div>
			
		  <div class="signUpField" style="border-top-width: 1px; border-top-style: dashed; border-top-color: #CCC;">
            <div class="signUpFieldLeft">Dome:</div>
            <div class="signUpFieldRight" style="width: 303px;">
			<?php if ($customer["dminventory"] > 0) { ?>
<input type="radio" name="dome" value="1" checked/> Yes&nbsp;&nbsp;<input type="radio" name="dome" value="0" /> No&nbsp;&nbsp;
			<?php } else { ?>
				<h4>No Dome Left, Please Purchase More</h4>
			<?php } ?>
            </div>
          </div>	
		   
          
          <div class="signUpField" >
            <div style="height: 30px; text-align: center; line-height: 30px; margin-top:15px; margin-bottom: 15px;"><input type="image" value="submit" src="images/addNameButton.png" /></div>
          </div>
          </form>
                   
      <?php }else{
	 ?>
		<div class="signUpField" >
				<div style=" text-align: center; line-height: 30px; margin-top:5px; margin-bottom: 5px;">
            	
                <h4>Your Badges:</h4>
                <?php 
				if ($style) {
				do { ?>
                <!-- ITEM -->
                <div style="float: left; padding-left: 25px;">
                	<img src="proofs/<?php echo $style["proof"]; ?>" width="185" />
					<p style="margin-top: -15px; font-weight: bold; padding:0; line-height: 18px;">To Order This Badge Style <br/> Please Purchase More Inventory</p>
					<br />
					
              </div>
                <!-- END ITEM -->
				<?php } while ($style = mysql_fetch_assoc($styles)); 
				} else {
				?>
				 <!-- ITEM -->
                <div style="float:left; padding-left: 25px;">
                	<h3 align="center">No badges designed yet</h3>
              </div>
                <!-- END ITEM -->
				<?php } ?>
              
            </div>
          </div>	
	 <?php	
	  } ?> 
     </div><!-- end logoBox -->
	  </div>
      
      <div id="addNamesRight">
      	<div class="boxHeader"><span style="float: left;">Names List</span></div>
        <?php if ($badge) { ?>
        <div class="signUpField" >
            <div style="text-align: center; line-height: 30px; margin-top:15px; margin-bottom: 15px;">
            <p style="margin: 0; padding: 0; line-height: 14px;">
            <h4 style="margin:0; padding: 0; line-height: 15px;">Finished?</h4>  Click "Place Order" to submit your order to us for production.</p>
            <br />
			<form method="post" action="customerpanel.php">
			<input type="hidden" name="process" value="1" />
            <input type="image" value="submit" src="images/placeOrderButton.png" />
			<br />
			Notes: <br />
			<textarea name="cusotmer_note" rows="3" cols="20"></textarea>
			</form>
            </div>
          </div>
        
        <?php 
		$x = 1;
		do { 
		?>
       <!-- name -->
        <div class="signUpField" style="border-top-width: 1px; border-top-style: dashed; border-top-color: #CCC;">
            <div class="signUpFieldLeft" style="width: 75px; height: 58px;">Name <?php echo $x; ?>:</div>
            <div class="signUpFieldRight" style="width: 363px; font-size: 11px; height: 48px; line-height: 14px;">
            	<div style="float: left; width: 250px;">
                <table cellpadding="0" cellspacing="0" height="58"><tr  style="font-size: 11px;"><td valign="middle">
                	<strong>Line 1:</strong>  <?php echo $badge["name"]; ?> <br />
                	<strong>Line 2:</strong>  <?php echo $badge["subtext"]; ?> <br />
                	<strong>Line 3:</strong>  <?php echo $badge["subtext2"]; ?> <br />
                 </td></tr></table>
                </div>
                <div style="float: right; width: 100px; text-align: center; font-size: 11px;">
                <table cellpadding="0" cellspacing="0" height="58"><tr style="font-size: 11px;">
                  <td valign="middle">
                Fastener: <?php echo $badge["fastener"]; ?><br />
				Dome : <?php if($badge['dome'] == 0){echo 'No';}else {echo 'Yes';}?> <br />		
                Frame: <?php echo $badge["frame"]; ?><br />
                <a href="customerpanel.php?deleteid=<?php echo $badge["id"]; ?>&frame=<?php echo $badge["frame"]; ?>&dome=<?php echo $badge["dome"];?>">Remove Name</a>
                </td></tr></table>
                </div>
            </div>
        </div>
       <!-- end name -->
       <?php
	    $x++;
	    } while ($badge = mysql_fetch_assoc($badges)); 
		} else {
		?>
     	<div class="signUpField" style="border-top-width: 1px; border-top-style: dashed; border-top-color: #CCC;">
			<p style="padding: 15px;">Add Names to the Left</p>
		</div>
	 	<?php } ?>
        
      </div>
      

    </div><!-- end mainContentFull -->
  
  </div><!-- end content -->
</div><!-- end wrapper -->
<div style="display: none;"><img src="/images/wizard/continueMinus.png" /></div>

<?php include_once 'inc/footer.php' ; ?>
