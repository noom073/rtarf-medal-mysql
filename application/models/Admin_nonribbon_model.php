<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_nonribbon_model extends CI_Model
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

        $sql = "SELECT A.BIOG_NAME, A.BIOG_DMY_WORK, A.BIOG_SALARY, A.BIOG_POSNAME_FULL, A.BIOG_RANK,
            A.BIOG_DEC, A.BIOG_DECY, A.BIOG_SEX,
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

        $sql = "SELECT A.BIOG_NAME, A.BIOG_DMY_WORK, A.BIOG_SALARY, A.BIOG_POSNAME_FULL, A.BIOG_RANK,
            A.BIOG_DEC, A.BIOG_DECY, A.BIOG_SEX,
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
}
