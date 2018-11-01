<?php
if(!defined('BASEPATH')) exit ('No direct script access allowed');

class Uploadtpb extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/uploaddata_model','dataupload',true);
		$this->load->model('dokumen/dokumen_model','dokumen',true);
	}

	public function index()
	{
		$this->data['main_content'] = 'administrator/upload_tpb/main_content';
		$this->data['JudulPanelBesar'] = 'Upload Data';
		$this->data['js'] = 'administrator/upload_tpb/js';
		$this->data['css'] = null;
		$this->data['breadcrumb'] = "Dashboard";
		$this->data['breadcrumb_item'] = array("Administrator","Upload Data");
		$this->load->view('administrator/upload_tpb/main_content',$this->data);
	}

	public function page_info(){
		$data['breadcrumb_item'] = array("Administrator","Upload Data TPB");

		echo json_encode($data);
	}

}

/* End of file uploadtpb.php */
/* Location: ./application/controllers/admin/uploadtpb.php */