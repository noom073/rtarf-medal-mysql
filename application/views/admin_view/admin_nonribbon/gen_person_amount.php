<?php
// echo $mpc['men'] > 0 ? $mpc['men'] : '-';
// exit;
$thcMen     = $thc['men'] > 0 ? $thc['men'] : '-';
$thcWomen   = $thc['women'] > 0 ? $thc['women'] : '-';
$thmMen     = $thm['men'] > 0 ? $thm['men'] : '-';
$thmWomen   = $thm['women'] > 0 ? $thm['women'] : '-';
$tcMen      = $tc['men'] > 0 ? $tc['men'] : '-';
$tcWomen    = $tc['women'] > 0 ? $tc['women'] : '-';
$tmMen      = $tm['men'] > 0 ? $tm['men'] : '-';
$tmWomen    = $tm['women'] > 0 ? $tm['women'] : '-';
$jcMen      = $jc['men'] > 0 ? $jc['men'] : '-';
$jcWomen    = $jc['women'] > 0 ? $jc['women'] : '-';
$jmMen      = $jm['men'] > 0 ? $jm['men'] : '-';
$jmWomen    = $jm['women'] > 0 ? $jm['women'] : '-';
$bcMen      = $bc['men'] > 0 ? $bc['men'] : '-';
$bcWomen    = $bc['women'] > 0 ? $bc['women'] : '-';
$bmMen      = $bm['men'] > 0 ? $bm['men'] : '-';
$bmWomen    = $bm['women'] > 0 ? $bm['women'] : '-';
$rtcMen      = $rtc['men'] > 0 ? $rtc['men'] : '-';
$rtcWomen    = $rtc['women'] > 0 ? $rtc['women'] : '-';
$rtmMen      = $rtm['men'] > 0 ? $rtm['men'] : '-';
$rtmWomen    = $rtm['women'] > 0 ? $rtm['women'] : '-';
$rgcMen      = $rgc['men'] > 0 ? $rgc['men'] : '-';
$rgcWomen    = $rgc['women'] > 0 ? $rgc['women'] : '-';
$rgmMen      = $rgm['men'] > 0 ? $rgm['men'] : '-';
$rgmWomen    = $rgm['women'] > 0 ? $rgm['women'] : '-';

$countMen   = $thc['men'] + $thm['men'] + $tc['men'] + $tm['men'] + $jc['men'] + $jm['men'] + $bc['men'] + $bm['men'] + $rtc['men'] + $rtm['men'] + $rgc['men'] + $rgm['men'];
$countWomen = $thc['women'] + $thm['women'] + $tc['women'] + $tm['women'] + $jc['women'] + $jm['women'] + $bc['women'] + $bm['women'] + $rtc['women'] + $rtm['women'] + $rgc['women'] + $rgm['women'];
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
$pdf->SetMargins(3, 10, 3, true);
$pdf->AddPage('L');
$pdf->writeHTMLCell(0, '', '', '', 'บัญชีแสดงจำนวนชั้นตราเครื่องราชอิสริยาภรณ์', 0, 1, 0, true, 'C', true);
$pdf->writeHTMLCell(0, '', '', '', "ซึ่งขอพระราชทานให้แก่ข้าราชการทหาร", 0, 1, 0, true, 'C', true);
$pdf->writeHTMLCell(0, '', '', '', "กองทัพไทย", 0, 1, 0, true, 'C', true);
$pdf->writeHTMLCell(0, '', '', '', "ชั้นสายสะพาย ประจำปี พ.ศ. {$year}", 0, 1, 0, true, 'C', true);
$pdf->Ln(5);


$html = '';
$html .= '<table border=".5" cellpadding="2" cellspacing="0">';
$html   .= '<thead>';
$html       .= '<tr>';
$html           .= '<th rowspan="3" style="text-align:center;" width="5%">ลำดับ</th>';
$html           .= '<th rowspan="3" style="text-align:center;" width="15%">กรม/ส่วนราชการที่เทียบเท่า</th>';
$html           .= '<th colspan="24" style="text-align:center;" width="67%">เครื่องราชอิสริยาภรณ์</th>';
$html           .= '<th rowspan="2" colspan="2" style="text-align:center;" width="5%">รวม <br /> จำนวน</th>';
$html           .= '<th rowspan="3" style="text-align:center;" width="8%">หมายเหตุ</th>';
$html       .= '</tr>';
$html       .= '<tr>';
$html           .= '<th colspan="2" style="text-align:center;">ท.ช.</th>';
$html           .= '<th colspan="2" style="text-align:center;">ท.ม.</th>';
$html           .= '<th colspan="2" style="text-align:center;">ต.ช.</th>';
$html           .= '<th colspan="2" style="text-align:center;">ต.ม.</th>';
$html           .= '<th colspan="2" style="text-align:center;">จ.ช.</th>';
$html           .= '<th colspan="2" style="text-align:center;">จ.ม.</th>';
$html           .= '<th colspan="2" style="text-align:center;">บ.ช.</th>';
$html           .= '<th colspan="2" style="text-align:center;">บ.ม.</th>';
$html           .= '<th colspan="2" style="text-align:center;">ร.ท.ช.</th>';
$html           .= '<th colspan="2" style="text-align:center;">ร.ท.ม.</th>';
$html           .= '<th colspan="2" style="text-align:center;">ร.ง.ช.</th>';
$html           .= '<th colspan="2" style="text-align:center;">ร.ง.ม.</th>';
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
$html           .= '<th style="text-align:center;">บุรุษ</th>';
$html           .= '<th style="text-align:center;">สตรี</th>';
$html           .= '<th style="text-align:center;">บุรุษ</th>';
$html           .= '<th style="text-align:center;">สตรี</th>';
$html       .= '</tr>';
$html   .= '</thead>';
$html   .= '<tbody>';
$html       .= '<tr>';
$html           .= '<th style="text-align:center;" width="5%">1</th>';
$html           .= '<th style="text-align:left;" width="15%">' . $unit_name['NPRT_NAME'] . '</th>';

$html           .= '<th style="text-align:center;" width="2.79%">' . $thcMen . '</th>';
$html           .= '<th style="text-align:center;" width="2.79%">' . $thcWomen . '</th>';
$html           .= '<th style="text-align:center;" width="2.79%">' . $thmMen . '</th>';
$html           .= '<th style="text-align:center;" width="2.79%">' . $thmWomen . '</th>';
$html           .= '<th style="text-align:center;" width="2.79%">' . $tcMen . '</th>';
$html           .= '<th style="text-align:center;" width="2.79%">' . $tcWomen . '</th>';
$html           .= '<th style="text-align:center;" width="2.79%">' . $tmMen . '</th>';
$html           .= '<th style="text-align:center;" width="2.79%">' . $tmWomen . '</th>';
$html           .= '<th style="text-align:center;" width="2.79%">' . $jcMen . '</th>';
$html           .= '<th style="text-align:center;" width="2.79%">' . $jcWomen . '</th>';
$html           .= '<th style="text-align:center;" width="2.79%">' . $jmMen . '</th>';
$html           .= '<th style="text-align:center;" width="2.79%">' . $jmWomen . '</th>';
$html           .= '<th style="text-align:center;" width="2.79%">' . $bcMen . '</th>';
$html           .= '<th style="text-align:center;" width="2.79%">' . $bcWomen . '</th>';
$html           .= '<th style="text-align:center;" width="2.79%">' . $bmMen . '</th>';
$html           .= '<th style="text-align:center;" width="2.79%">' . $bmWomen . '</th>';
$html           .= '<th style="text-align:center;" width="2.79%">' . $rtcMen . '</th>';
$html           .= '<th style="text-align:center;" width="2.79%">' . $rtcWomen . '</th>';
$html           .= '<th style="text-align:center;" width="2.79%">' . $rtmMen . '</th>';
$html           .= '<th style="text-align:center;" width="2.79%">' . $rtmWomen . '</th>';
$html           .= '<th style="text-align:center;" width="2.79%">' . $rgcMen . '</th>';
$html           .= '<th style="text-align:center;" width="2.79%">' . $rgcWomen . '</th>';
$html           .= '<th style="text-align:center;" width="2.79%">' . $rgmMen . '</th>';
$html           .= '<th style="text-align:center;" width="2.79%">' . $rgmWomen . '</th>';

$html           .= '<th style="text-align:center;" width="2.5%">' . $countMen . '</th>';
$html           .= '<th style="text-align:center;" width="2.5%">' . $countWomen . '</th>';
$html           .= '<th style="text-align:center;" width="8%"></th>';
$html       .= '</tr>';
$html       .= '<tr>';
$html           .= '<th style="text-align:center;" width="5%"></th>';
$html           .= '<th style="text-align:center;" width="15%">รวม</th>';
$html           .= '<th style="text-align:center;" width="2.79%">' . $thcMen . '</th>';
$html           .= '<th style="text-align:center;" width="2.79%">' . $thcWomen . '</th>';
$html           .= '<th style="text-align:center;" width="2.79%">' . $thmMen . '</th>';
$html           .= '<th style="text-align:center;" width="2.79%">' . $thmWomen . '</th>';
$html           .= '<th style="text-align:center;" width="2.79%">' . $tcMen . '</th>';
$html           .= '<th style="text-align:center;" width="2.79%">' . $tcWomen . '</th>';
$html           .= '<th style="text-align:center;" width="2.79%">' . $tmMen . '</th>';
$html           .= '<th style="text-align:center;" width="2.79%">' . $tmWomen . '</th>';
$html           .= '<th style="text-align:center;" width="2.79%">' . $jcMen . '</th>';
$html           .= '<th style="text-align:center;" width="2.79%">' . $jcWomen . '</th>';
$html           .= '<th style="text-align:center;" width="2.79%">' . $jmMen . '</th>';
$html           .= '<th style="text-align:center;" width="2.79%">' . $jmWomen . '</th>';
$html           .= '<th style="text-align:center;" width="2.79%">' . $bcMen . '</th>';
$html           .= '<th style="text-align:center;" width="2.79%">' . $bcWomen . '</th>';
$html           .= '<th style="text-align:center;" width="2.79%">' . $bmMen . '</th>';
$html           .= '<th style="text-align:center;" width="2.79%">' . $bmWomen . '</th>';
$html           .= '<th style="text-align:center;" width="2.79%">' . $rtcMen . '</th>';
$html           .= '<th style="text-align:center;" width="2.79%">' . $rtcWomen . '</th>';
$html           .= '<th style="text-align:center;" width="2.79%">' . $rtmMen . '</th>';
$html           .= '<th style="text-align:center;" width="2.79%">' . $rtmWomen . '</th>';
$html           .= '<th style="text-align:center;" width="2.79%">' . $rgcMen . '</th>';
$html           .= '<th style="text-align:center;" width="2.79%">' . $rgcWomen . '</th>';
$html           .= '<th style="text-align:center;" width="2.79%">' . $rgmMen . '</th>';
$html           .= '<th style="text-align:center;" width="2.79%">' . $rgmWomen . '</th>';

$html           .= '<th style="text-align:center;" width="2.5%">' . $countMen . '</th>';
$html           .= '<th style="text-align:center;" width="2.5%">' . $countWomen . '</th>';
$html           .= '<th style="text-align:center;" width="8%"></th>';
$html       .= '</tr>';
$html   .= '</tbody>';
$html .= '</table>';

// echo $html;
$pdf->writeHTML($html, true, 0, true, 0);
$pdf->Output('A.pdf', 'I');
