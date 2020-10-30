<!DOCTYPE html>
<html lang="zxx">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
  <meta charset="utf-8">
  <title>SMARTCROP</title>

  
  <!-- mobile responsive meta -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  
  <!-- Bootstrap -->
  <link rel="stylesheet" href="<?php echo SITE_URL; ?>assets/plugins/bootstrap/bootstrap.min.css">
  <!-- magnific popup -->
  <link rel="stylesheet" href="<?php echo SITE_URL; ?>assets/plugins/magnific-popup/magnific-popup.css">
  <!-- Slick Carousel -->
  <link rel="stylesheet" href="<?php echo SITE_URL; ?>assets/plugins/slick/slick.css">
  <link rel="stylesheet" href="<?php echo SITE_URL; ?>assets/plugins/slick/slick-theme.css">
  <!-- themify icon -->
  <link rel="stylesheet" href="<?php echo SITE_URL; ?>assets/plugins/themify-icons/themify-icons.css">
  <!-- animate -->
  <link rel="stylesheet" href="<?php echo SITE_URL; ?>assets/plugins/animate/animate.css">
  <!-- Aos -->
  <link rel="stylesheet" href="<?php echo SITE_URL; ?>assets/plugins/aos/aos.css">
  <!-- Stylesheets -->
  <link href="<?php echo SITE_URL; ?>assets/css/style.css" rel="stylesheet">
  
  <!--Favicon-->
  <link rel="shortcut icon" href="<?php echo SITE_URL; ?>assets/images/favicon.png" type="image/x-icon">
  <link rel="icon" href="<?php echo SITE_URL; ?>assets/images/favicon.png" type="image/x-icon">

</head>

<body>
  

<!-- preloader start -->
<div class="preloader">
    <img src="<?php echo SITE_URL; ?>assets/images/preloader.gif" alt="preloader">
</div>
<!-- preloader end -->

<section class="d-flex align-items-center justify-content-center" style="height: 100vh;">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="signup">
                    <div class="row">
                        <div class="col-md-5 signup-greeting overlay" style="background-image: url(<?php echo SITE_URL; ?>assets/images/background/signup.jpg);">
                            <a href="<?php echo base_url(); ?>">
                              <img src="<?php echo SITE_URL; ?>assets/images/logo-signup.png" alt="logo">
                            </a>
                            
                            <h4>Welcome!</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                                labore et dolore magna.</p>
                        </div>
                        <div class="col-md-7">
                            <div class="signup-form">
                                <form action="<?php echo base_url(); ?>login" method="post" class="row">
                                    <div class="col-lg-12">
                                        <h4>Login</h4>
                                        <p class="float-sm-right">Need An Account?
                                            <a href="<?php echo base_url(); ?>sign-up">Sign Up</a>
                                        </p>
                                    </div>
                                    <?php if($this->session->flashdata('v_error')): ?>
                                      <a href="<?php echo base_url(); ?>verification">
                                        <div class="alert alert-danger alert-dismissible">
                                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                          <?php echo $this->session->flashdata('v_error'); ?>
                                        </div>
                                      </a>
                                    <?php endif ?>
                                    <?php if($this->session->flashdata('error')): ?>
                                      <div class="alert alert-danger alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <?php echo $this->session->flashdata('error'); ?>
                                      </div>
                                    <?php endif ?>
                                    <?php if($this->session->flashdata('success')): ?>
                                        <div class="alert alert-success alert-dismissible">
                                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                          <?php echo $this->session->flashdata('success'); ?>
                                        </div>
                                    <?php endif ?>
                                    <div class="col-lg-12">
                                      <?php echo form_error('user_type'); ?>
                                       <select class="form-control" name="user_type">
                                        <option value="">--Select User Type--</option>
                                        <option value="farmer" <?php if(set_value('user_type') == 'farmer'){ echo 'selected';} ?>>Farmer</option>
                                        <option value="buyer" <?php if(set_value('user_type') == 'buyer'){ echo 'selected';} ?>>Buyer</option>
                                       </select>
                                    </div>
                                    <div class="col-lg-12">
                                        <?php echo form_error('mobile'); ?>
                                        <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile No" value="<?php echo set_value('mobile'); ?>">
                                    </div>
                                    <div class="col-lg-12">
                                        <?php echo form_error('pin'); ?>
                                        <input type="password" class="form-control" id="pin" name="pin" placeholder="Pin" value="<?php echo set_value('pin'); ?>">
                                    </div>
                                    <div class="col-sm-4">
                                        <button type="submit" class="btn btn-primary btn-sm">Login</button>
                                    </div>
                                    <div class="col-sm-8 text-sm-right" style="margin-top: 40px;">
                                        <a href="<?php echo base_url(); ?>forgot-password">forgot password ?</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- jQuery -->
<script src="<?php echo SITE_URL; ?>assets/plugins/jQuery/jquery.min.js"></script>
<!-- Bootstrap JS -->
<script src="<?php echo SITE_URL; ?>assets/plugins/bootstrap/bootstrap.min.js"></script>
<!-- magnific popup -->
<script src="<?php echo SITE_URL; ?>assets/plugins/magnific-popup/jquery.magnific.popup.min.js"></script>
<!-- slick slider -->
<script src="<?php echo SITE_URL; ?>assets/plugins/slick/slick.min.js"></script>
<!-- mixitup filter -->
<script src="<?php echo SITE_URL; ?>assets/plugins/mixitup/mixitup.min.js"></script>
<!-- Google Map -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBI14J_PNWVd-m0gnUBkjmhoQyNyd7nllA"></script>
<script  src="<?php echo SITE_URL; ?>assets/plugins/google-map/gmap.js"></script>
<!-- Syo Timer -->
<script src="<?php echo SITE_URL; ?>assets/plugins/syotimer/jquery.syotimer.js"></script>
<!-- aos -->
<script src="<?php echo SITE_URL; ?>assets/plugins/aos/aos.js"></script>
<!-- Main Script -->
<script src="<?php echo SITE_URL; ?>assets/js/script.js"></script>
</body>

<!-- Mirrored from demo.themefisher.com/themefisher/biztrox/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 03 Sep 2019 11:20:29 GMT -->
</html>