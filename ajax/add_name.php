<?php 
require_once('../admin/conn/DB.php');
include('../admin/conn/tablefuncs.php');
mysql_select_db($database_DB, $ravcodb);
session_start();

if ($_REQUEST["removeid"])
{
	delete_record_secondary("batches", $_REQUEST["removeid"], "id");
}

if ($_REQUEST["fastener"])
{
	$data["custid"] = $_SESSION["customerloginid"];
	$data["custstyleid"] = $_SESSION["custstyleid"];
	$data["printorderid"] = $_SESSION["printorderid"];
	if ($_REQUEST["text1"])
	{
		$data["name"] = $_REQUEST["text1"];
	} else {
		$data["name"] = "-< NO NAME ADDED >-";
	}
	$data["subtext"] = $_REQUEST["text2"];
	$data["subtext2"] = $_REQUEST["text3"];
	$data["fastener"] = $_REQUEST["fastener"];
	$data['dome'] 	  = $_REQUEST['dome'];	
	$data["frame"] = ucfirst($_SESSION["frame"]);
	$data['fontsize1'] = $_REQUEST['font1size'];
	$data['fontsize2'] = $_REQUEST['font2size'];
	$data['fontsize3'] = $_REQUEST['font3size'];
	$data['font1']	=$_REQUEST['font1'];
	$data['font2']	=$_REQUEST['font2'];
	$data['font3']	=$_REQUEST['font3'];
	add_record("batches", $data);
	
	$_SESSION["numofbadges"] = $_REQUEST["numofbadges"];
	$_SESSION["numofframes"] = $_REQUEST["numofframes"];
	$_SESSION["numofdomes"] = $_REQUEST["numofdomes"];
	
	$_SESSION["numofabadges"] = $_REQUEST["numofabadges"];
	$_SESSION["numofaframes"] = $_REQUEST["numofaframes"];
	$_SESSION["numofadome"] = $_REQUEST["numofadome"];
	
}

$qry = "SELECT * FROM batches WHERE printorderid = ".$_SESSION["printorderid"]." ORDER BY id";
$names = mysql_query($qry);
$name = mysql_fetch_assoc($names);
$_SESSION["badgecount"] = mysql_num_rows($names);

if ($name) { 
	$x = 1;
	do{ ?>
	<!-- name -->
        <div class="signUpField" style="border-top-width: 1px; border-top-style: dashed; border-top-color: #CCC;">
            <div class="signUpFieldLeft" style="width: 75px; height: 60px;">Name <?php echo $x; ?>:</div>
            <div class="signUpFieldRight" style="width: 363px; font-size: 11px; height: 60px; line-height: 14px;">
            	<div style="float: left; width: 250px;">
                <table cellpadding="0" cellspacing="0" height="48"><tr style="font-size: 11px;"><td valign="middle">
                	<strong>Name:</strong>  <?php echo $name["name"]; ?> <br />
                	<strong>Subtext:</strong>  <?php echo $name["subtext"]; ?> <br />
                	<strong>Subtext2:</strong>  <?php echo $name["subtext2"]; ?> <br />
                 </td></tr></table>
                </div>
                <div style="float: right; width: 100px; text-align: center; font-size: 11px;">
                <table cellpadding="0" cellspacing="0" height="48"><tr style="font-size: 11px;">
                  <td valign="middle">
				Frame: <?php echo $name['frame']?></br>  
				Dome: <?php if($name['dome'] == 1){
					echo 'Yes';}else { echo 'No';} ?> <br/>
                Fastener: <?php echo $name["fastener"]; ?><br />
                <a href="#names" onclick="javascript:removename(<?php echo $name["id"]; ?>);">Remove Name</a>
                </td></tr></table>
                </div>
            </div>
			<input type="hidden" value="<?php echo $name['dome']; ?>" id="dome_remove_<?php echo $name["id"]; ?>" name="dome" />
        </div>
       <!-- end name -->
	  <?php 
	  $x++;
	  } while($name = mysql_fetch_assoc($names)); 
	  }?>