<?php

class OptionsModel extends CI_Model {
    
    var $optionsTable = 'options';
    
    function __construct()
    {
        parent::__construct();
    }
    
    function password() {
        $this->db->where('name', 'password');
        $query = $this->db->get($this->optionsTable);
        
        if($query->num_rows() == 0 ) return null;
        return $query->row()->value;
    }
    
    function email() {
        $this->db->where('name', 'email');
        $query = $this->db->get($this->optionsTable);
        
        if($query->num_rows() == 0 ) return null;
        return $query->row()->value;        
    }
    
}
