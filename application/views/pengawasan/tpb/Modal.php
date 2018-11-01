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
					<input type="hidden" name="NipUser" value="<?php echo $this->session->userdata('NipUser');?>">
					<div class="form-group">
						<div class="col-md-3">
							<label class="control-label" id="labelNPWP">NPWP</label>
						</div>
						<div class="col-md-9">
							<input class="form-control" id="NPWP" name="NPWP"></input>
							<span class="help-block"></span>
						</div>
					</div>
					<div id="DropdownPerusahaan" class="form-group">
						<div class="col-md-3">
							<label class="control-label" id="labelPerusahaan">Nama Perusahaan</label>
						</div>
						<div class="col-md-9">
							<input class="form-control" id="NamaPerusahaan" name="NamaPerusahaan"></input>
							<span class="help-block"></span>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-3">
							<label class="control-label" id="labelFasilitas">Jenis Fasilitas</label>
						</div>
						<div class="col-md-3">
							<?php echo form_dropdown('Fasilitas', $options['fasTPB'],'', 'class="form-control select2" id="Fasilitas"'); ?>
						</div>
						<div class="col-md-2">
							<label class="control-label" id="labelJenis">Jenis TPB</label>
						</div>
						<div class="col-md-4">
							<?php echo form_dropdown('Jenis', $options['jenisTPB'],'', 'class="form-control select2" id="Jenis"'); ?>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-3">
							<label class="control-label" id="labelAlamatPabrik">Alamat Pabrik</label>
						</div>
						<div class="col-md-9">
							<input id="AlamatPabrik" class="form-control" type="text" name="AlamatPabrik">
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-3">
							<label class="control-label" id="labelAlamatKantor">Alamat Kantor</label>
						</div>
						<div class="col-md-9">
							<input id="AlamatKantor" class="form-control" type="text" name="AlamatKantor">
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-3">
							<label class="control-label" id="labelProfilResiko">Profil Resiko</label>
						</div>
						<div class="col-md-9">
							<?php echo form_dropdown('ProfilResiko', $options['ProfilResiko'],'', 'class="form-control select2" id="ProfilResiko"'); ?>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-3">
							<label class="control-label" id="labelNoSkepPendirian">No Skep Pendirian</label>
						</div>
						<div class="col-md-4">
							<input id="NoSkepPendirian" class="form-control" type="text" name="NoSkepPendirian">
						</div>
						<div class="col-md-2">
							<label class="control-label" id="labelTglSkepPendirian">Tgl Skep Pendirian</label>
						</div>
						<div class="col-md-3">
							<input id="TglSkepPendirian" class="form-control" type="text" name="TglSkepPendirian">
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-3">
							<label class="control-label" id="labelNoSkepAkhir">No Skep Terbaru</label>
						</div>
						<div class="col-md-4">
							<input id="NoSkepAkhir" class="form-control" type="text" name="NoSkepAkhir">
						</div>
						<div class="col-md-2">
							<label class="control-label" id="labelTglSkepAkhir">Tgl Skep Terbaru</label>
						</div>
						<div class="col-md-3">
							<input id="TglSkepAkhir" class="form-control" type="text" name="TglSkepAkhir">
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-3">
							<label class="control-label" id="labelKategoriUsaha">Kategori Usaha</label>
						</div>
						<div class="col-md-4">
							<input id="KategoriUsaha" class="form-control" type="text" name="KategoriUsaha">
						</div>
						<div class="col-md-2">
							<label class="control-label" id="labelTglJatuhTempo">Tgl Jatuh Tempo</label>
						</div>
						<div class="col-md-3">
							<input id="TglJatuhTempo" class="form-control" type="text" name="TglJatuhTempo">
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-3">
							<label class="control-label" id="labelNamaPenanggungJawab">Nama Penanggung Jawab</label>
						</div>
						<div class="col-md-4">
							<input id="NamaPenanggungJawab" class="form-control" type="text" name="NamaPenanggungJawab">
						</div>
						<div class="col-md-2">
							<label class="control-label" id="labelWNPenanggungJawab">Warga Negara</label>
						</div>
						<div class="col-md-3">
							<input id="WNPenanggungJawab" class="form-control" type="text" name="WNPenanggungJawab">
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-3">
							<label class="control-label" id="labelLuas">Luas Pabrik</label>
						</div>
						<div class="col-md-9">
							<input id="Luas" class="form-control" type="text" name="Luas">
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-3">
							<label class="control-label" id="labelStatus">Status</label>
						</div>
						<div class="col-md-9">
							<select class="form-control select2" id="Status" name="Status">
								<option value="Y">Aktif</option>
								<option value="N">Tidak Aktif</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-3">
							<label class="control-label" id="labelLokasi">Lokasi Perusahaan</label>
						</div>
						<div class="col-md-9">
							<?php echo form_dropdown('Lokasi', $options['Lokasi'],'', 'class="form-control select2" id="Lokasi"'); ?>
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