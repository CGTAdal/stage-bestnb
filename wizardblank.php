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
	include_once 'inc/header.php' ;
} ?>


<script type="text/javascript" src="/js/jscolor.js"></script>

    <div id="content">
     
    <div id="mainContentFull">
	  <h2>Blank Name Badge Ordering</h2>

	  <br /><br />
	  
      <div id="logoBox">
      	<div class="boxHeader"><span style="float: left;">Badge Information</span></div>
      	<div class="boxSub" style="border-bottom: none;">
        	  <div class="boxSub2" style="display: none;"></div>
        </div><div class="signUpField" style="border-top-width: 1px; border-top-style: dashed; border-top-color: #CCC;">
            <div class="signUpFieldLeft">Select Your Badge:</div>
            <div class="signUpFieldRight">
            <select name="changestyle" id="changestyle" onchange="changecstyle(this.value)" style="width: 200px; height: 22px;" class="signupFieldInput">
	<option value="0">Choose One...</option>
	<?php do { ?>
	<option value="<?php echo $newstyle["id"].",".$newstyle["colorid"]; ?>"><?php echo $newstyle["name"]." - ".$newstyle["size"]." - ".$newstyle["colorname"];?></option>
	<?php } while ($newstyle = mysql_fetch_assoc($newstyles)); ?>
</select></div>
          </div>
        <div class="signUpField" style="border-top-width: 1px; border-top-style: dashed; border-top-color: #CCC;">
        <div class="signUpFieldLeft">Try A Frame:</div>
            <div class="signUpFieldRight">
            <input type="hidden" name="tag" value="1" />
<input type="radio" name="frame" value="none" checked onclick="javascript:framechange(this.value);"/> None&nbsp;&nbsp;<input type="radio" name="frame" value="gold" <?php if ($_SESSION["frame"] == "gold") { ?>checked<?php } ?> onclick="javascript:framechange(this.value);"/> Gold&nbsp;&nbsp;<input type="radio" name="frame" value="silver" <?php if ($_SESSION["frame"] == "silver") { ?>checked<?php } ?> onclick="javascript:framechange(this.value);" /> Silver
            </div>
        </div>

	<div class="signUpField" style="border-top-width: 1px; border-top-style: dashed; border-top-color: #CCC;">
        <div class="signUpFieldLeft">Fastener:</div>
            <div class="signUpFieldRight">
            <input type="hidden" name="tag" value="1" />
<input type="radio" name="fastener" value="none" onclick="javascript:framechange(this.value);"/> None&nbsp;&nbsp;<input checked type="radio" name="fastener" value="magnet" <?php if ($_SESSION["frame"] == "gold") { ?>checked<?php } ?> onclick="javascript:framechange(this.value);"/> Magnet&nbsp;&nbsp;<input type="radio" name="fastener" value="pin" <?php if ($_SESSION["frame"] == "silver") { ?>checked<?php } ?> onclick="javascript:framechange(this.value);" /> Pin
            </div>
     </div>
     <div class="boxHeader"><span style="float: left;">Quantity Selection</span></div>
     <div class="signUpField" style="border-top-width: 1px; border-top-style: dashed; border-top-color: #CCC;">
        <div class="signUpFieldLeft">Quantity:</div>
            <div class="signUpFieldRight">
           <input type="text" name="additionalbadges"  value="1" maxlength="10" style="width: 30px;" class="signupFieldInput" />
            </div>
     </div>


<div style="width: 500px; float: left; padding-top: 25px; border-right: solid 1px #CCC; border-left: solid 1px #CCC; border-bottom: dashed 1px #CCC;">
     	<div style="float: left; width: 200px; padding-left: 15px;">
        	<p class="popBox">Badges This Order: <span class="quantityNumber">8</span></p>
        </div>
        <div style="float: right; width: 200px;">
        	<p class="popBox">Frames This Order: <span class="quantityNumber">8</span></p>
        </div>
        <div style="clear: both; padding-bottom: 5px;"></div>
        <div style="clear: both; border-bottom: solid 1px #CCC; height: 15px; margin-bottom: 10px;"></div>
        <div style="float: left; width: 220px; padding-left: 15px;">
        	<p class="popBoxSmall">Badge Total: 14 x $9.45 = <span class="quantityNumber" style="font-size: 14px;">$75.60</span></p>
        </div>
        <div style="float: right; width: 220px;">
        	<p class="popBoxSmall">Frame Total: 14 x $2.00 = <span class="quantityNumber" style="font-size: 14px;">$16.00</span></p>
        </div>
        <div style="clear: both;"></div>
        <div style="width: 500px; text-align: center;">
        	<p class="popBoxSmall">Order Total: <span class="quantityNumber">$91.60</span></p>
         </div>
     </div>


<div class="signUpField">
              <div class="signUpFieldLeft" style="height: 150px; ">Notes:<br />
              <p style="margin:0; padding: 0; line-height: 12px; font-weight: normal;">Any specific instructions?</p> </div>
            <div class="signUpFieldRight" style="height: 150px; "><textarea name="note" cols="40" rows="5" style="margin-top: 5px; width: 325px; height: 130px;"></textarea></div>
         	</div>

<div class="signUpField" style="width: 500px;">
            <div style="height: 30px; text-align: center; line-height: 30px; margin-top:15px; margin-bottom: 15px; width: 500px;"><input type="image" value="submit" src="images/continueButton.png" /></div>
          
      </div>

      </div><!-- end logoBox -->
      
      <div id="wizardRight">
      <div class="boxHeader"><span style="float: left;">Preview Your Badge</span></div>
      <div class="boxSub" style="float: left;">
         <div class="boxSub2" style="text-align: center; float: left;">
              <div id="imageshow" name="imageshow" style="height:133px; width: 330px; float: left; margin-top: 15px;">
  				<img src="/images/loading.gif" width="75" height="75" />
  			  </div>
           <p style="float: left; font-size: 10px; width: 150px; text-align: left;">Badge Style:<br />
             <strong>Brushed Aluminum  - 1" x 3"</strong>
             </p>
             <p style="float: right; font-size: 10px; width: 60px; text-align: left;">Frame:<br />
              <strong>None</strong>
              </p>
              <p style="float: right; font-size: 10px; width: 85px; text-align: left;">Color:<br />
              <strong>Silver</strong>
              </p>
            <p style="float: left; font-size: 10px; width: 85px; text-align: left; clear: both; margin: 0; padding: 0;">Fastener:<br />
            <strong>Magnet</strong></p>
         </div>
         
      </div>
    </div><!-- end wizardRight -->
    
    <div style="clear: both;"></div>
    
    

<script type="text/javascript">

var slider2=new accordion.slider("slider2");
slider2.init("slider2",15,"open");

</script>
    
    </div><!-- end mainContentFull -->
  
  </div><!-- end content -->
</div><!-- end wrapper -->
<div style="display: none;"><img src="/images/wizard/continueMinus.png" /></div>

<?php include_once 'inc/footer.php' ; ?>