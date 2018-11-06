<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Staff extends CI_Controller {
    const MODULE_NAME = 'Staff';
    
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
		try {
	    	if (!$this->role_manager->is_permitted(
						$this->session->userdata('role'), 
						Staff::MODULE_NAME,
						'read')) {
				throw new Exception("Access Denied");
			}   
	        
			$data = array(
				'positions' => $this->position_model->find_all(),
				'staffs' => $this->staff_model->find_all(),
		        'content_view' => 'staff/view'
		    );
			$this->load->view('main_view', $data);
		} catch (Exception $e) {
			$this->load->view('main_view', array('content_view' => 'errors/html/access_denied'));			
		}
	}
	
	public function filter() 
	{
		try {
	    	$user = $this->role_model->has_role(
	    				$this->session->userdata('role'), 
	    				Staff::MODULE_NAME
	    			);
	        if ($user->read_action == 0) {
	        	throw new Exception("Access Denied");
	        }    		
	        
			$id_position = $this->input->post('id_jabatan');
			$order_by = $this->input->post('order_by');
			$order_desc = $this->input->post('order_desc');
			$data = array(
				'selected_order_by' => $order_by,
				'selected_order_desc' => $order_desc,
				'selected_position_id' => $this->input->post('id_jabatan'),
				'positions' => $this->position_model->find_all(),
				'staffs' => $this->staff_model->find_all_by_position($id_position, $order_by, $order_desc),
		        'content_view' => 'staff/view'
			);
			//var_dump($data);
			$this->load->view('main_view', $data);
		} catch (Exception $e) {
			$this->load->view('main_view', array('content_view' => 'errors/html/access_denied'));			
		}
		
	}
	
	public function new_form() 
	{
		try {
	    	$user = $this->role_model->has_role(
	    				$this->session->userdata('role'), 
	    				Staff::MODULE_NAME
	    			);
	        if ($user->create_action == 0) {
	        	throw new Exception("Access Denied");
	        }    		
	        
			$data = array(
					'positions' => $this->position_model->find_all(),
					'staffs' => $this->staff_model->find_all(),
			        'content_view' => 'staff/form'
			    );
			
			$this->load->view('main_view', $data);	        
		} catch (Exception $e) {
			$this->load->view('main_view', array('content_view' => 'errors/html/access_denied'));			
		}
		
			
	}
	
	public function insert() 
	{
		try {
	    	$user = $this->role_model->has_role(
	    				$this->session->userdata('role'), 
	    				Staff::MODULE_NAME
	    			);
	        if ($user->create_action == 0) {
	        	throw new Exception("Access Denied");
	        }    		
	        
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
					'status' => $this->input->post('status')
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
		} catch (Exception $e) {
			$this->load->view('main_view', array('content_view' => 'errors/html/access_denied'));			
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
		try {
	    	if (!$this->role_manager->is_permitted(
						$this->session->userdata('role'), 
						Staff::MODULE_NAME,
						'read')) {
				throw new Exception("Access Denied");
			}   

			$data = array(
					'positions' => $this->position_model->find_all(),
					'staff' => $this->staff_model->find_one($id),
			        'content_view' => 'staff/form'
			    );
			
			$this->load->view('main_view', $data);			
		} catch (Exception $e) {
			$this->load->view('main_view', array('content_view' => 'errors/html/access_denied'));			
		}
	}	

	public function update() 
	{
		try {
	    	$user = $this->role_model->has_role(
	    				$this->session->userdata('role'), 
	    				Staff::MODULE_NAME
	    			);
	        if ($user->update_action == 0) {
	        	throw new Exception("Access Denied");
	        }    		
	        
			$this->form_validation->set_rules('nama', 'Nama', 'required');
			$id = $this->input->post('id');
			if ($this->form_validation->run() == TRUE) {
				$data = array(
					'nama' => $this->input->post('nama'),
					'alamat' => $this->input->post('alamat'),
					'jenis_kelamin' => $this->input->post('jenis_kelamin'),
					'pendidikan_terakhir' => $this->input->post('pendidikan_terakhir'),
					'id_jabatan' => $this->input->post('id_jabatan'),
					'status' => $this->input->post('status')
				);
				// update status jadi catatan
				// jangan sampai administrator di non aktifin
				// cek yang login jangan aktifin sendir
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
	        
		} catch (Exception $e) {
			$this->load->view('main_view', array('content_view' => 'errors/html/access_denied'));			
		}
	}
}    
?>
