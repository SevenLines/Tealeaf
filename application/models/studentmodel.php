<?php

class StudentModel extends CI_Model {
	
	var $studentTable = "student";
	var $groupTable = "group";
        var $markTable = "mark";
        var $eventTable = "event";
	
	function __construct()
	{
		parent::__construct();	
	}
        
        /**
         * 
         * @param integer $id id of row to get
         * @param string $table table name
         * @return null or row data if exists
         */
        protected function __get_row_or_null($id, $table) 
        {
            $this->db->where("id_", $id);
            $query = $this->db->get($table);
            return $this->__get_row_or_null_($query);
        }
        
        protected function __get_row_or_null_($query) 
        {
           if ($query->num_rows() > 0 ) {
                return $query->row();
            }
            return null; 
        }
            
        /**
         * Update only one row and check for it onliness
         * 
         * @param string $table
         * @param array $data if data without id_ field then $id is used
         * @param integer $id id_ field
         */
        protected function __update_one_row($table, $data, $id=null)
        {
            if ( !isset($data["id_"]) && !isset($id) ) {
                error_log(__FILE__.": ".__LINE__.":\n".__FUNCTION__.": $table: $id is not defined");
                return;
            }
            if ( isset($id) ) { $data["id_"] = $id; }
            $this->db->update($table, $data);
        }
        
        /**
         * Delete row  form table and check for $id
         * 
         * @param string $table
         * @param integer $id id_ field
         */
        protected function __delete_one_row($table, $id)
        {
            if ( isset($id) ) {
                error_log(__FILE__.": ".__LINE__.":\n".__FUNCTION__.": $table: $id is not defined");
                return;
            }
            $this->db->where("id_", $id);
            $this->db->delete($table);
        }
        
       
        public function get_groups() 
        {
            $query = $this->db->get($this->groupTable);    
            return $query->result();
        }
               
        public function get_group($group_id) 
        {
            return $this->__get_row_or_null($group_id, $this->groupTable);
        }
        
        public function update_group($data, $group_id = null) 
        {
            $this->__update_one_row($this->groupTable, $data, $group_id);
        }
        
        public function delete_group($group_id) 
        {
            $this->__delete_one_row($this->groupTable, $group_id);
        }
        
        public function add_group($data) 
        {
            $this->db->insert($this->groupTable, $data);
            return $this->db->insert_id();
        }
        	
	public function get_students($group_id)
	{
		$this->db->where("group_id", $group_id);
		$query = $this->db->get($this->studentTable);
		return $query->result();
	}

        public function get_student($student_id) 
        { 
            return $this->__get_row_or_null($student_id, $this->studentTable);
        }
        
        public function update_student($data, $student_id = null) 
        {
            $this->__update_one_row($this->studentTable, $data, $student_id);
        }

        public function delete_student($student_id) 
        {
            $this->__delete_one_row($this->studentTable, $student_id);
        }

        public function add_student($data) 
        {
            $this->db->insert($this->studentTable, $data);
            return $this->db->insert_id();
        }
        
        /**
         * Get info for available events for group with
         * 
         * @param integer $group_id group id
         * @return array array of rOw objects
         */
        public function get_events($group_id) 
        {
            $sql = <<<SQL
SELECT DISTINCT e.*
FROM $this->studentTable s
LEFT JOIN $this->markTable m ON s.id_ = m.student_id
JOIN $this->eventTable e ON e.id_ = m.event_id
WHERE event_id and s.group_id = $group_id                    
SQL;
            $query = $this->db->query($sql);
            return $query->result();
        }
        
        /**
         * Get marks for student
         * 
         * @param integer $student_id student id :D
         * @param integer $event_id set to null to get all marks for particular student
         */
        public  function get_mark_ex($student_id, $event_id = null)
        {
            $sql = <<<SQL
SELECT *
FROM $this->markTable
WHERE student_id = $student_id               
SQL;
            if ( isset($event_id) ) {
                $sql .= " and event_id = $event_id";
            }
            $query = $this->db->query($sql);
            return $this->__get_row_or_null_($query);
        }
        
        /**
         * 
         * @param integer $mark_id
         * @return mark row or null if nothing find
         */
        public  function get_mark($mark_id)
        {
            return $this->__get_row_or_null($mark_id, $this->markTable);
        }
        
        public function update_mark($mark_id, $mark) 
        {
            $this->__update_one_row($this->markTable, 
                    array("mark" => $mark), $mark_id);
        }
        
        /**
         * 
         * @param integer $student_id
         * @param integer $event_id
         * @param integer $mark
         * @return integer new mark id
         */
        public function add_mark($student_id, $event_id, $mark) 
        { 
            $data["student_id"] = $student_id;
            $data["event_id"] = $event_id;
            $data["mark"] = $mark;
            
            $this->db->insert($this->markTable, $data);
            return $this->db->insert_id();
        }
        
        public function delete_mark($mark_id) 
        {
            $this->__delete_one_row($this->markTable, $mark_id);
        }
 
	
}
