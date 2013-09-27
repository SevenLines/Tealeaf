<?php

class ArticlesModel extends CI_Model {
    
    function __construct()
    {
        parent::__construct();
    }

    // ���������� ������ ������ ��� ���������
    function get_articles_info_for_category($category_id)
    {
        $sql = 'SELECT id_, name, description, category_id, enabled FROM articles WHERE category_id = ?';
        $query = $this->db->query($sql, array($category_id));
        return $query->result();
    }
    
    // ���������� ��� ����������, ������� �����, ������ �� �� ��������������
    function get_article($article_id)
    {
        $sql = 'SELECT * FROM articles WHERE id_ = ?';
        $query = $this->db->query($sql, array($article_id));
        return $query->row();
    }

}