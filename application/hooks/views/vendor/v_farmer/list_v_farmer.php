<?php 
    $uid = $this->session->userdata[SESSION_VENDOR]['vendor_id'];
    $created_by = $this->session->userdata[SESSION_VENDOR]['created_by'];
    $role_permission = $this->mastermodel->getPermission_vendor('Farmer',$uid); 
?>
<link rel="stylesheet" href="<?=base_url('public');?>/components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<?php 
  $obj=&get_instance();
  if($created_by == 0 )
  {
    $farmers=$obj->v_usermodel->get_all_farmer(); 
  }
  else
  {
    $farmers=$obj->v_usermodel->get_all_farmer_by_subvendor(); 
  }
  
?> 
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Farmer</h1>
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
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="table" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Gender</th>
                    <th>Area</th>
                    <?php if($created_by == 0 ){ ?>
                    <th>Assign To [Vendor Name]</th>
                    <th>Action</th>
                    <?php } ?> 
                  </tr>
                </thead>
                <tbody>
                <?php 
                if(!empty($farmers)){ 
                  $i = 1;
                ?>  
                <?php foreach($farmers as $row) { 
                  $address = array();
                  if(!empty($row->village)){
                    array_push($address, $row->village);
                  }
                  if(!empty($row->city)){
                    array_push($address, $row->city);
                  }
                  if(!empty($row->district)){
                    array_push($address, $row->district);
                  }
                  if(!empty($row->state)){
                    array_push($address, $row->state);
                  }
                  array_push($address, $row->pincode);
                ?>
                  <tr>
                    <td><?php echo $i++; ?></td>
                    <td>
                      <?php if($row->profile_pic == ''){ ?>
                      <img class=" img-responsive" style="height:50px;width:50px" src="<?php echo DEFAULT_IMG_PATH; ?>">  
                      <?php }else{ ?>
                      <img class=" img-responsive" style="height:50px;width:50px" src="<?php echo IMG_PATH.'user_profiles/'.$row->profile_pic; ?>">
                      <?php } ?>
                    </td>
                    <td><?php echo $row->first_name.' '.$row->middle_name.' '.$row->last_name; ?></td>
                    <td><?php echo $row->mobile; ?></td>
                    <td><?php echo $row->gender; ?></td>
                    <td><?php echo implode(', ', $address); ?></td>
                    <?php if($created_by == 0 ){ ?>
                      <?php if($row->assign_subvendor_id != '0'){ ?>
                      <?php   
                        $abc = $row->assign_subvendor_id;
                        $v_name = $obj->mastermodel->get_field_val('vendor_id',$abc,'s_vendor','name'); 
                      ?>  
                      <td><?php echo $v_name; ?></td>
                      <?php }else{ ?>
                      <td></td>  
                      <?php } ?>
                    <td style="display: inline-flex;">
                      <?php if($role_permission->is_add == 1){ ?>
                        <button data-i="<?php echo $row->user_id; ?>" class="btn btn-md btn-primary assign_farmer mr-5">
                            Assign
                        </button>
                      <?php } ?>  
                      <?php if($role_permission->is_view == 1){ ?>
                        <a class="btn btn-md btn-primary mr-5" href="<?php echo base_url('vendor/farmer-profile/'.$row->user_id); ?>">
                         Profile
                        </a>
                      <?php } ?>
                    </td>  
                    <?php } ?>
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
<!-- DataTables -->
<?php 
$v_subadmin=$obj->v_subadminmodel->get_all_vendor_subadmin();
?>
<!-- Modal -->
<div class="modal fade in" id="modalAssign">
  <div class="modal-dialog" >
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Assign Farmer</h4>
      </div>
      <form method="post" action="<?php echo base_url('vendor/assign-farmer-to-subvendor'); ?>" id="frmAssign">
        <div class="modal-body">
          <input type="hidden" name="user_id" value="">
          <div class="form-group">
            <label>Sub Vendor</label>
            <select name="sub_vendor" class="form-control" id="sub_vendor" required>
              <option value="">Select Sub Vendor</option>
              <option value="<?php echo $this->session->userdata[SESSION_VENDOR]['vendor_id'] ?>">Main Vendor</option>  
              <?php foreach ($v_subadmin as $row) { ?>
                <option value="<?php echo $row->vendor_id; ?>" <?php echo (set_value('sub_vendor')==$row->vendor_id)?'selected':'' ?> >
                  <?php echo $row->name; ?>
                </option>
              <?php } ?>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         <input type="submit" class="btn btn-primary btnclass" value="Assign">
        </div>
      </form>
    </div>
  </div>
</div>
<!-- end -->
<script src="<?=base_url('public');?>/components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?=base_url('public');?>/components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
  $(function(){
    $("#table").DataTable();
  });
  $(document).ready(function(){
      $(document).on('click', '.assign_farmer', function(){
          var i = $(this).data('i');
          $("#frmAssign input[name='user_id']").val(i);
          $("#modalAssign").modal('show');
      });
  });
</script>


