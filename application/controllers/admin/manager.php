<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include_once 'application/controllers/auth_base.php';

class Manager extends Auth_base {
	
	function __construct()
    {
        parent::__construct();
    }

	function index() {
		$this->__show("manager", "", "manager/categories");
	}
	
	
}
