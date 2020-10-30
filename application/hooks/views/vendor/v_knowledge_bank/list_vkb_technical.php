<?php 
$uid = $this->session->userdata[SESSION_VENDOR]['vendor_id'];
$role_permission = $this->mastermodel->getPermission_vendor('KnowledgeBank',$uid); 
?>

<link rel="stylesheet" href="<?=base_url('public');?>/components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<?php
$subtopic_id = $this->uri->segment(3);
$obj=&get_instance();
$control_measure = $obj->v_knowledgebankmodel->get_all_technical($subtopic_id); 
$subtopic = $obj->v_knowledgebankmodel->get_kb_subtopic_by_id($subtopic_id); 
$topic = $obj->v_knowledgebankmodel->get_kb_topic_by_id($subtopic['topic_id']); 
$crop = $obj->cropmodel->get_crop_by_id($topic['crop_id']); 
?> 
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Crop Name : <?php echo $crop['en_crop_name']." [".$crop['hi_crop_name']."] [".$crop['mr_crop_name']."] " ?>
        <a href="<?php echo base_url('vendor/knowledge-bank-subtopic//'.$subtopic['topic_id']); ?>" class="btn btn-primary pull-right" > <i class="fa fa-angle-double-left" aria-hidden="true"></i>  Back to SubTopic</a>
      </h1>
      <h5><b>Topic : </b><?php echo $topic['en_name']." [".$topic['hi_name']."] [".$topic['mr_name']."]" ?></h5>
      <h5><b>SubTopic : </b> <?php echo $subtopic['en_title']." [".$subtopic['hi_title']."] [".$subtopic['mr_title']."]" ?></h5>
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
                <h3 style="margin-top: 0">Technical Name List
                <?php /*if($role_permission->is_add == 1){ ?>
                  <a href="<?php echo base_url('vendor/create-technical/'.$subtopic_id); ?>" class="btn btn-primary pull-right" ><i class="fa fa-plus"></i> Add Technical Name</a>
                <?php } */ ?>  
                </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="table" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Technical Name</th>
                    <!-- <th>Actions</th> -->
                  </tr>
                </thead>
                <tbody>
                <?php 
                if(!empty($control_measure)){ 
                  $i = 1;
                ?>  
                <?php foreach($control_measure as $row) { ?>
                  <tr>
                    <td><?php echo $i++; ?></td>
                    <td><img class=" img-responsive" src="<?php echo IMG_PATH.'control_measure/'.$row->image; ?>" style="height: 35px;">
                    </td>
                    <td>
                      <?php echo $row->en_technical_name; ?><br>
                        <?php echo $row->hi_technical_name; ?><br>
                        <?php echo $row->mr_technical_name; ?>
                    </td>
                    <td>
                        <?php /* if($role_permission->is_edit == 1){ ?>
                          <a class="btn btn-sm btn-primary" href="<?php echo base_url('vendor/edit-technical/'.$subtopic_id.'/'.$row->id); ?>">
                            <i class="fa fa-edit"></i>
                          </a>
                        <?php } ?>
                        <?php if($role_permission->is_delete == 1){ ?>  
                          <button data-i="<?php echo $row->id; ?>" class="btn btn-sm btn-primary delete">
                            <i class="fa fa-trash"></i>
                          </button>
                        <?php } */ ?>  
                        <a class="btn btn-sm btn-primary" href="<?php echo base_url('vendor/control-measure-list/'.$row->id); ?>">
                            Control Measure List
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
<!-- Modal -->
<div class="modal fade in" id="modalDel">
  <div class="modal-dialog" >
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Delete Confirmation</h4>
      </div>
      <form method="post" action="<?php echo base_url('vendor/trash-technical'); ?>" id="frmDel">
        <div class="modal-body">
          <p>Are you sure you want to delete?</p>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="subtopic_id" value="<?Php echo $subtopic_id; ?>">
          <input type="hidden" name="id" value="">
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
            $("#frmDel input[name='id']").val(i);
            $("#modalDel").modal('show');
        });
    });
</script>


