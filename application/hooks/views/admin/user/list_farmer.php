<?php 
  $uid = $this->session->userdata[SESSION_ADMIN]['admin_id'];
  $role_permission = $this->mastermodel->getPermission('User',$uid);
?>
<link rel="stylesheet" href="<?=base_url('public');?>/components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<?php 
$obj=&get_instance();
$farmers=$obj->usermodel->get_all_farmer(); 
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
                    <th>Vendor Name</th>
                    <th>Birth Date</th>
                    <th>Address</th>
                    <th>Action</th>
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
                      <?php if($row->profile_pic== ''){ ?>
                      <img class=" img-responsive" style="height:40px;width:40px" src="<?php echo DEFAULT_IMG_PATH; ?>">  
                      <?php }else{ ?>
                      <img class=" img-responsive" style="height:40px;width:40px" src="<?php echo IMG_PATH.'user_profiles/'.$row->profile_pic; ?>">
                      <?php } ?>
                    </td>
                    <td><?php echo $row->first_name.' '.$row->middle_name.' '.$row->last_name; ?></td>
                    <td><?php echo $row->mobile; ?></td>
                    <td><?php echo $row->gender; ?></td>
                    <td><?php echo $row->vendor_name; ?></td>
                    <td><?php echo date("d F, Y",strtotime($row->birth_date)); ?></td>
                    <td><?php echo implode(', ', $address); ?></td>
                    <td style="display: inline-flex;">
                      <?php if($role_permission->is_view == 1){ ?>
                        <a class="btn btn-md btn-primary" href="<?php echo base_url('admin/farmer-profile/'.$row->user_id); ?>">
                         Profile
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
<!-- DataTables -->
<script src="<?=base_url('public');?>/components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?=base_url('public');?>/components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
  $(function(){
    $("#table").DataTable();
  });
</script>


