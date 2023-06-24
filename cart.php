<?php include('includes/header.php'); ?>

    <!-- Start Breadcrumb 
    ============================================= -->
    <div class="breadcrumb-area shadow dark text-center bg-fixed text-light" style="background-image: url(assets/img/banner/2.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Cart</h1>
                    <ul class="breadcrumb">
                        <li><a href="index.php"><i class="fas fa-home"></i> Home</a></li>
                        <li class="active"> Cart</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumb -->
    
    <!-- Start Popular Courses 
    ============================================= -->
    <div class="popular-courses default-padding bottom-less without-carousel">
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
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1.</td>
                                                    <td><a href="test-details.php">TNPSC Group II</a></td>
                                                    <td><i class="fas fa-rupee-sign"></i> 150.00</td>
                                                    <td>20%</td>
                                                    <td class="text-right"><strong><i class="fas fa-rupee-sign"></i> 120.00</strong></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        
                                    </div>
            </div>
            <div class="row" style="background-color:#D0E6FA; padding:10px 0;">
                <table style="font-weight:bold; margin-right: 5px;" align="right" >
                    <tbody>
                        <tr>
                            <td align="right">Subtotal : </td>
                            <td width="5">&nbsp;</td>
                            <td><div align="right"><i class="fas fa-rupee-sign"></i> 120.00</div></td>
                        </tr>
                        <tr>
                            <td align="right">Tax : </td>
                            <td>&nbsp;</td>
                            <td><div align="right"><i class="fas fa-rupee-sign"></i> 0.00 </div></td>
                        </tr>
                        <tr>
                            <td align="right">Estimated Total : </td>
                            <td>&nbsp;</td>
                            <td><div align="right"><i class="fas fa-rupee-sign"></i> 120.00</div></td>
                        </tr>
                    </tbody>
                </table>
           </div>
           <div class="row padding-top-40 text-right">
           		<form action="#">
           		<button type="button" class="btn btn-success btn-lg"><i class="fas fa-credit-card"></i> &nbsp; PAY NOW!</button>
                </form>
           </div>
        </div>
    </div>
    <!-- End Popular Courses -->

    <?php include('includes/footer.php'); ?>