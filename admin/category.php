<?php include("includes/header.php");

	
if ($_REQUEST["page"]=="")
	$_REQUEST["page"]=1;
	
	$url_fields = "&order=".$_REQUEST["order"]."&type=".$_REQUEST["type"]."&filter=".$_SESSION['filter']."&filterfield=".$_SESSION['filterfield']."&page=".$_REQUEST["page"];
	
	############# Active #############
				if($_GET["act"]=="btnActive") {
					$strSqlActive = "select * from ".TBL_CATEGORY." where intCat_id=".$_GET["id"];
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
							
						$strSqlUpdate = "update ".TBL_CATEGORY." set `cStatus`='".$strActive."' where intCat_id=".$_GET["id"];
						$cnf->query_execute($strSqlUpdate);						
						
						header("Location:category.php?act=".$actmsg.$url_fields);
						} else {
						header("Location:category.php?act=Invalid".$url_fields);
					}
				}		
				
	//Status Change

	
	

	//Delete Record

	if($_REQUEST['act']== 'delete'){
		
		$sql = "SELECT logo_image FROM `".TBL_CATEGORY."` WHERE intCat_id=".$_GET["id"];
		$res = mysqli_query($con, $sql);
		$row = mysqli_fetch_object($res);
		@unlink("uploads/logo/".$row->logo_image);

		$strSql = "DELETE FROM ".TBL_CATEGORY." where intCat_id=".$_GET["id"];

		$cnf->query_execute($strSql);

		header("Location:category.php?act=deleted");

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
							
						
							
						$strSqlDelete = "delete from ".TBL_CATEGORY." where intSubCatId !=0 AND intCat_id=".$_POST["chk"][$intI];
						
						$cnf->query_execute($strSqlDelete);						
						
						} else {
						$strSqlUpdateOptions = "update ".TBL_CATEGORY." set ".$strString." where intCat_id=".$_POST["chk"][$intI]; 
						
						}
						$cnf->query_execute($strSqlUpdateOptions);	
					}
					
					if($selOptions!="Delete") {		
					
					if ($_REQUEST["page"]=="")
						$_REQUEST["page"]=1;			
							
						$strString = "".$actmsg."&order=".$_REQUEST["order"]."&type=".$_REQUEST["type"]."&filter=".$_SESSION['filter']."&filterfield=".$_SESSION['filterfield']."&page=".$_REQUEST["page"]; }
						else {
						$strString = "Deleted&order=".$_REQUEST["order"]."&type=".$_REQUEST["type"]."&filter=".$_SESSION['filter']."&filterfield=".$_SESSION['filterfield']."&page=".$_REQUEST["page"]; }
					
					header("Location:category.php?act=".$strString."&rec=mul");
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
					$strMsg = 'This categorys are activated successfully';
					echo $cnf->HideMsg(); 
				}	
				if($_GET["act"]=="deactive" && $_REQUEST['rec'] == 'mul') {									
					$strMsg = 'This categorys are deactivated successfully';
					echo $cnf->HideMsg(); 
				}	
					
					
				if($_GET["act"]=="active" && $_REQUEST['rec'] != 'mul') {									
					$strMsg = "This category activated successfully."; 
					echo $cnf->HideMsg(); }
					
				if($_GET["act"]=="deactive" && $_REQUEST['rec'] != 'mul') {									
					$strMsg = "This category deactivated successfully."; 
					echo $cnf->HideMsg(); }
					
	

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

						<h2>Category - List</h2>

					

						<div class="right-wrapper pull-right">

							<ol class="breadcrumbs">

								<li>

									<a href="dashboard.php">

										<i class="fa fa-home"></i>

									</a>

								</li>

								<li><span><a href="addcategory.php">Add Category</a></span></li>

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

										$strQry = "SELECT * FROM `".TBL_CATEGORY."` ORDER BY `intCat_id` DESC";

										$resQry = mysqli_query($con,$strQry);

										if($cnf->records_fetch($strQry) == true) {

										?>

                                            <table class="table table-bordered table-striped mb-none" id="datatable-default">

                                                <thead>

                                                    <tr>

                                                    	<th>S.No</th>

                                                        <th data-orderable="false"><input type="checkbox" name="checkBoxBtn" id="checkBoxBtn" value="1" /></th>
                                                        <th>Category Image</th>

                                                        <th>SubCategory Name</th>

                                                        <th class="hidden-phone">Create Date</th>

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

                                                        <td><input type="checkbox" name="chk[]" value="<?php echo $rowQry->intCat_id; ?>" <?php  if($_GET["act"]=="CheckAll") { ?> checked <?php } ?> /></td>
                                                        
                                                        <td class="center">
                                                        <?php
														if($rowQry->logo_image != ""){
														?>
                                                        <img src="uploads/logo/<?php echo $rowQry->logo_image; ?>" style="width:100px; height:90px; border:1px solid #333;" />
                                                        <?php }else{ ?>
                                                        <img src="uploads/logo/dummylogo.jpg" style="width:100px" />
														<?php } ?>
                                                        </td>

                                                        <td><a href="#" data-toggle="modal" data-target="#myModal" id=<?php echo $rowQry->intCat_id; ?>><?php echo $rowQry->vCatName; ?></a></td>

                                                        <td class="center"><?php echo $cnf->convetdate($rowQry->dtCreated); ?></td>

                                                        <td class="center"><?php echo $cnf->getActiveImageHide($rowQry->cStatus,'category.php?act=btnActive&id='.$rowQry->intCat_id)?></td>

                                                        <td class="center">

                                                        	
                                                            <a href="edit_category.php?id=<?php echo $rowQry->intCat_id.$url_fields ?>" onClick="return confirmMsg(1);" class="text-info" title="Edit"><i class="fa fa-pencil" ></i></a>&nbsp;&nbsp;
                                                            
                                                            <?php
                                                         if($rowQry->intSubCatId != 0){
                                                            ?>
                                                            <a href="category.php?act=delete&id=<?php echo $rowQry->intCat_id.$url_fields ?>" onClick="return confirmMsg(2);" class="text-danger" title="Delete"><i class="fa fa-trash-o"></i></a>
															<?php
														 }
															?>
                                                        </td>

                                                    </tr>

                                                  <?php $i++; } ?>                                                     

                                                </tbody>

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

                                                        <a href="category.php?act=<?php echo $strCheck?>" class="text_btm_link"><?php echo $strCheckString?></a>

                                                        </noscript>

                                                    </td>

                                                    <td width="85" align="left" valign="middle">With Select </td>

                                                    <td width="207" align="left" valign="middle">

                                                        <select name="selOptions" class="form-control">
                                                            <option value="InActive">-- Active --</option>
                                                            <option value="BanActive">-- InActive --</option>
                                                            <option value="Delete">-- Delete --</option>

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
        url: 'category_modal.php',
        data: 'id='+id,
        success: function(data) 
        {
            $('#myModal').show();
            $('#modalContent').show().html(data);
        }
    });
});
</script> 

