<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Error403 extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function index()
	{
		$this->data['main_content'] = 'errors/error403/main_content';
		$this->data['JudulPanelBesar'] = null;
		$this->data['js'] = null;
		$this->data['css'] = null;
		$this->data['breadcrumb'] = "Dashboard";
		$this->data['breadcrumb_item'] = array("Error","Error 403");

		$this->load->view('template/template', $this->data);
	}

}

/* End of file error403.php */
/* Location: ./application/controllers/error403.php */