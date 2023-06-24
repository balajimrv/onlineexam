<?php 

include("includes/header.php");



	if($_REQUEST["id"]!="") {

		$strSql = "SELECT * FROM ".TBL_USERS." WHERE user_id =".$_GET["id"]." ";

		if($cnf->records_fetch($strSql)==true) {

			$rows = mysqli_fetch_object($cnf->query_execute($strSql));

		}else{

			header("Location:user.php?act=invalid");

		}

	}else{

		header("Location:user.php?act=invalid");

	}

	

	if($_POST["action"]=="update") {

				
		$fieldarray = array(

					"first_name"=>ucwords(strtolower($_REQUEST['first_name'])),	

					"last_name"=>ucwords(strtolower($_REQUEST['last_name'])),

					"email"=>strtolower($_REQUEST['email']),

					"phone"=>$_REQUEST['phone'],

					"password"=>md5($_REQUEST['password']),

					"address"=>$_REQUEST['address'],

					"city"=>$_REQUEST['city'],

					"state"=>$_REQUEST['state'],

					"zip"=>$_REQUEST['zip'],

					"cStatus"=>$_REQUEST['txtstatus'],
					"emailStatus"=>$_REQUEST['emailStatus']
				  );

				  

		$cnf->update(TBL_USERS,$fieldarray,'user_id',$_POST["txtID"]);

		header("Location:user.php?act=updated");	

	}

?>



<script type="text/javascript">



	function valdateAdd(frm){

		var result = true;

		

		if(result) result = validateRequired(frm.first_name, 'Please enter the first name');

		if(result) result = validateRequired(frm.last_name, 'Please enter the first name');

		if(result) result = validateRequired(frm.email, 'Please enter the email');

		if(result) result = validateEmail(frm.email, 'Invalid email id');

		if(result) result = validateRequired(frm.phone, 'Please enter the phone');

		if(result) result = validateRequired(frm.address, 'Please enter the address');

		if(result) result = validateRequired(frm.city, 'Please enter the city');	

		if(result) result = validateRequired(frm.state, 'Please enter the state');

		if(result) result = validateRequired(frm.zip, 'Please enter the zip');

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

						<h2>Edit User</h2>

					

						<div class="right-wrapper pull-right">

							<ol class="breadcrumbs">

								<li>

									<a href="dashboard.php">

										<i class="fa fa-home"></i>

									</a>

								</li>

								<li><span><a href="user.php">Manage User</a></span></li>

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

												<label for="inputDefault" class="col-md-2 control-label">First Name</label>

												<div class="col-md-6">

													<input name="first_name" class="form-control" type="text" id="first_name" value="<?php echo $rows->first_name; ?>">

													<div class="error"></div>

												</div>

											</div>

											<div class="form-group">

												<label for="inputDefault" class="col-md-2 control-label">Last Name</label>

												<div class="col-md-6">

													<input name="last_name" class="form-control" type="text" id="last_name" value="<?php echo $rows->last_name; ?>">

													<div class="error1"></div>

												</div>

											</div>

											<div class="form-group">

												<label for="inputDefault" class="col-md-2 control-label">Email</label>

												<div class="col-md-6">

													<input name="email" class="form-control" type="text" id="email" value="<?php echo $rows->email; ?>" placeholder="Username">

													<div class="error2"></div>

												</div>

											</div>

                                            

                                            <div class="form-group">

												<label for="inputDefault" class="col-md-2 control-label">Phone</label>

												<div class="col-md-6">

													<input name="phone" class="form-control" type="text" id="phone" value="<?php echo $rows->phone; ?>" onKeyPress="return numbersonly(this, event)" maxlength="13">

													<div class="error2"></div>

												</div>

											</div>

																						

                                             <div class="form-group">

												<label for="inputDefault" class="col-md-2 control-label">Address</label>

												<div class="col-md-6">

													<input name="address" class="form-control" type="text" id="address" value="<?php echo $rows->address; ?>">

													<div class="error2"></div>

												</div>

											</div>

                                            

                                             <div class="form-group">

												<label for="inputDefault" class="col-md-2 control-label">City</label>

												<div class="col-md-6">

													<input name="city" class="form-control" type="text" id="city" value="<?php echo $rows->city; ?>">

													<div class="error2"></div>

												</div>

											</div>

                                            

                                            <div class="form-group">

												<label for="inputDefault" class="col-md-2 control-label">State</label>

												<div class="col-md-6">

                                                <select name="state" class="form-control" id="state" >

												<option value="">-- Select State --</option>

                                                <option value="Andaman and Nicobar Islands" <?php if($rows->state == "Andaman and Nicobar Islands"){ echo "selected"; }?>>Andaman and Nicobar Islands</option>

                                                <option value="Andhra Pradesh" <?php if($rows->state == "Andhra Pradesh"){ echo "selected"; }?>>Andhra Pradesh</option>

                                                <option value="Arunachal Pradesh" <?php if($rows->state == "Arunachal Pradesh"){ echo "selected"; }?>>Arunachal Pradesh</option>

                                                <option value="Assam" <?php if($rows->state == "Assam"){ echo "selected"; }?>>Assam</option>

                                                <option value="Bihar" <?php if($rows->state == "Bihar"){ echo "selected"; }?>>Bihar</option>

                                                <option value="Chandigarh" <?php if($rows->state == "Chandigarh"){ echo "selected"; }?>>Chandigarh</option>

                                                <option value="Chhattisgarh" <?php if($rows->state == "Chhattisgarh"){ echo "selected"; }?>>Chhattisgarh</option>

                                                <option value="Dadra and Nagar Haveli" <?php if($rows->state == "Dadra and Nagar Haveli"){ echo "selected"; }?>>Dadra and Nagar Haveli</option>

                                                <option value="Daman and Diu" <?php if($rows->state == "Daman and Diu"){ echo "selected"; }?>>Daman and Diu</option>

                                                <option value="Delhi" <?php if($rows->state == "Delhi"){ echo "selected"; }?>>Delhi</option>

                                                <option value="Goa" <?php if($rows->state == "Goa"){ echo "selected"; }?>>Goa</option>

                                                <option value="Gujarat" <?php if($rows->state == "Gujarat"){ echo "selected"; }?>>Gujarat</option>

                                                <option value="Haryana" <?php if($rows->state == "Haryana"){ echo "selected"; }?>>Haryana</option>

                                                <option value="Himachal Pradesh" <?php if($rows->state == "Himachal Pradesh"){ echo "selected"; }?>>Himachal Pradesh</option>

                                                <option value="Jammu and Kashmir" <?php if($rows->state == "Jammu and Kashmir"){ echo "selected"; }?>>Jammu and Kashmir</option>

                                                <option value="Jharkhand" <?php if($rows->state == "Jharkhand"){ echo "selected"; }?>>Jharkhand</option>

                                                <option value="Karnataka" <?php if($rows->state == "Karnataka"){ echo "selected"; }?>>Karnataka</option>

                                                <option value="Kerala" <?php if($rows->state == "Assam"){ echo "selected"; }?>>Kerala</option>

                                                <option value="Lakshadweep" <?php if($rows->state == "Lakshadweep"){ echo "selected"; }?>>Lakshadweep</option>

                                                <option value="Madhya Pradesh" <?php if($rows->state == "Madhya Pradesh"){ echo "selected"; }?>>Madhya Pradesh</option>

                                                <option value="Maharashtra" <?php if($rows->state == "Maharashtra"){ echo "selected"; }?>>Maharashtra</option>

                                                <option value="Manipur" <?php if($rows->state == "Manipur"){ echo "selected"; }?>>Manipur</option>

                                                <option value="Meghalaya" <?php if($rows->state == "Meghalaya"){ echo "selected"; }?>>Meghalaya</option>

                                                <option value="Mizoram" <?php if($rows->state == "Mizoram"){ echo "selected"; }?>>Mizoram</option>

                                                <option value="Nagaland" <?php if($rows->state == "Nagaland"){ echo "selected"; }?>>Nagaland</option>

                                                <option value="Orissa" <?php if($rows->state == "Orissa"){ echo "selected"; }?>>Orissa</option>

                                                <option value="Pondicherry" <?php if($rows->state == "Pondicherry"){ echo "selected"; }?>>Pondicherry</option>

                                                <option value="Punjab" <?php if($rows->state == "Punjab"){ echo "selected"; }?>>Punjab</option>

                                                <option value="Rajasthan" <?php if($rows->state == "Rajasthan"){ echo "selected"; }?>>Rajasthan</option>

                                                <option value="Sikkim" <?php if($rows->state == "Sikkim"){ echo "selected"; }?>>Sikkim</option>

                                                <option value="Tamil Nadu" <?php if($rows->state == "Tamil Nadu"){ echo "selected"; }?>>Tamil Nadu</option>

                                                <option value="Tripura" <?php if($rows->state == "Tripura"){ echo "selected"; }?>>Tripura</option>

                                                <option value="Uttaranchal" <?php if($rows->state == "Uttaranchal"){ echo "selected"; }?>>Uttaranchal</option>

                                                <option value="Uttar Pradesh" <?php if($rows->state == "Uttar Pradesh"){ echo "selected"; }?>>Uttar Pradesh</option>

                                                <option value="West Bengal" <?php if($rows->state == "West Bengal"){ echo "selected"; }?>>West Bengal</option>

                                                </select>

													<div class="error2"></div>

												</div>

											</div>

                                            

                                            <div class="form-group">

												<label for="inputDefault" class="col-md-2 control-label">Zip</label>

												<div class="col-md-6">

													<input name="zip" class="form-control" type="text" id="zip" value="<?php echo $rows->zip; ?>" onKeyPress="return numbersonly(this, event)" maxlength="8">

													<div class="error2"></div>

												</div>

											</div>

											
                                            <div class="form-group">
                                                <label for="inputDefault" class="col-md-2 control-label">Status</label>
                                                <div class="col-md-1">
                                                    <?php echo $cnf->statusBox($rows->cStatus);?>
                                                </div>
                                            </div>
                                                                                        
                                            <div class="form-group">
												<label for="inputDefault" class="col-md-2 control-label">Email Status</label>
												<div class="col-md-1">
													<select name='emailStatus' id='emailStatus' class='form-control'>
                                                    	<option value="Y"  <?php if($rows->emailStatus == "Y"){ echo "selected"; } ?>>Active</option>
                                                        <option value="N" <?php if($rows->emailStatus == "N"){ echo "selected"; } ?>>InActive</option>
                                                    </select>
												</div>
											</div>
                                            
                                            										

											<div class="form-group">

                                                <label class="col-md-2 control-label"></label>

                                                <div class="col-sm-6">

                                                    <p class="m-none">

                                                        <input type="hidden" name="action" value="update" />

                                                         <input type="hidden" name="txtID" value="<?php echo $rows->user_id; ?>" />

                                                        <input type="submit" value="Update" class="mb-xs mt-xs mr-xs btn btn-md btn-primary" id="addSubmit">

                                                        <a href="user.php" class="mb-xs mt-xs mr-xs btn btn-md btn-default">Cancel</a>

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