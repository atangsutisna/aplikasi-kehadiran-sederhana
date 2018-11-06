<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Authlib extends CI_Controller 
{
    public function index()
    {
        $this->load->library('unit_test');
        $this->load->library('auth', [
            'username' => 'admin',
            'password' => 'admin'
        ]);
        
        $result = $this->auth->is_authenticated();
        $expected = TRUE;
        echo $this->unit->run($result, $expected, 'should match');
    }
}