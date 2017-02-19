<?php


class User extends CI_Controller {
    
    public function __construct() 
    {
        parent::__construct();
    }
    
    public function index() 
    {
        $data = array(
	        'content_view' => 'user/view'
		);        
		$this->load->view('main_view', $data);
    }
    
    public function new_form() 
	{
		$this->load->view('main_view', array('content_view' => 'user/form'));			
	}
}