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
	public function index()
	{
		$data['title'] = "Tealeaf";
		$this->csharp();
	}

	private function __show($title, $viewName, $selected=false) 
	{
		$data['title'] = $title;
		$data['selected'] = $selected;
		$this->load->view('templates/header', $data);
		$this->load->view('templates/menu', $data);
		$data['content'] = $this->load->view($viewName,'', true);
		$this->load->view('language_lessons', $data);
		$this->load->view('templates/footer', $data);
	}

	public function csharp($page = 0) 
	{
		
		if (isset($page) && $page != 0 ) {
			switch($page) {
			case 1:
				$this->__show('Занятие первое. Работа с консолью', 'static/01-Console');	
				break;
			case 2:			
				$this->__show('Занятие второе. Коллекции', 'static/02-Collections');	
				break;		
			}		
		}	else {
				
				$this->__show('Вот список занятий', 'static/Lessons', true);		
		}	
	} 
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */ 
