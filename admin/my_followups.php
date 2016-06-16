<?php 
require_once('conn/DB.php');
include('conn/tablefuncs.php');
include('../include/config.php');
mysql_select_db($database_DB, $ravcodb);
session_start();
include('permision.php');
if (!$_SESSION["loginid"] || $_SESSION["userlevel"] < 2)
{?>
<script language="javascript">
parent.parent.location.href='admin.php';
window.close();
</script>
<?php }
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
//echo '<pre>'.print_r($arr_user).'</pre>';
// end of get list user.
if(!isset($_REQUEST['user_id'])){
	$sale_id = $_SESSION["loginid"];
}else {
	$sale_id = $_REQUEST['user_id'];
}

function doPages($page_size, $thepage, $query_string, $total=0) {
	    //per page count
	    $index_limit = 10;

	    //set the query string to blank, then later attach it with $query_string
	    $query='';

	    if(strlen($query_string)>0){
		$query = "&".$query_string;
	    }

	    //get the current page number example: 3, 4 etc: see above method description
	    $current = get_current_page();

	    $total_pages=ceil($total/$page_size);
	    $start=max($current-intval($index_limit/2), 1);
	    $end=$start+$index_limit-1;

	    echo '
	<div class="paging">';

	    if($current==1) {
		echo '<span class="prn">< Previous</span> ';
	    } else {
		$i = $current-1;
		echo '<a class="prn" title="go to page '.$i.'" rel="nofollow" href="'.$thepage.'?page='.$i.$query.'">< Previous</a> ';
		echo '<span class="prn">...</span> ';
	    }

	    if($start > 1) {
		$i = 1;
		echo '<a title="go to page '.$i.'" href="'.$thepage.'?page='.$i.$query.'">'.$i.'</a> ';
	    }

	    for ($i = $start; $i <= $end && $i <= $total_pages; $i++){
		if($i==$current) {
		    echo '<span>'.$i.'</span> ';
		} else {
		    echo '<a title="go to page '.$i.'" href="'.$thepage.'?page='.$i.$query.'">'.$i.'</a> ';
		}
	    }

	    if($total_pages > $end){
		$i = $total_pages;
		echo '<a title="go to page '.$i.'" href="'.$thepage.'?page='.$i.$query.'">'.$i.'</a> ';
	    }

	    if($current < $total_pages) {
		$i = $current+1;
		echo '<span class="prn">...</span> ';
		echo '<a class="prn" title="go to page '.$i.'" rel="nofollow" href="'.$thepage.'?page='.$i.$query.'">Next ></a> ';
	    } else {
		echo '<span class="prn">Next ></span> ';
	    }

	    //if nothing passed to method or zero, then dont print result, else print the total count below:
	    if ($total != 0){
			//prints the total result count just below the paging
			echo '(total '.$total.' results)</div>';
	    }

}//end of method doPages()
//Both of the functions below required

function check_integer($which) {
    if(isset($_REQUEST[$which])){
        if (intval($_REQUEST[$which])>0) {
            //check the paging variable was set or not,
            //if yes then return its number:
            //for example: ?page=5, then it will return 5 (integer)
            return intval($_REQUEST[$which]);
        } else {
            return false;
        }
    }
    return false;
}//end of check_integer()

function get_current_page() {
    if(($var=check_integer('page'))) {
        //return value of 'page', in support to above method
        return $var;
    } else {
        //return 1, if it wasnt set before, page=1
        return 1;
    }
}//end of method get_current_page()
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Best Name Badges - Content Management System</title>
<?php include("init_top.php");?>
<link href="<?php echo $base_url;?>/admin/includes/cms.css" rel="stylesheet" type="text/css" />

<script type="text/javascript">
    var GB_ROOT_DIR = "greybox/";
</script>


<script type="text/javascript" src="greybox/AJS.js"></script>
<script type="text/javascript" src="greybox/AJS_fx.js"></script>
<script type="text/javascript" src="greybox/gb_scripts.js"></script>
<link href="greybox/gb_styles.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="scripts/jquery-1.3.2.min.js"></script>

<script>
    
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
    
var Url = {
 
			// public method for url encoding
			encode : function (string) {
				return escape(this._utf8_encode(string));
			},
		 
			// public method for url decoding
			decode : function (string) {
				return this._utf8_decode(unescape(string));
			},
		 
			// private method for UTF-8 encoding
			_utf8_encode : function (string) {
				string = string.replace(/\r\n/g,"\n");
				var utftext = "";
		 
				for (var n = 0; n < string.length; n++) {
		 
					var c = string.charCodeAt(n);
		 
					if (c < 128) {
						utftext += String.fromCharCode(c);
					}
					else if((c > 127) && (c < 2048)) {
						utftext += String.fromCharCode((c >> 6) | 192);
						utftext += String.fromCharCode((c & 63) | 128);
					}
					else {
						utftext += String.fromCharCode((c >> 12) | 224);
						utftext += String.fromCharCode(((c >> 6) & 63) | 128);
						utftext += String.fromCharCode((c & 63) | 128);
					}
		 
				}
		 
				return utftext;
			},
		 
			// private method for UTF-8 decoding
			_utf8_decode : function (utftext) {
				var string = "";
				var i = 0;
				var c = c1 = c2 = 0;
		 
				while ( i < utftext.length ) {
		 
					c = utftext.charCodeAt(i);
		 
					if (c < 128) {
						string += String.fromCharCode(c);
						i++;
					}
					else if((c > 191) && (c < 224)) {
						c2 = utftext.charCodeAt(i+1);
						string += String.fromCharCode(((c & 31) << 6) | (c2 & 63));
						i += 2;
					}
					else {
						c2 = utftext.charCodeAt(i+1);
						c3 = utftext.charCodeAt(i+2);
						string += String.fromCharCode(((c & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
						i += 3;
					}
		 
				}
		 
				return string;
			}
		 
		}
$(document).ready(function(){
	$(".status_otpion").each(function(){			
			$(this).change(function(){
					var filter = $('#filter').val();
					//alert(filter);
					var status = $(this).val();
					var id_sign_up = $(this).attr('id');
					var notes = $("#note_"+id_sign_up).val();
					//alert(notes);
					$.ajax({
					 url : "savestatus.php",
					 type: 'POST',
					 data: {
						id_sign_up:id_sign_up,
						status: status,
						//note: Url.encode(notes)
					 },
					 success: function (data){
						//alert(data);
						alert('Changed status success!');				
						if(filter == 'Archive' || filter !='0'){
							location.reload(true);							
						}										
					 }
				}); 
			});
		});
		
	$(".tranfer_user_id").each(function(){
		$(this).change(function(){
			var tranfer_user_id  = $(this).val();
			var sign_up_id 	    = $(this).attr('id');
			$("#tranfer_user_id_value").val(tranfer_user_id);
			$("#tranfer_sign_up_value").val(sign_up_id);
			document.filterform.submit();
		});
	});	

	$(".text_note").each(function(){			
			$(this).change(function(){
					var filter = $('#filter').val();
					//alert(filter);
					var notes = $(this).val();
					var id_note_arr = $(this).attr('id').split('_');
					var id_note = id_note_arr[1];		
					var status = $("#"+id_note).val();
					$.ajax({
						 url : "savestatus.php",
						 type: 'POST',
						 data: {
							id_sign_up:id_note,
							status: status,
							note: Url.encode(notes),
							user_name: '<?php echo $_SESSION["username"]; ?>',
                            refresh: 1
						 },
						 success: function (data){
                            $("#note_"+id_note).val(" "); 	                                
							$("#div_show_"+id_note).html(htmlspecialchars_decode(data));					
							$("#div_show_"+id_note).show();							
							$("#div_edit_"+id_note).hide();   
							//alert(data);
							//alert('Changed status success!');
							//location.reload(true);																							
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

</script>
<style>

	.resize
	{
		width:259px;
		height:auto;
	}
	/*Paging style*/
	.paging { padding:10px 0px 0px 0px; text-align:center; font-size:13px;}
	.paging.display{text-align:right;}
	.paging a, .paging span {padding:2px 8px 2px 8px;}
	.paging span {font-weight:bold; color:#000; font-size:13px; }
	.paging a {color:#000; text-decoration:none; border:1px solid #dddddd;}
	.paging a:hover { text-decoration:none; background-color:#6C6C6C; color:#fff; border-color:#000;}
	.paging span.prn { font-size:13px; font-weight:normal; color:#aaa; }
	.paging a.prn { border:2px solid #dddddd;}
	.paging a.prn:hover { border-color:#000;}
	.paging p#total_count{color:#aaa; font-size:12px; padding-top:8px; padding-left:18px;}
	.paging p#total_display{color:#aaa; font-size:12px; padding-top:10px;}
</style>
<?php
	if(!isset($_SESSION['follow_status'])){
		$_SESSION['follow_status'] = 0;
	}
	if(isset($_REQUEST['follow_status'])){
		$_SESSION['follow_status'] = trim($_REQUEST['follow_status']);
	}
	if(isset($_REQUEST['tran_id']) && $_REQUEST['tran_id']>0 && isset($_REQUEST['tran_sign_up']) && $_REQUEST['tran_sign_up'] > 0){
		$data['sale_id'] = $_REQUEST['tran_id'];
		$where = "id=".$_REQUEST['tran_sign_up'];
		modify_record("customers",$data, $where);
	}
	//echo $_SESSION['filter_show'].'aa';
?>
</head>
<body>
<div align="center">
<?php include("header.php"); ?>
<?php 
	$rec_limit =30;
	if($_SESSION['follow_status']=='0'){
		$sql_count = "SELECT count(id) FROM customers WHERE follow_user_id={$sale_id}";													
	}else {
		$status = $_SESSION['status'];
		$sql_count = "SELECT count(id) FROM customers WHERE status ='{$status}'  AND follow_user_id={$sale_id}";
	}
	//echo $sql_count;
	$retval_count = mysql_query($sql_count);
	if(!$retval_count )
	{
	  die('Could not get data: ' . mysql_error());
	}
	$row = mysql_fetch_array($retval_count,MYSQL_NUM );
	$rec_count = $row[0];	
	$page = $_GET['page'];//curent page
	if ($page == "")  $page=1;
	$start = ($page-1)*$rec_limit;
	$total_page = ceil($rec_count/$rec_limit);
	//echo $total_page.'AAA';
	$left_rec = $rec_count - ($page * $rec_limit);
	if($_SESSION['follow_status']=='0'){
		//die('aa');
		
		$sql  = "SELECT * FROM customers WHERE follow_user_id= {$sale_id} ORDER BY ID DESC LIMIT {$start}, {$rec_limit}";											
	}else {
		$status_query = $_SESSION['follow_status'];
		$sql  = "SELECT * FROM customers WHERE   follow_user_id= {$sale_id} AND status ='{$status_query }' ORDER BY ID DESC LIMIT {$start}, {$rec_limit}";											
	}
	//echo  $_SESSION['follow_status'].'--'.$sql;
	$result 	= mysql_query($sql);										
	if(!$result )
	{
	  die('Could not get data: ' . mysql_error());
	}	
?>
<div class="xgrid">
<div style="min-height: 300px;" class="portlet x12">
	<div class="portlet-header"><h4>My Followups</h4></div>			
		<div class="portlet-content" >
<div style="float:left;font-size:12px">
		<form action="my_followups.php" name="filterform" method="post">
			<input type="hidden" id="tranfer_user_id_value" name="tran_id" value='0' />
			<input type="hidden" id="tranfer_sign_up_value" name="tran_sign_up" value='0' />
		Filter by:
				<select id="filter" name="follow_status" onchange="document.filterform.submit();">
					<option <?php if($_SESSION['follow_status']==0){ echo 'selected';}?> value="0">All</option>
					<option <?php if($_SESSION['follow_status']=='new'){ echo 'selected';}?> value="new">New</option>
					<option <?php if($_SESSION['follow_status']=='Call Back'){ echo 'selected';}?> value="Call Back">Call Back</option>
					<option <?php if($_SESSION['follow_status']=='Message'){ echo 'selected';}?> value="Message">Message</option>	
					<option <?php if($_SESSION['follow_status']=='Archive'){ echo 'selected';}?> value="Archive">Archive</option>					
				</select> 	
		User: <select id="user_id" name="user_id" onchange="document.filterform.submit();">
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
		</form>
									
	</div>
	<div style="clear:both"></div>
	<div style="margin-top:5px">
			<table border="0" class="customers">
				<tr algin="left" bgcolor="#D8D7E3">
					<td class="fieltable" width="200" algin="left" style="height: 25px;"><b>Name</b></td>
					<td class="fieltable" width="200" algin="left"><b>Address</b></td>
					<td class="fieltable"width="120" algin="left"><b>Phone</b></td>
					<td class="fieltable"width="200" algin="left"><b>Email</b></td>
					<td class="fieltable"><b>Company</b></td>
					<td class="fieltable"><b>Date/Time</b></td>					
					<td class="fieltable" algin="left"><b>Status</b></td>		
					<!-- <td><b>Transfer</b>  </td>	-->			
				</tr>
				<tr>
					<td colspan="8" style="height: 10px;"></td>
				</tr>
				<?php 
				$bgcolor = "WHITE";
				while($row  = mysql_fetch_assoc($result)){
				?>
				<tr bgcolor="<?php echo $bgcolor;?>">
					<td width="200"><a href="customer_view_admin.php?customerid=<?php echo $row['id'];?>"><?php echo $row['firstname'].' '.$row['lastname'];?></a></td>
					<td width="200">
						<?php if(!empty($row['street'])) echo  $row['street'].' <br />';  if(!empty($row['street2'])) echo  $row['street2'].' <br />'; ?>
                 				<?php echo  $row['city'].' '. $row['state'].' '. $row['zip']; ?> 
					</td>
					<td width="120"><?php echo $row['phone'];?></td>
					<td width="200"><?php echo $row['email'];?></td>
					<td>
						<?php echo $row['companyname'];?>
					</td>
					<td><?php echo $row['timestamp'];?></td>
						
					<td>
						<select class='status_otpion' id="<?php echo $row['id'];?>" name="status">							
								<option <?php if($row['status']=='new'){ echo 'selected';}?> value="new">New</option>
								<option <?php if($row['status']=='Call Back'){ echo 'selected';}?> value="Call Back">Call Back</option>
								<option <?php if($row['status']=='Message'){ echo 'selected';}?> value="Message">Message</option>								
								<option <?php if($row['status']=='Archive'){ echo 'selected';}?> value="Archive">Archive</option>	
							</select> 
					</td>	
					<!-- <td>
						<select id="<?php echo $row['id']?>" name="tranfer_user_id" class="tranfer_user_id">
							<option></option>		
							<?php 
								foreach($arr_user as $user){		
									if($sale_id == $user['id']){
										$sl = 'selected="selected"';
									}else{
										$sl = '';
									}									
									?>
									<option value="<?php echo $user['id']?>" <?php echo $sl ;?>><?php echo $user['username']?></option>
							<?php
								}
							?>	
						 </select> 				
					</td> -->							 
				</tr>	
				<tr bgcolor="<?php echo $bgcolor;?>">
					<td align="right" colspan="10">
							<a onclick="return GB_showCenter('', this.href,600,850)" href="customer_edit_admin.php?customerid=<?php echo $row['id']?>">edit</a> | <a onclick="return GB_showCenter('', this.href,800,1100)" href="admin_custstyle_view.php?customerid=<?php echo $row['id']?>">styles</a> | <a title="View Orders" href="order_view_admin.php?customerid=<?php echo $row['id']?>">orders</a> | <a title="View Print Orders" href="printorder_view_admin.php?customerid=<?php echo $row['id']?>">print orders</a> | <a rel="gb_page_center[1024, 500]"  href="batch_view_admin.php?customerid=<?php echo $row['id']?>&amp;batchstatus=pending">pending</a> | <a rel="gb_page_center[1024, 500]"  href="admin_change_customer_password.php?id=<?php echo $row['id']?>">change password</a>
					       	</td>
				</tr>
				<tr bgcolor="<?php echo $bgcolor; ?>">					
					<td colspan="10" class="end-row">	
                       <div style="background-color: #E3F8EF;" id="div_show_<?php echo $row["id"];?>">  
						Notes:<br />
						<?php 
							$arr_note  = explode("{note}",$row['notes']);
							//echo '<pre>'.print_r($arr_note).'</pre>';
							foreach($arr_note as $note){
								echo $note.'<br>';
							}
						?>							
                       </div> 
                        <div id="div_edit_<?php echo $row["id"]?>" style="display:none;">   
                            <textarea class="text_note" id="note_<?php echo $row['id'];?>" rows="3" cols="60"></textarea>
                        </div> 
						<div><span onclick="show_hide('<?php echo $row['id']?>')" style="color: #0096D6;cursor: pointer;">Add New Note</span></div>					
					</td>					
				</tr>
				<?php
					if ($bgcolor == "WHITE")
					{
						$bgcolor = "#D8D8D8";
					} else {
						$bgcolor = "WHITE";
					}	
				}	
				?>
			</table>
	</div>
	<div style="margin-top: 10px;">
		<?php		
			doPages($rec_limit ,'/admin/my_followups.php','',$rec_count);			
		?>
	</div>
</div>
</div>
</div>
</div>
</body>
</html>
