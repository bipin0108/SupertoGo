<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Add Spacing Area Unit
      <a href="<?php echo base_url('admin/spacing-area-unit-list/'); ?>" class="btn btn-primary pull-right" > <i class="fa fa-angle-double-left" aria-hidden="true"></i>  Back to List</a>
    </h1>
  </section>
  <!-- start add spacingunit form -->
  <section class="content">
    <div class="row">
      <div class="col-xs-6">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Add Spacing Area Unit</h3>
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
          <!-- START add spacingunit form -->
          <?php echo form_open_multipart('admin/add-spacing-area-unit'); ?>
            <div class="box-body">
                <div class="form-group">
                  <label>Spacing Unit Name [English]</label>
                  <input type="text" name="en_name" value="<?php echo set_value('en_name')?>" class="form-control" placeholder="Spacing Unit Name [English]" autocomplete="off">
                  <?php echo form_error('en_name'); ?>
                </div>
                <div class="form-group">
                  <label>Spacing Unit Name [Hindi]</label>
                  <input type="text" name="hi_name" value="<?php echo set_value('hi_name')?>" class="form-control" placeholder="Spacing Unit Name [Hindi]" autocomplete="off">
                  <?php echo form_error('hi_name'); ?>
                </div>
                <div class="form-group">
                  <label>Spacing Unit Name [Marathi] </label>
                  <input type="text" name="mr_name" value="<?php echo set_value('mr_name')?>" class="form-control" placeholder="Spacing Unit Name [Marathi]" autocomplete="off">
                  <?php echo form_error('mr_name'); ?>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <input type="submit" value="Add Spacing Area Unit" class="btn btn-primary">
            </div>
          <?php form_close();  ?>
          <!-- END add spacingunit form -->
        </div>
      </div> 
    </div>
  </section>    
  <!-- end add spacingunit form -->
</div>
