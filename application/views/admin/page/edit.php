<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <?=lang('Page');?>
      <a href="<?php echo base_url('admin/page-list/'); ?>" class="btn btn-primary pull-right" > <i class="fa fa-angle-double-left" aria-hidden="true"></i>  <?=lang('Back to List');?></a>
    </h1>
  </section>
  <!-- start add module form -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title"><?=lang('Edit');?></h3>
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
          <?php echo form_open('admin/update-page/'.$pages['page_id']); ?>
            <div class="box-body">
              <div class="col-xs-6">
                <input type="hidden" name="id" value="<?php echo $pages['page_id']; ?>" >
                <div class="form-group">
                  <label><?=lang('Title');?></label>
                  <input type="text" name="title" value="<?php echo $pages['title'] ?>" class="form-control" placeholder="<?=lang('Title');?>" autocomplete="off">
                  <?php echo form_error('title'); ?>
                </div>
              </div>
              <div class="col-xs-12">
                <div class="form-group">
                  <label><?=lang('Description');?></label>
                  <textarea name="description" id="description" class="form-control" placeholder="<?=lang('Description');?>" autocomplete="off"><?php echo $pages['description'] ?></textarea>
                  <?php echo form_error('description'); ?>
                </div>
              </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <input type="submit" value="<?=lang('Save');?>" class="btn btn-primary">
            </div>
          <?php form_close();  ?>
          <!-- END add bacterial intensity form -->
        </div>
      </div> 
    </div>
  </section>    
  <!-- end add bacterial intensity form -->
</div>
<script src="<?=base_url('public');?>/components/ckeditor/ckeditor.js"></script>
<script>
  $(function () {
    CKEDITOR.replace('description');
  });
</script>