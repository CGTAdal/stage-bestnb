<?php 
require_once('conn/DB.php');
include('conn/tablefuncs.php');
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
<?php include("scripts/collapse.js"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Best Name Badges - Content Management System</title>
<link href="includes/cms.css" rel="stylesheet" type="text/css" />

<script type="text/javascript">
    var GB_ROOT_DIR = "greybox/";
</script>


<script type="text/javascript" src="greybox/AJS.js"></script>
<script type="text/javascript" src="greybox/AJS_fx.js"></script>
<script type="text/javascript" src="greybox/gb_scripts.js"></script>
<link href="greybox/gb_styles.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="scripts/jquery-1.3.2.min.js"></script>
<script>
	$(document).ready(function(){
		$(".status_otpion").each(function(){			
			$(this).change(function(){
					var filter = $('#filter').val();
					//alert(filter);
					var status = $(this).val();
					var id_sign_up = $(this).attr('id');
					$.ajax({
					 url : "savestatus.php",
					 type: 'POST',
					 data: {
						id_sign_up:id_sign_up,
						status: status
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
		})
	});
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
	if(!isset($_SESSION['status'])){
		$_SESSION['status'] = 0;
	}
	if(isset($_REQUEST['status'])){
		$_SESSION['status'] = trim($_REQUEST['status']);
	}
	//echo $_SESSION['filter_show'].'aa';
?>
</head>
<body>
	<div align="center">
	<?php include("header.php"); ?>
	</div>
</body>
</html>
