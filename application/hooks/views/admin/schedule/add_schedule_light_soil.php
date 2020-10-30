<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Add Light Soil Schedule for <?php echo $month; ?>
      <a href="<?php echo base_url('admin/light-soil-schedule-list/'); ?>" class="btn btn-primary pull-right" > <i class="fa fa-angle-double-left" aria-hidden="true"></i> Back to List</a>
    </h1>
  </section>
  <!-- start add  form -->
  <section class="content">
    <div class="row">
      <div class="col-xs-6">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Add Light Soil Schedule</h3>
          </div>
          <!-- START add  form -->
          <?php echo form_open_multipart('admin/add-light-soil-schedule'); ?>
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
                <input type="hidden" name="month" value="<?php echo $month; ?>">
                <div class="form-group">
                    <label>Upload Excel</label>
                    <input type="file" name="schedule_file" class="form-control" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required>  

                    <?php echo form_error('schedule_file'); ?>

                    <?php if($this->session->flashdata('schedule_file_error')): ?>
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <span><?php echo $this->session->flashdata('schedule_file_error') ?></span>
                    </div>
                    <?php endif ?>
              </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <input type="submit" value="Add Schedule for <?php echo $month; ?>" id="schedule_btn" class="btn btn-primary">
            </div>
          <?php form_close();  ?>
          <!-- END add  form -->
        </div>
      </div> 
    </div>
  </section>    
  <!-- end add  form -->
</div>
<script type="text/javascript">
$(document).ready(function(){
      // $(document).on('click', '#schedule_btn', function(){
      //       $(this).prop('disabled',true);
      // });
});      
</script>


