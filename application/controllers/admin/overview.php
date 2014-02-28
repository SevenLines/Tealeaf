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
		$data['articles_stat'] = $this->ArticlesModel->get_most_visited_articles_info(20);
		$data['ords'] = $this->__get_select_ord($data['categories']);
                
                //generate specific categories info 
                foreach ($data['categories'] as &$category) {
                    $c = (array) $category;
                    $id = $c["id_"];
                    $enabled = $c["enabled"];
                    $ord = $c["ord"];
                    
                    $c["href"]["edit"] = site_url()."admin/category/$id";
                    $c["href"]["delete"] = site_url()."admin/category/delete/$id";
                    $c["href"]["update"] = site_url()."admin/category/update/$id";
                    $c["href"]["toggle"] = site_url()."admin/category/toggle/$id/$enabled";
                    $c["href"]["reorder"] = site_url()."admin/category/reorder/$id/$ord";
                    
                    $c["class"] = "";
                    if ($enabled) { $c["class"] = " enabled"; }
                    $c["class"] = trim($c["class"]);
                    
                    $category = (object) $c;
                }
                
		$this->__show("", "manager", "", "manager/overview",$data);
	}	
        
        function turn_on() {
            $this->OptionsModel->set_state("1");
            redirect("admin");
        }
        
        function turn_off() {
            $this->OptionsModel->set_state("0");
            redirect("admin");
        }

}
