<?php
	include '../includes/db_functions.php';
	$cnf = new DB_FUNCTINS();
	
	if($_REQUEST["id"] !="") {
		$strSql = "SELECT * FROM ".TBL_TEST." WHERE test_id =".$_POST["id"]." ";
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
        <h4 class="modal-title" id="myModalLabel">Test Details</h4>
      </div>
      
      <div class="modal-body">
         
    
 
<div class="col-md-12 table-responsive">
			<?php
				if($flag){
           	?> 
         	<table class="table table-bordered table-striped table-condensed">
            	<tr>
            		<th width="92"> Category   </th>
                    <td width="312">
					<?php 
					$strSqlCat1 = "select vCatName,intSubCatId from ".TBL_CATEGORY." where intCat_id='".$rows->intSubCatId."'";
					$resSqlCat1 = mysqli_query($con,$strSqlCat1);
					$rowSqlCat1 = mysqli_fetch_object($resSqlCat1);
					echo $rowSqlCat1->vCatName;
					?>
                     </td>
            	</tr>
               
            	</tr>
                
                <tr>
            		<th>Test Name</th>
                    <td><?php echo $rows->test_name;?></td>
            	</tr>
                <tr>
            		<th>Total Question</th>
                    <td><?php echo $rows->total_questions;?> </td>
            	</tr>
                <tr>
                <th>Test Time</th>
                    <td><?php echo $rows->test_time;?></td>
            	</tr>
                <th>Instructions</th>
                    <td><?php echo $rows->instructions;?></td>
            	</tr>
                
                <th>Type</th>
                    <td><?php if($rows->test_type == 1){ echo "Paid";}else{ echo "Free"; }?></td>
            	</tr>
                
                <tr>
                <th>Price</th>
                    <td> <?php echo 'Rs. '.$rows->test_price; ?> </td>
            	</tr>
                <tr>
               	<th>Discount</th>
                    <td><?php echo $rows->discount.' %'; ?></td>
            	</tr>
                <tr>
                <th>Rating</th>
                    <td><?php echo $rows->rating; ?></td>
            	</tr>
                <tr>
               
                <th>Popular Test</th>
                    <td><?php echo $cnf->showStatus($rows->popular_test)?></td>
            	</tr> 
                <tr>
               
                <tr>
                <th>Status</th>
                    <td><?php echo $cnf->showStatus($rows->cStatus)?></td>
            	</tr>
                <tr>
                <th>Created Date</th>
                    <td> <?php if($rows->dtCreated !='0000-00-00 00:00:00'){ echo $cnf->convetdate($rows->dtCreated); }else{ echo"N/A"; }?>  </td>
            	</tr>
               
                
                 <tr class="text-center">
                    <td colspan="2"><h3>Meta Tags</h3></td>
                 </tr>
                		  
                 <tr><th>Header Title</th>
                    <td><?php echo $rows->header_title; ?></td>
            	</tr> 
                </tr><th>Meta description</th>
                    <td><?php echo $rows->meta_desc; ?></td>
            	</tr>
                </tr><th>Meta keywords</th>
                    <td><?php echo $rows->meta_keywords; ?></td>
            	</tr>
               
            </table>
            <?php }else{ ?>
            	<div class="alert alert-danger">
                  <strong>No Records Found!</strong>
                </div>
            <?php } ?>
     </div>
  </div>
  
  