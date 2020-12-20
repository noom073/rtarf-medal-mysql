<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('admin_model');
		$this->load->library('myfunction');
	}

	public function index()
	{

		$data['sidemenu'] = $this->load->view('admin_view/admin_menu/list_admin_menu', null, true);

		$this->load->view('foundation_view/header');
		$this->load->view('admin_view/admin_menu/navbar_admin');
		$this->load->view('admin_view/admin_index', $data);
		$this->load->view('main_view/container_footer');
		$this->load->view('foundation_view/footer');
	}

	public function ajax_get_unit()
	{
		$result = $this->admin_model->get_unit();
		if ($result->num_rows() > 0) {
			$unit = $result->result_array();
			$data = [];
			foreach ($unit as $r) {
				$dt['NPRT_ACM']		= $r['NPRT_ACM'];
				$dt['NPRT_UNIT']	= $this->myfunction->encode($r['NPRT_UNIT']);
				$dt['NPRT_KEY']		= substr($r['NPRT_UNIT'], 0, 4);
				$data[] = $dt;
			}
		} else {
			$data = [];
		}

		echo json_encode($data);
	}
}
