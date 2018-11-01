<?php
if(!defined('BASEPATH'))exit('No direct script access allowed');

class Profil extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function index()
	{
		$this->data['main_content'] = 'profil';
		$this->data['JudulPanelBesar'] = 'Profile';
		$this->data['css'] = null;
		$this->data['breadcrumb'] = "Profil";
		$this->data['breadcrumb_item'] = array("Profile");
		$this->load->view('profil',$this->data);
	}

	public function page_info(){
		$data['breadcrumb_item'] = array("Profile","Summary");

		echo json_encode($data);
	}
}

/* End of file profil.php */
/* Location: ./application/controllers/profil.php */