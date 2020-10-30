<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <?=lang('Brand');?>
      <a href="<?php echo base_url('admin/brand-list/'); ?>" class="btn btn-primary pull-right" > <i class="fa fa-angle-double-left" aria-hidden="true"></i>  <?=lang('Back to List');?></a>
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
          <!-- START add intensity form -->
          <?php echo form_open('admin/add-brand'); ?>
            <div class="box-body">
                <div class="form-group">
                  <label><?=lang('Brand Name');?></label>
                  <input type="text" name="name" value="<?php echo set_value('name')?>" class="form-control" placeholder="<?=lang('Brand Name');?>" autocomplete="off">
                  <?php echo form_error('name'); ?>
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
