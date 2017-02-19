<?php

class Stdgroup_model extends CI_Model 
{
    public function __construct() 
    {
        parent::__construct();
    }
    
    public function find_all() 
    {
        $query = $this->db->get('kelas');
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

}