<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Person_data
{
    var $CI;

    function __construct()
    {
        $this->CI = &get_instance();
        $this->CI->load->model('lib_model');
    }

    public function army_rank($rankID)
    {
        $result = $this->CI->lib_model->to_army_rank($rankID)->row_array();

        return $result;
    }

    public function this_retire($dmy_born)
    {
        // $yearRetire = $this->CI->lib_model->retire60($dmy_born)->row_array()['YEAR_RETIRE'];
        $yearRetire = $this->CI->lib_model->retire60($dmy_born);
        $thisYear = date("Y") + 543;
        if ($yearRetire == $thisYear) {
            $status = true;
        } else {
            $status = false;
        }

        return $status;
    }

    public function set_cdec_date($yyyy)
    {
        $y = substr($yyyy, 2, 2);
        if ($yyyy >= 2560) {
            $result = "28 ก.ค.{$y}";
        } else {
            $result = "5 ธ.ค.{$y}";
        }

        return $result;
    }

    public function next_medal($person, $curYear)
    {
        if ($person['BIOG_DECY'] === null) return '???';
        if ($person['BIOG_DMY_BORN'] === null) return 'xxx';

        if ($person['BIOG_RANK'] == '01' || $person['BIOG_RANK'] == '02') {
            $medal = $this->next_medal_0102($person, $curYear);
        } else if ($person['BIOG_RANK'] == '03') {
            $medal = $this->next_medal_03($person, $curYear);
        } else if ($person['BIOG_RANK'] == '04') {
            $medal = $this->next_medal_04($person, $curYear);
        } else if ($person['BIOG_RANK'] == '05') {
            $medal = $this->next_medal_05($person, $curYear);
        } else {
            $medal = 'Not in rank';
        }

        $this->check_col5_5($person['BIOG_ID']);

        return $medal;
    }

    protected function next_medal_0102($person, $curYear)
    {
        $countYear  = $curYear - $person['BIOG_DECY'];
        $retire60   = $this->this_retire($person['BIOG_DMY_BORN']);

        $allMedal_0102 = array(
            'ปม.', 'ปม', 'ป.ม.', 'ปช.', 'ปช', 'ป.ช.', 'มวม.', 'มวม',
            'ม.ว.ม.', 'ม.ว.ม', 'มปช.', 'มปช', 'ม.ป.ช.', 'ม.ป.ช'
        );
        $medal_rank_mpc = array('มปช.', 'มปช', 'ม.ป.ช.', 'ม.ป.ช');
        $medal_rank_mvm = array('มวม.', 'มวม', 'ม.ว.ม.', 'ม.ว.ม');
        $medal_rank_pc  = array('ปช.', 'ปช', 'ป.ช.');
        $medal_rank_pm  = array('ปม.', 'ปม', 'ป.ม.');

        if ($person['BIOG_RANK'] == '01' && !in_array($person['BIOG_DEC'], $allMedal_0102)) return '???';

        /**ม.ว.ม */
        if (
            ($person['BIOG_RANK'] == '01' || $person['BIOG_RANK'] == '02')
            && $retire60 == $curYear
            && in_array($person['BIOG_DEC'], $medal_rank_mvm)
        ) return 'ม.ป.ช.';

        /**ป.ช. */
        if (
            ($person['BIOG_RANK'] == '01' || $person['BIOG_RANK'] == '02')
            && $retire60 == $curYear
            && in_array($person['BIOG_DEC'], $medal_rank_pc)
        ) return 'ม.ว.ม.';

        /**ป.ม. */
        if (
            ($person['BIOG_RANK'] == '01' || $person['BIOG_RANK'] == '02')
            && $retire60 == $curYear
            && in_array($person['BIOG_DEC'], $medal_rank_pm)
        ) return 'ป.ช.';

        /**ม.ป.ช */
        if (
            ($person['BIOG_RANK'] == '01' || $person['BIOG_RANK'] == '02')
            && in_array($person['BIOG_DEC'], $medal_rank_mpc)
        ) return '--';

        /**ครอง 01-02 นานเกิน 3ปี */
        if ($person['BIOG_RANK'] == '01' || $person['BIOG_RANK'] == '02') {
            if ($countYear > 3) {
                if (in_array($person['BIOG_DEC'], $medal_rank_pm)) return 'ป.ช.';
                if (in_array($person['BIOG_DEC'], $medal_rank_pc)) return 'ม.ว.ม.';

                if (in_array($person['BIOG_DEC'], $medal_rank_mvm)) return 'ม.ป.ช.';
                else return '???';
            } else return '-*-';
        }
    }

    protected function next_medal_03($person, $curYear)
    {
        $countYear  = $curYear - $person['BIOG_DECY'];
        $retire60   = $this->this_retire($person['BIOG_DMY_BORN']);

        $allMedal_03 = array(
            'ปม.', 'ปม', 'ป.ม.', 'ปช.', 'ปช', 'ป.ช.', 'มวม.', 'มวม',
            'ม.ว.ม.', 'ม.ว.ม', 'มปช.', 'มปช', 'ม.ป.ช.', 'ม.ป.ช'
        );
        $medal_rank_pm  = array('ปม.', 'ปม', 'ป.ม.');
        $medal_rank_pc  = array('ปช.', 'ปช', 'ป.ช.');
        $medal_rank_mvm = array('มวม.', 'มวม', 'ม.ว.ม.', 'ม.ว.ม');

        if ($person['BIOG_RANK'] == '03' && !in_array($person['BIOG_DEC'], $allMedal_03)) return '???';

        /**ป.ม. */
        if (
            $person['BIOG_RANK'] == '03'
            && $retire60 == $curYear
            && in_array($person['BIOG_DEC'], $medal_rank_pm)
        ) return 'ป.ช.';

        /**ป.ช. */
        if (
            $person['BIOG_RANK'] == '03'
            && $retire60 == $curYear
            && in_array($person['BIOG_DEC'], $medal_rank_pc)
        ) return 'ม.ว.ม.';

        /**ม.ว.ม. */
        if (
            $person['BIOG_RANK'] == '03'
            && $retire60 == $curYear
            && in_array($person['BIOG_DEC'], $medal_rank_mvm)
            && $countYear >= 5
        ) return 'ม.ป.ช.';

        /**ม.ว.ม. Top */
        if (
            $person['BIOG_RANK'] == '03'
            && $retire60 == $curYear
            && in_array($person['BIOG_DEC'], $medal_rank_mvm)
            && $countYear < 5
        ) return '--';

        /**03 long */
        if ($person['BIOG_RANK'] == '03') {
            if (in_array($person['BIOG_DEC'], $medal_rank_pm) && $countYear >= 3) return 'ป.ช.';
            else if (in_array($person['BIOG_DEC'], $medal_rank_pc) && $countYear >= 3) return 'ม.ว.ม.';
            else if (in_array($person['BIOG_DEC'], $medal_rank_mvm) && $countYear >= 5) return 'ม.ป.ช.';
            else return '-*-';
        }
    }

    protected function next_medal_04($person, $curYear)
    {
        $countYear  = $curYear - $person['BIOG_DECY'];
        $retire60   = $this->this_retire($person['BIOG_DMY_BORN']);

        $all_medal_04 = array(
            'ทช.', 'ทช', 'ท.ช.', 'ปม.', 'ปม', 'ป.ม.', 'ปช.', 'ปช',
            'ป.ช.', 'มวม.', 'มวม ', 'ม.ว.ม.', 'ม.ว.ม'
        );
        $medal_rank_tc = array('ทช.', 'ทช', 'ท.ช.');
        $medal_rank_pm = array('ปม.', 'ปม', 'ป.ม.');
        $medal_rank_pc = array('ปช', 'ปช.', 'ป.ช.');

        if ($person['BIOG_RANK'] == '04' && !in_array($person['BIOG_DEC'], $all_medal_04)) return '???';

        /**ท.ช. */
        if (
            $person['BIOG_RANK'] == '04'
            && $retire60 == $curYear
            && in_array($person['BIOG_DEC'], $medal_rank_tc)
        ) return 'ป.ม.';

        /**ป.ม. */
        if (
            $person['BIOG_RANK'] == '04'
            && $retire60 == $curYear
            && in_array($person['BIOG_DEC'], $medal_rank_pm)
        ) return 'ป.ช.';

        /**ป.ช. */
        if (
            $person['BIOG_RANK'] == '04'
            && $countYear >= 5
            && in_array($person['BIOG_DEC'], $medal_rank_pc)
        ) return 'ม.ว.ม.';

        /**ป.ช. < 5 */
        if (
            $person['BIOG_RANK'] == '04'
            && $retire60 == $curYear
            && in_array($person['BIOG_DEC'], $medal_rank_pc)
        ) return '--';

        /**04 long */
        if ($person['BIOG_RANK'] == '04') {
            if (in_array($person['BIOG_DEC'], $medal_rank_tc) && $countYear >= 3) return 'ป.ม.';
            else if (in_array($person['BIOG_DEC'], $medal_rank_pm) && $countYear >= 3) return 'ป.ช.';
            else if (in_array($person['BIOG_DEC'], $medal_rank_pc) && $countYear >= 5) return 'ม.ว.ม.';
            else return '-*-';
        }
    }

    protected function next_medal_05($person, $curYear)
    {
        $countYear  = $curYear - $person['BIOG_DECY'];
        $retire60   = $this->this_retire($person['BIOG_DMY_BORN']);

        $rank05_position = array(
            '01165', '01107', '01109', '01092', '01093', '01131',
            '01117', '01164', '01119', '01123', '05010'
        );

        $medal_rank_pm = array('ปม.', 'ปม.', 'ป.ม.');
        $medal_rank_tc = array('ทช.', 'ทช', 'ท.ช.');

        if ($person['BIOG_RANK'] == '05' && in_array($person['BIOG_DEC'], $medal_rank_pm)) return '--';
        else if ($person['BIOG_RANK'] == '05' && !in_array($person['BIOG_DEC'], $medal_rank_tc)) return '???';


        /*พ.อ.(พ) เกษียณอายุ */
        if (
            $person['BIOG_RANK'] == '05'
            && in_array(substr($person['BIOG_CPOS'], 0, 5), $rank05_position)
            && in_array($person['BIOG_DEC'], $medal_rank_tc)
            && $countYear >= 5
            && ($retire60 == $curYear || $retire60 == $curYear + 1)
            /**พ.อ.(พ) เกษียณอายุ ปีปัจุบัน หรือขอได้ตั้งแต่ก่อนเกษียณ 1 ปี */
        ) return 'ป.ม.';

        /**พ.อ.(พ) เกษียณอายุ ขอได้ตั้งแต่ก่อนเกษียณ 1 ปี */
        // if (
        //     $person['BIOG_RANK'] == '05'
        //     && in_array(substr($person['BIOG_CPOS'], 0, 5), $rank05_position)
        //     && in_array($person['BIOG_DEC'], $medal_rank_tc)
        //     && $countYear >= 5
        //     && $retire60 == $curYear + 1
        // ) return 'ป.ม.';

        /**พ.อ.(พ) ที่ดำรงตำแหน่งตรงตามคุณสมบัติ*/
        if (
            $person['BIOG_RANK'] == '05'
            && $person['BIOG_SLEVEL'] == 'น.5'
            && $person['BIOG_SCLASS'] >= '05.0'
            && in_array(substr($person['BIOG_CPOS'], 0, 5), $rank05_position)
            && in_array($person['BIOG_DEC'], $medal_rank_tc)
            && $countYear >= 3
        ) return 'ป.ม.';

        /**พ.อ.(พ) รับเงินเดือน น.5/5.0   ไม่น้อยกว่า 5 ปี   และ ได้รับ  ท.ช.  >=3 ปี  (ตามระเบียบของคมช.) */
        if (
            $person['BIOG_RANK'] == '05'
            && $person['BIOG_SLEVEL'] == 'น.5'
            && $person['BIOG_SCLASS'] >= '05.0'
            && $this->check_col5_5($person['BIOG_ID']) == 1
            && in_array($person['BIOG_DEC'], $medal_rank_tc)
            && $countYear >= 3
        ) return 'ป.ม.';
        else return '-*-';
    }

    public function check_col5_5($biog_id)
    {
        $result = $this->CI->lib_model->get_formula_col5_5($biog_id)->row_array();
        $d = new DateTime($result['DMY']);
        $dateCompare = new DateTime("28-MAY-" . date("Y"));
        $result = $d <= $dateCompare ? 1 : 2;
        return $result;
    }

    public function cdec_year2($biog_id, $cdecArray)
    {
        $result = $this->CI->lib_model->get_cdec_year2($biog_id, $cdecArray);
        if ($result->num_rows() > 0) {
            $year = substr($result->row_array()['CDEC_DMYGET'], 6);
        } else {
            $year = '-';
        }

        return $year;
    }

    public function get_unit_name($unitID)
    {
        $data = $this->CI->lib_model->get_unit_name($unitID)->row_array();
        return $data;
    }

    public function medal_full_name($medal_acm)
    {
        $result = '';
        switch ($medal_acm) {
            case 'ร.ง.ม.':
                $result = 'เหรียญเงินมงกุฎไทย';
                break;
            case 'ร.ง.ช.':
                $result = 'เหรียญเงินช้างเผือก';
                break;
            case 'ร.ท.ม.':
                $result = 'เหรียญทองมงกุฎไทย';
                break;
            case 'ร.ท.ช.':
                $result = 'เหรียญทองช้างเผือก';
                break;
            case 'บ.ม.':
                $result = 'เบญจมาภรณ์มงกุฎไทย';
                break;
            case 'บ.ช.':
                $result = 'เบญจมาภรณ์ช้างเผือก';
                break;
            case 'จ.ม.':
                $result = 'จัตุรถาภรณ์มงกุฏไทย';
                break;
            case 'จ.ช.':
                $result = 'จัตุรถาภรณ์ช้างเผือก';
                break;
            case 'ต.ม.':
                $result = 'ตริตาภรณ์มงกุฏไทย';
                break;
            case 'ต.ช.':
                $result = 'ตริตาภรณ์ช้างเผือก';
                break;
            case 'ท.ม.':
                $result = 'ทวีติยาภรณ์มงกุฎไทย';
                break;
            case 'ท.ช.':
                $result = 'ทวีติยาภรณ์ช้างเผือก';
                break;
            case 'ป.ม.':
                $result = 'ประถมาภรณ์มงกุฎไทย';
                break;
            case 'ป.ช.':
                $result = 'ประถมาภรณ์ช้างเผือก';
                break;
            case 'ม.ว.ม.':
                $result = 'มหาวชิรมงกุฎ';
                break;
            case 'ม.ป.ช.':
                $result = 'มหาปรมาภรณ์ช้างเผือก';
                break;

            default:
                $result = '-';
                break;
        }

        return $result;
    }

    public function check_person_in_bdec($id, $medal)
    {
        $result = $this->CI->lib_model->get_person_in_bdec($id, $medal)->num_rows();

        return $result;
    }

    public function save_update_medal_bdec($array)
    {
        if ($array['nextMedal'] == 'ม.ป.ช.')  $cseq = '1';
        else if ($array['nextMedal'] == 'ม.ว.ม.') $cseq = '2';
        else if ($array['nextMedal'] == 'ป.ช.') $cseq = '3';
        else if ($array['nextMedal'] == 'ป.ม.') $cseq = '4';
        else if ($array['nextMedal'] == 'ท.ช.') $cseq = '5';
        else if ($array['nextMedal'] == 'ท.ม.') $cseq = '6';
        else if ($array['nextMedal'] == 'ต.ช.') $cseq = '7';
        else if ($array['nextMedal'] == 'ต.ม.') $cseq = '8';
        else if ($array['nextMedal'] == 'จ.ช.') $cseq = '9';
        else if ($array['nextMedal'] == 'จ.ม.') $cseq = '10';
        else if ($array['nextMedal'] == 'บ.ช.') $cseq = '11';
        else if ($array['nextMedal'] == 'บ.ม.') $cseq = '12';
        else if ($array['nextMedal'] == 'ร.ท.ช.') $cseq = '13';
        else $cseq = null;

        $update = $this->CI->lib_model->update_medal_bdec($array['biogID'], $array['medal'], $array['nextMedal'], $cseq);
        return $update;
    }

    public function search_person($array)
    {
        $result = $this->CI->lib_model->search_person($array);
        return $result;
    }

    public function add_person_bdec($array)
    {
        $checkBdec = $this->CI->lib_model->check_person_in_bdec($array['biogID'])->num_rows();
        if ($checkBdec > 0) {
            $result = 'ERR-DUPLICATE';
        } else {
            $person = $this->CI->lib_model->search_person_by_id($array['biogID'])->row_array();
            if ($array['nextMedal'] == 'ม.ป.ช.')  $cseq = '1';
            else if ($array['nextMedal'] == 'ม.ว.ม.') $cseq = '2';
            else if ($array['nextMedal'] == 'ป.ช.') $cseq = '3';
            else if ($array['nextMedal'] == 'ป.ม.') $cseq = '4';
            else if ($array['nextMedal'] == 'ท.ช.') $cseq = '5';
            else if ($array['nextMedal'] == 'ท.ม.') $cseq = '6';
            else if ($array['nextMedal'] == 'ต.ช.') $cseq = '7';
            else if ($array['nextMedal'] == 'ต.ม.') $cseq = '8';
            else if ($array['nextMedal'] == 'จ.ช.') $cseq = '9';
            else if ($array['nextMedal'] == 'จ.ม.') $cseq = '10';
            else if ($array['nextMedal'] == 'บ.ช.') $cseq = '11';
            else if ($array['nextMedal'] == 'บ.ม.') $cseq = '12';
            else if ($array['nextMedal'] == 'ร.ท.ช.') $cseq = '13';
            else $cseq = null;
    
            $data['BDEC_ROUND'] = 'P0';
            $data['BDEC_ID']    = $person['BIOG_ID'];
            $data['BDEC_NAME']  = $person['BIOG_NAME'];
            $data['BDEC_RANK']  = $person['BIOG_RANK'];
            $data['BDEC_UNIT']  = $person['BIOG_UNIT'];
            $data['BDEC_COIN']  = $array['nextMedal'];
            $data['BDEC_CSEQ']  = $cseq;
            $data['BDEC_REM']   = '';
    
            $insert = $this->CI->lib_model->insert_person_bdec($data);
            if ($insert) {
                $result = 'SUCCESS';
            } else {
                $result = 'ERR-INSERT-FAIL';
            }            
        }
        return $result;
        
    }
}
