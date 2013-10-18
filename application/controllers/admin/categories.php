<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include_once 'application/controllers/auth_base.php';

class Categories extends Auth_base {
	var $flag = "manager";

	function __construct()
    {
        parent::__construct();
		$this->load->helper('form');
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
		$data['ords'] = $this->__get_select_ord($data['categories']);
		$this->__show("", "manager", "", "manager/categories",$data);
	}	

	public function update($category_id = null) {
		$this->session->set_flashdata('post', $this->input->post());
		redirect("admin/category/update/$category_id");
	}
	
	public function edit($category_id = null) {
		redirect('admin/category/'.$category_id);
	}
}
