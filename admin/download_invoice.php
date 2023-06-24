<?php include("../includes/db_functions.php");
$cnf = new DB_FUNCTINS();
//if(empty($_SESSION["intAdminId"])){ header("Location:index.php?act=exp"); }
require_once('tcpdf/tcpdf.php');
//require_once('tcpdf/tcpdf_barcodes_1d.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
//$pdf->SetAuthor('Balaji Rethinam');
$pdf->SetTitle('Sakthibooks Invoice');

// set default header data
//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderData(20, '10', 20);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(0);
$pdf->SetFooterMargin(0);

$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, 10);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// set font
//$pdf->SetFont('', '', 8);
$pdf->setFontSubsetting(true);
$pdf->SetFont('dejavusans', '', 14, '', true);
// define barcode style
$style = array(
	'position' => '',
	'align' => 'R',
	'stretch' => true,
	'fitwidth' => true,
	'cellfitalign' => 'R',
	'border' => false,
	'hpadding' => 'auto',
	'vpadding' => 'auto',
	'fgcolor' => array(0,0,0),
	'bgcolor' => false, //array(255,255,255),
	'text' => false,
	'font' => '',
	'fontsize' => 8,
	'stretchtext' => 4
);

// add a page
$pdf->AddPage();

require_once('../invoice/invoice.php');

$img_file = 'tcpdf/images/sphlogo.jpg';
$pdf->Image($img_file, 60, 100, 77, '', '', '', 'C', false, 300, '', false, false, 0);

// output the HTML content
$pdf->writeHTML($invoice, true, false, true, false, '');

//$pdf->lastPage(); // reset pointer to the last page
ob_end_clean();
$pdf->Output('sakthi.pdf', 'I');
$pdf->lastPage();
?>