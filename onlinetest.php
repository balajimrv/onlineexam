<?php include('includes/test_header.php'); ?>

    <!-- Start Test Details 
    ============================================= -->
    <div class="course-details-area default-padding" style="min-height:450px;">
        <div class="container">
        	<div class="row">
            	<nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">TNPSC</a></li>
                    <li class="breadcrumb-item active" aria-current="page">TNPSC Group II</li>
                  </ol>
                </nav>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="course-details-info">
                        <!-- Star Top Info -->
                        <div class="top-info">
                            <!-- Title-->
                            <div class="title">
                                <h3>1). Lorem ipsum dolor sit amet consectetur adipiscing elit?</h3>
                            </div>
                            <!-- End Title-->
                           
                        </div>
                       
                       
                        <div class="info title answer">
                            <form class="form-horizontal">
                            	<table class="options" width="100%" cellspacing="0" cellpadding="0" border="0">
                                	<tr>
                                        <td width="96%" class="ans-option">
                                        <label>
                                        <input type="radio" name="answer" value="">
                                        <span class="ans-num">A)</span>  Vestibulum venenatis et
                                        </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="96%" class="ans-option">
                                        <label>
                                        <input type="radio" name="answer" value="">
                                        <span class="ans-num">B)</span>  Vestibulum venenatis et
                                        </label>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td width="96%" class="ans-option">
                                        <label>
                                        <input type="radio" name="answer" value="">
                                        <span class="ans-num">C)</span>  Vestibulum venenatis et
                                        </label>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td width="96%" class="ans-option">
                                        <label>
                                        <input type="radio" name="answer" value="">
                                        <span class="ans-num">D)</span>  Vestibulum venenatis et
                                        </label>
                                        </td>
                                    </tr>
                                    
                                    
                                </table>
                            </form>         
                        </div>
                            
                            <div class="clearfix"></div>     
                                    
                        <div style="margin-top:80px;" >
                        	<div class="pull-left">
                            	<a href="#" class="btn btn-info">Previous</a>
                            </div>
                            <div class="pull-right">
                            	<a href="#" class="btn btn-info">Next</a>
                            </div>
                        	
                        </div>            
                    </div>
                </div>
                <!-- Start Sidebar -->
                <div class="col-md-4">
                    <div class="sidebar" style="padding-left:0;">
                        <aside>
                        <table class="table table-bordered">
                        	<tr>
                           		<td class="text-center bg-info">
                                <i class="fas fa-clock"></i>
                                Time Left : <strong><span id="countdown"></span></strong>
                                </td>
                            </tr>
                        </table>
                          
                           <div id="pag_num" style="margin:0px;">
                            <div class="pagination text-center" style="margin:0;">
                                <ul>
                                <?php
								for($i=1; $i <= 50; $i++){
								?>
                                    <div class="ques_count">
                                    	<li qno="<?php echo $i; ?>" class="<?php if($i == 1){  echo 'active'; }?> ques_default"><?php echo $i; ?></li>
                                    </div>
                                <?php } ?>    
                                </ul>
                            </div>
          
  						</div>
                        
                        <div class="text-center" style="margin-top:20px;"><button class="btn btn-lg btn-primary">Submit Test</button></div>

                        </aside>
                    </div>
                </div>
                <!-- End Sidebar -->
            </div>
        </div>
    </div>
    <!-- End Course Details -->
<script type="text/javascript">
    
 
        var seconds =1800;
  
  
    //var seconds =1500;
    function secondPassed() 
    {
      seconds--;
      //document.getElementById('r_sec').value=seconds;
      //alert(seconds);
    var minutes = parseInt(seconds/60);
    //seconds = parseInt(seconds);
    var remainingSeconds = parseInt(seconds % 60);
    //alert(remainingSeconds);
    if (remainingSeconds < 10) {
      remainingSeconds = "0" + parseInt(remainingSeconds);  
    }
    //document.getElementById('r_sec1').value=seconds;
    document.getElementById('countdown').innerHTML = "00 h : "+ minutes + " m : " + remainingSeconds+ " s";
    if (parseInt(seconds) === 0) 
    {
      //alert(seconds);
       alert("Time is over");
         clearInterval(countdownTimer);
       document.getElementById('countdown').innerHTML = "Time is Over";
       //collectAnswers();
       //document.forms["myForm"].submit();
    
      } 
      
      }
    var countdownTimer = window.setInterval(function(){ 
    secondPassed();
    }, 999);
    
    
  </script>
  
  
   <?php include('includes/test_footer.php'); ?>