<?php
if(!defined('BASEPATH'))exit('No direct script access allowed');

class Login_model extends CI_Model {

	public function __construct(){
		parent::__construct();
		$this->load->database('default',true);
		$this->load->library('Jquery_validation');
		$this->load->database();
	}

	public function cek_user(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$sql = "SELECT * FROM tbuser WHERE NipUser = ? limit 1";
		$query = $this->db->query($sql,array($username));
		$hash = $query->result_array();
		if(password_verify($password, $hash['0']['Password'])){
			if ($query->num_rows() === 1){
				$data = $query->row();
				$this->userdata($data->IdUser);
				return TRUE;
			} else {
				return FALSE;
			}
		} else {
			return FALSE;
		}
		
	}

	public function userdata($id = null){
		$query = $this->db
		->where('IdUser',$id)
		->limit(1)
		->get('tbuser_detail');

		if ($query->num_rows() === 1){
			$data = $query->row();
			$hanggar = $this->db->where('IdPegawai',$id)->limit(1)->get('tb_petugas_hanggar')->row();
			if ($hanggar->IdHanggar !== NULL) {
				$IdHanggar = $hanggar->IdHanggar;
			} else {
				$IdHanggar = 0;
			}
			$datauser = array(
				'IdUser' => $data->IdUser,
				'NipUser' => $data->NipUser,
				'NamaUser' => $data->NmUser,
				'GrupMenu' => $data->GrupMenu,
				'StatusUser' => $data->StatusUser,
				'NamaPegawai' => $data->NamaPegawai,
				'NIPPegawai' => $data->NIPPegawai,
				'Jabatan' => $data->NamaJabatan,
				'NamaUnit' => $data->NmUnit,
				'Pangkat' => $data->Pangkat,
				'IdHanggar' => $IdHanggar,
				'StatusLogin' => TRUE,
			);
			
			$this->session->set_userdata($datauser);
		}
	}

	public function logout(){
		$this->session->unset_userdata(array('IdUser' => '','StatusLogin' => FALSE));
		$this->session->sess_destroy();
	}

	public function CekUserHakAkses($IdUser = null){
		$sql = "SELECT * FROM tbgrupakses WHERE IdUser = ? AND (IdHakAkses = 5 OR IdHakAkses = 12)";
		$query = $this->db->query($sql,array($IdUser));
		if($query !== FALSE && $query->num_rows() > 0){
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function CekAdminHakAkses($IdUser = null){
		$sql = "SELECT * FROM tbgrupakses WHERE IdUser = ? AND IdHakAkses = 1";
		$query = $this->db->query($sql,array($IdUser));
		if($query !== FALSE && $query->num_rows() > 0){
			return TRUE;
		} else {
			return FALSE;
		}
	}

}

/* End of file Login_model.php */
/* Location: ./application/models/Login_model.php */