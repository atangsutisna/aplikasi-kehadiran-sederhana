<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa extends CI_Controller {
    
    
    public function __construct() {
        parent::__construct();
        if (!$this->session->has_userdata('logged_in')) {
        	$this->session->set_flashdata('not_authorize', 'Not Authorize');
        	redirect('auth');
        }
    }
    
	public function index()
	{
		$this->load->model('siswa_model');
		$students = $this->siswa_model->find_all();
		$data = array(
		        'students' => $students,
		        'content_view' => 'siswa/view'
		    );
		$this->load->view('main_view', $data);
	}

}