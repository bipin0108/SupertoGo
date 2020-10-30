<?php 
$uid = $this->session->userdata[SESSION_ADMIN]['admin_id'];
$role_permission = $this->mastermodel->getPermission('Staticpage',$uid); 
?>

<link rel="stylesheet" href="<?=base_url('public');?>/components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<?php 
  $obj=&get_instance();
  $static_pages=$obj->staticpagemodel->get_all_static_pages();
?> 
<div class="content-wrapper">
  <section class="content-header">
    <h1>Static Pages
    </h1>
  </section>  
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
           <div class="box box-primary">
            <div class="box-header">
              <?php if(!empty($this->session->flashdata('success'))): ?>
              <div class="alert alert-success">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <span> <?php echo $this->session->flashdata('success'); ?> </span>
              </div>
              <?php endif ?>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="table" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Page Title</th>
                  <th>Page Url</th>
                  <th>Page Preview</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php if(!empty($static_pages)){ $Idx=1; ?>  
                <?php foreach($static_pages as $row) { ?>
                  <tr>
                    <td><?php echo $Idx++; ?></td>
                    <td><?php echo $row->page_title; ?></td>
                    <td><?php echo $row->page_slug; ?></td>
                    <td><a href="<?php echo base_url().$row->page_slug; ?>" target="_blank" class='btn btn-md btn-primary photo_remove' >Preview</a></td>
                    <td>
                      <?php if($role_permission->is_edit == 1){ ?>
                        <a class="btn btn-sm btn-primary" href="<?php echo base_url('admin/edit-static-pages/'.$row->id); ?>"><i class="fa fa-fw fa-edit"></i></a>
                      <?php } ?>  
                    </td>
                  </tr>                  
                <?php } ?>    
                <?php } else { ?>
                	<tr><td colspan="3">The Page is not available yet.</td></tr>
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

<script src="<?=base_url('public');?>/components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?=base_url('public');?>/components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
  $(function(){
    $("#table").DataTable();
  });
</script>
