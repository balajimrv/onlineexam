<?php include("includes/header.php");
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

						<h2>Listing Header Image</h2>

					

						<div class="right-wrapper pull-right">

							<ol class="breadcrumbs">

								<li>

									<a href="dashboard.php">

										<i class="fa fa-home"></i>

									</a>

								</li>

								<li><span><a href="addheaderslider.php">Add Header Image</a></span></li>

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

                                    

                                            <table class="table table-bordered table-striped mb-none" id="datatable-default">

                                                <thead>

                                                    <tr>

                                                    	<th>S.No</th>

                                                        <th data-orderable="false">&nbsp;</th>

                                                        <th>Image Title</th>

                                                        <th class="hidden-phone">Header Image</th>

                                                        <th class="hidden-phone">Sort Order</th>

                                                        <th class="hidden-phone">Status</th>

														<th class="hidden-phone">Action</th>
                                                    </tr>

                                                </thead>

                                                <tbody>

                                              

                                                    <tr class="gradeX">

                                                        <td>1</td>

                                                        <td><input type="checkbox" name="chk[]" value="<?php echo $rowQry->category_id ?>" <?php  if($_GET["act"]=="CheckAll") { ?> checked <?php } ?> /></td>

                                                        <td>TNPSC Group4 and VAO 2017</td>

                                                        <td class="center"><img src="../uploads/header/tnpsc-group4-and-vao-2017.png" alt="Header Image"></td>

														 <td class="center"></td>
                                                        <td class="center"><?php echo $cnf->getActiveImageHide($rowQry->cStatus,'category.php?act=btnActive&id='.$rowQry->category_id)?></td>

                                                        <td class="center">

                                                        	<a href="detail_category.php?id=<?php echo $rowQry->category_id ?>" class="text-active" style="color:#000" title="View"><i class="fa fa fa-eye"></i></a>&nbsp;&nbsp;
                                                            <a href="edit_category.php?id=<?php echo $rowQry->category_id.$url_fields ?>" onClick="return confirmMsg(1);" class="text-info" title="Edit"><i class="fa fa-pencil" ></i></a>&nbsp;&nbsp;
                                                            
                                                            <a href="category.php?act=delete&id=<?php echo $rowQry->category_id.$url_fields ?>" onClick="return confirmMsg(2);" class="text-danger" title="Delete"><i class="fa fa-trash-o"></i></a>

                                                        </td>

                                                    </tr>

                                                                                            

                                                </tbody>

                                            </table>

                                            

                                                               

                                            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="rgtlistbdr">

                                                <tr>

                                                    <td width="72" align="left" valign="middle">&nbsp;</td>

                                                    <td width="200" align="left" valign="middle">

                                                       

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

                                                            <option value="allActive">-- Active --</option>

                                                            <option value="deActive">-- InActive --</option>

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

