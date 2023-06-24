<?php
	include '../includes/db_functions.php';
	$cnf = new DB_FUNCTINS();
	
	if($_REQUEST["id"] !="") {
		$strSql = "SELECT * FROM ".TBL_USERS." WHERE user_id=".$_POST['id']."";
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
        <h4 class="modal-title" id="myModalLabel">User Details</h4>
      </div>
      
      <div class="modal-body">
         
    
 
<div class="col-md-12 table-responsive">
			<?php
				if($flag){
           	?> 
         	<table class="table table-bordered table-striped table-condensed">
            	
              
                <tr>

                    <td width="30%">First Name</td>

                    <td width="70%"><?php echo $rows->first_name; ?></td>

                </tr>
                
                <tr>

                    <td width="30%">Last Name</td>

                    <td width="70%"><?php echo $rows->last_name; ?></td>

                </tr>

                 <tr>

                    <td width="30%">Email</td>

                    <td width="70%"><?php echo $rows->email; ?></td>

                </tr>

                 <tr>

                    <td width="30%">Phone</td>

                    <td width="70%"><?php echo $rows->phone; ?></td>

                </tr>

                
                 <tr>

                    <td width="30%">Address</td>

                    <td width="70%"><?php if($rows->address!=""){ echo nl2br($rows->address); }else{ echo"N/A"; }?></td>

                </tr>

                
                <tr>

                    <td width="30%">City</td>

                    <td width="70%"><?php echo $rows->city; ?></td>

                </tr>

                
                <tr>

                    <td width="30%">State</td>

                    <td width="70%"><?php echo $rows->state; ?></td>

                </tr>

                
                <tr>

                    <td width="30%">Zip</td>

                    <td width="70%"><?php echo $rows->zip; ?></td>

                </tr>

                <tr>

                    <td width="30%">Status</td>

                    <td width="70%"><?php echo $cnf->showStatus($rows->cStatus); ?></td>

                </tr>
                
                <tr>

                    <td width="30%">Email Status</td>

                    <td width="70%"><?php echo $cnf->showStatus($rows->emailStatus); ?></td>

                </tr>

                <tr>

                    <td width="30%">Created Date</td>

                    <td width="70%"><?php if($rows->dtCreated !='0000-00-00 00:00:00'){ echo $cnf->convetdate($rows->dtCreated); }else{ echo"N/A"; }?></td>

                </tr>
               
            </table>
            <?php }else{ ?>
            	<div class="alert alert-danger">
                  <strong>No Records Found!</strong>
                </div>
            <?php } ?>
     </div>
  </div>