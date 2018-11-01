<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $title; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css');?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/font-awesome/css/font-awesome.min.css');?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/Ionicons/css/ionicons.min.css')?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/AdminLTE.min.css')?>">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/iCheck/square/blue.css');?>">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<!-- Google Font -->
<style type="text/css">
.logobc{
  height: 100px;
}

label.error{
  color: red;
}
</style>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page" style="">
  <div class="login-box">
    <div class="login-logo">
      <b>Dashboard</b>TPB
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
      <div class="row text-center">
        <img class="logobc" src="<?php echo base_url('assets/img/logobc.png');?>">
      </div>
      <p class="login-box-msg text-danger"><b><?php if(isset($pesan)){echo $pesan;}?></b></p>

      <form id="form" action="<?php echo base_url('login/login');?>" novalidate="novalidate" method="post" >
        <div class="form-group has-feedback">
          <?php echo form_error('username','<span class="help-block"><p class="text-danger">','</p></span>');?>
          <span class="glyphicon glyphicon-user form-control-feedback"></span>
          <input type="text" id="username" name="username" class="form-control" placeholder="Username" autofocus>
          
        </div>
        <div class="form-group has-feedback">
          <?php echo form_error('password','<span class="help-block"><p class="text-danger">','</p></span>');?>
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          <input type="password" id="password" name="password" class="form-control" placeholder="Password">
          
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-xs-4 pull-right">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In &nbsp;<i class="fa fa-fw fa-sign-in"></i></button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.login-box-body -->
  </div>
  <!-- /.login-box -->

  <!-- jQuery 3 -->
  <script src="<?php echo base_url('assets/bower_components/jquery/dist/jquery.min.js');?>"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="<?php echo base_url('assets/bower_components/bootstrap/dist/js/bootstrap.min.js');?>"></script>
  <!-- iCheck -->
  <script src="<?php echo base_url('assets/plugins/iCheck/icheck.min.js');?>"></script>
  <script src="<?php echo base_url('assets/plugins/jquery-validation/dist/jquery.validate.js');?>"></script>
  <script src="<?php echo base_url('assets/bower_components/jquery/dist/jquery.form.js');?>"></script>
  <script type="text/javascript">

    $().ready(function() {
      $("#form").validate({
        errorClass: 'text-danger',
        rules: {
          username: "required",
          password: "required"
        },
        messages:{
          username: "Field username tidak boleh kosong",
          password: "Field password tidak boleh kosong"
        },
        errorPlacement:function(error, element){
          offset = element.offset();
          error.insertAfter(element);
          $('.form-group').addClass('has-error');
        }
      });
    });




  </script>
</body>
</html>