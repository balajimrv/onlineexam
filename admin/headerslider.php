<?php include("includes/header.php");
	
	if ($_REQUEST["page"]=="")
	$_REQUEST["page"]=1;
	
	$url_fields = "&order=".$_REQUEST["order"]."&type=".$_REQUEST["type"]."&filter=".$_SESSION['filter']."&filterfield=".$_SESSION['filterfield']."&page=".$_REQUEST["page"];
	
	
	
	//Status Change
	if($_GET["act"]=="btnActive") {
		$strSqlActive = "SELECT * FROM ".TBL_HEADER." WHERE header_id=".$_GET["id"];
		if($cnf->records_fetch($strSqlActive)==true) {
			$rs_contents = mysqli_fetch_object($cnf->query_execute($strSqlActive));
		
		if($rs_contents->cStatus=='N') {
			$strActive ='Y';
			$actmsg="active";				
		}else if($rs_contents->cStatus=='Y') {
			$strActive ='N';
			$actmsg="deactive";				
		}							
		
			$strSqlUpdate = "UPDATE ".TBL_HEADER." SET `cStatus`='".$strActive."' WHERE header_id=".$_GET["id"];
			$cnf->query_execute($strSqlUpdate);							
		
			header("Location:headerslider.php?act=".$actmsg.$url_fields);
		}else{
			header("Location:headerslider.php?act=Invalid".$url_fields);
		}
	}
	
	//Delete Record
	if($_REQUEST['act']== 'delete'){
		
		$sql1 = "SELECT * FROM `".TBL_HEADER."` WHERE header_id=".$_REQUEST['id']."";
			$res1 = mysqli_query($con,$sql1);
			$row1 = mysqli_fetch_object($res1);
		if($row1){
			unlink("uploads/header/".$row1->image_name);
		}
			
		$strSql = "DELETE FROM ".TBL_HEADER." WHERE header_id=".$_REQUEST['id']." LIMIT 1";
		$cnf->query_execute($strSql);
		header("Location:headerslider.php?act=deleted".$url_fields);
	}
	
	if($_POST["btnSubmit"]!="") {				
		$selOptions = $_POST["selOptions"];				

		if($selOptions=="allActive") {
			$strString = "`cStatus`='Y'"; 
			$actmsg="active";
		}else if($selOptions=="deActive") {
			$strString = "`cStatus`='N'"; 
			$actmsg="deactive";
		}
	
		$IntCount = count($_POST["chk"])  - 1;
		for($intI=0;$intI<=$IntCount;$intI++) {
			if($selOptions=="deleteRec") {
				
				$sql = "SELECT * FROM `".TBL_HEADER."` WHERE header_id=".$_POST["chk"][$intI];
				$res = mysqli_query($con,$sql);
				while($row = mysqli_fetch_object($res)){
					unlink("uploads/header/".$row->image_name);
				}
						
				$strSqlDelete = "DELETE FROM ".TBL_HEADER." WHERE header_id=".$_POST["chk"][$intI];
				$cnf->query_execute($strSqlDelete);																		
			}else{
				$strSqlUpdateOptions = "UPDATE ".TBL_HEADER." SET ".$strString." WHERE header_id=".$_POST["chk"][$intI]; }
				$cnf->query_execute($strSqlUpdateOptions);
		}
				
	if($selOptions !="deleteRec") {
			$strString = "".$actmsg; }
		else {
			$strString = "deleted"; }
			header("Location:headerslider.php?act=".$strString.$url_fields);
	}
	
	if($_GET["act"]=="added") {
		$strMsg = "Records added successfully!";
		echo $cnf->HideMsg(); 
	}
	
	if($_GET["act"]=="updated") {									
		$strMsg = "Records has been updated successfully!"; 
		echo $cnf->HideMsg(); 
	}
		
	if($_GET["act"]=="deleted") {
		$strMsg = "Records has been deleted successfully!";
		echo $cnf->HideMsg(); 
	}
	
	if($_GET["act"]=="active") {									
		$strMsg = "Records activated successfully!"; 
		echo $cnf->HideMsg(); 
	}

	if($_GET["act"]=="deactive"){									
		$strMsg = 'Records deactivated successfully!';
		echo $cnf->HideMsg(); 
	}
	
	if($_GET["act"]=="invalid"){									
		$strMsg = 'Invalid URL!';
		echo $cnf->HideMsg(); 
	}
	
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
						<h2>Header Image - List</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="dashboard.php">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span><a href="addheaderslider.php" class="btn btn-success btn-small"><i class="fa fa-plus" aria-hidden="true"></i>
 Add New Slider</a></span></li>
                                <li><span><a href="javascript:save('slider');" class="btn btn-success btn-small"><i class="fa fa-sort-amount-asc" aria-hidden="true"></i> Save Sort Order</a></span></li>
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
                                    <div class="clearfix"></div>
                                    
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
									if ($ordtype == "ASC") { $ordtypestr = "DESC"; } else { $ordtypestr = "ASC"; }						  
									$checkstr = "";						  
									if ($ordtype == "ASC") { $ordtypestr = "DESC"; } else { $ordtypestr = "ASC"; }						  
									
									$filterstr = $filter;				
									if ($wholeonly && $filterstr!='') { $filterstr = "" .$filterstr .""; }else{ $filterstr = "%" .$filterstr ."%"; } 
									
									
									$strQry = "SELECT * FROM ".TBL_HEADER." "; 						  
									
									if ($wholeonly && $_SESSION["filterfield"]!='') {
										$strQry .= " WHERE " .$_SESSION["filterfield"] ." LIKE '" .$_SESSION["filter"]."'";
									} else if ($_SESSION["filterfield"]!='') {								
										$strQry .= " WHERE " .$_SESSION["filterfield"] ." LIKE '%" .$_SESSION["filter"]."%'";		
									} else if ($_SESSION["filter"]!='') {
										
										
									}			 
									
									if($order!=''){$strQry .= " ORDER BY `" .$_SESSION["order"]."`";}else{$strQry .= " ORDER BY `intLinkOrder` ";}
									if ($ordtype!=''){$strQry .= " " .$_SESSION["type"];}else{$strQry .= "ASC";}	   
									//echo $strQry;
									
									$showrecs = INCRE;
									$pagerange = LIST_PRTPAGE;
									
									$page = @$_GET["page"];
									if (!isset($page)) $page = 1;
									
									$res = $cnf->sql_select($strQry);
									$count = $cnf->sql_getrecordcount($strQry);
									if ($count % $showrecs != 0) {
										$pagecount = intval($count / $showrecs) + 1;
									}else{
										$pagecount = intval($count / $showrecs);
									}
									$startrec = $showrecs * ($page - 1);
									if ($startrec < $count) {@mysqli_data_seek($res, $startrec);}
									$reccount = min($showrecs * $page, $count);	
									?>
                                    
    
                                    <form action="" method="POST" class="form-horizontal form-bordered" name="frm" onSubmit="return frmAction(frm);">
                                    	<?php
										//$strQry = "SELECT * FROM `".TBL_HEADER."` WHERE header_id=1 ORDER BY `header_id` DESC";
										//$resQry = mysqli_query($con,$strQry);
										if($cnf->records_fetch($strQry) == true) {
										?>
                                            <table class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                    	<th>S.No</th>
                                                        <th><input type="checkbox" name="checkBoxBtn" id="checkBoxBtn" value="1" /></th>
                                                        <th>Image Title(Small)</th>
                                                         <th>Image Title(Big)</th>
                                                        <th>Header Image</th>
                                                        <th><a href="headerslider.php?order=<?php echo "cStatus" ?>&type=<?php echo $ordtypestr ?>&filter=<?php echo $_REQUEST['filter']?>&filterfield=<?php echo $_REQUEST['filterfield']?>&page=<?php echo $_REQUEST["page"];?>">Status</a></th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="row_position">
                                                <?php
												for ($i = $startrec; $i < $reccount; $i++) {
												$rowQry = mysqli_fetch_object($res);
												?>
                                                    <tr class="gradeX" id="<?php echo $rowQry->header_id; ?>">
                                                        <td><?php echo $i+1; ?></td>
                                                        <td><input type="checkbox" name="chk[]" value="<?php echo $rowQry->header_id ?>" <?php  if($_GET["act"]=="CheckAll") { ?> checked <?php } ?> /></td>
                                                      
                                                        <td><?php echo $rowQry->image_title1; ?></td>
                                                        <td><?php echo $rowQry->image_title2; ?></td>
                                                        <td class="center"><img src="uploads/header/<?php echo $rowQry->image_name;?>" style="width:180px; height:60px; border:1px solid #000000;" /></td>
                                                        
                                                        <td class="center"><?php echo $cnf->getActiveImageHide($rowQry->cStatus,'headerslider.php?act=btnActive&id='.$rowQry->header_id)?></td>
                                                        <td class="center">
                                                        	
                                                            <a href="edit_headerslider.php?id=<?php echo $rowQry->header_id.$url_fields ?>" onClick="return confirmMsg(1);" class="text-info" title="Edit"><i class="fa fa-pencil" ></i></a>&nbsp;&nbsp;
                                                            <?php if($_SESSION["intAdminId"] == 1){ ?>
                                                            <a href="headerslider.php?act=delete&id=<?php echo $rowQry->header_id.$url_fields ?>" onClick="return confirmMsg(2);" class="text-danger" title="Delete"><i class="fa fa-trash-o"></i></a>
                                                            <?php } ?>
                                                        </td>
                                                    </tr>
                                                  <?php } ?>                                                     
                                                </tbody>
                                            </table>
                                            
                                            <table class="table table-condensed table-striped">
                                                <tr>
                                                    <td align="left" valign="middle" style="border-right:0;">Items <?php echo $startrec + 1 ?> - <?php echo $reccount ?> of <?php echo $count ?></td>
                                                    <td align="right" valign="middle"><?php  $cnf->showpagenav($page, $pagecount,"headerslider.php?order=".$_REQUEST["order"]."&type=".$_REQUEST["type"]."&filter=".$_SESSION['filter']."&filterfield=".$_SESSION['filterfield']."");?></td>
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
                                                        <a href="headerslider.php?act=<?php echo $strCheck?>" class="text_btm_link"><?php echo $strCheckString?></a>
                                                        </noscript>
                                                    </td>
                                                    <td width="85" align="left" valign="middle">With Select </td>
                                                    <td width="207" align="left" valign="middle">
                                                        <select name="selOptions" class="form-control">
                                                            <option value="allActive">-- Active --</option>
                                                            <option value="deActive">-- InActive --</option>
                                                              <?php if($_SESSION["intAdminId"] == 1){ ?>
                                                            <option value="deleteRec">-- Delete --</option>
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
  <!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
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
        url: 'user_modal.php',
        data: 'id='+id,
        success: function(data) 
        {
            $('#myModal').show();
            $('#modalContent').show().html(data);
        }
    });
});
</script> 
