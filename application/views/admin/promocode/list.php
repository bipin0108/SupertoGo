<link rel="stylesheet" href="<?=base_url('public');?>/components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="<?=base_url('public/css/toggle_switch.css');?>">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1><?=lang('Promocode');?></h1>
  </section>
  <!-- Main content --> 
  <section class="content">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
         <div class="box box-primary">
          <div class="box-header">
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
          </div>
          <!-- /.box-header -->
          <div class="box-body table-responsive">
            <table id="table" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>#</th>  
                  <th><?=lang('Promocode');?></th> 
                  <th><?=lang('Min Price');?></th> 
                  <th><?=lang('Descount');?></th> 
                  <th><?=lang('Validate');?></th> 
                  <th><?=lang('Status');?></th> 
                  <th><?=lang('Actions');?></th>
                </tr>
              </thead>
              <tbody>
              <?php 
              if(!empty($promocode)){ 
                $i = 1;
              ?>  
              <?php foreach($promocode as $row) {
                if($row['status'] == '1'){
                  $checked = 'checked';
                }else{
                  $checked = '';
                }
                if($row['discount_type'] == 1){
                  $dicount = $row['discount'].'%';
                }else{
                  $dicount = $this->m_general->getSetting('currency').$row['discount'];
                }
                

                ?>
                <tr>
                  <td><?php echo $i++; ?></td> 
                  <td class="text-nowrap"><?php echo $row['promocode'];?></td>
                  <td><?php echo $row['min_price'];?></td>
                  <td><?php echo $dicount;?></td>
                  <td class="text-nowrap"><?php echo $row['start_date']." To ".$row['end_date'];?></td>
                  <td>
                    <label class='switch'>
                      <input type="checkbox" <?=$checked;?> class="active_deactive" data-is_value="<?=$row['status'];?>" data-i="<?=$row['promo_id'];?>">
                    <span class='slider round'></span>
                    </label>
                  </td>
                  <td style="display: inline-flex;">
                    <a class="btn btn-sm btn-primary mr-5" href="<?php echo base_url('admin/edit-promocode/'.$row['promo_id']); ?>">
                      <i class="fa fa-edit"></i>
                    </a>
                    <button data-i="<?php echo $row['promo_id']; ?>" class="btn btn-sm btn-danger mr-5 delete">
                      <i class="fa fa-trash"></i>
                    </button>
                  </td>
                </tr>                  
              <?php } ?>    
              <?php } ?>
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
<!-- Modal -->
<div class="modal fade in" id="modalDel">
<div class="modal-dialog" >
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span></button>
      <h4 class="modal-title"><?=lang('Delete Confirmation');?></h4>
    </div>
    <form method="post" action="<?php echo base_url('admin/trash-promocode'); ?>" id="frmDel">
      <div class="modal-body">
        <p><?=lang('Are you sure you want to delete?');?></p>
      </div>
      <div class="modal-footer">
        <input type="hidden" name="id" value="">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?=lang('Close');?></button>
       <input type="submit" class="btn btn-primary btnclass" value="<?=lang('Yes Delete!');?>">
      </div>
    </form>
  </div>
</div>
</div>
<!-- DataTables -->
<script src="<?=base_url('public');?>/components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?=base_url('public');?>/components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
  $(function(){
    $("#table").DataTable();
  });
  $(document).ready(function(){
    $(document).on('click', '.delete', function(){
      var i = $(this).data('i');
      $("#frmDel input[name='id']").val(i);
      $("#modalDel").modal('show');
    });
    $(document).on('click', '.active_deactive', function(){
      var id = $(this).data('i');
      var is_value = $(this).data('is_value');
       $.ajax({
             url:"<?php echo base_url(); ?>admin/ajax/promocodeActiveDeactiveStatus",
             method:"POST",
             data:{id:id,is_value:is_value},
             success:function(data)
             {
                  
             }
        });
    });
  });
</script>
 


