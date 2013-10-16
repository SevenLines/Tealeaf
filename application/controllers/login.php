<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include 'application/controllers/base_page.php'; // include_once '../page_base.php';

class Login extends Base_page {
		
	var $password = "L7o4c3k2ed";
	var $rewrite_refer_url = FALSE;	
	
	function __construct()
    {
        parent::__construct();		        
		$this->load->helper('form');
		$this->load->library('session'); // fore using CI session
    }

	function index() {
		
		$get_password = $this->input->post('pass');
		$logged = $this->session->userdata('logged');
		
		if($get_password === $this->password) {
								
			$last_page = $this->session->userdata('refer');
			$this->session->set_userdata('logged', TRUE);
			redirect($last_page);
		}
		$data['logged'] = $logged;
		$this->__show("Вход в систему", "Вход в систему", "login",  $data);
	}
	
	function logout() {
		$this->session->set_userdata('logged', FALSE);
		redirect('login');
	}
	
	
}
