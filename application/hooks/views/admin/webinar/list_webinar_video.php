<?php 
  $uid = $this->session->userdata[SESSION_ADMIN]['admin_id'];
  $role_permission = $this->mastermodel->getPermission('Webinar',$uid); 
?>
<link rel="stylesheet" href="<?=base_url('public');?>/components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<?php
  $obj=&get_instance();
  $webinar_id = $this->uri->segment(3);
  $video=$obj->webinarmodel->get_all_sub_video($webinar_id);
  $webinar = $obj->webinarmodel->get_webinar_by_id($webinar_id);
?> 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Webinar Video Series
         <a href="<?php echo base_url('admin/webinar-list/'); ?>" class="btn btn-primary pull-right" ><i class="fa fa-angle-double-left" aria-hidden="true"></i>   Back to Webinar</a>
      </h1>
      <h5><b>Webinar Name : </b> <?php echo $webinar['en_title']." [".$webinar['hi_title']."] [".$webinar['mr_title']."]" ?></h5>
      <br>
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
              <?php if($role_permission->is_add == 1){ ?>
                <a href="<?php echo base_url('admin/create-webinar-video/'.$webinar_id); ?>" class="btn btn-primary pull-right" ><i class="fa fa-plus"></i> Add Video</a>
              <?php } ?>  
              </h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="table" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Video Link</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php 
                if(!empty($video)){ 
                  $i = 1;
                ?>  
                <?php foreach($video as $row) { ?>
                  <tr>
                    <td><?php echo $i++; ?></td>
                    <td>
                        <?php echo $row->en_link; ?><br>
                        <?php echo $row->hi_link; ?><br>
                        <?php echo $row->mr_link; ?>
                    </td>
                    <td>
                      <?php if($role_permission->is_edit == 1){ ?>
                        <a class="btn btn-sm btn-primary" href="<?php echo base_url('admin/edit-webinar-video/'.$row->id); ?>"><i class="fa fa-edit"></i></a>
                      <?php } ?>  
                      <?php if($role_permission->is_delete == 1){ ?>  
                        <button data-i="<?php echo $row->id; ?>" class="btn btn-sm btn-primary delete">
                          <i class="fa fa-trash"></i></button>
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
      <form method="post" action="<?php echo base_url('admin/trash-webinar-video'); ?>" id="frmDel">
        <div class="modal-body">
          <p>Are you sure you want to delete?</p>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="id" value="">
          <input type="hidden" name="webinar_id" value="<?php  echo $webinar_id; ?>">
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


