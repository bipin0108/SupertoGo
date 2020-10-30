<link rel="stylesheet" href="<?=base_url('public');?>/components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1><?=lang('Pages');?></h1>
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
                  <th><?=lang('Title');?></th>
                  <th><?=lang('Description');?></th>
                  <th><?=lang('Actions');?></th>
                </tr>
              </thead>
              <tbody>
              <?php 
              if(!empty($pages)){ 
                $i = 1;
              ?>  
              <?php foreach($pages as $row) { ?>
                <tr>
                  <td><?php echo $i++; ?></td> 
                  <td><?php echo $row['title'];?></td>
                  <td><?php echo $row['description'];?></td>
                  <td style="display: inline-flex;">
                    <a class="btn btn-sm btn-primary mr-5" href="<?php echo base_url('admin/edit-page/'.$row['page_id']); ?>">
                      <i class="fa fa-edit"></i>
                    </a> 
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
    <form method="post" action="<?php echo base_url('admin/trash-product'); ?>" id="frmDel">
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
  });
</script>
 


