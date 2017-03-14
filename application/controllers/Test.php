<?php

class Test extends CI_Controller 
{
    public function __construct() 
    {
        parent::__construct();
    }
    
    public function index() 
    {
        $this->load->library('pdf');
        $this->pdf->load_view('welcome_message');
    }
    
}