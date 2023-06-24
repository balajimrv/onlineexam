<?php include("includes/header.php");





if($_REQUEST['hdnButton'] != ""){


	$strSqlSelect = "SELECT * FROM ".TBL_ADMIN." WHERE intAdminId='".$_SESSION["intAdminId"]."' AND vUsername='".trim($cnf->strreplace($_POST["txtOldUsername"]))."'";


	if($cnf->records_fetch($strSqlSelect)==false) {


		header("Location:change_username.php?act=no");


	} else {


		$fieldarray = array(


					"vUsername"=>$_REQUEST['txtNewUsername'],


					"dtModified"=>$cnf->datetime_format()


				  );


		$cnf->update(TBL_ADMIN,$fieldarray,'intAdminId',$_SESSION["intAdminId"]);


		header("Location:admin_settings.php?act=updated");


	}


}


	


	if($_REQUEST['act']=="updated") {


		$strMsg = "Your username has been changed!";


		echo $cnf->HideMsg();


	}


	if($_GET["act"]=="no") {


		$strMsg = "Your current user name is incorrect.";


		echo $cnf->HideMsg();


	}	


?>





<script type="text/javascript">


	function valdateAdd(frm){


		var result = true;


		if(result) result = validateRequired(frm.txtOldUsername, 'Please enter your current username');


		if(result) result = validateRequired(frm.txtNewUsername, 'Please enter your new username');


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


						<h2>Change User Name</h2>


					


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


												<label for="inputDefault" class="col-md-2 control-label">Current User Name</label>


												<div class="col-md-6">


													<input type="text" id='txtOldUsername' name="txtOldUsername" maxlength="255" value="" class="form-control">


													<div class="error"></div>


												</div>


											</div>


											<div class="form-group">


												<label for="inputDefault" class="col-md-2 control-label">New User Name</label>


												<div class="col-md-6">


													<input type="text" id='txtNewUsername' name="txtNewUsername" maxlength="255" value="" class="form-control">


													<div class="error1"></div>


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