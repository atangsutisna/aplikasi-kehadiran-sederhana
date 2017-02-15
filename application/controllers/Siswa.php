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
		//$this->load->view('welcome_message');
		$this->load->model('siswa_model');
		$result = $this->siswa_model->find_all();
		var_dump($result);
	}

}