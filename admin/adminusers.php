<?php include("includes/header.php");

	

	//Status Change

	if($_GET["act"]=="btnActive") {

		$strSqlActive = "select * from ".TBL_ADMIN." where intAdminId=".$_GET["id"];

		if($cnf->records_fetch($strSqlActive)==true) {

			$rs_contents = mysqli_fetch_object($cnf->query_execute($strSqlActive));

		

		if($rs_contents->cStatus=='N') {

			$strActive ='Y';

			$actmsg="active";				

		}else if($rs_contents->cStatus=='Y') {

			$strActive ='N';

			$actmsg="deactive";				

		}							

		

			$strSqlUpdate = "update ".TBL_ADMIN." set `cStatus`='".$strActive."' where intAdminId=".$_GET["id"];

			$cnf->query_execute($strSqlUpdate);							

		

			header("Location:adminusers.php?act=".$actmsg);

		}else{

			header("Location:adminusers.php?act=Invalid");

		}

	}

	

	//Delete Record

	if($_REQUEST['act']== 'delete'){

		$strSql = "DELETE FROM ".TBL_ADMIN." WHERE intAdminId=".$_REQUEST['id']." LIMIT 1";

		$cnf->query_execute($strSql);

		header("Location:adminusers.php?act=deleted");

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

				$strSqlDelete = "DELETE FROM ".TBL_ADMIN." WHERE intAdminId=".$_POST["chk"][$intI];

				$cnf->query_execute($strSqlDelete);																		

			}else{

				$strSqlUpdateOptions = "UPDATE ".TBL_ADMIN." SET ".$strString." WHERE intAdminId=".$_POST["chk"][$intI]; }

				$cnf->query_execute($strSqlUpdateOptions);

		}

				

	if($selOptions !="deleteRec") {

			$strString = "".$actmsg; }

		else {

			$strString = "deleted"; }

			header("Location:adminusers.php?act=".$strString);

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

						<h2>Admin Users - List</h2>

                        <div class="right-wrapper pull-right">

							<ol class="breadcrumbs">

								<li>

									<a href="dashboard.php">

										<i class="fa fa-home"></i>

									</a>

								</li>

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

                                     <div class="navadminbtn pull-right">

                                    	 <a href="addadminuser.php"><button class="btn btn-success" style="margin-bottom:10px;">Add Admin User</button></a>

                                    </div>

                                    <div class="clearfix"></div>

                                        <form action="" method="POST" class="form-horizontal form-bordered" name="frm" onSubmit="return frmAction(frm);">

                                            <?php

                                            $strQry = "SELECT * FROM `".TBL_ADMIN."` ORDER BY `intAdminId` DESC";

                                            $resQry = mysqli_query($con,$strQry);

                                            if($cnf->records_fetch($strQry) == true) {

                                            ?>

                                                <table class="table table-bordered table-striped mb-none" id="datatable-default">

                                                    <thead>

                                                        <tr>

                                                            <th>S.No</th>

                                                            <th>Name</th>

                                                            <th>Username</th>

                                                            <th class="hidden-phone">Type</th>

                                                            <th class="hidden-phone">Date</th>

                                                            <th class="hidden-phone">Last Login</th>

                                                            <th class="hidden-phone">Status</th>

                                                            <th class="hidden-phone">Action</th>

                                                        </tr>

                                                    </thead>

                                                    <tbody>

                                                    <?php

                                                    $i=1;

                                                        while($rowQry = mysqli_fetch_object($resQry)){

                                                    ?>

                                                        <tr class="gradeX">

                                                            <td><?php echo $i; ?></td>

                                                            <td><?php echo $rowQry->txtName; ?></td>

                                                            <td><?php echo $rowQry->vUsername; ?></td>

                                                            <td><?php echo $cnf->showAdminType($rowQry->userType); ?></td>

                                                            <td class="center"><?php echo $cnf->convetdate($rowQry->dtCreated); ?></td>

                                                            <td class="center"><?php echo $rowQry->lastLogin; ?></td>

                                                            <td class="center"><?php echo $cnf->getActiveImageHide($rowQry->cStatus,'adminusers.php?act=btnActive&id='.$rowQry->intAdminId)?></td>

                                                            <td class="center">

                                                                <a href="detail_adminuser.php?id=<?php echo $rowQry->intAdminId ?>" class="text-active" style="color:#000" title="View"><i class="fa fa fa-eye"></i></a>&nbsp;&nbsp;

                                                                <a href="edit_adminuser.php?id=<?php echo $rowQry->intAdminId ?>" onClick="return confirmMsg(1);" class="text-info" title="Edit"><i class="fa fa-pencil" ></i></a>&nbsp;&nbsp;

                                                             <?php if($rowQry->intAdminId != 1){ ?>

                                                                <a href="adminusers.php?act=delete&id=<?php echo $rowQry->intAdminId ?>" onClick="return confirmMsg(2);" class="text-danger" title="Delete"><i class="fa fa-trash-o"></i></a>

                                                            <?php } ?>

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

