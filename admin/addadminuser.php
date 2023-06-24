<?php 

include("includes/header.php"); 

include("includes/authentication.php");



	if($_POST["action"] == "add") {

	

		$strSqlSelect = "SELECT * FROM ".TBL_ADMIN." WHERE vUsername='".trim($cnf->strreplace($_POST["txtUsername"]))."'";

		if($cnf->records_fetch($strSqlSelect)==true) {

			$strMsg = 'This username already exists';

			echo $cnf->HideMsg();

		}else{

			if($_REQUEST['userType'] == 1){
				$act_products = 'Y';
				$act_orders = 'Y';
				$act_static_pages = 'Y';
				$act_users = 'Y';
			}else{
				if($_REQUEST['act_products'] == 'Y'){ $act_products = 'Y'; }else{ $act_products = 'N'; }
				if($_REQUEST['act_orders'] == 'Y'){ $act_orders = 'Y'; }else{ $act_orders = 'N'; }
				if($_REQUEST['act_static_pages'] == 'Y'){ $act_static_pages = 'Y'; }else{ $act_static_pages = 'N'; }
				if($_REQUEST['act_users'] == 'Y'){ $act_users = 'Y'; }else{ $act_users = 'N'; }
			}		


			$fieldarray = array(
					"userType"=>$_REQUEST['userType'],
					"txtName"=>ucwords($_REQUEST['txtName']),
					"vUsername"=>$_REQUEST['txtUsername'],
					"vPassword"=>md5($_REQUEST['txtPassword']),
					"act_products"=>$act_products,
					"act_orders"=>$act_orders,
					"act_static_pages"=>$act_static_pages,
					"act_users"=>$act_users,
					"cStatus"=>$_REQUEST['txtstatus'],
					"dtCreated"=>$cnf->datetime_format()
				  );



			$cnf->insert(TBL_ADMIN,$fieldarray);

			header("Location:adminusers.php?act=added");

		}

	}

?>



<script type="text/javascript">

	function valdateAdd(frm){

		var result = true;

		if(result) result = validateRequired(frm.txtName, 'Please enter the name');

		if(result) result = validateRequired(frm.txtUsername, 'Please enter the username');

		if(result) result = validateRequired(frm.txtPassword, 'Please enter the password');

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

						<h2>Add Admin User</h2>

					

						<div class="right-wrapper pull-right">

							<ol class="breadcrumbs">

								<li>

									<a href="dashboard.php">

										<i class="fa fa-home"></i>

									</a>

								</li>

								<li><span><a href="adminusers.php">Manage Admin Users</a></span></li>

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

												<label for="inputDefault" class="col-md-2 control-label">Full Name</label>

												<div class="col-md-6">

													<input type="text" id='txtName' name="txtName" maxlength="255" value="" class="form-control">

													<div class="error"></div>

												</div>

											</div>

											<div class="form-group">

												<label for="inputDefault" class="col-md-2 control-label">Username</label>

												<div class="col-md-6">

													<input type="text" id='txtUsername' name="txtUsername" maxlength="255" value="" class="form-control">

													<div class="error1"></div>

												</div>

											</div>

                                            

                                            <div class="form-group">

												<label for="inputDefault" class="col-md-2 control-label">Password</label>

												<div class="col-md-6">

													<input type="password" id='txtPassword' name="txtPassword" maxlength="255" value="" class="form-control">

													<div class="error1"></div>

												</div>

											</div>

                                            

                                             <div class="form-group">

												<label for="inputDefault" class="col-md-2 control-label">User Type</label>

												<div class="col-md-6">

													<label class="radio-inline"><input type="radio" name="userType" value="1" > Super Admin</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

													<label class="radio-inline"><input type="radio" name="userType" value="2" checked="checked"> Admin</label>

												</div>

											</div>

                                            

                                            <div class="form-group" id="privilegesArea">

												<label for="inputDefault" class="col-md-2 control-label">Privileges</label>

            <div class="col-md-6">
            
        <div class="checkbox"><label><input type="checkbox" name="act_products" id="act_products" value="Y" <?php if($rows->act_products == "Y"){ echo "checked"; } ?>> Category / Test / Questions </label></div>
        <div class="checkbox"><label><input type="checkbox" name="act_orders" id="act_orders" value="Y" <?php if($rows->act_orders == "Y"){ echo "checked"; } ?>> Payment</label></div>
        <div class="checkbox"><label><input type="checkbox" name="act_static_pages" id="act_static_pages" value="Y" <?php if($rows->act_static_pages == "Y"){ echo "checked"; } ?>> Static Pages</label></div>                
        <div class="checkbox"><label><input type="checkbox" name="act_users" id="act_users" value="Y" <?php if($rows->act_users == "Y"){ echo "checked"; } ?>> Users</label></div>
                
            </div>

											</div>

                                            
                                            <div class="form-group">
												<label for="inputDefault" class="col-md-2 control-label">Status</label>
												<div class="col-md-1">
													<?php echo $cnf->statusBox("");?>
												</div>
											</div>
											

											<div class="form-group">

                                                <label class="col-sm-2 control-label"></label>

                                                <div class="col-sm-6">

                                                    <p class="m-none">

                                                        <input type="hidden" name="action" value="add" />

                                                        <input type="submit" value="Save" class="mb-xs mt-xs mr-xs btn btn-md btn-primary" id="addSubmit">

                                                        <a href="adminusers.php" class="mb-xs mt-xs mr-xs btn btn-md btn-default">Cancel</a>

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