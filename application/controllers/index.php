<?php
if(!defined('BASEPATH'))exit('No direct script access allowed');

class Index extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('perusahaan/perusahaan_model','perusahaan',TRUE);
	}

	public function index()
	{	
		$data = $this->perusahaan->getById($_GET['id']);
		$this->data['namaPT'] = $data['nama_perusahaan'];
		$fas = $this->perusahaan->getJenisTPBbyId($data['id_tpb']);
		$this->data['fasilitas'] = $fas['nama_detail'];
		$this->data['app'] = "PROFIL";
		$this->data['breadcrumb'] = "menu";
		$this->data['title'] = "APP PROFIL";
		$this->data['main_content'] = null;
		$this->load->view('template/template',$this->data);
	}

	public function page_info(){
		$data['breadcrumb_item'] = array("Stakeholders","All Perusahaan");

		echo json_encode($data);
	}

	public function getLocation(){
		$data = $this->perusahaan->getLocationTPB();

		echo json_encode($data);
	}

}

/* End of file index.php */
/* Location: ./application/controllers/index.php */