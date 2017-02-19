<?php


class Siswa_model extends CI_Model {
    
    public function __construct() 
    {
        parent::__construct();
    }
    
    public function find_all() 
    {
        $query = $this->db->get('siswa');
        return $query->result();
    }
    
    public function insert($data) 
    {
        $this->db->set($data);
        $this->db->insert('siswa');
    }
    
    public function update($id, $data) 
    {
        $this->db->set($data);
        $this->db->where('id', $id);
        $this->db->update('siswa');
    }
    
    public function find_one($id) 
    {
        $this->db->where('id', $id);
        $result = $this->db->get('siswa');
        return $result->row();
    }
    
    public function check_nis_doest_exist($nis) 
    {
        $result = $this->db->query('SELECT 1 AS is_present FROM siswa WHERE nomor_induk = ?', $nis);
        return $result->row();
    }
    
    public function delete($id)
    {
        $this->db->delete('siswa', array('id' => $id));
    }
    
}
?>