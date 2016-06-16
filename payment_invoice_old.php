<?php
require_once('admin/conn/DB.php');
include('admin/conn/tablefuncs.php');
include('include/config.php');
mysql_select_db($database_DB, $ravcodb);
@session_start();
// end of recalc total of order

$code = $_REQUEST['code'];
$sql = "SELECT * FROM invoices WHERE rand_code='{$code}'";
$result = mysql_query($sql);
if($result){
    $invoice = mysql_fetch_assoc($result);
}  else {
    $invoice  = array();
}

if(empty ($invoice)){
?>
<script>
    location.href='index.php';
</script>
<?php
}
function strip_javascript_input($filter){
  
    // realign javascript href to onclick
    $filter = preg_replace("/href=(['\"]).*?javascript:(.*)?\\1/i", "onclick=' $2 '", $filter);

    //remove javascript from tags
    while( preg_match("/<(.*)?javascript.*?\(.*?((?>[^()]+)|(?R)).*?\)?\)(.*)?>/i", $filter))
        $filter = preg_replace("/<(.*)?javascript.*?\(.*?((?>[^()]+)|(?R)).*?\)?\)(.*)?>/i", "<$1$3$4$5>", $filter);
            
    // dump expressions from contibuted content
    if(0) $filter = preg_replace("/:expression\(.*?((?>[^(.*?)]+)|(?R)).*?\)\)/i", "", $filter);

    while( preg_match("/<(.*)?:expr.*?\(.*?((?>[^()]+)|(?R)).*?\)?\)(.*)?>/i", $filter))
        $filter = preg_replace("/<(.*)?:expr.*?\(.*?((?>[^()]+)|(?R)).*?\)?\)(.*)?>/i", "<$1$3$4$5>", $filter);
       
    // remove all on* events   
    while( preg_match("/<(.*)?\s?on.+?=?\s?.+?(['\"]).*?\\2\s?(.*)?>/i", $filter) )
       $filter = preg_replace("/<(.*)?\s?on.+?=?\s?.+?(['\"]).*?\\2\s?(.*)?>/i", "<$1$3>", $filter);

    return htmlentities(strip_tags($filter));
} 
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

function formatMoney2($number, $cents = 2) { // cents: 0=never, 1=if needed, 2=always
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
    return $money;
  } // numeric
} // formatMoney
unset ($_SESSION["customerloginid"]);
unset ($_SESSION["username"]);        
$_SESSION["customerloginid"] = $invoice['customer_id'];
$sql_customer = "SELECT * FROM customers WHERE id=".$invoice['customer_id'];
$result_customer = mysql_query($sql_customer);
$infor_cus = mysql_fetch_assoc($result_customer);
$_SESSION["username"] = $infor_cus["firstname"]." ".$infor_cus["lastname"];

// calc total of invoices
$sql_total  = "SELECT * FROM item_invoice WHERE invoice_id = '{$invoice['id']}'";
//echo $sql_total;
$result_total = mysql_query($sql_total);
$total_invoice = 0;
$total_compare = 0;
$item  = array();
$qty = array();
if($result_total){                                
    while($row_total = mysql_fetch_assoc($result_total)){
        //echo $row_total['total'].'<br />';
        $item[] = $row_total;
        $qty[] = $row_total['qty'];
        $total_item  = str_replace(',','', $row_total['total']);
        $total_invoice = $total_invoice  + $total_item;
    }
}
$total_no_discount = $total_invoice;
/*$discount = str_replace('%','',$invoice['discount']);
if((int)$discount > 0){

    $total_invoice = $total_invoice  - $total_invoice*$discount/100;
} */
$total_compare = $total_invoice;
//$total_invoice =  number_format(round($total_invoice,2),2,'.',',');
if ($invoice["state"] == "FL" && $invoice["remove_tax"]=='0') { 			
    $taxdec = 6/100;
    $taxtotal = $taxdec * $total_invoice;   
}else {
    $taxtotal = 0;
}

$paid_total = $taxtotal + str_replace(',','',$total_invoice) - str_replace(',','',$invoice['paid_to_date']); 
$total_invoice =  number_format(round($total_invoice,2),2,'.',',');
// process update information of customer 

if($_POST['firstname1']){    
	$_REQUEST = array_map('strip_javascript_input',$_REQUEST);		
    $firstname  = $_REQUEST['firstname1'];
	$lastname   = $_REQUEST['lastname1'];
    $companyname= $_REQUEST['companyname1'];
    $street     = $_REQUEST['street1'];
    $street2    = $_REQUEST['street21'];
    $city       = $_REQUEST['city1'];
    $country    = $_REQUEST['country1'];
    $zip        = $_REQUEST['zip1'];
    $phone      = $_REQUEST['phone1'];
    $state      = $_REQUEST['state1'];  
    $_SESSION["state"] = $state;
    $userid     = $_REQUEST['userid'];
    $sql        = 'UPDATE customers SET firstname="'.$firstname.'", lastname="'.$lastname.'",companyname="'.$companyname.'", street="'.$street.'",
                         street2="'.$street2.'", city ="'.$city.'", country = "'.$country.'",
                         zip = "'.$zip.'",phone = "'.$phone.'",
                         state = "'.$state.'"
                         WHERE id = "'.$_SESSION["customerloginid"].'"                            
                     ';	                    
    mysql_query($sql);
}
if ($_POST["attempt2"])
{
	$_POST = array_map('strip_javascript_input',$_POST);		
	require_once 'braintree/lib/Braintree.php';
	Braintree_Configuration::environment('production');
	Braintree_Configuration::merchantId('952ff2n634sv6zdf');
	Braintree_Configuration::publicKey('8qbw39w6nqhjvzwb');
	Braintree_Configuration::privateKey('vgfjkvmx2rndd9qt');
	
    /*if($_REQUEST['shippingmethod']=='fedex'){
        $sql_fedex1      = "SELECT * FROM fedex_setting";
        $result_fedex1   = mysql_query($sql_fedex1);
        $row_fedex1      = mysql_fetch_assoc($result_fedex1);

        $fedexaccount        = $row_fedex1['fedex_accountno'];
        $fedexmeterno        = $row_fedex1['fedex_meternum'];
        $fedexService        = $row_fedex1['fedex_service'];
        $fedexServicename    = $row_fedex1['fedex_servicename'];
        $fedexpacking        = $row_fedex1['fedex_packe']; 
        $fedexdroptype       = $row_fedex1['fedex_type'];
        $fedex = new Fedex;
        $fedex->setServer("https://gatewaybeta.fedex.com/GatewayDC");
        $fedex->setAccountNumber($fedexaccount); //Get your own - this will not work...
        $fedex->setMeterNumber($fedexmeterno);    //Get your own - this will not work...
        $fedex->setCarrierCode("FDXE");
        $fedex->setDropoffType($fedexdroptype);
        $fedex->setService($fedexService, $fedexServicename );
        $fedex->setPackaging($fedexpacking);
        $fedex->setWeightUnits("LBS");
        $weidght =  round($_POST["totalbadges"]/30);
        if($weidght < 1){
            $weidght = 1;
        } 
        $fedex->setWeight($weidght);
        $fedex->setOriginStateOrProvinceCode($row_fedex['state']);
        $fedex->setOriginPostalCode($row_fedex['postalcode']);
        $fedex->setOriginCountryCode($row_fedex['countrycode']);
        $fedex->setDestStateOrProvinceCode($_REQUEST['state']);
        $fedex->setDestPostalCode($_REQUEST['zip']);
        $fedex->setDestCountryCode($_REQUEST['country']);
        $fedex->setPayorType("SENDER");
        
        $price = $fedex->getPrice();
        if(isset($price->price->rate)){
            $fedexfee            = $price->price->rate;
        }else{
            $fedexfee = 0;
        }    
    }else {
        $fedexfee = 0;
    }*/
   
	$result = Braintree_Transaction::sale(array(
  	//'amount' => $_POST["total"] + $fedexfee,
	'amount' =>  round($_SESSION['total'],2),
  	'creditCard' => array(
    'number' => $_POST["creditCardNumber"],
    'expirationDate' => $_POST["expDateMonth"]."/".$_POST["expDateYear"],
	'cardholderName' => $_POST["firstname"]." ".$_POST["lastname"],
	'cvv' => $_POST["cvv2Number"]
  	),
	'billing' => array(
    'firstName' => $_POST["firstname"],
    'lastName' => $_POST["lastname"],
    'streetAddress' => $_POST["street"],
    'extendedAddress' => $_POST["street2"],
    'locality' => $_POST["city"],
    'region' => $_POST["state"],
    'postalCode' => $_POST["zip"],
    'countryCodeAlpha2' => $_POST["country"]
	),
	'options' => array(
    'submitForSettlement' => true
  	)
	));
	
	if ($result->success) {
        $code = $_REQUEST['code'];
        $sql = "SELECT * FROM invoices WHERE rand_code='{$code}'";
        $result = mysql_query($sql);
        if($result){
            $invoice = mysql_fetch_assoc($result);
        }  else {
            $invoice  = array();
        }
      
		
		$invoice_id = $invoice['id'];
        $total_paid  = round(str_replace(',','',$_SESSION['total']),2);
        // process update paid to date in invoice.
        $sql_invoice = "UPDATE invoices SET paid_to_date=paid_to_date + {$total_paid} WHERE id={$invoice_id}";
        
        mysql_query($sql_invoice);
        // end of paid to date
		$qry = "SELECT * FROM customers WHERE id = ".$_SESSION["customerloginid"];
		$customers = mysql_query($qry) or die('Query failed: ' . mysql_error()); 
		$customer = mysql_fetch_assoc($customers);
		
        
        // update status for invoice.
        
        $sql_total  = "SELECT total FROM item_invoice WHERE invoice_id = '{$invoice_id}'";
        //echo $sql_total;
        $result_total = mysql_query($sql_total);
        $total_invoice = 0;
        $total_compare = 0;
        if($result_total){                                
            while($row_total = mysql_fetch_assoc($result_total)){
                //echo $row_total['total'].'<br />';   
                $total_item  = str_replace(',', '', $row_total['total']);
                $total_invoice = $total_invoice  + $total_item;              
            }
        }    
        // get discount from table invoice.

        $sql_discount = "SELECT paid_to_date  FROM invoices WHERE id='{$invoice_id}'";
        $resutl_discount = mysql_query($sql_discount);
        $row_discount = mysql_fetch_assoc($resutl_discount);
        /*$discount = str_replace('%','', $row_discount['discount']);
        if((int)$discount > 0){    

            $total_invoice = $total_invoice  - $total_invoice*$discount/100;
        } */
        $total_compare = $total_invoice;       
        $paid_to_date = str_replace(',','',$row_discount['paid_to_date']);
        if($paid_to_date >0 &&  $total_compare >= (float)$total_compare){
            $invoice_stt = 'paid';
        }else if($paid_to_date >0 && $paid_to_date < (float)$total_compare){
            $invoice_stt = 'partial';
        }else {
            $invoice_stt = 'unpaid';
        }
        
        $sql_stt = "UPDATE invoices SET invoice_status='{$invoice_stt}' WHERE id=".$invoice_id;
        mysql_query($sql_stt);
                
        // process only show on new orders when paid is full
        if($invoice_stt == 'paid'){
            // insert to table printordes
            $_POST = array_map('strip_javascript_input',$_POST);	
            $printorder['timestamp'] = date('Y-m-d H:i:s');
            $printorder["custid"] = $_SESSION["customerloginid"];
            $printorder['note'] = $invoice['internal_note'];
            $printorder['customer_note']     = $invoice['note_visible_to_client'];
            $printorder['invoice_id']     = $invoice['id'];
            $_SESSION["printorderid"] = add_record("printorders",$printorder); 
            // insert to table orders
            $data["customerid"] =  $_SESSION["customerloginid"];		
            $data["qty"] = 1;		
            $data["totalprice"] =  round($_SESSION['total'],2);
            $data['invoice_id'] =  $invoice['id'];
            $orderid = add_record("orders", $data); 
            // insert to table receipts
            $data2["oid"] = $orderid;
            $data2["date"] = date("Y/m/d");
            $data2["name"] = $customer["firstname"]." ".$customer["lastname"];
            $data2["address"] = $customer["street"];
            $data2["address2"] = $customer["street2"];
            $data2["city"] = $customer["city"];
            $data2["state"] = $customer["state"];
            $data2["zip"] = $customer["zip"];		
            $data2["tax"] = $_POST["tax"];		
            $data2["funit"] = 2.00;		
            $rid = add_record("receipts", $data2);	

            // insert to table preceipts    
            $data3["oid"] = $_SESSION["printorderid"];
            $data3["date"] = date("Y/m/d");
            $data3["name"] = $customer["firstname"]." ".$customer["lastname"];
            $data3["address"] = $customer["street"];
            $data3["address2"] = $customer["street2"];
            $data3["city"] = $customer["city"];
            $data3["state"] = $customer["state"];
            $data3["zip"] = $customer["zip"];
            $pid = add_record("preceipts", $data3);	
            // update status of field 'paid' in table printorders
            $data5["paid"] = 1;            
            $where = "id = ".$_SESSION["printorderid"];
            modify_record("printorders", $data5, $where);
        }
		$id_customer = $_SESSION["customerloginid"];	
		$sql = "UPDATE customers SET status='Archive' WHERE id='{$id_customer}'";	
		mysql_query($sql);
        
        
        $subject  = '[Best Name Badges] New Invoice '.$invoice_id;
        //$to = 'hien.nguyenvan@citigo.net';
        $to = 'orders@crucialclick.com';
        $message = '
            Invoice #: '.$invoice['id'].' <br />
            Customer Name: '.$customer["firstname"].' '.$customer["lastname"].'<br />    
            Company Name: '.$customer["companyname"].' <br />
            Total Purchase Price Charged:: $'.number_format(round($_SESSION['total'],2),2,'.',',').'    
            ';   
        //define the headers we want passed. Note that they are separated with \r\n    
        //add boundary string and mime type specification   
        $headers = "MIME-Version: 1.0" . "\r\n";					
        $headers .= "Content-type:text/html; charset=utf-8" . "\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
        $headers .= "From: sales@bestnamebadges.com \r\n";				       
        mail($to, $subject, $message, $headers);   


        // sent mail nofication to customer
        $link = $base_url.'/invoices.php?code='.$invoice['rand_code'];
        $email = $customer['email'];
        //$email = 'hiencoder@gmail.com';
        $subject1 = '[Best Name Badges] Payment Notification Invoice '.$invoice_id;
        $message1 = 'A payment has been added to your invoice from Best Name Badges in the amount of $'.number_format(round($_SESSION['total'],2),2,'.',',').', to view the invoice and print a copy for your records, click the link below:: <br />
                    <p></p>
                   '.$link.' <br />
                    </br>    
                    Best regards,  <br />
                    Best Name Badges (support@bestnamebadges.com)<br />  ';
        
        //define the headers we want passed. Note that they are separated with \r\n    
        //add boundary string and mime type specification   
        $header1s = "MIME-Version: 1.0" . "\r\n";					
        $header1s .= "Content-type:text/html; charset=utf-8" . "\r\n";
        $header1s .= "X-Mailer: PHP/" . phpversion() . "\r\n";
        $header1s .= "From: sales@bestnamebadges.com \r\n";				    

        mail($email, $subject1, $message1, $header1s);
        // end of sent mail notication to customer
  
		//header("location: thankyou.php?order=".$orderid."&rid=".$rid."&porder=".$_SESSION["printorderid"]."&pid=".$pid."&total=".$_POST["total"] + $fedexfee);
		header("location: thankyou_invoice.php?order=".$orderid."&invoice_id=".$invoice['id']."&rid=".$rid."&porder=".$_SESSION["printorderid"]."&pid=".$pid."&total=".number_format(round($_SESSION['total'],2),2,'.',','));
	} else if ($result->transaction) {
		header("location: thankyouerror.php?message=".rawurlencode($result->message));
	} else {
		header("location: thankyouerror.php?message=".rawurlencode($result->message));
	}
}else{
$pagetitle = "Buy Name Badges - Custom Name Badge Styles and Tags";
$metadescription = "Best Name Badges offers several styles of high quality badges and tags to fit your needs.  Magnetic and Pin fasteners are included free of charge.";
$metakeywords = "name badges, name tags, custom name badge, custom name tags, metal name tags, brushed aluminum name badges, plastic name tags, plastic name badges, color name badges, employee name tags, employee name badges, professional name tags, professional name badges";    
if (!$_SESSION["customerloginid"]){    
	header("location: sign-up.php");
}
if ($_SESSION["customerloginid"])
{    
	include_once 'inc/header-auth.php';
} else {    
	include_once 'inc/header.php' ;
}
?>
<script type="text/javascript" src="/js/jscolor.js"></script>
<script src="<?php echo $base_url?>/js/jquery-1.3.2.js"></script>
<script>
function updateaddress(){	
	var state = document.getElementById('state1').value;	
	document.getElementById('state_submit').value = state;	
    if(document.getElementById('promocode').value==""){
        document.getElementById('promo2').value = 0;    
    }else{
        document.getElementById('promo2').value = 1;
    }
	
    document.getElementById('attempt2').value = 0;
    document.checkoutform.submit();
}
function changestatediv(country)
{
	if (country == "CA")
	{		
		value_html = '<option value="AB" <?php if ($_SESSION["state"] == "AB") { ?>selected<?php } ?>>AB</option><option value=BC <?php if ($_SESSION["state"] == "BC") { ?>selected<?php } ?>>BC</option><option value="MB" <?php if ($_SESSION["state"] == "MB") { ?>selected<?php } ?>>MB</option><option value="NB" <?php if ($_SESSION["state"] == "NB") { ?>selected<?php } ?>>NB</option><option value=NL <?php if ($_SESSION["state"] == "NL") { ?>selected<?php } ?>>NL</option><option value="NT" <?php if ($_SESSION["state"] == "NT") { ?>selected<?php } ?>>NT</option><option value="NS" <?php if ($_SESSION["state"] == "NS") { ?>selected<?php } ?>>NS</option><option value="NU" <?php if ($_SESSION["state"] == "NU") { ?>selected<?php } ?>>NU</option><option value="ON" <?php if ($_SESSION["state"] == "ON") { ?>selected<?php } ?>>ON</option><option value="PE" <?php if ($_SESSION["state"] == "PE") { ?>selected<?php } ?>>PE</option><option value="QC" <?php if ($_SESSION["state"] == "QC") { ?>selected<?php } ?>>QC</option><option value="SK" <?php if ($_SESSION["state"] == "SI") { ?>selected<?php } ?>>SK</option><option value="YT" <?php if ($_SESSION["state"] == "YT") { ?>selected<?php } ?>>YT</option>';
		$("#state").html(value_html);		
		document.getElementById('stateprov').innerHTML = "<div class='signUpFieldLeft'>Province:</div>";
	} else if (country == "US")	{
		value_html = '<option value=AK <?php if ($_SESSION["state"] == "AK") { ?>selected<?php } ?>>AK</option><option value=AL <?php if ($_SESSION["state"] == "AL") { ?>selected<?php } ?>>AL</option><option value=AR <?php if ($_SESSION["state"] == "AR") { ?>selected<?php } ?>>AR</option><option value=AZ <?php if ($_SESSION["state"] == "AZ") { ?>selected<?php } ?>>AZ</option><option value=CA <?php if ($_SESSION["state"] == "CA") { ?>selected<?php } ?>>CA</option><option value=CO <?php if ($_SESSION["state"] == "CO") { ?>selected<?php } ?>>CO</option><option value=CT <?php if ($_SESSION["state"] == "CT") { ?>selected<?php } ?>>CT</option><option value=DC <?php if ($_SESSION["state"] == "DC") { ?>selected<?php } ?>>DC</option><option value=DE <?php if ($_SESSION["state"] == "DE") { ?>selected<?php } ?>>DE</option><option value=FL <?php if ($_SESSION["state"] == "FL") { ?>selected<?php } ?>>FL</option><option value=GA <?php if ($_SESSION["state"] == "GA") { ?>selected<?php } ?>>GA</option><option value=HI <?php if ($_SESSION["state"] == "HI") { ?>selected<?php } ?>>HI</option><option value=IA <?php if ($_SESSION["state"] == "IA") { ?>selected<?php } ?>>IA</option><option value=ID <?php if ($_SESSION["state"] == "ID") { ?>selected<?php } ?>>ID</option><option value=IL <?php if ($_SESSION["state"] == "IL") { ?>selected<?php } ?>>IL</option><option value=IN <?php if ($_SESSION["state"] == "IN") { ?>selected<?php } ?>>IN</option><option value=KS <?php if ($_SESSION["state"] == "KS") { ?>selected<?php } ?>>KS</option><option value=KY <?php if ($_SESSION["state"] == "KY") { ?>selected<?php } ?>>KY</option><option value=LA <?php if ($_SESSION["state"] == "LA") { ?>selected<?php } ?>>LA</option><option value=MA <?php if ($_SESSION["state"] == "MA") { ?>selected<?php } ?>>MA</option><option value=MD <?php if ($_SESSION["state"] == "MD") { ?>selected<?php } ?>>MD</option><option value=ME <?php if ($_SESSION["state"] == "ME") { ?>selected<?php } ?>>ME</option><option value=MI <?php if ($_SESSION["state"] == "MI") { ?>selected<?php } ?>>MI</option><option value=MN <?php if ($_SESSION["state"] == "MN") { ?>selected<?php } ?>>MN</option><option value=MO <?php if ($_SESSION["state"] == "MO") { ?>selected<?php } ?>>MO</option><option value=MS <?php if ($_SESSION["state"] == "MS") { ?>selected<?php } ?>>MS</option><option value=MT <?php if ($_SESSION["state"] == "MT") { ?>selected<?php } ?>>MT</option><option value=NC <?php if ($_SESSION["state"] == "NC") { ?>selected<?php } ?>>NC</option><option value=ND <?php if ($_SESSION["state"] == "ND") { ?>selected<?php } ?>>ND</option><option value=NE <?php if ($_SESSION["state"] == "NE") { ?>selected<?php } ?>>NE</option> <option value=NH <?php if ($_SESSION["state"] == "NH") { ?>selected<?php } ?>>NH</option><option value=NJ <?php if ($_SESSION["state"] == "NJ") { ?>selected<?php } ?>>NJ</option><option value=NM <?php if ($_SESSION["state"] == "NM") { ?>selected<?php } ?>>NM</option><option value=NV <?php if ($_SESSION["state"] == "NV") { ?>selected<?php } ?>>NV</option><option value=NY <?php if ($_SESSION["state"] == "NY") { ?>selected<?php } ?>>NY</option><option value=OH <?php if ($_SESSION["state"] == "OH") { ?>selected<?php } ?>>OH</option><option value=OK <?php if ($_SESSION["state"] == "OK") { ?>selected<?php } ?>>OK</option><option value=OR <?php if ($_SESSION["state"] == "OR") { ?>selected<?php } ?>>OR</option> <option value=PA <?php if ($_SESSION["state"] == "PA") { ?>selected<?php } ?>>PA</option><option value=RI <?php if ($_SESSION["state"] == "RI") { ?>selected<?php } ?>>RI</option><option value=SC <?php if ($_SESSION["state"] == "SC") { ?>selected<?php } ?>>SC</option><option value=SD <?php if ($_SESSION["state"] == "SD") { ?>selected<?php } ?>>SD</option><option value=TN <?php if ($_SESSION["state"] == "TN") { ?>selected<?php } ?>>TN</option><option value=TX <?php if ($_SESSION["state"] == "TX") { ?>selected<?php } ?>>TX</option><option value=UT <?php if ($_SESSION["state"] == "UT") { ?>selected<?php } ?>>UT</option><option value=VA <?php if ($_SESSION["state"] == "VA") { ?>selected<?php } ?>>VA</option><option value=VT <?php if ($_SESSION["state"] == "VT") { ?>selected<?php } ?>>VT</option><option value=WA <?php if ($_SESSION["state"] == "WA") { ?>selected<?php } ?>>WA</option><option value=WI <?php if ($_SESSION["state"] == "WI") { ?>selected<?php } ?>>WI</option><option value=WV <?php if ($_SESSION["state"] == "WV") { ?>selected<?php } ?>>WV</option><option value=WY <?php if ($_SESSION["state"] == "WY") { ?>selected<?php } ?>>WY</option><option value=AA <?php if ($_SESSION["state"] == "AA") { ?>selected<?php } ?>>AA</option> <option value=AE <?php if ($_SESSION["state"] == "AE") { ?>selected<?php } ?>>AE</option><option value=AP <?php if ($_SESSION["state"] == "AP") { ?>selected<?php } ?>>AP</option><option value=AS <?php if ($_SESSION["state"] == "AS") { ?>selected<?php } ?>>AS</option><option value=FM <?php if ($_SESSION["state"] == "FM") { ?>selected<?php } ?>>FM</option><option value=GU <?php if ($_SESSION["state"] == "GU") { ?>selected<?php } ?>>GU</option><option value=MH <?php if ($_SESSION["state"] == "MH") { ?>selected<?php } ?>>MH</option><option value=MP <?php if ($_SESSION["state"] == "MP") { ?>selected<?php } ?>>MP</option><option value=PR <?php if ($_SESSION["state"] == "PR") { ?>selected<?php } ?>>PR</option><option value=PW <?php if ($_SESSION["state"] == "PW") { ?>selected<?php } ?>>PW</option><option value=VI <?php if ($_SESSION["state"] == "VI") { ?>selected<?php } ?>>VI</option>';
		$("#state").html(value_html);		
		document.getElementById('stateprov').innerHTML = "<div class='signUpFieldLeft'>State:</div>";
	}
}

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
$(document).ready(function(){
   $("#promo_ask").click(function(){
        $(this).hide();
        $("#promo_show").show();
   });
   
   $("#click_edit").click(function(){
       $("#show_address").hide();
       $("#link_edit").hide();
       $("#edit_address").show(); 
   });
});
function validateform()
{
	error = "";
	if (document.getElementById('firstname').value == "")
	{
		error = error + "Please enter a First Name";
	}
	if (document.getElementById('lastname').value == "")
	{
		error = error + "\nPlease enter a Last Name";
	}
	if (document.getElementById('street').value == "")
	{
		error = error + "\nPlease enter a Street Name";
	}
	if (document.getElementById('city').value == "")
	{
		error = error + "\nPlease enter a City";
	}
	if (document.getElementById('state').value == "")
	{
		error = error + "\nPlease enter a State";
	}
	if (document.getElementById('zip').value == "")
	{
		error = error + "\nPlease enter a Zip Code";
	}
	if (document.getElementById('creditCardNumber').value == "")
	{
		error = error + "\nPlease enter a Credit Card Number";
	}
	if (document.getElementById('cvv2Number').value == "")
	{
		error = error + "\nPlease enter a Card Verification Number";
	}
	
	if (error)
	{
		alert(error);
	} else {
		document.checkoutform.submit();
	}
}
</script>
<style>
#promo_ask{
    display: block;
}
#promo_show{
    display:none;
}
#edit_address{
    display: none;
    padding-left: 10px;
}
</style>
<div id="content">
     
    <div id="mainContentFull">
        <h2>Billing And Checkout</h2>
		
	  <br /><br />
      <div style="margin-bottom: 15px;font-family: Arial;">	
          <h1>Invoice: <?php echo $invoice['id'];?> </h1>
      </div>
      <div style="width: 960px;">
      <div style="width: 500px; float: left;">
    
    <div id="signUpLeft" style="margin-top: 0px;width: 450px;">
  		  <form method="post" action="payment_invoice.php" name="checkoutform" id="checkoutform">
		  <input type="hidden"  readonly name="totalbadges" value="0" />
		  <input type="hidden"  readonly  name="totaldome" value="0" />
		  <input type="hidden"  readonly name="totalframes" value="0" />
		  <input type="hidden"  readonly name="abadges" value="0" />
		  <input type="hidden"  readonly name="aframes" value="0" />
		  <input type="hidden" name="numofadome" value="0" />
		  <input type="hidden" name="numofabadges" value="0" />
		  <input type="hidden" name="numofaframes" value="0" />
		  <input type="hidden" name="numofbadges" value="0" />
		  <input type="hidden" name="numofframes" value="0" />
		  <input type="hidden" name="numofdomes" value="0" />
		  <input type="hidden" name="badgetotal" value="0" />
		  <input type="hidden" name="frametotal" value="0" />
          	 <input type="hidden" name="dometotal" value="0" /> 
		  <input type="hidden" name="ordertotal" value="0" />
		  <input type="hidden" name="badgetimes" value="0" />
		  <input type="hidden" name="unitprice" value="0" />
		  <input type="hidden" name="setup" value="0" />
		  <input type="hidden" name="attempt2" id="attempt2" value="1" />
		  <input type="hidden" name="promo2" id="promo2" value="0" />
          <input type="hidden" name="dome_show_calc" value="0" /> 
		  <input type="hidden" name="promocode" id="promocode" value="0" />
          <input type="hidden" value="0" name="frametimes" />          
          <input type="hidden" value="<?php echo $code;?>" name="code" />
     </div>
	 	
		
         		    <?php          
				//if($row_fedex['fedex_enable']==1){           ?>         
					<!-- <div class="boxHeader">
						<span style="float: left;">SHIPPING METHOD</span></div>          
					<div class="signUpField">                             
					<div class="signUpFieldLeft">Shipping Method:</div>             
						 <div class="signUpFieldRight">                 <select name="shippingmethod">                    <!-- <option value="fedex">Fedex</option>
							 <option value="usps">USPS (FREE)</option>                 
							</select>   <a class="hotspot" onmouseover="tooltip.show('<br/><strong>Your Timeline Is Important To Us</strong><br/><br/>We deliver on-time, everytime.<br/><br/>We can oftentimes ship out the same or next day, with delivery options as fast as overnight. We accomodate every rush order request with NO rush fees.<br/><br/>You have 2 ways to do this, first, please try calling us at 888-445-7601.  If it is after hours, please submit your order with free shipping selected, then email support@bestnamebadges.com with your request and we will reach out to you right away.<br/><br/>');" onmouseout="tooltip.hide();" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-weight: normal;" href="javascript:void()">(Need It Faster?)</a>           
					</div>
		                 </div>  -->        
<?php // } ?>	
		  <div class="boxHeader"><span style="float: left;">Billing Address Information</span></div>
           <div class="signUpField">
            <div class="signUpFieldLeft">First Name*:</div>
            <div class="signUpFieldRight"><input type="text" name="firstname" id="firstname" value="<?php echo $_POST["firstname"]; ?>" style="width: 200px;" class="signupFieldInput" /></div>
          </div>
          <div class="signUpField">
            <div class="signUpFieldLeft">Last Name*:</div>
            <div class="signUpFieldRight"><input type="text" name="lastname" id="lastname" value="<?php echo $_POST["lastname"]; ?>" style="width: 200px;" class="signupFieldInput" /></div>
          </div>
          <div class="signUpField">
            <div class="signUpFieldLeft"> Address*:</div>
            <div class="signUpFieldRight"><input type="text" name="street" id="street" value="<?php echo $_POST["street"]; ?>" style="width: 200px;" class="signupFieldInput" /></div>
          </div>
          <div class="signUpField">
            <div class="signUpFieldLeft">Address 2:</div>
            <div class="signUpFieldRight"><input type="text" name="street2" value="<?php echo $_POST["street2"]; ?>" style="width: 200px;" class="signupFieldInput" /></div>
          </div>
          <div class="signUpField">
            <div class="signUpFieldLeft">City*:</div>
            <div class="signUpFieldRight"><input type="text" name="city" id="city" value="<?php echo $_POST["city"]; ?>" style="width: 200px;" class="signupFieldInput" /></div>
          </div>
          <div class="signUpField">
            <div class="signUpFieldLeft">Country*:</div>
            <div class="signUpFieldRight"><select name="country" class="signupFieldInput" style="height: 20px;" onchange="changestatediv(this.value);"><option value="US">United States</option><option value="CA">Canada</option></select></div>
          </div>
          <div class="signUpField">
            <div id="stateprov">
              <div class="signUpFieldLeft"> State*:</div></div>
            <div id="statediv">
			<div class="signUpFieldRight">				
				<select id="state" name="state">
				</select>
			</div>
	   </div>
          </div>
          <div class="signUpField">
            <div class="signUpFieldLeft">Zip*:</div>
            <div class="signUpFieldRight"><input type="text" name="zip" id="zip" value="<?php echo $_POST["zip"]; ?>" maxlength="7" style="width: 50px;" class="signupFieldInput" /></div>
          </div>
        
          <div class="boxHeader"><span style="float: left;">Credit Card Information</span></div>
          <div class="signUpField">
            <div class="signUpFieldLeft">Card Type*:</div>
            <div class="signUpFieldRight"><select name=creditCardType onchange="javascript:generateCC(); return false;"  class="signupFieldInput" style="height: 20px;">
							      	<option value=Visa>Visa</option>
      								<option value=MasterCard>MasterCard</option>
      								<option value=Discover>Discover</option>
      								<option value=Amex>American Express</option>
    							</select></div>
          </div>
          <div class="signUpField">
            <div class="signUpFieldLeft">Card Number*:</div>
            <div class="signUpFieldRight"><input type="text" size="19" maxlength="19" name="creditCardNumber" id="creditCardNumber" class="signupFieldInput"  style="width: 200px;"  /></div>
          </div>
          <div class="signUpField">
            <div class="signUpFieldLeft">Card Expiration*:</div>
            <div class="signUpFieldRight">
            <select name=expDateMonth class="signupFieldInput" style="height: 20px;">
							      <option value=1>01</option>
							      <option value=2>02</option>
						          <option value=3>03</option>
						        <option value=4>04</option>
						        <option value=5>05</option>
						        <option value=6>06</option>
						        <option value=7>07</option>
						        <option value=8>08</option>
						        <option value=9>09</option>
						        <option value=10>10</option>
						        <option value=11>11</option>
						        <option value=12>12</option>
						      </select>
						      <select name=expDateYear class="signupFieldInput" style="height: 20px;">
						        <option value=2011>2011</option>
						        <option value=2012>2012</option>
						        <option value=2013>2013</option>
							    <option value=2014>2014</option>
						        <option value=2015>2015</option>
                                <option value=2016>2016</option>
                                <option value=2017>2017</option>
                                <option value=2018>2018</option>
                                <option value=2019>2019</option>
                                <option value=2020>2020</option>
                                <option value=2021>2021</option>
                                <option value=2022>2022</option>
						      </select>
            </div>
          </div>
          <div class="signUpField">
            <div class="signUpFieldLeft">Card Verfication #*:</div>
            <div class="signUpFieldRight"><input type="text" size="4" maxlength="4" name="cvv2Number" id="cvv2Number" class="signupFieldInput"  style="width: 40px;"/></div>
          </div>
          
          <div class="signUpField">
            <div style="height: 30px; text-align: center; line-height: 30px; margin-top:15px; margin-bottom: 15px;"><img src="images/placeOrderButton.png" onclick="validateform();"/></div>
          </div>
          
        </div>
      </div>  
      <div style="width: 450px; float: right;">
      <div id="wizardRight" style="float: right;width: 450px;">
      <div class="boxorder">
      <span style="float: left;">Your Order</span></div>
      <div class="boxSub" style="float: left;border-bottom: 1px dashed #CCC">         
          <div>	
            <?php 
            if ($_SESSION["state"] == "FL") { 			
                $taxdec = 6/100;
                $taxtotal = $taxdec * $total_compare;
                $no_tax   = $total_compare;
                $total_compare = $taxtotal + $total_compare;
                $tax = '<p style="padding-left: 10px;" class="popBoxSmall"><strong>FL 6% Sales Tax:</strong> <span class="quantityNumber" style="font-size: 14px;">'.formatMoney($taxtotal).'</span></p>'; 
            }else {
               $no_tax   = $total_compare; 
               $tax = '<p style="padding-left: 10px;" class="popBoxSmall"><strong>Sales Tax:</strong> <span class="quantityNumber" style="font-size: 14px;"> N/A</span></p>';  
            }
			?>	
              <!-- <p class="popBoxSmall" style="padding-left: 10px;"><strong>Discount:</strong> <span class="quantityNumber" style="font-size: 14px;"><?php echo  $invoice['discount'];?></span></p>    
              <p class="popBoxSmall" style="padding-left: 10px;"><strong>Subtotal:</strong> <span class="quantityNumber" style="font-size: 14px;"><?php echo formatMoney($no_tax);?></span></p>
                <?php echo $tax;?> -->
                <p class="popBoxSmall" style="padding-left: 10px;"><strong>Invoice Total:</strong> <span class="quantityNumber">$<?php echo number_format($paid_total,2,'.',','); ?></span></p>
         </div>
      </div>
    </div>
    </div>
    <div style="clear: both;"></div>
    <div style="padding-top: 25px;" align="center">
        <div id="promo_ask"><a href="javascript:void(0);"><b>Have a promo code?</b></a></div>
        <div id="promo_show">    	  
    		<p class="popBoxSmall"><input id="promocode_text" value="<?php if(isset($_REQUEST['promo'])){ echo $_REQUEST['promo'];}?>" type="text" name="promo" />&nbsp;&nbsp;<input type="button" value="Apply Promo Code" onclick="javascript:applypromo();"/></p>
        </div>
	</div>
  	 <input type="hidden" name="tax"  readonly value="<?php echo $taxtotal; ?>" />
	<?php 
		$_SESSION['total'] = $paid_total;
	?>
         <!-- <input type="hidden" name="total"  readonly value="<?php echo $total_compare; ?>" /> -->
	  <!-- <input type="hidden" name="discount" id="discount" value="<?php echo $totaldec; ?>" /> -->
    </form>
    </div>
    </div>
</div>
 </div><!-- end content -->
</div><!-- end wrapper -->
<div style="display: none;"><img src="/images/wizard/continueMinus.png" /></div>

<?php include_once 'inc/footer.php' ; ?>

<?php } ?>
<script language="javascript">
changestatediv("US");
changestatediv1("US");
</script>
<script type="text/javascript" language="javascript" src="<?php echo $base_url;?>/js/toolscript.js"></script>