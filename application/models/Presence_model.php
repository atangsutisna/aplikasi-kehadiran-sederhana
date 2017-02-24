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
    
    public function find_all_staff_by_date($pres_date) 
    {
        $result = $this->db->query("
            SELECT staff.id AS id_staff, staff.nip, staff.nama, 
            kehadiran_staff.id_kehadiran, 
            kehadiran_staff.keterangan FROM staff
            LEFT JOIN (
                SELECT id AS id_kehadiran, id_staff, keterangan
                FROM kehadiran_staff
                WHERE tanggal = ?
            ) kehadiran_staff 
            ON (staff.id = kehadiran_staff.id_staff)
            WHERE staff.status = 'AKTIF' ", $pres_date);
        return $result->result();
    }
    
    public function view_all_by_date($pres_date) 
    {
        $result = $this->db->query("
            SELECT staff.id AS id_staff, staff.nip, staff.nama, 
            kehadiran_staff.id_kehadiran, 
            kehadiran_staff.keterangan FROM staff
            INNER JOIN (
                SELECT id AS id_kehadiran, id_staff, keterangan
                FROM kehadiran_staff
                WHERE tanggal = ?
            ) kehadiran_staff 
            ON (staff.id = kehadiran_staff.id_staff)
            WHERE staff.status = 'AKTIF' ", $pres_date);
        return $result->result();
    }
    
    
    public function check_by_date_and_staffids($pres_date, $staffIds) 
    {
        $this->db->select('1 AS is_present');
        $this->db->where('tanggal', $pres_date);
        $this->db->where_in('id_staff', $staffIds);
        $this->db->limit(1);
        $result = $this->db->get('kehadiran_staff');
        
        return $result->row();
    }
    
    public function show_student_report_by_yearmonth($yearmonth)
    {
        $result = $this->db->query("
            select 
            siswa.nomor_induk, 
            siswa.nama_lengkap, 
            kelas.nama_kelas,
            case when counter_attendance.count is null then 0 else counter_attendance.count end as count_hadir,
            case when counter_alpa.count is null then 0 else counter_alpa.count end as count_alpa,
            case when counter_sakit.count is null then 0 else counter_sakit.count end count_sakit,
            case when counter_ijin.count is null then 0 else counter_ijin.count end count_ijin
            from siswa
            left join (
                select 
                id_siswa,
                kelas.nama_kelas
                from anggota_kelas
                left join kelas
                on anggota_kelas.id_kelas = kelas.id
            ) kelas
            on siswa.id = kelas.id_siswa
            left join (
                select 
                id_siswa,
                count(*) as count
                from kehadiran_siswa
                where keterangan = 'HADIR'
                and extract(year_month from tanggal) = ?
                group by id_siswa
            ) counter_attendance
            on siswa.id = counter_attendance.id_siswa
            left join (
                select 
                id_siswa,
                count(*) as count
                from kehadiran_siswa
                where keterangan = 'ALPA'
                and extract(year_month from tanggal) = ?
                group by id_siswa
            ) counter_alpa
            on siswa.id = counter_alpa.id_siswa
            left join (
                select 
                id_siswa,
                count(*) as count
                from kehadiran_siswa
                where keterangan = 'SAKIT'
                and extract(year_month from tanggal) = ?
                group by id_siswa
            ) counter_sakit
            on siswa.id = counter_sakit.id_siswa
            left join (
                select 
                id_siswa,
                count(*) as count
                from kehadiran_siswa
                where keterangan = 'IJIN'
                and extract(year_month from tanggal) = ?
                group by id_siswa
            ) counter_ijin
            on siswa.id = counter_ijin.id_siswa
        ", array($yearmonth, $yearmonth, $yearmonth, $yearmonth));
        
        return $result->result();
    }
    
    public function show_staff_report_by_yearmonth($yearmonth)
    {
        $result = $this->db->query("
            SELECT staff.id,nip, nama AS nama_lengkap, jabatan.nama_jabatan, 
            case when counter_hadir.count_hadir is null then 0 else counter_hadir.count_hadir end as count_hadir,
            case when counter_alpa.count_alpa is null then 0 else counter_alpa.count_alpa end as count_alpa,
            case when counter_sakit.count_sakit is null then 0 else counter_sakit.count_sakit end as count_sakit,
            case when counter_ijin.count_ijin is null then 0 else counter_ijin.count_ijin end as count_ijin
            FROM staff
            LEFT JOIN jabatan 
            ON staff.id_jabatan = jabatan.id
            LEFT JOIN (
                SELECT id_staff, count(*) as count_hadir
                FROM kehadiran_staff
                WHERE keterangan = 'HADIR'
                AND EXTRACT(YEAR_MONTH FROM tanggal) = ?
                GROUP BY id_staff
            ) counter_hadir
            ON staff.id = counter_hadir.id_staff        
            LEFT JOIN (
                SELECT id_staff, count(*) as count_alpa
                FROM kehadiran_staff
                WHERE keterangan = 'ALPA'
                AND EXTRACT(YEAR_MONTH FROM tanggal) = ?
                GROUP BY id_staff
            ) counter_alpa
            ON staff.id = counter_alpa.id_staff        
            LEFT JOIN (
                SELECT id_staff, count(*) as count_sakit
                FROM kehadiran_staff
                WHERE keterangan = 'SAKIT'
                AND EXTRACT(YEAR_MONTH FROM tanggal) = ?
                GROUP BY id_staff
            ) counter_sakit
            ON staff.id = counter_sakit.id_staff        
            LEFT JOIN (
                SELECT id_staff, count(*) as count_ijin
                FROM kehadiran_staff
                WHERE keterangan = 'IJIN'
                AND EXTRACT(YEAR_MONTH FROM tanggal) = ?
                GROUP BY id_staff
            ) counter_ijin
            ON staff.id = counter_ijin.id_staff        
            WHERE staff.status = 'AKTIF'
        ", array($yearmonth, $yearmonth, $yearmonth, $yearmonth));
        return $result->result();
    }
    
}