<link rel="stylesheet" href="<?=base_url('public');?>/components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <?=lang('Promocode');?>
      <a href="<?php echo base_url('admin/promocode-list/'); ?>" class="btn btn-primary pull-right" > <i class="fa fa-angle-double-left" aria-hidden="true"></i>  <?=lang('Back to List');?></a>
    </h1>
  </section>
  <!-- start add intensity form -->
  <section class="content">
    <div class="row">
        <div class="col-md-6">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title"><?=lang('Add');?>
            </h3>
          </div>
          
          <!-- START add intensity form -->
          <?php echo form_open_multipart('admin/add-promocode'); ?>
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
                <label><?=lang('Promocode');?></label>
                <input type="text" name="promocode" value="<?php echo set_value('promocode')?>" class="form-control" placeholder="<?=lang('Promocode');?>" autocomplete="off">
                <?php echo form_error('promocode'); ?>
              </div>
              <div class="form-group">
                <label><?=lang('Discount Type');?></label>
                <select class="form-control" name="discount_type" >
                  <option value=""><?=lang('Discount Type');?></option>
                  <option value="1">Percent</option>
                  <option value="2">Flat</option>
                </select>
                <?php echo form_error('store_ids[]'); ?>
              </div>
              <div class="form-group">
                <label><?=lang('Discount');?></label>
                <input type="number" name="discount" value="<?php echo set_value('discount')?>" class="form-control" placeholder="<?=lang('Discount');?>" autocomplete="off">
                <?php echo form_error('discount'); ?>
              </div>
              <div class="form-group">
                <label><?=lang('Min Price');?></label>
                <input type="number" name="min_price" value="<?php echo set_value('min_price')?>" class="form-control" placeholder="<?=lang('Min Price');?>" autocomplete="off">
                <?php echo form_error('min_price'); ?>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label><?=lang('Start Date');?></label>
                    <input type="text" name="start_date" value="<?php echo set_value('start_date')?>" class="form-control datepicker" placeholder="<?=lang('Start Date');?>" autocomplete="off">
                    <?php echo form_error('start_date'); ?>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label><?=lang('End Date');?></label>
                    <input type="text" name="end_date" value="<?php echo set_value('end_date')?>" class="form-control datepicker" placeholder="<?=lang('End Date');?>" autocomplete="off">
                    <?php echo form_error('end_date'); ?>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label><?=lang('Description');?></label>
                <textarea name="description" class="form-control" placeholder="<?=lang('Description');?>" autocomplete="off"><?php echo set_value('description')?></textarea>
                <?php echo form_error('description'); ?>
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
<script src="<?=base_url('public');?>/components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script>
  $(document).ready(function(){
    $('.datepicker').datepicker({
      autoclose: true,
      startDate:'+0d'
    });
  });
</script>
