<?php
if(!defined('BASEPATH'))exit('No direct script access allowed');

class Menu_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		// $this->load->model("'dokumen/dokumen_model','dokumen',true);
		$this->load->model('perusahaan/perusahaan_model','perusahaan',true);
	}

	private $selected_db;

	public function Menu($unit){
		// $jumlahDokumen = $this->dokumen->getJumlahDokumenTahunBerjalan();
		$hoem = array(
			'url' => array("'home'"),
			'icon' => 'fa fa-home',
			'menu' => 'Beranda'
		);

		$profil = array(
			'url' => array("'profil'"),
			'icon' => 'fa fa-user',
			'menu' => 'Profil Perusahaan'
		);

		$Dokumen = array(
			'url' => array("'dokumen'"),
			'icon' => 'fa fa-file',
			'menu' => 'Dokumen Legalitas',
		);

		$pj = array(
			'url' => '#',
			'icon' => 'fa fa-user',
			'menu' => 'Penanggung Jawab',
			'subMenu' => array(
				'direksi' => array(
					'url' => array("'kuasa'",1),
					'icon' => 'fa fa-file',
					'menu' => 'Direksi',
				),
				'exim' => array(
					'url' => array("'kuasa'",2),
					'icon' => 'fa fa-file',
					'menu' => 'Exim',
				),
				'lain' => array(
					'url' => array("'kuasa'",3),
					'icon' => 'fa fa-file',
					'menu' => 'Lain-Lain',
				),
			)
		);

		$audit = array(
			'url' => array("'audit'"),
			'icon' => 'fa fa-file',
			'menu' => 'Riwayat Audit',
		);

		$nob = array(
			'url' => '#',
			'icon' => 'fa fa-industry',
			'menu' => 'Nature of Bussiness',
			'subMenu' => array(
				'produk' => array(
					'url' => array("'nob/produk'"),
					'icon' => 'fa fa-file',
					'menu' => 'Hasil Produksi',
				),
				'pemasok' => array(
					'url' => array("'nob/pemasok'"),
					'icon' => 'fa fa-file',
					'menu' => 'Pemasok',
				),
				'pembeli' => array(
					'url' => array("'nob/pembeli'"),
					'icon' => 'fa fa-file',
					'menu' => 'Pembeli',
				),
				'subkonMasuk' => array(
					'url' => array("'nob/subkonmasuk'"),
					'icon' => 'fa fa-file',
					'menu' => 'Perusahaan Pemberi Subkon',
				),
				'subkonKeluar' => array(
					'url' => array("'nob/subkonkeluar'"),
					'icon' => 'fa fa-file',
					'menu' => 'Perusahaan Tujuan Subkon',
				),
			),
		);

		$akses = array(
			'url' => '#',
			'icon' => 'fa fa-video',
			'menu' => 'CCTV dan IT Inventory',
			'subMenu' => array(
				'cctv' => array(
					'url' => array("'cctv'"),
					'icon' => 'fa fa-camera',
					'menu' => 'Akses CCTV'
				),
				'it' => array(
					'url' => array("'it'"),
					'icon' => 'fa fa-indent',
					'menu' => 'Akses IT Inventory'
				),
			),
		);

		$pelanggaran = array(
			'url' => array("'pelanggaran'"),
			'icon' => 'fa fa-times-circle',
			'menu' => 'Riawayat Pelanggaran',
		);

		$data = array(
			'mainMenu' => array($hoem,$profil,$Dokumen,$pj,$audit,$nob,$akses,$pelanggaran),
			'adminMenu' => array()
		);

		return $data;
	}

	public function getJenisDokumen(){
		$this->selected_db = $this->load->database("'tpb', TRUE);
		$query = $this->selected_db->get('tb_jenis_dokumen'");

		return $query->result_array();
	}

	public function getJenisDokumenByKode($filter){
		$this->selected_db = $this->load->database('tpb', TRUE);
		$this->selected_db->where('Kd_Dok',$filter);
		$query = $this->selected_db->get('tb_jenis_dokumen');

		return $query->row();
	}
}

/* End of file menu_model.php */
/* Location: ./application/models/menu_model.php */