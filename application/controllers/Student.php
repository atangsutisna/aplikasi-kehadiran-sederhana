<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends CI_Controller {
    
    
    public function __construct() {
        parent::__construct();
        if (!$this->session->has_userdata('logged_in')) {
        	$this->session->set_flashdata('not_authorize', 'Not Authorize');
        	redirect('auth');
        }
        $this->load->model('siswa_model');
    }
    
	public function index()
	{
		$students = $this->siswa_model->find_all();
		$data = array(
		        'students' => $students,
		        'content_view' => 'student/view'
		    );
		$this->load->view('main_view', $data);
	}
	
	public function new_form() 
	{
		$this->load->view('main_view', array('content_view' => 'student/form'));			
	}
	
	public function insert() 
	{
		$this->load->library('form_validation');	
		
		$this->form_validation->set_rules('nomor_induk', 'NIS', 'required');
		if ($this->form_validation->run() == TRUE) {
			//insert to database
			$data = array(
					'nomor_induk' => $this->input->post('nomor_induk'),
					'nama_lengkap' => $this->input->post('nama_lengkap'),
					'jenis_kelamin' => $this->input->post('jenis_kelamin'),
					'alamat' => $this->input->post('alamat')
				);
			$this->siswa_model->insert($data);
			$this->session->set_flashdata('notif', 'Data sudah disimpan');
			redirect('student/new_form');
		} else {
			$this->load->view('main_view', array('content_view' => 'student/form'));						
		}
	}

	
	public function edit_student($id) 
	{
		$this->load->view('main_view', array('content_view' => 'student/form'));							
	}
	
	public function delete($id) 
	{
		
	}



}