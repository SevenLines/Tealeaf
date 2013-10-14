<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include_once 'application/controllers/page_base.php'; // include_once '../page_base.php';

class Main extends Page_base {

    function __construct()
    {
        parent::__construct();
    }
    
	//Called when no paramters set for constructor
	public function index($page=null)
	{
		$this->__showMainPage();
	}
	
	public function inside()
	{
		$this->load->view('static/inside');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */ 
