<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include_once 'application/controllers/base_page.php';

class error404 extends Base_page {
    function __construct() {
        parent::__construct();
    }
    
    public function index() {
       $this->__show("404", "404", "", "error404", array());
    }
}
