<?php


class User extends CI_Controller {
    
    public function __construct() 
    {
        parent::__construct();
        $this->load->library('form_validation');	
        $this->load->model(array('user_model', 'staff_model'));
    }
    
    public function index() 
    {
        $data = array(
            'users' => $this->user_model->find_all(),
	        'content_view' => 'user/view'
		);        
		$this->load->view('main_view', $data);
    }
    
    public function new_form() 
	{
	    $data = array(
	        'staffs' => $this->staff_model->find_all(),
	        'content_view' => 'user/form'
	    );
		$this->load->view('main_view', $data);			
	}
	
	public function insert() 
	{
	    $this->form_validation->set_rules('username', 'Username', 'required');
	    $this->form_validation->set_rules('id_pengguna', 'Nama Staff', 'required');
	    $this->form_validation->set_rules('password', 'Password', 'required');
	    $this->form_validation->set_rules('peran', 'Peran', 'required');
	    $this->form_validation->set_rules('retype_password', 'Retype Password', 'required');
	    if ($this->form_validation->run() == TRUE) {
    	    $data = array(
    	        'id_pengguna' => $this->input->post('id_pengguna'),
    	        'username' => $this->input->post('username'),
    	        'password' => $this->input->post('password'),
    	        'peran' => $this->input->post('peran'),
    	        'status' => true,
    	    );    
    	    $this->user_model->insert($data);
    	    redirect('user/new_form');
	    } else {
    	    $data = array(
    	        'staffs' => $this->staff_model->find_all(),
    	        'content_view' => 'user/form'
    	    );
    		$this->load->view('main_view', $data);			
	    }
	}
	
	public function update() 
	{
	    
	}
	
	public function edit($id) 
	{
	    
	}
	

}