<?php

class MYPDF extends PDF
{
    //Page header
    public function Header()
    {
        $fontname = TCPDF_FONTS::addTTFfont(FCPATH . 'assets/fonts/THSarabun.ttf', 'TrueTypeUnicode', '', 96);

        $this->SetFont($fontname, '', 14);
        // $this->MultiCell(245, 5, 'พิมพ์เมื่อ' . $this->PageNo(), 0, 'L', 0, 0, '', '', true);
        // $this->MultiCell(245, 5, 'พิมพ์เมื่อ ' . $this->curDate, 0, 'L', 0, 0, '', '', true);
        // $this->MultiCell(55, 5, 'แผ่นที่ ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, 'R', 0, 1, '', '', true);

        $this->SetFont($fontname, '', 16);

        $head = '<span style="font-weight:bold;">บัญชีแสดงคุณสมบัติของข้าราชการทหาร ซึ่งเสนอขอพระราชทานเครื่องราชอิสริยาภรณ์ประจำปี พ.ศ.' . $this->myYear . '</span>';
        $this->writeHTMLCell(0, '', '', '', $head, 0, 1, 0, true, 'C', true);
        // $this->writeHTMLCell(0, '', '', '', 'ของข้าราชการ กองทัพไทย', 0, 1, 0, true, 'C', true);
        $this->writeHTMLCell(0, '', '', '', 'กองทัพไทย', 0, 1, 0, true, 'C', true);
        $this->writeHTMLCell(0, '', '', '', $this->headerUnitName, 0, 1, 0, true, 'C', true);
    }
}

$dm = date('dm') . strval(date('Y') + 543);

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->headerUnitName = $unit_name['NPRT_NAME'];
// $pdf->myYear = strval(date('Y') + 543);
$pdf->myYear = $year;
$pdf->curDate = $this->myfunction->dmy_to_thai($dm, 0);
$pdf->SetMargins(5, 45, 5);
$pdf->SetHeaderMargin(15);
$pdf->SetFooterMargin(1);

// set auto page breaks

$pdf->SetAutoPageBreak(TRUE, 10);

// set font
$fontname = TCPDF_FONTS::addTTFfont(FCPATH . 'assets/fonts/THSarabun.ttf', 'TrueTypeUnicode', '', 96);
$pdf->SetFont($fontname, '', 15, '', true);

// add a page
$pdf->AddPage('L');

// set Content To print
$html = '';
$html .= '<table border=".5" cellpadding="3" cellspacing="0">';
$html .=    '<thead>';
$html .=        '<tr>';
$html .=            '<th rowspan="2" width="4%" style="text-align: center">ลำดับ</th>';
$html .=            '<th rowspan="2" width="21%" style="text-align: center">ชื่อตัว - ชื่อสกุล</th>';
$html .=            '<th colspan="3" width="20%" style="text-align: center">เป็นข้าราชการ</th>';
$html .=            '<th rowspan="2" width="24%" style="text-align: center">ตำแหน่ง <br /> ปัจจุบันและอดีตเฉพาะปีที่ได้รับ <br /> พระราชทานเครื่องราชอิสริยาภรณ์</th>';
$html .=            '<th colspan="3" width="19%" style="text-align: center">เครื่องราชอิสริยาภรณ์</th>';
$html .=            '<th rowspan="2" width="12%" style="text-align: center">หมายเหตุ <br /> (เริ่มบรรจุกรณีขอครั้งแรก, โอนมาจาก , ชื่อตัว - ชื่อสกุลเดิม ชื่อตำแหน่งตามบัญชีอื่น, ปีเกษียณ)</th>';
$html .=        '</tr>';
$html .=        '<tr>';
$html .=            '<th style="text-align: center" width="8%">ระดับ/ขั้น (ปัจจุบัน)</th>';
$html .=            '<th style="text-align: center" width="6.5%">ตั้งแต่ วัน เดือน ปี</th>';
$html .=            '<th style="text-align: center" width="5.5%">เงินเดือน (ปัจจุบัน)</th>';

$html .=            '<th style="text-align: center" width="7.5%">ที่ได้รับ <br /> (จากชั้นสูงไปชั้นรอง)</th>';
$html .=            '<th style="text-align: center" width="6.5%">วัน เดือน ปี ( 5 ธ.ค. ...)</th>';
$html .=            '<th style="text-align: center" width="5%">ขอครั้งนี้</th>';

$html .=        '</tr>';
$html .=    '</thead>';
$html .=    '<tbody>';
$html .=        '<tr nobr="true">';
$html .=            '<td width="4%" style="text-align: center"></td>';
$html .=            '<td width="21%">' . $ribbon_name . '</td>';
$html .=            '<td width="8%"></td>';
$html .=            '<td width="6.5%"></td>';
$html .=            '<td width="5.5%"></td>';
$html .=            '<td width="24%"></td>';
$html .=            '<td width="7.5%"></td>';
$html .=            '<td width="6.5%"></td>';
$html .=            '<td width="5%"></td>';
$html .=            '<td width="12%"></td>';
$html .=        '</tr>';

$num = 1;
foreach ($persons as $r) {
    $biog_dmy_work  = $this->myfunction->dmy_to_thai($r['BIOG_DMY_WORK'], 1);
    $biog_decy  = $this->person_data->set_cdec_date($r['BIOG_DECY'], 1);

    $html .=    '<tr nobr="true">';
    $html .=        '<td width="4%" style="text-align: center">' . $num . '</td>';
    $html .=        '<td width="21%">' . $r['BIOG_NAME'] . '</td>';
    $html .=        '<td width="8%">' . $r['CRAK_NAME_FULL'] . '</td>';
    $html .=        '<td width="6.5%">' . $biog_dmy_work . '</td>';
    $html .=        '<td width="5.5%">' . number_format($r['BIOG_SALARY']) . '</td>';
    $html .=        '<td width="24%">' . $r['BIOG_POSNAME_FULL'] . '<br/> <br/>' . $r['CRAK_NAME_FULL'] . '</td>';
    $html .=        '<td width="7.5%">' . $r['BIOG_DEC'] . '</td>';
    $html .=        '<td width="6.5%">' . $biog_decy . '</td>';
    $html .=        '<td width="5%">' . $ribbon_acm . '</td>';
    $html .=        '<td width="12%"></td>';
    $html .=    '</tr>';

    $num++;
}

$html .=    '</tbody>';
$html .= '</table>';
$pdf->writeHTML($html, true, 0, true, 0);
$pdf->Output('A.pdf', 'I');
