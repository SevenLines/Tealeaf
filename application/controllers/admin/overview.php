<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include_once 'application/controllers/admin/admin_base.php';

class Overview extends Admin_base {
	
	function __construct()
    {
        	
        parent::__construct();
		
		$this->load->helper('form');
		$this->load->model('VisitorsModel');
    }

	// returns data for selector form_dropdown()
	// of all available ords
	function __get_select_ord($categories_list) {
		
		$out = array();
		foreach($categories_list as $c) {
			$out[$c->ord] = $c->ord;
		}
		return $out;
	}

	function index() {
		$data['categories'] = $this->ArticlesModel->get_categories();
		$data['active_users'] = $this->VisitorsModel->get_current_visitors();
		$data['visitors'] = $this->StatsModel->get_last_visitiors(0,20);
		$data['articles_stat'] = $this->ArticlesModel->get_most_visited_articles_info();
		$data['ords'] = $this->__get_select_ord($data['categories']);
		$this->__show("", "manager", "", "manager/overview",$data);
	}	

}
