<?php require_once("includes/header.php"); 

if($_POST["hdProcess"]!="") {
	$strSql = "SELECT * FROM ".TBL_USERS." WHERE email ='".strtolower($_POST["email"])."'";
if($cnf->records_fetch($strSql)==true) {
		header("Location:adduser.php?act=exists");
} else {
		
			$fieldarray = array(
					"first_name"=>ucwords(strtolower($_REQUEST['first_name'])),	
					"last_name"=>ucwords(strtolower($_REQUEST['last_name'])),
					"password"=>md5($_REQUEST['password']),
					"email"=>strtolower($_REQUEST['email']),
					"phone"=>$_REQUEST['phone'],					
					"address"=>$_REQUEST['address'],
					"city"=>$_REQUEST['city'],
					"state"=>$_REQUEST['state'],
					"zip"=>$_REQUEST['zip'],
					"dtCreated"=>$cnf->datetime_format(),
					"cStatus"=>$_REQUEST['txtstatus'],
					"emailStatus"=>'Y',
				  );

			$cnf->insert(TBL_USERS,$fieldarray);
			header("Location:user.php?act=added");
	}
}

if($_GET["act"]=="exists") {
	$strMsg = 'User eamil id already exists';
	echo $cnf->HideMsg(); 
}

?>

<script type="text/javascript">
	function validateUser(frm){
		var result = true;
		if(result) result = validateRequired(frm.first_name, 'Please enter the first name');
		if(result) result = validateRequired(frm.email, 'Please enter the email');
		if(result) result = validateEmail(frm.email, 'Invalid email id');
		if(result) result = validateRequired(frm.password, 'Please enter the password');
		//if(result) result = validateRequired(frm.txtAddress, 'Please enter the address');
		if(result) result = validateRequired(frm.phone, 'Please enter the phone');	
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
						<h2>Add User</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="dashboard.php">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span><a href="user.php">Manage Users</a></span></li>
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
										<form action="" method="POST" class="form-horizontal form-bordered" name="frm" onSubmit="return validateUser(this)">
											
											<div class="form-group">
												<label for="inputDefault" class="col-md-2 control-label">First Name <span class="req"> *</span></label>
												<div class="col-md-6">
													<input name="first_name" class="form-control" type="text" id="first_name" value="<?php echo $_POST['first_name']; ?>">
													<div class="error"></div>
											  </div>
											</div>
											<div class="form-group">
												<label for="inputDefault" class="col-md-2 control-label">Last Name</label>
												<div class="col-md-6">
													<input name="last_name" class="form-control" type="text" id="last_name" value="<?php echo $_POST['last_name']; ?>">
													<div class="error1"></div>
												</div>
											</div>
											<div class="form-group">
												<label for="inputDefault" class="col-md-2 control-label">Email <span class="req"> *</span></label>
												<div class="col-md-6">
													<input name="email" class="form-control" type="text" id="email" value="<?php echo $_POST['email']; ?>" placeholder="Username">
													<div class="error2"></div>
												</div>
											</div>
                                            											
											<div class="form-group">
												<label for="inputDefault" class="col-md-2 control-label">Password <span class="req"> *</span></label>
												<div class="col-md-6">
													<input name="password" class="form-control" type="password" id="password" value="<?php echo $_POST['password']; ?>">
													<div class="error3"></div>
												</div>
											</div>
                                            
                                            <div class="form-group">
												<label for="inputDefault" class="col-md-2 control-label">Phone <span class="req"> *</span></label>
												<div class="col-md-6">
													<input name="phone" class="form-control" type="text" id="phone" value="<?php echo $_POST['phone']; ?>" onKeyPress="return numbersonly(this, event)" maxlength="13">
													<div class="error2"></div>
												</div>
											</div>
                                            
                                             <div class="form-group">
												<label for="inputDefault" class="col-md-2 control-label">Address</label>
												<div class="col-md-6">
													<input name="address" class="form-control" type="text" id="address" value="<?php echo $_POST['address']; ?>">
													<div class="error2"></div>
												</div>
											</div>
                                            
                                             <div class="form-group">
												<label for="inputDefault" class="col-md-2 control-label">City</label>
												<div class="col-md-6">
													<input name="city" class="form-control" type="text" id="city" value="<?php echo $_POST['city']; ?>">
													<div class="error2"></div>
												</div>
											</div>
                                            
                                            <div class="form-group">
												<label for="inputDefault" class="col-md-2 control-label">State</label>
												<div class="col-md-6">
                                                <select name="state" class="form-control" id="state" >
												<option value="">-- Select State --</option>
                                                <option value="Andaman and Nicobar Islands" <?php if($_POST['state'] == "Andaman and Nicobar Islands"){ echo "selected"; }?>>Andaman and Nicobar Islands</option>
                                                <option value="Andhra Pradesh" <?php if($_POST['state'] == "Andhra Pradesh"){ echo "selected"; }?>>Andhra Pradesh</option>
                                                <option value="Arunachal Pradesh" <?php if($_POST['state'] == "Arunachal Pradesh"){ echo "selected"; }?>>Arunachal Pradesh</option>
                                                <option value="Assam" <?php if($_POST['state'] == "Assam"){ echo "selected"; }?>>Assam</option>
                                                <option value="Bihar" <?php if($_POST['state'] == "Bihar"){ echo "selected"; }?>>Bihar</option>
                                                <option value="Chandigarh" <?php if($_POST['state'] == "Chandigarh"){ echo "selected"; }?>>Chandigarh</option>
                                                <option value="Chhattisgarh" <?php if($_POST['state'] == "Chhattisgarh"){ echo "selected"; }?>>Chhattisgarh</option>
                                                <option value="Dadra and Nagar Haveli" <?php if($_POST['state'] == "Dadra and Nagar Haveli"){ echo "selected"; }?>>Dadra and Nagar Haveli</option>
                                                <option value="Daman and Diu" <?php if($_POST['state'] == "Daman and Diu"){ echo "selected"; }?>>Daman and Diu</option>
                                                <option value="Delhi" <?php if($_POST['state'] == "Delhi"){ echo "selected"; }?>>Delhi</option>
                                                <option value="Goa" <?php if($_POST['state'] == "Goa"){ echo "selected"; }?>>Goa</option>
                                                <option value="Gujarat" <?php if($_POST['state'] == "Gujarat"){ echo "selected"; }?>>Gujarat</option>
                                                <option value="Haryana" <?php if($_POST['state'] == "Haryana"){ echo "selected"; }?>>Haryana</option>
                                                <option value="Himachal Pradesh" <?php if($_POST['state'] == "Himachal Pradesh"){ echo "selected"; }?>>Himachal Pradesh</option>
                                                <option value="Jammu and Kashmir" <?php if($_POST['state'] == "Jammu and Kashmir"){ echo "selected"; }?>>Jammu and Kashmir</option>
                                                <option value="Jharkhand" <?php if($_POST['state'] == "Jharkhand"){ echo "selected"; }?>>Jharkhand</option>
                                                <option value="Karnataka" <?php if($_POST['state'] == "Karnataka"){ echo "selected"; }?>>Karnataka</option>
                                                <option value="Kerala" <?php if($_POST['state'] == "Assam"){ echo "selected"; }?>>Kerala</option>
                                                <option value="Lakshadweep" <?php if($_POST['state'] == "Lakshadweep"){ echo "selected"; }?>>Lakshadweep</option>
                                                <option value="Madhya Pradesh" <?php if($_POST['state'] == "Madhya Pradesh"){ echo "selected"; }?>>Madhya Pradesh</option>
                                                <option value="Maharashtra" <?php if($_POST['state'] == "Maharashtra"){ echo "selected"; }?>>Maharashtra</option>
                                                <option value="Manipur" <?php if($_POST['state'] == "Manipur"){ echo "selected"; }?>>Manipur</option>
                                                <option value="Meghalaya" <?php if($_POST['state'] == "Meghalaya"){ echo "selected"; }?>>Meghalaya</option>
                                                <option value="Mizoram" <?php if($_POST['state'] == "Mizoram"){ echo "selected"; }?>>Mizoram</option>
                                                <option value="Nagaland" <?php if($_POST['state'] == "Nagaland"){ echo "selected"; }?>>Nagaland</option>
                                                <option value="Orissa" <?php if($_POST['state'] == "Orissa"){ echo "selected"; }?>>Orissa</option>
                                                <option value="Pondicherry" <?php if($_POST['state'] == "Pondicherry"){ echo "selected"; }?>>Pondicherry</option>
                                                <option value="Punjab" <?php if($_POST['state'] == "Punjab"){ echo "selected"; }?>>Punjab</option>
                                                <option value="Rajasthan" <?php if($_POST['state'] == "Rajasthan"){ echo "selected"; }?>>Rajasthan</option>
                                                <option value="Sikkim" <?php if($_POST['state'] == "Sikkim"){ echo "selected"; }?>>Sikkim</option>
                                                <option value="Tamil Nadu" <?php if($_POST['state'] == "Tamil Nadu"){ echo "selected"; }?>>Tamil Nadu</option>
                                                <option value="Tripura" <?php if($_POST['state'] == "Tripura"){ echo "selected"; }?>>Tripura</option>
                                                <option value="Uttaranchal" <?php if($_POST['state'] == "Uttaranchal"){ echo "selected"; }?>>Uttaranchal</option>
                                                <option value="Uttar Pradesh" <?php if($_POST['state'] == "Uttar Pradesh"){ echo "selected"; }?>>Uttar Pradesh</option>
                                                <option value="West Bengal" <?php if($_POST['state'] == "West Bengal"){ echo "selected"; }?>>West Bengal</option>
                                                </select>
													<div class="error2"></div>
												</div>
											</div>
                                            
                                           
                                            <div class="form-group">
												<label for="inputDefault" class="col-md-2 control-label">Zip</label>
												<div class="col-md-6">
													<input name="zip" class="form-control" type="text" id="zip" value="<?php echo $_POST['zip']; ?>" onKeyPress="return numbersonly(this, event)" maxlength="8">
													<div class="error2"></div>
												</div>
											</div>
											
											<div class="form-group">
												<label for="inputDefault" class="col-md-2 control-label">Status</label>
												<div class="col-md-1">
													<?php echo $cnf->statusBox("");?>
												</div>
											</div>
                                            
											<div class="form-group">
											<label class="col-md-2 control-label"></label>
											<div class="col-md-6">
											<p class="m-none">
											 <input type="hidden" name="hdProcess" value="add" />
                                            <input type="submit" value="Save" class="mb-xs mt-xs mr-xs btn btn-md btn-primary" id="addSubmit">
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