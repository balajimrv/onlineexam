<?php require_once("includes/header.php"); 
if($_POST["hdProcess"]!="") {
	
	
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
			
			/*foreach($_REQUEST['mul_option'] as $mul_option){  
				  $answer.= $mul_option.",";  
			} */
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
					"dtCreated"=>$cnf->datetime_format(),
					"cStatus"=>$_REQUEST['txtstatus']
				  );
			$cnf->insert(TBL_QUESTIONS,$fieldarray);

			if($_REQUEST['action'] == "save"){
				header("Location:questions.php?act=added");
			}
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

						<h2>Add Questions</h2>

					

						<div class="right-wrapper pull-right">

							<ol class="breadcrumbs">

								<li>

									<a href="dashboard.php">

										<i class="fa fa-home"></i>

									</a>

								</li>

								<li><span><a href="questions.php">Manage Questions</a></span></li>

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

										<form action="addquestions.php" method="POST" enctype="multipart/form-data" class="form-horizontal form-bordered" name="frm" onSubmit="return valdateAdd(this)">


											<div class="form-group">

												<label for="inputDefault" class="col-md-3 control-label">Select Test <span class="req"> *</span></label>

												<div class="col-md-6">

													<select name="test_id" id="test_id" class="form-control">
                                                      <option value="">--Select--</option>
													  <?php echo $cnf->displaySelectBox($_POST["test_id"],TBL_TEST,"test_name","test_id")?>
                                                    </select>


												</div>

											</div>
                                            
                                            <div class="form-group" id="ques_type_txt">
												<label for="inputDefault" class="col-md-3 control-label"><strong>Question uploaded Count</strong></label>
												<div class="col-md-8">
                                               <?php
													$sql = @mysqli_query($con,"SELECT * FROM `".TBL_QUESTIONS."` WHERE test_id=3");
													$quescount =  @mysqli_num_rows($sql);
												?>
                                              
                                                <span class="badge"><h4>0</h4></span>
												</div>
											</div>

                                            <div class="form-group" id="ques_type_txt">

												<label for="inputDefault" class="col-md-3 control-label">Question <font class="text_small"> *</font></label>

												<div class="col-md-8">                                                                                    
                                                    <textarea class="summernote" name="question" data-plugin-summernote data-plugin-options='{ "height": 120, "codemirror": { "theme": "ambiance" } }'></textarea>
												</div>

											</div>
                                            
                                            <div class="form-group">

												<label for="inputDefault" class="col-md-3 control-label">Answer Type <font class="text_small"> *</font></label>

												<div class="col-md-4">

													<select name="answer_type" id="answer_type" class="form-control">
                                                      <option value="">--Select--</option>
													  <option value="SLQ">Single Choice</option>
                                                      <option value="MCQ">Multiple Choice</option>
                                                      <option value="INPUT">Input</option>
                                                    </select>

												</div>

											</div>
                                            
                                            <div id="single_choice" style="display:none;">

												<div class="form-group">

												<label for="inputDefault" class="col-md-3 control-label">Option 1</label>
                                                
                                                <div class="col-md-7">
													 <textarea class="summernote" name="s_option1" data-plugin-summernote data-plugin-options='{ "height": 50, "codemirror": { "theme": "ambiance" } }'></textarea>
												</div>

												<div class="col-md-1">
                                                	<input type="radio" name="option" value="1" />
                                               </div>     
                                                    

											</div>
                                            
                                            <div class="form-group">

												<label for="inputDefault" class="col-md-3 control-label">Option 2</label>
                                                
                                                <div class="col-md-7">
													 <textarea class="summernote" name="s_option2" data-plugin-summernote data-plugin-options='{ "height": 50, "codemirror": { "theme": "ambiance" } }'></textarea>
												</div>

												<div class="col-md-1">
                                                	<input type="radio" name="option" value="2" />
                                               </div>     
                                                    

											</div>
                                            
                                            <div class="form-group">

												<label for="inputDefault" class="col-md-3 control-label">Option 3</label>
                                                
                                                <div class="col-md-7">
													 <textarea class="summernote" name="s_option3" data-plugin-summernote data-plugin-options='{ "height": 50, "codemirror": { "theme": "ambiance" } }'></textarea>
												</div>

												<div class="col-md-1">
                                                	<input type="radio" name="option" value="3" />
                                               </div>     
                                                    

											</div>
                                            
                                            <div class="form-group">

												<label for="inputDefault" class="col-md-3 control-label">Option 4</label>
                                                
                                                <div class="col-md-7">
													 <textarea class="summernote" name="s_option4" data-plugin-summernote data-plugin-options='{ "height": 50, "codemirror": { "theme": "ambiance" } }'></textarea>
												</div>

												<div class="col-md-1">
                                                	<input type="radio" name="option" value="4" />
                                               </div>     
                                                    

											</div>
											
										</div>
                                        
                                        	<div id="multiple_choice" style="display:none;">

												<div class="form-group">

												<label for="inputDefault" class="col-md-3 control-label">Option 1</label>
                                                
                                                <div class="col-md-7">
													 <textarea class="summernote" name="m_option1" data-plugin-summernote data-plugin-options='{ "height": 50, "codemirror": { "theme": "ambiance" } }'></textarea>
												</div>

												<div class="col-md-1">
                                                	<input type="checkbox" name="mul_option[]" value="1" />
                                               </div>     
                                                    

											</div>
                                            
                                            <div class="form-group">

												<label for="inputDefault" class="col-md-3 control-label">Option 2</label>
                                                
                                                <div class="col-md-7">
													 <textarea class="summernote" name="m_option2" data-plugin-summernote data-plugin-options='{ "height": 50, "codemirror": { "theme": "ambiance" } }'></textarea>
												</div>

												<div class="col-md-1">
                                                	<input type="checkbox" name="mul_option[]" value="2" />
                                               </div>     
                                                    

											</div>
                                            
                                            <div class="form-group">

												<label for="inputDefault" class="col-md-3 control-label">Option 3</label>
                                                
                                                <div class="col-md-7">
													 <textarea class="summernote" name="m_option3" data-plugin-summernote data-plugin-options='{ "height": 50, "codemirror": { "theme": "ambiance" } }'></textarea>
												</div>

												<div class="col-md-1">
                                                	<input type="checkbox" name="mul_option[]" value="3" />
                                               </div>     
                                                    

											</div>
                                            
                                            <div class="form-group">

												<label for="inputDefault" class="col-md-3 control-label">Option 4</label>
                                                
                                                <div class="col-md-7">
													 <textarea class="summernote" name="m_option4" data-plugin-summernote data-plugin-options='{ "height": 50, "codemirror": { "theme": "ambiance" } }'></textarea>
												</div>

												<div class="col-md-1">
                                                	<input type="checkbox" name="mul_option[]" value="4" />
                                               </div>     
                                                    

											</div>
											
										</div>
                                        
											<div class="form-group" id="input_answer" style="display:none;">

												<label for="inputDefault" class="col-md-3 control-label">Input Answer</label>

												<div class="col-md-4">

													<input type="text" class="txt_inputs form-control" name="input_answer" value="">
												
												</div>

											</div>
                                            
                                            <div class="form-group">

												<label for="inputDefault" class="col-md-3 control-label">Mark</label>

												<div class="col-md-4">

													<input type="text" class="txt_inputs form-control" name="mark" value="" onKeyPress="return decimalNumbersOnly(this, event)">
												
												</div>

											</div>
                                            
                                            <div class="form-group">

												<label for="inputDefault" class="col-md-3 control-label">Hint</label>

												<div class="col-md-4">

													<input type="text" class="txt_inputs form-control" name="hint" value="">
												
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
                                            <button type="submit" name="action" value="save" class="mb-xs mt-xs mr-xs btn btn-md btn-primary">Save</button>
                                            <button type="submit" name="action" value="save_and_new" class="mb-xs mt-xs mr-xs btn btn-md btn-primary">Save &amp; New</button>

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