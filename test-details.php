<?php include('includes/header.php'); ?>

    <!-- Start Breadcrumb 
    ============================================= -->
    <div class="breadcrumb-area shadow dark text-center bg-fixed text-light" style="background-image: url(assets/img/banner/2.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Test Details</h1>
                    <ul class="breadcrumb">
                        <li><a href="#"><i class="fas fa-home"></i> Home</a></li>
                        <li><a href="#">Exams</a></li>
                        <li class="active">TNPSC Group II</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumb -->

    <!-- Start Course Details 
    ============================================= -->
    <div class="course-details-area default-padding">
        <div class="container">
            <div class="row">
            	<!-- Start Sidebar -->
                <?php include('sidebar.php'); ?>
                <!-- End Sidebar -->
                
                <div class="col-md-8">
                    <div class="course-details-info">
                        <!-- Star Top Info -->
                        <div class="top-info">
                            <!-- Title-->
                            <div class="title">
                                <h2>TNPSC Group II - Test</h2>
                            </div>
                            <!-- End Title-->

                            <!-- Thumbnail -->
                            <div class="thumb">
                                <img src="assets/img/logo/tnpsc.jpg" alt="Thumb">
                            </div>
                            <!-- End Thumbnail -->

                            <!-- Course Meta -->
                            <div class="course-meta">
                                <div class="item author">
                                    <div class="thumb">
                                        <a href="#"><img alt="Thumb" src="assets/img/logo/tnpsc.jpg"></a>
                                    </div>
                                    <div class="desc">
                                        <h4>Category</h4>
                                        <a href="#">TNPSC</a>
                                    </div>
                                </div>
                                <div class="item category">
                                    <h4>Questions</h4>
                                    <a href="#">200</a>
                                </div>
                                <div class="item category">
                                    <h4>Time</h4>
                                    <a href="#">03.00 Hrs</a>
                                </div>
                                <div class="item price">
                                    <h4>Price</h4>
                                    <span>FREE</span>
                                </div>
                                <div class="item rating">
                                    <h4>Rating</h4>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                    <span>4.5</span>
                                </div>
                                
                                
                            </div>
                            <!-- End Course Meta -->
                        </div>
                        <!-- End Top Info -->

                       <div class="tab-content tab-content-info">
                               <div class="info title">
                                        <h4>Test Description</h4>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus odio nibh, facilisis at diam eu, molestie ornare turpis. Morbi consequat lectus vel fermentum eleifend.
                                        </p>
                                        <h4>Test Instructions</h4>
                                        <ul>
                                            <li><i class="fas fa-check-double"></i> Total number of questions : 200</li>
                                            <li><i class="fas fa-check-double"></i> Each question carries 1 Mark</li>
                                            <li><i class="fas fa-check-double"></i> Negative marks of Each Questions: 0 Marks</li>
                                            <li><i class="fas fa-check-double"></i> Time allotted : 03.00 hrs</li>
                                        </ul>
                                    </div>
                                    
                                <div class="align-right">
                                    <a class="btn btn-dark effect btn-sm" href="onlinetest.php">
                                        Start Test <i class="fas fa-angle-double-right"></i>
                                    </a>
                                </div>
                            </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <!-- End Course Details -->

    <?php include('includes/footer.php'); ?>