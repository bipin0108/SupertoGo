<!-- not direct access -->
<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<!-- load header -->
<?php $this->load->view('admin/include/header');?>

<!-- load topbar -->
<?php $this->load->view('admin/include/topbar');?>

<!-- load sidebar -->
<?php $this->load->view('admin/include/sidebar');?>

<!-- load content -->
<?php $this->load->view('admin/'.$page); ?>

<!-- load footer -->
<?php $this->load->view('admin/include/footer');?>
