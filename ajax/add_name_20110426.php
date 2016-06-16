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
	$data["frame"] = ucfirst($_SESSION["frame"]);
	add_record("batches", $data);
	
	$_SESSION["numofbadges"] = $_REQUEST["numofbadges"];
	$_SESSION["numofframes"] = $_REQUEST["numofframes"];
	$_SESSION["numofabadges"] = $_REQUEST["numofabadges"];
	$_SESSION["numofaframes"] = $_REQUEST["numofaframes"];
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
            <div class="signUpFieldLeft" style="width: 75px; height: 48px;">Name <?php echo $x; ?>:</div>
            <div class="signUpFieldRight" style="width: 363px; font-size: 11px; height: 48px; line-height: 14px;">
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
                Fastener: <?php echo $name["fastener"]; ?><br />
                <a href="#names" onclick="javascript:removename(<?php echo $name["id"]; ?>);">Remove Name</a>
                </td></tr></table>
                </div>
            </div>
        </div>
       <!-- end name -->
	  <?php 
	  $x++;
	  } while($name = mysql_fetch_assoc($names)); 
	  }?>