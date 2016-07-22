<?php 
require_once('admin/conn/DB.php');
include('admin/conn/tablefuncs.php');
mysql_select_db($database_DB, $ravcodb);
session_start();
if($_REQUEST['id']==''){
	$pagetitle = "The Best Name Badges Blog About Tags - Best Name Badges";
	$metadescription = "";
	$metakeywords = "name badges, name tags, custom name badge, custom name tags, metal name tags, brushed aluminum name badges, plastic name tags, plastic name badges, color name badges, employee name tags, employee name badges, professional name tags, professional name badges"; 
}else {
	$id = $_REQUEST['id'];
	$query_title = "SELECT * FROM blogs WHERE id= $id AND active = 1 ORDER BY id DESC LIMIT 1 ";
	$result_title = mysql_query($query_title);
	$rows_title = mysql_fetch_assoc($result_title);
	$pagetitle = $rows_title['title'];
	$metadescription = $rows_title['meta_description'];
	$metakeywords = $rows_title['meta_keyword'];; 
}
?>
<?php 
if ($_SESSION["customerloginid"])
{
	include_once 'inc/header-auth.php';
} else {
	//include_once 'inc/header.php' ;
	include_once 'inc/header_new.php' ;
} ?>

<div id="hero" class="herobgnone">
  <img src="images/heroBG.jpg"  />
  <div id="heroHeader"  class="heroheadrnone">
    &nbsp;
  </div>
  

</div>
 
  
  <div id="content">
  	
    <div id="leftColumn">
    
      <?php include_once 'inc/leftcolumn3.php' ; ?>	

      <div class="need-fast clb" style="width: 180px;">
	        	<h3>Blog Posts:</h3>
	        	<div style="padding-top: 15px;">
	        	<?php 
					$query  = 'SELECT *FROM blogs WHERE active = 1 ORDER BY id DESC LIMIT 10';
					$result = mysql_query($query);
					$num_rows = mysql_num_rows($result);
					if($num_rows > 0){
					while($rows  = mysql_fetch_assoc($result)){
				?>
					<a href="<?php echo $base_url;?>/blog/<?php echo $rows['permanent_link'];?>_<?php echo $rows['id']?>"><?php echo $rows['link_anchor'];?></a><br />
				<?php } 
				  } ?>
				</div>
	        </div>
      
    </div><!-- end leftColumn -->
    
    <div id="mainContent">
    	
        <div class="subright flr">
	  <?php 
		if($_REQUEST['id']==''){
			//select the first record
			$sql_f = 'SELECT * FROM blogs WHERE active = 1 ORDER BY id DESC LIMIT 1 ';
			$result_f = mysql_query($sql_f);
			$rows_f = mysql_fetch_assoc($result_f);
		?>
		<h2><?php echo $rows_f['title']; ?></h2>
		<p>
			<?php echo $rows_f['content']?>
		</p>
		<?php 
		}else {		
			$id = $_REQUEST['id'];
			$query = "SELECT * FROM blogs WHERE id= $id AND active = 1 ORDER BY id DESC LIMIT 1 ";
			$result = mysql_query($query);
			$rows = mysql_fetch_assoc($result);
		?>
		<h2><?php echo $rows['title']; ?></h2>
		<p>
			<?php echo $rows['content']?>
		</p>
		<?php	
		}
	  ?>
	  </div>
    </div><!-- end mainContent -->
  
  </div><!-- end content -->
</div><!-- end wrapper -->

<div style="display: none;"><img src="/images/sevenReasonsButtonMinus.png" /></div>

<?php include_once 'inc/footer.php' ; ?>