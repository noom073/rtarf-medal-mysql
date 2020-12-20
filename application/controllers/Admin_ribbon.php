<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_ribbon extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('myfunction');
        $this->load->library('person_data');

        // $this->load->model('admin_ribbon_model');
        $this->load->model('admin_ribbon_prop_model');
    }

    public function property_form()
    {
        $data['sidemenu'] = $this->load->view('admin_view/admin_menu/list_admin_menu', null, true);
        $this->load->view('foundation_view/header');
        $this->load->view('admin_view/admin_menu/navbar_admin');
        $this->load->view('admin_view/admin_ribbon/admin_ribbon_property_form', $data);
        $this->load->view('main_view/container_footer');
        $this->load->view('foundation_view/footer');
    }

    public function action_get_ribbon_person_prop()
    {
        $this->load->library('pdf');

        $unitID = $this->myfunction->decode($this->input->post('unitid'));
        $ribbon    = $this->input->post('ribbon_type');

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
        $data['condition']      = $this->input->post('condition');

        if ($ribbon == 'ม.ป.ช.') {
            $data['persons'] = $this->admin_ribbon_prop_model->get_person_prop_mpc($unitID, $data)->result_array();
        } else if ($ribbon == 'ม.ว.ม.') {
            $data['persons'] = $this->admin_ribbon_prop_model->get_person_prop_mvm($unitID, $data)->result_array();
        } else if ($ribbon == 'ป.ช.') {
            $data['persons'] = $this->admin_ribbon_prop_model->get_person_prop_pc($unitID, $data)->result_array();
        } else if ($ribbon == 'ป.ม.') {
            $data['persons'] = $this->admin_ribbon_prop_model->get_person_prop_pm($unitID, $data);
        } else {
            $data['persons'] = [];
        }

        // var_dump($data);
        $this->load->view('admin_view/admin_ribbon/gen_ribbon_property', $data);
    }

    public function summarize_name_form()
    {
        $data['sidemenu'] = $this->load->view('admin_view/admin_menu/list_admin_menu', null, true);
        $this->load->view('foundation_view/header');
        $this->load->view('admin_view/admin_menu/navbar_admin');
        $this->load->view('admin_view/admin_ribbon/admin_ribbon_summarize_name_form', $data);
        $this->load->view('main_view/container_footer');
        $this->load->view('foundation_view/footer');
    }

    public function action_summarize_name()
    {
        $this->load->library('pdf');

        $unitID = $this->myfunction->decode($this->input->post('unitid'));

        $data['year']           = $this->input->post('year');
        $data['condition']      = $this->input->post('condition');
        $data['unit_name']      = $this->person_data->get_unit_name($unitID);
        $data['persons_mpc']    = $this->admin_ribbon_prop_model->get_person_prop_mpc($unitID, $data)->result_array();
        $data['persons_mvm']    = $this->admin_ribbon_prop_model->get_person_prop_mvm($unitID, $data)->result_array();
        $data['persons_pc']     = $this->admin_ribbon_prop_model->get_person_prop_pc($unitID, $data)->result_array();
        $data['persons_pm']     = $this->admin_ribbon_prop_model->get_person_prop_pm($unitID, $data);
        
        // var_dump($data);
        // echo json_encode($data);
        $this->load->view('admin_view/admin_ribbon/gen_ribbon_summarize_name', $data);
    }

    public function ribbon_amount()
    {
        $data['sidemenu'] = $this->load->view('admin_view/admin_menu/list_admin_menu', null, true);
        $this->load->view('foundation_view/header');
        $this->load->view('admin_view/admin_menu/navbar_admin');
        $this->load->view('admin_view/admin_ribbon/admin_ribbon_amount_form', $data);
        $this->load->view('main_view/container_footer');
        $this->load->view('foundation_view/footer');
    }

    public function action_get_ribbon_amount()
    {
        $this->load->library('pdf');

        $unitID = $this->myfunction->decode($this->input->post('unitid'));

        $data['year']           = $this->input->post('year');
        $data['condition']      = $this->input->post('condition');
        $data['unit_name']      = $this->person_data->get_unit_name($unitID);
        $data['persons_mpc']    = $this->admin_ribbon_prop_model->get_person_prop_mpc($unitID, $data)->result_array();
        $data['persons_mvm']    = $this->admin_ribbon_prop_model->get_person_prop_mvm($unitID, $data)->result_array();
        $data['persons_pc']     = $this->admin_ribbon_prop_model->get_person_prop_pc($unitID, $data)->result_array();
        $data['persons_pm']     = $this->admin_ribbon_prop_model->get_person_prop_pm($unitID, $data);
        
        $persons_mpc_men        = array_filter($data['persons_mpc'], function($r) { return $r['BIOG_SEX'] == 0; });
        $persons_mpc_women      = array_filter($data['persons_mpc'], function($r) { return $r['BIOG_SEX'] == 1; });
        $data['mpc']['men']     = count($persons_mpc_men);
        $data['mpc']['women']   = count($persons_mpc_women);

        $persons_mvm_men        = array_filter($data['persons_mvm'], function($r) { return $r['BIOG_SEX'] == 0; });
        $persons_mvm_women      = array_filter($data['persons_mvm'], function($r) { return $r['BIOG_SEX'] == 1; });
        $data['mvm']['men']     = count($persons_mvm_men);
        $data['mvm']['women']   = count($persons_mvm_women);

        $persons_pc_men        = array_filter($data['persons_pc'], function($r) { return $r['BIOG_SEX'] == 0; });
        $persons_pc_women      = array_filter($data['persons_pc'], function($r) { return $r['BIOG_SEX'] == 1; });
        $data['pc']['men']     = count($persons_pc_men);
        $data['pc']['women']   = count($persons_pc_women);

        $persons_pm_men        = array_filter($data['persons_pm'], function($r) { return $r['BIOG_SEX'] == 0; });
        $persons_pm_women      = array_filter($data['persons_pm'], function($r) { return $r['BIOG_SEX'] == 1; });
        $data['pm']['men']     = count($persons_pm_men);
        $data['pm']['women']   = count($persons_pm_women);

        // var_dump($data);
        $this->load->view('admin_view/admin_ribbon/gen_ribbon_amount', $data);

    }
}
