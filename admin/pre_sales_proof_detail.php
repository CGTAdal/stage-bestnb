<?php
require_once('conn/DB.php');
include('conn/tablefuncs.php');
include('../include/config.php');
mysql_select_db($database_DB, $ravcodb);
session_start();
include('permision.php');
if ($_REQUEST["logout"])
{
	unset($_SESSION["loginid"]);
	unset($_SESSION["userlevel"]);
	unset($_SESSION["username"]);
}
if (!$_SESSION["loginid"] )
{
	header("location: login.php");
}

// get list user to filter by user:
$sql_user  = "SELECT * FROM users ORDER BY username ASC";
$result_user 	= mysql_query($sql_user);
$arr_user  = array();
if($result_user){
	while($row_user = mysql_fetch_assoc($result_user)){
		$arr_user[] = $row_user;
	}
}

if($_REQUEST['del_pre_sale']){
	$id = $_REQUEST['id'];
	$sql_del =  "DELETE FROM order_wizard WHERE id=".$id;
	mysql_query($sql_del);
	?>
<script language="javascript">
        parent.parent.location.href='pre_sales_proof.php';
        window.close();
    </script>
	<?php
}



$id_pre_sale = $_REQUEST['pre_id'];
$sql_detail  = "SELECT order_wizard.* FROM order_wizard WHERE id=".$id_pre_sale;

$result = mysql_query($sql_detail);
$row = mysql_fetch_assoc($result);
/*echo '<pre>';
 print_r($row);
 echo '</pre>'; */
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Best Name Badges - Content Management System</title>
<?php include("init_top.php");?>
<link href="includes/cms.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" media="all"
	href="<?php echo $base_url;?>/admin/calendar/calendar-win2k-1.css"
	title="win2k-1" />

<script type="text/javascript"
	src="<?php echo $base_url;?>/admin/scripts/jquery-1.3.2.min.js"></script>
<!-- main calendar program -->
<script type="text/javascript"
	src="<?php echo $base_url;?>/admin/calendar/calendar.js"></script>

<!-- language for the calendar -->
<script type="text/javascript"
	src="<?php echo $base_url;?>/admin/calendar/lang/calendar-en.js"></script>

<!-- the following script defines the Calendar.setup helper function, which makes
     adding a calendar a matter of 1 or 2 lines of code. -->
<script type="text/javascript"
	src="<?php echo $base_url;?>/admin/calendar/calendar-setup.js"></script>

<script type="text/javascript">
    var GB_ROOT_DIR = "greybox/";
</script>


<script type="text/javascript" src="greybox/AJS.js"></script>
<script type="text/javascript" src="greybox/AJS_fx.js"></script>
<script type="text/javascript" src="greybox/gb_scripts.js"></script>
<link href="greybox/gb_styles.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="scripts/jquery-1.3.2.min.js"></script>
<style>
.resize {
	width: 259px;
	height: auto;
}
/*Paging style*/
.paging {
	padding: 10px 0px 0px 0px;
	text-align: center;
	font-size: 13px;
}

.paging.display {
	text-align: right;
}

.paging a,.paging span {
	padding: 2px 8px 2px 8px;
}

.paging span {
	font-weight: bold;
	color: #000;
	font-size: 13px;
}

.paging a {
	color: #000;
	text-decoration: none;
	border: 1px solid #dddddd;
}

.paging a:hover {
	text-decoration: none;
	background-color: #6C6C6C;
	color: #fff;
	border-color: #000;
}

.paging span.prn {
	font-size: 13px;
	font-weight: normal;
	color: #aaa;
}

.paging a.prn {
	border: 2px solid #dddddd;
}

.paging a.prn:hover {
	border-color: #000;
}

.paging p#total_count {
	color: #aaa;
	font-size: 12px;
	padding-top: 8px;
	padding-left: 18px;
}

.paging p#total_display {
	color: #aaa;
	font-size: 12px;
	padding-top: 10px;
}
</style>
<script type="text/javascript">
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
            // Resolve string input to bitwise e.g. 'PATHINFO_EXTENSION' becomes 4
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

$(document).ready(function(){
	$(".save").each(function(){
		$(this).change(function(){
			var id_arr = $(this).attr('id').split('note_');
			var id = id_arr[1];
			
			//var notes =  $("#note_"+id).val();
			var notes =  $(this).val();			
			//alert(notes);			
			//var note =  tinyMCE.get("note_"+id).getContent();
			$.ajax({
				url: 'save_note_presale.php',
				data: {
					id_presale: id,
					note: notes,
					user_name: '<?php echo $_SESSION["username"]; ?>',
				    refresh: 1	
				},
				success: function (data){	   
                    //alert(data);
					$("#note_"+id).val(" "); 			
					$("#div_show_"+id).html(htmlspecialchars_decode(data));					
					$("#div_show_"+id).show();							
					$("#div_edit_"+id).hide();					
				}
			});
		});
	});
});
function update_status(status,id)
{
	$.ajax({
		url:'<?php echo $base_url;?>/admin/pre_sale_change.php',
		type:'POST',
		data:{
			status: status,
			id: id			
		},
		success: function(){
			
		}
	});
}
function show_hide(id)
{
	//alert(id);
	$("#div_show_"+id).hide();
	$("#div_edit_"+id).show();
}

function update_sale(user_id, pre_sale_id)
{
	$.ajax({
		url:'<?php echo $base_url;?>/admin/pre_sale_change.php',
		type:'POST',
		data:{
			user_id		: user_id,
			pre_sale_id	: pre_sale_id,
			action  	: 'changesale'			
		},
		success: function(){
			
		}
	});	
}	
</script>
</head>
<body>
	<div align="center">
	<?php include("header.php"); ?>
		<div class="xgrid">
			<div class="portlet x12" style="min-height: 300px;">
				<div class="portlet-header">
					<h4>
						Pre Sale Order: #
						<?php echo $row['id'];?>
					</h4>
				</div>
				<?php
				$qry = "
							SELECT customers.id AS custid, customers.firstname AS firstname, customers.lastname AS lastname, customers.companyname AS companyname, customers.street, customers.street2, customers.city, customers.state, customers.zip AS zipcode, customers.email, customers.phone 
							FROM customers
							WHERE customers.id=".$row['customer_id'];
				$customer 	= mysql_query($qry) or die('Query failed: ' . mysql_error());
				$customers 	= mysql_fetch_assoc($customer);
				?>
				<div class="portlet-content">
					<table frame="box" border="0" align="center">
						<tr>
							<td colspan="1"><a
								href="customer_view_admin.php?customerid=<?php echo $customers["custid"]; ?>"><strong><?php echo $customers["companyname"]."<br>".$customers["firstname"]." ".$customers["lastname"]; ?>
								</strong> </a><br /> <?php echo $customers["street"]; ?> <?php if ($customers["street2"]) { echo "<br>".$customers["street2"]; } ?><br />
								<?php echo $customers["city"].", ".$customers["state"]." ".$customers["zipcode"]; ?>
							</td>
							<td colspan="7" align="right"><strong><?php echo $customers["email"]."<br>".$customers["phone"]; ?>
							</strong></td>
						</tr>
						<tr bgcolor="#D8D7E3">
							<td colspan="2" class="fieltable" align="center"><strong>Date</strong>
							</td>
							<td colspan="2" class="fieltable" align="center"><strong>Presale
									Quantity</strong></td>
							<td colspan="3" class="fieltable" align="center" width="250"><strong>Operation</strong>
							</td>
							<td colspan="2" class="fieltable"><strong>Type</strong></td>
						</tr>
						<tr>
							<td colspan="2" align="center"><a
								href="pre_sales_proof_detail.php?pre_id=<?php echo $row['id'];?>"><?php echo $row['created_date'];?>
							</a></td>
							<td colspan="2" align="center"><font color="#FF0000"><strong><?php echo $row['id'];?>
								</strong> </font></td>
							<td colspan="3" align="center">
								<select id="user_id" name="user_id" onChange="update_sale(this.value,'<?php echo $row['id']?>');">
									<option value="0"></option>
									<?php
										foreach($arr_user as $user){
											if($row['sale_id'] == $user['id']){
												$sl = 'selected="selected"';
											}else{
												$sl = '';
											}
									?>
										<option value="<?php echo $user['id']?>" <?php echo $sl;?>>
											<?php echo $user['username']?>
										</option>
									<?php
										}
									?>
								</select>
								<select name="status" onChange="update_status(this.value,'<?php echo $row['id'];?>')">
									<option <?php echo ($row['status']=='all')?'selected="selected"':""?> value="all">All</option>
									<option <?php echo ($row['status']=='new')?'selected="selected"':""?> value="new">New</option>
									<option <?php echo ($row['status']=='sent')?'selected="selected"':""?> value="sent">Sent</option>
									<option <?php echo ($row['status']=='waiting')?'selected="selected"':""?> value="waiting">Waiting</option>
									<option <?php echo ($row['status']=='complete')?'selected="selected"':""?> value="complete">Complete</option>
								</select>
								<!--<a onClick="javascript:return confirm('Are you sure you want to delete this presale order?')" href="pre_sales_proof.php?del_pre_sale=1&id=<?php echo $row['id'];?>">[X]</a>-->
							</td>
							<td colspan="2"><b><?php echo $row['type'];?> </b></td>
						</tr>
						<?php if($row['type'] == 'Photo ID Badges'){?>
							<tr>
								<td width="30%" style="height: 25px;"><strong>Badge Size</strong></td>
								<td align="center"><strong>Badge Color</strong></td>
								<td align="center"><strong>Orientation</strong></td>
								<td align="center"><strong>Lanyard</strong></td>
								<?php if($row['lanyard']==1){?>
									<td><strong>Lanyard Color</strong></td>
								<?php }else{?>
									<td><strong>Backing Fastener</strong></td>
								<?php } ?>
								<td align="center"><strong>Shipping</strong></td>
								<?php if($row['delivery']==0){?>
									<td align="center"><strong>My Order By</strong></td>
								<?php }?>
								<td align="center"><strong>Velvet Carry Pouch</strong></td>
							</tr>
							<tr>
								<td width="30%" style="height: 25px;"><?php echo $row['size'];?></td>
								<td align="center"><?php echo $row['badge_color'];?></td>
								<td align="center"><?php if($row['orientation']==1){echo 'Horizontal';}else{echo 'Vertical';}?></td>
								<td align="center"><?php if($row['lanyard']==1){ echo 'Yes';}else{ echo 'No';}?></td>
								<td><?php if($row['lanyard']==1){ echo $row['lanyard_color'];}else{echo $row['backing_fastener'];}?></td>
								<td>
									<?php
										if($row['delivery']==1){
											echo 'Standard';
										}else{
											echo 'Expedited';
										}?>
								</td>
								<?php if($row['delivery']==0){?>
									<td><?php echo $row['delivered_by'];?></td>
								<?php } ?>
								<td><?php echo $row['velvet_carry_pouch'];?>
								</td>
							</tr>
							<?php if(!empty($row['your_photo_id_badge'])){?>
							<tr>
								<td><h3>Upload Photo</h3></td>
							</tr>
							<tr>
								<td><img width="150" src="<?php echo $base_url.$row['your_photo_id_badge'];?>"></td>
							</tr>
							<?php } ?>
						<?php }?>
						<?php if($row['type'] == 'Engraved Name Tags' || $row['type'] == 'Digitally Printed Pro Badges'){?>
							<tr>
								<td width="30%" style="height: 25px;"><strong>Badge Size</strong>
								</td>
								<td align="center"><strong>Badge Color</strong></td>
								<td align="center"><strong>Frame</strong></td>
								<td align="center"><strong>Dome</strong></td>
								<td align="center"><strong>Backing Fastener</strong></td>
								<td align="center"><strong>Shipping</strong></td>
								<?php if($row['delivery']==0){?>
								<td align="center"><strong>My Order By</strong></td>
								<?php }?>
								<td align="center"><strong>Velvet Carry Pouch</strong></td>
	
								<td><strong>Quantity</strong></td>
							</tr>
	
							<tr>
								<td width="30%" style="height: 25px;"><?php echo $row['size'];?>
								</td>
								<td align="center"><?php echo $row['badge_color'];?></td>
								<td align="center"><?php echo $row['frame']; //if($row['frame']==1){echo 'Yes';}else{echo 'No';}?>
								</td>
								<td align="center"><?php if($row['dome']==1){echo 'Yes';}else{echo 'No';}?>
								</td>
								<td align="center"><?php echo $row['backing_fastener'];?></td>
								<td><?php if($row['delivery']==1){
									echo 'Standard';
								}else{
									echo 'Expedited';
								}?>
								</td>
								<?php if($row['delivery']==0){?>
								<td><?php echo $row['delivered_by'];?></td>
								<?php } ?>
								<td align="center"><?php echo $row['velvet_carry_pouch'];?></td>
								<td><strong><?php echo $row['num_baged'];?> </strong></td>
							</tr>
						<?php }?>


						<?php if($row['type'] == 'Reusable Name Badges'){?>
							<tr>
								<td width="30%" style="height: 25px;"><strong>Badge Size</strong>
								</td>
								<td align="center"><strong>Badge Color</strong></td>
								<td align="center"><strong>Backing Fastener</strong></td>
								<td align="center"><strong>Pre-Printed Logo</strong></td>
								<td align="center"><strong>Software</strong></td>
								<td align="center"><strong>Printer Type</strong></td>
								<td align="center"><strong>Shipping</strong></td>
								<?php if($row['delivery']==0){?>
								<td align="center"><strong>My Order By</strong></td>
								<?php }?>
								<td align="center"><strong>Velvet Carry Pouch</strong></td>
	
								<td><strong>Quantity</strong></td>
							</tr>
							<tr>
								<td width="30%" style="height: 25px;"><?php echo $row['size'];?>
								</td>
								<td align="center"><?php echo $row['badge_color'];?></td>
								<td align="center"><?php echo $row['backing_fastener'];?></td>
								<td align="center"><?php echo $row['pre_print_logo'];?></td>
								<td align="center"><?php echo $row['software'];?></td>
								<td align="center"><?php echo $row['printer_type'];?></td>
								<td><?php if($row['delivery']==1){
									echo 'Standard';
								}else{
									echo 'Expedited';
								}?>
								</td>
								<?php if($row['delivery']==0){?>
								<td><?php echo $row['delivered_by'];?></td>
								<?php } ?>
								<td align="center"><?php echo $row['velvet_carry_pouch'];?></td>
								<td><strong><?php echo $row['num_baged'];?> </strong></td>
							</tr>
						<?php } ?>
						<!-- Process for plates logos -->
						<?php if($row['type'] == 'Desk Name Plates and Wall Plates'){?>
							<tr>
								<td width="30%" style="height: 25px;"><strong>Badge Size</strong>
								</td>
								<td align="center"><strong>Plate Color</strong></td>
								<td align="center"><strong>Imprint Method</strong></td>
								<td align="center"><strong>Holder Type</strong></td>
								<?php if($row['type_holder']==1){?>
								<td align="center"><strong>Material</strong></td>
								<td align="center"><strong>Holder Color</strong></td>
								<?php }elseif($row['type_holder']==0){ ?>
								<td align="center"><strong>Holder Color</strong></td>
								<td align="center"><strong>Attachment</strong></td>
								<?php }else{?>
								<td align="center"><strong>Attachment</strong></td>
								<?php } ?>
								<td align="center"><strong>Shipping</strong></td>
								<?php if($row['delivery']==0){?>
								<td align="center"><strong>My Order By</strong></td>
								<?php }?>
								<td><strong>Plates Quantity</strong></td>
								<td><strong>Holders Quantity</strong></td>
							</tr>
							<tr>
								<td width="30%" style="height: 25px;"><?php echo $row['size'];?>
								</td>
								<td align="center"><?php echo $row['plate_color']?></td>
								<td align="center"><?php echo ($row['imprint_method']==1)?'Printed (Full Color)':'Engraved (Black or White Only)';?>
								</td>
								<td align="center"><?php if($row['type_holder']==1){ 
									echo 'Desk Plate Holder'; }
									elseif($row['type_holder']==0){
										echo 'Wall Plate Holder';
									}else{ echo 'None';}?>
								</td>
								<?php if($row['type_holder']==1){?>
								<td align="center"><?php echo ($row['material_holder']=='1')?'Aluminum':'Stained Wood';?>
								</td>
								<td align="center"><?php echo $row['holder_color_first']?></td>
								<?php }else if($row['type_holder']==0){ ?>
								<td align="center"><?php echo $row['holder_color_second']?></td>
								<td align="center"><?php echo $row['attachment']?></td>
								<?php } else{?>
								<td align="center"><?php echo $row['attachment']?></td>
								<?php }?>
	
								<td><?php if($row['delivery']==1){
									echo 'Standard';
								}else{
									echo 'Expedited';
								}?>
								</td>
								<?php if($row['delivery']==0){?>
								<td><?php echo $row['delivered_by'];?></td>
								<?php } ?>
								<td><strong><?php echo $row['num_plates'];?> </strong></td>
								<td><strong><?php echo $row['num_holders'];?> </strong></td>
							</tr>
						<?php } ?>
						<!--  End plates logos -->


						<?php if($row['type'] != 'Reusable Name Badges'){?>
							<tr>
								<td colspan="8"><h3>Logos</h3></td>
							</tr>
							<tr bgcolor="#D8D7E3">
								<td><strong>Path</strong></td>
								<td colspan="2"><strong>Images</strong></td>
								<td colspan="<?php echo $row['type'] == 'Engraved Name Tags' ? 4 : 5?>"><strong>Logo Placement</strong></td>
								<?php if($row['type'] == 'Engraved Name Tags'){?>
									<td><strong>Logo Engraving</strong></td>
								<?php }?>
							</tr>
							<?php
								$sql_logo = "SELECT * FROM logos WHERE id_order_wizard=".$row['id'];
								$result_logo = mysql_query($sql_logo);
								if($result_logo) {
									while($row_logo = mysql_fetch_assoc($result_logo)) {
							?>
										<tr>
											<td>
												<a target="_blank" href="<?php echo $base_url.$row_logo['path'];?>">View logos</a>
											</td>
											<td colspan="2">
												<a href="<?php echo $base_url.$row_logo['path'];?>" target="_blank">
													<img height="150" width="150" src="<?php echo $base_url.$row_logo['path'];?>">
												</a>
											</td>
											<td colspan="<?php echo $row['type'] == 'Engraved Name Tags' ? 4 : 5?>"><?php echo $row_logo['logo_placement'];?></td>
											<?php if($row['type'] == 'Engraved Name Tags'){?>
												<td><?php echo $row_logo['logo_engraving'];?></td>
											<?php } ?>
										</tr>
							<?php	}
								} ?>
							<tr>
								<td colspan="8"><h3>Text lines</h3></td>
							</tr>
							<tr bgcolor="#D8D7E3">
								<td><strong>Line</strong></td>
								<td><strong>Type</strong></td>
								<td colspan="3"><strong>font</strong></td>
								<td colspan="3"><strong>color</strong></td>
							</tr>
							<?php
							$sql_textline = "SELECT * FROM textlines WHERE id_order_wizard=".$row['id'];
	
							$result_textline = mysql_query($sql_textline);
							if($result_textline){
								$i=1;
								while($row_textline = mysql_fetch_assoc($result_textline))
								{
									?>
							<tr>
								<td>Line <?php echo $i;?></td>
								<td><?php echo $row_textline['type'];?></td>
								<td colspan="3"><?php echo $row_textline['font'];?></td>
								<td colspan="3">#<?php echo $row_textline['color'];?></td>
							</tr>
							<?php
							$i++;
								}
							} ?>
						<?php }?>
						<tr>
							<td colspan="8">
								<h3>
									Notes For The Designer (<span
										style="color: #0096D6; cursor: pointer;"
										onclick="show_hide('<?php echo $row["id"];?>')">Add New Note</span>)
								</h3></td>
						</tr>
						<tr>
							<td colspan="8">
								<div style="background-color: #E3F8EF;"
									id="div_show_<?php echo $row["id"];?>">
									<?php
									$arr_note  = explode("{note}",$row['notes']);
									foreach($arr_note as $notes){
										echo htmlspecialchars_decode($notes).'<br>';
									}
									?>
								</div>
								<div id="div_edit_<?php echo $row["id"]?>"
									style="display: none;">
									<textarea class="save" rows="2" cols="80"
										id="note_<?php echo $row["id"];?>"
										name="note_<?php echo $row["id"];?>"></textarea>
									</br>
									<!-- <input type="button" value="Save" name="Save" class="save" id="btnsave_<?php echo $row["id"];?>" /> -->
								</div> <?php //echo $row['notes'];?>
							</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
