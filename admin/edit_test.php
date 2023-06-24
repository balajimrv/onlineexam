<?php require_once("includes/header.php"); 
if($_REQUEST["id"]!="") {

		$strSql = "SELECT * FROM ".TBL_TEST." WHERE test_id =".$_GET["id"]." ";

		if($cnf->records_fetch($strSql)==true) {

			$rows = mysqli_fetch_object($cnf->query_execute($strSql));
			
		}else{

			header("Location:test.php?act=invalid");
		}

	}else{

		header("Location:test.php?act=invalid");

	}

	if($_POST["action"]=="update") {
		
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
					"cStatus"=>$_REQUEST['txtstatus']
				  );
				  
			$cnf->update(TBL_TEST,$fieldarray,'test_id',$_POST["txtID"]);
			
			//Delete Old Tags
			$old_tags_id = explode(",", $_POST['previous_tag_id']);
			/*foreach ($old_tags_id as $old_id){
				@mysqli_query($con,"DELETE FROM ".TBL_PRODUCT_TAGS." WHERE product_id=".$_POST["txtID"]." AND tags_id=".$old_id." LIMIT 1");
			}*/
			@mysqli_query($con,"DELETE FROM ".TBL_TEST_TAGS." WHERE test_id=".$_POST["txtID"]."");
			
			//Insert New Tags
			foreach ($_REQUEST['tag_id'] as $tag_id){
				$field = array(
				"test_id"=>$rows->test_id,
				"tags_id"=>$tag_id
				);
				$cnf->insert(TBL_TEST_TAGS,$field);
			}
			
			header("Location:test.php?act=Updated");	
	}
	
			
		if($strContentVal=="Exists") {
			$strMsg = Records_exists;
			echo $cnf->HideMsg();
		}
		
		if($_POST["hdProcess"]=="Delete") {
			$strSqlDelete = "delete from ".TBL_TEST." where test_id=".$_POST["txtID"];
			$cnf->query_execute($strSqlDelete);
			header("Location:test.php?page=".$_REQUEST["txtPage"]."&act=Deleted");
		}
		
		if($_GET["act"]=="Delete") {
		
			//delete the records
			$strSqlDelete = "delete from ".TBL_TEST." where test_id=".$_GET["id"];
			$cnf->query_execute($strSqlDelete);
			header("Location:test.php?page=".$_GET["page"]."&act=Deleted");
		}
		
		if($_GET["act"]=="Modify") { $strbtn = "Modify"; } 
		else if($_GET["act"]=="Delete") { $strbtn = "Delete"; }
		else { $strbtn = "Save"; } 	
?>



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
<link rel="stylesheet" href="assets/vendor/summernote/summernote.css" />
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

						<h2>Edit Test</h2>

					

						<div class="right-wrapper pull-right">

							<ol class="breadcrumbs">

								<li>

									<a href="dashboard.php">

										<i class="fa fa-home"></i>

									</a>

								</li>

								<li><span><a href="test.php">Manage Test</a></span></li>

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

										<form action="" method="POST" class="form-horizontal form-bordered" name="frm" enctype="multipart/form-data" onSubmit="return valdateAdd(this)">

											<div class="form-group">

												<label for="inputDefault" class="col-md-3 control-label">Category <font class="text_small"> *</font></label>

												<div class="col-md-6">

													<select name="selCategory" id="selCategory" class="form-control">

                                                      <option value="">--Select--</option>
                                                      <?php echo $cnf->displaySubSecCategory($rows->intSubCatId,TBL_CATEGORY,"vCatName","intCat_id")?>

                                                    </select>

													<div class="error"></div>

												</div>

											</div>

											<div class="form-group">

												<label for="inputDefault" class="col-md-3 control-label">Test Name <font class="text_small"> *</font></label>

												<div class="col-md-6">

													<input type="text" name="test_name" id="test_name" class="form-control" value="<?php echo $rows->test_name;?>">
                                                    
												</div>

											</div>
                                            
                                            <div class="form-group">

												<label for="inputDefault" class="col-md-3 control-label">No of Questions<font class="text_small"> *</font></label>

												<div class="col-md-2">

													<input type="text" name="total_questions" id="total_questions" class="form-control" value="<?php echo $rows->total_questions;?>" onKeyPress="return decimalNumbersOnly(this, event)">
                                                    
												</div>

											</div>
                                            
                                            <div class="form-group">

												<label for="inputDefault" class="col-md-3 control-label">Total Time<font class="text_small"> *</font></label>
												<?php
												$time = explode (":", $rows->test_time); 
												
                                                ?>
												<div class="col-md-2">
													<div class="input-group timepicker">
                                                    <input type="text" class="form-control" name="hours" placeholder="HH" onKeyPress="return decimalNumbersOnly(this, event)" value="<?php echo $time[0];?>">
                                                    <span class="input-group-addon">
                                                        <span class="fa fa-clock-o"></span>
                                                    </span>
                                                </div>
                                                    
												</div>
                                                
                                                <div class="col-md-2">
													<div class="input-group timepicker">
                                                    <input type="text" class="form-control" name="minutes" placeholder="MM" onKeyPress="return decimalNumbersOnly(this, event)" value="<?php echo $time[1];?>">
                                                    <span class="input-group-addon">
                                                        <span class="fa fa-clock-o"></span>
                                                    </span>
                                                </div>
                                                    
												</div>

											</div>
                                            
                                            
											<div class="form-group">

												<label for="inputDefault" class="col-md-3 control-label">Test Instructions <font class="text_small"> *</font></label>

												<div class="col-md-8">                                                                                    
                                                    <textarea class="summernote" name="instructions" data-plugin-summernote data-plugin-options='{ "height": 120, "codemirror": { "theme": "ambiance" } }'><?php echo $rows->instructions; ?></textarea>

												
												</div>

											</div>
                                            
                                            <div class="form-group">

												<label for="inputDefault" class="col-md-3 control-label">Test Type <font class="text_small"> *</font></label>

												<div class="col-md-6">

													<input type="radio" name="test_type" value="1" <?php if($rows->test_type == 1){ echo"checked"; } ?> /> Paid
												    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
												    <input type="radio" name="test_type" value="2" <?php if($rows->test_type == 2){ echo"checked"; } ?>/> Free

												</div>

											</div>
                                            
                                            
                                            <div class="form-group testType" <?php if($rows->test_type == 2){ echo 'style="display:none"';} ?>>

												<label for="inputDefault" class="col-md-3 control-label">Price <font class="text_small"> *</font></label>

												<div class="col-md-3">

													<input type="text" class="txt_inputs form-control" name="test_price"  id="test_price" value="<?php echo $rows->test_price; ?>" onKeyPress="return decimalNumbersOnly(this, event)">

												</div>

											</div>
											<div class="form-group testType" <?php if($rows->test_type == 2){ echo 'style="display:none"';} ?>>

												<label for="inputDefault" class="col-md-3 control-label">Discount</label>
                                                
                                                <div class="col-md-2">
													<div class="input-group timepicker">
                                                    <input type="text" class="form-control" name="discount" placeholder="%" value="<?php echo $rows->discount; ?>" onKeyPress="return decimalNumbersOnly(this, event)">
                                                    <span class="input-group-addon">
                                                        %
                                                    </span>
                                                </div>
                                                    
												</div>

											</div>
                                            
                                            <div class="form-group">

												<label for="inputDefault" class="col-md-3 control-label">Tags</label>

												<div class="col-md-6">
													<select class="form-control" multiple="multiple" data-plugin-options='{ "maxHeight": 200, "includeSelectAllOption": true, "enableCaseInsensitiveFiltering": true }' data-plugin-multiselect id="tag_id" name="tag_id[]">
													<?php
													$sql = mysqli_query($con,"SELECT * FROM ".TBL_TAGS." WHERE cStatus='Y' ORDER BY `tags` ASC");
													while($res = mysqli_fetch_object($sql)){
														$selected = "";
														$strsql = "SELECT * FROM ".TBL_TEST_TAGS." WHERE test_id = ".$rows->intBookId." AND tags_id=".$res->tags_id."";
														if($cnf->records_fetch($strsql)==true) {
															$selected = "selected";
															$row = mysqli_fetch_object($cnf->query_execute($strsql));
															$previous_tag[] = $row->tags_id;
														}
													?>
													                                                    
                                                    <option value="<?php echo $res->tags_id; ?>" <?php echo $selected; ?>><?php echo $res->tags; ?></option>
													<?php
													}
												   ?>
                                                  
												</select>	
                                                
                                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">Add New Tag</button>

												</div>

											</div>
                                            
                                            
											<div class="form-group">

												<label for="inputDefault" class="col-md-3 control-label">Popular Test</label>

												<div class="col-md-6">

													<select name="popular_test" class="txt_inputs form-control">
														<option value="Y" <?php if($rows->popular_test == 'Y'){ echo "selected";} ?>>Yes</option>
														<option value="N" <?php if($rows->popular_test == 'N'){ echo "selected";} ?>>No</option>
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
													<input type="text" class="txt_inputs form-control" name="header_title" id="header_title" value="<?php echo $rows->header_title; ?>" />
													<div class="error1"></div>
												</div>
											</div>
                                            
                                            <div class="form-group">											
												<label for="inputDefault" class="col-md-3 control-label">Meta Description</label>
												<div class="col-md-6">
													
                                                    <textarea class="txt_inputs form-control" name="meta_desc" id="meta_desc" rows="3"><?php echo $rows->meta_desc; ?></textarea>
													<div class="error1"></div>
												</div>
											</div>
                                            
                                             <div class="form-group">											
												<label for="inputDefault" class="col-md-3 control-label">Meta keywords</label>
												<div class="col-md-6">
													<textarea class="txt_inputs form-control" name="meta_keywords" id="meta_keywords" rows="3" style="margin-top:10px;"><?php echo $rows->meta_keywords; ?></textarea>
													<div class="error1"></div>
												</div>
											</div>
                                            
											
											<div class="form-group">
												<label for="inputDefault" class="col-md-3 control-label">Status</label>
												<div class="col-md-1">
													<?php echo $cnf->statusBox($rows->cStatus);?>
												</div>
											</div>

                                            

											<div class="form-group">

                                                <label class="col-md-3 control-label"></label>

                                                <div class="col-sm-6">

                                                    <p class="m-none">

                                                        <input type="hidden" name="action" value="update" />

                                                         <input type="hidden" name="txtID" value="<?php echo $rows->test_id; ?>" />

                                                        <input type="submit" value="Update" class="mb-xs mt-xs mr-xs btn btn-md btn-primary" id="addSubmit">

                                                        <a href="
                                                        test.php" class="mb-xs mt-xs mr-xs btn btn-md btn-default">Cancel</a>

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
        

<?php include("includes/footer.php"); ?>