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

if ($_POST["attempt2"])
{
	require_once 'braintree/lib/Braintree.php';

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
	));

	if ($result->success) 
	{
		$msg = "Payment was Successful!";
		ob_start();
		echo "<strong>Best Name Badges has received a Payment:</strong>";
		echo "<br>".$_POST["firstname"]." ".$_POST["lastname"];
		echo "<br>".$_POST["street"];
		echo "<br>".$_POST["city"].", ".$_POST["state"]." ".$_POST["zip"];
		echo "<br>Order Total: $".$_POST["ordertotal"];
		echo "<br>Notes: ".$_POST["notes"];
	
		$contents1 = ob_get_contents();
		ob_end_clean();
		mail("ryan@crucialclick.com", "New Payment", $contents1, $email_headers);
			} else if ($result->transaction) {
		header("location: thankyouerror.php?message=".rawurlencode($result->message));
	} else {
	   header("location: thankyouerror.php?message=".rawurlencode($result->message));
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
	if (num < 1001 && num > 250)
	{
		badgeprice = num * 4.90;
		badge = 4.90;
	} else if (num < 251 && num > 100) {
		 badgeprice = num * 5.75;
		 badge = 5.75;
	} else if (num < 101 && num > 50) {
		badgeprice = num * 6.05;
		badge = 6.05;
	} else if (num < 51 && num > 25) {
		 badgeprice = num * 6.95;
		 badge = 6.95;
	} else if (num < 26 && num > 10) {
		 badgeprice = num * 8.15;
		 badge = 8.15;
	} else {
		 badgeprice = num * 9.45;
		 badge = 9.45;
	}
	frameprice = framenum * 2;
	
	document.getElementById('badgetimes').value = num + " x " + formatCurrency(badge) + " = ";
	document.getElementById('badgetotal').value = formatCurrency(badgeprice) ;
	document.getElementById('badgeunit').value = badge;
	
	document.getElementById('frametimes').value = framenum + " x $2.00 = ";
	document.getElementById('frametotal').value = formatCurrency(frameprice);
	document.getElementById('frameunit').value = 2.00;
	
	//alert(frameprice);
	totalprice = badgeprice + frameprice;
	
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
</script>
    <div id="content">
     
    <div id="mainContentFull">
	  <h2>Make A Payment</h2>


      
      <p>On this page, you will can make payments to Best Name Badges. You should already have arrangements with us before using this form.<br />
        <br />
        <br />
      </p>
      
      <div style="float: left; width: 500px;">
      <form method="post" action="payment.php" name="checkoutform" id="checkoutform" style="width: 500px;">
	  <input type="hidden" name="attempt2" value="1" />
      
      <div style="width: 960px;">
        <div style="width: 500px; float: left;">
          
          <div id="signUpLeft" style="margin-top: 0px;">
          <div class="boxHeader"><span>Enter Payment Amount</span></div>
          <?php if ($msg) { ?>
          <div class="signUpField" style="border-top-width: 1px; border-top-style: dashed; border-top-color: #CCC;"><font color='green'><?php echo $msg; ?></font></div>
     	<?php } ?>
     <div class="signUpField" style="border-top-width: 1px; border-top-style: dashed; border-top-color: #CCC;"></div>
          
         
          
          <div style="width: 500px; text-align: center;">
    	    	<p class="popBoxSmall">Order Total: $ 
    	    	  <input type="text" name="ordertotal" id="ordertotal" maxlength="15" style="width: 60px;font-size:14px;" value="0" /></p>
       	    </div>
     	</div>
          
		  <input type="hidden" name="attempt2" value="1" />
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
						        <option value=2005>2005</option>
						        <option value=2006>2006</option>
						        <option value=2007>2007</option>
						        <option value=2008>2008</option>
							    <option value=2009>2009</option>
						        <option value=2010>2010</option>
						        <option value=2011>2011</option>
						        <option value=2012>2012</option>
						        <option value=2013>2013</option>
							    <option value=2014>2014</option>
						        <option value=2015>2015</option>
						      </select>
            </div>
          </div>
          <div class="signUpField">
            <div class="signUpFieldLeft">Card Verfication #*:</div>
            <div class="signUpFieldRight"><input type="text" size="4" maxlength="4" name="cvv2Number" id="cvv2Number" class="signupFieldInput"  style="width: 40px;"/></div>
          </div>
           <div class="boxHeader"><span style="float: left;">Notes / Process</span></div>
        <div class="signUpField">
           <div class="signUpFieldLeft" style="height: 85px;">Notes:</div>
          <div class="signUpFieldRight" style="height: 85px;"><textarea rows="3" cols="35" name="notes" style="width: 300px; height: 75px;"></textarea></div>
          </div>
          <div class="signUpField">
            <div style="height: 30px; text-align: center; line-height: 30px; margin-top:15px; margin-bottom: 15px;"><img src="images/placeOrderButton.png" onclick="validateform();"/></div>
          </div>
        </form>
      </div>
    
    
      </div>
    </div><!-- end mainContentFull --><!-- end wrapper -->
<div style="display: none;"><img src="/images/wizard/continueMinus.png" /></div>
</div>
<?php include_once 'inc/footer.php' ; ?>
<script language="javascript">
changestatediv("US");
</script>