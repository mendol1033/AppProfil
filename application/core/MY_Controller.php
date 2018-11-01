<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Menu_model','menu',true);
		$this->load->model('login_model','login',true);

		if($this->session->userdata('StatusLogin') === TRUE){
			if ($this->login->CekUserHakAkses($this->session->userdata('IdUser')) !== TRUE){
				redirect('error403');
			} else {
				$menu = $this->menu->Menu($this->session->userdata('GrupMenu'));
				$this->data['menu'] = $menu['mainMenu'];
				if ($this->login->CekAdminHakAkses($this->session->userdata('IdUser')) === TRUE){
					$this->data['adminMenu'] = $menu['adminMenu'];
				}
				$this->data['DashboardTitle'] = 'TPB';
				$this->data['IdUser'] = $this->session->userdata('IdUser');
			}
		} else {
			redirect('login');
		}
	}

	public function appfeedback($status,$operation,$app){
		if($status === TRUE){
			$pesan = "Sukses ".$operation." Data ".$app;
		} else {
			$pesan = "Gagal ".$operation." Data ".$app;
		}

		return $pesan;
	}

}



/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */