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
                      <a class="btn btn-sm btn-primary" href="<?php echo base_url('vendor/knowledge-bank-topic/'.$row->crop_id); ?>">Knowledge Bank</a>
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


