<?php require_once("includes/header.php"); 
if($_POST["hdProcess"]!="") {
	
	if($_FILES['fileUpload']['size'] != "") {
		$uploadedfile = $_FILES['fileUpload']['tmp_name'];
		$fileName = $_FILES['fileUpload']['name'];
			
		include("resize-class.php");
		smart_resize_image($uploadedfile , 1920, 1080, false , "uploads/header/".$fileName , false , false ,100 );
					
		//get Order number
		 $sqlQry = "select intLinkOrder from ".TBL_HEADER." ORDER BY intLinkOrder DESC";
		 $resQry = mysqli_query($con,$sqlQry);
		 $rowQry = mysqli_fetch_object($resQry);
		 $intLinkOrder = $rowQry->intLinkOrder+1;
		 
			$fieldarray = array(
				"image_title1"=>$cnf->strreplace($_REQUEST['image_title1']),
				"image_title2"=>$cnf->strreplace($_REQUEST['image_title2']),
				"image_name"=>$fileName,
				"intLinkOrder"=>$intLinkOrder,
				"cStatus"=>$_REQUEST['txtstatus']
			);
			$cnf->insert(TBL_HEADER,$fieldarray);
			
			header("Location:headerslider.php?act=Added");
	}
}
?>

<script type="text/javascript">	
function valdateAdd(frm){
	var result = true;
	if(result) result = validateRequired(frm.fileUpload, 'Please upload the image');
	if(result) result = CheckImgExtension(frm.fileUpload, 'Invalid image file');
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

						<h2>Add Header Slider</h2>

					

						<div class="right-wrapper pull-right">

							<ol class="breadcrumbs">

								<li>

									<a href="dashboard.php">

										<i class="fa fa-home"></i>

									</a>

								</li>

								<li><span><a href="header_slider.php">Manage Header Slider</a></span></li>

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

										<form action="" method="POST" class="form-horizontal form-bordered" name="frm" enctype="multipart/form-data" onSubmit="return valdateAdd(this)">

											<div class="form-group">

												<label for="inputDefault" class="col-md-3 control-label">Image Title1 (Small)</label>

												<div class="col-md-6">
													<input type="text" name="image_title1" id="image_title1" class="form-control" value="">
												</div>

											</div>
                                            <div class="form-group">

												<label for="inputDefault" class="col-md-3 control-label">Image Title2 (Big)</label>

												<div class="col-md-6">
													<input type="text" name="image_title2" id="image_title2" class="form-control" value="">
												</div>

											</div>

											<div class="form-group">

												<label for="inputDefault" class="col-md-3 control-label">Header Image <font class="text_small"> *</font></label>

												<div class="col-md-6">

													<input type="file" name="fileUpload" id="fileUpload" class="txt_inputs" />

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

                                            <a href="headerslider.php" class="mb-xs mt-xs mr-xs btn btn-md btn-default">Cancel</a>

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