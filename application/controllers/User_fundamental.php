<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_fundamental extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('user_fundamental_model');
		$this->load->library('session');
		$this->load->library('myfunction');
	}

	public function index()
	{

		$unit = $this->user_fundamental_model->get_unitname($this->session->unit)->row_array();
		$data['unitname'] 	= $unit['NPRT_NAME'];
		$data['unitID'] 	= $this->myfunction->encode($unit['NPRT_UNIT']);
		$data['sidemenu']	= $this->load->view('user_view/user_menu/list_user_menu', null, true);
		$this->load->view('foundation_view/header');
		$this->load->view('user_view/user_menu/navbar_user', $data);
		$this->load->view('user_view/user_fdmt/user_fdmt_profile', $data);
		$this->load->view('main_view/container_footer');
		$this->load->view('foundation_view/footer');
	}

	public function ajax_search_person()
	{
		$unitid = $this->input->post('unitid');
		$data['type'] = $this->input->post('type');
		$data['text'] = $this->input->post('text');
		$data['unitid'] = $this->myfunction->decode($unitid);
		$result = $this->user_fundamental_model->get_person($data);
		if ($result->num_rows() > 0) {
			$person = array();
			foreach ($result->result_array() as $r) {
				$r['BIOG_ID'] = $this->myfunction->encode($r['BIOG_ID']);
				$person[] = $r;
			}
			$respone['status'] 	= true;
			$respone['data'] 	= $person;
		} else {
			$respone['status'] 	= false;
			$respone['data'] 	= 'ไม่พบข้อมูล';
		}
		echo json_encode($respone);
	}

	public function biog($encBiog_id)
	{
		$biog_id = $this->myfunction->decode($encBiog_id);
		$data['person'] = $this->user_fundamental_model->get_person_row($biog_id)->row_array();

		$unit = $this->user_fundamental_model->get_unitname($this->session->unit)->row_array();
		$data['unitname'] 	= $unit['NPRT_NAME'];
		$data['unitID'] 	= $this->myfunction->encode($unit['NPRT_UNIT']);
		$data['sidemenu'] = $this->load->view('user_view/user_menu/list_user_menu', null, true);
		$this->load->view('foundation_view/header');
		$this->load->view('user_view/user_menu/navbar_user', $data);
		$this->load->view('user_view/user_fdmt/user_biog_profile', $data);
		$this->load->view('main_view/container_footer');
		$this->load->view('foundation_view/footer');
	}

	public function ribbon_report()
	{
		// echo 'ribbon';
		$unit = $this->user_fundamental_model->get_unitname($this->session->unit)->row_array();
		$data['unitname'] 	= $unit['NPRT_NAME'];
		$data['unitID'] 	= $this->myfunction->encode($unit['NPRT_UNIT']);
		$data['sidemenu'] = $this->load->view('user_view/user_menu/list_user_menu', null, true);
		$this->load->view('foundation_view/header');
		$this->load->view('user_view/user_menu/navbar_user', $data);
		$this->load->view('user_view/user_fdmt/user_ribbon_form', $data);
		$this->load->view('main_view/container_footer');
		$this->load->view('foundation_view/footer');
	}

	public function ajax_ribbon_generate_report()
	{
		$this->load->library('pdf');
		$this->load->library('person_data');
		$data['year']		= $this->input->post('year');
		$unitid				= $this->myfunction->decode($this->input->post('unitid'));
		$unitcode4          = substr($unitid, 0, 4);
		$data['unit_name'] 	= $this->user_fundamental_model->get_unit_name($unitid)->row_array();
		$data['persons'] 	= $this->user_fundamental_model->get_ribbon_person($unitcode4)->result_array();
		// var_dump($data);
		$this->load->view('user_view/user_fdmt/gen_ribbon_report', $data);
	}

	public function non_ribbon_report()
	{
		// echo 'non-ribbon form';
		$this->load->model('lib_model');

		$data['ranks'] = $this->lib_model->get_all_rank()->result_array();

		$unit = $this->user_fundamental_model->get_unitname($this->session->unit)->row_array();
		$data['unitname'] 	= $unit['NPRT_NAME'];
		$data['unitID'] 	= $this->myfunction->encode($unit['NPRT_UNIT']);
		$data['sidemenu'] = $this->load->view('user_view/user_menu/list_user_menu', null, true);
		$this->load->view('foundation_view/header');
		$this->load->view('user_view/user_menu/navbar_user', $data);
		$this->load->view('user_view/user_fdmt/user_non_ribbon_form', $data);
		$this->load->view('main_view/container_footer');
		$this->load->view('foundation_view/footer');
	}

	public function non_ribbon_generate_report()
	{
		$this->load->library('pdf');
		$this->load->library('person_data');

		$data['year']		= $this->input->post('year');
		$data['rankid']		= $this->input->post('rankid');
		$unitid				= $this->myfunction->decode($this->input->post('unitid'));
		$data['unit_name'] 	= $this->user_fundamental_model->get_unit_name($unitid)->row_array();
		$unitcode4          = substr($unitid, 0, 4);

		if ($data['rankid'] >= '05' && $data['rankid'] <= '11') {
			$data['rankType'] 	= 'commission';
			$data['persons'] 	= $this->user_fundamental_model
				->get_non_ribbon_person($unitcode4, $data['rankid'], $data['rankid'])
				->result_array();
			$this->load->view('user_view/user_fdmt/gen_non_ribbon_a_report', $data);
		} else if ($data['rankid'] >= '21' && $data['rankid'] <= '27') {
			$data['rankType'] 	= 'non-commission';
			$data['persons'] 	= $this->user_fundamental_model
				->get_non_ribbon_person($unitcode4, $data['rankid'], $data['rankid'])
				->result_array();
			$this->load->view('user_view/user_fdmt/gen_non_ribbon_b_report', $data);
		} else if ($data['rankid'] >= '50' && $data['rankid'] <= '61') {
			$data['rankType'] 	= 'employee';
			$data['persons'] 	= $this->user_fundamental_model
				->get_non_ribbon_person($unitcode4, $data['rankid'], $data['rankid'])
				->result_array();
			$this->load->view('user_view/user_fdmt/gen_non_ribbon_c_report', $data);
		} else {
			$data['rankType'] = 'not in rank';
			redirect('user_fundamental/non_ribbon_report');
		}
	}

	public function not_request_medal()
	{
		// echo 'non-ribbon form';
		$this->load->model('lib_model');

		$data['ranks'] = $this->lib_model->get_all_rank()->result_array();
		
		$unit = $this->user_fundamental_model->get_unitname($this->session->unit)->row_array();
		$data['unitname'] 	= $unit['NPRT_NAME'];
		$data['unitID'] 	= $this->myfunction->encode($unit['NPRT_UNIT']);
		$data['sidemenu'] = $this->load->view('user_view/user_menu/list_user_menu', null, true);
		$this->load->view('foundation_view/header');
		$this->load->view('user_view/user_menu/navbar_user', $data);
		$this->load->view('user_view/user_fdmt/user_not_request_medal_form', $data);
		$this->load->view('main_view/container_footer');
		$this->load->view('foundation_view/footer');
	}

	public function not_request_medal_generate_report()
	{
		$this->load->library('pdf');
		$this->load->library('person_data');

		$data['year']		= $this->input->post('year');
		$data['rankid']		= $this->input->post('rankid');
		$unitid				= $this->myfunction->decode($this->input->post('unitid'));
		$data['unit_name'] 	= $this->user_fundamental_model->get_unit_name($unitid)->row_array();
		$unitcode4          = substr($unitid, 0, 4);

		if ($data['rankid'] >= '05' && $data['rankid'] <= '11') {
			$data['rankType'] 	= 'commission';
			$data['persons'] 	= $this->user_fundamental_model
				->get_non_ribbon_person($unitcode4, $data['rankid'], $data['rankid'])
				->result_array();
			$this->load->view('user_view/user_fdmt/gen_not_req_medal_a_report', $data);
		} else if ($data['rankid'] >= '21' && $data['rankid'] <= '27') {
			$data['rankType'] 	= 'non-commission';
			$data['persons'] 	= $this->user_fundamental_model
				->get_non_ribbon_person($unitcode4, $data['rankid'], $data['rankid'])
				->result_array();
			$this->load->view('user_view/user_fdmt/gen_not_req_medal_b_report', $data);
		} else if ($data['rankid'] >= '50' && $data['rankid'] <= '61') {
			$data['rankType'] 	= 'employee';
			$data['persons'] 	= $this->user_fundamental_model
				->get_non_ribbon_person($unitcode4, $data['rankid'], $data['rankid'])
				->result_array();
			$this->load->view('user_view/user_fdmt/gen_not_req_medal_c_report', $data);
		} else {
			$data['rankType'] = 'not in rank';
			redirect('user_fundamental/non_ribbon_report');
		}
	}
}
