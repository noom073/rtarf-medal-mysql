<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_typical_ribbon_model extends CI_Model
{

    protected $oracle;

    function __construct()
    {
        $this->oracle = $this->load->database('oracle', true);
    }

    public function get_person_bdec($unitID)
    {
        $this->oracle->where('BDEC_CSEQ <= 4');
        $this->oracle->like('substr(BDEC_UNIT, 1, 4)', $unitID, 'none');
        $this->oracle->order_by('BDEC_RANK');
        $result = $this->oracle->get('PER_BDEC_TAB');
        
        return $result;
    }

    public function delete_bdec_person($id)
    {
        $this->oracle->where('BDEC_ID', $id);
        $query = $this->oracle->delete('PER_BDEC_TAB');

        return $query;
    }

    public function get_person_prop_by_medal($unitID, $array)
    {
        $unitID4    = $this->oracle->escape_like_str(substr($unitID, 0, 4));
        $year       = (int) $array['year'];

        if ($array['condition'] == 'retire') {
            $retireCondition = "AND RETIRE60(B.BIOG_DMY_BORN ) = {$year}";
        } else {
            $retireCondition = '';
        }  

        $result = $this->oracle->query("SELECT A.BDEC_NAME,B.BIOG_NAME, B.BIOG_DMY_WORK,
        B.BIOG_SALARY, B.BIOG_POSNAME_FULL, B.BIOG_DEC, B.BIOG_DECY, B.BIOG_SEX,
        C.CRAK_NAME_FULL
        FROM PER_BDEC_TAB A
        INNER JOIN PER_BIOG_VIEW B
            ON A.BDEC_ID = B.BIOG_ID
        INNER JOIN PER_CRAK_TAB C
            ON B.BIOG_RANK = C.CRAK_CODE 
            AND B.BIOG_CDEP = C.CRAK_CDEP_CODE 
        WHERE A.BDEC_UNIT LIKE '$unitID4%'
        AND A.BDEC_COIN LIKE '{$array['ribbon_acm']}'
        {$retireCondition}
        order by B.BIOG_SEX, B.BIOG_RANK, B.BIOG_CDEP");

        return $result;
    }
}
