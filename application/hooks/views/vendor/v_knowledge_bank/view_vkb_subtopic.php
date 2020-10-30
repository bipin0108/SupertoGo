<?php 
$photos = $this->knowledgebankmodel->get_photos_by_subtopic($subtopic['id']);
$videos = $this->knowledgebankmodel->get_videos_by_subtopic($subtopic['id']);
?>
<style type="text/css">
  label {
    text-decoration:underline;
  }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      View SubTopic
      <a href="<?php echo base_url('vendor/knowledge-bank-subtopic/'.$topic_id) ?>" class="btn btn-primary pull-right">Back to Subtopic List</a>
    </h1>
  </section>
  <!-- start edit SubTopic form -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">View SubTopic</h3>
          </div>
          <!-- START edit SubTopic form -->
            <div class="box-body"> 
              <div class="col-md-12">
                <input type="hidden" name="topic_id" value="<?php echo $topic_id; ?>" >
                <input type="hidden" name="id" value="<?php echo $subtopic['id']; ?>" >
                <div class="col-md-4">
                  <div class="form-group">
                      <label>Title [English]</label>
                      <div class="m-5">
                        <?php echo $subtopic['en_title'] ?>
                      </div>
                  </div>
                </div>  
                <div class="col-md-4">
                  <div class="form-group">
                      <label>Title [Hindi]</label>
                      <div class="m-5">
                        <?php echo $subtopic['hi_title'] ?> 
                      </div>
                  </div>
                </div>  
                <div class="col-md-4">
                  <div class="form-group">
                      <label>Title [Marathi] </label>
                      <div class="m-5">
                        <?php echo $subtopic['mr_title'] ?> 
                      </div>
                  </div>
                </div>  
              </div>  
              <div class="col-md-12">
                <div class="col-md-12">
                  <div class="form-group">
                      <label>Description [English]</label>
                      <div class="m-5">
                        <?php echo $subtopic['en_description'] ?> 
                      </div>
                  </div>
                </div>  
                <div class="col-md-12">
                  <div class="form-group">
                      <label>Description [Hindi]</label>
                      <div class="m-5">
                        <?php echo $subtopic['hi_description'] ?> 
                      </div>
                  </div>
                </div>  
                <div class="col-md-12">
                  <div class="form-group">
                      <label>Description [Marathi]</label>
                      <div class="m-5">
                        <?php echo $subtopic['mr_description'] ?> 
                      </div>
                  </div>
                </div>  
              </div> 
              <div class="col-md-12">
                <div class="col-md-4">
                  <div class="form-group">
                      <label>PDF [English]</label>
                      <div class="m-5">
                        <a href="<?php echo base_url('master/download_pdf/'.$topic_id.'/'.$subtopic['en_pdf_file']);?>" >
                          <b>Download Existing Document</b>
                        </a>
                      </div>  
                  </div>
                </div>  
                <div class="col-md-4">
                  <div class="form-group">
                      <label>PDF [Hindi]</label>
                      <div class="m-5">
                        <a href="<?php echo base_url('master/download_pdf/'.$topic_id.'/'.$subtopic['hi_pdf_file']);?>" >
                          <b>Download Existing Document</b>
                        </a>
                      </div> 
                  </div>
                </div>  
                <div class="col-md-4">
                  <div class="form-group">
                      <label>PDF [Marathi]</label>
                      <div class="m-5">
                        <a href="<?php echo base_url('master/download_pdf/'.$topic_id.'/'.$subtopic['mr_pdf_file']);?>" >
                          <b>Download Existing Document</b>
                        </a>
                      </div> 
                  </div>
                </div>  
                <div class="col-md-4">
                  <div class="form-group">
                      <label>PDF Title [English]</label>
                      <div class="m-5">
                        <?php echo $subtopic['en_pdf_title'] ?> 
                      </div>
                  </div>
                </div>  
                <div class="col-md-4">
                  <div class="form-group">
                      <label>PDF Title [Hindi]</label>
                      <div class="m-5">
                        <?php echo $subtopic['hi_pdf_title'] ?> 
                      </div>
                  </div>
                </div>  
                <div class="col-md-4">
                  <div class="form-group">
                      <label>PDF Title [Marathi]</label>
                      <div class="m-5">
                        <?php echo $subtopic['mr_pdf_title'] ?> 
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
                  <div class="col-md-12" id="photobox_<?php echo $i; ?>">
                    <div class="col-md-3">
                      <div class="form-group">
                        <a href="<?php echo IMG_PATH.'knowledge_bank/'.$topic_id.'/'.$photo->img_path; ?>" target='_blank'>
                          <img class=" img-responsive" height="50px" width="60px" src="<?php echo IMG_PATH.'knowledge_bank/'.$topic_id.'/'.$photo->img_path; ?>"  style='margin-top:1px;'>
                        </a>
                      </div>
                    </div>  
                    <div class="col-md-3">
                      <div class="form-group">
                        <div class="m-5">
                          <?php echo $photo->en_photo_title; ?>
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
                    <div class="col-md-3">
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
                <div class="col-md-12" id="videobox_<?php echo $i; ?>">
                  <h5><b><i class="fa fa-hand-o-right" aria-hidden="true"></i>  Youtube Video <?php echo $i; ?></b> </h5>
                  <hr>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Youtube Link [English]</label>
                      <div class="m-5">
                        <?php echo $video->en_link ?>
                      </div>  
                    </div>
                  </div>  
                  <input type="hidden" name="video_id_<?php echo $i; ?>" value="<?php echo $video->id; ?>">
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
            <a href="<?php echo base_url('vendor/knowledge-bank-subtopic/'.$topic_id) ?>" class="btn btn-primary">Back to Subtopic List</a>
          </div>
        </div>   
      </div> 
    </div>
  </section>    
  <!-- end edit SubTopic form -->
</div>
