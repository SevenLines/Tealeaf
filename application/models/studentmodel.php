<?php

class StudentModel extends CI_Model {
	
	var $studentTable = "student";
	var $groupTable = "group";
	
	function __construct()
	{
		parent::__construct();	
	}
	
	public function get_students($group_id)
	{
		$this->db->where("group_id", $group_id);
		$query = $this->db->get($this->studentTable);
		return $query->result();
	}
	
}
