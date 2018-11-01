<section class="form">
	<div class="container-fluid">
		<?php if (isset($JudulPanelBesar)){?>
		<header><h3><?php echo $JudulPanelBesar; ?></h3></header>
		<?php }?>
		<div class="row">
			<div class="col-lg-6 col-md-12 col-xs-12">
				<div class="box" id="Dokumen">
					<div class="box-header">
						Upload Data Dokumen
					</div>
					<div class="box-body" id="DokumenBody">
						<div class="row sr-only" id="feedbackArea">
							<div class="col-md-10 col-sm-10">
								<p class="text-warning">
									<strong id="feedbackApp"></strong>
								</p>
							</div>
							<div class="col-md-1 col-sm-2">
								<button type="button" class="close" onclick="removeFeedback()">x</button>
							</div>
						</div>
						<?php $hidden = array('IdUser' => $IdUser) ;?>
						<div class="row">
							<?php echo form_open_multipart('#', ' id="form_uploadDokumen" class="form-inline" enctype="multipart/form-data"',$hidden); ?>
							<div class="col-md-8 col-sm-8">
								<?php echo form_upload('dataExcel','','id = "dataExcel" class="form-control" style="width:100%;"'); ?>
								<span class="help-block"></span>
							</div>
							<div class="col-md-4 col-sm-4">
								<button id="button_uploadDokumen" type="submit" class="btn btn-success">UPLOAD</button>
							</div>
							<?php echo form_close(); ?>
						</div>
					</div>
					<div id="loadingState" class="overlay sr-only">
						<i class="fa fa-refresh fa-spin"></i>
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-md-12 col-xs-12">
				<div class="box" id="Nopen">
					<div class="box-header">
						Upload Data Nopen Dokumen
					</div>
					<div class="box-body" id="NopenBody">
						<div class="row sr-only" id="feedbackArea">
							<div class="col-md-10 col-sm-10">
								<p class="text-warning"><strong id="feedbackApp"></strong></p>
							</div>
							<div class="col-md-1 col-sm-2">
								<button type="button" class="close" onclick="removeFeedback()">x</button>
							</div>
						</div>
						<?php $hidden1 = array('IdUser' => $IdUser) ;?>
						<div class="row">
							<?php echo form_open_multipart('#', ' id="form_uploadNopen" class="form-inline" enctype="multipart/form-data"',$hidden1); ?>
							<div class="col-md-8 col-sm-8">
								<?php echo form_upload('dataNopen','','id = "dataNopen" class="form-control" style="width:100%;"'); ?>
								<span class="help-block"></span>
							</div>
							<div class="col-md-4 col-sm-4">
								<button id="button_uploadDokumen" type="submit" class="btn btn-success">UPLOAD</button>
							</div>
							<?php echo form_close(); ?>
						</div>
					</div>
					<div id="loadingState" class="overlay sr-only">
						<i class="fa fa-refresh fa-spin"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php if(isset($js)){$this->load->view($js);} ?>