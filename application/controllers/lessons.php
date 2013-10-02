<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lessons extends CI_Controller {
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
    
	/*Called when no paramters set for constructor*/
	public function index($page=null)
	{
		$this->__showMainPage();
	}
	
	public function inside()
	{
		$this->load->view('static/inside');
	}
	

	public function __showMenu($data=array(), $category_id)
	{
		//$data['menu'] = $this->LessonsModel->get_categories_tree();
		$data['menu'] = $this->LessonsModel->get_menu_array($category_id);
		$this->load->view('templates/menu', $data);
	} 

	private function __show($title_page, $title, $viewName, $data=array(), $category_id=0) 
	{
        $data['title_page'] = $title_page;
		$data['title'] = $title;
		$data['mail'] = $this->mymail;
        
		$this->load->view('templates/header', $data);
		$this->__showMenu($data, $category_id);
		if (isset ($viewName)) {
        	$this->load->view($viewName, $data);
        }
		$this->load->view('templates/footer', $data);
	}
	
	private function __show_articles_list($category_id)
	{
	    $category = $this->LessonsModel->get_category($category_id);
	    $data['articles'] = $this->LessonsModel->get_articles_list($category_id);	
		$data['controller_path'] = $category->controller;
		$this->__show($category->title,
					  $category->title,
					  'lessons/articles_list', $data, $category_id);			
	}

	public function csharp($page = 0) 
	{
		$category_id = 2;			
		if ( isset($page) && $page != 0 ) {		
            $data['articles_info'] = $this->LessonsModel->get_article($page);
            $this->__show($data['articles_info']->title_page,
            			  $data['articles_info']->title,
            			 'lessons/article_syntax', $data, $category_id);	
		} else {
            $this->__show_articles_list($category_id);     
		}		
	} 
	
	public function mlogic($page=0)
	{
		$category_id = 4;	
		if ( isset($page) && $page != 0 ) {		
            $data['articles_info'] = $this->LessonsModel->get_article($page);
            $this->__show($data['articles_info']->title_page,
            			  $data['articles_info']->title,
            			  'lessons/article_syntax', $data,$category_id);	
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
