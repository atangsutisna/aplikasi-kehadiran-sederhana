<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student_presence extends CI_Controller {
    
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('stdgroup_model');
    }
    
    public function index() 
    {
        $data = array(
            'tahun_ajaran' => $this->stdgroup_model->find_all_tahun_ajaran(),
	        'content_view' => 'studentpresence/form',
	        'group_members' => [],
		);        
		
		$this->load->view('main_view', $data);
    }
    
    public function show_group() 
    {
        $post_tahun_ajaran = $this->input->post('tahun_ajaran');
        $data = array(
            'stdgroup' => $this->stdgroup_model->find_by_tahun_ajaran($post_tahun_ajaran),
            'tahun_ajaran' => $this->stdgroup_model->find_all_tahun_ajaran(),
            'group_members' => [],
	        'content_view' => 'studentpresence/form'
		);        
		
		$this->load->view('main_view', $data);
    }
    
    public function new_presence() 
    {
        $post_tahun_ajaran = $this->input->post('tahun_ajaran');
        $post_id_kelas = $this->input->post('id_kelas');
        $data = array(
            'group_name' => $this->stdgroup_model->find_one($post_id_kelas),
            'stdgroup' => $this->stdgroup_model->find_by_tahun_ajaran($post_tahun_ajaran),
            'tahun_ajaran' => $this->stdgroup_model->find_all_tahun_ajaran(),
            'group_members' => $this->stdgroup_model->find_all_member($post_id_kelas),
	        'content_view' => 'studentpresence/form'
		);        
        
		$this->load->view('main_view', $data);
    }
    
    public function insert() 
    {
        $this->load->model('presence_model');
        $postData = $this->input->post('keterangan');
        $data = array();
        foreach($postData as $idx => $value) {
            $row = array(
                'id_siswa' => $idx,
                'keterangan' => $value,
                'id_operator' => $this->session->userdata('staff_id'),
                'tanggal' => date('Y/m/d')
            );
            
            $data[] = $row;
        }
        $this->presence_model->insert_into('kehadiran_siswa', $data);
        $this->session->set_flashdata('notif', 'Data sudah disimpan');
        redirect('student_presence');
    }
    
}

