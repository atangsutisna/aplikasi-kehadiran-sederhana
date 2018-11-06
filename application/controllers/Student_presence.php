<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student_presence extends CI_Controller {
    
    const MODULE_NAME = 'Absensi Siswa';   
    
    public function __construct() 
    {
        parent::__construct();
        if (!$this->session->has_userdata('logged_in') || 
            !$this->session->has_userdata('staff_id')) {
        	$this->session->set_flashdata('not_authorize', 'Not Authorize or session was close');
        	redirect('auth');
        }
        
        $this->load->model('stdgroup_model');
    }
    
    public function index() 
    {
        try {
	    	if (!$this->role_manager->is_permitted(
	    				$this->session->userdata('role'), 
                        Student_presence::MODULE_NAME,
                        'read'
	    			)) {
                throw new Exception("Access Denied");
            }
	
            $data = array(
                'tahun_ajaran' => $this->stdgroup_model->find_all_tahun_ajaran(),
    	        'content_view' => 'studentpresence/form',
    	        'group_members' => [],
    		);        
    		
    		$this->load->view('main_view', $data);
        } catch (Exception $e) {
			$this->load->view('main_view', array('content_view' => 'errors/html/access_denied'));			            
        }
        
    }
    
    public function show_group() 
    {
        try {
	    	$user = $this->role_model->has_role(
	    				$this->session->userdata('role'), 
	    				Student_presence::MODULE_NAME
	    			);
	        if ($user->read_action == 0) {
	        	throw new Exception("Access Denied");
	        }    		
	        //code move here
	        
            $post_tahun_ajaran = $this->input->post('tahun_ajaran');
            $data = array(
                'stdgroup' => $this->stdgroup_model->find_by_tahun_ajaran($post_tahun_ajaran),
                'tahun_ajaran' => $this->stdgroup_model->find_all_tahun_ajaran(),
                'group_members' => [],
    	        'content_view' => 'studentpresence/form'
    		);        
    		
    		$this->load->view('main_view', $data);	        
        } catch (Exception $e) {
			$this->load->view('main_view', array('content_view' => 'errors/html/access_denied'));			            
        }
    }
    
    public function new_presence() 
    {
        try {
	    	$user = $this->role_model->has_role(
	    				$this->session->userdata('role'), 
	    				Student_presence::MODULE_NAME
	    			);
	        if ($user->create_action == 0) {
	        	throw new Exception("Access Denied");
	        }    		
	        //code move here
            $post_tahun_ajaran = $this->input->post('tahun_ajaran');
            $post_id_kelas = $this->input->post('id_kelas');
            
            $this->load->model('presence_model');
            $data = array(
                'group_name' => $this->stdgroup_model->find_one($post_id_kelas),
                'stdgroup' => $this->stdgroup_model->find_by_tahun_ajaran($post_tahun_ajaran),
                'tahun_ajaran' => $this->stdgroup_model->find_all_tahun_ajaran(),
                'group_members' => $this->presence_model->find_all_by_group_and_date($post_id_kelas, date('Y/m/d')),
    	        'content_view' => 'studentpresence/form'
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
	    				Student_presence::MODULE_NAME
	    			);
	        if ($user->create_action == 0) {
	        	throw new Exception("Access Denied");
	        }    		
	        //code move here
            $this->load->model('presence_model');
            $postData = $this->input->post('keterangan');
            $data = array();
            $studentIds = [];
            foreach($postData as $idx => $value) {
                $studentIds[] = $idx;
                $row = array(
                    'id_siswa' => $idx,
                    'keterangan' => $value,
                    'id_operator' => $this->session->userdata('staff_id'),
                    'tanggal' => date('Y/m/d')
                );
                
                $data[] = $row;
            }
            
            $prensece = $this->presence_model->check_by_date_and_stundentids(date('Y/m/d'), $studentIds);
            if ($prensece != NULL && $prensece->is_present == 1) {
                $presence_ids = $this->input->post('id_kehadiran');   
                $update_data = array();
                foreach ($presence_ids as $idx => $value) {
                    foreach ($data as $row_idx => $row) {
                        //echo $row['id_siswa']. ' '. $idx. '<br>';
                        if ($row['id_siswa'] == $idx) {
                            //echo 'is equal <br/>';
                            $row['id'] = $value;
                            $update_data[] = $row;
                        }
                    }
                }
                
                
                $this->session->set_flashdata('notif', 'Data sudah diubah');
                $this->presence_model->update_batch_table('kehadiran_siswa', $update_data);
            } else {
                $this->session->set_flashdata('notif', 'Data sudah disimpan');
                $this->presence_model->insert_batch_into('kehadiran_siswa', $data);    
            }
            
            $group_id = $this->input->post('id_kelas');
            redirect('student_presence/view/'. $group_id);	        
        } catch (Exception $e) {
			$this->load->view('main_view', array('content_view' => 'errors/html/access_denied'));			            
        }
        
    }
    
    public function view($group_id) 
    {
        //code move here
        $this->load->model('presence_model');
        // cara ini jelek, bisa langsung pake query
        $count_hadir = 0;
        $count_alpa = 0;
        $count_sakit = 0;
        $count_ijin = 0;
        $group_members = $this->presence_model->find_all_by_group_and_date($group_id, date('Y-m-d'));
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
            'content_view' => 'studentpresence/view'
        );
        $this->load->view('main_view', $data);
    }
    
}

