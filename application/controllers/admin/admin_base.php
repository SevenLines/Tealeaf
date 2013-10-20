<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include_once 'application/controllers/auth_base.php';

class Admin_base extends Auth_base
{
	var $flag = "manager";	
	var $password = "L7o4c3k2ed";	
	
	function __construct()
    {
        parent::__construct();
    }
}
