<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Crop
      <a href="<?php echo base_url('admin/crop-list/'); ?>" class="btn btn-primary pull-right" > <i class="fa fa-angle-double-left" aria-hidden="true"></i>  Back to List</a>
    </h1>
  </section>
  <!-- start add state form -->
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
          <!-- START add state form -->
          <?php echo form_open_multipart('admin/add-crop'); ?>
            <div class="box-body">
              <div class="col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                      <label>Crop Name [English]</label>
                      <input type="text" name="en_crop_name" value="<?php echo set_value('en_crop_name')?>" class="form-control" placeholder="Crop Name [English]" autocomplete="off">
                      <?php echo form_error('en_crop_name'); ?>
                   </div>
                </div>  
                <div class="col-md-6">
                    <div class="form-group">
                      <label>Crop Name [Hindi]</label>
                      <input type="text" name="hi_crop_name" value="<?php echo set_value('hi_crop_name')?>" class="form-control" placeholder="Crop Name [Hindi]" autocomplete="off">
                      <?php echo form_error('hi_crop_name'); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label>Crop Name [Marathi] </label>
                      <input type="text" name="mr_crop_name" value="<?php echo set_value('mr_crop_name')?>" class="form-control" placeholder="Crop Name [Marathi]" autocomplete="off">
                      <?php echo form_error('mr_crop_name'); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label">Crop Image</label>
                      <input type="file" class="form-control" name="crop_image" >
                      <?php echo form_error('crop_image'); ?>
                      <?php if($this->session->flashdata('img_error')): ?>
                      <div class="alert alert-danger">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <span><?php echo $this->session->flashdata('img_error') ?></span>
                      </div>
                      <?php endif ?>
                    </div>
                </div>
              </div>
            </div>    

            <!-- mandi rate -->
             <div class="box-body">
                <div class="col-md-12">
                    <input type="hidden" name="mandi_val" value="1">
                    <h4>
                      <b><i class="fa fa-hand-o-right" aria-hidden="true"></i> Grade of Mandi</b>
                      <a id="add_rate_mandi" class="btn btn-primary btn-sm pull-right">Add Grade</a>
                    </h4>
                    <hr>
                    <div class="row">
                      <div id="rate_of_mandi_div">
                          <!-- strat -->
                          <div class='col-md-12' id='mandibox_1'>
                            <div class='col-md-4'>
                              <div class='form-group'>
                                <label>Grade [English]</label>
                                <input type='text' id='en_mgrade_1' value="<?php echo set_value('en_mgrade_1')?>" name='en_mgrade_1' data-i='1' placeholder='Grade [English]' class='form-control' >
                              </div>
                            </div>
                            <div class='col-md-4'>
                              <div class='form-group'>
                                <label>Grade [Hindi]</label>
                                <input type='text' name='hi_mgrade_1'  value="<?php echo set_value('hi_mgrade_1')?>" placeholder='Grade [Hindi]' class='form-control' >
                              </div>
                            </div>
                            <div class='col-md-4'>
                              <div class='form-group'>
                                <label>Grade [Marathi]</label>
                                <input type='text' name='mr_mgrade_1' value="<?php echo set_value('mr_mgrade_1')?>"  placeholder='Grade [Marathi]' class='form-control' >
                              </div>
                            </div>
                            <div class='col-md-4'>
                              <div class='form-group'>
                                <label>Specification [English]</label>
                                <input type='text' name='en_mspeci_1' value="<?php echo set_value('en_mspeci_1')?>" placeholder='Specification [English]' class='form-control' >
                              </div>
                            </div>
                            <div class='col-md-4'>
                              <div class='form-group'>
                                <label>Specification [Hindi]</label>
                                <input type='text' name='hi_mspeci_1'  value="<?php echo set_value('hi_mspeci_1')?>" placeholder='Specification [Hindi]' class='form-control' >
                              </div>
                            </div>
                            <div class='col-md-4'>
                              <div class='form-group'>
                                <label>Specification [Marathi]</label>
                                <input type='text' name='mr_mspeci_1' value="<?php echo set_value('mr_mspeci_1')?>" placeholder='Specification [Marathi]' class='form-control' >
                              </div>
                            </div>
                          </div>
                          <!-- end -->
                      </div>
                    </div> 
                </div>  
                <!-- end -->
            </div>
            <!-- farm rate --> 
            <div class="box-body">
              <div class="col-md-12">
                    <input type="hidden"  name="farm_val" value="1">
                    <h4><b><i class="fa fa-hand-o-right" aria-hidden="true"></i> Grade of Farm</b>
                    <a id="add_rate_farm" class="btn btn-primary btn-sm pull-right">Add Grade</a>
                    </h4>
                    <hr>
                    <div class="row">
                    <div id="rate_of_farm_div">
                      <!-- strat -->
                      <div class='col-md-12' id='farmbox_1'>
                        <div class='col-md-4'>
                          <div class='form-group'>
                            <label>Specification [English]</label>
                            <input type='text' value="<?php echo set_value('en_fspeci_1')?>" id='en_fspeci_1' name='en_fspeci_1' data-i='1' placeholder='Specification [English]' class='form-control' required>
                          </div>
                        </div>
                        <div class='col-md-4'>  
                          <div class='form-group'>
                            <label>Specification [Hindi]</label>
                            <input type='text' value="<?php echo set_value('hi_fspeci_1')?>" name='hi_fspeci_1'  placeholder='Specification [Hindi]' class='form-control' required>
                          </div>
                        </div>
                        <div class='col-md-4'>
                          <div class='form-group'>
                            <label>Specification [Marathi]</label>
                            <input type='text' value="<?php echo set_value('mr_fspeci_1')?>" name='mr_fspeci_1' placeholder='Specification [Marathi]' class='form-control' required>
                          </div>
                        </div>
                      </div>
                      <!-- end -->
                    </div>
                    </div> 
              </div>  
            </div>  
            <!-- /.box-body -->
            <div class="box-footer">
              <input type="submit" value="Save" class="btn btn-primary">
            </div>
          <?php form_close();  ?>
          <!-- END add state form -->
        </div>
      </div> 
    </div>
  </section>    
  <!-- end add state form -->
</div>
<script type="text/javascript">
var k = 1;
var l = 1;
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
