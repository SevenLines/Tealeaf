<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include_once 'application/controllers/auth_base.php';

class Article extends Auth_base {

	function __construct()
    {
        parent::__construct();
		$this->load->helper('form');
    }

	function index($article_id=null) {
		if (!isset($article_id)) {
			redirect('admin/categories');
		}
		$data['article2'] = $this->ArticlesModel->get_article($article_id);
		$data['categories_list'] = $this->__get_categories_list($article_id);
		
		$category_name = $data['categories_list'][$data['article2']->category_id];
		
		$data['breadcrumbs'] = '<a href='.site_url().'/admin/category/'.$data['article2']->category_id.'>&lt;&lt; '.$category_name.'</a>';
		$title = "«{$data['article2']->title}» id: $article_id"."<a style='float:right' target=blank href=".site_url()."/admin/preview/$article_id>посмотреть</a>";
		$this->__show("Статья", $title, "manager/article", $data);
	}	
	
	function update($article_id=null) {
		$data = $this->input->post();
		unset($data['submit']);
		$this->ArticlesModel->update_article($article_id, $data);
		redirect("admin/article/$article_id");
	}
	
	function __get_categories_list($article_id) {
		$categories = $this->ArticlesModel->get_categories();
		
		$out = array();
		foreach ($categories as $cat) {
			$title = $cat->title;
			if (empty($title)) $title = $cat->title_menu;
			if (empty($title)) $title = $cat->title_page;
			if (empty($title)) $title = 'без имени';
			$out[$cat->id_] =  $title;
		}
		return $out;
	} 
	
	function toggle($article_id, $enabled) {
		$data['enabled'] = $enabled==1?0:1; 
		$this->ArticlesModel->update_article($article_id, $data);
		redirect($this->last_url);
	}
	
	function delete($article_id) {
		try {
			$this->ArticlesModel->delete_article($article_id);
		} catch (Exception $e) {
			echo $e->getMessage();
		}
		redirect($this->last_url);
	}
	
	function add($title, $category_id) {
		$data['title'] = $data['title_page'] = $data['title_menu'] = $title;
		$data['category_id'] = $category_id;
		$data['text'] = '';
		$id = $this->ArticlesModel->add_article($data);
		$this->index($id);
	}
	
	function reorder($article_id, $category_id, $old_ord) {
		$data = $this->input->post();
		$new_ord = $data['ord'];
		$this->ArticlesModel->set_order($article_id, $category_id, $old_ord, $new_ord);
		redirect($this->last_url);
	}
	
}
