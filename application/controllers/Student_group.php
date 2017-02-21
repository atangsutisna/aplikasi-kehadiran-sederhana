<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student_Group extends CI_Controller {
    
    public function __construct() 
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model(array('stdgroup_model', 'staff_model'));
    }
    
    public function index() 
    {
        $data = array(
            'groups' => $this->stdgroup_model->find_all(),
	        'content_view' => 'studentgroup/view'
		);        
		$this->load->view('main_view', $data);
		$this->load->library('form_validation');	
		$this->load->model(array('staff_model', 'stdgroup_model', 'siswa_model'));	    
    }
    
    public function new_form() 
	{
        $data = array(
            'staffs' => $this->staff_model->find_all(),
            'groups' => $this->stdgroup_model->find_all(),
	        'content_view' => 'studentgroup/form'
		);        
		$this->load->view('main_view', $data);			
	}

    public function new_member($stdgroup_id) 
	{
		$this->load->model('siswa_model');
		$data = array(
			'stdgroup_id' => $stdgroup_id,
			'students' => $this->siswa_model->find_all(),
			'group_members' => $this->stdgroup_model->find_member_by_group_id($stdgroup_id),
			'content_view' => 'studentgroup/form_member'
		);
		$this->load->view('main_view', $data);			
	}
	
	public function insert_new_member() 
	{
		$this->load->model('siswa_model');
		$this->form_validation->set_rules('id_kelas', 'Nama Kelas', 'required');	
		$this->form_validation->set_rules('id_siswa', 'Nama Siswa', 'required|callback_check_member');
		
		$stdgroup_id = $this->input->post('id_kelas');
		if ($this->form_validation->run() == TRUE) {
			
			$data = array(
				'id_kelas' => $stdgroup_id,
				'id_siswa' => $this->input->post('id_siswa'),
			);
			$this->stdgroup_model->add_new_member($data);
			$this->session->set_flashdata('notif', 'Data sudah disimpan');
			redirect('student_group/new_member/'. $stdgroup_id);
		} else {
			$this->new_member($stdgroup_id);
		}
		
	}
	
	public function check_member() 
	{
		$student_id = $this->input->post('id_siswa');
		$stdgroup_id = $this->input->post('id_kelas');
		$member = $this->stdgroup_model->check_member_exists($stdgroup_id, $student_id);
		if ($student_id == 0) {
			$this->form_validation->set_message('check_member', '{field} is required');
			return FALSE;
		} else if ($member->is_present == 1) {
			$this->form_validation->set_message('check_member', 'Duplicate {field}');
			return FALSE;
		} else {
			return TRUE;
		}
	}
	
    public function insert() 
	{
		$this->form_validation->set_rules('nama_kelas', 'Nama Kelas', 'required');	
		$this->form_validation->set_rules('tahun_ajaran', 'Tahun Ajaran', 'required');
		if ($this->form_validation->run() == TRUE) {
			$data = array(
				'nama_kelas' => $this->input->post('nama_kelas'),
				'tahun_ajaran' => $this->input->post('tahun_ajaran'),
				'id_wali_kelas' => $this->input->post('id_wali_kelas')
			);
			$this->staff_model->insert($data);
			$this->session->set_flashdata('notif', 'Data sudah disimpan');
			redirect('student_group/new_form');
		} else {
            $data = array(
                'staffs' => $this->staff_model->find_all(),
                'groups' => $this->stdgroup_model->find_all(),
    	        'content_view' => 'studentgroup/form'
    		);        
    		$this->load->view('main_view', $data);
		}
	}
	
    public function update() 
	{
		$this->form_validation->set_rules('nama_kelas', 'Nama Kelas', 'required');	
		$this->form_validation->set_rules('tahun_ajaran', 'Tahun Ajaran', 'required');
		if ($this->form_validation->run() == TRUE) {
			$data = array(
				'nama_kelas' => $this->input->post('nama_kelas'),
				'tahun_ajaran' => $this->input->post('tahun_ajaran'),
				'id_wali_kelas' => $this->input->post('id_wali_kelas')
			);
			$id = $this->input->post('id');
			$this->staff_model->update($id, $data);
			$this->session->set_flashdata('notif', 'Data sudah disimpan');
			redirect('student_group/new_form');
		} else {
            $data = array(
                'staffs' => $this->staff_model->find_all(),
                'groups' => $this->stdgroup_model->find_all(),
    	        'content_view' => 'studentgroup/form'
    		);        
    		$this->load->view('main_view', $data);
		}
	}
	

}