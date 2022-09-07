<?php

class Test extends CI_Controller 
{
    public function __construct() 
    {
        parent::__construct();
    }
    
    public function index() 
    {
        //$this->load->library('pdf');
        //$this->pdf->load_view('welcome_message');
        /**$this->load->model('User_model', 'user_model');
        $users = $this->user_model->find_all();
        $hashed_password = password_hash('password', PASSWORD_DEFAULT);
        foreach ($users as $user) {
            $this->user_model->update($user->id_pengguna, [
                'password' => $hashed_password
            ]);
        }
        echo "done"**/;
    }
    
}