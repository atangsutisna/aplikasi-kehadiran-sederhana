<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student_Group extends CI_Controller {
    
    const MODULE_NAME = 'Kelas';    
    
    public function __construct() 
    {
        parent::__construct();
        if (!$this->session->has_userdata('logged_in')) {
        	$this->session->set_flashdata('not_authorize', 'Not Authorize');
        	redirect('auth');
        }
        
        $this->load->library('form_validation');
        $this->load->model(array('stdgroup_model', 'staff_model'));
    }
    
    public function index() 
    {
		try {
	    	if (!$this->role_manager->is_permitted(
						$this->session->userdata('role'), 
						Student_Group::MODULE_NAME,
						'read')) {
				throw new Exception("Access Denied");
			}   
	
	        $data = array(
	            'groups' => $this->stdgroup_model->find_all(),
		        'content_view' => 'studentgroup/view'
			);        
			$this->load->view('main_view', $data);
			$this->load->library('form_validation');	
			$this->load->model(array('staff_model', 'stdgroup_model', 'siswa_model'));	    
		} catch (Exception $e) {
			$this->load->view('main_view', array('content_view' => 'errors/html/access_denied'));			
		}
		
    }
    
    public function new_form() 
	{
		try {
	    	if (!$this->role_manager->is_permitted(
						$this->session->userdata('role'), 
						Student_Group::MODULE_NAME,
						'create')) {
				throw new Exception("Access Denied");
			}   

	        $data = array(
	            'staffs' => $this->staff_model->find_all(),
	            'groups' => $this->stdgroup_model->find_all(),
		        'content_view' => 'studentgroup/form'
			);        
			$this->load->view('main_view', $data);			
			
		} catch (Exception $e) {
			$this->load->view('main_view', array('content_view' => 'errors/html/access_denied'));			
		}

	}
	
	public function edit($id) 
	{
		try {
	    	if (!$this->role_manager->is_permitted(
						$this->session->userdata('role'), 
						Student_Group::MODULE_NAME,
						'update')) {
				throw new Exception("Access Denied");
			}   

	        
	        $data = array(
	            'staffs' => $this->staff_model->find_all(),
	            'group' => $this->stdgroup_model->find_one($id),
		        'content_view' => 'studentgroup/form'
			);        
			
			$this->load->view('main_view', $data);			
		} catch (Exception $e) {
			$this->load->view('main_view', array('content_view' => 'errors/html/access_denied'));			
		}
	}
	
    public function new_member($stdgroup_id) 
	{
		try {
	    	if (!$this->role_manager->is_permitted(
						$this->session->userdata('role'), 
						Student_Group::MODULE_NAME,
						'create')) {
				throw new Exception("Access Denied");
			}   

			$this->load->model('siswa_model');
			$data = array(
				'stdgroup_id' => $stdgroup_id,
				'students' => $this->siswa_model->find_all(),
				'group_members' => $this->stdgroup_model->find_member_by_group_id($stdgroup_id),
				'content_view' => 'studentgroup/form_member'
			);
			
			$this->load->view('main_view', $data);					
		} catch (Exception $e) {
			$this->load->view('main_view', array('content_view' => 'errors/html/access_denied'));			
		}
	}
	
	public function insert_new_member() 
	{
		try {
	    	if (!$this->role_manager->is_permitted(
						$this->session->userdata('role'), 
						Student_Group::MODULE_NAME,
						'create')) {
				throw new Exception("Access Denied");
			}   

			//pindahin ke atas
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
		} catch (Exception $e) {
			$this->load->view('main_view', array('content_view' => 'errors/html/access_denied'));			
		}
	}
	
	public function delete_member($stdgroup_id, $member_id) 
	{
		
		try {
	    	if (!$this->role_manager->is_permitted(
						$this->session->userdata('role'), 
						Student_Group::MODULE_NAME,
						'delete')) {
				throw new Exception("Access Denied");
			}   

		
			$this->session->set_flashdata('notif', 'Data sudah dihapus');
			$this->stdgroup_model->delete_member($member_id);
			redirect('student_group/new_member/'. $stdgroup_id);		
		} catch (Exception $e) {
			$this->load->view('main_view', array('content_view' => 'errors/html/access_denied'));			
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
		
		try {
	    	if (!$this->role_manager->is_permitted(
						$this->session->userdata('role'), 
						Student_Group::MODULE_NAME,
						'create')) {
				throw new Exception("Access Denied");
			}   

			//pindahin ke atas
			$this->form_validation->set_rules('nama_kelas', 'Nama Kelas', 'required');	
			$this->form_validation->set_rules('tahun_ajaran', 'Tahun Ajaran', 'required');
			if ($this->form_validation->run() == TRUE) {
				$data = array(
					'nama_kelas' => $this->input->post('nama_kelas'),
					'tahun_ajaran' => $this->input->post('tahun_ajaran'),
					'id_wali_kelas' => $this->input->post('id_wali_kelas')
				);
				$this->stdgroup_model->insert($data);
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
		} catch (Exception $e) {
			$this->load->view('main_view', array('content_view' => 'errors/html/access_denied'));			
		}
	}
	
    public function update() 
	{
		try {
	    	if (!$this->role_manager->is_permitted(
						$this->session->userdata('role'), 
						Student_Group::MODULE_NAME,
						'update')) {
				throw new Exception("Access Denied");
			}   

			//pindahin ke atas
			$this->form_validation->set_rules('nama_kelas', 'Nama Kelas', 'required');	
			$this->form_validation->set_rules('tahun_ajaran', 'Tahun Ajaran', 'required');
			if ($this->form_validation->run() == TRUE) {
				$data = array(
					'nama_kelas' => $this->input->post('nama_kelas'),
					'tahun_ajaran' => $this->input->post('tahun_ajaran'),
					'id_wali_kelas' => $this->input->post('id_wali_kelas')
				);
				$id = $this->input->post('id');
				$this->stdgroup_model->update($id, $data);
				$this->session->set_flashdata('notif', 'Data sudah disimpan');
				redirect('student_group/edit/'. $id);
			} else {
	            $data = array(
	                'staffs' => $this->staff_model->find_all(),
	                'groups' => $this->stdgroup_model->find_all(),
	    	        'content_view' => 'studentgroup/form'
	    		);        
	    		$this->load->view('main_view', $data);
			}
		} catch (Exception $e) {
			$this->load->view('main_view', array('content_view' => 'errors/html/access_denied'));			
		}
	}
	

}