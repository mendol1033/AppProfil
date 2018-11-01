<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perusahaan_model extends CI_Model {

	private $sikabayan_db;
	private $Hanggar;

	public function __construct()
	{
		parent::__construct();
		$this->sikabayan_db = $this->load->database('sikabayan',true);
		$this->Hanggar = $this->session->userdata('IdHanggar');
	}

	var $table = "tpbdetail";
	var $column_order = array(null,'id_perusahaan','NPWP','nama_perusahaan','alamat');
	var $column_search = array('id_perusahaan','NPWP','nama_perusahaan','alamat');
	var $order = array('nama_perusahaan'=>'asc');

	private function GetListData(){
		$this->sikabayan_db->from($this->table);

		$i = 0;

		foreach($this->column_search as $item) //loop column
		{
			if($_POST['search']['value']) //if dataTable send POST for search
			{

				if($i === 0) //first loop
				{
					$this->sikabayan_db->group_start(); //open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->sikabayan_db->like($item, $_POST['search']['value']);
				} 
				else 
				{
					$this->sikabayan_db->or_like($item, $_POST['search']['value']);
				}
				if(count($this->column_search) -1 == $i) //last loop
				$this->sikabayan_db->group_end(); //close bracket
			}
			$i++;
		}

		if(isset($_POST['order'])) //ordering
		{
			$this->sikabayan_db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} else if(isset($this->order))
		{
			$order = $this->order;
			$this->sikabayan_db->order_by(key($order),$order[key($order)]);
		}

	}

	public function GetDataTable(){
		$this->GetListData();
		if($_POST['length'] != -1){
			$this->sikabayan_db->limit($_POST['length'], $_POST['start']);
		}

		if(!empty($_GET['nama'])){
			$this->sikabayan_db->like('nama_perusahaan',$_GET['nama']);
		}

		if ($this->Hanggar !== 0) {
			$this->sikabayan_db->where('IdHanggar',$this->Hanggar);
		}

		$query = $this->sikabayan_db->get();
		return $query->result();
	}

	public function count_filtered(){
		$this->GetListData();

		if(!empty($_GET['nama'])){
			$this->sikabayan_db->like('nama_perusahaan',$_GET['nama']);
		}

		if ($this->Hanggar !== 0) {
			$this->sikabayan_db->where('IdHanggar',$this->Hanggar);
		}
		$query = $this->sikabayan_db->get();
		return $query->num_rows();
	}

	public function count_all(){
		$this->sikabayan_db->from($this->table);
		if ($this->Hanggar !== 0) {
			$this->sikabayan_db->where('IdHanggar',$this->Hanggar);
		}
		return $this->sikabayan_db->count_all_results();
	}


	// Get Data Perusahaan By ID
	public function getById(){
		if(!empty($_GET['id'])){
			$id = $_GET['id'];
		} else {
			$id = $_POST['id'];
		}
		$this->sikabayan_db->from('tb_perusahaan');
		$this->sikabayan_db->where('id_perusahaan',$id);
		$query = $this->sikabayan_db->get();

		return $query->row_array();
	}

	// Get Data Perusahaan By ID
	public function getById2($id){
		$this->sikabayan_db->from('tb_perusahaan');
		$this->sikabayan_db->where('id_perusahaan',$id);
		$query = $this->sikabayan_db->get();

		return $query->row();
	}

	

	public function getByNama($search,$column){
		$this->sikabayan_db->from($this->table);
		$this->sikabayan_db->select($column);
		if ($this->Hanggar !== 0) {
			$this->sikabayan_db->where('id_hanggar',$this->Hanggar);
		}
		$this->sikabayan_db->like('nama_perusahaan',$search);
		return $this->sikabayan_db->get()->result_array();
	}

	public function getNPWP($search,$column){
		$this->sikabayan_db->from('userstpb');
		$this->sikabayan_db->select($column);
		// if ($this->Hanggar !== 0) {
		// 	$this->sikabayan_db->where('id_hanggar',$this->Hanggar);
		// }
		$this->sikabayan_db->like('name',$search);
		return $this->sikabayan_db->get()->result_array();
	}

	public function getJumlahTPB(){
		$sql = "SELECT id_tpb as jenis, COUNT(*) AS JumlahTPB FROM tb_perusahaan group by id_tpb";
		$query = $this->sikabayan_db->query($sql);

		if($query->num_rows() > 0){
			$data = $query->result();

			$result = array(
				'0' => NULL,
				'1' => NULL,
				'2' => NULL,
				'3' => NULL,
				'4' => NULL,
				'5' => NULL,
				'6' => NULL,
				'7' => NULL,
				'8' => NULL,
				'9' => NULL,
			);

			foreach ($data as $value) {
				$result[$value->jenis] = $value->JumlahTPB;
			}
		} else {
			$result = array(
				'0' => NULL,
				'1' => NULL,
				'2' => NULL,
				'3' => NULL,
				'4' => NULL,
				'5' => NULL,
				'6' => NULL,
				'7' => NULL,
				'8' => NULL,
				'9' => NULL,
			);
		}
		return $result;
	}

	public function countAllPerusahaan(){
		$sql = "SELECT COUNT(*) AS JumlahTPB FROM tb_perusahaan";
		$query = $this->sikabayan_db->query($sql);

		$data = $query->result();
		foreach ($data as $value) {
			$result = $value->JumlahTPB;
		}

		return $result;
	}

	public function GetJenisTPB(){
		$query = 'SELECT id_tpb as id, nama_tpb as jenis, nama_detail as nama FROM tb_jenis_tpb';
		$JenisTPB = $this->sikabayan_db->query($query);
		if ($JenisTPB->num_rows() != 0 ) {
			return $JenisTPB;
		}
	}

	public function getJenisTPBbyId($id){
		$this->sikabayan_db->from('tb_jenis_tpb');
		$this->sikabayan_db->where('id_tpb',$id);

		$query = $this->sikabayan_db->get();
		return $query->row_array();
	}

	public function GetListHanggar(){
		$query = 'SELECT id_hanggar as id, nama_hanggar as nama FROM tb_hanggar';
		$hanggar = $this->sikabayan_db->query($query);
		return $hanggar;
	}

	public function add(){
		$this->sikabayan_db->trans_begin();
		$datatpb = array(
			'NPWP' => $this->input->post('NPWP'),
			'nama_perusahaan' => $this->input->post('namatpb'),
			'telepon' => $this->input->post('telepon'),
			'fax' => $this->input->post('fax'),
			'alamat' => $this->input->post('alamat'),
			'provinsi' => $this->input->post('provinsi'),
			'kota' => $this->input->post('kota'),
			'kecamatan' => $this->input->post('kecamatan'),
			'kelurahan' => $this->input->post('kelurahan'),
			'kode_pos' => $this->input->post('kodepos'),
			'id_tpb' => $this->input->post('JenisTPB'),
			'lokasi_tpb' => $this->input->post('LokasiTPB'),
			'ijin_kelola_tpb' => $this->input->post('izin'),
			'latitude' => $this->input->post('latitude'),
			'longitude' => $this->input->post('longitude'),
			'id_hanggar' => $this->input->post('Hanggar'),
			'status' => $this->input->post('status')
		);
		$this->sikabayan_db->insert('tb_perusahaan',$datatpb);

		if($this->sikabayan_db->trans_status() === FALSE){
			$this->sikabayan_db->trans_rollback();
			return FALSE;
		} else {
			$this->sikabayan_db->trans_commit();
			return TRUE;
		}
	}

	public function update(){
		$this->sikabayan_db->trans_begin();
		$datatpb = array(
			'NPWP' => $this->input->post('NPWP'),
			'nama_perusahaan' => $this->input->post('namatpb'),
			'telepon' => $this->input->post('telepon'),
			'fax' => $this->input->post('fax'),
			'alamat' => $this->input->post('alamat'),
			'provinsi' => $this->input->post('provinsi'),
			'kota' => $this->input->post('kota'),
			'kecamatan' => $this->input->post('kecamatan'),
			'kelurahan' => $this->input->post('kelurahan'),
			'kode_pos' => $this->input->post('kodepos'),
			'id_tpb' => $this->input->post('JenisTPB'),
			'lokasi_tpb' => $this->input->post('LokasiTPB'),
			'ijin_kelola_tpb' => $this->input->post('izin'),
			'latitude' => $this->input->post('latitude'),
			'longitude' => $this->input->post('longitude'),
			'id_hanggar' => $this->input->post('Hanggar'),
			'status' => $this->input->post('status')
		);
		$this->sikabayan_db->where('id_perusahaan',$this->input->post('id'))->update('tb_perusahaan',$datatpb);

		if($this->sikabayan_db->trans_status() === FALSE){
			$this->sikabayan_db->trans_rollback();
			return FALSE;
		} else {
			$this->sikabayan_db->trans_commit();
			return TRUE;
		}
	}

	public function getLocationTPB(){
		$this->sikabayan_db->from('tb_perusahaan');
		$this->sikabayan_db->select('nama_perusahaan AS nama, latitude AS lat, longitude AS lng, id_perusahaan AS id, id_tpb AS jenis, profil_resiko AS profil');
		$query = $this->sikabayan_db->get();

		return $query->result_array();
	}

	public function getProvinsi($search){
		$this->sikabayan_db->from('inf_lokasi');
		$this->sikabayan_db->where('lokasi_kabupatenkota',00);
		$this->sikabayan_db->where('lokasi_kecamatan',00);
		$this->sikabayan_db->where('lokasi_kelurahan',0000);
		$this->sikabayan_db->like('lokasi_nama',$search);

		$query = $this->sikabayan_db->get();
		return $query->result_array();
	}

	public function getKabupaten($provinsi,$search){
		$sql = "SELECT lokasi_propinsi FROM inf_lokasi WHERE lokasi_kode=? limit 1";
		$kodeProv = $this->sikabayan_db->query($sql,$provinsi)->result_array();

		$this->sikabayan_db->from('inf_lokasi');
		$this->sikabayan_db->where('lokasi_propinsi',$kodeProv[0]['lokasi_propinsi']);
		$this->sikabayan_db->where('lokasi_kabupatenkota !=', 00);
		$this->sikabayan_db->where('lokasi_kecamatan',00);
		$this->sikabayan_db->where('lokasi_kelurahan',0000);
		$this->sikabayan_db->like('lokasi_nama',$search);

		$query = $this->sikabayan_db->get();
		return $query->result_array();
		// return $kodeProv;
	}

	public function getKecamatan($kabupaten,$search){
		$sql = "SELECT lokasi_propinsi, lokasi_kabupatenkota FROM inf_lokasi WHERE lokasi_kode=? limit 1";
		$kodeKab = $this->sikabayan_db->query($sql,$kabupaten)->result_array();

		$this->sikabayan_db->from('inf_lokasi');
		$this->sikabayan_db->where('lokasi_propinsi',$kodeKab[0]['lokasi_propinsi']);
		$this->sikabayan_db->where('lokasi_kabupatenkota',$kodeKab[0]['lokasi_kabupatenkota']);
		$this->sikabayan_db->where('lokasi_kecamatan !=',00);
		$this->sikabayan_db->where('lokasi_kelurahan',0000);
		$this->sikabayan_db->like('lokasi_nama',$search);

		$query = $this->sikabayan_db->get();
		return $query->result_array();
	}

	public function getKelurahan($kecamatan,$search){
		$sql = "SELECT lokasi_propinsi, lokasi_kabupatenkota, lokasi_kecamatan FROM inf_lokasi WHERE lokasi_kode=? limit 1";
		$kodeKec = $this->sikabayan_db->query($sql,$kecamatan)->result_array();

		$this->sikabayan_db->from('inf_lokasi');
		$this->sikabayan_db->where('lokasi_propinsi',$kodeKec[0]['lokasi_propinsi']);
		$this->sikabayan_db->where('lokasi_kabupatenkota',$kodeKec[0]['lokasi_kabupatenkota']);
		$this->sikabayan_db->where('lokasi_kecamatan',$kodeKec[0]['lokasi_kecamatan']);
		$this->sikabayan_db->where('lokasi_kelurahan !=',00);
		$this->sikabayan_db->like('lokasi_nama',$search);

		$query = $this->sikabayan_db->get();
		return $query->result_array();
	}

}

/* End of file perusahaan_model.php */
/* Location: ./application/models/perusahaan/perusahaan_model.php */