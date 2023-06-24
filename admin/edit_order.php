<?php require_once("includes/header.php"); 
if($_REQUEST["id"]!="") {
		$strSql = "SELECT * FROM ".TBL_ORDER." WHERE intOrd_id =".$_GET["id"]." ";
		if($cnf->records_fetch($strSql)==true) {
			$rows = mysqli_fetch_object($cnf->query_execute($strSql));
		}else{
			header("Location:orders.php?act=invalid");
		}
	}else{
		header("Location:orders.php?act=invalid");
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

						<h2>Edit Order</h2>

					

						<div class="right-wrapper pull-right">

							<ol class="breadcrumbs">

								<li>

									<a href="dashboard.php">

										<i class="fa fa-home"></i>

									</a>

								</li>

								<li><span><a href="orders.php">Manage Orders</a></span></li>

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
										<table>
                                        	<tr><td><strong>Order Number : #<?php echo $rows->vOrder_number; ?></strong></td></tr>
                                        </table>
                                	</div>
                                </section>
								
                                <div id="response" class="alert alert-success" style="display:none;">
                                <a href="#" class="close" data-dismiss="alert">&times;</a>
                                <div class="message"></div>
                            </div>
							
								<section class="panel">

									<div class="panel-body">

										<form method="post" id="update_invoice">
            <input type="hidden" name="action" value="update_order">
			<input type="hidden" name="order_id" value="<?php echo $rows->intOrd_id; ?>">
			
            <div class="table-responsive">
                <table class="table table-bordered" id="invoice_table">
                    <thead>
                        <tr class="bg-info">
                            <th width="504">
                                <h4><a href="#" class="btn btn-success btn-xs add-row"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a> Add New Row</h4>
                            </th>
                            
                            <th width="193">
                                <h4>Price</h4>
                            </th>
                            <th width="68">
                                <h4>Qty</h4>
                            </th>
                            <th width="182">
                                <h4>Discount</h4>
                            </th>
                            <th width="199">
                                <h4>Sub Total</h4>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
						<?php
                        $str_order_item = "select * from ".TBL_ORDER_ITEM." where intOrd_id = '".$rows->intOrd_id."'";
                        $res_order_item = mysqli_query($con,$str_order_item);
                        $i=1;
                        $qty=0;
                        while($order_item = mysqli_fetch_object($res_order_item)){
							$strQry = "select * from ".TBL_BOOKS." where intBookId = '".$order_item->intPro_id."'";
							$resQry = mysqli_query($con,$strQry);
							$rowQry = mysqli_fetch_object($resQry);
							
							if($rowQry->intDiscount == 0){
								$book_price = $rowQry->deBookPrice;						
							}else{
								$book_price = $cnf->calculate_discount($rowQry->deBookPrice, $rowQry->intDiscount);
							}
							
							$sub_price = ($book_price * $order_item->intItem_qty);
                       ?>
                        <tr>
                            <td>
                                <div class="form-group form-group-sm  no-margin-bottom">
                                    <a href="#" class="btn btn-danger btn-xs delete-row"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
                                    <input type="text" class="form-control form-group-sm item-input invoice_product bg-white" name="invoice_product[]" placeholder="Book Name" value="<?php echo $rowQry->vBookName; ?>" readonly>
                                    <input type="hidden" class="invoice_book_id" name="invoice_product_id[]" value="<?php echo $rowQry->intBookId; ?>">
                                    <p class="item-select"><a href="#" class="btn btn-sm btn-success">Select Book</a></p>
                                </div>
                            </td>
                            
                            <td class="text-right">
                                <div class="input-group input-group-sm  no-margin-bottom">
                                    <span class="input-group-addon">&#8377;</i>
</span>
                                    <input type="text" class="form-control calculate invoice_product_price bg-white" name="invoice_product_price[]" aria-describedby="sizing-addon1" placeholder="0.00" readonly value="<?php echo $rowQry->deBookPrice; ?>">
                                </div>
                            </td>
                            
                            <td class="text-right">
                                <div class="form-group form-group-sm no-margin-bottom">
                                    <input type="text" class="form-control invoice_product_qty calculate" name="invoice_product_qty[]" value="<?php echo $order_item->intItem_qty; ?>" style="height:30px;">
                                </div>
                            </td>
                            <td class="text-right">
                                <div class="form-group form-group-sm  no-margin-bottom">
                                    <input type="text" class="form-control calculate bg-white invoice_discount" name="invoice_product_discount[]" placeholder="0%" value="<?php echo $rowQry->intDiscount; ?>%" readonly>
                                </div>
                               
                            </td>
                            <td class="text-right">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-addon">&#8377;</i>
</span>
                                    <input type="text" class="form-control calculate-sub" name="invoice_product_sub[]" id="invoice_product_sub" value="<?php echo $cnf->displayAmount($sub_price); ?>" aria-describedby="sizing-addon1" disabled >
                                </div>
                            </td>
                        </tr>
                        <?php 
							$SubTotal = $SubTotal+$sub_price; //Sub total
							$grandTotal = $SubTotal; //Estimated total 
						} ?>
                    </tbody>
                </table>
            </div>
			<div id="invoice_totals" class="padding-right row text-right">
				<div class="col-xs-6">
					<div class="input-group form-group-sm textarea no-margin-bottom">
						<!--<textarea class-"form-control" name="invoice_notes" placeholder="Please enter any order notes here."></textarea>-->
					</div>
				</div>
				<div class="col-xs-6 no-padding-right">
					<div class="row">
						<div class="col-xs-4 col-xs-offset-5">
							<strong>Sub Total:</strong>
						</div>
						<div class="col-xs-3">
							&#8377; : <span class="invoice-sub-total"><?php echo $rows->deOrd_sub_total;?></span>
							<input type="hidden" name="invoice_subtotal" id="invoice_subtotal">
						</div>
					</div>
					
                  
					<div class="row">
						<div class="col-xs-4 col-xs-offset-5">
							<strong class="shipping">Shipping:</strong>
						</div>
						<div class="col-xs-3">
                        
							<div class="input-group input-group-sm">
								<span class="input-group-addon">&#8377;</span>
								<input type="text" class="form-control calculate shipping" name="invoice_shipping" id="invoice_shipping" aria-describedby="sizing-addon1" placeholder="0.00" value="<?php echo $rows->deOrd_shipping_cost;?>">
							</div>
						
						</div>
					</div>
                  <?php if($rows->payment_type == "COD"){ ?>
                    
                    <div class="row">
						<div class="col-xs-4 col-xs-offset-5">
							<strong class="shipping">COD Charges:</strong>
						</div>
						<div class="col-xs-3">
                        
                        	&#8377; : <span class="invoice-cod"><?php echo $rows->deOrd_cod_cost;?></span>
							<input type="hidden" name="invoice_cod" id="invoice_cod" value="<?php echo $rows->deOrd_cod_cost;?>">
							
						</div>
					</div>
				<?php } ?>						
						<div class="row">
						<div class="col-xs-4 col-xs-offset-5">
							<strong>Total:</strong>
						</div>
						<div class="col-xs-3">
							&#8377; : <span class="invoice-total"><?php echo $rows->deOrd_total;?></span>
							<input type="hidden" name="invoice_total" id="invoice_total">
						</div>
					</div>
				</div>

			</div>
			<div class="row">
				<div class="col-xs-12 margin-top btn-group">
                    <input type="submit" id="action_edit_order" class="btn btn-danger btn-lg float-right" value="Update Order" data-loading-text="Updating..."/>
				</div>
			</div>
		</form>

                    <div id="insert" class="modal fade">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Select a Book</h4>
                          </div>
                          <div class="modal-body">
                            <select class="form-control item-select">
                                <?php
                                $sql = "SELECT intBookId,vBookName,deBookPrice,intDiscount FROM ".TBL_BOOKS." ORDER BY vBookName ASC";
                                
                                $res = mysqli_query($con,$sql);
                                while($rows = mysqli_fetch_object($res)){ ?>
                                <option value="<?php echo $rows->deBookPrice; ?>" data-discount="<?php echo $rows->intDiscount; ?>" data-book-id="<?php echo $rows->intBookId; ?>"><?php echo $rows->vBookName; ?></option>
                                <?php } ?>
                            </select>
                         </div>
                
                          <div class="modal-footer">
                            <button type="button" data-dismiss="modal" class="btn btn-primary" id="selected">Add</button>
                            <button type="button" data-dismiss="modal" class="btn">Cancel</button>
                          </div>
                        </div><!-- /.modal-content -->
                      </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->
                                

            </div>

        </section>

    </div>

</div>

					

					

					<!-- end: page -->

				</section>

			</div>



		</section>

        

<?php include("includes/footer.php"); ?>