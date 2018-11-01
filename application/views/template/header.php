<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $title; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/bower_components/bootstrap/dist/css/bootstrap.css';;?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/fontawesome-free-web/css/all.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/bower_components/fontawesome-free-web/css/v4-shims.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/bower_components/Ionicons/css/ionicons.min.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css';?>">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/bower_components/select2/dist/css/select2.min.css';?>">
  <link rel="stylesheet" href="<?php echo base_url().'assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css';?>">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/plugins/iCheck/all.css';?>">
  <!-- daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.css">

  <?php if(isset($css)) {$this->load->view($css);} ?>
  <style type="text/css">
  .noresize {
    resize : none; }
  </style>

  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/dist/css/AdminLTE.min.css';?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/dist/css/skins/_all-skins.min.css';?>">
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <!-- JS Files -->
  <!-- jQuery 3 -->
  <script src="<?php echo base_url().'assets/bower_components/jquery/dist/jquery.min.js';?>"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="<?php echo base_url().'assets/bower_components/jquery-ui/jquery-ui.min.js';?>"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button);
  </script>
  <!-- Bootstrap 3.3.7 -->
  <script src="<?php echo base_url().'assets/bower_components/bootstrap/dist/js/bootstrap.min.js';?>"></script>
  <!-- InputMask -->
  <script src="<?php echo base_url().'assets/plugins/input-mask/jquery.inputmask.js';?>"></script>
  <script src="<?php echo base_url().'assets/plugins/input-mask/jquery.inputmask.date.extensions.js';?>"></script>
  <script src="<?php echo base_url().'assets/plugins/input-mask/jquery.inputmask.extensions.js';?>"></script>
  <!-- bootstrap datepicker -->
  <script src="<?php echo base_url().'assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js';?>"></script>
  <!-- Slimscroll -->
  <script src="<?php echo base_url().'assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js';?>"></script>
  <!-- FastClick -->
  <script src="<?php echo base_url().'assets/bower_components/fastclick/lib/fastclick.js';?>"></script>
  <!-- DataTables -->
  <script src="<?php echo base_url()?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url()?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <script src="<?php echo base_url('assets/plugins/jquery-validation/dist/jquery.validate.js');?>"></script>
  <script src="<?php echo base_url('assets/bower_components/jquery/dist/jquery.form.js');?>"></script>
  <!-- ChartJS -->
  <script src="<?php echo base_url()?>assets/bower_components/Chart.js/Chart.bundle.min.js"></script>
  <script src="<?php echo base_url()?>assets/bower_components/Chart.js/utils.js"></script>
  <!-- iCheck 1.0.1 -->
  <script src="<?php echo base_url()?>assets/plugins/iCheck/icheck.min.js"></script>
  <!-- date-range-picker -->
  <script src="<?php echo base_url();?>assets/bower_components/moment/min/moment.min.js"></script>
  <script src="<?php echo base_url();?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>

  <script src="<?php echo base_url('assets/bower_components/select2/dist/js/select2.full.min.js')?>" ></script>
  <!-- AdminLTE App -->
  <script src="<?php echo base_url().'assets/dist/js/adminlte.min.js';?>"></script>
  <!-- Ion Icon -->
  <!-- <script src="https://unpkg.com/ionicons@4.4.2/dist/ionicons.js"></script> -->
</head>
<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <header class="main-header">
      <!-- Logo -->
      <a id="AppDashboard" href="" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><img style="height: 30px" src="<?php echo base_url().'assets/img/logobc.png'; ?>"></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><img style="height: 30px" src="<?php echo base_url().'assets/img/logobc.png'; ?>">&nbsp;<b>App</b>&nbsp;Dashboard</span>
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <li class="dropdown user user-menu">
              <!-- USER PROFILE -->
              <a href="" class="dropdown-toggle" data-toggle="dropdown">
                <span class="hidden-xs"><?php echo ($this->session->userdata('NamaUser'));?></span>
              </a>
              <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header" style="height: 70px;">
                  <p>
                    <?php echo ($this->session->userdata('NamaUser').' - '.$this->session->userdata('NipUser')) ;?>
                    <small></small>
                  </p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="http:/OfficeAutomation" class="btn btn-default btn-flat">Profile</a>
                  </div>
                  <div class="pull-right">
                    <a href="<?php echo base_url().'logout';?>" class="btn btn-default btn-flat">Sign out</a>
                  </div>
                </li>
              </ul>
            </li>
            <!-- Control Sidebar Toggle Button -->
          </ul>
        </div>
      </nav>
    </header>