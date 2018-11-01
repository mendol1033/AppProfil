<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Log_model extends CI_Model {

	private $peloro;

	public function __construct()
	{
		parent::__construct();
		$this->peloro = $this->load->database('peloro', TRUE);
	}

	public function addHistory($IdUser,$operation,$app){
		$this->peloro->trans_begin();

		$data = array(
			'IdUser' => $IdUser,
			'KdHistory' => 1,
			'DetailHistory' => "Berhasil ".$operation." data ".$app
		);

		$this->peloro->insert('tb_history',$data);
		if ($this->peloro->trans_status() === FALSE) {
			$this->peloro->trans_rollback();
			return FALSE;
		} else {
			$this->peloro->trans_commit();
			return TRUE;
		}
	}
}

/* End of file log_model.php */
/* Location: ./application/models/log_model.php */