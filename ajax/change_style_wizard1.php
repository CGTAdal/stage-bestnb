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
			<input type="hidden" value="<?php echo 'url(\'blanks/'.$_SESSION['backgroundimage'].'\') no-repeat scroll 50% 50%';?>" name="bgr" id="bgr" />
			<input type="hidden" value="<?php echo $_SESSION['backgroundimage'];?>" id="bgr_img" name="backgroundimage" />
			<div class="signUpFieldRight" style="height: 65px;float:left;"> 
			  <div style="float: left; width: 350px; margin-top: 0;">
					<div id="styleinfo">  
					 <div id="badgestyle">
					   <p style="float: left; font-size: 10px; width: 210px; text-align: left;">Badge Style:<br />
						 <strong><?php echo $style["size"]." - ".$style["name"]; ?></strong>
					   </p>
					  </div>
					  <div id="framestyle">
						  <p style="float: right; font-size: 10px; width: 60px; text-align: left;">Frame:<br />
							<strong><?php echo $_SESSION["frame"]; ?></strong>
						  </p>
					  </div>
					  <div id="colorname">
						  <p style="float: right; font-size: 10px; width: 75px; text-align: left;">Color:<br />
						  <strong><?php echo $color2["name"]; ?></strong>
						  </p>
					  </div>
				</div>
			</div> 
         </div>