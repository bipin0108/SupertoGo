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
  <link rel="stylesheet" href="<?php echo base_url('public')?>/components/bootstrap-datepicker/dist/css/bootstrap-datepicker.css">
    <!-- <link href="<?php echo SITE_URL; ?>assets/css/font-awesome.css" rel="stylesheet"> -->
    <link href="<?php echo SITE_URL; ?>assets/css/ionicons.css" rel="stylesheet">
    <link href="<?php echo SITE_URL; ?>assets/css/jquery.steps.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo SITE_URL; ?>assets/css/bootstrap-select.css" />
    <!-- Bracket CSS -->
    <link rel="stylesheet" href="<?php echo SITE_URL; ?>assets/css/bracket.css">
  <!-- Datatables -->
  <link rel="stylesheet" href="<?php echo base_url('public');?>/components/datatables.net-bs/css/dataTables.bootstrap.min.css">
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
  <link href="<?php echo SITE_URL; ?>assets/css/tab.css" rel="stylesheet">
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

<!-- navigation -->
<header>
    <!-- top header -->
    <div class="top-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="list-inline text-lg-right text-center">
                        <li class="list-inline-item">
                            <a href="mailto:info@companyname.com">info@companyname.com</a>
                        </li>
                        <li class="list-inline-item">
                            <a href="callto:1234565523">Call Us Now:
                                <span class="ml-2"> 123 456 5523</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- nav bar -->
    <div class="navigation">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="<?php echo base_url(); ?>">
                    <img src="<?php echo SITE_URL; ?>assets/images/logo.png" alt="logo">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">

                        <li class="nav-item <?php echo ($page == 'index')? 'active' : '' ; ?>">
                            <a class="nav-link" href="<?php echo base_url(); ?>">Home</a>
                        </li>
                        <li class="nav-item <?php echo ($page == 'about_us')? 'active' : '' ; ?>">
                            <a class="nav-link" href="<?php echo base_url(); ?>about-us">About Us</a>
                        </li>
                        <!-- <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                Service
                            </a>
                            <div class="dropdown-menu" >
                                <a class="dropdown-item" href="service.php">Service page</a>
                                <a class="dropdown-item" href="service-2.php">Service page-2</a>
                                <a class="dropdown-item" href="service-single.php">Service Single</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                Pages
                            </a>
                            <div class="dropdown-menu" >
                                <a class="dropdown-item" href="team.php">Team Page</a>
                                <a class="dropdown-item" href="pricing.php">Pricing Page</a>
                                <a class="dropdown-item" href="project.php">project Page</a>
                                <a class="dropdown-item" href="faqs.php">FAQs Page</a>
                                <a class="dropdown-item" href="project-single.php">Project Single</a>
                                <a class="dropdown-item" href="team-single.php">Team Single</a>
                                <a class="dropdown-item" href="404.php">404 Page</a>
                                <a class="dropdown-item" href="signup.php">Sign Up Page</a>
                                <a class="dropdown-item" href="login.php">Login Page</a>
                                <a class="dropdown-item" href="comming-soon.php">Comming Soon Page</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                Blog
                            </a>
                            <div class="dropdown-menu" >
                                <a class="dropdown-item" href="blog.php">Blog Page</a>
                                <a class="dropdown-item" href="blog-sidebar.php">Blog with Sidebar</a>
                                <a class="dropdown-item" href="blog-single.php">Blog Single</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                Elements
                            </a>
                            <div class="dropdown-menu" >
                                <a class="dropdown-item" href="components/buttons.php">Buttons</a>
                                <a class="dropdown-item" href="components/icons.php">Icons</a>
                                <a class="dropdown-item" href="components/typography.php">Typography</a>
                                <a class="dropdown-item" href="components/accordions.php">Accordions</a>
                                <a class="dropdown-item" href="components/blog-contents.php">Blog Contents</a>
                                <a class="dropdown-item" href="components/service-contents.php">Service Contents</a>
                                <a class="dropdown-item" href="components/team-contents.php">Team Contents</a>
                            </div>
                        </li> -->
                        <li class="nav-item <?php echo ($page == 'contact')? 'active' : '' ; ?>">
                            <a class="nav-link" href="<?php echo base_url(); ?>contact">Contact</a>
                        </li>
                        <?php if(isset($this->session->userdata[SESSION_USER]['logged_in']) == 'TRUE' ){?>
                            <li class="nav-item <?php echo ($page == 'dashboard')? 'active' : '' ; ?>">
                                <a class="nav-link" href="<?php echo base_url(); ?>dashboard">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link btn btn-primary btn-sm" href="<?php echo base_url(); ?>logout">logout</a>
                            </li>
                        <?php }else{ ?>
                            <li class="nav-item">
                                <a class="nav-link btn btn-primary btn-sm" href="<?php echo base_url(); ?>login">login</a>
                            </li>
                        <?php } ?>    
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</header>
<style type="text/css">
    .wd-xs-200{float: left;}
    .form-control-label{font-size: 18px;color: #212529;}
    .wizard > .steps .current a, .wizard > .steps .current a:hover, .wizard > .steps .current a:activ{
        background-color: #e84444;
    }
    .wizard > .steps .done a, .wizard > .steps .done a:hover, .wizard > .steps .done a:active {
    background-color: #e84444;}
  </style>