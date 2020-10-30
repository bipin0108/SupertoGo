<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Technical Name
       <a href="<?php echo base_url('admin/technical-list/'.$subtopic_id); ?>" class="btn btn-primary pull-right" ><i class="fa fa-angle-double-left" aria-hidden="true"></i>   Back to Technical Name List</a>
    </h1>
  </section>
  <!-- start add control measure form -->
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
          <!-- START add control measure form -->
            <?php echo form_open_multipart('admin/add-technical'); ?>
            <div class="box-body">
              	<div class="col-md-12">
                	<input type="hidden" name="subtopic_id" value="<?php echo $subtopic_id; ?>">
        					<div class="form-group">
        						<label>Technical Name [English]</label>
        						<input type="text" name="en_technical_name" value="<?php echo set_value('en_technical_name')?>" class="form-control" placeholder="Technical Name [English]" autocomplete="off">
        						<?php echo form_error('en_technical_name'); ?>
        					</div> 
                  <div class="form-group">
                    <label>Technical Name [Hindi]</label>
                    <input type="text" name="hi_technical_name" value="<?php echo set_value('hi_technical_name')?>" class="form-control" placeholder="Technical Name [Hindi]" autocomplete="off">
                    <?php echo form_error('hi_technical_name'); ?>
                  </div>
                  <div class="form-group">
                    <label>Technical Name [Marathi]</label>
                    <input type="text" name="mr_technical_name" value="<?php echo set_value('mr_technical_name')?>" class="form-control" placeholder="Technical Name [Marathi]" autocomplete="off">
                    <?php echo form_error('mr_technical_name'); ?>
                  </div>     
        					<div class="form-group">
        						<label>Upload Base Image</label>
        						<input type="file" name="image" class="form-control" autocomplete="on" accept=".png,.jpg,.jpeg" >
        						<?php echo form_error('image'); ?>
        						<?php if($this->session->flashdata('image_error')): ?>
        							<div class="alert alert-danger">
        							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        							<span><?php echo $this->session->flashdata('image_error') ?></span>
        							</div>
        						<?php endif ?>
        					</div>
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

