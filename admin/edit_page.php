<?php 
include("includes/header.php");

	if($_REQUEST["id"]!="") {

		$strSql = "SELECT * FROM ".TBL_PAGES." WHERE intPages_Id =".$_GET["id"]." ";

		if($cnf->records_fetch($strSql)==true) {

			$rows = mysqli_fetch_object($cnf->query_execute($strSql));

		}else{

			header("Location:page.php?act=invalid");

		}

	}else{

		header("Location:page.php?act=invalid");

	}

	if($_POST["action"]=="update") {

				

		if($_REQUEST['txtstatus'] == "Y"){ $status = "Y"; }else{ $status = "N"; }

		$fieldarray = array(		
			"pages_name"=>$cnf->strreplace($_REQUEST['txtPagename']),
			"pages_description"=>$cnf->strreplace($_REQUEST['txtDescription']),
			"dtModified"=>$cnf->datetime_format()			
		  );

		$cnf->update(TBL_PAGES,$fieldarray,'intPages_Id',$_POST["txtID"]);

		header("Location:page.php?act=updated");	

	}

?>
<link rel="stylesheet" href="assets/vendor/summernote/summernote.css" />
<script type="text/javascript">	

	function valdateAdd(frm){

		var result = true;
		if(result) result = validateRequired(frm.txtPagename, 'Please enter the page title');
		if(result) result = validateRequired(frm.txtDescription, 'Please enter the page Content');

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

						<h2>Edit Page</h2>

					

						<div class="right-wrapper pull-right">

							<ol class="breadcrumbs">

								<li>

									<a href="dashboard.php">

										<i class="fa fa-home"></i>

									</a>

								</li>

								<li><span><a href="category.php">Manage Page</a></span></li>

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

												<label for="inputDefault" class="col-md-3 control-label">Page Title</label>

												<div class="col-md-6">

													<input type="text" class="txt_inputs form-control" name="txtPagename"  id="txtPagename" size="45" value="<?php echo $rows->pages_name; ?>">

													<div class="error1"></div>

												</div>

											</div>

											<div class="form-group">

												<label for="inputDefault" class="col-md-3 control-label">Page Content</label>

												<div class="col-md-8">
													
                                                    <textarea class="summernote" name="txtDescription" data-plugin-summernote data-plugin-options='{ "height": 250, "codemirror": { "theme": "ambiance" } }'><?php echo $rows->pages_description; ?></textarea>
													<div class="error1"></div>

												</div>

											</div>

											
											<div class="form-group">

                                                <label class="col-sm-2 control-label"></label>

                                                <div class="col-sm-6">

                                                    <p class="m-none">

                                                        <input type="hidden" name="action" value="update" />

                                                         <input type="hidden" name="txtID" value="<?php echo $rows->intPages_Id; ?>" />

                                                        <input type="submit" value="Update" class="mb-xs mt-xs mr-xs btn btn-md btn-primary" id="addSubmit">

                                                        <a href="page.php" class="mb-xs mt-xs mr-xs btn btn-md btn-default">Cancel</a>

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