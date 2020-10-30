<link rel="stylesheet" href="<?=base_url('public');?>/components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="<?=base_url('public');?>/components/bootstrap-datepicker/dist/css/
bootstrap-datepicker.min.css">
<?php 
 $obj=&get_instance();
 $farmer_id = $this->uri->segment(3);
 $farmer = $obj->usermodel->get_farmer_by_id($farmer_id);
 $plots = $obj->usermodel->get_plot_of_farmer($farmer_id);
 // print_r($plots);
 // die;
 ?>
<style type="text/css">
  .label_val{padding:0px 8px;}
  .nav-tabs-custom#element_overlap1>.nav-tabs>li.active>a, .nav-tabs-custom#element_overlap1>.nav-tabs>li.active:hover>a {background-color: #00968861 !important;color: #444 !important;}
  .nav-tabs-custom#element_overlap1>.nav-tabs>li>a, .nav-tabs-custom#element_overlap1>.nav-tabs>li>a:hover{font-size: 17px !important;} 
  .nav-tabs-custom#element_overlap1{box-shadow: 0 1px 1px rgba(0,0,0,0.1);}
  #inner_tabview .nav-tabs-custom>.nav-tabs>li.active>a,#inner_tabview .nav-tabs-custom>.nav-tabs>li.active:hover>a {background-color: #ddd !important;color: #000 !important;}
  #inner_tabview .nav-tabs-custom>.nav-tabs>li>a,#inner_tabview .nav-tabs-custom>.nav-tabs>li>a:hover{font-size: 14px !important;} 
  #inner_tabview .nav-tabs-custom>.nav-tabs>li.active {border: 2px solid #333;}
  #inner_tabview .nav-tabs-custom{box-shadow: 0 1px 1px rgba(0,0,0,0.1);}
</style>
<!-- Content Wrapper. Contains page content --> 
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Farmer Profile
      <a href="<?php echo base_url('vendor/farmer-list') ?>" class="btn btn-primary pull-right">Back to Farmer List</a>
    </h1>
  </section>
  <!-- start edit SubTopic form -->
  <section class="content">
    <!-- request detail -->
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title pull-left"><b><i class="fa fa-hand-o-right" aria-hidden="true"></i> Farmer Detail</b></h3>
          </div>
          <!-- START edit SubTopic form -->
          <div class="box-body">
              <div class="col-md-12">
                <div class="col-md-2">
                  <?php if($farmer->profile_pic == ''){ ?>
                    <img class="profile-user-img img-responsive img-circle" style="height:100px;width:100px" src="<?php echo DEFAULT_IMG_PATH; ?>">  
                    <?php }else{ ?>
                    <img class="profile-user-img img-responsive img-circle" style="height:100px;width:100px" src="<?php echo IMG_PATH.'user_profiles/'.$farmer->profile_pic; ?>">
                  <?php } ?>
                </div>  
                <div class="col-md-5">
                  <label>Name :</label><span class="label_val"><?php echo $farmer->first_name." ".$farmer->middle_name." ".$farmer->last_name; ?></span><br>
                  <label>Mobile :</label><span class="label_val"><?php echo $farmer->mobile; ?></span><br>
                  <?php $address = $farmer->village." ".$farmer->city." ".$farmer->district." ".$farmer->state." ".$farmer->pincode; ?>
                  <label>Address :</label><span class="label_val"><?php echo $address; ?></span>
                </div>  
                <div class="col-md-5">
                  <label>Gender :</label><span class="label_val"><?php echo $farmer->gender; ?></span><br>
                  <label>Birth Date :</label><span class="label_val"><?php echo date("d M, Y ",strtotime($farmer->birth_date)); ?></span>
                </div> 
              </div>
          </div>
        </div>
        <!-- end -->
      </div> 
    </div>
    <?php if(count($plots) > 0){?>
    <!-- start tab view -->
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
        <div class="box box-primary">
          <div class="box-header">
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <!-- start tab view -->
            <div class="nav-tabs-custom" id="element_overlap1">
              <ul class="nav nav-tabs"  id="myTab" style="box-shadow: 0 0px 0px rgba(0,0,0,0.1) !important;">
                <?php foreach ($plots as $idx => $plot) { ?>
                    <li class="<?php echo ($idx == 0) ? 'active' : ''; ?>" >
                      <a href="#plot_<?php echo $plot->plot_id ?>" data-toggle="tab" ><?php echo $plot->plot_name; ?></a>
                    </li>   
                <?php } ?>
              </ul>
              <div class="tab-content">
                <?php $i=0; foreach ($plots as $idx => $plot) {  $plot_id = $plot->plot_id; $i++; ?>
                <div class="tab-pane <?php echo ($idx == 0) ? 'active' : ''; ?>" id="plot_<?php echo $plot->plot_id ?>" >
                  <!-- start -->
                  <?php echo $plot_name; ?>
                  <div class="row" id="inner_tabview">
                    <div class="col-md-12">  
                      <!-- start tab view -->
                      <div class="nav-tabs-custom" id="plot_<?php echo $plot_id; ?>_main" class="my_tab">
                        <ul class="nav nav-tabs"  id="plot_tab_<?php echo $plot_id; ?>" >
                          <li class="active"><a href="#plot_detail_<?php echo $plot_id ?>" data-toggle="tab">Plot Detail</a></li>
                          <li><a href="#schedule_<?php echo $plot_id ?>" data-toggle="tab">Schedule</a></li>
                          <li><a href="#advisory_<?php echo $plot_id ?>" data-toggle="tab">Advisory History</a></li>
                          <li><a href="#weekly_images_<?php echo $plot_id ?>" data-toggle="tab">Weekly Images</a></li>
                        </ul> 
                        <div class="tab-content">
                        <!-- start tab content -->
                          <!-- Plot Detail --> 
                          <div class="tab-pane active" id="plot_detail_<?php echo $plot_id ?>">
                            <?php $detail=$obj->usermodel->get_plot_detail($plot_id); ?>
                            <!-- start -->
                            <div class="row">
                              <div class="col-md-12">
                                <div class="col-md-6">
                                  <div class="table-responsive">
                                    <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                          <td><b>Crop Name</b></td>
                                          <td><?php echo $detail['crop_name']." [".$detail['variety_name']."]"; ?></td>
                                        </tr>
                                        <tr>
                                          <td><b>Plot Area</b></td>
                                          <td><?php echo $detail['area_of_plot']." ".$detail['plot_area_unit_name']; ?></td>
                                        </tr>
                                        <tr>
                                          <td><b>Address</b></td>
                                          <td><?php echo $detail['village'].", ".$detai['city'].", ".$detail['district'].", ".$detail['state']." ".$detail['pincode']; ?></td>
                                        </tr>
                                        <tr>
                                          <td><b>Total Plant</b></td>
                                          <td><?php echo $detail['num_of_plant']; ?></td>
                                        </tr>
                                        <tr>
                                          <td><b>Planting Date</b></td>
                                          <td><?php echo date("d M, Y",strtotime($detail['planting_date'])); ?></td>
                                        </tr>
                                        <tr>
                                          <td><b>First Irrigation Date</b></td>
                                          <td><?php echo date("d M, Y",strtotime($detail['first_irrigation_date'])); ?></td>
                                        </tr>
                                        <tr>
                                          <?php 
                                                $current_date = date('Y-m-d');
                                                $first_irrigation_date = $detail['first_irrigation_date'];
                                                $date1=date_create($first_irrigation_date);
                                                $date2=date_create($current_date);
                                                $diff=date_diff($date1,$date2);
                                                $day = $diff->format("%a");
                                          ?>
                                          <td><b>Days From First Irigation Date</b></td>
                                          <td><?php echo $day; ?></td>
                                        </tr>
                                        <tr>
                                          <td><b>Row to Row Distance</b></td>
                                          <td><?php echo $detail['row_to_row_distance']." ".$detail['spacing_unit_name']; ?></td>
                                        </tr>
                                        <tr>
                                          <td><b>Plant to Plant Distance</b></td>
                                          <td><?php echo $detail['plant_to_plant_distance']." ".$detail['spacing_unit_name']; ?></td>
                                        </tr>
                                        <tr>
                                          <td><b>Planting Method</b></td>
                                          <td><?php echo $detail['planting_method']; ?></td>
                                        </tr>
                                      <!-- end -->  
                                    </tbody>
                                    </table>
                                  </div>  
                                </div>
                                <div class="col-md-6">  
                                  <div class="table-responsive">
                                    <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                          <td><b>Planting Material</b></td>
                                          <td><?php echo $detail['planting_material']; ?></td>
                                        </tr>
                                        <tr>
                                          <td><b>Defoliation  date</b></td>
                                          <td><?php echo date("d M, Y",strtotime($detail['defoliation_date'])); ?></td>
                                        </tr>
                                        <tr>
                                          <td><b>Irrigation Source</b></td>
                                          <td><?php echo $detail['irrigation_source_name']; ?></td>
                                        </tr>
                                        <tr>
                                          <td><b>Irrigation Type</b></td>
                                          <td><?php echo $detail['irrigation_type']; ?></td>
                                        </tr>
                                        <tr>
                                          <td><b>Filteration System</b></td>
                                          <td><?php echo $detail['filtration_system_name']; ?></td>
                                        </tr>
                                        <tr>
                                          <td><b>Fertigation Equipment</b></td>
                                          <td><?php echo $detail['fertigation_equipment_name']; ?></td>
                                        </tr>
                                        <tr>
                                          <td><b>Mulching Type</b></td>
                                          <td><?php echo $detail['mulching_type']; ?></td>
                                        </tr>
                                        <tr>
                                          <td><b>Status</b></td>
                                          <td><?php echo $detail['status']; ?></td>
                                        </tr>
                                        <tr>
                                          <td><b>Soil Type</b></td>
                                          <td><?php echo $detail['soli_type']; ?></td>
                                        </tr>
                                        <tr>
                                          <td><b>Water Source</b></td>
                                          <td><?php echo $detail['water_source']; ?></td>
                                        </tr>
                                      <!-- end -->  
                                    </tbody>
                                    </table>
                                  </div>  
                                </div> 
                              </div>
                            </div>
                            <!-- end --> 
                          </div>  
                          <!-- Schedule --> 
                          <div class="tab-pane" id="schedule_<?php echo $plot_id ?>">
                            <?php $schedule=$obj->usermodel->get_schedule_by_plot($plot_id); ?>
                            <div class="row">
                              <div class="col-md-12">
                                <div class="table-responsive">
                                  <!-- start table -->
                                  <table id="schedule_tbl_<?php echo $plot_id ?>" class="table table-bordered table-striped">
                                    <thead>
                                      <tr>
                                        <th>ID</th>
                                        <th>Stage</th>
                                        <th>Date</th>
                                        <th>Activity Type</th>
                                        <th>Problem Type</th>
                                        <th>Problem</th>
                                        <th>Technical Name</th>
                                        <th>Brand Name</th>
                                        <th>Qty</th>
                                        <th>Unit</th>
                                        <th>Per</th>
                                        <th>Remark</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                <?php if(count($schedule) > 0) $i = 1; ?>
                                  <?php foreach ($schedule as $row) { ?>
                                      <tr>
                                        <td><?php echo $i++; ?></td>
                                        <td>
                                          <?php echo $row->en_stage; ?><br>
                                          <?php echo $row->hi_stage; ?><br>
                                          <?php echo $row->mr_stage; ?>
                                        </td>
                                        <td><?php echo date("d M, Y",strtotime($row->schedule_date)) ; ?></td>
                                        <td>
                                          <?php echo $row->en_activity_type; ?><br>
                                          <?php echo $row->hi_activity_type; ?><br>
                                          <?php echo $row->mr_activity_type; ?>
                                        </td>
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
                                          <?php echo $row->en_technical_name; ?><br>
                                          <?php echo $row->hi_technical_name; ?><br>
                                          <?php echo $row->mr_technical_name; ?>
                                        </td>
                                        <td>
                                          <?php echo $row->en_brand_name; ?><br>
                                          <?php echo $row->hi_brand_name; ?><br>
                                          <?php echo $row->mr_brand_name; ?>
                                        </td>
                                        <td>
                                          <?php echo $row->en_qty; ?>
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
                                          <?php echo $row->en_remark; ?><br>
                                          <?php echo $row->hi_remark; ?><br>
                                          <?php echo $row->mr_remark; ?>
                                        </td>
                                    </tr>       
                                  <?php } ?>
                                <?php ?>
                                    </tbody>
                                  </table>
                                  <script type="text/javascript">
                                    $(function(){
                                      $("#schedule_tbl_<?php echo $plot_id ?>").DataTable();
                                    });
                                  </script>
                                </div> 
                              </div>
                            </div>
                          </div>  
                          <!-- advisory --> 
                          <div class="tab-pane" id="advisory_<?php echo $plot_id ?>">
                            <?php $farmer_req = $obj->usermodel->get_advisory_request_by_farmer($farmer_id,$plot_id);  ?>
                            <div class="row">
                              <div class="col-md-12">
                                <div class="table-responsive">
                                  <!-- start table -->
                                  <table id="advisory_tbl_<?php echo $plot_id ?>" class="table table-bordered table-striped">
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
                                        <th>Status</th>
                                        <th>Actions</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php if(count($farmer_req) > 0) $i = 1; ?>
                                      <?php foreach ($farmer_req as $req) { ?>
                                      <tr>
                                          <td><?php echo $i++; ?></td>
                                          <td><?php echo date("d M, Y h:i A",strtotime($req->raised_on)); ?></td>
                                          <td><?php echo $req->farmer_name; ?></td>
                                          <td><?php echo $req->request_ticket; ?></td>
                                          <td><?php echo $req->plot_name; ?></td>
                                          <td><?php echo $req->crop_name; ?></td>
                                          <td><?php echo $req->problem_area_name; ?></td>
                                          <td><?php echo date("d M, Y",strtotime($req->first_irrigation_date)); ?>
                                          <?php 
                                            if($req->status == 'New'){ $status="<span style='color:Black';><b>New</b></span>"; }
                                            elseif($req->status == 'Ongoing'){ $status="<span style='color:#34a853';><b>Ongoing</b></span>"; }
                                            elseif($req->status == 'Followup'){ $status="<span style='color:##daaa1d';><b>Followup</b></span>"; }
                                            else{ $status="<span style='color:#ea4335 ';>Closed</span>";  } 
                                          ?>  
                                          </td>
                                          <td><?php echo $status; ?></td>
                                          <td style="display: inline-flex;">
                                            <a class="btn btn-sm btn-primary" href="<?php echo base_url('vendor/view-advisory-request/'.$req->advisory_id); ?>" style="margin-right: 5px;">
                                              <i class="fa fa-eye"></i>
                                            </a>
                                          </td>
                                      </tr>       
                                    <?php } ?>
                                  <?php ?>
                                    </tbody>
                                  </table>
                                  <script type="text/javascript">
                                    $(function(){
                                      $("#advisory_tbl_<?php echo $plot_id ?>").DataTable();
                                    });
                                  </script>
                                </div> 
                              </div>
                            </div>
                          </div>  
                          <!-- weekly_images --> 
                          <div class="tab-pane" id="weekly_images_<?php echo $plot_id ?>">
                              <?php 
                              $subscription  = $obj->usermodel->get_subscription_by_plot($plot_id);
                              if(count($subscription) > 0){ $i=0;
                              foreach ($subscription as $subscription_id) { $i++;
                                $weeklyimg=$obj->usermodel->get_weekly_image_by_plot($plot_id,$subscription_id);
                              ?>
                                <label>SubScription <?php echo $i; ?></label>
                                <div class="row">
                                  <div class="col-md-12">
                                    <!-- start image -->
                                    <?php if(count($weeklyimg) > 0){ $i = 1; ?>
                                      <?php foreach ($weeklyimg as $row) { ?>
                                        <div class="col-md-2" style="margin-bottom: 5px;">
                                            <label><center><?php echo "W".$row->week; ?></center></label>
                                            <?php if($row->path == ''){ ?>
                                              <div class="img-box" style="height:120px;width:120px;border: 1px solid #ccc;padding:5px;">
                                              </div>  
                                            <?php }else{ ?>
                                            <img class="img-responsive" style="height:120px;width:120px;border: 1px solid #ccc;padding:5px;" src="<?php echo IMG_PATH.'plots/'.$plot_id.'/weekly_images/'.$row->path; ?>">
                                            <?php } ?>
                                        </div>  
                                      <?php } ?>
                                    <?php } ?>
                                    <!-- end image -->
                                  </div>
                                </div>
                               <?php } ?>
                              <?php } ?>  
                          </div> 
                        <!-- end tab content --> 
                        </div> 
                      </div>  
                      <!-- end tab view -->
                     </div> 
                    <!-- end -->  
                  </div>  
                  <!-- end -->
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
    <!-- end tab view -->
    <?php } ?>
  </section>    
  <!-- end edit SubTopic form -->
</div>
<!-- END plot Detail -->
<script src="<?=base_url('public');?>/components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?=base_url('public');?>/components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
  $(function(){
    $("#table").DataTable();
  });
</script>  
  