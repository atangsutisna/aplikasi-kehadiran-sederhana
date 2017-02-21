<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student_Group extends CI_Controller {
    
    public function __construct() 
    {
        parent::__construct();
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
		$this->load->model(array('staff_model', 'stdgroup_model'));	    
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

    public function new_member() 
	{
		$this->load->view('main_view', array('content_view' => 'studentgroup/form_member'));			
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