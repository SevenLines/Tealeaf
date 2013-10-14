<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include_once 'application/controllers/page_base.php'; // include_once '../page_base.php';

class Mlogic extends Page_base {
	
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