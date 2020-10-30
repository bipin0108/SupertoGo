<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Edit Light Soil Schedule
      <a href="<?php echo base_url('admin/light-soil-schedule-list/'); ?>" class="btn btn-primary pull-right" > <i class="fa fa-angle-double-left" aria-hidden="true"></i>  Back to List</a>
    </h1>
  </section>
  <!-- start  form -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Edit Light Soil Schedule</h3>
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
          <!-- START  form -->
          <?php echo form_open_multipart('admin/update-light-soil-schedule'); ?>
            <div class="box-body">  
                <input type="hidden" name="id" value="<?php echo $schedule['id']; ?>" >
                <!-- Start -->
                <div class="col-md-12">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Stage [English]</label>
                      <input type="text" name="en_stage" value="<?php echo $schedule['en_stage'] ?>" class="form-control" placeholder="Stage [English]" autocomplete="off">
                      <?php echo form_error('en_stage'); ?>
                    </div>
                    <div class="form-group">
                      <label>Stage [Hindi]</label>
                      <input type="text" name="hi_stage" value="<?php echo $schedule['hi_stage'] ?>" class="form-control" placeholder="Stage [Hindi]" autocomplete="off">
                      <?php echo form_error('hi_stage'); ?>
                    </div>
                  </div>  
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Stage [Marathi]</label>
                      <input type="text" name="mr_stage" value="<?php echo $schedule['mr_stage'] ?>" class="form-control" placeholder="Stage [Marathi]" autocomplete="off">
                      <?php echo form_error('mr_stage'); ?>
                    </div>
                    <div class="form-group">
                      <label>Day</label>
                      <input type="number" name="s_day" value="<?php echo $schedule['s_day'] ?>" class="form-control" placeholder="Day" autocomplete="off">
                      <?php echo form_error('s_day'); ?>
                    </div>
                  </div> 
                </div>
                <!-- Start -->
                <div class="col-md-12">
                  <div class="col-md-4">
                     <div class="form-group">
                      <label>Activity Type [English]</label>
                      <input type="text" name="en_activity_type" value="<?php echo $schedule['en_activity_type'] ?>" class="form-control" placeholder="Activity Type [English]" autocomplete="off">
                      <?php echo form_error('en_activity_type'); ?>
                    </div>
                  </div>  
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Activity Type [Hindi]</label>
                      <input type="text" name="hi_activity_type" value="<?php echo $schedule['hi_activity_type'] ?>" class="form-control" placeholder="Activity Type [Hindi]" autocomplete="off">
                      <?php echo form_error('hi_activity_type'); ?>
                    </div>
                  </div>  
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Activity Type [Marathi]</label>
                      <input type="text" name="mr_activity_type" value="<?php echo $schedule['mr_activity_type'] ?>" class="form-control" placeholder="Activity Type [Marathi]" autocomplete="off">
                      <?php echo form_error('mr_activity_type'); ?>
                    </div>
                  </div>  
                </div>
                <!-- Start -->  
                <div class="col-md-12">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Problem Type [English]</label>
                      <input type="text" name="en_problem_type" value="<?php echo $schedule['en_problem_type'] ?>" class="form-control" placeholder="Problem Type [English]" autocomplete="off">
                      <?php echo form_error('en_problem_type'); ?>
                    </div>
                  </div>  
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Problem Type [Hindi]</label>
                      <input type="text" name="hi_problem_type" value="<?php echo $schedule['hi_problem_type'] ?>" class="form-control" placeholder="Problem Type [Hindi]" autocomplete="off">
                      <?php echo form_error('hi_problem_type'); ?>
                    </div>
                  </div>  
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Problem Type [Marathi]</label>
                      <input type="text" name="mr_problem_type" value="<?php echo $schedule['mr_problem_type'] ?>" class="form-control" placeholder="Problem Type [Marathi]" autocomplete="off">
                      <?php echo form_error('mr_problem_type'); ?>
                    </div>
                  </div>  
                </div>
                <!-- Start -->  
                 <div class="col-md-12">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Problem [English]</label>
                      <textarea name="en_problem" class="form-control" placeholder="Problem [English]" autocomplete="off"><?php echo $schedule['en_problem'] ?></textarea>
                      <?php echo form_error('en_problem'); ?>
                    </div>
                  </div>  
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Problem [Hindi]</label>
                      <textarea name="hi_problem" class="form-control" placeholder="Problem [Hindi]" autocomplete="off"><?php echo $schedule['hi_problem'] ?></textarea>
                      <?php echo form_error('hi_problem'); ?>
                    </div>
                  </div>  
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Problem [Marathi]</label>
                      <textarea name="mr_problem" class="form-control" placeholder="Problem [Marathi]" autocomplete="off"><?php echo $schedule['mr_problem'] ?></textarea>
                      <?php echo form_error('mr_problem'); ?>
                    </div>
                  </div>  
                </div>
                <!-- Start -->  
                 <div class="col-md-12">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Technical Name [English]</label>
                      <input name="en_technical_name" value="<?php echo $schedule['en_technical_name'] ?>"  class="form-control" placeholder="Technical Name [English]" autocomplete="off">
                      <?php echo form_error('en_technical_name'); ?>
                    </div>
                  </div>  
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Technical Name [Hindi]</label>
                      <input name="hi_technical_name" value="<?php echo $schedule['hi_technical_name'] ?>" class="form-control" placeholder="Technical Name [Hindi]" autocomplete="off">
                      <?php echo form_error('hi_technical_name'); ?>
                    </div>
                  </div>  
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Technical Name [Marathi]</label>
                      <input name="mr_technical_name" value="<?php echo $schedule['mr_technical_name'] ?>" class="form-control" placeholder="Technical Name [Marathi]" autocomplete="off">
                      <?php echo form_error('mr_technical_name'); ?>
                    </div>
                  </div>  
                </div>
                <!-- Start -->  
                 <div class="col-md-12">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Brand Name [English]</label>
                      <input name="en_brand_name" value="<?php echo $schedule['en_brand_name'] ?>" class="form-control" placeholder="Brand Name [English]" autocomplete="off">
                      <?php echo form_error('en_brand_name'); ?>
                    </div>
                  </div>  
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Brand Name [Hindi]</label>
                      <input name="hi_brand_name" value="<?php echo $schedule['hi_brand_name'] ?>" class="form-control" placeholder="Brand Name [Hindi]" autocomplete="off">
                      <?php echo form_error('hi_brand_name'); ?>
                    </div>
                  </div>  
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Brand Name [Marathi]</label>
                      <input name="mr_brand_name" value="<?php echo $schedule['mr_brand_name'] ?>" class="form-control" placeholder="Brand Name [Marathi]" autocomplete="off">
                      <?php echo form_error('mr_brand_name'); ?>
                    </div>
                  </div>  
                </div>
                <!-- Start -->  
                 <div class="col-md-12">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Quantity [English]</label>
                      <input name="en_qty" value="<?php echo $schedule['en_qty'] ?>" class="form-control" placeholder="Quantity [English]" autocomplete="off">
                      <?php echo form_error('en_qty'); ?>
                    </div>
                  </div>  
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Quantity [Hindi]</label>
                      <input name="hi_qty" value="<?php echo $schedule['hi_qty'] ?>" class="form-control" placeholder="Quantity [Hindi]" autocomplete="off">
                      <?php echo form_error('hi_qty'); ?>
                    </div>
                  </div>  
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Quantity [Marathi]</label>
                      <input name="mr_qty" value="<?php echo $schedule['mr_qty'] ?>" class="form-control" placeholder="Quantity [Marathi]" autocomplete="off">
                      <?php echo form_error('mr_qty'); ?>
                    </div>
                  </div>  
                </div>
                <!-- Start --> 
                 <div class="col-md-12">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Unit [English]</label>
                      <input type="text" name="en_unit" value="<?php echo $schedule['en_unit'] ?>" class="form-control" placeholder="Unit [English]" autocomplete="off">
                      <?php echo form_error('en_unit'); ?>
                    </div>
                  </div>  
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Unit [Hindi]</label>
                      <input type="text" name="hi_unit" value="<?php echo $schedule['hi_unit'] ?>" class="form-control" placeholder="Unit [Hindi]" autocomplete="off">
                      <?php echo form_error('hi_unit'); ?>
                    </div>
                  </div>  
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Unit [Marathi]</label>
                      <input type="text" name="mr_unit" value="<?php echo $schedule['mr_unit'] ?>" class="form-control" placeholder="Unit [Marathi]" autocomplete="off">
                      <?php echo form_error('mr_unit'); ?>
                    </div>     
                  </div>  
                </div>  
                <!-- Start -->
                <div class="col-md-12">
                  <div class="col-md-4">
                     <div class="form-group">
                      <label>Per [English]</label>
                      <input type="text" name="en_per" value="<?php echo $schedule['en_per'] ?>" class="form-control" placeholder="Per [English]" autocomplete="off">
                      <?php echo form_error('en_per'); ?>
                    </div>
                  </div>  
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Per [Hindi]</label>
                      <input type="text" name="hi_per" value="<?php echo $schedule['hi_per'] ?>" class="form-control" placeholder="Per [Hindi]" autocomplete="off">
                      <?php echo form_error('hi_per'); ?>
                    </div>
                  </div>  
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Per [Marathi]</label>
                      <input type="text" name="mr_per" value="<?php echo $schedule['mr_per'] ?>" class="form-control" placeholder="Per [Marathi]" autocomplete="off">
                      <?php echo form_error('mr_per'); ?>
                    </div>
                  </div>  
                </div>
                <!-- Start --> 
                <div class="col-md-12">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Remark [English]</label>
                      <textarea name="en_remark" class="form-control" placeholder="Remark [English]" autocomplete="off"><?php echo $schedule['en_remark'] ?></textarea>
                      <?php echo form_error('en_remark'); ?>
                    </div>
                  </div>  
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Remark [Hindi]</label>
                      <textarea name="hi_remark" class="form-control" placeholder="Remark [Hindi]" autocomplete="off"><?php echo $schedule['hi_remark'] ?></textarea>
                      <?php echo form_error('hi_remark'); ?>
                    </div>
                  </div>  
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Remark [Marathi]</label>
                      <textarea name="mr_remark" class="form-control" placeholder="Remark [Marathi]" autocomplete="off"><?php echo $schedule['mr_remark'] ?></textarea>
                      <?php echo form_error('mr_remark'); ?>
                    </div>
                  </div>  
                </div>
            </div><!-- /.box-body -->
            <div class="box-footer">
              <input type="submit" value="Update" class="btn btn-primary">
            </div>
          <?php form_close();  ?>
          <!-- END  form -->
        </div>
      </div> 
    </div>
  </section>    
  <!-- end  form -->
</div>
