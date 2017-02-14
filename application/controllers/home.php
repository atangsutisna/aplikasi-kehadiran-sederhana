<?php  

class home extends CI_Controller {
 
	var $limit=10;
	var $offset=10;	
	function index($limit='',$offset=''){		 
		$this->load->model("pegawai_model");  
		$data['judul']='';
		$data['view']='masuk';
		$data['pegawai']='masuk';
		$this->load->view('index',$data);  
	}
	function pulang($limit='',$offset=''){		 
		$this->load->model("pegawai_model");  
		$data['judul']='';
		$data['view']='pulang';
		$data['pegawai']='pulang';
		$this->load->view('index',$data);  
	}
	
	function cekMasuk(){
		$this->load->model("pegawai_model"); 
		$this->pegawai_model->cekMasuk();
	}
	function cekPulang(){
		$this->load->model("pegawai_model"); 
		$this->pegawai_model->cekPulang();
	}
	function listabsen($limit='',$offset=''){
	 
		$this->load->model("pegawai_model"); 
		$data['judul']='Histori Absensi Pegawai';
		/* VAGINATION */
		if($limit==''){ $limit = 0; $offset=10 ;}
		if($limit!=''){ $limit = $limit ; $offset=$this->offset ;}
		$data['count']=$this->pegawai_model->count();	
		$config['base_url'] = base_url().'home/search/';
		$config['total_rows'] = $data['count'];
		$config['per_page'] = $this->limit;    
		$config['cur_tag_open'] = '<span class="pg">';
		$config['cur_tag_close'] = '</span>';		
		$this->pagination->initialize($config);
		/*----------------*/
		$data['query']=$this->pegawai_model->getListpegawai($limit,$offset);
		$data['view']='hist_absen';
		$this->load->view('index',$data);
		 
	}
	 function search($limit='',$offset=''){
	 	$this->load->model("pegawai_model"); 
		/* VAGINATION */
		if($limit==''){ $limit = 0; $offset=10 ;}
		if($limit!=''){ $limit = $limit ; $offset=$this->offset ;}
		$data['count']=$this->pegawai_model->count();	
		$config['base_url'] = base_url().'home/search/';
		$config['total_rows'] = $data['count'];
		$config['per_page'] = $this->limit;    
		$config['cur_tag_open'] = '<span class="pg">';
		$config['cur_tag_close'] = '</span>';		
		$this->pagination->initialize($config);
		/*----------------*/
 
		$data['query']=$this->pegawai_model->getListpegawai($limit,$offset);
		$this->load->view('hist_absen',$data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */