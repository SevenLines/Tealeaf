<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include_once 'admin_base.php';

class Visits extends Admin_base{

	function __construct()
    {
        parent::__construct();
		$this->load->model('VisitsModel');
    }

	function index() {
		$data = array();
		$data['visits'] = $this->VisitsModel->get_last_visits(20,0);
		$this->__show("Посетители", "Посетители", '', 'manager/visits', $data);
	}	
}