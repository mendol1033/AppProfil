<section class="form">
	<div class="container-fluid">
		<?php if (isset($JudulPanelBesar)){?>
			<header><h3><?php echo $JudulPanelBesar; ?></h3></header>
		<?php }?>
		<div class="row">
			<div class="col-lg-6 col-md-6 col-sm-6">
				<!-- <form id="formFilter" class="form-horizontal" novalidate="true"> -->
					<div class="form-group">
						<div class="col-lg-4 col-md-4 col-sm-4">
							<label class="control-label">Nama Perusahaan</label>
						</div>
						<div class="col-lg-8 col-md-8 col-sm-8">
							<input type="text" name="filterPerusahaan" class="form-control" id="filterPerusahaan" autocomplete="off">
							<!-- <?php echo form_dropdown('filterPerusahaan', '', '', 'class="form-control" id="filterPerusahaan"'); ?> -->
						</div>
					</div>
					<!-- FILTER TANGGAL -->
					<!-- <div class="form-group">
						<div class="col-lg-4 col-md-4 col-sm-4">
							<label class="control-label">Tanggal</label>
						</div>
						<div>
							<div class="col-lg-4 col-md-4 col-sm-4">
								<input type="text" id="tglAwal" name="tglAwal" class="form-control">
							</div>
							<div class="col-lg-4 col-md-4 col-sm-4">
								<input type="text" id="tglAkhir" name="tglAkhir" class="form-control">
							</div>
						</div>
					</div> -->
				<!-- </form> -->
			</div>
		<!-- </div> -->
		<!-- <div class="row"> -->
			<!-- <div class="col-lg-6 col-md-6 col-sm-6">
				<div class="col-lg-12 col-md-12 col-sm-12">
					<div class="row">
						<button type="button" class="btn btn-primary pull-left" id="btnFilter" style="margin-right: 5px;"><i class="fa fa-search"></i>&nbsp;Filter</button>
						<button type="button" class="btn btn-danger pull-left" id="clearFilter"><i class="fa fa-close"></i>&nbsp;Clear</button>
					</div>
				</div>
			</div> -->
			<div class="col-lg-6 col-md-6 col-sm-6">
				<button type="button" class="btn btn-primary pull-right " id="btnTambah" style="margin-bottom: 5px;">TAMBAH</button>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12">
				<div class="box box-default">
					<div class="box-body">
						<table id="dataTable" class="table table-striped table-responsive table-hover">
							<thead>
								<tr>
									<th style="width: 5%;">No</th>
									<th style="width: 15%;">NPWP</th>
									<th style="width: 30%;">Nama Perusahaan</th>
									<th>Alamat</th>
									<th style="width: 7%">Status</th>
									<th style="width: 5%;">View</th>
									<th style="width: 5%;">Edit</th>
								</tr>
							</thead>
							<tbody></tbody>
							<tfoot>
								<tr>
									<th>No</th>
									<th>NPWP</th>
									<th>Nama Perusahaan</th>
									<th>Alamat</th>
									<th>Status</th>
									<th>View</th>
									<th>Edit</th>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- <?php print_r($options); ?> -->
<?php if(isset($modal)){$this->load->view($modal);} ?>
<?php if(isset($js)){$this->load->view($js);} ?>