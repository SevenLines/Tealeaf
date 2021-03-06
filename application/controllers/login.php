<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include 'application/controllers/base_page.php'; // include_once '../page_base.php';

class Login extends Base_page {

    var $rewrite_refer_url = FALSE;	
    var $secure_cookies_name = 'haksdj';
	
    function __construct()
    {
        parent::__construct();		        
        
        $this->load->library('session'); // fore using CI session
    }

    function index() {
        $get_password = md5($this->input->post('pass'));
        $real_password = $this->OptionsModel->password();
        $logged = $this->session->userdata('logged');

        if( $get_password === $real_password ) {	
            $last_page = $this->session->userdata('refer');
            $this->session->set_userdata('logged', TRUE);
            redirect($last_page);
        }
        
            $data['logged'] = $logged;
        if ($this->state) {
            $this->__show("Вход в систему", "Вход в систему", '', "login",  $data);
        } else {
            $this->__show_turned_off();
        }

    }

    function logout() {
        $this->session->set_userdata('logged', FALSE);
        redirect($this->last_url);
    }
	
	
}
