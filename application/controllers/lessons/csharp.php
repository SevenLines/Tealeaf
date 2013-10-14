<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include_once 'application/controllers/base_page.php'; // include_once '../page_base.php';

class Csharp extends Base_page {
	
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