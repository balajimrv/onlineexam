<?php require_once("includes/header.php");

	if($_SESSION["intAdmin_Id"] !=''){ header("Location:dashboard.php"); }

	if($_POST["btnSubmit"]!="") { $cnf->adminLogin($_POST["username"],$_POST["password"]); }

	if($_GET["act"]=="session_expired") {
		$strMsg = "Please login to access!";
		echo $cnf->HideMsg(); 
	}

	if($_GET["act"]=="invalid") {
		$strMsg = "Invalid username or password!";
		echo $cnf->HideMsg(); 
	}

	if($_GET["act"]=="logout") {
		$strMsg = "User logged out successfully!";
		echo $cnf->HideMsg(); 
	}
?>

<script type="text/javascript">

	function valdateLogin(frm){

		var result = true;

		if(result) result = validateRequired(frm.username, 'Please enter the username');

		if(result) result = validateRequired(frm.password, 'Please enter the password');

		return result;

	}

</script>

	<body>

		<!-- start: page -->

		<section class="body-sign">
			<div class="center-sign">
				<a href="#" class="logo pull-left">
					<img src="assets/images/logo.png" />
				</a>

				<div class="panel panel-sign">
					<div class="panel-title-sign mt-xl text-right">
						<h2 class="title text-uppercase text-weight-bold m-none"><i class="fa fa-user mr-xs"></i> Admin Login</h2>
					</div>
                    
					<div class="panel-body">
                    	<div style="text-align:center; padding-bottom:10px; color: #FF0000; font-size: 12px; font-weight: bold;"><?php echo $strMsg?></div>
						<form action="index.php" method="post" name="frmLogin" onSubmit="return valdateLogin(this)">
                          <div class="form-group mb-lg">
								<label>Username</label>
								<div class="input-group input-group-icon">
                                    <input type="text" name="username" id="username" class="form-control input-lg" placeholder="Username">  
									<span class="input-group-addon">
										<span class="icon icon-lg">
											<i class="fa fa-user"></i>
										</span>
									</span>
								</div>
							</div>



							<div class="form-group mb-lg">
								<div class="clearfix">
									<label class="pull-left">Password</label>
								</div>

								<div class="input-group input-group-icon">
                                    <input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password">
									<span class="input-group-addon">
										<span class="icon icon-lg">
											<i class="fa fa-lock"></i>
										</span>
									</span>
								</div>
							</div>



							<div class="row">
								<div class="col-sm-8">
								</div>

								<div class="col-sm-4 text-right">
                                	<input type="hidden" name="btnSubmit" value="Process">
									<button type="submit" name="btnProcess" class="btn btn-primary hidden-xs">Sign In</button>
									<button type="submit" name="btnProcess" class="btn btn-primary btn-block btn-lg visible-xs mt-lg">Sign In</button>
								</div>
							</div>
						</form>
					</div>
				</div>

				<p class="text-center text-muted mt-md mb-md">&copy; Copyright <?php echo date('Y').' '.siteTitle; ?>. All Rights Reserved.</p>
			</div>
		</section>

		<!-- end: page -->

<?php //include("includes/footer.php"); ?>