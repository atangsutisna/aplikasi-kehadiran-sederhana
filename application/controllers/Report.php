<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {
    const MODULE_NAME = 'Laporan';   
    
    public function __construct() 
    {
        parent::__construct();
        if (!$this->session->has_userdata('logged_in')) {
        	$this->session->set_flashdata('not_authorize', 'Not Authorize');
        	redirect('auth');
        }
        
        $this->load->model(array('presence_model'));
    }
    
    public function index() 
    {
        $this->load->view('main_view', array(
            'content_view' => 'report/index'
        ));
    }
    
    public function student() 
    {
        
        $this->load->view('main_view', array(
            'students' => $this->presence_model->show_student_report_by_date(date('Y/m/d')),
            'content_view' => 'report/student'
        ));        
    }
    
    public function staff() 
    {
        $this->load->view('main_view', array(
            'staffs' => $this->presence_model->show_staff_report_by_date(date('Y/m/d')),
            'content_view' => 'report/staff'
        ));        
    }

}