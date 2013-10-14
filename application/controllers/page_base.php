<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page_base extends CI_Controller {
	var $mymail = "mmailm.math@mail.ru";
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
        $this->load->model('LessonsModel');
    }

	public function __showMenu($data=array(), $category_id, $show_breadcrumbs=false)
	{
		list($data['menu'], $active_index) = $this->LessonsModel->get_menu_array($category_id);
		
		if ( $show_breadcrumbs ) {
			$data['breadcrumbs'] = $data['menu'][$active_index]['title'];
		}
		
		$this->load->view('templates/menu', $data);
	} 

	/*used to show default article with title and text*/
	public function __show($title_page,
							$title,
							$viewName, 
							$data=array(), 
							$category_id=0,
							$show_breadcrumbs=false) 
	{
		$data['title'] = $title;
		$data['title_page'] = $title_page;
		$data['mail'] = $this->mymail;
        
		$this->load->view('templates/header', $data);
		$this->__showMenu($data, $category_id, $show_breadcrumbs);
		if (isset ($viewName)) {
        	$this->load->view($viewName, $data);
        }
		$this->load->view('templates/footer', $data);
	}
	
	/* used to show articles list of the selected category */
	public function __show_articles_list($category_id)
	{
	    $category = $this->LessonsModel->get_category($category_id);
	    $data['articles'] = $this->LessonsModel->get_articles_list($category_id);	
		$data['controller_path'] = $category->controller;
		$this->__show($category->title,
					  $category->title,
					  'lessons/articles_list',
					  $data, 
					  $category_id);			
	}
	
	/* show article for current category*/
	public function __show_article($page = 0, $category_id = 2) 
	{
		if ( isset($page) && $page != 0 ) {		
            $data['articles_info'] = $this->LessonsModel->get_article($page);
            $this->__show($data['articles_info']->title_page,
            			  $data['articles_info']->title,
            			 'lessons/article_syntax', 
            			 $data, 
            			 $category_id,
						 true);	
		} else {			
            $this->__show_articles_list($category_id);     
		}			
	}

	public function __showMainPage()
	{
		$category_id = 9;
		$articles_info = $this->LessonsModel->get_article(7);
		$data['text'] = $articles_info->text;
		
		$this->__show($articles_info->title_page,
					  $articles_info->title,
					  "article", $data, $category_id);		
	}

	

	

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */ 
