<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lessons extends CI_Controller {

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
	public function index()
	{
		$this->showMainPage();
	}
	
	public function showMainPage()
	{
		$category_id = 9;
		$articles_info = $this->LessonsModel->get_article(7);
		$data['title'] = $articles_info->name;
		$data['text'] = $articles_info->text;
		
		$this->__show($articles_info->name, "article", $data, $category_id);		
	}
	

	public function showMenu($data=array(), $category_id)
	{
		//$data['menu'] = $this->LessonsModel->get_categories_tree();
		$data['menu'] = $this->LessonsModel->get_menu_array($category_id);
		$this->load->view('templates/menu', $data);
	} 

	private function __show($title, $viewName, $data=array(), $category_id=0) 
	{
        $data['title'] = $title;
        
		$this->load->view('templates/header', $data);
		$this->showMenu($data, $category_id);
		if (isset ($viewName)) {
        	$this->load->view($viewName, $data);
        }
		$this->load->view('templates/footer', $data);
	}

	public function csharp($page = 0) 
	{
		$category_id = 2;			
		if ( isset($page) && $page != 0 ) {		
            $data['articles_info'] = $this->LessonsModel->get_article($page);
            $this->__show($data['articles_info']->name, 'lessons/csharp', $data, $category_id);	
		} else {
            $data['articles'] = $this->LessonsModel->get_articles_list($category_id);	
			$data['controller_path'] = $this->LessonsModel->get_category($category_id)->controller;
			$this->__show('Вот список занятий', 'lessons/articles_list', $data, $category_id);	     
		}		
	} 
	
	public function mlogic($page=0)
	{
		$category_id = 4;	
		if ( isset($page) && $page != 0 ) {		
            $data['articles_info'] = $this->LessonsModel->get_article($page);
            $this->__show($data['articles_info']->name, 'lessons/csharp', $data,$category_id);	
		} else {
            $data['articles'] = $this->LessonsModel->get_articles_list($category_id);	
			$data['controller_path'] = $this->LessonsModel->get_category($category_id)->controller;
			$this->__show('Математическая логика', 'lessons/articles_list', $data, $category_id);	     
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */ 
