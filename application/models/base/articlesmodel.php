<?php

class ArticlesModel extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	// function to log variable
	static function log_var($variable, $comment="")
	{
		echo '<pre class="trace">';	
		var_dump($variable);
		echo '</pre>';		
	}

	/*
	 * Returns info for articles of selected category
	 *
	 * @param	int	$category_id Category identificator, set to 0 to get all categories
	 * @param	int $enabled_only Set it 0 if u want to see disabled category info
	 * @return	Result as array
	 */
	function get_articles_info_for_category($category_id, $enabled_only = 1) {
		$sql = 'SELECT id_, name, description, category_id, enabled 
        	    FROM articles 
        	    WHERE (0 = category_id or category_id = ?) and (0 = ? or enabled = ?)
        	    ORDER BY ord, id_';
		$query = $this -> db -> query($sql, array($category_id, $enabled_only, $enabled_only));
		return $query -> result();
	}


	function get_all_articles_info($enabled_only = 1) {
		return get_articles_info_for_category(0, $enabled_only);
	}
	
	/*
	 * return tree in which for each item:
	 * item[0] -- info array, contains of the object with name, 
	 * description parent_id and id_ params
	 * 
	 * item[1] -- array of child nodes
	 */
	function get_categories_tree() {
		$sql_get_catg = 'SELECT id_, name, controller, parent_id FROM categories ORDER BY ord, id_';
		$query = $this->db->query($sql_get_catg); 
		
		// list for database rows, with id_ as key
		$out = array();
		
		// itterate over items
		if($query->num_rows()>0) {
			foreach($query->result() as $value) {
				$out[$value->id_] = $value;
			}
		} 
		// generate and return tree of objects
		return $this->genTree($out, NULL);
	}
	
	/*
	 * create tree from categories array of objects,
	 * where each item has id_ and parent_id property
	 * 
	 */ 
	function genTree($array, $parent_value, $path="")
	{
		$output = array();
		foreach ($array as $key => $value) {
			if ($value->parent_id === $parent_value ) {
				$output[$value->id_][0] = $value;
				$newPath = $path."/".$value->controller;
				$output[$value->id_]['path'] = $newPath;
				$output[$value->id_][1] = $this->genTree($array, $value->id_, $newPath);
				
			}
		}
		return $output;
	}	
	
	function get_child_categories($category_id = NULL)
	{
		$sql = "SELECT * FROM categories WHERE parent_id is ? ORDER BY ord, id_";
		$query = $this->db->query($sql, $category_id);
		return $query->result(); 
	}
	
	function get_category($category_id)
	{
		$sql = 'SELECT * FROM categories WHERE id_ = ?';
		$query = $this -> db -> query($sql, array($category_id));
		return $query -> row();
	}
	
	function get_articles_list($category_id)
	{
		$sql = "SELECT * FROM articles WHERE category_id = $category_id ORDER BY ord, id_";
		$query = $this->db->query($sql, $category_id);
		return $query->result();
	}
	
	
	/* TO get article text for selected id*/
	function get_article($article_id) {
		$sql = 'SELECT * FROM articles WHERE id_ = ? ORDER BY  ord, id_';
		$query = $this -> db -> query($sql, array($article_id));
		return $query -> row();
	}
	
	/* return menu as array
	 * 
	 * [i][0] - name  
	 * [i][1] - path
	 * [i][2] - childs_articles
	 * [i][2][0] - article_name
	 * [i][2][1] - article_id
	 * */
	function get_menu_array()
	{
		$out = array();
		$categories = $this->get_child_categories();
		foreach ($categories as $ctg) {
			$item = array();
			$item[0] = $ctg->name;
			$item[1] = $ctg->controller;
			foreach($this->get_articles_list($ctg->id_) as $article) {
				$art[0] = $article->name;
				$art[1] = $article->id_;
				$item[2][] = $art;	
			}
			$out[] = $item;	
		}
		//ArticlesModel::log_var($out);
		return $out;
	} 
	 
	
}
