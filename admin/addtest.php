<?php require_once("includes/header.php"); 
if($_POST["hdProcess"]!="") {

		  
		$time = "00:00";
		$discount = 0;
	  if($_REQUEST['test_type'] == 1){
		  $time = $_REQUEST['hours'].":".$_REQUEST['minutes'];
		  $discount = $_REQUEST['discount'];
	  }

		$fieldarray = array(				

					"intSubCatId"=>$_REQUEST['selCategory'],
					"test_name"=>$cnf->strreplace($_REQUEST['test_name']),
					"total_questions"=>$_REQUEST['total_questions'],
					"test_time"=>$time,
					"instructions"=>$cnf->strreplace($_REQUEST['instructions']),
					"test_type"=>$_REQUEST['test_type'],
					"test_price"=>$_REQUEST['test_price'],
					"discount"=>$discount,
					"rating"=>$_REQUEST['rating'],
					"popular_test"=>$_REQUEST['popular_test'],
					"header_title"=>$_REQUEST['header_title'],
					"meta_desc"=>$_REQUEST['meta_desc'],
					"meta_keywords"=>$_REQUEST['meta_keywords'],
					"dtCreated"=>$cnf->datetime_format(),
					"cStatus"=>$_REQUEST['txtstatus']
				  );
			$test_id = $cnf->insert(TBL_TEST,$fieldarray);
			
			if($test_id !=""){
				foreach ($_REQUEST['tag_id'] as $tag_id){
					$field = array(
					"test_id"=>$test_id,
					"tags_id"=>$tag_id
					);
					$cnf->insert(TBL_TEST_TAGS,$field);
				}
			}

			header("Location:test.php?act=added");
}
if($_GET["act"]=="exists") {

	$strMsg = "This record already exists. Please add different one.";

	echo $cnf->HideMsg(); 

}	

?>


<link rel="stylesheet" href="assets/vendor/summernote/summernote.css" />

<script type="text/javascript">	

function valdateAdd(frm){

	var result = true;

	if(result) result = validateCombo(frm.selCategory, 'Please select the category');

	if(result) result = validateRequired(frm.test_name, 'Please enter the test name');
	
	if(result) result = validateRequired(frm.total_questions, 'Please enter total question');
	
	if(result) result = validateRequired(frm.instructions, 'Please enter test instructions');

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

						<h2>Create New Test</h2>

					

						<div class="right-wrapper pull-right">

							<ol class="breadcrumbs">

								<li>

									<a href="dashboard.php">

										<i class="fa fa-home"></i>

									</a>

								</li>

								<li><span><a href="test.php">Manage Tests</a></span></li>

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

												<label for="inputDefault" class="col-md-3 control-label">Category <font class="text_small"> *</font></label>

												<div class="col-md-6">

													<select name="selCategory" id="selCategory" class="form-control">

                                                      <option value="">--Select--</option>
													 <?php echo $cnf->displaySubSecCategory($_POST["selCategory"],TBL_CATEGORY,"vCatName","intCat_id")?>

                                                    </select>

													<div class="error"></div>

												</div>

											</div>

											<div class="form-group">

												<label for="inputDefault" class="col-md-3 control-label">Test Name <font class="text_small"> *</font></label>

												<div class="col-md-6">

													<input type="text" name="test_name" id="test_name" class="form-control" value="<?php echo $_POST["test_name"]?>">
                                                    
												</div>

											</div>
                                            
                                            <div class="form-group">

												<label for="inputDefault" class="col-md-3 control-label">No of Questions<font class="text_small"> *</font></label>

												<div class="col-md-2">

													<input type="text" name="total_questions" id="total_questions" class="form-control" value="<?php echo $_POST["total_questions"]?>" onKeyPress="return decimalNumbersOnly(this, event)">
                                                    
												</div>

											</div>
                                            
                                            <div class="form-group">

												<label for="inputDefault" class="col-md-3 control-label">Total Time<font class="text_small"> *</font></label>

												<div class="col-md-2">
													<div class="input-group timepicker">
                                                    <input type="text" class="form-control" name="hours" placeholder="HH" onKeyPress="return decimalNumbersOnly(this, event)">
                                                    <span class="input-group-addon">
                                                        <span class="fa fa-clock-o"></span>
                                                    </span>
                                                </div>
                                                    
												</div>
                                                
                                                <div class="col-md-2">
													<div class="input-group timepicker">
                                                    <input type="text" class="form-control" name="minutes" placeholder="MM" onKeyPress="return decimalNumbersOnly(this, event)">
                                                    <span class="input-group-addon">
                                                        <span class="fa fa-clock-o"></span>
                                                    </span>
                                                </div>
                                                    
												</div>

											</div>
                                            
                                            
											<div class="form-group">

												<label for="inputDefault" class="col-md-3 control-label">Test Instructions <font class="text_small"> *</font></label>

												<div class="col-md-8">                                                                                    
                                                    <textarea class="summernote" name="instructions" data-plugin-summernote data-plugin-options='{ "height": 120, "codemirror": { "theme": "ambiance" } }'><?php echo $_POST["instructions"]?></textarea>

												
												</div>

											</div>
                                            
                                            <div class="form-group">

												<label for="inputDefault" class="col-md-3 control-label">Test Type <font class="text_small"> *</font></label>

												<div class="col-md-6">

													<input type="radio" name="test_type" value="1" checked="checked" /> Paid
												    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
												    <input type="radio" name="test_type" value="2" /> Free

												</div>

											</div>
                                            
                                            
                                            <div class="form-group testType">

												<label for="inputDefault" class="col-md-3 control-label">Price <font class="text_small"> *</font></label>

												<div class="col-md-3">

													<input type="text" class="txt_inputs form-control" name="test_price"  id="test_price" value="<?php echo $_POST["test_price"]?>" onKeyPress="return decimalNumbersOnly(this, event)">

												</div>

											</div>
                                            
                                            <div class="form-group testType">

												<label for="inputDefault" class="col-md-3 control-label">Discount</label>
                                                
                                                <div class="col-md-2">
													<div class="input-group timepicker">
                                                    <input type="text" class="form-control" name="discount" placeholder="%" onKeyPress="return decimalNumbersOnly(this, event)">
                                                    <span class="input-group-addon">
                                                        %
                                                    </span>
                                                </div>
                                                    
												</div>

											</div>
                                            
                                            <div class="form-group">

												<label for="inputDefault" class="col-md-3 control-label">Rating <font class="text_small"> *</font></label>

												<div class="col-md-2">

													<select name="rating" class="form-control">
														<option value="2">2</option>
														<option value="3">3</option>
                                                        <option value="3.5">3.5</option>
                                                        <option value="4">4</option>
                                                        <option value="4.5">4.5</option>
                                                        <option value="5">5</option>
													  </select>

												</div>

											</div>
                                            
                                            <div class="form-group">

												<label for="inputDefault" class="col-md-3 control-label">Tags</label>

												<div class="col-md-9">
													
                                                    
                                                    <select class="form-control" multiple="multiple" data-plugin-options='{ "maxHeight": 200, "includeSelectAllOption": true, "enableCaseInsensitiveFiltering": true }' data-plugin-multiselect id="tag_id" name="tag_id[]">
                                                    
													<?php
													$sql = mysqli_query($con,"SELECT * FROM ".TBL_TAGS." WHERE cStatus='Y' ORDER BY `tags` ASC");
													while($res = mysqli_fetch_object($sql)){?>
													<option value="<?php echo $res->tags_id; ?>"><?php echo $res->tags; ?></option>
													<?php
													}
												   ?>
                                                  
												</select>
                                                
                                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">Add New Tag</button>
                                                        
												</div>

											</div>
                                            
                                            
                                            <div class="form-group">

												<label for="inputDefault" class="col-md-3 control-label">Popular Test</label>

												<div class="col-md-3">

													<select name="popular_test" class="txt_inputs form-control">
														<option value="Y">Yes</option>
														<option value="N" selected="selected">No</option>
													  </select>

													<div class="error1"></div>

												</div>

											</div>
                                            
                                            
                                            <div class="col-md-9 col-md-offset-1">
												<h3 class="text-center" style="color:#333; margin-bottom:20px;">Meta Tags</h3>
											</div>
                                            
                                            <div class="form-group">											
												<label for="inputDefault" class="col-md-3 control-label">Header Title</label>
												<div class="col-md-6">
													<input type="text" class="txt_inputs form-control" name="header_title" id="header_title" value="<?php echo $_POST["header_title"]?>" />
													<div class="error1"></div>
												</div>
											</div>
                                            
                                            <div class="form-group">											
												<label for="inputDefault" class="col-md-3 control-label">Meta Description</label>
												<div class="col-md-6">
													
                                                    <textarea class="txt_inputs form-control" name="meta_desc" id="meta_desc" rows="3"><?php echo $_POST["meta_desc"]?></textarea>
													<div class="error1"></div>
												</div>
											</div>
                                            
                                             <div class="form-group">											
												<label for="inputDefault" class="col-md-3 control-label">Meta Keywords</label>
												<div class="col-md-6">
													<textarea class="txt_inputs form-control" name="meta_keywords" id="meta_keywords" rows="3" style="margin-top:10px;"><?php echo $_POST["meta_keywords"]?></textarea>
													<div class="error1"></div>
												</div>
											</div>

											
											

											<div class="form-group">
												<label for="inputDefault" class="col-md-3 control-label">Status</label>
												<div class="col-md-1">
													<?php echo $cnf->statusBox("");?>
												</div>
											</div>

                                            

											<div class="form-group">

											<label class="col-md-3 control-label"></label>
											<div class="col-sm-6">

											<p class="m-none">

											 <input type="hidden" name="hdProcess" value="add" />

                                            <input type="submit" value="Save" class="mb-xs mt-xs mr-xs btn btn-md btn-primary" id="addSubmit">

                                            <a href="test.php" class="mb-xs mt-xs mr-xs btn btn-md btn-default">Cancel</a>

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
        
        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Tag</h4>
        </div>
        <div class="modal-body">
            <form id="tagFrom" class="form-horizontal mb-lg" novalidate>
                <div id="tag_error" class="text-center"></div>
                <div class="form-group mt-lg">
                    <label class="col-sm-3 control-label">Add Tag</label>
                    <div class="col-sm-6">
                        <input type="text" name="tag_name" id="tag_name" class="form-control" placeholder=""/>
                    </div>
                </div>													
            </form>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="saveTag">Save Tag</button>
        </div>
        </div>
        </div>
        </div>

        
<style>
.datepicker,
.timepicker,
.datetimepicker {
	.form-control {
		background: #fff;
	}
}
</style>
<script>
var defaults = {
	calendarWeeks: true,
	showClear: true,
	showClose: true,
	allowInputToggle: true,
	useCurrent: false,
	ignoreReadonly: true,
	minDate: new Date(),
	toolbarPlacement: 'top',
	locale: 'nl',
	icons: {
		time: 'fa fa-clock-o',
		date: 'fa fa-calendar',
		up: 'fa fa-angle-up',
		down: 'fa fa-angle-down',
		previous: 'fa fa-angle-left',
		next: 'fa fa-angle-right',
		today: 'fa fa-dot-circle-o',
		clear: 'fa fa-trash',
		close: 'fa fa-times'
	}
};

$(function() {
	var optionsTime = $.extend({}, defaults, {format:'HH:mm'});
	
	$('.timepicker').datetimepicker(optionsTime);
});
</script>
<?php include("includes/footer.php"); ?>