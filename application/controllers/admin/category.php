<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include_once 'admin_base.php';

class Category extends Admin_base {
	var $current_controller = "admin/category";
	
	
	function __construct()
    {
        parent::__construct();
		$this->load->helper('form');
    }

	// returns data for selector form_dropdown()
	// of all available ords
	function __get_select_ord($articles_list) {
		$out = array();
		foreach($articles_list as $a) {
			$out[$a->ord] = $a->ord;
		}
		return $out;
	}

	function index($category_id=null) {
		if (!isset($category_id)) {
			redirect('admin/categories');
		}
		
		$data['status'] = $this->session->flashdata('status');
		
		if ($category_id == 0) {
			$title = 'Без категории';	
			$data['category2'] = '';
		} else {
			$data['category2'] = $this->ArticlesModel->get_category($category_id);
			$title = "«{$data['category2']->title}» id: $category_id";
		}
		
		$data['articles'] = $this->ArticlesModel->get_articles_info_list($category_id, -1);
		
		$data['ords'] = $this->__get_select_ord($data['articles']);
		
		$data['breadcrumbs'] = '<a href="'.site_url().'/admin"><< к выбору категорий</a>';
		
		$this->__show( $title, "Категория", "", "manager/category",$data, $category_id);
	}	
	
	function update($category_id) {
		$data = $this->input->post();
		// what if someone make redirect with post data to current page
		if (!$data) $data = $this->session->flashdata('post');
		if( $data ) {
			unset($data['submit']); // remove button from data to update
			$this->ArticlesModel->update_category($category_id, $data);
		}
		$this->session->set_flashdata('status', "Категория $category_id успешно обновлена");
		redirect($this->last_url);
	}
	
	function delete($category_id=null) {
		$this->ArticlesModel->delete_category($category_id);
		$this->session->set_flashdata('status', "Категория $category_id успешно удалена");
		redirect($this->last_url);
	}
	
	function add($title) {
		$data['title'] = $data['title_page'] = $data['title_menu'] = $title;
		$data['controller'] = "";
		$this->ArticlesModel->add_category($data);
		$this->session->set_flashdata('status', "Категория успешно добавлена");
		redirect($this->last_url);
	}
	
	function reorder($category_id, $old_ord) {
		$new_ord = $this->input->post('ord');
		$this->ArticlesModel->set_category_order($category_id, $old_ord, $new_ord);
		$this->session->set_flashdata('status', "Категория $category_id теперь имеет номер $new_ord");
		redirect($this->last_url);
	}
	
	function toggle($category_id, $enabled) {
		$data['enabled'] = $enabled==1?0:1; 
		$this->ArticlesModel->update_category($category_id, $data);
		$this->session->set_flashdata('status', "Категория $category_id теперь ".(!$enabled?'доступна':'недоступна'));
		redirect($this->last_url);
	}
}

