<?php
if(!defined('BASEPATH'))exit('No direct script access allowed');

class Direksi_model extends CI_Model {

	private $sikabayan;

	public function __construct()
	{
		parent::__construct();
		$this->sikabayan = $this->load->database('sikabayan',TRUE);
		$this->load->model('perusahaan/perusahaan_model','perusahaan',TRUE);
	}

	var $table = 'tb_penanggung_jawab';
	var $column_order = array(null,'nama_pj','jabatan','no_hp','no_hp2','email','alamat');
	var $column_search = array('nama_pj','jabatan','no_hp','no_hp2','email','alamat');
	var $order = array('id_pjwd'=>'asc');

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

	public function GetDataTable(){
		$this->GetListData();
		if($_POST['length'] != -1){
			$this->sikabayan->limit($_POST['length'], $_POST['start']);
		}
		$this->sikabayan->where('id_perusahaan',$_POST['id']);
		$this->sikabayan->where('group',$_POST['menu_id']);
		$query = $this->sikabayan->get();
		return $query->result();
	}

	public function count_filtered()
	{
		$this->GetListData();
		$this->sikabayan->where('id_perusahaan',$_POST['id']);
		$this->sikabayan->where('group',$_POST['menu_id']);
		$query = $this->sikabayan->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->sikabayan->from($this->table);
		$this->sikabayan->where('id_perusahaan',$_POST['id']);
		$this->sikabayan->where('group',$_POST['menu_id']);
		return $this->sikabayan->count_all_results();
	}
}

/* End of file direksi.php */
/* Location: ./application/models/kuasa/direksi.php */