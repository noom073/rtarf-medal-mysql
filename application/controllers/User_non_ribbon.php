<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_non_ribbon extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('myfunction');
        $this->load->library('person_data');

        $this->load->model('user_nonribbon_model');
    }

    public function index()
    {
        $unit = $this->user_nonribbon_model->get_unitname($this->session->unit)->row_array();
        $data['unitname']     = $unit['NPRT_NAME'];
        $data['unitID']     = $this->myfunction->encode($unit['NPRT_UNIT']);
        $data['sidemenu'] = $this->load->view('user_view/user_menu/list_user_menu', null, true);
        $this->load->view('foundation_view/header');
        $this->load->view('user_view/user_menu/navbar_user', $data);
        $this->load->view('user_view/user_nonribbon/user_nonribbon_property_form', $data);
        $this->load->view('main_view/container_footer');
        $this->load->view('foundation_view/footer');
    }

    public function action_get_person_prop()
    {
        $this->load->library('pdf');

        $unitID = $this->myfunction->decode($this->input->post('unitid'));
        $ribbon = $this->input->post('ribbon_type');

        $data['unit_name']      = $this->person_data->get_unit_name($unitID);
        $data['ribbon_acm']     = $ribbon;
        $data['ribbon_name']    = $this->person_data->medal_full_name($ribbon);
        $data['year']           = $this->input->post('year');
        $data['p1_rank']        = $this->input->post('p1_rank');
        $data['p1_name']        = $this->input->post('p1_name');
        $data['p1_position']    = $this->input->post('p1_position');
        $data['p2_rank']        = $this->input->post('p2_rank');
        $data['p2_name']        = $this->input->post('p2_name');
        $data['p2_position']    = $this->input->post('p2_position');

        if ($ribbon == 'ท.ช.') {
            $decArray = array('ท.ช.');
            $data['persons'] = $this->user_nonribbon_model->get_person_prop($unitID, $decArray, '05')->result_array();
        } else if ($ribbon == 'ท.ม.') {
            $decArray = array('ท.ม.');
            $data['persons'] = $this->user_nonribbon_model->get_person_prop($unitID, $decArray, '06')->result_array();
        } else if ($ribbon == 'ต.ช.') {
            $decArray = array('ต.ช.');
            $data['persons'] = $this->user_nonribbon_model->get_person_prop($unitID, $decArray, '07')->result_array();
        } else if ($ribbon == 'ต.ม.') {
            $decArray = array('ต.ม.');
            $data['persons'] = $this->user_nonribbon_model->get_person_prop($unitID, $decArray, '08')->result_array();
        } else if ($ribbon == 'จ.ช.') {
            $decArray = array('จ.ช.');
            $data['persons'] = $this->user_nonribbon_model->get_person_prop($unitID, $decArray, '09')->result_array();
        } else if ($ribbon == 'จ.ม.') {
            $decArray = array('จ.ม.');
            $rankAray = array('10', '11');
            $result = $this->user_nonribbon_model->get_person_prop($unitID, $decArray, $rankAray)->result_array();
            $data['persons'] = $this->user_nonribbon_model->jm_person_filter($result);
        } else if ($ribbon == 'บ.ช.') {
            $decArray = array('บ.ช.');
            $rankAray = array('11', '21');
            $result = $this->user_nonribbon_model->get_person_prop($unitID, $decArray, $rankAray)->result_array();
            $data['persons'] = $this->user_nonribbon_model->bc_person_filter($result);
        } else if ($ribbon == 'บ.ม.') {
            $decArray = array('บ.ม.');
            $rankAray = array('11', '21', '22', '23', '24');
            $result = $this->user_nonribbon_model->get_person_prop($unitID, $decArray, $rankAray)->result_array();
            $data['persons'] = $this->user_nonribbon_model->bm_person_filter($result);
        } else if ($ribbon == 'ร.ท.ช.') {
            // $decArray = array('ร.ท.ช.', 'บ.ม.', 'บ.ช.');
            $rankAray = array('21', '22', '23', '24');
            $result = $this->user_nonribbon_model->get_person_coin_prop($unitID, $rankAray)->result_array();
            $data['persons'] = $this->user_nonribbon_model->rtc_person_filter($result);
        } else if ($ribbon == 'ร.ท.ม.') {
            // $decArray = array('ร.ท.ม.');
            $rankAray = array('25');
            $result = $this->user_nonribbon_model->get_person_coin_prop($unitID, $rankAray)->result_array();
            $data['persons'] = $this->user_nonribbon_model->rtm_person_filter($result);
        } else if ($ribbon == 'ร.ง.ช.') {
            // $decArray = array('ร.ง.ช.');
            $rankAray = array('26');
            $result = $this->user_nonribbon_model->get_person_coin_prop($unitID, $rankAray)->result_array();
            $data['persons'] = $this->user_nonribbon_model->rgc_person_filter($result);
        } else if ($ribbon == 'ร.ง.ม.') {
            // $decArray = array('ร.ง.ม.');
            $rankAray = array('27');
            $result = $this->user_nonribbon_model->get_person_coin_prop($unitID, $rankAray)->result_array();
            $data['persons'] = $this->user_nonribbon_model->rgm_person_filter($result);
        } else {
            $data['persons'] = [];
        }

        // var_dump($result);
        $this->load->view('user_view/user_nonribbon/gen_property', $data);
    }

    public function summarize_name()
    {
        $unit = $this->user_nonribbon_model->get_unitname($this->session->unit)->row_array();
        $data['unitname']     = $unit['NPRT_NAME'];
        $data['unitID']     = $this->myfunction->encode($unit['NPRT_UNIT']);
        $data['sidemenu'] = $this->load->view('user_view/user_menu/list_user_menu', null, true);
        $this->load->view('foundation_view/header');
        $this->load->view('user_view/user_menu/navbar_user', $data);
        $this->load->view('user_view/user_nonribbon/user_summarize_name_form', $data);
        $this->load->view('main_view/container_footer');
        $this->load->view('foundation_view/footer');
    }

    public function action_summarize_name()
    {
        $this->load->library('pdf');

        $unitID = $this->myfunction->decode($this->input->post('unitid'));

        $data['year']           = $this->input->post('year');
        $data['unit_name']      = $this->person_data->get_unit_name($unitID);

        $data['thc'] = $this->user_nonribbon_model->get_person_prop($unitID, array('ท.ช.'), '05')->result_array();
        $data['thm'] = $this->user_nonribbon_model->get_person_prop($unitID, array('ท.ม.'), '06')->result_array();
        $data['tc'] = $this->user_nonribbon_model->get_person_prop($unitID, array('ต.ช.'), '07')->result_array();
        $data['tm'] = $this->user_nonribbon_model->get_person_prop($unitID, array('ต.ม.'), '08')->result_array();
        $data['jc'] = $this->user_nonribbon_model->get_person_prop($unitID, array('จ.ช.'), '09')->result_array();

        $rsJm = $this->user_nonribbon_model->get_person_prop($unitID, array('จ.ม.'), array('10', '11'))->result_array();
        $data['jm'] = $this->user_nonribbon_model->jm_person_filter($rsJm);

        $rsBc = $this->user_nonribbon_model->get_person_prop($unitID, array('บ.ช.'), array('11', '21'))->result_array();
        $data['bc'] = $this->user_nonribbon_model->bc_person_filter($rsBc);

        $rsBm = $this->user_nonribbon_model->get_person_prop($unitID, array('บ.ม.'), array('11', '21', '22', '23', '24'))->result_array();
        $data['bm'] = $this->user_nonribbon_model->bm_person_filter($rsBm);

        $rsRtc = $this->user_nonribbon_model->get_person_coin_prop($unitID, array('21', '22', '23', '24'))->result_array();
        $data['rtc'] = $this->user_nonribbon_model->rtc_person_filter($rsRtc);

        $rsRtm = $this->user_nonribbon_model->get_person_coin_prop($unitID, array('25'))->result_array();
        $data['rtm'] = $this->user_nonribbon_model->rtm_person_filter($rsRtm);

        $rsRgc = $this->user_nonribbon_model->get_person_coin_prop($unitID, array('26'))->result_array();
        $data['rgc'] = $this->user_nonribbon_model->rgc_person_filter($rsRgc);

        $rsRgm = $this->user_nonribbon_model->get_person_coin_prop($unitID, array('27'))->result_array();
        $data['rgm'] = $this->user_nonribbon_model->rgm_person_filter($rsRgm);

        // $data['persons_mpc']    = $this->admin_ribbon_prop_model->get_person_prop_mpc($unitID, $data['year'])->result_array();
        // $data['persons_mvm']    = $this->admin_ribbon_prop_model->get_person_prop_mvm($unitID, $data['year'])->result_array();
        // $data['persons_pc']     = $this->admin_ribbon_prop_model->get_person_prop_pc($unitID, $data['year'])->result_array();
        // $data['persons_pm']     = $this->admin_ribbon_prop_model->get_person_prop_pm($unitID, $data['year']);

        // var_dump($data);
        $this->load->view('user_view/user_nonribbon/gen_summarize_name', $data);
    }

    public function nonribbon_amount()
    {
        $unit = $this->user_nonribbon_model->get_unitname($this->session->unit)->row_array();
        $data['unitname']     = $unit['NPRT_NAME'];
        $data['unitID']     = $this->myfunction->encode($unit['NPRT_UNIT']);
        $data['sidemenu'] = $this->load->view('user_view/user_menu/list_user_menu', null, true);
        $this->load->view('foundation_view/header');
        $this->load->view('user_view/user_menu/navbar_user', $data);
        $this->load->view('user_view/user_nonribbon/person_amount_form', $data);
        $this->load->view('main_view/container_footer');
        $this->load->view('foundation_view/footer');
    }

    public function action_person_amount()
    {
        $this->load->library('pdf');

        $unitID = $this->myfunction->decode($this->input->post('unitid'));

        $data['year']           = $this->input->post('year');
        $data['unit_name']      = $this->person_data->get_unit_name($unitID);

        $dtthc = $this->user_nonribbon_model->get_person_prop($unitID, array('ท.ช.'), '05')->result_array();
        $dtthm = $this->user_nonribbon_model->get_person_prop($unitID, array('ท.ม.'), '06')->result_array();
        $dttc = $this->user_nonribbon_model->get_person_prop($unitID, array('ต.ช.'), '07')->result_array();
        $dttm = $this->user_nonribbon_model->get_person_prop($unitID, array('ต.ม.'), '08')->result_array();
        $dtjc = $this->user_nonribbon_model->get_person_prop($unitID, array('จ.ช.'), '09')->result_array();

        $rsJm = $this->user_nonribbon_model->get_person_prop($unitID, array('จ.ม.'), array('10', '11'))->result_array();
        $dtjm = $this->user_nonribbon_model->jm_person_filter($rsJm);

        $rsBc = $this->user_nonribbon_model->get_person_prop($unitID, array('บ.ช.'), array('11', '21'))->result_array();
        $dtbc = $this->user_nonribbon_model->bc_person_filter($rsBc);

        $rsBm = $this->user_nonribbon_model->get_person_prop($unitID, array('บ.ม.'), array('11', '21', '22', '23', '24'))->result_array();
        $dtbm = $this->user_nonribbon_model->bm_person_filter($rsBm);

        $rsRtc = $this->user_nonribbon_model->get_person_coin_prop($unitID, array('21', '22', '23', '24'))->result_array();
        $dtrtc = $this->user_nonribbon_model->rtc_person_filter($rsRtc);

        $rsRtm = $this->user_nonribbon_model->get_person_coin_prop($unitID, array('25'))->result_array();
        $dtrtm = $this->user_nonribbon_model->rtm_person_filter($rsRtm);

        $rsRgc = $this->user_nonribbon_model->get_person_coin_prop($unitID, array('26'))->result_array();
        $dtrgc = $this->user_nonribbon_model->rgc_person_filter($rsRgc);

        $rsRgm = $this->user_nonribbon_model->get_person_coin_prop($unitID, array('27'))->result_array();
        $dtrgm = $this->user_nonribbon_model->rgm_person_filter($rsRgm);

        $persons_thc_men        = array_filter($dtthc, function ($r) {
            return $r['BIOG_SEX'] == 0;
        });
        $persons_thc_women      = array_filter($dtthc, function ($r) {
            return $r['BIOG_SEX'] == 1;
        });
        $data['thc']['men']     = count($persons_thc_men);
        $data['thc']['women']   = count($persons_thc_women);

        $persons_thm_men        = array_filter($dtthm, function ($r) {
            return $r['BIOG_SEX'] == 0;
        });
        $persons_thm_women      = array_filter($dtthm, function ($r) {
            return $r['BIOG_SEX'] == 1;
        });
        $data['thm']['men']     = count($persons_thm_men);
        $data['thm']['women']   = count($persons_thm_women);

        $persons_tc_men        = array_filter($dttc, function ($r) {
            return $r['BIOG_SEX'] == 0;
        });
        $persons_tc_women      = array_filter($dttc, function ($r) {
            return $r['BIOG_SEX'] == 1;
        });
        $data['tc']['men']     = count($persons_tc_men);
        $data['tc']['women']   = count($persons_tc_women);

        $persons_tm_men        = array_filter($dttm, function ($r) {
            return $r['BIOG_SEX'] == 0;
        });
        $persons_tm_women      = array_filter($dttm, function ($r) {
            return $r['BIOG_SEX'] == 1;
        });
        $data['tm']['men']     = count($persons_tm_men);
        $data['tm']['women']   = count($persons_tm_women);

        $persons_jc_men        = array_filter($dtjc, function ($r) {
            return $r['BIOG_SEX'] == 0;
        });
        $persons_jc_women      = array_filter($dtjc, function ($r) {
            return $r['BIOG_SEX'] == 1;
        });
        $data['jc']['men']     = count($persons_jc_men);
        $data['jc']['women']   = count($persons_jc_women);

        $persons_jm_men        = array_filter($dtjm, function ($r) {
            return $r['BIOG_SEX'] == 0;
        });
        $persons_jm_women      = array_filter($dtjm, function ($r) {
            return $r['BIOG_SEX'] == 1;
        });
        $data['jm']['men']     = count($persons_jm_men);
        $data['jm']['women']   = count($persons_jm_women);

        $persons_bc_men        = array_filter($dtbc, function ($r) {
            return $r['BIOG_SEX'] == 0;
        });
        $persons_bc_women      = array_filter($dtbc, function ($r) {
            return $r['BIOG_SEX'] == 1;
        });
        $data['bc']['men']     = count($persons_bc_men);
        $data['bc']['women']   = count($persons_bc_women);

        $persons_bm_men        = array_filter($dtbm, function ($r) {
            return $r['BIOG_SEX'] == 0;
        });
        $persons_bm_women      = array_filter($dtbm, function ($r) {
            return $r['BIOG_SEX'] == 1;
        });
        $data['bm']['men']     = count($persons_bm_men);
        $data['bm']['women']   = count($persons_bm_women);

        $persons_rtc_men        = array_filter($dtrtc, function ($r) {
            return $r['BIOG_SEX'] == 0;
        });
        $persons_rtc_women      = array_filter($dtrtc, function ($r) {
            return $r['BIOG_SEX'] == 1;
        });
        $data['rtc']['men']     = count($persons_rtc_men);
        $data['rtc']['women']   = count($persons_rtc_women);

        $persons_rtm_men        = array_filter($dtrtm, function ($r) {
            return $r['BIOG_SEX'] == 0;
        });
        $persons_rtm_women      = array_filter($dtrtm, function ($r) {
            return $r['BIOG_SEX'] == 1;
        });
        $data['rtm']['men']     = count($persons_rtm_men);
        $data['rtm']['women']   = count($persons_rtm_women);

        $persons_rgc_men        = array_filter($dtrgc, function ($r) {
            return $r['BIOG_SEX'] == 0;
        });
        $persons_rgc_women      = array_filter($dtrgc, function ($r) {
            return $r['BIOG_SEX'] == 1;
        });
        $data['rgc']['men']     = count($persons_rgc_men);
        $data['rgc']['women']   = count($persons_rgc_women);

        $persons_rgm_men        = array_filter($dtrgm, function ($r) {
            return $r['BIOG_SEX'] == 0;
        });
        $persons_rgm_women      = array_filter($dtrgm, function ($r) {
            return $r['BIOG_SEX'] == 1;
        });
        $data['rgm']['men']     = count($persons_rgm_men);
        $data['rgm']['women']   = count($persons_rgm_women);
        // var_dump($data);
        $this->load->view('user_view/user_nonribbon/gen_person_amount', $data);
    }

    public function prepare_save_bdec()
    {
        $unit = $this->user_nonribbon_model->get_unitname($this->session->unit)->row_array();
        $data['unitname']   = $unit['NPRT_NAME'];
        $data['unitID']     = $this->myfunction->encode($unit['NPRT_UNIT']);
        $data['sidemenu']   = $this->load->view('user_view/user_menu/list_user_menu', null, true);
        $this->load->view('foundation_view/header');
        $this->load->view('user_view/user_menu/navbar_user', $data);
        $this->load->view('user_view/user_nonribbon/save_person_bdec_view', $data);
        $this->load->view('main_view/container_footer');
        $this->load->view('foundation_view/footer');
    }

    public function ajax_save_person_to_bdec()
    {
        $unitIDEnc  = $this->input->post('unitid');
        $unitID     = $this->myfunction->decode($unitIDEnc);
        $data['year']   = (int) date("Y") + 543;

        $personThc = $this->user_nonribbon_model->get_person_prop($unitID, array('ท.ช.'), '05')->result_array();
        $personThm = $this->user_nonribbon_model->get_person_prop($unitID, array('ท.ม.'), '06')->result_array();
        $personTc = $this->user_nonribbon_model->get_person_prop($unitID, array('ต.ช.'), '07')->result_array();
        $personTm = $this->user_nonribbon_model->get_person_prop($unitID, array('ต.ม.'), '08')->result_array();
        $personJc = $this->user_nonribbon_model->get_person_prop($unitID, array('จ.ช.'), '09')->result_array();

        $rsJm = $this->user_nonribbon_model->get_person_prop($unitID, array('จ.ม.'), array('10', '11'))->result_array();
        $personJm = $this->user_nonribbon_model->jm_person_filter($rsJm);

        $rsBc = $this->user_nonribbon_model->get_person_prop($unitID, array('บ.ช.'), array('11', '21'))->result_array();
        $personBc = $this->user_nonribbon_model->bc_person_filter($rsBc);

        $rsBm = $this->user_nonribbon_model->get_person_prop($unitID, array('บ.ม.'), array('11', '21', '22', '23', '24'))->result_array();
        $personBm = $this->user_nonribbon_model->bm_person_filter($rsBm);

        $rsRtc = $this->user_nonribbon_model->get_person_coin_prop($unitID, array('21', '22', '23', '24'))->result_array();
        $personRtc = $this->user_nonribbon_model->rtc_person_filter($rsRtc);

        // $rsRtm = $this->user_nonribbon_model->get_person_coin_prop($unitID, array('25'))->result_array();
        // $personRtm = $this->user_nonribbon_model->rtm_person_filter($rsRtm);

        // $rsRgc = $this->user_nonribbon_model->get_person_coin_prop($unitID, array('26'))->result_array();
        // $personRgc = $this->user_nonribbon_model->rgc_person_filter($rsRgc);

        // $rsRgm = $this->user_nonribbon_model->get_person_coin_prop($unitID, array('27'))->result_array();
        // $personRgm = $this->user_nonribbon_model->rgm_person_filter($rsRgm);
        
        // $result = array_merge($personThc, $personThm, $personTc, $personTm, $personJc, $personJm, $personBc, $personBm, $personRtc);
        $result = array();
        foreach ($personThc as $r) {
            $insertBdec = $this->user_nonribbon_model->process_insert_to_bdec($r, 'ท.ช.');
            array_push($result, $insertBdec);
        }
        foreach ($personThm as $r) {
            $insertBdec = $this->user_nonribbon_model->process_insert_to_bdec($r, 'ท.ม.');
            array_push($result, $insertBdec);
        }
        foreach ($personTc as $r) {
            $insertBdec = $this->user_nonribbon_model->process_insert_to_bdec($r, 'ต.ช.');
            array_push($result, $insertBdec);
        }
        foreach ($personTm as $r) {
            $insertBdec = $this->user_nonribbon_model->process_insert_to_bdec($r, 'ต.ม.');
            array_push($result, $insertBdec);
        }
        foreach ($personJc as $r) {
            $insertBdec = $this->user_nonribbon_model->process_insert_to_bdec($r, 'จ.ช.');
            array_push($result, $insertBdec);
        }
        foreach ($personJm as $r) {
            $insertBdec = $this->user_nonribbon_model->process_insert_to_bdec($r, 'จ.ม.');
            array_push($result, $insertBdec);
        }
        foreach ($personBc as $r) {
            $insertBdec = $this->user_nonribbon_model->process_insert_to_bdec($r, 'บ.ช.');
            array_push($result, $insertBdec);
        }
        foreach ($personBm as $r) {
            $insertBdec = $this->user_nonribbon_model->process_insert_to_bdec($r, 'บ.ม.');
            array_push($result, $insertBdec);
        }
        foreach ($personRtc as $r) {
            $insertBdec = $this->user_nonribbon_model->process_insert_to_bdec($r, 'ร.ท.ช.');
            array_push($result, $insertBdec);
        }

        $response = json_encode($result);
        $this->output
            ->set_content_type('application/json')
            ->set_output($response);
    }
}
