<?php
require_once('conn/DB.php');
include('conn/tablefuncs.php');
include('../include/config.php');
mysql_select_db($database_DB, $ravcodb);
session_start();
include('permision.php');
//if (!$_SESSION["loginid"] || $_SESSION["userlevel"] < 2)
if (!$_SESSION["loginid"])
{?>
<script language="javascript">
parent.parent.location.href='admin.php';
window.close();
</script>
<?php }

if($_REQUEST['del_name'] ==1){
	$bad_id =  $_REQUEST['bgd_id'];
	delete_record_secondary("batches", $_REQUEST["bgd_id"], "id");
}


if ($_REQUEST["norderid"])
{
	if(isset($_REQUEST["status"])){
		$data["status"] = $_REQUEST["status"];
	}
	if(isset($_REQUEST['priority'])){
		if($_REQUEST['priority'] == 0){
			$data['priority'] = 1;
		}else{
			$data['priority'] = 0;
		}
	}

	if(isset($_REQUEST['proof_prod'])){
		$data['proof_product'] =$_REQUEST['proof_prod'];
		$data['new_old']   	 = 'old';
	}


	$where = "id = ".$_REQUEST["norderid"];
	modify_record("printorders", $data, $where);


}

if ($_REQUEST["delid"])
{
	if(check('delete',3)){
		delete_record_secondary("printorders", $_REQUEST["delid"], "id");
		delete_record_secondary("batches", $_REQUEST["delid"], "printorderid");
	}else {
		die('You don\'t have permision to perform this action.');
	}
}

if ($_REQUEST["customerid"])
{
	$criteria = $_REQUEST["customerid"];
	$orderid = $_REQUEST["orderid"];

	if ($orderid)
	{
		$qry = "SELECT printorders.*, customers.id AS custid, customers.firstname AS firstname, customers.lastname AS lastname, customers.companyname AS companyname, customers.street, customers.street2, customers.city, customers.state, customers.zip AS zipcode, customers.email, customers.phone FROM printorders LEFT JOIN customers ON (customers.id = printorders.custid) WHERE printorders.custid=$criteria AND printorders.id = $orderid AND printorders.paid = 1
ORDER BY id DESC";
	} else {
		$qry = "SELECT printorders.*, customers.id AS custid, customers.firstname AS firstname, customers.lastname AS lastname, customers.companyname AS companyname, customers.street, customers.street2, customers.city, customers.state, customers.zip AS zipcode, customers.email, customers.phone FROM printorders LEFT JOIN customers ON (customers.id = printorders.custid) WHERE printorders.custid=$criteria AND printorders.paid = 1
ND printorders.new_old = 'new'
 ORDER BY id DESC";
	}
} else {
	$per_page = 150;
	$qry = "SELECT printorders.*, customers.id AS custid, customers.firstname AS firstname, customers.lastname AS lastname, customers.companyname AS companyname, customers.street, customers.street2, customers.city, customers.state, customers.zip AS zipcode, customers.email, customers.phone FROM printorders LEFT JOIN customers ON (customers.id = printorders.custid) WHERE printorders.paid = 1
AND printorders.new_old = 'new'
ORDER BY id DESC 
";
	//echo $qry;
	$result = mysql_query($qry);
	$count = mysql_num_rows($result);
	$pages = ceil($count/$per_page);
}

$type_list = array(
	'1'		=> 'DTC',
	'2'		=> 'Photo Id',
	'3'		=> 'Direct Jet',
	'4'		=> 'UV',
	'5'		=> 'Laser',
	'6'		=> 'Reusable',
	'0'		=> 'Other'
);
$status_list = array(
	'New'		=> 'New',
	'Printed'	=> 'Printed',
	'Waiting'	=> 'Waiting',
	'See Note'	=> 'See Note'
);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>View Print Orders</title>
<?php include("init_top.php");?>
<link href="<?php echo $base_url?>/admin/includes/cms.css"
	rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css"
	href="<?php echo $base_url?>/admin/calendar/calendar-win2k-1.css" />

<script type="text/javascript"
	src="<?php echo $base_url?>/admin/scripts/jquery-1.3.2.min.js"></script>
<!-- main calendar program -->
<script type="text/javascript"
	src="<?php echo $base_url?>/admin/calendar/calendar.js"></script>

<!-- language for the calendar -->
<script type="text/javascript"
	src="<?php echo $base_url?>/admin/calendar/lang/calendar-en.js"></script>

<!-- the following script defines the Calendar.setup helper function, which makes
     adding a calendar a matter of 1 or 2 lines of code. -->
<script type="text/javascript"
	src="<?php echo $base_url?>/admin/calendar/calendar-setup.js"></script>

<script type="text/javascript">
    var GB_ROOT_DIR = "greybox/";
</script>

<script type="text/javascript"
	src="<?php echo $base_url?>/admin/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		editor_selector : "mceEditor",
		plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",

		// Theme options
		theme_advanced_buttons1 : "bold,italic,underline,link,styleselect,formatselect,fontselect,fontsizeselect,justifyleft,justifycenter,justifyright",
		theme_advanced_buttons2 : "link,unlink,anchor,forecolor,backcolor",
		theme_advanced_buttons3 : "",
		theme_advanced_buttons4 : "",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
		content_css : "css/content.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Style formats
		style_formats : [
			{title : 'Bold text', inline : 'b'},
			{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
			{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
			{title : 'Example 1', inline : 'span', classes : 'example1'},
			{title : 'Example 2', inline : 'span', classes : 'example2'},
			{title : 'Table styles'},
			{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
		],

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
</script>

<script type="text/javascript"
	src="<?php echo $base_url?>/admin/greybox/AJS.js"></script>
<script type="text/javascript"
	src="<?php echo $base_url?>/admin/greybox/AJS_fx.js"></script>
<script type="text/javascript"
	src="<?php echo $base_url?>/admin/greybox/gb_scripts.js"></script>
<script type="text/javascript"
	src="<?php echo $base_url?>/admin/scripts/jquery-1.3.2.min.js"></script>


<link href="<?php echo $base_url?>/admin/greybox/gb_styles.css"
	rel="stylesheet" type="text/css" />

<script language="javascript">

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

function OpenFileManager(name,subtext,subtext2,faster,frame,dome)
{
	var strUrl="<?php echo $base_url?>/admin/edit_tfd.php?name="+name+"&subtext="+subtext+"&subtext2="+subtext2+"&faster="+faster+"&frame="+frame+"&dome="+dome;
	window.status="Open";
	window.open(strUrl,"View","width=500,height=400,toolbar=yes,scrollbars=yes");
}
$(document).ready(function()

{

	//Display Loading Image
	function Display_Load()

	{

		$("#loading").fadeIn(900,0);

		$("#loading").html('<img src="loadAnm.gif" />');

	}
	//Hide Loading Image
	function Hide_Load()

	{

		$("#loading").fadeOut('slow');

	};


	//Default Starting Page Results
	$("#pagination li:first").css({'color' : '#FF0084'}).css({'border' : 'none'});

	Display_Load();

	$("#order-list").load("printorder_view_paing.php?page=1", Hide_Load());
	//Pagination Click
	$("#pagination li").click(function(){
		
		Display_Load();
		//CSS Styles
		$("#pagination li")

			.css({'border' : 'solid #dddddd 1px'})

			.css({'color' : '#0063DC'});



		$(this)

		.css({'color' : '#FF0084'})

		.css({'border' : 'none'});
		//Loading Data
		var pageNum = this.id;

		$("#order-list").load("printorder_view_paing.php?page=" + pageNum,Hide_Load());

	});

	$(".save").each(function(){
		$(this).change(function(){
			var id_arr = $(this).attr('id').split('note_');
			var id = id_arr[1];
			//var notes =  $("#note_"+id).val();
			var notes =  $(this).val();			
			//alert(notes);			
			//var note =  tinyMCE.get("note_"+id).getContent();
			$.ajax({
				url: 'savenote.php',
				data: {
					id: id,
					note: notes,
					user_name: '<?php echo $_SESSION["username"]; ?>',
				        refresh: 1	
				},
				success: function (data){	        
					$("#note_"+id).val(" "); 			
					$("#div_show_"+id).html(htmlspecialchars_decode(data));					
					$("#div_show_"+id).show();							
					$("#div_edit_"+id).hide();					
				}
			});
		});
	});	
});
function show_hide(id)
{
	//alert(id);
	$("#div_show_"+id).hide();
	$("#div_edit_"+id).show();
}
function reloadIt()
{
	window.location = "printorder_view_admin.php";
}
</script>
</head>

<body>
<?php include("header.php");  ?>
	<div class="xgrid">
		<div style="min-height: 300px;" class="portlet x12">
			<div class="portlet-header">
				<h4>View Print Orders</h4>
			</div>
			<div class="portlet-content">

			<?php if(!isset($_REQUEST["customerid"])){?>
				<form action="printorder_search_view_admin.php" method="post"
					name="customer_search_form">
					<table class="search-box-tabletype">
						<tr>
							<td colspan="9"><h3>Search form</h3></td>
						</tr>
						<tr>
							<td>Customer Name:</td>
							<td><input type="text" value="" name="customer_name" /></td>
							<td>Type:</td>
							<td rowspan="4"><select name="search_type[]" multiple size="7"
								style="width: 232px">
								<?php foreach($type_list as $key=>$value) {?>
									<option value="<?php echo $key;?>">
									<?php echo $value;?>
									</option>
									<?php }?>
							</select>
							<td>Pro Status</td>
							<td rowspan="4">
								<select name="search_prod_status[]" multiple size="4" style="width: 232px">
									<?php foreach($status_list as $key=>$value) {?>
										<option value="<?php echo $key;?>">
										<?php echo $value;?>
										</option>
									<?php }?>
								</select>
							</td>
						</tr>
						<tr>
							<td>Print order number:</td>
							<td><input type="text" value="" name="print_order_number" /></td>
						</tr>
						<tr>
							<td>Company name:</td>
							<td><input type="text" name="company_name"
								value="<?php if(isset($_REQUEST['company_name'])){ echo $_REQUEST['company_name']; }?>" />
							</td>
						</tr>
						<tr>
							<td>Date:</td>
							<td><input type="text" value="" name="date" id="date_search" /></td>
						</tr>
                        <tr>
                            <td>Order Date:</td>
                            <td><input type="text" value="" name="created_date" id="created_date_search" /></td>
                        </tr>
						<tr>
							<td><input type="submit" name="Search" value="Search" /></td>
						</tr>
					</table>
					<script type="text/javascript">
	  Calendar.setup(
	    {
	      inputField  : "date_search",         // ID of the input field
	      ifFormat    : "%Y-%m-%d"    // the date format
	    }
	  );
      Calendar.setup(
              {
                  inputField  : "created_date_search",         // ID of the input field
                  ifFormat    : "%Y-%m-%d"    // the date format
              }
      );
	</script>
				</form>
				<?php }?>
				<?php if(!isset($_REQUEST["customerid"])){?>
				<div align="center" style="margin-left: 260px">
					<ul id="pagination">
					<?php
					//Pagination Numbers

					for($i=1; $i<=$pages; $i++)

					{

						echo '<li id="'.$i.'">'.$i.'</li>';

					}
					?>
					</ul>
					<h4>
						Total pages:
						<?php echo $pages;?>
					</h4>
				</div>
				<div style="clear: both;"></div>
				<div id="loading"></div>
				<div id="order-list"></div>
				<div align="center" style="margin-left: 260px">
					<ul id="pagination">
					<?php
					//Pagination Numbers

					for($i=1; $i<=$pages; $i++)

					{

						echo '<li id="'.$i.'">'.$i.'</li>';

					}
					?>
					</ul>
					<h4>
						Total pages:
						<?php echo $pages;?>
					</h4>
				</div>
				<?php }else {
					$criteria	= $_REQUEST["customerid"];
					$orderid 	= $_REQUEST["orderid"];
					if ($orderid)
					{
						$qry = "SELECT printorders.*, customers.id AS custid, customers.firstname AS firstname, customers.lastname AS lastname, customers.companyname AS companyname, customers.street, customers.street2, customers.city, customers.state, customers.zip AS zipcode, customers.email, customers.phone FROM printorders LEFT JOIN customers ON (customers.id = printorders.custid) WHERE printorders.custid=$criteria AND printorders.id = $orderid AND printorders.paid = 1 ORDER BY id DESC";
					} else {
						$qry = "SELECT printorders.*, customers.id AS custid, customers.firstname AS firstname, customers.lastname AS lastname, customers.companyname AS companyname, customers.street, customers.street2, customers.city, customers.state, customers.zip AS zipcode, customers.email, customers.phone FROM printorders LEFT JOIN customers ON (customers.id = printorders.custid) WHERE printorders.custid=$criteria AND printorders.paid = 1 ORDER BY id DESC";
					}
					$printorders	= mysql_query($qry) or die('Query failed: ' . mysql_error());
					$printorder		= mysql_fetch_assoc($printorders);
					?>
				<form action="printorder_add_admin.php"
					enctype="multipart/form-data" method="post" name="addprintorder">
					<input type="hidden" name="addprintorderinfo" value="1" /> <input
						type="hidden" id="printorder_id" value="<?php echo $orderid;?>" />
					<table width="800" frame="box" border="0" align="center">
						<?php if ($_REQUEST["customerid"]) { ?>
						<tr>
							<td colspan="1"><a
								href="customer_view_admin.php?customerid=<?php echo $printorder["custid"]; ?>"><strong><?php echo $printorder["companyname"]."<br>".$printorder["firstname"]." ".$printorder["lastname"]; ?>
								</strong> </a><br /> <?php echo $printorder["street"]; ?> <?php if ($printorder["street2"]) { echo "<br>".$printorder["street2"]; } ?><br />
								<?php echo $printorder["city"].", ".$printorder["state"]." ".$printorder["zipcode"]; ?>
							</td>
							<td colspan="4" align="right"><strong><?php echo $printorder["email"]."<br>".$printorder["phone"]; ?>
							</strong></td>
						</tr>
						<?php do { ?>

						<tr bgcolor="#D8D7E3">
							<td class="fieltable" width="20%" align="center"><strong>Date</strong>
							</td>
							<td class="fieltable" align="center" width="90"><strong>Print
									Order Number</strong></td>
							<td class="fieltable" align="center" width="153"><strong>Operations</strong>
							</td>
							<td class="fieltable" align="center" width="153"><strong>Type</strong>
							</td>
							<td class="fieltable" align="center" width="153"><strong>Prod Status</strong>
							</td>
						</tr>
						<tr bgcolor="<?php echo $bgcolor; ?>">
							<td width="20%" align="center"><a
								href="printorder_view_admin.php?customerid=<?php echo $printorder["custid"]; ?>&orderid=<?php echo $printorder["id"]; ?>"><?php echo $printorder["timestamp"]; ?>
							</a></td>

							<?php
							if ($printorder) {
								$qry = "SELECT batches. * ,batches.id as bid, batches.name as bname, batches.subtext as bsubtext, batches.subtext2 as bsubtext2, custstyle. * , custstyle.id AS custid, styles. * , styles.name AS sname, colors. * , colors.name AS cname
FROM batches
LEFT JOIN custstyle ON ( custstyle.id = batches.custstyleid ) 
LEFT JOIN styles ON ( styles.id = custstyle.styleid ) 
LEFT JOIN colors ON ( colors.id = custstyle.color ) 
WHERE batches.printorderid = ".$printorder["id"];
								//echo $qry."<BR>";
								$badges = mysql_query($qry) or die('Query failed: ' . mysql_error());
								$badge = mysql_fetch_assoc($badges);
								?>
							<td width="20%" align="center"><font color="#FF0000"><strong><?php echo $printorder["id"]; ?>
								</strong> </font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a
								href="export_txt_file.php?orderid=<?php echo $printorder["id"]; ?>"
								title="Export TXT File" rel="gb_page_center[600, 200]">export
									order to txt file</a></td>
							<td width="20%" align="center"><a
								href="add_tfd.php?cusid=<?php echo $_REQUEST["customerid"];?>&printorderid=<?php echo $printorder["id"]?>"
								title="Add Name" rel="gb_page_center[auto, auto]">Add Name</a> |
								<?php if(check('delete',3)){?><a
								href="printorder_view_admin.php?delid=<?php echo $printorder["id"]; ?>"
								onClick="javascript:return confirm('Are you sure you want to delete this print order?')">delete</a>
								| <?php } if ($printorder["status"]) { ?><a
								href="printorder_view_admin.php?status=0&customerid=<?php echo $printorder["custid"]; ?>&norderid=<?php echo $printorder["id"]; ?>"
								style="color: green;">complete</a> <?php } else { ?> <a
								href="completed_order.php?status=1&customerid=<?php echo $printorder["custid"]; ?>&norderid=<?php echo $printorder["id"]; ?>&page=1"
								title="Completed Order" rel="gb_page_center[550,200]"
								style="color: red;">incomplete</a> <?php } ?> | <a
								href="p-receipt.php?rid=<?php echo $printorder["id"]; ?>"
								target="_blank">receipt</a>
							</td>
							<td align="center">
								<select id="printorder_type">
									<?php foreach($type_list as $key=>$type) {?>
										<option value="<?php echo $key?>"
											<?php echo $key==$printorder['type']?"selected":"";?>>
											<?php echo $type;?>
										</option>
									<?php }?>
								</select>
							</td>
							<td align="center">
								<select id="prod_status">
									<?php foreach($status_list as $key=>$status) {?>
										<option value="<?php echo $key?>"
											<?php echo $key==$printorder['prod_status']?"selected":"";?>>
											<?php echo $status;?>
										</option>
									<?php }?>
								</select>
							</td>
						</tr>
						<tr bgcolor="<?php echo $bgcolor; ?>">
							<td colspan="5">

								<table width="100%">

								<?php if($printorder['invoice_id'] == 0){?>
								<?php if ($badge) { ?>
									<tr>
										<td><strong>Customer Style Name</strong></td>
										<td><strong>Name</strong></td>
										<td><strong>subtext</strong></td>
										<td><strong>subtext 2</strong></td>
										<td><strong>Fastener</strong></td>
										<td><strong>Frame</strong></td>
										<td><strong>Dome</strong></td>
										<td><strong>Action</strong></td>
									</tr>
									<?php do { ?>
									<tr>
										<td><a
											href="custstyle_viewentry_admin.php?styleid=<?php echo $badge["custid"]; ?>&bid=<?php echo $badge["bid"]?>"
											title="Edit Customer" rel="gb_page_center[850, 600]"><?php echo $badge["stylename"]; ?>
										</a></td>
										<td><?php echo $badge["bname"]; ?></td>
										<td><?php echo $badge["bsubtext"]; ?></td>
										<td><?php echo $badge["bsubtext2"]; ?></td>
										<td><?php echo $badge["fastener"]; ?></td>
										<td><?php echo $badge["frame"]; ?></td>
										<td><?php if($badge["dome"]==1){ echo 'Yes';}else{ echo 'No';} ?>
										</td>
										<td><a
											href="edit_tfd.php?cusid=<?php echo $_REQUEST["customerid"];?>&bid=<?php echo $badge['bid']?>&printorderid=<?php echo $printorder["id"]?>&name=<?php echo $badge["bname"];?>&subtext=<?php echo $badge["bsubtext"];?>&subtext2=<?php echo $badge["bsubtext2"];?>&fastener=<?php echo $badge["fastener"];?>&frame=<?php echo $badge["frame"];?>&dome=<?php echo $badge["dome"];?>"
											title="Edit text,frame, dome"
											rel="gb_page_center[auto, auto]">Edit</a> | <a
											onclick="javascript:return confirm('Are you sure you wish to delete?')"
											href="printorder_view_admin.php?customerid=<?php echo $criteria; ?>&orderid=<?php echo $orderid;?>&del_name=1&bgd_id=<?php echo $badge['bid'];?>">Delete</a>
										</td>

										<?php } while ($badge = mysql_fetch_assoc($badges)); ?>
										<tr>
											<td>&nbsp;</td>
											<td colspan="6"><strong><?php echo $badge["notes"]; ?> </strong>
											</td>
										</tr>

										<?php } else { ?>
										<tr>
											<td><h3>No badges on this order?</h3></td>
										</tr>
										<?php }
								}else {
									?>
										<tr>
											<td><a
												href="admin_view_invoice.php?invoice_id=<?php echo $printorder['invoice_id'];?>&customer_id=<?php echo $printorder['custid'];?>">View
													This Invoice</a></td>
										</tr>
										<?php
								}
								?>

										<tr>
											<td><b>Customer Note</b></td>
										</tr>
										<?php if($printorder['customer_note']!="") {?>
										<tr>
											<td colspan="8"><?php echo $printorder['customer_note'];?></td>
										</tr>
										<?php }?>
										<tr>
											<td><b>Tracking</b></td>
										</tr>
										<tr>
											<td><?php
											if($printorder['payment_method']==0 && $printorder['tracking_number'] > 0){ $link ='<a href="http://trkcnfrm1.smi.usps.com/PTSInternetWeb/InterLabelInquiry.do?origTrackNum='.$printorder['tracking_number'].'" target="_blank">'.$printorder['tracking_number'].' - USPS</a>';}
											else if($printorder['payment_method']==1 && $printorder['tracking_number'] > 0){ $link = '<a href="http://www.fedex.com/Tracking?tracknumbers='.$printorder['tracking_number'].'&cntry_code=us&clienttype=ivother&" target="_blank">'.$printorder['tracking_number'].' - FedEx</a>';}
											else{ $link = 'Unavailable ';}
											?> <?php echo $link;?>
											</td>
										</tr>
										<tr>
											<td colspan="8"><b>Internal Notes</b>(<span
												style="color: #0096D6; cursor: pointer;"
												onclick="show_hide('<?php echo $printorder["id"];?>')">Add
													New Note</span>)
												<div
													style="background-color: #E3F8EF; padding: 5px 0 0 5px; margin-top: 5px;"
													id="div_show_<?php echo $printorder["id"];?>">
													<?php
													$arr_note  = explode("{note}",$printorder['note']);
								//echo '<pre>'.print_r($arr_note).'sssss</pre>';	
								//echo '<pre>'.print_r($arr_note).'</pre>';
								foreach($arr_note as $notes){
									echo htmlspecialchars_decode($notes).'<br>';
								}
							?>
												</div>
												<div id="div_edit_<?php echo $printorder["id"]?>"
													style="display: none;">
													<textarea class="save" rows="2" cols="80"
														id="note_<?php echo $printorder["id"];?>"
														name="note_<?php echo $printorder["id"];?>"></textarea>
													</br>
													<!-- <input type="button" value="Save" name="Save" class="save" id="btnsave_<?php echo $printorder["id"];?>" /> -->
												</div>
											</td>
										</tr>
								
								</table> <?php } else {?>
								<h3>No Print Orders</h3> <?php } ?>
							</td>
						</tr>
						<?php } while ($printorder = mysql_fetch_assoc($printorders)); ?>
						<?php }?>
						<?php	
}?>
					</table>
					<script>
$(document).ready(function(){
	$('#printorder_type').change(function(){
		var type 	= $(this).val();
		var id		= $('#printorder_id').val();
		$.post(
			"<?php echo $base_url?>/admin/change_printorder_type.php",
			{id: id, type: type, option: 'change_type'},
			function(data){
			}
		);
	});
	$('#prod_status').change(function(){
		var status 	= $(this).val();
		var id		= $('#printorder_id').val();
		$.post(
			"<?php echo $base_url?>/admin/change_printorder_type.php",
			{id: id, status: status, option: 'change_status'},
			function(data){
			}
		);
	});
});
</script>
			
			</div>
		</div>
	</div>

</body>
</html>
