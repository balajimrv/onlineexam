<?php include("includes/header.php");

	

	if ($_REQUEST["page"]=="")

	$_REQUEST["page"]=1;

	

	$url_fields = "&order=".$_REQUEST["order"]."&type=".$_REQUEST["type"]."&filter=".$_SESSION['filter']."&filterfield=".$_SESSION['filterfield']."&page=".$_REQUEST["page"];

	

	

	//Delete Record

	if($_REQUEST['act']== 'delete'){

		$strSql = "DELETE FROM ".TBL_LOGIN_AUDIT." WHERE login_id=".$_REQUEST['id']." LIMIT 1";

		$cnf->query_execute($strSql);

		header("Location:login_audit.php?act=deleted".$url_fields);

	}

	

	if($_POST["btnSubmit"]!="") {				

		$selOptions = $_POST["selOptions"];

			

		$IntCount = count($_POST["chk"])  - 1;

		for($intI=0;$intI<=$IntCount;$intI++) {

			if($selOptions=="deleteRec") {

				$strSqlDelete = "DELETE FROM ".TBL_LOGIN_AUDIT." WHERE login_id=".$_POST["chk"][$intI];

				$cnf->query_execute($strSqlDelete);																		

				$cnf->query_execute($strSqlUpdateOptions);

		}

	}

				

	if($selOptions !="deleteRec") {

			$strString = "".$actmsg; }

		else {

			$strString = "deleted"; }

			header("Location:login_audit.php?act=".$strString.$url_fields);

	}

			

	if($_GET["act"]=="deleted") {

		$strMsg = "Records has been deleted successfully!";

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

						<h2>User - Login Audit</h2>

					

						<div class="right-wrapper pull-right">

							<ol class="breadcrumbs">

								<li>

									<a href="dashboard.php">

										<i class="fa fa-home"></i>

									</a>

								</li>

								<!--<li><span><a href="addlogin_audit.php">Add User</a></span></li>-->

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

																		

									$strQry = "SELECT la.*, us.first_name, us.email 

										FROM `".TBL_LOGIN_AUDIT."` AS la 

										LEFT JOIN ".TBL_USERS." AS us ON (la.`user_id` = us.`user_id`) ";					  

									

									if ($wholeonly && $_SESSION["filterfield"]!='') {

										$strQry .= " WHERE " .$_SESSION["filterfield"] ." LIKE '" .$_SESSION["filter"]."'";

									} else if ($_SESSION["filterfield"]!='') {								

										$strQry .= " WHERE " .$_SESSION["filterfield"] ." LIKE '%" .$_SESSION["filter"]."%'";		

									} else if ($_SESSION["filter"]!='') {

										$strQry .= "WHERE (us.`first_name` LIKE '" .$filterstr ."') OR (`email` LIKE '" .$filterstr ."')";

									}			 

									

									if($order!=''){$strQry .= " ORDER BY `" .$_SESSION["order"]."`";}else{$strQry .= " ORDER BY la.`login_id` ";}

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

									if ($startrec < $count) {mysqli_data_seek($res, $startrec);}

									$reccount = min($showrecs * $page, $count);

									if($cnf->records_fetch($strQry) == true) {

									?>

                                    <form action="login_audit.php" method="post">

                                        <table class="table table-bordered table-striped" width="100%" border="0" cellspacing="0" cellpadding="0" >

                                            <tr>

                                                <td align="center" valign="middle"><b>FILTER</b> :

                                                    <input type="text" name="filter" id="filter" class="input-sm" value="<?php echo $filter ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                                    By Location Status&nbsp;&nbsp;

                                                    <select name="filterfield" class="input-sm">

                                                    <option value="">All Fields</option>

                                                    <option value="<?php echo "first_name" ?>"<?php if ($filterfield == "first_name") { echo "selected"; } ?>><?php echo htmlspecialchars("Name") ?></option>
                                                    <option value="<?php echo "email" ?>"<?php if ($filterfield == "email") { echo "selected"; } ?>><?php echo htmlspecialchars("Email") ?></option>

                                                    </select>

                                                    &nbsp;&nbsp;&nbsp;Whole words only

                                                    <input type="checkbox" name="wholeonly"<?php echo $checkstr ?> />

                                                    <label>

                                                    <input type="submit" name="Submit" value="Find" class="btn btn-info btn-sm" onClick="return btncustomfilter();">

                                                    </label>

                                                &nbsp;<a href="login_audit.php?a=reset" class="btn btn-link">Reset List</a>

                                                </td>

                                            </tr>

                                        </table>

      								</form>

                                    <?php } ?>   

                                    <form action="" method="POST" class="form-horizontal form-bordered" name="frm" onSubmit="return frmAction(frm);">

                                    	<?php

										//$strQry = "SELECT * FROM `".TBL_LOGIN_AUDIT."` WHERE login_id=1 ORDER BY `login_id` DESC";

										//$resQry = mysqli_query($con,$strQry);

										if($cnf->records_fetch($strQry) == true) {

										?>

                                            <table class="table table-bordered table-striped">

                                                <thead>

                                                    <tr>

                                                    	<th>S.No</th>

                                                        <th><input type="checkbox" name="checkBoxBtn" id="checkBoxBtn" value="1" /></th>
                                                        
                                                        <th>Full Name</th>
                                                        
                                                        <th>Email</th>

                                                        <th>Last Login</th>

                                                        <th>Logout</th>

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

                                                        <td align="center"><input type="checkbox" name="chk[]" value="<?php echo $rowQry->login_id ?>" <?php  if($_GET["act"]=="CheckAll") { ?> checked <?php } ?> /></td>

                                                        <td><?php echo $rowQry->first_name; ?></td>

                                                        <td><?php echo $rowQry->email; ?></td>

                                                        <td align="center"><?php echo $rowQry->login; ?></td>

                                                        <td align="center"><?php echo $rowQry->logout; ?></td>

                                                        

                                                        <td class="center">

                                                        <?php if($_SESSION["intAdminId"] == 1){ ?>

                                                            <a href="login_audit.php?act=delete&id=<?php echo $rowQry->login_id.$url_fields ?>" onClick="return confirmMsg(2);" class="text-danger" title="Delete"><i class="fa fa-trash-o"></i></a>

                                                        <?php } ?>

                                                        </td>

                                                    </tr>

                                                  <?php } ?>                                                     

                                                </tbody>

                                            </table>

                                            

                                            <table class="table table-condensed table-striped">

                                                <tr>

                                                    <td align="left" valign="middle" style="border-right:0;">Items <?php echo $startrec + 1 ?> - <?php echo $reccount ?> of <?php echo $count ?></td>

                                                    <td align="right" valign="middle"><?php  $cnf->showpagenav($page, $pagecount,"login_audit.php?order=".$_REQUEST["order"]."&type=".$_REQUEST["type"]."&filter=".$_SESSION['filter']."&filterfield=".$_SESSION['filterfield']."");?></td>

                                                </tr>

                                            </table>

                                            

                                        <?php 

										}else{ echo "<p style='color:#FF0000;'>Sorry no records found!</p>"; } ?>

                                        

                                        <?php if($cnf->records_fetch($strQry)==true) {?>

                                         <?php if($_SESSION["intAdminId"] == 1){ ?>                         

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

                                                        <a href="login_audit.php?act=<?php echo $strCheck?>" class="text_btm_link"><?php echo $strCheckString?></a>

                                                        </noscript>

                                                    </td>

                                                    <td width="85" align="left" valign="middle">With Select </td>

                                                    <td width="207" align="left" valign="middle">

                                                        <select name="selOptions" class="form-control">

                                                            <option value="deleteRec">-- Delete --</option>

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

                                            

                                        <?php 

										 }

											} ?>

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