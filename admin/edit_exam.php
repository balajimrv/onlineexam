<?php require_once("includes/header.php");

if($_REQUEST["id"]!="") {

		$strSql = "SELECT * FROM ".TBL_FORTHCOMING_EXAMS." WHERE intForthComingExamId =".$_GET["id"]." ";

		if($cnf->records_fetch($strSql)==true) {

			$rows = mysqli_fetch_object($cnf->query_execute($strSql));
			
		}else{

			header("Location:exams.php?act=invalid");
		}

	}else{

		header("Location:exams.php?act=invalid");

	}

if($_POST["action"]=="update") {

		if($_REQUEST['txtstatus'] == "Y"){ $status = "Y"; }else{ $status = "N"; }
		$date = explode('/', $_POST['txt_start_date']);
		$new_date = $date[2].'-'.$date[1].'-'.$date[0];
		
		$fieldarray = array(				
					"vTitle"=>$cnf->strreplace($_REQUEST['txtExamName']),
					"dtExamDate"=>$new_date,
					"dtModified"=>$cnf->datetime_format(),
					"cStatus"=>$status
				  );
		$cnf->update(TBL_FORTHCOMING_EXAMS,$fieldarray,'intForthComingExamId',$_POST["txtID"]);
		header("Location:exams.php?act=updated");		
	}
?>


<script type="text/javascript">	
function valdateAdd(frm){
	var result = true;
	if(result) result = validateRequired(frm.txtExamName, 'Please enter the exam name');
	var SDate = frm.txt_start_date.value;
	if((result) && (SDate == '')){
			alert("Please select the exam date");
			return false;
	}
	
	var today = new Date()
		var month = today.getMonth()+1
		var year = today.getFullYear()
		var day = today.getDate()
	
		if(day<10) day = "0" + day
		if(month<10) month= "0" + month 
		var CDate = (year + "-" + month + "-" + day);
			  
		var alertReason3 =	'Exam date can not be less than current date.';
		//Start Date
		var yr1		= parseInt(SDate.substring(0,4),10);
		var mon1	= parseInt(SDate.substring(5,7),10);
		var dt1		= parseInt(SDate.substring(8,10),10);
		
		//Current Date
		var cyr2	= parseInt(CDate.substring(0,4),10);
		var cmon2	= parseInt(CDate.substring(5,7),10);
		var cdt2	= parseInt(CDate.substring(8,10),10);
		
		var startDate = new Date(yr1, mon1, dt1);
		var currDate  = new Date(cyr2, cmon2, cdt2); 
			
		if(currDate > startDate) {
			alert(alertReason3);
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

						<h2>Edit Exam</h2>

					

						<div class="right-wrapper pull-right">

							<ol class="breadcrumbs">

								<li>

									<a href="dashboard.php">

										<i class="fa fa-home"></i>

									</a>

								</li>

								<li><span><a href="exams.php">Manage Exam</a></span></li>

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

												<label for="inputDefault" class="col-md-3 control-label">Forthcoming Exam Name <font class="text_small"> *</font></label>

												<div class="col-md-6">

													<input type="text" name="txtExamName" id="txtExamName" class="form-control" value="<?php echo $rows->vTitle; ?>">

													<div class="error1"></div>

												</div>

											</div>

											<div class="form-group">

												<label for="inputDefault" class="col-md-3 control-label">Exam Date <font class="text_small"> *</font></label>

												<div class="col-md-6">
													<div class="input-group">
														<span class="input-group-addon">
															<i class="fa fa-calendar"></i>
														</span>
														<input type="text" data-plugin-datepicker class="form-control" name="txt_start_date" id="txt_start_date" value="<?php echo date("d/m/Y", strtotime($rows->dtExamDate)); ?>">
													</div>
												</div>

											</div>

											
											<div class="form-group">

                                                <label class="col-sm-2 control-label"></label>

                                                <div class="col-sm-6">

                                                    <div class="checkbox-custom checkbox-success">

                                                        <input type="checkbox" name="txtstatus" id="txtstatus " value="Y" <?php if($rows->cStatus == "Y"){ echo "checked"; } ?>>

                                                        <label for="checkboxStatus">Status <font class="text_small"> *</font></label>

                                                    </div>

                                    

                                                </div>

                                            </div>

                                            

											<div class="form-group">

											<label class="col-sm-2 control-label"></label>

											<div class="col-sm-6">

											<p class="m-none">
                                            <input type="hidden" name="action" value="update" />
                                            <input type="hidden" name="txtID" value="<?php echo $rows->intForthComingExamId; ?>" />
                                            <input type="submit" value="Update" class="mb-xs mt-xs mr-xs btn btn-md btn-primary" id="addSubmit">
                                            <a href="exams.php" class="mb-xs mt-xs mr-xs btn btn-md btn-default">Cancel</a>

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