<?php include("includes/header.php");
	
	if ($_REQUEST["page"]=="")
	$_REQUEST["page"]=1;
	
	$url_fields = "&order=".$_REQUEST["order"]."&type=".$_REQUEST["type"]."&filter=".$_SESSION['filter']."&filterfield=".$_SESSION['filterfield']."&page=".$_REQUEST["page"];
	
	//Status Change
	if($_GET["act"]=="btnActive") {
		$strSqlActive = "select * from ".TBL_ORDER." where intOrd_id=".$_GET["id"];
		if($cnf->records_fetch($strSqlActive)==true) {
			$rs_contents = mysqli_fetch_object($cnf->query_execute($strSqlActive));
		
		if($rs_contents->cStatus=='N') {
			$strActive ='Y';
			$actmsg="active";				
		}else if($rs_contents->cStatus=='Y') {
			$strActive ='N';
			$actmsg="deactive";				
		}							
		
			$strSqlUpdate = "update ".TBL_ORDER." set `cStatus`='".$strActive."' where intOrd_id=".$_GET["id"];
			$cnf->query_execute($strSqlUpdate);							
		
			header("Location:cancel_orders.php?act=".$actmsg.$url_fields);
		}else{
			header("Location:cancel_orders.php?act=Invalid".$url_fields);
		}
	}
	
	//Delete Record
	if($_REQUEST['act']== 'delete'){
		$strSql = "DELETE FROM ".TBL_ORDER." WHERE intOrd_id=".$_REQUEST['id']." LIMIT 1";
		$cnf->query_execute($strSql);
		header("Location:cancel_orders.php?act=deleted".$url_fields);
	}
	
	if($_REQUEST['act'] == 'Mail' && $_REQUEST['ID'] != "" && $_REQUEST['UID'] != ""){
				$strSqlUser = "select * from ".TBL_USERS." where intUserId='".$_REQUEST['UID']."'";
				$resUser = mysqli_query($con,$strSqlUser);
				$rowsUser = mysqli_fetch_object($resUser);
				
				$strSqlOrder = "select * from ".TBL_ORDER." where intUser_id='".$_REQUEST['UID']."' and intOrd_id='".$_REQUEST['ID']."'";
				$resOrder = mysqli_query($con,$strSqlOrder);
				$rowsOrder = mysqli_fetch_object($resOrder);
				
				$strSqls = "SELECT a.*,b.* from ".TBL_ORDER_ITEM." as a inner join ".TBL_BOOKS." as b on a.intPro_id=b.intBookId where a.intOrd_id=".$_REQUEST["ID"];
								
				$sendmail 	= $rowsOrder->vOrd_payment_Email; //to mail
				$subject = "Books Order Shipped Confirmation!"; //subject
				$siteurl_link = SITE_URL;
				//message
				$message='<table width="600" border="0" align="left" cellspacing="0" cellpadding="0" style="border:1px solid #83ccf6;">
				<tr>
					<td>
					<img src="'.SITE_URL.'/adminpanel/images/email_header.jpg" style="width:600px; height:100px;"></td>
					</td>
				</tr>
				<tr>
				<td style="padding:15px;">
				Welcome, SPH Invite your recent <strong>Order No : '.$rowsOrder->vOrder_number.'</strong><br><br>
				
				Hello <strong>MR. '.$rowsOrder->vbill_first_name.' '.$rowsOrder->vbill_last_name.'</strong>,<br/><br />
				
						This is to inform you that Sakthi’s <strong>';
						if($cnf->records_fetch($strSqls)==true) {
							$res= $cnf->query_execute($strSqls);
							while($rows2 = mysqli_fetch_object($res)){
								if($rows2->intDiscount == 0){
									$pro_price = $rows2->deBookPrice;
								}else{
									$pro_price = $cnf->calculate_discount($rows2->deBookPrice, $rows2->intDiscount);
								}
								$message .= $rows2->vBookName.' &nbsp;'.$rows2->intItem_qty.' No. Rs.'.$rows2->intItem_qty * $pro_price.'/-, ';
							}
						}
						$message .='</strong> Value of Book has been sent through '.$rowsOrder->courier_name.' on <strong>'.date("d-m-Y", strtotime($rowsOrder->dispatched_date)).'</strong>.<br />
<strong>Courier No : '.$rowsOrder->couriern_no.'</strong><br><br>Kindly Acknowledge.<br />
<br />
				
				'.nl2br(EMAIL_SIGNATURE).'</td>
				</tr>
				</table>';		
				
												
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers .= "From: Sakthi Books <".EMAIL_FROM_ADDR."> \r\n";
				
				$res = mail($sendmail, $subject, $message, $headers);
								
				if($res){
					$strSqlUpdate = "update ".TBL_ORDER." set `email_sent`='Y' where intOrd_id=".$_REQUEST["ID"];
					$cnf->query_execute($strSqlUpdate);
					header("Location:cancel_orders.php?act=Send");
				}
				else{
					header("Location:cancel_orders.php?act=Sendfail");
				}
			}
	
	if($_GET["act"]=="Updated") {									
					$strMsg = "Records has been updated successfully.";
					echo $cnf->HideMsg(); }
					
				if($_GET["act"]=="Added") {
					$strMsg = Inserted_RECORDS;
					echo $cnf->HideMsg(); }
					
				if($_GET["act"]=="Exists") {
					$strMsg = Records_exists;
					echo $cnf->HideMsg(); }	
					
				if($_GET["act"]=="Deleted") {
					$strMsg = "Records has been deleted successfully.";
					echo $cnf->HideMsg(); }
					
				if($_GET["act"]=="active") {									
					$strMsg = Active_Article; 
					echo $cnf->HideMsg(); }
					
				
					
			if($_GET["act"]=="Send") {
			$strMsg = "Your email has been sent successfully!";
			echo $cnf->HideMsg(); 
			}			
		
			if($_GET["act"]=="Sendfail") {
			$strMsg = "Mail failed to sent!";
			echo $cnf->HideMsg(); 
			}	
				
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
						<h2>Cancel / Return Orders - List</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="dashboard.php">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<!--<li><span><a href="addcancel_orders.php">Add User</a></span></li>-->
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
									if ($ordtype == "ASC") { $ordtypestr = "DESC"; } else { $ordtypestr = "ASC"; }						  
									$checkstr = "";						  
									if ($ordtype == "ASC") { $ordtypestr = "DESC"; } else { $ordtypestr = "ASC"; }						  
									
									$filterstr = $filter;				
									if ($wholeonly && $filterstr!='') { $filterstr = "" .$filterstr .""; }else{ $filterstr = "%" .$filterstr ."%"; } 									

									
									 $strQry = "SELECT * FROM ".TBL_ORDER." WHERE numOrd_status IN ('Customer Not Responding','Customer Requested to Cancel','Wrong Item Dispatched','Wrong Item Ordered','Not Interested','Other Reason') ";				  
									
									if ($wholeonly && $_SESSION["filterfield"]!='') {
										$strQry .= " AND " .$_SESSION["filterfield"] ." LIKE '" .$_SESSION["filter"]."'";
									} else if ($_SESSION["filterfield"]!='') {								
										$strQry .= " AND " .$_SESSION["filterfield"] ." LIKE '%" .$_SESSION["filter"]."%'";		
									} else if ($_SESSION["filter"]!='') {
										
										$strQry .= " AND ((`vOrder_number` like '" .$filterstr ."') or (`payment_type` like '" .$filterstr ."') or (`vbill_first_name` like '" .$filterstr ."') or (`numOrd_status` like '" .$filterstr ."') or (`vbill_last_name` like '" .$filterstr ."')) ";
									}			 
									
									if($order!=''){$strQry .= " ORDER BY `" .$_SESSION["order"]."`";}else{$strQry .= " ORDER BY `intOrd_id` ";}
									if ($ordtype!=''){$strQry .= " " .$_SESSION["type"];}else{$strQry .= "DESC";} 
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
                                    
                                    <form action="cancel_orders.php" method="post">
                                        <table class="table table-bordered table-striped" width="100%" border="0" cellspacing="0" cellpadding="0" >
                                            <tr>
                                                <td align="center" valign="middle"><b>FILTER</b> :
                                                    <input type="text" name="filter" id="filter" class="input-sm" value="<?php echo $filter ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    By Location Status&nbsp;&nbsp;
                                                    <select name="filterfield" class="input-sm">
                                                    <option value="">All Fields</option>
                                                    <option value="<?php echo "vOrder_number" ?>"<?php if ($filterfield == "vOrder_number") { echo "selected"; } ?>><?php echo htmlspecialchars("Order Number") ?></option>
								  <option value="<?php echo "vbill_first_name" ?>"<?php if ($filterfield == "vbill_first_name") { echo "selected"; } ?>><?php echo htmlspecialchars("Name") ?></option>
								  <option value="<?php echo "numOrd_status" ?>"<?php if ($filterfield == "numOrd_status") { echo "selected"; } ?>><?php echo htmlspecialchars("Status") ?></option>
                                                    </select>
                                                    &nbsp;&nbsp;&nbsp;Whole words only
                                                    <input type="checkbox" name="wholeonly"<?php echo $checkstr ?> />
                                                    <label>
                                                    <input type="submit" name="Submit" value="Find" class="btn btn-info btn-sm" onClick="return btncustomfilter();">
                                                    </label>
                                                &nbsp;<a href="cancel_orders.php?a=reset" class="btn btn-link">Reset List</a>
                                                </td>
                                            </tr>
                                        </table>
      								</form>
                                    
    
                                    <form action="cancel_orders.php" method="POST" class="form-horizontal form-bordered" id="actionfrm" name="frm" onSubmit="return frmAction(frm);">
                                    	<?php
										//$strQry = "SELECT * FROM `".TBL_ORDER."` WHERE intOrd_id=1 ORDER BY `intOrd_id` DESC";
										//$resQry = mysqli_query($con,$strQry);
										if($cnf->records_fetch($strQry) == true) {
										?>
                                            <table class="table table-bordered table-striped">
                                                <thead>
                                                   			  
			   <th>S.No</th>
                     
                      <th><a href="cancel_orders.php?order=<?php echo "vOrder_number" ?>&type=<?php echo $ordtypestr ?>&filter=<?php echo $_REQUEST['filter']?>&filterfield=<?php echo $_REQUEST['filterfield']?>&page=<?php echo $_REQUEST["page"];?>">Order Number</a></th>
					  <th><a href="cancel_orders.php?order=<?php echo "vbill_first_name" ?>&type=<?php echo $ordtypestr ?>&filter=<?php echo $_REQUEST['filter']?>&filterfield=<?php echo $_REQUEST['filterfield']?>&page=<?php echo $_REQUEST["page"];?>">Name</a></th>
					  
					  <th><a href="cancel_orders.php?order=<?php echo "deOrd_total" ?>&type=<?php echo $ordtypestr ?>&filter=<?php echo $_REQUEST['filter']?>&filterfield=<?php echo $_REQUEST['filterfield']?>&page=<?php echo $_REQUEST["page"];?>">Total</a></th>
                      <th><a href="cancel_orders.php?order=<?php echo "payment_type" ?>&type=<?php echo $ordtypestr ?>&filter=<?php echo $_REQUEST['filter']?>&filterfield=<?php echo $_REQUEST['filterfield']?>&page=<?php echo $_REQUEST["page"];?>">Mode</a></th>
					  <th><a href="cancel_orders.php?order=<?php echo "numOrd_status" ?>&type=<?php echo $ordtypestr ?>&filter=<?php echo $_REQUEST['filter']?>&filterfield=<?php echo $_REQUEST['filterfield']?>&page=<?php echo $_REQUEST["page"];?>">Status</a></th>
					                        
                     <th>Order Date</th>
					   
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
                   
                   
                   <td align="center">
                   
                   <a href="#" data-toggle="modal" data-target="#myModal" id=<?php echo $rowQry->intOrd_id; ?>><?php echo $rowQry->vOrder_number; ?></a></td>
                    <td><?php echo $rowQry->vbill_first_name; ?></td>
                    <td align="center"><?php echo "Rs. ".$cnf->displayAmount($rowQry->deOrd_total);?></td>
                    <td align="center"><?php echo $rowQry->payment_type; ?></td>
                    <td align="center"><?php echo $rowQry->numOrd_status; ?></td>                    
                    <td align="center"><?php echo $cnf->convetdate($rowQry->dtOrd_date);?></td>
                    
                    <td class="center">
                    
                    <a href="#" onClick="MM_openBrWindow('print.php?OID=<?php echo $rowQry->intOrd_id?>&UID=<?php echo $rowQry->intUser_id?>','print','scrollbars=yes,width=800,height=520')" title="Print">
                    <i class="fa fa-print" ></i>
                    </a>                    
                  
                    </td>
                </tr>
                                                  <?php } ?>                                                     
                                                </tbody>
                                            </table>
                                            
                                            <table class="table table-condensed table-striped">
                                                <tr>
                                                    <td align="left" valign="middle" style="border-right:0;">Items <?php echo $startrec + 1 ?> - <?php echo $reccount ?> of <?php echo $count ?></td>
                                                    <td align="right" valign="middle"><?php  $cnf->showpagenav($page, $pagecount,"cancel_orders.php?order=".$_REQUEST["order"]."&type=".$_REQUEST["type"]."&filter=".$_SESSION['filter']."&filterfield=".$_SESSION['filterfield']."");?></td>
                                                </tr>
                                            </table>
                                            
                                        <?php 
										}else{ echo "<p style='color:#FF0000;'>Sorry no records found!</p>"; } ?>
                                        
                                        <?php if($cnf->records_fetch($strQry)==true) {?>                            
                                            
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
 
 

<!--<div class="modal fade" id="despatchUpload" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Upload Bulk Despatch Detail</h4>
            </div>
            
            
            <div class="modal-body">
                <p class="statusMsg"></p>
                <form role="form" action="" id="uploadFrmCsv" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="inputName">Choose your CSV File</label>
                        <input type="file" name="csv" id="uploadCsv" value="" />
                    </div>
                </form>
            </div>
            
            
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary submitBtn" onclick="submitDespatchDetail()">SUBMIT</button>
            </div>
        </div>
    </div>
</div>-->

  <!-- Modal -->
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
$("a[data-target='#myModal']").click(function() 
{   
    var id = $(this).attr('id');

    $.ajax({
        cache: false,
        type: 'POST',
        url: 'order_modal.php',
        data: 'id='+id,
        success: function(data) 
        {
            $('#myModal').show();
            $('#modalContent').show().html(data);
        }
    });
});

/*$("a[data-target='#despatchUpload']").click(function(){   
	$('.statusMsg').html('');          
	$('.submitBtn').removeAttr("disabled");
	$('.modal-body').css('opacity', '');
});
*/	
</script>

<?php
	   		if(isset($_POST["iconSubmit"])){
				if($_POST["iconSubmit"] == "labels") {
					$link = "<script>window.open('label.php?".http_build_query($_POST["chk"])."')</script>";
					echo $link;
					exit;
				}
				
				if($_POST["iconSubmit"] == "address") {
					$link = "<script>window.open('customer_address.php?".http_build_query($_POST["chk"])."')</script>";
					echo $link;
					exit;
				}
				
				if($_POST["iconSubmit"] == "details") {
					$link = "<script>window.open('order_details.php?".http_build_query($_POST["chk"])."', 'width=710,height=555,left=160,top=170')</script>";
					echo $link;
					exit;
				}
			}
			
            if(isset($_POST["selOptions"])) {
				
						
				
				$selOptions = $_POST["selOptions"];
				
				
				if($_POST["selOptions"] == "addressDownload") {
					$link = "<script>window.open('customer_address.php?".http_build_query($_POST["chk"])."')</script>";
					echo $link;
					exit;
				}
				
				if($_POST["selOptions"] == "labelsDownload") {
					$link = "<script>window.open('label.php?".http_build_query($_POST["chk"])."')</script>";
					echo $link;
					exit;
				}
				
				if($_POST["selOptions"] == "orderDetails") {
					$link = "<script>window.open('order_details.php?".http_build_query($_POST["chk"])."', 'width=710,height=555,left=160,top=170')</script>";
					echo $link;
					exit;
				}
				
					if($selOptions=="InActive") {
						$strString = "`bitUserStatus`='1'"; 
						$actmsg="show";
						}
					
					if($selOptions=="BanActive") {
						$strString = "`bitUserStatus`='0'"; 
						$actmsg="hide";
						}
					
					
					$IntCount = count($_POST["chk"]) - 1;
					for($intI=0;$intI<=$IntCount;$intI++) {
						if($selOptions=="Delete") {
						
						$strSqlDelete = "delete from ".TBL_ORDER." where intOrd_id=".$_POST["chk"][$intI];
						$cnf->query_execute($strSqlDelete);
						
						$strSql = "delete from ".TBL_ORDER." where intOrd_id=".$_POST["chk"][$intI];
						$cnf->query_execute($strSql);
						
						$strSqlDelete1 = "delete from ".TBL_ORDER_ITEM." where intOrd_id=".$_POST["chk"][$intI];
						$cnf->query_execute($strSqlDelete1);
																			
						
						} else {
						$strSqlUpdateOptions = "update ".TBL_ORDER." set ".$strString." where intOrd_id=".$_POST["chk"][$intI]; }
						$cnf->query_execute($strSqlUpdateOptions);	
											
					}
		
					
					
					if($selOptions!="Delete") {		
					
					if ($_REQUEST["page"]=="")
						$_REQUEST["page"]=1;			
							
						$strString = "".$actmsg."&page=".$_REQUEST["page"]; }
						else {
						$strString = "Deleted&page=".$_REQUEST["page"]; }
					
					header("Location:cancel_orders.php?act=".$strString);
				
			
			}
			
			
			?> 
