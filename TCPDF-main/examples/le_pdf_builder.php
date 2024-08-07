<?php
//============================================================+
// File name   : le_pdf_builder.php
// Begin       : 2024-05-20
// Last Update : 2013-05-14
//
// Description : Lab Elements PDF Builder
//               Quotaion Request
//
// Author: Roberto Tablarin
//
//============================================================+


// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');
include $_SERVER['DOCUMENT_ROOT'] . '/labelements.shop/build2v/model/conn2.php';

$sql = 'SELECT * FROM rfq_submitted WHERE id = "J2w9XExb7GlFklZYXg4J"';
$stmt = $conn->prepare($sql);
$stmt->execute();

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (count($results) > 0) {
    $business_name = $results[0]['business_name'];
} else {
    echo "No data found.";
    exit;
}

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->setCreator(PDF_CREATOR);
$pdf->setAuthor('Lab Elements');
$pdf->setTitle('Quotation');
$pdf->setSubject('Quotation');
$pdf->setKeywords('RFQ, PDF, product, quotation, price');

// set default header data
$pdf->setHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->setDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->setMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->setHeaderMargin(PDF_MARGIN_HEADER);
$pdf->setFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->setAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->setFont('helvetica', 'B', 20);

// add a page
$pdf->AddPage();

$pdf->Write(0, 'Quotation', '', 0, 'C', true, 0, false, false, 0);

$pdf->setFont('helvetica', '', 8);

// -----------------------------------------------------------------------------

$tbl = <<<EOD
<br><br>
<table cellspacing="1" cellpadding="1" border="0">
    
    <tr>
        <td width="40" align="" rowspan="5"><b>TO:</b></td>
        <td colspan="3">$business_name</td>
        <td colspan="2" align="right"><b>DATE:</b></td>
        <td align="right">May 6, 2024</td>
    </tr>

    <tr>
    	<td colspan="3">Roberto M. Tablarin</td>
        <td colspan="2" align="right"><b>QUOTATION NO:</b></td>
        <td align="right">QT20240506-01</td>
    </tr>

    <tr>
       <td colspan="3">L10-1 One Global Place 25th Corner 5th Ave. BGC Taguig</td>
       <td colspan="2" align="right"><b>DATE VALID:</b></td>
       <td align="right">August 6, 2024</td>
    </tr>
    <br>
    <tr>
        <td colspan="2">Dear Valued Client,</td>    
    </tr>
    <tr>
        <td colspan="5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;We are pleased to quote and supply the following items as requested.</td>
    </tr>

</table>

EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');

// -----------------------------------------------------------------------------

$tbl = <<<EOD
<table cellspacing="0" cellpadding="3" border="1">
    <tr align="center">
        <th width="40"><b><font size="5">ITEM NO.</font></b></th>
        <th colspan="5"><b>PRODUCT - DESCRIPTION</b></th>
        <th><b>QTY</b></th>
        <th><b>UNIT</b></th>
        <th><b>UNIT PRICE</b></th>
        <th width="80"><b>TOTAL</b></th>
    </tr>

    
    <tr> 
        <td width="40" align="center">1</td>
        <td colspan="5">Latex Gloves - Small</td>
        <td align="center">1</td>
        <td align="center">Case</td>
        <td align="right">1,500.00</td>
        <td width="80" align="right">1,500.00</td>
    </tr>
    <tr> 
        <td width="40" align="center">2</td>
        <td colspan="5">Nitrile Gloves - Medium</td>
        <td align="center">1</td>
        <td align="center">Case</td>
        <td align="right">1,900.00</td>
        <td width="80" align="right">1,900.00</td>
    </tr>


    <tr> 
        <td colspan="9" align="right">SUBTOTAL:</td>
        <td width="80" align="right">3,400.00</td>
    </tr>

</table>
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');

// -----------------------------------------------------------------------------

$tbl = <<<EOD
<br>
<table cellspacing="" cellpadding="1" border="0" bottom="10">
    <tr> 
        <td width="40"><b>Note</b></td>
        <td colspan="5">Payment Term: CBD (Cash Before Delivery)</td>
        <td colspan="3" align="right">Shipping</td>
        <td  width="80" align="right">1,000.00</td>
    </tr>

    <tr> 
        <td></td>
        <td colspan="5">Bank-Branch: ChinaBank, Fort Bonifacio</td>
        <td colspan="3" align="right">Less Discount:</td>
        <td  width="80" align="right">2,525.50</td>
    </tr>

    <tr> 
        <td></td>
        <td colspan="5">Account: Lab Elements Opc - 1155-0000-3202</td>
        <td colspan="3" align="right"><b>GRAND TOTAL:</b></td>
        <td  width="80" align="right"><b>3,525.50</b></td>
    </tr>
    
    <br>
    <br>
    <tr>
        <td colspan="2">Prepared By:</td>    
    </tr>
    <tr>
        <td colspan="5">Lab Elements Opc</td>
    </tr>

</table>

EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');

// -----------------------------------------------------------------------------

//Close and output PDF document
$pdf->Output('Lab_Elements_Quotation_0001.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
