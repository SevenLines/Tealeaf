<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include 'application/controllers/page_base.php'; // include_once '../page_base.php';

class Csharp extends Page_base {
	
	function __construct()
    {
        parent::__construct();
    }
	
	public function index($page=null)
	{
		$category_id = 2;			
		$this->__show_article($page, $category_id);
	}
}