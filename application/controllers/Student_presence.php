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
        
        $this->load->model('presence_model');
        $data = array(
            'group_name' => $this->stdgroup_model->find_one($post_id_kelas),
            'stdgroup' => $this->stdgroup_model->find_by_tahun_ajaran($post_tahun_ajaran),
            'tahun_ajaran' => $this->stdgroup_model->find_all_tahun_ajaran(),
            'group_members' => $this->presence_model->find_all_by_group_and_date($post_id_kelas, date('Y/m/d')),
	        'content_view' => 'studentpresence/form'
		);
		
		$this->load->view('main_view', $data);
    }
    
    public function insert() 
    {
        $this->load->model('presence_model');
        $postData = $this->input->post('keterangan');
        $data = array();
        $studentIds = [];
        foreach($postData as $idx => $value) {
            $studentIds[] = $idx;
            $row = array(
                'id_siswa' => $idx,
                'keterangan' => $value,
                'id_operator' => $this->session->userdata('staff_id'),
                'tanggal' => date('Y/m/d')
            );
            
            $data[] = $row;
        }
        
        $prensece = $this->presence_model->check_by_date_and_stundentids(date('Y/m/d'), $studentIds);
        if ($prensece->is_present == 1) {
            $presence_ids = $this->input->post('id_kehadiran');   
            $update_data = array();
            foreach ($presence_ids as $idx => $value) {
                foreach ($data as $row_idx => $row) {
                    //echo $row['id_siswa']. ' '. $idx. '<br>';
                    if ($row['id_siswa'] == $idx) {
                        //echo 'is equal <br/>';
                        $row['id'] = $value;
                        $update_data[] = $row;
                    }
                }
            }

            $this->session->set_flashdata('notif', 'Data sudah diubah');
            $this->presence_model->update_batch_table('kehadiran_siswa', $update_data);
        } else {
            $this->session->set_flashdata('notif', 'Data sudah disimpan');
            $this->presence_model->insert_batch_into('kehadiran_siswa', $data);    
        }
        
        redirect('student_presence');
    }
    
}

