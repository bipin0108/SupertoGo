<?php 
$photos = $this->webinarmodel->get_photos_by_webinar($webinar['id']);
$videos = $this->webinarmodel->get_videos_by_webinar($webinar['id']);
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Edit Webinar
      <a href="<?php echo base_url('admin/webinar-list/'); ?>" class="btn btn-primary pull-right" > <i class="fa fa-angle-double-left" aria-hidden="true"></i>  Back to List</a>
    </h1>
  </section>
  <!-- start edit SubTopic form -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <?php echo form_open_multipart('admin/update-webinar'); ?>
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Edit Webinar</h3>
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
          <!-- START edit SubTopic form -->
            <div class="box-body"> 
              <div class="col-md-12">
                <input type="hidden" name="id" value="<?php echo $webinar['id']; ?>" >
                <div class="col-md-4">
                  <div class="form-group">
                      <label>Title [English]</label>
                      <input type="text" name="en_title" value="<?php echo $webinar['en_title'] ?>" class="form-control" placeholder="Title [English]" autocomplete="off" required>
                      <?php echo form_error('en_title'); ?>
                  </div>
                </div>  
                <div class="col-md-4">
                  <div class="form-group">
                      <label>Title [English]</label>
                      <input type="text" name="hi_title" value="<?php echo $webinar['hi_title'] ?>" class="form-control" placeholder="Title [English]" autocomplete="off" required>
                      <?php echo form_error('hi_title'); ?>
                  </div>
                </div>  
                <div class="col-md-4">
                  <div class="form-group">
                      <label>Title [Marathi] </label>
                      <input type="text" name="mr_title" value="<?php echo $webinar['mr_title'] ?>" class="form-control" placeholder="Title [Marathi]" autocomplete="off" required>
                      <?php echo form_error('mr_title'); ?>
                  </div>
                </div>  
              </div>  
              <div class="col-md-12">
                <div class="col-md-12">
                  <div class="form-group">
                      <label>Description [English]</label>
                      <textarea rows="4" class="form-control" id="en_description" name="en_description" autocomplete="off" required><?php echo $webinar['en_description'] ?></textarea>
                      <?php echo form_error('en_description'); ?>
                  </div>
                </div>  
                <div class="col-md-12">
                  <div class="form-group">
                      <label>Description [Hindi]</label>
                      <textarea rows="4" class="form-control" id="hi_description" name="hi_description" autocomplete="off" required><?php echo $webinar['hi_description'] ?></textarea>
                      <?php echo form_error('hi_description'); ?>
                  </div>
                </div>  
                <div class="col-md-12">
                  <div class="form-group">
                      <label>Description [Marathi]</label>
                      <textarea rows="4" class="form-control" id="mr_description" name="mr_description" autocomplete="off" required><?php echo $webinar['mr_description'] ?></textarea>
                      <?php echo form_error('mr_description'); ?>
                  </div>
                </div>  
              </div> 
              <div class="col-md-12">
                <div class="col-md-4">
                  <div class="form-group">
                      <label>Upload Base Image</label>
                      <input type="file" name="base_image" class="form-control" autocomplete="on" accept=".png,.jpg,.jpeg">
                      <?php echo form_error('base_image'); ?>
                      <?php if($this->session->flashdata('base_image_error')): ?>
                      <div class="alert alert-danger">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <span><?php echo $this->session->flashdata('base_image_error') ?></span>
                      </div>
                      <?php endif ?>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <a href="<?php echo IMG_PATH.'webinar/'.$webinar['base_image']; ?>" target='_blank'>
                      <img class=" img-responsive" height="50px" width="70px" src="<?php echo IMG_PATH.'webinar/'.$webinar['base_image']; ?>"  style='margin-top:8px;'>
                    </a>
                  </div>  
                </div> 
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Price</label>
                    <input type="number" name="price" value="<?php echo $webinar['price'] ?>" class="form-control" placeholder="Price" autocomplete="off" required>
                    <?php echo form_error('price'); ?>
                  </div>
                </div>  
              </div> 
            </div>  
            <!-- end --> 
        </div>
        <!-- photo -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Upload Photo</h3>
            <input type="hidden" name="photo_val">
            <input type="hidden" name="remove_photo">
            <a id="add_photo" class="btn btn-primary btn-sm pull-right">Add Photo</a>
          </div>
          <div class="box-body">
            <div class="row">
              <div id="photo_upload_div">
                <div class="col-md-12">
                    <div class="col-md-5">
                      <div class="form-group">
                        <label>Upload File</label>
                      </div>
                    </div>  
                    <div class="col-md-2">
                      <div class="form-group">
                        <label>Title [English]</label>
                      </div>
                    </div>  
                    <div class="col-md-2">
                      <div class="form-group">
                        <label>Title [Hindi]</label>
                      </div>    
                    </div>  
                    <div class="col-md-2">
                      <div class="form-group">
                        <label>Title [Marathi]</label>
                      </div>    
                    </div>
                  </div>
                <?php $i = 0; if(count($photos) > 0){  ?>
                  <?php foreach ($photos as $photo) { $i++; ?>
                  <div class="col-md-12" id="photobox_<?php echo $i; ?>">
                    <div class="col-md-4">
                      <div class="form-group">
                        <input type="file" name="photofile_<?php echo $i; ?>"  class="form-control" accept=".png, .jpg, .jpeg">
                      </div>
                    </div>  
                    <input type="hidden" name="image_name_<?php echo $i; ?>" value="<?php echo $photo->img_path; ?>">
                    <input type="hidden" name="photo_id_<?php echo $i; ?>" value="<?php echo $photo->id; ?>">
                    <div class="col-md-1">
                      <div class="form-group">
                        <a href="<?php echo IMG_PATH.'webinar/'.$webinar['id'].'/'.$photo->img_path; ?>" target='_blank'>
                          <img class=" img-responsive" height="50px" width="60px" src="<?php echo IMG_PATH.'webinar/'.$webinar['id'].'/'.$photo->img_path; ?>"  style='margin-top:1px;'>
                        </a>
                      </div>
                    </div>  
                    <div class="col-md-2">
                      <div class="form-group">
                        <input type="text"  id="en_photo_title_<?php echo $i; ?>" name="en_photo_title_<?php echo $i; ?>" data-i="<?php echo $i; ?>" value="<?php echo $photo->en_photo_title; ?>" placeholder="Title [English]" class="form-control" autocomplete="off" required>
                      </div>
                    </div>  
                    <div class="col-md-2">
                      <div class="form-group">
                        <input type="text" name="hi_photo_title_<?php echo $i; ?>" value="<?php echo $photo->hi_photo_title; ?>" placeholder="Title [Hindi]" class="form-control" autocomplete="off" required>
                      </div>    
                    </div>  
                    <div class="col-md-2">
                      <div class="form-group">
                        <input type="text" name="mr_photo_title_<?php echo $i; ?>" value="<?php echo $photo->mr_photo_title; ?>" placeholder="Title [Marathi]" class="form-control" autocomplete="off" required>
                      </div>    
                    </div>
                    <div class="col-md-1">
                      <div class='form-group'>
                        <a class='btn btn-sm btn-danger photo_remove'  data-i="<?php echo $photo->id; ?>" id='<?php echo $i; ?>_removebtn' style='margin-top:1px;'><i class='fa fa-fw fa-remove'></i></a>
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
            <h3 class="box-title">Upload Video</h3>
            <input type="hidden"  name="video_val">
            <input type="hidden"  name="remove_video">
            <a id="add_video" class="btn btn-primary btn-sm pull-right">Add Video</a>
          </div>
          <div class="box-body">
             <div class="row">
              <div id="video_upload_div">
                <?php $i = 0; if(count($videos) > 0){  ?>
                <?php foreach ($videos as $video) { $i++; ?>
                <div class="col-md-12" id="videobox_<?php echo $i; ?>">
                  <h5><b><i class="fa fa-hand-o-right" aria-hidden="true"></i> Youtube Video</b>
                    <a class="btn btn-sm btn-danger video_remove pull-right" data-i="<?php echo $video->id; ?>"  id="<?php echo $i; ?>_removebtn" style="margin-top:1px;"><i class="fa fa-fw fa-remove"></i></a>
                  </h5>
                  <hr>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Youtube Link [English]</label>
                      <input type="url" id="en_link_<?php echo $i; ?>" name="en_link_<?php echo $i; ?>" value="<?php echo $video->en_link ?>" data-i="<?php echo $i; ?>" placeholder="Video Link [English]" class="form-control" pattern="http(s)?://.+"  required>
                    </div>
                  </div>  
                  <input type="hidden" name="video_id_<?php echo $i; ?>" value="<?php echo $video->id; ?>">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Youtube Link [Hindi]</label>
                      <input type="url" name="hi_link_<?php echo $i; ?>" value="<?php echo $video->hi_link ?>" placeholder="Video Link [Hindi]" class="form-control" pattern="http(s)?://.+" required>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Youtube Link [Marathi]</label>
                      <input type="url" name="mr_link_<?php echo $i; ?>" value="<?php echo $video->mr_link ?>" placeholder="Video Link [Marathi]" class="form-control" pattern="http(s)?://.+" required>
                    </div>
                  </div>    
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Youtube Link ID [English]</label>
                      <input type="text" name="en_id_<?php echo $i; ?>" value="<?php echo $video->en_id ?>" placeholder="Video Link ID [English]" class="form-control" required>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Youtube Link ID [Hindi]</label>
                      <input type="text" name="hi_id_<?php echo $i; ?>" value="<?php echo $video->hi_id ?>" placeholder="Video Link ID [Hindi]" class="form-control" required>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Youtube Link ID [Marathi]</label>
                      <input type="text" name="mr_id_<?php echo $i; ?>" value="<?php echo $video->mr_id ?>" placeholder="Video Link ID [Marathi]" class="form-control" required>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Video Description [English]</label>
                      <textarea rows="4" class="form-control" name="en_description_<?php echo $i; ?>" placeholder="Video Description [English]" autocomplete="off" required><?php echo $video->en_description; ?></textarea>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Video Description [Hindi]</label>
                      <textarea rows="4" class="form-control" name="hi_description_<?php echo $i; ?>" placeholder="Video Description [Hindi]" autocomplete="off" required><?php echo $video->hi_description; ?></textarea>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Video Description [Marathi]</label>
                      <textarea rows="4" class="form-control" name="mr_description_<?php echo $i; ?>" placeholder="Video Description [Marathi]" autocomplete="off" required><?php echo $video->mr_description; ?></textarea>
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
            <input type="submit" id="submit" value="Update SubTopic" class="btn btn-primary">
          </div>
        </div>   
        <?php form_close();  ?>
      </div> 
    </div>
  </section>    
  <!-- end edit SubTopic form -->
</div>
<script type="text/javascript">
  var i = <?php echo count($photos); ?>;
  var k = <?php echo count($videos); ?>;
  var arr_photo = [];
  var arr_video = [];
  
  $(document).ready(function(){

    someFunction();
    someFunction_Video();  
  
    $(document).on('click', '#add_photo', function(){
      i++;
      var j = i;
      var html = "<div class='col-md-12' id='photobox_"+i+"'>\
                    <div class='col-md-5'>\
                      <div class='form-group'>\
                        <input type='file' id='photofile_"+j+"' name='photofile_"+j+"'  class='form-control' accept='.png, .jpg, .jpeg' required>\
                      </div>\
                    </div>\
                     <input type='hidden' name='image_name_"+j+"' value='0'>\
                    <div class='col-md-2'>\
                      <div class='form-group'>\
                        <input type='text' id='en_photo_title_"+j+"'  name='en_photo_title_"+j+"' data-i='"+j+"' class='form-control' placeholder='Title [English]' autocomplete='off' required>\
                      </div>\
                    </div>\
                    <div class='col-md-2'>\
                      <div class='form-group'>\
                        <input type='text' name='hi_photo_title_"+j+"' placeholder='Title [Hindi]' class='form-control' autocomplete='off' required>\
                      </div>\
                    </div>\
                    <div class='col-md-2'>\
                      <div class='form-group'>\
                        <input type='text' name='mr_photo_title_"+j+"' placeholder='Title [Marathi]'  class='form-control' autocomplete='off' required>\
                      </div>\
                    </div>\
                    <div class='col-md-1'>\
                      <div class='form-group'>\
                        <a class='btn btn-sm btn-danger photo_remove' data-i='none' id='"+j+"_removebtn' style='margin-top:1px;'><i class='fa fa-fw fa-remove'></i></a>\
                      </div>\
                    </div>\
                </div>";
    $('#photo_upload_div').append(html);
    someFunction();
  }); 
   //remove photo row
  var remove_photo = [];
  $(document).on("click",'.photo_remove', function(e){
      if(arr_photo.length <= 1){
        alert('Photo is required.');
      }
      else
      {
        var id = $(this).attr('id').slice(0,-10);
        var remove_id = $(this).data('i');
        if(remove_id != 'none')
        {
          remove_photo.push(remove_id); 
        }
        $(this).closest('#photobox_'+id).remove();
        someFunction();
      }
  });
  //call function
  function someFunction(){
      var arr_photo1 = [];
      $("input[id^='en_photo_title_']").each(function(){
        var val = $(this).data('i');
        if(val){
          arr_photo1.push(val); 
         }
      });
      var photo_val = arr_photo1.toString();
      arr_photo = arr_photo1;
      $("input[name='photo_val']").val(photo_val);
  }
  //on submit form
    //add video
    $(document).on('click', '#add_video', function(){
      k++;
      var html = "<div class='col-md-12' id='videobox_"+k+"'>\
                    <h5><b>><i class='fa fa-hand-o-right' aria-hidden='true'></i> Youtube Video</b>\
                    <a class='btn btn-sm btn-danger video_remove pull-right' data-i='none' id='"+k+"_removebtn' style='margin-top:1px;'><i class='fa fa-fw fa-remove'></i></a>\
                    </h5>\
                    <hr>\
                    <div class='col-md-4'>\
                      <div class='form-group'>\
                        <label>Youtube Link [English]</label>\
                        <input type='url' id='en_link_"+k+"' name='en_link_"+k+"' data-i='"+k+"' placeholder='Video Link [English]' class='form-control' pattern='http(s)?://.+' required>\
                      </div>\
                    </div>\
                    <input type='hidden' name='video_id_"+k+"' value='0'>\
                    <div class='col-md-4'>\
                      <div class='form-group'>\
                        <label>Youtube Link [Hindi]</label>\
                        <input type='url' name='hi_link_"+k+"'  placeholder='Video Link [Hindi]' class='form-control' pattern='http(s)?://.+' required>\
                      </div>\
                    </div>\
                    <div class='col-md-4'>\
                      <div class='form-group'>\
                        <label>Youtube Link [Marathi]</label>\
                        <input type='url' name='mr_link_"+k+"' placeholder='Video Link [Marathi]' class='form-control' pattern='http(s)?://.+' required>\
                      </div>\
                    </div>\
                    <div class='col-md-4'>\
                      <div class='form-group'>\
                        <label>Youtube Link ID [English]</label>\
                        <input type='text' name='en_id_"+k+"' class='form-control' placeholder='Video Link ID [English]' required>\
                      </div>\
                    </div>\
                    <div class='col-md-4'>\
                      <div class='form-group'>\
                        <label>Youtube Link ID [Hindi]</label>\
                        <input type='text' name='hi_id_"+k+"' class='form-control' placeholder='Video Link ID [Hindi]' required>\
                      </div>\
                    </div>\
                    <div class='col-md-4'>\
                      <div class='form-group'>\
                        <label>Youtube Link ID [Marathi]</label>\
                        <input type='text' name='mr_id_"+k+"' class='form-control' placeholder='Video Link ID [Marathi]' required>\
                      </div>\
                    </div>\
                    <div class='col-md-4'>\
                      <div class='form-group'>\
                      <label>Video Description [English]</label>\
                        <textarea name='en_description_"+k+"' placeholder='Video Description [English]' class='form-control' autocomplete='off' required></textarea>\
                      </div>\
                    </div>\
                    <div class='col-md-4'>\
                      <div class='form-group'>\
                      <label>Video Description [Hindi]</label>\
                        <textarea name='hi_description_"+k+"' placeholder='Video Description [Hindi]' class='form-control' autocomplete='off' required></textarea>\
                      </div>\
                    </div>\
                    <div class='col-md-4'>\
                      <div class='form-group'>\
                      <label>Video Description [Marathi]</label>\
                        <textarea name='mr_description_"+k+"' placeholder='Video Description [Marathi]' class='form-control' autocomplete='off' required></textarea>\
                      </div>\
                    </div>\
                </div>\
              ";
      $('#video_upload_div').append(html);
      someFunction_Video();
    }); 

    //remove video row
     var remove_video = [];
    $(document).on("click",'.video_remove', function(e){
        if(arr_video.length <= 1)
        {
          alert("Youtube Video is Required.")
        }
        else
        {
          var id = $(this).attr('id').slice(0,-10);
          var remove_v_id = $(this).data('i');
          if(remove_v_id != 'none')
          {
            remove_video.push(remove_v_id); 
          }
          $(this).closest('#videobox_'+id).remove();
          someFunction_Video();
        }
    });
    //call function
    function someFunction_Video() {
        var arr_video1 = [];
        $("input[id^='en_link_']").each(function(){
           var num_val = $(this).data('i');
            arr_video1.push(num_val); 
        });
        arr_video = arr_video1;
        var video_val = arr_video.toString();
        $("input[name='video_val']").val(video_val);
    }

     //on submit form
    $(document).on('click', '#submit', function(){

      var remove_photo_val = remove_photo.toString();
      $("input[name='remove_photo']").val(remove_photo_val);
      var remove_video_val = remove_video.toString();
      $("input[name='remove_video']").val(remove_video_val);
      someFunction();
      someFunction_Video();
    });
    //end
});
</script>  