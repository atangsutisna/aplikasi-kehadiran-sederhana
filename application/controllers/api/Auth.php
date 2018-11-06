<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function start_session()
    {
        $response = array(
            'message' => 'Loggin success'
        );
        $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode($response));
    }

    public function end_session() 
    {
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('staff_id');           
        $this->session->unset_userdata('role');   
        $this->session->unset_userdata('staff_name');   
        redirect('auth');
    }

}