<?php

class Presence_model extends CI_Model
{
    public function __construct() 
    {
        parent::__construct();
    }
    
    public function insert_batch_into($table_name, $data)
    {
        $this->db->insert_batch($table_name, $data);
    }

    public function update_batch_table($table_name, $data)
    {
        $this->db->update_batch($table_name, $data, 'id');
    }
    
    public function find_all_by_group_and_date($stdgroup_id, $pres_date) 
    {
        $result = $this->db->query('
            SELECT anggota_kelas.*, siswa.nomor_induk, siswa.nama_lengkap, 
            kehadiran_siswa.id_kehadiran, kehadiran_siswa.keterangan FROM anggota_kelas
            INNER JOIN siswa ON (anggota_kelas.id_siswa = siswa.id)
            LEFT JOIN (
                SELECT id AS id_kehadiran, id_siswa, keterangan
                FROM kehadiran_siswa
                WHERE tanggal = ?
            ) kehadiran_siswa 
            ON (anggota_kelas.id_siswa = kehadiran_siswa.id_siswa)
            WHERE id_kelas = ?
        ', array($pres_date, $stdgroup_id));
        return $result->result();
    }
    
    public function check_by_date_and_stundentids($pres_date, $studentIds) 
    {
        $this->db->select('1 AS is_present');
        $this->db->where('tanggal', $pres_date);
        $this->db->where_in('id_siswa', $studentIds);
        $this->db->limit(1);
        $result = $this->db->get('kehadiran_siswa');
        
        return $result->row();
    }
    
}