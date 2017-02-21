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
			'positions' => $this->position_model->find_all(),
			'staffs' => $this->staff_model->find_all(),
	        'content_view' => 'staff/view'
	    );
		$this->load->view('main_view', $data);
	}
	
	public function filter() 
	{
		$id_position = $this->input->post('id_jabatan');
		$data = array(
			'selected_position_id' => $this->input->post('id_jabatan'),
			'positions' => $this->position_model->find_all(),
			'staffs' => $this->staff_model->find_all_by_position($id_position),
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
	
	public function insert() 
	{
		$this->form_validation->set_rules('nip', 'NIP', 'required|callback_check_id');	
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		if ($this->form_validation->run() == TRUE) {
			$data = array(
				'nip' => $this->input->post('nip'),
				'nama' => $this->input->post('nama'),
				'alamat' => $this->input->post('alamat'),
				'jenis_kelamin' => $this->input->post('jenis_kelamin'),
				'pendidikan_terakhir' => $this->input->post('pendidikan_terakhir'),
				'id_jabatan' => $this->input->post('id_jabatan'),
			);
			$this->staff_model->insert($data);
			$this->session->set_flashdata('notif', 'Data sudah disimpan');
			redirect('staff/new_form');
		} else {
			$data = array(
				'positions' => $this->position_model->find_all(),
		        'content_view' => 'staff/form'
		    );
			$this->load->view('main_view', $data);			
		}
	}
	
	public function check_id($nip) 
	{
		$result = $this->staff_model->check_nip_doest_exist($nip);
		if ($result->is_present) {
			$this->form_validation->set_message('check_id', 'Duplicate {field}');
			return FALSE;
		} else {
			return TRUE;
		}
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
