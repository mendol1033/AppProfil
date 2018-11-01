<?php if (!defined('BASEPATH')) exit ('no direct script access allowed');

class Login extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('login_model','login',true);
	}

	public function index(){

		if($this->session->userdata('StatusLogin') === TRUE){
			redirect('Index');
		}

		$this->data['pesan'] = $this->session->flashdata('pesan');
		$this->data['formValidation'] = 'login/validasi';
		$this->data['title']="Aplikasi Profil Perusahaan";
		$this->data['DashboardTitle'] = 'AppPro';
		$this->load->view('login',$this->data);
	}

	public function login(){
		if($this->login->cek_user()===TRUE){
				redirect('login');
			} else {
				$data = array('pesan' => "Username dan Password Salah");
				$this->session->set_flashdata($data);
				redirect('login');
			}
	}

	public function logout(){
		$this->login->logout();
		redirect('login');
	}
}