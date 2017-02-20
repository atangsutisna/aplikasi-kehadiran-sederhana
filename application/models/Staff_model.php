<?php

class Staff_model extends CI_Model 
{
    public function __construct() 
    {
        parent::__construct();
    }
    
    public function find_all() 
    {
        $query = $this->db->get('staff');
        return $query->result();
    }
    
    public function find_one($id) 
    {
        $this->db->where('id', $id);
        $result = $this->db->get('staff');
        return $result->row();
    }

}
