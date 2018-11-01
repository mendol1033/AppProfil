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
<script src="<?php echo base_url()?>assets/js/kuasa.js"></script>
<div class="row">
  <div class="col-md-9 col-xs-7">
    <!-- <div class="row">
      <form class="form-inline" id="filterTable">
        <div class="col-md-6">
          <?php echo form_dropdown('filter', $options,'', 'id="filter" class="select2"'); ?>
        </div>
      </form>
    </div> -->
  </div>
  <div class="col-md-3 col-xs-5">
    <button type="button" class="btn btn-success pull-right" id="tambah_Dokumen">TAMBAH</button>
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
              <th>Nama</th>
              <th>Jabatan</th>
              <th>Telepon</th>
              <th>Email</th>
              <th>Alamat</th>
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
              <th class="tableNo">No</th>
              <th>Nama</th>
              <th>Jabatan</th>
              <th>Telepon</th>
              <th>Email</th>
              <th>Alamat</th>
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

<?php $attrib_label= array( 'class' => 'col-sm-3 control-label') ;?>
<?php $attrib_label2= array( 'class' => 'col-sm-4 control-label') ;?>
<?php $options = $option2; ?>
<?php $form = array(
  'IdPJ' => array(
    'id' => "IdPJ",
    'name' => "IdPJ",
    'type' => "hidden",
  ),  
  'NmPIC' => array( 
    'id' => 'NmPIC',
    'name' => 'NmPIC',
    'class' => 'form-control',
    'placeholder' => 'Nama Penanggung Jawab Perusahaan'
  ),
  'NoIdentitas' => array( 
    'id' => 'NoIdentitas',
    'name' => 'NoIdentitas',
    'class' => 'form-control',
    'placeholder' => 'Nomor Kartu Identitas'

  ),
  'Jabatan' => array( 
    'id' => 'Jabatan',
    'name' => 'Jabatan',
    'class' => 'form-control',
    'placeholder' => 'Jabatan'
  ),
  'Alamat' => array(  
    'id' => 'Alamat',
    'name' => 'Alamat',
    'class' => 'form-control',
    'rows' => 2,
    'placeholder' => 'Alamat Penanggung Jawab'
  ),
  'NoHp1' => array( 
    'id' => 'NoHp1',
    'name' => 'NoHp1',
    'class' => 'form-control',
    'placeholder' => 'Nomor Handphone 1'),
  'NoHp2' => array( 
    'id' => 'NoHp2',
    'name' => 'NoHp2',
    'class' => 'form-control',
    'placeholder' => 'Nomor Handphone 2'),
  'Email' => array( 
    'id' => 'Email',
    'name' => 'Email',
    'type' => 'email',
    'class' => 'form-control',
    'placeholder' => 'Alamat Email Penanggung Jawab'),
  'MasaKerja' => array( 
    'id' => 'MasaKerja',
    'name' => 'MasaKerja',
    'class' => 'form-control',
    'placeholder' => 'Masa Kerja Penanggung Jawab'),
  'WargaNegara' => array( 
    'id' => 'WargaNegara',
    'name' => 'WargaNegara',
    'class' => 'form-control',
    'placeholder' => 'Kewarganegaraan Penanggung Jawab')
);
?>

<div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg">
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
        <?php echo form_open_multipart("", 'class="form-horizontal" id="form"');?>
        <input type="hidden" name="group" id="group" value="">
        <div class="form-group">
          <?php echo form_label('Nama Penanggung Jawab', 'NmPIC', $attrib_label); ?>
          <div class="col-sm-9">
            <?php echo form_input($form['NmPIC']); ?>
            <span class="help-block"></span>
          </div>
        </div>
        <div class="form-group">
          <?php echo form_label('Jenis Identitas', 'JenisID', $attrib_label);?>
          <div class="col-sm-9">
            <?php echo form_dropdown('JenisID',$options,'','class="form-control select2" id="JenisID"');?>
            <span class="help-block"></span>
          </div>
        </div>
        <div class="form-group">
          <?php echo form_label('Nomor Identitas', 'NoIdentitas', $attrib_label);?>
          <div class="col-sm-9">
            <?php echo form_input($form['NoIdentitas']);?>
            <span class="help-block"></span>
          </div>
        </div>
        <div class="form-group">
          <?php echo form_label('Jabatan', 'Jabatan', $attrib_label);?>
          <div class="col-sm-9">
            <?php echo form_input($form['Jabatan']);?>
            <span class="help-block"></span>
          </div>
        </div>
        <div class="form-group">
          <?php echo form_label('Alamat', 'Alamat', $attrib_label);?>
          <div class="col-sm-9">
            <?php echo form_textarea($form['Alamat']);?>
            <span class="help-block"></span>
          </div>
        </div>
        <div class="form-group">
          <?php echo form_label('Nomor Handphone 1', 'NoHp1', $attrib_label);?>
          <div class="col-sm-9">
            <?php echo form_input($form['NoHp1']);?>
            <span class="help-block"></span>
          </div>
        </div>
        <div class="form-group">
          <?php echo form_label('Nomor Handphone 2', 'NoHp2', $attrib_label);?>
          <div class="col-sm-9">
            <?php echo form_input($form['NoHp2']);?>
            <span class="help-block"></span>
          </div>
        </div>
        <div class="form-group">
          <?php echo form_label('Email', 'Email', $attrib_label);?>
          <div class="col-sm-9">
            <?php echo form_input($form['Email']);?>
            <span class="help-block"></span>
          </div>
        </div>
        <div class="form-group">
          <?php echo form_label('Masa Kerja', 'MasaKerja', $attrib_label);?>
          <div class="col-sm-9">
            <?php echo form_input($form['MasaKerja']);?>
            <span class="help-block"></span>
          </div>
        </div>
        <div class="form-group">
          <?php echo form_label('Kewarganegaraan', 'WargaNegara', $attrib_label);?>
          <div class="col-sm-9">
            <?php echo form_input($form['WargaNegara']);?>
            <span class="help-block"></span>
          </div>
        </div>
        <div class="form-group" id="fieldFoto">
          <?php echo form_label('Foto', 'Foto', $attrib_label);?>
          <div class="col-sm-9">
            <?php echo form_upload('Foto','','class="form-control"'); ;?>
            <span class="help-block"></span>
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

<?php $form2 = array( 
  'NmPIC' => array( 
    'id' => 'NmPIC',
    'name' => 'NmPIC',
    'class' => 'form-control',
    'disabled' => TRUE
  ),
  'JenisID' => array( 
    'id' => 'JenisID',
    'name' => 'JenisID',
    'class' => 'form-control',
    'disabled' => TRUE
  ),
  'NoIdentitas' => array( 
    'id' => 'NoIdentitas',
    'name' => 'NoIdentitas',
    'class' => 'form-control',
    'disabled' => TRUE
  ),
  'Jabatan' => array( 
    'id' => 'Jabatan',
    'name' => 'Jabatan',
    'class' => 'form-control',
    'disabled' => TRUE
  ),
  'Alamat' => array(  
    'id' => 'Alamat',
    'name' => 'Alamat',
    'class' => 'form-control',
    'rows' => 2,
    'disabled' => TRUE
  ),
  'NoHp1' => array( 
    'id' => 'NoHp1',
    'name' => 'NoHp1',
    'class' => 'form-control',
    'disabled' => TRUE),
  'NoHp2' => array( 
    'id' => 'NoHp2',
    'name' => 'NoHp2',
    'class' => 'form-control',
    'disabled' => TRUE),
  'Email' => array( 
    'id' => 'Email',
    'name' => 'Email',
    'class' => 'form-control',
    'disabled' => TRUE),
  'MasaKerja' => array( 
    'id' => 'MasaKerja',
    'name' => 'MasaKerja',
    'class' => 'form-control',
    'disabled' => TRUE),
  'WargaNegara' => array( 
    'id' => 'WargaNegara',
    'name' => 'WargaNegara',
    'class' => 'form-control',
    'disabled' => TRUE)
);
?> 
<div class="modal fade" id="viewDetail" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <?php echo form_open("", 'class="form-horizontal" id="formView"');?>
        <div class="row">
          <div class="col-sm-9">
            <div class="form-group">
              <?php echo form_label('Nama Penanggung Jawab', 'NmPIC', $attrib_label2); ?>
              <div class="col-sm-8">
                <?php echo form_input($form2['NmPIC']); ?>
                <span class="help-block"></span>
              </div>
            </div>
            <div class="form-group">
              <?php echo form_label('Jenis Identitas', 'JenisID', $attrib_label2);?>
              <div class="col-sm-8">
                <?php echo form_input($form2['JenisID']); ?>
                <span class="help-block"></span>
              </div>
            </div>
            <div class="form-group">
              <?php echo form_label('Nomor Identitas', 'NoIdentitas', $attrib_label2);?>
              <div class="col-sm-8">
                <?php echo form_input($form2['NoIdentitas']);?>
                <span class="help-block"></span>
              </div>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="row">
              <img id="fotoKaryawan" alt="Foto Karyawan" style="width: 75%;">
            </div>
          </div>
        </div>
        <div class="col-sm-12">
          <div class="form-group">
            <?php echo form_label('Jabatan', 'Jabatan', $attrib_label);?>
            <div class="col-sm-9">
              <?php echo form_input($form2['Jabatan']);?>
              <span class="help-block"></span>
            </div>
          </div>
          <div class="form-group">
            <?php echo form_label('Alamat', 'Alamat', $attrib_label);?>
            <div class="col-sm-9">
              <?php echo form_textarea($form2['Alamat']);?>
              <span class="help-block"></span>
            </div>
          </div>
          <div class="form-group">
            <?php echo form_label('No Handphone 1', 'NoHp1', $attrib_label);?>
            <div class="col-sm-9">
              <?php echo form_input($form2['NoHp1']);?>
              <span class="help-block"></span>
            </div>
          </div>
          <div class="form-group">
            <?php echo form_label('Nomor Handphone 2', 'NoHp2', $attrib_label);?>
            <div class="col-sm-9">
              <?php echo form_input($form2['NoHp2']);?>
              <span class="help-block"></span>
            </div>
          </div>
          <div class="form-group">
            <?php echo form_label('Email', 'Email', $attrib_label);?>
            <div class="col-sm-9">
              <?php echo form_input($form2['Email']);?>
              <span class="help-block"></span>
            </div>
          </div>
          <div class="form-group">
            <?php echo form_label('Masa Kerja', 'MasaKerja', $attrib_label);?>
            <div class="col-sm-9">
              <?php echo form_input($form2['MasaKerja']);?>
              <span class="help-block"></span>
            </div>
          </div>
          <div class="form-group">
            <?php echo form_label('Kewarganegaraan', 'WargaNegara', $attrib_label);?>
            <div class="col-sm-9">
              <?php echo form_input($form2['WargaNegara']);?>
              <span class="help-block"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <button type="button" class="btn btn-dark pull-right" data-dismiss="modal" style="margin-right: 10px">BATAL</button>
        </div>
        <?php echo form_close();?>
      </div>
    </div>
  </div>
</div>