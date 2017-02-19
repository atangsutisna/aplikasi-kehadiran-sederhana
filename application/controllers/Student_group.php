<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student_Group extends CI_Controller {
    
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('stdgroup_model');
    }
    
    public function index() 
    {
        $data = array(
            'groups' => $this->stdgroup_model->find_all(),
	        'content_view' => 'studentgroup/view'
		);        
		$this->load->view('main_view', $data);
    }
    
    public function new_form() 
	{
        $this->load->model('staff_model');	    
        $data = array(
            'staffs' => $this->staff_model->find_all(),
            'groups' => $this->stdgroup_model->find_all(),
	        'content_view' => 'studentgroup/form'
		);        
		$this->load->view('main_view', $data);			
	}

    public function new_member() 
	{
		$this->load->view('main_view', array('content_view' => 'studentgroup/form_member'));			
	}

    
}