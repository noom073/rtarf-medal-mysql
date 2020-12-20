<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lib_model extends CI_Model
{

    var $oracle;

    function __construct()
    {
        parent::__construct();
        $this->oracle = $this->load->database('oracle', true);
    }

    public function to_army_rank($rankID)
    {
        $this->oracle->select("CRAK_NAME_ACM, CRAK_NAME_ACM1");
        $this->oracle->where("CRAK_CDEP_CODE", 1);
        $this->oracle->where("CRAK_CODE", $rankID);
        $result = $this->oracle->get('PER_CRAK_TAB');

        return $result;
    }

    public function retire60($dmy_born)
    {
        // $result = $this->oracle->query("SELECT retire60('{$dmy_born}') as YEAR_RETIRE FROM dual");
        // return $result;
        $d = substr($dmy_born, 0, 2);
        $m = substr($dmy_born, 2, 2);
        $y = substr($dmy_born, 4, 4);

        if ($m >= 10) {
            $retireYear = $y + 61;
        } else {
            $retireYear = $y + 60;
        }

        return $retireYear;
    }

    public function get_formula_col5_5($biog_id)
    {
        $this->oracle->select("ADD_MONTHS(to_date(to_char(MIN(to_number(to_char(to_number(substr(SALA_DMY,5))-543)
            ||substr(SALA_DMY,3,2)
            ||substr(SALA_DMY,1,2)))),'yyyymmdd'),60) DMY");
        $this->oracle->where("SALA_ID", $biog_id);
        $this->oracle->where("SALA_LEVEL >= 'น.5'");
        $this->oracle->where("SALA_CLASS >= '05.0'");
        $this->oracle->where("to_number(to_number(substr(SALA_DMY, 5))-543 ||substr(SALA_DMY, 3, 2) ||
            substr(SALA_DMY, 1, 2)) > 0");
        $this->oracle->group_by("SALA_ID");
        $result = $this->oracle->get("PER_SALA_TAB");

        return $result;
    }

    public function get_all_rank()
    {
        $this->oracle->select('CRAK_CODE, CRAK_NAME_ACM, CRAK_CDEP_CODE');
        $result = $this->oracle->get('PER_CRAK_TAB');

        return $result;
    }

    public function get_cdec_year2($id, $array)
    {
        $this->oracle->select('CDEC_DMYGET');
        $this->oracle->where('CDEC_ID', $id);
        $this->oracle->where_in('CDEC_COIN', $array);

        $result = $this->oracle->get('PER_CDEC_TAB');
        return $result;
    }

    public function get_unit_name($unitID)
    {
        $this->oracle->select("NPRT_ACM, NPRT_NAME");
        $this->oracle->where("NPRT_UNIT", $unitID);
        $result = $this->oracle->get('PER_NPRT_TAB');
        // echo $this->oracle->last_query();

        return $result;
    }

    public function get_person_in_bdec($id, $medal)
    {
        $this->oracle->where('BDEC_ID');
        $this->oracle->where('BDEC_COIN');
        $query = $this->oracle->get('PER_BDEC_TAB');

        return $query;
    }

    public function update_medal_bdec($biogID, $medal, $nextMedal, $cseq)
    {
        $this->oracle->set('BDEC_COIN', $nextMedal);
        $this->oracle->set('BDEC_CSEQ', $cseq);

        $this->oracle->where('BDEC_ID', $biogID);
        $this->oracle->where('BDEC_COIN', $medal);
        $result = $this->oracle->update('PER_BDEC_TAB');
        // echo $this->oracle->last_query();
        return $result;
    }

    public function search_person($array)
    {
        if ($array['type'] == 'id') {
            $this->oracle->where('A.BIOG_ID', $array['text']);
        } else if ($array['type'] == 'name') {
            $this->oracle->like('A.BIOG_NAME', $array['text'], 'both');
        } else if ($array['type'] == 'lastname') {
            $this->oracle->where("A.BIOG_NAME like '%  %{$array['text']}%'");
        }

        $this->oracle->select('A.BIOG_ID, A.BIOG_NAME, A.BIOG_RANK, A.BIOG_UNIT, A.BIOG_DEC, B.BDEC_ID, B.BDEC_COIN');
        $this->oracle->join('PER_BDEC_TAB B', 'A.BIOG_ID = B.BDEC_ID ', 'left');
        $this->oracle->where("SUBSTR(A.BIOG_UNIT, 1,4) = '{$array['unitID4']}'");
        $this->oracle->order_by("A.BIOG_RANK");
        $query = $this->oracle->get('PER_BIOG_VIEW A');
        return $query;
    }

    public function search_person_by_id($biogID)
    {
        $this->oracle->select('A.BIOG_ID, A.BIOG_NAME, A.BIOG_RANK, A.BIOG_UNIT, A.BIOG_DEC');
        $this->oracle->where('A.BIOG_ID', $biogID);
        $this->oracle->order_by("A.BIOG_RANK");
        $query = $this->oracle->get('PER_BIOG_VIEW A');
        return $query;
    }

    public function check_person_in_bdec($biogID)
    {
        $this->oracle->where('A.BDEC_ID', $biogID);
        $query = $this->oracle->get('PER_BDEC_TAB A');
        return $query;
    }

    public function insert_person_bdec($array)
    {
        $this->oracle->set('BDEC_ROUND', $array['BDEC_ROUND']);
        $this->oracle->set('BDEC_ID', $array['BDEC_ID']);
        $this->oracle->set('BDEC_NAME', $array['BDEC_NAME']);
        $this->oracle->set('BDEC_RANK', $array['BDEC_RANK']);
        $this->oracle->set('BDEC_UNIT', $array['BDEC_UNIT']);
        $this->oracle->set('BDEC_COIN', $array['BDEC_COIN']);
        $this->oracle->set('BDEC_CSEQ', $array['BDEC_CSEQ']);
        $this->oracle->set('BDEC_REM', $array['BDEC_REM']);
        $query = $this->oracle->insert('PER_BDEC_TAB');

        return $query;
    }
}
