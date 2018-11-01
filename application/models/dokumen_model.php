<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dokumen_model extends CI_Model {

	private $sikabayan;

	public function __construct()
	{
		parent::__construct();
		$this->sikabayan = $this->load->database('sikabayan',TRUE);
		$this->load->model('perusahaan/perusahaan_model','perusahaan',TRUE);
	}

	var $table = "tb_dokumen_skep";
	var $column_order = array(null,'nama_dokumen','no_dokumen','tgl_dok','tgl_berakhir_dok','nama_file');
	var $column_search = array('nama_dokumen','no_dokumen','tgl_dok','tgl_berakhir_dok','nama_file');
	var $order = array('id_skep'=>'asc');

	private function GetListData(){
		$this->sikabayan->from($this->table);

		$i = 0;

		foreach($this->column_search as $item) //loop column
		{
			if($_POST['search']['value']) //if dataTable send POST for search
			{

				if($i === 0) //first loop
				{
					$this->sikabayan->group_start(); //open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->sikabayan->like($item, $_POST['search']['value']);
				} 
				else 
				{
					$this->sikabayan->or_like($item, $_POST['search']['value']);
				}
				if(count($this->column_search) -1 == $i) //last loop
				$this->sikabayan->group_end(); //close bracket
			}
			$i++;
		}

		if(isset($_POST['order'])) //ordering
		{
			$this->sikabayan->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} else if(isset($this->order))
		{
			$order = $this->order;
			$this->sikabayan->order_by(key($order),$order[key($order)]);
		}

	}

	public function GetDataTable($IdSkep){
		$this->GetListData();
		if($_POST['length'] != -1)
			$this->sikabayan->limit($_POST['length'], $_POST['start']);
		
		if($IdSkep > 0){
			$this->sikabayan->where('no',$IdSkep);
			$this->sikabayan->where('id_perusahaan',$_POST['id']);
		} else {
			$this->sikabayan->where('id_perusahaan',$_POST['id']);
		}

		$query = $this->sikabayan->get();
		return $query->result();
	}

	public function count_filtered($IdSkep)
	{
		$this->GetListData();
		if($IdSkep > 0){
			$this->sikabayan->where('no',$IdSkep);
			$this->sikabayan->where('id_perusahaan',$_POST['id']);
		} else {
			$this->sikabayan->where('no > ',$IdSkep);
			$this->sikabayan->where('id_perusahaan',$_POST['id']);
		}
		$query = $this->sikabayan->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->sikabayan->from($this->table);
		$this->sikabayan->where('id_perusahaan',$_POST['id']);
		return $this->sikabayan->count_all_results();
	}

	public function GetAllJenis(){
		$sql = "SELECT * FROM tb_jenis_skep";
		$query = $this->sikabayan->query($sql);
		return $query->result_array();
	}

	public function getDokumenById($IdSkep){
		$this->sikabayan->from($this->table);
		$this->sikabayan->where('id_skep',$IdSkep);

		$data = $this->sikabayan->get();
		return $data->row();
	}

	public function AddDokumen($aData){
		$this->sikabayan->trans_begin();
		$nama_file = $aData['success']['file_name'];
		$data = array(
			'id_perusahaan' 	=> $this->input->post('id'),
			'nama_dokumen' 		=> $this->input->post('NmDokumen'),
			'no_dokumen' 		=> $this->input->post('NoDokumen'),
			'tgl_dok'	 		=> $this->input->post('TglDokumen'),
			'tgl_berakhir_dok' 	=> $this->input->post('TglDokumenAkhir'),
			'no' 				=> $this->input->post('no'),
			'nama_file' 		=> $nama_file,
			'file_dok' 			=> $nama_file,
		);

		$this->sikabayan->insert('tb_dokumen_skep',$data);
		if ($this->sikabayan->trans_status() === FALSE){
			$this->sikabayan->trans_rollback();
			return FALSE;
		} else {
			$this->sikabayan->trans_commit();
			return TRUE;
		}
	}

	public function editDokumen($id,$data=NULL){
		$this->sikabayan->trans_begin();

		if(!empty($data)){
			$nama_file = $data['success']['file_name'];
			$query = $this->sikabayan->where('id_skep',$id)->limit(1)->get('tb_dokumen_skep');
			$dataSkep = $query->row();
			$deleteFile = $dataSkep->nama_file;

			$path = 'assets/upload/';
			$dataPT = $this->perusahaan->getById($_POST['id']);
			$IdSkep = $_POST['idSkep'];
			$folder = $dataPT['nama_perusahaan'];
			$dir = str_replace(array(' ','.','%20','_','-'), '', $folder);
			$direktori = $path.$dir;
		} else {
			$query = $this->sikabayan->where('id_skep',$id)->limit(1)->get('tb_dokumen_skep');
			$dataSkep = $query->row();
			$nama_file = $dataSkep->nama_file;
		}

		$data = array(
			'id_perusahaan' 	=> $this->input->post('id'),
			'nama_dokumen' 		=> $this->input->post('NmDokumen'),
			'no_dokumen' 		=> $this->input->post('NoDokumen'),
			'tgl_dok'	 		=> $this->input->post('TglDokumen'),
			'tgl_berakhir_dok' 	=> $this->input->post('TglDokumenAkhir'),
			'no' 				=> $this->input->post('no'),
			'nama_file' 		=> $nama_file,
			'file_dok' 			=> $nama_file,
		);

		$this->sikabayan->where('id_skep',$id)->update('tb_dokumen_skep',$data);

		if($this->sikabayan->trans_status() === FALSE){
			$this->sikabayan->trans_rollback();

			return FALSE;
		} else {
			$this->sikabayan->trans_commit();
			if (!empty($deleteFile)) {
				if(file_exists($direktori."/".$deleteFile)){
					unlink($direktori."/".$deleteFile);
				}
			}
			return TRUE;
		}
	}

	public function DeleteDokumen(){
		if (!empty($_POST)){
			$query = $this->sikabayan->where('id_skep',$_POST['idSkep'])->limit(1)->get('tb_dokumen_skep');
			$dataSkep = $query->row();
			$deleteFile = $dataSkep->nama_file;

			$path = 'assets/upload/';
			$dataPT = $this->perusahaan->getById($_POST['id']);
			$IdSkep = $_POST['idSkep'];
			$folder = $dataPT['nama_perusahaan'];
			$dir = str_replace(array(' ','.','%20','_','-'), '', $folder);
			$direktori = $path.$dir;

			$this->sikabayan->trans_begin();
			$this->sikabayan->where('id_skep',$_POST['idSkep'])->delete('tb_dokumen_skep');
			if($this->sikabayan->trans_status() === FALSE){
				$this->sikabayan->trans_rollback();

				return FALSE;
			} else {
				$this->sikabayan->trans_commit();
				if(file_exists($direktori.'/'.$deleteFile)){
					unlink($direktori.'/'.$deleteFile);	
				}
				
				return TRUE;
			}
		} else {
			return FALSE;
		}
	}

}

/* End of file dokumen_model.php */
/* Location: ./application/models/dokumen_model.php */