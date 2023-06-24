<?php require_once("../includes/db_functions.php");
$cnf = new DB_FUNCTINS();
if(empty($_SESSION["intAdminId"])){ header("Location:index.php?act=exp"); }

$strSqlUser = "select * from ".TBL_USERS." where intUser_id='".$_REQUEST['UID']."'";
$resUser = mysqli_query($con,$strSqlUser);
$rowsUser = @mysqli_fetch_object($resUser);

$strSqlOrder = "select * from ".TBL_ORDER." where intOrd_id='".$_REQUEST['OID']."'";
$resOrder = mysqli_query($con,$strSqlOrder);
$rowsOrder = mysqli_fetch_object($resOrder);

if($rowsOrder->intDiscount == 0){
	$pro_price = $rowsOrder->deBookPrice;
	$Offer="";
}else{
	$pro_price = $cnf->calculate_discount($rowsOrder->deBookPrice, $rowsOrder->intDiscount);
	$Offer = "Offer ";
}
			
if($_REQUEST['act'] == 'Mail'){

$strSqlCountry = "select * from ".TBL_COUNTRY." where intCountry_id='".$rowsUser->intCountry."'";
$resCountry = mysqli_query($con,$strSqlCountry);
$rowsCountry = mysqli_fetch_object($resCountry);
$loginid 	= $rowsUser->vFname;
$sendmail 	= $rowsUser->vEmail;
$subject = "Sakthi Books Order Details - Invoice Bill";
$siteurl_link = SITE_URL;
$message ='<div style="width:580px; margin:0 auto;">
<div style="font-size:18px; color:#000000; text-align:center; padding:20px 0 6px 0; font-weight:bold;">Go Flowers 4 U</div>
<div style="text-align:center; font-size:15px; padding:0 0 15px 0;">
</div>
<div style="padding:0; margin:0; clear:both;">
<div style="float:left; font-size:11px; font-weight:bold; width:250px;">ORDER DATE : '.$rowsOrder->dtOrd_date.'<br />PAYMENT STATUS :'.$rowsOrder->numOrd_status.'<br />';

if($rowsOrder->numOrd_status == 'Completed'){
$message .= 'PAYMENT DATE :'.$rowsOrder->dtOrd_last_update.'';
 } 
$message .= '</div>
<div style="float:right; width:260px; font-size:11px; color:#000000; line-height:20px; padding:0 0 10px 0;"><b>Billing Information</b><br />
Name : '.$rowsUser->vFname.' <br />
Address1 : '.$rowsUser->vAddress1.'<br />
Address2 : '.$rowsUser->vAddress2.'<br />
City : '.$rowsUser->vCity.'<br />
State : '.$rowsUser->vState.'<br />
Country :'.$rowsCountry->vCountryName;
$message .= '<br />
Zipcode : '.$rowsUser->intZip.'<br />
Phone : '.$rowsUser->intPhone.'<br />
Email : '.$rowsUser->vEmail.'<br />';

$message .= '</div>
</div>
<div style="width:560px; height:1px; border-top:#808080 1px solid; background:#d4d0c8; clear:both;"><img src="'.SITE_URL.'/images/trans.gif" width="1" height="1" /></div>
<div style="padding:0; margin:0; clear:both;">
<div style="padding:20px 0 0 0; margin:0;"></div>
<div style="width:50px; text-decoration:underline; float:left; font-size:10px; font-style:italic; padding:0 0 8px;">Sl.No.</div>
<div style="width:295px; text-decoration:underline; float:left; font-size:10px; font-style:italic; padding:0 0 8px;">Product Name</div>
<div style="width:50px; text-decoration:underline; float:left; font-size:10px; font-style:italic; text-align:right; padding:0 0 8px;">Unit Price</div>
<div style="width:70px; text-decoration:underline; float:left; font-size:10px; font-style:italic; text-align:center; padding:0 0 8px;">Qty</div>
<div style="width:50px; text-decoration:underline; float:left; font-size:10px; font-style:italic; text-align:right; padding:0 0 8px;">Shipping</div>
<div style="width:95px; text-decoration:underline; float:left; font-size:10px; font-style:italic; text-align:right; padding:0 0 8px;">Total Price</div>
</div>';
$intI = 1;
$subTot = 0;
$strSqlProduct = "select * from ".TBL_ORDER_ITEM." where intOrd_id = '".$rowsOrder->intOrd_id."'";
$resProduct = mysqli_query($con,$strSqlProduct);
while($rowsProduct = mysqli_fetch_object($resProduct)){
$strSqlProduct1 = "select * from ".TBL_BOOKS." where intBookId = '".$rowsProduct->intPro_id."'";
$resProduct1 = mysqli_query($con,$strSqlProduct1);
$rowsProduct1 = mysqli_fetch_object($resProduct1);	

$message .= '<div style="padding:0; margin:0; clear:both;">
<div style="width:50px; float:left; font-size:11px;">'.$intI.'</div>
<div style="width:285px; float:left; font-size:11px; padding:0 10px 12px 0;">'.$rowsProduct1->vBookName;

$message .='</div>
<div style="width:50px; float:left; font-size:11px; text-align:right; padding:0 0 12px 0;">Rs. '.$rowsProduct1->deBookPrice.'</div>
<div style="width:70px; float:left; font-size:11px; text-align:center; padding:0 0 12px 0;">'.$rowsProduct->intItem_qty.'</div>
<div style="width:50px; float:left; font-size:11px; text-align:right; padding:0 0 12px 0;">'.'Rs. '.$rowsProduct1->deShipping.'</div>';

$Price = ($rowsProduct1->deBookPrice)*($rowsProduct->intItem_qty);

	if($rowsProduct1->deShipping == '0.00'){
	$shippPrice = '';
	}else{
	$shippPrice = $rowsProduct1->deShipping;
	}
$shipPrice = ($shippPrice)*($rowsProduct->intItem_qty);
$totPrice = ($Price+$shipPrice);

$message .='<div style="width:95px; float:left; font-size:11px; text-align:right; padding:0 0 12px 0;">$&nbsp;'.
$cnf->displayAmount($totPrice);

$subTotal = $totPrice * $rowsProduct->intItem_qty;

$message .='</div>
</div>';
$intI=$intI+1; 
$subTot = $subTotal +$subTot;
}

$message .='<br />
<div style="width:560px; height:1px; border-top:#808080 1px solid; background:#d4d0c8; clear:both;"><img src="'.SITE_URL.'/images/trans.gif" width="1" height="1" /></div>
<div style="width:560px; clear:both;">
<div style="padding:0; margin:0; clear:both;">
<div style="width:80px; font-size:11px; font-weight:bold; color:#000000; float:right; text-align:right; padding:15px 0 0 0;">$'.$cnf->displayAmount($subTot).'</div>
<div style="width:100px; font-size:11px; font-weight:bold; color:#000000; float:right; text-align:right; padding:15px 0 0 0;">Sub Total :</div>
</div>

<div style="padding:0; margin:0; clear:both;">
<div style="width:80px; font-size:11px; font-weight:bold; color:#000000; float:right; text-align:right; padding:8px 0 0 0;">
$'.$rowsOrder->int_coupon_charge.'</div>
<div style="width:200px; font-size:11px; font-weight:bold; color:#000000; float:right; text-align:right; padding:8px 0 0 0;">Coupon Savings :</div>
</div>';

$message .='<div class="space4" style="clear:both;"></div>
<div style="padding:0; margin:0; clear:both;">
<div style="width:135px; height:1px; border-top:#808080 1px solid; background:#d4d0c8; float:right;"><img src="'.SITE_URL.'/images/trans.gif" width="1" height="1" /></div>
</div>

<div style="padding:0; margin:0; clear:both;">
<div style="width:80px; font-size:11px; font-weight:bold; color:#000000; float:right; text-align:right; padding:8px 0 0 0;">$'.$rowsOrder->deOrd_total.'</div>
<div style="width:200px; font-size:11px; font-weight:bold; color:#000000; float:right; text-align:right; padding:8px 0 0 0;">Total (US Dollars) :</div>
</div>
<div class="space4" style="clear:both;"></div>
<div style="padding:0; margin:0; clear:both;">
  <div style="width:135px; height:1px; border-top:#808080 1px solid; background:#d4d0c8; float:right;"><img src="'.SITE_URL.'/images/trans.gif" width="1" height="1" /></div>
</div>
</div>';


//die();
//$res = $mailobj->SMTPMail($sendmail,$loginid,$subject,$message);
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			// Additional headers
			$headers .= 'From: '.$sendmail. "\r\n";
			$res = mail($sendmail, $subject, $message, $headers);		
if($res){			
header("Location:print.php?rep=Send&OID=".$_REQUEST['OID']."&UID=".$_REQUEST['UID']."");
}
else{			
header("Location:print.php?rep=Sendfail&OID=".$_REQUEST['OID']."&UID=".$_REQUEST['UID']."");
}

}

	if($_GET["rep"]=="Send") {
	$strMsg = Send_RECORDS;
	echo $cnf->HideMsg(); 
	}			

	if($_GET["rep"]=="Sendfail") {
	$strMsg = Mail_Sendfail;
	echo $cnf->HideMsg(); 
	}	

?>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title><?php echo SiteTitle ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <script language="JavaScript">
    function varitext(text) {
        text = document
        print(text)
    }
    </script>
</head>

<body style="background:#ffffff; font-family:Arial, Helvetica, sans-serif;">
    <div id="divMsg"
        style="font-size:12px; float:left; padding:0 0 0 120px; width:500px; color:#FF0000; text-align:center; height:10px;">
        <?php echo $strMsg?></div>
    <div style="font-size:12px; float:right; color:#FF0000; text-align:center; height:10px;"><a
            href="javascript:window.close();"><img src="assets/images/delete.png" title="Close" /></a></div>
            
    <div style="width:580px; margin:0 auto;">
      <div style="clear:both;"></div>
        <div style="font-size:14px; color:#000000; text-align:left; font-weight:bold;float:left;">
            <h2>SAKTHI PUBLISHING HOUSE</h2>
            <address style="font-style:normal;font-weight:normal;font-size:10px;margin-bottom:10px;">
                New No.19 / Old No. 8/1, Lotus Ramasamy Street,<br/>
Royapuram<br/>
Chennai - 600013<br/>
Phone: 044 - 25967807, 25966778, +91 9962033320<br/>
Email Id: contact@sakthibooks.com
            </address>
            </div>
          <div style="text-align:center;font-size:20px;font-weight:bold;margin-bottom:20px;position:relative;color:#6f6e6e;float:right;width:120px;text-align:right;padding-right:20px;">
            INVOICE
        </div>
        <div style="text-align:right; font-size:15px; padding:0 0 15px 0;position:absolute;right:20px;top:30px;">
            <a href="#" onclick="varitext();"><img src="assets/images/print-icon.gif" width="14" height="21" border="0"
                    alt="print" title="Print" /></a>
        </div>
        <div style="padding:10px 0 0 0; margin:0; clear:both;border-top:2px solid #333;">
           


            

            <div
                style="float:left; width:300px; font-size:11px; color:#000000; clear:both; line-height:20px; padding:0 0 10px 0;">
                <b> Shipping Information </b><br />
                Name : <?php echo $rowsOrder->vbill_first_name.' '. $rowsOrder->vbill_last_name; ?><br />
                Address : <?php echo nl2br($rowsOrder->vbill_address); ?><br />
                City : <?php echo $rowsOrder->vbill_city; ?><br />
                State : <?php echo $rowsOrder->vbill_state; ?><br />
                Country : <?php $strSqlCountry = "select * from ".TBL_COUNTRY." where intCountry_id=1";
$resCountry = mysqli_query($con,$strSqlCountry);
$rowsCountry = mysqli_fetch_object($resCountry);
echo $rowsCountry->vCountryName;

 ?><br />
                Zipcode : <?php echo $rowsOrder->vbill_postal_code; ?><br />
                Phone : <?php echo $rowsOrder->vbill_Phone; ?><br />
                Email : <?php echo $rowsOrder->vbill_Email; ?><br />

            </div>
             <div style="float:right; font-size:11px;width:200px;line-height:20px;">
                Order Number : <?php echo $rowsOrder->vOrder_number; ?><br />
                Date : <?php echo $rowsOrder->dtOrd_date; ?><br />
                Payment Mode : <?php echo $rowsOrder->payment_type; ?><br />
            
                <?php if($rowsOrder->numOrd_status == 'Completed'){ ?>
                Payment Date : <?php echo $rowsOrder->dtOrd_last_update; ?>
                <?php } ?>
            </div>

        </div>
        <div style="width:535px; height:1px; border-top:#808080 1px solid; background:#d4d0c8; clear:both;"><img
                src="<?php echo SITE_URL?>/images/trans.gif" width="1" height="1" /></div>
        <div style="padding:0; margin:0; clear:both;">
            <div style="padding:20px 0 0 0; margin:0;"></div>
            <div
                style="width:50px; text-decoration:underline; float:left; font-size:10px; font-style:italic; padding:0 0 8px;">
                Sl.No.</div>
            <div
                style="width:230px; text-decoration:underline; float:left; font-size:10px; font-style:italic; padding:0 0 8px;">
                Product Name</div>
            <div
                style="width:60px; text-decoration:underline; float:left; font-size:10px; font-style:italic; text-align:right; padding:0 0 8px;">
                Unit Price</div>
            <div
                style="width:50px; text-decoration:underline; float:left; font-size:10px; font-style:italic; text-align:center; padding:0 0 8px;">
                Qty</div>
            <div
                style="width:95px; text-decoration:underline; float:left; font-size:10px; font-style:italic; text-align:right; padding:0 0 8px;">
                Total Price</div>
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
            <div style="width:60px; float:left; font-size:11px; text-align:right; padding:0 0 12px 0;">
                <?php echo 'Rs. '.$pro_price; ?></div>
            <div style="width:50px; float:left; font-size:11px; text-align:center; padding:0 0 12px 0;">
                <?php echo $rowsProduct->intItem_qty?></div>
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
        <div style="width:535px; height:1px; border-top:#808080 1px solid; background:#d4d0c8; clear:both;"><img
                src="<?php echo SITE_URL?>/images/trans.gif" width="1" height="1" /></div>
        <div style="width:530px; clear:both;">

            <div style="padding:0 0 5px 0; margin:0; clear:both; float:right;">
                <div
                    style="width:80px; font-size:11px; font-weight:bold; color:#000000; float:right; text-align:right; padding:15px 0 0 0;">
                    <?php echo 'Rs. '.$rowsOrder->deOrd_sub_total;?></div>
                <div
                    style="width:100px; font-size:11px; font-weight:bold; color:#000000; float:right; text-align:right; padding:15px 0 0 0;">
                    Sub Total :</div>
            </div>

            <div style="padding:0 0 5px 0; margin:0; clear:both; float:right;">
                <div
                    style="width:80px; font-size:11px; font-weight:bold; color:#000000; float:right; text-align:right; padding:5px 0 0 0;">
                    <?php echo 'Rs. '.$rowsOrder->deOrd_shipping_cost;?></div>
                <div
                    style="width:120px; font-size:11px; font-weight:bold; color:#000000; float:right; text-align:right; padding:5px 0 0 0;">
                    Shipping Charges :</div>
            </div>
            <?php  if($rowsOrder->payment_type == "COD"){ ?>
            <div style="padding:0 0 5px 0; margin:0; clear:both; float:right;">
                <div
                    style="width:80px; font-size:11px; font-weight:bold; color:#000000; float:right; text-align:right; padding:5px 0 0 0;">
                    <?php echo 'Rs. '.$rowsOrder->deOrd_cod_cost;?></div>

                <div
                    style="width:120px; font-size:11px; font-weight:bold; color:#000000; float:right; text-align:right; padding:5px 0 0 0;">
                    COD Charges:</div>
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
                <div style="width:180px; height:1px; border-top:#808080 1px solid; background:#d4d0c8; float:right;">
                    <img src="<?php echo SITE_URL?>/images/trans.gif" width="1" height="1" /></div>
            </div>

            <div style="padding:0; margin:0; clear:both;">
                <div
                    style="width:80px; font-size:11px; font-weight:bold; color:#000000; float:right; text-align:right; padding:8px 0 5px 0;">
                    <?php echo 'Rs. '.$rowsOrder->deOrd_total;?></div>
                <div
                    style="width:200px; font-size:11px; font-weight:bold; color:#000000; float:right; text-align:right; padding:8px 0 5px 0;">
                    Total (Rs ) :</div>
            </div>
            <div class="space4" style="clear:both;"></div>
            <div style="padding:0; margin:0; clear:both;">
                <div style="width:180px; height:1px; border-top:#808080 1px solid; background:#d4d0c8; float:right;">
                    <img src="<?php echo SITE_URL?>/images/trans.gif" width="1" height="1" /></div>
            </div>
        </div>
    </div>
</body>

</html>