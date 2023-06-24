<?php require_once("../includes/db_functions.php");
$cnf = new DB_FUNCTINS();

	if($_POST['action'] == "update_order"){
	
	$order_id = $_POST["order_id"];
	
	//print_r($_POST);
	
	@mysqli_query($con,"DELETE FROM ".TBL_ORDER_ITEM." WHERE intOrd_id=".$order_id."");
	
	for($i=0; $i<count($_POST['invoice_product']); $i++){
			$fieldarray = array(
				"intOrd_id"=>$order_id,
				"intPro_id"=>$_POST['invoice_product_id'][$i],
				"intItem_qty"=>$_POST['invoice_product_qty'][$i]
			);
		$cnf->insert(TBL_ORDER_ITEM,$fieldarray);
	}
	
	$fieldarray1 = array(	 
		"deOrd_shipping_cost"=>$_POST['invoice_shipping'],
		"deOrd_sub_total"=>$_POST['invoice_subtotal'],
		"deOrd_total"=>$_POST['invoice_total'],
  	);
	
	$cnf->update(TBL_ORDER,$fieldarray1,'intOrd_id',$order_id);
		
		$result = array('status' => "Success", 'message' => "");
}

$data = json_encode($result);
echo $data;
?>