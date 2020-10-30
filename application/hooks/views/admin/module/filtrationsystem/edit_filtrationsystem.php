<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Edit Filtration System
      <a href="<?php echo base_url('admin/filtration-system-list/'); ?>" class="btn btn-primary pull-right" > <i class="fa fa-angle-double-left" aria-hidden="true"></i>  Back to List</a>
    </h1>
  </section>
  <!-- start filtration system form -->
  <section class="content">
    <div class="row">
      <div class="col-xs-6">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Edit Filtration System</h3>
          </div>
          <?php if(!empty($this->session->flashdata('success'))): ?>
          <div class="alert alert-success">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <span> <?php echo $this->session->flashdata('success'); ?> </span>
          </div>
          <?php endif ?> 
         
          <?php if($this->session->flashdata('error')): ?>
          <div class="alert alert-danger">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <span><?php echo $this->session->flashdata('error') ?></span>
          </div>
          <?php endif ?>
          <!-- START filtration system form -->
          <?php echo form_open_multipart('admin/update-filtration-system'); ?>
            <div class="box-body">  
                <input type="hidden" name="id" value="<?php echo $filtrationsystem['id']; ?>" >
                <div class="form-group">
                  <label>Filtration System Name [English]</label>
                  <input type="text" name="en_name" value="<?php echo $filtrationsystem['en_name'] ?>" class="form-control" placeholder="Filtration System Name [English]" autocomplete="off">
                  <?php echo form_error('en_name'); ?>
                </div>
                <div class="form-group">
                  <label>Filtration System Name [Hindi]</label>
                  <input type="text" name="hi_name" value="<?php echo $filtrationsystem['hi_name'] ?>" class="form-control" placeholder="Filtration System Name [Hindi]" autocomplete="off">
                  <?php echo form_error('hi_name'); ?>
                </div>
                 <div class="form-group">
                  <label>Filtration System Name [Marathi] </label>
                  <input type="text" name="mr_name" value="<?php echo $filtrationsystem['mr_name'] ?>" class="form-control" placeholder="Filtration System Name [Marathi]" autocomplete="off">
                  <?php echo form_error('mr_name'); ?>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <input type="submit" value="Update System" class="btn btn-primary">
            </div>
          <?php form_close();  ?>
          <!-- END filtration system form -->
        </div>
      </div> 
    </div>
  </section>    
  <!-- end filtration system form -->
</div>
