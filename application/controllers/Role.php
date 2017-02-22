<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Role extends CI_Controller {
    
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
		$data = array(
	        'content_view' => 'role/view'
	    );
		$this->load->view('main_view', $data);
	}
	
	
	public function edit($role_name) 
	{
	    if (!isset($role_name)) {
	        show_404();
	    }
	    
	    $roles = $this->role_model->find_all_by_role($role_name);
		$data = array(
		    'roles' => $this->role_model->find_all_by_role($role_name),
	        'content_view' => 'role/form'
	    );
		$this->load->view('main_view', $data);	    
	}
    
}