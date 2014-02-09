<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include_once 'application/controllers/base_page.php';// include_once '../page_base.php';

class Page extends Base_page {

    function __construct()
    {
        parent::__construct();
    }
    
	//Called when no paramters set for constructor
	public function index($category_id=null, $article_id=null)
	{
            // проверка отключен ли сайт             
            if (!$this->state && !$this->logged) { 
                $this->__show_turned_off();
                return;
            }
            
            if ( !isset($category_id) && !isset($article_id) ) {
                    $this->__showMainPage();
                    return;	
            }

            if ( !isset($article_id) ) {
                    $this->__show_articles_list($category_id);
                    return;
            }

            $this->__show_article($article_id, $category_id);
	}
	
	public function inside()
	{
		$this->load->view('static/inside');
	}
	
	
	public function __showMainPage()
	{
		$category_id = 9;
		$article = $this->ArticlesModel->get_top_article();
		if ($article) {
			$this->article_id = $article->id_;
			$data['text'] = $article->text;
			$this->__show($article->title,
						  $article->title_page,
						  '',
						  "templates/plain_text", $data, 0);		
		} else {
			$data['text'] = '^_^';

			$this->__show("пустота",
						  "пока ничего нету",
						  '',
						  "templates/plain_text", $data, 0);	
		}

	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */ 
