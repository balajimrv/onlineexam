<?php require_once("includes/header.php"); 

if($_REQUEST["ID"]!="") {
		$strSql = "Select * from  ".TBL_ORDER." where intOrd_id=".$_REQUEST["ID"]." ";
			if($cnf->records_fetch($strSql)==true) {
				$rows = mysqli_fetch_object($cnf->query_execute($strSql));
				$intOrd_id	= $rows->intOrd_id; 
				$vOrder_number = $rows->vOrder_number;
				$payment_type		= $rows->payment_type;
				$numOrd_status = $rows->numOrd_status;
				$cancel_date = $rows->cancel_date;
				$cancel_note = $rows->cancel_note;			
			}
		}	
		
		if($_POST["hdProcess"]=="Modify") {
			
		$date = explode('/', $_POST['cancel_date']);
		$new_date = $date[2].'-'.$date[1].'-'.$date[0];
		
		$fieldarray = array(
			"numOrd_status"=>$_REQUEST['reason'],
			"cancel_date"=>$new_date,
			"cancel_note"=>$cnf->strreplace($_REQUEST['cancel_note'])
		);

		$cnf->update(TBL_ORDER,$fieldarray,'intOrd_id',$_POST["txtID"]);
			
		header("Location:cancel_orders.php?act=Updated");	
		}
		
			if($strContentVal=="Exists") {
				$strMsg = Records_exists;
				echo $cnf->HideMsg();
			}
			
			if($_GET["act"]=="Modify") { $strbtn = "Modify"; } 
			else { $strbtn = "Save"; } 		

?>

<script type="text/javascript">	
function valdateAdd(frm){
	var result = true;
	if(result) result = validateCombo(frm.reason, 'Please select the reason');	
	var SDate = frm.cancel_date.value;
	if((result) && (SDate == '0000-00-00')){
		alert("Please select the cancel date");
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
						<h2>Enter Cancel Details</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="dashboard.php">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span><a href="orders.php">Manage Orders</a></span></li>
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
												<label for="inputDefault" class="col-md-2 control-label">Payment Mode</label>
												<div class="col-md-6">
													<?php echo $payment_type; ?>
											  </div>
											</div>
											<div class="form-group">
												<label for="inputDefault" class="col-md-2 control-label">Order Number</label>
												<div class="col-md-6">
													<?php echo $vOrder_number; ?>
												</div>
											</div>
                                            
											
                                            <div class="form-group">
												<label for="inputDefault" class="col-md-2 control-label">Reason for Cancel <span class="req"> *</span></label>
												<div class="col-md-6">
													<select name="reason" class="form-control">
														<option value="Customer Not Responding">Customer Not Responding</option>
                                                        <option value="Customer Requested to Cancel">Customer Requested to Cancel</option>
                                                        <option value="Wrong Item Dispatched">Wrong Item Dispatched</option>
                                                        <option value="Wrong Item Ordered">Wrong Item Ordered</option>
                                                        <option value="Not Interested">Not Interested</option>
                                                        <option value="Other Reason">Other Reason</option>
													</select>
											  </div>
											</div>
                                            
                                            <div class="form-group">
												<label for="inputDefault" class="col-md-2 control-label">Cancel Date <span class="req"> *</span></label>
												<div class="col-md-6">
													<div class="input-group">
														<span class="input-group-addon">
															<i class="fa fa-calendar"></i>
														</span>
														<input type="text" data-plugin-datepicker datepicker-orient-bottom class="form-control" name="cancel_date" id="cancel_date" value="">
													</div>
												</div>
											</div>
                                            
                                            <div class="form-group">
												<label for="inputDefault" class="col-md-2 control-label">Cancel Notes</label>
												<div class="col-md-6">                                                
                                                	<textarea name="cancel_note" class="form-control"><?php echo $cancel_note; ?></textarea>
												</div>
											</div>
                                            
											<div class="form-group">
											<label class="col-sm-2 control-label"></label>
											<div class="col-sm-6">
											<p class="m-none">
                                            <input type="hidden" name="txtID" value="<?php echo $rows->intOrd_id; ?>" />
											 <input type="hidden" name="hdProcess" value="Modify" />
                                            <input type="submit" value="Save" class="mb-xs mt-xs mr-xs btn btn-md btn-primary" id="addSubmit">
                                            <a href="orders.php" class="mb-xs mt-xs mr-xs btn btn-md btn-default">Cancel</a>
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