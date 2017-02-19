<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student_presence extends CI_Controller {
    
    public function __construct() 
    {
        parent::__construct();
    }
    
    public function index() 
    {
        $data = array(
	        'content_view' => 'studentpresence/form'
		);        
		$this->load->view('main_view', $data);
    }
    
}

