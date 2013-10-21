<?php

class ArticlesModel extends CI_Model {

	var $categories_table = 'categories';
	var $articles_table = 'articles';
	var $article_info_fields = 'id_, title, title_menu, title_page, description, category_id, enabled, ord, top, date_create, date_update, visits';

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
		$this->db->order_by('ord');
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
	
	function add_category($data)
	{
		$this->db->select_max('ord');
		$query = $this->db->get($this->categories_table);
		$max_ord = $query->row()->ord;
		$data['ord'] = $max_ord + 1;
		
		$this->db->insert($this->categories_table, $data);
	}
	
	// set $enabled to -1 to show disabled and enabled articles
	// set $category to 0 to show articles from all categories
	function get_articles_info_list($category_id, $enabled = 1)
	{
		$sql = "SELECT  {$this->article_info_fields}
				FROM articles 	
				WHERE (($category_id = 0 and category_id is NULL ) or category_id = $category_id) and ($enabled=-1 or enabled = $enabled) 
				ORDER BY ord, id_";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	// set article's order to new order value, and shift another items if neccessary
	function set_category_order($category_id,  $old_ord, $new_ord) {
		// generate script for move items
		if ($old_ord > $new_ord) {
			$sql = <<<SQL
			UPDATE {$this->categories_table}
			SET ord = ord + 1
			WHERE ord BETWEEN $new_ord and $old_ord-1 
SQL;
		} else if ($old_ord < $new_ord ) {
			$sql = <<<SQL
			UPDATE {$this->categories_table}
			SET ord = ord - 1
			WHERE ord BETWEEN $old_ord and $new_ord
SQL;
		} else {
			return false;
		}
		// shift other items
		$this->db->query($sql);
		
		// update current article order value to $new_ord
		$this->db->where('id_', $category_id);
		$this->db->update($this->categories_table, array('ord' => $new_ord));
		return true;
	}	
	
	
	// get top article, by default only one article can be top
	function get_top_article($only_info=false) {	
		$this->db->where('top', 1);
		$this->db->order_by('id_', 'desc');
		$this->db->limit(1);
		if ($only_info)
			$this->db->select($this->article_info_fields);
		
		$data = $this->db->get($this->articles_table)->result();
		
		if (!$data)
			return false;
		return $data[0];
	}
	
	// get top article, by default only one article can be top
	function get_top_article_info() {	
		return $this->get_top_article(true);
	}
	
	// set article with id as top,
	// all others articles set as no top
	function set_top_article($article_id) {
		$this->db->update($this->articles_table, array('top' => 0));
		$this->db->where('id_', $article_id);
		$this->db->update($this->articles_table, array('top'=> 1));
	}

	/* TO get article text for selected id*/
	function get_article($article_id, $info_only = false) {
		$this->db->where('id_', $article_id);
		if ($info_only) 
			$this->db->select($this->article_info_fields);
		
		return $this->db->get($this->articles_table)->row();
	}
		
	/* to get arcticle without text for id*/ 
	function get_article_info($article_id) {
		return $this->get_article($article_id, true);
	}
	
	
	function delete_article($article_id) {
		$this->db->where('id_', $article_id);
		$this->db->delete($this->articles_table	);
	}
	
	// category_id =  0 is the same as category_id = NULL 
	function update_article($article_id, $data) {
		if ( isset($data['category_id']) && $data['category_id'] == 0) {
			$data['category_id'] = NULL;
		}
		$data['date_update'] = time();
		$this->db->where('id_', $article_id);
		$this->db->update($this->articles_table, $data);		
	}
	
	function add_article($data) {
		if ($data['category_id'] == -1)
			return;	
		$this->db->select_max('ord');
		$this->db->where('category_id', $data['category_id']);
		$query = $this->db->get($this->articles_table);
		$max_ord = $query->row()->ord;
		$data['ord'] = $max_ord + 1;
		$data['date_update'] = $data['date_create'] = time();
		$this->db->insert($this->articles_table, $data);
		return $this->db->insert_id();
	} 

	function inc_article_visit($article_id) {
		$sql = "UPDATE {$this->articles_table} SET visits = visits + 1 WHERE id_ = $article_id";
		$this->db->query($sql);
	} 

	// set article's order to new order value, and shift another items if neccessary
	function set_article_order($article_id, $category_id,  $old_ord, $new_ord) {
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
		// shift other items
		$this->db->query($sql);
		
		// update current article order value to $new_ord
		$this->db->where('id_', $article_id);
		$this->db->update($this->articles_table, array('ord' => $new_ord));
		return true;
	}

	function get_most_visited_articles_info($count=5) {
		$this->db->limit($count);
		$this->db->order_by('visits', 'desc');
		$this->db->select($this->article_info_fields);
		$query = $this->db->get($this->articles_table);
		return $query->result();;
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
	function get_menu_array($active_category_id=0, $only_enabled = true)
	{
		$out = array();
		$index = -1;
		$categories = $this->get_child_categories();
		$count = count($categories);
		for( $i=0;$i<$count; ++$i ) {
			$ctg = $categories[$i];
			if ($only_enabled && !$ctg->enabled) {
				continue;
			}
			$item = array();
			$item['title_menu'] = $ctg->title_menu;
			$item['title'] = url_title($ctg->title);
			$item['controller'] = $ctg->controller;
			$item['id_'] = $ctg->id_;
			foreach($this->get_articles_info_list($ctg->id_) as $article) {
				$art['title_menu'] = $article->title_menu;
				$art['title'] = url_title($article->title);
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
			
			$out[$i] = $item;	
		}
		return array($out, $index);
	} 
	 
	
}
