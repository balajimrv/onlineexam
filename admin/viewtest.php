<?php require_once("includes/header.php");
if($_REQUEST["ID"]!="") {
$strSql = "Select * from  ".TBL_CATEGORY." where intCat_id=".$_REQUEST["ID"]." ";
if($cnf->records_fetch($strSql)==true) {
$rows = mysqli_fetch_object($cnf->query_execute($strSql));
$intCat_id	= $rows->intCat_id; 
$vCatName = $rows->vCatName;
$vTitle = $rows->vTitle;
$intSubCatId = $rows->intSubCatId;
$pageTitle = $rows->pageTitle;
$metaDescription = $rows->metaDescription;
$metaKeywords = $rows->metaKeywords;
$status = $rows->cStatus;				
}
}	
if($_POST["hdProcess"]=="Modify") {		
$strSqlUpdate = "update ".TBL_CATEGORY." set vCatName='".addslashes($_REQUEST['txtCategory'])."', vTitle='".addslashes($_REQUEST['txtTitle'])."'";
$strSqlUpdate .= ",intSubCatId='".$_REQUEST["selCategory"]."', pageTitle='".$_REQUEST["txtPageTitle"]."', metaDescription='".$_REQUEST["metaDescription"]."', metaKeywords='".$_REQUEST["metaKeywords"]."', cStatus='".$_REQUEST["selActive"]."', dtModified ='".$cnf->datetime_format()."'";
$strSqlUpdate .= ",intModifiedBy='".$_SESSION["intAdminId"]."' where intCat_id='".$_POST["txtID"]."'";			
$cnf->query_execute($strSqlUpdate);	
header("Location:category.php?filter=".$_REQUEST["filter"]."&filterfield=".$_REQUEST["filterfield"]."&order=".$_REQUEST["order"]."&type=".$_REQUEST["type"]."&page=".$_REQUEST["txtPage"]."&act=Updated");	
}

if($strContentVal=="Exists") {
$strMsg = Records_exists;
echo $cnf->HideMsg();
}

if($_GET["act"]=="Modify") { $strbtn = "Modify"; } 
else { $strbtn = "Save"; } 
			
			
			 


?>


<script type="text/javascript">	

function valdateAdd(frm){

	var result = true;

	//if(result) result = validateCombo(frm.selCategory, 'Please select the category');

	if(result) result = validateRequired(frm.txtCategory, 'Please enter the category or sub category');

	return result;

}

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

						<h2>Add Category</h2>

					

						<div class="right-wrapper pull-right">

							<ol class="breadcrumbs">

								<li>

									<a href="dashboard.php">

										<i class="fa fa-home"></i>

									</a>

								</li>

								<li><span><a href="category.php">Manage Category</a></span></li>

							</ol>

					

							<a class="" data-open="sidebar-right">&nbsp;</a>

						</div>

					</header>



					<!-- start: page -->

					<div class="row">

							<div class="col-lg-12">

                            	<div id="divMsg"><?php echo $strMsg?> </div>

								<section class="panel">

									<div class="panel-body">

										<form action="" method="POST" class="form-horizontal form-bordered" name="frm" onSubmit="return valdateAdd(this)">

											<div class="form-group">

												<label for="inputDefault" class="col-md-3 control-label">Select Main Category <font class="text_small"> *</font></label>

												<div class="col-md-6">

													<select name="selCategory" id="selCategory" class="form-control">
                                                      <option value="">--Select--</option>
													  <?php echo $cnf->DisplayCategory($intSubCatId,TBL_CATEGORY,"vCatName","intCat_id")?>
                                                      
                                                    </select>

													<div class="error"></div>

												</div>

											</div>

											<div class="form-group">

												<label for="inputDefault" class="col-md-3 control-label">Category (OR) Sub Category <font class="text_small"> *</font></label>

												<div class="col-md-6">

													<input type="text" name="txtCategory" id="txtCategory" class="form-control" value="<?php echo $vCatName ?>">

													<div class="error1"></div>

												</div>

											</div>

											

											<div class="form-group">

												<label for="inputDefault" class="col-md-3 control-label">Page Title</label>

												<div class="col-md-6">

													<input type="text" class="txt_inputs form-control" name="txtPageTitle"  id="txtPageTitle" size="45" value="<?php echo $vTitle; ?>">

													<div class="error1"></div>

												</div>

											</div>


											<div class="form-group">

												<label for="inputDefault" class="col-md-3 control-label">Meta Description</label>

												<div class="col-md-6">

													<textarea style="margin-top:10px;" rows="5" cols="40" class="form-control" id="metaDescription" name="metaDescription"><?php echo $metaDescription; ?></textarea>

													<div class="error1"></div>

												</div>

											</div>

											<div class="form-group">

												<label for="inputDefault" class="col-md-3 control-label"><?php echo $metaKeywords; ?></label>

												<div class="col-md-6">

													<input type="text" class="txt_inputs form-control" name="metaKeywords"  id="metaKeywords" size="45" value="">

													<div class="error1"></div>

												</div>

											</div>
											

											<div class="form-group">

                                                <label class="col-sm-2 control-label"></label>

                                                <div class="col-sm-6">

                                                    <div class="checkbox-custom checkbox-success">

                                                        <input type="checkbox" checked name="txtstatus" id="txtstatus" value="Y">

                                                        <label for="checkboxStatus">Status</label>

                                                    </div>

                                    

                                                </div>

                                            </div>

                                            

											<div class="form-group">

											<label class="col-sm-2 control-label"></label>

											<div class="col-sm-6">

											<p class="m-none">

											 <input type="hidden" name="hdProcess" value="add" />

												<?php  if($_GET["act"]=="Modify") { $strbtn = "Modify"; } ?>			
                                                <input type="hidden" name="txtID" value="<?php echo $intCat_id;?>">
                                                <input type="hidden" name="txtPage" value="<?php echo $_REQUEST["page"];?>">
                                                <input type="hidden" name="filter" value="<?php echo $_REQUEST["filter"];?>">
                                                <input type="hidden" name="filterfield" value="<?php echo $_REQUEST["filterfield"];?>">		
                                                <input type="hidden" name="order" value="<?php echo $_REQUEST["order"];?>">	
                                                <input type="hidden" name="type" value="<?php echo $_REQUEST["type"];?>">		
                                                <input type="hidden" name="hdProcess" value="<?php echo $strbtn?>">	
                                                <?php echo $cnf->formButton($strbtn)?> 
                                                <?php echo $cnf->CancelProcess("category.php?order=".$_REQUEST["order"]."&type=".$_REQUEST["type"]."&page=".$_REQUEST['page']."&filter=".$_REQUEST['filter']."&filterfield=".$_REQUEST['filterfield']."");?> 

											</p>

											</div>

											</div>

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