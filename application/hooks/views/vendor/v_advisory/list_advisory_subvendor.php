<?php 
$uid = $this->session->userdata[SESSION_VENDOR]['vendor_id'];
$created_by = $this->session->userdata[SESSION_VENDOR]['created_by'];
$role_permission = $this->mastermodel->getPermission_vendor('Advisory',$uid); 
?>
<link rel="stylesheet" href="<?=base_url('public');?>/components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<style type="text/css">
  .nav-tabs-custom>.nav-tabs>li.active>a, .nav-tabs-custom>.nav-tabs>li.active:hover>a {
    background-color: #00968861;
    color: #444;
}
.nav-tabs-custom>.nav-tabs>li>a, .nav-tabs-custom>.nav-tabs>li>a:hover {
    font-size: 16px;
}
</style>
<?php 
$obj=&get_instance();
$advisory_status = array('New','Ongoing','Followup','Closed');
?> 
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Expert Advisory Request</h1>  
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
                  <?php foreach ($advisory_status as $idx => $ad_status) { ?>
                      <li class="<?php echo ($idx == 0) ? 'active' : ''; ?>" >
                        <a href="#<?php echo $ad_status?>" data-toggle="tab" >
                          <?php echo $ad_status; ?>
                        </a>
                      </li>   
                  <?php } ?>
                </ul>
                <div class="tab-content">
                  <?php $i=0; foreach ($advisory_status as $idx => $ad_status) { 
                    $i++;
                    $request_data = $obj->v_advisorymodel->get_advisory_request_subvendor($ad_status);  
                  ?>
                  <div class="tab-pane <?php echo ($idx == 0) ? 'active' : ''; ?>" id="<?php echo $ad_status?>" >
                    <!-- start table -->
                    <div class="table-responsive">
                        <table id="table_<?php echo $ad_status?>" class="table table-bordered table-striped">
                          <thead>
                            <tr>
                              <th>ID</th>
                              <th>Raised On</th>
                              <th>Farmer Name</th>
                              <th>Ticket</th>
                              <th>Plot Name</th>
                              <th>Crop Name</th>
                              <th>Problem Area Name</th>
                              <th>First Irrigation Date</th>
                              <th>Actions</th>
                            </tr>
                          </thead>
                          <tbody>
                          <?php 
                          if(!empty($request_data)){ 
                            $i = 1;
                          ?>  
                          <?php foreach($request_data as $row) { ?>
                            <tr>
                              <td><?php echo $i++; ?></td>
                              <td><?php echo date("d M, Y h:i A",strtotime($row->raised_on)); ?></td>
                              <td><?php echo $row->farmer_name; ?></td>
                              <td><?php echo $row->request_ticket; ?></td>
                              <td><?php echo $row->plot_name; ?></td>
                              <td><?php echo $row->crop_name; ?></td>
                              <td><?php echo $row->problem_area_name; ?></td>
                              <td><?php echo date("d M, Y",strtotime($row->first_irrigation_date)); ?></td>
                              <td style="display: inline-flex;">
                                <?php if($role_permission->is_view == 1){ ?>
                                  <a class="btn btn-sm btn-primary" href="<?php echo base_url('vendor/view-advisory-request/'.$row->advisory_id); ?>" style="margin-right: 5px;">
                                    <i class="fa fa-eye"></i>
                                  </a>
                                <?php } ?>    
                              </td>
                            </tr>                  
                          <?php } ?>    
                          <?php } ?>
                          </tbody>
                        </table>
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
<!-- DataTables -->
<script src="<?=base_url('public');?>/components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?=base_url('public');?>/components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
  $(function(){
    $("#table_New").DataTable();
    $("#table_Ongoing").DataTable();
    $("#table_Followup").DataTable();
    $("#table_Closed").DataTable();
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


