<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth {
    private $CI;
    private $username;
    private $password;
    private $subject = NULL;

    private $errors = [];

    public function __construct($params)
    {
        $this->CI =& get_instance();
        $this->username = $params['username'];
        $this->password = $params['password'];
    }

    public function is_authenticated()
    {
        $this->CI->load->model('user_model');
        $userdata = $this->CI->user_model->find_by_username($this->username);
        
        if ($userdata == NULL) {
            $this->errors['username'] = "Cannot find username {$this->username}";
            return FALSE;
        } 
        
        if ($userdata->password != $this->password) {
            $this->errors['username'] = "Username password doest match";
            return FALSE;
        } 

        $user_info = $this->CI->user_model->get_user_info_from_staff($this->username);
        if ($user_info == NULL) {
            $user_info = $this->CI->user_model->get_user_info_from_siswa($this->username);
        }

        $this->subject = array(
            'logged_in' => TRUE,
            'staff_id' => $user_info->id,
            'role' => $user_info->peran,
            'staff_name' => $user_info->nama
        );

        return TRUE;
    }

    public function get_errors()
    {
        return $this->errors;
    }

    public function get_subject()
    {
        return $this->errors;
    }


}