<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include 'application/controllers/base_page.php'; // include_once '../page_base.php';

class Login extends Base_page {
		
	var $password = "L7o4c3k2ed";
	var $rewrite_refer_url = FALSE;	
	var $secure_cookies_name = 'haksdj';
	
	function __construct()
    {
        parent::__construct();		        
		$this->load->helper('form');
		$this->load->library('session'); // fore using CI session
		//$this->__check_logged();
    }

	function index() {
		
		$get_password = $this->input->post('pass');
		$logged = $this->session->userdata('logged');
		
		
		if (!$this->input->cookie($this->secure_cookies_name)) {
			if($get_password === $this->password) {	
				$last_page = $this->session->userdata('refer');
				$this->session->set_userdata('logged', TRUE);
				redirect($last_page);
			}
		}
		$data['logged'] = $logged;
		$this->__show("Вход в систему", "Вход в систему", "login",  $data);
		
		$cookie = array('expire' => 3, 'name' => $this->secure_cookies_name, 'value'=>':P');
		$this->input->set_cookie($cookie);
	}
	
	function logout() {
		$this->session->set_userdata('logged', FALSE);
		redirect('login');
	}
	
	
}
