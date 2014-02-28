<?php

include_once 'admin_base.php';

class Tests extends Auth_base {
    function __construct()
    {
        parent::__construct();
        $this->load->library('unit_test');
    }
    
    function index() {
        $this->testPageContoller();
    }
    
    function testPageContoller() {
        $p = new Page();
        $p->index();
        $p->index(1);
        $p->index(1, 2);
        echo 1;
    }
    
    function testArticlesModel() {
        try {
            $this->unit->run($this->ArticlesModel->get_articles_info_list(0), "is_array", "get_articles_info_list(0)");
            $this->unit->run($this->ArticlesModel->get_articles_info_list(0, -1), "is_array", "get_articles_info_list(0, -1)");
            $this->unit->run($this->ArticlesModel->get_articles_info_list(2), "is_array", "get_articles_info_list(2)");
            $this->unit->run($this->ArticlesModel->get_articles_info_list(2, -1), "is_array", "get_articles_info_list(2, -1)");
            $this->unit->run($this->ArticlesModel->get_articles_info_list(2, 0), "is_array", "get_articles_info_list(2, 0)");
            
            
            $this->unit->run(count($this->ArticlesModel->get_all_articles_info(0)), TRUE);
            $this->unit->run(count($this->ArticlesModel->get_all_articles_info(0)), TRUE);
            $this->unit->run(count($this->ArticlesModel->get_all_articles_info(1)), TRUE);
            $this->unit->run(count($this->ArticlesModel->get_all_articles_info(2)), TRUE);

            $this->unit->run($this->ArticlesModel->get_child_categories(), "is_array", "get_child_categories()");
            $this->unit->run($this->ArticlesModel->get_child_categories(NULL), "is_array", "get_child_categories(NULL)");
            $this->unit->run($this->ArticlesModel->get_child_categories(-1), "is_array", "get_child_categories(-1)");
        } catch(Exception $e) {
            echo $e->getMessage();
        }
        echo $this->unit->report();
        echo "done";  
    }
}