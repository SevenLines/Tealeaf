<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include_once 'auth_base.php';

class Admin extends Auth_base {
		
	var $password = "L7o4c3k2ed";	
	
	function __construct()
    {
        parent::__construct();
    }

	function index() {
		parent::index();
	}
	
	
}
