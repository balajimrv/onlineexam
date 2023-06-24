<?php include('includes/db_functions.php'); 
	$cnf = new DB_FUNCTINS();
	global $con;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- ========== Meta Tags ========== -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Sakthi Books - Online Exam Portal">

    <!-- ========== Page Title ========== -->
    <title><?php echo siteTitle; ?></title>

    <!-- ========== Favicon Icon ========== -->
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicon-16x16.png">


    <!-- ========== Start Stylesheet ========== -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.min.css" rel="stylesheet" />
    <link href="assets/css/flaticon-set.css" rel="stylesheet" />
    <link href="assets/css/elegant-icons.css" rel="stylesheet" />
    <link href="assets/css/magnific-popup.css" rel="stylesheet" />
    <link href="assets/css/owl.carousel.min.css" rel="stylesheet" />
    <link href="assets/css/owl.theme.default.min.css" rel="stylesheet" />
    <link href="assets/css/animate.css" rel="stylesheet" />
    <link href="assets/css/bootsnav.css" rel="stylesheet" />
    <link href="style.css" rel="stylesheet">
    <link href="assets/css/responsive.css" rel="stylesheet" />
    <!-- ========== End Stylesheet ========== -->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="assets/js/html5/html5shiv.min.js"></script>
      <script src="assets/js/html5/respond.min.js"></script>
    <![endif]-->

    <!-- ========== Google Fonts ========== -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700,800" rel="stylesheet">

</head>

<body>

    <!-- Preloader Start -->
    <div class="se-pre-con"></div>
    <!-- Preloader Ends -->

    <!-- Start Header Top 
    ============================================= -->
    <div class="top-bar-area address-one-lines bg-dark text-light">
        <div class="container">
            <div class="row">
                <div class="col-md-8 address-info">
                    <div class="info box">
                        <ul>
                            <li>
                                <i class="fas fa-envelope-open"></i> contact@sakthibooks.com
                            </li>
                            <li>
                                <i class="fas fa-phone"></i> 044 - 25967807 / 25966778, +91 9962033320
                            </li>
                        </ul>
                    </div>
                </div>
               
                <div class="user-login text-right col-md-4">
                	<span style="color:#FFFFFF; padding-right:20px;">
                    <a href="cart.php" class="btn-cart" title="Cart"><i class="fas fa-shopping-cart"></i> 0</a></span>
                    <a href="register.php">
                        <i class="fas fa-edit"></i> Register
                    </a>
                    <a href="login.php">
                        <i class="fas fa-user"></i> Login
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- End Header Top -->

    <!-- Header 
    ============================================= -->
    <header id="home">

        <!-- Start Navigation -->
        <nav class="navbar navbar-default attr-border navbar-sticky bootsnav">

            <!-- Start Top Search -->
            <div class="container">
                <div class="row">
                    <div class="top-search">
                        <div class="input-group">
                            <form action="search-results.php">
                                <input type="text" name="text" class="form-control" placeholder="Search">
                                <button type="submit">
                                    <i class="fas fa-search"></i>
                                </button>  
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Top Search -->

            <div class="container">

                <!-- Start Atribute Navigation -->
                <div class="attr-nav">
                    <ul>
                        <li class="search"><a href="#"><i class="fa fa-search"></i></a></li>
                        <li class="side-menu"><a href="#"><i class="fa fa-bars"></i></a></li>
                    </ul>
                </div>        
                <!-- End Atribute Navigation -->

                <!-- Start Header Navigation -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                        <i class="fa fa-bars"></i>
                    </button>
                    <a class="navbar-brand" href="index.php">
                        <img src="assets/img/logo.png" class="logo" alt="Logo">
                    </a>
                </div>
                <!-- End Header Navigation -->

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="navbar-menu">
                    <ul class="nav navbar-nav navbar-right" data-in="#" data-out="#">
                    
                    	<li <?php echo $cnf->curPageName('index.php', 'user'); ?>>
                            <a href="index.php">Home</a>
                        </li>
                        
                        <?php
							$sqlQryCat = "SELECT * FROM `".TBL_MAIN_CATEGORY."` WHERE cStatus = 'Y' ORDER BY `intCat_id` ASC";
							$sqlResCat = mysqli_query($con,$sqlQryCat);
							while($resRowCat = mysqli_fetch_object($sqlResCat)){
						?>
                        	<li class="dropdown <?php echo $cnf->curPageName('','user'); ?>">
                            <a href="#" class="dropdown-toggle active" data-toggle="dropdown" ><?php echo $resRowCat->vCatName; ?></a>
                            
                            <ul class="dropdown-menu">
                            
                            <?php
								$sqlSubCat = "SELECT * FROM `".TBL_CATEGORY."` WHERE intSubCatId = ".$resRowCat->intCat_id." AND cStatus = 'Y' ORDER BY `vCatName` ASC";
								$resSubCat = mysqli_query($con,$sqlSubCat);
								while($rowSubCat = mysqli_fetch_object($resSubCat)){
							?>
                                <li><a href="test-list.php"><?php echo $rowSubCat->vCatName; ?></a></li>
                            <?php } ?>
                            </ul>
                            
                        </li>
                        <?php
							}
						?>
                                                
                                                
                        <li <?php echo $cnf->curPageName('faq.php','user'); ?>>
                            <a href="faq.php">FAQ</a>
                        </li>
                        <li <?php echo $cnf->curPageName('contact.php','user'); ?>>
                            <a href="contact.php">Contact</a>
                        </li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div>
            
            <!-- Start Side Menu -->
            <div class="side">
                <a href="#" class="close-side"><i class="fa fa-times"></i></a>
                <div class="widget">
                    <h4 class="title">Welcome Mr. Balaji</h4>
                   
                    <ul>
                        <li><a href="test-list.php">Exams</a></li>
                        <li><a href="recent-order.php">Recent Order</a></li>
                        <li><a href="edit-profile.php">Edit Profile</a></li>
                        <li><a href="change-password.php">Change Password</a></li>
                        <li><a href="#">Logout</a></li>
                    </ul>
                </div>
                
                <div class="widget social">
                    <h4 class="title">Connect With Us</h4>
                    <ul class="link">
                        <li class="facebook"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                        <li class="twitter"><a href="#"><i class="fab fa-twitter"></i></a></li>
                        <li class="linkedin"><a href="#"><i class="fab fa-linkedin"></i></a></li>
                        <li class="pinterest"><a href="#"><i class="fab fa-youtube"></i></a></li>
                    </ul>
                </div>
            </div>
            <!-- End Side Menu -->

        </nav>
        <!-- End Navigation -->

    </header>
    <!-- End Header -->
    
