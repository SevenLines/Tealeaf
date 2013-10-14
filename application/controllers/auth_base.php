<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include_once 'application/controllers/base_page.php';

class Auth_base extends Base_page {
	
	function __construct()
    {
        parent::__construct();
        $this->load->model('LessonsModel'); // for using database model
		$this->load->library('session'); // fore using CI session
		$this->load->helper('url'); // for redirecting
    }
	
	// checked is logged and redirect to login page on false
	function __check_logged($redirect = true) {
		$logged = $this->session->userdata('logged');
		if ( isset($logged) & $logged )	{
			return true;
		}
		
		if ($redirect) {
			$this->session->set_userdata('refer', current_url()); 
			redirect('/login', 'refresh');
		}
		
		return false;
	}
	
	function index() {
		$this->__check_logged();
		$this->__showMainPage();
	}
	
	
}
