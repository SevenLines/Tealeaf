<?php

class VisitorsModel extends CI_Model {

	var $session_table = 'ci_sessions';

	
	# return last from to visits
	function get_current_visitors()
	{
		$this->db->order_by('last_activity', 'desc');
		$this->db->limit(5,0);
		$query = $this->db->get($this->session_table);
		return $query->result();
	}

}