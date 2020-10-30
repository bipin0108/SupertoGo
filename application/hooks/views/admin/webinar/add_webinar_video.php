<?php
  $obj=&get_instance();
  $webinar = $obj->webinarmodel->get_webinar_by_id($webinar_id);
?> 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Webinar Video Series
       <a href="<?php echo base_url('admin/webinar-video-list/'.$webinar_id); ?>" class="btn btn-primary pull-right" ><i class="fa fa-angle-double-left" aria-hidden="true"></i>   Back to Webinar</a>
    </h1>
    <h5><b>Webinar Name : </b> <?php echo $webinar['en_title']." [".$webinar['hi_title']."] [".$webinar['mr_title']."]" ?></h5>
  </section>
  <!-- start add control measure form -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
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
          <!-- START add control measure form -->
            <?php echo form_open_multipart('admin/add-webinar-video'); ?>
            <div class="box-body">
              <input type="hidden" name="webinar_id" value="<?php echo $webinar_id; ?>">
              <!-- video -->
              <div class="col-md-12">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Youtube Link [English]</label>
                      <input type="text" name="en_link" class="form-control" placeholder="Video Link [English]" value="<?php echo set_value('en_link')?>">
                      <?php echo form_error('en_link'); ?>
                    </div>
                  </div>  
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Youtube Link [Hindi]</label>
                      <input type="text" name="hi_link" class="form-control" placeholder="Video Link [Hindi]" value="<?php echo set_value('hi_link')?>">
                      <?php echo form_error('hi_link'); ?>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Youtube Link [Marathi]</label>
                      <input type="text" name="mr_link" class="form-control" placeholder="Video Link [Marathi]" value="<?php echo set_value('mr_link')?>">
                      <?php echo form_error('mr_link'); ?>
                    </div>
                  </div>    
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Youtube Link ID [English]</label>
                      <input type="text" name="en_id" class="form-control" placeholder="Video Link ID [English]" value="<?php echo set_value('en_id')?>">
                      <?php echo form_error('en_id'); ?>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Youtube Link ID [Hindi]</label>
                      <input type="text" name="hi_id" class="form-control" placeholder="Video Link ID [Hindi]" value="<?php echo set_value('hi_id')?>">
                      <?php echo form_error('hi_id'); ?>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Youtube Link ID [Marathi]</label>
                      <input type="text" name="mr_id" class="form-control" placeholder="Video Link ID [Marathi]" value="<?php echo set_value('mr_id')?>" >
                      <?php echo form_error('mr_id'); ?>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Video Description [English]</label>
                      <textarea rows="4" class="form-control" name="en_description"  placeholder="Video Description [English]"  placeholder="Video Description [English]" autocomplete="off" ><?php echo set_value('en_description')?></textarea>
                      <?php echo form_error('en_description'); ?>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Video Description [Hindi]</label>
                      <textarea rows="4" class="form-control" name="hi_description"  placeholder="Video Description [Hindi]" placeholder="Video Description [Hindi]" autocomplete="off" ><?php echo set_value('hi_description')?></textarea>
                      <?php echo form_error('hi_description'); ?>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Video Description [Marathi]</label>
                      <textarea rows="4" class="form-control" name="mr_description"  placeholder="Video Description [Marathi]" placeholder="Video Description [Marathi]" autocomplete="off" ><?php echo set_value('mr_description')?></textarea>
                      <?php echo form_error('mr_description'); ?>
                    </div>
                  </div>
                  <hr/>
                </div>
              <!-- end -->
            </div>
            <div class="box-footer">
              <input type="submit" id="submit" value="Save" class="btn btn-primary">
            </div>  
            <?php form_close();  ?>
            <!-- /.box-body -->
          <!-- END  form -->
        </div>
        
      </div> 
    </div>
  </section>    
  <!-- end add control measure form -->
</div>
