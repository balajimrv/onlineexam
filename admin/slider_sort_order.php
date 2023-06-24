<?php
require_once '../includes/db_functions.php';
$cnf = new DB_FUNCTINS();

$position = $_POST['position'];
$i=1;
foreach($position as $k=>$header_id){
	$fieldarray = array(
	    "intLinkOrder"=>$i
	);	
	$cnf->update(TBL_HEADER,$fieldarray,'header_id',$header_id);
		
	$i++;
}
?>
