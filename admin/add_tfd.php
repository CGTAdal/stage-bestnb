<?php
require_once('conn/DB.php');
include('conn/tablefuncs.php');
include('../include/config.php');
mysql_select_db($database_DB, $ravcodb);
session_start();

if($_REQUEST['update']=='Upadte'){
	if(!empty($_REQUEST['bname'])){
		$data['name'] 	 = $_REQUEST['bname'];
	}else {
		$data['name'] = 	"-< NO NAME ADDED >-";
	}
	$data['subtext']  		= $_REQUEST['bsubtext'];
	$data['subtext2'] 		= $_REQUEST['bsubtext2'];
	$data['fastener'] 		= $_REQUEST['fastener'];
	$data['frame'] 	  	= $_REQUEST['frame'];
	$data['dome'] 		= $_REQUEST['dome'];
	$data['printorderid'] 	= $_REQUEST['printorderid'];
	$printorderid		=	$_REQUEST['printorderid'];
	$cusid				= $_REQUEST['cusid'];
	$data['custstyleid'] 	= $_REQUEST['styleid'];
	add_record("batches", $data);
	//$sql  = "UPDATE batches SET name = '$name', subtext = '$subtext', subtext2 = '$subtext2', fastener = '$fastener', frame='$frame', dome='$dome' WHERE printorderid=".$printorderid. " AND id=$bid";
	
	?>
	<script language="javascript";>
		parent.parent.location.href = "printorder_view_admin.php?customerid=<?php echo $cusid?>&orderid=<?php echo $printorderid;?>";
		window.close();
	</script>
	<?php	
}
?>
<div id="edit_tfd" align="center" style="margin-top: 50px;">
	<form action="" method="POST" name="edit_tfd">
		<input type="hidden" value="<?php echo $_REQUEST['bid']?>" name="bid"/>
		<input type="hidden" value="<?php echo $_REQUEST['cusid']?>" name="cusid"/>
		<input type="hidden" value="<?php echo $_REQUEST['printorderid']?>" name="printorderid" />
		<input type="hidden" value="<?php echo $_REQUEST['styleid']?>" name="styleid" />
		<table>
			<tr>
				<td>Name</td>
				<td>
					<input type="text" value="" name="bname" />
				</td>
			</tr>
			<tr>
				<td>Subtext</td>
				<td><input type="text" value="" name="bsubtext" /></td>
			</tr>
			<tr>
				<td>Subtext2</td>
				<td><input type="text" value="" name="bsubtext2" /></td>
			</tr>	
			<tr>
				<td>Fastener</td>
				<td>
					<input  type="radio" value="none" name="fastener"> None&nbsp;&nbsp;
					<input  type="radio" checked="" value="magnet" name="fastener"> Magnet&nbsp;&nbsp;
					<input type="radio" value="pin" name="fastener"> Pin
				</td>
			</tr>	
			<tr>
				<td>Frame</td>
				<td>
					<input  type="radio" checked="" value="None" name="frame"> None&nbsp;&nbsp;
					<input  type="radio" value="Silver" name="frame"> Silver&nbsp;&nbsp;
					<input  type="radio" value="Gold" name="frame"> Gold
				</td>
			</tr>
			<tr>
				<td>Dome</td>
				<td>
					<input type="radio" name="dome" value="1"/> Yes 
					<input  type="radio" name="dome" value="0"/> No
				</td>
			</tr>
			<tr>
				<td><input type="submit" value="Upadte" name="update"></td>
				<td><input type="reset" name="Cancel" value="Cancel" onclick="close_w();"></td>
			</tr>
		</table>
	</form>
</div>
