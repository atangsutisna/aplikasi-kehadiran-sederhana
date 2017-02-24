<?php

class User_model extends CI_Model {
    
    public function __construct() 
    {
        parent::__construct();
    }
    
    public function find_all() 
    {
        $query = $this->db->query('
            SELECT pengguna.*, staff.nama FROM pengguna
            INNER JOIN staff 
            ON pengguna.id_pengguna = staff.id
            UNION
            SELECT pengguna.*, siswa.nama_lengkap AS nama FROM pengguna
            INNER JOIN siswa
            ON pengguna.id_pengguna = siswa.id
        ');
        return $query->result();
    }

    public function find_one($id) 
    {
        $this->db->where('id_pengguna', $id);
        $result = $this->db->get('pengguna');
        return $result->row();
    }

    public function insert($data) 
    {
        $this->db->set($data);
        $this->db->insert('pengguna');
    }

    public function update($username, $data) 
    {
        $this->db->set($data);
        $this->db->where('username', $username);
        $this->db->update('pengguna');
    }

    public function check_username($username) 
    {
        $result = $this->db->query("SELECT 1 AS is_present FROM pengguna WHERE username = ?", array($username));
        return $result->row();
    }
    
    public function find_by_username($username) 
    {
        $result = $this->db->query("
            SELECT * FROM pengguna WHERE
            username = ?", array($username));
        return $result->row();
    }
    
    public function get_user_info_from_staff($username) 
    {
        $result = $this->db->query("
            SELECT staff.nama, pengguna.peran FROM pengguna 
            INNER JOIN staff 
            ON (pengguna.id_pengguna = staff.id)
            WHERE staff.status = 'AKTIF'
            AND
            username = ?", array($username));
        return $result->row();
    }
    
    public function get_user_info_from_siswa($username) 
    {
        $result = $this->db->query("
            SELECT siswa.nama_lengkap AS nama, pengguna.peran FROM pengguna
            INNER JOIN siswa
            ON (pengguna.id_pengguna = siswa.id)
            AND
            username = ?", array($username));
        return $result->row();
    }
    
    
    
}