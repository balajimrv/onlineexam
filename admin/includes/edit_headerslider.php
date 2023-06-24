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

		if($_REQUEST['txtstatus'] == "Y"){ $status = "Y"; }else{ $status = "N"; }

		if($_FILES['fileUpload']['size'] != "") {
			$uploadedfile = $_FILES['fileUpload']['tmp_name'];
			$fileName = $_FILES['fileUpload']['name'];
			
			include("resize-class.php");
			smart_resize_image($uploadedfile , 655 , 240 , false , "uploads/header/".$fileName , false , false ,100 );
				
				move_uploaded_file($uploadedfile, "uploads/header/".$fileName);
				
				$fieldarray1 = array( "`image_name`"=>$fileName );
				$cnf->update(TBL_HEADER,$fieldarray1,'header_id',$_POST["txtID"]);
		}
		
			$fieldarray = array(
				"image_title"=>$_REQUEST['image_title'],
				"area_map"=>$_REQUEST['area_map']
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

												<label for="inputDefault" class="col-md-3 control-label">Image Title <font class="text_small"> *</font></label>

												<div class="col-md-6">

													<input type="text" class="form-control" name="image_title" id="image_title" value="<?php echo $rows->image_title;?>">


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

												<label for="inputDefault" class="col-md-3 control-label">Image Area Map</label>

												<div class="col-md-6">

													<textarea name="area_map" id="area_map" rows="8" cols="65" placeholder="Just add <area>...</area> tags only!"><?php echo $rows->area_map; ?></textarea><br />
													(Just add &lt;area&gt; ... &lt; /area&gt; tags only!, don't add &lt; map &gt; tag)


												</div>

											</div>

											
											<div class="form-group">

                                                <label class="col-sm-2 control-label"></label>

                                                <div class="col-sm-6">

                                                    <div class="checkbox-custom checkbox-success">

                                                        <input type="checkbox" checked name="txtstatus" id="txtstatus " value="Y">

                                                        <label for="checkboxStatus">Status</label>

                                                    </div>

                                    

                                                </div>

                                            </div>

                                            

											<div class="form-group">

											<label class="col-sm-2 control-label"></label>

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