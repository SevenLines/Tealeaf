<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include_once 'application/controllers/base_page.php'; // include_once '../page_base.php';

class Mlogic extends Base_page {
	
	function __construct()
    {
        parent::__construct();
    }
	
	public function index($page=null)
	{
		$category_id = 4;	
		$this->__show_article($page, $category_id);
	}
	
}