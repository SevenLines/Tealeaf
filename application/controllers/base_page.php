<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Base_page extends CI_Controller {
	var $email = ""; // почта админа
	var $base_view = 'base_page'; // вид для отображения контента
        var $turnedoff_view = 'turnedoff'; // вид используемый для отображения статьи тех. перерыва
	var $last_url = ''; // последняя ссылка
	var $current_controller = ''; // текущей контроллер
	var $rewrite_refer_url = TRUE; // TRUE means that every time u enter,  $this->session->set_userdata('refer', current_url()); called
	var $flag = '';// some special flag
	var $article_id = null; // id текущей статьи
	var $status = ''; 
	var $logged = ''; // залоген ли пользователь
        var $state = true; // активен ли сайт сейчас
	
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
        $this->load->model('OptionsModel'); // for access to options
        $this->load->model('StatsModel'); // for track user
        $this->load->library('session'); // fore using CI session
        $this->load->helper('form');

        // считываем настройки
        $this->last_url = $this->session->userdata('refer');
        $this->email = $this->OptionsModel->email();
        $this->logged = $this->session->userdata('logged');
        $this->state = $this->OptionsModel->state();
        

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
        
        // add specific info for categories in menu array
        foreach($data['menu'] as &$c) {
            $c['active'] = $c['id_'] == $category_id;
            
            $c['class'] = "";
            if ($c['active']) { $c['class'] .= " active"; }
            $c['class'] = trim($c['class']);
            $c['href'] = site_url()."/page/{$c['id_']}";
        }
    } 

    /*used to show default article with title and text*/
    public function __show( $title,
                            $title_page,
                            $description,
                            $viewName, 
                            &$data, 
                            $category_id=0,
                            $show_breadcrumbs=false,
                            $main_view = null) 
    {
        if ( !isset($main_view) ) {
            $main_view = $this->base_view;
        }

        
        $data['title'] = $title;
        $data['description'] = $description;
        $data['title_page'] = $title_page;
        $data['mail'] = $this->email;
        $data['logged'] = $this->session->userdata('logged');
        $data['category_id'] = $category_id;
        $data['article_id'] = $this->article_id;
        $data['flag'] = $this->flag;
        $data['state'] = $this->state;

        
        $this->__fillMenuData($data, $category_id, $show_breadcrumbs);

        if (isset ($viewName)) {
            // чтобы избежать рекурсии
            if ($viewName != $main_view) {
                $data['subview'] = $viewName;
            } 	
        }

        $this->load->view($main_view, $data);
    }

    /* used to show articles list of the selected category */
    public function __show_articles_list($category_id)
    {
        $category = $this->ArticlesModel->get_category($category_id);

        if(!is_object($category)) {
            show_404();
        }

        if ( !$this->logged && !$category->enabled ) {
                redirect("admin/preview/$category_id");
        }

        $data['articles'] = $this->ArticlesModel->get_articles_info_list($category_id);	
//            $data['controller_path'] = $category->controller;
            $this->__show($category->title,
                          $category->title_page,
                          $category->description,
                          'lessons/articles_list',
                          $data, 
                          $category_id);			
    }

    /**
     * показать страницу с отключенной информацией
     */
    public function __show_turned_off() {
        $this->article_id = $this->OptionsModel->off_article_id();
        $article_id = $this->article_id;
        if ( isset($article_id) && $article_id != 0 ) {  		

            // считываем информацию о статье, включая сам текст
            $data['articles_info'] = $this->ArticlesModel->get_article($article_id);
            # track visits only if user is not admin
            if(!$this->logged)
                $this->ArticlesModel->inc_article_visit($article_id);

            # show article
            $this->__show(  $data['articles_info']->title,
                            $data['articles_info']->title_page,
                            '',
                            'lessons/article', 
                            $data, 
                            null,
                            false,
                            "turned_off");
        }
    }
    
    /* show article for current category*/
    public function __show_article($article_id = 0, $category_id = null) 
    {
        $this->article_id = $article_id;

        if ( isset($article_id) && $article_id != 0 ) {  		

            // считываем информацию о статье, включая сам текст
            $data['articles_info'] = $this->ArticlesModel->get_article($article_id);
            
            // проверяем что категория статьи соответствует категории указанной 
            // в $category_id
            if(!is_object($data['articles_info']) 
                    || $data['articles_info']->category_id != $category_id ) {
                show_404();
            }
            
            // отключенные статьи можно просмотреть только администратору
            $c = $this->ArticlesModel->get_category($data['articles_info']->category_id);
            if ( !$this->logged ) { 
                 if (!$data['articles_info']->enabled || !$c->enabled ) {
                    redirect("admin/preview/{$data['articles_info']->category_id}/$article_id");
                 }
            }

            # track visits only if user is not admin
            if (!$this->logged) {
                $this->ArticlesModel->inc_article_visit($article_id);
            }

            # show article
            $this->__show(  $data['articles_info']->title,
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
