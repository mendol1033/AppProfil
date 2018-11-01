 <style type="text/css">
 .tableNo{
  width: 3%;
  text-align: center;
}
.tableButton{
  width: 5%;
  text-align: center;
}
</style>
<script src="<?php echo base_url()?>assets/js/dokumen.js"></script>
<div class="row">
  <div class="col-md-9 col-xs-7">
    <div class="row">
      <form class="form-inline" id="filterTable">
        <div class="col-md-6">
          <?php echo form_dropdown('filter', $options,'', 'id="filter" class="select2"'); ?>
        </div>
      </form>
    </div>
  </div>
  <div class="col-md-3 col-xs-5">
    <button type="button" class="btn btn-success pull-right" id="tambah_Dokumen">TAMBAH DOKUMEN</button>
  </div>
</div>
<div class="row">
  <span class="help-block"></span>
</div>
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title"><?php echo strtoupper($tableName)?></h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table id="dataTable" class="table table-bordered table-hover">
          <thead>
            <tr>
              <th class="tableNo">No</th>
              <th>Nama Dokumen</th>
              <th>Nomor Dokumen</th>
              <th>Tanggal Dokumen</th>
              <th>Tanggal Berakhir</th>
              <th>Nama File</th>
              <th class="tableButton">View</th>
              <th class="tableButton">Edit</th>
              <?php if ($this->session->userdata('GrupMenu') == 1){?>
                <th class="tableButton">Delete</th>
              <?php }?>
            </tr>
          </thead>
          <tbody>

          </tbody>
          <tfoot>
            <tr>
              <th class="tableButton">No</th>
              <th>Nama Dokumen</th>
              <th>Nomor Dokumen</th>
              <th>Tanggal Dokumen</th>
              <th>Tanggal Berakhir</th>
              <th>Nama File</th>
              <th class="tableButton">View</th>
              <th class="tableButton">Edit</th>
              <?php if ($this->session->userdata('GrupMenu') == 1){?>
                <th class="tableButton">Delete</th>
              <?php }?>
            </tr>
          </tfoot>
        </table>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
    <!-- /.box -->
  </div>
  <!-- /.col -->
</div>

<div class="modal fade" id="viewDokumen" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 id="modalTitle" class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <div id="viewPDF">
          <iframe id="iframePDF" style="width: 100%; height: 800px;"></iframe>
        </div>
      </div>
    </div>
  </div>
</div>

<?php $attrib_label= array( 'class' => 'col-sm-3 control-label') ;?>
<?php $action = 'dokumen/TambahDokumen' ;?>
<?php $form = array(  
  'NmDokumen' => array( 
    'id' => 'NmDokumen',
    'name' => 'NmDokumen',
    'class' => 'form-control',
    'placeholder' => 'PERIHAL SURAT KEPUTUSAN'
  ),
  'NoDokumen' => array( 
    'id' => 'NoDokumen',
    'name' => 'NoDokumen',
    'class' => 'form-control',
    'placeholder' => 'NOMOR DOKUMEN SURAT KEPUTUSAN'
  ),
  'TglDokumen' => array(  
    'id' => 'TglDokumen',
    'name' => 'TglDokumen',
    'type' => 'input',
    'class' => 'form-control tanggal',
  ),
  'TglDokumenAkhir' => array( 
    'id' => 'TglDokumenAkhir',
    'name' => 'TglDokumenAkhir',
    'type' => 'input',
    'class' => 'form-control tanggal'
  ),
  'DokumenSkep' => array( 
    'id' => 'DokumenSkep',
    'name' => 'DokumenSkep',
    'class' => 'form-control')
) ;
?>

<div class="modal fade" id="TambahDokumen" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-xs-12">
            <h5 id="pesanError"></h5>
          </div>
        </div>
        <?php echo form_open_multipart($action, 'class="form-horizontal" id="form"');?>
        <input type="hidden" name="idSkep" id="idSkep" value="">
        <div class="form-group">
          <?php echo form_label('Jenis Dokumen', 'no', $attrib_label); ?>
          <div class="col-sm-9">
            <?php echo form_dropdown('no', $options,'', 'class="form-control select2" id="jnsDokumen"');?>
          </div>
        </div>
        <div class="form-group">
          <?php echo form_label('Nama Dokumen', 'NmDokumen', $attrib_label); ?>
          <div class="col-sm-9">
            <?php echo form_input($form['NmDokumen']); ?>
          </div>
        </div>
        <div class="form-group">
          <?php echo form_label('Nomor Dokumen', 'NoDokumen', $attrib_label); ?>
          <div class="col-sm-9">
            <?php echo form_input($form['NoDokumen']); ?>
          </div>
        </div>
        <div class="form-group">
          <?php echo form_label('Tanggal Dokumen', 'TglDokumen', $attrib_label); ?>
          <div class="col-sm-9">
            <?php echo form_input($form['TglDokumen']); ?>
          </div>
        </div>
        <div class="form-group">
          <?php echo form_label('Tangal Dokumen Berakhir', 'TglDokumenAkhir', $attrib_label); ?>
          <div class="col-sm-9">
            <?php echo form_input($form['TglDokumenAkhir']); ?>
          </div>
        </div>
        <div class="form-group">
          <?php echo form_label('Upload Dokumen', 'DokumenSkep', $attrib_label); ?>
          <div class="col-sm-9">
            <?php echo form_upload($form['DokumenSkep']);?>
            <p class="help-blok"><em>File Upload Harus Berupa File PDF</em></p>
            <p class="help-blok"><em>Pastikan Nama File Tidak Mengandung Spasi dan Simbol _ / - / '/ "</em></p>
          </div>
        </div>
        <div class="row">
          <button type="button" id="Simpan" class="btn btn-primary pull-right" value="Simpan" style="margin-right: 15px">SIMPAN</button>
          <button type="button" class="btn btn-dark pull-right" data-dismiss="modal" style="margin-right: 10px">BATAL</button>
          <button type="button" class="btn btn-success pull-right sr-only" id="btnDisable" style="margin-right: 10px"></button>
        </div>
        <?php echo form_close();?>
      </div>
    </div>
  </div>
</div>