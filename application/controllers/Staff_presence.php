<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Staff_presence extends CI_Controller {
    
    public function __construct() 
    {
        parent::__construct();
        $this->load->model(array('presence_model', 'staff_model'));
    }
    
    public function index() 
    {
        $data = array(
	        'content_view' => 'staffpresence/form',
	        'staffs' => $this->presence_model->find_all_staff_by_date(date('Y/m/d')),
		);        
		
		$this->load->view('main_view', $data);
    }    
    
    public function insert() 
    {
        $this->load->model('presence_model');
        $postData = $this->input->post('keterangan');
        $data = array();
        $staff_ids = [];
        foreach($postData as $idx => $value) {
            $staff_ids[] = $idx;
            $row = array(
                'id_staff' => $idx,
                'keterangan' => $value,
                'id_operator' => $this->session->userdata('staff_id'),
                'tanggal' => date('Y/m/d')
            );
            
            $data[] = $row;
        }
        
        $prensece = $this->presence_model->check_by_date_and_staffids(date('Y/m/d'), $staff_ids);
        if ($prensece->is_present == 1) {
            $presence_ids = $this->input->post('id_kehadiran');   
            $update_data = array();
            foreach ($presence_ids as $idx => $value) {
                foreach ($data as $row_idx => $row) {
                    //echo $row['id_staff']. ' '. $idx. '<br>';
                    if ($row['id_staff'] == $idx) {
                        //echo 'is equal <br/>';
                        $row['id'] = $value;
                        $update_data[] = $row;
                    }
                }
            }

            $this->session->set_flashdata('notif', 'Data sudah diubah');
            $this->presence_model->update_batch_table('kehadiran_staff', $update_data);
        } else {
            $this->session->set_flashdata('notif', 'Data sudah disimpan');
            $this->presence_model->insert_batch_into('kehadiran_staff', $data);    
        }
        
        redirect('staff_presence');
    }    
    
}