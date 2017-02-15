<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa extends CI_Controller {
    
    /**
    public function __construct() {
        parent::__contruct();
        $this->load->model('Siswa_model');
    }
    **/
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