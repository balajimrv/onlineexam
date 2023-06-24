<?php
	include '../includes/db_functions.php';
	$cnf = new DB_FUNCTINS();
	
	if($_POST["id"] !="") {
		$strSql = "SELECT * FROM ".TBL_CATEGORY." WHERE intCat_id =".$_POST["id"]." ";
		
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
        <h4 class="modal-title" id="myModalLabel">Category Details</h4>
      </div>
      
      <div class="modal-body">
         
    
 
<div class="col-md-12 table-responsive">
			<?php
				if($flag){
           	?> 
         	<table class="table table-bordered table-striped table-condensed">
            	
               
               <?php
			   if($_POST["cat"] == "sec"){
			   ?>
               <tr>
            		<th width="92">Sub Secondary Category</th>
                    <td width="312">
					<?php 
					echo $rows->vCatName;
					?>
                     </td>
            	</tr>
               <tr>
            		<th width="92">Sub Category</th>
                    <td width="312">
					<?php 
					$strSqlCat = "select vCatName from ".TBL_CATEGORY." where intCat_id='".$rows->sub_sec_category."'";
					$resSqlCat = mysqli_query($con,$strSqlCat);
					$rowSqlCat = mysqli_fetch_object($resSqlCat);
					echo $rowSqlCat->vCatName;
					?>
                     </td>
            	</tr>
                
                <tr>
                        <th width="92">Main Category</th>
                        <td width="312">
                        <?php 
                        $strSqlCat = "select vCatName from ".TBL_MAIN_CATEGORY." where intSubCatId='".$rows->intSubCatId."'";
                        $resSqlCat = mysqli_query($con,$strSqlCat);
                        $rowSqlCat = mysqli_fetch_object($resSqlCat);
                        echo $rowSqlCat->vCatName;
                        ?>
                         </td>
                    </tr>
                <?php }else{ ?>
                	<tr>
                        <th width="92"> Sub Category   </th>
                        <td width="312">
                        <?php 
                        $strSqlCat1 = "select vCatName,intSubCatId from ".TBL_CATEGORY." where intCat_id='".$rows->intCat_id."'";
                        $resSqlCat1 = mysqli_query($con,$strSqlCat1);
                        $rowSqlCat1 = mysqli_fetch_object($resSqlCat1);
                        echo $rowSqlCat1->vCatName;
                        ?>
                         </td>
                    </tr>
                	<tr>
                        <th width="92">Main Category</th>
                        <td width="312">
                        <?php 
                        $strSqlCat = "select vCatName from ".TBL_MAIN_CATEGORY." where intCat_id='".$rows->intSubCatId."'";
                        $resSqlCat = mysqli_query($con,$strSqlCat);
                        $rowSqlCat = mysqli_fetch_object($resSqlCat);
                        echo $rowSqlCat->vCatName;
                        ?>
                         </td>
                    </tr>
                <?php } ?>
            	</tr>
                
                <tr>
            		<th>Category Image</th>
                    <td><img src="uploads/logo/<?php echo $rows->logo_image;?>" width="70px" height="90px"/></td>
            	</tr>
                
               
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
                    <td><?php echo $rows->pageTitle; ?></td>
            	</tr> 
                </tr><th>Meta description</th>
                    <td><?php echo $rows->metaDescription; ?></td>
            	</tr>
                </tr><th>Meta keywords</th>
                    <td><?php echo $rows->metaKeywords; ?></td>
            	</tr>
               
            </table>
            <?php }else{ ?>
            	<div class="alert alert-danger">
                  <strong>No Records Found!</strong>
                </div>
            <?php } ?>
     </div>
  </div>
  
  