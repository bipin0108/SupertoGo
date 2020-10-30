<?php 
$uid = $this->session->userdata[SESSION_ADMIN]['admin_id'];
$role_permission = $this->mastermodel->getPermission('User',$uid);
?>
<link rel="stylesheet" href="<?=base_url('public');?>/components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<?php 
$buyer_id=$this->uri->segment(3);
$obj=&get_instance();
$buyer_name = $obj->usermodel->get_buyer_name($buyer_id); 
$buyer_rate = $obj->usermodel->get_buyer_rate($buyer_id); 
?> 
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Buyer Rate
      <h4><b><?php echo $buyer_name; ?></b></h4>
      </h1>
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
                    <th>Crop Name</th>
                    <th>Grade 1<br> Rate</th>
                    <th>Grade 2<br> Rate</th>
                    <th>Grade 3<br> Rate</th>
                    <th>Grade 4<br> Rate</th>
                    <th>Grade 5<br> Rate</th>
                    <th>Grade 6<br> Rate</th>
                  </tr>
                </thead>
                <tbody>
                <?php 
                if(!empty($buyer_rate)){ 
                  $i = 1;
                ?>  
                <?php foreach($buyer_rate as $row) { ?>
                  <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $row->crop_name; ?></td>
                    <td><?php echo !empty($row->grade_1)?$row->grade_1:'-'; ?></td>
                    <td><?php echo !empty($row->grade_2)?$row->grade_2:'-'; ?></td>
                    <td><?php echo !empty($row->grade_3)?$row->grade_3:'-'; ?></td>
                    <td><?php echo !empty($row->grade_4)?$row->grade_4:'-'; ?></td>
                    <td><?php echo !empty($row->grade_5)?$row->grade_5:'-'; ?></td>
                    <td><?php echo !empty($row->grade_6)?$row->grade_6:'-'; ?></td>
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


