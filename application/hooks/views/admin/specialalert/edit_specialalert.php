<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Special Alert
      <a href="<?php echo base_url('admin/special-alert-list/'); ?>" class="btn btn-primary pull-right" > <i class="fa fa-angle-double-left" aria-hidden="true"></i>  Back to List</a>
    </h1>
  </section>
  <!-- start add  form -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Add
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
          <!-- START add  form -->
          <?php echo form_open('admin/update-special-alert'); ?>
            <div class="box-body">
              <input type="hidden" name="id" value="<?php echo $specialalert['id'] ?>" >
              <!-- start -->
              <div class="col-md-12">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Title [English]</label>
                    <input type="text" name="en_title" value="<?php echo $specialalert['en_title'] ?>" class="form-control" placeholder="Title [English]" autocomplete="off">
                    <?php echo form_error('en_title'); ?>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Title [Hindi]</label>
                    <input type="text" name="hi_title" value="<?php echo $specialalert['hi_title'] ?>" class="form-control" placeholder="Title [Hindi]" autocomplete="off">
                    <?php echo form_error('hi_title'); ?>
                  </div>
                </div>  
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Title [Marathi] </label>
                    <input type="text" name="mr_title" value="<?php echo $specialalert['mr_title'] ?>" class="form-control" placeholder="Title [Marathi]" autocomplete="off">
                    <?php echo form_error('mr_title'); ?>
                  </div>
                </div>  
              </div>
              <!-- start -->
              <div class="col-md-12">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Description [English]</label>
                    <textarea rows="4" class="form-control" id="en_description" name="en_description"  autocomplete="off" required><?php echo $specialalert['en_description'] ?></textarea>
                    <?php echo form_error('en_description'); ?>
                  </div>
                  <div class="form-group">
                    <label>Description [Hindi]</label>
                    <textarea rows="4" class="form-control" id="hi_description" name="hi_description" autocomplete="off" required><?php echo $specialalert['hi_description'] ?></textarea>
                    <?php echo form_error('hi_description'); ?>
                  </div>
                  <div class="form-group">
                    <label>Description [Marathi]</label>
                    <textarea rows="4" class="form-control" id="mr_description" name="mr_description" autocomplete="off" required><?php echo $specialalert['mr_description'] ?></textarea>
                    <?php echo form_error('mr_description'); ?>
                  </div>
                </div>
              </div>    
              <!-- end -->                  
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <input type="submit" value="Save" class="btn btn-primary">
            </div>
          <?php form_close();  ?>
          <!-- END add  form -->
        </div>
      </div> 
    </div>
  </section>    
  <!-- end add  form -->
</div>
