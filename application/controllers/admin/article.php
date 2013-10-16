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
		$data['breadcrumbs'] = '<a href='.site_url().'/admin/category/'.$data['article2']->category_id.'><< к категории</a>';
		$this->__show("Статья", "Статья #".$article_id, "manager/article", $data);
	}	
	
	function update($article_id=null) {
		$data = $this->input->post();
		unset($data['submit']);
		$data['enabled'] = isset($data['enabled'])?1:0;
		$this->ArticlesModel->update_article($article_id, $data);
		redirect($this->last_url);
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
	
}
