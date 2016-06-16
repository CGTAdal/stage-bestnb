<?php
require_once('conn/DB.php');
include('conn/tablefuncs.php');
include('../include/config.php');
mysql_select_db($database_DB, $ravcodb);
session_start();
if (!$_SESSION["loginid"])
{?>
<script language="javascript">
parent.parent.location.href='admin.php';
window.close();
</script>
<?php 
}
    $customer_id = $_REQUEST['customer_id'];
    $qry = "SELECT  customers.id AS custid, customers.firstname AS firstname, customers.lastname AS lastname, customers.companyname AS companyname, customers.street, customers.street2, 
    customers.country,customers.city, customers.state, customers.zip AS zipcode, customers.email, customers.phone FROM customers WHERE customers.id ='{$customer_id}'";
    //echo $qry;
    $customers_result = mysql_query($qry) or die('Query failed: ' . mysql_error()); 
    $customers = mysql_fetch_assoc($customers_result); 
    if(!isset ($_REQUEST['update'])){
        $_SESSION["state"] = $customers['state'];
    }else {
        $_SESSION["state"] = $_REQUEST['state1'];
    }
    if(isset($_REQUEST['country1'])){
        $_SESSION['country'] = $_REQUEST['country1'];
    }else {
        $_SESSION['country'] = $customers['country'];
    }
    
		//echo '<pre>'.print_r($customers).'</pre>';		
		
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Best Name Badges - Content Management System</title>
<?php include("init_top.php");?>
<link href="includes/cms.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $base_url?>/admin/includes/cms.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css"  href="<?php echo $base_url?>/admin/calendar/calendar-win2k-1.css" />

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

<script type="text/javascript" src="greybox/AJS.js"></script>
<script type="text/javascript" src="greybox/AJS_fx.js"></script>
<script type="text/javascript" src="greybox/gb_scripts.js"></script>
<link href="greybox/gb_styles.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="scripts/jquery-1.3.2.min.js"></script>
<style>
	.save_sent_button{
		background: url('images/savesend-btn.gif') no-repeat top center;
		border:none;
		width:220px;
		height:45px;
		line-height:45px;
		color:#fff;
		text-align:center;
		font-family: arial;
	        font-size: 14px !important;
	        font-weight: bold;
	}
	.add_line{
		background: url('images/add-line.gif') no-repeat top center;
		border:none;
		width:99px;
		height:22px;
		line-height:22px;
		color:#fff;
		text-align:left;
		font-family: arial;
	        font-size: 13px !important;
	        font-weight: bold;
	}
	#edit_address{
	    display: none;
	    padding-left: 10px;
	}
</style>
<script>
	
$(document).ready(function(){
	 $("#click_edit").click(function(){
	       $("#show_address").hide();
	       $("#link_edit").hide();
	       $("#edit_address").show(); 
	   });
	 $("#click_cancel").click(function(){
	       $("#show_address").show();
	       $("#link_edit").show();
	       $("#edit_address").hide(); 
	   });
});

function changestatediv1(country)
{
	var state = '<?php echo $_SESSION["state"]; ?>';		
   if (country == "CA")
	{		
		value_html = '<option value=AB <?php if ($_SESSION["state"] == "AB") { ?>selected<?php } ?>>AB</option><option value=BC <?php if ($_SESSION["state"] == "BC") { ?>selected<?php } ?>>BC</option><option value=MB <?php if ($_SESSION["state"] == "MB") { ?>selected<?php } ?>>MB</option><option value=NB <?php if ($_SESSION["state"] == "NB") { ?>selected<?php } ?>>NB</option><option value=NL <?php if ($_SESSION["state"] == "NL") { ?>selected<?php } ?>>NL</option><option value=NT <?php if ($_SESSION["state"] == "NT") { ?>selected<?php } ?>>NT</option><option value=NS <?php if ($_SESSION["state"] == "NS") { ?>selected<?php } ?>>NS</option><option value=NU <?php if ($_SESSION["state"] == "NU") { ?>selected<?php } ?>>NU</option><option value=ON <?php if ($_SESSION["state"] == "ON") { ?>selected<?php } ?>>ON</option><option value=PE <?php if ($_SESSION["state"] == "PE") { ?>selected<?php } ?>>PE</option><option value=QC <?php if ($_SESSION["state"] == "QC") { ?>selected<?php } ?>>QC</option><option value=SK <?php if ($_SESSION["state"] == "SI") { ?>selected<?php } ?>>SK</option><option value=YT <?php if ($_SESSION["state"] == "YT") { ?>selected<?php } ?>>YT</option>';		
		$("#state1").html(value_html);
		document.getElementById('stateprov1').innerHTML = "<div>Province:</div>";
	} else if (country == "US")	{
		value_html  ='<option value=AK <?php if ($_SESSION["state"] == "AK") { ?>selected<?php } ?>>AK</option><option value=AL <?php if ($_SESSION["state"] == "AL") { ?>selected<?php } ?>>AL</option><option value=AR <?php if ($_SESSION["state"] == "AR") { ?>selected<?php } ?>>AR</option><option value=AZ <?php if ($_SESSION["state"] == "AZ") { ?>selected<?php } ?>>AZ</option><option value=CA <?php if ($_SESSION["state"] == "CA") { ?>selected<?php } ?>>CA</option><option value=CO <?php if ($_SESSION["state"] == "CO") { ?>selected<?php } ?>>CO</option><option value=CT <?php if ($_SESSION["state"] == "CT") { ?>selected<?php } ?>>CT</option><option value=DC <?php if ($_SESSION["state"] == "DC") { ?>selected<?php } ?>>DC</option><option value=DE <?php if ($_SESSION["state"] == "DE") { ?>selected<?php } ?>>DE</option><option value=FL <?php if ($_SESSION["state"] == "FL") { ?>selected<?php } ?>>FL</option><option value=GA <?php if ($_SESSION["state"] == "GA") { ?>selected<?php } ?>>GA</option><option value=HI <?php if ($_SESSION["state"] == "HI") { ?>selected<?php } ?>>HI</option><option value=IA <?php if ($_SESSION["state"] == "IA") { ?>selected<?php } ?>>IA</option><option value=ID <?php if ($_SESSION["state"] == "ID") { ?>selected<?php } ?>>ID</option><option value=IL <?php if ($_SESSION["state"] == "IL") { ?>selected<?php } ?>>IL</option><option value=IN <?php if ($_SESSION["state"] == "IN") { ?>selected<?php } ?>>IN</option><option value=KS <?php if ($_SESSION["state"] == "KS") { ?>selected<?php } ?>>KS</option><option value=KY <?php if ($_SESSION["state"] == "KY") { ?>selected<?php } ?>>KY</option><option value=LA <?php if ($_SESSION["state"] == "LA") { ?>selected<?php } ?>>LA</option><option value=MA <?php if ($_SESSION["state"] == "MA") { ?>selected<?php } ?>>MA</option><option value=MD <?php if ($_SESSION["state"] == "MD") { ?>selected<?php } ?>>MD</option><option value=ME <?php if ($_SESSION["state"] == "ME") { ?>selected<?php } ?>>ME</option><option value=MI <?php if ($_SESSION["state"] == "MI") { ?>selected<?php } ?>>MI</option><option value=MN <?php if ($_SESSION["state"] == "MN") { ?>selected<?php } ?>>MN</option><option value=MO <?php if ($_SESSION["state"] == "MO") { ?>selected<?php } ?>>MO</option><option value=MS <?php if ($_SESSION["state"] == "MS") { ?>selected<?php } ?>>MS</option><option value=MT <?php if ($_SESSION["state"] == "MT") { ?>selected<?php } ?>>MT</option><option value=NC <?php if ($_SESSION["state"] == "NC") { ?>selected<?php } ?>>NC</option><option value=ND <?php if ($_SESSION["state"] == "ND") { ?>selected<?php } ?>>ND</option><option value=NE <?php if ($_SESSION["state"] == "NE") { ?>selected<?php } ?>>NE</option> <option value=NH <?php if ($_SESSION["state"] == "NH") { ?>selected<?php } ?>>NH</option><option value=NJ <?php if ($_SESSION["state"] == "NJ") { ?>selected<?php } ?>>NJ</option><option value=NM <?php if ($_SESSION["state"] == "NM") { ?>selected<?php } ?>>NM</option><option value=NV <?php if ($_SESSION["state"] == "NV") { ?>selected<?php } ?>>NV</option><option value=NY <?php if ($_SESSION["state"] == "NY") { ?>selected<?php } ?>>NY</option><option value=OH <?php if ($_SESSION["state"] == "OH") { ?>selected<?php } ?>>OH</option><option value=OK <?php if ($_SESSION["state"] == "OK") { ?>selected<?php } ?>>OK</option><option value=OR <?php if ($_SESSION["state"] == "OR") { ?>selected<?php } ?>>OR</option> <option value=PA <?php if ($_SESSION["state"] == "PA") { ?>selected<?php } ?>>PA</option><option value=RI <?php if ($_SESSION["state"] == "RI") { ?>selected<?php } ?>>RI</option><option value=SC <?php if ($_SESSION["state"] == "SC") { ?>selected<?php } ?>>SC</option><option value=SD <?php if ($_SESSION["state"] == "SD") { ?>selected<?php } ?>>SD</option><option value=TN <?php if ($_SESSION["state"] == "TN") { ?>selected<?php } ?>>TN</option><option value=TX <?php if ($_SESSION["state"] == "TX") { ?>selected<?php } ?>>TX</option><option value=UT <?php if ($_SESSION["state"] == "UT") { ?>selected<?php } ?>>UT</option><option value=VA <?php if ($_SESSION["state"] == "VA") { ?>selected<?php } ?>>VA</option><option value=VT <?php if ($_SESSION["state"] == "VT") { ?>selected<?php } ?>>VT</option><option value=WA <?php if ($_SESSION["state"] == "WA") { ?>selected<?php } ?>>WA</option><option value=WI <?php if ($_SESSION["state"] == "WI") { ?>selected<?php } ?>>WI</option><option value=WV <?php if ($_SESSION["state"] == "WV") { ?>selected<?php } ?>>WV</option><option value=WY <?php if ($_SESSION["state"] == "WY") { ?>selected<?php } ?>>WY</option><option value=AA <?php if ($_SESSION["state"] == "AA") { ?>selected<?php } ?>>AA</option> <option value=AE <?php if ($_SESSION["state"] == "AE") { ?>selected<?php } ?>>AE</option><option value=AP <?php if ($_SESSION["state"] == "AP") { ?>selected<?php } ?>>AP</option><option value=AS <?php if ($_SESSION["state"] == "AS") { ?>selected<?php } ?>>AS</option><option value=FM <?php if ($_SESSION["state"] == "FM") { ?>selected<?php } ?>>FM</option><option value=GU <?php if ($_SESSION["state"] == "GU") { ?>selected<?php } ?>>GU</option><option value=MH <?php if ($_SESSION["state"] == "MH") { ?>selected<?php } ?>>MH</option><option value=MP <?php if ($_SESSION["state"] == "MP") { ?>selected<?php } ?>>MP</option><option value=PR <?php if ($_SESSION["state"] == "PR") { ?>selected<?php } ?>>PR</option><option value=PW <?php if ($_SESSION["state"] == "PW") { ?>selected<?php } ?>>PW</option><option value=VI <?php if ($_SESSION["state"] == "VI") { ?>selected<?php } ?>>VI</option>';	
		$("#state1").html(value_html);
		document.getElementById('stateprov1').innerHTML = "<div>State:</div>";
	} 
}
    function round_up (val, precision) {
        power = Math.pow (10, precision);
        poweredVal = Math.ceil (val * power);
        result = poweredVal / power;

        return result;
    }
    function number_format (number, decimals, dec_point, thousands_sep) {
        // Formats a number with grouped thousands  
        // 
        // version: 1109.2015
        // discuss at: http://phpjs.org/functions/number_format    // +   original by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
        // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
        // +     bugfix by: Michael White (http://getsprink.com)
        // +     bugfix by: Benjamin Lupton
        // +     bugfix by: Allan Jensen (http://www.winternet.no)    // +    revised by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
        // +     bugfix by: Howard Yeend
        // +    revised by: Luke Smith (http://lucassmith.name)
        // +     bugfix by: Diogo Resende
        // +     bugfix by: Rival    // +      input by: Kheang Hok Chin (http://www.distantia.ca/)
        // +   improved by: davook
        // +   improved by: Brett Zamir (http://brett-zamir.me)
        // +      input by: Jay Klehr
        // +   improved by: Brett Zamir (http://brett-zamir.me)    // +      input by: Amir Habibi (http://www.residence-mixte.com/)
        // +     bugfix by: Brett Zamir (http://brett-zamir.me)
        // +   improved by: Theriault
        // +      input by: Amirouche
        // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)    // *     example 1: number_format(1234.56);
        // *     returns 1: '1,235'
        // *     example 2: number_format(1234.56, 2, ',', ' ');
        // *     returns 2: '1 234,56'
        // *     example 3: number_format(1234.5678, 2, '.', '');    // *     returns 3: '1234.57'
        // *     example 4: number_format(67, 2, ',', '.');
        // *     returns 4: '67,00'
        // *     example 5: number_format(1000);
        // *     returns 5: '1,000'    // *     example 6: number_format(67.311, 2);
        // *     returns 6: '67.31'
        // *     example 7: number_format(1000.55, 1);
        // *     returns 7: '1,000.6'
        // *     example 8: number_format(67000, 5, ',', '.');    // *     returns 8: '67.000,00000'
        // *     example 9: number_format(0.9, 0);
        // *     returns 9: '1'
        // *    example 10: number_format('1.20', 2);
        // *    returns 10: '1.20'    // *    example 11: number_format('1.20', 4);
        // *    returns 11: '1.2000'
        // *    example 12: number_format('1.2000', 3);
        // *    returns 12: '1.200'
        // *    example 13: number_format('1 000,50', 2, '.', ' ');    // *    returns 13: '100 050.00'
        // Strip all characters but numerical ones.
        number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
        var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function (n, prec) {
                var k = Math.pow(10, prec);            return '' + Math.round(n * k) / k;
            };
        // Fix for IE parseFloat(0.55).toFixed(0) = 0;
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');    }
        return s.join(dec);
    }
function cal_total(count_id)
{
    var value = $("#qty"+count_id).val();
    var unit_cost = $("#unitcode"+count_id).val();
    var tax = $("#tax"+count_id).val();
    if(tax=='FL'){
        var total = value*unit_cost + value*unit_cost*6/100;
    }else {
        var total = value*unit_cost;
    }   
    //$("#total"+count_id).val(total);
     $("#total"+count_id).val(number_format(round_up(total,2),2,'.',','));
}
var countInput = 0;
function moreInput(){
		//alert('aaaa');
		//Remove old error
		$('#error-show').slideUp('fast');
		$('#error-show').html('');	
			
        countInput += 1;
        $('#inputsTable').append("<tr>"+                   
                    "<td width=\"200\"><input type=\"text\" style=\"width:200px;\"  value=\"\" class=\"input-text\"  name=\"item[]\" id=\"item"+ countInput +"\" /></td>"+
                    "<td width=\"200\"><input type=\"text\" style=\"width: 200px;\" value=\"\" class=\"input-text\"  name=\"description[]\" id=\"description"+ countInput +"\" /></td>"+
                    "<td width=\"60\"><input type=\"text\" style=\"width: 60px;\" value=\"\" class=\"input-text\" onchange=\"cal_total("+countInput+")\"  name=\"unitcode[]\" id=\"unitcode"+ countInput +"\" /></td>"+
                    "<td width=\"60\"><input type=\"text\" style=\"width: 60px;\" value=\"\" class=\"input-text\" onchange=\"cal_total("+countInput+")\"  name=\"qty[]\" id=\"qty"+ countInput +"\" /></td>"+                    
                    "<td width=\"60\"><input type=\"text\" style=\"width: 60px;\" value=\"\" class=\"input-text\"  name=\"total[]\" id=\"total"+ countInput +"\" /></td>"+
                     "<td style=\"width: 60px;border-right:none!important;\"><a href=\"#\" onclick=\"$(this).parent().parent().fadeOut('fast', function(){$(this).remove();}); countInput--; return false;\" style=\"padding-right: 7px; color: red;\">Delete</a></td>"+
                "</tr>");					
	}
    
function check_valid()
{
    var invoice_number = $("#invoice_number").val();
    var date_of_issue  = $("#date_of_issue").val();
    if(invoice_number < 61245){
        alert('Please enter invoice number greater 61245.');
        $("#invoice_number").focus();
        return false;
    }
    if(invoice_number == ''){
        alert('Please enter invoice number.');
        $("#invoice_number").focus();
        return false;
    }
    if(date_of_issue == ''){
        alert('Please enter date of issue. ');
        $("#date_of_issue").focus();
        return false;
    }
    return true;
}
   
</script>
<?php 

function generatePassword ($length = 8)
  {

    // start with a blank password
    $password = "";

    // define possible characters - any character in this string can be
    // picked for use in the password, so if you want to put vowels back in
    // or add special characters such as exclamation marks, this is where
    // you should do it
    $possible = "2346789bcdfghjkmnpqrtvwxyzBCDFGHJKLMNPQRTVWXYZ";

    // we refer to the length of $possible a few times, so let's grab it now
    $maxlength = strlen($possible);
  
    // check for length overflow and truncate if necessary
    if ($length > $maxlength) {
      $length = $maxlength;
    }
	
    // set up a counter for how many characters are in the password so far
    $i = 0; 
    
    // add random characters to $password until $length is reached
    while ($i < $length) { 

      // pick a random character from the possible ones
      $char = substr($possible, mt_rand(0, $maxlength-1), 1);
        
      // have we already used this character in $password?
      if (!strstr($password, $char)) { 
        // no, so it's OK to add it onto the end of whatever we've already got...
        $password .= $char;
        // ... and increase the counter by one
        $i++;
      }

    }

    // done!
    return $password;

  }
// function get max id of invoices table 
$q = "select MAX(invoice_number) from invoices";
$result_max = mysql_query($q);
$data = mysql_fetch_array($result_max);
if(!$data || $data[0]<61245){
    $invoice_id = '61245';
}  else {
    $invoice_id = $data[0] + 1;
}

if($_POST['firstname1'] && isset($_REQUEST['update'])){
    	
	/*echo '<pre>';	
	print_r($_REQUEST);
	echo '</pre>';*/
   // $_REQUEST = array_map('strip_javascript_input',$_REQUEST);		
    $_SESSION['firstname']  = sc_mysql_escape($_REQUEST['firstname1']);
    $_SESSION['lastname']   = sc_mysql_escape($_REQUEST['lastname1']);
    $_SESSION['companyname']= sc_mysql_escape($_REQUEST['companyname1']);
    $_SESSION['street']     = sc_mysql_escape($_REQUEST['street1']);
    $_SESSION['street2']    = sc_mysql_escape($_REQUEST['street21']);
    $_SESSION['city']       = sc_mysql_escape($_REQUEST['city1']);
    $_SESSION['country']    = sc_mysql_escape($_REQUEST['country1']);
    $_SESSION['zip']        = sc_mysql_escape($_REQUEST['zip1']);
    $_SESSION['phone']      = sc_mysql_escape($_REQUEST['phone1']);
    $state                  = sc_mysql_escape($_REQUEST['state1']);  
    $_SESSION['email']      = $_REQUEST['email'];
    $_SESSION["state"] = $state;
   // $userid     = $_REQUEST['userid'];
    /*$sql        = 'UPDATE customers SET firstname="'.$firstname.'", lastname="'.$lastname.'",companyname="'.$companyname.'", street="'.$street.'",
                         street2="'.$street2.'", city ="'.$city.'", country = "'.$country.'",
                         zip = "'.$zip.'",phone = "'.$phone.'",
                         state = "'.$state.'",
                         email = "'.$email.'"    
                         WHERE id = "'.$_REQUEST["customer_id"].'"                            
                     ';	
                    
    mysql_query($sql);*/
    
    
}
if($_REQUEST['save'] == 'Save Draft')
{
   // process insert to invoice table
    $invoice_number = $_REQUEST['invoice_number'];
    $date_of_issue  = $_REQUEST['date_of_issue'];
    $po_number      = $_REQUEST['po_number'];
   // $discount       = $_REQUEST['discount'];
    $customer_id    = $_REQUEST['customer_id'];
    $internal_note  = sc_mysql_escape($_REQUEST['internal_note']);
    $note_visible_to_client = sc_mysql_escape($_REQUEST['note_visible_to_client']);
    
    $firstname  = sc_mysql_escape($_REQUEST['firstname1']);
    $lastname   = sc_mysql_escape($_REQUEST['lastname1']);
    $companyname= sc_mysql_escape($_REQUEST['companyname1']);
    $street     = sc_mysql_escape($_REQUEST['street1']);
    $street2    =sc_mysql_escape($_REQUEST['street21']);
    $city       = sc_mysql_escape($_REQUEST['city1']);
    $country    = $_REQUEST['country1'];
    $zip        = $_REQUEST['zip1'];
    $phone      = $_REQUEST['phone1'];
    $state      = $_REQUEST['state1'];  
    $_SESSION["state"] = $state;
    $email      = $_REQUEST['email'];
    $rand_code = generatePassword(64); 
    if(isset($_REQUEST['remove_tax'])){
        $remove_tax = $_REQUEST['remove_tax'];
    }else{
        $remove_tax  = 0;
    }
   
    
    $sql_invoice    = "INSERT INTO invoices(`invoice_number`,`data_of_issue`,`po_number`,
                                    `customer_id`,`internal_note`,`note_visible_to_client`,
                                     `firstname`,`lastname`,`companyname`,`address`,`address2`,
                                     `city`,`country`,`state`,`zip`,`phone`,`rand_code`,
                                      `email`,`remove_tax`,`sale_id`  
                        )
                        VALUES('{$invoice_number}','{$date_of_issue}','{$po_number}','{$customer_id}',
                        '{$internal_note}','{$note_visible_to_client}','{$firstname}','{$lastname}','{$companyname}','{$street}','{$street2}',
                        '{$city}','{$country}','{$state}','{$zip}','{$phone}','{$rand_code}','{$email}','{$remove_tax}','{$_SESSION["loginid"]}')";   
    mysql_query($sql_invoice);                    
    
    // insert items for invoice.
    // +> get id of invoice to insert items.
    $max_id_invoice = mysql_insert_id();    
    $i=0;
   // $total_item = 0;
    if(!empty($_REQUEST['item'])){
        foreach($_REQUEST['item'] as $item){
            $query = "INSERT INTO item_invoice(`item`,`description`,`unit_cost`,`qty`,`total`,`invoice_id`) VALUES('{$item}','{$_REQUEST['description'][$i]}','{$_REQUEST['unitcode'][$i]}','{$_REQUEST['qty'][$i]}','{$_REQUEST['total'][$i]}','{$max_id_invoice}')";
            mysql_query($query);               
            $i++;
        }
    }
?>
<script language="javascript">
parent.parent.location.href='admin_view_invoice.php?invoice_id=<?php echo $max_id_invoice;?>&customer_id=<?php echo $customer_id;?>';
window.close();
</script>
<?php
}

?>

<?php 
if(isset($_REQUEST['update'])){
    $show = 'block';
    $edit = 'none';
}else{
    $show = 'none';
    $edit = 'block';
}
?>
<style>
    #table_item .border_item, #table_item{
        border: 1px solid #E0E0E0!important;
        border-collapse: collapse;
    }
    #inputsTable td{
        border-bottom: 1px solid #E0E0E0!important;
        border-right: 1px solid #E0E0E0!important;
        border-collapse: collapse;
        padding: 2px;
    }
    
#promo_ask{
    display: block;
}
#promo_show{
    display:none;
}
#edit_address{
    display: <?php echo $edit;?>;
    padding-left: 10px;
}
#show_address{
    width: 150px;
    float: left; 
    padding-left: 10px;
    display: <?php echo $show;?>;
}
</style>

</head>
<body>
	
	<div align="center">
		<?php include("header.php"); ?>
		<div class="xgrid">
		<div style="min-height: 300px;" class="portlet x12">
		<div class="portlet-header"><h4>Create New Invoice</h4></div>			
			<div class="portlet-content" >
				
		<div style="margin-top: 0px;">
		
         <form action="" name="add_invoice" method="post" onsubmit ="return check_valid(); ">
             <input type="hidden" name="customer_id" value="<?php echo $customer_id?>" />
             <table width="800" frame="box" border="0" align="center" id="table_item" style="border:none!important;" cellpadding="0" cellspacing="0">							
                  <tr>                    
                    <td colspan="7" algin="right"><div style="float: right; padding-right: 15px;"><a href="admin_list_invoice.php?customerid=<?php echo $customer_id;?>">View Invoices</a></div></td>
                </tr>
				<tr>
					<td colspan="2"><a href="customer_view_admin.php?customerid=<?php echo $customers["custid"]; ?>"><strong><?php echo $customers["companyname"]."<br>".$customers["firstname"]." ".$customers["lastname"]; ?></strong></a><br /><?php echo $customers["street"]; ?><?php if ($customers["street2"]) { echo "<br>".$customers["street2"]; } ?><br /><?php echo $customers["city"].", ".$customers["state"]." ".$customers["zipcode"]; ?></td>
					<td colspan="4" align="right"><strong><?php echo $customers["email"]."<br>".$customers["phone"]; ?></strong></td>
				</tr>
				<tr style="height: 30px; background-color: #CCC;">
					<td class="fieltable"  colspan="6" style="padding-left: 20px;"> <strong> NEW ORDER </strong></td>
				</tr>				
				
				<tr>
					<td colspan="2">
						<table>							
							<tr>
							<?php /*
								<td align="right"><strong>Address</strong></td> */?>
								<td>
									 <div>            
                                         <?php                                                                                      
                                            if(isset($_SESSION['firstname']) && isset($_REQUEST['update'])){
                                                $firstname = $_SESSION['firstname'];
                                            }else {
                                                $firstname = $customers["firstname"];
                                            }
                                            if(isset($_SESSION['lastname'])&& isset($_REQUEST['update'])){
                                                $lastname = $_SESSION['lastname'];
                                            }else {
                                                $lastname = $customers["lastname"];
                                            }
                                            if(isset($_SESSION['companyname'])&& isset($_REQUEST['update'])){
                                                $companyname = $_SESSION['companyname'];
                                            }else {
                                                $companyname = $customers["companyname"];
                                            }
                                            if(isset($_SESSION['email'])&& isset($_REQUEST['update'])){
                                                $email = $_SESSION['email'];
                                            }else {
                                                $email = $customers["email"];
                                            }
                                            if(isset($_SESSION['street'])&& isset($_REQUEST['update'])){
                                                $street = $_SESSION['street'];
                                            }else {
                                                $street = $customers["street"];
                                            }
                                            if(isset($_SESSION['street2'])&& isset($_REQUEST['update'])){
                                                $street2 = $_SESSION['street2'];
                                            }else {
                                                $street2 = $customers["street2"];
                                            }
                                            if(isset($_SESSION['city'])&& isset($_REQUEST['update'])){
                                                $city = $_SESSION['city'];
                                            }else {
                                                $city = $customers["city"];
                                            }
                                            if(isset($_SESSION['zip'])&& isset($_REQUEST['update'])){
                                                $zip = $_SESSION['zip'];
                                            }else {
                                                $zip = $customers["zipcode"];
                                            }
                                            if(isset($_SESSION['phone'])&& isset($_REQUEST['update'])){
                                                $phone = $_SESSION['phone'];
                                            }else {
                                                $phone = $customers["phone"];
                                            }
                                          ?>
                                         <div id="show_address">
                                             <strong><?php echo $companyname;?></strong> <br />
                                             <strong><?php echo $firstname;?>  <?php echo $lastname; ?></strong> <br />
                                             <?php if(!empty($street)) echo $street.'<br />';?> 
                                             <?php  if(!empty($street2)) echo $street2.' <br />'; ?>
                                             <?php echo $city.' '.$_SESSION['state'].' '.$zip; ?> <br />
                                              <div style="width: 200px;float: left; padding-top: 50px;">
                                                <a id="click_edit" href="javascript:void(0);">Edit Address</a></a>
                                               </div>
                                         </div>
										 <div id="edit_address">						
                                                <table style="width: 100%;">
                                                    <tr>
                                                        <td>First Name:</td>
                                                        <td>
                                                            
                                                            <input type="text" name="firstname1" value="<?php echo $firstname ;?>" style="width: 200px;" class="signupFieldInput" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Last Name:</td>
                                                        <td>
                                                            <input  type="text" name="lastname1" value="<?php echo $lastname;?>" style="width: 200px;" class="signupFieldInput" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Company Name:</td>
                                                        <td>                                                           
                                                            <input  type="text" name="companyname1" value="<?php echo $companyname;?>" style="width: 200px;" class="signupFieldInput" />
                                                        </td>
                                                    </tr>
                                                     <tr>
                                                        <td>Email: </td>
                                                        <td>                                                           
                                                            <input type="text" name="email" value="<?php echo $email;?>"/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Address:</td>
                                                        <td>                                                           
                                                            <input  type="text" name="street1" value="<?php echo $street;?>" style="width: 200px;" class="signupFieldInput" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Address2:</td>
                                                        <td>
                                                              
                                                            <input type="text" name="street21" value="<?php echo $street2;?>" style="width: 200px;" class="signupFieldInput" />
                                                        </td>
                                                    </tr>
                                                    <td align="left"><strong>Address</strong></td>
                                                    <tr>
                                                        <td>City: </td>
                                                        <td>                                                           
                                                            <input type="text" name="city1" value="<?php echo $city;?>" style="width: 200px;" class="signupFieldInput" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Country: </td>
                                                        <td>
                                                            <select  name="country1" class="signupFieldInput" style="height: 30px;" onChange="changestatediv1(this.value);">
                                                                <option <?php if($_SESSION['country']=='US'){echo 'selected="selected"';}?> value="US">United States</option>
                                                                <option <?php if($_SESSION['country']=='CA'){echo 'selected="selected"';}?> value="CA">Canada</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><div id="stateprov1">State: </div></td>
                                                        <td>		
                                                                <input type="hidden" value="0" name="state_submit" id="state_submit" />                          
                                                                <select id="state1" name="state1">
                                                                </select>												       
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Zip: </td>
                                                        <td>                                                            
                                                            <input type="text" name="zip1" value="<?php echo $zip;?>" maxlength="5" style="width: 50px;" class="signupFieldInput" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Phone: </td>
                                                        <td>                                                           
                                                            <input  type="text" name="phone1" value="<?php echo $phone;?>" style="width: 200px;" class="signupFieldInput" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td align="center">
                                                            <input class="btn btn-small" style="font-size:13px;" type="submit" name="update" value="Update"  />
                                                        </td>
                                                        <td align="center">
                                                            <input type="button" style="font-size:13px;" class="btn btn-small" value="Cancel" id="click_cancel" />
                                                        </td>
                                                    </tr>
                                                </table>
										  </div> 
										  <div style="clear:both;"></div>			
										  
									  </div>  
								</td>
							</tr>
						</table>	
					</td>
					<td colspan="4" algin="right">
						<div style="float:right">
							<table>		
								<tr><td></td></tr>
								<tr><td></td></tr>
								<tr><td></td></tr>
								<tr><td></td></tr>
								<tr><td></td></tr>
								<tr><td></td></tr>									
								<tr>
									<td align="right"> <strong>Invoice Number</strong> <font color="red">*</font></td>
                                    <td><input type="text" name="invoice_number" readonly id="invoice_number" value="<?php echo $invoice_id;?>"/></td>
								</tr>
								<tr>
									<td align="right"> <strong>Date of Issue </strong><font color="red">*</font></td>
									<td>
										<input type="text" name="date_of_issue" value="<?php echo date('m/d/Y');?>" id="date_of_issue"/>
										<img src="calendar/img.gif" id="f_trigger_c"
											style="cursor: pointer; border: 1px solid red;"
											title="Date selector" />
	
									</td>
								</tr>
								<script type="text/javascript">
									Calendar.setup({
										inputField:"date_of_issue",
										ifFormat:"%m/%d/%Y",
										button:"f_trigger_c",
										align:"Tl",
										singleClick:false
									});
								</script>
								<tr>
									<td align="right"><strong> PO Number</strong></td>
									<td><input type="text" name="po_number" value=""/></td>
								</tr>
								
                                <tr>
                                    <td align="right"><strong>Remove tax</strong></td>
                                    <td><input type="checkbox" name="remove_tax" value="1" /></td>
                                </tr>
									
							</table>
						</div>		
					</td>
				</tr>
				<?php /*
				<tr>
					<td colspan="6"  style="margin-top: 40px;"><div style="height: 30px;"></div></td>
				</tr>
				*/?>
                <tr class="border_item">
					<td class="fieltable" align="center" style="width: 220px;"><strong>Item</strong></td>
					<td class="fieltable" align="center" style="width: 220px;"><strong>Description</strong></td>
					<td class="fieltable" align="center" style="width: 60px;"><strong>Unit Cost</strong></td>
					<td class="fieltable" align="center" style="width: 60px;"><strong>Qty</strong></td>					
					<td class="fieltable" align="center" style="width: 60px;"><strong>Line Total</strong></td>
                    <td class="fieltable" style="width: 60px;"></td>
				</tr>
                <tr class="border_item" style="border-bottom:none!important">
                    <td colspan="7">
                        <table width="100%" id="inputsTable" cellpadding="0" cellspacing="0">                           
                        </table>
                    </td>
                </tr>     
				<tr>
					<td colspan="6"><input style="margin-top: 5px;" type="button" value="Add Line" class="add_line" name="addline" onClick=" moreInput();return false;" /></td>
				</tr>
				
                <tr>
                    <td colspan="7" height="50"></td>
                </tr>    
				<tr>
					<td colspan="3"><strong>Internal Notes:</strong></td>
					<td colspan="3" align="right"><strong>Notes Visible to Client</strong></td>
				</tr>
				<tr>
					<td colspan="3">
						<textarea name="internal_note" cols="30" rows="5"></textarea>
					</td>
					<td colspan="3" align="right">
						<textarea name="note_visible_to_client" cols="30" rows="5"></textarea>
					</td>
				</tr>
                 <tr>
                    <td colspan="7" height="50"></td>
                </tr>
				<tr>
					<td><input type="submit"  value="Save Draft" name="save" id="save" class="save_sent_button"><br /><div style="padding-top: 20px;">Save updates made to this invoice</div></td>
					<td><!-- <input type="submit"  value="Sent by Email" name="sentemail" id="sentemail" class="save_sent_button"><br /><span>Email this invoice to your client</span> --></td>
				</tr>
			
			</table>
        </form>     
		</div>
		<div style="height: 50px;"> &nbsp;</div>
	</div>
</div></div></div>
<script language="javascript">    
    changestatediv1("<?php echo $_SESSION['country'];?>");
</script>

</body>
</html>
