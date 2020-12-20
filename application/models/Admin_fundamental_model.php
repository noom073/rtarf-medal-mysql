<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_fundamental_model extends CI_Model
{

    var $oracle;

    function __construct()
    {
        parent::__construct();
        $this->oracle = $this->load->database('oracle', true);
    }

    public function get_unit_name($unitID)
    {
        $this->oracle->select("NPRT_ACM, NPRT_NAME");
        $this->oracle->where("NPRT_UNIT", $unitID);
        $result = $this->oracle->get('PER_NPRT_TAB');
        // echo $this->oracle->last_query();

        return $result;
    }

    public function get_person($array)
    {
        $this->oracle->select('BIOG_NAME, BIOG_ID');

        if ($array['type'] == 'mid') {
            $this->oracle->where('BIOG_ID', $array['text']);
        } else {
            $this->oracle->like('BIOG_NAME', $array['text']);
        }

        // if ($array['unitid'] != '6001000000') { // on DB 10.104.4.62
        if ($array['unitid'] != '6001000000') { // on DB 10.104.117.50
            $this->oracle->like('BIOG_UNIT', substr($array['unitid'], 0, 4), 'after');
        }

        $this->oracle->order_by('BIOG_RANK');
        $result = $this->oracle->get('PER_BIOG_VIEW');

        return $result;
    }

    public function get_person_row($biog_id)
    {
        $this->oracle->where('BIOG_ID', $biog_id);
        $result = $this->oracle->get('PER_BIOG_VIEW');

        return $result;
    }

    public function get_ribbon_person($unitid)
    {
        $this->oracle->select('SUBSTR(A.BIOG_UNIT, 1, 4) as UNIT,
            A.BIOG_CODE, A.BIOG_CPOS, 
            A.BIOG_ID, A.BIOG_NAME, A.BIOG_RANK, 
            A.BIOG_DMY_BORN, A.BIOG_CDEP, A.BIOG_SEX, 
            A.BIOG_DMY_RANK, A.BIOG_SLEVEL, A.BIOG_SCLASS, 
            A.BIOG_DEC, A.BIOG_DECY, A.BIOG_POSNAME, 
            A.BIOG_STAPOS, A.BIOG_UNIT');
        $this->oracle->where("SUBSTR(A.BIOG_UNIT, 1, 4) = ", $unitid);
        $this->oracle->where('A.BIOG_RANK >=', '01');
        $this->oracle->where('A.BIOG_RANK <=', '05');
        $this->oracle->order_by('A.BIOG_RANK');
        $this->oracle->order_by('A.BIOG_CPOS');
        $this->oracle->order_by('A.BIOG_SLEVEL', 'desc');
        $this->oracle->order_by('TO_NUMBER(A.BIOG_SCLASS)', 'desc');
        $this->oracle->order_by('A.BIOG_DMY_RANK');

        $result = $this->oracle->get('PER_BIOG_VIEW A');
        return $result;
    }

    public function get_non_ribbon_person($unitSub4, $rankStart, $rankEnd)
    {
        $this->oracle->select("B.UNIT_CODE, B.UNIT_ACM, B.UNIT_NAME, 
        A.BIOG_ID, A.BIOG_STAPOS, A.BIOG_UNIT, A.BIOG_ID, A.BIOG_CPOS, A.BIOG_POSNAME,
         A.BIOG_NAME, A.BIOG_DMY_BORN,A.BIOG_RANK,A.BIOG_DEC, A.BIOG_DECY,A.BIOG_SALARY,A.BIOG_SLEVEL,A.BIOG_SCLASS");
        $this->oracle->join("PER_UNIT_TAB B", 
            "CONCAT(SUBSTR(A.BIOG_UNIT, 1, 4), '000000') = CONCAT(SUBSTR(B.UNIT_CODE, 1, 4), '000000')");

        if ($unitSub4 != '6000') {
            $this->oracle->where("SUBSTR(A.BIOG_UNIT, 1, 4) LIKE ", $unitSub4);
        }
        
        $this->oracle->where("A.BIOG_RANK >= ", $rankStart);
        $this->oracle->where("A.BIOG_RANK <= ", $rankEnd);
        $this->oracle->order_by('A.BIOG_RANK');
        $this->oracle->order_by('A.BIOG_CPOS');
        $this->oracle->order_by('A.BIOG_SLEVEL', 'desc');
        $this->oracle->order_by('TO_NUMBER(A.BIOG_SCLASS)', 'desc');
        $this->oracle->order_by('A.BIOG_DMY_RANK');
        $result = $this->oracle->get("PER_BIOG_VIEW A");
        
        // echo $this->oracle->last_query();
        return $result;
    }
    
}
