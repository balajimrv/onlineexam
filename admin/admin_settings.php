<?php include("includes/header.php"); ?>


<script type="text/javascript">


	function valdateAdd(frm){


		var result = true;


		if(result) result = validateRequired(frm.txtFromemail, 'Please enter the Email Address');


		if(result) result = validateEmail(frm.txtFromemail, 'Invalid Email Address');


		if(result) result = validateRequired(frm.txtToemail, 'Please enter the Contact Us Email Address');


		if(result) result = validateEmail(frm.txtToemail, 'Invalid Contact Us Email Address');


		if(result) result = validateRequired(frm.txtSignatue, 'Please enter the email signature');


	}


</script>


<?php


if($_REQUEST['hdnButton'] != ""){


	$fieldarray = array(
						"vFromEmail"=>$_REQUEST['txtFromemail'],
						"vToEmail"=>$_REQUEST['txtToemail'],
						"vSignature"=>$cnf->strreplace($_REQUEST['txtSignatue']),
						"vKeywords"=>$cnf->strreplace($_REQUEST['keywords']),
						"dtModified"=>$cnf->datetime_format()
					  );

			$cnf->update(TBL_ADMIN_SETTING,$fieldarray,'adminSettingId',1);


	header("Location:admin_settings.php?act=updated");


}





if($_REQUEST['act']=="updated") {


	$strMsg = "Records has been updated successfully!";


	echo $cnf->HideMsg();


}





$strSqlSelect = mysqli_fetch_object(mysqli_query($con,"SELECT * FROM ".TBL_ADMIN_SETTING));


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


						<h2>Admin Settings</h2>


					


						<div class="right-wrapper pull-right">


							<ol class="breadcrumbs">


								<li>


									<a href="dashboard.php">


										<i class="fa fa-home"></i>


									</a>


								</li>


								<!--<li><span><a href="category.php">Manage Category</a></span></li>-->


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


											
											<h4>Mail Settings</h4>

											<div class="form-group">


												<label for="inputDefault" class="col-md-2 control-label">Email Address</label>


												<div class="col-md-6">


													<input type="text" id='txtFromemail' name="txtFromemail" maxlength="255" value="<?php echo $strSqlSelect->vFromEmail;?>" class="form-control">


													<div class="error"></div>


												</div>


											</div>


											<div class="form-group">


												<label for="inputDefault" class="col-md-2 control-label">Contact Us Email Address</label>


												<div class="col-md-6">


													<input type="text" id='txtToemail' name="txtToemail" maxlength="255" value="<?php echo $strSqlSelect->vToEmail ;?>" class="form-control">


													<div class="error1"></div>


												</div>


											</div>


											


                                            <div class="form-group">


												<label class="col-md-2 control-label" for="textareaAutosize">Email Signature</label>


												<div class="col-md-6">


													<textarea style="overflow: hidden; word-wrap: break-word; resize: none; height: 91px;" class="form-control" rows="3" name="txtSignatue" id="txtSignatue" data-plugin-textarea-autosize=""><?php echo $strSqlSelect->vSignature;?></textarea>


												</div>


											</div>
                                            
                                            <h4>Site Settings</h4>

											<div class="form-group">


												<label class="col-md-2 control-label" for="textareaAutosize">Meta Keywords</label>


												<div class="col-md-6">


													<textarea style="overflow: hidden; word-wrap: break-word; resize: none; height: 91px;" class="form-control" rows="3" name="keywords" id="keywords" data-plugin-textarea-autosize=""><?php echo $strSqlSelect->vKeywords;?></textarea>


												</div>


											</div>
                                            
                                            
                                            

											<div class="form-group">


											<label class="col-sm-2 control-label"></label>


											<div class="col-sm-6">


											<p class="m-none">


                                            <input type="hidden" name="hdnButton" value="hdnButton" />


											<input type="submit" value="Update" class="mb-xs mt-xs mr-xs btn btn-md btn-primary" id="addSubmit">


                                            <a href="dashboard.php" class="mb-xs mt-xs mr-xs btn btn-md btn-default">Cancel</a>


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