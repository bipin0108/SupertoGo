<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Topic
      <a href="<?php echo base_url('admin/knowledge-bank-topic/'.$crop_id); ?>" class="btn btn-primary pull-right" > <i class="fa fa-angle-double-left" aria-hidden="true"></i>  Back to Topic List</a>
    </h1>
  </section>
  <!-- start add Category form -->
  <section class="content">
    <div class="row">
      <div class="col-xs-6">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Add</h3>
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
          <!-- START add Category form -->
          <?php echo form_open_multipart('admin/add-knowledge-bank-topic'); ?>
            <div class="box-body">
                <input type="hidden" name="crop_id" value="<?php echo $crop_id; ?>">
                <div class="form-group">
                   <label>Topic Name [English]</label>
                    <input type="text" name="en_name" value="<?php echo set_value('en_name')?>" class="form-control" placeholder="Topic Name [English]" autocomplete="off">
                    <?php echo form_error('en_name'); ?>
                </div>
                <div class="form-group">
                    <label>Topic Name [Hindi]</label>
                    <input type="text" name="hi_name" value="<?php echo set_value('hi_name')?>" class="form-control" placeholder="Topic Name [Hindi]" autocomplete="off">
                    <?php echo form_error('hi_name'); ?>
                </div>
                <div class="form-group">
                    <label>Topic Name [Marathi] </label>
                    <input type="text" name="mr_name" value="<?php echo set_value('mr_name')?>" class="form-control" placeholder="Topic Name [Marathi]" autocomplete="off">
                    <?php echo form_error('mr_name'); ?>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <input type="submit" value="Save" class="btn btn-primary">
            </div>
          <?php form_close();  ?>
          <!-- END add Category form -->
        </div>
      </div> 
    </div>
  </section>    
  <!-- end add Category form -->
</div>