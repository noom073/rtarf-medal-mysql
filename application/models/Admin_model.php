<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{

    var $oracle;

    function __construct()
    {
        parent::__construct();
        $this->oracle = $this->load->database('oracle', true);
    }


    public function get_unit()
    {
        $sql = "SELECT NPRT_UNIT, NPRT_ACM, SUBSTR(NPRT_UNIT, 1,4), SUBSTR(NPRT_UNIT, 5,6)
            FROM PER_NPRT_TAB 
            WHERE SUBSTR(NPRT_UNIT, 5,6) LIKE '000000' 
            AND NPRT_UNIT NOT LIKE '6000000000'
            ORDER BY NPRT_UNIT";
        $result = $this->oracle->query($sql);

        return $result;
    }
}
