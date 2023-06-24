<?php 
include("includes/header.php");

	if($_REQUEST["id"]!="") {

		$strSql = "SELECT * FROM ".TBL_MAILER." WHERE mailer_id =".$_GET["id"]." ";

		if($cnf->records_fetch($strSql)==true) {

			$rows = mysqli_fetch_object($cnf->query_execute($strSql));

		}else{

			header("Location:mailer.php?act=invalid");

		}

	}else{

		header("Location:mailer.php?act=invalid");

	}

	if($_POST["action"]=="update") {

				

		if($_REQUEST['txtstatus'] == "Y"){ $status = "Y"; }else{ $status = "N"; }

		$fieldarray = array(
			"mailer_subject"=>$cnf->strreplace($_REQUEST['mailer_subject']),
			"mailer_description"=>$cnf->strreplace($_REQUEST['mailer_description'])
		  );

		$cnf->update(TBL_MAILER,$fieldarray,'mailer_id',$_POST["txtID"]);

		header("Location:mailer.php?act=updated");	

	}

?>
<link rel="stylesheet" href="assets/vendor/summernote/summernote.css" />
<script type="text/javascript">	

	function valdateAdd(frm){

		var result = true;
		if(result) result = validateRequired(frm.mailer_description, 'Please enter the mailer content');

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

						<h2>Edit Mailer Template</h2>

					

						<div class="right-wrapper pull-right">

							<ol class="breadcrumbs">

								<li>

									<a href="dashboard.php">

										<i class="fa fa-home"></i>

									</a>

								</li>

								<li><span><a href="mailer.php">Manage Mailer Template</a></span></li>

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

												<label for="inputDefault" class="col-md-3 control-label">Mailer Title</label>

												<div class="col-md-6">

													<input type="text" class="txt_inputs form-control" size="45" value="<?php echo $rows->mailer_title; ?>" readonly>

													<div class="error1"></div>

												</div>

											</div>

											<div class="form-group">

												<label for="inputDefault" class="col-md-3 control-label">Mailer Subject</label>

												<div class="col-md-6">

													<input type="text" class="txt_inputs form-control" name="mailer_subject" value="<?php echo $rows->mailer_subject; ?>">

													<div class="error1"></div>

												</div>

											</div>
                                            
											<div class="form-group">

												<label for="inputDefault" class="col-md-3 control-label">Mailer Content</label>

												<div class="col-md-8">
													
                                                    <textarea class="summernote" name="mailer_description" data-plugin-summernote data-plugin-options='{ "height": 350, "codemirror": { "theme": "ambiance" } }'><?php echo $rows->mailer_description; ?></textarea>
													<div>
													Member Name (Full Name): <span class="label label-warning">{MEMBER}</span><br>
													Default Message: <span class="label label-warning">{MESSAGE}</span><br>
													Order Number: <span class="label label-warning">{ORDER_NUMBER}</span><br>
													OTP Value: <span class="label label-warning">{OTP}</span><br>
													</div>

												</div>

											</div>

											
											<div class="form-group">

                                                <label class="col-sm-3 control-label"></label>

                                                <div class="col-sm-6">

                                                    <p class="m-none">

                                                        <input type="hidden" name="action" value="update" />

                                                         <input type="hidden" name="txtID" value="<?php echo $rows->mailer_id; ?>" />

                                                        <input type="submit" value="Update" class="mb-xs mt-xs mr-xs btn btn-md btn-primary" id="addSubmit">

                                                        <a href="mailer.php" class="mb-xs mt-xs mr-xs btn btn-md btn-default">Cancel</a>

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