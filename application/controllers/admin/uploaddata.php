<?php
if (!defined('BASEPATH')) exit ('No direct script access allowed');

class Uploaddata extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/uploaddata_model','dataupload',true);
		$this->load->model('dokumen/dokumen_model','dokumen',true);
		require_once APPPATH.'third_party/PHPExcel-1.8/Classes/PHPExcel.php';
		$this->excel = new PHPExcel();
	}

	public function index()
	{
		$this->data['main_content'] = 'administrator/upload_data/main_content';
		$this->data['JudulPanelBesar'] = 'Upload Data';
		$this->data['js'] = 'administrator/upload_data/js';
		$this->data['css'] = null;
		$this->data['breadcrumb'] = "Dashboard";
		$this->data['breadcrumb_item'] = array("Administrator","Upload Data");
		$this->load->view('administrator/upload_data/main_content',$this->data);
	}

	public function page_info(){
		$data['breadcrumb_item'] = array("Administrator","Upload Data");

		echo json_encode($data);
	}

	public function uploadDokumen(){
		// Cek Hak Akases Administrator
		if($this->login->CekAdminHakAkses($this->session->userdata('IdUser')) === TRUE ){
			// Cek Ada atau tidak file yang di upload
			if(!empty($_FILES["dataExcel"]["name"])){
				// proses upload file
				$dir = "assets/upload/excel/";
				$config["upload_path"] = $dir;
				$config["allowed_types"] = "xls|xlsx";
				$config["file_name"] = date("Y-m-d").'_'.rand(000000,999999);

				$this->load->library('upload', $config); 
				
				if(! $this->upload->do_upload('dataExcel')){
					echo $this->upload->display_errors();
				} else {
					$dataPost = array($_POST,$_FILES);
					$data = $this->upload->data();

					// Setelah Berhasil Upload, Proses File Excel di Server untuk di proses dengan PHPExcel
					$file_type = PHPExcel_IOFactory::identify($dir.$data['file_name']);
					$objReader = PHPExcel_IOFactory::createReader($file_type);
					$objPHPExcel = $objReader->load($dir.$data['file_name']);
					$worksheet = $objReader->listWorksheetNames($dir.$data['file_name']);
					foreach ($worksheet as $key => $sheetName) {
						$sheetData[$sheetName] = $objPHPExcel->getSheetByName($sheetName)->toArray(null,true,true);
						$highestRow[$sheetName] = $objPHPExcel->getSheetByName($sheetName)->getHighestRow();
						$higestColumn[$sheetName] = $objPHPExcel->getSheetByName($sheetName)->getHighestColumn();
					}

					// Get Data From Sheet 1
					if(isset($worksheet[0])){
						if($highestRow[$worksheet[0]] > 1){
							for ($i=1; $i <= max(array_keys($sheetData[$worksheet[0]])) ; $i++) {
								if ($higestColumn[$worksheet[0]] == "BA") {
									$dataInput['header'][] = array(
										"NOMOR_AJU" => $sheetData[$worksheet[0]][$i][1],
										"NOMOR_DAFTAR" => $sheetData[$worksheet[0]][$i][2],
										"TANGGAL_DAFTAR" => $sheetData[$worksheet[0]][$i][3],
										"STATUS_DOKUMEN" => $sheetData[$worksheet[0]][$i][4],
										"KODE_DOKUMEN" => $sheetData[$worksheet[0]][$i][5],
										"KODE_KANTOR" => $sheetData[$worksheet[0]][$i][6],
										"KODE_KANTOR_BONGKAR" => $sheetData[$worksheet[0]][$i][7],
										"NAMA_PEMASOK" => $sheetData[$worksheet[0]][$i][8],
										"ALAMAT_PEMASOK" => $sheetData[$worksheet[0]][$i][9],
										"KODE_NEGARA_PEMASOK" => $sheetData[$worksheet[0]][$i][10],
										"NOMOR_IJIN_TPB" => $sheetData[$worksheet[0]][$i][11],
										"TANGGAL_IJIN_TPB" => date('Y-m-d',strtotime($sheetData[$worksheet[0]][$i][12])),
										"NPWP" => $sheetData[$worksheet[0]][$i][13],
										"NAMA_PENGUSAHA" => $sheetData[$worksheet[0]][$i][14],
										"ALAMAT_PENGUSAHA" => $sheetData[$worksheet[0]][$i][15],
										"ID_PPJK" => $sheetData[$worksheet[0]][$i][16],
										"NAMA_PPJK" => $sheetData[$worksheet[0]][$i][17],
										"ALAMAT_PPJK" => $sheetData[$worksheet[0]][$i][18],
										"NPPPJK" => $sheetData[$worksheet[0]][$i][19],
										"TANGGAL_NPPPJK" => date('Y-m-d',strtotime($sheetData[$worksheet[0]][$i][20])),
										"NAMA_PENGANGKUT" => $sheetData[$worksheet[0]][$i][21],
										"NOMOR_VOY_FLIGHT" => $sheetData[$worksheet[0]][$i][22],
										"NOMOR_BC11" => $sheetData[$worksheet[0]][$i][23],
										"TANGGAL_BC11" => date('Y-m-d',strtotime($sheetData[$worksheet[0]][$i][24])),
										"POS_BC11" => $sheetData[$worksheet[0]][$i][25],
										"KODE_TPS" => $sheetData[$worksheet[0]][$i][26],
										"KODE_VALUTA" => $sheetData[$worksheet[0]][$i][27],
										"KURS" => $sheetData[$worksheet[0]][$i][28],
										"FOB" => $sheetData[$worksheet[0]][$i][29],
										"CIF" => $sheetData[$worksheet[0]][$i][30],
										"CIF_RUPIAH" => $sheetData[$worksheet[0]][$i][31],
										"BRUTO" => $sheetData[$worksheet[0]][$i][32],
										"NETTO" => $sheetData[$worksheet[0]][$i][33],
										"JUMLAH_BARANG" => $sheetData[$worksheet[0]][$i][34],
										"KODE_TUJUAN_TPB" => $sheetData[$worksheet[0]][$i][35],
										"JUMLAH_KONTAINER" => $sheetData[$worksheet[0]][$i][36],
										"JUMLAH_KEMASAN" => $sheetData[$worksheet[0]][$i][37],
										"ID_PENERIMA" => $sheetData[$worksheet[0]][$i][38],
										"NAMA_PENERIMA" => $sheetData[$worksheet[0]][$i][39],
										"ALAMAT_PENERIMA" => $sheetData[$worksheet[0]][$i][40],
										"NOMOR_API_PENERIMA" => $sheetData[$worksheet[0]][$i][41],
										"NOMOR_API_PEMILIK" => $sheetData[$worksheet[0]][$i][42],
										"KODE_KANTOR_TUJUAN" => $sheetData[$worksheet[0]][$i][43],
										"NOMOR_IZIN_TPB_PENERIMA" => $sheetData[$worksheet[0]][$i][44],
										"ID_PENGIRIM" => $sheetData[$worksheet[0]][$i][45],
										"NAMA_PENGIRIM" => $sheetData[$worksheet[0]][$i][46],
										"ALAMAT_PENGIRIM" => $sheetData[$worksheet[0]][$i][47],
										"ID_IMPORTIR" => $sheetData[$worksheet[0]][$i][48],
										"NAMA_IMPORTIR" => $sheetData[$worksheet[0]][$i][49],
										"ALAMAT_IMPORTIR" => $sheetData[$worksheet[0]][$i][50],
										"NOMOR_API_IMPORTIR" => $sheetData[$worksheet[0]][$i][51],
										"NIK" => $sheetData[$worksheet[0]][$i][52],
									);
								} else {
									$dataInput['header'][] = array(
										"NOMOR_AJU" => $sheetData[$worksheet[0]][$i][1],
										"KODE_DOKUMEN" => $sheetData[$worksheet[0]][$i][2],
										"KODE_KANTOR" => $sheetData[$worksheet[0]][$i][3],
										"KODE_KANTOR_BONGKAR" => $sheetData[$worksheet[0]][$i][4],
										"NAMA_PEMASOK" => $sheetData[$worksheet[0]][$i][5],
										"ALAMAT_PEMASOK" => $sheetData[$worksheet[0]][$i][6],
										"KODE_NEGARA_PEMASOK" => $sheetData[$worksheet[0]][$i][7],
										"NOMOR_IJIN_TPB" => $sheetData[$worksheet[0]][$i][8],
										"TANGGAL_IJIN_TPB" => date('Y-m-d',strtotime($sheetData[$worksheet[0]][$i][9])),
										"NPWP" => $sheetData[$worksheet[0]][$i][10],
										"NAMA_PENGUSAHA" => $sheetData[$worksheet[0]][$i][11],
										"ALAMAT_PENGUSAHA" => $sheetData[$worksheet[0]][$i][12],
										"ID_PPJK" => $sheetData[$worksheet[0]][$i][13],
										"NAMA_PPJK" => $sheetData[$worksheet[0]][$i][14],
										"ALAMAT_PPJK" => $sheetData[$worksheet[0]][$i][15],
										"NPPPJK" => $sheetData[$worksheet[0]][$i][16],
										"TANGGAL_NPPPJK" => date('Y-m-d',strtotime($sheetData[$worksheet[0]][$i][17])),
										"NAMA_PENGANGKUT" => $sheetData[$worksheet[0]][$i][18],
										"NOMOR_VOY_FLIGHT" => $sheetData[$worksheet[0]][$i][19],
										"NOMOR_BC11" => $sheetData[$worksheet[0]][$i][20],
										"TANGGAL_BC11" => date('Y-m-d',strtotime($sheetData[$worksheet[0]][$i][21])),
										"POS_BC11" => $sheetData[$worksheet[0]][$i][22],
										"KODE_TPS" => $sheetData[$worksheet[0]][$i][23],
										"KODE_VALUTA" => $sheetData[$worksheet[0]][$i][24],
										"KURS" => $sheetData[$worksheet[0]][$i][25],
										"FOB" => $sheetData[$worksheet[0]][$i][26],
										"CIF" => $sheetData[$worksheet[0]][$i][27],
										"CIF_RUPIAH" => $sheetData[$worksheet[0]][$i][28],
										"BRUTO" => $sheetData[$worksheet[0]][$i][29],
										"NETTO" => $sheetData[$worksheet[0]][$i][30],
										"JUMLAH_BARANG" => $sheetData[$worksheet[0]][$i][31],
										"KODE_TUJUAN_TPB" => $sheetData[$worksheet[0]][$i][32],
										"JUMLAH_KONTAINER" => $sheetData[$worksheet[0]][$i][33],
										"JUMLAH_KEMASAN" => $sheetData[$worksheet[0]][$i][34],
										"ID_PENERIMA" => $sheetData[$worksheet[0]][$i][35],
										"NAMA_PENERIMA" => $sheetData[$worksheet[0]][$i][36],
										"ALAMAT_PENERIMA" => $sheetData[$worksheet[0]][$i][37],
										"NOMOR_API_PENERIMA" => $sheetData[$worksheet[0]][$i][38],
										"NOMOR_API_PEMILIK" => $sheetData[$worksheet[0]][$i][39],
										"KODE_KANTOR_TUJUAN" => $sheetData[$worksheet[0]][$i][40],
										"NOMOR_IZIN_TPB_PENERIMA" => $sheetData[$worksheet[0]][$i][41],
										"ID_PENGIRIM" => $sheetData[$worksheet[0]][$i][42],
										"NAMA_PENGIRIM" => $sheetData[$worksheet[0]][$i][43],
										"ALAMAT_PENGIRIM" => $sheetData[$worksheet[0]][$i][44],
										"ID_IMPORTIR" => $sheetData[$worksheet[0]][$i][45],
										"NAMA_IMPORTIR" => $sheetData[$worksheet[0]][$i][46],
										"ALAMAT_IMPORTIR" => $sheetData[$worksheet[0]][$i][47],
										"NOMOR_API_IMPORTIR" => $sheetData[$worksheet[0]][$i][48],
										"NIK" => $sheetData[$worksheet[0]][$i][49],
									);
								}

							}
						}
					}	
					// Get Data From Sheet 2
					if(isset($worksheet[1])){
						if($highestRow[$worksheet[1]] > 1){
							for ($i=1; $i <= max(array_keys($sheetData[$worksheet[1]])) ; $i++) {
								$dataInput['barang'][] = array(
									"NOMOR_AJU" => $sheetData[$worksheet[1]][$i][1],
									"HS_CODE" => $sheetData[$worksheet[1]][$i][2],
									"SERI_BARANG" => $sheetData[$worksheet[1]][$i][3],
									"NAMA_BARANG" => $sheetData[$worksheet[1]][$i][4],
									"MERK" => $sheetData[$worksheet[1]][$i][5],
									"TIPE" => $sheetData[$worksheet[1]][$i][6],
									"KODE_BARANG" => $sheetData[$worksheet[1]][$i][7],
									"JUMLAH_SATUAN" => $sheetData[$worksheet[1]][$i][8],
									"KODE_SATUAN" => $sheetData[$worksheet[1]][$i][9],
									"HARGA_SATUAN" => $sheetData[$worksheet[1]][$i][10],
									"CIF" => $sheetData[$worksheet[1]][$i][11],
									"CIF_RUPIAH" => $sheetData[$worksheet[1]][$i][12],
									"JUMLAH_KEMASAN" => $sheetData[$worksheet[1]][$i][13],
									"KODE_KEMASAN" => $sheetData[$worksheet[1]][$i][14],
									"KODE_NEGARA_ASAL" => $sheetData[$worksheet[1]][$i][15],
									"KODE_JENIS_NILAI" => $sheetData[$worksheet[1]][$i][16],
									"SKA" => $sheetData[$worksheet[1]][$i][17]
								);
							}
						}
					}
					// Get Data From Sheet 3
					if(isset($worksheet[2])){
						if ($highestRow[$worksheet[2]] > 1) {
							for ($i=1; $i <= max(array_keys($sheetData[$worksheet[2]])) ; $i++) { 
								$dataInput['barangTarif'][] = array(
									"NOMOR_AJU" => $sheetData[$worksheet[2]][$i][1],
									"SERI_BARANG" => $sheetData[$worksheet[2]][$i][2],
									"KODE_BARANG" => $sheetData[$worksheet[2]][$i][3],
									"NAMA_BARANG" => $sheetData[$worksheet[2]][$i][4],
									"JENIS_TARIF" => $sheetData[$worksheet[2]][$i][5],
									"TARIF" => $sheetData[$worksheet[2]][$i][6],
									"NILAI_BAYAR" => $sheetData[$worksheet[2]][$i][7],
									"KODE_FASILITAS" => $sheetData[$worksheet[2]][$i][8],
									"TARIF_FASILITAS" => $sheetData[$worksheet[2]][$i][9],
									"NILAI_FASILITAS" => $sheetData[$worksheet[2]][$i][10],
								);
							}
						}
					}
					// Get Data From Sheet 4
					if(isset($worksheet[3])){
						if ($highestRow[$worksheet[3]] > 1) {
							for ($i=1; $i <= max(array_keys($sheetData[$worksheet[3]])) ; $i++) { 
								$dataInput['dokumenPelengkap'][] = array(
									"NOMOR_AJU" => $sheetData[$worksheet[3]][$i][1],
									"JENIS_DOKUMEN" => $sheetData[$worksheet[3]][$i][2],
									"NOMOR_DOKUMEN" => $sheetData[$worksheet[3]][$i][3],
									"TANGGAL_DOKUMEN" => date('Y-m-d',strtotime($sheetData[$worksheet[3]][$i][4])),
									"FLAG_TERIMA" => $sheetData[$worksheet[3]][$i][5],
								);
							}
						}
					}
					// Get Data From Sheet 5
					if(isset($worksheet[4])){
						if ($highestRow[$worksheet[4]] > 1) {
							for ($i=1; $i <= max(array_keys($sheetData[$worksheet[4]])) ; $i++) { 
								$dataInput['pungutanDokumen'][] = array(
									"NOMOR_AJU" => $sheetData[$worksheet[4]][$i][1],
									"JENIS_TARIF" => $sheetData[$worksheet[4]][$i][2],
									"NILAI_PUNGUTAN" => $sheetData[$worksheet[4]][$i][3],
									"KODE_FASILITAS" => $sheetData[$worksheet[4]][$i][4],
								);
							}
						}
					}
					// Get Data From Sheet 6
					if(isset($worksheet[5])){
						if ($highestRow[$worksheet[5]] > 1) {
							for ($i=1; $i <= max(array_keys($sheetData[$worksheet[5]])) ; $i++) { 
								$dataInput['bahanBaku'][] = array(
									"NOMOR_AJU" => $sheetData[$worksheet[5]][$i][1],
									"SERI_BARANG" => $sheetData[$worksheet[5]][$i][2],
									"KODE_BARANG" => $sheetData[$worksheet[5]][$i][3],
									"HS_CODE" => $sheetData[$worksheet[5]][$i][4],
									"JENIS_SATUAN" => $sheetData[$worksheet[5]][$i][5],
									"JUMLAH_SATUAN" => $sheetData[$worksheet[5]][$i][6],
									"CIF" => $sheetData[$worksheet[5]][$i][7],
									"CIF_RUPIAH" => $sheetData[$worksheet[5]][$i][8],
									"HARGA_PENYERAHAN" => $sheetData[$worksheet[5]][$i][9],
									"JENIS_DOK_ASAL" => $sheetData[$worksheet[5]][$i][10],
									"NOMOR_AJU_DOK_ASAL" => $sheetData[$worksheet[5]][$i][11],
									"TANGGAL_DAFTAR_DOK_ASAL" => date('Y-m-d',strtotime($sheetData[$worksheet[5]][$i][12])),
									"KODE_KANTOR" => $sheetData[$worksheet[5]][$i][13],
								);
							}
						}
					}
					// // Get Data From Sheet 7
					if(isset($worksheet[6])){
						if ($highestRow[$worksheet[1]] > 1) {
							for ($i=1; $i <= max(array_keys($sheetData[$worksheet[6]])) ; $i++) { 
								$dataInput['kemasan'][] = array(
									"NOMOR_AJU" => $sheetData[$worksheet[6]][$i][1],
									"JUMLAH_KEMASAN" => $sheetData[$worksheet[6]][$i][2],
									"KODE_JENIS_KEMASAN" => $sheetData[$worksheet[6]][$i][3],
									"MERK_KEMASAN" => $sheetData[$worksheet[6]][$i][4],
									"KETERANGAN" => $sheetData[$worksheet[6]][$i][5],
									"NOMOR_POLISI" => $sheetData[$worksheet[6]][$i][6],
									"NOMOR_SEGEL" => $sheetData[$worksheet[6]][$i][7],
									"WAKTU_GATE_IN" =>  date('Y-m-d H:i:s',strtotime($sheetData[$worksheet[6]][$i][8])),
									"NIP_GATE_IN" => $sheetData[$worksheet[6]][$i][9],
									"WAKTU_GATE_OUT" =>  date('Y-m-d H:i:s',strtotime($sheetData[$worksheet[6]][$i][10])),
									"NIP_GATE_OUT" => $sheetData[$worksheet[6]][$i][11],
								);
							}
						}
					}
					// Get Data From Sheet 8
					if(isset($worksheet[7])){
						if ($highestRow[$worksheet[7]] > 1) {
							for ($i=1; $i <= max(array_keys($sheetData[$worksheet[7]])) ; $i++) {
								$dataInput['kontainer'][] = array(
									"NOMOR_AJU" => $sheetData[$worksheet[7]][$i][1],
									"NOMOR_KONTAINER" => $sheetData[$worksheet[7]][$i][2],
									"KODE_UKURAN_KONTAINER" => $sheetData[$worksheet[7]][$i][3],
									"KODE_TIPE_KONTAINER" => $sheetData[$worksheet[7]][$i][4],
									"NOMOR_POLISI" => $sheetData[$worksheet[7]][$i][5],
									"NOMOR_SEGEL" => $sheetData[$worksheet[7]][$i][6],
									"WAKTU_GATE_IN" => date('Y-m-d H:i:s',strtotime($sheetData[$worksheet[7]][$i][7])),
									"NIP_GATE_IN" => $sheetData[$worksheet[7]][$i][8],
									"WAKTU_GATE_OUT" =>  date('Y-m-d H:i:s',strtotime($sheetData[$worksheet[7]][$i][9])),
									"NIP_GATE_OUT" => $sheetData[$worksheet[7]][$i][10],
								);
							}
						}
					}
				}

				$status = $this->dataupload->addData($dataInput);
				if ($status === TRUE) {
					$pesan = "Berhasil Upload Data";
				} else {
					$pesan = "Gagal Upload Data";
				}

				echo json_encode(
					array(
						'pesan' => $pesan,
						'data' => $data,
						'row' => $highestRow,
						'excel' => $dataInput,
						'column' => $higestColumn
					)
				);
			}

		} else {
			$status = "Gagal Upload Data";
			$data = array($_POST,$_FILES);

			echo json_encode(
				array(
					'status' => $status,
					'data' => $data,
				)
			);
		}
	}

	public function uploadNopen(){
		// Cek Hak Akases Administrator
		if($this->login->CekAdminHakAkses($this->session->userdata('IdUser')) === TRUE ){
			// Cek Ada atau tidak file yang di upload
			if(!empty($_FILES["dataNopen"]["name"])){
				// proses upload file
				$dir = "assets/upload/nopen/";
				$config["upload_path"] = $dir;
				$config["allowed_types"] = "xls|xlsx";
				$config["file_name"] = date("Y-m-d").'_'.rand(000000,999999);

				$this->load->library('upload', $config); 

				if(! $this->upload->do_upload('dataNopen')){
					echo $this->upload->display_errors();
				} else {
					$dataPost = array($_POST,$_FILES);
					$data = $this->upload->data();

					// Setelah Berhasil Upload, Proses File Excel di Server untuk di proses dengan PHPExcel
					$file_type = PHPExcel_IOFactory::identify($dir.$data['file_name']);
					$objReader = PHPExcel_IOFactory::createReader($file_type);
					$objPHPExcel = $objReader->load($dir.$data['file_name']);
					$worksheet = $objReader->listWorksheetNames($dir.$data['file_name']);
					foreach ($worksheet as $key => $sheetName) {
						$sheetData[$sheetName] = $objPHPExcel->getSheetByName($sheetName)->toArray(null,true,true);
						$highestRow[$sheetName] = $objPHPExcel->getSheetByName($sheetName)->getHighestRow();
					}

					foreach ($worksheet as $key => $sheetName) {
						if ($highestRow[$sheetName] > 1){
							for ($i=1; $i <= max(array_keys($sheetData[$sheetName])) ; $i++) { 
								$dataInput[$sheetName][] = array(
									'NOMOR_AJU' => $sheetData[$sheetName][$i][1],
									'NPWP' => $sheetData[$sheetName][$i][2],
									'NAMA_PERUSAHAAN' => $sheetData[$sheetName][$i][3],
									'SKEP' => $sheetData[$sheetName][$i][4],
									'DOKUMEN' => substr($sheetData[$sheetName][$i][5],3,3),
									'NOMOR_DAFTAR' => $sheetData[$sheetName][$i][6],
									'TANGGAL_DAFTAR' => date('Y-m-d',strtotime($sheetData[$sheetName][$i][7])),
									'STATUS' => $sheetData[$sheetName][$i][8]
								);
							}
						}
					}

					$status = $this->dataupload->addNopen($dataInput);
					if ($status === TRUE) {
						$pesan = "Berhasil Upload Data";
					} else {
						$pesan = "Gagal Upload Data";
					}

					echo json_encode(
						array(
							'pesan' => $pesan,
							'data' => $data,
							'row' => $highestRow,
							'excel' => $dataInput,
							'sheet' => $sheetData
						)
					);
				}				
			}

		} else {
			$status = "Gagal Upload Data";
			$data = array($_POST,$_FILES);

			echo json_encode(
				array(
					'status' => $status,
					'data' => $data,
				)
			);
		}
	}

	public function test(){

		$variable = $this->dokumen->getJumlahDokumenTahunBerjalan();
		foreach ($variable as $value) {
			print_r($value);
			echo "<br>";
		}

		print_r($variable->result());
	}

}

/* End of file uploaddata.php */
/* Location: ./application/controllers/uploaddata.php */