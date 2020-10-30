<link rel="stylesheet" href="<?=base_url('public/components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css');?>">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <?=lang('Time Slot');?>
      <a href="<?php echo base_url('admin/time-slot-list/'); ?>" class="btn btn-primary pull-right" > <i class="fa fa-angle-double-left" aria-hidden="true"></i>  <?=lang('Back to List');?></a>
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
          <!-- START add intensity form -->
          <?php echo form_open('admin/add-time-slot'); ?>
            <div class="box-body">
              <div class="col-md-4">
                <div class="form-group">
                  <label>Slot Date</label>
                  <input type="text" name="slot_date" value="" class="form-control date" placeholder="Slot Date" autocomplete="off">
                  <?php echo form_error('slot_date'); ?>
                </div>
              </div>
              
              <div class="clearfix"></div>
              <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th><?=lang('From Hour');?></th>
                      <th><?=lang('From Minute');?></th>
                      <th><?=lang('Before Midday');?></th>
                      <th><?=lang('To Hour');?>To Hour</th>
                      <th><?=lang('To Minute');?></th>
                      <th><?=lang('After Midday');?></th>
                      <th><?=lang('Actions');?></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td> 
                        <input type="text" name="from_hour[]" class="form-control" placeholder="<?=lang('From Hour');?>" autocomplete="off"> 
                      </td>
                      <td>
                        <input type="text" name="from_min[]" class="form-control" placeholder="<?=lang('From Minute');?>" autocomplete="off"> 
                      </td>
                      <td>
                        <select name="before_midday[]" class="form-control">
                          <option value="AM">AM</option>
                          <option value="PM">PM</option>
                        </select> 
                      </td>
                      <td>
                         <input type="text" name="to_hour[]" class="form-control" placeholder="<?=lang('To Hour');?>" autocomplete="off"> 
                      </td>
                      <td>
                         <input type="text" name="to_min[]" class="form-control" placeholder="<?=lang('To Minute');?>" autocomplete="off"> 
                      </td>
                      <td>
                         <select name="after_midday[]" class="form-control">
                          <option value="AM">AM</option>
                          <option value="PM">PM</option>
                        </select> 
                      </td>
                      <td>
                        <a tabindex="-1" href="javascript:;" class="btn btn-sm btn-primary add" data-store_id="5" data-city_id="3">
                          <i class="fa fa-plus"></i>
                        </a>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <input type="submit" value="Save" class="btn btn-primary">
            </div>
          <?php form_close();  ?>
          <!-- END add intensity form -->
        </div>
      </div> 
    </div>
  </section>    
  <!-- end add intensity form -->
</div>
<script src="<?=base_url('public/components/bootstrap-datepicker/js/bootstrap-datepicker.js');?>"></script>
<script>
  $(document).ready(function(){
    var dateToday = new Date();    
    $('.date').datepicker({
      multidate: true,
      format: 'dd-mm-yyyy',
      startDate: "+0d"
    });

    var i=1;
    $('.add').on('click',function(){
      if(i<2){
        i += 1;
        var html = "";
        var $this = $(this);
        html += '<tr>\
          <td> \
            <input type="text" name="from_hour[]" class="form-control" placeholder="<?=lang('From Hour');?>" autocomplete="off">\
          </td>\
          <td>\
            <input type="text" name="from_min[]" class="form-control" placeholder="<?=lang('From Minute');?>" autocomplete="off">\
          </td>\
          <td>\
            <select name="before_midday[]" class="form-control">\
              <option value="AM">AM</option>\
              <option value="PM">PM</option>\
            </select>\
          </td>\
          <td>\
             <input type="text" name="to_hour[]" class="form-control" placeholder="<?=lang('To Hour');?>" autocomplete="off">\
          </td>\
          <td>\
             <input type="text" name="to_min[]" class="form-control" placeholder="<?=lang('To Minute');?>" autocomplete="off">\
          </td>\
          <td>\
             <select name="after_midday[]" class="form-control">\
              <option value="AM">AM</option>\
              <option value="PM">PM</option>\
            </select>\
          </td>\
          <td><a tabindex="-1" href="javascript:;" class="btn btn-sm btn-danger remove"><i class="fa fa-trash"></i></a></td>\
        </tr>';

         $(html).insertAfter($this.closest("tbody").find('tr').last());
      }
    });

    $(document).on('click', '.remove', function(){
      i -= 1;
      $(this).parent('td').parent('tr').remove();
    });

  });
</script>