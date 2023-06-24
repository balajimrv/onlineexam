<?php require_once("includes/header.php"); 
if($_POST["hdProcess"]!="") {

	$strSqlSelect = "SELECT * FROM ".TBL_CATEGORY." WHERE category_name='".trim($cnf->strreplace($_POST["txtCategory"]))."'";

	if($cnf->records_fetch($strSqlSelect)==true) {

		header("Location:addcategory.php?act=exists");

	} else {

		

		if($_REQUEST['selCategory'] !=''){

				$parentCatId = $_REQUEST['selCategory'];

			}else{

				$parentCatId = 0;

			}
			
			if($_FILES['fileUpload']['size'] != "") {
				$uploadedfile = $_FILES['fileUpload']['tmp_name'];
				$fileName = time().$_FILES['fileUpload']['name'];
				move_uploaded_file($uploadedfile, "uploads/logo/".$fileName);
			}

		$fieldarray = array(				

					"vCatName"=>$_REQUEST['txtCategory'],
					"vTitle"=>$_REQUEST['txtTitle'],
					"intSubCatId"=>$_REQUEST['selCategory'],
					"logo_image"=>$fileName,
					"pageTitle"=>$_REQUEST['txtPageTitle'],
					"metaDescription"=>$_REQUEST['metaDescription'],
					"metaKeywords"=>$_REQUEST['metaKeywords'],
					"dtCreated"=>$cnf->datetime_format(),
					"cStatus"=>$_REQUEST['txtstatus']
				  );
			$cnf->insert(TBL_CATEGORY,$fieldarray);

			header("Location:category.php?act=added");
	}
}
if($_GET["act"]=="exists") {

	$strMsg = "This record already exists. Please add different one.";

	echo $cnf->HideMsg(); 

}	

?>



<script type="text/javascript">	

function valdateAdd(frm){

	var result = true;

	//if(result) result = validateCombo(frm.selCategory, 'Please select the category');

	if(result) result = validateRequired(frm.txtCategory, 'Please enter the sub category');

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

						<h2>Add Category</h2>

					

						<div class="right-wrapper pull-right">

							<ol class="breadcrumbs">

								<li>

									<a href="dashboard.php">

										<i class="fa fa-home"></i>

									</a>

								</li>

								<li><span><a href="category.php">Manage Category</a></span></li>

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

										<form action="" method="POST" enctype="multipart/form-data" class="form-horizontal form-bordered" name="frm" onSubmit="return valdateAdd(this)">

											<div class="form-group">

												<label for="inputDefault" class="col-md-3 control-label">Select Main Category <span class="req"> *</span></label>

												<div class="col-md-6">

													<select name="selCategory" id="selCategory" class="form-control">
                                                      <option value="">--Select--</option>
													  <?php echo $cnf->displayCategory($_POST["selCategory"],TBL_CATEGORY,"vCatName","intCat_id")?>
                                                    </select>

													<div class="error"></div>

												</div>

											</div>

											<div class="form-group">

												<label for="inputDefault" class="col-md-3 control-label">Sub Category <span class="req"> *</span></label>

												<div class="col-md-6">

													<input type="text" name="txtCategory" id="txtCategory" class="form-control" value="">

													<div class="error1"></div>

												</div>

											</div>
                                            
                                            <div class="form-group">

												<label for="inputDefault" class="col-md-3 control-label">Category Image <span class="req"> *</span></label>

												<div class="col-md-6">											
                                                    <input type="file" name="fileUpload" id="fileUpload" class="form-control" />

													<div class="error1"></div>

												</div>

											</div>

										<div class="form-group">

												<label for="inputDefault" class="col-md-3 control-label">Abbreviation</label>

												<div class="col-md-6">

													<input type="text" class="txt_inputs form-control" name="txtTitle"  id="txtTitle" size="45" value="">

													<div class="error1"></div>

												</div>

											</div>
											

											<div class="form-group">

												<label for="inputDefault" class="col-md-3 control-label">Page Title</label>

												<div class="col-md-6">

													<input type="text" class="txt_inputs form-control" name="txtPageTitle"  id="txtPageTitle" size="45" value="">

													<div class="error1"></div>

												</div>

											</div>


											<div class="form-group">

												<label for="inputDefault" class="col-md-3 control-label">Meta Description</label>

												<div class="col-md-6">

													<textarea style="margin-top:10px;" rows="5" cols="40" class="form-control" id="metaDescription" name="metaDescription"></textarea>

													<div class="error1"></div>

												</div>

											</div>

											<div class="form-group">

												<label for="inputDefault" class="col-md-3 control-label">Meta Keywords</label>

												<div class="col-md-6">

													<input type="text" class="txt_inputs form-control" name="metaKeywords"  id="metaKeywords" size="45" value="">

													<div class="error1"></div>

												</div>

											</div>
											

											<div class="form-group">
												<label for="inputDefault" class="col-md-3 control-label">Status</label>
												<div class="col-md-1">
													<?php echo $cnf->statusBox("");?>
												</div>
											</div>

                                            

											<div class="form-group">

											<label class="col-md-3 control-label"></label>

											<div class="col-sm-6">

											<p class="m-none">

											 <input type="hidden" name="hdProcess" value="add" />

                                            <input type="submit" value="Save" class="mb-xs mt-xs mr-xs btn btn-md btn-primary" id="addSubmit">

                                            <a href="category.php" class="mb-xs mt-xs mr-xs btn btn-md btn-default">Cancel</a>

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