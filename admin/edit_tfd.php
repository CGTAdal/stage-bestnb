<?php
require_once('conn/DB.php');
include('conn/tablefuncs.php');
include('../include/config.php');
mysql_select_db($database_DB, $ravcodb);
session_start();

if($_REQUEST['update']=='Upadte'){
	$name 	  		= $_REQUEST['bname'];
	$subtext  		= $_REQUEST['bsubtext'];
	$subtext2 		= $_REQUEST['bsubtext2'];
	$fastener 		= $_REQUEST['fastener'];
	$frame 	  		= $_REQUEST['frame'];
	$dome 			= $_REQUEST['dome'];
	$printorderid 	= $_REQUEST['printorderid'];
	$bid 			= $_REQUEST['bid'];
	$cusid			= $_REQUEST['cusid'];
	$sql  = "UPDATE batches SET name = '$name', subtext = '$subtext', subtext2 = '$subtext2', fastener = '$fastener', frame='$frame', dome='$dome' WHERE printorderid=".$printorderid. " AND id=$bid";
	if(mysql_query($sql)){
	?>
	<script language="javascript";>
		parent.parent.location.href = "printorder_view_admin.php?customerid=<?php echo $cusid?>&orderid=<?php echo $printorderid;?>";
		window.close();
	</script>
	<?php
	}else {
		echo 'Error: Unable update this record.';
	}
}
?>
<div id="edit_tfd" align="center" style="margin-top: 50px;">
	<form action="" method="POST" name="edit_tfd">
		<input type="hidden" value="<?php echo $_REQUEST['bid']?>" name="bid"/>
		<input type="hidden" value="<?php echo $_REQUEST['cusid']?>" name="cusid"/>
		<input type="hidden" value="<?php echo $_REQUEST['printorderid']?>" name="printorderid" />
		<table>
			<tr>
				<td>Name</td>
				<td>
					<input type="text" value="<?php echo $_REQUEST['name']?>" name="bname" />
				</td>
			</tr>
			<tr>
				<td>Subtext</td>
				<td><input type="text" value="<?php echo $_REQUEST['subtext']?>" name="bsubtext" /></td>
			</tr>
			<tr>
				<td>Subtext2</td>
				<td><input type="text" value="<?php echo $_REQUEST['subtext2']?>" name="bsubtext2" /></td>
			</tr>	
			<tr>
				<td>Fastener</td>
				<td>
					<input <?php if($_REQUEST['fastener'] == 'none'){echo 'checked';}?> type="radio" value="none" name="fastener"> None&nbsp;&nbsp;
					<input <?php if($_REQUEST['fastener'] == 'magnet'){echo 'checked';}?> type="radio" checked="" value="magnet" name="fastener"> Magnet&nbsp;&nbsp;
					<input <?php if($_REQUEST['fastener'] == 'pin'){echo 'checked';}?> type="radio" value="pin" name="fastener"> Pin
				</td>
			</tr>	
			<tr>
				<td>Frame</td>
				<td>
					<input <?php if($_REQUEST['frame'] == 'None'){ echo 'checked';}?> type="radio" checked="" value="None" name="frame"> None&nbsp;&nbsp;
					<input <?php if($_REQUEST['frame'] == 'Silver'){ echo 'checked';}?> type="radio" value="Silver" name="frame"> Silver&nbsp;&nbsp;
					<input <?php if($_REQUEST['frame'] == 'Gold'){ echo 'checked';}?> type="radio" value="Gold" name="frame"> Gold
				</td>
			</tr>
			<tr>
				<td>Dome</td>
				<td>
					<input <?php if($_REQUEST['dome'] == 1){echo 'checked';}?> type="radio" name="dome" value="1"/> Yes 
					<input <?php if($_REQUEST['dome'] == 0){echo 'checked';}?> type="radio" name="dome" value="0"/> No
				</td>
			</tr>
			<tr>
				<td><input type="submit" value="Upadte" name="update"></td>
				<td><input type="reset" name="Cancel" value="Cancel" onclick="close_w();"></td>
			</tr>
		</table>
	</form>
</div>
