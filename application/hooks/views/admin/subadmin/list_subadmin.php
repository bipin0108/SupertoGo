<link rel="stylesheet" href="<?=base_url('public');?>/components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="<?=base_url('public');?>/css/toggle_switch.css">
<?php 
$obj=&get_instance();
$subadmin=$obj->subadminmodel->get_all_subadmin(); 
?> 
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Subadmin</h1>
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
             <a href="<?php echo base_url('admin/create-subadmin'); ?>" class="btn btn-primary pull-right" >Add</a>
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
                  <th>Is Active</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                if(!empty($subadmin)){   
                  $i = 1;
                ?>  
                <?php foreach($subadmin as $row) { ?>
                  <tr>
                    <td><?php echo $i++; ?></td>
                    <td>
                      <?php if($row->profile_image == ''){ ?>
                      <img class="img-responsive" style="height:40px;width:40px" src="<?php echo DEFAULT_IMG_PATH; ?>">  
                      <?php }else{ ?>
                      <img class="img-responsive" style="height:40px;width:40px" src="<?php echo IMG_PATH.'profiles/'.$row->profile_image; ?>">
                      <?php } ?>
                    </td>
                    <td><?php echo $row->name; ?></td>
                    <?php /*<td><?php echo $row->role_name; ?></td> */ ?>
                    <td><?php echo $row->email; ?></td>
                    <td><?php echo $row->mobile; ?></td>
                    <td><?php echo $row->address."<br> [".$row->village.", ".$row->district.", ".$row->city.", ".$row->state.", ".$row->pincode."]"; ?></td>
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
                          data-is_value="<?php echo $row->is_active; ?>" data-i="<?php echo $row->admin_id ?>"  >
                          <span class="slider round"></span>
                        </label>
                    </td>
                    <td style="display: inline-flex;">
                      <a class="btn btn-sm btn-primary mr-5" href="<?php echo base_url('admin/role-permission/'.$row->admin_id); ?>">
                        <i class="fa fa-unlock"></i>
                      </a>
                      <a class="btn btn-sm btn-primary mr-5" href="<?php echo base_url('admin/edit-subadmin/'.$row->admin_id); ?>">
                        <i class="fa fa-edit"></i>
                      </a>
                      <button data-i="<?php echo $row->admin_id; ?>" class="btn btn-sm btn-primary  mr-5 delete">
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
      <form method="post" action="<?php echo base_url('admin/trash-subadmin'); ?>" id="frmDel">
        <div class="modal-body">
          <p>Are you sure you want to delete?</p>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="admin_id" value="">
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
            $("#frmDel input[name='admin_id']").val(i);
            $("#modalDel").modal('show');
        });
        $(document).on('click', '.active_deactive', function(){
          var admin_id = $(this).data('i');
          var is_value = $(this).data('is_value');
           $.ajax({
                 url:"<?php echo base_url(); ?>admin/subadmin_active_deactive_ajax",
                 method:"POST",
                 data:{admin_id:admin_id,is_value:is_value},
                 success:function(data)
                 {
                      
                 }
            });
        });
  });
</script>


