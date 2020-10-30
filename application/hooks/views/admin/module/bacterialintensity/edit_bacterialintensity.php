<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Bacterial Blight Intensity
      <a href="<?php echo base_url('admin/bacterial-intensity-list/'); ?>" class="btn btn-primary pull-right" > <i class="fa fa-angle-double-left" aria-hidden="true"></i>  Back to List</a>
    </h1>
  </section>
  <!-- start add module form -->
  <section class="content">
    <div class="row">
      <div class="col-xs-6">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Edit</h3>
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
          <!-- START add bacterial intensity form -->
          <?php echo form_open('admin/update-bacterial-intensity'); ?>
            <div class="box-body">
              <input type="hidden" name="id" value="<?php echo $bacterialintensity['id']; ?>" >
              <div class="form-group">
                  <label>Bacterial Intensity Name [English]</label>
                  <input type="text" name="en_name" value="<?php echo $bacterialintensity['en_name'] ?>" class="form-control" placeholder="Bacterial Intensity Name [English]" autocomplete="off">
                  <?php echo form_error('en_name'); ?>
              </div>
              <div class="form-group">
                  <label>Bacterial Intensity Name [Hindi]</label>
                  <input type="text" name="hi_name" value="<?php echo $bacterialintensity['hi_name'] ?>" class="form-control" placeholder="Bacterial Intensity Name [Hindi]" autocomplete="off">
                  <?php echo form_error('hi_name'); ?>
              </div>
              <div class="form-group">
                  <label>Bacterial Intensity Name [Marathi] </label>
                  <input type="text" name="mr_name" value="<?php echo $bacterialintensity['mr_name'] ?>" class="form-control" placeholder="Bacterial Intensity Name [Marathi]" autocomplete="off">
                  <?php echo form_error('mr_name'); ?>
              </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <input type="submit" value="Save" class="btn btn-primary">
            </div>
          <?php form_close();  ?>
          <!-- END add bacterial intensity form -->
        </div>
      </div> 
    </div>
  </section>    
  <!-- end add bacterial intensity form -->
</div>
