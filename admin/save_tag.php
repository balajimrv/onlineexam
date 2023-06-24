<?php
require_once '../includes/db_functions.php';
$cnf = new DB_FUNCTINS();

$strQry = "SELECT * FROM ".TBL_TAGS." WHERE tags='".$_REQUEST['tagname']."'";

if($cnf->records_fetch($strQry)==true) {
	echo "exe";
}else{
	$fieldarray = array(
			"tags"=>addslashes($_REQUEST['tagname']),
			"cStatus"=>'Y'
		  );
	$tags_id = $cnf->insert(TBL_TAGS,$fieldarray);
	echo "<option value='".$tags_id."'>".$_REQUEST['tagname']."</option>";
}
?>
