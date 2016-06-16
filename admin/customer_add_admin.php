<?php 
require_once('conn/DB.php');
include('conn/tablefuncs.php');
mysql_select_db($database_DB, $ravcodb);
session_start();
include('permision.php');
//if (!$_SESSION["loginid"] || $_SESSION["userlevel"] < 2)
if (!$_SESSION["loginid"])
{ 
?>
<script language="javascript">
parent.parent.location.href='admin.php';
window.close();
</script>
<?php }

if ($_POST["addcustinfo"]) 
{
		unset($_POST["addcustinfo"]);
		
		if($_POST['country']== "0") {
			$_POST['country'] 	= $_POST['enter_country'];
			$_POST['state']		= $_POST['enter_state'];
		}
		
		unset($_POST['enter_country']);			
		unset($_POST['enter_state']);
		
		$customerid = add_record("customers", $_POST);
		
		//$msg = "<font color='green'>New Customer Added</font><br>".$customerid;
		unset($_POST);
?>
<script language="javascript">
parent.parent.location.href='customer_view_admin.php?customerid=<?php echo $customerid;?>';
window.close();
</script>
<?php
}

$sql_user  = "SELECT * FROM users ORDER BY username ASC";
$result_user 	= mysql_query($sql_user);		
$arr_user  = array();
if($result_user){
	while($row_user = mysql_fetch_assoc($result_user)){
		$arr_user[] = $row_user;
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Add Customer</title>
<?php include("init_top.php");?>

<link href="includes/cms.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="scripts/jquery-1.3.2.min.js"></script>
<style>
	.resize{width:150px;height:auto;}
</style>
<script>
        $(document).ready(function(){
            $("#usename").change(function(){
                var user = $(this).val();                
                $.ajax({
                    url: "<?php echo $base_url?>/admin/ajaxcheck.php",
                    type:'POST',
                    data:{
                        username: user,
                        checktype: 'user'
                    },
                    dataType:"html",
                    success: function(data){
                        if(data=='yes'){
                            $("#user_error").html("<font color='red'>Name Already Exists, Choose Another</font>");
                            $("#check_submit").val(1);
                        }else{
                            $("#user_error").html("<font color='green'>User Name Valid</font>");
                            $("#check_submit").val(0);
                        }
                        
                    }
                });
            });
            $("#email").change(function(){
                var email = $(this).val();                
                $.ajax({
                    url: "<?php echo $base_url?>/admin/ajaxcheck.php",
                    type:'POST',
                    data:{
                        email: email,
                        checktype: 'email'
                    },
                    dataType:"html",
                    success: function(data){
                        if(data=='yes'){
                            $("#email_error").html("<font color='red'>Email Already Exists, Choose Another</font>");
                            $("#check_email").val(1);
                        }else{
                            $("#email_error").html("<font color='green'>Email Is Valid</font>");
                            $("#check_email").val(0);
                        }
                        
                    }
                });
            });
        });
        function check_submit()
        {
            var check_user = $("#check_submit").val();
            var check_email= $("#check_email").val();
            if(check_user == '1'){                
                return false;
            }  
            if(check_email == '1'){               
                return false;
            }
            document.addcust.submit();
        }
</script>
</head>

<body>
<?php include("header.php"); ?>
<div id="content" class="xfluid">
<div style="min-height: 300px;" class="portlet x12">
	<div class="portlet-header"><h4>Add Customer</h4></div>			
		<div class="portlet-content" >	
		
<input type="hidden" value="0" name="check_submit" id="check_submit" />
<input type="hidden" value="0" name="check_email" id="check_email" />
<form action="customer_add_admin.php" enctype="multipart/form-data" method="post" name="addcust">
<input type="hidden" name="addcustinfo" value="1">
<input type="hidden" name="inventory" value="0" />
<!-- <input type="hidden" name="setup" value="0" />-->

<table width="800" frame="box" border="0" align="center">
	<tr>
		<td colspan="2">&nbsp;</td>
		<td colspan="2" align="right" valign="bottom"><h3></h3></td>
	</tr>
	<?php if ($msg) { ?>
	<tr>
		<td>&nbsp;</td>
		<td><font size="1"><?php echo $msg; ?></font></td>
	</tr>
	<?php } ?>
	<tr>
		<td align="right"><strong>UserName:</strong></td>
		<td>
            <input type="text" id="usename" name="username" value="<?php echo $_POST["username"]; ?>"/><br />
            <span id="user_error"></span>
        </td>
	</tr>
    <tr>
        <td align="right"><strong>Assign To Salesperson</strong></td>
        <td>
            <select id="sale_id" name="sale_id">
				<?php 
					foreach($arr_user as $user){		
						if($sale_id == $user['id']){
							$sl = 'selected="selected"';
						}else{
							$sl = '';
						}
						?>
						<option value="<?php echo $user['id']?>" <?php echo $sl;?>><?php echo $user['username']?></option>
				<?php
					}
				?>	
			 </select> 
        </td>
    </tr>
	<tr>
		<td align="right"><strong>First Name:</strong></td>
		<td><input type="text" name="firstname" value="<?php echo $_POST["firstname"]; ?>"/></td>
	</tr>
	<tr>
		<td align="right"><strong>Last Name:</strong></td>
		<td><input type="text" name="lastname" value="<?php echo $_POST["lastname"]; ?>"/></td>
	</tr>
	<tr>
		<td align="right"><strong>Company Name:</strong></td>
		<td><input type="text" name="companyname" value="<?php echo $_POST["companyname"]; ?>" /></td>
	</tr>
	<tr>
		<td align="right"><strong>Password:</strong></td>
		<td><input type="text" name="password" value="<?php echo $_POST["password"]; ?>" /></td>
	</tr>
	<tr>
		<td align="right"><strong>Email:</strong></td>
		<td>
                <input type="text" id="email" name="email" value="<?php echo $_POST["email"]; ?>" /><br />
                <span id="email_error"></span>
        </td>
	</tr>
	<!-- <tr>
		<td align="right"><strong>Inventory:</strong></td>
		<td><input type="text" name="inventory" value="<?php //echo $_POST["inventory"]; ?>" /></td>
	</tr> -->
	<tr>
		<td align="right"><strong>Street:</strong></td>
		<td><input type="text" name="street" value="<?php echo $_POST["street"]; ?>" /></td>
	</tr>
	<tr>
		<td align="right"><strong>Street 2:</strong></td>
		<td><input type="text" name="street2" value="<?php echo $_POST["street2"]; ?>" /></td>
	</tr>
	<tr>
		<td align="right"><strong>City:</strong></td>
		<td><input type="text" name="city" value="<?php echo $_POST["city"]; ?>" /></td>
	</tr>
	<tr>
		<td align="right"><strong>Country:</strong></td>
		<td>
			<div>
				<select id="select_country" name="country">
					<option value="US">United States</option>
					<option value="CA">Canada</option>
					<option value="0">Other</option>
				</select>
			</div>
			<div>
				<input id="enter_country" name="enter_country" type="text" value="" style="display:none" />
			</div>
		</td>
	</tr>
	<tr>
		<td align="right"><strong id='state_prov'>State:</strong></td>
		<!-- <td><input type="text" name="state" value="<?php #echo $_POST["state"]; ?>" /></td>-->
		<td>
			<div id='state_list'></div>
			<div id='state_box' style="display:none">
				<input type="text" name="enter_state"/>
			</div>
		</td>
	</tr>
	<tr>
		<td align="right"><strong>Zip:</strong></td>
		<td><input type="text" name="zip" value="<?php echo $_POST["zip"]; ?>" /></td>
	</tr>
	<tr>
		<td align="right"><strong>Phone:</strong></td>
		<td><input type="text" name="phone" value="<?php echo $_POST["phone"]; ?>" /></td>
	</tr>

	<tr>
		<td colspan="2">&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td><input style="font-size:12px;" class="btn btn-small" type="button" value="Add New Customer" onclick="check_submit();" /></td>
	</tr>
</table>
</form>
</div>
</div>
</div>
<script>
$(document).ready(function(){
	changestatediv("US");

	$('#select_country').change(function(){
		changestatediv($(this).val());
	});
});

function changestatediv(country)
{
	if (country == "CA")
	{
		$('#state_prov').html('Province:');
		$('#state_list').html("<div><select name='state'><option selected></option><option value=AB>AB</option><option value=BC>BC</option><option value=MB>MB</option><option value=NB>NB</option><option value=NL>NL</option><option value=NT>NT</option><option value=NS>NS</option><option value=NU>NU</option><option value=ON>ON</option><option value=PE>PE</option><option value=QC>QC</option><option value=SK>SK</option><option value=YT>YT</option></select></div>");
		$('#state_list').show();
		$('#state_box').hide();
		$('#enter_country').hide();
	} else if (country == "US")	{
		$('#state_prov').html('State:');
		$('#state_list').html("<div><select name='state'><option selected></option><option value=AK>AK</option><option value=AL>AL</option><option value=AR>AR</option><option value=AZ>AZ</option><option value=CA>CA</option><option value=CO>CO</option><option value=CT>CT</option><option value=DC>DC</option><option value=DE>DE</option><option value=FL>FL</option><option value=GA>GA</option><option value=HI>HI</option><option value=IA>IA</option><option value=ID>ID</option><option value=IL>IL</option><option value=IN>IN</option><option value=KS>KS</option><option value=KY>KY</option><option value=LA>LA</option><option value=MA>MA</option><option value=MD>MD</option><option value=ME>ME</option><option value=MI>MI</option><option value=MN>MN</option><option value=MO>MO</option><option value=MS>MS</option><option value=MT>MT</option><option value=NC>NC</option><option value=ND>ND</option><option value=NE>NE</option> <option value=NH>NH</option><option value=NJ>NJ</option><option value=NM>NM</option><option value=NV>NV</option><option value=NY>NY</option><option value=OH>OH</option><option value=OK>OK</option><option value=OR>OR</option> <option value=PA>PA</option><option value=RI>RI</option><option value=SC>SC</option><option value=SD>SD</option><option value=TN>TN</option><option value=TX>TX</option><option value=UT>UT</option><option value=VA>VA</option><option value=VT>VT</option><option value=WA>WA</option><option value=WI>WI</option><option value=WV>WV</option><option value=WY>WY</option><option value=AA>AA</option> <option value=AE>AE</option><option value=AP>AP</option><option value=AS>AS</option><option value=FM>FM</option><option value=GU>GU</option><option value=MH>MH</option><option value=MP>MP</option><option value=PR>PR</option><option value=PW>PW</option><option value=VI>VI</option></select></div>");
		$('#state_list').show();
		$('#state_box').hide();
		$('#enter_country').hide();
	} else {
		$('#state_prov').html('State:');
		$('#state_list').hide();
		$('#state_box').show();
		$('#enter_country').show();
	}
}
</script>
</body>
</html>
