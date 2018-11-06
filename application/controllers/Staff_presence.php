<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Staff_presence extends CI_Controller {
    
    const MODULE_NAME = 'Absensi Staff';   
    
    public function __construct() 
    {
        parent::__construct();
        if (!$this->session->has_userdata('logged_in')) {
        	$this->session->set_flashdata('not_authorize', 'Not Authorize');
        	redirect('auth');
        }
        
        $this->load->model(array('presence_model', 'staff_model'));
    }
    
    public function index() 
    {
        try {
	    	$user = $this->role_manager->has_role(
	    				$this->session->userdata('role'), 
	    				Staff_presence::MODULE_NAME
	    			);
	        if ($user->read_action == 0) {
	        	throw new Exception("Access Denied");
	        }   
	        //code here
            $data = array(
    	        'content_view' => 'staffpresence/form',
    	        'staffs' => $this->presence_model->find_all_staff_by_date(date('Y/m/d')),
    		);        
    		
    		$this->load->view('main_view', $data);
    		
        } catch (Exception $e) {
            $this->load->view('main_view', array('content_view' => 'errors/html/access_denied'));		
        }
    }    
    
    public function insert() 
    {
        try {
	    	$user = $this->role_model->has_role(
	    				$this->session->userdata('role'), 
	    				Staff_presence::MODULE_NAME
	    			);
	        if ($user->read_action == 0) {
	        	throw new Exception("Access Denied");
	        }   
	        //code here
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
            
            redirect('staff_presence/view_current_date');	        
        } catch (Exception $e) {
            $this->load->view('main_view', array('content_view' => 'errors/html/access_denied'));		
        }
    }    
    
    public function view_current_date() 
    {
        $count_hadir = 0;
        $count_alpa = 0;
        $count_sakit = 0;
        $count_ijin = 0;
        $group_members = $this->presence_model->view_all_by_date(date('Y-m-d'));
        foreach ($group_members as $value) {
            if ($value->keterangan == 'HADIR') {
                $count_hadir++;
            }
            if ($value->keterangan == 'ALPA') {
                $count_alpa++;
            }
            if ($value->keterangan == 'SAKIT') {
                $count_sakit++;
            }
            if ($value->keterangan == 'IJIN') {
                $count_ijin++;
            }
        }
        
        $data = array(
            'count_hadir' => $count_hadir,
            'count_alpa' => $count_alpa,
            'count_sakit' => $count_sakit,
            'count_ijin' => $count_ijin,
            'group_members' => $group_members,
            'content_view' => 'staffpresence/view'
        );
        
        $this->load->view('main_view', $data);        
    }
    
}