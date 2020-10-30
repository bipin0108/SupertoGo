<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Webinar
      <a href="<?php echo base_url('admin/webinar-list/'); ?>" class="btn btn-primary pull-right" > <i class="fa fa-angle-double-left" aria-hidden="true"></i>  Back to List</a>
    </h1>
  </section>
  <!-- start add webinar form -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <?php echo form_open_multipart('admin/add-webinar'); ?>
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
          <!-- START add webinar form -->
          
            <div class="box-body">
              <div class="col-md-12">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Title [English]</label>
                    <input type="text" name="en_title" value="<?php echo set_value('en_title')?>" class="form-control" placeholder="Title [English]" autocomplete="off" required>
                    <?php echo form_error('en_title'); ?>
                  </div>
                </div>  
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Title [Hindi]</label>
                    <input type="text" name="hi_title" value="<?php echo set_value('hi_title')?>" class="form-control" placeholder="Title [Hindi]" autocomplete="off" required>
                    <?php echo form_error('hi_title'); ?>
                  </div>
                </div>  
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Title [Marathi]</label>
                    <input type="text" name="mr_title" value="<?php echo set_value('mr_title')?>" class="form-control" placeholder="Title [Marathi]" autocomplete="off" required>
                    <?php echo form_error('mr_title'); ?>
                  </div>
                </div> 
              </div>
              <div class="col-md-12">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Description [English]</label>
                    <textarea rows="4" class="form-control" id="en_description" name="en_description" autocomplete="off" placeholder="Description [English]" required><?php echo set_value('en_description') ?></textarea>
                    <?php echo form_error('en_description'); ?>
                  </div>
                </div>
                <div class="col-md-12">  
                  <div class="form-group">
                    <label>Description [Hindi]</label>
                    <textarea rows="4" class="form-control" id="hi_description" name="hi_description" autocomplete="off" placeholder="Description [Hindi]" required><?php echo set_value('hi_description') ?></textarea>
                    <?php echo form_error('hi_description'); ?>
                  </div>
                </div>
                <div class="col-md-12">  
                  <div class="form-group">
                    <label>Description [Marathi]</label>
                    <textarea rows="4" class="form-control" id="mr_description" name="mr_description" autocomplete="off" placeholder="Description [Marathi]" required><?php echo set_value('mr_description') ?></textarea>
                    <?php echo form_error('mr_description'); ?>
                  </div>
                </div>  
              </div>  
              <div class="col-md-12">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Upload Base Image</label>
                    <input type="file" name="base_image" class="form-control" autocomplete="on" accept=".png,.jpg,.jpeg" required>
                    <?php echo form_error('base_image'); ?>
                    <?php if($this->session->flashdata('base_image_error')): ?>
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <span><?php echo $this->session->flashdata('base_image_error') ?></span>
                    </div>
                    <?php endif ?>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Price</label>
                    <input type="number" name="price" value="<?php echo set_value('price')?>" class="form-control" placeholder="Price" autocomplete="off" required>
                  </div>
                </div> 
              </div>
              
              <!-- end -->
            </div>
            <!-- /.box-body -->
          <!-- END add webinar form -->
        </div>
        <!-- photo -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Upload Photo</h3>
            <input type="hidden"  name="photo_val">
            <a id="add_photo" class="btn btn-primary btn-sm pull-right">Add Photo</a>
          </div>
          <div class="box-body">
            <div class="row">
              <div id="photo_upload_div">
                <div class="col-md-12" id="photobox_1">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Upload File</label>
                      <input type="file" id="photofile_1" name="photofile_1" data-i="1" class="form-control" accept=".png, .jpg, .jpeg" required>
                    </div>
                  </div>  
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Title [English]</label>
                      <input type="text" name="en_photo_title_1" class="form-control" placeholder="Title [English]" autocomplete="off" required>
                    </div>
                  </div>  
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Title [Hindi]</label>
                      <input type="text" name="hi_photo_title_1" class="form-control" placeholder="Title [Hindi]" autocomplete="off" required>
                    </div>    
                  </div>  
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Title [Marathi]</label>
                      <input type="text" name="mr_photo_title_1" class="form-control" placeholder="Title [Marathi]" autocomplete="off" required>
                    </div>    
                  </div>
                  <div class="col-md-2">
                  </div>
                </div>
              </div>
              <!-- end -->
            </div>    
          </div>  
        </div>
        <!-- video -->  
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Upload Video</h3>
            <input type="hidden"  name="video_val">
            <a id="add_video" class="btn btn-primary btn-sm pull-right">Add Video</a>
          </div>
          <div class="box-body">
             <div class="row">
              <div id="video_upload_div">
                <div class="col-md-12" id="videobox_1">
                  <h5><b><i class="fa fa-hand-o-right" aria-hidden="true"></i> Youtube Video</b></h5>
                  <hr>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Youtube Link [English]</label>
                      <input type="url" id="en_link_1" name="en_link_1" data-i="1" placeholder="Video Link [English]" class="form-control" pattern="http(s)?://.+" required>
                    </div>
                  </div>  
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Youtube Link [Hindi]</label>
                      <input type="url" name="hi_link_1" placeholder="Video Link [Hindi]" class="form-control" pattern="http(s)?://.+" required>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Youtube Link [Marathi]</label>
                      <input type="url" name="mr_link_1" placeholder="Video Link [Marathi]" class="form-control" pattern="http(s)?://.+" required>
                    </div>
                  </div>    
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Youtube Link ID [English]</label>
                      <input type="text" name="en_id_1" placeholder="Video Link ID [English]" class="form-control" required>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Youtube Link ID [Hindi]</label>
                      <input type="text" name="hi_id_1" placeholder="Video Link ID [Hindi]" class="form-control" required>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Youtube Link ID [Marathi]</label>
                      <input type="text" name="mr_id_1" placeholder="Video Link ID [Marathi]" class="form-control" required>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Video Description [English]</label>
                      <textarea rows="4" class="form-control" name="en_description_1" placeholder="Video Description [English]" autocomplete="off" required></textarea>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Video Description [Hindi]</label>
                      <textarea rows="4" class="form-control" name="hi_description_1" placeholder="Video Description [Hindi]" autocomplete="off" required></textarea>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Video Description [Marathi]</label>
                      <textarea rows="4" class="form-control" name="mr_description_1" placeholder="Video Description [Marathi]" autocomplete="off" required></textarea>
                    </div>
                  </div>
                  <hr/>
                </div>
              </div>
              <!-- end -->
            </div>    
          </div>
          <div class="box-footer">
              <input type="submit" id="submit" value="Save" class="btn btn-primary">
            </div>  
        </div> 
        <?php form_close();  ?>
      </div> 
    </div>
  </section>    
  <!-- end add webinar form -->
</div>
<script type="text/javascript">
  var i = 1;
  var k = 1;
  $(document).ready(function(){
    $(document).on('click', '#add_photo', function(){
      i++;
      var j = i;
      var html = "<div class='col-md-12' id='photobox_"+j+"'>\
                    <div class='col-md-4'>\
                      <div class='form-group'>\
                        <input type='file' id='photofile_"+j+"' name='photofile_"+j+"' data-i='"+j+"' class='form-control' accept='.png, .jpg, .jpeg' required>\
                      </div>\
                    </div>\
                    <div class='col-md-2'>\
                      <div class='form-group'>\
                        <input type='text' name='en_photo_title_"+j+"' placeholder='Title [English]' class='form-control' autocomplete='off' required>\
                      </div>\
                    </div>\
                    <div class='col-md-2'>\
                      <div class='form-group'>\
                        <input type='text' name='hi_photo_title_"+j+"' placeholder='Title [Hindi]' class='form-control' autocomplete='off' required>\
                      </div>\
                    </div>\
                    <div class='col-md-2'>\
                      <div class='form-group'>\
                        <input type='text' name='mr_photo_title_"+j+"' placeholder='Title [Marathi]' class='form-control' autocomplete='off' required>\
                      </div>\
                    </div>\
                    <div class='col-md-2'>\
                      <div class='form-group'>\
                        <a class='btn btn-sm btn-danger photo_remove'  id='"+j+"_removebtn' style='margin-top:1px;'><i class='fa fa-fw fa-remove'></i></a>\
                      </div>\
                    </div>\
                </div>";
      $('#photo_upload_div').append(html);
      someFunction();
    }); 
    //remove photo row
    $(document).on("click",'.photo_remove', function(e){
        var id = $(this).attr('id').slice(0,-10);
        $(this).closest('#photobox_'+id).remove();
        someFunction();
    });
    //call function
    function someFunction() {
        var arr_photo = [];
        $("input[id^='photofile_']").each(function(){
          var val = $(this).data('i');
          if(val){
           arr_photo.push(val); 
           }
        });
        var photo_val = arr_photo.toString();
        $("input[name='photo_val']").val(photo_val);
    }
    //add video
    $(document).on('click', '#add_video', function(){
      k++;
      var html = "<div class='col-md-12' id='videobox_"+k+"'>\
                    <h5><b><i class='fa fa-hand-o-right' aria-hidden='true'></i> Youtube Video</b>\
                    <a class='btn btn-sm btn-danger video_remove pull-right'  id='"+k+"_removebtn' style='margin-top:1px;'><i class='fa fa-fw fa-remove'></i></a>\
                    </h5>\
                    <hr>\
                    <div class='col-md-4'>\
                      <div class='form-group'>\
                        <label>Youtube Link [English]</label>\
                        <input type='url' id='en_link_"+k+"' name='en_link_"+k+"' data-i='"+k+"' placeholder='Video Link [English]' class='form-control' pattern='http(s)?://.+' required>\
                      </div>\
                    </div>\
                    <div class='col-md-4'>\
                      <div class='form-group'>\
                        <label>Youtube Link [Hindi]</label>\
                        <input type='url' name='hi_link_"+k+"' placeholder='Video Link [Hindi]' class='form-control' pattern='http(s)?://.+' required>\
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
                        <input type='text' name='en_id_"+k+"' placeholder='Video Link ID [English]' class='form-control' required>\
                      </div>\
                    </div>\
                    <div class='col-md-4'>\
                      <div class='form-group'>\
                        <label>Youtube Link ID [Hindi]</label>\
                        <input type='text' name='hi_id_"+k+"' placeholder='Video Link ID [Hindi]' class='form-control' required>\
                      </div>\
                    </div>\
                    <div class='col-md-4'>\
                      <div class='form-group'>\
                        <label>Youtube Link ID [Marathi]</label>\
                        <input type='text' name='mr_id_"+k+"' placeholder='Video Link ID [Marathi]' class='form-control' required>\
                      </div>\
                    </div>\
                    <div class='col-md-4'>\
                      <div class='form-group'>\
                      <label>Video Description [English]</label>\
                        <textarea rows='4' type='text' name='en_description_"+k+"' placeholder='Video Description [English]' class='form-control' autocomplete='off' required></textarea>\
                      </div>\
                    </div>\
                    <div class='col-md-4'>\
                      <div class='form-group'>\
                      <label>Video Description [Hindi]</label>\
                        <textarea rows='4' type='text' name='hi_description_"+k+"' placeholder='Video Description [Hindi]' class='form-control' autocomplete='off' required></textarea>\
                      </div>\
                    </div>\
                    <div class='col-md-4'>\
                      <div class='form-group'>\
                      <label>Video Description [Marathi]</label>\
                        <textarea rows='4' type='text' name='mr_description_"+k+"' placeholder='Video Description [Marathi]' class='form-control' autocomplete='off' required></textarea>\
                      </div>\
                    </div>\
                </div>\
              ";
      $('#video_upload_div').append(html);
      someFunction_Video();
    }); 

    //remove video row
    $(document).on("click",'.video_remove', function(e){
        var id = $(this).attr('id').slice(0,-10);
        $(this).closest('#videobox_'+id).remove();
        someFunction_Video();
    });
    //call function

    function someFunction_Video() {
        var arr_video = [];
        $("input[id^='en_link_']").each(function(){
           var num_val = $(this).data('i');
            arr_video.push(num_val); 
        });
        var video_val = arr_video.toString();
        $("input[name='video_val']").val(video_val);
    }

     //on submit form
    $(document).on('click', '#submit', function(){
      someFunction();
      someFunction_Video();
    });
    //end
  });
</script>

