<div class="modal fade" id="modal" role="dialog" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Disini Modal Title</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" id="formCCTV" novalidate="true">
					<input type="hidden" name="NipUser" value="<?php echo $this->session->userdata('NipUser');?>">
					<div id="DropdownPerusahaan" class="form-group">
						<div class="col-md-3">
							<label class="control-label" id="labelPerusahaan">Nama Perusahaan</label>
						</div>
						<div class="col-md-9">
							<select class="form-control select2" id="NamaPerusahaan" name="NamaPerusahaan"></select>
							<span class="help-block"></span>
						</div>
					</div>
					<div id="InputPerusahaan" class="form-group sr-only">
						<div class="col-md-3">
							<label class="control-label" id="labelPerusahaan">Nama Perusahaan</label>
						</div>
						<div class="col-md-9">
							<input id="PerusahaanInput" class="form-control" type="text" name="PerusahaanInput">
							<span class="help-block"></span>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-3">
							<label class="control-label" id="labelBrowser">Jenis Browser</label>
						</div>
						<div class="col-md-9">
							<?php echo form_dropdown('Browser', $browserOptions,'', 'class="form-control select2" id="Browser"'); ?>
						</div>
					</div>
					<!-- <div class="form-group">
						<div class="col-md-3">
							<label class="control-label" id="labelCctvType">Tipe CCTV</label>
						</div>
						<div class="col-md-9">
							<?php echo form_dropdown('cctvType', $cctvType,'', 'class="form-control select2" id="cctvType"'); ?>
						</div>
					</div> -->
					<div class="form-group">
						<div class="col-md-3">
							<label class="control-label" id="labelIpAddress">Ip Address</label>
						</div>
						<div class="col-md-9">
							<input id="IpAddress" class="form-control" type="text" name="IpAddress" placeholder="IP Addres IT Inventory" autocomplete="off">
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-3">
							<label class="control-label" id="labelUsername">Username</label>
						</div>
						<div class="col-md-9">
							<input id="Username" class="form-control" type="text" name="Username" placeholder="Username Akses IT Inventory" autocomplete="off">
						</div> 
					</div>
					<div class="form-group">
						<div class="col-md-3">
							<label class="control-label" id="labelPassword">Password</label>
						</div>
						<div class="col-md-9">
							<input id="Password" class="form-control" type="text" name="Password" placeholder="Password Akses IT Inventory" autocomplete="off">
						</div>
					</div>
					<div class="row">
						<div class="form-group">
							<div class="col-md-1"></div>
							<div class="col-md-2">
								<label class="control-label" id="labelStatus">Status</label>
							</div>
							<div class="col-md-3">
								<select id="Status" class="form-control select2" name="Status">
									<option value="Y">Aktif</option>
									<option value="N">Tidak Aktif</option>
								</select>
							</div>
							<div class="col-md-2">
								<label class="control-label" id="labelRealtime">Realtime</label>
							</div>
							<div class="col-md-3">
								<select id="Realtime" class="form-control select2" name="Realtime">
									<option value="Y">Realtime</option>
									<option value="N">Tidak Realtime</option>
								</select>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-3">
							<label class="control-label" id="labelKeterangan">Keterangan</label>
						</div>
						<div class="col-md-9">
							<textarea id="Keterangan" class="form-control" name="Keterangan" rows="4" placeholder="Keterangan diisi dengan cara membuka IT Inventory bila IT Invetory tidak menggunakan Web Browser atau diisi dengan Keterangan lainnya"></textarea>
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