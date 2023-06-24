<?php include("includes/header.php"); ?>
<?php if($_SESSION["adminUserType"] != 1){ header("Location:home.php"); } ?>

	<body>

		<section class="body">



			<!-- start: header -->

			<?php include("includes/topheader.php"); ?>

			<!-- end: header -->



			<div class="inner-wrapper">

				<!-- start: sidebar -->

				<?php include ("includes/menu.php"); ?>

				<!-- end: sidebar -->



				<section role="main" class="content-body">

					<header class="page-header">

						<h2>Dashboard</h2>

					

						<div class="right-wrapper pull-right">

							<ol class="breadcrumbs">

								<li>

									<a href="dashboard.php">

										<i class="fa fa-home"></i>

									</a>

								</li>

								<li><span>Dashboard</span></li>

							</ol>

					

							<a class="" data-open="sidebar-right">&nbsp;</a>

						</div>

					</header>



					<!-- start: page -->

					<div class="row">

						

						<div class="col-md-12 col-lg-12 col-xl-12">

							<div class="row">
                            
                                <div class="col-md-6 col-lg-6 col-xl-6">
    
                                        <section class="panel panel-featured-left panel-featured-secondary">
    
                                            <div class="panel-body">
    
                                                <div class="widget-summary">
    
                                                    <div class="widget-summary-col widget-summary-col-icon">
    
                                                        <div class="summary-icon bg-secondary">
    
                                                           <i class="fa fa-cart-arrow-down" aria-hidden="true"></i>
                                                        </div>
    
                                                    </div>
    
                                                    <div class="widget-summary-col">
    
                                                        <div class="summary">
    
                                                            <h4 class="title">Today's</h4>
    
                                                            <div class="info">
															<?php 
															$sql = mysqli_query($con,"SELECT * FROM `".TBL_ORDER."` WHERE date(dtOrd_date) = curdate() AND (numOrd_status='Completed' OR otp_veryfied='Y')");
			$cod_count =  mysqli_num_rows($sql);
            ?>
                                                               
                                                                <strong class="amount"><?php echo $cod_count; ?> New Orders</strong>
    
                                                            </div>
    
                                                        </div>
    
                                                        <div class="summary-footer">
    
                                                            <a href="orders.php" class="text-muted text-uppercase">(view all)</a>
    
                                                        </div>
    
                                                    </div>
    
                                                </div>
    
                                            </div>
    
                                        </section>
    
                                    </div>

								<div class="col-md-6 col-lg-6 col-xl-6">

									<section class="panel panel-featured-left panel-featured-warning">

										<div class="panel-body">

											<div class="widget-summary">

												<div class="widget-summary-col widget-summary-col-icon">

													<div class="summary-icon bg-warning">

														<i class="fa fa-cart-plus" aria-hidden="true"></i>


													</div>

												</div>

												<div class="widget-summary-col">

													<div class="summary">

														<h4 class="title">Total</h4>

														<div class="info">
                                                        	<?php
															$sql = mysqli_query($con,"SELECT * FROM `".TBL_ORDER."` WHERE numOrd_status='Completed' OR otp_veryfied='Y' ");
															$online_count =  mysqli_num_rows($sql);
														?>
															<strong class="amount"><?php echo $online_count; ?> Orders</strong>

														</div>

													</div>

													<div class="summary-footer">

														<a href="orders.php" class="text-muted text-uppercase">(view all)</a>

													</div>

												</div>

											</div>

										</div>

									</section>

								</div>                          
                                
                                
                                <div class="col-md-6 col-lg-6 col-xl-6">

									<section class="panel panel-featured-left panel-featured-success">

										<div class="panel-body">

											<div class="widget-summary">

												<div class="widget-summary-col widget-summary-col-icon">

													<div class="summary-icon bg-success">

														<i class="fa fa-list-ul" aria-hidden="true"></i>

													</div>

												</div>

												<div class="widget-summary-col">

													<div class="summary">

														<h4 class="title">Total</h4>

														<div class="info">
                                                        	<?php
																$sql = mysqli_query($con,"SELECT * FROM `".TBL_CATEGORY."`");
																$principal_count =  mysqli_num_rows($sql);
															?>
															<strong class="amount"><?php echo $principal_count; ?> Category</strong>

														</div>

													</div>

													<div class="summary-footer">

														<a href="category.php" class="text-muted text-uppercase">(view all)</a>

													</div>

												</div>

											</div>

										</div>

									</section>

								</div>                                
                                
                                
                                <div class="col-md-6 col-lg-6 col-xl-6">

									<section class="panel panel-featured-left panel-featured-tertiary">

										<div class="panel-body">

											<div class="widget-summary">

												<div class="widget-summary-col widget-summary-col-icon">

													<div class="summary-icon bg-tertiary">

														<i class="fa fa-book" aria-hidden="true"></i>


													</div>

												</div>

												<div class="widget-summary-col">

													<div class="summary">

														<h4 class="title">Total</h4>

														<div class="info">
                                                        	<?php
																$sql = mysqli_query($con,"SELECT * FROM `".TBL_BOOKS."`");
																$teacher_count =  mysqli_num_rows($sql);
															?>
															<strong class="amount"><?php echo $teacher_count; ?> Books</strong>

														</div>

													</div>

													<div class="summary-footer">

														<a href="books.php" class="text-muted text-uppercase">(view all)</a>

													</div>

												</div>

											</div>

										</div>

									</section>

								</div>
                                
                                
                                <div class="col-md-6 col-lg-6 col-xl-6">

									<section class="panel panel-featured-left panel-featured-quartenary">

										<div class="panel-body">

											<div class="widget-summary">

												<div class="widget-summary-col widget-summary-col-icon">

													<div class="summary-icon bg-quartenary">

														<i class="fa fa-users" aria-hidden="true"></i>

													</div>

												</div>

												<div class="widget-summary-col">

													<div class="summary">

														<h4 class="title">Total</h4>

														<div class="info">
                                                        	<?php
																$sql = mysqli_query($con,"SELECT * FROM `".TBL_USERS."`");
																$user_count =  mysqli_num_rows($sql);
															?>
															<strong class="amount"><?php echo $user_count; ?> Users</strong>

														</div>

													</div>

													<div class="summary-footer">

														<a href="user.php" class="text-muted text-uppercase">(view all)</a>

													</div>

												</div>

											</div>

										</div>

									</section>

								</div>
                                
                                
                                
								<div class="col-md-6 col-lg-6 col-xl-6">

									<section class="panel panel-featured-left panel-featured-primary">

										<div class="panel-body">

											<div class="widget-summary">

												<div class="widget-summary-col widget-summary-col-icon">

													<div class="summary-icon bg-primary">

														<i class="fa fa-sign-in" aria-hidden="true"></i>

													</div>

												</div>

												<div class="widget-summary-col">

													<div class="summary">

														<h4 class="title">Total</h4>

														<div class="info">
                                                        
															<strong class="amount">Login Audit</strong>

														</div>

													</div>

													<div class="summary-footer">

														<a href="login_audit.php" class="text-muted text-uppercase">(view all)</a>

													</div>

												</div>

											</div>

										</div>

									</section>
                                    
                                    

								</div>
                                
                                

							</div>
                            
						</div>
                        
                        
                        

					</div>

					<!-- end: page -->

				</section>

			</div>



		</section>

        

<?php include("includes/footer.php"); ?>