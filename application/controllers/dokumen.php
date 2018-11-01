<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dokumen extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('dokumen_model','dokumen',TRUE);
		$this->load->model('perusahaan/perusahaan_model','perusahaan',TRUE);
	}

	public function index()
	{
		$this->data['tableName'] = "Dokumen Legalitas";

		$optionSkep = array ("" =>"Semua Dokumen");
		$skep = $this->dokumen->GetAllJenis();
		$no = 0;
		foreach ($skep as $key => $value) {
			$no++;
			$optionSkep[$value['IdJnsSkep']] = $no.". ".$value['NmJnsSkep'];
		}
		$this->data['options'] = $optionSkep;

		$this->load->view('dokumen',$this->data);
	}

	public function page_info(){
		$data['breadcrumb_item'] = array("Profile","Dokumen Legalitas");

		echo json_encode($data);
	}

	public function ajax_list(){
		$dataPT = $this->perusahaan->getById($_POST['id']);
		$IdSkep = $_POST['idSkep'];
		$folder = $dataPT['nama_perusahaan'];
		$dir = str_replace(array(' ','.','%20','_','-'), '', $folder);
		$direktori = strtoupper($dir);

		//start datatable
		$list = $this->dokumen->GetDataTable($IdSkep);
		$data = array();
		$no = $_POST['start'];

		foreach ($list as $ListData){
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $ListData->nama_dokumen;
			$row[] = $ListData->no_dokumen;
			$row[] = $ListData->tgl_dok;
			$row[] = $ListData->tgl_berakhir_dok;
			$row[] = $ListData->file_dok;
			$row[] = '<button type="button" class="btn btn-primary" onclick="view('.$ListData->id_skep.')"><i class="icon ion-document"><span hidden>Lihat Dokumen</span></i></button>';
			$row[] = '<button type="button" class="btn btn-success" onclick="edit('.$ListData->id_skep.')"><i class="icon ion-compose"></i></button>';
			$row[] = '<button type="submit" onclick="hapusDokumen('.$ListData->id_skep.')" class="btn btn-danger"><i class="icon ion-close"></i></button>';


			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->dokumen->count_all(),
			"recordsFiltered" => $this->dokumen->count_filtered($IdSkep),
			"data" => $data,
		);
		
		echo json_encode($output);
	}

	public function getSkepById(){
		$dataSkep = $this->dokumen->getDokumenById($_GET['idSkep']);
		$path = 'assets/upload/';
		$dataPT = $this->perusahaan->getById($_GET['id']);
		$IdSkep = $_GET['idSkep'];
		$folder = $dataPT['nama_perusahaan'];
		$dir = str_replace(array(' ','.','%20','_','-'), '', $folder);
		$direktori = strtoupper($dir);
		// $direktori = $path.$dir2;

		$data = array();

		foreach ($dataSkep as $key => $value) {
			$data[$key] = $value;
		}
		$data["folder"] = $direktori;

		echo json_encode($data);
	}

	public function TambahDokumen(){
		if (!empty($_FILES['DokumenSkep']['name']) && !empty($_POST['NoDokumen'])){
			if ($_FILES['DokumenSkep']['size'] > 50000000) {
				$pesan = "File Yang Anda Upload Terlalu Besar";
				$data = array('pesan' => $pesan);

				echo json_encode($data);
			} else {
				$path = 'assets/upload/';
				$dataPT = $this->perusahaan->getById($_POST['id']);
				//$IdSkep = $_GET['idSkep'];
				$folder = $dataPT['nama_perusahaan'];
				$dir = str_replace(array(' ','.','%20','_','-'), '', $folder);
				$direktori = $path.$dir;
				$config['upload_path'] = $direktori;
				$config['allowed_types'] = 'pdf';
				$config['max_size'] = '0';
				$config['remove_space'] = FALSE;

				$this->load->library('Upload',$config);

				if (is_dir($direktori) == FALSE) {
					mkdir($direktori);
					if ( ! $this->upload->do_upload('DokumenSkep')) {
						$error = array( 'error' => $this->upload->display_errors());
						$data = array(
							'status' => false,
							'pesan' => $error['error'],
						);
						echo json_encode($data);
					} else {
						$success = array( 'success' => $this->upload->data());
						$this->dokumen->AddDokumen($success);

						$data = array(
							'status' => true,
							'pesan' => "Berhasil Tambah Dokumen",
							'data' => $success,
						);

						echo json_encode($data);
					}
				} else {
					if ( ! $this->upload->do_upload('DokumenSkep')) {
						$error = array( 'error' => $this->upload->display_errors());
						$data = array(
							'status' => false,
							'pesan' => $error['error'],
						);
						echo json_encode($data);
					} else {
						$success = array( 'success' => $this->upload->data());
						$this->dokumen->AddDokumen($success);

						$data = array(
							'status' => true,
							'pesan' => "Berhasil Tambah Dokumen",
							'data' => $success,
						);

						echo json_encode($data);
					}
				}
			}
		} else {
			$pesan = "Isi Form Dengan Lengkap dan Pilih File Yang Akan Di Upload";
			$data = array('pesan' => $pesan);

			echo json_encode($data);
		}
	}

	public function EditDokumen(){

		if (!empty($_FILES['DokumenSkep']['name']) && !empty($_POST['NoDokumen'])){
			$path = 'assets/upload/';
			$dataPT = $this->perusahaan->getById($_POST['id']);
			$IdSkep = $_POST['idSkep'];
			$folder = $dataPT['nama_perusahaan'];
			$dir = str_replace(array(' ','.','%20','_','-'), '', $folder);
			$direktori = $path.$dir;
			$config['upload_path'] = $direktori;
			$config['allowed_types'] = 'pdf';
			$config['max_size'] = '0';
			$config['remove_space'] = FALSE;

			$this->load->library('Upload',$config);

			if ( ! $this->upload->do_upload('DokumenSkep')) {
				$error = array( 'error' => $this->upload->display_errors());
				$data = array(
					'status' => false,
					'pesan' => $error['error'],
				);
				echo json_encode($data);
			} else {
				$success = array( 'success' => $this->upload->data());
				$status = $this->dokumen->editDokumen($_POST['idSkep'],$success);

				$data = array(
					'status' => $status,
					'pesan' => "Berhasil Ubah Dokumen",
				);

				echo json_encode($data);
			}
		} else if (!empty($_POST['NoDokumen'])) {
			$status = $this->dokumen->editDokumen($_POST['idSkep']);

			$data = array(
				'status' => $status,
				'pesan' => "Berhasil Ubah Dokumen",
			);


			echo json_encode($data);
		} else {
			$pesan = "Isi Form dan Pilih File Yang Akan DiUpload";
			$data = array('pesan' => $pesan);

			echo json_encode($data);
		}
	}

	public function HapusDokumen(){
		$status = $this->dokumen->DeleteDokumen();
		
		if ($status === TRUE){
			$pesan = "Berhasil Hapus Dokumen";

			$data = array(
				'status' => $status,
				'pesan' => $pesan
			);
			echo json_encode($data);
		} else {
			$pesan = "Gagal Hapus Dokumen";

			$data = array(
				'status' => $status,
				'pesan' => $pesan
			);
			echo json_encode($data);
		}
	}
}

/* End of file dokumen.php */
/* Location: ./application/controllers/dokumen.php */