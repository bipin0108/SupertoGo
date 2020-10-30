<link rel="stylesheet" href="<?=base_url('public');?>/components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="<?=base_url('public');?>/components/bootstrap-datepicker/dist/css/
bootstrap-datepicker.min.css">
<?php 
 $obj=&get_instance();
 $advisory_id = $this->uri->segment(3);
 $request_data = $obj->v_advisorymodel->view_advisory_request_by_id($advisory_id);
 $farmer_req = $obj->v_advisorymodel->get_advisory_request_by_farmer($request_data->farmer_id); 
 
 ?>
<style type="text/css">
  .rchemicals {
    border: 1px solid #ccc;
    width: 100%;
    margin-top: 8px;
}
  .label_val{
    padding:0px 8px;
  }
  .nav-tabs-custom>.nav-tabs>li.active>a, .nav-tabs-custom>.nav-tabs>li.active:hover>a {
    background-color: #00968861;
    color: #444;
  }
  .nav-tabs-custom>.nav-tabs>li>a, .nav-tabs-custom>.nav-tabs>li>a:hover {
      font-size: 16px;
  } 
  #modalplotdetail table tbody th{background-color:#009688!important;color:#fff;}
  #modalplotdetail table tbody tr td,#modalplotdetail table tbody tr th,#solution table tbody tr td,#solution table tbody tr th{padding:4px !important;}
  .right .direct-chat-text:after, .right .direct-chat-text:before{border-left-color: #9ed7d240;}
  .direct-chat-text:after, .direct-chat-text:before{border-right-color: #cccccc59;}
  .mr-5{margin-right: 5px;}
  #activity_type_error,#problem_area_error{color:red;}
  .direct-chat-text .table-bordered tbody tr td,.direct-chat-text .table-bordered tbody tr th{
    padding:5px !important;
  }
  .direct-chat-text{
    color: #333 !important;
  }
  .direct-chat-text .table-bordered>tbody>tr>th,.direct-chat-text .table-bordered>tbody>tr>td{
    border:0 !important;
  }
  .direct-chat-text .table-bordered>tbody>tr {
    border-bottom: 1px solid #333 !important;
  }
  .direct-chat-text .table-bordered{
    border: 1px solid #333 !important;
    background: #fff;
    margin-bottom: 5px;
    color:#333 !important;
    margin-top: 15px;
  }
</style>
<!-- Content Wrapper. Contains page content --> 
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>View Expert Advisory Request
      <a href="<?php echo base_url('admin/farmer-profile/'.$request_data->farmer_id) ?>" class="btn btn-primary pull-right">Back to Farmer Profile</a>
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
            <h3 class="box-title pull-right">
              <?php 
                  if($request_data->advisory_status == 'New'){ $color="#0a0a0a"; $status="New"; }
                  elseif($request_data->advisory_status == 'Ongoing'){ $color="#026627"; $status="Ongoing"; }
                  elseif($request_data->advisory_status == 'Followup'){ $color="#daaa1d"; $status="Followup"; }
                  else{ $color="#ea4335"; $status="Closed"; } 
              ?>
              <button style="background-color:<?php echo $color; ?> !important;color:#fff;margin-right: 7px;" class="btn btn-md pull-right"><b><?php echo $status; ?></b></button>
            </h3>
          </div>
          <!-- START edit SubTopic form -->
          <div class="box-body">
              <div class="col-md-12"> 
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
              </div>  
              <div class="col-md-12">
                <div class="col-md-2">
                   <?php if($request_data->farmer_profile == ''){ ?>
                    <img class="profile-user-img img-responsive img-circle" style="height:100px;width:100px" src="<?php echo DEFAULT_IMG_PATH; ?>">  
                    <?php }else{ ?>
                    <img class="profile-user-img img-responsive img-circle" style="height:100px;width:100px" src="<?php echo IMG_PATH.'user_profiles/'.$request_data->farmer_profile; ?>">
                  <?php } ?>
                </div>  
                <div class="col-md-5">
                    <label>Name :</label><span class="label_val"><?php echo $request_data->farmer_name; ?></span><br>
                    <label>Mobile :</label><span class="label_val"><?php echo $request_data->farmer_mobile; ?></span><br>
                    <label>Address :</label><span class="label_val"><?php echo $request_data->farmer_address; ?></span>
                </div>  
                <div class="col-md-5">
                    <label>Request ID :</label><span class="label_val"><?php echo $request_data->request_ticket; ?></span><br>
                    <label>Issue Raised On :</label><span class="label_val"><?php echo date("d M, Y h:i A",strtotime($request_data->raised_on)); ?></span>
                </div> 
              </div>
          </div>
          <div class="box-body" style="border-top: 2px solid #eee;">    
              <div class="row">
              <div class="col-md-12">
                <div class="col-md-6">
                  <h4><b><i class="fa fa-hand-o-right" aria-hidden="true"></i> Request Detail</b></h4>
                  <div class="table-responsive">
                    <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td style="width:150px;"><b>Problem Area</b></td>
                            <td><?php echo $request_data->problem_area_name; ?></td>
                        </tr>
                        <tr>
                            <td><b>Description</b></td>
                            <td><?php echo $request_data->description; ?></td>
                        </tr>
                        <tr>
                            <td><b>Plot Name</b></td>
                            <td><?php echo $request_data->plot_name; ?><a class="pull-right" id="plotdetail"><b>View Plot Detail</b></a></td>
                        </tr>
                        <tr>
                            <td><b>Plot Area</b></td>
                            <td><?php echo $request_data->area_of_plot; ?></td>
                        </tr>
                        <tr>
                            <td><b>Crop Name</b></td>
                            <td><?php echo $request_data->crop_name; ?></td>
                        </tr>
                        <tr>
                            <td><b>First Irrigation Date</b></td>
                            <td><?php echo date("d M, Y",strtotime($request_data->first_irrigation_date)); ?></td>
                        </tr>
                        <tr>
                          <?php 
                          $current_date = date('Y-m-d');
                          $first_irrigation_date = $request_data->first_irrigation_date;
                          $date1=date_create($first_irrigation_date);
                          $date2=date_create($current_date);
                          $diff=date_diff($date1,$date2);
                          $day = $diff->format("%a");
                          ?>
                            <td><b>Days From First Irigation Date:</b></td>
                            <td><?php echo $day; ?></td>
                        </tr>
                        <tr>
                            <td><b>Crop Stage</b></td>
                            <?php $soil_type=$obj->mastermodel->get_field_val('id',$request_data->soil_type_id,'s_soil_type','soil_type'); ?>
                            <?php $crop_stage=$obj->mastermodel->get_stage($request_data->first_irrigation_date,$soil_type); ?>
                            <td><?php echo $crop_stage; ?></td>
                        </tr>  
                    </tbody>
                    </table>
                  </div>
                  <!-- table -->    
                </div>  
                <div class="col-md-6">
                  <h4><b><i class="fa fa-hand-o-right" aria-hidden="true"></i> Images</b></h4>
                  <div class="row">
                    <div class="col-md-12" style="margin-bottom:10px;border-bottom: 2px solid #eee;">
                      <?php 
                        if(!empty($request_data->images)){
                          $images = explode(',',$request_data->images); 
                          foreach ($images as $img) {
                      ?>
                          <div class="col-md-4" style="padding: 0">
                            <img class="img img-responsive" src="<?php echo IMG_PATH.'advisory/'.$img; ?>" type="audio/mpeg" style="margin: 5px;height:150px;"/>
                          </div> 
                      <?php  } } ?>
                    </div>
                  </div>  
                  <h4><b><i class="fa fa-hand-o-right" aria-hidden="true"></i> Voice Record</b></h4>
                  <div class="row">  
                    <div class="col-md-12">
                      <div class="col-md-12">
                        <?php if(!empty($request_data->audio)){ ?>
                            <audio controls="" src="<?php echo IMG_PATH.'advisory/'.$request_data->audio; ?>" type="audio/mpeg"></audio>
                        <?php }else{ ?>
                        <?Php echo "Not Available"; ?>
                        <?php } ?>
                      </div>  
                    </div>  
                  </div>  
                </div>
              </div>
              </div>
              <!-- end box-body --> 
          </div>  
        </div>
        <!-- end -->
      </div> 
    </div>
    <!-- START Response, Schedule and Advice History -->
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-primary">
          <div class="box-header">
          </div>
          <div class="box-body">
            <div class="nav-tabs-custom" id="element_overlap1">
              <ul class="nav nav-tabs"  id="myTab">
                <li class="active"><a href="#Responses" data-toggle="tab" >Responses</a></li>
                <li><a href="#AdviceHistory" data-toggle="tab" >Advice History</a></li>   
                <li><a href="#Schedule" data-toggle="tab" >Schedule</a></li>
              </ul>
              <div class="tab-content">
                <!-- Response -->
                <div class="tab-pane active" id="Responses">
                  <!-- start -->
                  <div class="row">
                    <div class="col-md-12">
                      <?php 
                        $response=$obj->v_advisorymodel->get_response_by_advisory($advisory_id);
                        $farmer_name =  $request_data->farmer_name;
                        if($request_data->farmer_profile == '')
                        {
                          $farmer_path = DEFAULT_IMG_PATH;
                        }else{
                          $farmer_path = IMG_PATH.'user_profiles/'.$request_data->farmer_profile;  
                        }
                      ?>
                      <?php if(count($response) > 0){ ?>
                        <div class="">
                        <?php foreach ($response as $res){ ?>
                            <?php 
                              $date = date("d M, Y h:i A",strtotime($res['created_at']));
                              if($res['send_by'] == 'vendor'){ 
                                $right='right';
                                $name_pull = 'pull-right';
                                $date_pull = 'pull-left'; 
                                $imgname = $obj->mastermodel->get_field_val('vendor_id',$res['vendor_id'],'s_vendor','profile_image');
                                if($imgname == ''){
                                  $img_path = DEFAULT_IMG_PATH;
                                }else{
                                   $img_path = IMG_PATH.'vendor_profiles/'.$imgname;
                                }
                                $username = $obj->mastermodel->get_field_val('vendor_id',$res['vendor_id'],'s_vendor','name');
                                $bg = '#9ed7d240';
                              }else{
                                $right='';  
                                $name_pull = 'pull-left';
                                $date_pull = 'pull-right';
                                $username = $farmer_name;
                                $img_path =  $farmer_path;
                                $bg = '#cccccc59';
                              }
                            ?>
                            <div class="direct-chat-msg <?php echo $right; ?>">
                              <div class="direct-chat-info clearfix">
                                <span class="direct-chat-name <?php echo $name_pull; ?>"><?php echo $username; ?></span>
                                <span class="direct-chat-timestamp <?php echo $date_pull; ?>"><?php echo $date; ?></span>
                              </div>
                              <img class="direct-chat-img" src="<?php echo $img_path; ?>" alt="message user image">
                              <div class="direct-chat-text" style="background-color: <?php echo $bg; ?>;border: 1px solid <?php echo $bg; ?>;">
                              <?php $msg = json_decode($res['message'],true); ?>
                              <!-- msg -->
                              <?php if(!empty($msg['message'])){ ?>
                                <span style="margin-top:10px;font-weight:600;"><?php echo $msg['message']; ?></span>
                              <?php } ?>
                              <!-- solution -->
                              <?php if(!empty($msg['solution'])){ ?>
                                  <!-- SOLUTION 1 -->
                                  <?php $solution1 = $msg['solution']['solution1']; ?>
                                  <?php  if(!empty($solution1)){ ?>
                                    <br>
                                    <div class="table-responsive">
                                    <table class="table table-bordered">
                                    <tbody>
                                      <tr style="background-color:#333333c2;color:#fff">
                                        <th>Solution</th>
                                        <th>Date</th>
                                        <th>Activity Type</th>
                                        <th>Problem</th>
                                        <th>Chemical</th>
                                        <th>Dosage</th>
                                      </tr>      
                                    <?php foreach ($solution1 as $sol1) { ?>
                                      <tr>
                                        <td><?php echo $sol1['solution'] ?></td>
                                        <td><?php echo date("d M, Y",strtotime($sol1['date']));  ?></td>
                                        <td><?php echo $sol1['activity_type'] ?></td>
                                        <td><?php echo $sol1['problem'] ?></td>
                                        <td><?php echo $sol1['chemical'] ?></td>
                                        <td><?php echo $sol1['dosage'] ?></td>
                                      </tr>        
                                    <?php } ?>
                                    </tbody>    
                                    </table>
                                    </div>
                                  <?php } ?>
                                  <!-- SOLUTION 2 -->
                                  <?php $solution2 = $msg['solution']['solution2']; ?>
                                  <?php  if(!empty($solution2)){ ?>
                                    <br>
                                    <div class="table-responsive">
                                    <table class="table table-bordered">
                                    <tbody>
                                      <tr style="background-color:#333333c2;color:#fff">
                                        <th>Solution</th>
                                        <th>Date</th>
                                        <th>Activity Type</th>
                                        <th>Problem</th>
                                        <th>Chemical</th>
                                        <th>Dosage</th>
                                      </tr>      
                                    <?php foreach($solution2 as $sol2) { ?>
                                      <tr>
                                        <td><?php echo $sol2['solution'] ?></td>
                                        <td><?php echo date("d M, Y",strtotime($sol2['date']));  ?></td>
                                        <td><?php echo $sol2['activity_type'] ?></td>
                                        <td><?php echo $sol2['problem'] ?></td>
                                        <td><?php echo $sol2['chemical'] ?></td>
                                        <td><?php echo $sol2['dosage'] ?></td>
                                      </tr>        
                                    <?php } ?>
                                    </tbody>    
                                    </table>
                                    </div>
                                  <?php } ?>
                                  <!-- END -->
                              <?php } ?>
                              <!-- audio -->
                              <?php if(!empty($res['audio'])){ ?>
                                <br>
                                <audio controls="" src="<?php echo IMG_PATH.'advisory/'.$request_data->audio; ?>" type="audio/mpeg" style="margin-top: 5px;"></audio>
                              <?php } ?> 
                              <!-- images -->
                              <?php if(!empty($res['images'])){ ?>
                              <br>  
                              <?php $images = explode(',',$res['images']); ?>
                              <div style="display:inline-flex;">
                              <?php foreach ($images as $img) { ?>
                                <img class="img img-responsive" src="<?php echo IMG_PATH.'advisory/'.$img; ?>" type="audio/mpeg" style="margin: 5px;height:100px;"/>
                              <?php } ?>
                              </div>  
                              <?php } ?> 
                              </div>
                            </div>
                        <!-- end offoreach  -->    
                        <?php } ?>
                        </div>
                      <?php } ?>
                    </div>  
                  </div>  
                  <!-- end -->
                </div>
                <!-- advice history -->
                <div class="tab-pane" id="AdviceHistory">
                  <div class="table-responsive">
                    <!-- start table -->
                    <table id="table" class="table table-bordered table-striped">
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
                              elseif($req->status == 'Ongoing'){ $status="<span style='color:#026627';><b>Ongoing</b></span>"; }
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
                  </div>
                  <!-- end table -->  
                </div> 
                <!-- schedule -->
                <div class="tab-pane" id="Schedule">
                  <?php $schedule=$obj->usermodel->get_schedule_by_plot($request_data->plot_id); ?>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="table-responsive">
                        <!-- start table -->
                        <table id="schedule" class="table table-bordered table-striped">
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
                      </div> 
                    </div>
                  </div>
                </div>  
                <!-- end -->   
              </div>  
          </div>  
         </div>  
      </div>  
    </div>  
    <!-- END Response, Schedule and Advice History -->
  </section>    
  <!-- end edit SubTopic form -->
</div>
<!-- END plot Detail -->
<script src="<?=base_url('public')?>/components/bootstrap-datepicker/dist/js/bootstrap-datepicker.js"></script>
<script src="<?=base_url('public');?>/components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?=base_url('public');?>/components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
  $(function(){
    $("#table").DataTable();
    $("#schedule").DataTable();
  });
   
</script>
<!-- START plot Detail -->
<div class="modal fade in" id="modalplotdetail">
  <div class="modal-dialog modal-lg" >
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" style="opacity:1;color:#009688" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" ><b>×</b></span></button>
        <h4 class="modal-title">Plot Detail [ Plot Name : <?php echo $request_data->plot_name ?>]</h4>
      </div>
      <div class="modal-body">
       <!-- start -->
        <div class="row">
          <div class="col-md-6">
              <table class="table table-bordered">
                  <tbody>
                      <tr><th colspan="2">Plot Overview</th></tr>
                      <tr><td><b>Plot area</b></td><td><?php echo $request_data->area_of_plot ?></td></tr>
                      <tr><td><b>Soil Type</b></td><td><?php echo $obj->mastermodel->get_field_val('id',$request_data->soil_type_id,'s_soil_type','en_name') ?></td></tr>
                  </tbody>
              </table>
              <table class="table table-bordered">
                  <tbody>
                      <tr><th colspan="2">Plot Irrigation details</th></tr>
                      <tr><td><b>Irrigation Type</b></td><td><?php echo $request_data->irrigation_type ?></td></tr>
                      <tr><td><b>First Irrigation Date</b></td><td><?php echo date("d M, Y",strtotime($request_data->first_irrigation_date)); ?></td></tr>
                      <tr><td><b>Dripper Spacing</b></td><td><?php echo $request_data->dripper_spacing_cm ?></td></tr>
                      <tr><td><b>Dripper Discharge</b></td><td><?php echo $request_data->dripper_discharge_liter_hour ?></td></tr>
                      <tr><td><b>Water Filter System</b></td><td><?php echo $obj->mastermodel->get_field_val('id',$request_data->filtration_system_ids,'s_filtration_system','en_name') ?></td></tr>
                      <tr><td><b>Water Source</b></td><td><?php echo $obj->mastermodel->get_field_val('id',$request_data->water_source_id,'s_water_source','en_name') ?></td></tr>
                  </tbody>
              </table>
                <table class="table table-bordered">
                    <tbody>
                        <tr><th colspan="2">Disease Information</th></tr>
                        <tr><td><b>Prevalent Disease</b></td><td><?php echo $request_data->prevalent_disease ?></td></tr>
                        <tr><td><b>No. Of Affected Plants</b></td><td><?php echo $request_data->num_of_plant_affected ?></td></tr>
                    </tbody>
                </table>
          </div>
          <div class="col-md-6">
              <table class="table table-bordered">
                  <tbody>
                      <tr><th colspan="2">Crop Overview</th></tr>
                      <tr><td><b>Crop Name</b></td><td><?php echo $request_data->crop_name ?></td></tr>
                      <tr><td><b>Variety</b></td><td><?php echo $obj->mastermodel->get_field_val('variety_id',$request_data->variety_id,'s_variety','en_name') ?></td></tr>
                      <tr><td><b>No. of Plants</b></td><td><?php echo $request_data->num_of_plant ?></td></tr>
                      <tr><td><b>Planting Date</b></td><td><?php echo date("d M, Y",strtotime($request_data->planting_date)); ?></td></tr>
                      <tr><td><b>Defoliation Date</b></td><td><?php echo date("d M, Y",strtotime($request_data->defoliation_date)); ?></td></tr>
                      <tr><td><b>Age of Plant</b></td><td><?php echo $request_data->plot_name ?></td></tr>
                      <tr><td><b>Crop Stage</b></td><td></td></tr>
                      <tr><td><b>Planting Method</b></td><td><?php echo $obj->mastermodel->get_field_val('id',$request_data->planting_method_id,'s_planting_method','en_name') ?></td></tr>
                      <tr><td><b>Planting Material</b></td><td><?php echo $obj->mastermodel->get_field_val('id',$request_data->planting_material_id,'s_planting_material','en_name') ?></td></tr>
                  </tbody>
              </table>
               <table class="table table-bordered">
                    <tbody>
                        <tr><th colspan="2">Fertilization Details</th></tr>
                        <tr><td><b>Mulching</b></td><td><?php echo $request_data->mulching_type ?></td></tr>
                        <tr><td><b>Paper Width / Thickness</b></td><td><?php echo $request_data->paper_width_in_meter.'/'.$request_data->paper_thickness_in_micro;   ?></td></tr>
                    </tbody>
                </table>
          </div>
      </div>
       <!-- end -->
      </div>
      <!-- model body -->
    </div>
  </div>
</div>
