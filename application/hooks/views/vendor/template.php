<!-- not direct access -->
<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<!-- load header -->
<?php $this->load->view('vendor/include/header');?>

<!-- load topbar -->
<?php $this->load->view('vendor/include/topbar');?>

<!-- load sidebar -->
<?php $this->load->view('vendor/include/sidebar');?>

<!-- load content -->
<?php $this->load->view('vendor/'.$page); ?>

<!-- load footer -->
<?php $this->load->view('vendor/include/footer');?>
