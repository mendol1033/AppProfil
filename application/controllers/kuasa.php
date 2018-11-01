<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kuasa extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('kuasa/kuasa_model','kuasa',TRUE);
	}

	public function index()
	{
		$this->data['tableName'] = "Kuasa Direksi";

		$option2 = array( 	'' => '-- PILIH JENIS KARTU IDENTITAS --',
			'KTP' => 'KTP',
			'KITAS' => 'KITAS',
			'PASPOR' => 'PASPOR');
		$this->data['option2'] = $option2;
		$this->load->view('kuasa',$this->data);	
	}

	Public function page_info(){
		$data['breadcrumb_item'] = array("Penanggung Jawab","Kuasa Direksi");

		echo json_encode($data);
	}

	public function ajax_list(){
		//start datatable
		$list = $this->kuasa->GetDataTable();
		$data = array();
		$no = $_POST['start'];

		foreach ($list as $ListData){
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $ListData->nama_pj;
			$row[] = $ListData->jabatan;
			$row[] = $ListData->no_hp.'<br>'.$ListData->no_hp2;
			$row[] = $ListData->email;
			$row[] = $ListData->alamat;
			$row[] = '<button type="button" class="btn btn-primary" onclick="view('.$ListData->id_pjwd.')"><i class="icon ion-document"><span hidden>View</span></i></button>';
			$row[] = '<button type="button" class="btn btn-success" onclick="edit('.$ListData->id_pjwd.')"><i class="icon ion-compose"><span hidden>Edit</span></i></button>';
			$row[] = '<button type="submit" onclick="hapus('.$ListData->id_pjwd.')" class="btn btn-danger"><i class="icon ion-close"><span hidden>Hapus</span></i></button>';


			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->kuasa->count_all(),
			"recordsFiltered" => $this->kuasa->count_filtered(),
			"data" => $data,
		);
		
		echo json_encode($output);
	}

	public function getKuasaById(){
		$data = $this->kuasa->getKuasaById();

		echo json_encode($data);
	}

	public function add(){

	}

	public function edit(){

	}

	public function delete(){

	}

}

/* End of file kuasa.php */
/* Location: ./application/controllers/kuasa/kuasa.php */