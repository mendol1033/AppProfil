<?php $attrib_label= array( 'class' => 'col-sm-3 control-label') ;?>
<?php $form = array(
	'NPWP' => array(
		'id' => 'NPWP',
		'name' => 'NPWP',
		'class' => 'form-control'
	),	
	'NamaPerusahaan' => array(	
		'id' => 'namatpb',
		'name' => 'namatpb',
		'class' => 'form-control',
	),
	'Telepon' => array(	
		'id' => 'telepon',
		'name' => 'telepon',
		'class' => 'form-control',
	),
	'Fax' => array(	
		'id' => 'fax',
		'name' => 'fax',
		'class' => 'form-control',
	),
	'Alamat' =>	array(
		'id' => 'alamat',
		'name' => 'alamat',	
		'class' => 'form-control',
		'rows' => '2',
	),
	'Provinsi' => array(
		'id' => 'provinsi',
		'name' => 'provinsi',	
		'class' => 'form-control',
	),
	'Kota' => array(
		'id' => 'kota',
		'name' => 'kota',		
		'class' => 'form-control',
	),
	'Kecamatan' =>	array(	
		'id' => 'kecamatan',
		'name' => 'kecamatan',	
		'class' => 'form-control',
	),
	'Kelurahan' =>	array(	
		'id' => 'kelurahan',
		'name' => 'kelurahan',	
		'class' => 'form-control',
	),
	'KodePos' => array(	
		'id' => 'kodepos',
		'name' => 'kodepos',	
		'class' => 'form-control',
	),
	'IzinKelola' => array(
		'id' => 'izin',
		'name' => 'izin',
		'class' => 'form-control',
	),
	'Latitude' => array(
		'id' => 'latitude',
		'name' => 'latitude',
		'class' => 'form-control',
	),
	'Longitude' => array(
		'id' => 'longitude',
		'name' => 'longitude',
		'class' => 'form-control',
	),
);	
?>

<div class="modal fade" id="modal" role="dialog" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Disini Modal Title</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" id="form" novalidate="true">
					<div class="form-group">
						<?php echo form_label('NPWP', 'labelNPWP', $attrib_label);?>
						<div class="col-sm-9">
							<?php echo form_input($form['NPWP']); ?>
						</div>
					</div>
					<div class="form-group">
						<?php echo form_label('Nama Perusahaan', 'labelNmPerusahaan', $attrib_label); ?>
						<div class="col-sm-9">
							<?php echo form_input($form['NamaPerusahaan']); ?>
							<span class="help-blok"></span>
						</div>
					</div>
					<div class="form-group">
						<?php echo form_label('Telepon', 'labelTelepon', $attrib_label); ?>
						<div class="col-sm-9">
							<?php echo form_input($form['Telepon']); ?>
							<span class="help-blok"></span>
						</div>
					</div>
					<div class="form-group">
						<?php echo form_label('Fax', 'fax', $attrib_label); ?>
						<div class="col-sm-9">
							<?php echo form_input($form['Fax']); ?>
							<span class="help-blok"></span>
						</div>
					</div>
					<div class="form-group">
						<?php echo form_label('Alamat', 'labelAlamat', $attrib_label); ?>
						<div class="col-sm-9">
							<?php echo form_textarea($form['Alamat']); ?>
							<span class="help-blok"></span>
						</div>
					</div>
					<div class="form-group">
						<?php echo form_label('Provinsi', 'labelProvinsi', $attrib_label); ?>
						<div class="col-sm-9">
							<select id="Provinsi" name="provinsi" class="form-control select2"></select>
							<span class="help-blok"></span>
						</div>
					</div>
					<div class="form-group">
						<?php echo form_label('Kota', 'labelKota', $attrib_label); ?>
						<div class="col-sm-9">
							<select id="Kota" name="kota" class="form-control select2"></select>
							<span class="help-blok"></span>
						</div>
					</div>
					<div class="form-group">
						<?php echo form_label('Kecamatan', 'labelKecamatan', $attrib_label); ?>
						<div class="col-sm-9">
							<select id="Kecamatan", name="kecamatan" class="form-control select2"></select>
							<span class="help-blok"></span>
						</div>
					</div>
					<div class="form-group">
						<?php echo form_label('Kelurahan', 'labelKelurahan', $attrib_label); ?>
						<div class="col-sm-9">
							<select id="Kelurahan" name="kelurahan" class="form-control select2"></select>
							<span class="help-blok"></span>
						</div>
					</div>
					<div class="form-group">
						<?php echo form_label('Kode Pos', 'labelKodePos', $attrib_label); ?>
						<div class="col-sm-9">
							<?php echo form_input($form['KodePos']); ?>
							<span class="help-blok"></span>
						</div>
					</div>
					<div class="form-group">
						<?php echo form_label('Jenis TPB', 'labelJenisTPB', $attrib_label); ?>
						<div class="col-sm-9">
							<?php echo form_dropdown('JenisTPB', $option1,'', 'class="form-control select2" id="JenisTPB"'); ?>
							<span class="help-blok"></span>
						</div>
					</div>
					<div class="form-group">
						<?php echo form_label('Lokasi TPB', 'labelLokasiTPB', $attrib_label); ?>
						<div class="col-sm-9">
							<?php echo form_dropdown('LokasiTPB', $option2,'', 'class="form-control select2" id="LokasiTPB"'); ?>
							<span class="help-blok"></span>
						</div>
					</div>
					<div class="form-group">
						<?php echo form_label('No Skep Izin TPB', 'labelIzinKelola', $attrib_label); ?>
						<div class="col-sm-9">
							<?php echo form_input($form['IzinKelola']); ?>
							<span class="help-blok"></span>
						</div>
					</div>
					<div class="form-group">
						<?php echo form_label('Latitude', 'labelLatitude', $attrib_label); ?>
						<div class="col-sm-9">
							<?php echo form_input($form['Latitude']); ?>
							<span class="help-blok"></span>
						</div>
					</div>
					<div class="form-group">
						<?php echo form_label('Longitude', 'labelLongitude', $attrib_label); ?>
						<div class="col-sm-9">
							<?php echo form_input($form['Longitude']); ?>
							<span class="help-blok"></span>
						</div>
					</div>
					<div class="form-group">
						<?php echo form_label('Hanggar TPB', 'labelHanggar', $attrib_label); ?>
						<div class="col-sm-9">
							<?php echo form_dropdown('Hanggar', $option3, '', 'class="form-control select2" id="Hanggar"'); ?>
							<span class="help-blok"></span>
						</div>
					</div>
					<div class="form-group">
						<?php echo form_label('Status', 'labelStatus', $attrib_label); ?>
						<div class="col-sm-9">
							<select name="status" id="status" class="form-control select2">
								<option value="">Pilih Status Perusahaan</option>
								<option value="Y">Aktif</option>
								<option value="N">Tidak Aktif</option>
							</select>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" id="tutup" class="btn btn-default" data-dismiss="modal">Tutup</button>
				<button type="button" id="simpan" class="btn btn-primary" onclick="save()">Simpan</button>
			</div>
		</div>
	</div>
</div>