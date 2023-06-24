<?php 
include("includes/header.php");

	if($_REQUEST["id"]!="") {

		$strSql = "SELECT * FROM ".TBL_MAIN_CATEGORY." WHERE intCat_id =".$_GET["id"]." ";

		if($cnf->records_fetch($strSql)==true) {

			$rows = mysqli_fetch_object($cnf->query_execute($strSql));
		}else{
			header("Location:main_category.php?act=invalid");
		}

	}else{
		header("Location:main_category.php?act=invalid");
	}

	

	if($_POST["action"]=="update") {
		
		$fieldarray = array(		
			"vCatName"=>addslashes($_REQUEST['txtCategory']),
			"cStatus"=>$_REQUEST['txtstatus']
		  );

		$cnf->update(TBL_MAIN_CATEGORY,$fieldarray,'intCat_id',$_POST["txtID"]);

		header("Location:main_category.php?act=updated");	

	}

?>



<script type="text/javascript">	

	function valdateAdd(frm){

		var result = true;
		if(result) result = validateRequired(frm.txtCategory, 'Please enter the category');

		return result;

	}

</script>



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

						<h2>Edit Main Category</h2>

					

						<div class="right-wrapper pull-right">

							<ol class="breadcrumbs">

								<li>

									<a href="dashboard.php">

										<i class="fa fa-home"></i>

									</a>

								</li>

								<!--<li><span><a href="main_category.php">Manage Category</a></span></li>-->

							</ol>

					

							<a class="" data-open="sidebar-right">&nbsp;</a>

						</div>

					</header>



					<!-- start: page -->

					<div class="row">

							<div class="col-lg-12">

                            	<div id="divMsg"><?php echo $strMsg?> </div>

								<section class="panel">

									<div class="panel-body">

                                     	

										<form action="" method="POST" class="form-horizontal form-bordered" enctype="multipart/form-data" name="frm" onSubmit="return valdateAdd(this)">

											
											<div class="form-group">

												<label for="inputDefault" class="col-md-3 control-label">Main Category <span class="req"> *</span></label>

												<div class="col-md-6">

													<input type="text" name="txtCategory" id="txtCategory" class="form-control" value="<?php echo $rows->vCatName; ?>">

												</div>

											</div>
                                            
                                            
                                            <div class="form-group">
												<label for="inputDefault" class="col-md-3 control-label">Status</label>
												<div class="col-md-1">
													<?php echo $cnf->statusBox($rows->cStatus);?>
												</div>
											</div>


											

											<div class="form-group">

                                                <label class="col-md-3 control-label"></label>

                                                <div class="col-sm-6">

                                                    <p class="m-none">

                                                        <input type="hidden" name="action" value="update" />

                                                         <input type="hidden" name="txtID" value="<?php echo $rows->intCat_id; ?>" />

                                                        <input type="submit" value="Update" class="mb-xs mt-xs mr-xs btn btn-md btn-primary" id="addSubmit">

                                                        <a href="main_category.php" class="mb-xs mt-xs mr-xs btn btn-md btn-default">Cancel</a>

                                                    </p>

                                                </div>

											</div>

										</form>

									</div>

								</section>

							</div>

						</div>

					

					

					<!-- end: page -->

				</section>

			</div>



		</section>

        

<?php include("includes/footer.php"); ?>