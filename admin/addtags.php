<?php require_once("includes/header.php"); 

if($_POST["hdProcess"]!="") {

	if($_REQUEST['txtstatus'] == "Y"){ $status = "Y"; }else{ $status = "N"; }		

	$fieldarray = array(
				"tags"=>addslashes($_REQUEST['tags']),
				"cStatus"=>$status
			  );


	$cnf->insert(TBL_TAGS,$fieldarray);
	header("Location:tags.php?act=added");
}

?>

<link rel="stylesheet" href="assets/vendor/summernote/summernote.css" />
<script type="text/javascript">
function valdateAdd(frm){
	var result = true;
	if(result) result = validateRequired(frm.tags, 'Please enter the tag name');
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

						<h2>Add Tags</h2>

					

						<div class="right-wrapper pull-right">

							<ol class="breadcrumbs">

								<li>

									<a href="dashboard.php">

										<i class="fa fa-home"></i>

									</a>

								</li>

								<li><span><a href="tags.php">Manage Tags</a></span></li>

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

										<form action="" method="POST" class="form-horizontal form-bordered" name="frm" onSubmit="return valdateAdd(this)">

											

											<div class="form-group">

												<label for="inputDefault" class="col-md-3 control-label">Tag Name <font class="text_small"> *</font></label>

												<div class="col-md-6">

													<input type="text" name="tags" id="tags" class="form-control" value="">

												</div>

											</div>

											
											
											<div class="form-group">

                                                <label class="col-sm-3 control-label"></label>

                                                <div class="col-sm-6">

                                                    <div class="checkbox-custom checkbox-success">

                                                        <input type="checkbox" checked name="txtstatus" id="txtstatus " value="Y">

                                                        <label for="checkboxStatus">Status</label>

                                                    </div>

                                    

                                                </div>

                                            </div>

                                            

											<div class="form-group">

											<label class="col-sm-3 control-label"></label>

											<div class="col-sm-6">

											<p class="m-none">

											 <input type="hidden" name="hdProcess" value="add" />

                                            <input type="submit" value="Save" class="mb-xs mt-xs mr-xs btn btn-md btn-primary" id="addSubmit">

                                            <a href="tags.php" class="mb-xs mt-xs mr-xs btn btn-md btn-default">Cancel</a>

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