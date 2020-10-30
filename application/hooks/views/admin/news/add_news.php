<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Add News
      <a href="<?php echo base_url('admin/news-list/'); ?>" class="btn btn-primary pull-right" > <i class="fa fa-angle-double-left" aria-hidden="true"></i>  Back to List</a>
    </h1>
  </section>
  <!-- start add news form -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Add News</h3>
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
          <!-- START add news form -->
          <?php echo form_open_multipart('admin/add-news'); ?>
            <div class="box-body">
              <!-- start -->
              <div class="col-md-12">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Title [English]</label>
                    <input type="text" name="en_title" value="<?php echo set_value('en_title')?>" class="form-control" placeholder="Title [English]" autocomplete="off">
                    <?php echo form_error('en_title'); ?>
                  </div>
                  <div class="form-group">
                    <label>Title [Marathi] </label>
                    <input type="text" name="mr_title" value="<?php echo set_value('mr_title')?>" class="form-control" placeholder="Title [Marathi]" autocomplete="off">
                    <?php echo form_error('mr_title'); ?>
                  </div>
                </div> 
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Title [Hindi]</label>
                    <input type="text" name="hi_title" value="<?php echo set_value('hi_title')?>" class="form-control" placeholder="Title [Hindi]" autocomplete="off">
                    <?php echo form_error('hi_title'); ?>
                  </div>
                  <div class="form-group">
                    <label class="control-label">News Image</label>
                    <input type="file" class="form-control" name="news_image" >
                    <?php echo form_error('news_image'); ?>
                    <?php if($this->session->flashdata('img_error')): ?>
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <span><?php echo $this->session->flashdata('img_error') ?></span>
                    </div>
                    <?php endif ?>
                  </div>
                </div>
              </div>                
              <!-- start -->   
               <div class="col-md-12">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>News Description [English]</label>
                    <textarea rows="4" class="form-control" id="news_en_description" name="news_en_description" autocomplete="off" ><?php echo set_value('news_en_description') ?></textarea>
                    <?php echo form_error('news_en_description'); ?>
                  </div>
                </div>
                <div class="col-md-12">  
                  <div class="form-group">
                    <label>News Description [Hindi]</label>
                    <textarea rows="4" class="form-control" id="news_hi_description" name="news_hi_description" autocomplete="off" ><?php echo set_value('news_hi_description') ?></textarea>
                    <?php echo form_error('news_hi_description'); ?>
                  </div>
                </div>
                <div class="col-md-12">  
                  <div class="form-group">
                    <label>News Description [Marathi]</label>
                    <textarea rows="4" class="form-control" id="news_mr_description" name="news_mr_description" autocomplete="off" ><?php echo set_value('news_mr_description') ?></textarea>
                    <?php echo form_error('news_mr_description'); ?>
                  </div>
                </div>  
              </div>   
              <!-- start -->
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
               
                </div>
              <!-- end --> 
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <input type="submit" value="Add News" class="btn btn-primary">
            </div>
          <?php form_close();  ?>
          <!-- END add news form -->
        </div>
      </div> 
    </div>
  </section>    
  <!-- end add news form -->
</div>
