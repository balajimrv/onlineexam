<?php include('includes/header.php'); ?>

    <!-- Start Breadcrumb 
    ============================================= -->
    <div class="breadcrumb-area shadow dark text-center bg-fixed text-light" style="background-image: url(assets/img/banner/2.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Recent Order</h1>
                    <ul class="breadcrumb">
                        <li><a href="index.php"><i class="fas fa-home"></i> Home</a></li>
                        <li class="active"> Recent Order</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumb -->
    
    <!-- Start Popular Courses 
    ============================================= -->
    <div class="popular-courses default-padding bottom-less without-carousel" style="min-height:350px">
        <div class="container">
            <div class="row">
                <div class="table-responsive">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>NO.</th>
                                                    <th>Exam Title</th>
                                                    <th>Price</th>
                                                    <th>Discount</th>
                                                    <th>Total</th>
                                                    <th>Payment Status</th>
                                                    <th>Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1.</td>
                                                    <td><a href="test-details.php">TNPSC Group II</a></td>
                                                    <td><i class="fas fa-rupee-sign"></i> 150.00</td>
                                                    <td>20%</td>
                                                    <td><strong><i class="fas fa-rupee-sign"></i> 120.00</strong></td>
                                                    <td class="text-center"><span class="badge badge-success" style="background-color:#28a745">Success</span></td>
                                                    <td>09-08-2022, 07:40 PM</td>
                                                </tr>
                                                <tr>
                                                    <td>2.</td>
                                                    <td><a href="test-details.php">IBPS PO</a></td>
                                                    <td><i class="fas fa-rupee-sign"></i> 180.00</td>
                                                    <td>---</td>
                                                    <td><strong><i class="fas fa-rupee-sign"></i> 180.00</strong></td>
                                                    <td class="text-center"><span class="badge badge-danger">Pending</span></td>
                                                    <td>10-08-2022, 12:30 PM</td>
                                                </tr>
                                                <tr>
                                                    <td>2.</td>
                                                    <td><a href="test-details.php">UPSC Prelims</a></td>
                                                    <td><i class="fas fa-rupee-sign"></i> 140.00</td>
                                                    <td>10%</td>
                                                    <td><strong><i class="fas fa-rupee-sign"></i> 126.00</strong></td>
                                                    <td class="text-center"><span class="badge badge-danger" style="background-color:#dc3545">Cancel</span></td>
                                                    <td>10-08-2022, 09:30 AM</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        
                                    </div>
            </div>
            
           
        </div>
    </div>
    <!-- End Popular Courses -->

    <?php include('includes/footer.php'); ?>