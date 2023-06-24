<?php require_once("includes/header.php"); 

if($_POST["hdProcess"]!="") {
	$strSql = "SELECT * FROM ".TBL_USERS." WHERE vEmail ='".strtolower($_POST["vEmail"])."'";
if($cnf->records_fetch($strSql)==true) {
		header("Location:adduser.php?act=exists");
} else {
		if($_REQUEST['txtstatus'] == "Y"){ $status = "Y"; }else{ $status = "N"; }		
			$fieldarray = array(
					"vFname"=>ucwords(strtolower($_REQUEST['vFname'])),	
					"vLname"=>ucwords(strtolower($_REQUEST['vLname'])),
					"vPassword"=>md5($_REQUEST['vPassword']),
					"vEmail"=>strtolower($_REQUEST['vEmail']),
					"intPhone"=>$_REQUEST['intPhone'],					
					"vAddress"=>$_REQUEST['vAddress'],
					"vCity"=>$_REQUEST['vCity'],
					"vState"=>$_REQUEST['vState'],
					"intZip"=>$_REQUEST['intZip'],
					"dtCreated"=>$cnf->datetime_format(),
					"cStatus"=>$status,
					"bitEmailStatus"=>'Y',
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

	function validate(frm){
		var result = true;
				
		var SDate = frm.txt_start_date.value;    	
    	var EDate = frm.txt_end_date.value;
	
		if((result) && (SDate == '')){
			alert("Please select start date");
			return false;
		}
		 if((result) && (EDate == '')) {
				alert("Please select end date");
				return false;
		}
	
		var today = new Date()
		var month = today.getMonth()+1
		var year = today.getFullYear()
		var day = today.getDate()
	
		if(day<10) day = "0" + day
		if(month<10) month= "0" + month 
		var CDate = (year + "-" + month + "-" + day);
			  
		var alertReason1 =  'End date must be greater than or equal to  start date.' 
		//var alertReason2 =  'End date can not be less than current date.';
		//var alertReason3 =	'Start date can not be less than current date.';
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
	
	/*
		if(currDate > endDate) {
			alert(alertReason2);
			return false;
		}
	
		if(currDate > startDate) {
			alert(alertReason3);
			return false;
		}
*/		
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
						<h2>Download Order Report</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="dashboard.php">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span></span></li>
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
										<form action="download_file.php?dwn=excel" method="POST" class="form-horizontal form-bordered" name="frm" onSubmit="return validate(this)">
											
											<div class="form-group">
												<label for="inputDefault" class="col-md-3 control-label">Start Date <span class="req"> *</span></label>
												<div class="col-md-4">
													
													<div class="input-group">
														<span class="input-group-addon">
															<i class="fa fa-calendar"></i>
														</span>
														<input type="text" data-plugin-datepicker class="form-control" name="txt_start_date" id="txt_start_date">
													</div>
											  </div>
											</div>
											
                                            
                                            <div class="form-group">
												<label for="inputDefault" class="col-md-3 control-label">End Date <span class="req"> *</span></label>
												<div class="col-md-4">
													<div class="input-group">
														<span class="input-group-addon">
															<i class="fa fa-calendar"></i>
														</span>
														<input type="text" data-plugin-datepicker class="form-control" name="txt_end_date" id="txt_end_date">
													</div>
											  </div>
											</div>
                                            
											<div class="form-group">
											<label class="col-sm-3 control-label"></label>
											<div class="col-sm-4">
											<p class="m-none">
											 <input type="hidden" name="hdProcess" value="add" />
                                            <input type="submit" value="Submit" class="mb-xs mt-xs mr-xs btn btn-md btn-primary" id="addSubmit">
                                            <a href="order.php" class="mb-xs mt-xs mr-xs btn btn-md btn-default">Cancel</a>
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