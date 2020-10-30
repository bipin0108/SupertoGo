<link rel="stylesheet" href="<?=base_url('public');?>/components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<?php
  $obj=&get_instance();
  $kb_subcate=$obj->webinarmodel->get_all_webinar();
?> 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Webinar</h1>
      <br>
    </section>
    <!-- Main content --> 
    <section class="content">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
           <div class="box">
            <div class="box-header">
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="table" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Webinar Image</th>
                    <th>Title</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php 
                if(!empty($kb_subcate)){ 
                  $i = 1;
                ?>  
                <?php foreach($kb_subcate as $row) { ?>
                  <tr>
                    <td><?php echo $i++; ?></td>
                    <td>
                       <img height="55px" src="<?php echo IMG_PATH.'webinar/'.$row->base_image; ?>"  >
                    </td>
                    <td>
                        <?php echo $row->en_title; ?><br>
                        <?php echo $row->hi_title; ?><br>
                        <?php echo $row->mr_title; ?>
                    </td>
                    <td>
                        <a class="btn btn-sm btn-primary" href="<?php echo base_url('vendor/view-webinar/'.$row->id); ?>">
                          <i class="fa fa-eye"></i>
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
<!-- DataTables -->
<script src="<?=base_url('public');?>/components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?=base_url('public');?>/components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
  $(function(){
    $("#table").DataTable();
  });
</script>


