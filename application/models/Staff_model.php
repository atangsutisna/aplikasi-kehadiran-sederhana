<?php

class Staff_model extends CI_Model 
{
    public function __construct() 
    {
        parent::__construct();
    }
    
    public function find_all() 
    {
        $query = $this->db->query('
            SELECT staff.*, pos.nama_jabatan FROM staff
            LEFT JOIN jabatan pos
            ON staff.id_jabatan = pos.id
            ORDER BY nama;
        ');
        return $query->result();
    }
    
    public function insert($data) 
    {
        $this->db->set($data);
        $this->db->insert('staff');
    }
    
    public function update($id, $data) 
    {
        $this->db->set($data);
        $this->db->where('id', $id);
        $this->db->update('staff');
    }
    
    public function find_one($id) 
    {
        $this->db->where('id', $id);
        $result = $this->db->get('staff');
        return $result->row();
    }

}
