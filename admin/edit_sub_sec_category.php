<?php 
include("includes/header.php");

	if($_REQUEST["id"]!="") {

		$strSql = "SELECT * FROM ".TBL_CATEGORY." WHERE intCat_id =".$_GET["id"]." ";

		if($cnf->records_fetch($strSql)==true) {

			$rows = mysqli_fetch_object($cnf->query_execute($strSql));
		}else{
			header("Location:sub_sec_category.php?act=invalid");
		}

	}else{
		header("Location:sub_sec_category.php?act=invalid");
	}

	

	if($_POST["action"]=="update") {

		$fieldarray = array(		
			"vCatName"=>addslashes($_REQUEST['txtCategory']),
			"vTitle"=>addslashes($_REQUEST['txtTitle']),
			"intSubCatId"=>0,
			"sub_sec_category"=>$_REQUEST['selCategory'],
			"metaDescription"=>$_REQUEST["metaDescription"],
			"metaKeywords"=>$_REQUEST["metaKeywords"],
			"cStatus"=>$_REQUEST['txtstatus']
		  );

		$cnf->update(TBL_CATEGORY,$fieldarray,'intCat_id',$_POST["txtID"]);
		header("Location:sub_sec_category.php?act=updated");	

	}

?>



<script type="text/javascript">	

	function valdateAdd(frm){

		var result = true;
		if(result) result = validateCombo(frm.selCategory, 'Please select the sub category');
		if(result) result = validateRequired(frm.txtCategory, 'Please enter the Sub Secondary category');

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

						<h2>Edit Sub Secondary Category</h2>

					

						<div class="right-wrapper pull-right">

							<ol class="breadcrumbs">

								<li>

									<a href="dashboard.php">

										<i class="fa fa-home"></i>

									</a>

								</li>

								<!--<li><span><a href="sub_sec_category.php">Manage Category</a></span></li>-->

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

												<label for="inputDefault" class="col-md-3 control-label">Sub Category <span class="req"> *</span></label>

												<div class="col-md-6">

													<select name="selCategory" id="selCategory" class="form-control">
                                                      <option value="">--Select--</option>
													  <?php echo $cnf->displaySubCategory($rows->sub_sec_category,TBL_CATEGORY,"vCatName","intCat_id")?>
                                                    </select>

													<div class="error"></div>

												</div>

											</div>

											<div class="form-group">

												<label for="inputDefault" class="col-md-3 control-label">Sub Secondary Category <span class="req"> *</span></label>

												<div class="col-md-6">

													<input type="text" name="txtCategory" id="txtCategory" class="form-control" value="<?php echo $rows->vCatName; ?>">

												</div>

											</div>
                                            

										<div class="form-group">

												<label for="inputDefault" class="col-md-3 control-label">Abbreviation</label>

												<div class="col-md-6">

													<input type="text" class="txt_inputs form-control" name="txtTitle"  id="txtTitle" size="45" value="<?php echo $rows->vTitle; ?>">

													

												</div>

											</div>
											

											<div class="form-group">

												<label for="inputDefault" class="col-md-3 control-label">Page Title</label>

												<div class="col-md-6">

													<input type="text" class="txt_inputs form-control" name="txtPageTitle"  id="txtPageTitle" size="45" value="<?php echo $rows->pageTitle; ?>">

													

												</div>

											</div>


											<div class="form-group">

												<label for="inputDefault" class="col-md-3 control-label">Meta Description</label>

												<div class="col-md-6">

													<textarea style="margin-top:10px;" rows="5" cols="40" class="form-control" id="metaDescription" name="metaDescription"><?php echo $rows->metaDescription; ?></textarea>

													

												</div>

											</div>

											<div class="form-group">

												<label for="inputDefault" class="col-md-3 control-label">Meta Keywords</label>

												<div class="col-md-6">

													<input type="text" class="txt_inputs form-control" name="metaKeywords"  id="metaKeywords" size="45" value="<?php echo $rows->metaKeywords; ?>">

													

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

                                                        <a href="sub_sec_category.php" class="mb-xs mt-xs mr-xs btn btn-md btn-default">Cancel</a>

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