<?php
ob_start();
@session_start();
error_reporting(E_ERROR | E_WARNING | E_PARSE);
set_time_limit(500);
ini_set("max_execution_time",300);
ini_set('memory_limit', '-1');
date_default_timezone_set('Asia/Kolkata');

$_SESSION['session_id'] = session_id();
define("siteTitle","Sakthi - Online Exam");
define("adminTitle","Sakthi Online Exam :: Admin Panel");
define("INCRE",'100');
define("LIST_PRTPAGE",'5');

define("SITE_URL",'http://localhost/onlineexam/');
//define("SITE_URL",'https://www.sakthibooks.com/');

//Database Tables
$prefix = "onlinetest_";
define("TBL_ADMIN", $prefix."admin");
define("TBL_ADMIN_SETTING", $prefix."admin_setting");
define("TBL_MAIN_CATEGORY", $prefix."main_category");
define("TBL_CATEGORY", $prefix."category");
define("TBL_USERS", $prefix."users");
define("TBL_HEADER", $prefix."header");
define("TBL_TEST", $prefix."test");
define("TBL_TEST_TYPE", $prefix."test_type");
define("TBL_QUESTIONS", $prefix."questions");
define("TBL_ANSWER_TYPE", $prefix."answer_type");
define("TBL_RESULT", $prefix."result");
define("TBL_CERTIFICATE", $prefix."certificate");
define("TBL_PAGES", $prefix."pages");
define("TBL_LOGIN_AUDIT", $prefix."login_audit");
define("TBL_TAGS", $prefix."tags");
define("TBL_TEST_TAGS", $prefix."test_tags");

class DB_FUNCTINS {
	
    private $db;
    function __construct() {
        require_once 'db_connect.php';
        $this->db = new DB_CONNECT();
        $this->db->connect();
    }

    // destructor

    function __destruct() {
    }		

	function curPageName($pagename, $panel) {
		
		$curpage = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
		
		if($panel == "home"){
			if($curpage == $pagename){
				$classname = 'class="active"'; 
			}else{
				$classname = '';
			}
			return $classname;
		}else{
			return $curpage;
		}
	}
	
	
	

	function adminLogin($username,$password) {
		 global $con;
		 $sql = "SELECT * FROM ".TBL_ADMIN." WHERE vUsername='".$username."' AND vPassword='".md5($password)."' AND cStatus='Y'";
			
		$results = mysqli_query($con,$sql);
		if($rows=@mysqli_fetch_object($results)) {
			session_start();
			$_SESSION["vUsername"] = $rows->vUsername;
			$_SESSION["adminUserType"] = $rows->userType;
			$_SESSION["intAdminId"] = $rows->intAdminId;			
			
			$_SESSION['act_products'] = $rows->act_products;
			$_SESSION['act_orders'] = $rows->act_orders;
			$_SESSION['act_static_pages'] = $rows->act_static_pages;
			$_SESSION['act_users'] = $rows->act_users;
			
			mysqli_query($con,"UPDATE `".TBL_ADMIN."` SET `lastLogin` = '".$this->datetime_format()."' WHERE `intAdminId` = ".$rows->intAdminId."");
			if($rows->userType == 1){
				header("Location:dashboard.php");
			}else{
				header("Location:home.php");
			}
		} else {
			header("Location:index.php?act=invalid");
		}
	}


	function userLogin($username,$password,$page_source) {
		global $con;
		$sql = "SELECT 	user_id,member_id,member_type,name,email,phone,cStatus,emailStatus FROM ".TBL_USER." WHERE (email='".trim($username)."' OR member_id='".trim($username)."') AND password='".md5(trim($password))."'";
		$results = mysqli_query($con,$sql);
		if($rows=@mysqli_fetch_object($results)){
			if($rows->member_type == "member"){
				if($rows->emailStatus == 'Y'){
					if($rows->cStatus == 'N'){
						header("Location:login.php?page=".$page_source."&act=deactive");
					}else if($rows->cStatus == 'Y') {
						$_SESSION['user_id'] = $rows->user_id;					
						$_SESSION['member_id'] = $rows->member_id;
						$_SESSION['name'] = $rows->name;
						$_SESSION['email'] = $rows->email;
						$_SESSION['phone'] = $rows->phone;
						$fieldarray = array(
							"user_id"=>$rows->user_id,
							"login"=>$this->datetime_format()
						  );
						$login_id = $this->insert(TBL_LOGIN_AUDIT,$fieldarray);
						$_SESSION['login_id'] = $login_id;						
						header("Location:welcome.php");
					}
				}else{
					header("Location:login.php?act=eact");
				}
			}else if($rows->member_type == "non-member"){
				header("Location:login.php?act=error");
			}
		}else{ header("Location:login.php?act=invalied"); }
	}

	function records_fetch($strSql) {
		global $con;
		$Sql = $strSql;
		$results = mysqli_query($con,$Sql);
		if(@mysqli_fetch_object($results)) {
			$records_results = true; 
		}else{
			$records_results = false;
		}
		return $records_results;
	}



	function query_execute($strSql) {
		global $con;
		$Sql = $strSql;
		$results = mysqli_query($con,$Sql);
		return $results;
		mysqli_free_result($results);
	}



	function insert($tblname,$array){
		global $con;
		if(!is_array($array)){
			die("insert record failed, info must be an array");
		}

		$strSqlInsert = "INSERT INTO ".$tblname." (";
		for ($i=0; $i<count($array); $i++){
			$strSqlInsert .= key($array);
			if ($i < (count($array)-1)){
				$strSqlInsert .= ", ";
			}else $strSqlInsert .= ") ";
				next($array);
		}

		 reset($array);
		 $strSqlInsert .= "VALUES (";
		 for ($j=0; $j<count($array); $j++){
		 $strSqlInsert.= "'".current($array)."'";
		 if ($j < (count($array)-1)){
		 $strSqlInsert .= ", ";
		 } else
		 $strSqlInsert .= ") ";
		 next($array);
		}

		//echo $strSqlInsert;
		//exit;

		//mysqli_query($con,$strSqlInsert) or die("query failed ".mysqli_error());

		$this->query_execute($strSqlInsert) or die("query failed ".mysqli_error());
		return mysqli_insert_id($con); 
	}



	function update($tblname,$fieldarray,$fieldname,$value){
		global $con;
		if(!is_array($fieldarray)){ 
			die("update record failed, info must be an array"); 
		}
		$strSqlUpdate = "UPDATE `".$tblname."` SET "; 
		foreach($fieldarray as $key=>$val){
			$strSqlUpdate .= $key."='".$val."',";
		}

		$strSqlUpdate = substr_replace($strSqlUpdate ,"",-1);
		$strSqlUpdate .= ' WHERE '.$fieldname.'='.$value.'';
		//echo $strSqlUpdate;
		//exit;
		$this->query_execute($strSqlUpdate) or die("query failed ".mysqli_error());
	}
	
	
	function datetime_format() {
		$strDateTime = date("Y-m-d H:i:s");
		return	$strDateTime;
	}


	function json($data){
		header("Content-Type: application/json; charset=UTF-8");
	   	return json_encode($data);
	}


	function date_format($dateval) {
		$year = substr($dateval,0,4); 
		$month = substr($dateval,5,2);		
		$day = substr($dateval,8,2);
		$hour = substr($dateval,12,4);
		//echo $month."/".$day."/".$year."&nbsp;".$hour;  
		echo $month."/".$day."/".$year;
	}


	function HideMsg() {
		$strString  = "<script type='text/javascript' language='javascript'>";
		$strString .= "setTimeout('hide_msg();',5000);";
		$strString .= "</script>\n";
		return $strString;
	}

	
	function strreplace($strString) {
		$strsplval = array("?", "?", "'");
		$strsplrepl= array("`", "`", "`");
		$str_String = str_replace($strsplval,$strsplrepl,$strString);
		return $str_String;
	}
		
	function Session_Expired() {
		$getUrl = strpos($_SERVER['PHP_SELF'],"home.php");
		if($getUrl==false) {
			$Include_Path =""; 
		}else{
			$Include_Path ="";
		}

		if($_SESSION["vUsername"]=="" && $_SESSION["intAdminId "]=="") {
			header("Location:".$Include_Path."index.php?act=session_expired");
		}
	}

	function HideMsg60sec() {
		$strString  = "<script type='text/javascript' language='javascript'>";
		$strString .= "setTimeout('hide_msg();',60000);";
		$strString .= "</script>\n";
		return $strString;
	}
	
	function stringLimit($summary,$limit) {		
		$strLen = strlen($summary);
		if($strLen > $limit){
			$summary = substr($summary, 0, $limit) . '...';
		}
		return $summary;
	}


	function adminInclude($strPath,$strFile) {
		require($strPath.'includes/'.$strFile.'.php');
	}
	
	function sql_select($strSqlSelect) {
		global $con;
		$res = mysqli_query($con,$strSqlSelect); 
		return $res;
	}


	function sql_getrecordcount($strSqlSelect) { 
		global $con;
		$res = mysqli_query($con,$strSqlSelect);  
		$row = @mysqli_num_rows($res);  
		//reset($row);
		return $row;
	}
	
	function calculate_discount($bookPrice, $discount_value){
		$discount = ($discount_value/100);
		$discount_price = ($discount * $bookPrice);
		$total_price = floor($bookPrice - $discount_price);
		//$total_price = number_format(round($total_price, 2), 2);
		return $total_price;
	}
	
	function sendSMS($mobile,$message){
		$user		=	"sakthibookscom";
		$apikey		=	"FMwJpmjy3ovGObTJUCKe";
		$senderid	= 	"SPHORD";
		$type		=	"txt";
		$ch = curl_init("http://smshorizon.co.in/api/sendsms.php?user=".$user."&apikey=".$apikey."&mobile=".$mobile."&senderid=".$senderid."&message=".$message."&type=".$type.""); 
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$output = curl_exec($ch);      
		curl_close($ch);
		// Display MSGID of the successful sms push
		echo $output;
	}

	function generateOTP($digits = 4){
		$i = 0;
		$otp = "";
		while($i < $digits){
			$otp .= mt_rand(0, 9);
			$i++;
		}
		return $otp;
	}
	
	function convetdate($date){
		$split_date = explode('-',$date); 
		$strMonth = array("","Jan","Feb","Mar","Apr","May","June","July","Aug","Sep","Oct","Nov","Dec");
		if($split_date[1]==1){$Month=$strMonth[1];}
		else if($split_date[1]==2){$Month=$strMonth[2];}
		else if($split_date[1]==3){$Month=$strMonth[3];}
		else if($split_date[1]==4){$Month=$strMonth[4];}
		else if($split_date[1]==5){$Month=$strMonth[5];}
		else if($split_date[1]==6){$Month=$strMonth[6];}
		else if($split_date[1]==7){$Month=$strMonth[7];}
		else if($split_date[1]==8){$Month=$strMonth[8];}
		else if($split_date[1]==9){$Month=$strMonth[9];}
		else if($split_date[1]==10){$Month=$strMonth[10];}
		else if($split_date[1]==11){$Month=$strMonth[11];}
		else {$Month=$strMonth[12];}	
		$day = explode(' ',$split_date[2]);	
		echo $Month.'&nbsp;'.$day[0].',&nbsp;'.$split_date[0];
	}

	function showpagenav($page, $pagecount,$subpagename) {
		?>
		<ul class="pagination pagination-sm" style="margin:0;">
		<?php if ($page > 1) { ?>
		<li><a href="<?php echo $subpagename?>&page=<?php echo 1 ?>" aria-label="Previous"><span class="fa fa-fast-backward"></span></a></li>
		<li><a href="<?php echo $subpagename?>&page=<?php echo $page - 1 ?>"><span class="fa fa-chevron-left"></span></a></li>
		<?php } ?>
		<?php
		global $pagerange;
		
		if ($pagecount > 1) {
		
		if ($pagecount % $pagerange != 0) {
		$rangecount = intval($pagecount / $pagerange) + 1;
		}
		else {
		$rangecount = intval($pagecount / $pagerange);
		}
		for ($i = 1; $i < $rangecount + 1; $i++) {
		$startpage = (($i - 1) * $pagerange) + 1;
		$count = min($i * $pagerange, $pagecount);
		
		if ((($page >= $startpage) && ($page <= ($i * $pagerange)))) {
		for ($j = $startpage; $j < $count + 1; $j++) {
		if ($j == $page) {
		?>
		<li class="active"><a href="#"><?php echo $j ?> <span class="sr-only">(current)</span></a></li>
		<?php } else { ?>
		<li><a href="<?php echo $subpagename?>&page=<?php echo $j ?>"><span><?php echo $j ?></span></a></li>
		<?php } } } else { ?>
		
		<?php } } } ?>
		<?php if ($page < $pagecount) { ?>
		<li><a href="<?php echo $subpagename?>&page=<?php echo $page + 1 ?>"><span class="fa fa-chevron-right"></span></a></li>
		<li><a href="<?php echo $subpagename?>&page=<?php echo $pagecount?>" aria-label="Next"><span class="fa fa-fast-forward"></span></a></li>
		<?php } ?>
		</ul>
	<?php }

	function getActiveImageHide($strActive,$Page) {
		if($strActive=='Y') {
			$strImage = '<span class="glyphicon glyphicon-ok-circle text-success" aria-hidden="true"></span>'; 
			$altTitle ="Active"; 
		}elseif($strActive=='' || $strActive=='N') {
			$strImage = '<span class="glyphicon glyphicon-ban-circle text-danger" aria-hidden="true"></span>'; 
			$altTitle ="InActive"; 
		}
			$strString = "<a href='$Page' title='".$altTitle."'>".$strImage."</a>";
			return $strString;
	}

	

	function random_string($type = 'alnum', $len = 8)
	{					
		switch($type)
		{
			case 'alnum'	:
			case 'numeric'	:
			case 'nozero'	:
					switch ($type)
					{
						case 'alnum'	:	$pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
							break;
						case 'numeric'	:	$pool = '0123456789';
							break;
						case 'nozero'	:	$pool = '123456789';
							break;
					}

					$str = '';
					for ($i=0; $i < $len; $i++)
					{
						$str .= substr($pool, mt_rand(0, strlen($pool) -1), 1);
					}
					return $str;
			  break;
			case 'unique' : return md5(uniqid(mt_rand()));
			  break;
		}
	}


	function displayAmount($number) {
		return number_format((float)$number, 2, '.', '');
	}
		
	function showAdminType($user_type){
		$userType = "";
		if($user_type == 1){
			$userType = "Super Admin";
		}else if($user_type == 2){
			$userType = "Admin";
		}
		return $userType;
	}

	function showStatus($strStatus){
		if($strStatus=='Y'){ echo 'Active'; }else if($strStatus=='N'){ echo 'InActive'; }
	}


	function itemSelectedStr($items, $value){
		$selected = "";		
		if (strpos($items, $value) !== false) { $selected = "selected"; }		
		return $selected;
	}
	
	function custom_echo($x, $length){
		if(strlen($x)<=$length){
			return $x;
		}else{
			$y=substr($x,0,$length) . '...';
			return $y;
		}
	}

	function displayCategory($strID,$strTableName,$strTextName,$strValueName) {
		$results = $this->query_execute("SELECT * FROM ".$strTableName." WHERE intSubCatId =0 AND cStatus = 'Y' ORDER BY ".$strTextName);
		while($rows=@mysqli_fetch_object($results))
		{
			if($strID==$rows->$strValueName) {
				$strString .=  "<option value='".$rows->$strValueName."' selected>".substr($rows->$strTextName,0,50)."</option>";
			}
			else {
				$strString .=  "<option value='".$rows->$strValueName."'>".substr($rows->$strTextName,0,50)."</option>";
			}
		}
		return $strString;
	}
	
	function displaySubCategory($strID,$strTableName,$strTextName,$strValueName) {
		$results = $this->query_execute("select * from ".$strTableName." where intSubCatId NOT IN (0) AND cStatus = 'Y' order by ".$strTextName);
		while($rows=mysqli_fetch_object($results))
		{
			if($strID==$rows->$strValueName) {
				$strString .=  "<option value='".$rows->$strValueName."' selected>".substr($rows->$strTextName,0,50)."</option>";}
				else {
					$strString .=  "<option value='".$rows->$strValueName."'>".substr($rows->$strTextName,0,50)."</option>";}
		}
		return $strString;
	}
	
	function displaySubSecCategory($strID,$strTableName,$strTextName,$strValueName) {
		$results = $this->query_execute("select * from ".$strTableName." where intSubCatId IN (0) AND cStatus = 'Y' order by ".$strTextName);
		while($rows=mysqli_fetch_object($results))
		{
			if($strID==$rows->$strValueName) {
				$strString .=  "<option value='".$rows->$strValueName."' selected>".substr($rows->$strTextName,0,50)."</option>";}
				else {
					$strString .=  "<option value='".$rows->$strValueName."'>".substr($rows->$strTextName,0,50)."</option>";}
		}
		return $strString;
	}

	
	function displaySelectBox($strID,$strTableName,$strTextName,$strValueName) {
		$results = $this->query_execute("SELECT * FROM ".$strTableName." WHERE cStatus = 'Y'");
		while($rows=@mysqli_fetch_object($results)){
			if($rows->$strTextName !=""){
				if($strID==$rows->$strValueName) {
					$strString .=  "<option value='".$rows->$strValueName."' selected>".substr($rows->$strTextName,0,50)."</option>";
				}else{
					$strString .=  "<option value='".$rows->$strValueName."'>".substr($rows->$strTextName,0,50)."</option>";
				}
			}
		}
		return $strString;
	}
		
			
	function displayName($fn,$value,$strID,$strTableName) {
		global $con;
		$results = $this->query_execute("select ".$value." from ".$strTableName." where ".$fn." = '".$strID."'");
		$rows=@mysqli_fetch_object($results);
		return $rows->$value;
	}
	
	function mailerTemplate($id) {
		global $con;
		$results = $this->query_execute("SELECT * FROM `".TBL_MAILER."` WHERE `mailer_id`=".$id."");
		$rows=@mysqli_fetch_object($results);
		return $rows;
	}
	
	function smsTemplate($id) {
		global $con;
		$results = $this->query_execute("SELECT * FROM `".TBL_SMS."` WHERE `sms_id`=".$id."");
		$rows=@mysqli_fetch_object($results);
		return $rows;
	}
	
	function cancelStatus($status) {
		$style="";
		if($status == "Y"){ $style="style='text-decoration: line-through;'"; }
		return $style;
	}
	
	function orderStatus($status) {
		$style="";
		if($status == "New"){ $style='<span class="label label-warning">'.$status.'</span>'; }
		elseif($status == "Completed"){ $style='<span class="label label-success">'.$status.'</span>'; }
		else{ $style='<span class="label label-danger">Cancel</span>'; }
		return $style;
	}
	
	function statusBox($status) {
		$strString = "<select name='txtstatus' id='txtstatus' class='form-control'>";
		$selected1 = "";
		$selected2 = "";
		if($status=='Y') {
			$selected1 = "selected";
		}elseif($status=='N'){
			$selected2 = "selected";
		}
		
		$strString .= "<option value='Y' ".$selected1.">Active</option>";
		$strString .= "<option value='N' ".$selected2.">InActive</option>"; 
		$strString .= "</select>";
		return $strString;
	}
}
?>