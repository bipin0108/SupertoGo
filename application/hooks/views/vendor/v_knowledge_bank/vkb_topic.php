<link rel="stylesheet" href="<?=base_url('public');?>/components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<?php
$crop_id = $this->uri->segment(3);
$obj=&get_instance();
$kb_topic=$obj->knowledgebankmodel->get_all_kb_topic($crop_id); 

$crop = $obj->cropmodel->get_crop_by_id($crop_id); 
?> 
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Crop Name: <?php echo $crop['en_crop_name']." [".$crop['hi_crop_name']."] [".$crop['mr_crop_name']."]" ?>
      <a href="<?php echo base_url('vendor/knowledge-bank-list'); ?>" class="btn btn-primary pull-right" ><i class="fa fa-angle-double-left" aria-hidden="true"></i>   Back to Crop list</a>
      </h1>
    </section>
    <!-- Main content --> 
    <section class="content">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
           <div class="box box-primary">
            <div class="box-header">
              <h3 style="margin-top: 0px">Topic</h3>
              <?php if(!empty($this->session->flashdata('success'))): ?>
              <div class="alert alert-success">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <span> <?php echo $this->session->flashdata('success'); ?> </span>
              </div>
              <?php endif ?>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="table" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Topic Title</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                <?php 
                if(!empty($kb_topic)){ 
                  $i = 1;
                ?>  
                <?php foreach($kb_topic as $row) { ?>
                  <tr>
                    <td><?php echo $i++; ?></td>
                    <td>
                        <?php echo $row->en_name; ?><br>
                        <?php echo $row->hi_name; ?><br>
                        <?php echo $row->mr_name; ?>
                    </td>
                    <td>
                        <a class="btn btn-sm btn-primary" href="<?php echo base_url('vendor/knowledge-bank-subtopic/'.$row->id); ?>">
                          Sub Topic
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


