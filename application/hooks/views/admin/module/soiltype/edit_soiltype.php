<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Edit Soil Type
      <a href="<?php echo base_url('admin/soil-type-list/'); ?>" class="btn btn-primary pull-right" > <i class="fa fa-angle-double-left" aria-hidden="true"></i>  Back to List</a>
    </h1>
  </section>
  <!-- start update Soil Type form -->
  <section class="content">
    <div class="row">
      <div class="col-xs-6">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Edit Soil Type</h3>
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
          <!-- START update Soil Type form -->
          <?php echo form_open_multipart('admin/update-soil-type'); ?>
            <div class="box-body">  
                <input type="hidden" name="id" value="<?php echo $soiltype['id']; ?>" >
                <div class="form-group">
                  <label>Soil Type Name [English]</label>
                  <input type="text" name="en_name" value="<?php echo $soiltype['en_name'] ?>" class="form-control" placeholder="Soil Type Name [English]" autocomplete="off">
                  <?php echo form_error('en_name'); ?>
                </div>
                <div class="form-group">
                  <label>Soil Type Name [Hindi]</label>
                  <input type="text" name="hi_name" value="<?php echo $soiltype['hi_name'] ?>" class="form-control" placeholder="Soil Type Name [Hindi]" autocomplete="off">
                  <?php echo form_error('hi_name'); ?>
                </div>
                <div class="form-group">
                  <label>Soil Type Name [Marathi] </label>
                  <input type="text" name="mr_name" value="<?php echo $soiltype['mr_name'] ?>" class="form-control" placeholder="Soil Type Name [Marathi]" autocomplete="off">
                  <?php echo form_error('mr_name'); ?>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <input type="submit" value="Update Soil Type" class="btn btn-primary">
            </div>
          <?php form_close();  ?>
          <!-- END update Soil Type form -->
        </div>
      </div> 
    </div>
  </section>    
  <!-- end update Soil Type form -->
</div>
