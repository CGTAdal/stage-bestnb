<?php 
require_once('conn/DB.php');
include('conn/tablefuncs.php');
mysql_select_db($database_DB, $ravcodb);
session_start();
include('permision.php');
if (isset($_REQUEST["logout"]))
{
	unset($_SESSION["loginid"]);
	unset($_SESSION["userlevel"]);
	unset($_SESSION["username"]);
}
if (!$_SESSION["loginid"] )
{
	header("location: login.php");
}
?>

<?php include("scripts/collapse.js"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Best Name Badges - Content Management System</title>
<?php include("init_top.php");?>

<script type="text/javascript">
    var GB_ROOT_DIR = "greybox/";
</script>


<script type="text/javascript" src="greybox/AJS.js"></script>
<script type="text/javascript" src="greybox/AJS_fx.js"></script>
<script type="text/javascript" src="greybox/gb_scripts.js"></script>
<link href="greybox/gb_styles.css" rel="stylesheet" type="text/css" />

<style>

.resize
{
	width:259px;
	height:auto;
}
</style>
</head>
<body>
<?php include("header.php"); ?>
<div id="content" class="xfluid">
<?php include("dashboard.php");?>
</div>

<?php
/*
<div id="content">
</div>
<div align="center">
<p>&nbsp;</p>
<table width="680" border="0" cellpadding="0" cellspacing="0" id="cmsborder" align="center">
  <!--DWLayoutTable-->
  <tr>
    <td height="54" valign="top" align="center"><table width="90%" border="0" cellpadding="0" cellspacing="0" align="center">
      <!--DWLayoutTable-->
      <tr>

          <td width="680" valign="top" align="center"><table width="91%" border="0" cellpadding="0" cellspacing="0" align="center">
            <!--DWLayoutTable-->
            <tr>
				<td><img src="images/generic_logo.gif" class="resize"/></td>
			</tr>
			<tr>
              <td width="100%" height="23" valign="top" id="head1_sp1"><!--DWLayoutEmptyCell-->&nbsp;</td>
              </tr>
            <tr>
              <td height="27" valign="top" id="topright_sp1"><span class="header1_text">&nbsp;Best Name Badges - Administration</span><br />
                <br />
				<table width="712">
					<tr>
						<td width="50%">
						<?php if ($_SESSION["username"]) { ?>
		                  <strong>Welcome - <?php echo $_SESSION["username"]; ?></strong>
						<?php } else { ?>
							&nbsp;
						<?php } ?>
						</td>
						<td align="right"><a href="admin.php?logout=1">logout</a></td>
					</tr>
				</table>
				</td>
			
            </tr>
			<tr>
				<td>
				

				</td>
			</tr>
			<tr>
			  <td class="text" align="center"><br />
			    Click on each section header or +/- to toggle the selection for updating.
			      <br />
			      <br />
				  <br />
			      <table border="1" frame="border" width="80%" bgcolor="#E8E8E8">
					<tr>
				  		<td align="center">
				  			<table align="center" valign width="100%" border="0" frame="border">
								
						
								
				
                                <tr class="header">
	                    			<td><a name="testexpand" onclick="expandcontent('customers')" style="cursor:hand; cursor:pointer">Customers</a></td>
                      				<td align="right"><a name="testexpand" onclick="expandcontent('customers')" style="cursor:hand; cursor:pointer">+|- more</a></td>
                    			</tr>
								<tr>
                      				<td>
										<div id="customers" class="switchcontent">
                          				<table>
                                           <tr>
												<td><a href="customer_add_admin.php" title="Add Customer">Add Customer</a></td>
											</tr>
										
											<tr>
												<td><a href="customer_view_admin.php" title="View Customers">View Customers</a></td>
											</tr>
										</table>
                      					</div>
									</td>
								</tr>
								<tr>
									<td colspan="2"><hr /></td>
								</tr>
				
                                <tr class="header">
	                    			<td><a name="testexpand" onclick="expandcontent('orders')" style="cursor:hand; cursor:pointer">Orders</a></td>
                      				<td align="right"><a name="testexpand" onclick="expandcontent('orders')" style="cursor:hand; cursor:pointer">+|- more</a></td>
                    			</tr>
								<tr>
                      				<td>
										<div id="orders" class="switchcontent">
                          				<table>
                          					<tr>
                          						<td><a href="pre_sales_proof.php">Pre-Sales Proof</a></td>
                          					</tr>
                                            <tr>
                                                <td><a href="admin_listall_invoice.php" title="View Orders">Invoices</a></td>
                                            </tr>
											<tr>
												<td><a href="order_view_admin.php" title="View Orders">View Orders</a></td>
											</tr>
											<tr>
												<td> <a href="order_proofs_admin.php" title="New Orders">Proofs </a></td>	
											</tr>
											<tr>
												<td><a href="order_products_admin.php" title="View Orders">Production</a></td>
											</tr>	
											<tr>
												<td><a href="printorder_view_admin.php" title="View Print Orders">New Orders</a></td>
											</tr>	
											<!-- <tr>
												<td><a href="printorder_view_admin.php" title="View Print Orders">View Print Orders</a></td>
											</tr> -->
											
                                        </table>  
  										</div>
                                  	</td>
								</tr>
								
								
                                <?php if(check('view',3)){?>	
                                <tr>
									<td colspan="2"><hr /></td>
								</tr>
                                						                            
								<tr class="header">
	                    			<td><a name="testexpand" onclick="expandcontent('reporting')" style="cursor:hand; cursor:pointer">Users</a></td>
                      				<td align="right"><a name="testexpand" onclick="expandcontent('reporting')" style="cursor:hand; cursor:pointer">+|- more</a></td>
                    			</tr>
                       
								<tr>
                      				<td>
										<div id="reporting" class="switchcontent">
                          				<table>
										
				         						<tr>
												<td><a href="admin_add_user.php" title="Add User" rel="gb_page_center[550, 500]">Add Admin/User</a></td>
											</tr>										
											<tr>
												<td><a href="admin_view_user.php" title="View Users" rel="gb_page_center[650, 650]">View Users</a></td>
											</tr>
										</table>
                      					</div>
									</td>
								</tr>
                               
								<tr>
									<td colspan="2"><hr /></td>
								</tr>
                                 <?php }?>
								<?php if(check('view',3)){?>
								<tr class="header">
	                    			<td><a name="testexpand" onclick="expandcontent('blog')" style="cursor:hand; cursor:pointer">Blogs</a></td>
                      				<td align="right"><a name="testexpand" onclick="expandcontent('blog')" style="cursor:hand; cursor:pointer">+|- more</a></td>
                    			</tr>
								<tr>
                      				<td>
										<div id="blog" class="switchcontent">
                          				<table>
                         					<tr>
												<td><a href="admin_add_blog.php" title="Add User">Add Blog</a></td>
											</tr>
											<tr>
												<td><a href="admin_view_blog.php" title="View Users">View Blogs</a></td>
											</tr>
										</table>
                      					</div>
									</td>
								</tr>
								<?php }?>
						<?php if ($_SESSION["userlevel"] > 1) { ?>
						<tr>
									<td colspan="2"><hr /></td>
								</tr>
								<tr class="header">
	                    			<td><a name="testexpand" onclick="expandcontent('templates')" style="cursor:hand; cursor:pointer">Templates</a></td>
                      				<td align="right"><a name="testexpand" onclick="expandcontent('templates')" style="cursor:hand; cursor:pointer">+|- more</a></td>
                    			</tr>
								<tr>
                      				<td>
										<div id="templates" class="switchcontent">
                          				<table>
                         								<tr>
												<td><a href="admin_add_client_templates.php" title="Add User">Add Templates</a></td>
											</tr>
											<tr>
												<td><a href="admin_view_client_templates.php" title="View Users">View Templates</a></td>
											</tr>											
										</table>
                      					</div>
									</td>
								</tr>
						
							<tr>
									<td colspan="2"><hr /></td>
								</tr>
							<tr class="header">
									<td><a name="testexpand" onclick="expandcontent('styles')" style="cursor:hand; cursor:pointer">Styles</a></td>
									  <td align="right"><a name="testexpand" onclick="expandcontent('styles')" style="cursor:hand; cursor:pointer">+|- more</a></td>
								       </tr>
							<tr>
									  <td>
											<div id="styles" class="switchcontent">
									      <table>
									      <tr>
							    <td><a href="style_add_admin.php" title="Add Style">Add Style</a></td>
							   </tr>
							   <tr>
							    <td><a href="style_view_admin.php" title="View Styles">View Styles</a></td>
							   </tr>
							
							
							  </table>
									   </div>
							 </td>
							</tr>
							<?php } ?>
							<tr>
									<td colspan="2"><hr /></td>
								</tr>	
							<tr>
							  <tr class="header">
									<td><a name="testexpand" onclick="expandcontent('sales')" style="cursor:hand; cursor:pointer">Sales</a></td>
									  <td align="right"><a name="testexpand" onclick="expandcontent('sales')" style="cursor:hand; cursor:pointer">+|- more</a></td>
								       </tr>
							  <tr>
									  <td>
											<div id="sales" class="switchcontent">
											      <table>
											    	  <tr>
									   				 <td><a href="sign_ups.php" title="Add Style">Sign Ups</a></td>
									 			  </tr>
												  <tr>
									   				 <td><a href="my_sales.php" title="Add Style">My Sales</a></td>
									 			  </tr>
							
												  </table>
									   </div>
							 </td>
							</tr>		
						<?php if ($_SESSION["userlevel"] > 1) { ?>
						<tr>
							<td colspan="2"><hr /></td>
						</tr>
						<tr class="header">
					    			<td><a name="testexpand" onclick="expandcontent('main_admin')" style="cursor:hand; cursor:pointer">Main Admin</a></td>
				      				<td align="right"><a name="testexpand" onclick="expandcontent('templates')" style="cursor:hand; cursor:pointer">+|- more</a></td>
                    				</tr>
						<tr>
									  <td>
											<div id="main_admin" class="switchcontent">
											      <table>
											    	 <tr>
												<td><a href="admin_view_taxes.php" title="View Taxed Orders">View Taxed Orders</a></td>
												</tr>
												<tr>
													<td><a href="admin_promo_codes.php" title="View Taxed Orders">View Promo Codes</a></td>
												</tr>
							
												  </table>
									   </div>
							 </td>
							</tr>	
						<?php } ?>
							</table>
                      	</td>
					</tr>
				
				</table>
			</td>
		</tr>
	</table>
</td>
</tr>
</table>
</td>
</tr>
</table>
  
		
</div>
*/ ?>
</body>
</html>
