<?php
	include '../includes/db_functions.php';
	$cnf = new DB_FUNCTINS();
	
	if($_REQUEST["id"] !="") {
		$strSql = "SELECT a.*,b.test_id, b.test_name from ".TBL_QUESTIONS." as a inner join ".TBL_TEST." as b on a.test_id=b.test_id WHERE question_id=".$_POST["id"]."";	  
		if($cnf->records_fetch($strSql)==true) {	
			$rows = mysqli_fetch_object($cnf->query_execute($strSql));
			$flag = true;
		}else{
			$flag = false;
		}
	}else{
		$flag = false;
	}
?>

<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Question Details</h4>
      </div>
      
      <div class="modal-body">
         
    
 
<div class="col-md-12 table-responsive">
			<?php
				if($flag){
           	?> 
         	<table class="table table-bordered table-striped table-condensed">
            	
            	</tr>
                
                <tr>
            		<th>Test Name</th>
                    <td><?php echo $rows->test_name;?></td>
            	</tr>
                <tr>
            		<th>Question</th>
                    <td><?php echo $rows->question;?> </td>
            	</tr>
                <tr>
                
                
                <th>Answer Type</th>
                    <td>
					<?php 
					if($rows->answer_type == "SLQ"){
						echo "Single Choice";
					}else if($rows->answer_type == "MCQ"){
						echo "Multiple Choice";
					}else if($rows->answer_type == "INPUT"){
						echo "Input";
					}
			
					?>
                    </td>
            	</tr>
                
                <?php
				if($rows->answer_type !="INPUT"){
				?>
                <th>option1</th>
                    <td><?php echo $rows->option1;?></td>
            	</tr>
                <tr>
                 <th>option2</th>
                    <td><?php echo $rows->option2;?></td>
            	</tr>
                <tr>
                 <th>option3</th>
                    <td><?php echo $rows->option3;?></td>
            	</tr>
                <tr>
                 <th>option4</th>
                    <td><?php echo $rows->option4;?></td>
            	</tr>
                
                <?php } ?>
                
                <tr>
                 <th>answer</th>
                    <td><?php echo $rows->answer;?></td>
            	</tr>
                <tr>
                
                 <th>Mark</th>
                    <td><?php echo $rows->mark;?></td>
            	</tr>
                <tr>
                 <th>Hint</th>
                    <td><?php echo $rows->hint;?></td>
            	</tr>
                
                
                <tr>
                <th>Status</th>
                    <td><?php echo $cnf->showStatus($rows->cStatus)?></td>
            	</tr>
                <tr>
                <th>Created Date</th>
                    <td> <?php if($rows->dtCreated !='0000-00-00 00:00:00'){ echo $cnf->convetdate($rows->dtCreated); }else{ echo"N/A"; }?>  </td>
            	</tr>
               
                
                
               
            </table>
            <?php }else{ ?>
            	<div class="alert alert-danger">
                  <strong>No Records Found!</strong>
                </div>
            <?php } ?>
     </div>
  </div>
  
  