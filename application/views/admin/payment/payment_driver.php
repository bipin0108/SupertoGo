<link rel="stylesheet" href="<?=base_url('public');?>/components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="<?=base_url('public');?>/components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1><?=lang('Payment Driver');?></h1>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
         <div class="box">
          <div class="box-header">
            <?php if(!empty($this->session->flashdata('success'))): ?>
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <span> <?php echo $this->session->flashdata('success'); ?> </span>
            </div>
            <?php endif ?>
            <form id="form-filter" class="form-horizontal">
              <div class="col-sm-2 custom">
                <input type="text" name="from" class="form-control date" id="from" placeholder="<?=lang('From Date');?>">
              </div>
              <div class="col-sm-2 custom">
                <input type="text" name="to" class="form-control date" id="to" placeholder="<?=lang('To Date');?>">
              </div>

              <div class="col-sm-2" style="display: inline-flex;">
                <button data-toggle="tooltip" data-placement="top" title="<?=lang('Search');?>" type="button" id="btn-filter" class="btn btn-primary"><i class="fa fa-filter" aria-hidden="true"></i></button>
                <button data-toggle="tooltip" data-placement="top" title="<?=lang('Refresh');?>" type="button" id="btn-reset" class="btn btn-primary"><i class="fa fa-refresh" aria-hidden="true"></i></button>
                <a data-toggle="tooltip" data-placement="top" title="<?=lang('Download PDF');?>" target="_blank" href="<?php echo base_url(); ?>admin/payment-driver-save-pdf?from=&to=" type="button" class="btn btn-primary export" ><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
                <a data-toggle="tooltip" data-placement="top" title="<?=lang('Download Excel');?>" target="_blank" href="<?php echo base_url(); ?>admin/payment-driver-save-excel?from=&to=" type="button" class="btn btn-primary export" ><i class="fa fa-file-excel-o" aria-hidden="true"></i></a>
              </div>
                 
            </form>
            <div class="clearfix"></div>
              <!-- /.box-header -->
              <div class="box-body table-responsive">
                <table id="table" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>#</th> 
                    <th><?=lang('Order ID');?></th>
                    <th><?=lang('Date');?></th>
                    <th><?=lang('User');?></th> 
                    <th><?=lang('Delivery Boy');?></th>
                    <th><?=lang('Order Status');?></th>
                    <th><?=lang('Adject Amt');?></th> 
                    <th><?=lang('Price');?></th> 
                    <th><?=lang('Driver Amt');?></th> 
                    <th><?=lang('Admin Amt');?></th> 
                  </tr>
                  </thead>
                  <tbody>

                  </tbody>
                </table>
              </div>
          <!-- /.box-body -->
          </div>
        <!-- /.box -->
        </div>
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
            "url": "<?php echo base_url(); ?>admin/payment-driver-list-ajax",
            "type": "POST",
            "data": function ( data ) {
                data.from = $('#from').val();
                data.to = $('#to').val();
            }
        },
        "language": {                
            "infoFiltered": ""
        },

        <?php //Set column definition initialisation properties. ?>
        "columnDefs": [
        { 
            "targets": [ 0 ], <?php //first column / numbering column ?>
            "orderable": false, <?php //set not orderable ?>
        },
        ],
      "columns": [
        { "visible": false }, 
        null,
        null,
        null,
        null,
        null,
        null, 
        null, 
        null, 
        null, 
      ]

    });

    $('#btn-filter').click(function(){ <?php //button filter event click ?>
        table.ajax.reload();  <?php //just reload table ?>
    });
    $('#btn-reset').click(function(){ <?php //button reset event click ?>
        $('#form-filter')[0].reset();
        table.ajax.reload();  <?php //just reload table ?>
    });

    $(".date").datepicker({
      autoclose: true
    });

    $('.export').click(function(event){
      event.preventDefault();
      event.stopPropagation(); 
      var from = $('#from').val();
      var to = $('#to').val();
      var hrefVal = this.toString().replace("?from=&to=", "?from="+from+"&to="+to);
      window.location = hrefVal;
    });

});
</script>



