<?php
	include '../includes/db_functions.php';
	$cnf = new DB_FUNCTINS();
	
	if($_REQUEST["id"] !="") {
		$strSqls = "SELECT a.*,b.* from ".TBL_ORDER_ITEM." as a inner join ".TBL_BOOKS." as b on a.intPro_id=b.intBookId where a.intOrd_id=".$_POST["id"];
		$strSqlOrder = "SELECT * from ".TBL_ORDER." where intOrd_id=".$_POST["id"]." ";		
		if($cnf->records_fetch($strSqlOrder)==true) {	
			$rows_Order = mysqli_fetch_object($cnf->query_execute($strSqlOrder));
			$flag = true;
		}else{
			$flag = false;
		}
	}else{
		$flag = false;
	}
?>

<style>strong{ color:#C60; }</style>

    <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Order Details</h4>
          </div>
      
      <div class="modal-body">
         
    
 
<div class="col-md-12 table-responsive">
			<?php
				if($flag){
           	?> 
       <table class="table table-bordered table-striped table-condensed" style="width:100%">  
		<tr>
            
            <td colspan="2"><strong>Customer Details</strong></td>
          </tr>
          <tr>
            
            <td width="26%">Name : </td>
            <td width="74%"><?php echo $rows_Order->vbill_first_name.' '.$rows_Order->vbill_last_name;  ?></td>
          </tr>
          <tr>
            
            <td>Email :</td>
            <td><?php if($rows_Order->vbill_Email !=""){ echo $rows_Order->vbill_Email; }else{ echo"N/A"; }?></td>
          </tr>
		  
          <tr>
            
            <td>Address : </td>
            <td><?php if($rows_Order->vbill_address!=""){ echo nl2br($rows_Order->vbill_address); }else{ echo"N/A"; }?></td>
          </tr>
		   <tr>
            
            <td>City : </td>
            <td><?php echo $rows_Order->vbill_city; ?></td>
          </tr>
		  
		  <tr>
            
            <td>State : </td>
            <td>
			<?php echo $rows_Order->vbill_state; ?></td>
          </tr>
		  
          <tr>
            
            <td>Country : </td>
            <td>India</td>
          </tr>
         
          <tr>
            
            <td>Zipcode : </td>
            <td><?php echo $rows_Order->vbill_postal_code; ?> </td>
          </tr>
          <tr>
            
            <td>Phone : </td>
            <td><?php  echo $rows_Order->vbill_Phone;  ?></td>
          </tr>
          
          <tr>
            
            <td>Order Date : </td>
            <td><?php echo $rows_Order->dtOrd_date; ?></td>
          </tr>
          <tr>
            
            <td>Payment Date :</td>
            <td><?php if($rows_Order->dtOrd_last_update != '0000-00-00 00:00:00'){ echo $rows_Order->dtOrd_last_update; } else { echo 'N/A'; } ?></td> 
          </tr>
          <tr>
		  
            <td colspan="2"><strong>Orders List</strong></td>
          </tr>
		  <tr>
            
            <td colspan="2"q>
			<table width="647" border="1" cellpadding="0" cellspacing="0" class="table table-bordered table-condensed">
			  <tr>
				<th width="245" height="28">Book Name</th>
				<th width="66">Language</th>
				<th width="165">Category</th>
				<th width="58">Quantity</th>
				<th width="101">Price</th>
			  </tr>
				<?php 			
				if($cnf->records_fetch($strSqls)==true) {
				$res= $cnf->query_execute($strSqls);
				while($rows2 = mysqli_fetch_object($res)){
				if($rows2->intDiscount == 0){
					$pro_price = $rows2->deBookPrice;
					$Offer="";
				}else{
					$pro_price = $cnf->calculate_discount($rows2->deBookPrice, $rows2->intDiscount);
					$Offer = "Offer ";
				}
				
				$sqlQryCate = "SELECT vCatName,intSubCatId FROM `".TBL_CATEGORY."` WHERE intCat_id = ".$rows2->intCat_id." LIMIT 1";
				$resQryCate = mysqli_query($con,$sqlQryCate);
				$rowQryCate = mysqli_fetch_object($resQryCate);
							
				?>			  
			  <tr>
				<td><?php echo $rows2->vBookName; ?></td>
				<td><?php echo $rows2->book_language; ?></td>
				<td><?php echo $rowQryCate->vCatName; ?></td>
				<td><?php echo $rows2->intItem_qty; ?></td>
				<td><?php echo 'Rs. '.$rows2->intItem_qty * $pro_price; ?></td>
			  </tr>
<?php } }else{
	echo "<tr><td colspan='3' height='20'> Product details not found.</td></tr>";
} ?>			  
			</table>
			</td>
          </tr>
		  <tr>
            
            <td>Status : </td>
            <td><?php echo $rows_Order->numOrd_status; ?></td>
          </tr>
          
           <tr>
            
            <td>Payment Mode : </td>
            <td><?php echo $rows_Order->payment_type; ?></td>
          </tr>
          
		  <tr>
            
            <td>Order Number : </td>
            <td><?php echo $rows_Order->vOrder_number; ?></td>
          </tr>
		   
		   <tr>
            
            <td>Sub Total : </td>
            <td>Rs. <?php echo $rows_Order->deOrd_sub_total; ?></td>
          </tr>
		  
		  <tr>
            
            <td>Shipping Charges : </td>
            <td>Rs. <?php echo $rows_Order->deOrd_shipping_cost; ?></td>
          </tr>
          <?php
		  if($rows_Order->payment_type == "COD"){ 
		  ?>
		  <tr>
            
            <td>COD Charges : </td>
            <td>Rs. <?php echo $rows_Order->deOrd_cod_cost; ?></td>
          </tr>
         <?php } ?>
		   <tr>
            
            <td>Total : </td>
            <td>Rs. <?php echo $rows_Order->deOrd_total; ?></td>
          </tr>
          
         <?php
		if($rows_Order->couriern_no != ""){
		?>  
          
          <tr>
            
            <td colspan="2"><strong>Dispatche Details</strong></td>
          </tr>
        
          
          <tr>
            
            <td width="26%">Dispatched Datee : </td>
            <td width="74%"><?php echo $rows_Order->dispatched_date; ?></td>
          </tr>
          
           <tr>
            
            <td width="26%">Courier Name : </td>
            <td width="74%"><?php echo $rows_Order->courier_name; ?></td>
          </tr>
          
          <tr>
            
            <td width="26%">Courier Number : </td>
            <td width="74%"><?php echo $rows_Order->couriern_no; ?></td>
          </tr>
          
        <?php } ?>
        
        <?php
		if($rows_Order->cancel_status == "Y"){
		?>  
          
          <tr>
            
            <td colspan="2"><strong>Cancel Option</strong></td>
          </tr>
          <tr>
            
            <td width="26%">Cancel : </td>
            <td width="74%">Yes</td>
          </tr>
          
          <tr>
            
            <td width="26%">Cancel Date : </td>
            <td width="74%"><?php echo $rows_Order->cancel_date; ?></td>
          </tr>
          
           <tr>
            
            <td width="26%">Cancel Note : </td>
            <td width="74%"><?php echo $rows_Order->cancel_note; ?></td>
          </tr>
          
        <?php } ?>
          
        </table>  
            <?php }else{ ?>
            	<div class="alert alert-danger">
                  <strong>No Records Found!</strong>
                </div>
            <?php } ?>
     </div>
  </div>