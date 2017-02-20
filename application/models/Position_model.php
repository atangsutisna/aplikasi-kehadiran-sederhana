<?php

class Position_model extends CI_Model 
{
    public function __construct() 
    {
        parent::__construct();
    }
    
    public function find_all() 
    {
        $query = $this->db->get('jabatan');
        return $query->result();
    }
}
