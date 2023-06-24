<?php 
include("includes/header.php");

	if($_REQUEST["id"]!="") {

		$strSql = "SELECT * FROM ".TBL_QUESTIONS." WHERE question_id =".$_GET["id"]." ";

		if($cnf->records_fetch($strSql)==true) {

			$rows = mysqli_fetch_object($cnf->query_execute($strSql));

		}else{

			header("Location:questions.php?act=invalid");

		}

	}else{

		header("Location:questions.php?act=invalid");

	}

	

	if($_POST["action"]=="update") {

		$answer="";
		if($_REQUEST['answer_type'] == "SLQ"){
			$answer=$_REQUEST['option'];
			$option1 = $_REQUEST['s_option1'];
			$option2 = $_REQUEST['s_option2'];
			$option3 = $_REQUEST['s_option3'];
			$option4 = $_REQUEST['s_option4'];
		}elseif($_REQUEST['answer_type'] == "MCQ"){
			$option1 = $_REQUEST['m_option1'];
			$option2 = $_REQUEST['m_option2'];
			$option3 = $_REQUEST['m_option3'];
			$option4 = $_REQUEST['m_option4'];
			
			$answer.= join(",",$_REQUEST['mul_option']);  
		}elseif($_REQUEST['answer_type'] == "INPUT"){
			$answer=$_REQUEST['input_answer'];
		}
		
		
		$fieldarray = array(		
			"test_id"=>$_REQUEST['test_id'],
					"question"=>$_REQUEST['question'],
					"answer_type"=>$_REQUEST['answer_type'],
					"option1"=>$option1,
					"option2"=>$option2,
					"option3"=>$option3,
					"option4"=>$option4,
					"answer"=>$answer,
					"question"=>$_REQUEST['question'],
					"mark"=>$_REQUEST['mark'],
					"hint"=>$_REQUEST['hint'],
					"cStatus"=>$_REQUEST['txtstatus']
		  );

		$cnf->update(TBL_QUESTIONS,$fieldarray,'question_id',$_POST["txtID"]);

		header("Location:questions.php?act=updated");	

	}

?>


<link rel="stylesheet" href="assets/vendor/summernote/summernote.css" />
<script type="text/javascript">	

	function valdateAdd(frm){

		var result = true;
		if(result) result = validateCombo(frm.test_id, 'Please select test');
		if(result) result = validateRequired(frm.question, 'Please enter question');
		if(result) result = validateCombo(frm.answer_type, 'Please select answer type');
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

						<h2>Edit Category</h2>

					

						<div class="right-wrapper pull-right">

							<ol class="breadcrumbs">

								<li>

									<a href="dashboard.php">

										<i class="fa fa-home"></i>

									</a>

								</li>

								<!--<li><span><a href="questions.php">Manage Category</a></span></li>-->

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

												<label for="inputDefault" class="col-md-3 control-label">Select Test <span class="req"> *</span></label>

												<div class="col-md-6">

													<select name="test_id" id="test_id" class="form-control">
                                                      <option value="">--Select--</option>
													  <?php echo $cnf->displaySelectBox($rows->test_id,TBL_TEST,"test_name","test_id")?>
                                                    </select>


												</div>

											</div>

                                            <div class="form-group" id="ques_type_txt">

												<label for="inputDefault" class="col-md-3 control-label">Question <font class="text_small"> *</font></label>

												<div class="col-md-8">                                                                                    
                                                    <textarea class="summernote" name="question" data-plugin-summernote data-plugin-options='{ "height": 120, "codemirror": { "theme": "ambiance" } }'><?php echo $rows->question; ?></textarea>
												</div>

											</div>
                                            
                                            <div class="form-group">

												<label for="inputDefault" class="col-md-3 control-label">Answer Type <font class="text_small"> *</font></label>

												<div class="col-md-4">

													<select name="answer_type" id="answer_type" class="form-control">
                                                      <option value="">--Select--</option>
													  <option value="SLQ" <?php if($rows->answer_type == "SLQ"){ echo "selected"; }?>>Single Choice</option>
                                                      <option value="MCQ" <?php if($rows->answer_type == "MCQ"){ echo "selected"; }?>>Multiple Choice</option>
                                                      <option value="INPUT" <?php if($rows->answer_type == "INPUT"){ echo "selected"; }?>>Input</option>
                                                    </select>

												</div>

											</div>
                                            
                                            <div id="single_choice" <?php if($rows->answer_type == "SLQ"){ echo 'style="display:block;"';}else{ echo 'style="display:none;"'; }?>>

												<div class="form-group">

												<label for="inputDefault" class="col-md-3 control-label">Option 1</label>
                                                
                                                <div class="col-md-7">
													 <textarea class="summernote" name="s_option1" data-plugin-summernote data-plugin-options='{ "height": 50, "codemirror": { "theme": "ambiance" } }'><?php echo $rows->option1; ?></textarea>
												</div>

												<div class="col-md-1">
                                                	<input type="radio" name="option" value="1" <?php if($rows->answer == 1){ echo "checked"; } ?> />
                                               </div>     
                                                    

											</div>
                                            
                                            <div class="form-group">

												<label for="inputDefault" class="col-md-3 control-label">Option 2</label>
                                                
                                                <div class="col-md-7">
													 <textarea class="summernote" name="s_option2" data-plugin-summernote data-plugin-options='{ "height": 50, "codemirror": { "theme": "ambiance" } }'><?php echo $rows->option2; ?></textarea>
												</div>

												<div class="col-md-1">
                                                	<input type="radio" name="option" value="2" <?php if($rows->answer == 2){ echo "checked"; } ?>/>
                                               </div>     
                                                    

											</div>
                                            
                                            <div class="form-group">

												<label for="inputDefault" class="col-md-3 control-label">Option 3</label>
                                                
                                                <div class="col-md-7">
													 <textarea class="summernote" name="s_option3" data-plugin-summernote data-plugin-options='{ "height": 50, "codemirror": { "theme": "ambiance" } }'><?php echo $rows->option3; ?></textarea>
												</div>

												<div class="col-md-1">
                                                	<input type="radio" name="option" value="3" <?php if($rows->answer == 3){ echo "checked"; } ?>/>
                                               </div>     
                                                    

											</div>
                                            
                                            <div class="form-group">

												<label for="inputDefault" class="col-md-3 control-label">Option 4</label>
                                                
                                                <div class="col-md-7">
													 <textarea class="summernote" name="s_option4" data-plugin-summernote data-plugin-options='{ "height": 50, "codemirror": { "theme": "ambiance" } }'><?php echo $rows->option4; ?></textarea>
												</div>

												<div class="col-md-1">
                                                	<input type="radio" name="option" value="4" <?php if($rows->answer == 4){ echo "checked"; } ?>/>
                                               </div>     
                                                    

											</div>
											
										</div>
                                        
                                        	<div id="multiple_choice" <?php if($rows->answer_type == "MCQ"){ echo 'style="display:block;"';}else{ echo 'style="display:none;"'; }?>>
                                            
                                            	<?php
												$array_answer = explode(',',$rows->answer);
												?>

												<div class="form-group">

												<label for="inputDefault" class="col-md-3 control-label">Option 1</label>
                                                
                                                <div class="col-md-7">
													 <textarea class="summernote" name="m_option1" data-plugin-summernote data-plugin-options='{ "height": 50, "codemirror": { "theme": "ambiance" } }'><?php echo $rows->option1; ?></textarea>
												</div>

												<div class="col-md-1">
                                                	<input type="checkbox" name="mul_option[]" value="1" <?php if(in_array(1, $array_answer)){ echo "checked"; } ?>/>
                                               </div>     
                                                    

											</div>
                                            
                                            <div class="form-group">

												<label for="inputDefault" class="col-md-3 control-label">Option 2</label>
                                                
                                                <div class="col-md-7">
													 <textarea class="summernote" name="m_option2" data-plugin-summernote data-plugin-options='{ "height": 50, "codemirror": { "theme": "ambiance" } }'><?php echo $rows->option2; ?></textarea>
												</div>

												<div class="col-md-1">
                                                	<input type="checkbox" name="mul_option[]" value="2" <?php if(in_array(2, $array_answer)){ echo "checked"; } ?>/>
                                               </div>     
                                                    

											</div>
                                            
                                            <div class="form-group">

												<label for="inputDefault" class="col-md-3 control-label">Option 3</label>
                                                
                                                <div class="col-md-7">
													 <textarea class="summernote" name="m_option3" data-plugin-summernote data-plugin-options='{ "height": 50, "codemirror": { "theme": "ambiance" } }'><?php echo $rows->option3; ?></textarea>
												</div>

												<div class="col-md-1">
                                                	<input type="checkbox" name="mul_option[]" value="3" <?php if(in_array(3, $array_answer)){ echo "checked"; } ?>/>
                                               </div>     
                                                    

											</div>
                                            
                                            <div class="form-group">

												<label for="inputDefault" class="col-md-3 control-label">Option 4</label>
                                                
                                                <div class="col-md-7">
													 <textarea class="summernote" name="m_option4" data-plugin-summernote data-plugin-options='{ "height": 50, "codemirror": { "theme": "ambiance" } }'><?php echo $rows->option4; ?></textarea>
												</div>

												<div class="col-md-1">
                                                	<input type="checkbox" name="mul_option[]" value="4" <?php if(in_array(4, $array_answer)){ echo "checked"; } ?>/>
                                               </div>     
                                                    

											</div>
											
										</div>
                                        
											<div class="form-group" id="input_answer" <?php if($rows->answer_type == "INPUT"){ echo 'style="display:block;"';}else{ echo 'style="display:none;"'; }?>>

												<label for="inputDefault" class="col-md-3 control-label">Input Answer</label>

												<div class="col-md-4">

													<input type="text" class="txt_inputs form-control" name="input_answer" value="<?php echo $rows->answer; ?>">
												
												</div>

											</div>
                                            
                                            <div class="form-group">

												<label for="inputDefault" class="col-md-3 control-label">Mark</label>

												<div class="col-md-4">

													<input type="text" class="txt_inputs form-control" name="mark" value="<?php echo $rows->mark; ?>" onKeyPress="return decimalNumbersOnly(this, event)">
												
												</div>

											</div>
                                            
                                            <div class="form-group">

												<label for="inputDefault" class="col-md-3 control-label">Hint</label>

												<div class="col-md-4">

													<input type="text" class="txt_inputs form-control" name="hint" value="<?php echo $rows->hint; ?>">
												
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

                                                         <input type="hidden" name="txtID" value="<?php echo $rows->question_id; ?>" />

                                                        <input type="submit" value="Update" class="mb-xs mt-xs mr-xs btn btn-md btn-primary" id="addSubmit">

                                                        <a href="questions.php" class="mb-xs mt-xs mr-xs btn btn-md btn-default">Cancel</a>

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