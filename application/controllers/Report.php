<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {
    const MODULE_NAME = 'Laporan';   
    
    public function __construct() 
    {
        parent::__construct();
        /**
        if (!$this->session->has_userdata('logged_in')) {
        	$this->session->set_flashdata('not_authorize', 'Not Authorize');
        	redirect('auth');
        }**/
        
        $this->load->model(array('presence_model'));
        $this->load->library('Mypdfcrowd');
    }
    
    public function index() 
    {
        $this->load->view('main_view', array(
            'content_view' => 'report/index'
        ));
    }
    
    public function student() 
    {
        $month = $this->input->post('month');
        $year = $this->input->post('year');

        $data['content_view'] = 'report/student';
        $data['students'] = [];
        if (isset($month) && isset($year)) {
            if ($month < 10) {
                $yearmonth = $year.'0'.$month;
            } else {
                $yearmonth = $year.$month;                
            }
            $data['students'] = $this->presence_model->show_student_report_by_yearmonth($yearmonth);
            $data['month'] = $month;
            $data['year'] = $year;
        }

        $this->load->view('main_view', $data);        
    }

    public function staff() 
    {
        $this->load->view('main_view', array(
            'staffs' => $this->presence_model->show_staff_report_by_month(2),
            'content_view' => 'report/staff'
        ));
    }
    
    public function print_pdf_student_report()
    {
        try {
            $month = $this->input->post('month');
            $year = $this->input->post('year');
            $yearmonth;
            if ($month < 10) {
                $yearmonth = $year.'0'.$month;
            } else {
                $yearmonth = $year.$month;                
            }
            
            // create an API client instance
            $client = new Pdfcrowd("atang", "e2a89092c8b140255a6521f87ce51407");
            // convert a web page and store the generated PDF into a $pdf variable
            $pdf = $client->convertURI(base_url(). 'index.php/report/student_report_pdf_template/'. $yearmonth);
            // set HTTP response headers
            header("Content-Type: application/pdf");
            header("Cache-Control: max-age=0");
            header("Accept-Ranges: none");
            header("Content-Disposition: attachment; filename=\"student_presence_report.pdf\"");
            // send the generated PDF 
            echo $pdf;            
        } catch (PdfcrowdException $why) {
            echo "Pdfcrowd Error: " . $why;
        }
    }
    
    public function student_report_pdf_template($yearmonth) 
    {
        $this->load->view('report/student_table', array(
            'current_date' => date('d/m/Y'),
            'students' => $this->presence_model->show_student_report_by_yearmonth($yearmonth)
        )); 
    }
    
    public function staff_report() 
    {
        $this->load->view('report/staff_table', array(
            'current_date' => date('d/m/Y'),
            'staffs' => $this->presence_model->show_staff_report_by_date(date('Y/m/d')),
        ));        
    }

    public function staff_report_pdf()
    {
        try {
            // create an API client instance
            $client = new Pdfcrowd("atang", "e2a89092c8b140255a6521f87ce51407");
            // convert a web page and store the generated PDF into a $pdf variable
            $pdf = $client->convertURI(base_url(). 'index.php/report/staff_report');
            // set HTTP response headers
            header("Content-Type: application/pdf");
            header("Cache-Control: max-age=0");
            header("Accept-Ranges: none");
            header("Content-Disposition: attachment; filename=\"student_presence_report.pdf\"");
            // send the generated PDF 
            echo $pdf;            
        } catch (PdfcrowdException $why) {
            echo "Pdfcrowd Error: " . $why;
        }
    }

}