<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    private $username = 'admin';
    private $password = 'nothing';
    
    public function index() 
    {
        $this->load->helper('form');
        $this->load->view('logged_in');  
    }
    
    public function session() 
    {
        $this->load->helper(array('form', 'security'));
        $this->load->library(array('form_validation'));
        
        $this->form_validation->set_rules('username', 'Username', 'callback_check_username');
        $this->form_validation->set_rules('password', 'Password', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('logged_in');
        } else {
            $this->session->set_userdata(array(
                    'logged_in' => TRUE
                ));
            redirect('student');
        }
    }

    public function end_session() 
    {
        $this->session->unset_userdata('logged_in');   
        redirect('auth');
    }
    
    public function check_username() {
        $this->load->model('user_model');
        $userdata = $this->user_model->find_by_username($this->input->post('username'));
        $password = $this->input->post('password');
        
        if ($userdata == null) {
            $this->form_validation->set_message('check_username', 'Invalid {field}');
            return FALSE;
        } 
        
        if ($userdata->password != $password) {
            $this->form_validation->set_message('check_username', 'Username and Password doest match!');
            return FALSE;
        } 
        
        return TRUE;
    }
    
}