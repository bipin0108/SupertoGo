<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?=APP_NAME;?> | Admin-Login</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?=base_url('public')?>/components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?=base_url('public')?>/dist/css/AdminLTE.min.css">
  <link rel="icon" href="<?=base_url('public/images/favicon.jpeg');?>" type="image/x-icon" />
  <script src="<?=base_url('public')?>/components/jquery/dist/jquery.min.js"></script>
  <style>
    .login-page, .register-page {
      background: linear-gradient(
        rgba(0,0,0,0.5),
        rgba(0,0,0,0.5)
      ),url(../public/images/2.jpg);
      /*background: url(../public/images/2.jpg);*/
      background-repeat: no-repeat;
      background-size: cover;
    }
    .login-box{margin: 0;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
    }
    .superLogo{text-align: center;}
    .superLogo img{max-width: 150px;}
    .login-box-body{display: none;}
  </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- <div class="login-logo">
    <a href="<?=base_url();?>"><img src="<?=base_url('public/images/logo.jpeg');?>" style="width: 125px;"></a>
  </div> -->
  <div class="superLogo" style="display:<?php echo !empty(form_error('email'))?'none':'block;'; ?>"><a href="javascript:;" class="show-login"><img src="<?=base_url();?>public/images/3.png" alt=""></a></div>
  <div class="login-box-body" style="display:<?php echo !empty(form_error('email'))?'block':'none;'; ?>">
    <?php if($this->session->flashdata('error')): ?>
        <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <span><?php echo $this->session->flashdata('error') ?></span>
        </div>
    <?php endif ?>
    <p class="login-box-msg">Sign in to start your session</p>
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
          <a href="<?=base_url('admin/i-forgot-my-password');?>">I forgot my password</a>
        </div>
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
      </div>
    </form>
  </div>
</div>
<script>
  $(document).ready(function(){
    $('.show-login').click(function(){
      $(this).hide();
      $('.login-box-body').show();
    });
  });
</script>
</body>
</html>

