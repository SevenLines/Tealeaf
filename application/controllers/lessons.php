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
     
	public function index()
	{
		$data['title'] = "Tealeaf";
		$this->csharp();
	}

	private function __show($title, $viewName, $data=array(), $selected=false) 
	{
        $data['title'] = $title;
		$data['selected'] = $selected;
        
		$this->load->view('templates/header', $data);
		$this->load->view('templates/menu', $data);
		
        $this->load->view($viewName, $data);
		$this->load->view('templates/footer', $data);
	}

	public function csharp($page = 0) 
	{	
		if ( isset($page) && $page != 0 ) {		
            $data['articles_info'] = $this->LessonsModel->get_article($page);
            $this->__show($data['articles_info']->name, 'lessons/csharp', $data);	
		} else {
            $data['articles_info'] = $this->LessonsModel->get_csharp_articles();
            $this->__show('Вот список занятий', 'lessons/csharp_main', $data, true);		     
		}	
	} 
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */ 