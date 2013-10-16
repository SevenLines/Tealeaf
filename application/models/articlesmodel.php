<?php

class ArticlesModel extends CI_Model {

	var $categories_table = 'categories';
	var $articles_table = 'articles';

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



	function get_all_articles_info($enabled_only = 1) {
		return get_articles_info_for_category(0, $enabled_only);
	}
	
	
	function get_child_categories($category_id = NULL)
	{
		$sql = "SELECT * FROM categories WHERE parent_id is ? ORDER BY ord, id_";
		$query = $this->db->query($sql, $category_id);
		return $query->result(); 
	}
	
	function get_categories() {
		$query = $this->db->get('categories');
		return $query->result(); 
	}
	
	function get_category($category_id)
	{
		$this->db->where('id_', $category_id);
		$query = $this -> db -> get($this->categories_table);
		return $query -> row();
	}
	
	function delete_category($category_id) 
	{
		$this->db->where('id_', $category_id);
		$this->db->delete($this->categories_table);
	}
	
	function update_category($category_id, $data) 
	{
		$this->db->where('id_', $category_id);
		$this->db->update($this->categories_table, $data);
	}
	
	function insert_category($data)
	{
		$this->db->insert($this->categories_table, $data);
	}
	
	// set $enabled to -1 to show all articles
	function get_articles_list($category_id, $enabled = 1)
	{
		$sql = "SELECT * 
				FROM articles 	
				WHERE ($category_id is NULL or category_id = $category_id) and ($enabled=-1 or enabled = $enabled) 
				ORDER BY ord, id_";
		$query = $this->db->query($sql);
		return $query->result();
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
	
	/* TO get article text for selected id*/
	function get_article($article_id) {
		$sql = "SELECT * FROM articles WHERE id_ = $article_id ORDER BY  ord, id_";
		$query = $this -> db -> query($sql);
		return $query -> row();
	}
	
	function delete_article($article_id) {
		$this->db->where('id_', $article_id);
		$this->db->delete($this->articles_table	);
	}
	
	function update_article($article_id, $data) {
		$this->db->where('id_', $article_id);
		$this->db->update($this->articles_table, $data);		
	}
	
	function add_article($data) {
		$this->db->select_max('ord');
		$this->db->where('category_id', $data['category_id']);
		$query = $this->db->get($this->articles_table);
		$max_ord = $query->row()->ord;
		$data['ord'] = $max_ord + 1;
		
		$this->db->insert($this->articles_table, $data);
		return $this->db->insert_id();
	} 

	// set article's order to new order value, and shift another items if neccessary
	function set_order($article_id, $category_id,  $old_ord, $new_ord) {
		// generate script for move items
		if ($old_ord > $new_ord) {
			$sql = <<<SQL
			UPDATE {$this->articles_table}
			SET ord = ord + 1
			WHERE (ord BETWEEN $new_ord and $old_ord-1) and category_id = $category_id;
SQL;
		} else if ($old_ord < $new_ord ) {
			$sql = <<<SQL
			UPDATE {$this->articles_table}
			SET ord = ord - 1
			WHERE (ord BETWEEN $old_ord and $new_ord) and category_id = $category_id;
SQL;
		} else {
			return false;
		}
		// shift other items, if any shift required
		$this->db->query($sql);
		
		// update current article order value to $new_ord
		$this->db->where('id_', $article_id);
		$this->db->update($this->articles_table, array('ord' => $new_ord));
		return true;
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
		$index = 0;
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
			if ( isset($active_category_id) && $active_category_id == $ctg->id_ ) {
				$item['active'] = true;
				$index = $i;
			}
			
			$item['title'] = $ctg->title;
			
			$out[] = $item;	
		}
		return array($out, $index);
	} 
	 
	
}
