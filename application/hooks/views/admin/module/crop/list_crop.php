<?php 
$uid = $this->session->userdata[SESSION_ADMIN]['admin_id'];
$role_permission = $this->mastermodel->getPermission('Module',$uid); 
?>

<link rel="stylesheet" href="<?=base_url('public');?>/components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<?php 
$obj=&get_instance();
$crop=$obj->cropmodel->get_all_crop(); 
?> 
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Crops</h1>
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
              <?php if($role_permission->is_add == 1){ ?>
                <a href="<?php echo base_url('admin/create-crop'); ?>" class="btn btn-primary pull-right" ><i class="fa fa-plus"></i> Add Crop</a>
              <?php } ?>  
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="table" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                <?php 
                if(!empty($crop)){ 
                  $i = 1;
                ?>  
                <?php foreach($crop as $row) { ?>
                  <tr>
                    <td><?php echo $i++; ?></td>
                    <td><img class=" img-responsive" src="<?php echo IMG_PATH.'crop/'.$row->crop_image; ?>" style="height: 35px;"></td>
                    <td>
                        <?php echo $row->en_crop_name; ?><br>
                        <?php echo $row->hi_crop_name; ?><br>
                        <?php echo $row->mr_crop_name; ?>
                    </td>
                    <td>
                      <?php if($role_permission->is_edit == 1){ ?>
                        <a class="btn btn-sm btn-primary" href="<?php echo base_url('admin/edit-crop/'.$row->crop_id); ?>">
                          <i class="fa fa-edit"></i>
                        </a>
                      <?php } ?>
                      <?php if($role_permission->is_delete == 1){ ?>  
                        <button data-i="<?php echo $row->crop_id; ?>" class="btn btn-sm btn-primary delete">
                          <i class="fa fa-trash"></i>
                        </button>
                      <?php } ?>
                      <?php if($role_permission->is_view == 1){ ?>  
                        <a href="<?php echo base_url('admin/variety-list/'.$row->crop_id); ?>">
                          <button class="btn btn-sm btn-primary delete">
                            Variety List
                          </button>
                        </a>
                      <?php } ?>  
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
        <h4 class="modal-title">Delete Confirmation</h4>
      </div>
      <form method="post" action="<?php echo base_url('admin/trash-crop'); ?>" id="frmDel">
        <div class="modal-body">
          <p>Are you sure you want to delete?</p>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="id" value="">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         <input type="submit" class="btn btn-primary btnclass" value="Yes Delete!">
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


