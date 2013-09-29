<?php

include_once( 'base/articlesmodel.php' );

class LessonsModel extends ArticlesModel {

    function __construct()
    {
        parent::__construct();
    }
    
    // возвращает список статей C#
    function get_csharp_articles()
    {
        $csharp_article = 2;
        return $this->get_articles_info_for_category($csharp_article, 0);
    }
    
}