<?php
require_once('conn/DB.php');
include('conn/tablefuncs.php');
include('../include/config.php');
mysql_select_db($database_DB, $ravcodb);
session_start();
//if (!$_SESSION["loginid"] || $_SESSION["userlevel"] < 2)
if (!$_SESSION["loginid"])
{?>
<script language="javascript">
parent.parent.location.href='admin.php';
window.close();
</script>
<?php 
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Best Name Badges - Content Management System</title>
<?php include("init_top.php");?>
<link href="<?php echo $base_url;?>/admin/includes/cms.css" rel="stylesheet" type="text/css" />
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
     .public_button{
		background: url('images/gray_btn.gif') no-repeat top center;
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
   // alert(total);
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
                    "<td align=\"center\"><input type=\"text\" style=\"width:180px;\"  value=\"\" class=\"input-text\"  name=\"item[]\" id=\"item"+ countInput +"\" /></td>"+
                    "<td align=\"center\"><input type=\"text\" style=\"width: 200px;\" value=\"\" class=\"input-text\"  name=\"description[]\" id=\"description"+ countInput +"\" /></td>"+
                    "<td align=\"center\"><input type=\"text\" style=\"width: 60px;\" value=\"\" class=\"input-text\" onchange=\"cal_total("+countInput+")\"  name=\"unitcode[]\" id=\"unitcode"+ countInput +"\" /></td>"+
                    "<td align=\"center\"><input type=\"text\" style=\"width: 60px;\" value=\"\" class=\"input-text\" onchange=\"cal_total("+countInput+")\"  name=\"qty[]\" id=\"qty"+ countInput +"\" /></td>"+                   
                    "<td align=\"center\"><input type=\"text\" style=\"width: 60px;\" value=\"\" class=\"input-text\"  name=\"total[]\" id=\"total"+ countInput +"\" /></td>"+
                     "<td style=\"border-right:none!important;\" align=\"center\"><a href=\"#\" onclick=\"$(this).parent().parent().fadeOut('fast', function(){$(this).remove();}); countInput--; return false;\" style=\"padding-right: 7px; color: red;\">Delete</a></td>"+
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
function formatMoney($number, $cents = 2) { // cents: 0=never, 1=if needed, 2=always
  if (is_numeric($number)) { // a number
    if (!$number) { // zero
      $money = ($cents == 2 ? '0.00' : '0'); // output zero
    } else { // value
      if (floor($number) == $number) { // whole number
        $money = number_format($number, ($cents == 2 ? 2 : 0)); // format
      } else { // cents
        $money = number_format(round($number, 2), ($cents == 0 ? 0 : 2)); // format
      } // integer or decimal
    } // value
    return '$'.$money;
  } // numeric
} // formatMoney
$invoice_id  = $_REQUEST['invoice_id'];
$sql_detail  = "SELECT * FROM invoices WHERE id='{$invoice_id}'";
$result_detail = mysql_query($sql_detail);
if($result_detail){
    $row_detail  = mysql_fetch_array($result_detail);
}else {
    $row_detail = array();
}   
$_SESSION['state'] = $row_detail['state'];
if(isset($_REQUEST['country1'])){
    $_SESSION['country'] = $_REQUEST['country1'];
}else {
    $_SESSION['country'] = $row_detail["country"];
}


if($_REQUEST['del_item'] == 1){
    $customer_id    = $_REQUEST['customer_id'];
    $invoice_id     = $_REQUEST['invoice_id'];
    
    $item_id = $_REQUEST['item_id']; 
    //get total of item 
    $sql_total = "SELECT total FROM item_invoice WHERE id=".$item_id;
    $result_total = mysql_query($sql_total);
    $row_total = mysql_fetch_array($result_total);
    $total = $row_total['total'];
    
    $sql_delete_item = "DELETE FROM item_invoice WHERE id='{$item_id}'";   
    mysql_query($sql_delete_item);
    ?>
    <script language="javascript">
        parent.parent.location.href='admin_edit_invoice.php?customer_id=<?php echo $customer_id?>&invoice_id=<?php echo $invoice_id; ?>';
        window.close();
    </script>
<?php
   // die();
}

if($_REQUEST['sentemail']){  
        $invoice_id = $_REQUEST['invoice_id'];
        //echo $invoice_id;
        $rand_code = rand();
		$message = $base_url.'/invoice.php?code='.$rand_code;	
        //echo $message;
		//mail('caffeinated@example.com', 'My Subject', $message);
        //mail('hien.nguyenvan@citigo.net', 'New Invoice for you', $message);
}
if($_REQUEST['Publish']){
    $invoice_id  = $_REQUEST['invoice_id'];   
    $customer_id = $_REQUEST['customer_id'];
    $invoice_id  = $_REQUEST['invoice_id'];
    $pub_value   = $_REQUEST['pub_value'];
    $sql_public  = "UPDATE invoices SET  is_client_public = '".$pub_value."' WHERE id={$invoice_id}";        
    mysql_query($sql_public);
?>
<script>
     parent.parent.location.href='admin_edit_invoice.php?customer_id=<?php echo $customer_id?>&invoice_id=<?php echo $invoice_id; ?>';       // window.close();
        
</script>
<?php
}
// get list item
$sql_item = "SELECT * FROM item_invoice WHERE invoice_id='{$invoice_id}'";
$result_item = mysql_query($sql_item);
if($result_item){
    $item_list = array();
    while($row  = mysql_fetch_assoc($result_item)){
        $item_list[] = $row;
    }
}else{
    $item_list = array();
}
//echo '<pre>'.print_r($item_list).'</pre>';
if($_POST['firstname1'] && isset($_REQUEST['update'])){				
    $firstname  = sc_mysql_escape($_REQUEST['firstname1']);
    $lastname   = sc_mysql_escape($_REQUEST['lastname1']);
    $companyname= sc_mysql_escape($_REQUEST['companyname1']);
    $street     = sc_mysql_escape($_REQUEST['street1']);
    $street2    = sc_mysql_escape($_REQUEST['street21']);
    $city       = $_REQUEST['city1'];
    $country    = $_REQUEST['country1'];
    $zip        = $_REQUEST['zip1'];
    $phone      = $_REQUEST['phone1'];
    $state      = $_REQUEST['state1'];  
    $email      = $_REQUEST['email'];
    //$_SESSION["state"] = $_REQUEST['state1'];  
    $_SESSION["state"] = $state;
   // $userid     = $_REQUEST['userid'];
    $sql        = 'UPDATE invoices SET firstname="'.$firstname.'", lastname="'.$lastname.'",companyname="'.$companyname.'", address="'.$street.'",
                         address2="'.$street2.'", city ="'.$city.'", country = "'.$country.'",
                         zip = "'.$zip.'",phone = "'.$phone.'",
                         state = "'.$state.'",email = "'.$email.'"
                         WHERE id = "'.$_REQUEST["invoice_id"].'"                            
                     ';	             

    mysql_query($sql);
 
?>
<script language="javascript">
        parent.parent.location.href='';
</script>
<?php
}
if($_REQUEST['save'] == 'Save Draft')
{	
    $invoice_id = $_REQUEST['invoice_id'];     
   // process insert to invoice table
    $invoice_number = $_REQUEST['invoice_number'];
    $date_of_issue  = $_REQUEST['date_of_issue'];
    $po_number      = $_REQUEST['po_number'];
    //$discount       = $_REQUEST['discount'];
    $customer_id    = $_REQUEST['customer_id'];
    $internal_note  = sc_mysql_escape($_REQUEST['internal_note']);
    $note_visible_to_client = sc_mysql_escape($_REQUEST['note_visible_to_client']);
    $firstname  = $_REQUEST['firstname1'];
    $lastname   = $_REQUEST['lastname1'];
    $companyname= sc_mysql_escape($_REQUEST['companyname1']);
    $street     = $_REQUEST['street1'];
    $street2    = $_REQUEST['street21'];
    $city       = $_REQUEST['city1'];
    $country    = $_REQUEST['country1'];
    $zip        = $_REQUEST['zip1'];
    $phone      = $_REQUEST['phone1'];
    $state      = $_REQUEST['state1'];  
    $email      = $_REQUEST['email'];
    $_SESSION["state"] = $state;
    if(isset($_REQUEST['remove_tax'])){
        $remove_tax = $_REQUEST['remove_tax'];
    }else{
        $remove_tax  = 0;
    }
    $sql_invoice    = "UPDATE invoices SET invoice_number='{$invoice_number}',data_of_issue='{$date_of_issue}',
                        po_number='{$po_number}',customer_id= '{$customer_id}',internal_note='{$internal_note}',note_visible_to_client='{$note_visible_to_client}',
                        firstname = '{$firstname}',lastname='{$lastname}',companyname = '{$companyname}', address = '{$street}',
                        address2 = '{$street2}',city='{$city}',country='{$country}',zip='{$zip}',phone = '{$phone}',
                        state = '{$state}',email = '{$email}',
                        remove_tax = '{$remove_tax}'
                        WHERE id='{$invoice_id}'";
                 
    mysql_query($sql_invoice);                    
   
    // insert items for invoice.
    // +> get id of invoice to insert items.
    
    $i=0;
    if(!empty ($_REQUEST['item'])){
        if(!empty ($_REQUEST['item'])){      
            foreach($_REQUEST['item'] as $item){
                $query = "INSERT INTO item_invoice(`item`,`description`,`unit_cost`,`qty`,`total`,`invoice_id`) VALUES('{$item}','{$_REQUEST['description'][$i]}','{$_REQUEST['unitcode'][$i]}','{$_REQUEST['qty'][$i]}','{$_REQUEST['total'][$i]}','{$invoice_id}')";
                mysql_query($query);                  
                $i++;
            }
       }
    }
   ?>
    <script language="javascript">
        parent.parent.location.href='admin_edit_invoice.php?customer_id=<?php echo $customer_id?>&invoice_id=<?php echo $invoice_id; ?>';
        window.close();
    </script>
<?php   
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
    .table_item tr:first-child td{
        border-top: 1px solid #E0E0E0!important;
        border-collapse: collapse;
        padding:2px 0;
    }
</style>
<script>
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

</script>
</head>
<body>
	<div align="center">
		<?php include("header.php"); ?>		
		<div class="xgrid">
		<div style="min-height: 300px;" class="portlet x12">
		<div class="portlet-header"><h4>Edit Draft</h4></div>			
			<div class="portlet-content" >
		<div style="margin-top: 00px;">
		<?php 	
		$customer_id = $_REQUEST['customer_id'];
		$qry = "SELECT  customers.id AS custid, customers.firstname AS firstname, customers.lastname AS lastname, customers.companyname AS companyname, customers.street, customers.street2, customers.city, customers.state, customers.zip AS zipcode, customers.email, customers.phone FROM customers WHERE customers.id ='{$customer_id}'";
		$customers_result = mysql_query($qry) or die('Query failed: ' . mysql_error()); 
		$customers = mysql_fetch_assoc($customers_result); 
		//echo '<pre>'.print_r($customers).'</pre>';		
		?>
         <form action="" name="add_invoice" method="post" onsubmit ="return check_valid(); ">
             
            <input type="hidden" value="<?php echo $invoice_id;?>" name="invoice_id" />
			<table width="800" frame="box" border="0" align="center" id="table_item" style="border:none!important;" cellpadding="0" cellspacing="0">							
                <tr>                    
                    <td colspan="7" algin="right"><div style="float: right; padding-right: 15px;"><a href="admin_list_invoice.php?customerid=<?php echo $customer_id;?>">View Invoices</a></div></td>
                </tr>
				<tr>
					<td colspan="2"><a href="customer_view_admin.php?customerid=<?php echo $customers["custid"]; ?>"><strong><?php echo $customers["companyname"]."<br>".$customers["firstname"]." ".$customers["lastname"]; ?></strong></a><br /><?php echo $customers["street"]; ?><?php if ($customers["street2"]) { echo "<br>".$customers["street2"]; } ?><br /><?php echo $customers["city"].", ".$customers["state"]." ".$customers["zipcode"]; ?></td>
					<td colspan="4" align="right"><strong><?php echo $customers["email"]."<br>".$customers["phone"]; ?></strong></td>
				</tr>
				<tr  style="height: 30px; background-color: #CCC;">
					<td class="fieltable"  colspan="6" style="padding-left: 20px;"> <strong> EDIT ORDER </strong></td>
				</tr>
				
				<input type="hidden" name="customer_id" value="<?php echo $customer_id?>" />
				<tr>
					<td colspan="2">
						<table>
							<tr>
								<td align="right"><strong>Address</strong></td>
								<td>
									 <div>
            
										   <div  id="show_address" style="width: 150px;float: left; padding-left: 10px;">
										   
										    <?php
										    	$qry_info = "SELECT * FROM invoices WHERE id = ".$invoice_id;
												$customers_info = mysql_query($qry_info) or die('Query failed: ' . mysql_error()); 
												$customer_info = mysql_fetch_assoc($customers_info);                
				
										     ?>
										     <strong><?php echo $customer_info['companyname'];?></strong> <br />
										     <strong><?php echo $customer_info['firstname'];?>  <?php echo $customer_info['lastname']; ?></strong> <br />
										     <?php if(!empty($customer_info['address'])) echo $customer_info['address'].'<br />';?> 
										     <?php  if(!empty($customer_info['address2'])) echo $customer_info['address2'].' <br />'; ?>
										     <?php echo $customer_info['city'].' '.$customer_info['state'].' '.$customer_info['zip']; ?> <br />
										   </div> 
										    <div id="edit_address">						
											<table style="width: 100%;">
											    <tr>
												<td>First Name:</td>
												<td><input type="text" name="firstname1" value="<?php echo $customer_info["firstname"]; ?>" style="width: 200px;" class="signupFieldInput" /></td>
											    </tr>
											    <tr>
												<td>Last Name:</td>
												<td><input  type="text" name="lastname1" value="<?php echo $customer_info["lastname"]; ?>" style="width: 200px;" class="signupFieldInput" /></td>
											    </tr>
											    <tr>
												<td>Company Name:</td>
												<td><input  type="text" name="companyname1" value="<?php echo $customer_info["companyname"]; ?>" style="width: 200px;" class="signupFieldInput" /></td>
											    </tr>
                                                <tr>
                                                    <td>Email: </td>
                                                    <td><input type="text" name="email" value="<?php echo $customer_info["email"]; ?>"</td>
                                                </tr>
											    <tr>
												<td>Address:</td>
												<td><input  type="text" name="street1" value="<?php if(!empty($customer_info["address"])) echo $customer_info["address"]; ?>" style="width: 200px;" class="signupFieldInput" /></td>
											    </tr>
											    <tr>
												<td>Address2:</td>
												<td><input type="text" name="street21" value="<?php echo $customer_info["address2"]; ?>" style="width: 200px;" class="signupFieldInput" /></td>
											    </tr>
											    <tr>
												<td>City: </td>
												<td><input type="text" name="city1" value="<?php echo $customer_info["city"]; ?>" style="width: 200px;" class="signupFieldInput" /></td>
											    </tr>
											    <tr>
												<td>Country: </td>
												<td>
												    <select  name="country1" class="signupFieldInput" style="height: 20px;" onChange="changestatediv1(this.value);">
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
												<td><input type="text" name="zip1" value="<?php echo $customer_info['zip']; ?>" style="width: 100px;" class="signupFieldInput" /></td>
											    </tr>
											    <tr>
												<td>Phone: </td>
												<td><input  type="text" name="phone1" value="<?php echo $customer_info['phone']; ?>" style="width: 200px;" class="signupFieldInput" /></td>
											    </tr>
											    <tr>
												<td align="center">
												    <input type="submit" name="update" value="Update"  />
												</td>
												<td align="center">
													<input type="button" value="Cancel" id="click_cancel" />
												</td>
											    </tr>
											</table>
										   </div> 
										  <div style="clear:both;"></div>			
										   <div id="link_edit" style="width: 200px;float: left; padding-top: 50px;">
										    <a id="click_edit" href="javascript:void(0);">Edit Address</a></a>
										   </div>
									      </div>  
								</td>
							</tr>
						</table>	
					</td>
					<td colspan="4" algin="right">
						<div style="float:right">
							<table>			
								<tr>
									<td align="right"> <strong>Invoice Number</strong> <font color="red">*</font></td>
                                    <td><input type="text" name="invoice_number" readonly id="invoice_number" value="<?php echo $row_detail['id']; ?>"/></td>
								</tr>
								<tr>
									<td align="right"> <strong>Date of Issue </strong><font color="red">*</font></td>
									<td>
                                        <?php
                                            //echo '<pre>'.print_r($row_detail).'</pre>';
                                            //echo $row_detail['data_of_issue'];?>
										<input type="text" name="date_of_issue" value="<?php echo $row_detail[2]; ?>" id="date_of_issue"/>
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
									<td><input type="text" name="po_number" value="<?php echo $row_detail['po_number']; ?>"/></td>
								</tr>
								
								<tr>
                                    <td align="right"><strong>Remove tax</strong></td>
                                    <td>
                                            <?php 
                                            if($row_detail['remove_tax']==1){
                                                $check = 'checked';
                                            }else {
                                                 $check = '';
                                            }
                                            ?>
                                            <input <?php echo $check;?> type="checkbox" name="remove_tax" value="1" />
                                    </td>
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
                    <td colspan="7" style="padding:0;">
                        <table class="table_item" width="100%" border="0" cellpadding="0" cellspacing="0">
                            <tr style="border-top: 1px solid #E0E0E0;">
                                <td class="fieltable" align="center" width="300"><strong>Item</strong></td>
                                <td class="fieltable" align="center" width="450"><strong>Description</strong></td>
                                <td class="fieltable" align="center" width="100"><strong>Unit Cost</strong></td>
                                <td class="fieltable" align="center" width="180"><strong>Qty</strong></td>                                
                                <td class="fieltable" align="center" width="100"><strong>Line Total</strong></td>
                                <td class="fieltable" ></td>
                            </tr>
                        </table>
                    </td>
				</tr>
				
                <tr class="border_item" style="border-bottom:none!important">
                    <td colspan="7">
                        <table width="100%" id="inputsTable" cellpadding="0" cellspacing="0">
                           <?php
                           $total = 0;
                            foreach($item_list as $item){
                                $total_item = str_replace(',','',$item['total']);
                                $total = $total + $total_item; 
                            ?>
                            <tr>
                                <td align="center" style="width: 190px;"><?php echo $item['item']?></td>
                                <td align="center" style="width: 220px;"><?php echo $item['description']?></td>
                                <td align="center" style="width: 100px;">$<?php echo $item['unit_cost']?></td>
                                <td align="center" style="width: 100px;"><?php echo $item['qty']?></td>
                                
                                <td style="background-color: #F0F0F0 !important;width: 85px;" align="center" style="width: 80px;">$<?php echo $item['total'];?></td>
                                <td align="center" style="border-right:none!important;">
                                        <a href="admin_edit_invoice.php?customer_id=<?php echo $customer_id;?>&invoice_id=<?php echo $invoice_id;?>&del_item=1&item_id=<?php echo $item['id'];?>"><font color="red">Delete</font></a>
                                         | 
                                         <a onClick="return GB_showCenter('Edit Item', this.href,400,340);" href="admin_edit_item.php?customer_id=<?php echo $customer_id;?>&invoice_id=<?php echo $invoice_id;?>&item_id=<?php echo $item['id'];?>">Edit</a> 
                                </td>                                
                            </tr>
                            <?php
                            }
                           
                           ?>                            
                        </table>
                    </td>
                </tr> 
                <tr algin="right" style="border: none !important;">
                    <td colspan="7">
                        <table width="100%" cellpadding="0" cellspacing="0">
                            <tr> 
                                <td style="border: none !important;width: 400px;" colspan="4"><input style="margin-top: 5px;" type="button" value="Add Line" class="add_line" name="addline" onClick=" moreInput();return false;" /></td>
                                <td style="border-left: 1px solid #F0F0F0 !important;padding-left: 5px;" algin="left">Invoice Total</td>
                                <td style="border-right: 1px solid #F0F0F0 !important;" colspan="2">
                                    <input type="hidden" name="total_not_discount" id="total_not_discount" value="<?php echo number_format(round($total,2),2,'.',','); ?>"/>
                                    <div style="float: right;padding-right: 5px;" id="total">                                                                               
                                        $<?php                                            
                                        
                                        if ($row_detail["state"] == "FL" && $row_detail["remove_tax"] == '0') { 			
                                            $taxdec = 6/100;
                                            $totaltax = $taxdec * $total;
                                            $total = $taxdec * $total + $total;   
                                            $tax = '<tr><td colspan="4" style="width: 400px;border: none !important;"></td>
                                                    <td style="border-left: 1px solid #F0F0F0 !important;border-bottom: 1px solid #F0F0F0 !important;padding-left: 5px;" algin="left">FL 6% Sales Tax</td>
                                                    <td style="border-right: 1px solid #F0F0F0 !important;border-bottom: 1px solid #F0F0F0 !important;" colspan="2"><div style="float: right;padding-right: 5px;">'.formatMoney($totaltax).'</div></td></tr>'; 
                                        }else {
                                            $taxtotal = 0;
                                            $tax = '<tr><td colspan="4" style="width: 400px;border: none !important;"></td>
                                                    <td style="border-left: 1px solid #F0F0F0 !important;border-bottom: 1px solid #F0F0F0 !important;padding-left: 5px;" algin="left">Sales Tax</td>
                                                    <td style="border-right: 1px solid #F0F0F0 !important;border-bottom: 1px solid #F0F0F0 !important;" colspan="2"><div style="float: right;padding-right: 5px;">N/A</div></td></tr>'; 
                                        }
                                        echo number_format(round($total,2),2,'.',',');
                                        $total_update = round($total,2);
                                        //echo $total_update.'aaaa';
                                        $sql_update = "UPDATE invoices SET total = {$total_update} WHERE id=".$row_detail['id'];
                                        mysql_query($sql_update);
                                        
                                        ?>
                                    </div>
                                </td>
                            </tr>  
                            <?php echo $tax;?>
                            <tr algin="right" style="border: none !important;">
                                <td colspan="4"></td>
                                <td style="border-left: 1px solid #F0F0F0 !important;border-bottom: 1px solid #F0F0F0 !important;padding-left: 5px;" algin="left">
                                    Paid To Date
                                </td>
                                <td style="border-right: 1px solid #F0F0F0 !important;border-bottom: 1px solid #F0F0F0 !important;" colspan="2">
                                    <div style="float: right;padding-right: 5px;" id="paid_to_date">
                                        <?php
                                            echo '$'.number_format(round($row_detail['paid_to_date'],2),2,'.',',');
                                        ?>
                                    </div>
                                </td>
                            </tr>
                            
                            <tr style="border-bottom: 1px #F0F0F0 !important;height: 25px !important;">
                                <td style="border: none !important;" colspan="4"></td>
                                <td style="border-left: 1px solid #F0F0F0 !important;padding-left: 5px;width:90px;background: #F0F0F0 !important;" algin="left">
                                    <strong>Balance (USD)</strong>
                                </td>
                                <td style="border-right: 1px solid #F0F0F0 !important;background: #F0F0F0 !important;" algin="right" colspan="2">
                                    <div style="float: right;padding-right: 5px;" id="blance">                                       
                                        <strong>$<?php $blance = str_replace(',', '',number_format(round($total,2),2,'.',',')) - str_replace(',','', $row_detail['paid_to_date']); echo number_format(round($blance,2),2,'.',',');?></strong>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </td>  
                </tr>  
                <?php /*              
                <tr>
                    <td colspan="7" height="50"></td>
                </tr>
*/?>
				<tr>
					<td colspan="2">
						<strong>Internal Notes:</strong><br/>
                        <textarea name="internal_note" cols="30" rows="5"><?php echo $row_detail['internal_note']; ?></textarea>
					</td>
					<td colspan="3">
						<strong>Notes Visible to Client</strong><br/>
						<textarea name="note_visible_to_client" cols="30" rows="5"><?php echo $row_detail['note_visible_to_client']; ?></textarea>
					</td>
				</tr>
				<?php /*
                <tr>
                    <td colspan="7" height="50"></td>
                </tr>
                */?>
				<tr>
					<td><input type="submit"  value="Save Draft" name="save" id="save" class="save_sent_button"><br /><div style="padding-top: 20px;">Save updates made to this invoice</div></td>
					<td style="padding-left: 50px;">
                        <a href="sent_mail_invoice.php?total=<?php echo number_format(round($blance,2),2,'.',',');?>&invoice_id=<?php echo $row_detail['id'];?>&customer_id=<?php echo $customer_id;?>&url=admin_edit_invoice.php" onClick="return GB_showCenter('Send Mail', this.href,400,500);"><input type="button"  value="Send by Email" name="sentemail" id="sentemail" class="save_sent_button"></a>
                            <br /><div style="padding-top: 20px;">Email this invoice to your client</div>
                    </td>
                   <td style="padding-left: 50px;">
                       
                       <?php if($row_detail['is_client_public']== 'yes'){?>
                        <input type="submit"  value="Already Published" name="Publish" class="save_sent_button"><br /><div style="padding-top: 20px;">&nbsp;</div>
                        <input type="hidden" name="pub_value" value="no" />    
                       <?php }else { ?>    
                        <input type="submit"  value="Publish To Client" name="Publish" class="public_button"><br /><div style="padding-top: 20px;">&nbsp;</div>   
                        <input type="hidden" name="pub_value" value="yes" />    
                       <?php } ?>       
                   </td>  
                  
				</tr>
			
			</table>
        </form>     
		</div>
		<?php // <div style="height: 50px;"> &nbsp;</div>?>
	</div>
<script language="javascript">    
    changestatediv1("<?php echo $_SESSION['country'];?>");
</script>
</body>
</html>