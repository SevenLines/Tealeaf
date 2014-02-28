<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include_once 'admin_base.php';

class Article extends Admin_base {
	

	function __construct()
    {
        parent::__construct();
		$this->load->helper('form');
    }

	function index($article_id=null) {
		$this->article_id = $article_id;

		
		$data['textarea_pos'] = $this->session->userdata('textarea_pos');
		$data['status'] = $this->session->flashdata('status');
		
		if (!isset($article_id)) {
                    redirect('admin/categories');
		}
                
                
		$data['articleInfo'] = $this->ArticlesModel->get_article($article_id);
		$data['categories_list'] = $this->__get_categories_list($article_id);
                
		if ( isset($data['articleInfo']->category_id) ) {
                    $category_name = $data['categories_list'][$data['articleInfo']->category_id];
		} else {
                    $category_name = 'без категории';
                    $data['articleInfo']->category_id = 0;
		}
               
                // generate specific info for article
                $a = (array) $data['articleInfo'];
                $a['href']['update'] = site_url()."admin/article/update/{$a["id_"]}";
                $a['href']['toggle'] = site_url()."admin/article/toggle/{$a['id_']}/{$a['enabled']}";
                $a['href']['set_as_off_page'] = site_url()."admin/article/set_as_off_page/{$a["id_"]}";
                $a["is_off"] = $this->OptionsModel->off_article_id() == $a["id_"];
                $data['articleInfo'] = (object) $a;
		
		$data['breadcrumbs'] = '<a href='.site_url().'admin/category/'.$data['articleInfo']->category_id.'>&lt;&lt; '.$category_name.'</a>';
		$title = "«{$data['articleInfo']->title}» id: $article_id";	
		$this->__show( $title, "Статья", '', "manager/article", $data, $data['articleInfo']->category_id);
	}	
	
	function update($article_id=null) {
		$data = $this->input->post();
                // полжение курсора в textarea
		$this->session->set_userdata('textarea_pos', $data['pos']);
		
		unset($data['pos']);
		
		if ($data) {
			$this->ArticlesModel->update_article($article_id, $data);
		}
		$article_info = $this->ArticlesModel->get_article_info($article_id);
		$this->session->set_flashdata('status', "<b>$article_info->title</b><br> успешно обновлена");
		
		redirect("admin/article/$article_id");
	}
	
	function __get_categories_list($article_id) {
		$categories = $this->ArticlesModel->get_categories();
		
		$out = array();
		$out[0] = 'без категории';
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
		$article_info = $this->ArticlesModel->get_article_info($article_id);
		$this->session->set_flashdata('status', "<b>$article_info->title</b><br> теперь ".(!$enabled?'доступна':'недоступна'));
		redirect($this->last_url);
	}
	
	function delete($article_id) {
		$article_info = $this->ArticlesModel->get_article_info($article_id);
		if ($article_id!=7) {
			try {
				$this->ArticlesModel->delete_article($article_id);
			} catch (Exception $e) {
				echo $e->getMessage();
			}
		}
		$this->session->set_flashdata('status', "<b>$article_info->title</b><br> успешно удалена");
		redirect($this->last_url);
	}
	
	function add($category_id, $title) {
		$data['title'] = $data['title_page'] = $data['title_menu'] = $title;
		$data['category_id'] = $category_id;
		$data['text'] = '';
		$id = $this->ArticlesModel->add_article($data);
		$this->session->set_flashdata('status', "статья успешно добавлена");
		$this->index($id);
	}
	
	function reorder($article_id, $category_id, $old_ord) {
		$new_ord = $this->input->post('ord');

		$this->ArticlesModel->set_article_order($article_id, $category_id, $old_ord, $new_ord);
		$article_info = $this->ArticlesModel->get_article_info($article_id);
		$this->session->set_flashdata('status', "<b>$article_info->title</b><br> теперь имеет номер $new_ord");
		redirect($this->last_url);
	}
	
	function top($article_id) {
            $this->ArticlesModel->set_top_article($article_id);
            $article_info = $this->ArticlesModel->get_article_info($article_id);
            $this->session->set_flashdata('status', "<b>$article_info->title</b><br> теперь используется в качестве главной странице");
            redirect($this->last_url);
	}
        
        // установить в качестве страницы технического перерыва
        function set_as_off_page($article_id) {
            $this->OptionsModel->set_off_article_id($article_id);
            redirect($this->last_url);
        }
	
}
