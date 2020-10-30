<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <?=lang('Delivery Boy');?>
      <a href="<?php echo base_url('admin/delivery-boy-list/'); ?>" class="btn btn-primary pull-right" > <i class="fa fa-angle-double-left" aria-hidden="true"></i>  <?=lang('Back to List');?></a>
    </h1>
  </section>
  <!-- start add intensity form -->
  <section class="content">
    <div class="row">
      <div class="col-xs-6">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title"><?=lang('Add');?>
            </h3>
          </div>
          <!-- START add intensity form -->
          <?php echo form_open_multipart('admin/add-delivery-boy'); ?>
            <div class="box-body">
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
              <div class="form-group">
                <label><?=lang('First Name');?></label>
                <input type="text" name="first_name" value="<?php echo set_value('first_name')?>" class="form-control" placeholder="<?=lang('First Name');?>" autocomplete="off">
                <?php echo form_error('first_name'); ?>
              </div>
              <div class="form-group">
                <label><?=lang('Last Name');?></label>
                <input type="text" name="last_name" value="<?php echo set_value('last_name')?>" class="form-control" placeholder="<?=lang('Last Name');?>" autocomplete="off">
                <?php echo form_error('last_name'); ?>
              </div>
              <div class="form-group">
                <label><?=lang('Email');?></label>
                <input type="email" name="email" value="<?php echo set_value('email')?>" class="form-control" placeholder="<?=lang('Email');?>" autocomplete="off">
                <?php echo form_error('email'); ?>
              </div>
              <div class="form-group">
                <label><?=lang('Mobile');?></label>
                <input type="number" name="mobile" value="<?php echo set_value('mobile')?>" class="form-control" placeholder="<?=lang('Mobile');?>" autocomplete="off">
                <?php echo form_error('mobile'); ?>
              </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <input type="submit" value="<?=lang('Save');?>" class="btn btn-primary">
            </div>
          <?php form_close();  ?>
          <!-- END add intensity form -->
        </div>
      </div> 
    </div>
  </section>    
  <!-- end add intensity form -->
</div>
