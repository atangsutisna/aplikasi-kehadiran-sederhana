<?php

class Stdgroup_model extends CI_Model 
{
    public function __construct() 
    {
        parent::__construct();
    }
    
    public function find_all() 
    {
        $query = $this->db->query('
            SELECT kelas.*, staff.nama AS wali_kelas FROM kelas
            LEFT JOIN staff 
            ON kelas.id_wali_kelas = staff.id
            ORDER BY kelas.id DESC;
        ');
        return $query->result();
    }
    
    public function insert($data) 
    {
        $this->db->set($data);
        $this->db->insert('kelas');
    }
    
    public function update($id, $data) 
    {
        $this->db->set($data);
        $this->db->where('id', $id);
        $this->db->update('kelas');
    }
    
    public function find_one($id) 
    {
        $this->db->where('id', $id);
        $result = $this->db->get('kelas');
        return $result->row();
    }

    public function find_all_tahun_ajaran() 
    {
        $result = $this->db->query("SELECT DISTINCT tahun_ajaran FROM kelas");
        return $result->result();
    }
    
    public function find_by_tahun_ajaran($tahun_ajaran) 
    {
        $this->db->where('tahun_ajaran', $tahun_ajaran);
        $result = $this->db->get('kelas');
        return $result->result();
    }
    
    public function find_all_member($group_id) 
    {
        if (!isset($group_id)) {
            return [];
        }
        
        $result = $this->db->query('SELECT id_siswa, siswa.nomor_induk, siswa.nama_lengkap FROM `anggota_kelas` 
            INNER JOIN siswa ON anggota_kelas.id_siswa = siswa.id
            WHERE id_kelas = '. $group_id);
        return $result->result();
    }
    
    public function find_member_by_group_id($stdgroup_id) 
    {
        $result = $this->db->query('
            SELECT anggota_kelas.*, siswa.nomor_induk, siswa.nama_lengkap FROM anggota_kelas
            INNER JOIN siswa ON (anggota_kelas.id_siswa = siswa.id)
            WHERE id_kelas = ?
        ', $stdgroup_id);
        return $result->result();
    }
    
    public function add_new_member($data) 
    {
        $this->db->insert('anggota_kelas', $data);
    }
    
    public function check_member_exists($stdgroup_id, $student_id)
    {
        $result = $this->db->query('
            SELECT 1 AS is_present FROM anggota_kelas
            WHERE id_kelas = ? AND id_siswa = ?
        ', array($stdgroup_id, $student_id));        
        return $result->row();                
    }
    
    public function delete_member($member_id)
    {
        $this->db->delete('anggota_kelas', array('id' => $member_id));
    }

}