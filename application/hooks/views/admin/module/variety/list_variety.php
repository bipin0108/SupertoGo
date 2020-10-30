<?php 
$uid = $this->session->userdata[SESSION_ADMIN]['admin_id'];
$role_permission = $this->mastermodel->getPermission('Module',$uid); 
?>

<link rel="stylesheet" href="<?=base_url('public');?>/components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<?php 
  $obj=&get_instance();
  $variety = $obj->varietymodel->get_all_variety_forcrop($crop_id); 
  $crop = $obj->cropmodel->get_crop_by_id($crop_id);
?> 
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Crop Name: <?php echo $crop['en_crop_name']." [".$crop['hi_crop_name']."] [".$crop['mr_crop_name']."] " ?>
        <span><a href="<?php echo base_url('admin/crop-list'); ?>" class="btn btn-primary pull-right "><i class="fa fa-angle-double-left" aria-hidden="true"></i> Back to Crop List</a></span>
      </h1>
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
              <h3 style="margin-top: 0px">Variety
              <?php if($role_permission->is_add == 1){ ?>  
                <a href="<?php echo base_url('admin/create-variety/'.$crop_id); ?>" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Add Variety</a>
              <?php } ?>  
              </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="variety_table" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Variety Name</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                <?php 
                if(!empty($variety)){ 
                  $i = 1;
                ?>  
                <?php foreach($variety as $row) { ?>
                  <tr>
                    <td><?php echo $i++; ?></td>
                    <td>
                      <?php echo $row->en_name; ?><br>
                      <?php echo $row->hi_name; ?><br>
                      <?php echo $row->mr_name; ?>
                    </td>
                    <td style="display: inline-flex;">
                      <?php if($role_permission->is_edit == 1){ ?>
                        <a class="btn btn-sm btn-primary" href="<?php echo base_url('admin/edit-variety/'.$row->variety_id); ?>" style="margin-right: 5px;">
                          <i class="fa fa-edit"></i>
                        </a>
                      <?php } ?>  
                      <?php if($role_permission->is_delete == 1){ ?>  
                        <button data-i="<?php echo $row->variety_id; ?>" class="btn btn-sm btn-primary delete" style="margin-right: 5px;">
                          <i class="fa fa-trash"></i>
                        </button>
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
  <!-- /.content-wrapper -->
<!-- Modal -->
<div class="modal fade in" id="modalDel">
  <div class="modal-dialog" >
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Delete Confirmation</h4>
      </div>
      <form method="post" action="<?php echo base_url('admin/trash-variety'); ?>" id="frmDel">
        <div class="modal-body">
          <p>Are you sure you want to delete?</p>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="variety_id" value="">
          <input type="hidden" name="crop_id" value="<?php echo $crop_id; ?>">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         <input type="submit" class="btn btn-primary btnclass" value="Yes Delete!">
        </div>
      </form> 
    </div>
  </div>
</div>
<script src="<?=base_url('public');?>/components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?=base_url('public');?>/components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
  $(function(){
    $("#variety_table").DataTable();
  });
  $(document).ready(function(){
      $(document).on('click', '.delete', function(){
          var i = $(this).data('i');
          $("#frmDel input[name='variety_id']").val(i);
          $("#modalDel").modal('show');
      });
  });
</script>
