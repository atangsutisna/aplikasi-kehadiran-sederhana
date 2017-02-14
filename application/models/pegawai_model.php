<?php
class pegawai_model extends CI_Model{ 

	function pegawai_model()
	{
		parent::__construct();
	}
	 
	/* GET DAT APEGAWAI */
		function cekNikPegawai(){
			$nik=$this->input->post('nik');
			$query=$this->db->query("select nik from pegawai where nik='$nik'");
			return $query->num_rows();
		}
		function cekMasuk(){
			$nik=$this->input->post('nik');
			$datenow=date("Y-m-d");
			$jammasuk="";
			$ceknik=$this->cekNikPegawai();
			if($ceknik==0){
				echo'<hr><label style="font-size:40px;font-family:calibri">NIK TIDAK TERSEDIA </label>';
				return false;
			}
			$query=$this->db->query("select nik,jammasuk from absensi where nik='$nik' and tanggal='$datenow' and kodeabsensi='1'");
			if ($query->num_rows() > 0){
				foreach ($query->result() as $data) {
					$jammasuk=$data->jammasuk;
				}
				echo'<hr><label style="font-size:40px;font-family:calibri">Anda Sudah Melakukan Abssnsi Kedatangan Pada Pukul :</label>';
				echo'<label style="color:red;font-size:50px;font-family:calibri"><br>'.$jammasuk.' !!! </label><a href="#" class="more"></a>';
				return false;
			}	 else {
				 $data=array(
				 'nik'=>$nik,
				 'kodeabsensi'=>'1',
				 'jammasuk'=>date("H:i:s"),
				 'tanggal'=>$datenow
				);
				$this->db->trans_start();
				$this->db->insert('absensi',$data);
				$this->db->trans_complete(); 
				echo'<hr><label style="font-size:40px;font-family:calibri">Sukses Melakukan Absensi Kedatangan Pada Pukul:</label><br>';
				echo'<label style="color:green;font-size:50px;font-family:calibri"><br>'.date("H:i:s").'</label>';
			}
		}
		function cekdatang(){
			$nik=$this->input->post('nik');
			$query=$this->db->query("select nik from pegawai where nik='$nik' and  kodeabsensi='1'");
			return $query->num_rows();
		}
		function cekPulang(){
			$nik=$this->input->post('nik');
			$datenow=date("Y-m-d");
			$jammasuk="";
			$ceknik=$this->cekNikPegawai();
			if($ceknik==0){
				echo'<hr><label style="font-size:40px;font-family:calibri">NIK TIDAK TERSEDIA </label>';
				return false;
			}
			$query=$this->db->query("select nik,jammasuk from absensi where nik='$nik' and tanggal='$datenow' and kodeabsensi='2'");
			if ($query->num_rows() > 0){
				foreach ($query->result() as $data) {
					$jammasuk=$data->jammasuk;
				}
				echo'<hr><label style="font-size:40px;font-family:calibri">Anda Sudah Melakukan Absensi Kepulangan Pada Pukul :</label>';
				echo'<label style="color:red;font-size:50px;font-family:calibri"><br>'.$jammasuk.'</label>';
				return false;
			}	 else {
				 $data=array(
				 'nik'=>$nik,
				 'kodeabsensi'=>'2',
				 'jammasuk'=>date("H:i:s"),
				 'tanggal'=>$datenow
				);
				$this->db->trans_start();
				$this->db->insert('absensi',$data);
				$this->db->trans_complete(); 
				echo'<hr><label style="font-size:40px;font-family:calibri">Sukses Melakukan Absensi Kepulangan Pada Pukul:</label><br>';
				echo'<label style="color:green;font-size:50px;font-family:calibri"><br>'.date("H:i:s").'</label>';
			}
		}
		
		function getListpegawai($limit='',$offset=''){
			$query=$this->db->query("select *,pegawai.nama from absensi left join pegawai on absensi.nik=pegawai.nik
			 LIMIT $limit,$offset
			");
			 if ($query->num_rows() > 0) {
				foreach ($query->result() as $data) {
					$menus[]=$data;
				}
				return $menus;
			}
		}
		function count(){
			$query=$this->db->query("select count(1) as jumlah from absensi");
			 if ($query->num_rows() > 0) {
				foreach ($query->result() as $data) {
					$menus=$data->jumlah;
				}
				return $menus;
			}
		}

	/* --- */
	function count_cuti($id=''){
		$jumlah='';
		$status=$this->session->userdata('STATUS');
		$addTag="";
		if($status!=0){
		$addTag="where t_cuti.nik='".$this->session->userdata('NIK')."'";	
		}		
		$query=$this->db->query("select count(1) as jumlah from t_cuti $addTag");
			 if ($query->num_rows() > 0) {
				foreach ($query->result() as $data) {
				$jumlah=$data->jumlah;
				}
				return $jumlah;
			}
	}
	 

}
// END RiskIssue_model Class

/* End of file RiskIssue_model.php */
/* Location: ./application/models/RiskIssue_model.php */
?>