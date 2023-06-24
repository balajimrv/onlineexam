<?php 
require_once("includes/header.php");

if($_REQUEST["id"]!="") {
	$strSql = "SELECT * FROM ".TBL_USERS." WHERE user_id =".$_GET["id"]." ";
	if($cnf->records_fetch($strSql)==true) {
		$rows = mysqli_fetch_object($cnf->query_execute($strSql));
	}else{
		header("Location:user.php?act=invalid");
	}
}else{
	header("Location:detail_user.php?act=invalid");
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
						<h2>User Details</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="dashboard.php">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span><a href="user.php">Manage Users</a></span></li>
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
                                                <td width="30%">First Name</td>
                                                <td width="70%"><?php echo $rows->first_name; ?></td>
                                            </tr>
                                            <tr>
                                                <td width="30%">Last Name</td>
                                                <td width="70%"><?php echo $rows->last_name; ?></td>
                                            </tr>
                                            
                                             <tr>
                                                <td width="30%">Email</td>
                                                <td width="70%"><?php echo $rows->email; ?></td>
                                            </tr>
                                            
                                             <tr>
                                                <td width="30%">Phone</td>
                                                <td width="70%"><?php echo $rows->phone; ?></td>
                                            </tr>
                                            
                                             <tr>
                                                <td width="30%">Address</td>
                                                <td width="70%"><?php echo $rows->address; ?></td>
                                            </tr>
                                            
                                            <tr>
                                                <td width="30%">City</td>
                                                <td width="70%"><?php echo $rows->city; ?></td>
                                            </tr>
                                            
                                            <tr>
                                                <td width="30%">State</td>
                                                <td width="70%"><?php echo $rows->state; ?></td>
                                            </tr>
                                            
                                            <tr>
                                                <td width="30%">Zip</td>
                                                <td width="70%"><?php echo $rows->zip; ?></td>
                                            </tr>
                                                                                       
                                            <tr>
                                                <td width="30%">Status</td>
                                                <td width="70%"><?php echo $cnf->showStatus($rows->cStatus); ?></td>
                                            </tr>
                                            
                                            <tr>
                                                <td width="30%">Created Date</td>
                                                <td width="70%"><?php if($rows->dtCreated !='0000-00-00 00:00:00'){ echo $cnf->convetdate($rows->dtCreated); }else{ echo"N/A"; }?></td>
                                            </tr>
                                            <tr>
                                                <td width="30%">Modified Date</td>
                                                <td width="70%"><?php if($rows->dtModified !='0000-00-00 00:00:00'){ echo $cnf->convetdate($rows->dtModified); }else{ echo"N/A"; }?></td>
                                            </tr>
                                            
                                                                                  
                                        </table>
                                        <div class="center"><a href="user.php" class="mb-xs mt-xs mr-xs btn btn-md btn-info">Cancel</a></div>
                                    </div>
                                    
								</section>
							</div>
						</div>
					
					
					<!-- end: page -->
				</section>
			</div>

		</section>
 <?php include("includes/footer.php"); ?>       
