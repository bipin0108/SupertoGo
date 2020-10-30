<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> Admin-Login | Smart Crop</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?=base_url('public')?>/components/bootstrap/dist/css/bootstrap.min.css">
  <!-- <link rel="stylesheet" href="<?=base_url('public')?>/components/font-awesome/css/font-awesome.min.css"> -->
  <!-- <link rel="stylesheet" href="<?=base_url('public')?>/components/Ionicons/css/ionicons.min.css"> -->
  <link rel="stylesheet" href="<?=base_url('public')?>/dist/css/AdminLTE.min.css">
  <!-- <link rel="stylesheet" href="<?=base_url('public')?>/plugins/iCheck/square/blue.css"> -->
  <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"> -->
  <link rel="icon" href="<?=base_url('public/images/favicon.png');?>" type="image/x-icon" />
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="<?=base_url();?>"><img src="<?=base_url('public/images/logo.png');?>" style="width: 125px;"></a>
  </div>
  <div class="login-box-body">
    <?php if($this->session->flashdata('error')): ?>
        <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <span><?php echo $this->session->flashdata('error') ?></span>
        </div>
    <?php endif ?>
    <form method="post" action="<?php echo base_url('admin/authlogincheck') ?>">
      <div class="form-group has-feedback">
        <input type="text" name="email" class="form-control" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        <?php echo form_error('email'); ?>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        <?php echo form_error('password'); ?>
      </div>
      <div class="row">
        <div class="col-xs-8">
        </div>
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
      </div>
    </form>
  </div>
</div>
<!-- <script src="<?=base_url('public')?>/components/jquery/dist/jquery.min.js"></script> -->
<!-- <script src="<?=base_url('public')?>/components/bootstrap/dist/js/bootstrap.min.js"></script> -->
<!-- <script src="<?=base_url('public')?>/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function (){
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script> -->
</body>
</html>

