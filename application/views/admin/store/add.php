<style>
  .table-responsive { overflow-x: inherit; }
  .table td{position:relative;}
</style>
<link rel="stylesheet" href="<?=base_url('public/plugins/timepicker/bootstrap-timepicker.min.css');?>">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <?=lang('Store');?>
      <a href="<?php echo base_url('admin/store-list/'); ?>" class="btn btn-primary pull-right" > <i class="fa fa-angle-double-left" aria-hidden="true"></i>  <?=lang('Back to List');?></a>
    </h1>
  </section>
  <!-- start add intensity form -->
  <section class="content">
    <div class="row">
        <div class="col-xs-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title"><?=lang('Add');?>
            </h3>
          </div>
          
          <!-- START add intensity form -->
          <?php echo form_open_multipart('admin/add-store'); ?>
            <div class="box-body">
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
              <div class="col-xs-12 col-md-6">
                <div class="form-group">
                  <label><?=lang('Store Name');?></label>
                  <input type="text" name="name" value="<?php echo set_value('name')?>" class="form-control" placeholder="<?=lang('Store Name');?>" autocomplete="off">
                  <?php echo form_error('name'); ?>
                </div>
                <div class="form-group">
                  <label><?=lang('City');?></label>
                  <select class="form-control select2" name="city_ids[]" multiple="multiple" data-placeholder="<?=lang('City');?>" style="width: 100%;">
                    <?php foreach ($city as $row) { ?>
                      <option value="<?php echo $row['city_id']; ?>"><?php echo $row['name']; ?></option>
                    <?php }  ?>
                  </select>
                  <?php echo form_error('city_ids[]'); ?>
                </div>
                <div class="form-group">
                  <label><?=lang('Store Icon');?></label>
                  <input type="file" class="form-control" name="store_icon" accept=".png,.jpg,.jpeg" >
                  <?php echo form_error('store_icon'); ?>
                </div>
                <div class="form-group">
                  <label><?=lang('Store Banner');?></label>
                  <input type="file" class="form-control" name="store_banner" accept=".png,.jpg,.jpeg" >
                  <?php echo form_error('store_banner'); ?>
                </div>
              </div>
               <div class="col-xs-12 col-md-6">
                  <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                     <thead>
                       <th><?=lang('Open/Close');?></th>
                       <th><?=lang('All');?></th>
                       <th><?=lang('Day');?></th>
                       <th><?=lang('Open Time');?></th>
                       <th><?=lang('Close Time');?></th>
                     </thead>
                     <tbody>
                       <tr>
                          <td style="vertical-align: middle;">
                            <input type="checkbox" class="chck_status">
                            <input type="hidden" name="status[]" value="" class="status">
                          </td>
                          <td style="vertical-align: middle;">
                            <input type="checkbox" class="chck_all">
                          </td>
                          <td style="vertical-align: middle;">Mon<input type="hidden" name="days[]" value="Mon"></td>
                          <td>
                            <div class="bootstrap-timepicker">
                              <div class="input-group">
                                <input type="text" class="form-control timepicker open_time" name="open_time[]" style="min-width: 100px;">
                                <div class="input-group-addon">
                                  <i class="fa fa-clock-o"></i>
                                </div>
                              </div>
                            </div>
                          </td>
                          <td>
                            <div class="bootstrap-timepicker">
                              <div class="input-group">
                                <input type="text" class="form-control timepicker close_time" name="close_time[]" style="min-width: 100px;">
                                <div class="input-group-addon">
                                  <i class="fa fa-clock-o"></i>
                                </div>
                              </div>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td style="vertical-align: middle;">
                            <input type="checkbox" class="chck_status">
                            <input type="hidden" name="status[]" value="" class="status">
                          </td>
                          <td style="vertical-align: middle;">
                            <input type="checkbox" class="chck_all">
                          </td>
                          <td style="vertical-align: middle;">Tue<input type="hidden" name="days[]" value="Tue"></td>
                          <td>
                            <div class="bootstrap-timepicker">
                              <div class="input-group">
                                <input type="text" class="form-control timepicker open_time" name="open_time[]" style="min-width: 100px;">
                                <div class="input-group-addon">
                                  <i class="fa fa-clock-o"></i>
                                </div>
                              </div>
                            </div>
                          </td>
                          <td>
                            <div class="bootstrap-timepicker">
                              <div class="input-group">
                                <input type="text" class="form-control timepicker close_time" name="close_time[]" style="min-width: 100px;">
                                <div class="input-group-addon">
                                  <i class="fa fa-clock-o"></i>
                                </div>
                              </div>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td style="vertical-align: middle;">
                            <input type="checkbox" class="chck_status">
                            <input type="hidden" name="status[]" value="" class="status">
                          </td>
                           <td style="vertical-align: middle;">
                            <input type="checkbox" class="chck_all">
                          </td>
                          <td style="vertical-align: middle;">Wed<input type="hidden" name="days[]" value="Wed"></td>
                          <td>
                            <div class="bootstrap-timepicker">
                              <div class="input-group">
                                <input type="text" class="form-control timepicker open_time" name="open_time[]" style="min-width: 100px;">
                                <div class="input-group-addon">
                                  <i class="fa fa-clock-o"></i>
                                </div>
                              </div>
                            </div>
                          </td>
                          <td>
                            <div class="bootstrap-timepicker">
                              <div class="input-group">
                                <input type="text" class="form-control timepicker close_time" name="close_time[]" style="min-width: 100px;">
                                <div class="input-group-addon">
                                  <i class="fa fa-clock-o"></i>
                                </div>
                              </div>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td style="vertical-align: middle;">
                            <input type="checkbox" class="chck_status">
                            <input type="hidden" name="status[]" value="" class="status">
                          </td>
                           <td style="vertical-align: middle;">
                            <input type="checkbox" class="chck_all">
                          </td>
                          <td style="vertical-align: middle;">Thu<input type="hidden" name="days[]" value="Thu"></td>
                          <td>
                            <div class="bootstrap-timepicker">
                              <div class="input-group">
                                <input type="text" class="form-control timepicker open_time" name="open_time[]" style="min-width: 100px;">
                                <div class="input-group-addon">
                                  <i class="fa fa-clock-o"></i>
                                </div>
                              </div>
                            </div>
                          </td>
                          <td>
                            <div class="bootstrap-timepicker">
                              <div class="input-group">
                                <input type="text" class="form-control timepicker close_time" name="close_time[]" style="min-width: 100px;">
                                <div class="input-group-addon">
                                  <i class="fa fa-clock-o"></i>
                                </div>
                              </div>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td style="vertical-align: middle;">
                            <input type="checkbox" class="chck_status">
                            <input type="hidden" name="status[]" value="" class="status">
                          </td>
                           <td style="vertical-align: middle;">
                            <input type="checkbox" class="chck_all">
                          </td>
                          <td style="vertical-align: middle;">Fri<input type="hidden" name="days[]" value="Fri"></td>
                          <td>
                            <div class="bootstrap-timepicker">
                              <div class="input-group">
                                <input type="text" class="form-control timepicker open_time" name="open_time[]" style="min-width: 100px;">
                                <div class="input-group-addon">
                                  <i class="fa fa-clock-o"></i>
                                </div>
                              </div>
                            </div>
                          </td>
                          <td>
                            <div class="bootstrap-timepicker">
                              <div class="input-group">
                                <input type="text" class="form-control timepicker close_time" name="close_time[]" style="min-width: 100px;">
                                <div class="input-group-addon">
                                  <i class="fa fa-clock-o"></i>
                                </div>
                              </div>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td style="vertical-align: middle;">
                            <input type="checkbox" class="chck_status">
                            <input type="hidden" name="status[]" value="" class="status">
                          </td>
                           <td style="vertical-align: middle;">
                            <input type="checkbox" class="chck_all">
                          </td>
                          <td style="vertical-align: middle;">Sat<input type="hidden" name="days[]" value="Sat"></td>
                          <td>
                            <div class="bootstrap-timepicker">
                              <div class="input-group">
                                <input type="text" class="form-control timepicker open_time" name="open_time[]" style="min-width: 100px;">
                                <div class="input-group-addon">
                                  <i class="fa fa-clock-o"></i>
                                </div>
                              </div>
                            </div>
                          </td>
                          <td>
                            <div class="bootstrap-timepicker">
                              <div class="input-group">
                                <input type="text" class="form-control timepicker close_time" name="close_time[]" style="min-width: 100px;">
                                <div class="input-group-addon">
                                  <i class="fa fa-clock-o"></i>
                                </div>
                              </div>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td style="vertical-align: middle;">
                            <input type="checkbox" class="chck_status">
                            <input type="hidden" name="status[]" value="" class="status">
                          </td>
                           <td style="vertical-align: middle;">
                            <input type="checkbox" class="chck_all">
                          </td>
                          <td style="vertical-align: middle;">Sun<input type="hidden" name="days[]" value="Sun"></td>
                          <td>
                            <div class="bootstrap-timepicker">
                              <div class="input-group">
                                <input type="text" class="form-control timepicker open_time" name="open_time[]" style="min-width: 100px;">
                                <div class="input-group-addon">
                                  <i class="fa fa-clock-o"></i>
                                </div>
                              </div>
                            </div>
                          </td>
                          <td>
                            <div class="bootstrap-timepicker">
                              <div class="input-group">
                                <input type="text" class="form-control timepicker close_time" name="close_time[]" style="min-width: 100px;">
                                <div class="input-group-addon">
                                  <i class="fa fa-clock-o"></i>
                                </div>
                              </div>
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
               </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <input type="submit" value="<?=lang('Save');?>" class="btn btn-primary">
            </div>
          <?php form_close();  ?>
          <!-- END add intensity form -->
        </div>
      </div> 
    </div>
  </section>    
  <!-- end add intensity form -->
</div>
<script src="<?=base_url('public/plugins/timepicker/bootstrap-timepicker.min.js');?>"></script>
<script>
  $(document).ready(function(){
    $('.select2').select2();
    $('.chck_status').iCheck({
      checkboxClass: 'icheckbox_minimal-blue'
    }).on('ifChanged', function(e) {
      var isChecked = e.currentTarget.checked;
      if (isChecked == true) {
        $(e.currentTarget).parent().parent().find('.status').val(1)
      }else{
        $(e.currentTarget).parent().parent().find('.status').val(0)
      }
    });
    $('.chck_all').iCheck({
      checkboxClass: 'icheckbox_minimal-blue'
    }).on('ifChanged', function(e) {
      var isChecked = e.currentTarget.checked;
      var open_time = $(e.currentTarget).parent().parent().parent().find('.open_time').val();
      var close_time = $(e.currentTarget).parent().parent().parent().find('.close_time').val();
      if (isChecked == true) {
        $(".open_time").val(open_time);
        $(".close_time").val(close_time);
      }else{
        $(".open_time").not($(e.currentTarget).parent().parent().parent().find('.open_time')).val("");
        $(".close_time").not($(e.currentTarget).parent().parent().parent().find('.close_time')).val("");
      }
    });
    $('.timepicker').timepicker({
      showInputs: false
    });
    $('.iCheck-helper').css('position', 'relative');
  });
</script>
