<?php require_once("../includes/db_functions.php");
$cnf = new DB_FUNCTINS();
if(empty($_SESSION["intAdminId"])){ header("Location:index.php?act=exp"); }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">

<style>
    body {
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
        background-color: #FAFAFA;
        font: 12pt "Tahoma";
    }
    * {
        box-sizing: border-box;
        -moz-box-sizing: border-box;
    }
    .page {
        width: 210mm;
        min-height: 297mm;
        padding: 20mm;
        margin: 10mm auto;
        border: 1px #D3D3D3 solid;
        border-radius: 5px;
        background: white;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }
    .subpage {
        padding: 1cm;
        border: 5px red solid;
        height: 257mm;
        outline: 2cm #FFEAEA solid;
    }
    
    @page {
        size: A4;
        margin: 0;
    }
    @media print {
        html, body {
            width: 210mm;
            height: 297mm;        
        }
        .page {
            margin: 0;
            border: initial;
            border-radius: initial;
            width: initial;
            min-height: initial;
            box-shadow: initial;
            background: initial;
            page-break-after: always;
        }
    }
</style>

</head>
<body>
<script language="JavaScript">
function varitext(text){
text=document
print(text)
}
</script>

<body style="background:#ffffff; font-family:Arial, Helvetica, sans-serif;">

<?php
/*
	$todayDate = date("Y-m-d");
	header("Content-type: application/vnd.ms-word");
	header("Content-Disposition: attachment; filename=Order_Details_".$todayDate.".doc");
	header("Pragma: no-cache");
	header("Expires: 0");
*/

foreach ( $_GET as $key => $value) {
$strSqlOrder = "select * from ".TBL_ORDER." where intOrd_id='".$value."'";
$resOrder = mysqli_query($con,$strSqlOrder);
$rowsOrder = mysqli_fetch_object($resOrder);

if($rowsOrder->intDiscount == 0){
	$pro_price = $rowsOrder->deBookPrice;
	$Offer="";
}else{
	$pro_price = $cnf->calculate_discount($rowsOrder->deBookPrice, $rowsOrder->intDiscount);
	$Offer = "Offer ";
}
?>

<div class="page">

<table align="center">
<tr>
<td>


<div style="width:580px; margin:0 auto;">
<div style="font-size:18px; color:#000000; text-align:center; padding:20px 0 6px 0; font-weight:bold;">Sakthi Books Order Details</div>
<div style="text-align:center; font-size:15px; padding:0 0 15px 0;">
</div>
<div style="padding:0; margin:0; clear:both;">
<div style="float:left; font-size:11px; font-weight:bold; width:250px;">
ORDER NUMBER : <?php echo $rowsOrder->vOrder_number; ?><br />
ORDER DATE : <?php echo $rowsOrder->dtOrd_date; ?><br />
PAYMENT MODE : <?php echo $rowsOrder->payment_type; ?><br />
PAYMENT STATUS : <?php echo $rowsOrder->numOrd_status; ?><br />
<?php if($rowsOrder->numOrd_status == 'Completed'){ ?>
PAYMENT DATE : <?php echo $rowsOrder->dtOrd_last_update; ?>
<?php } ?>
</div>


<div style="padding:20px 0 0 0; margin:0; clear:both;"></div>

<div style="float:left; width:100%; font-size:11px; color:#000000; clear:both; line-height:20px; padding:0 0 10px 0;"><b> Shipping Information </b><br />
Name : <?php echo $rowsOrder->vbill_first_name.' '. $rowsOrder->vbill_last_name; ?><br />
Address : <?php echo nl2br($rowsOrder->vbill_address); ?><br />
City : <?php echo $rowsOrder->vbill_city; ?><br />
State : <?php echo $rowsOrder->vbill_state; ?><br />
Country : <?php $strSqlCountry = "select * from ".TBL_COUNTRY." where intCountry_id='".$rowsOrder->vbill_country."'";
$resCountry = mysqli_query($con,$strSqlCountry);
$rowsCountry = mysqli_fetch_object($resCountry);
echo $rowsCountry->vCountryName;

 ?><br />
Zipcode : <?php echo $rowsOrder->vbill_postal_code; ?><br />
Phone : <?php echo $rowsOrder->vbill_Phone; ?><br />
Email : <?php echo $rowsOrder->vbill_Email; ?><br />

</div>

</div>
<div style="width:535px; height:1px; border-top:#808080 1px solid; clear:both;"><img src="<?php echo SITE_URL?>/images/trans.gif" width="1" height="1" /></div>
<div style="padding:0; margin:0; clear:both;">
<div style="padding:20px 0 0 0; margin:0;"></div>
<div style="width:50px; text-decoration:underline; float:left; font-size:10px; font-style:italic; padding:0 0 8px;">Sl.No.</div>
<div style="width:230px; text-decoration:underline; float:left; font-size:10px; font-style:italic; padding:0 0 8px;">Product Name</div>
<div style="width:60px; text-decoration:underline; float:left; font-size:10px; font-style:italic; text-align:right; padding:0 0 8px;">Unit Price</div>
<div style="width:50px; text-decoration:underline; float:left; font-size:10px; font-style:italic; text-align:center; padding:0 0 8px;">Qty</div>
<div style="width:95px; text-decoration:underline; float:left; font-size:10px; font-style:italic; text-align:right; padding:0 0 8px;">Total Price</div>
</div>
<?php
$intI = 1;
$subTot = 0;
$strSqlProduct = "select * from ".TBL_ORDER_ITEM." where intOrd_id = '".$rowsOrder->intOrd_id."'";
$resProduct = mysqli_query($con,$strSqlProduct);
while($rowsProduct = mysqli_fetch_object($resProduct)){

	
		
?>

<div style="padding:0; margin:0; clear:both;">
<div style="width:50px; float:left; font-size:11px;"><?php echo $intI; ?></div>
<div style="width:230px; float:left; font-size:11px; padding:0 0 12px 0;">
<?php
$strSqlProduct1 = "select * from ".TBL_BOOKS." where intBookId = '".$rowsProduct->intPro_id."'";
$resProduct1 = mysqli_query($con,$strSqlProduct1);
$rowsProduct1 = mysqli_fetch_object($resProduct1);
echo $rowsProduct1->vBookName." - ".$rowsProduct1->book_language;

	$sqlQryCate = "SELECT vCatName,intSubCatId FROM `".TBL_CATEGORY."` WHERE intCat_id = ".$rowsProduct1->intCat_id." LIMIT 1";
	$resQryCate = mysqli_query($con,$sqlQryCate);
	$rowQryCate = mysqli_fetch_object($resQryCate);
	
				
if($rowsProduct1->intDiscount == 0){
	$pro_price = $rowsProduct1->deBookPrice;
	$Offer="";
}else{
	$pro_price = $cnf->calculate_discount($rowsProduct1->deBookPrice, $rowsProduct1->intDiscount);
	$Offer = "Offer ";
}
?><br />( <?php echo $rowQryCate->vCatName; ?> )
</div>
<div style="width:60px; float:left; font-size:11px; text-align:right; padding:0 0 12px 0;"><?php echo 'Rs. '.$pro_price; ?></div>
<div style="width:50px; float:left; font-size:11px; text-align:center; padding:0 0 12px 0;"><?php echo $rowsProduct->intItem_qty?></div>
<div style="width:92px; float:left; font-size:11px; text-align:right; padding:0 0 12px 0;">
<?php 
$Price = ($pro_price)*($rowsProduct->intItem_qty);

	if($rowsProduct1->deShipping == 'Rs. 0.00'){
	$shippPrice = 1;
	}else{
	$shippPrice = $rowsProduct1->deShipping;
	}
$shipPrice = ($shippPrice)*($rowsProduct->intItem_qty);
$totPrice = ($Price+$shipPrice);
echo "Rs. ". $cnf->displayAmount($totPrice);
$subTotal = $totPrice * $rowsProduct->intItem_qty;
 ?></div>
</div>
<?php  $intI=$intI+1; 
$subTot = $subTotal +$subTot;
}
 ?>
<br />
<div style="width:535px; height:1px; border-top:#808080 1px solid; clear:both;"><img src="<?php echo SITE_URL?>/images/trans.gif" width="1" height="1" /></div>
<div style="width:530px; clear:both;">

<div style="padding:0 0 5px 0; margin:0; clear:both; float:right;">
<div style="width:80px; font-size:11px; font-weight:bold; color:#000000; float:right; text-align:right; padding:15px 0 0 0;"><?php echo 'Rs. '.$rowsOrder->deOrd_sub_total;?></div>
<div style="width:100px; font-size:11px; font-weight:bold; color:#000000; float:right; text-align:right; padding:15px 0 0 0;">Sub Total :</div>
</div>

<div style="padding:0 0 5px 0; margin:0; clear:both; float:right;">
<div style="width:80px; font-size:11px; font-weight:bold; color:#000000; float:right; text-align:right; padding:5px 0 0 0;"><?php echo 'Rs. '.$rowsOrder->deOrd_shipping_cost;?></div>
<div style="width:120px; font-size:11px; font-weight:bold; color:#000000; float:right; text-align:right; padding:5px 0 0 0;">Shipping :</div>
</div>

<?php  if($rowsOrder->payment_type == "COD"){ ?>
<div style="padding:0 0 5px 0; margin:0; clear:both; float:right;">
<div style="width:80px; font-size:11px; font-weight:bold; color:#000000; float:right; text-align:right; padding:5px 0 0 0;"><?php echo 'Rs. '.$rowsOrder->deOrd_cod_cost;?></div>

<div style="width:120px; font-size:11px; font-weight:bold; color:#000000; float:right; text-align:right; padding:5px 0 0 0;">COD Charges:</div>
</div>
<?php } ?>


<div style="padding:0; margin:0; clear:both;">

</div>
<div style="padding:0; margin:0; clear:both;">

</div>
<?php if($rowsOrder->int_coupon_charge!="") { ?>
<div style="padding:0; margin:0; clear:both;">


</div>
<?php }?>

<div class="space4" style="clear:both;"></div>
<div style="padding:0; margin:0; clear:both;">
<div style="width:180px; height:1px; border-top:#808080 1px solid; float:right;"><img src="<?php echo SITE_URL?>/images/trans.gif" width="1" height="1" /></div>
</div>

<div style="padding:0; margin:0; clear:both;">
<div style="width:80px; font-size:11px; font-weight:bold; color:#000000; float:right; text-align:right; padding:8px 0 5px 0;"><?php echo 'Rs. '.$rowsOrder->deOrd_total;?></div>
<div style="width:200px; font-size:11px; font-weight:bold; color:#000000; float:right; text-align:right; padding:8px 0 5px 0;">Total (Rs ) :</div>
</div>
<div class="space4" style="clear:both;"></div>
<div style="padding:0; margin:0; clear:both;">
  <div style="width:180px; height:1px; border-top:#808080 1px solid; float:right;"><img src="<?php echo SITE_URL?>/images/trans.gif" width="1" height="1" /></div>
</div>
</div>
</div>
<div style="margin-top:30px; border-top:1px dotted #000;">&nbsp;</div>
</td></tr></table>

</div>
<?php
} ?>

</body>
</html>
