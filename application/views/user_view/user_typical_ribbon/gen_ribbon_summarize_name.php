<?php

// create new PDF document
$pdf = new PDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
// $pdf->SetHeaderMargin(15);
// $pdf->SetFooterMargin(1);

// set auto page breaks

$pdf->SetAutoPageBreak(TRUE, 10);

// set font
$fontname = TCPDF_FONTS::addTTFfont(FCPATH . 'assets/fonts/THSarabun.ttf', 'TrueTypeUnicode', '', 96);
$pdf->SetFont($fontname, '', 15, '', true);

/******************************************************* */
// add a page มหาปรมาภรณ์ช้างเผือก
$pdf->SetMargins(10, 10, 5, true);
$pdf->AddPage('L');
$pdf->writeHTMLCell(0, '', '', '', 'บัญชีรายชื่อข้าราชการทหารผู้ขอพระราชทานเครื่องราชอิสริยาภรณ์', 0, 1, 0, true, 'C', true);
$pdf->writeHTMLCell(0, '', '', '', "ประจำปี พ.ศ. {$year}", 0, 1, 0, true, 'C', true);
$pdf->writeHTMLCell(0, '', '', '', "กองทัพไทย", 0, 1, 0, true, 'C', true);
$pdf->writeHTMLCell(0, '', '', '', $unit_name['NPRT_NAME'], 0, 1, 0, true, 'C', true);
$pdf->writeHTMLCell(0, '', '', '', 'มหาปรมาภรณ์ช้างเผือก', 0, 1, 0, true, 'C', true);
$pdf->Ln(5);

$mpcNum = 1;
$html = '';
foreach ($persons_mpc as $r) {
    $html .= "{$mpcNum}&nbsp;{$r['BIOG_NAME']} <br />";
    $mpcNum++;
}
$pdf->SetMargins(45, 10, 5, true);
$pdf->setEqualColumns(2); 
$pdf->writeHTML($html);
$pdf->resetColumns();

/******************************************************* */
// add a page มหาวชิรมงกุฎ
$pdf->SetMargins(10, 10, 5, true);

$pdf->AddPage('L');
$pdf->writeHTMLCell(0, '', '', '', 'บัญชีรายชื่อข้าราชการทหารผู้ขอพระราชทานเครื่องราชอิสริยาภรณ์', 0, 1, 0, true, 'C', true);
$pdf->writeHTMLCell(0, '', '', '', "ประจำปี พ.ศ. {$year}", 0, 1, 0, true, 'C', true);
$pdf->writeHTMLCell(0, '', '', '', "กองทัพไทย", 0, 1, 0, true, 'C', true);
$pdf->writeHTMLCell(0, '', '', '', $unit_name['NPRT_NAME'], 0, 1, 0, true, 'C', true);
$pdf->writeHTMLCell(0, '', '', '', 'มหาวชิรมงกุฎ', 0, 1, 0, true, 'C', true);
$pdf->Ln(5);

$mvmNum = 1;
$html = '';
foreach ($persons_mvm as $r) {
    $html .= "{$mvmNum}&nbsp;{$r['BIOG_NAME']} <br />";
    $mvmNum++;
}
$pdf->SetMargins(45, 10, 5, true);
$pdf->setEqualColumns(2); 
$pdf->writeHTML($html);
$pdf->resetColumns();

/******************************************************* */
// add a page ประถมาภรณ์ช้างเผือก
$pdf->SetMargins(10, 10, 5, true);
$pdf->AddPage('L');
$pdf->writeHTMLCell(0, '', '', '', 'บัญชีรายชื่อข้าราชการทหารผู้ขอพระราชทานเครื่องราชอิสริยาภรณ์', 0, 1, 0, true, 'C', true);
$pdf->writeHTMLCell(0, '', '', '', "ประจำปี พ.ศ. {$year}", 0, 1, 0, true, 'C', true);
$pdf->writeHTMLCell(0, '', '', '', "กองทัพไทย", 0, 1, 0, true, 'C', true);
$pdf->writeHTMLCell(0, '', '', '', $unit_name['NPRT_NAME'], 0, 1, 0, true, 'C', true);
$pdf->writeHTMLCell(0, '', '', '', 'ประถมาภรณ์ช้างเผือก', 0, 1, 0, true, 'C', true);
$pdf->Ln(5);

$pcNum = 1;
$html = '';
foreach ($persons_pc as $r) {
    $html .= "{$pcNum}&nbsp;{$r['BIOG_NAME']} <br />";
    $pcNum++;
}
$pdf->SetMargins(45, 10, 5, true);
$pdf->setEqualColumns(2); 
$pdf->writeHTML($html);
$pdf->resetColumns();

/******************************************************* */
// add a page ประถมาภรณ์มงกุฎไทย
$pdf->SetMargins(10, 10, 5, true);
$pdf->AddPage('L');
$pdf->writeHTMLCell(0, '', '', '', 'บัญชีรายชื่อข้าราชการทหารผู้ขอพระราชทานเครื่องราชอิสริยาภรณ์', 0, 1, 0, true, 'C', true);
$pdf->writeHTMLCell(0, '', '', '', "ประจำปี พ.ศ. {$year}", 0, 1, 0, true, 'C', true);
$pdf->writeHTMLCell(0, '', '', '', "กองทัพไทย", 0, 1, 0, true, 'C', true);
$pdf->writeHTMLCell(0, '', '', '', $unit_name['NPRT_NAME'], 0, 1, 0, true, 'C', true);
$pdf->writeHTMLCell(0, '', '', '', 'ประถมาภรณ์มงกุฎไทย', 0, 1, 0, true, 'C', true);
$pdf->Ln(5);

$pmNum = 1;
$html = '';
foreach ($persons_pm as $r) {
    $html .= "{$pmNum}&nbsp;{$r['BIOG_NAME']} <br />";
    $pmNum++;
}
$pdf->SetMargins(45, 10, 5, true);
$pdf->setEqualColumns(2); 
$pdf->writeHTML($html);
$pdf->resetColumns();


$pdf->Output('A.pdf', 'I');
?>