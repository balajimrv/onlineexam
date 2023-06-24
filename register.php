<?php include('includes/header.php'); 

if($_REQUEST['regValue']=='yes'){
	
		$strSqlSelect = "SELECT * FROM ".TBL_USERS." WHERE email='".trim($cnf->strreplace($_POST["email"]))."'";
		if($cnf->records_fetch($strSqlSelect)==true) {
			$strMsg = 'This eamil id already exists.';
			echo $cnf->HideMsg();
		}else{
			$strSqlSelect = "SELECT * FROM ".TBL_USERS." WHERE phone='".trim($cnf->strreplace($_POST["phone"]))."'";
			if($cnf->records_fetch($strSqlSelect)==true) {
				$strMsg = 'This phone number already exists.';
				echo $cnf->HideMsg();
			}else{			
				include("securimage.php");
				$img = new Securimage();
				$valid = $img->check($_POST['code']);
				if($valid == true){
					
					require_once 'includes/class.phpmailer.php';
					$mail = new PHPMailer(true);
					$admin_mail = new PHPMailer(true);
					
					$code = md5($_POST['code']);
					
					$fieldarray = array(
						"first_name"=>ucwords(strtolower($_REQUEST['first_name'])),
						"last_name"=>ucwords(strtolower($_REQUEST['last_name'])),
						"email"=>strtolower($_REQUEST['email']),
						"phone"=>$_REQUEST['phone'],
						"password"=>md5($_REQUEST['password']),
						"cStatus"=>"Y",					
						"emailStatus"=>"N",
						"emailStatus"=>"N",
						"dtCreated"=>$cnf->datetime_format(),
						"captcha"=>$code					
					);		
					$UID = $cnf->insert(TBL_USERS,$fieldarray);
					$newuserid = base64_encode($UID);				
					$toEmail = $_REQUEST['email'];	// to email
					
				$subject = "Sakthi Onlineexam - Registration Confirmation!"; //subject
				
				$message = '
				Dear '.ucwords($_REQUEST['first_name']).' '.ucwords($_REQUEST['last_name']).',<br /><br />				
				Welcome to sakthibooks.com!.<br><br>
				Your account has been created successfully.<br><br>
				<strong>Username: </strong>'.$txtEmail.'<br />
				<strong>Password: </strong> '.$txtPassword.'<br><br>
				In order to complete your registration with Online Exam you must confirm your e-mail address by clicking on the link below or copy and paste on address bar.<br>
				Confirmation Link:<br><a href="'.SITE_URL.'/confirm.php?uid='.$newuserid.'&code='.$code.'" TARGET="_blank">
							'.SITE_URL.'/confirm.php?uid='.$newuserid.'&code='.$code.'</a><br><br>';
				
				
				$mail->AddAddress($toEmail, ucwords($_REQUEST['first_name']));
				$mail->SetFrom(EMAIL_FROM_ADDR, SiteTitle);
				//$mail->AddCC('balajimrv@gmail.com', 'Balaji');
				$mail->AddReplyTo(EMAIL_FROM_ADDR, SiteTitle);			
				$mail->Subject = $subject;
				$mail->MsgHTML($message);
				$mail->Send();
				
				$_SESSION['seller_phone'] = $_REQUEST['phone'];
				
				$strMsg1 = "Dear ".ucwords($_REQUEST['first_name']).", <br />
			your profile was successfully created. A confirmation mail has been sent to the Email ID <span style='color:#FF0000;'>".$_REQUEST['email']."</span>. <br>Please check your email to activate your account. <br />Thank you.";
				}else{
					$strMsg ="Sorry, the code you entered was invalid. Please try again!.";
					echo $cnf->HideMsg();
				}	
			}
		}
	}


	if($_GET["act"]=="Exists") {
		$strMsg = Records_exists;
		echo $cnf->HideMsg();
	}
?>
<script type="text/javascript">
	
	function validateFrm(frm){
		var result = true;
		if(result) result = validateRequired(frm.first_name, 'Please enter your first name');
		if(result) result = validateRequired(frm.email, 'Please enter your email address');
		if(result) result = validateEmail(frm.email, 'Invalid email id');
		if(result) result = validateRequired(frm.phone, 'Please enter your mobile no');
		if(result) result = validateRequired(frm.password, 'Please enter your password');
		if(result) result = validateRequired(frm.confirmPassword, 'Please enter your confirm password');
		if(result) result = compareFields(frm.password, frm.confirmPassword, 'Your passwords are mismatch!');
		if(result) result = validateRequired(frm.code, 'Please enter the security code');
		return result;
	}
</script>

    <!-- Start Signup 
    ============================================= -->
    <div class="login-area default-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                <?php
				if($strMsg !=''){ echo '<p class="errorMgs" id="divMsg">'.$strMsg.'</p>';}
				if($strMsg1 !=''){ echo '<p style="font-weight:bold; padding-top:10px; line-height:24px; padding-bottom:50px;">'.$strMsg1.'</p>';}else{
				?>
                    <form class="white-popup-block" name="frm" action="register.php" method="post" onsubmit="return validateFrm(this)">
                        <div class="col-md-4 login-social">
                            
                            
                        </div>
                        <div class="col-md-8 login-custom">
                            <h4>Register a new account</h4>
                            
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="form-group">
                                        <input class="form-control" name="first_name" id="first_name" placeholder="First Name*" type="text" value="">
                                    </div>
                                </div>
                            </div>
                             <div class="col-md-12">
                                <div class="row">
                                    <div class="form-group">
                                        <input class="form-control" name="last_name" id="last_name" placeholder="Last Name" type="text" value="">
                                    </div>
                                </div>
                            </div>
                             
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="form-group">
                                        <input class="form-control" name="email" id="email" placeholder="Email*" type="email" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="form-group">
                                        <input class="form-control" name="phone" id="phone" placeholder="Mobile*" type="text" onblur="return checkPhone(this.value);" value="<?php echo $_POST['phone']; ?>" onkeypress="return numbersonly(this, event)" maxlength="13">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Password*" type="password" id="password" name="password" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Confirm Password*" type="password" id="confirmPassword" name="confirmPassword" value="">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="form-group">
                                        <img src="securimage_show.php?sid=<?php echo md5(uniqid(time())); ?>">                              
                     					<input name="code" class="form-control" type="text" id="code" placeholder="Security Code" value="" style="margin-top:10px; text-transform:uppercase;">
                                    </div>
                                </div>
                            </div>
                            
                            
                            <div class="col-md-12">
                                <div class="row">
                                	<input type="hidden" name="regValue" value="yes" />
                                    <input name="submit" type="submit" value="Register" class="btn btn-info" />
                                </div>
                            </div>
                            <p class="link-bottom">Are you a member? <a href="login.php">Login now</a></p>
                        </div>
                    </form>
                <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <!-- End Login Area -->

   <?php include('includes/footer.php'); ?>