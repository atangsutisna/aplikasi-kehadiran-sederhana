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
    
    public function find_all_active() 
    {
        $query = $this->db->query("
            SELECT staff.*, pos.nama_jabatan FROM staff
            LEFT JOIN jabatan pos
            ON staff.id_jabatan = pos.id
            WHERE status = 'AKTIF'
            ORDER BY nama;
        ");
        return $query->result();
    }    
    
    public function find_all_by_position($id_position) 
    {
        $query = $this->db->query('
            SELECT staff.*, pos.nama_jabatan FROM staff
            LEFT JOIN jabatan pos
            ON staff.id_jabatan = pos.id
            WHERE staff.id_jabatan = ?
            ORDER BY nama;
        ', $id_position);
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
    
    public function check_nip_doest_exist($nip) 
    {
        $result = $this->db->query('SELECT 1 AS is_present FROM staff WHERE nip = ?', $nip);
        return $result->row();
    }


}
