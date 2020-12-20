<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_ribbon_model extends CI_Model
{

    protected $oracle;

    function __construct()
    {
        $this->oracle = $this->load->database('oracle', true);
    }

    public function get_person_in_unit($unitID)
    {
        $unitID4 = substr($unitID, 0,4);

        $this->oracle->select('BIOG_NAME, BIOG_DECY, BIOG_DMY_BORN, BIOG_RANK, BIOG_ID, 
        BIOG_DEC, BIOG_CPOS, BIOG_SLEVEL, BIOG_SCLASS');
        // $this->oracle->where("substr(BIOG_UNIT, 1, 4) like $unitID4");
        $this->oracle->like("substr(BIOG_UNIT, 1, 4)", $unitID4);
        $result = $this->oracle->get('PER_BIOG_VIEW');
        
        return $result;
    }
}
