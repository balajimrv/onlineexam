<?php require_once("includes/header.php"); 

if($_REQUEST["id"]!="") {

		$strSql = "SELECT * FROM ".TBL_HEADER." WHERE header_id =".$_GET["id"]." ";

		if($cnf->records_fetch($strSql)==true) {

			$rows = mysqli_fetch_object($cnf->query_execute($strSql));
			
		}else{

			header("Location:headerslider.php?act=invalid");
		}

	}else{

		header("Location:headerslider.php?act=invalid");

	}
	
	if($_POST["action"]=="update") {

		
		if($_FILES['fileUpload']['size'] != "") {
			$uploadedfile = $_FILES['fileUpload']['tmp_name'];
			$fileName = $_FILES['fileUpload']['name'];
			
			include("resize-class.php");
			smart_resize_image($uploadedfile, 1920, 1080, false, "uploads/header/".$fileName, false, false,100 );
				
				move_uploaded_file($uploadedfile, "uploads/header/".$fileName);
				
				$fieldarray1 = array( "`image_name`"=>$fileName );
				$cnf->update(TBL_HEADER,$fieldarray1,'header_id',$_POST["txtID"]);
		}
		
			$fieldarray = array(
				"image_title1"=>$cnf->strreplace($_REQUEST['image_title1']),
				"image_title2"=>$cnf->strreplace($_REQUEST['image_title2']),
				"cStatus"=>$_REQUEST['txtstatus']
			);
			$cnf->update(TBL_HEADER,$fieldarray,'header_id',$_POST["txtID"]);
			header("Location:headerslider.php?page=1&act=Updated");
	}
	


if($_GET["act"]=="exists") {

	$strMsg = "This record already exists. Please add different one.";

	echo $cnf->HideMsg(); 

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

						<h2>Edit Header Slider</h2>

					

						<div class="right-wrapper pull-right">

							<ol class="breadcrumbs">

								<li>

									<a href="dashboard.php">

										<i class="fa fa-home"></i>

									</a>

								</li>

								<li><span><a href="headerslider.php">Manage Header Image</a></span></li>

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

												<label for="inputDefault" class="col-md-3 control-label">Image Title1 (Small) </label>

												<div class="col-md-6">

													<input type="text" class="form-control" name="image_title1" id="image_title1" value="<?php echo $rows->image_title1;?>">


												</div>

											</div>
                                            
                                            <div class="form-group">

												<label for="inputDefault" class="col-md-3 control-label">Image Title2 (Big) </label>

												<div class="col-md-6">

													<input type="text" class="form-control" name="image_title2" id="image_title2" value="<?php echo $rows->image_title2;?>">


												</div>

											</div>
											

											<div class="form-group">

												<label for="inputDefault" class="col-md-3 control-label">Header Image <font class="text_small"> *</font></label>

												<div class="col-md-6">
													
                                                    <input type="hidden" name="defaultImage" value="<?php echo $rows->rowsimage_name; ?>" id="defaultImage" />
                                                    <input type="file" name="fileUpload" id="fileUpload" /><br />
                                                    <img src="uploads/header/<?php echo $rows->image_name;?>" style="width:180px; height:60px; border:1px solid #000000;" />

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

                                             <input type="hidden" name="txtID" value="<?php echo $rows->header_id; ?>" />

                                             <input type="submit" value="Update" class="mb-xs mt-xs mr-xs btn btn-md btn-primary" id="addSubmit">

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