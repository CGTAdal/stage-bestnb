<?php 
require_once('../admin/conn/DB.php');
include('../admin/conn/tablefuncs.php');
mysql_select_db($database_DB, $ravcodb);
session_start();
$_SESSION["styleid"] = $_REQUEST["style"];
$_SESSION["color"] = $_REQUEST["color"]; 

$qry = "SELECT * FROM colors WHERE id = ".$_REQUEST["color"];
$colors = mysql_query($qry) or die('Query failed: ' . mysql_error()); 
$color2 = mysql_fetch_assoc($colors);

$_SESSION["backgroundimage"] = $color2["backgroundimage"];

$qry = "SELECT * FROM styles WHERE id = ".$_REQUEST["style"];
$styles = mysql_query($qry) or die('Query failed: ' . mysql_error()); 
$style = mysql_fetch_assoc($styles);

?>
			<div class="boxSub2" style="text-align: center; float: left;width: 100%">
              <?php 
			  $rate  = 580/330;;
			  ?>
              <div id="imageshow" name="imageshow" style="height:<?php echo 310/$rate?>px; width: 330px; float: left; margin-top: 15px;">
  				<img src="/images/loading.gif" />
  			  </div>
			  <div id="badgestyle">
           <p style="float: left; font-size: 10px; width: 150px; text-align: left;">Badge Style:<br />
             <strong><?php echo $style["size"]." - ".$style["name"]; ?></strong>
             </p></div>
             <div id="framestyle"><p style="float: right; font-size: 10px; width: 60px; text-align: left;">Frame:<br />
              <strong><?php echo $_SESSION["frame"]; ?></strong>
              </p></div>
              <div id="colorname">
			  <p style="float: right; font-size: 10px; width: 85px; text-align: left;">Color:<br />
              <strong><?php echo $color2["name"]; ?></strong>
              </p>
			  </div>
         </div>