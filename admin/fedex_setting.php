<?php 
require_once('conn/DB.php');
include('conn/tablefuncs.php');
include('../include/config.php');
mysql_select_db($database_DB, $ravcodb);
session_start();
if (!$_SESSION["loginid"] || $_SESSION["userlevel"] < 2)
{?>
<script language="javascript">
parent.parent.location.href='admin.php';
window.close();
</script>
<?php }?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>View Print Orders</title>
<link href="<?php echo $base_url?>/admin/includes/cms.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" media="all" href="<?php echo $base_url?>/admin/calendar/calendar-win2k-1.css" title="win2k-1" />

<script type="text/javascript" src="<?php echo $base_url?>/admin/scripts/jquery-1.3.2.min.js"></script>
<!-- main calendar program -->
<script type="text/javascript" src="<?php echo $base_url?>/admin/calendar/calendar.js"></script>

<!-- language for the calendar -->
<script type="text/javascript" src="<?php echo $base_url?>/admin/calendar/lang/calendar-en.js"></script>

<!-- the following script defines the Calendar.setup helper function, which makes
     adding a calendar a matter of 1 or 2 lines of code. -->
<script type="text/javascript" src="<?php echo $base_url?>/admin/calendar/calendar-setup.js"></script>

<script type="text/javascript">
    var GB_ROOT_DIR = "greybox/";
</script>
<script type="text/javascript" src="<?php echo $base_url?>/admin/greybox/AJS.js"></script>
<script type="text/javascript" src="<?php echo $base_url?>/admin/greybox/AJS_fx.js"></script>
<script type="text/javascript" src="<?php echo $base_url?>/admin/greybox/gb_scripts.js"></script>
<script type="text/javascript" src="<?php echo $base_url?>/admin/scripts/jquery-1.3.2.min.js"></script>


<link href="<?php echo $base_url?>/admin/greybox/gb_styles.css" rel="stylesheet" type="text/css" />
<body>

<?php
$sql = "SELECT * FROM fedex_setting";
$result = mysql_query($sql);
$fedex = mysql_fetch_assoc($result);
if(empty($fedex)){
    $faccoutnum = '';
    $fmeternum  = '';
    $fdroptype  = '';
    $fservice   = '';
    $fpacking   = '';
    $fenable    = 1;
    $state      = '';
    $postalcode = '';
    $countrycode='';
}else{
    $faccoutnum = $fedex['fedex_accountno'];
    $fmeternum  = $fedex['fedex_meternum'];
    $fdroptype  = $fedex['fedex_type'];
    $server     = explode('_',$fedex['fedex_service']);
    $fpacking   = $fedex['fedex_packe'];
    $fenable    = $fedex['fedex_enable'];
    $state      = $fedex['state'];
    $postalcode = $fedex['postalcode'];
    $countrycode=$fedex['countrycode'];
}   

if($_REQUEST['fedexaccno'])
{
    if($_REQUEST['fedexaccno']==''){
        $error_accountno = 'You need enter account no.';
    }else {
        $error_accountno = '';
    }
    if($_REQUEST['fedexmeterno']==''){
        $error_meterno = 'You need enter meter no.';
    }else {
        $error_meterno = '';
    }
    $faccoutnum = $_REQUEST['fedexaccno'];
    $fmeternum  = $_REQUEST['fedexmeterno'];
    $fdroptype  = $_REQUEST['dropoff'];
    $server     = explode('_',$_REQUEST['fedexservice']);
    $fpacking   = $_REQUEST['packageType'];
    $fenable    = $_REQUEST['fedexenable'];
    $state      = $_REQUEST['state'];
    $postalcode = $_REQUEST['postalcode'];
    $countrycode= $_REQUEST['countrycode'];
    $sql_update = 'UPDATE fedex_setting SET fedex_accountno ="'.$faccoutnum.'", fedex_meternum="'.$fmeternum.'", fedex_type="'.$fdroptype.'",
                    fedex_service="'.$server[0].'",fedex_servername="'.$server[1].'", fedex_packe="'.$fpacking.'",fedex_enable="'.$fenable.'",
                    state="'.$state.'",postalcode = "'.$postalcode.'",countrycode = "'.$countrycode.'"
                    ';
    //echo $sql_update;    
                
    mysql_query($sql_update);                
}
include("header.php"); ?>
	<form action="" method="post" name="fedexShipping" onSubmit="return validateFedex();">
		
		<div align="center" class="content_area">
				<!--content area start -->
				<table width="800" frame="box" cellpadding="0" cellspacing="0" border="0" width="100%">
				<tr>
				<td>
				
						<div style="padding-top: 25px;" align="left" class="page_title"><strong>Edit Fedex Shipping Settings</strong></div>
						<div align="center" class="text_information grey_tr"><?php echo $message?></div>
            			<br>
					
						<div align="center">						
								<table width="100%" border="0" cellpadding="5" cellspacing="5" class="manage_table">
    								<tr>
    								  <td>Fedex Account Number<span class="style1">*</span></td>
    								  <td align="left"><input name="fedexaccno" class="textarea2" type="text" id="fedexaccno" value="<?php echo $faccoutnum;?>"> 
    								    Test Accno : <?php echo $faccoutnum;?> <br />
                                        <font color="red"><?php echo $error_accountno;?></font></td>
    								</tr>
    								<tr>
    								  <td>Fedex Meter Number<span class="style1">*</span></td>
    								  <td align="left"><input name="fedexmeterno" class="textarea2" type="text" id="fedexmeterno" value="<?php echo $fmeternum;?>">
    								    Test Meter No : <?php echo $fmeternum;?><br />
                                        <font color="red"><?php echo $error_meterno;?></font>
                                        </td>
    								</tr>
    								<tr>
    								  <td>Weight Units <span class="style1">*</span></td>
    								  <td align="left"><input name="weight" type="radio" value="LBS" <?php if($weight=="LBS") { echo "checked";}?>  checked>
    								    LBS							        </td>
    								</tr>    							
    								<tr>
    								  <td valign="top">Drop off type<span class="style1">*</span><br>							      </td>
    								  <td align="left">
    								  <?php
                                        $dropOfftype['REGULARPICKUP']           = 'REGULARPICKUP';
                                        $dropOfftype['DROPBOX']                 = 'DROPBOX';
                                        $dropOfftype['BUSINESSSERVICECENTER']   = 'BUSINESSSERVICECENTER';
                                        $dropOfftype['REQUESTCOURIER']          = 'REQUESTCOURIER';
                                        $dropOfftype['STATION']                 = 'STATION'; 
                                       foreach($dropOfftype as $dropoffs=>$type)
    								  	{ // display dropoff from array
                                        if($fdroptype==$dropoffs){
                                            $sl = 'checked';
                                        }else {
                                            $sl = '';
                                        }
    									?>
    								  <input name="dropoff" type="radio" value="<?php echo $dropoffs;?>" <?php echo $sl;?>><?php echo $type;?>
    								  <br>
    								  <?
    									  }
    								  ?>
    							      </td>
    								  </tr>
    								<tr>
    								  <td valign="top">Service Type </td>
    								  <td align="left">
    								  <?php 
    								   // displaying Service Types								
    								    $fedexServiceArray['PRIORITYOVERNIGHT']     = 'FedEx Priority Overnight';
                                        $fedexServiceArray['STANDARDOVERNIGHT']     = 'FedEx Standard Overnight';
                                        $fedexServiceArray['FIRSTOVERNIGHT']        = 'FedEx First Overnight';
                                        $fedexServiceArray['FEDEX2DAY']             = 'FedEx 2 Day';
                                        $fedexServiceArray['FEDEXEXPRESSSAVER']     = 'FedEx Express Saver';
                                        $fedexServiceArray['INTERNATIONALPRIORITY'] = 'FedEx International Priority';
                                        $fedexServiceArray['INTERNATIONALECONOMY']  = 'FedEx International Economy';
                                        $fedexServiceArray['INTERNATIONALFIRST']    = 'FedEx International First';
                                        $fedexServiceArray['FEDEX1DAYFREIGHT']      = 'FedEx Overnight Freight';
                                        $fedexServiceArray['FEDEX2DAYFREIGHT']      = 'FedEx 2 day Freight';
                                        $fedexServiceArray['FEDEX3DAYFREIGHT']      = 'FedEx 3 day Freight';
                                        $fedexServiceArray['FEDEXGROUND']           = 'FedEx Ground';
                                        $fedexServiceArray['GROUNDHOMEDELIVERY']    = 'FedEx Home Delivery';
    								  foreach($fedexServiceArray as $service=>$serviceNames)
    									{
    									
    									  	if($server[0] == $service)
    										{
    											$checkd='checked';
    										}//end if
    										else
    										{
    											$checkd='';
    										}//end else
    								 ?>
    									<input type="radio" value="<?php echo $service.'_'.$serviceNames;?>" name="fedexservice" <?php echo $checkd;?>> <?php echo $serviceNames;?>
    									
    									<?php
    									echo "<br>";
    								  	} // end for each 
    								  	?>
    								  </td>
    								  </tr>
    								<tr>
    								  <td valign="top">Packaging Type</td>
    								  <td align="left">
    								  <select name="packageType" id="packageType" class="textarea2">
                                      
    								  <?php
                                        $Packagetype['YOURPACKAGING']   = 'YOURPACKAGING';
                                        $Packagetype['FEDEXBOX']        = 'FEDEXBOX';
                                        $Packagetype['FEDEXPAK']        = 'FEDEXPAK';
                                        $Packagetype['FEDEXTUBE']       = 'FEDEXTUBE';
    								  	foreach($Packagetype as $key=>$value)
    									{ // display package type
    									if($packagingTypes=='')
    									{
    										$pt="YOURPACKAGING";
    									}
    									else
    									{
    									$pt=$fpacking;
    									}
    									if($key==$pt)
    									{
    									$check="selected";
    									}
    									else
    									{
    									$check='';
    									}
    									
    									?>
    									<option value="<?php echo $value;?>"  <?php echo $check;?>><?php echo $value;?></option>
    									
    									<?php 
    									} // end for each 
    								  
    								  ?>
    							      </select></td>
    								  </tr>		
                                    
                                    <tr>
                                        <td>
                                            Origin State/Province Code
                                        </td>
                                        <td>
                                            <input type="text" name="state" value="<?php echo $state;?>" />
                                        </td>
                                    </tr>   
                                    <tr>
                                        <td>
                                            Origin Postal Code
                                        </td>
                                        <td>
                                            <input type="text" name="postalcode" value="<?php echo $postalcode;?>" />
                                        </td>
                                    </tr> 
                                     <tr>
                                        <td>
                                            Origin Country Code
                                        </td>
                                        <td>
                                            <input type="text" name="countrycode" value="<?php echo $countrycode;?>" />
                                        </td>
                                    </tr> 
    								<tr>
                                        <td>
                                            Enable(?)
                                        </td>
                                        <td>
                                            <select name="fedexenable">
                                                <option <?php if($fenable==1){ echo 'selected="selected"';}?> value="1">Enable</option>
                                                <option <?php if($fenable==0){ echo 'selected="selected"';}?> value="0">Disable</option>
                                            </select>
                                        </td>
                                    </tr>
    							     <tr>
        								  <td valign="top">&nbsp;</td>
        								  <td align="left">&nbsp;</td>
    								  </tr>
								</table>

						</div>
						<div align="center"><input type="submit" name="submit" value="Update" class="button"></div>
						
	<!--content area end-->
	 </td></tr>
			
			</table>	
		  </div>
				
				</form>
				
					<div align="left" class="clear_float"><img src="../images/clear.gif" alt="" width="1" height="1" /></div>
				<!--main body end -->
				</div>
				

<script language="javascript">
function validateFedex()
{	
return true;
	if(document.fedexShipping.fedexaccno.value=="")
	{
	alert("Please enter Fedex Account Number");
	document.fedexShipping.fedexaccno.focus();
	return false;
	}
	
	if(document.fedexShipping.fedexmeterno.value=="")
	{
	alert("Please enter Fedex Meter Number");
	document.fedexShipping.fedexmeterno.focus();
	return false;
	}
	
	
	return true;
	
}	


</script>

</body>
</html>