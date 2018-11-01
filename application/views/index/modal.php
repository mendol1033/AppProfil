<style type="text/css">
.tableLabel{
	width: 25%;
}
.semicolon{
	width: 2%;
}
</style>
<div class="modal fade" id="modal" role="dialog" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-xxl modal-xl modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="close">
					<span aria-hidden="true">&times;</span>
				</button>
				<ul class="nav nav-tabs">
					<li class="active"><a href="#profil" data-toggle="tab" aria-expanded="true">Profil Perusahaan</a></li>
					<li class=""><a href="#timeline" data-toggle="tab" aria-expanded="false">Timeline</a></li>
					<li class=""><a href="#settings" data-toggle="tab" aria-expanded="false">Settings</a></li>
				</ul>
			</div>
			<div class="modal-body">
				<div class="row">
					
					<div class="tab-content">
						<div class="tab-pane active" id="profil">
							<div class="col-md-3">
								
							</div>
							<div class="col-md-9">
								<table class="table table-striped table-hover">
									<tbody>
										<tr>
											<td class="tableLabel"><b>NPWP</b></td>
											<td class="semicolon">:</td>
											<td id="NPWP"></td>
										</tr>
										<tr>
											<td class="tableLabel"><b>NAMA PERUSAHAAN</b></td>
											<td class="semicolon">:</td>
											<td id="ProfilNama"></td>
										</tr>
										<tr>
											<td class="tableLabel"><b>NAMA PERUSAHAAN</b></td>
											<td class="semicolon">:</td>
											<td id="ProfilNama"></td>
										</tr>
									</tbody>
								</table>
							</div>	
						</div>
						<!-- /.tab-pane -->
						<div class="tab-pane" id="timeline">
							
						</div>
						<!-- /.tab-pane -->

						<div class="tab-pane" id="settings">
							<div class="row">
								<div class="col-lg-12">
									<form id="form" class="form-horizontal" novalidate="true">
										<dir class="col-md-3">
											<label class="control-label" id="labelCCTV">Pilih Alamat CCTV</label>
										</dir>
										<div class="col-md-9">
											<select class="form-control select2" id="CCTV" name="CCTV"></select>
										</div>
									</form>
								</div>
							</div>
						</div>
						<!-- /.tab-pane -->
					</div>
					<!-- /.tab-content -->
				</div>
				<!-- /.nav-tabs-custom -->
			</div>
			<div class="modal-footer">
				<button type="button" id="tutup" class="btn btn-default" data-dismiss="modal">Tutup</button>
				<button type="button" id="simpan" class="btn btn-primary" onclick="save()">Simpan</button>
			</div>
		</div>
	</div>
</div>
<script src="<?php echo base_url().'assets/js/profil.js';?>"></script>