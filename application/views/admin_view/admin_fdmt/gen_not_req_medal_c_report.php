<?php

class MYPDF extends PDF
{
    //Page header
    public function Header()
    {
        $fontname = TCPDF_FONTS::addTTFfont(FCPATH . 'assets/fonts/THSarabun.ttf', 'TrueTypeUnicode', '', 96);

        $this->SetFont($fontname, '', 14);

        $this->MultiCell(245, 5, 'พิมพ์เมื่อ ' . $this->curDate, 0, 'L', 0, 0, '', '', true);
        $this->MultiCell(55, 5, 'แผ่นที่ ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, 'R', 0, 1, '', '', true);

        $this->SetFont($fontname, '', 16);

        $html1 = '<span style="font-weight:bold;">บัญชีผู้ยังไม่ได้รับพระราชทานเครื่องราชอิสริยาภรณ์ชั้นต่ำกว่าสายสะพาย พ.ศ.' . $this->myYear . '</span>';
        $this->writeHTMLCell(0, '', '', '', $html1, 0, 1, 0, true, 'C', true);
        // $this->writeHTMLCell(0, '', '', '', 'ของข้าราชการ กองทัพไทย', 0, 1, 0, true, 'C', true);
        $this->writeHTMLCell(0, '', '', '', 'สังกัด  ' . $this->headerUnitName, 0, 1, 0, true, 'C', true);
    }

    // Page footer
    // public function Footer()
    // {
    //     // Position at 15 mm from bottom
    //     $this->SetY(-15);
    //     // Set font
    //     $fontname = TCPDF_FONTS::addTTFfont(FCPATH . 'assets/fonts/THSarabun.ttf', 'TrueTypeUnicode', '', 96);
    //     $this->SetFont($fontname, '', 14, '', true);
    //     $footer1 = '<span style="text-decoration: underline; font-weight:bold;">หมายเหตุ</span>';
    //     $this->writeHTMLCell(50, '', 30, '', $footer1, 0, 0, 0, true, 'C', true);
    //     $this->writeHTMLCell(30, '', '', '', '*** เกษียณปีปัจจุบัน', 0, 0, 0, true, 'C', true);
    //     $this->writeHTMLCell(30, '', '', '', 'xxx วดป.ผิด', 0, 0, 0, true, 'C', true);
    //     $this->writeHTMLCell(30, '', '', '', '-*- ไม่ครบขอฯ', 0, 0, 0, true, 'C', true);
    //     $this->writeHTMLCell(30, '', '', '', '-- ชั้นสูงสุด', 0, 0, 0, true, 'C', true);
    //     $this->writeHTMLCell(30, '', '', '', '??? เครื่องราชฯ เดิมผิด', 0, 0, 0, true, 'C', true);
    // }
}

// create new PDF document
$dm = date('dm') . strval( date('Y') + 543);

$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->headerUnitName = $unit_name['NPRT_NAME'];
$pdf->myYear = $year;
$pdf->curDate = $this->myfunction->dmy_to_thai($dm, 0);
// set document information
// $pdf->SetCreator(PDF_CREATOR);
// $pdf->SetAuthor('Nicola Asuni');
// $pdf->SetTitle('TCPDF Example 003');
// $pdf->SetSubject('TCPDF Tutorial');
// $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// $pdf->setPrintHeader(false);
// $pdf->setPrintFooter(false);
// echo PDF_HEADER_STRING;

// set margins
// $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
// $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
// $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetMargins(5, 45, 0);
$pdf->SetHeaderMargin(15);
$pdf->SetFooterMargin(1);

// set auto page breaks

$pdf->SetAutoPageBreak(TRUE, 10);

// set font
$fontname = TCPDF_FONTS::addTTFfont(FCPATH . 'assets/fonts/THSarabun.ttf', 'TrueTypeUnicode', '', 96);
$pdf->SetFont($fontname, '', 16, '', true);

// add a page
$pdf->AddPage('L');

// set Content To print
$num = 1;
$html = '<table border="0" cellpadding="0" cellspacing="0">';
$html .= '<thead>';
$html .= '<tr>';
$html .= '<th width="3%">ลำดับ</th>';
$html .= '<th width="1%"></th>';
$html .= '<th width="18%">ยศ นาม  นามสกุล</th>';
$html .= '<th width="11%">หมายเลขประจำตัว</th>';
$html .= '<th width="35%">ตำแหน่ง</th>';
$html .= '<th width="22%" colspan="5" align="center">เครื่องราชอิสริยาภรณ์/ปีที่รับ</th>';
$html .= '<th width="12%">หมายเหตุ</th>';
$html .= '</tr>';

$html .= '<tr>';
$html .= '<th colspan="5"></th>';
$html .= '<th width="5%">บ.ม.</th>';
$html .= '<th width="5%">บ.ช.</th>';
$html .= '<th width="5%">จ.ม.</th>';
$html .= '<th width="5%">จ.ช.</th>';
$html .= '<th width="12%"></th>';
$html .= '</tr>';
$html .= '</thead>';
$html .= '<tbody>';
foreach ($persons as $person) {
    // echo "{$num} {$person['BIOG_NAME']} {$person['BIOG_POSNAME']} - $txtLength : {$rowHeight} <br />";

    // $rank           = $this->person_data->army_rank($person['BIOG_RANK'])['CRAK_NAME_ACM'];
    // $biog_dmy_rank  = $this->myfunction->dmy_to_thai($person['BIOG_DMY_RANK'], 1);
    // $nearRetire     = $this->person_data->this_retire($person['BIOG_DMY_BORN']) === true ? '***' : '';
    // $cdecDate       = $this->person_data->set_cdec_date($person['BIOG_DECY']);
    // $this_medal     = $this->person_data->next_medal($person, $year);
    $n5 = $person['BIOG_RANK'] == '05' ? '*' : '';
    $bm = $this->person_data->cdec_year2($person['BIOG_ID'], array('บม.', 'บ.ม.'));
    $bc = $this->person_data->cdec_year2($person['BIOG_ID'], array('บช.', 'บ.ช.'));
    $jm = $this->person_data->cdec_year2($person['BIOG_ID'], array('จม.', 'จ.ม.'));
    $jc = $this->person_data->cdec_year2($person['BIOG_ID'], array('จช.', 'จ.ช.'));

    $html .= '<tr nobr="false">';
    $html .= '<td width="3%">' . $num . '</td>';
    $html .= '<td width="1%">' . $n5 . '</td>';
    $html .= '<td width="18%">' . $person['BIOG_NAME'] . '</td>';
    $html .= '<td width="11%">' . $person['BIOG_ID'] . '</td>';
    $html .= '<td width="35%">' . $person['BIOG_POSNAME'] . '</td>';
    $html .= '<td width="5%">' . $bm . '</td>';
    $html .= '<td width="5%">' . $bc . '</td>';
    $html .= '<td width="5%">' . $jm . '</td>';
    $html .= '<td width="5%">' . $jc . '</td>';
    $html .= '<td width="12%">' . '&nbsp;' . '</td>';
    $html .= '</tr>';

    $num++;
}

$html .= '</tbody>';
$html .= '</table>';

// echo $html;
$pdf->writeHTML($html, true, 0, true, 0);
$pdf->Output('A.pdf', 'I');
?>