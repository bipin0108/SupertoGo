<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Crop
      <a href="<?php echo base_url('admin/crop-list/'); ?>" class="btn btn-primary pull-right" > <i class="fa fa-angle-double-left" aria-hidden="true"></i>  Back to List</a>
    </h1>
  </section>
  <!-- start add module form -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Edit</h3>
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
          <!-- START add crop form -->
          <?php echo form_open_multipart('admin/update-crop'); ?>
            <div class="box-body">
              <input type="hidden" name="id" value="<?php echo $crop['crop_id']; ?>" >
              <!-- start -->
              <div class="col-md-12">
                <div class=" col-md-6">
                  <div class="form-group">
                    <label>Crop Name [English]</label>
                    <input type="text" name="en_crop_name" value="<?php echo $crop['en_crop_name'] ?>" class="form-control" placeholder="Crop Name [English]" autocomplete="off">
                    <?php echo form_error('en_crop_name'); ?>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Crop Name [Hindi]</label>
                    <input type="text" name="hi_crop_name" value="<?php echo $crop['hi_crop_name'] ?>" class="form-control" placeholder="Crop Name [Hindi]" autocomplete="off">
                    <?php echo form_error('hi_crop_name'); ?>
                  </div>
                </div>
                <div class=" col-md-6">
                  <div class="form-group">
                    <label>Crop Name [Marathi] </label>
                    <input type="text" name="mr_crop_name" value="<?php echo $crop['mr_crop_name'] ?>" class="form-control" placeholder="Crop Name [Marathi]" autocomplete="off">
                    <?php echo form_error('mr_crop_name'); ?>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="control-label">Crop Image</label>
                    <input type="file" class="form-control" name="crop_image" >
                    <?php if($this->session->flashdata('img_error')){ ?>
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <span><?php echo $this->session->flashdata('img_error') ?></span>
                    </div>
                    <?php } ?>
                  </div>   
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <img class=" img-responsive" src="<?php echo IMG_PATH."crop/".$crop['crop_image']; ?>" style="height:50px;"/>
                  </div>   
                </div>
              </div>  
              <!-- mandi rate -->
              <div class="box-body">
                <div class="col-md-12">
                  <h4>
                    <input type="hidden" name="mandi_val" value="">
                    <b><i class="fa fa-hand-o-right" aria-hidden="true"></i> Grade of Mandi</b>
                    <a id="add_rate_mandi" class="btn btn-primary btn-sm pull-right">Add Grade</a>
                  </h4>  
                  <div class="row">
                    <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>S/R</th>
                        <th>Grade [English]</th>
                        <th>Specification [English]</th>
                        <th>Grade [Hindi]</th>
                        <th>Specification [Hindi]</th>
                        <th>Grade [Marathi]</th>
                        <th>Specification [Marathi]</th>
                        <!-- <th>Action</th> -->
                      </tr>  
                    </thead>
                    <?php $mandirate = $this->cropmodel->mandi_rate_by_crop($crop['crop_id']); ?>    
                    <tbody>
                      <?php $i=0; foreach ($mandirate as $row) { $i++; ?>
                        <tr>
                          <td><?php echo $i; ?></td>
                          <td><input type="text" name="m_en_grade_<?php echo $row->id; ?>" class="form-control" value="<?php echo $row->en_grade; ?>"></td>
                          <td><input type="text" name="m_hi_grade_<?php echo $row->id; ?>" class="form-control" value="<?php echo $row->hi_grade; ?>"></td>
                          <td><input type="text" name="m_mr_grade_<?php echo $row->id; ?>" class="form-control" value="<?php echo $row->mr_grade; ?>"></td>
                          <td><input type="text" name="m_en_specification_<?php echo $row->id; ?>" class="form-control" value="<?php echo $row->en_specification; ?>" ></td>
                          <td><input type="text" name="m_hi_specification_<?php echo $row->id; ?>" class="form-control" value="<?php echo $row->hi_specification; ?>" ></td>
                          <td><input type="text" name="m_mr_specification_<?php echo $row->id; ?>" class="form-control" value="<?php echo $row->mr_specification; ?>" ></td>
                       </tr>
                      <?php } ?>
                    </tbody>  
                    </table>
                    <div id="rate_of_mandi_div"> 
                    </div>  
                  </div>  
                </div>
              </div>    
              <!-- farm rate -->
              <!-- mandi rate -->
              <div class="box-body">
                <div class="col-md-12">
                  <h4>
                    <input type="hidden" name="farm_val" value="">
                    <b><i class="fa fa-hand-o-right" aria-hidden="true"></i> Grade of Farm</b>
                    <a id="add_rate_farm" class="btn btn-primary btn-sm pull-right">Add Grade</a>
                  </h4>  
                  <div class="row">
                    <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>S/R</th>
                        <th>Specification [English]</th>
                        <th>Specification [Hindi]</th>
                        <th>Specification [Marathi]</th>
                      </tr>  
                    </thead>
                    <?php $farmrate = $this->cropmodel->farm_rate_by_crop($crop['crop_id']); ?>    
                    <tbody>
                      <?php $i=0; foreach ($farmrate as $row) { $i++; ?>
                        <tr>
                          <td><?php echo $i; ?></td>
                          <td><input type="text" name="f_en_specification_<?php echo $row->id; ?>" class="form-control" value="<?php echo $row->en_specification; ?>" ></td>
                          <td><input type="text" name="f_hi_specification_<?php echo $row->id; ?>" class="form-control" value="<?php echo $row->hi_specification; ?>" ></td>
                          <td><input type="text" name="f_mr_specification_<?php echo $row->id; ?>" class="form-control" value="<?php echo $row->mr_specification; ?>" ></td>
                        </tr>
                      <?php } ?>
                    </tbody>  
                    </table>
                    <div id="rate_of_farm_div"> 
                    </div>  
                  </div>  
                </div>
              </div>    
              <!-- end -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <input type="submit" value="Save" class="btn btn-primary">
            </div>
          <?php form_close();  ?>
          <!-- END add crop form -->
        </div>
      </div> 
    </div>
  </section>    
  <!-- end add crop form -->
</div>
<script type="text/javascript">
var k = 0;
var l = 0;
$(document).ready(function(){
  //add rate of mandi
  $(document).on('click', '#add_rate_mandi', function(){
      k++;
       var html = "<div class='col-md-12' id='mandibox_"+k+"'>\
                      <div class='col-md-12'>\
                        <a class='btn btn-sm btn-danger mandi_remove pull-right'  id='"+k+"_removebtn' style='margin-top:1px;'><i class='fa fa-fw fa-remove'></i></a>\
                      </div>\
                      </h5>\
                      <div class='col-md-4'>\
                        <div class='form-group'>\
                          <label>Grade [English]</label>\
                          <input type='text' id='en_mgrade_"+k+"' name='en_mgrade_"+k+"' data-i='"+k+"' placeholder='Grade [English]' class='form-control' required>\
                        </div>\
                      </div>\
                      <div class='col-md-4'>\
                        <div class='form-group'>\
                          <label>Grade [Hindi]</label>\
                          <input type='text' name='hi_mgrade_"+k+"'  placeholder='Grade [Hindi]' class='form-control' required>\
                        </div>\
                      </div>\
                      <div class='col-md-4'>\
                        <div class='form-group'>\
                          <label>Grade [Marathi]</label>\
                          <input type='text' name='mr_mgrade_"+k+"' placeholder='Grade [Marathi]' class='form-control' required>\
                        </div>\
                      </div>\
                      <div class='col-md-4'>\
                        <div class='form-group'>\
                          <label>Specification [English]</label>\
                          <input type='text' id='en_mspeci_"+k+"' name='en_mspeci_"+k+"' data-i='"+k+"' placeholder='Specification [English]' class='form-control' required>\
                        </div>\
                      </div>\
                      <div class='col-md-4'>\
                        <div class='form-group'>\
                          <label>Specification [Hindi]</label>\
                          <input type='text' name='hi_mspeci_"+k+"'  placeholder='Specification [Hindi]' class='form-control' required>\
                        </div>\
                      </div>\
                      <div class='col-md-4'>\
                        <div class='form-group'>\
                          <label>Specification [Marathi]</label>\
                          <input type='text' name='mr_mspeci_"+k+"' placeholder='Specification [Marathi]' class='form-control' required>\
                        </div>\
                      </div>\
                </div>\
              ";
      $('#rate_of_mandi_div').append(html);
      someFunction();
  });
  //remove mandi row
    $(document).on("click",'.mandi_remove', function(e){
        var id = $(this).attr('id').slice(0,-10);
        $(this).closest('#mandibox_'+id).remove();
        someFunction();
    });
  //add rate of mandi 
   function someFunction() {
        var arr_mandi = [];
        $("input[id^='en_mgrade_']").each(function(){
          var val = $(this).data('i');
          if(val){
           arr_mandi.push(val); 
           }
        });
        var mandi_val = arr_mandi.toString();
        $("input[name='mandi_val']").val(mandi_val);
    }
    //add rate of farm
  $(document).on('click', '#add_rate_farm', function(){
      l++;
       var html = "<div class='col-md-12' id='farmbox_"+l+"'>\
                      <div class='col-md-12'>\
                        <a class='btn btn-sm btn-danger farm_remove pull-right'  id='"+l+"_removebtn' style='margin-top:1px;'><i class='fa fa-fw fa-remove'></i></a>\
                      </div>\
                      </h5>\
                      <div class='col-md-4'>\
                        <div class='form-group'>\
                          <label>Specification [English]</label>\
                          <input type='text' id='en_fspeci_"+l+"' name='en_fspeci_"+l+"' data-i='"+l+"' placeholder='Specification [English]' class='form-control' required>\
                        </div>\
                      </div>\
                      <div class='col-md-4'>\
                        <div class='form-group'>\
                          <label>Specification [Hindi]</label>\
                          <input type='text' name='hi_fspeci_"+l+"'  placeholder='Specification [Hindi]' class='form-control' required>\
                        </div>\
                      </div>\
                      <div class='col-md-4'>\
                        <div class='form-group'>\
                          <label>Specification [Marathi]</label>\
                          <input type='text' name='mr_fspeci_"+l+"' placeholder='Specification [Marathi]' class='form-control' required>\
                        </div>\
                      </div>\
                </div>\
              ";
      $('#rate_of_farm_div').append(html);
      someFunction_farm();
  });
  //remove farm row
    $(document).on("click",'.farm_remove', function(e){
        var id = $(this).attr('id').slice(0,-10);
        $(this).closest('#farmbox_'+id).remove();
        someFunction_farm();
    });
  //add rate of farm 
   function someFunction_farm() {
        var arr_farm = [];
        $("input[id^='en_fspeci_']").each(function(){
          var val = $(this).data('i');
          if(val){
           arr_farm.push(val); 
          }
        });
        var farm_val = arr_farm.toString();
        $("input[name='farm_val']").val(farm_val);
    }
    //on submit form
    $(document).on('click', '#submit', function(){
      someFunction();
      someFunction_far();
    });
  //end
});
</script>  
