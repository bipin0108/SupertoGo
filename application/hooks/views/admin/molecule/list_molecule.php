<?php 
$uid = $this->session->userdata[SESSION_ADMIN]['admin_id'];
$role_permission = $this->mastermodel->getPermission('Molecule',$uid); 
?>
<link rel="stylesheet" href="<?=base_url('public');?>/components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<style type="text/css">
  .nav-tabs-custom>.nav-tabs>li.active>a, .nav-tabs-custom>.nav-tabs>li.active:hover>a {
    background-color: #00968861;
    color: #444;
}
</style>
<?php 
$obj=&get_instance();
$activity_arr = $obj->moleculemodel->get_all_activity();
?> 
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Molecule</h1>  
    </section>
    <!-- Main content --> 
    <section class="content">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
           <div class="box box-primary">
            <div class="box-header">
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <?php if(!empty($this->session->flashdata('success'))): ?>
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <span> <?php echo $this->session->flashdata('success'); ?> </span>
                    </div>
                    <?php endif ?>
                    <?php if(!empty($this->session->flashdata('error'))): ?>
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <span> <?php echo $this->session->flashdata('error'); ?> </span>
                    </div>
                  <?php endif ?>
              <!-- start tab view -->
              <div class="nav-tabs-custom" id="element_overlap1">
                <ul class="nav nav-tabs"  id="myTab">
                  <?php foreach ($activity_arr as $idx => $activity) { ?>
                      <li class="<?php echo ($idx == 0) ? 'active' : ''; ?>" >
                      <a href="#<?php echo $activity->slug ?>" data-toggle="tab" >
                        <?php echo $activity->en_act_name; ?>
                      </a>
                    </li>   
                  <?php } ?>
                </ul>
                <div class="tab-content">
                  <?php $i=0; foreach ($activity_arr as $idx => $activity) { 
                    $i++;
                    $molecule_data = $this->moleculemodel->get_molecule_by_activity_type($activity->en_act_name);
                  ?>
                  <div class="tab-pane <?php echo ($idx == 0) ? 'active' : ''; ?>" id="<?php echo $activity->slug ?>" >
                    <h3 style="margin:5px 0 5px 0;">Molecule of <?php echo $activity->en_act_name; ?>
                      <?php if(count($molecule_data) > 0){ ?>
                        <?php if($role_permission->is_delete == 1){ ?>
                          <a class="btn btn-primary pull-right delete" data-i="<?php echo $activity->en_act_name; ?>" >
                            <i class="fa fa-trash"></i> Remove Molecule
                          </a>
                        <?php } ?>  
                      <?php }else{ ?>
                        <?php if($role_permission->is_add == 1){ ?>
                          <a href="<?php echo base_url('admin/create-molecule/'.$activity->slug); ?>" class="btn btn-primary pull-right" style="margin-right: 5px;">
                            <i class="fa fa-plus"></i> Add Molecule
                          </a>
                        <?php } ?>  
                      <?php } ?>  
                    </h3>
                    <hr/>
                    <!-- start table -->
                    <div class="table-responsive">
                        <table id="table_<?php echo $activity->slug ?>" class="table table-bordered table-striped">
                          <thead>
                            <tr>
                              <th>ID</th>
                              <th>Problem Type</th>
                              <th>Problem</th>
                              <th>Problem Area</th>
                              <th>Technical Name</th>
                              <th>Dose</th>
                              <th>Unit</th>
                              <th>Per</th>
                              <th>Brand Name</th>
                              <th>Safeness for Honey Bee</th>
                              <th>Actions</th>
                            </tr>
                          </thead>
                          <tbody>
                          <?php 
                          if(!empty($molecule_data)){   
                            $i = 1;
                          ?>  
                          <?php foreach($molecule_data as $row) { ?>
                            <tr>
                              <td><?php echo $i++; ?></td>
                              <td>
                                <?php echo $row->en_problem_type; ?><br>
                                <?php echo $row->hi_problem_type; ?><br>
                                <?php echo $row->mr_problem_type; ?>
                              </td>
                              <td>
                                <?php echo $row->en_problem; ?><br>
                                <?php echo $row->hi_problem; ?><br>
                                <?php echo $row->mr_problem; ?>
                              </td>
                              <td>
                                <?php echo $row->en_problem_area; ?><br>
                                <?php echo $row->hi_problem_area; ?><br>
                                <?php echo $row->mr_problem_area; ?>
                              </td>
                              <td>
                                <?php echo $row->en_technical_name; ?><br>
                                <?php echo $row->hi_technical_name; ?><br>
                                <?php echo $row->mr_technical_name; ?>
                              </td>
                              <td>
                                <?php echo $row->en_dose; ?>
                              </td>
                              <td>
                                <?php echo $row->en_unit; ?><br>
                                <?php echo $row->hi_unit; ?><br>
                                <?php echo $row->mr_unit; ?>
                              </td>
                              <td>
                                <?php echo $row->en_per; ?><br>
                                <?php echo $row->hi_per; ?><br>
                                <?php echo $row->mr_per; ?>
                              </td>
                              <td>
                                <?php echo $row->en_brand; ?><br>
                                <?php echo $row->hi_brand; ?><br>
                                <?php echo $row->mr_brand; ?>
                              </td>
                              <td>
                                <?php echo $row->en_safeness_for_honey_bee; ?><br>
                                <?php echo $row->hi_safeness_for_honey_bee; ?><br>
                                <?php echo $row->mr_safeness_for_honey_bee; ?>
                              </td>
                              <td style="display: inline-flex;">
                                <?php if($role_permission->is_edit == 1){ ?>
                                    <a class="btn btn-sm btn-primary" href="<?php echo base_url('admin/edit-molecule/'.$row->id); ?>" style="margin-right: 5px;">
                                      <i class="fa fa-edit"></i>
                                    </a>
                                  <?php } ?>
                              </td>
                            </tr>                  
                          <?php } ?>    
                          <?php } ?>
                          </tbody>
                        </table>
                        <script type="text/javascript">
                          $(function(){
                            $("#table_<?php echo $activity->slug ?>").DataTable();
                          });
                        </script>
                      </div>   
                    <!-- end table -->
                  </div>  
                <?php } ?>
                </div>  
              </div>  
              <!-- end tab view -->
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
      <form method="post" action="<?php echo base_url('admin/trash-molecule'); ?>" id="frmDel">
        <div class="modal-body">
          <p>Are you sure you want to delete molecule for <b><span id="msg_activity_type"></span></b> Activity ?</p>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="activity_type" value="">
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
  $(document).ready(function(){
      $(document).on('click','.delete', function(){
          var activity_type = $(this).data('i');
          $("#frmDel input[name='activity_type']").val(activity_type);
          $("#msg_activity_type").text(activity_type);
          $("#modalDel").modal('show');
      });
    });
</script>
<script type="text/javascript">
$(document).ready(function(){
    $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
        localStorage.setItem('activeTab', $(e.target).attr('href'));
    });
    var activeTab = localStorage.getItem('activeTab');
    if(activeTab){
        $('#myTab a[href="' + activeTab + '"]').tab('show');
    }
});
</script>


