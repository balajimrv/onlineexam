<?php require_once("includes/header.php"); 

if($_POST["hdProcess"]!="") {

	if($_REQUEST['txtstatus'] == "Y"){ $status = "Y"; }else{ $status = "N"; }		

	$fieldarray = array(
				"author_name"=>addslashes($_REQUEST['author_name']),
				"dtCreated"=>$cnf->datetime_format(),
				"cStatus"=>$status
			  );


	$cnf->insert(TBL_AUTHOR,$fieldarray);
	header("Location:orders.php?act=added");
}

?>

<script type="text/javascript">
function valdateAdd(frm){
	var result = true;
	//if(result) result = validateRequired(frm.start_date, 'Please select the start date');
	//if(result) result = validateRequired(frm.end_date, 'Please select the end date');
	
		var SDate = frm.start_date.value;    	
    	var EDate = frm.end_date.value;
	
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
		var CDate = (day+ "-" + month + "-" + year);
			  
		var alertReason1 =  'End date must be greater than or equal to  start date.' 
		//var alertReason2 =  'End date can not be less than current date.';
		//var alertReason3 =	'Start date can not be less than current date.';
		//Start Date
		var dt1		= parseInt(SDate.substring(0,2),10);
		var mon1	= parseInt(SDate.substring(3,5),10);
		var yr1		= parseInt(SDate.substring(6,10),10);
	
		//End Date
		var dt2		= parseInt(EDate.substring(0,2),10);
		var mon2	= parseInt(EDate.substring(3,5),10);
		var yr2		= parseInt(EDate.substring(6,10),10);
	
		//Current Date
		var cyr2	= parseInt(CDate.substring(0,2),10);
		var cmon2	= parseInt(CDate.substring(3,5),10);
		var cdt2	= parseInt(CDate.substring(6,10),10);
		
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

						<h2>Download Payment (CSV)</h2>

					

						<div class="right-wrapper pull-right">

							<ol class="breadcrumbs">

								<li>

									<a href="dashboard.php">

										<i class="fa fa-home"></i>

									</a>

								</li>

								<li><span><a href="orders.php">Manage Payment</a></span></li>

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

										<form action="filter_orders.php" method="POST" class="form-horizontal form-bordered" name="frm" onSubmit="return valdateAdd(this)">

											
                                            <div class="form-group">
                                                <label for="inputDefault" class="col-md-3 control-label">Start Date <font class="text_small"> *</font></label>
                                                <div class="col-md-3">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                        </span>
                                                        <input type="text" data-plugin-datepicker class="form-control" name="start_date" id="start_date" value="">
                                                    </div>
                                                </div>
                                            </div>
                                                                                        
                                            <div class="form-group">
                                                <label for="inputDefault" class="col-md-3 control-label">End Date <font class="text_small"> *</font></label>
                                                <div class="col-md-3">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                        </span>
                                                        <input type="text" data-plugin-datepicker class="form-control" name="end_date" id="end_date" value="">
                                                    </div>
                                                </div>
                                            </div>

											<div class="form-group">

											<label class="col-sm-3 control-label"></label>

											<div class="col-sm-6">

											<p class="m-none">

											 <input type="hidden" name="hdProcess" value="add" />

                                            <input type="submit" value="Submit" class="mb-xs mt-xs mr-xs btn btn-md btn-primary" id="addSubmit">

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