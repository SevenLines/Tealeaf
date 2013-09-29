<?php

class ArticlesModel extends CI_Model {

	function __construct() {
		parent::__construct();

	}

	/*
	 * Returns info for articles of selected category
	 *
	 * @param	int	$category_id Category identificator
	 * @param	int $enabled_only Set it 0 if u want to see disabled category info
	 * @return	Result as array
	 */
	function get_articles_info_for_category($category_id, $enabled_only = 1) {
		$sql = 'SELECT id_, name, description, category_id, enabled 
        	    FROM articles 
        	    WHERE category_id = ? and (0 = ? or enabled = ?)';
		$query = $this -> db -> query($sql, array($category_id, $enabled_only, $enabled_only));
		return $query -> result();
	}

	function get_article($article_id) {
		$sql = 'SELECT * FROM articles WHERE id_ = ?';
		$query = $this -> db -> query($sql, array($article_id));
		return $query -> row();
	}

}
