<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Staff extends CI_Controller {
    
    public function __construct() 
    {
        parent::__construct();
        if (!$this->session->has_userdata('logged_in')) {
        	$this->session->set_flashdata('not_authorize', 'Not Authorize');
        	redirect('auth');
        }
        $this->load->library('form_validation');	
        $this->load->model(array('staff_model', 'position_model'));
    }
	
	public function index()
	{
		$data = array(
				'staffs' => $this->staff_model->find_all(),
		        'content_view' => 'staff/view'
		    );
		$this->load->view('main_view', $data);
	}
	
	public function new_form() 
	{
		
		$data = array(
				'positions' => $this->position_model->find_all(),
				'staffs' => $this->staff_model->find_all(),
		        'content_view' => 'staff/form'
		    );
		
		$this->load->view('main_view', $data);			
	}
	
	public function edit($id) 
	{
		$data = array(
				'positions' => $this->position_model->find_all(),
				'staff' => $this->staff_model->find_one($id),
		        'content_view' => 'staff/form'
		    );
		
		$this->load->view('main_view', $data);			
	}	

	public function update() 
	{
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$id = $this->input->post('id');
		if ($this->form_validation->run() == TRUE) {
			$data = array(
				'nama' => $this->input->post('nama'),
				'alamat' => $this->input->post('alamat'),
				'jenis_kelamin' => $this->input->post('jenis_kelamin'),
				'pendidikan_terakhir' => $this->input->post('pendidikan_terakhir'),
				'id_jabatan' => $this->input->post('id_jabatan'),
			);
			$this->staff_model->update($id, $data);
			$this->session->set_flashdata('notif', 'Data sudah diupdate');
			redirect('staff/edit/'. $id);
		} else {
			$data = array(
				'positions' => $this->position_model->find_all(),
				'staff' => $this->staff_model->find_one($id),
		        'content_view' => 'staff/form'
		    );
			$this->load->view('main_view', $data);			
		}
	}
}    
?>
