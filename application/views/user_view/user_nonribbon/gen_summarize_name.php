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
// add a page ทวีติยาภรณ์ช้างเผือก
$pdf->SetMargins(10, 10, 5, true);
$pdf->AddPage('L');
$pdf->writeHTMLCell(0, '', '', '', 'บัญชีรายชื่อข้าราชการทหารผู้ขอพระราชทานเครื่องราชอิสริยาภรณ์', 0, 1, 0, true, 'C', true);
$pdf->writeHTMLCell(0, '', '', '', "ประจำปี พ.ศ. {$year}", 0, 1, 0, true, 'C', true);
$pdf->writeHTMLCell(0, '', '', '', "กองทัพไทย", 0, 1, 0, true, 'C', true);
$pdf->writeHTMLCell(0, '', '', '', $unit_name['NPRT_NAME'], 0, 1, 0, true, 'C', true);
$pdf->writeHTMLCell(0, '', '', '', 'ทวีติยาภรณ์ช้างเผือก', 0, 1, 0, true, 'C', true);
$pdf->Ln(5);

$thcNum = 1;
$html = '';
foreach ($thc as $r) {
    $html .= "{$thcNum}&nbsp;{$r['BIOG_NAME']} <br />";
    $thcNum++;
}
$pdf->SetMargins(45, 10, 5, true);
$pdf->setEqualColumns(2); 
$pdf->writeHTML($html);
$pdf->resetColumns();

/******************************************************* */
// add a page ทวีติยาภรณ์มงกุฎไทย
$pdf->SetMargins(10, 10, 5, true);

$pdf->AddPage('L');
$pdf->writeHTMLCell(0, '', '', '', 'บัญชีรายชื่อข้าราชการทหารผู้ขอพระราชทานเครื่องราชอิสริยาภรณ์', 0, 1, 0, true, 'C', true);
$pdf->writeHTMLCell(0, '', '', '', "ประจำปี พ.ศ. {$year}", 0, 1, 0, true, 'C', true);
$pdf->writeHTMLCell(0, '', '', '', "กองทัพไทย", 0, 1, 0, true, 'C', true);
$pdf->writeHTMLCell(0, '', '', '', $unit_name['NPRT_NAME'], 0, 1, 0, true, 'C', true);
$pdf->writeHTMLCell(0, '', '', '', 'ทวีติยาภรณ์มงกุฎไทย', 0, 1, 0, true, 'C', true);
$pdf->Ln(5);

$thmNum = 1;
$html = '';
foreach ($thm as $r) {
    $html .= "{$thmNum}&nbsp;{$r['BIOG_NAME']} <br />";
    $thmNum++;
}
$pdf->SetMargins(45, 10, 5, true);
$pdf->setEqualColumns(2); 
$pdf->writeHTML($html);
$pdf->resetColumns();

/******************************************************* */
// add a page ตริตาภรณ์ช้างเผือก
$pdf->SetMargins(10, 10, 5, true);
$pdf->AddPage('L');
$pdf->writeHTMLCell(0, '', '', '', 'บัญชีรายชื่อข้าราชการทหารผู้ขอพระราชทานเครื่องราชอิสริยาภรณ์', 0, 1, 0, true, 'C', true);
$pdf->writeHTMLCell(0, '', '', '', "ประจำปี พ.ศ. {$year}", 0, 1, 0, true, 'C', true);
$pdf->writeHTMLCell(0, '', '', '', "กองทัพไทย", 0, 1, 0, true, 'C', true);
$pdf->writeHTMLCell(0, '', '', '', $unit_name['NPRT_NAME'], 0, 1, 0, true, 'C', true);
$pdf->writeHTMLCell(0, '', '', '', 'ตริตาภรณ์ช้างเผือก', 0, 1, 0, true, 'C', true);
$pdf->Ln(5);

$tcNum = 1;
$html = '';
foreach ($tc as $r) {
    $html .= "{$tcNum}&nbsp;{$r['BIOG_NAME']} <br />";
    $tcNum++;
}
$pdf->SetMargins(45, 10, 5, true);
$pdf->setEqualColumns(2); 
$pdf->writeHTML($html);
$pdf->resetColumns();

/******************************************************* */
// add a page ตริตาภรณ์มงกุฏไทย
$pdf->SetMargins(10, 10, 5, true);
$pdf->AddPage('L');
$pdf->writeHTMLCell(0, '', '', '', 'บัญชีรายชื่อข้าราชการทหารผู้ขอพระราชทานเครื่องราชอิสริยาภรณ์', 0, 1, 0, true, 'C', true);
$pdf->writeHTMLCell(0, '', '', '', "ประจำปี พ.ศ. {$year}", 0, 1, 0, true, 'C', true);
$pdf->writeHTMLCell(0, '', '', '', "กองทัพไทย", 0, 1, 0, true, 'C', true);
$pdf->writeHTMLCell(0, '', '', '', $unit_name['NPRT_NAME'], 0, 1, 0, true, 'C', true);
$pdf->writeHTMLCell(0, '', '', '', 'ตริตาภรณ์มงกุฏไทย', 0, 1, 0, true, 'C', true);
$pdf->Ln(5);

$tmNum = 1;
$html = '';
foreach ($tm as $r) {
    $html .= "{$tmNum}&nbsp;{$r['BIOG_NAME']} <br />";
    $tmNum++;
}
$pdf->SetMargins(45, 10, 5, true);
$pdf->setEqualColumns(2); 
$pdf->writeHTML($html);
$pdf->resetColumns();

/******************************************************* */
// add a page จัตุรถาภรณ์ช้างเผือก
$pdf->SetMargins(10, 10, 5, true);
$pdf->AddPage('L');
$pdf->writeHTMLCell(0, '', '', '', 'บัญชีรายชื่อข้าราชการทหารผู้ขอพระราชทานเครื่องราชอิสริยาภรณ์', 0, 1, 0, true, 'C', true);
$pdf->writeHTMLCell(0, '', '', '', "ประจำปี พ.ศ. {$year}", 0, 1, 0, true, 'C', true);
$pdf->writeHTMLCell(0, '', '', '', "กองทัพไทย", 0, 1, 0, true, 'C', true);
$pdf->writeHTMLCell(0, '', '', '', $unit_name['NPRT_NAME'], 0, 1, 0, true, 'C', true);
$pdf->writeHTMLCell(0, '', '', '', 'จัตุรถาภรณ์ช้างเผือก', 0, 1, 0, true, 'C', true);
$pdf->Ln(5);

$jcNum = 1;
$html = '';
foreach ($jc as $r) {
    $html .= "{$jcNum}&nbsp;{$r['BIOG_NAME']} <br />";
    $jcNum++;
}
$pdf->SetMargins(45, 10, 5, true);
$pdf->setEqualColumns(2); 
$pdf->writeHTML($html);
$pdf->resetColumns();

/******************************************************* */
// add a page จัตุรถาภรณ์มงกุฏไทย
$pdf->SetMargins(10, 10, 5, true);
$pdf->AddPage('L');
$pdf->writeHTMLCell(0, '', '', '', 'บัญชีรายชื่อข้าราชการทหารผู้ขอพระราชทานเครื่องราชอิสริยาภรณ์', 0, 1, 0, true, 'C', true);
$pdf->writeHTMLCell(0, '', '', '', "ประจำปี พ.ศ. {$year}", 0, 1, 0, true, 'C', true);
$pdf->writeHTMLCell(0, '', '', '', "กองทัพไทย", 0, 1, 0, true, 'C', true);
$pdf->writeHTMLCell(0, '', '', '', $unit_name['NPRT_NAME'], 0, 1, 0, true, 'C', true);
$pdf->writeHTMLCell(0, '', '', '', 'จัตุรถาภรณ์มงกุฏไทย', 0, 1, 0, true, 'C', true);
$pdf->Ln(5);

$jmNum = 1;
$html = '';
foreach ($jm as $r) {
    $html .= "{$jmNum}&nbsp;{$r['BIOG_NAME']} <br />";
    $jmNum++;
}
$pdf->SetMargins(45, 10, 5, true);
$pdf->setEqualColumns(2); 
$pdf->writeHTML($html);
$pdf->resetColumns();

/******************************************************* */
// add a page เบญจมาภรณ์ช้างเผือก
$pdf->SetMargins(10, 10, 5, true);
$pdf->AddPage('L');
$pdf->writeHTMLCell(0, '', '', '', 'บัญชีรายชื่อข้าราชการทหารผู้ขอพระราชทานเครื่องราชอิสริยาภรณ์', 0, 1, 0, true, 'C', true);
$pdf->writeHTMLCell(0, '', '', '', "ประจำปี พ.ศ. {$year}", 0, 1, 0, true, 'C', true);
$pdf->writeHTMLCell(0, '', '', '', "กองทัพไทย", 0, 1, 0, true, 'C', true);
$pdf->writeHTMLCell(0, '', '', '', $unit_name['NPRT_NAME'], 0, 1, 0, true, 'C', true);
$pdf->writeHTMLCell(0, '', '', '', 'เบญจมาภรณ์ช้างเผือก', 0, 1, 0, true, 'C', true);
$pdf->Ln(5);

$bcNum = 1;
$html = '';
foreach ($bc as $r) {
    $html .= "{$bcNum}&nbsp;{$r['BIOG_NAME']} <br />";
    $bcNum++;
}
$pdf->SetMargins(45, 10, 5, true);
$pdf->setEqualColumns(2); 
$pdf->writeHTML($html);
$pdf->resetColumns();

/******************************************************* */
// add a page เบญจมาภรณ์มงกุฎไทย
$pdf->SetMargins(10, 10, 5, true);
$pdf->AddPage('L');
$pdf->writeHTMLCell(0, '', '', '', 'บัญชีรายชื่อข้าราชการทหารผู้ขอพระราชทานเครื่องราชอิสริยาภรณ์', 0, 1, 0, true, 'C', true);
$pdf->writeHTMLCell(0, '', '', '', "ประจำปี พ.ศ. {$year}", 0, 1, 0, true, 'C', true);
$pdf->writeHTMLCell(0, '', '', '', "กองทัพไทย", 0, 1, 0, true, 'C', true);
$pdf->writeHTMLCell(0, '', '', '', $unit_name['NPRT_NAME'], 0, 1, 0, true, 'C', true);
$pdf->writeHTMLCell(0, '', '', '', 'เบญจมาภรณ์มงกุฎไทย', 0, 1, 0, true, 'C', true);
$pdf->Ln(5);

$bmNum = 1;
$html = '';
foreach ($bm as $r) {
    $html .= "{$bmNum}&nbsp;{$r['BIOG_NAME']} <br />";
    $bmNum++;
}
$pdf->SetMargins(45, 10, 5, true);
$pdf->setEqualColumns(2); 
$pdf->writeHTML($html);
$pdf->resetColumns();

/******************************************************* */
// add a page เหรียญทองช้างเผือก
$pdf->SetMargins(10, 10, 5, true);
$pdf->AddPage('L');
$pdf->writeHTMLCell(0, '', '', '', 'บัญชีรายชื่อข้าราชการทหารผู้ขอพระราชทานเครื่องราชอิสริยาภรณ์', 0, 1, 0, true, 'C', true);
$pdf->writeHTMLCell(0, '', '', '', "ประจำปี พ.ศ. {$year}", 0, 1, 0, true, 'C', true);
$pdf->writeHTMLCell(0, '', '', '', "กองทัพไทย", 0, 1, 0, true, 'C', true);
$pdf->writeHTMLCell(0, '', '', '', $unit_name['NPRT_NAME'], 0, 1, 0, true, 'C', true);
$pdf->writeHTMLCell(0, '', '', '', 'เหรียญทองช้างเผือก', 0, 1, 0, true, 'C', true);
$pdf->Ln(5);

$rtcNum = 1;
$html = '';
foreach ($rtc as $r) {
    $html .= "{$rtcNum}&nbsp;{$r['BIOG_NAME']} <br />";
    $rtcNum++;
}
$pdf->SetMargins(45, 10, 5, true);
$pdf->setEqualColumns(2); 
$pdf->writeHTML($html);
$pdf->resetColumns();

/******************************************************* */
// add a page เหรียญทองมงกุฎไทย
$pdf->SetMargins(10, 10, 5, true);
$pdf->AddPage('L');
$pdf->writeHTMLCell(0, '', '', '', 'บัญชีรายชื่อข้าราชการทหารผู้ขอพระราชทานเครื่องราชอิสริยาภรณ์', 0, 1, 0, true, 'C', true);
$pdf->writeHTMLCell(0, '', '', '', "ประจำปี พ.ศ. {$year}", 0, 1, 0, true, 'C', true);
$pdf->writeHTMLCell(0, '', '', '', "กองทัพไทย", 0, 1, 0, true, 'C', true);
$pdf->writeHTMLCell(0, '', '', '', $unit_name['NPRT_NAME'], 0, 1, 0, true, 'C', true);
$pdf->writeHTMLCell(0, '', '', '', 'เหรียญทองมงกุฎไทย', 0, 1, 0, true, 'C', true);
$pdf->Ln(5);

$rtmNum = 1;
$html = '';
foreach ($rtm as $r) {
    $html .= "{$rtmNum}&nbsp;{$r['BIOG_NAME']} <br />";
    $rtmNum++;
}
$pdf->SetMargins(45, 10, 5, true);
$pdf->setEqualColumns(2); 
$pdf->writeHTML($html);
$pdf->resetColumns();

/******************************************************* */
// add a page เหรียญเงินช้างเผือก
$pdf->SetMargins(10, 10, 5, true);
$pdf->AddPage('L');
$pdf->writeHTMLCell(0, '', '', '', 'บัญชีรายชื่อข้าราชการทหารผู้ขอพระราชทานเครื่องราชอิสริยาภรณ์', 0, 1, 0, true, 'C', true);
$pdf->writeHTMLCell(0, '', '', '', "ประจำปี พ.ศ. {$year}", 0, 1, 0, true, 'C', true);
$pdf->writeHTMLCell(0, '', '', '', "กองทัพไทย", 0, 1, 0, true, 'C', true);
$pdf->writeHTMLCell(0, '', '', '', $unit_name['NPRT_NAME'], 0, 1, 0, true, 'C', true);
$pdf->writeHTMLCell(0, '', '', '', 'เหรียญเงินช้างเผือก', 0, 1, 0, true, 'C', true);
$pdf->Ln(5);

$rgcNum = 1;
$html = '';
foreach ($rgc as $r) {
    $html .= "{$rgcNum}&nbsp;{$r['BIOG_NAME']} <br />";
    $rgcNum++;
}
$pdf->SetMargins(45, 10, 5, true);
$pdf->setEqualColumns(2); 
$pdf->writeHTML($html);
$pdf->resetColumns();

/******************************************************* */
// add a page เหรียญเงินมงกุฎไทย
$pdf->SetMargins(10, 10, 5, true);
$pdf->AddPage('L');
$pdf->writeHTMLCell(0, '', '', '', 'บัญชีรายชื่อข้าราชการทหารผู้ขอพระราชทานเครื่องราชอิสริยาภรณ์', 0, 1, 0, true, 'C', true);
$pdf->writeHTMLCell(0, '', '', '', "ประจำปี พ.ศ. {$year}", 0, 1, 0, true, 'C', true);
$pdf->writeHTMLCell(0, '', '', '', "กองทัพไทย", 0, 1, 0, true, 'C', true);
$pdf->writeHTMLCell(0, '', '', '', $unit_name['NPRT_NAME'], 0, 1, 0, true, 'C', true);
$pdf->writeHTMLCell(0, '', '', '', 'เหรียญเงินมงกุฎไทย', 0, 1, 0, true, 'C', true);
$pdf->Ln(5);

$rgmNum = 1;
$html = '';
foreach ($rgm as $r) {
    $html .= "{$rgmNum}&nbsp;{$r['BIOG_NAME']} <br />";
    $rgmNum++;
}
$pdf->SetMargins(45, 10, 5, true);
$pdf->setEqualColumns(2); 
$pdf->writeHTML($html);
$pdf->resetColumns();

/******************************************************* */

$pdf->Output('A.pdf', 'I');
?>