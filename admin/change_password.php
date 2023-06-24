<?php include("includes/header.php");





if($_REQUEST['hdnButton'] != ""){


	$strSqlSelect = "SELECT * FROM ".TBL_ADMIN." WHERE intAdminId='".$_SESSION["intAdminId"]."' AND vPassword='".md5(trim($cnf->strreplace($_POST["txtOldPassword"])))."'";


	if($cnf->records_fetch($strSqlSelect)==false) {


		header("Location:change_username.php?act=no");


	} else {


		$fieldarray = array(


					"vPassword"=>md5($_REQUEST["txtConfirm_Password"]),


					"dtModified"=>$cnf->datetime_format()


				  );


		$cnf->update(TBL_ADMIN,$fieldarray,'intAdminId',$_SESSION["intAdminId"]);


		header("Location:admin_settings.php?act=updated");


	}


}


	


	if($_REQUEST['act']=="updated") {


		$strMsg = "Your password has been changed!";


		echo $cnf->HideMsg();


	}


	if($_GET["act"]=="no") {


		$strMsg = "Your current password is incorrect.";


		echo $cnf->HideMsg();


	}	


?>





<script type="text/javascript">


		function valdateAdd(frm){


			var result = true;


			if(result) result = validateRequired(frm.txtOldPassword, 'Please enter your old password');


			if(result) result = validateRequired(frm.txtNewPassword, 'Please enter your new password');


			if(result) result = validateRequired(frm.txtConfirm_Password, 'Please enter retype new password');


			if(result) result = compareFields(frm.txtNewPassword,frm.txtConfirm_Password, 'New Password and Confirm Password should be same');


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


						<h2>Change Password</h2>


					


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


											


											<div class="form-group">


												<label for="inputDefault" class="col-md-3 control-label">Current Password</label>


												<div class="col-md-6">


													<input type="text" id='txtOldPassword' name="txtOldPassword" maxlength="255" value="" class="form-control">


													<div class="error"></div>


												</div>


											</div>


											<div class="form-group">


												<label for="inputDefault" class="col-md-3 control-label">New Password</label>


												<div class="col-md-6">


													<input type="text" id='txtNewPassword' name="txtNewPassword" maxlength="255" value="" class="form-control">


													<div class="error1"></div>


												</div>


											</div>


                                            


                                            <div class="form-group">


												<label for="inputDefault" class="col-md-3 control-label">Retype New Password</label>


												<div class="col-md-6">


													<input type="text" id='txtConfirm_Password' name="txtConfirm_Password" maxlength="255" value="" class="form-control">


													<div class="error1"></div>


												</div>


											</div>


                                            


											<div class="form-group">


											<label class="col-sm-3 control-label"></label>


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