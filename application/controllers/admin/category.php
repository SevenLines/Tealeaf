<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include_once 'application/controllers/auth_base.php';

class Category extends Auth_base {
	
	function __construct()
    {
        parent::__construct();
		$this->load->helper('form');
    }

	function index($category_id=null) {
		if (!isset($category_id)) {
			redirect('admin/categories');
		}
		$data['category2'] = $this->ArticlesModel->get_category($category_id);
		$data['articles'] = $this->ArticlesModel->get_articles_list($category_id, -1);
		$data['breadcrumbs'] = '<a href="'.site_url().'/admin/categories"><< к выбору категорий</a>';
		$this->__show("manager", "«{$data['category2']->title}» id: $category_id", "manager/category",$data);
	}	
	
	function update($category_id=null) {
		$data = $this->input->post();
		unset($data['submit']); // remove button from data to update
		
		$this->ArticlesModel->update_category($category_id, $data);
		redirect($this->last_url);
	}
	
	function delete($category_id=null) {
		//$this->ArticlesModel->delete_category($category_id);
		redirect($this->last_url);
	}
	
}

