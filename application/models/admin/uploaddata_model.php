<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Uploaddata_model extends CI_Model {

	private $tpb_db;

	public function __construct(){
		parent::__construct();
		$this->tpb_db = $this->load->database('tpb',true);
	}

	public function addData($data){
		$this->tpb_db->trans_begin();
		
		if (array_key_exists('header', $data)) {
			$this->tpb_db->insert_batch('tpb_header',$data['header']);
		}
		
		if (array_key_exists('barang', $data)) {
			$this->tpb_db->insert_batch('tpb_barang',$data['barang']);
		}

		if (array_key_exists('barangTarif', $data)) {
			$this->tpb_db->insert_batch('tpb_barang_tarif',$data['barangTarif']);
		}

		if (array_key_exists('dokumenPelengkap', $data)) {
			$this->tpb_db->insert_batch('tpb_dokumen_pelengkap',$data['dokumenPelengkap']);
		}

		if (array_key_exists('pungutanDokumen', $data)) {
			$this->tpb_db->insert_batch('tpb_pungutan_dokumen',$data['pungutanDokumen']);
		}
	
		if (array_key_exists('bahanBaku', $data)) {
			$this->tpb_db->insert_batch('tpb_bahan_baku',$data['bahanBaku']);
		}
		
		if (array_key_exists('kemasan', $data)) {
			$this->tpb_db->insert_batch('tpb_kemasan',$data['kemasan']);
		}

		if (array_key_exists('kontainer', $data)) {
			$this->tpb_db->insert_batch('tpb_kontainer',$data['kontainer']);
		}


		if ($this->tpb_db->trans_status() === FALSE){
			$this->tpb_db->trans_rollback();
			return FALSE;
		} else {
			$this->tpb_db->trans_commit();
			return TRUE;
		}
	}

	public function addNopen($data){
		$this->tpb_db->trans_begin();

		foreach ($data as $key => $value) {
			$this->tpb_db->insert_batch('tpb_nopen',$value);
		}

		if ($this->tpb_db->trans_status() === FALSE){
			$this->tpb_db->trans_rollback();
			return FALSE;
		} else {
			$this->tpb_db->trans_commit();
			return TRUE;
		}
	}

}

/* End of file uploaddata_model.php */
/* Location: ./application/models/admin/uploaddata_model.php */