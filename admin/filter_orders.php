<?php 
require_once("../includes/db_functions.php");
$cnf = new DB_FUNCTINS();

$start_date = str_replace('/', '-', $_POST['start_date']);
$end_date = str_replace('/', '-', $_POST['end_date']);

//get records from database
	$strQry = "SELECT * FROM ".TBL_ORDER." WHERE ((numOrd_status='Completed') OR (numOrd_status='New' AND payment_type='COD' AND otp_veryfied='Y')) AND  `dtOrd_date` >= '".date('Y-m-d', strtotime($start_date))." 00:00:00' AND `dtOrd_date` <= '".date('Y-m-d', strtotime($end_date))." 24:60:60' ORDER BY `dtOrd_date` ASC";
	
	$query = mysqli_query($con,$strQry);
	$num_rows = mysqli_num_rows($query);
	
	if($num_rows > 0){
		$delimiter = ",";
		$filename = "orders_" . date('Y-m-d') . ".csv";
		
		//create a file pointer
		$f = fopen('php://memory', 'w');
		
		//set column headers
		$fields = array(
			'Order Number', 
			'Name', 
			'Order Date',
			'Mode',
			'Total Amount',
			'Shipping Cost',
			'COD Cost',
			'Status',
			'Shipment send',
			'Address',
			'City',
			'State',
			'pincode',
			'Phone',			
			'Email',
			'Payment Date',
			'Cancel Date',
			'Cancel Note',
			'Dispatched Date',
			'Courier Name',
			'Couriern No'
		);
		fputcsv($f, $fields, $delimiter);
		
		//output each row of the data, format line as csv and write to file pointer
		while($row = mysqli_fetch_assoc($query)){
			
			$strSqlCat = "select vCatName from ".TBL_CATEGORY." where intCat_id='".$row['intSubCatId']."'";
			$resCat = mysqli_query($con,$strSqlCat);
			$rowCat = mysqli_fetch_array($resCat);
			if($rowCat['vCatName'] != ""){
				$catName = $rowCat['vCatName'];
			}else{
				$catName = "N/A";
			}
					
			$lineData = array(				
				$row['vOrder_number'],
				$row['vbill_first_name'].' '.$row['vbill_last_name'],
				$row['dtOrd_date'],
				$row['payment_type'],
				'Rs.'.$row['deOrd_total'],
				'Rs.'.$row['deOrd_shipping_cost'],
				'Rs.'.$row['deOrd_cod_cost'],
				$row['numOrd_status'],
				$row['email_sent'],
				$row['vbill_address'],
				$row['vbill_city'],
				$row['vbill_state'],
				$row['vbill_postal_code'],
				$row['vbill_Phone'],
				$row['vbill_Email'],
				$row['dtOrd_last_update'],
				$row['cancel_date'],
				$row['cancel_note'],
				$row['dispatched_date'],
				$row['courier_name'],
				$row['couriern_no']
			);
			fputcsv($f, $lineData, $delimiter);
		}
		
		//move back to beginning of file
		fseek($f, 0);
		
		//set headers to download file rather than displayed
		header('Content-Type: text/csv');
		header('Content-Disposition: attachment; filename="' . $filename . '";');
		
		//output all remaining data on a file pointer
		fpassthru($f);
	}
	exit;

?>