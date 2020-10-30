<?php 
$uid = $this->session->userdata[SESSION_ADMIN]['admin_id'];
$role_permission = $this->mastermodel->getPermission('Vendor',$uid); 
?>

<link rel="stylesheet" href="<?=base_url('public');?>/components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="<?=base_url('public');?>/css/toggle_switch.css">
<?php 
$obj=&get_instance();
$vendormodel=$obj->vendormodel->get_all_vendor(); 
?> 
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Vendor</h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
           <div class="box box-primary">
            <div class="box-header">
              <?php if(!empty($this->session->flashdata('success'))): ?>
              <div class="alert alert-success">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <span> <?php echo $this->session->flashdata('success'); ?> </span>
              </div>
              <?php endif ?>
              <?php if(!empty($this->session->flashdata('error'))): ?>
              <div class="alert alert-success">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <span> <?php echo $this->session->flashdata('error'); ?> </span>
              </div>
              <?php endif ?>
              <?php if($role_permission->is_add == 1){ ?>
                <a href="<?php echo base_url('admin/create-vendor'); ?>" class="btn btn-primary pull-right" ><i class="fa fa-plus"></i> Add Vendor</a>
              <?php } ?>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="table" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S/R No.</th>
                  <th>Image</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Mobile No.</th>
                  <th>Address</th>
                  <th>Promocode</th>
                  <th>Is Active</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                if(!empty($vendormodel)){   
                  $i = 1;
                ?>  
                <?php foreach($vendormodel as $row) { ?>
                  <tr>
                    <td><?php echo $i++; ?></td>
                  <td>
                    <?php if($row->profile_image == ''){ ?>
                    <img class=" img-responsive" style="height:60px;width:60px" src="<?php echo DEFAULT_IMG_PATH; ?>">  
                    <?php }else{ ?>
                    <img class=" img-responsive" style="height:60px;width:60px" src="<?php echo IMG_PATH.'vendor_profiles/'.$row->profile_image; ?>">
                    <?php } ?>
                  </td>
                    <td><?php echo $row->name; ?></td>
                    <td><?php echo $row->email; ?></td>
                    <td><?php echo $row->mobile; ?></td>
                    <td><?php echo $row->address." ".$row->city_name." ".$row->state_name." ".$row->pincode; ?></td>
                    <td><?php echo $row->promocode; ?></td>
                    <td>
                        <label class="switch">
                          <?php 
                            if($row->is_active == '1'){
                              $checked = 'checked';
                            }else{
                              $checked = '';
                            } 
                           ?> 
                          <input type="checkbox"  <?php echo $checked; ?> class="active_deactive" 
                          data-is_value="<?php echo $row->is_active; ?>" data-i="<?php echo $row->vendor_id ?>"  >
                          <span class="slider round"></span>
                        </label>
                    </td>
                    <td>
                      <?php if($role_permission->is_edit == 1){ ?>
                        <a class="btn btn-sm btn-primary" href="<?php echo base_url('admin/edit-vendor/'.$row->vendor_id); ?>">
                          <i class="fa fa-edit"></i>
                        </a>
                      <?php } ?>
                      <?php if($role_permission->is_delete == 1){ ?>
                        <button data-i="<?php echo $row->vendor_id; ?>" class="btn btn-sm btn-primary delete">
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
      <form method="post" action="<?php echo base_url('admin/trash-vendor'); ?>" id="frmDel">
        <div class="modal-body">
          <p>Are you sure you want to delete?</p>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="vendor_id" value="">
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
            $("#frmDel input[name='vendor_id']").val(i);
            $("#modalDel").modal('show');
        });
        $(document).on('click', '.active_deactive', function(){
          var vendor_id = $(this).data('i');
          var is_value = $(this).data('is_value');
           $.ajax({
                 url:"<?php echo base_url(); ?>admin/vendor_active_deactive_ajax",
                 method:"POST",
                 data:{vendor_id:vendor_id,is_value:is_value},
                 success:function(data)
                 {
                      
                 }
            });
        });
  });
</script>


