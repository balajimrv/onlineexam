<?php include("includes/header.php");
	
	if ($_REQUEST["page"]=="")
	$_REQUEST["page"]=1;
	
	$url_fields = "&order=".$_REQUEST["order"]."&type=".$_REQUEST["type"]."&filter=".$_SESSION['filter']."&filterfield=".$_SESSION['filterfield']."&page=".$_REQUEST["page"];
	
	############# Active #############
				if($_GET["act"]=="BanActive") {
					$strSqlActive = "select * from ".TBL_TEST." where test_id=".$_GET["id"];
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
							
						$strSqlUpdate = "update ".TBL_TEST." set `cStatus`='".$strActive."' where test_id=".$_GET["id"];
						$cnf->query_execute($strSqlUpdate);						
						
						header("Location:test.php?act=".$actmsg.$url_fields);
						} else {
						header("Location:test.php?act=Invalid".$url_fields);
					}
				}		
				
				
				
				############# Popular Active #############
				
				if($_GET["act"]=="PopActive") {
					$strSqlActive = "select * from ".TBL_TEST." where test_id=".$_GET["id"];
					if($cnf->records_fetch($strSqlActive)==true) {
						$rs_contents = mysqli_fetch_object($cnf->query_execute($strSqlActive));
						
						if($rs_contents->popular_test=='N') {
							$strActive ='Y';
							 $actmsg="PopActive";				
							}
							else if($rs_contents->popular_test=='Y') {
							$strActive ='N';
							 $actmsg="PopInActive";				
							}							
							
						$strSqlUpdate = "update ".TBL_TEST." set `popular_test`='".$strActive."' where test_id=".$_GET["id"];
						$cnf->query_execute($strSqlUpdate);						
						
						header("Location:test.php?act=".$actmsg.$url_fields);
						} else {
						header("Location:test.php?act=Invalid".$url_fields);
					}
				}
				
				
								
		//delete one record
		if($_REQUEST['act']== 'delete'){
			$sql ="DELETE FROM ".TBL_QUESTIONS." where test_id=".$_GET["id"];
			$cnf->query_execute($sql);
	
			$strSql = "DELETE FROM ".TBL_TEST." where test_id=".$_GET["id"];
			$cnf->query_execute($strSql);
			header("Location:test.php?act=deleted");
	}
						

				
				if($_GET["act"]=="Updated") {    								
					$strMsg = "Records has been updated successfully!"; 
					echo $cnf->HideMsg(); }
					
				if($_GET["act"]=="Added") {
					$strMsg = "Records added successfully!";
					echo $cnf->HideMsg(); }
					
				if($_GET["act"]=="Exists") {
					$strMsg = Records_exists;
					echo $cnf->HideMsg(); }	
					
				if($_GET["act"]=="Deleted") {
					$strMsg = "Records has been deleted successfully!";
					echo $cnf->HideMsg(); }
					
				if($_GET["act"]=="active") {									
					$strMsg = "Records activated successfully!"; 
					echo $cnf->HideMsg(); }
										
				if($_GET["act"]=="Deleted" && $_REQUEST['rec'] != 'mul') {
					$strMsg = Deleted_RECORDS;
					echo $cnf->HideMsg(); }
					
				if($_GET["act"]=="Deleted" && $_REQUEST['rec'] == 'mul') {
					$strMsg = "Records has been deleted successfully";
					echo $cnf->HideMsg(); }	
					
				if($_GET["act"]=="active" && $_REQUEST['rec'] == 'mul') {									
					$strMsg = 'This test are activated successfully';
					echo $cnf->HideMsg(); 
				}	
				if($_GET["act"]=="deactive" && $_REQUEST['rec'] == 'mul') {									
					$strMsg = 'This test are deactivated successfully';
					echo $cnf->HideMsg(); 
				}	
					
					
				if($_GET["act"]=="PopActive") {									
					$strMsg = "The popular test status activated successfully!"; 
					echo $cnf->HideMsg(); }
					
				if($_GET["act"]=="PopInActive") {									
					$strMsg = "The popular test status deactivated successfully!"; 
					echo $cnf->HideMsg(); }
					
				
				if($_GET["act"]=="active" && $_REQUEST['rec'] != 'mul') {									
					$strMsg = "This test activated successfully."; 
					echo $cnf->HideMsg(); }
					
				if($_GET["act"]=="deactive" && $_REQUEST['rec'] != 'mul') {									
					$strMsg = "This test deactivated successfully."; 
					echo $cnf->HideMsg(); }
							
?>

<script type="text/JavaScript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>
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
						<h2>Test - List</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="dashboard.php">
										<i class="fa fa-home"></i>
									</a>
								</li>
								
                                <li><span><a href="addtest.php" class="btn btn-success btn-small"><i class="fa fa-plus" aria-hidden="true"></i>
 Add New Test</a></span></li>
                                
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
									?>
                                    <div class="clearfix"></div>
                                    
                                    <?php
                                    //Filter listing values
									$strQry = "SELECT * FROM (SELECT t1.`test_id`, t1.`intSubCatId`, lp1.`vCatName` AS `category_name`, t1.`test_name`, t1.`total_questions`, t1.`test_time`, t1.`dtCreated`, t1.`cStatus`, t1.`popular_test`, t1.`test_price` , ty.`test_type_name` FROM ".TBL_TEST." AS t1 LEFT OUTER JOIN ".TBL_CATEGORY." AS lp1 ON (t1.`intSubCatId` = lp1.`intCat_id`) LEFT OUTER JOIN ".TBL_TEST_TYPE." AS ty ON (t1.`test_type` = ty.`test_type`)) subq ";				  
									
									if ($wholeonly && $_SESSION["filterfield"]!='') {
									$strQry .= " where " .$_SESSION["filterfield"] ." like '" .$_SESSION["filter"]."'";
									} else if ($_SESSION["filterfield"]!='') {								
									$strQry .= " where " .$_SESSION["filterfield"] ." like '%" .$_SESSION["filter"]."%'";		
									} else if ($_SESSION["filter"]!='') {
									
									$strQry .= " WHERE (`test_id` like '" .$filterstr ."') or (`category_name` like '" .$filterstr ."') or (`test_name` like '" .$filterstr ."')  or (`test_type` like '" .$filterstr ."') ";	
									}		
									
									
									if($order!=''){$strQry .= " order by `" .$_SESSION["order"]."`";}else{$strQry .= " order by `test_id` ";}
									if ($ordtype!=''){$strQry .= " " .$_SESSION["type"];}else{$strQry .= "DESC";}	
									//echo $strQry;
									
									$showrecs = 25;
									$pagerange = LIST_PRTPAGE;
									
									$page = @$_GET["page"];
									if (!isset($page)) $page = 1;
									
									$res = $cnf->sql_select($strQry);
									$count = $cnf->sql_getrecordcount($strQry);
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
                                    <form action="test.php" method="post">
                                        <table class="table table-bordered table-striped" width="100%" border="0" cellspacing="0" cellpadding="0" >
                                            <tr>
                                                <td align="center" valign="middle"><b>FILTER</b> :
                                                    <input type="text" name="filter" id="filter" class="input-sm" value="<?php echo $filter ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    By Location Status&nbsp;&nbsp;
                                                    <select name="filterfield" class="input-sm">
                                                        <option value="">All Fields</option>
                                                        <option value="<?php echo "category_name" ?>"<?php if ($filterfield == "category_name") { echo "selected"; } ?>><?php echo htmlspecialchars("Sub Category Name") ?></option>
                                                        
                                                        <option value="<?php echo "test_name" ?>"<?php if ($filterfield == "test_name") { echo "selected"; } ?>><?php echo htmlspecialchars("Test Name") ?></option>
                                                        
                                                    </select>
                                                    &nbsp;&nbsp;&nbsp;Whole words only
                                                    <input type="checkbox" name="wholeonly"<?php echo $checkstr ?> />
                                                    <label>
                                                    <input type="submit" name="Submit" value="Find" class="btn btn-info btn-sm" onClick="return btncustomfilter();">
                                                    </label>
                                                &nbsp;<a href="test.php?a=reset" class="btn btn-link">Reset List</a>
                                                </td>
                                            </tr>
                                        </table>
      								</form>
    
                                    <form action="test.php" method="POST" id="actionfrm" class="form-horizontal form-bordered" name="frm">
                                    	<?php
										//$strQry = "SELECT * FROM `".TBL_TEST."` WHERE test_id=1 ORDER BY `test_id` DESC";
										//$resQry = mysqli_query($con,$strQry);
										if($cnf->records_fetch($strQry) == true) {
											
										?>
                                            <table class="table table-bordered table-striped table-condensed" style="width:100%">
                                                <thead>
                                                    <tr>
                                                    	<th width="61">S.No</th>
                                                        <th width="25"><input type="checkbox" name="checkBoxBtn" id="checkBoxBtn" value="1" /></th>
                                                        <th width="508">Test Name</th>
                                                        <th width="300"><a href="test.php?order=<?php echo "category_name" ?>&type=<?php echo $ordtypestr ?>&filter=<?php echo $_REQUEST['filter']?>&filterfield=<?php echo $_REQUEST['filterfield']?>&page=<?php echo $_REQUEST["page"];?>">Category Name</a></th>
                                                        <th width="112">Type</th>
                                                        <th width="112">Total Ques</th>
                                                        <th width="40">Time</th>
                                                        
                                                        <th width="40"><a class="title_link" href="test.php?order=<?php echo "cStatus" ?>&type=<?php echo $ordtypestr ?>&filter=<?php echo $_REQUEST['filter']?>&filterfield=<?php echo $_REQUEST['filterfield']?>&page=<?php echo $_REQUEST["page"];?>">Status</a></th>
                                                     
                                                        <th width="40">Popular Test</th>
                                                        <th class="hidden-phone">Date</th>
                                                        
                                                        
                                                        <th width="87">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php
												
												for ($i = $startrec; $i < $reccount; $i++) {													
												$rowQry = mysqli_fetch_object($res);
												?>
                                                    <tr class="gradeX">
                                                        <td><?php echo $i+1; ?></td>
                                                        
                                                        <td><input type="checkbox" name="chk[]" value="<?php echo $rowQry->test_id ?>" <?php  if($_GET["act"]=="CheckAll") { ?> checked <?php } ?> /></td>                        
                                                        
                                                        <td><a href="#" data-toggle="modal" data-target="#myModal" id=<?php echo $rowQry->test_id; ?>><?php echo $cnf->custom_echo($rowQry->test_name, 50);?></a></td>
                                                        <td><?php echo $rowQry->category_name;?></td>
                                                        
                                                        
                                                        <td><?php echo $rowQry->test_type_name;?></td>
                                                        <td><?php echo $rowQry->total_questions;?></td>
                                                        <td><?php echo $rowQry->test_time;?></td>
                                                        <td align="center">
														<?php echo $cnf->getActiveImageHide($rowQry->cStatus,'test.php?act=BanActive&id='.$rowQry->test_id)?>
                                                        </td>
                                                       
                                                       <td align="center" valign="middle" class="brwhite">
                                                       <?php echo $cnf->getActiveImageHide($rowQry->popular_test,'test.php?act=PopActive&id='.$rowQry->test_id)?>
                                                       </td>
                                                        
                                                        
                                                       <td class="center"><?php echo $cnf->convetdate($rowQry->dtCreated); ?></td>
                                                        
                                                        <td align="center" valign="middle" class="brwhite">
                                                                                                            
                                                      <?php 
                                                      if($_SESSION["userType"] != 2){ ?>
                                                          <a href="edit_test.php?id=<?php echo $rowQry->test_id.$url_fields ?>" onClick="return confirmMsg(1);" class="text-info" title="Edit"><i class="fa fa-pencil" ></i></a>&nbsp;&nbsp;
                                                            
                                                            <a href="test.php?act=delete&id=<?php echo $rowQry->test_id.$url_fields ?>" onClick="return confirmMsg(2);" class="text-danger" title="Delete"><i class="fa fa-trash-o"></i></a>
                                                     <?php
                                                      }else{ ?>
                                                    <a href="test.php?act=delete&id=<?php echo $rowQry->test_id.$url_fields ?>" onClick="return confirmMsg(2);" class="text-danger" title="Delete"><i class="fa fa-trash-o"></i></a>  
                                                    <?php 
                                                      }
                                                      ?>
                                                      </td>
                                                    </tr>
                                                <?php } ?>                                                     
                                                </tbody>
                                            </table>
                                            
                                            <table class="table table-condensed table-striped">
                                                <tr>
                                                    <td align="left" valign="middle" style="border-right:0;">Items <?php echo $startrec + 1 ?> - <?php echo $reccount ?> of <?php echo $count ?></td>
                                                    <td align="right" valign="middle"><?php  $cnf->showpagenav($page, $pagecount,"test.php?order=".$_REQUEST["order"]."&type=".$_REQUEST["type"]."&filter=".$_SESSION['filter']."&filterfield=".$_SESSION['filterfield']."");?></td>
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
                                                        <a href="test.php?act=<?php echo $strCheck?>" class="text_btm_link"><?php echo $strCheckString?></a>
                                                        </noscript>
                                                    </td>
                                                    <td width="85" align="left" valign="middle">With Select </td>
                                                    <td width="207" align="left" valign="middle">
                                                        <select name="selOptions" class="form-control">
                                                            <option value="InActive">-- Active --</option>
                                                          <option value="BanActive">-- InActive --</option>
                                                          <option value="Pop_Active">-- Popular Active --</option>
                                                          <option value="Pop_InActive">-- Popular InActive --</option>
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
        
        <style>
        .ajax-done {
            margin: 10px;
            position: absolute;
            top: 0px;

            animation-name: fadeInAndOut;
            animation-duration: 2s;
            animation-fill-mode: forwards;
        }

        @keyframes fadeInAndOut {
            0%   {opacity: 1; transform: translateY(-30px);}
            10%  {opacity: 1; transform: translateY(0px);}
            70%  {opacity: 1;}
            90%  {opacity: 1; transform: translateY(0px);}
            100% {opacity: 0; transform: translateY(-30px);}
        }
    </style>

    <div class="alert alert-success hidden">
        <p>
            <i class="checkmark icon"></i>
            <span></span>
        </p>
    </div>
 <?php include("includes/footer.php"); 
 
		
	if($_POST["btnSubmit"]!="") {		
				
				$selOptions = $_POST["selOptions"];					
					
					if($selOptions=="InActive") {
						$strString = "`cStatus`='Y'"; 
						$actmsg="active";
					}
					
					if($selOptions=="Pop_Active") {
						$strString = "`popular_test`='Y'"; 
						$actmsg="PopActive";
					}
					
					if($selOptions=="Pop_InActive") {
						$strString = "`popular_test`='N'"; 
						$actmsg="PopInActive";
					}
					
					$IntCount = count($_POST["chk"]) - 1;
					for($intI=0;$intI<=$IntCount;$intI++) {
						if($selOptions=="Delete") {
						
						$sql = "delete from ".TBL_QUESTIONS." where test_id=".$_POST["chk"][$intI];
						$cnf->query_execute($sql);
						
						$strSqlDelete = "delete from ".TBL_TEST." where test_id=".$_POST["chk"][$intI];
						$cnf->query_execute($strSqlDelete);
						
						} else {
						$strSqlUpdateOptions = "update ".TBL_TEST." set ".$strString." where test_id=".$_POST["chk"][$intI]; }
						$cnf->query_execute($strSqlUpdateOptions);	
					}
					
					if($selOptions!="Delete") {		
					
					if ($_REQUEST["page"]=="")
						$_REQUEST["page"]=1;			
							
						$strString = "".$actmsg."&order=".$_REQUEST["order"]."&type=".$_REQUEST["type"]."&filter=".$_SESSION['filter']."&filterfield=".$_SESSION['filterfield']."&page=".$_REQUEST["page"]; }
						else {
						$strString = "Deleted&order=".$_REQUEST["order"]."&type=".$_REQUEST["type"]."&filter=".$_SESSION['filter']."&filterfield=".$_SESSION['filterfield']."&page=".$_REQUEST["page"]; }
					
					header("Location:test.php?act=".$strString."&rec=mul");
				}			
 ?>
 <div class="modal fade bs-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <div id="modalContent" style="display:none;"></div>
      <div class="clearfix"></div>
	  <div class="modal-footer">
      	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>      
    </div>
  </div>
</div>

<script type="text/javascript">
$("a[data-toggle=modal]").click(function() 
{   
    var id = $(this).attr('id');

    $.ajax({
        cache: false,
        type: 'POST',
        url: 'test_modal.php',
        data: 'id='+id,
        success: function(data) 
        {
            $('#myModal').show();
            $('#modalContent').show().html(data);
        }
    });
});
</script> 