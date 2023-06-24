<?php
	$pageName = $cnf->curPageName('','');
?>
<aside id="sidebar-left" class="sidebar-left">



	<div class="sidebar-header">

		<div class="sidebar-title">

			Navigation

		</div>

		<div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">

			<i class="fa fa-bars" aria-label="Toggle sidebar"></i>

		</div>

	</div>



	<div class="nano">

		<div class="nano-content">

			<nav id="menu" class="nav-main" role="navigation">

				<ul class="nav nav-main">

					<li <?php if($pageName == "dashboard.php"){ echo 'class="nav-active"'; }?>>
						<a href="dashboard.php">
							<i class="fa fa-home"></i>
							<span>Dashboard</span>
						</a>
					</li>
                    
                    <li class="nav-parent <?php if($pageName == "admin_settings.php" || $pageName == "addadminuser.php" || $pageName == "adminusers.php" || $pageName == "change_password.php" || $pageName == "change_username.php" ) echo "nav-expanded nav-active"; ?>">
						<a>
							<i aria-hidden="true" class="fa fa-cog"></i>
							<span>Settings</span>
						</a>
						<ul class="nav nav-children" style="">
							<?php
							echo $_SESSION["adminUserType"];
								if($_SESSION["adminUserType"] == 1){
							?>
							<li <?php if($pageName == "admin_settings.php"){ echo 'class="nav-active"';}?>><a href="admin_settings.php">Admin Settings</a></li>
                            
							<li <?php if($pageName == "adminusers.php"){ echo 'class="nav-active"';}?>><a href="adminusers.php">Manage Admin Users</a></li>
                            <?php } ?>
							<li <?php if($pageName == "change_username.php"){ echo 'class="nav-active"';}?>><a href="change_username.php">Change Username</a></li>
							<li <?php if($pageName == "change_password.php"){ echo 'class="nav-active"';}?>><a href="change_password.php">Change Password</a></li>
                           
						</ul>
					</li>
                    
                    <?php
					if($_SESSION["act_products"] == "Y"){
					?>
                    
                    <li class="nav-parent <?php if($pageName == "main_category.php" || $pageName == "sub_category.php" || $pageName == "sub_sec_category.php" || $pageName == "addmain_category.php" || $pageName == "addsub_category.php" || $pageName == "addsub_sec_category.php" || $pageName == "edit_main_category.php" || $pageName == "edit_sub_category.php"|| $pageName == "edit_sub_sec_category.php") echo "nav-expanded nav-active"; ?>">
						<a>
							<i aria-hidden="true" class="fa fa-list"></i>
							<span>Category</span>
						</a>
						<ul class="nav nav-children" style="">
							<li <?php if($pageName == "main_category.php"){ echo 'class="nav-active"';}?>><a href="main_category.php">Main Category</a></li>
                            <li <?php if($pageName == "sub_category.php"){ echo 'class="nav-active"';}?>><a href="sub_category.php">Sub Category</a></li>
                            <li <?php if($pageName == "sub_sec_category.php"){ echo 'class="nav-active"';}?>><a href="sub_sec_category.php">Sub Secondary Category</a></li>
						</ul>
					</li>
                    
                    <li class="nav-parent <?php if($pageName == "test.php" || $pageName == "addtest.php" || $pageName == "edit_test.php" || $pageName == "tags.php" || $pageName == "addtags.php" || $pageName == "edit_tags.php") echo "nav-expanded nav-active"; ?>">
						<a>
							<i aria-hidden="true" class="fa fa-check-square-o"></i>
							<span>Test</span>
						</a>
						<ul class="nav nav-children" style="">
                        	<li <?php if($pageName == "addtest.php" || $pageName == "edit_test.php"){ echo 'class="nav-active"';}?>><a href="addtest.php">Create Test</a></li>
							<li <?php if($pageName == "test.php"){ echo 'class="nav-active"';}?>><a href="test.php">Manage Tests</a></li>
                            <li <?php if($pageName == "tags.php" || $pageName == "addtags.php" || $pageName == "edit_tags.php"){ echo 'class="nav-active"';}?>><a href="tags.php">Tags</a></li>
						</ul>
					</li>
					
                    <li class="nav-parent <?php if($pageName == "questions.php" || $pageName == "addquestions.php" || $pageName == "edit_questions.php") echo "nav-expanded nav-active"; ?>">
						<a>
							<i aria-hidden="true" class="fa fa-list-alt"></i>
							<span>Questions</span>
						</a>
						<ul class="nav nav-children" style="">
                        <li <?php if($pageName == "addquestions.php" || $pageName == "edit_questions.php"){ echo 'class="nav-active"';}?>><a href="addquestions.php">Add Questions</a></li>
							<li <?php if($pageName == "questions.php"){ echo 'class="nav-active"';}?>><a href="questions.php">Manage Questions</a></li>
						</ul>
					</li>
                    
				 <?php }
				 	if($_SESSION["act_orders"] == "Y"){
					?>
                    
                    <li class="nav-parent <?php if($pageName == "orders.php" || $pageName == "change-order-status.php" || $pageName == "new_orders.php" || $pageName == "add_despatch_details.php" || $pageName == "cancel_orders.php" || $pageName == "update_despatch.php") echo "nav-expanded nav-active"; ?>">
						<a>
							<i aria-hidden="true" class="fa fa-shopping-basket"></i>
							<span>Payment</span>
						</a>
                       
						<ul class="nav nav-children" style="">
							<li <?php if($pageName == "orders.php"){ echo 'class="nav-active"';}?>><a href="orders.php">Confirm Payment 
							</a></li>
							<li <?php if($pageName == "new_orders.php"){ echo 'class="nav-active"';}?>><a href="new_orders.php">New / Pending </a></li>
                            
                            <li <?php if($pageName == "cancel_orders.php"){ echo 'class="nav-active"';}?>><a href="cancel_orders.php">Cancel/Return</a></li>
                            <li <?php if($pageName == "download_orders.php"){ echo 'class="nav-active"';}?>><a href="download_orders.php">Download Payment</a></li>
						</ul>
					</li>
				 <?php } 
				   	if($_SESSION["act_static_pages"] == 'Y'){
				   ?> 
					
                    <li class="nav-parent <?php if($pageName == "headerslider.php" || $pageName == "addheaderslider.php" || $pageName == "addquicklinks.php" || $pageName == "quicklinks.php" || $pageName == "downloads.php" || $pageName == "adddownloads.php" || $pageName == "exams.php" || $pageName == "addexam.php" || $pageName == "notification.php" || $pageName == "page.php" || $pageName == "mailer.php" || $pageName == "edit_mailer.php" || $pageName == "sms.php" || $pageName == "edit_sms.php") echo "nav-expanded nav-active"; ?>">
						<a>
							<i aria-hidden="true" class="fa fa-copy"></i>
							<span>Static Pages</span>
						</a>
						<ul class="nav nav-children" style="">
							<li <?php if($pageName == "headerslider.php" || $pageName == "addheaderslider.php"){ echo 'class="nav-active"';}?>>
                            <a href="headerslider.php">Header Slider</a>
                            </li>
                            <li <?php if($pageName == "page.php"){ echo 'class="nav-active"';}?>>
                            <a href="page.php">Manage Page Content</a>
                            </li>                            
						</ul>
					</li>
                   <?php 
				   }
				   ?>
                   
                   <?php if($_SESSION["act_users"] == 'Y'){
				   ?> 
					
                    <li class="nav-parent <?php if($pageName == "adduser.php" || $pageName == "user.php" || $pageName == "edit_user.php" || $pageName == "detailuser.php" || $pageName == "login_audit.php") echo "nav-expanded nav-active"; ?>">
						<a>
							<i aria-hidden="true" class="fa fa-users"></i>
							<span>Users</span>
						</a>
						<ul class="nav nav-children" style="">
							<li <?php if($pageName == "user.php"){ echo 'class="nav-active"';}?>><a href="user.php">Manage Users</a></li>
                            <li <?php if($pageName == "result.php"){ echo 'class="nav-active"';}?>><a href="result.php">Manage Result</a></li>
							<li <?php if($pageName == "login_audit.php"){ echo 'class="nav-active"';}?>><a href="login_audit.php">User Login Audit</a></li>
						</ul>
					</li>
                   <?php 
				   }
					?>
				</ul>
			</nav>	

		</div>

		<script>

			// Preserve Scroll Position

			if (typeof localStorage !== 'undefined') {

				if (localStorage.getItem('sidebar-left-position') !== null) {

					var initialPosition = localStorage.getItem('sidebar-left-position'),

						sidebarLeft = document.querySelector('#sidebar-left .nano-content');					

					sidebarLeft.scrollTop = initialPosition;

				}

			}

		</script>



	</div>



</aside>