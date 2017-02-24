<?php


class User extends CI_Controller {
    
    const MODULE_NAME = 'Pengguna';
    
    public function __construct() 
    {
        parent::__construct();
        $this->load->library('form_validation');	
        $this->load->model(array('user_model', 'staff_model'));
    }
    
    public function index() 
    {
    	try {
	    	$user = $this->role_model->has_role(
	    				$this->session->userdata('role'), 
	    				USER::MODULE_NAME
	    			);
	        if ($user->read_action == 0) {
	        	throw new Exception("Access Denied");
	        }    		
			$data = array(
	            'users' => $this->user_model->find_all(),
		        'content_view' => 'user/view'
			);        
			
			$this->load->view('main_view', $data);	        
    	} catch(Exception $e) {
			$this->load->view('main_view', array('content_view' => 'errors/html/access_denied'));
    	}
    }
    
    public function new_form() 
	{
		try {
	    	$user = $this->role_model->has_role(
	    				$this->session->userdata('role'), 
	    				USER::MODULE_NAME
	    			);
	        if ($user == null || $user->create_action == 0) {
	        	throw new Exception("Access Denied");
	        }  
	        
	        $query = $this->db->query("
	        	SELECT id, nama FROM staff WHERE status = 'AKTIF'
	        	UNION
	        	SELECT id, nama_lengkap AS nama FROM siswa
	        ");
	        
		    $data = array(
		        'users' => $query->result(),
		        'content_view' => 'user/form'
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
	    				USER::MODULE_NAME
	    			);
	        if ($user == null || $user->create_action == 0) {
	        	throw new Exception("Access Denied");
	        }  
		
		    $this->form_validation->set_rules('username', 'Username', 'required|callback_check_username');
		    $this->form_validation->set_rules('id_pengguna', 'Nama Staff', 'required');
		    $this->form_validation->set_rules('password', 'Password', 'required');
		    $this->form_validation->set_rules('peran', 'Peran', 'required');
		    $this->form_validation->set_rules('retype_password', 'Retype Password', 'required|callback_check_password_equal');
		    if ($this->form_validation->run() == TRUE) {
	    	    $data = array(
	    	        'id_pengguna' => $this->input->post('id_pengguna'),
	    	        'username' => $this->input->post('username'),
	    	        'password' => $this->input->post('password'),
	    	        'peran' => $this->input->post('peran'),
	    	        'status' => true,
	    	    );    
	    	    $this->user_model->insert($data);
	    	    redirect('user/new_form');
		    } else {
	    	    $data = array(
	    	        'staffs' => $this->staff_model->find_all(),
	    	        'content_view' => 'user/form'
	    	    );
	    		$this->load->view('main_view', $data);			
		    }
		    
		} catch (Exception $e) {
			$this->load->view('main_view', array('content_view' => 'errors/html/access_denied'));
		}
	}
	
	public function check_username($username) 
	{
		$result = $this->user_model->check_username($username);
		if ($result->is_present) {
			$this->form_validation->set_message('check_username', 'Duplicate {field}');
			return FALSE;
		} else {
			return TRUE;
		}
	}

	public function check_password_equal()
	{
	    $password = $this->input->post('password');
	    $retype_password = $this->input->post('retype_password');
	    if ($password != $retype_password) {
	        $this->form_validation->set_message('check_password_equal', '{field} is not equal with password');
	        return FALSE;
	    } else {
	        return TRUE;
	    }
	}
	
	public function update() 
	{
	    /**
	    $this->form_validation->set_rules('username', 'Username', 'required');
	    $this->form_validation->set_rules('id_pengguna', 'Nama Staff', 'required');
	    $this->form_validation->set_rules('peran', 'Peran', 'required');
	    
	    
	    if ($this->form_validation->run() == TRUE) {
    	    $data = array(
    	        'id_pengguna' => $this->input->post('id_pengguna'),
    	        'peran' => $this->input->post('peran'),
    	    );    
    	    $username = $this->input->post('username');
    	    $this->user_model->update($username, $data);
    	    redirect('user/new_form');
	    } else {
	        $id = $this->input->post('id_pengguna');
    	    $data = array(
    	        'user' => $this->user_model->find_one($id),
    	        'staffs' => $this->staff_model->find_all(),
    	        'content_view' => 'user/form'
    	    );
    		$this->load->view('main_view', $data);			
	    } **/
	    echo "Maaf, fasilistas ini masih dalam tahap Delevelopment";
	}
	
	public function edit($id) 
	{
		try {
	    	$user = $this->role_model->has_role(
	    				$this->session->userdata('role'), 
	    				USER::MODULE_NAME
	    			);
	        if ($user == null || $user->update_action == 0) {
	        	throw new Exception("Access Denied");
	        }  

	        $query = $this->db->query("
	        	SELECT id, nama FROM staff WHERE status = 'AKTIF'
	        	UNION
	        	SELECT id, nama_lengkap AS nama FROM siswa
	        ");
			
		    $data = array(
		        'user' => $this->user_model->find_one($id),
		        'users' => $query->result(),
		        'content_view' => 'user/form'
		    );
			$this->load->view('main_view', $data);			
		} catch (Exception $e) {
			$this->load->view('main_view', array('content_view' => 'errors/html/access_denied'));
		}
	}
	

}