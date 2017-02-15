<?php

class Pengguna_model extends CI_Model {
    
    public function __construct() 
    {
        parent::__construct();
    }
    
    public function check_username($username) 
    {
        $result = $this->db->query("SELECT 1 FROM pengguna WHERE username = ?", array($username));
        return $result->row();
    }
    
    public function find_by_username($username) 
    {
        $result = $this->db->query("SELECT * FROM pengguna WHERE username = ?", array($username));
        return $result->row();
    }
    
}