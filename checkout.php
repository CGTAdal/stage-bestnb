<?php 
require_once('admin/conn/DB.php');
include('admin/conn/tablefuncs.php');
mysql_select_db($database_DB, $ravcodb);
session_start();

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


//recalc total of order
function recalc_total_badge($badgenum){
	if($badgenum>= 1001 && $badgenum< 5000){
		$badgeprice = $badge*3.89;
		$badgenum = 3.89;
	}else if ($badgenum < 1001 && $badgenum > 250)
	{
		$badgeprice = $badgenum*4.90;
		$badgenum = 4.90;
	} else if ($badgenum < 251 && $badgenum > 100) {
		 $badgeprice = $badgenum*5.65;
		 $badgenum = 5.65;
	} else if ($badgenum < 101 && $badgenum > 50) {
		$badgeprice = $badgenum*5.95;
		$badgenum = 5.95;
	} else if ($badgenum < 51 && $badgenum > 25) {
		 $badgeprice = $badgenum*6.85;
		 $badgenum = 6.85;
	} else if ($badgenum < 26 && $badgenum > 10) {
		 $badgeprice = $badgenum*8.10;
		 $badgenum = 8.10;
	} else {
		 $badgeprice = $badgenum*9.37;
		 $badgenum = 9.37;
	}
	return formatMoney2($badgeprice);
	
}

function recalc_total_frame($framenum)
{
	$frameprice = $framenum * 2;
	return formatMoney2($frameprice);
}

function recalc_total_dome($domenum)
{
	$dome_total  = $domenum*2.75;
	return formatMoney2($dome_total);
}
 
$badge_num = $_POST["numofbadges"] + $_POST["numofabadges"];
$dome_num  = $_POST['dome_total'] + $_POST['numofadome'];
$frame_num = $_POST["numofframes"] + $_POST["numofaframes"];


$badge_total = recalc_total_badge($badge_num);
$frame_total = recalc_total_frame($frame_num);
$dome_total  = recalc_total_dome($dome_num);

$ordertotal = $badge_total + $frame_total + $dome_total;



// end of recalc total of order

if (!$_SESSION["customerloginid"])
{
	header("location: sign-up.php");
}
//require("fedex.php");
if(isset($_REQUEST['numofbadges'])){
    $_SESSION["numofbadges"]    = $_REQUEST['numofbadges'];
    $_SESSION["numofframes"]    = $_REQUEST['numofframes'];
    $_SESSION["numofabadges"]   = $_REQUEST['numofabadges'];
    $_SESSION["numofaframes"]   = $_REQUEST['numofaframes'];
    $_SESSION["numofdomes"]     = $_REQUEST['numofdomes'];
    $_SESSION["numofadome"]     = $_REQUEST['numofadome'];
}
if($_POST["promo"]){
    $_SESSION["numofbadges"]    = $_REQUEST['numofbadges'];
    $_SESSION["numofframes"]    = $_REQUEST['numofframes'];
    $_SESSION["numofdomes"]     = $_REQUEST['numofdomes'];
    $_SESSION["numofabadges"]   = $_REQUEST['abadges'];
    $_SESSION["numofaframes"]   = $_REQUEST['aframes'];    
    $_SESSION["numofadome"]     = $_REQUEST['numofadome'];
}
/*$sql_fedex      = "SELECT * FROM fedex_setting";
$result_fedex   = mysql_query($sql_fedex);
$row_fedex      = mysql_fetch_assoc($result_fedex);
*/
function email_header ($to_id, $from_name, $from_email, $return_path)
{
	$email_headers = sprintf(
	"From: %s <%s>\n".
	"Content-type: text/html; charset=iso-8859-1\n",
	$from_name, $from_email,
	$return_path, md5(EMAIL_HASH_KEY.$to_id), $to_id);
	return ($email_headers);
}
if ($_POST["promo"])
{
	$qry = "SELECT * FROM promo_codes WHERE code = '".$_POST["promo"]."'";    
	$codes = mysql_query($qry) or die('Query failed: ' . mysql_error()); 
	$code = mysql_fetch_assoc($codes);
    if(empty($code)){
        $_SESSION['promo_error'] = 'Promo code don\'t correctly.Please try again.';
    }else{
        $_SESSION['promo_error'] = '';
    }
}else{
    $_SESSION['promo_error'] = '';
}

if($_POST['firstname1']){
    	
	/*echo '<pre>';	
	print_r($_REQUEST);
	echo '</pre>';*/
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
	'amount' =>$_SESSION['total'],
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
		/*echo '<pre>';
		print_r($_REQUEST);
		echo '</pre>';
		die();*/
		$data["customerid"] = $_SESSION["customerloginid"];
		$data["styleid"] = $_SESSION["custstyleid"];
		$data["qty"] = $_POST["totalbadges"];
		$data["fqty"] = $_POST["totalframes"];
		$data['dmqty'] = $_POST['totaldome'];
		//$data["totalprice"] = $_POST["total"] + $fedexfee;
		$data["totalprice"] =$_SESSION['total'];
		$orderid = add_record("orders", $data);
		
		$qry = "SELECT * FROM customers WHERE id = ".$_SESSION["customerloginid"];
		$customers = mysql_query($qry) or die('Query failed: ' . mysql_error()); 
		$customer = mysql_fetch_assoc($customers);
		
		$datac["inventory"] = $customer["inventory"] + $_POST["abadges"];
		$datac["finventory"] = $customer["finventory"] + $_POST["aframes"];
		$datac["dminventory"] = $customer["dminventory"] + $_POST["adome"];
		$where = "id = ".$customer["id"];
		modify_record("customers", $datac, $where);
		
		$data2["oid"] = $orderid;
		$data2["date"] = date("Y/m/d");
		$data2["name"] = $customer["firstname"]." ".$customer["lastname"];
		$data2["address"] = $customer["street"];
		$data2["address2"] = $customer["street2"];
		$data2["city"] = $customer["city"];
		$data2["state"] = $customer["state"];
		$data2["zip"] = $customer["zip"];
		$data2["bqty"] = $_POST["totalbadges"];
		$data2["bunit"] = $_POST["unitprice"];
		$data2["fqty"] = $_POST["totalframes"];
		$data2['dmqty'] = $_POST['totaldome'];
		$data2["tax"] = $_POST["tax"];
		$data2["setup"] = $_POST["setup"];
		$data2["funit"] = 2.00;
		$data2["promocode"] = $_POST["promocode"];
		$data2["discount"] = $_POST["discount"];
		$rid = add_record("receipts", $data2);
		
		$data3["oid"] = $_SESSION["printorderid"];
		$data3["date"] = date("Y/m/d");
		$data3["name"] = $customer["firstname"]." ".$customer["lastname"];
		$data3["address"] = $customer["street"];
		$data3["address2"] = $customer["street2"];
		$data3["city"] = $customer["city"];
		$data3["state"] = $customer["state"];
		$data3["zip"] = $customer["zip"];
		$pid = add_record("preceipts", $data3);
		
		$data4["paid"] = 1;
		$where = "id = ".$_SESSION["custstyleid"];
		modify_record("custstyle", $data4, $where);
		
		$data5["paid"] = 1;
		/*if($_REQUEST['shippingmethod']=='fedex'){
		    $data5['payment_method'] = 1;
		}else{
		    $data5['payment_method'] = 0;
		}*/
		$where = "id = ".$_SESSION["printorderid"];
		modify_record("printorders", $data5, $where);
		
		ob_start();
		echo "<strong>Best Name Badges has received a new order:</strong>";
		echo "<br>".$customer["firstname"]." ".$customer["lastname"];
		echo "<br>A new style was created";
		echo "<br>Badges: ".$_POST["totalbadges"];
		echo "<br>Frames: ".$_POST["totalframes"];
		echo "<br>Domes: ".$_POST["totaldome"];
		//echo "<br>Total Purchase Price Charged: ".$_POST["total"] + $fedexfee;
		echo "<br>Total Purchase Price Charged: ".$_SESSION['total'];
	
		$contents1 = ob_get_contents();
		ob_end_clean();
		mail("orders@crucialclick.com", "New Order Number ".$orderid, $contents1, $email_headers);
		//mail("hien.nguyenvan@citigo.net", "New Order Number ".$orderid, $contents1, $email_headers);
		
		//header("location: thankyou.php?order=".$orderid."&rid=".$rid."&porder=".$_SESSION["printorderid"]."&pid=".$pid."&total=".$_POST["total"] + $fedexfee);
		header("location: thankyou.php?order=".$orderid."&rid=".$rid."&porder=".$_SESSION["printorderid"]."&pid=".$pid."&total=".$_SESSION['total']);
	} else if ($result->transaction) {
		header("location: thankyouerror.php?message=".rawurlencode($result->message));
	} else {
		header("location: thankyouerror.php?message=".rawurlencode($result->message));
	}
} else {
$pagetitle = "Buy Name Badges - Custom Name Badge Styles and Tags";
$metadescription = "Best Name Badges offers several styles of high quality badges and tags to fit your needs.  Magnetic and Pin fasteners are included free of charge.";
$metakeywords = "name badges, name tags, custom name badge, custom name tags, metal name tags, brushed aluminum name badges, plastic name tags, plastic name badges, color name badges, employee name tags, employee name badges, professional name tags, professional name badges"; 

$arytimes = split(" ", $_POST["badgetimes"]);
$unitprice = trim($arytimes[2]);
$unitprice = substr($unitprice, 1);

if ($_SESSION["color"])
{
	$qry = "SELECT * FROM colors WHERE id = ".$_SESSION["color"];	
	$colors = mysql_query($qry) or die('Query failed: ' . mysql_error()); 
	$color2 = mysql_fetch_assoc($colors);
	$_SESSION["backgroundimage"] = $color2["backgroundimage"];
}
if ($_SESSION["styleid"])
{
	$qry = "SELECT * FROM styles WHERE id = ".$_SESSION["styleid"];
	$styles = mysql_query($qry) or die('Query failed: ' . mysql_error()); 
	$style = mysql_fetch_assoc($styles);
}

?>
<?php 
if ($_SESSION["customerloginid"])
{
	include_once 'inc/header-auth.php';
} else {
	include_once 'inc/header.php' ;
}




 ?>

<script type="text/javascript" src="/js/jscolor.js"></script>
<script language="javascript">
function processimage(frame2) {
    left = '<?php echo $_SESSION["left"]; ?>';
	down = '<?php echo $_SESSION["down"]; ?>';
	left2 = '<?php echo $_SESSION["left2"]; ?>';
	down2 = '<?php echo $_SESSION["down2"]; ?>';
	leftt = '<?php echo $_SESSION["leftt"]; ?>';
	downt = '<?php echo $_SESSION["downt"]; ?>';
	img1w = '<?php echo $_SESSION["img1w"]; ?>';
	img1h = '<?php echo $_SESSION["img1h"]; ?>';
	img2w = '<?php echo $_SESSION["img2w"]; ?>';
	img2h = '<?php echo $_SESSION["img2h"]; ?>';
	leftt2 = '<?php echo $_SESSION["leftt2"]; ?>';
	downt2 = '<?php echo $_SESSION["downt2"]; ?>';
	leftt3 = '<?php echo $_SESSION["leftt3"]; ?>';
	downt3 = '<?php echo $_SESSION["downt3"]; ?>';
	font1 = "<?php echo $_SESSION["font1"]; ?>";
	font2 = "<?php echo $_SESSION["font2"]; ?>";
	font3 = "<?php echo $_SESSION["font3"]; ?>";
	font1size = '<?php echo $_SESSION["font1size"]; ?>';
	font2size = '<?php echo $_SESSION["font2size"]; ?>';
	font3size = '<?php echo $_SESSION["font3size"]; ?>';
	
  	url = "ajax/create_image2.php?left=" + left + "&down=" + down + "&left2=" + left2 + "&down2=" + down2 + "&leftt=" + leftt + "&downt=" + downt + "&img1h=" + img1h + "&img1w=" + img1w + "&img2h=" + img2h + "&img2w=" + img2w + "&leftt2=" + leftt2 + "&downt2=" + downt2 + "&font1=" + font1 + "&font2=" + font2 + "&font1size=" + font1size + "&font2size=" + font2size + "&frame=" + frame2+ "&leftt3=" + leftt3+ "&downt3=" + downt3+ "&font3=" + font3+ "&font3size=" + font3size;

   //alert(url);
    // branch for native XMLHttpRequest object
	req_fifo = false;

	try
	{
	req_fifo = new XMLHttpRequest();
	}
	
	catch (e)
	{
	
		try	{
			req_fifo = new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch (e)
		{
			try
			{
				req_fifo = new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e)
			{
				alert("You browser pro\'lly don\'t support AJAX, get the newest version of Firefox");
				return false;
			}
		}
	}
	
	if (req_fifo)
	{
		req_fifo.abort();
		req_fifo.onreadystatechange = gotprocess;
	    req_fifo.open("POST", url, true);
		req_fifo.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	   	req_fifo.send(null);
	}

    
	
}

function gotprocess() {
// only if req_fifo shows "loaded"
	if (req_fifo.readyState != 4 || req_fifo.status != 200) {
    	return;
    }

	var info = req_fifo.responseText;
	//alert(info);
	var ary=info.split("??");
	//alert(ary);
	document.getElementById('bannerimage').src = ary[0];
	document.getElementById('badgestyle').innerHTML = '<p style="float: left; font-size: 10px; width: 150px; text-align: left;">Badge Style:<br /><strong>'+ary[1]+'</strong></p>';
	document.getElementById('colorname').innerHTML = '<p style="float: right; font-size: 10px; width: 85px; text-align: left;" >Color:<br /><strong>'+ary[2]+'</strong></p>';
	document.getElementById('framestyle').innerHTML = '<p style="float: right; font-size: 10px; width: 60px; text-align: left;">Frame:<br /><strong>'+ary[3]+'</strong></p>';
	
}

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

function select_innerHTML(objeto,innerHTML,state){

/******
* select_innerHTML - corrige o bug do InnerHTML em selects no IE
* Veja o problema em: http://support.microsoft.com/default.aspx?scid=kb;en-us;276228
* Versão: 2.1 - 04/09/2007
* Autor: Micox - Náiron José C. Guimarães - micoxjcg@yahoo.com.br
* @objeto(tipo HTMLobject): o select a ser alterado
* @innerHTML(tipo string): o novo valor do innerHTML
*******/
    objeto.innerHTML = ""
    var selTemp = document.createElement("micoxselect")
    var opt;
    selTemp.id="micoxselect1"
    document.body.appendChild(selTemp)
    selTemp = document.getElementById("micoxselect1")
    selTemp.style.display="none"
    if(innerHTML.indexOf("<option")<0){//se não é option eu converto
        innerHTML = "<option>" + innerHTML + "</option>"
    }
    innerHTML = innerHTML.replace(/<option/g,"<span").replace(/<\/option/g,"</span")
    selTemp.innerHTML = innerHTML
      
    
    for(var i=0;i<selTemp.childNodes.length;i++){
  var spantemp = selTemp.childNodes[i];
  
        if(spantemp.tagName){     
            opt = document.createElement("OPTION")
    
   if(document.all){ //IE
    objeto.add(opt)
   }else{
    objeto.appendChild(opt)
   }       
    
   //getting attributes
   for(var j=0; j<spantemp.attributes.length ; j++){
    var attrName = spantemp.attributes[j].nodeName;
    var attrVal = spantemp.attributes[j].nodeValue;
	//alert(spantemp.attributes[j].nodeSelected);
    if(attrVal){
     try{
      opt.setAttribute(attrName,attrVal);
      opt.setAttributeNode(spantemp.attributes[j].cloneNode(true));
     }catch(e){}
    }
   }
   //getting styles
   if(spantemp.style){
    for(var y in spantemp.style){
     try{opt.style[y] = spantemp.style[y];}catch(e){}
    }
   }
   //value and text
   
   if(opt.value ==state ){   		
   		opt.selected = true;
   	}
   opt.value = spantemp.getAttribute("value")
   opt.text = spantemp.innerHTML
   //IE
   //opt.selected = spantemp.getAttribute('selected');
   opt.className = spantemp.className;
  } 
 }    
 document.body.removeChild(selTemp)
 selTemp = null
}

/*function changestatediv(country)
{
	if (country == "CA")
	{
		//document.getElementById('state').innerHTML = "<option selected></option><option value=AB>AB</option><option value=BC>BC</option><option value=MB>MB</option><option value=NB>NB</option><option value=NL>NL</option><option value=NT>NT</option><option value=NS>NS</option><option value=NU>NU</option><option value=ON>ON</option><option value=PE>PE</option><option value=QC>QC</option><option value=SK>SK</option><option value=YT>YT</option>";
		select_innerHTML(document.getElementById('state'),"<option selected></option><option value=AB>AB</option><option value=BC>BC</option><option value=MB>MB</option><option value=NB>NB</option><option value=NL>NL</option><option value=NT>NT</option><option value=NS>NS</option><option value=NU>NU</option><option value=ON>ON</option><option value=PE>PE</option><option value=QC>QC</option><option value=SK>SK</option><option value=YT>YT</option>");
		document.getElementById('stateprov').innerHTML = "<div class='signUpFieldLeft'>Province:</div>";
	} else if (country == "US")	{
		//document.getElementById('state').innerHTML = "<option selected></option><option value=AK>AK</option><option value=AL>AL</option><option value=AR>AR</option><option value=AZ>AZ</option><option value=CA>CA</option><option value=CO>CO</option><option value=CT>CT</option><option value=DC>DC</option><option value=DE>DE</option><option value=FL>FL</option><option value=GA>GA</option><option value=HI>HI</option><option value=IA>IA</option><option value=ID>ID</option><option value=IL>IL</option><option value=IN>IN</option><option value=KS>KS</option><option value=KY>KY</option><option value=LA>LA</option><option value=MA>MA</option><option value=MD>MD</option><option value=ME>ME</option><option value=MI>MI</option><option value=MN>MN</option><option value=MO>MO</option><option value=MS>MS</option><option value=MT>MT</option><option value=NC>NC</option><option value=ND>ND</option><option value=NE>NE</option> <option value=NH>NH</option><option value=NJ>NJ</option><option value=NM>NM</option><option value=NV>NV</option><option value=NY>NY</option><option value=OH>OH</option><option value=OK>OK</option><option value=OR>OR</option> <option value=PA>PA</option><option value=RI>RI</option><option value=SC>SC</option><option value=SD>SD</option><option value=TN>TN</option><option value=TX>TX</option><option value=UT>UT</option><option value=VA>VA</option><option value=VT>VT</option><option value=WA>WA</option><option value=WI>WI</option><option value=WV>WV</option><option value=WY>WY</option><option value=AA>AA</option> <option value=AE>AE</option><option value=AP>AP</option><option value=AS>AS</option><option value=FM>FM</option><option value=GU>GU</option><option value=MH>MH</option><option value=MP>MP</option><option value=PR>PR</option><option value=PW>PW</option><option value=VI>VI</option>";
		select_innerHTML(document.getElementById('state'),"<option selected></option><option value=AK>AK</option><option value=AL>AL</option><option value=AR>AR</option><option value=AZ>AZ</option><option value=CA>CA</option><option value=CO>CO</option><option value=CT>CT</option><option value=DC>DC</option><option value=DE>DE</option><option value=FL>FL</option><option value=GA>GA</option><option value=HI>HI</option><option value=IA>IA</option><option value=ID>ID</option><option value=IL>IL</option><option value=IN>IN</option><option value=KS>KS</option><option value=KY>KY</option><option value=LA>LA</option><option value=MA>MA</option><option value=MD>MD</option><option value=ME>ME</option><option value=MI>MI</option><option value=MN>MN</option><option value=MO>MO</option><option value=MS>MS</option><option value=MT>MT</option><option value=NC>NC</option><option value=ND>ND</option><option value=NE>NE</option> <option value=NH>NH</option><option value=NJ>NJ</option><option value=NM>NM</option><option value=NV>NV</option><option value=NY>NY</option><option value=OH>OH</option><option value=OK>OK</option><option value=OR>OR</option> <option value=PA>PA</option><option value=RI>RI</option><option value=SC>SC</option><option value=SD>SD</option><option value=TN>TN</option><option value=TX>TX</option><option value=UT>UT</option><option value=VA>VA</option><option value=VT>VT</option><option value=WA>WA</option><option value=WI>WI</option><option value=WV>WV</option><option value=WY>WY</option><option value=AA>AA</option> <option value=AE>AE</option><option value=AP>AP</option><option value=AS>AS</option><option value=FM>FM</option><option value=GU>GU</option><option value=MH>MH</option><option value=MP>MP</option><option value=PR>PR</option><option value=PW>PW</option><option value=VI>VI</option>");
		document.getElementById('stateprov').innerHTML = "<div class='signUpFieldLeft'>State:</div>";
	}
}*/

function applypromo()
{
	var stage = document.getElementById('state1').value;
	document.getElementById('state_submit').value = stage;
	document.getElementById('attempt2').value = 0;
	document.getElementById('promo2').value = 1;
	document.checkoutform.submit();
}

function removepromo()
{
	var stage = document.getElementById('state1').value;
	document.getElementById('state_submit').value = stage;
	document.getElementById('attempt2').value = 0;
	document.getElementById('promo2').value = 0;
       document.getElementById('promocode_text').value='';
	document.checkoutform.submit();
}


function htmlspecialchars_decode (string, quote_style) {
    var optTemp = 0,
        i = 0,
        noquotes = false;
    if (typeof quote_style === 'undefined') {
        quote_style = 2;
    }
    string = string.toString().replace(/&lt;/g, '<').replace(/&gt;/g, '>');
    var OPTS = {
        'ENT_NOQUOTES': 0,
        'ENT_HTML_QUOTE_SINGLE': 1,
        'ENT_HTML_QUOTE_DOUBLE': 2,
        'ENT_COMPAT': 2,
        'ENT_QUOTES': 3,
        'ENT_IGNORE': 4
    };
    if (quote_style === 0) {
        noquotes = true;
    }
    if (typeof quote_style !== 'number') { // Allow for a single string or an array of string flags
        quote_style = [].concat(quote_style);
        for (i = 0; i < quote_style.length; i++) {
            if (OPTS[quote_style[i]] === 0) {
                noquotes = true;
            } else if (OPTS[quote_style[i]]) {
                optTemp = optTemp | OPTS[quote_style[i]];
            }
        }
        quote_style = optTemp;
    }
    if (quote_style & OPTS.ENT_HTML_QUOTE_SINGLE) {
        string = string.replace(/&#0*39;/g, "'"); // PHP doesn't currently escape if more than one 0, but it should
        // string = string.replace(/&apos;|&#x0*27;/g, "'"); // This would also be useful here, but not a part of PHP
    }
    if (!noquotes) {
        string = string.replace(/&quot;/g, '"');
    }
    // Put this in last place to avoid escape being double-decoded
    string = string.replace(/&amp;/g, '&');

    return string;
}
</script>
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
		 <div style="float: left; width: 200px;padding-top: 15px;"><h3 style="font-family:Arial black;font-size: 15px;float: right; padding-right: 15px;text-shadow: 1px 0px #000;">Just 3 Simple Steps:</h3></div> <div class="step"><a href="<?php echo $base_url?>/wizard.php"><h1>Step 1:</h1> Create A Badge Template</a></div><div style="margin-left: -22px;" class="step"><a href="<?php echo $base_url?>/add-names.php"><h1>Step 2:</h1> <div style="weight: 1px;"></div> Add Names And Review Pricing</a></div><div style="margin-left: -22px;"  class="step stepactive"><h1>Step 3:</h1> Submit Your Order</div>
      </div>
      <div style="width: 960px;">
      <div style="width: 500px; float: left;">
    
    <div id="signUpLeft" style="margin-top: 0px;width: 450px;">
  		  <form method="post" action="checkout.php" name="checkoutform" id="checkoutform">
		  <input type="hidden"  readonly name="totalbadges" value="<?php echo $_POST["numofbadges"] + $_POST["numofabadges"]; ?>" />
		  <input type="hidden"  readonly  name="totaldome" value="<?php echo $_POST['dome_total'] + $_POST['numofadome'];?>" />
		  <input type="hidden"  readonly name="totalframes" value="<?php echo $_POST["numofframes"] + $_POST["numofaframes"]; ?>" />
		  <input type="hidden"  readonly name="abadges" value="<?php echo $_POST["numofabadges"]; ?>" />
		  <input type="hidden"  readonly name="aframes" value="<?php echo $_POST["numofaframes"]; ?>" />
		  <input type="hidden" name="numofadome" value="<?php echo $_POST["numofadome"]; ?>" />
		  <input type="hidden" name="numofabadges" value="<?php echo $_POST["numofabadges"]; ?>" />
		  <input type="hidden" name="numofaframes" value="<?php echo $_POST["numofaframes"]; ?>" />
		  <input type="hidden" name="numofbadges" value="<?php echo $_POST["numofbadges"]; ?>" />
		  <input type="hidden" name="numofframes" value="<?php echo $_POST["numofframes"]; ?>" />
		  <input type="hidden" name="numofdomes" value="<?php echo $_POST["numofdomes"]; ?>" />
		  <input type="hidden" name="badgetotal" value="<?php echo $_POST["badgetotal"]; ?>" />
		  <input type="hidden" name="frametotal" value="<?php echo $_POST["frametotal"]; ?>" />
          	 <input type="hidden" name="dometotal" value="<?php echo $_POST['dometotal'];?>" /> 
		  <input type="hidden" name="ordertotal" value="<?php echo $_POST["ordertotal"]; ?>" />
		  <input type="hidden" name="badgetimes" value="<?php echo $_POST["badgetimes"]; ?>" />
		  <input type="hidden" name="unitprice" value="<?php echo $unitprice; ?>" />
		  <input type="hidden" name="setup" value="<?php echo $pricesetup ;?>" />
		  <input type="hidden" name="attempt2" id="attempt2" value="1" />
		  <input type="hidden" name="promo2" id="promo2" value="0" />
          <input type="hidden" name="dome_show_calc" value="<?php echo $_POST["dome_show_calc"]; ?>" /> 
		  <input type="hidden" name="promocode" id="promocode" value="<?php echo $code["name"]; ?>" />
          <input type="hidden" value="<?php echo $_POST["frametimes"]; ?>" name="frametimes" />          
     </div>
	 	
		 
         <div class="boxHeader"><span style="float: left;">YOUR ORDER WILL SHIP TO</span></div>
          <div class="signUpField" style="padding-top: 15px; padding-bottom: 15px;">
            <div>
            
                   <div  id="show_address" style="width: 150px;float: left; padding-left: 10px;">
                   
                    <?php
                    	$qry_info = "SELECT * FROM customers WHERE id = ".$_SESSION["customerloginid"];
                		$customers_info = mysql_query($qry_info) or die('Query failed: ' . mysql_error()); 
                		$customer_info = mysql_fetch_assoc($customers_info);                
				
                     ?>
                     <strong><?php echo $customer_info['companyname'];?></strong> <br />
                     <strong><?php echo $customer_info['firstname'];?>  <?php echo $customer_info['lastname']; ?></strong> <br />
                     <?php if(!empty($customer_info['street'])) echo $customer_info['street'].'<br />';?> 
                     <?php  if(!empty($customer_info['street2'])) echo $customer_info['street2'].' <br />'; ?>
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
                                <td>Address:</td>
                                <td><input  type="text" name="street1" value="<?php if(!empty($customer_info["street"])) echo $customer_info["street"]; ?>" style="width: 200px;" class="signupFieldInput" /></td>
                            </tr>
                            <tr>
                                <td>Address2:</td>
                                <td><input type="text" name="street21" value="<?php echo $customer_info["street2"]; ?>" style="width: 200px;" class="signupFieldInput" /></td>
                            </tr>
                            <tr>
                                <td>City: </td>
                                <td><input type="text" name="city1" value="<?php echo $customer_info["city"]; ?>" style="width: 200px;" class="signupFieldInput" /></td>
                            </tr>
                            <tr>
                                <td>Country: </td>
                                <td>
                                    <select  name="country1" class="signupFieldInput" style="height: 20px;" onchange="changestatediv1(this.value);">
                                        <option value="US">United States</option><option value="CA">Canada</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><div id="stateprov1">State: </div></td>
                                <td>		
						<input type="hidden" value="0" name="state_submit" id="state_submit" />                          
						<select id="state1" name="state1">
						</select>
                                    </div>        
                                </td>
                            </tr>
                            <tr>
                                <td>Zip: </td>
                                <td><input type="text" name="zip1" value="<?php echo $customer_info['zip']; ?>" maxlength="5" style="width: 50px;" class="signupFieldInput" /></td>
                            </tr>
                            <tr>
                                <td>Phone: </td>
                                <td><input  type="text" name="phone1" value="<?php echo $customer_info['phone']; ?>" style="width: 200px;" class="signupFieldInput" /></td>
                            </tr>
                            <tr>
                                <td colspan="2" align="center">
                                    <input type="button" value="Update"  onclick="javascript:updateaddress();" />
                                </td>
                            </tr>
                        </table>
                   </div> 
                   <div id="link_edit" style="width: 200px;float: right; padding-top: 50px;">
                    <a id="click_edit" href="javascript:void(0);">Click Here </a> To Update Address</a>
                   </div>
              </div>     
                 
          </div>
         		    <?php          
				//if($row_fedex['fedex_enable']==1){           ?>         
					 <div class="boxHeader">
						<span style="float: left;">SHIPPING METHOD</span></div>          
					<div class="signUpField">                             
					<div class="signUpFieldLeft">Shipping Method:</div>             
						 <div class="signUpFieldRight">                 <select name="shippingmethod">                    <!-- <option value="fedex">Fedex</option>-->                   
							 <option value="usps">USPS (FREE)</option>                 
							</select>   <a class="hotspot" onmouseover="tooltip.show('<br/><strong>Your Timeline Is Important To Us</strong><br/><br/>We deliver on-time, everytime.<br/><br/>We can oftentimes ship out the same or next day, with delivery options as fast as overnight. We accomodate every rush order request with NO rush fees.<br/><br/>You have 2 ways to do this, first, please try calling us at 888-445-7601.  If it is after hours, please submit your order with free shipping selected, then email support@bestnamebadges.com with your request and we will reach out to you right away.<br/><br/>');" onmouseout="tooltip.hide();" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-weight: normal;" href="javascript:void()">(Need It Faster?)</a>           
					</div>
		                 </div>          
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
     	<div style="float: left; width: 200px;border-bottom: 1px dashed #CCC">
            <div style="width: 150px;float: left;">	
                <div class="signUpFieldLeft" style="width: 130px;">Badges This Order: <span class="quantityNumber"></div>            
            </div>
            <div style="width: 50px;float: right;text-align: center;padding-top: 5px;">
                <span class="quantityNumber"><?php echo $_POST["numofbadges"]; ?></span></div>
        </div>
        
        <div style="float: right; width: 248px;border-bottom: 1px dashed #CCC;border-left: 1px solid #CCC">
        	<div style="width: 160px;float: left;">	
                <div class="signUpFieldLeft" style="width: 150px;">
                    Extra Badges For Later:
                </div>
            </div>
            <div style="width: 30px;float: left; text-align: center;padding-top: 5px;">
                <span class="quantityNumber" style="font-size: 14px; font-weight: bold;"><?php echo $_POST["numofabadges"]; ?></span>
            </div>        
        </div>
        
        <div style="float: left; width: 200px;border-bottom: 1px dashed #CCC">
            <div style="width: 150px;float: left;">	
                <div class="signUpFieldLeft" style="width: 130px;">
                    Frames This Order: 
                </div>
            </div>
            <div style="width: 50px;float: right;text-align: center;padding-top: 5px;"><span class="quantityNumber"><?php echo $_POST["numofframes"]; ?></span></div>        
        </div>
        
        <div style="float: right; width: 248px;border-bottom: 1px dashed #CCC;border-left: 1px solid #CCC;">        	
            <div style="width: 160px;float: left;">	
                <div class="signUpFieldLeft" style="width: 150px;">
                   Extra Frames For Later: 
                </div>
           </div>
           <div style="width: 30px;float: left; text-align: center;padding-top: 5px;"><span class="quantityNumber" style="font-size: 14px; font-weight: bold;"><?php echo $_POST["numofaframes"]; ?></span></div>        
        </div>
        
		<div style="float: left; width: 200px;border-bottom: 1px dashed #CCC">
        	<div style="width: 150px;float: left;">	
                <div class="signUpFieldLeft" style="width: 130px;">
                    Domes This Order: 
                </div>
            </div>
            <div style="width: 50px; float: left; text-align: center;padding-top: 5px;"><span class="quantityNumber"><?php echo $_POST["numofdomes"]; ?></span></div>        
        </div>
       
		<div style="float: right; width: 248px;border-bottom: 1px dashed #CCC;border-left: 1px solid #CCC;">
        	<div style="width: 160px;float: left;">	
                <div class="signUpFieldLeft" style="width: 150px;">
                    Extra Dome For Later: 
                </div>
            </div>
            <div style="width: 30px;float: left; text-align: center;padding-top: 5px;"><span class="quantityNumber" style="font-size: 14px; font-weight: bold;"><?php echo $_POST["numofadome"]; ?></span></div>               
		</div>			
        <div style="clear: both;"></div>
        <div style="float: left; width: 450px; border-bottom: 1px dashed #CCC;">
      		<div style="width: 120px;float: left;">	
                <div class="signUpFieldLeft" style="width: 100px;">
                    Badge Total: 
                </div>
            </div>
            <div style="width: 200px;float:left;padding-top: 5px;">        <?php echo $_POST["badgetimes"]; ?> <span class="quantityNumber" style="font-size: 14px;"><?php echo $_POST["badgetotal"]; ?></span></div>            
        </div>
		
        <div style="float: right; width: 450px;  border-bottom: 1px dashed #CCC;">
      		<div style="width: 120px;float: left;">	
                <div class="signUpFieldLeft" style="width: 100px;">
                    Frame Total: 
                </div>
            </div>    
            <div style="width: 200px;float: left;padding-top: 5px;">    <?php echo $_POST["frametimes"]; ?> <span class="quantityNumber" style="font-size: 14px;"><?php echo $_POST["frametotal"]; ?></span></div>
        </div>
		<div style="float: left; width: 450px;  border-bottom: 1px dashed #CCC;">
        	<div style="width: 120px;float: left;">	
                <div class="signUpFieldLeft" style="width: 100px;">
                    Dome Total: 
                </div>                
            </div>
            <div style="width: 200px; float:left;padding-top: 5px;">
                        <?php echo $_POST["dome_show_calc"]; ?> <span class="quantityNumber" style="font-size: 14px;"><?php echo $_POST["dometotal"]; ?></span>
            </div>
        </div>
        <div style="clear: both;"></div>
        <div style="width: 450px; text-align: center;">
			<?php	
				//echo $ordertotal.'----'.$_POST["ordertotal"];
			?>
        	<p class="popBoxSmall">One-Time Setup Fee = <span class="quantityNumber" style="font-size: 14px;">$<?php echo $pricesetup ;?></span></p>
			<?php if ($_SESSION["state"] == "FL") { 
			//$total = substr($_POST["ordertotal"], 1);
			$total =  $ordertotal;
			if ($code["type"] == 1)
			{
				$promodec = $code["percentage"]/100;
				$totaldec = $promodec * $pricesetup;
				$pricesetup = $pricesetup - $totaldec;
			}
			$total = $total + $pricesetup;
			$subtotal = $total;
			if ($code["type"] == 2)
			{
				$promodec = $code["percentage"]/100;
				$totaldec = $promodec * $total;
				$total = $total - $totaldec;
				$subtotal = $total;
			}
			$taxdec = 6/100;
			$taxtotal = $taxdec * $total;
			$total = $taxtotal + $total;
			$total = formatMoney2($total);
			//echo $total.'AAAA';
			?>	

             
            <?php if ($code) {  ?>
			<p class="popBoxSmall"><?php echo $code["name"]; ?>: <span class="quantityNumber" style="font-size: 14px; color:red;">- <?php echo formatMoney($totaldec); ?></span>&nbsp;&nbsp;<span class="quantityNumber" style="font-size: 10px; color:blue;"><a href="javascript:removepromo();">remove promo</a></span></p>
            
			<?php }?>
            <p style="color: red;"><?php echo $_SESSION['promo_error']; ?></p>
			<p class="popBoxSmall">Subtotal: <?php echo $_REQUEST['ordertotal']?><span class="quantityNumber" style="font-size: 14px;"><?php echo formatMoney($subtotal) ;?></span></p>
			<p class="popBoxSmall">FL 6% Sales Tax: <span class="quantityNumber" style="font-size: 14px;"><?php echo formatMoney($taxtotal) ;?></span></p>
			<?php } else { 
			//$total = substr($_POST["ordertotal"], 1);
			$total =  $ordertotal;
			if ($code["type"] == 1)
			{
				$promodec = $code["percentage"]/100;
				$totaldec = $promodec * $pricesetup;
				$pricesetup = $pricesetup - $totaldec;
			}
			$total = $total + $pricesetup;
			$subtotal = $total;
			if ($code["type"] == 2)
			{
				$promodec = $code["percentage"]/100;
				$totaldec = $promodec * $total;
				$total = $total - $totaldec;
				$subtotal = $total;
			}
			$total = formatMoney2($total);
			?>	
            <?php if ($code) {  ?>
			<p class="popBoxSmall"><?php echo $code["name"]; ?>: <span class="quantityNumber" style="font-size: 14px; color:red;">- <?php echo formatMoney($totaldec); ?></span>&nbsp;&nbsp;<span class="quantityNumber" style="font-size: 10px; color:blue;"><a href="javascript:removepromo();">remove promo</a></span></p>
			<?php } ?>
            <p style="color: red;"><?php echo $_SESSION['promo_error']; ?></p>
			<p class="popBoxSmall">Subtotal: <span class="quantityNumber" style="font-size: 14px;"><?php echo formatMoney($subtotal) ;?></span></p>
			<p class="popBoxSmall">Sales Tax: <span class="quantityNumber" style="font-size: 14px;"> N/A</span></p>
			<?php } ?>	
			
        	<p class="popBoxSmall">Order Total: <span class="quantityNumber"><?php echo formatMoney($total); ?></span></p>
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
        <div style="clear: both; text-align: center; padding-top: 25px;">
      <a href="https://www.sitelock.com/verify.php?site=www.bestnamebadges.com" target="_blank"><img alt="website security" title="SiteLock" border="0" src="//shield.sitelock.com/shield/www.bestnamebadges.com"/></a> </div>
	</div>
  	 <input type="hidden" name="tax"  readonly value="<?php echo $taxtotal; ?>" />
	<?php 
		$_SESSION['total'] = $total;
	?>
         <!-- <input type="hidden" name="total"  readonly value="<?php echo $total; ?>" /> -->
	  <input type="hidden" name="discount" id="discount" value="<?php echo $totaldec; ?>" />
    </form>
    </div>
    	
    </div><!-- end mainContentFull -->
  
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