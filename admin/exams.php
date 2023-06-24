<?php include("includes/header.php");
	
	if ($_REQUEST["page"]=="")
	$_REQUEST["page"]=1;
	
	$url_fields = "&order=".$_REQUEST["order"]."&type=".$_REQUEST["type"]."&filter=".$_SESSION['filter']."&filterfield=".$_SESSION['filterfield']."&page=".$_REQUEST["page"];
	
	############# Active #############
				if($_GET["act"]=="btnActive") {
					$strSqlActive = "SELECT * FROM ".TBL_FORTHCOMING_EXAMS." WHERE intForthComingExamId=".$_GET["id"];
					if($cnf->records_fetch($strSqlActive)==true) {
						$rs_contents = mysqli_fetch_object($cnf->query_execute($strSqlActive));
						
						if($rs_contents->cStatus=='N') {
							$strActive ='Y';
							 $actmsg="active";				
							}
							else if($rs_contents->cStatus=='Y') {
							$strActive ='N';
							 $actmsg="deactive";				
							}							
							
						$strSqlUpdate = "update ".TBL_FORTHCOMING_EXAMS." set `cStatus`='".$strActive."' where intForthComingExamId=".$_GET["id"];
						$cnf->query_execute($strSqlUpdate);						
						
						header("Location:exams.php?act=".$actmsg.$url_fields);
						} else {
						header("Location:exams.php?act=Invalid".$url_fields);
					}
				}	
								
		
			
			//delete one record
		if($_REQUEST['act']== 'deleterec'){
			$strSql = "DELETE FROM ".TBL_FORTHCOMING_EXAMS." WHERE intForthComingExamId=".$_REQUEST['id']." LIMIT 1";
			$cnf->query_execute($strSql);			
			header("Location:exams.php?act=deleted".$url_fields);
		}
				
						

				if($_POST["btnSubmit"]!="") {		
				
				$selOptions = $_POST["selOptions"];					
					

					if($selOptions=="InActive") {
						$strString = "`cStatus`='Y'"; 
						$actmsg="active";
						}
					
					if($selOptions=="BanActive") {
						$strString = "`cStatus`='N'"; 
						$actmsg="deactive";
						}
					
					
					$IntCount = count($_POST["chk"]) - 1;
					for($intI=0;$intI<=$IntCount;$intI++) {
						if($selOptions=="Delete") {
						$strSqlDelete = "delete from ".TBL_FORTHCOMING_EXAMS." where intForthComingExamId=".$_POST["chk"][$intI];
						$cnf->query_execute($strSqlDelete);						
						} else {
						$strSqlUpdateOptions = "update ".TBL_FORTHCOMING_EXAMS." set ".$strString." where intForthComingExamId=".$_POST["chk"][$intI]; }
						$cnf->query_execute($strSqlUpdateOptions);	
					}
					
					if($selOptions!="Delete") {		
					
					if ($_REQUEST["page"]=="")
						$_REQUEST["page"]=1;			
							
						$strString = "".$actmsg."&order=".$_REQUEST["order"]."&type=".$_REQUEST["type"]."&filter=".$_SESSION['filter']."&filterfield=".$_SESSION['filterfield']."&page=".$_REQUEST["page"]; }
						else {
						$strString = "Deleted&order=".$_REQUEST["order"]."&type=".$_REQUEST["type"]."&filter=".$_SESSION['filter']."&filterfield=".$_SESSION['filterfield']."&page=".$_REQUEST["page"]; }
					
					header("Location:exams.php?act=".$strString."&rec=mul");
				}				
				
				
				if($_GET["act"]=="Updated") {									
					$strMsg = Updated_RECORDS; 
					echo $cnf->HideMsg(); }
					
				if($_GET["act"]=="Added") {
					$strMsg = Inserted_RECORDS;
					echo $cnf->HideMsg(); }
					
				if($_GET["act"]=="Exists") {
					$strMsg = Records_exists;
					echo $cnf->HideMsg(); }	
					
				if($_GET["act"]=="Deleted") {
					$strMsg = "Records has been deleted successfully!";
					echo $cnf->HideMsg(); }
					
				if($_GET["act"]=="active") {									
					$strMsg = Active_Article; 
					echo $cnf->HideMsg(); }
					
				
					
				if($_GET["act"]=="Deleted" && $_REQUEST['rec'] != 'mul') {
					$strMsg = Deleted_RECORDS;
					echo $cnf->HideMsg(); }
					
				if($_GET["act"]=="Deleted" && $_REQUEST['rec'] == 'mul') {
					$strMsg = "Records has been deleted successfully";
					echo $cnf->HideMsg(); }	
					
				if($_GET["act"]=="active" && $_REQUEST['rec'] == 'mul') {									
					$strMsg = 'This forth coming exams are activated successfully';
					echo $cnf->HideMsg(); 
				}	
				if($_GET["act"]=="deactive" && $_REQUEST['rec'] == 'mul') {									
					$strMsg = 'This forth coming exams are deactivated successfully';
					echo $cnf->HideMsg(); 
				}	
					
					
				if($_GET["act"]=="active" && $_REQUEST['rec'] != 'mul') {									
					$strMsg = "This forth coming exams activated successfully."; 
					echo $cnf->HideMsg(); }
					
				if($_GET["act"]=="deactive" && $_REQUEST['rec'] != 'mul') {									
					$strMsg = "This forth coming exams deactivated successfully."; 
					echo $cnf->HideMsg(); }
					
				
			?>
					
<?php 			 

//Filter listing values
$filter1 = @trim($_REQUEST["filter"]);
$filterfield1 = @trim($_REQUEST["filterfield"]);
$filter = $_SESSION["filter"] = $filter1;
$filterfield = $_SESSION["filterfield"] = $filterfield1;
$wholeonly = false;
$wholeonly = @$_REQUEST["wholeonly"];						 
$wholeonly = $_SESSION["wholeonly"] = $wholeonly;

//Order listing values
$order1 = @trim($_REQUEST["order"]);
$ordtype1 = @trim($_REQUEST["type"]);
$order = $_SESSION["order"] = $order1;
$ordtype = $_SESSION["type"] = $ordtype1;

$checkstr = "";						 
if ($ordtype == "asc") { $ordtypestr = "desc"; } else { $ordtypestr = "asc"; }						  
$checkstr = "";						  
if ($ordtype == "asc") { $ordtypestr = "desc"; } else { $ordtypestr = "asc"; }						  

$filterstr = $filter;				
if ($wholeonly && $filterstr!='') 
{
$filterstr = "" .$filterstr .""; 
}else{
$filterstr = "%" .$filterstr ."%"; 
} 


$strSqlSelect = "SELECT * FROM ".TBL_FORTHCOMING_EXAMS." "; 						  

if ($wholeonly && $_SESSION["filterfield"]!='') {
$strSqlSelect .= " where " .$_SESSION["filterfield"] ." like '" .$_SESSION["filter"]."'";
} else if ($_SESSION["filterfield"]!='') {								
$strSqlSelect .= " where " .$_SESSION["filterfield"] ." like '%" .$_SESSION["filter"]."%'";		
} else if ($_SESSION["filter"]!='') {

$strSqlSelect .= "where (`vTitle` like '" .$filterstr ."') or (`cStatus` like '" .$filterstr ."')  ";	
}			 

if($order!=''){$strSqlSelect .= " order by `" .$_SESSION["order"]."`";}else{$strSqlSelect .= " order by `intForthComingExamId` ";}
if ($ordtype!=''){$strSqlSelect .= " " .$_SESSION["type"];}else{$strSqlSelect .= "DESC";}	   
//echo $strSqlSelect;

$showrecs = INCRE;
$pagerange = LIST_PRTPAGE;

$page = @$_GET["page"];
if (!isset($page)) $page = 1;

$res = $cnf->sql_select($strSqlSelect);
$count = $cnf->sql_getrecordcount($strSqlSelect);
if ($count % $showrecs != 0) {
$pagecount = intval($count / $showrecs) + 1;
}
else {
$pagecount = intval($count / $showrecs);
}
$startrec = $showrecs * ($page - 1);
if ($startrec < $count) {mysqli_data_seek($res, $startrec);}
$reccount = min($showrecs * $page, $count); 										

?>

	<body>
		<section class="body">

			<!-- start: header -->
			<?php include("includes/topheader.php"); ?>
			<!-- end: header -->

			<div class="inner-wrapper">
				<!-- start: sidebar -->
				<?php include ("includes/menu.php"); ?>
				<!-- end: sidebar -->
					
				<section role="main" class="content-body">
					<header class="page-header">
						<h2>Exam - List</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="dashboard.php">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<!--<li><span><a href="addproduct.php">Add User</a></span></li>-->
							</ol>
					
							<a class="" data-open="sidebar-right">&nbsp;</a>
						</div>
					</header>
					
					<!-- start: page -->
					<div class="row">
							<div class="col-lg-12">
                            	<div id="divMsg"><?php echo $strMsg?></div>
								<section class="panel">
									
                                    <div class="panel-body">
                                    
                                    <div class="pull-right navadminbtn" style="margin-bottom:10px;">
                                         <a href="addexam.php"><button class="btn btn-success">Add Exams</button></a>
                                    </div>
                                    <div class="clearfix"></div>
                                    
                                  
                                    <form action="exams.php" method="post">
                                        <table class="table table-bordered table-striped" width="100%" border="0" cellspacing="0" cellpadding="0" >
                                            <tr>
                                                <td align="center" valign="middle"><b>FILTER</b> :
                                                    <input type="text" name="filter" id="filter" class="input-sm" value="<?php echo $filter ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    By Location Status&nbsp;&nbsp;
                                                    <select name="filterfield" class="input-sm">
                                                        <option value="">All Fields</option>
                                                        <option value="<?php echo "vTitle" ?>"<?php if ($filterfield == "vTitle") { echo "selected"; } ?>><?php echo htmlspecialchars("Exam Name") ?></option>
                                                    </select>
                                                    &nbsp;&nbsp;&nbsp;Whole words only
                                                    <input type="checkbox" name="wholeonly"<?php echo $checkstr ?> />
                                                    <label>
                                                    <input type="submit" name="Submit" value="Find" class="btn btn-info btn-sm" onClick="return btncustomfilter();">
                                                    </label>
                                                &nbsp;<a href="exams.php?a=reset" class="btn btn-link">Reset List</a>
                                                </td>
                                            </tr>
                                        </table>
      								</form>
    
                                    <form action="" method="POST" class="form-horizontal form-bordered" name="frm" onSubmit="return frmAction(frm);">
                                    	<?php
										$strQry = "SELECT * FROM ".TBL_FORTHCOMING_EXAMS." ";
										$resQry = mysqli_query($con,$strQry);
										if($cnf->records_fetch($strQry) == true) {
											
										?>
                                            <table class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                    	<th>S.No</th>
                                                        <th><input type="checkbox" name="checkBoxBtn" id="checkBoxBtn" value="1" /></th>
                                                        <th><a href="exams.php?order=<?php echo "vTitle" ?>&type=<?php echo $ordtypestr ?>&filter=<?php echo $_REQUEST['filter']?>&filterfield=<?php echo $_REQUEST['filterfield']?>&page=<?php echo $_REQUEST["page"];?>">Exam Name</a></th>
                                                        <th><a href="exams.php?order=<?php echo "dtExamDate" ?>&type=<?php echo $ordtypestr ?>&filter=<?php echo $_REQUEST['filter']?>&filterfield=<?php echo $_REQUEST['filterfield']?>&page=<?php echo $_REQUEST["page"];?>">Exam Date</a></th>
                                                        
                                                        
                                                        <th><a class="title_link" href="exams.php?order=<?php echo "cStatus" ?>&type=<?php echo $ordtypestr ?>&filter=<?php echo $_REQUEST['filter']?>&filterfield=<?php echo $_REQUEST['filterfield']?>&page=<?php echo $_REQUEST["page"];?>">Status</a></th>
                                                      
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php
												
												for ($i = $startrec; $i < $reccount; $i++) {													
												$rowQry = mysqli_fetch_object($res);
												?>
                                                    <tr class="gradeX">
                                                        <td><?php echo $i+1; ?></td>
                                                        <td><input type="checkbox" name="chk[]" value="<?php echo $rowQry->intForthComingExamId ?>" <?php  if($_GET["act"]=="CheckAll") { ?> checked <?php } ?> /></td>                        
                                                        <td><?php echo $rowQry->vTitle; ?></td>
                                                        <td><?php echo $cnf->convetdate($rowQry->dtExamDate);?></td>
                                                         
                                                        <td align="center">
														<?php echo $cnf->getActiveImageHide($rowQry->cStatus,'exams.php?act=btnActive&id='.$rowQry->intForthComingExamId)?>
                                                        </td>
                                                        
                                                        
                                                        <td align="center" valign="middle" class="brwhite">
													   <a href="edit_exam.php?id=<?php echo $rowQry->intForthComingExamId.$url_fields ?>" onClick="return confirmMsg(1);" class="text-info" title="Edit"><i class="fa fa-pencil" ></i></a>&nbsp;&nbsp;
                                                            
                                                            <a href="exams.php?act=deleterec&id=<?php echo $rowQry->intForthComingExamId.$url_fields ?>" onClick="return confirmMsg(2);" class="text-danger" title="Delete"><i class="fa fa-trash-o"></i></a>
                                                      </td>
                                                    </tr>
                                                <?php } ?>                                                     
                                                </tbody>
                                            </table>
                                            
                                            <table class="table table-condensed table-striped">
                                                <tr>
                                                    <td align="left" valign="middle" style="border-right:0;">Items <?php echo $startrec + 1 ?> - <?php echo $reccount ?> of <?php echo $count ?></td>
                                                    <td align="right" valign="middle"><?php  $cnf->showpagenav($page, $pagecount,"exams.php?order=".$_REQUEST["order"]."&type=".$_REQUEST["type"]."&filter=".$_SESSION['filter']."&filterfield=".$_SESSION['filterfield']."");?></td>
                                                </tr>
                                            </table>
                                            
                                        <?php 
										}else{ echo "<p style='color:#FF0000;'>Sorry no records found!</p>"; } ?>
                                        
                                        <?php if($cnf->records_fetch($strQry)==true) {?>                            
                                            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="rgtlistbdr">
                                                <tr>
                                                    <td width="72" align="left" valign="middle">&nbsp;</td>
                                                    <td width="200" align="left" valign="middle">
                                                        <?php 
                                                            if($_GET["act"]=="UnCheckAll"){
                                                                $strCheck = "CheckAll"; $strCheckString = "Check All";
                                                            }else if($_GET["act"]=="CheckAll"){
                                                                $strCheck = "UnCheckAll"; $strCheckString = "UnCheck All";
                                                            }else{
                                                                $strCheck = "CheckAll"; $strCheckString = "Check All";
                                                            }
                                                        ?>
                                                        <a href="javascript:CheckAll(frm);" class="text_btm_link">
                                                            <div id="divCheck" style="font-weight:bold;">Check All</div>
                                                        </a>
                                                        <noscript>
                                                        <a href="exams.php?act=<?php echo $strCheck?>" class="text_btm_link"><?php echo $strCheckString?></a>
                                                        </noscript>
                                                    </td>
                                                    <td width="85" align="left" valign="middle">With Select </td>
                                                    <td width="207" align="left" valign="middle">
                                                        <select name="selOptions" class="form-control">
                                                            <option value="InActive">-- Active --</option>
                                                          <option value="BanActive">-- InActive --</option>
                                                          <?php if($_SESSION["userType"] != 2){ ?>
                                                          <option value="Delete">-- Delete --</option>
                                                          <?php } ?>
                                                        </select>
                                                        <input type="hidden" name="txtCheck" value="unCheck">
                                                        <input type="hidden" name="txtOpt" value="N">
                                                    </td>
                                                    <td width="658" valign="middle">
                                                        <button type="submit" name="btnProcess" class="btn btn-small btn-info" style="margin-left:10px;">Submit</button>
                                                        <input type="hidden" name="btnSubmit" value="Process">
                                                    </td>
                                                    <td width="76" align="left" valign="middle">&nbsp;</td>
                                                </tr>
                                            </table>
                                        <?php } ?>
                                        </form>
                                    </div>
							</section>
        
							</div>
                            
						</div>
					
					
					<!-- end: page -->
				</section>
			</div>

		</section>
 <?php include("includes/footer.php"); ?>
