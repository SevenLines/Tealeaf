<?php

class OptionsModel extends CI_Model {
    
    var $optionsTable = 'options';
    
    function __construct()
    {
        parent::__construct();
    }
    
    // пароль администратора
    function password() {
        $this->db->where('name', 'password');
        $query = $this->db->get($this->optionsTable);
        
        if($query->num_rows() == 0 ) return null;
        return $query->row()->value;
    }
    
    function off_article_id() {
        $this->db->where('name', 'turned_off_article_id');
        $query = $this->db->get($this->optionsTable);
        
        if($query->num_rows() == 0 ) return null;
        return $query->row()->value;
    }
    
    function set_off_article_id($article_id) {
        $data['value'] = $article_id;
        $this->db->where('name', 'turned_off_article_id');
        $query = $this->db->update($this->optionsTable, $data);
    }

    // почта администратора
    function email() {
        $this->db->where('name', 'email');
        $query = $this->db->get($this->optionsTable);
        
        if($query->num_rows() == 0 ) return null;
        return $query->row()->value;        
    }
    
    // состояние сайта включен / выключен
    function state() {
        $this->db->where('name', 'state');
        $query = $this->db->get($this->optionsTable);
        
        if($query->num_rows() == 0 ) return true;
        return $query->row()->value=="0"?false:true;  
    }
    
        
    function set_state($state) {
        $data['value'] = $state;
        $this->db->where('name', 'state');
        $query = $this->db->update($this->optionsTable, $data);
    }
    
}
