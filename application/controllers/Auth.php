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
            $this->load->model('user_model');
            $username = $this->input->post('username');
            $user_info = $this->user_model->get_user_info_from_staff($username);
            if ($user_info == null) {
                $user_info = $this->user_model->get_user_info_from_siswa($username);
            }
            
            $this->session->set_userdata(array(
                    'logged_in' => TRUE,
                    'staff_id' => $user_info->id,
                    'role' => $user_info->peran,
                    'staff_name' => $user_info->nama
                ));
            //var_dump($this->session->userdata('staff_id'));    
           redirect('student_presence');
        }
    }

    public function end_session() 
    {
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('staff_id');           
        $this->session->unset_userdata('role');   
        $this->session->unset_userdata('staff_name');   
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