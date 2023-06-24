<?php 

require_once("includes/header.php"); 

include("includes/authentication.php");



if($_REQUEST["id"]!="") {

	$strSql = "SELECT * FROM ".TBL_ADMIN." WHERE intAdminId =".$_GET["id"]." ";

	if($cnf->records_fetch($strSql)==true) {

		$rows = mysqli_fetch_object($cnf->query_execute($strSql));

	}else{

		header("Location:adminusers.php?act=invalid");

	}

}else{

	header("Location:detail_adminuser.php?act=invalid");

}

?>

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

						<h2>Admin User Details</h2>

					

						<div class="right-wrapper pull-right">

							<ol class="breadcrumbs">

								<li>

									<a href="dashboard.php">

										<i class="fa fa-home"></i>

									</a>

								</li>

								<li><span><a href="adminusers.php">Manage Admin User</a></span></li>

							</ol>

					

							<a class="" data-open="sidebar-right">&nbsp;</a>

						</div>

					</header>

					

					<!-- start: page -->

					<div class="row">

							<div class="col-lg-12">

                            	<div id="divMsg"><?php echo $strMsg?></div>

								<section class="panel">

									

                                    <div class="panel-body">

                                        <table class="table table-bordered table-striped mb-none">                                               

                                            <tr>

                                                <td width="30%">Full Name</td>

                                                <td width="70%"><?php echo $rows->txtName; ?></td>

                                            </tr>

                                            <tr>

                                                <td width="30%">Username</td>

                                                <td width="70%"><?php echo $rows->vUsername; ?></td>

                                            </tr>

                                            <tr>

                                                <td width="30%">User Type</td>

                                                <td width="70%"><?php echo $cnf->showAdminType($rows->userType); ?></td>

                                            </tr>

                                            <?php if($rows->userType == 2){ ?>

                                            <tr><td colspan="2"><strong>Privileges</strong></td></tr>

											
                                            <tr>

                                                <td width="30%"> Category / Test / Questions</td>

                                                <td width="70%"><?php if($rows->act_products == "Y"){ echo "Yes"; }else{ echo "No"; } ?></td>

                                            </tr>
                                            
                                            <tr>

                                                <td width="30%">Payment</td>

                                                <td width="70%"><?php if($rows->act_orders == "Y"){ echo "Yes"; }else{ echo "No"; } ?></td>

                                            </tr>
                                            
                                            <tr>

                                                <td width="30%">Static Pages</td>

                                                <td width="70%"><?php if($rows->act_static_pages == "Y"){ echo "Yes"; }else{ echo "No"; } ?></td>

                                            </tr>
                                            
                                            <tr>

                                                <td width="30%">Users</td>

                                                <td width="70%"><?php if($rows->act_users == "Y"){ echo "Yes"; }else{ echo "No"; } ?></td>

                                            </tr>

                                            <tr><td colspan="2">&nbsp;</td></tr>

                                            <?php } ?>

                                            

                                            <tr>

                                                <td width="30%">Status</td>

                                                <td width="70%"><?php echo $cnf->showStatus($rows->cStatus); ?></td>

                                            </tr>

                                            

                                            <tr>

                                                <td width="30%">Created Date</td>

                                                <td width="70%"><?php if($rows->dtCreated !='0000-00-00 00:00:00'){ echo $rows->dtCreated; }else{ echo"N/A"; }?></td>

                                            </tr>

                                            <tr>

                                                <td width="30%">Modified Date</td>

                                                <td width="70%"><?php if($rows->dtModified !='0000-00-00 00:00:00'){ echo $rows->dtModified; }else{ echo"N/A"; }?></td>

                                            </tr>

                                            <tr>

                                                <td width="30%">Last Login</td>

                                                <td width="70%"><?php if($rows->lastLogin !='0000-00-00 00:00:00'){	echo $rows->lastLogin; }else{ echo "N/A"; }?></td>

                                            </tr>                                       

                                        </table>

                                        <div class="center"><a href="adminusers.php" class="mb-xs mt-xs mr-xs btn btn-md btn-info">Back</a></div>

                                    </div>

                                    

								</section>

							</div>

						</div>

					

					

					<!-- end: page -->

				</section>

			</div>



		</section>

 <?php include("includes/footer.php"); ?>       

