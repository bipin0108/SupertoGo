<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Edit Molecule
      <a href="<?php echo base_url('admin/molecule-list/'); ?>" class="btn btn-primary pull-right" > <i class="fa fa-angle-double-left" aria-hidden="true"></i>  Back to List</a>
    </h1>
  </section>
  <!-- start  form -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Edit Molecule</h3>
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
          <?php echo form_open_multipart('admin/update-molecule'); ?>
            <div class="box-body">  
                <input type="hidden" name="id" value="<?php echo $molecule['id']; ?>" >
                <!-- Start -->
                <div class="col-md-12">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Problem Type [English]</label>
                      <input type="text" name="en_problem_type" value="<?php echo $molecule['en_problem_type'] ?>" class="form-control" placeholder="Problem Type [English]" autocomplete="off">
                      <?php echo form_error('en_problem_type'); ?>
                    </div>
                  </div>  
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Problem Type [Hindi]</label>
                      <input type="text" name="hi_problem_type" value="<?php echo $molecule['hi_problem_type'] ?>" class="form-control" placeholder="Problem Type [Hindi]" autocomplete="off">
                      <?php echo form_error('hi_problem_type'); ?>
                    </div>
                  </div>  
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Problem Type [Marathi]</label>
                      <input type="text" name="mr_problem_type" value="<?php echo $molecule['mr_problem_type'] ?>" class="form-control" placeholder="Problem Type [Marathi]" autocomplete="off">
                      <?php echo form_error('mr_problem_type'); ?>
                    </div>
                  </div>  
                </div>
                <!-- Start -->  
                 <div class="col-md-12">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Problem [English]</label>
                      <textarea rows="4" name="en_problem" class="form-control" placeholder="Problem [English]" autocomplete="off"><?php echo $molecule['en_problem'] ?></textarea>
                      <?php echo form_error('en_problem'); ?>
                    </div>
                  </div>  
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Problem [Hindi]</label>
                      <textarea rows="4" name="hi_problem" class="form-control" placeholder="Problem [Hindi]" autocomplete="off"><?php echo $molecule['hi_problem'] ?></textarea>
                      <?php echo form_error('hi_problem'); ?>
                    </div>
                  </div>  
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Problem [Marathi]</label>
                      <textarea rows="4" name="mr_problem"  class="form-control" placeholder="Problem [Marathi]" autocomplete="off"><?php echo $molecule['mr_problem']  ?></textarea>
                      <?php echo form_error('mr_problem'); ?>
                    </div>
                  </div>  
                </div>

                <!-- Start -->  
                 <div class="col-md-12">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Problem Area[English]</label>
                      <input name="en_problem_area" value="<?php echo $molecule['en_problem_area'] ?>" class="form-control" placeholder="Problem Area [English]" autocomplete="off">
                      <?php echo form_error('en_problem_area'); ?>
                    </div>
                  </div>  
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Problem Area [Hindi]</label>
                      <input name="hi_problem_area" value="<?php echo $molecule['hi_problem_area'] ?>" class="form-control" placeholder="Problem Area [Hindi]" autocomplete="off">
                      <?php echo form_error('hi_problem_area'); ?>
                    </div>
                  </div>  
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Problem Area [Marathi]</label>
                      <input name="mr_problem_area" value="<?php echo $molecule['mr_problem_area']  ?>" class="form-control" placeholder="Problem Area [Marathi]" autocomplete="off">
                      <?php echo form_error('mr_problem_area'); ?>
                    </div>
                  </div>  
                </div>
                <!-- Start --> 
                <div class="col-md-12">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Technical Name [English]</label>
                      <input type="text" name="en_technical_name" value="<?php echo $molecule['en_technical_name'] ?>" class="form-control" placeholder="Technical Name [English]" autocomplete="off">
                      <?php echo form_error('en_technical_name'); ?>
                    </div>
                  </div>  
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Technical Name [Hindi]</label>
                      <input type="text" name="hi_technical_name" value="<?php echo $molecule['hi_technical_name'] ?>" class="form-control" placeholder="Technical Name [Hindi]" autocomplete="off">
                      <?php echo form_error('hi_technical_name'); ?>
                    </div>
                  </div>  
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Technical Name [Marathi]</label>
                      <input type="text" name="mr_technical_name" value="<?php echo $molecule['mr_technical_name'] ?>" class="form-control" placeholder="Technical Name [Marathi]" autocomplete="off">
                      <?php echo form_error('mr_technical_name'); ?>
                    </div>     
                  </div>  
                </div> 
                <!-- Start --> 
                 <div class="col-md-12">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Formulation [English]</label>
                      <input type="text" name="en_formulation" value="<?php echo $molecule['en_formulation'] ?>" class="form-control" placeholder="Formulation [English]" autocomplete="off">
                      <?php echo form_error('en_formulation'); ?>
                    </div>
                  </div>  
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Formulation [Hindi]</label>
                      <input type="text" name="hi_formulation" value="<?php echo $molecule['hi_formulation'] ?>" class="form-control" placeholder="Formulation [Hindi]" autocomplete="off">
                      <?php echo form_error('hi_formulation'); ?>
                    </div>
                  </div>  
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Formulation [Marathi]</label>
                      <input type="text" name="mr_formulation" value="<?php echo $molecule['mr_formulation'] ?>" class="form-control" placeholder="Formulation [Marathi]" autocomplete="off">
                      <?php echo form_error('mr_formulation'); ?>
                    </div>     
                  </div>  
                </div> 
                <!-- Start -->
                <div class="col-md-12">
                  <div class="col-md-4">
                     <div class="form-group">
                      <label>Dose [English]</label>
                      <input type="number" name="en_dose" value="<?php echo $molecule['en_dose'] ?>" class="form-control" placeholder="Dose [English]" autocomplete="off">
                      <?php echo form_error('en_dose'); ?>
                    </div>
                  </div>  
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Dose [Hindi]</label>
                      <input type="number" name="hi_dose" value="<?php echo $molecule['hi_dose'] ?>" class="form-control" placeholder="Dose [Hindi]" autocomplete="off">
                      <?php echo form_error('hi_dose'); ?>
                    </div>
                  </div>  
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Dose [Marathi]</label>
                      <input type="number" name="mr_dose" value="<?php echo $molecule['mr_dose'] ?>" class="form-control" placeholder="Dose [Marathi]" autocomplete="off">
                      <?php echo form_error('mr_dose'); ?>
                    </div>
                  </div>  
                </div>
                <!-- Start -->  
                 <div class="col-md-12">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Unit [English]</label>
                      <input type="text" name="en_unit" value="<?php echo $molecule['en_unit'] ?>" class="form-control" placeholder="Unit [English]" autocomplete="off">
                      <?php echo form_error('en_unit'); ?>
                    </div>
                  </div>  
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Unit [Hindi]</label>
                      <input type="text" name="hi_unit" value="<?php echo $molecule['hi_unit'] ?>" class="form-control" placeholder="Unit [Hindi]" autocomplete="off">
                      <?php echo form_error('hi_unit'); ?>
                    </div>
                  </div>  
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Unit [Marathi]</label>
                      <input type="text" name="mr_unit" value="<?php echo $molecule['mr_unit'] ?>" class="form-control" placeholder="Unit [Marathi]" autocomplete="off">
                      <?php echo form_error('mr_unit'); ?>
                    </div>     
                  </div>  
                </div>  
                <!-- Start -->
                <div class="col-md-12">
                  <div class="col-md-4">
                     <div class="form-group">
                      <label>Per [English]</label>
                      <input type="text" name="en_per" value="<?php echo $molecule['en_per'] ?>" class="form-control" placeholder="Per [English]" autocomplete="off">
                      <?php echo form_error('en_per'); ?>
                    </div>
                  </div>  
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Per [Hindi]</label>
                      <input type="text" name="hi_per" value="<?php echo $molecule['hi_per'] ?>" class="form-control" placeholder="Per [Hindi]" autocomplete="off">
                      <?php echo form_error('hi_per'); ?>
                    </div>
                  </div>  
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Per [Marathi]</label>
                      <input type="text" name="mr_per" value="<?php echo $molecule['mr_per'] ?>" class="form-control" placeholder="Per [Marathi]" autocomplete="off">
                      <?php echo form_error('mr_per'); ?>
                    </div>
                  </div>  
                </div>
                <!-- Start --> 
                <div class="col-md-12">
                  <div class="col-md-4">
                     <div class="form-group">
                      <label>Mode of Action [English]</label>
                      <input type="text" name="en_mode_of_action" value="<?php echo $molecule['en_mode_of_action'] ?>" class="form-control" placeholder="Mode of Action [English]" autocomplete="off">
                      <?php echo form_error('en_mode_of_action'); ?>
                    </div>
                  </div>  
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Mode of Action [Hindi]</label>
                      <input type="text" name="hi_mode_of_action" value="<?php echo $molecule['hi_mode_of_action'] ?>" class="form-control" placeholder="Mode of Action [Hindi]" autocomplete="off">
                      <?php echo form_error('hi_mode_of_action'); ?>
                    </div>
                  </div>  
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Mode of Action [Marathi]</label>
                      <input type="text" name="mr_mode_of_action" value="<?php echo $molecule['mr_mode_of_action'] ?>" class="form-control" placeholder="Mode of Action [Marathi]" autocomplete="off">
                      <?php echo form_error('mr_mode_of_action'); ?>
                    </div>
                  </div>  
                </div>
                <!-- Start --> 
                <div class="col-md-12">
                  <div class="col-md-4">
                     <div class="form-group">
                      <label>Group [English]</label>
                      <input type="text" name="en_group" value="<?php echo $molecule['en_group'] ?>" class="form-control" placeholder="Group [English]" autocomplete="off">
                      <?php echo form_error('en_group'); ?>
                    </div>
                  </div>  
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Group [Hindi]</label>
                      <input type="text" name="hi_group" value="<?php echo $molecule['hi_group'] ?>" class="form-control" placeholder="Group [Hindi]" autocomplete="off">
                      <?php echo form_error('hi_group'); ?>
                    </div>
                  </div>  
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Group [Marathi]</label>
                      <input type="text" name="mr_group" value="<?php echo $molecule['mr_group'] ?>" class="form-control" placeholder="Group [Marathi]" autocomplete="off">
                      <?php echo form_error('mr_group'); ?>
                    </div>
                  </div>  
                </div>
                <!-- Start --> 
                <div class="col-md-12">
                  <div class="col-md-4">
                     <div class="form-group">
                      <label>Safeness For Honey Bee [English]</label>
                      <input type="text" name="en_safeness_for_honey_bee" value="<?php echo $molecule['en_safeness_for_honey_bee'] ?>" class="form-control" placeholder="Safeness For Honey Bee [English]" autocomplete="off">
                      <?php echo form_error('en_safeness_for_honey_bee'); ?>
                    </div>
                  </div>  
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Safeness For Honey Bee [Hindi]</label>
                      <input type="text" name="hi_safeness_for_honey_bee" value="<?php echo $molecule['hi_safeness_for_honey_bee'] ?>" class="form-control" placeholder="Safeness For Honey Bee [Hindi]" autocomplete="off">
                      <?php echo form_error('hi_safeness_for_honey_bee'); ?>
                    </div>
                  </div>  
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Safeness For Honey Bee [Marathi]</label>
                      <input type="text" name="mr_safeness_for_honey_bee" value="<?php echo $molecule['mr_safeness_for_honey_bee'] ?>" class="form-control" placeholder="Safeness For Honey Bee [Marathi]" autocomplete="off">
                      <?php echo form_error('mr_safeness_for_honey_bee'); ?>
                    </div>
                  </div>  
                </div>
                <!-- Start --> 
                <div class="col-md-12">
                  <div class="col-md-4">
                     <div class="form-group">
                      <label>Brand [English]</label>
                      <input type="text" name="en_brand" value="<?php echo $molecule['en_brand'] ?>" class="form-control" placeholder="Brand [English]" autocomplete="off">
                      <?php echo form_error('en_brand'); ?>
                    </div>
                  </div>  
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Brand [Hindi]</label>
                      <input type="text" name="hi_brand" value="<?php echo $molecule['hi_brand'] ?>" class="form-control" placeholder="Brand [Hindi]" autocomplete="off">
                      <?php echo form_error('hi_brand'); ?>
                    </div>
                  </div>  
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Brand [Marathi]</label>
                      <input type="text" name="mr_brand" value="<?php echo $molecule['mr_brand'] ?>" class="form-control" placeholder="Brand [Marathi]" autocomplete="off">
                      <?php echo form_error('mr_brand'); ?>
                    </div>
                  </div>  
                </div>
                <!-- Start --> 
                <div class="col-md-12">
                  <div class="col-md-4">
                     <div class="form-group">
                      <label>PHI [English]</label>
                      <input type="text" name="en_phi" value="<?php echo $molecule['en_phi'] ?>" class="form-control" placeholder="PHI [English]" autocomplete="off">
                      <?php echo form_error('en_phi'); ?>
                    </div>
                  </div>  
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>PHI [Hindi]</label>
                      <input type="text" name="hi_phi" value="<?php echo $molecule['hi_phi'] ?>" class="form-control" placeholder="PHI [Hindi]" autocomplete="off">
                      <?php echo form_error('hi_phi'); ?>
                    </div>
                  </div>  
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>PHI [Marathi]</label>
                      <input type="text" name="mr_phi" value="<?php echo $molecule['mr_phi'] ?>" class="form-control" placeholder="PHI [Marathi]" autocomplete="off">
                      <?php echo form_error('mr_phi'); ?>
                    </div>
                  </div>  
                </div>
                <!-- Start --> 
                <div class="col-md-12">
                  <div class="col-md-4">
                     <div class="form-group">
                      <label>MRL [English]</label>
                      <input type="text" name="en_mrl" value="<?php echo $molecule['en_mrl'] ?>" class="form-control" placeholder="MRL [English]" autocomplete="off">
                      <?php echo form_error('en_mrl'); ?>
                    </div>
                  </div>  
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>MRL [Hindi]</label>
                      <input type="text" name="hi_mrl" value="<?php echo $molecule['hi_mrl'] ?>" class="form-control" placeholder="MRL [Hindi]" autocomplete="off">
                      <?php echo form_error('hi_mrl'); ?>
                    </div>
                  </div>  
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>MRL [Marathi]</label>
                      <input type="text" name="mr_mrl" value="<?php echo $molecule['mr_mrl'] ?>" class="form-control" placeholder="MRL [Marathi]" autocomplete="off">
                      <?php echo form_error('mr_mrl'); ?>
                    </div>
                  </div>  
                </div>
                <!-- end -->
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
