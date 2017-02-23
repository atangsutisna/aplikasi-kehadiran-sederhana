<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Role extends CI_Controller {
    
    const MODULE_NAME = 'Hak Akses';   
    
    public function __construct() 
    {
        parent::__construct();
        if (!$this->session->has_userdata('logged_in')) {
        	$this->session->set_flashdata('not_authorize', 'Not Authorize');
        	redirect('auth');
        }
        $this->load->model(array('role_model'));
    }
    
    public function index()
	{
		try {
	    	$user = $this->role_model->has_role(
	    				$this->session->userdata('role'), 
	    				Role::MODULE_NAME
	    			);
	    	
	        if ($user->read_action == 0) {
	        	throw new Exception("Access Denied");
	        }   
	        //code here
			$data = array(
		        'content_view' => 'role/view'
		    );
			$this->load->view('main_view', $data);
		} catch (Exception $e) {
            $this->load->view('main_view', array('content_view' => 'errors/html/access_denied'));					
		}
	}
	
	
	public function edit($role_name) 
	{
	    if (!isset($role_name)) {
	        show_404();
	    }
	 
		try {
	    	$user = $this->role_model->has_role(
	    				$this->session->userdata('role'), 
	    				Role::MODULE_NAME
	    			);
	        if ($user->update_action == 0) {
	        	throw new Exception("Access Denied");
	        }   
	        //code here
		    $roles = $this->role_model->find_all_by_role($role_name);
			$data = array(
			    'role_name' => $role_name,
			    'roles' => $this->role_model->find_all_by_role($role_name),
		        'content_view' => 'role/form'
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
	    				Role::MODULE_NAME
	    			);
	        if ($user->update_action == 0) {
	        	throw new Exception("Access Denied");
	        }   
	        //code here
		    $role_name = $this->input->post('role_name');
		    if ($role_name = 'ADMINISTRATOR') {
		        $this->session->set_flashdata('notif', 'ROLE ADMINISTRATOR tidak dapat diubah');    
		    } else {
	    	    $create_actions = $this->input->post('create_action') == NULL ? array() : $this->input->post('create_action');
	    	    $read_actions = $this->input->post('read_action') == NULL ? array() : $this->input->post('read_action');
	    	    $update_actions = $this->input->post('update_action') == NULL ? array() : $this->input->post('update_action');
	    	    $delete_actions = $this->input->post('delete_action') == NULL ? array() : $this->input->post('delete_action');
	    	    
	    	    $role_name = $this->input->post('role_name');
	    	    $roles = $this->role_model->find_all_by_role($role_name);
	    	    foreach ($roles as $role) {
	    	        $role->create_action = !array_key_exists($role->module_id, $create_actions) ? FALSE : TRUE;
	    	        $role->read_action = !array_key_exists($role->module_id, $read_actions) ? FALSE : TRUE;
	    	        $role->update_action = !array_key_exists($role->module_id, $update_actions) ? FALSE : TRUE;
	    	        $role->delete_action = !array_key_exists($role->module_id, $delete_actions) ? FALSE : TRUE;
	    	    }
	    	    
	    	    $this->role_model->update_batch($roles);
	    	    $this->session->set_flashdata('notif', 'Data sudah diubah');
		    }
		    
		    redirect('role');	        
		} catch (Exception $e) {
            $this->load->view('main_view', array('content_view' => 'errors/html/access_denied'));					
		}
	}
}