<link rel="stylesheet" href="<?=base_url('public');?>/components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="<?=base_url('public');?>/components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<link rel="stylesheet" href="https://gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/css/dataTables.checkboxes.css">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1><?=lang('Driver Notification');?></h1>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
        <form action="<?=base_url('/admin/send-notification');?>" id="frmNotify" method="post">
          <div class="box">
            <input type="hidden" name="action" value="delivery-boy">
              <div class="box-header" style="display:<?=( !empty($this->session->flashdata('success')) || !empty(form_error('id[]')) )?'block':'none';?>;">
                <?php if(!empty($this->session->flashdata('success'))): ?>
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <span> <?php echo $this->session->flashdata('success'); ?> </span>
                </div>
                <?php endif ?>
                <?php echo form_error('id[]'); ?>
              </div>
              <div class="clearfix"></div>
                <!-- /.box-header -->
              <div class="box-body table-responsive">
                <table id="table" class="table table-bordered table-striped" style="width: 100%;">
                  <thead>
                  <tr>
                    <th width="1%"></th> 
                    <th><?=lang('Name');?></th>
                    <th><?=lang('Email');?></th>
                    <th><?=lang('Mobile');?></th>
                  </tr>
                  </thead>
                  <tbody>

                  </tbody>
                </table>
                <div class="form-group">
                  <label for="msg"><?=lang('Message');?></label>
                  <textarea name="msg" id="msg" placeholder="<?=lang('Message');?>" class="form-control"><?php echo set_value('msg')?></textarea>
                  <?php echo form_error('msg'); ?>
                </div>
              </div>
            <!-- /.box-body -->
            
            <div class="box-footer">
              <button type="submit" class="btn btn-primary"><?=lang('Send');?></button>
            </div>
          </div>
        <!-- /.box -->
        </div>
        </form>
      <!-- /.col -->
      </div>
    <!-- /.row -->
    </section>
  <!-- /.content -->
  </div>
<!-- /.content-wrapper -->
<script src="<?=base_url('public');?>/components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?=base_url('public');?>/components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="<?=base_url('public')?>/components/bootstrap-datepicker/dist/js/bootstrap-datepicker.js"></script>
<script src="https://gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/js/dataTables.checkboxes.min.js"></script>
<script type="text/javascript">
  
var table; 
$(document).ready(function() {
  $.fn.dataTable.ext.errMode = 'none';

  <?php //datatables ?> 
  table = $('#table').DataTable({ 
    "processing": true, <?php //Feature control the processing indicator. ?>
    "serverSide": true, <?php //Feature control DataTables' server-side processing mode. ?>
    "order": [], <?php //Initial no order. ?>

    <?php // Load data for the table's content from an Ajax source ?>
    "ajax": {
        "url": "<?php echo base_url(); ?>admin/delivery-boy-list-ajax",
        "type": "POST",
        "data": function ( data ) {
             
        }
    },
    "language": {                
        "infoFiltered": ""
    },

    <?php //Set column definition initialisation properties. ?>
    'columnDefs': [{
      'targets': 0,
      'checkboxes': {
         'selectRow': true
      }
    }],
    'select': {
       'style': 'multi'
    },
    "columns": [
      null,
      { "class":"text-nowrap" },
      null,
      null,
    ]
  });

  table.on('error.dt', function(e, settings, techNote, message) {
    console.log( 'An error has been reported by DataTables: ', message);
  });

  $('#frmNotify').on('submit', function(e){
      var form = this;
      var params = table.$('textarea').serializeArray();
      $.each(params, function(){ 
         if(!$.contains(document, form[this.name])){ 
            $(form).append(
               $('<input>')
                  .attr('type', 'hidden')
                  .attr('name', this.name)
                  .val(this.value)
            );
         }
      });

      $.each(table.column(0).checkboxes.selected(), function(index, rowId){
        $(form).append(
            $('<input>')
               .attr('type', 'hidden')
               .attr('name', 'id[]')
               .val(rowId)
        );
     });
   });

});
</script>



