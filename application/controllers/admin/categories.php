<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include_once 'application/controllers/auth_base.php';

class Categories extends Auth_base {

	function __construct()
    {
        parent::__construct();
		$this->load->helper('form');
    }

	function index() {
		$data['categories'] = $this->ArticlesModel->get_categories();
		$this->__show("manager", "", "manager/categories",$data);
	}	
	
	public function delete($category_id = null) {
		$this->ArticlesModel->delete_category($category_id);
		redirect('admin/'.$this->router->class);
	}
	
	public function update($category_id = null) {
		$data = $this->input->post();
		unset($data['submit']); // remove button from data to update
		unset($data['update']); // remove button from data to update
		$this->ArticlesModel->update_category($category_id, $data);
		redirect('admin/'.$this->router->class);
	}
	
	public function edit($category_id = null) {
		redirect('admin/category/'.$category_id);
	}
	
	public function add() {
		//redirect('admin/category/'.$category_id);
	}
}
