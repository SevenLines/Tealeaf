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
		$sql = "SELECT * 
				FROM articles 
				WHERE category_id = $category_id and enabled = 1 
				ORDER BY ord, id_";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	
	/* TO get article text for selected id*/
	function get_article($article_id) {
		$sql = 'SELECT * FROM articles WHERE id_ = ? ORDER BY  ord, id_';
		$query = $this -> db -> query($sql, array($article_id));
		return $query -> row();
	}
	
	/* return active category info and menu as array
	 * 
	 * use like (menu_array, index_of_active_category_in_current_array) = get_menu_array(100500);
	 * 
	 * [i][0] - name  
	 * [i][1] - path
	 * [i][2] - childs_articles
	 * [i][3] - actve, True if active
	 * [i][2][0] - article_name
	 * [i][2][1] - article_id
	 * */
	function get_menu_array($active_category_id=0)
	{
		$out = array();
		$index = -1;
		$categories = $this->get_child_categories();
		$count = count($categories);
		for( $i=0;$i<$count; ++$i ) {
			$ctg = $categories[$i];
			$item = array();
			$item['title_menu'] = $ctg->title_menu;
			$item['controller'] = $ctg->controller;
			foreach($this->get_articles_list($ctg->id_) as $article) {
				$art['title_menu'] = $article->title_menu;
				$art['id'] = $article->id_;
				$item['articles'][] = $art;	
			}
			
			// third index used to define is item active
			$item['active'] = false;
			if ( $active_category_id == $ctg->id_ ) {
				$item['active'] = true;
				$index = $i;
			}
			
			$item['title'] = $ctg->title;
			
			$out[] = $item;	
		}
		return array($out, $index);
	} 
	 
	
}
