<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_nonribbon_model extends CI_Model
{

    private $oracle;

    function __construct()
    {
        parent::__construct();
        $this->oracle = $this->load->database('oracle', true);
    }

    function test($data)
    {
        $result = $this->oracle->escape_like_str($data);
        return $result;
    }

    public function get_person_prop($unit, $decArray, $rankArray)
    {

        $sql = "SELECT A.BIOG_ID, A.BIOG_NAME, A.BIOG_DMY_WORK, A.BIOG_SALARY, A.BIOG_POSNAME_FULL, A.BIOG_RANK,
            A.BIOG_DEC, A.BIOG_DECY, A.BIOG_SEX, A.BIOG_UNIT,
            B.CRAK_NAME_FULL
            FROM PER_BIOG_VIEW A
            INNER JOIN PER_CRAK_TAB B 
                ON A.BIOG_RANK = B.CRAK_CODE 
                AND A.BIOG_CDEP = B.CRAK_CDEP_CODE 
            WHERE SUBSTR(A.BIOG_UNIT, 1,4) LIKE ?
            AND A.BIOG_DEC NOT IN ('ท.ช.', 'ป.ม.', 'ป.ช.', 'ม.ว.ม.', 'ม.ป.ช.')
            AND (
                A.BIOG_RANK IN ?
                AND A.BIOG_DEC NOT IN ?
            )
            ORDER BY A.BIOG_SEX, A.BIOG_RANK, A.BIOG_CDEP";

        $unitID4Esc = substr($unit, 0, 4);

        $result = $this->oracle->query($sql, array($unitID4Esc, $rankArray, $decArray));
        return $result;
    }

    public function get_person_coin_prop($unit, $rankArray)
    {

        $sql = "SELECT  A.BIOG_ID, A.BIOG_NAME, A.BIOG_DMY_WORK, A.BIOG_SALARY, A.BIOG_POSNAME_FULL, A.BIOG_RANK,
            A.BIOG_DEC, A.BIOG_DECY, A.BIOG_SEX, A.BIOG_UNIT,
            B.CRAK_NAME_FULL
            FROM PER_BIOG_VIEW A
            INNER JOIN PER_CRAK_TAB B 
                ON A.BIOG_RANK = B.CRAK_CODE 
                AND A.BIOG_CDEP = B.CRAK_CDEP_CODE 
            WHERE SUBSTR(A.BIOG_UNIT, 1,4) LIKE ?
            AND A.BIOG_DEC IS NULL
            AND A.BIOG_RANK IN ?
            ORDER BY A.BIOG_SEX, A.BIOG_RANK, A.BIOG_CDEP";

        $unitID4Esc = substr($unit, 0, 4);

        $result = $this->oracle->query($sql, array($unitID4Esc, $rankArray));

        return $result;
    }

    public function jm_person_filter($personsArray)
    {
        $persons = array();
        foreach ($personsArray as $r) {
            $countWorkYear  = (date('Y') + 543) - substr($r['BIOG_DMY_WORK'], 4, 4);
            $countDecYear   = (date('Y') + 543) - $r['BIOG_DECY'];
            if (
                ($r['BIOG_RANK'] == '10' && $countWorkYear >= 5) ||
                (($r['BIOG_RANK'] == '11' || $r['BIOG_RANK'] == '21') && ($r['BIOG_DEC'] == 'บ.ช.' && $countDecYear >= 5))
            ) {
                array_push($persons, $r);
            }
        }

        return $persons;
    }

    public function bc_person_filter($personsArray)
    {
        $persons = array();
        foreach ($personsArray as $r) {
            $countDecYear   = (date('Y') + 543) - $r['BIOG_DECY'];
            if (
                ($r['BIOG_RANK'] == '11' || $r['BIOG_RANK'] == '21') &&
                ($r['BIOG_DEC'] == 'บ.ม.' && $countDecYear >= 5)
            ) {
                array_push($persons, $r);
            }
        }

        return $persons;
    }

    public function bm_person_filter($personsArray)
    {
        $persons = array();
        foreach ($personsArray as $r) {
            $countWorkYear  = (date('Y') + 543) - substr($r['BIOG_DMY_WORK'], 4, 4);
            $countDecYear   = (date('Y') + 543) - $r['BIOG_DECY'];
            if (
                ($r['BIOG_RANK'] == '11' && $countWorkYear >= 5) ||
                (in_array($r['BIOG_RANK'], array('11', '21', '22', '23', '24')) &&
                    ($r['BIOG_DEC'] == 'ร.ท.ช.' && $countDecYear >= 5))
            ) {
                array_push($persons, $r);
            }
        }

        return $persons;
    }

    public function rtc_person_filter($personsArray)
    {
        $persons = array();
        foreach ($personsArray as $r) {
            $countWorkYear  = (date('Y') + 543) - substr($r['BIOG_DMY_WORK'], 4, 4);
            if (
                in_array($r['BIOG_RANK'], array('21', '22', '23', '24')) &&
                $countWorkYear >= 5
            ) {
                array_push($persons, $r);
            }
        }

        return $persons;
    }

    public function rtm_person_filter($personsArray)
    {
        $persons = array();
        foreach ($personsArray as $r) {
            $countWorkYear  = date('Y') - substr($r['BIOG_DMY_WORK'], 4, 4);
            if (
                in_array($r['BIOG_RANK'], array('25')) &&
                $countWorkYear >= 5
            ) {
                array_push($persons, $r);
            }
        }

        return $persons;
    }

    public function rgc_person_filter($personsArray)
    {
        $persons = array();
        foreach ($personsArray as $r) {
            $countWorkYear  = date('Y') - substr($r['BIOG_DMY_WORK'], 4, 4);
            if (
                in_array($r['BIOG_RANK'], array('26')) &&
                $countWorkYear >= 5
            ) {
                array_push($persons, $r);
            }
        }

        return $persons;
    }

    public function rgm_person_filter($personsArray)
    {
        $persons = array();
        foreach ($personsArray as $r) {
            $countWorkYear  = date('Y') - substr($r['BIOG_DMY_WORK'], 4, 4);
            if (
                in_array($r['BIOG_RANK'], array('27')) &&
                $countWorkYear >= 5
            ) {
                array_push($persons, $r);
            }
        }

        return $persons;
    }

    public function get_unitname($unitID4)
    {
        $this->oracle->select('NPRT_NAME, NPRT_ACM, NPRT_UNIT');
        $this->oracle->where('NPRT_UNIT', $unitID4.'000000');
        $result = $this->oracle->get('PER_NPRT_TAB');
        // echo $this->oracle->last_query();
        return $result;
    }

    private function check_before_insert_bdec($biogID, $nextMedal)
    {
        $this->oracle->where('BDEC_ID', $biogID);
        $this->oracle->where('BDEC_COIN', $nextMedal);
        $query = $this->oracle->get('PER_BDEC_TAB');

        return $query;
    }

    private function insert_bdec($row, $nextMedal, $round, $bdecSeq)
    {
        $this->oracle->set('BDEC_ROUND', $round);
        $this->oracle->set('BDEC_ID', $row['BIOG_ID']);
        $this->oracle->set('BDEC_NAME', $row['BIOG_NAME']);
        $this->oracle->set('BDEC_RANK', $row['BIOG_RANK']);
        $this->oracle->set('BDEC_UNIT', $row['BIOG_UNIT']);
        $this->oracle->set('BDEC_COIN', $nextMedal);
        $this->oracle->set('BDEC_CSEQ', $bdecSeq);

        $insert = $this->oracle->insert('PER_BDEC_TAB');
        return $insert;
    }

    public function process_insert_to_bdec($person, $nextMedal)
    {
        if ($nextMedal == 'ท.ช.') $cseq = '5';
        else if ($nextMedal == 'ท.ม.') $cseq = '6';
        else if ($nextMedal == 'ต.ช.') $cseq = '7';
        else if ($nextMedal == 'ต.ม.') $cseq = '8';
        else if ($nextMedal == 'จ.ช.') $cseq = '9';
        else if ($nextMedal == 'จ.ม.') $cseq = '10';
        else if ($nextMedal == 'บ.ช.') $cseq = '11';
        else if ($nextMedal == 'บ.ม.') $cseq = '12';
        else if ($nextMedal == 'ร.ท.ช.') $cseq = '13';
        else $cseq = null;

        $checkPersonInBdec = $this->check_before_insert_bdec($person['BIOG_ID'], $nextMedal);
        if ($checkPersonInBdec->num_rows() == 0) {
            $insert = $this->insert_bdec($person, $nextMedal, 'P0', $cseq);
            if ($insert) {
                $result['status']   = true;
                $result['text']     = 'บันทึกสำเร็จ';
                $result['data']     = array( 
                    'BIOG_ID' => $person['BIOG_ID'],
                    'BIOG_NAME' => $person['BIOG_NAME'],
                    'BIOG_RANK' => $person['BIOG_RANK'],
                    'BIOG_UNIT' => $person['BIOG_UNIT'],
                    'BIOG_DEC' => $person['BIOG_DEC'],
                    'NEXT_DEC' => $nextMedal
                );
            } else {
                $result['status']   = false;
                $result['text']     = 'บันทึกไม่สำเร็จ';
                $result['data']     = array( 
                    'BIOG_ID' => $person['BIOG_ID'],
                    'BIOG_NAME' => $person['BIOG_NAME'],
                    'BIOG_RANK' => $person['BIOG_RANK'],
                    'BIOG_UNIT' => $person['BIOG_UNIT'],
                    'BIOG_DEC' => $person['BIOG_DEC'],
                    'NEXT_DEC' => $nextMedal
                );
            }            
        } else {
            $result['status']   = false;
            $result['text']     = 'มีข้อมูลแล้ว';
            $result['data']     = array( 
                'BIOG_ID' => $person['BIOG_ID'],
                'BIOG_NAME' => $person['BIOG_NAME'],
                'BIOG_RANK' => $person['BIOG_RANK'],
                'BIOG_UNIT' => $person['BIOG_UNIT'],
                'BIOG_DEC' => $person['BIOG_DEC'],
                'NEXT_DEC' => $nextMedal
            );
        }

        return $result;
    }
}
