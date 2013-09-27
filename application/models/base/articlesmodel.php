<?php

class ArticlesModel extends CI_Model {
    
    function __construct()
    {
        parent::__construct();
    }

    // возвращает список статей для категории
    function get_articles_info_for_category($category_id)
    {
        $sql = 'SELECT id_, name, description, category_id, enabled FROM articles WHERE category_id = ?';
        $query = $this->db->query($sql, array($category_id));
        return $query->result();
    }
    
    // возвращает всю информацию, включая текст, статьи по ее идентификатору
    function get_article($article_id)
    {
        $sql = 'SELECT * FROM articles WHERE id_ = ?';
        $query = $this->db->query($sql, array($article_id));
        return $query->row();
    }

}