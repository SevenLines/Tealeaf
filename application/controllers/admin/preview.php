<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include_once 'application/controllers/auth_base.php';

class Preview extends Auth_base {
	
	function __construct()
    {
        parent::__construct();
    }

	function index($article_id) {
		
		$this->__show_article($article_id, null);
	}	
}

