<?php

class StatsModel extends CI_Model {

	var $visitors_table = 'visitors';

    function __construct()
    {
        parent::__construct();
		$this->load->library('user_agent');
    }

	function get_last_visit() {
		$this->db->order_by('id_', 'desc');
		$this->db->limit(1);
		$query = $this->db->get($this->visitors_table);
		if ($query->num_rows() === 0) return null;	
		return $query->row();
	}
	
	
	function save_current_visit() {
		$data = array();
		$data['referrer'] = substr($this->agent->referrer(), 0, 512);
		$data['platform'] = substr($this->agent->platform(), 0, 128);
		$data['browser'] = substr($this->agent->browser(), 0, 128);
		$data['browser_v'] = substr($this->agent->version(), 0, 128);
		$data['mobile'] = substr($this->agent->mobile(), 0, 128);
		$data['robot'] = substr($this->agent->robot(), 0, 128);
		$data['agent'] = substr($this->agent->agent_string(), 0, 512);
		$data['timestamp'] = time();
		$data['ip'] =  substr($this->input->ip_address(), 0, 45);
		
		$last_visit = $this->get_last_visit();
		# if agent and ip equals just update row
		if(isset($last_visit) && $last_visit->ip === $data['ip'] && $last_visit->agent === $data['agent']) {
			unset($data['agent']);
			unset($data['ip']);
			$this->db->where('id_', $last_visit->id_);
			$this->db->update($this->visitors_table, $data);	
		} else {
			$this->db->insert($this->visitors_table, $data);	
		}
	}
	
	function get_last_visitiors($from, $count) {
		$this->db->order_by('timestamp', 'desc');
		$this->db->limit($count, $from);
		$query = $this->db->get($this->visitors_table);
		return $query->result();
	}
	

}