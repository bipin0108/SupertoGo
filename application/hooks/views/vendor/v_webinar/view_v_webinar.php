<?php 
$photos = $this->webinarmodel->get_photos_by_webinar($webinar['id']);
$videos = $this->webinarmodel->get_videos_by_webinar($webinar['id']);
?>
<style type="text/css">
  label {
    text-decoration: underline;
  }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      View Webinar
      <a href="<?php echo base_url('vendor/webinar-list') ?>" class="btn btn-primary pull-right">Back to Webinar List</a>
    </h1>
  </section>
  <!-- start edit SubTopic form -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">View Webinar</h3>
          </div>
          <!-- START edit SubTopic form -->
            <div class="box-body"> 
              <div class="col-md-12">
                <input type="hidden" name="id" value="<?php echo $webinar['id']; ?>" >
                <div class="col-md-4">
                  <div class="form-group">
                      <label>Title [English]</label>
                      <div class="m-5">
                        <?php echo $webinar['en_title'] ?>
                      </div>  
                  </div>
                </div>  
                <div class="col-md-4">
                  <div class="form-group">
                      <label>Title [Hindi]</label>
                      <div class="m-5">
                        <?php echo $webinar['hi_title'] ?>
                      </div> 
                  </div>
                </div>  
                <div class="col-md-4">
                  <div class="form-group">
                      <label>Title [Marathi] </label>
                      <div class="m-5">
                        <?php echo $webinar['mr_title'] ?>
                      </div> 
                  </div>
                </div>  
              </div>  
              <div class="col-md-12">
                <div class="col-md-12">
                  <div class="form-group">
                      <label>Description [English]</label>
                      <div class="m-5">
                        <?php echo $webinar['en_description'] ?>
                      </div> 
                  </div>
                </div>  
                <div class="col-md-12">
                  <div class="form-group">
                      <label>Description [Hindi]</label>
                      <div class="m-5">
                        <?php echo $webinar['hi_description'] ?>
                      </div>
                  </div>
                </div>  
                <div class="col-md-12">
                  <div class="form-group">
                      <label>Description [Marathi]</label>
                      <div class="m-5">
                        <?php echo $webinar['mr_description'] ?>
                      </div>
                  </div>
                </div>  
              </div> 
              <div class="col-md-12">
                <div class="col-md-4">
                  <div class="form-group">
                      <label>Base Image</label>
                      <div class="col-md-4">
                        <a href="<?php echo IMG_PATH.'webinar/'.$webinar['base_image']; ?>" target='_blank'>
                          <img height="50px" src="<?php echo IMG_PATH.'webinar/'.$webinar['base_image']; ?>"  style='margin-top:1px;'>
                        </a>
                      </div>  
                  </div>
                </div>  
              </div> 
            </div>  
            <!-- end --> 
        </div>
        <!-- photo -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Photo</h3>
          </div>
          <div class="box-body">
            <div class="row">
              <div id="photo_upload_div">
                <div class="col-md-12">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Photo</label>
                      </div>
                    </div>  
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Title [English]</label>
                      </div>
                    </div>  
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Title [Hindi]</label>
                      </div>    
                    </div>  
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Title [Marathi]</label>
                      </div>    
                    </div>
                  </div>
                <?php $i = 0; if(count($photos) > 0){  ?>
                  <?php foreach ($photos as $photo) { $i++; ?>
                  <div class="col-md-12" >
                    <div class="col-md-3">
                      <div class="form-group">
                        <a href="<?php echo IMG_PATH.'webinar/'.$webinar['id'].'/'.$photo->img_path; ?>" target='_blank'>
                          <img height="50px" width="60px" src="<?php echo IMG_PATH.'webinar/'.$webinar['id'].'/'.$photo->img_path; ?>"  style='margin-top:1px;'>
                        </a>
                      </div>
                    </div>  
                    <div class="col-md-3">
                      <div class="form-group">
                        <div class="m-5">
                          <?php echo $photo->en_photo_title ?>
                        </div>
                      </div>
                    </div>  
                    <div class="col-md-3">
                      <div class="form-group">
                        <div class="m-5">
                          <?php echo $photo->hi_photo_title; ?>
                        </div>
                      </div>    
                    </div>  
                    <div class="col-md-2">
                      <div class="form-group">
                        <div class="m-5">
                          <?php echo $photo->mr_photo_title; ?>
                        </div>
                      </div>    
                    </div>
                  </div>
                  <?php } ?>
                <?php } ?>
              </div>
              <!-- end -->
            </div>    
          </div> 
           <!-- /.box-body -->
          <!-- END SubTopic photo form --> 
        </div>
        <!-- video --> 
        <!-- video -->  
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Videos</h3>
          </div>
          <div class="box-body">
             <div class="row">
              <div id="video_upload_div">
                <?php $i = 0; if(count($videos) > 0){  ?>
                <?php foreach ($videos as $video) { $i++; ?>
                <div class="col-md-12">
                  <h5><b>Youtube Video</b></h5>
                  <hr>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Youtube Link [English]</label>
                      <div class="m-5">
                        <?php echo $video->en_link ?>
                      </div>
                    </div>
                  </div>  
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Youtube Link [Hindi]</label>
                      <div class="m-5">
                        <?php echo $video->hi_link ?>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Youtube Link [Marathi]</label>
                      <div class="m-5">
                        <?php echo $video->mr_link ?>
                      </div>
                    </div>
                  </div>    
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Youtube Link ID [English]</label>
                      <div class="m-5">
                        <?php echo $video->en_id ?>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Youtube Link ID [Hindi]</label>
                      <div class="m-5">
                        <?php echo $video->hi_id ?>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Youtube Link ID [Marathi]</label>
                      <div class="m-5">
                        <?php echo $video->mr_id ?>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Video Description [English]</label>
                      <div class="m-5">
                        <?php echo $video->en_description ?>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Video Description [Hindi]</label>
                      <div class="m-5">
                        <?php echo $video->hi_description ?>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Video Description [Marathi]</label>
                      <div class="m-5">
                        <?php echo $video->mr_description ?>
                      </div>
                    </div>
                  </div>
                  <hr/>
                </div>
                <?php } ?>
                <?php } ?>
              </div>
              <!-- end -->
            </div>    
          </div>
          <div class="box-footer">
             <a href="<?php echo base_url('vendor/webinar-list') ?>" class="btn btn-primary">Back to Webinar List</a>
          </div>  
        </div>   
      </div> 
    </div>
  </section>    
  <!-- end edit SubTopic form -->
</div>
