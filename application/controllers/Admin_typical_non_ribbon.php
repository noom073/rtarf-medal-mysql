<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_typical_non_ribbon extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('admin_typical_non_ribbon_model', 'atnr_model');
		$this->load->library('myfunction');
		$this->load->library('person_data');
	}

	public function fundation()
	{
		$data['sidemenu'] = $this->load->view('admin_view/admin_menu/list_admin_menu', null, true);

		$this->load->view('foundation_view/header');
		$this->load->view('admin_view/admin_menu/navbar_admin');
		$this->load->view('admin_view/admin_typical_non_ribbon/admin_typical_non_ribbon_fundation', $data);
		$this->load->view('main_view/container_footer');
		$this->load->view('foundation_view/footer');
	}

	public function ajax_get_person_bdec()
	{
		$unitInput 	= $this->input->post('unitid', true);
		$unitID4 	= substr($this->myfunction->decode($unitInput), 0, 4);
		$person 	= $this->atnr_model->get_person_bdec($unitID4)->result_array();
		$response 	= json_encode($person);
		$this->output
			->set_content_type('application/json')
			->set_output($response);
	}

	public function ajax_update_medal_bdec()
	{
		$data['biogID'] 	= $this->input->post('id');
		$data['medal'] 		= $this->input->post('medal');
		$data['nextMedal']	= $this->input->post('nextMedal');

		$update = $this->person_data->save_update_medal_bdec($data);
		if ($update) {
			$result['status'] 	= true;
			$result['text'] 	= 'บันทึกสำเร็จ';
		} else {
			$result['status'] 	= false;
			$result['text'] 	= 'บันทึกไม่สำเร็จ';
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($result));
	}

	public function ajax_search_person()
	{
		$data['type']	= $this->input->post('type_opt', true);
		$data['text']	= $this->input->post('text_search', true);
		$unitInput 		= $this->input->post('unitID', true);
		$data['unitID4'] = substr($this->myfunction->decode($unitInput), 0, 4);
		$personData		= $this->person_data->search_person($data)->result_array();
		$persons 		= array_filter($personData, function ($x) {
			/** filter person's rank <= 06 only */
			return $x['BIOG_RANK'] >= '06';
		});
		if (count($persons) > 0) {
			$result['status']	= true;
			$result['text'] 	= "พบข้อมูล";
			foreach ($persons as $r) {
				$result['data'][] = $r;
			}
		} else {
			$result['status'] 	= false;
			$result['text'] 	= "ไม่พบข้อมูล";
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($result));
	}

	public function ajax_add_person_to_bdec()
	{
		$data['nextMedal'] 	= $this->input->post('medal', true);
		$data['biogID']	= $this->input->post('biog_id', true);

		$insert = $this->person_data->add_person_bdec($data);
		if ($insert == 'SUCCESS') {
			$result['status'] = true;
			$result['text'] = 'บันทึกสำเร็จ';
		} else if ($insert == 'ERR-DUPLICATE') {
			$result['status'] = false;
			$result['text'] = 'มีรายชื่อแล้ว';
		} else if ($insert == 'ERR-INSERT-FAIL') {
			$result['status'] = false;
			$result['text'] = 'ไม่สามารถบันทึกได้';
		} else {
			$result['status'] = false;
			$result['text'] = 'NOT IN CASE';
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($result));
	}

	public function ajax_delete_bdec_person()
	{
		$biogID = $this->input->post('bdec_id', true);
		$delete = $this->atnr_model->delete_bdec_person($biogID);

		if ($delete) {
			$result['status'] = true;
			$result['text'] = 'ลบข้อมูลสำเร็จ';
		} else {
			$result['status'] = false;
			$result['text'] = 'ไม่สามารถลบข้อมูลได้';
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($result));
	}

	public function property()
	{
		$data['sidemenu'] = $this->load->view('admin_view/admin_menu/list_admin_menu', null, true);

		$this->load->view('foundation_view/header');
		$this->load->view('admin_view/admin_menu/navbar_admin');
		$this->load->view('admin_view/admin_typical_non_ribbon/admin_typical_non_ribbon_index', $data);
		$this->load->view('main_view/container_footer');
		$this->load->view('foundation_view/footer');
	}

	public function action_get_non_ribbon_person_prop()
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
		$data['condition']      = $this->input->post('condition');

		$data['persons'] = $this->atnr_model->get_person_prop_by_medal($unitID, $data)->result_array();

		$this->load->view('admin_view/admin_typical_non_ribbon/gen_non_ribbon_property', $data);
	}

	public function summarize_name()
	{
		$data['sidemenu'] = $this->load->view('admin_view/admin_menu/list_admin_menu', null, true);

		$this->load->view('foundation_view/header');
		$this->load->view('admin_view/admin_menu/navbar_admin');
		$this->load->view('admin_view/admin_typical_non_ribbon/admin_typical_non_ribbon_summarize_name_form', $data);
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

		$data['ribbon_acm'] = 'ท.ช.';
		$data['thc']    = $this->atnr_model->get_person_prop_by_medal($unitID, $data)->result_array();
		$data['ribbon_acm'] = 'ท.ม.';
        $data['thm']    = $this->atnr_model->get_person_prop_by_medal($unitID, $data)->result_array();
		$data['ribbon_acm'] = 'ต.ช.';
        $data['tc']    = $this->atnr_model->get_person_prop_by_medal($unitID, $data)->result_array();
		$data['ribbon_acm'] = 'ต.ม.';
        $data['tm']    = $this->atnr_model->get_person_prop_by_medal($unitID, $data)->result_array();
		$data['ribbon_acm'] = 'จ.ช.';
        $data['jc']    = $this->atnr_model->get_person_prop_by_medal($unitID, $data)->result_array();
		$data['ribbon_acm'] = 'จ.ม.';
        $data['jm']    = $this->atnr_model->get_person_prop_by_medal($unitID, $data)->result_array();
		$data['ribbon_acm'] = 'บ.ช.';
        $data['bc']    = $this->atnr_model->get_person_prop_by_medal($unitID, $data)->result_array();
		$data['ribbon_acm'] = 'บ.ม.';
        $data['bm']    = $this->atnr_model->get_person_prop_by_medal($unitID, $data)->result_array();
		$data['ribbon_acm'] = 'ร.ท.ช.';
        $data['rtc']    = $this->atnr_model->get_person_prop_by_medal($unitID, $data)->result_array();
		$data['ribbon_acm'] = 'ร.ท.ม.';
        $data['rtm']    = $this->atnr_model->get_person_prop_by_medal($unitID, $data)->result_array();
		$data['ribbon_acm'] = 'ร.ง.ช.';
        $data['rgc']    = $this->atnr_model->get_person_prop_by_medal($unitID, $data)->result_array();
		$data['ribbon_acm'] = 'ร.ง.ม.';
        $data['rgm']    = $this->atnr_model->get_person_prop_by_medal($unitID, $data)->result_array();
        
        $this->load->view('admin_view/admin_typical_non_ribbon/gen_non_ribbon_summarize_name', $data);
	}
	
	public function ribbon_amount()
    {
        $data['sidemenu'] = $this->load->view('admin_view/admin_menu/list_admin_menu', null, true);
        $this->load->view('foundation_view/header');
        $this->load->view('admin_view/admin_menu/navbar_admin');
        $this->load->view('admin_view/admin_typical_non_ribbon/admin_typical_non_ribbon_amount_form', $data);
        $this->load->view('main_view/container_footer');
        $this->load->view('foundation_view/footer');
    }

    public function action_get_ribbon_amount()
    {
        $this->load->library('pdf');

        $unitID = $this->myfunction->decode($this->input->post('unitid'));

        $data['year']    	= $this->input->post('year');
        $data['condition']  = $this->input->post('condition');
		$data['unit_name'] 	= $this->person_data->get_unit_name($unitID);
		
		$data['ribbon_acm'] = 'ท.ช.';
		$dtthc = $this->atnr_model->get_person_prop_by_medal($unitID, $data)->result_array();
		$data['ribbon_acm'] = 'ท.ม.';
		$dtthm = $this->atnr_model->get_person_prop_by_medal($unitID, $data)->result_array();
		$data['ribbon_acm'] = 'ต.ช.';
		$dttc = $this->atnr_model->get_person_prop_by_medal($unitID, $data)->result_array();
		$data['ribbon_acm'] = 'ต.ม.';
		$dttm = $this->atnr_model->get_person_prop_by_medal($unitID, $data)->result_array();
		$data['ribbon_acm'] = 'จ.ช.';
        $dtjc = $this->atnr_model->get_person_prop_by_medal($unitID, $data)->result_array();
		$data['ribbon_acm'] = 'จ.ม.';
        $dtjm = $this->atnr_model->get_person_prop_by_medal($unitID, $data)->result_array();
		$data['ribbon_acm'] = 'บ.ช.';
        $dtbc = $this->atnr_model->get_person_prop_by_medal($unitID, $data)->result_array();
		$data['ribbon_acm'] = 'บ.ม.';
        $dtbm = $this->atnr_model->get_person_prop_by_medal($unitID, $data)->result_array();
		$data['ribbon_acm'] = 'ร.ท.ช.';
        $dtrtc = $this->atnr_model->get_person_prop_by_medal($unitID, $data)->result_array();
		$data['ribbon_acm'] = 'ร.ท.ม.';
        $dtrtm = $this->atnr_model->get_person_prop_by_medal($unitID, $data)->result_array();
		$data['ribbon_acm'] = 'ร.ง.ช.';
        $dtrgc = $this->atnr_model->get_person_prop_by_medal($unitID, $data)->result_array();
		$data['ribbon_acm'] = 'ร.ง.ม.';
        $dtrgm = $this->atnr_model->get_person_prop_by_medal($unitID, $data)->result_array();

        $persons_thc_men        = array_filter($dtthc, function($r) { return $r['BIOG_SEX'] == 0; });
        $persons_thc_women      = array_filter($dtthc, function($r) { return $r['BIOG_SEX'] == 1; });
        $data['thc']['men']     = count($persons_thc_men);
        $data['thc']['women']   = count($persons_thc_women);

        $persons_thm_men        = array_filter($dtthm, function($r) { return $r['BIOG_SEX'] == 0; });
        $persons_thm_women      = array_filter($dtthm, function($r) { return $r['BIOG_SEX'] == 1; });
        $data['thm']['men']     = count($persons_thm_men);
        $data['thm']['women']   = count($persons_thm_women);

        $persons_tc_men        = array_filter($dttc, function($r) { return $r['BIOG_SEX'] == 0; });
        $persons_tc_women      = array_filter($dttc, function($r) { return $r['BIOG_SEX'] == 1; });
        $data['tc']['men']     = count($persons_tc_men);
        $data['tc']['women']   = count($persons_tc_women);

        $persons_tm_men        = array_filter($dttm, function($r) { return $r['BIOG_SEX'] == 0; });
        $persons_tm_women      = array_filter($dttm, function($r) { return $r['BIOG_SEX'] == 1; });
        $data['tm']['men']     = count($persons_tm_men);
        $data['tm']['women']   = count($persons_tm_women);
        
        $persons_jc_men        = array_filter($dtjc, function($r) { return $r['BIOG_SEX'] == 0; });
        $persons_jc_women      = array_filter($dtjc, function($r) { return $r['BIOG_SEX'] == 1; });
        $data['jc']['men']     = count($persons_jc_men);
        $data['jc']['women']   = count($persons_jc_women);

        $persons_jm_men        = array_filter($dtjm, function($r) { return $r['BIOG_SEX'] == 0; });
        $persons_jm_women      = array_filter($dtjm, function($r) { return $r['BIOG_SEX'] == 1; });
        $data['jm']['men']     = count($persons_jm_men);
        $data['jm']['women']   = count($persons_jm_women);

        $persons_bc_men        = array_filter($dtbc, function($r) { return $r['BIOG_SEX'] == 0; });
        $persons_bc_women      = array_filter($dtbc, function($r) { return $r['BIOG_SEX'] == 1; });
        $data['bc']['men']     = count($persons_bc_men);
        $data['bc']['women']   = count($persons_bc_women);

        $persons_bm_men        = array_filter($dtbm, function($r) { return $r['BIOG_SEX'] == 0; });
        $persons_bm_women      = array_filter($dtbm, function($r) { return $r['BIOG_SEX'] == 1; });
        $data['bm']['men']     = count($persons_bm_men);
        $data['bm']['women']   = count($persons_bm_women);

        $persons_rtc_men        = array_filter($dtrtc, function($r) { return $r['BIOG_SEX'] == 0; });
        $persons_rtc_women      = array_filter($dtrtc, function($r) { return $r['BIOG_SEX'] == 1; });
        $data['rtc']['men']     = count($persons_rtc_men);
        $data['rtc']['women']   = count($persons_rtc_women);

        $persons_rtm_men        = array_filter($dtrtm, function($r) { return $r['BIOG_SEX'] == 0; });
        $persons_rtm_women      = array_filter($dtrtm, function($r) { return $r['BIOG_SEX'] == 1; });
        $data['rtm']['men']     = count($persons_rtm_men);
        $data['rtm']['women']   = count($persons_rtm_women);

        $persons_rgc_men        = array_filter($dtrgc, function($r) { return $r['BIOG_SEX'] == 0; });
        $persons_rgc_women      = array_filter($dtrgc, function($r) { return $r['BIOG_SEX'] == 1; });
        $data['rgc']['men']     = count($persons_rgc_men);
        $data['rgc']['women']   = count($persons_rgc_women);

        $persons_rgm_men        = array_filter($dtrgm, function($r) { return $r['BIOG_SEX'] == 0; });
        $persons_rgm_women      = array_filter($dtrgm, function($r) { return $r['BIOG_SEX'] == 1; });
        $data['rgm']['men']     = count($persons_rgm_men);
        $data['rgm']['women']   = count($persons_rgm_women);

        // var_dump($data);
        $this->load->view('admin_view/admin_typical_non_ribbon/gen_non_ribbon_amount', $data);

    }
}
