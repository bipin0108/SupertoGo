<?php 
$uid = $this->session->userdata[SESSION_ADMIN]['admin_id'];
$role_permission = $this->mastermodel->getPermission('KnowledgeBank',$uid); 
?>

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
      <a href="<?php echo base_url('admin/knowledge-bank-list'); ?>" class="btn btn-primary pull-right" > <i class="fa fa-angle-double-left" aria-hidden="true"></i>  Back to Crop list</a>
      </h1>
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
              <h3 style="margin-top: 0">
                Topic
                <?php if($role_permission->is_add == 1){ ?>
                  <a href="<?php echo base_url('admin/create-knowledge-bank-topic/'.$crop_id); ?>" class="btn btn-primary pull-right" ><i class="fa fa-plus"></i> Add Topic</a>
                <?php } ?>
              </h3>
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
                        <?php if($role_permission->is_edit == 1){ ?>
                          <a class="btn btn-sm btn-primary" href="<?php echo base_url('admin/edit-knowledge-bank-topic/'.$crop_id.'/'.$row->id); ?>">
                            <i class="fa fa-edit"></i>
                          </a>
                        <?php } ?>
                        <?php if($role_permission->is_delete == 1){ ?>
                          <button data-i="<?php echo $row->id; ?>" class="btn btn-sm btn-primary delete">
                            <i class="fa fa-trash"></i>
                          </button>
                        <?php } ?>
                        <?php if($role_permission->is_view == 1){ ?>
                          <a class="btn btn-sm btn-primary" href="<?php echo base_url('admin/knowledge-bank-subtopic/'.$row->id); ?>">
                            Sub Topic
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
<!-- Modal -->
<div class="modal fade in" id="modalDel">
  <div class="modal-dialog" >
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Delete Confirmation</h4>
      </div>
      <form method="post" action="<?php echo base_url('admin/trash-knowledge-bank-topic'); ?>" id="frmDel">
        <div class="modal-body">
          <p>Are you sure you want to delete?</p>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="crop_id" value="<?Php echo $crop_id; ?>">
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


