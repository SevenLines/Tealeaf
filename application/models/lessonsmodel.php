<?php

include_once( 'base/articlesmodel.php' );

class LessonsModel extends ArticlesModel {

    function __construct()
    {
        parent::__construct();
    }
    
    // возвращает список уроков по C#
    function get_csharp_articles()
    {
        return $this->get_articles_info_for_category(2);
    }
    
}