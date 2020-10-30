<link rel="stylesheet" href="<?=base_url('public');?>/components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="<?=base_url('public');?>/components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1><?=lang('Pending Orders');?></h1>
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
                <a data-toggle="tooltip" data-placement="top" title="<?=lang('Download PDF');?>" target="_blank" href="<?php echo base_url(); ?>admin/pending-order-save-pdf?last=&from=&to=" type="button" class="btn btn-primary export" ><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
                <a data-toggle="tooltip" data-placement="top" title="<?=lang('Download Excel');?>" target="_blank" href="<?php echo base_url(); ?>admin/pending-order-save-excel?last=&from=&to=" type="button" class="btn btn-primary export" ><i class="fa fa-file-excel-o" aria-hidden="true"></i></a>
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
                    <th><?=lang('Price');?></th>
                    <th><?=lang('Order Status');?></th>
                    <th><?=lang('Actions');?></th>
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

<!-- Modal -->
<div class="modal fade in" id="modal_near_by_driver">
  <div class="modal-dialog" >
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Driver Near By</h4>
      </div> 
        <div class="modal-body" >
          <table id="driver_assign_tbl" class="table table-bordered table-striped" style="width:100%">
            <thead>
              <tr>
                <td>Driver Name</td>
                <td>Mobile</td>
                <td>Action</td>
              </tr>  
            </thead>
            <tbody>
              <!-- add data by ajax -->
            </tbody>  
          </table>  
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div> 

<!-- Modal -->
<div class="modal fade in" id="modalOrderCancel">
  <div class="modal-dialog" >
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Cancel Order</h4>
      </div>
        
        <div class="modal-body" >
            <p>Are you sure you want to cancel?</p>
            <input type="hidden" name="order_id" value="">
             
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <input type="submit" value="Cancel" class="btn btn-primary cancel_order">
        </div>
    </div>
  </div>
</div> 

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
            "url": "<?php echo base_url(); ?>admin/pending-order-list-ajax",
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
            "targets": [ 0,6 ], <?php //first column / numbering column ?>
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
      ],
      "drawCallback": function( settings ) {
        $('[data-toggle="tooltip"]').tooltip();
      }

    });

    $('#btn-filter').click(function(){ <?php //button filter event click ?>
        table.ajax.reload();  <?php //just reload table ?>
    });
    $('#btn-reset').click(function(){ <?php //button reset event click ?>
        $('#form-filter')[0].reset();
        table.ajax.reload();  <?php //just reload table ?>
    });

    setInterval( function () {
      $('#table').dataTable().api().ajax.reload();
    }, 30000 );

    $(".date").datepicker({
      autoclose: true
    });

    $('.export').click(function(event){
      event.preventDefault();
      event.stopPropagation();
      $('#table').dataTable().api().ajax.reload(); 
      var from = $('#from').val();
      var to = $('#to').val();
      var hrefVal = this.toString().replace("?last=&from=&to=", "?from="+from+"&to="+to);
      window.location = hrefVal;
    });


    $(document).on('click', '.cancel', function(){
      var row = $(this).data('row');
      $("#modalOrderCancel input[name='order_id']").val(row.order_id);
      $("#modalOrderCancel").modal('show');
    });

    <?php //cancel order ?>
    $(document).on('click', '.cancel_order', function(){
        var order_id =  $("#modalOrderCancel input[name='order_id']").val();
        $.post("<?=base_url();?>admin/order-cancel",{order_id:order_id},function(res){
            if(res == 1){
              $('#table').dataTable().api().ajax.reload();
              $("#modalOrderCancel").modal('hide');
            }
        });
    });

    <?php //open model with near by driver ?>
    $(document).on('click', '.near_by_driver_btn', function(){
      var row = $(this).data('row'); 
      $.ajax({
        url: "<?php echo base_url(); ?>admin/get_nearby_driver_ajax",
        method:"POST",
        data:{lat:row.lat,lon:row.lon},
        success: function(data){
          var data = JSON.parse(data);
          var row_data = '';
          for (var i = 0; i < data.length; i++) {
             row_data += '<tr>\
              <td>'+data[i].name+'</td>\
              <td>'+data[i].mobile+'</td>\
              <td> <button data-order_id='+row.order_id+' data-driver_id='+data[i].db_id+' data-device_token='+data[i].device_token+' data-type="button"  class="btn btn-primary assign_btn">Assign</button></td>\
            </tr>';
          }
          $('#driver_assign_tbl tbody').html(row_data);
        }
      });
      $("#modal_near_by_driver").modal('show');
      setTimeout(function() {$("#driver_assign_tbl").DataTable();}, 200);
    });

    <?php //assign request to new driver ?>
    $(document).on('click', '.assign_btn', function(){
        var order_id = $(this).data('order_id');
        var db_id = $(this).data('db_id');
        var device_token = $(this).data('device_token');
         $.ajax({
          url: "<?php echo base_url(); ?>admin/assign_driver_to_order_ajax",
          method:"POST",
          data:{order_id:order_id,db_id:db_id,device_token:device_token},
          success: function(data){
            location.reload();
          }
        });
    });


});
</script>



