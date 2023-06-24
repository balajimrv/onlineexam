<?php include("includes/header.php");

if ($_REQUEST["page"]=="")
	$_REQUEST["page"]=1;
	
	$url_fields = "&order=".$_REQUEST["order"]."&type=".$_REQUEST["type"]."&filter=".$_SESSION['filter']."&filterfield=".$_SESSION['filterfield']."&page=".$_REQUEST["page"];
	
	############# Active #############
				if($_GET["act"]=="btnActive") {
					$strSqlActive = "select * from ".TBL_MAILER." where mailer_id=".$_GET["id"];
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
							
						$strSqlUpdate = "update ".TBL_MAILER." set `cStatus`='".$strActive."' where intBookId=".$_GET["id"];
						$cnf->query_execute($strSqlUpdate);						
						
						header("Location:mailer.php?act=".$actmsg.$url_fields);
						} else {
						header("Location:mailer.php?act=Invalid".$url_fields);
					}
				}		
				if($_POST["btnSubmit"]!="") {				
				$selOptions = $_POST["selOptions"];				
					
					if($selOptions=="InActive") {
						$strString = "`cStatus`='Y'"; 
						$actmsg="show";
						}
					
					if($selOptions=="BanActive") {
						$strString = "`cStatus`='N'"; 
						$actmsg="deactive";
						}					
								
					
					$IntCount = count($_POST["chk"]) - 1;
					for($intI=0;$intI<=$IntCount;$intI++) {
						if($selOptions=="Delete") {
						
						$strSqlDelete = "delete from ".TBL_MAILER." where mailer_id=".$_POST["chk"][$intI];
						$cnf->query_execute($strSqlDelete);
						
						$strSql = "delete from ".TBL_MAILERCONT." where pages_id=".$_POST["chk"][$intI];
						$res = mysqli_query($con,$strSql);																			
						
						} else {
						$strSqlUpdateOptions = "update ".TBL_MAILER." set ".$strString." where mailer_id=".$_POST["chk"][$intI]; }
						$cnf->query_execute($strSqlUpdateOptions);	
											
					}
					
					if($selOptions!="Delete") {		
					
					if ($_REQUEST["page"]=="")
						$_REQUEST["page"]=1;			
							
						$strString = "".$actmsg."&order=".$_REQUEST["order"]."&type=".$_REQUEST["type"]."&filter=".$_SESSION['filter']."&filterfield=".$_SESSION['filterfield']."&page=".$_REQUEST["page"]; }
						else {
						$strString = "Deleted&order=".$_REQUEST["order"]."&type=".$_REQUEST["type"]."&filter=".$_SESSION['filter']."&filterfield=".$_SESSION['filterfield']."&page=".$_REQUEST["page"]; }
					
					header("Location:pages.php?act=".$strString."&rec=mul");
				}				
				
				
				if($_GET["act"]=="Updated") {									
					$strMsg = "Records has been updated successfully"; 
					echo $cnf->HideMsg(); }
					
				if($_GET["act"]=="Added") {
					$strMsg = Inserted_RECORDS;
					echo $cnf->HideMsg(); }
					
				if($_GET["act"]=="Exists") {
					$strMsg = Records_exists;
					echo $cnf->HideMsg(); }	
					
				if($_GET["act"]=="Deleted") {
					$strMsg = Deleted_RECORDS;
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
					$strMsg = 'This pages are activated successfully';
					echo $cnf->HideMsg(); 
				}	
				if($_GET["act"]=="deactive" && $_REQUEST['rec'] == 'mul') {									
					$strMsg = 'This pages are deactivated successfully';
					echo $cnf->HideMsg(); 
				}	
					
					
				if($_GET["act"]=="active" && $_REQUEST['rec'] != 'mul') {									
					$strMsg = "This page activated successfully."; 
					echo $cnf->HideMsg(); }
					
				if($_GET["act"]=="deactive" && $_REQUEST['rec'] != 'mul') {									
					$strMsg = "This page deactivated successfully."; 
					echo $cnf->HideMsg(); }
					
		
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
							
						  						  						  
						   $strSqlSelect = "SELECT `mailer_id`, `mailer_title` FROM ".TBL_MAILER." "; 						  
						  						  					   
						    if ($wholeonly && $_SESSION["filterfield"]!='') {
							$strSqlSelect .= " where " .$_SESSION["filterfield"] ." like '" .$_SESSION["filter"]."'";
							} else if ($_SESSION["filterfield"]!='') {								
							$strSqlSelect .= " where " .$_SESSION["filterfield"] ." like '%" .$_SESSION["filter"]."%'";		
						  } else if ($_SESSION["filter"]!='') {
							
						$strSqlSelect .= "where (`mailer_title` like '" .$filterstr ."') ";	
						 }			 
						  
						  if($order!=''){$strSqlSelect .= " order by `" .$_SESSION["order"]."`";}else{$strSqlSelect .= " order by `mailer_id` ";}
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

						<h2>Mailer Template</h2>

					

						<div class="right-wrapper pull-right">

							<ol class="breadcrumbs">

								<li>

									<a href="dashboard.php">

										<i class="fa fa-home"></i>

									</a>

								</li>

								<!--<li><span><a href="addnotification.php">Add Category</a></span></li>-->

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

                                    <form action="" method="POST" class="form-horizontal form-bordered" name="frm" onSubmit="return frmAction(frm);">

                                    <?php

										$strQry = "SELECT * FROM `".TBL_MAILER."` ORDER BY `mailer_id` ASC";

										$resQry = mysqli_query($con,$strQry);

										if($cnf->records_fetch($strQry) == true) {

										?>
                                            <table class="table table-bordered table-striped mb-none" id="datatable-default">

                                                <thead>

                                                    <tr>

                                                    	<th>S.No</th>

                                                        <th>Mailer Name</th>
                                                        <th>Panel</th>
														<th class="hidden-phone">Action</th>
                                                    </tr>

                                                </thead>

                                                <tbody>

                                              <?php

												$i=1;

													while($rowQry = mysqli_fetch_object($resQry)){

												?>

                                                    <tr class="gradeX">

                                                        <td><?php echo $i?></td>

                                                        

                                                        <td><?php echo $rowQry->mailer_title; ?></td>
														<td class="text-center"><?php echo $rowQry->panel; ?></td>
                                                        
                                                        <td class="center">

                                                        	
                                                            <a href="edit_mailer.php?id=<?php echo $rowQry->mailer_id.$url_fields ?>" onClick="return confirmMsg(1);" class="text-info" title="Edit"><i class="fa fa-pencil" ></i></a>
                                                           
                                                        </td>

                                                    </tr>
  													<?php $i++; } ?>      
                                                                                            

                                                </tbody>

                                            </table>

                                            

                                                   
                                        <?php 

										}else{ echo "<p style='color:#FF0000;'>Sorry no records found!</p>"; } ?>

                                                                               
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

