<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends CI_Controller {
    const MODULE_NAME = 'Siswa';    
    
    public function __construct() {
        parent::__construct();
        if (!$this->session->has_userdata('logged_in')) {
        	$this->session->set_flashdata('not_authorize', 'Not Authorize');
        	redirect('auth');
        }
        $this->load->library('form_validation');	
        $this->load->model('siswa_model');
    }
    
	public function index()
	{
		try {
	    	if (!$this->role_manager->is_permitted(
						$this->session->userdata('role'), 
						Student::MODULE_NAME,
						'read')) {
				throw new Exception("Access Denied");
			}   

			$students = $this->siswa_model->find_all();
			$data = array(
			        'students' => $students,
			        'content_view' => 'student/view'
			    );
			$this->load->view('main_view', $data);
		} catch (Exception $e) {
			$this->load->view('main_view', array('content_view' => 'errors/html/access_denied'));			
		}
	}
	
	public function new_form() 
	{
		try {
	    	if (!$this->role_manager->is_permitted(
						$this->session->userdata('role'), 
						Student::MODULE_NAME,
						'create')) {
				throw new Exception("Access Denied");
			}   
			
			$this->load->view('main_view', array('content_view' => 'student/form'));						
		} catch(Exception $e) {
			$this->load->view('main_view', array('content_view' => 'errors/html/access_denied'));
		}

	}
	
	public function insert() 
	{
		try {
	    	$user = $this->role_model->has_role(
	    				$this->session->userdata('role'), 
	    				Student::MODULE_NAME
	    			);
	        if ($user->read_action == 0) {
	        	throw new Exception("Access Denied");
	        }    		
	        
			$this->save('insert');
		} catch(Exception $e) {
			$this->load->view('main_view', array('content_view' => 'errors/html/access_denied'));
		}

	}

	public function check_id($nis) 
	{
		$result = $this->siswa_model->check_nis_doest_exist($nis);
		if ($result->is_present) {
			$this->form_validation->set_message('check_id', 'Duplicate {field}');
			return FALSE;
		} else {
			return TRUE;
		}
	}
	
	public function edit_student($id) 
	{
		try {
	    	if (!$this->role_manager->is_permitted(
						$this->session->userdata('role'), 
						Student::MODULE_NAME,
						'update')) {
				throw new Exception("Access Denied");
			}   

	        
			$student = $this->siswa_model->find_one($id);
			$this->load->view('main_view', array(
				'content_view' => 'student/form',
				'siswa' => $student));	
		} catch (Exception $e) {
			$this->load->view('main_view', array('content_view' => 'errors/html/access_denied'));						
		}
	}
	
	public function update() 
	{
		try {
	    	$user = $this->role_model->has_role(
	    				$this->session->userdata('role'), 
	    				Student::MODULE_NAME
	    			);
	        if ($user->update_action == 0) {
	        	throw new Exception("Access Denied");
	        }    		
			
			$this->save('update');			
		} catch (Exception $e) {
			$this->load->view('main_view', array('content_view' => 'errors/html/access_denied'));			
		}
		
	}
	
	public function delete($id) 
	{
		try {
	    	if (!$this->role_manager->is_permitted(
						$this->session->userdata('role'), 
						Student::MODULE_NAME,
						'delete')) {
				throw new Exception("Access Denied");
			}   
	
			if (!isset($id)) {
				$this->session->set_flashdata('notif', 'ID must not be null');
				redirect('student');
			}
			
			$this->siswa_model->delete($id);
			$this->session->set_flashdata('notif', '1 siswa telah dihapus');
			redirect('student');
		} catch (Exception $e) {
			$this->load->view('main_view', array('content_view' => 'errors/html/access_denied'));			
		}
	}

	private function save($action) 
	{
		if ($action == 'insert') {
			$this->form_validation->set_rules('nomor_induk', 'NIS', 'required|callback_check_id');	
		}
		
		$this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required');
		if ($this->form_validation->run() == TRUE) {
			//insert to database
			if ($action == 'insert') {
				$data = array(
					'nomor_induk' => $this->input->post('nomor_induk'),
					'nama_lengkap' => $this->input->post('nama_lengkap'),
					'jenis_kelamin' => $this->input->post('jenis_kelamin'),
					'alamat' => $this->input->post('alamat')
				);

				$this->session->set_flashdata('notif', 'Data sudah disimpan');
				$this->siswa_model->insert($data);				
				redirect('student/new_form');
			} 
			
			if ($action == 'update') {
				$data = array(
					'nama_lengkap' => $this->input->post('nama_lengkap'),
					'jenis_kelamin' => $this->input->post('jenis_kelamin'),
					'alamat' => $this->input->post('alamat')
				);

				$this->session->set_flashdata('notif', 'Data sudah diupdate');
				$this->siswa_model->update($this->input->post('id'), 
				$data);				
				redirect('student/edit_student/'. $this->input->post('id'));
			}

			
		} else {
			$this->load->view('main_view', array('content_view' => 'student/form'));						
		}
	}
	
	public function order() 
	{
		$order_by = $this->input->post('order_by');
		$order_desc = $this->input->post('order_desc');
		try {
	    	$user = $this->role_model->has_role(
	    				$this->session->userdata('role'), 
	    				Student::MODULE_NAME
	    			);
	        if ($user->read_action == 0) {
	        	throw new Exception("Access Denied");
	        }    		

			$students = $this->siswa_model->find_all($order_by, $order_desc);
			$data = array(
					'selected_order_by' => $order_by,
					'selected_order_desc' => $order_desc,
			        'students' => $students,
			        'content_view' => 'student/view'
			    );
			$this->load->view('main_view', $data);
		} catch (Exception $e) {
			$this->load->view('main_view', array('content_view' => 'errors/html/access_denied'));			
		}		
	}

}