<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <?=lang('Bulk Product');?>
      <a href="<?php echo base_url('admin/product-list'); ?>" class="btn btn-primary pull-right" ><i class="fa fa-angle-double-left" aria-hidden="true"></i> <?=lang('Back to List');?></a>
    </h1>
  </section>
  <!-- start add bulk product form -->
  <section class="content">
    <div class="row">
      <div class="col-xs-6">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title"><?=lang('Add');?></h3>
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
          <!-- START add bulk product form -->
            <form action="<?=base_url('admin/bulk-product');?>" method="post" enctype="multipart/form-data" id="frmAdd">
              <div class="box-body">
                 <!-- start -->
                  <div class="form-group">
                      <label><?=lang('Upload Excel');?></label>
                      <input type="file" name="product_excel" class="form-control" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">  
                      <?php echo form_error('product_excel'); ?>
                      <?php if($this->session->flashdata('product_excel_error')): ?>
                      <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <span><?php echo $this->session->flashdata('product_excel_error') ?></span>
                      </div>
                      <?php endif ?>
                  </div>
                  <div class="form-group">
                      <label><?=lang('Upload Image');?></label>
                      <input type="file" name="image[]" class="form-control" accept=".png, .jpg, .jpeg" multiple>  
                      <?php echo form_error('image'); ?>
                      <?php if($this->session->flashdata('image_error')): ?>
                      <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <span><?php echo $this->session->flashdata('image_error') ?></span>
                      </div>
                      <?php endif ?>
                  </div>
                <!-- end -->
              </div>
              <div class="box-footer">
                <input type="submit" id="submit" value="<?=lang('Save');?>" class="btn btn-primary">
              </div>  
            </form> 
            <!-- /.box-body -->
          <!-- END  form -->
        </div>
        
      </div> 
    </div>
  </section>    
  <!-- end add bulk product form -->
</div>
<script src="<?=base_url('public/js/jquery.validate.js');?>"></script>
<script>
  $(document).ready(function(){
    $("#frmAdd").validate({
      rules: {
        product_excel: {
          required: true
        },
        'image[]': {
          required: true
        },
      },
      submitHandler: function(form) {
        $('#frmAdd input[type="submit"]').attr('disabled', true); 
        form.trigger('submit'); 
      }
    });
  });
</script>