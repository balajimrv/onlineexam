<?php 
include("includes/header.php");
	if($_REQUEST["id"]!="") {
		$strSql = "SELECT * FROM ".TBL_ORDER." WHERE intOrd_id =".$_GET["id"]." ";
		if($cnf->records_fetch($strSql)==true) {
			$rows = mysqli_fetch_object($cnf->query_execute($strSql));
			$intOrd_id 			= $rows->intOrd_id;
			$vOrder_number		= $rows->vOrder_number;
			$payment_type		= $rows->payment_type;
			$dtOrd_date			= $rows->dtOrd_date;
			$dtOrd_last_update	= $rows->dtOrd_last_update;
			$numOrd_status		= $rows->numOrd_status;
		}else{
			header("Location:new_orders.php?act=invalid");
		}
	}else{
		header("Location:new_orders.php?act=invalid");
	}


	if($_POST["action"]=="update") {
		$date = explode('/', $_POST['payment_date']);
		$new_date = $date[2].'-'.$date[1].'-'.$date[0];
		
		$fieldarray = array(
			"dtOrd_last_update"=>$new_date,
			"numOrd_status"=>$_REQUEST['selPaymentStatus']
		  );
		$cnf->update(TBL_ORDER,$fieldarray,'intOrd_id',$_POST["txtID"]);
		
		if($_REQUEST['selPaymentStatus'] == "Completed"){
				header("Location:orders.php?act=updated");
			}else{
				header("Location:new_orders.php?act=updated");
			}			
		header("Location:new_orders.php?act=updated");
	}
?>



<script type="text/javascript">
function valdateAdd(frm){
		var result = true;
		var SDate = frm.order_date.value;    	
    	var EDate = frm.payment_date.value;
	
		 if((result) && (EDate == '')) {
				alert("Please select the payment date");
				return false;
		}
	
		var today = new Date()
		var month = today.getMonth()+1
		var year = today.getFullYear()
		var day = today.getDate()
	
		if(day<10) day = "0" + day
		if(month<10) month= "0" + month 
		var CDate = (year + "-" + month + "-" + day);
			  
		var alertReason1 =  'Payment date must be greater than or equal to order date.';
		
		//Start Date
		var yr1		= parseInt(SDate.substring(0,4),10);
		var mon1	= parseInt(SDate.substring(5,7),10);
		var dt1		= parseInt(SDate.substring(8,10),10);
	
		//End Date
		var yr2		= parseInt(EDate.substring(0,4),10);
		var mon2	= parseInt(EDate.substring(5,7),10);
		var dt2		= parseInt(EDate.substring(8,10),10);
		
		//Current Date
		var cyr2	= parseInt(CDate.substring(0,4),10);
		var cmon2	= parseInt(CDate.substring(5,7),10);
		var cdt2	= parseInt(CDate.substring(8,10),10);
		
		var startDate = new Date(yr1, mon1, dt1);
		var endDate   = new Date(yr2, mon2, dt2);
		var currDate  = new Date(cyr2, cmon2, cdt2);
		
	   if(startDate > endDate) {
			alert(alertReason1);
			return false;
		}
		
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

						<h2>Modify Order Status</h2>

					

						<div class="right-wrapper pull-right">

							<ol class="breadcrumbs">

								<li>

									<a href="dashboard.php">

										<i class="fa fa-home"></i>

									</a>

								</li>

								<li><span><a href="new_orders.php">New Orders</a></span></li>

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

												<label for="inputDefault" class="col-md-2 control-label">PAYMENT MODE</label>

												<div class="col-md-6">
													<?php echo $payment_type; ?>
												</div>

											</div>

											<div class="form-group">

												<label for="inputDefault" class="col-md-2 control-label">ORDER NUMBER</label>

												<div class="col-md-6">
													<?php echo $vOrder_number; ?>
												</div>

											</div>

											<div class="form-group">

												<label for="inputDefault" class="col-md-2 control-label">ORDER DATE</label>

												<div class="col-md-6">

													<?php 
														$order_date =  date('d-m-Y', strtotime($dtOrd_date));
														echo $order_date;
													?>

												</div>

											</div>

                                            

                                            <div class="form-group">

												<label for="inputDefault" class="col-md-2 control-label">PAYMENT STATUS</label>

												<div class="col-md-6">                                                    
                                                <select name="selPaymentStatus" id="selPaymentStatus" class="form-control">
                                                    <option value="New" <?php if($numOrd_status == "New"){ echo "selected"; }?>>New</option>
                                                    <option value="Cancelled" <?php if($numOrd_status == "Cancelled"){ echo "selected"; }?>>Cancelled</option>
                                                    <option value="Pending" <?php if($numOrd_status == "Pending"){ echo "selected"; }?>>Pending</option>
                                                    <option value="Completed" <?php if($numOrd_status == "Completed"){ echo "selected"; }?>>Completed</option>
                                                </select>
												</div>

											</div>

																						

                                             <div class="form-group">

												<label for="inputDefault" class="col-md-2 control-label">PAYMENT DATE</label>

												<div class="col-md-6">
                                                
                                                <div class="input-group">
														<span class="input-group-addon">
															<i class="fa fa-calendar"></i>
														</span>
														<?php
													if($dtOrd_last_update == "0000-00-00 00:00:00"){
														$payment_date = "";
													}else{
														$payment_date =  date('Y-m-d', strtotime($dtOrd_last_update));
													}
												?>
												  <input name="order_date" type="hidden" id="order_date" value="<?php echo $dtOrd_date;  ?>" readonly>
												  

													<input type="text" data-plugin-datepicker class="form-control" name="payment_date" id="payment_date" value="<?php echo $payment_date;  ?>">
													</div>
                                                
                                                 
												</div>

											</div>


											<div class="form-group">

                                                <label class="col-sm-2 control-label"></label>

                                                <div class="col-sm-6">

                                                    <p class="m-none">

                                                        <input type="hidden" name="action" value="update" />

                                                         <input type="hidden" name="txtID" value="<?php echo $rows->intOrd_id; ?>" />

                                                        <input type="submit" value="Update" class="mb-xs mt-xs mr-xs btn btn-md btn-primary" id="addSubmit">

                                                        <a href="new_orders.php" class="mb-xs mt-xs mr-xs btn btn-md btn-default">Cancel</a>

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