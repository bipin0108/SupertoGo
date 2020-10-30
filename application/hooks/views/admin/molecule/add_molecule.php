<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Add Molecule for <?php echo $activity_type; ?>
      <a href="<?php echo base_url('admin/molecule-list/'); ?>" class="btn btn-primary pull-right" > <i class="fa fa-angle-double-left" aria-hidden="true"></i> Back to List</a>
    </h1>
  </section>
  <!-- start add  form -->
  <section class="content">
    <div class="row">
      <div class="col-xs-6">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Add Molecule</h3>
          </div>
          <!-- START add  form -->
          <?php echo form_open_multipart('admin/add-molecule'); ?>
            <div class="box-body">
                <?php if(!empty($this->session->flashdata('success'))): ?>
                  <div class="alert alert-success">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <span> <?php echo $this->session->flashdata('success'); ?> </span>
                  </div>
                  <?php endif ?> 
                 
                  <?php if($this->session->flashdata('error1')): ?>
                  <div class="alert alert-danger">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <span><?php echo $this->session->flashdata('error1') ?></span>
                  </div>
                  <?php endif ?>
                <input type="hidden" name="activity_type" value="<?php echo $activity_type; ?>">
                <div class="form-group">
                    <label>Upload Excel</label>
                    <input type="file" name="molecule_file" class="form-control" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">  

                    <?php echo form_error('molecule_file'); ?>

                    <?php if($this->session->flashdata('molecule_file_error')): ?>
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <span><?php echo $this->session->flashdata('molecule_file_error') ?></span>
                    </div>
                    <?php endif ?>
              </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <input type="submit" value="Add Molecule" class="btn btn-primary">
            </div>
          <?php form_close();  ?>
          <!-- END add  form -->
        </div>
      </div> 
    </div>
  </section>    
  <!-- end add  form -->
</div>


