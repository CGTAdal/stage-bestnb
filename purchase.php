<?php 
require_once('admin/conn/DB.php');
include('admin/conn/tablefuncs.php');
mysql_select_db($database_DB, $ravcodb);
session_start();

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
}

if ($_POST["attempt2"]){
	$_POST["ordertotal"] = substr($_POST["ordertotal"], 1);	
	
	//// Braintree Method (define class and variables)
	/*require_once 'braintree/lib/Braintree.php';	
	//Braintree_Configuration::environment('sandbox');
	//Braintree_Configuration::merchantId('y4b39ygj5tsmsrhm');
	//Braintree_Configuration::publicKey('hc3tx7dpwftgy6yc');
	//Braintree_Configuration::privateKey('ktsvdyd4rmnjfphr');
	
	Braintree_Configuration::environment('production');
	Braintree_Configuration::merchantId('952ff2n634sv6zdf');
	Braintree_Configuration::publicKey('8qbw39w6nqhjvzwb');
	Braintree_Configuration::privateKey('vgfjkvmx2rndd9qt');

	$result = Braintree_Transaction::sale(array(
  	'amount' => $_POST["ordertotal"],
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
	));*/
	require_once('payeezy_payment.php');
    $billing =  new stdClass();
    /* get customer email*/
    $qry1 = "SELECT email FROM customers WHERE id = ".$_SESSION["customerloginid"];   
    $custemail = mysql_query($qry1) or die('Query failed: ' . mysql_error()); 
    $custdata = mysql_fetch_assoc($custemail); 
    $array = array('address'=>$_POST["street"],'address2'=>$_POST["street2"],'city'=>$_POST["city"],'state'=>$_POST["state"],'zip'=>$_POST["zip"]);
    foreach ($array as $key => $value)
    {
        $billing->$key = $value;
    }

	$payment = new Payment();
    $payment->cc_name = $_POST["firstname"]." ".$_POST["lastname"];
    $payment->cc_number = $_POST["creditCardNumber"];
    $payment->cc_cvv = $_POST["cvv2Number"];
    $payment->cc_type = $_POST["creditCardType"];
    $payment->cc_month = $_POST["expDateMonth"];
    $payment->merchant_ref = "inventory";
    $payment->amount = $_POST["ordertotal"];
    $payment->cc_year = $_POST["expDateYear"];
    $payment->email = $custdata['email'];
    $result = $payment->charge($billing);

	if ($result['success'] == true) {  

		$data["customerid"] = $_SESSION["customerloginid"];
		$data["qty"] = $_POST["badges"];
		$data["fqty"] = $_POST["frames"];
		$data["dmqty"] = $_POST["domes"];
		$data["totalprice"] = $_POST["ordertotal"];
		$orderid = add_record("orders", $data);
		
		$qry = "SELECT * FROM customers WHERE id = ".$_SESSION["customerloginid"];
		$customers = mysql_query($qry) or die('Query failed: ' . mysql_error()); 
		$customer = mysql_fetch_assoc($customers);
		
		$datac["inventory"] = $customer["inventory"] + $_POST["badges"];
		$datac["finventory"] = $customer["finventory"] + $_POST["frames"];
		$datac["dminventory"] = $customer["dminventory"] + $_POST["domes"];
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
		$data2["bqty"] = $_POST["badges"];
		$data2["bunit"] = $_POST["badgeunit"];
		$data2["fqty"] = $_POST["frames"];
		$data2['dmqty'] = $_POST['domes'];
		$data2["tax"] = $_POST["tax"];
		$data2["funit"] = $_POST["frameunit"];
		$data2["promocode"] = $_POST["promocode"];
		$data2["discount"] = $_POST["discount"];
		$rid = add_record("receipts", $data2);
		
		ob_start();
		echo "<strong>Best Name Badges has received a New Inventory Order: ".$orderid."</strong>";
		echo "<br>".$customer["firstname"]." ".$customer["lastname"];
		echo "<br>".$customer["street"];
		echo "<br>".$customer["city"].", ".$customer["state"]." ".$customer["zip"];
		echo "<BR>Badges: ".$_POST["badges"];
		echo "<BR>Frames: ".$_POST["frames"];
		echo "<BR>Tax: ".$_POST["tax"];
		echo "<br>Order Total: $".$_POST["ordertotal"];
		$contents1 = ob_get_contents();
		ob_end_clean();
		mail("support@bestnamebadges.com", "New Inventory Order ".$orderid, $contents1, $email_headers);
				
		header("location: thankyou2.php?order=".$orderid."&rid=".$rid."&ordertotal=".$_POST["ordertotal"]);
	} else if ($result['error']) {
		header("location: thankyouerror.php?message=".rawurlencode($result['error']));
	} else {
	    header("location: thankyouerror.php?message=".rawurlencode($result['error']));
	}
}
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
<script language="javascript">
function formatCurrency(num) {
	num = num.toString().replace(/\$|\,/g,'');
	if(isNaN(num))
		num = "0";
	sign = (num == (num = Math.abs(num)));
	num = Math.floor(num*100+0.50000000001);
	cents = num%100;
	num = Math.floor(num/100).toString();
	if(cents<10)
		cents = "0" + cents;
	for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
	num = num.substring(0,num.length-(4*i+3))+','+
	num.substring(num.length-(4*i+3));
	return (((sign)?'':'-') + '$' + num + '.' + cents);
}
function recalc2()
{
	recalc();
}
function recalc()
{
	state = "<?php echo $_SESSION["state"]; ?>";
	num = parseInt(document.getElementById('badges').value);
	framenum = parseInt(document.getElementById('frames').value);
	domenum = parseInt(document.getElementById('domes').value);
	if (num < 1001 && num > 250)
	{
		badgeprice = num * 4.90;
		badge = 4.90;
	} else if (num < 251 && num > 100) {
		 badgeprice = num * 5.65;
		 badge = 5.65;
	} else if (num < 101 && num > 50) {
		badgeprice = num * 5.95;
		badge = 5.95;
	} else if (num < 51 && num > 25) {
		 badgeprice = num * 6.85;
		 badge = 6.85;
	} else if (num < 26 && num > 10) {
		 badgeprice = num * 8.10;
		 badge = 8.10;
	} else {
		 badgeprice = num * 9.37;
		 badge = 9.37;
	}
	frameprice = framenum * 2;
	domeprice  = domenum * 2.75;	
	document.getElementById('badgetimes').value = num + " x " + formatCurrency(badge) + " = ";
	document.getElementById('badgetotal').value = formatCurrency(badgeprice) ;
	document.getElementById('badgeunit').value = badge;
	
	document.getElementById('frametimes').value = framenum + " x $2.00 = ";
	document.getElementById('frametotal').value = formatCurrency(frameprice);
	document.getElementById('frameunit').value = 2.00;
	
	document.getElementById('dometimes').value = domenum + " x $2.75 = ";
	document.getElementById('dometotal').value = formatCurrency(domeprice);
	document.getElementById('domeunit').value = 2.75;
	//alert(frameprice);
	totalprice = badgeprice + frameprice + domeprice;
	
	<?php if ($code["type"] == 2) {?>
		promodec = <?php echo $code["percentage"]/100; ?>;
		totaldec = promodec * totalprice;
		totalprice = totalprice - totaldec;
		document.getElementById("discount").value = totaldec;
		document.getElementById("subtotal").value = formatCurrency(totalprice);
		document.getElementById("promo").value = formatCurrency(totaldec);
	<?php } ?>

	if (state == "FL") 
	{
		taxdec = 6/100;
		taxtotal = taxdec * totalprice;
		totalprice = taxtotal + totalprice;
		tax = formatCurrency(taxtotal);
		document.getElementById("tax").value = tax.substr(1);
	}
	document.getElementById("ordertotal").value = formatCurrency(totalprice);
}

function changestatediv(country)
{
	if (country == "CA")
	{
		document.getElementById('statediv').innerHTML = "<div class='signUpFieldRight'><select id=state name=state><option selected></option><option value=AB>AB</option><option value=BC>BC</option><option value=MB>MB</option><option value=NB>NB</option><option value=NL>NL</option><option value=NT>NT</option><option value=NS>NS</option><option value=NU>NU</option><option value=ON>ON</option><option value=PE>PE</option><option value=QC>QC</option><option value=SK>SK</option><option value=YT>YT</option></select></div>";
		document.getElementById('stateprov').innerHTML = "<div class='signUpFieldLeft'>Province:</div>";
	} else if (country == "US")	{
		document.getElementById('statediv').innerHTML = "<div class='signUpFieldRight'><select id=state name=state><option selected></option><option value=AK>AK</option><option value=AL>AL</option><option value=AR>AR</option><option value=AZ>AZ</option><option value=CA>CA</option><option value=CO>CO</option><option value=CT>CT</option><option value=DC>DC</option><option value=DE>DE</option><option value=FL>FL</option><option value=GA>GA</option><option value=HI>HI</option><option value=IA>IA</option><option value=ID>ID</option><option value=IL>IL</option><option value=IN>IN</option><option value=KS>KS</option><option value=KY>KY</option><option value=LA>LA</option><option value=MA>MA</option><option value=MD>MD</option><option value=ME>ME</option><option value=MI>MI</option><option value=MN>MN</option><option value=MO>MO</option><option value=MS>MS</option><option value=MT>MT</option><option value=NC>NC</option><option value=ND>ND</option><option value=NE>NE</option> <option value=NH>NH</option><option value=NJ>NJ</option><option value=NM>NM</option><option value=NV>NV</option><option value=NY>NY</option><option value=OH>OH</option><option value=OK>OK</option><option value=OR>OR</option> <option value=PA>PA</option><option value=RI>RI</option><option value=SC>SC</option><option value=SD>SD</option><option value=TN>TN</option><option value=TX>TX</option><option value=UT>UT</option><option value=VA>VA</option><option value=VT>VT</option><option value=WA>WA</option><option value=WI>WI</option><option value=WV>WV</option><option value=WY>WY</option><option value=AA>AA</option> <option value=AE>AE</option><option value=AP>AP</option><option value=AS>AS</option><option value=FM>FM</option><option value=GU>GU</option><option value=MH>MH</option><option value=MP>MP</option><option value=PR>PR</option><option value=PW>PW</option><option value=VI>VI</option></select></div>";
		document.getElementById('stateprov').innerHTML = "<div class='signUpFieldLeft'>State:</div>";
	}
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

function applypromo()
{
	document.getElementById('attempt2').value = 0;
	document.getElementById('promo2').value = 1;
	document.checkoutform.submit();
}

function removepromo()
{
	document.getElementById('attempt2').value = 0;
	document.getElementById('promo2').value = 0;
	document.checkoutform.submit();
}

</script>
    <div id="content">
     
    <div id="mainContentFull">
	  <h2>Purchase Additional Inventory</h2>


      
      <p>On this page, you will purchase additional inventory.  Having inventory will allow you to place orders for name badges.  Remember, you can purchase high quantities of inventory now to take advantage of volume discounts, but still just use what you need, when you need it.</p><p>  Meaning, you may purchase an inventory of 51 badges now, but only use 15 of the badges today and save the other 36 to be used later as needed.</p>
      <h4>Once you have purchased your inventory, return to the &quot;Order Badges&quot; screen to place your badge order.</h4>
      
      <div  class="purchase-border"></div>
      
      <div  class="purchase-table-outer">
    <table width="565" border="0" align="center" cellpadding="2" cellspacing="3" style="font-size: 11px;">
  <tr>
    <td width="123" align="center" bgcolor="#738539"><strong style="color: #FFF">Badge Quantity</strong></td>
    <td width="80" align="center" bgcolor="#738539"><strong style="color: #FFF">Price</strong></td>
    <td width="99" align="center" bgcolor="#738539"><strong style="color: #FFF">Colors</strong></td>
    <td width="148" align="center" bgcolor="#738539"><strong style="color: #FFF">Fastener<br />
    </strong></td>
    <td width="105" align="center" bgcolor="#738539"><strong style="color: #FFF">Shipping</strong></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#ececec">1 - 10</td>
    <td align="center" bgcolor="#ececec"><span style="text-decoration:line-through;">$<?php echo $pricepro1sale ; ?>/ea</span><br />
      <span style="color:#F00;">$<?php echo $pricepro1 ; ?>/ea</span></td>
    <td align="center" bgcolor="#ececec">Full Color</td>
    <td align="center" bgcolor="#ececec">Magnet or Pin Included</td>
    <td align="center" bgcolor="#ececec">Free</td>
  </tr>
  <tr>
    <td align="center" bgcolor="#ececec">11-25</td>
    <td align="center" bgcolor="#ececec"><span style="text-decoration:line-through;">$<?php echo $pricepro2sale ; ?>/ea</span><br />
      <span style="color:#F00;">$<?php echo $pricepro2 ; ?>/ea</span></td>
    <td align="center" bgcolor="#ececec">Full Color</td>
    <td align="center" bgcolor="#ececec">Magnet or Pin Included</td>
    <td align="center" bgcolor="#ececec">Free</td>
  </tr>
  <tr>
    <td align="center" bgcolor="#ececec">26-50</td>
    <td align="center" bgcolor="#ececec"><span style="text-decoration:line-through;">$<?php echo $pricepro3sale ; ?>/ea</span><br />
      <span style="color:#F00;">$<?php echo $pricepro3 ;?>/ea</span></td>
    <td align="center" bgcolor="#ececec">Full Color</td>
    <td align="center" bgcolor="#ececec">Magnet or Pin Included</td>
    <td align="center" bgcolor="#ececec">Free</td>
  </tr>
  <tr>
    <td align="center" bgcolor="#ececec">51-100</td>
    <td align="center" bgcolor="#ececec"><span style="text-decoration:line-through;">$<?php echo $pricepro4sale ; ?>/ea</span><br />
      <span style="color:#F00;">$<?php echo $pricepro4 ;?>/ea</span></td>
    <td align="center" bgcolor="#ececec">Full Color</td>
    <td align="center" bgcolor="#ececec">Magnet or Pin Included</td>
    <td align="center" bgcolor="#ececec">Free</td>
  </tr>
  <tr>
    <td align="center" bgcolor="#ececec">101-250</td>
    <td align="center" bgcolor="#ececec"><span style="text-decoration:line-through;">$<?php echo $pricepro5sale ; ?>/ea</span><br />
      <span style="color:#F00;">$<?php echo $pricepro5 ;?>/ea</span></td>
    <td align="center" bgcolor="#ececec">Full Color</td>
    <td align="center" bgcolor="#ececec">Magnet or Pin Included</td>
    <td align="center" bgcolor="#ececec">Free</td>
  </tr>
  <tr>
    <td align="center" bgcolor="#ececec">251-1000</td>
    <td align="center" bgcolor="#ececec"><span style="text-decoration:line-through;">$<?php echo $pricepro6sale ; ?>/ea</span><br />
      <span style="color:#F00;">$<?php echo $pricepro6 ;?>/ea</span></td>
    <td align="center" bgcolor="#ececec">Full Color</td>
    <td align="center" bgcolor="#ececec">Magnet or Pin Included</td>
    <td align="center" bgcolor="#ececec">Free</td>
  </tr>
  <tr>
    <td align="center" bgcolor="#ececec">1001 - 10000</td>
    <td align="center" bgcolor="#ececec"><span style="text-decoration:line-through;">$<?php echo $pricepro7sale ; ?>/ea</span><br />
      <span style="color:#F00;">$<?php echo $pricepro7 ;?>/ea</span></td>
    <td align="center" bgcolor="#ececec">Full Color</td>
    <td align="center" bgcolor="#ececec">Magnet or Pin Included</td>
    <td align="center" bgcolor="#ececec">Free</td>
  </tr>
  <tr>
    <td align="center" bgcolor="#738539"><strong style="color:#FFF;">Badge Frames</strong></td>
    <td align="center" bgcolor="#738539"><strong style="color:#FFF;">Price</strong></td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center" bgcolor="#ececec">All Sizes/Colors</td>
    <td align="center" bgcolor="#ececec">$<?php echo $priceframes ;?>/ea</td>
    <td align="center" bgcolor="#ececec">&nbsp;</td>
    <td align="center" bgcolor="#ececec">&nbsp;</td>
    <td align="center" bgcolor="#ececec">&nbsp;</td>
  </tr>
  <tr>
    <td align="center" bgcolor="#738539"><strong style="color:#FFF;">Badge Domes</strong></td>
    <td align="center" bgcolor="#738539"><strong style="color:#FFF;">Price</strong></td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center" bgcolor="#ececec">Polyurethane Domed Lens</td>
    <td align="center" bgcolor="#ececec">$2.75/ea</td>
    <td align="center" bgcolor="#ececec">&nbsp;</td>
    <td align="center" bgcolor="#ececec">&nbsp;</td>
    <td align="center" bgcolor="#ececec">&nbsp;</td>
  </tr>
</table>
    </div>
    
      <div class="payment-left-panel">
      <form method="post" action="purchase.php" name="checkoutform" id="checkoutform" >
        <input type="hidden" name="badgeunit" id="badgeunit" value="0" />
	  <input type="hidden" name="frameunit" id="frameunit" value="0" />
	  <input type="hidden" name="domeunit" id="domeunit" value="0" />
	  <input type="hidden" name="attempt2" id="attempt2" value="1" />
	  <input type="hidden" name="promo2" id="promo2" value="0" />
	  <input type="hidden" name="promocode" id="promocode" value="<?php echo $code["name"]; ?>" />
	  <input type="hidden" name="discount" id="discount" value="0" />
      
      
        <div class="payment-left-first" >
          
          <div id="signUpLeft" style="margin-top: 0px;" class="payment-left-first">
          <div class="boxHeader"><span>Purchase Inventory</span></div>
          
          <div class="signUpField" style="border-top-width: 1px; border-top-style: dashed; border-top-color: #CCC;">
        <div class="signUpFieldLeft" style="width: 150px;">Badges:</div>
            <div class="signUpFieldRight" style="width: 320px;">
           <input type="text" name="badges" id="badges" value="<?php if ($_POST["badges"]) { echo $_POST["badges"]; } else { echo "0"; } ?>" maxlength="10" style="width: 30px;" class="signupFieldInput" onchange="javascript:recalc2();" />
            </div>
     </div>
     
     <div class="signUpField" style="border-top-width: 1px; border-top-style: dashed; border-top-color: #CCC;">
        <div class="signUpFieldLeft" style="width: 150px;">Badge Frames:</div>
            <div class="signUpFieldRight" style="width: 320px;">
           <input type="text" name="frames" id="frames" value="<?php if ($_POST["frames"]) { echo $_POST["badges"]; } else { echo "0"; } ?>" maxlength="10" style="width: 30px;" class="signupFieldInput" onchange="javascript:recalc2();"/>
            </div>
     </div>
	 <div class="signUpField" style="border-top-width: 1px; border-top-style: dashed; border-top-color: #CCC;">
        <div class="signUpFieldLeft" style="width: 150px;">Domes:</div>
            <div class="signUpFieldRight" style="width: 320px;">
           <input type="text" name="domes" id="domes" value="<?php if ($_POST["domes"]) { echo $_POST["domes"]; } else { echo "0"; } ?>" maxlength="10" style="width: 30px;" class="signupFieldInput" onchange="javascript:recalc2();"/>
            </div>
     </div>
          
          <div class="signUpField" style="border-top-width: 1px; border-top-style: dashed; border-top-color: #CCC;">
				<p style="text-align: center;"><a style="cursor: pointer;">Update Totals</a></p>
		 </div>
        <div class="boxHeader"><span>Your Order</span></div>
  		<div class="signUpField">
            <div class="purcahse-yourorder-first" >
            <p class="popBoxSmall">Pro Badges Total: <input type="text" name="badgetimes" id="badgetimes" maxlength="15" style="width: 70px; border:none;" value="0" class="popBoxSmall"  readonly/> <input type="text" name="badgetotal" id="badgetotal" maxlength="15" style="width: 60px; border:none; font-size:14px;" value="" class="quantityNumber" readonly/></p>
			</div>
              
       		<div class="purcahse-yourorder-second" >
        	<p class="popBoxSmall">Frame Total: <input type="text" name="frametimes" id="frametimes" maxlength="15" style="width: 70px; border:none;" value="0" class="popBoxSmall" readonly/> <input type="text" name="frametotal" id="frametotal" maxlength="15" style="width: 60px; border:none; font-size:14px;" value="" class="quantityNumber" readonly/></p>
        	</div>
			 <div class="purcahse-yourorder-third">
            <p class="popBoxSmall">Domes Total: <input type="text" name="dometimes" id="dometimes" maxlength="15" style="width: 70px; border:none;" value="0" class="popBoxSmall"  readonly/> <input type="text" name="dometotal" id="dometotal" maxlength="15" style="width: 60px; border:none; font-size:14px;" value="" class="quantityNumber" readonly/></p>
			</div>
			 <?php if ($code) {  ?>
			<p class="popBoxSmall"><?php echo $code["name"]; ?>: <span class="quantityNumber" style="font-size: 14px; color:red;">- <input type="text" name="promo" id="promo" maxlength="15" style="width: 50px; border:none; font-size:14px;" value="0" class="quantityNumber" readonly/><a href="javascript:removepromo();">remove promo</a></span></p>
			<?php } else { ?>
			<p class="popBoxSmall"><input type="text" name="promo" />&nbsp;&nbsp;<input type="button" value="Apply Promo Code" onclick="javascript:applypromo();"/></p>
			<?php } ?>
			<p class="popBoxSmall" style="display: none;">Subtotal: <span class="quantityNumber" style="font-size: 14px;"><input type="text" name="subtotal" id="subtotal" maxlength="15" style="width: 50px; border:none; font-size:14px;" value="0" class="quantityNumber" readonly/></span></p>
			 <?php if ($_SESSION["state"] == "FL") { ?>
			 <div class="purcahse-yourorder-fourth" >
    	    	<p class="popBoxSmall">FL 6% Sales Tax: $<input type="text" name="tax" id="tax" maxlength="15" style="width: 50px; border:none; font-size:14px;" value="0" class="quantityNumber" readonly/></p>
        	 </div>
			 <?php } else { ?>
			 <div class="purcahse-yourorder-fourth" >
    	    	<p class="popBoxSmall">Sales Tax: $<input type="text" name="tax" id="tax" maxlength="15" style="width: 50px; border:none; font-size:14px;" value=" N/A" class="quantityNumber" readonly/></p>
        	 </div>
			 <?php } ?>
		     <div class="purcahse-yourorder-five">
    	    	<p class="popBoxSmall">Order Total:  <input type="text" name="ordertotal" id="ordertotal" maxlength="15" style="width: 60px; border:none; font-size:14px;" value="0" class="quantityNumber" readonly/></p>
        	 </div>
          </div>   
     	
          
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
            <div class="signUpFieldRight"><input type="text" name="street2" id="street2" value="<?php echo $_POST["street2"]; ?>" style="width: 200px;" class="signupFieldInput" /></div>
          </div>
          <div class="signUpField">
            <div class="signUpFieldLeft">City*:</div>
            <div class="signUpFieldRight"><input type="text" name="city" id="city" value="<?php echo $_POST["city"]; ?>" style="width: 200px;" class="signupFieldInput" /></div>
          </div>
          <div class="signUpField">
            <div class="signUpFieldLeft">Country*:</div>
            <div class="signUpFieldRight"><select name="country" id="country" class="signupFieldInput" style="height: 20px;" onchange="changestatediv(this.value);"><option value="US">United States</option><option value="CA">Canada</option></select></div>
          </div>
          <div class="signUpField">
            <div id="stateprov">
              <div class="signUpFieldLeft"> State*:</div></div>
            <div id="statediv"><div class="signUpFieldRight"><input type="text" name="state" id="state" value="<?php echo $_POST["state"]; ?>" maxlength="2" style="width: 25px;" class="signupFieldInput" /></div></div>
          </div>
          <div class="signUpField">
            <div class="signUpFieldLeft">Zip*:</div>
            <div class="signUpFieldRight"><input type="text" name="zip" id="zip" value="<?php echo $_POST["zip"]; ?>" maxlength="7" style="width: 50px;" class="signupFieldInput" /></div>
          </div>
          <div class="boxHeader"><span style="float: left;">Credit Card Information</span></div>
          <div class="signUpField">
            <div class="signUpFieldLeft">Card Type*:</div>
            <div class="signUpFieldRight"><select name=creditCardType  class="signupFieldInput" style="height: 20px;">
							      	<option value=Visa>Visa</option>
      								<option value=MasterCard>MasterCard</option>
      								<option value=Discover>Discover</option>
      								<option value=Amex>American Express</option>
    							</select></div>
          </div>
          <div class="signUpField">
            <div class="signUpFieldLeft">Card Number*:</div>
            <div class="signUpFieldRight"><input type="text" size="19" maxlength="19" name="creditCardNumber" id="creditCardNumber" class="signupFieldInput"  autocomplete="off"  style="width: 200px;"  /></div>
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
						        <?php $k= date('y'); for($i=date('Y');$i<=date('Y')+15;$i++) {?>
                                <option value=<?php echo $k; ?>><?php echo $i; ?></option>
                                <?php $k++; }?>	
						      </select>
            </div>
          </div>
          <div class="signUpField">
            <div class="signUpFieldLeft">Card Verfication #*:</div>
            <div class="signUpFieldRight"><input type="text" size="4" maxlength="4" name="cvv2Number" id="cvv2Number" class="signupFieldInput"  autocomplete="off"  style="width: 40px;"/></div>
          </div>
          
          <div class="signUpField">
            <div style="height: 30px; text-align: center; line-height: 30px; margin-top:15px; margin-bottom: 15px;"><img src="images/placeOrderButton.png" onclick="validateform();"/></div>
          </div>
          
        </div>
    </form>
    </div>
      
    </div><!-- end mainContentFull -->  
  </div><!-- end content -->
</div><!-- end wrapper -->
<div style="display: none;"><img src="/images/wizard/continueMinus.png" /></div>
</div>
<?php include_once 'inc/footer.php' ; ?>
<script language="javascript">
changestatediv("US");
recalc2();
</script>