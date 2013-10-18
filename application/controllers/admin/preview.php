<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include_once 'application/controllers/auth_base.php';

class Preview extends Auth_base {
	
	function __construct()
    {
        parent::__construct();
    }

	function index($category_id, $article_id=null ) {
		if ( !isset($article_id) ) {
			$this->__show_articles_list($category_id);
			return;
		}
		
		$this->__show_article($article_id, $category_id);
	}	
}

