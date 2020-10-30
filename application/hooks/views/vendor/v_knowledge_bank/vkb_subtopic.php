<link rel="stylesheet" href="<?=base_url('public');?>/components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<?php
$topic_id = $this->uri->segment(3);
$obj=&get_instance();
$kb_subcate=$obj->knowledgebankmodel->get_all_kb_subtopic($topic_id); 
$topic = $obj->knowledgebankmodel->get_kb_topic_by_id($topic_id);
$crop = $obj->cropmodel->get_crop_by_id($topic['crop_id']); 
?> 
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Crop Name : <?php echo $crop['en_crop_name']." [".$crop['hi_crop_name']."] [".$crop['mr_crop_name']."]" ?>
      <a href="<?php echo base_url('vendor/knowledge-bank-topic/'.$topic['crop_id']); ?>" class="btn btn-primary pull-right" > <i class="fa fa-angle-double-left" aria-hidden="true"></i>  Back to Topic List</a>
      </h1>
      <h5><b>Topic :</b> <?php echo $topic['en_name']." [".$topic['hi_name']."] [".$topic['mr_name']."]" ?></h5>
    </section>
    <!-- Main content --> 
    <section class="content">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
           <div class="box box-primary">
            <div class="box-header">
               <h3 style="margin-top: 0px">SubTopic</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="table" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Sub Topic Title</th>
                    <th>Actions</th>
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
                        <?php echo $row->en_title; ?><br>
                        <?php echo $row->hi_title; ?><br>
                        <?php echo $row->mr_title; ?>
                    </td>
                    <td>
                        <a class="btn btn-sm btn-primary" href="<?php echo base_url('vendor/view-knowledge-bank-subtopic/'.$topic_id.'/'.$row->id); ?>">
                          <i class="fa fa-eye"></i>
                        </a>
                        <a class="btn btn-sm btn-primary" href="<?php echo base_url('vendor/control-measure-list/'.$row->id); ?>">
                          Control Measure
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


