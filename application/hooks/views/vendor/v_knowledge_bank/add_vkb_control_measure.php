<?php
$obj=&get_instance();
$technical = $obj->knowledgebankmodel->get_technical_by_id($technical_id); 
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Control Measure
       <a href="<?php echo base_url('vendor/control-measure-list/'.$technical_id); ?>" class="btn btn-primary pull-right" ><i class="fa fa-angle-double-left" aria-hidden="true"></i>   Back to Control Measure</a>
    </h1>
    <h5><b>Technical Name : </b> <?php echo $technical['en_technical_name']." [".$technical['hi_technical_name']."] [".$technical['mr_technical_name']."]" ?></h5>
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
            <?php echo form_open_multipart('vendor/add-control-measure'); ?>
            <div class="box-body">
               <input type="hidden" name="technical_id" value="<?php echo $technical_id; ?>">
              <!-- start -->
              <div class="col-md-12">
                <div class="col-md-4">
                   <div class="form-group">
                    <label>Brand Name [English]</label>
                    <input type="text" name="en_brand_name" value="<?php echo set_value('en_brand_name') ?>" class="form-control" placeholder="Brand [English]" autocomplete="off">
                    <?php echo form_error('en_brand_name'); ?>
                  </div>
                </div>  
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Brand Name [Hindi]</label>
                    <input type="text" name="hi_brand_name" value="<?php echo set_value('hi_brand_name') ?>" class="form-control" placeholder="Brand [Hindi]" autocomplete="off">
                    <?php echo form_error('hi_brand_name'); ?>
                  </div>
                </div>  
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Brand Name [Marathi]</label>
                    <input type="text" name="mr_brand_name" value="<?php echo set_value('mr_brand_name') ?>" class="form-control" placeholder="Brand [Marathi]" autocomplete="off">
                    <?php echo form_error('mr_brand_name'); ?>
                  </div>
                </div>  
              </div>
              <!-- start -->  
             <div class="col-md-12">
                <div class="col-md-4">
                   <div class="form-group">
                    <label>Company Name [English]</label>
                    <input type="text" name="en_company_name" value="<?php echo set_value('en_company_name') ?>" class="form-control" placeholder="Company [English]" autocomplete="off">
                    <?php echo form_error('en_company_name'); ?>
                  </div>
                </div>  
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Company Name [Hindi]</label>
                    <input type="text" name="hi_company_name" value="<?php echo set_value('hi_company_name') ?>" class="form-control" placeholder="Company [Hindi]" autocomplete="off">
                    <?php echo form_error('hi_company_name'); ?>
                  </div>
                </div>  
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Company Name [Marathi]</label>
                    <input type="text" name="mr_company_name" value="<?php echo set_value('mr_company_name') ?>" class="form-control" placeholder="Company [Marathi]" autocomplete="off">
                    <?php echo form_error('mr_company_name'); ?>
                  </div>
                </div>  
              </div>
              <div class="col-md-12">
                  <div class="col-md-4">
                     <div class="form-group">
                      <label>Dosage [English]</label>
                      <input type="text" name="en_dose" value="<?php echo set_value('en_dose') ?>" class="form-control" placeholder="Dosage [English]" autocomplete="off">
                      <?php echo form_error('en_dose'); ?>
                    </div>
                  </div>  
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Dosage [Hindi]</label>
                      <input type="text" name="hi_dose" value="<?php echo set_value('hi_dose') ?>" class="form-control" placeholder="Dosage [Hindi]" autocomplete="off">
                      <?php echo form_error('hi_dose'); ?>
                    </div>
                  </div>  
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Dosage [Marathi]</label>
                      <input type="text" name="mr_dose" value="<?php echo set_value('mr_dose') ?>" class="form-control" placeholder="Dosage [Marathi]" autocomplete="off">
                      <?php echo form_error('mr_dose'); ?>
                    </div>
                  </div>  
              </div>
              <div class="col-md-12">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Description [English]</label>
                    <textarea class="form-control" id="en_cm_description" name="en_cm_description" autocomplete="off" rows="4" placeholder="Description [English]"><?php echo set_value('en_cm_description') ?></textarea>
                    <?php echo form_error('en_cm_description'); ?>
                  </div>
                </div>
                <div class="col-md-12">  
                  <div class="form-group">
                    <label>Description [Hindi]</label>
                    <textarea class="form-control" id="hi_cm_description" name="hi_cm_description" autocomplete="off" rows="4" placeholder="Description [Hindi]"><?php echo set_value('hi_cm_description') ?></textarea>
                    <?php echo form_error('hi_cm_description'); ?>
                  </div>
                </div>
                <div class="col-md-12">  
                  <div class="form-group">
                    <label>Description [Marathi]</label>
                    <textarea class="form-control" id="mr_cm_description" name="mr_cm_description" autocomplete="off" rows="4" placeholder="Description [Marathi]"><?php echo set_value('mr_cm_description') ?></textarea>
                    <?php echo form_error('mr_cm_description'); ?>
                  </div>
                </div>  
              </div>  
              <div class="col-md-12">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Upload Base Image</label>
                    <input type="file" name="base_image" class="form-control" autocomplete="on" accept=".png,.jpg,.jpeg" >
                    <?php echo form_error('base_image'); ?>
                    <?php if($this->session->flashdata('base_image_error')): ?>
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <span><?php echo $this->session->flashdata('base_image_error') ?></span>
                    </div>
                    <?php endif ?>
                  </div>
                </div>
              </div>
              <!-- video -->
              <div class="col-md-12">
                  <h5><b><i class="fa fa-hand-o-right" aria-hidden="true"></i> Youtube Video</b></h5>
                  <hr>
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
                      <textarea class="form-control" name="en_description"  placeholder="Video Description [English]"  autocomplete="off" rows="4"><?php echo set_value('en_description')?></textarea>
                      <?php echo form_error('en_description'); ?>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Video Description [Hindi]</label>
                      <textarea class="form-control" name="hi_description"  placeholder="Video Description [Hindi]" autocomplete="off" rows="4"><?php echo set_value('hi_description')?></textarea>
                      <?php echo form_error('hi_description'); ?>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Video Description [Marathi]</label>
                      <textarea class="form-control" name="mr_description"  placeholder="Video Description [Marathi]" autocomplete="off" rows="4"><?php echo set_value('mr_description')?></textarea>
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

