	<div id="top">
		<div id="header">
			<h2 style="padding:20px;color:#fff;text-align:left">Best Name Badges - Administration</h2>
			<div id="info">
				<h4>
					<?php if ($_SESSION["username"]) { ?>
	                <strong>Welcome - <?php echo $_SESSION["username"]; ?></strong>
					<?php } else { ?>
						&nbsp;
					<?php } ?>	
				</h4>
				<p><a href="admin.php?logout=1">Log out</a></p>
			</div>
		</div>
		<div id="nav">				
			<ul class="mega-container mega-grey">
	
				<li class="mega">
					<a class="mega-tab">Customers</a>
					<div class="mega-content mega-menu ">
						<ul>
							<li><a href="customer_add_admin.php" title="Add Customer">Add Customer</a></li>
							<li><a href="customer_view_admin.php" title="View Customers">View Customers</a></li>
						</ul>
					</div>
				</li>
		
				<li class="mega">				
					<a class="mega-tab">
						Invoices
					</a>
					<div class="mega-content mega-menu ">
						<ul>
							<li><a href="admin_listall_invoice.php" title="List all invoices">Invoices</a></li>
							<li><a href="order_view_admin.php" title="View Orders">View Orders</a></li>
							<li><a href="admin_listall_po_invoice.php" title="Invoices / PO">Invoices / PO</a></li>
						</ul>
					</div>						
				</li>
				
				<li class="mega">				
					<a class="mega-tab">Production</a>
					<div class="mega-content mega-menu">
						<ul>
							<li><a href="printorder_view_admin.php" title="View Print Orders">New Production</a></li>
							<li><a href="order_proofs_admin.php" title="New Orders">Proofs </a></li>
							<li><a href="order_products_admin.php" title="View Orders">Production</a></li>
						</ul>
					</div>
				</li>
				<?php /*if ($_SESSION["userlevel"] > 1) { ?>
					<li class="mega">				
						<a class="mega-tab">Style</a>
						<div class="mega-content mega-menu">
							<ul>
								<li><a href="style_add_admin.php" title="Add Style">Add Style</a></li>
								<li><a href="style_view_admin.php" title="View Styles">View Styles</a></li>
							</ul>
						</div>
					</li>
				<?php } */ ?>
				
				<li class="mega">				
					<a class="mega-tab">Sales</a>
					<div class="mega-content mega-menu">
						<ul>
							<li><a href="pre_sales_proof.php" title="">Pre-Sales</a></li>
						</ul>
					</div>
				</li>
				
				<?php /* if ($_SESSION["userlevel"] > 1) { ?>
					<li class="mega">				
						<a class="mega-tab">Blogs</a>
						<div class="mega-content mega-menu">
							<ul>
								<li><a href="admin_add_blog.php" title="Add Blog">Add Blog</a></li>
							</ul>
						</div>
					</li>
				<?php }?>
				
				<?php if ($_SESSION["userlevel"] > 1) { ?>
					<li class="mega">				
						<a class="mega-tab">Templates</a>
						<div class="mega-content mega-menu">
							<ul>
								<li><a href="admin_add_client_templates.php" title="Add Templates">Add Templates</a></li>
								
							</ul>
						</div>
					</li>
				<?php } */?>
				
				<li class="mega">
					<a class="mega-tab">Main Admin</a>
					<div class="mega-content mega-menu">
						<ul>
							<?php if($_SESSION['userlevel'] > 1 ) {?>
								<li><a href="admin.php" title="Add Style">Main Menu</a></li>
							<?php }?>
							<li><a href="admin_promo_codes.php" title="View Promo Codes">View Promo Codes</a></li>
							<?php if ($_SESSION["userlevel"] > 1) { ?>
								<li><a href="admin_view_taxes.php" title="View Taxed Orders">View Taxed Orders</a></li>
								<li><a href="admin_view_blog.php" title="View Blog">View Blogs</a></li>
								<li><a href="admin_view_client_templates.php" title="View Blog">View Templates</a></li>
								<li><a href="style_view_admin.php" title="View Styles">View Styles</a></li>
							<?php }?>
							<?php if ($_SESSION["userlevel"] ==3) { ?>
							<li><a href="admin_add_user.php" title="Add User">Add User</a></li>
							<li><a href="admin_view_user.php" title="View Users">View Users</a></li>
							<?php }?>
							<?php if ($_SESSION["userlevel"] > 1) { ?>
								<li><a href="sign_ups.php" title="Add Style">Sign Ups</a></li>
								<li><a href="my_sales.php">My Sales</a></li>
								<li><a href="my_followups.php" title="New Orders">My Followups </a></li>
							<?php }?>
						</ul>
					</div>
				</li>
				
				<li id="grid" class="mega">
					<a class="mega-link" href="/admin/tc1/">Time Clock</a>
				</li>
				
			</ul>
		</div> <!-- #nav -->
	</div>
<?php /*?>
<table width="800" align="center" bgcolor="#EFEFEF">
    <tr>
        <td colspan="7">
            <div style="float: right; padding: 10px;">Welcome <?php echo $_SESSION['username'];?> | <a href="/admin/tc1/">Time Clock</a> | <a href="admin.php?logout=1" title="Add Style">Logout</a></div>
        </td>
    </tr>
	<tr>
		<td><strong>Customers</strong></td>	
		<td><strong>Orders</strong></td>				
		<?php if ($_SESSION["userlevel"] > 1) { ?>
		<td><strong>Style</strong></td>
		<?php }else{?>
		<td></td>
		<?php } ?>		
		<td><strong>Sales</strong></td>
		<?php if ($_SESSION["userlevel"] > 1) { ?>
		<td><strong>Blogs</strong></td>
		<td><strong>Templates</strong></td>
		<?php } else{?>
		<td></td>
		<td></td>	
		<?php } ?>
		<td><strong>Main Admin</strong></td>
	</tr>
	<tr>			
		<td><a href="customer_add_admin.php" title="Add Customer">Add Customer</a></td>	
		<td><a href="admin_listall_invoice.php" title="List all invoices">Invoices</a></td>				
        
		<td><a href="pre_sales_proof.php" title="">Pre-Sales Proof</a></td>		
		
		<td><a href="sign_ups.php" title="Add Style">Sign Ups</a></td>
		<?php if ($_SESSION["userlevel"] > 1) { ?>
		<td><a href="admin_add_blog.php" title="Add Blog">Add Blog</a></td>
		<td><a href="admin_add_client_templates.php" title="Add Templates">Add Templates</a></td>
		<?php }else { ?>
		<td></td>
		<td></td>	
		<?php }?>
		<td><a href="admin.php" title="Add Style">Main Menu</a></td>
	</tr>
	<tr>		
		<td><a href="customer_view_admin.php" title="View Customers">View Customers</a></td>
		<td><a href="order_view_admin.php" title="View Orders">View Orders</a></td>	
        
		<?php if ($_SESSION["userlevel"] > 1) { ?>
		<td><a href="style_add_admin.php" title="Add Style">Add Style</a></td>
		<?php }else { ?>
		<td></td>
		<?php } ?>
		
		<td>
		<a href="my_sales.php">My Sales</a>	
		</td>
		<?php if ($_SESSION["userlevel"] > 1) { ?>
		<td><a href="admin_view_blog.php" title="View Blog">View Blogs</a></td>
		<td><a href="admin_view_client_templates.php" title="View Blog">View Templates</a></td>		
		<?php } else{
		?>	
			<td></td>
			<td></td>
		<?php
		}?>
        <td><a href="admin_promo_codes.php" title="View Promo Codes">View Promo Codes</a></td>    
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td><a href="printorder_view_admin.php" title="View Print Orders">New Orders</a></td>
        
		
		<?php if ($_SESSION["userlevel"] > 1) { ?>
		<td><a href="style_view_admin.php" title="View Styles">View Styles</a></td>
		<?php } else {?>	
		<td></td>
		<?php }?>
		<td><a href="my_followups.php" title="New Orders">My Followups </a></td>
		<td>&nbsp;</td>	
		<td>&nbsp;</td>
		<?php if ($_SESSION["userlevel"] > 1) { ?>
		<td><a href="admin_view_taxes.php" title="View Taxed Orders">View Taxed Orders</a></td>		
		<?php } else{?>
		<td></td>
		<?php }?>
	</tr>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td> <a href="order_proofs_admin.php" title="New Orders">Proofs </a> </td>
        
		
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>	
		<td>&nbsp;</td>			
		<td></td>	
	</tr>
	<tr>
        <td></td>
        <td><a href="order_products_admin.php" title="View Orders">Production</a></td>
        
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
	
	<tr>
		<td colspan="7"><hr></td>
	</tr>
</table>
*/ ?>