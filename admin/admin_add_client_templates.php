<?php 
require_once('conn/DB.php');
include('conn/tablefuncs.php');
include('../include/config.php');
mysql_select_db($database_DB, $ravcodb);
session_start();
if (!$_SESSION["loginid"] || $_SESSION["userlevel"] < 2)
{?>
<script language="javascript">
parent.parent.location.href='admin.php';
window.close();
</script>
<?php }?>
<?php 
	$message = '';
	if($_REQUEST['private'] !=''){
		// process upload 		
		if ($_FILES["proof"])
		{	
			if ($_FILES["proof"]["name"]) 
			{
				$idir = '../output';
				$idir1 = '../proofs';
				srand ((double) microtime( )*1000000);
				$random_number = rand(1000000000,9999999999);
				$date = getdate();
				$url = $date[0].$random_number."_".$_FILES["proof"]['name'];
				
				$file_ext = strrchr($_FILES['proof']['name'], '.');   // Get The File Extention In The Format Of , For Instance, .jpg, .gif or .php 
				$file_ext = strtolower($file_ext);
				if ($file_ext == ".jpg" || $file_ext == ".jpeg" || $file_ext == ".pjpeg" || $file_ext == ".gif" || $file_ext == ".png" || $file_ext == ".bmp") 
				{ 
					
					$copy = copy($_FILES["proof"]['tmp_name'], "$idir/" . $date[0].$random_number."_".$_FILES["proof"]['name']);   // Move Image From Temporary Location To Permanent Location
					$copy = copy($_FILES["proof"]['tmp_name'], "$idir1/" . $date[0].$random_number."_".$_FILES["proof"]['name']);   // Move Image From Temporary Location To Permanent Location 
					$_POST['proof'] = $date[0].$random_number."_".$_FILES["proof"]['name'];
				}	
			}		
		}	
		unset($_POST['Add']);
		add_record("templates", $_POST);
		$message = 'Insert blog successful';
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>View Print Orders</title>
<?php include("init_top.php");?>
<link href="<?php echo $base_url?>/admin/includes/cms.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css"  href="<?php echo $base_url?>/admin/calendar/calendar-win2k-1.css"  />

<script type="text/javascript" src="<?php echo $base_url?>/admin/scripts/jquery-1.3.2.min.js"></script>
<!-- main calendar program -->
<script type="text/javascript" src="<?php echo $base_url?>/admin/calendar/calendar.js"></script>

<!-- language for the calendar -->
<script type="text/javascript" src="<?php echo $base_url?>/admin/calendar/lang/calendar-en.js"></script>

<!-- the following script defines the Calendar.setup helper function, which makes
     adding a calendar a matter of 1 or 2 lines of code. -->
<script type="text/javascript" src="<?php echo $base_url?>/admin/calendar/calendar-setup.js"></script>

<script type="text/javascript">
    var GB_ROOT_DIR = "greybox/";
</script>

<script type="text/javascript" src="<?php echo $base_url?>/admin/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		editor_selector : "mceEditor",
		plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",

		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",
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
<script type="text/javascript" src="<?php echo $base_url?>/admin/greybox/AJS.js"></script>
<script type="text/javascript" src="<?php echo $base_url?>/admin/greybox/AJS_fx.js"></script>
<script type="text/javascript" src="<?php echo $base_url?>/admin/greybox/gb_scripts.js"></script>
<script type="text/javascript" src="<?php echo $base_url?>/admin/scripts/jquery-1.3.2.min.js"></script>
<link href="<?php echo $base_url?>/admin/greybox/gb_styles.css" rel="stylesheet" type="text/css" />

<body>
<?php include("header.php"); ?>
<div class="xfluid" style="width: 95%;margin-left: 2.50%;">
<div style="min-height: 300px;" class="portlet x12">
	<div class="portlet-header"><h4>Add Template</h4></div>			
		<div class="portlet-content" >
		
<form action="" method="post" name="add_template" id="add_template" enctype="multipart/form-data">	
	<div align="center"><h2><?php echo $message;?></h2></div>
	<table  width="800" frame="box" border="0" align="center">
	<?php /*
		<tr>
			<td colspan="5"><h3>Add Template</h3></td>
		</tr>
	*/?>
		<tr>
			<td><strong>Page Title </strong></td>
			<td><input style  ="width:400px;" type="text" name="title" value="" /></td>
		</tr>
		<tr>
			<td><strong>Permanent link</strong></td>
			<td><input style  ="width:400px;" type="text" name="permanent_link" value=""/></td>
		</tr>
		
		<tr>
			<td><strong>Link Anchor </strong></td>
			<td><input style  ="width:400px;" type="text" name="link_anchor" value=""/></td>
		</tr>
		
		<tr>
			<td><strong>Meta Description  </strong></td>
			<td><textarea name="meta_description" cols="80" rows="3"></textarea></td>
		</tr>
		
		<tr>
			<td><strong>Meta Keywords  </strong></td>
			<td><textarea name="meta_keyword" cols="80" rows="3"></textarea></td>
		</tr>

		
		<tr>
			<td><strong>Text area</strong></td>
			<td><textarea class="mceEditor" name="content" cols="80" rows="15"></textarea></td>
		</tr>
		<tr>
			<td>Upload proof</td>
			<td><input type="file" name="proof" value="" /></td>
		</tr>
		<tr>
			<td>Style name</td>
			<td><input type="text" name="stylename" value=""></td>
		</tr>
		<tr>
			<td>Frame</td>
			<td><input type="radio" checked="checked" name="frame" value="1"> None <input type="radio" name="frame" value="2"> Silver <input type="radio" name="frame" value="3"> Gold</td>
		</tr>
		<tr>
			<td>Dome</td>
			<td><input type="radio" name="dome" value="1"> Yes <input checked="checked" type="radio" name="dome" value="0"> No</td>
		</tr>
		<tr>
			<td>Private (?)</td>
			<td>
				<select name="private">
					<option value="0">Public</option>
					<option value="1">Private</option>					
				</select>
			</td>
		</tr>
		<tr>
			<td align="right"><input style="font-size:12px;" class="btn btn-small" type="submit" name="Add" value="Add"></td>
			<td><input style="font-size:12px;" class="btn btn-small" type="reset" name="Cancel" value="Cancel"></td>
		</tr>
	</table>
</form>
</div>
</div>
</div>
</body>
</html>