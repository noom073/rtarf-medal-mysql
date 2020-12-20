<?php
// echo $mpc['men'] > 0 ? $mpc['men'] : '-';
// exit;
$mpcMen     = $mpc['men'] > 0 ? $mpc['men'] : '-';
$mpcWomen   = $mpc['women'] > 0 ? $mpc['women'] : '-';
$mvmMen     = $mvm['men'] > 0 ? $mvm['men'] : '-';
$mvmWomen   = $mvm['women'] > 0 ? $mvm['women'] : '-';
$pcMen      = $pc['men'] > 0 ? $pc['men'] : '-';
$pcWomen    = $pc['women'] > 0 ? $pc['women'] : '-';
$pmMen      = $pm['men'] > 0 ? $pm['men'] : '-';
$pmWomen    = $pm['women'] > 0 ? $pm['women'] : '-';
$countMen   = $mpc['men'] + $mvm['men'] + $pc['men'] + $pm['men'];
$countWomen = $mpc['women'] + $mvm['women'] + $pc['women'] + $pm['women'];
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
$pdf->writeHTMLCell(0, '', '', '', 'บัญชีแสดงจำนวนชั้นตราเครื่องราชอิสริยาภรณ์', 0, 1, 0, true, 'C', true);
$pdf->writeHTMLCell(0, '', '', '', "ซึ่งขอพระราชทานให้แก่ข้าราชการทหาร", 0, 1, 0, true, 'C', true);
$pdf->writeHTMLCell(0, '', '', '', "กองทัพไทย", 0, 1, 0, true, 'C', true);
$pdf->writeHTMLCell(0, '', '', '', "ชั้นสายสะพาย ประจำปี พ.ศ. {$year}", 0, 1, 0, true, 'C', true);
$pdf->Ln(5);


$html = '';
$html .= '<table border=".5" cellpadding="3" cellspacing="0">';
$html   .= '<thead>';
$html       .= '<tr>';
$html           .= '<th rowspan="3" style="text-align:center;" width="5%">ลำดับ</th>';
$html           .= '<th rowspan="3" style="text-align:center;" width="25%">กรม/ส่วนราชการที่เทียบเท่า</th>';
$html           .= '<th colspan="8" style="text-align:center;" width="50%">เครื่องราชอิสริยาภรณ์</th>';
$html           .= '<th rowspan="2" colspan="2" style="text-align:center;" width="10%">รวมจำนวน</th>';
$html           .= '<th rowspan="3" style="text-align:center;" width="10%">หมายเหตุ</th>';
$html       .= '</tr>';
$html       .= '<tr>';
$html           .= '<th colspan="2" style="text-align:center;">ม.ป.ช.</th>';
$html           .= '<th colspan="2" style="text-align:center;">ม.ว.ม.</th>';
$html           .= '<th colspan="2" style="text-align:center;">ป.ช.</th>';
$html           .= '<th colspan="2" style="text-align:center;">ป.ม.</th>';
$html       .= '</tr>';
$html       .= '<tr>';
$html           .= '<th style="text-align:center;">บุรุษ</th>';
$html           .= '<th style="text-align:center;">สตรี</th>';
$html           .= '<th style="text-align:center;">บุรุษ</th>';
$html           .= '<th style="text-align:center;">สตรี</th>';
$html           .= '<th style="text-align:center;">บุรุษ</th>';
$html           .= '<th style="text-align:center;">สตรี</th>';
$html           .= '<th style="text-align:center;">บุรุษ</th>';
$html           .= '<th style="text-align:center;">สตรี</th>';
$html           .= '<th style="text-align:center;">บุรุษ</th>';
$html           .= '<th style="text-align:center;">สตรี</th>';
$html       .= '</tr>';
$html   .= '</thead>';
$html   .= '<tbody>';
$html       .= '<tr>';
$html           .= '<th style="text-align:center;" width="5%">1</th>';
$html           .= '<th style="text-align:left;" width="25%">' . $unit_name['NPRT_NAME'] . '</th>';
$html           .= '<th style="text-align:center;" width="6.25%">' . $mpcMen . '</th>';
$html           .= '<th style="text-align:center;" width="6.25%">' . $mpcWomen . '</th>';
$html           .= '<th style="text-align:center;" width="6.25%">' . $mvmMen . '</th>';
$html           .= '<th style="text-align:center;" width="6.25%">' . $mvmWomen . '</th>';
$html           .= '<th style="text-align:center;" width="6.25%">' . $pcMen . '</th>';
$html           .= '<th style="text-align:center;" width="6.25%">' . $pcWomen . '</th>';
$html           .= '<th style="text-align:center;" width="6.25%">' . $pmMen . '</th>';
$html           .= '<th style="text-align:center;" width="6.25%">' . $pmWomen . '</th>';
$html           .= '<th style="text-align:center;" width="5%">' . $countMen . '</th>';
$html           .= '<th style="text-align:center;" width="5%">' . $countWomen . '</th>';
$html           .= '<th style="text-align:center;" width="10%"></th>';
$html       .= '</tr>';
$html       .= '<tr>';
$html           .= '<th style="text-align:center;" width="5%"></th>';
$html           .= '<th style="text-align:center;" width="25%">รวม</th>';
$html           .= '<th style="text-align:center;" width="6.25%">' . $mpcMen . '</th>';
$html           .= '<th style="text-align:center;" width="6.25%">' . $mpcWomen . '</th>';
$html           .= '<th style="text-align:center;" width="6.25%">' . $mvmMen . '</th>';
$html           .= '<th style="text-align:center;" width="6.25%">' . $mvmWomen . '</th>';
$html           .= '<th style="text-align:center;" width="6.25%">' . $pcMen . '</th>';
$html           .= '<th style="text-align:center;" width="6.25%">' . $pcWomen . '</th>';
$html           .= '<th style="text-align:center;" width="6.25%">' . $pmMen . '</th>';
$html           .= '<th style="text-align:center;" width="6.25%">' . $pmWomen . '</th>';
$html           .= '<th style="text-align:center;" width="5%">' . $countMen . '</th>';
$html           .= '<th style="text-align:center;" width="5%">' . $countWomen . '</th>';
$html           .= '<th style="text-align:center;" width="10%"></th>';
$html       .= '</tr>';
$html   .= '</tbody>';
$html .= '</table>';

// echo $html;
$pdf->writeHTML($html, true, 0, true, 0);
$pdf->Output('A.pdf', 'I');
