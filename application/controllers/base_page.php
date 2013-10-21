<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Base_page extends CI_Controller {
	var $mymail = "mmailm.math@mail.ru";
	var $base_view = 'base_page';
	var $last_url = '';
	var $current_controller = '';
	var $rewrite_refer_url = TRUE; // TRUE means that every time u enter,  $this->session->set_userdata('refer', current_url()); called
	var $flag = '';// some special flag
	var $article_id = null;
	var $status = '';
	var $logged = '';
	
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
     function __construct()
    {
        parent::__construct();
        $this->load->model('ArticlesModel'); // for using database model
		$this->load->model('StatsModel'); // for track user
		$this->load->library('session'); // fore using CI session
		
		$this->last_url = $this->session->userdata('refer');
		$this->logged = $this->session->userdata('logged');
		if ($this->rewrite_refer_url) {
			$this->session->set_userdata('refer', current_url());
		} 
		$this->__checkUserSession();
    }

	public function __checkUserSession()
	{
		// if user first time entered, and save this visit to the db
		if (!$this->session->userdata('entered')) {
			$this->session->set_userdata('entered', 1);
			$this->StatsModel->save_current_visit();
		}
	}
	

	// fill data array with menu items
	public function __fillMenuData(&$data, $category_id, $show_breadcrumbs=false)
	{
		
		$menu = array();
	
		$data['top_article_info'] = $this->ArticlesModel->get_top_article_info();
		list($data['menu'], $active_index) = $this->ArticlesModel->get_menu_array($category_id);
		if ( $show_breadcrumbs && $active_index != -1) {
			$data['breadcrumbs'] = $data['menu'][$active_index]['title'];
		}
	} 

	/*used to show default article with title and text*/
	public function __show( $title,
							$title_page,
							$description,
							$viewName, 
							&$data, 
							$category_id=0,
							$show_breadcrumbs=false) 
	{
		$data['title'] = $title;
		$data['description'] = $description;
		$data['title_page'] = $title_page;
		$data['mail'] = $this->mymail;
		$data['logged'] = $this->session->userdata('logged');
		$data['category_id'] = $category_id;
		$data['article_id'] = $this->article_id;
		$data['flag'] = $this->flag;
		
		$this->__fillMenuData($data, $category_id, $show_breadcrumbs);
		
		if (isset ($viewName)) {
        	if ($viewName != $this->base_view) {
        		$data['subview'] = $viewName;
			} 	
        }
		
		$this->load->view($this->base_view, $data);
	}
	
	/* used to show articles list of the selected category */
	public function __show_articles_list($category_id)
	{
	    $category = $this->ArticlesModel->get_category($category_id);
		
		if ( !$this->logged && !$category->enabled ) {
			redirect("admin/preview/$category_id");
		}
		
	    $data['articles'] = $this->ArticlesModel->get_articles_info_list($category_id);	
		$data['controller_path'] = $category->controller;
		$this->__show($category->title,
				      $category->title_page,
					  $category->description,
					  'lessons/articles_list',
					  $data, 
					  $category_id);			
	}
	
	/* show article for current category*/
	public function __show_article($article_id = 0, $category_id = null) 
	{
		$this->article_id = $article_id;
			
		if ( isset($article_id) && $article_id != 0 ) {  		
            $data['articles_info'] = $this->ArticlesModel->get_article($article_id);

			if ( !$this->logged && ($data['articles_info']->category_id != $category_id || !$data['articles_info']->enabled)) {
				redirect("admin/preview/{$data['articles_info']->category_id}/$article_id");
			}
			
			# track visits only if user is not admin
			if(!$this->logged)
				$this->ArticlesModel->inc_article_visit($article_id);
			
            $this->__show($data['articles_info']->title,
            			  $data['articles_info']->title_page,
            			  '',
            			 'lessons/article_syntax', 
            			 $data, 
            			 $category_id,
						 true);	
		} else {		
            $this->__show_articles_list($category_id);     
		}			
	}


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */ 
