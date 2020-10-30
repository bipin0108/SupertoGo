<link rel="stylesheet" href="<?=base_url('public/components/datatables.net-bs/css/dataTables.bootstrap.min.css');?>">
<link rel="stylesheet" href="<?=base_url('public/css/toggle_switch.css');?>">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Users</h1>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
         <div class="box">
          <div class="box-header">
            <?php if(!empty($this->session->flashdata('add_success'))): ?>
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <span> <?php echo $this->session->flashdata('add_success'); ?> </span>
            </div>
            <?php endif ?>
            <?php if(!empty($this->session->flashdata('error'))): ?>
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <span> <?php echo $this->session->flashdata('error'); ?> </span>
            </div>
            <?php endif ?>
          <!-- /.box-header -->
          <div class="box-body table-responsive">
            <table id="table" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>#</th>
                <th><?=lang('Image');?></th>
                <th><?=lang('First Name');?></th>
                <th><?=lang('Last Name');?></th>
                <th><?=lang('Email');?></th>
                <th><?=lang('Mobile');?></th>
                <th><?=lang('Status');?></th> 
              </tr>
              </thead>
              <tbody>
                <?php 
            if(!empty($user)){ 
              $i = 1;
            ?>  
            <?php foreach($user as $row) {
              if($row['status'] == 'Active'){
                $checked = 'checked';
              }else{
                $checked = '';
              }
              $image = '-';
              if(file_exists('./uploads/profiles/'.$row['avatar']) && !empty($row['avatar'])){ 
                  $image = '<a data-magnify="gallery" data-caption=" " href="'.base_url('uploads/profiles/'.$row['avatar']).'"><img class="img-responsive" style="height:40px;" src="'.base_url('uploads/profiles/'.$row['avatar']).'"></a>';
              }

            ?>
              <tr>
                <td><?php echo $i++;?></td>
                <td><?php echo $image;?></td>
                <td><?php echo $row['first_name'];?></td>
                <td><?php echo $row['last_name'];?></td>
                <td><?php echo $row['email'];?></td>
                <td><?php echo $row['mobile'];?></td>
                <td>
                  <label class='switch'>
                    <input type="checkbox" <?=$checked;?> class="active_deactive" data-is_value="<?=$row['status'];?>" data-i="<?=$row['user_id'];?>">
                  <span class='slider round'></span>
                  </label>
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
<!-- /.content-wrapper --> 
<script src="<?=base_url('public');?>/components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?=base_url('public');?>/components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script>
  $(function(){
    $("#table").DataTable();
    $(document).on('click', '.active_deactive', function(){
      var id = $(this).data('i');
      var is_value = $(this).data('is_value');
       $.ajax({
             url:"<?php echo base_url(); ?>admin/ajax/userActiveDeactiveStatus",
             method:"POST",
             data:{id:id,is_value:is_value},
             success:function(data)
             {
                  
             }
        });
    });
  });
</script>