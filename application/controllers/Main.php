<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

    function __construct() {
        parent ::__construct();
        $this->load->helper('url');
    }

	public function index() {   
        $this->load->library('myfunction');     
        $this->load->view('foundation_view/header');
		$this->load->view('foundation_view/navbar_normal');
		$this->load->view('main_view/container_index');
		$this->load->view('main_view/container_footer');
        $this->load->view('foundation_view/footer');
        
    }
    
}
