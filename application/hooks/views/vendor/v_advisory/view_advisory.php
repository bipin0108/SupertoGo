<link rel="stylesheet" href="<?=base_url('public');?>/components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="<?=base_url('public');?>/components/bootstrap-datepicker/dist/css/
bootstrap-datepicker.min.css">
<?php 
 $obj=&get_instance();
 $advisory_id = $this->uri->segment(3);
 $request_data = $obj->v_advisorymodel->view_advisory_request_by_id($advisory_id);
 $farmer_req = $obj->v_advisorymodel->get_advisory_request_by_farmer($request_data->farmer_id,$request_data->plot_id); 
 $vendor=$obj->v_vendormodel->GetVendorData();
 $role_id = $this->session->userdata[SESSION_VENDOR]['role_id'];
 $vendor_id = $this->session->userdata[SESSION_VENDOR]['vendor_id'];
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
      <a href="<?php echo base_url('vendor/advisory-request-list') ?>" class="btn btn-primary pull-right">Back to Advisory List</a>
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

              <?php if($role_id == 0){ ?>
                <?php if($request_data->vendor_id == $vendor_id){ ?>
                  <?Php if($request_data->advisory_status != 'Closed'){ ?>
                    <!-- start button -->
                    <?php if($request_data->advisory_status == 'New'){ ?>
                      <button class="btn btn-primary pull-right mr-5" id="change_status"><i class="fa fa-edit"></i> Status</button>
                    <?php } ?>    
                    <?php if($request_data->advisory_status == 'Ongoing'){ ?>
                        <button class="btn btn-primary pull-right mr-5" id="follow_up"> Set Follow Up Date</button>
                        <button class="btn btn-primary pull-right mr-5" id="change_status"><i class="fa fa-edit"></i> Status</button>
                    <?php } ?>  
                    <?php if($request_data->advisory_status == 'Followup'){ ?>
                      <button class="btn btn-primary pull-right mr-5" id="follow_up"> Set Follow Up Date</button>
                      <button class="btn btn-primary pull-right mr-5" id="change_status"><i class="fa fa-edit"></i> Status</button>
                    <?php } ?>
                    <!-- end button -->
                  <?php } ?>  
                <?php } ?>
              <?php }else{ ?> 
                <?Php if($request_data->advisory_status != 'Closed'){ ?>
                  <!-- start button -->
                    <?php if($request_data->advisory_status == 'New'){ ?>
                      <button class="btn btn-primary pull-right mr-5" id="change_status"><i class="fa fa-edit"></i> Status</button>
                    <?php } ?>
                    <?php if($request_data->advisory_status == 'Ongoing'){ ?>
                       <button class="btn btn-primary pull-right mr-5" id="follow_up"> Set Follow Up Date</button>
                       <button class="btn btn-primary pull-right mr-5" id="change_status"><i class="fa fa-edit"></i> Status</button>
                    <?php } ?>  
                    <?php if($request_data->advisory_status == 'Followup'){ ?>
                      <button class="btn btn-primary pull-right mr-5" id="follow_up"> Set Follow Up Date</button>
                      <button class="btn btn-primary pull-right mr-5" id="change_status"><i class="fa fa-edit"></i> Status</button>
                    <?php } ?>
                    <!-- end button -->
                <?php } ?>
              <?php } ?>
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
                            <td style="width:210px;"><b>Problem Area</b></td>
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
                            <img class="profile-user-img img-responsive" src="<?php echo IMG_PATH.'advisory/'.$img; ?>"  style="margin: 5px;height:150px;"/>
                          </div> 
                      <?php  } }?>
                    </div>
                  </div>  
                  <h4><b><i class="fa fa-hand-o-right" aria-hidden="true"></i> Voice Record</b></h4>
                  <div class="row">  
                    <div class="col-md-12">
                      <div class="col-md-12">
                        <?php if(!empty($request_data->audio)){ ?>
                            <audio controls="" src="<?php echo IMG_PATH.'advisory/'.$request_data->audio; ?>" type="audio/mp4"></audio>
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
                      $activity = $obj->moleculemodel->get_all_activity();
                      $problem_area = $obj->problemareamodel->get_all_problemarea();
                      ?>
                      <!-- <div class="col-md-12 col-md-offset-1"> -->
                      <!-- START New Message -->
                      <?php if($role_id == 0){ ?>
                        <?php if($request_data->vendor_id == $vendor_id){ ?>
                          <?Php if($request_data->advisory_status != 'Closed'){ ?>
                            <button class="btn btn-primary pull-right" style="margin-bottom: 15px;" id="reply_yes"><i class="fa fa-plus"></i>  Reply</button>
                          <?php } ?>  
                        <?php } ?>
                      <?php }else{ ?> 
                        <?Php if($request_data->advisory_status != 'Closed'){ ?>
                          <button class="btn btn-primary pull-right" style="margin-bottom: 15px;" id="reply_yes"><i class="fa fa-plus"></i>  Reply</button>
                        <?php } ?>
                      <?php } ?>
                      
                      <!-- reply box-->
                      <div id="reply_box" style="display:none;">
                        <button class="btn btn-primary pull-right" id="reply_no"><i class="fa fa-arrow-up"></i>  Reply</button>
                        <button class="btn btn-primary pull-right mr-5" id="chemical_yes"><i class="fa fa-plus"></i>  
                        Add Chemicals</button>
                        <button class="btn btn-primary pull-right mr-5" id="reference_yes"><i class="fa fa-plus"></i>  Add Reference</button>

                        <div id="chemical_box" style="display:none;">
                          <button class="btn btn-primary pull-right mr-5" id="chemical_no"><i class="fa fa-arrow-up"></i>  Add Chemicals</button>
                          <div class="clearfix"><br></div>
                          <!-- start -->
                          <div class="row">
                            <div class="col-md-4">
                              <div class="form-group">
                                <label>Date</label>
                                <div class="input-group date">
                                  <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                  <input type="text" name="sol_date" class="form-control" value="<?php echo set_value('sol_date')?>" id="sol_date" autocomplete="off" >
                                </div>
                                <?php echo form_error('sol_date'); ?>
                              </div>   
                            </div> 
                          </div>    
                          <!-- strat -->
                          <div class="row">
                            <div class="col-md-3">
                              <div class="form-group">
                                <label>Activity Type</label>
                                <select class="form-control" id="activity_type">
                                  <option value="">Select Activity</option>  
                                  <?php foreach($activity as $act){ ?>
                                    <option value="<?php echo $act->en_act_name; ?>"><?php echo $act->en_act_name; ?></option>
                                  <?php } ?>
                                </select>
                              </div>
                              <span id="activity_type_error"></span>
                            </div> 
                            <div class="col-md-3">
                              <div class="form-group">
                                <label>Problem Area</label>
                                <select name="problem_area" id="problem_area" class="form-control">
                                  <option value="">Select Problem Area</option>  
                                  <?php foreach($problem_area as $prob){ ?>
                                    <?php if($request_data->problem_area_name == $prob->en_name){ $selected='selected'; }else{$selected='';} ?>
                                    <option value="<?php echo $prob->en_name; ?>" <?php echo $selected; ?> ><?php echo $prob->en_name; ?></option>
                                  <?php } ?>
                                </select>
                              </div> 
                              <span id="problem_area_error"></span> 
                            </div>   
                            <div class="col-md-3">
                              <div class="form-group">
                                <label>Problem Type</label>
                                <select name="problem_type" id="problem_type" class="form-control" disabled>
                                  <option value="">Select Problem Type</option>  
                                </select>
                              </div>
                              <span id="problem_type_error"></span>  
                            </div>  
                            <div class="col-md-3">
                              <div class="form-group">
                                <label>Problem Name</label>
                                <select name="problem" id="problem" class="form-control" disabled>
                                  <option value="">Select Problem Name</option>  
                                </select>
                              </div>  
                            </div>  
                          </div>
                          <!-- find chemicals -->
                          <div class="row">
                            <div class="col-md-12">
                              <button class="btn btn-primary mr-5" type="submit" value="" id="find_chemical"><i class="fa fa-search"></i> Find Chemical</button>
                              <!-- <button class="btn btn-primary mr-5" type="submit" value="" id="combine_chemical">Combine</button> -->
                              <button class="btn btn-primary mr-5" type="submit" value="" id="OR_chemical">OR </button>
                            </div>
                          </div>  
                          <!-- add solution -->
                          <div class="row" >
                            <div class="col-md-12">
                              <div id="solution" class="table-responsive" style="padding: 10px;max-height: 400px;overflow-x: hidden;overflow-y: auto;display: none">
                               <br>
                                <div id="solution_tbl">
                                </div>  
                              </div>
                            </div>  
                          </div> 
                          <br>
                          <div class="row">
                              <div class="col-md-12"> 
                                  <button class="btn btn-primary mr-5 add_solution_class" id="add_solution">
                                    <i class="fa fa-plus"></i> Add Solution
                                  </button>
                                  <button class="btn btn-primary mr-5 add_solution_class" style="display:none" id="add_combine_solution">
                                    <i class="fa fa-plus"></i> Add Combine Solution
                                  </button>
                              </div> 
                          </div>  
                          <!-- end -->

                        </div>  
                        <br>
                        <!-- start chemical1 message -->
                        <div class="row" >
                          <div class="col-md-12">
                            <div id="chemical1" class="table-responsive" style="display: none">
                              <label>Solution 1</label>
                              <table class="table table-bordered">
                                <thead>
                                  <tr>
                                    <th>Date</th>
                                    <th>Activity Type</th>
                                    <th>Problem</th>
                                    <th>Chemical</th>
                                    <th>Dosage</th>
                                    <th>Remove</th>
                                  </tr>
                                </thead>  
                                <tbody id="chemical1_msg_tbl">
                                </tbody>
                              </table> 
                            </div>
                          </div>
                        </div>       
                        <!-- start chemical2 message -->
                        <div class="row" >
                          <div class="col-md-12">
                            <div id="chemical2" class="table-responsive" style="display: none">
                              <label>Solution 2</label>
                              <table class="table table-bordered">
                                <thead>
                                  <tr>
                                    <th>Date</th>
                                    <th>Activity Type</th>
                                    <th>Problem</th>
                                    <th>Chemical</th>
                                    <th>Dosage</th>
                                    <th>Remove</th>
                                  </tr>
                                </thead>  
                                <tbody id="chemical2_msg_tbl">
                                </tbody>
                              </table> 
                            </div>
                          </div>
                        </div>      
                        <!-- end chemical2 message -->       
                        <!-- start reference -->
                        <div class="row">
                          <div class="col-md-6">
                            <div id="reference" style="display: none" class="table-responsive">
                              <br>
                              <table class="table table-bordered">
                                <thead>
                                  <tr><th>SubTopic Title</th><th>Action</th></tr>
                                </thead>
                                <tbody id="reference_tbl">
                                </tbody>  
                              </table>  
                            </div>
                           </div>   
                        </div>  
                        <!-- end reference -->
                        <!-- start text area -->
                        <br>
                        <div class="form-group">
                          <label>Message</label>
                          <textarea  id="chat_msg" rows="6" class="form-control" ></textarea>
                        </div>
                        <input type="hidden" id="message">
                        <button class="btn btn-primary" id="send">SEND</button>  
                      </div>  
                      <div class="clearfix"><br></div>
                      <!-- END New Message -->

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
                                <br>
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
                              <!-- reference -->
                              <?php if(!empty($msg['reference'])){ ?>
                                <br>
                                <?php $ref_link = explode(',',$msg['reference']); ?>
                                <?php  foreach ($ref_link as $idx=>$ref) { $idx++; ?>
                                  <?php $rcrop_id = $this->mastermodel->get_field_val('id',$ref,'s_kb_subtopic','topic_id'); ?>
                                  <a target="_blank" href="<?php echo base_url('vendor/view-knowledge-bank-subtopic/'.$rcrop_id.'/'.$ref) ?>" class="btn btn-sm btn-default">Reference <?php echo $idx; ?></a>
                                <?php } ?>
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
    $('#sol_date').datepicker({autoclose: true,todayHighlight: true,format: "dd/mm/yyyy"});
    $('#follow_up_date').datepicker({autoclose: true,todayHighlight: true,format: "dd/mm/yyyy"});
  });
  $(document).ready(function(){
      $(document).on('click', '#change_status', function(){
          $("#modalStatus").modal('show');
      });
      $(document).on('click', '#follow_up', function(){
          $("#modalFollowUp").modal('show');
      });
      $(document).on('click', '#plotdetail', function(){
          $("#modalplotdetail").modal('show');
      });
      var farmer_id = "<?php echo $request_data->farmer_id; ?>"; 
      var vendor_id = "<?php echo $this->session->userdata[SESSION_VENDOR]['vendor_id']; ?>"; 
      //open reply box
      $(document).on('click', '#reply_yes', function(){
        $("#reply_box").attr('style','display:block;');
        $("#reply_yes").attr('style','display:none;');    
      });
      //close reply box
      $(document).on('click', '#reply_no', function(){
        $("#reply_box").attr('style','display:none;');
        $("#reply_yes").attr('style','display:block;');    
      });
      //open chemical box
      $(document).on('click', '#chemical_yes', function(){
        $("#chemical_box").attr('style','display:block;');
        $("#chemical_yes").attr('style','display:none;');    
      });
      //close chemical box
      $(document).on('click', '#chemical_no', function(){
        $("#chemical_box").attr('style','display:none;');
        $("#chemical_yes").attr('style','display:block;');    
      });

      //combine 
      $(document).on('click', '#combine_chemical', function(){
        $("#add_solution").attr('style','display:none;');
        $("#add_combine_solution").attr('style','display:block;'); 
      });

      //remove chemicals
      $(document).on('click', '.remove', function(){
        $(this).closest("tr").remove();
      });

      //select activity type
      $(document).on('change', '#activity_type,#problem_area', function(){
        var activity_type = $('#activity_type').val();
        var problem_area = $('#problem_area').val();
         $.ajax({
           url:"<?php echo base_url(); ?>vendor/get_problem_type_of_activity_ajax",
           method:"POST",
           data:{activity_type:activity_type,problem_area:problem_area},
           success:function(data)
           {
             $('#problem_type').html(data);
             $("#problem_type").prop('disabled',false);
           }
         });
      });
      //select problem type
      $(document).on('change', '#activity_type,#problem_area,#problem_type', function(){
        var activity_type = $('#activity_type').val();
        var problem_area = $('#problem_area').val();
        var problem_type = $('#problem_type').val();
         $.ajax({
           url:"<?php echo base_url(); ?>vendor/get_problem_of_problem_type_ajax",
           method:"POST",
           data:{problem_type:problem_type,activity_type:activity_type,problem_area:problem_area},
           success:function(data)
           {
             $('#problem').html(data);
             $("#problem").prop('disabled',false);
           }
         });
         //end
      });
      //find chemical
      $(document).on('click','#find_chemical', function(){
        $("#add_combine_solution").attr('style','display:none;');
        $("#add_solution").attr('style','display:block;');    

        var activity_type = $('#activity_type').val();
        var problem_area = $('#problem_area').val();
        var problem_type = $('#problem_type').val();
        var problem = $('#problem').val();
        if(activity_type == '' || problem_area == '' || problem_type == '')
        {
          if(activity_type == ''){
            alert('Please Select Activity Type!');
          }
          if(problem_area == ''){
            alert('Please Select Problem Area!');
          }
          if(problem_type == ''){
            alert('Please Select Problem Type!');
          }
        }
        else
        {
           $.ajax({
           url:"<?php echo base_url(); ?>vendor/find_solution_ajax",
           method:"POST",
           data:{activity_type:activity_type,problem_area:problem_area,problem_type:problem_type,problem:problem},
           success:function(data)
           {
            $('#solution_tbl').html(data);
            $("#solution").attr('style','display:block;');
           }  
          });
        }
      });
      var or_solution_val=false;
      $(document).on('click','#OR_chemical', function(){
        if(or_solution_val == true)
        {
          or_solution_val = false;  
        }
        else
        {
          or_solution_val = true;   
        }
        
        $("#solution_tbl").html("");
        $("#activity_type").val("").trigger('change');
        $("#problem_area").val("").trigger('change');
        $("#chemical2").attr('style','display:block;');

      });
      //add solution
      $(document).on('click','.add_solution_class', function(){
          var sol_date = $('#sol_date').val();
          var btn_id = $(this).attr('id');
          if(sol_date == ''){
              alert('Please Select Date!');
          }
          else
          {
              var chem1_arr=[];
              var dosage_arr = [];
              $("input[id^='cchq_']").each(function(){
                 var num_val = $(this).data('i');
                 var dosage_val = $('#dose_'+num_val).val();
                 if($(this). prop("checked") == true)
                 {
                    chem1_arr.push(num_val);
                    dosage_arr.push(dosage_val);
                 }
              });
              
              if(chem1_arr.length > 0)
              {
                var chem1_arr = chem1_arr.toString();
                var dosage_arr = dosage_arr.toString();
                //var rowCount = $('#myTable tr').length;
                 $.ajax({
                 url:"<?php echo base_url(); ?>vendor/add_solution_ajax",
                 method:"POST",
                 data:{chem1_arr:chem1_arr,dosage_arr:dosage_arr,btn_id:btn_id,date:sol_date},
                 success:function(data)
                 {
                    if(or_solution_val == true)
                    {
                      $('#chemical2_msg_tbl').append(data);
                      $("#chemical2").attr('style','display:block;');    
                    }
                    else
                    {
                      $('#chemical1_msg_tbl').append(data);
                      $("#chemical1").attr('style','display:block;');  
                    }
                    $("#sol_date").attr("disabled",true); 
                 }
                });  
              }  
              else
              {
                alert('Please Select Chemicals!');
              }
          }
      });
     //send message
     $(document).on('click','#send', function(){
        var chat_msg = $('#chat_msg').val();
        var my_msg = {};

        my_msg['message'] = chat_msg;

        //set id of chemical 1
        var solution = {};

        var chem1_row = $('#chemical1_msg_tbl tr').length;
        if(chem1_row > 0){
          var chemical1 = 0;
          $("#chemical1_msg_tbl tr td input").each(function(){
            chemical1++; $(this).attr('id','sol1_'+chemical1);
          }); 
          //solution 1
           var solution1 = [];
           $("input[id^='sol1_']").each(function(){
                var sol_chemical = {};
                sol_chemical['solution'] = 'sol 1';
                sol_chemical['date'] = $(this).data('date');
                sol_chemical['activity_type'] = $(this).data('activity_type');
                sol_chemical['problem'] = $(this).data('problem');
                sol_chemical['chemical'] = $(this).data('chemical');
                sol_chemical['dosage'] = $(this).data('dosage');
                //sol_chemical.push({'dosage':$(this).data('dosage')});
                solution1.push(sol_chemical);
            });
           solution['solution1'] = solution1;
        }

        var chem2_row = $('#chemical2_msg_tbl tr').length;
        if(chem2_row > 0){
          var chemical2 = 0;
          $("#chemical2_msg_tbl tr td input").each(function(){
            chemical2++; $(this).attr('id','sol2_'+chemical2);
          });
          //solution 1
           var solution2= [];
           $("input[id^='sol2_']").each(function(){
                var sol_chemical = {};
                sol_chemical['solution'] = 'sol 2';
                sol_chemical['date'] = $(this).data('date');
                sol_chemical['activity_type'] = $(this).data('activity_type');
                sol_chemical['problem'] = $(this).data('problem');
                sol_chemical['chemical'] = $(this).data('chemical');
                sol_chemical['dosage'] = $(this).data('dosage');
                solution2.push(sol_chemical);
            });
           solution['solution2'] = solution2;
        }

        var ref_row = $('#reference_tbl tr').length;
        if(ref_row > 0){
          var ref = 0;
          $("#reference_tbl tr td input").each(function(){
            ref++; $(this).attr('id','ref_'+ref);
          });
          //solution 1
           var reference_subtopic= [];
           $("input[id^='ref_']").each(function(){
                var subtopic_id = $(this).data('i');
                reference_subtopic.push(subtopic_id);
            });
           my_msg['reference'] = reference_subtopic.toString();
        }

        my_msg['solution'] = solution;
        $("#message").val(JSON.stringify(my_msg));
        //set id of chemical 2
        var advisory_id = '<?php echo $advisory_id; ?>';
        var farmer_id = '<?php echo $request_data->farmer_id; ?>';
        $.ajax({
            url:"<?php echo base_url(); ?>vendor/save_message_ajax",
            method:"POST",
            data:{advisory_id:advisory_id,farmer_id:farmer_id,message:$("#message").val()},
            success:function(data)
            {
              if(data == 1)
              {
                location.reload();
              }
            }
        });  
     }); 
     //start reference 
      $(document).on('click', '#reference_yes', function(){
          $("#modalReference").modal('show');
      });
      $(document).on('change', '#crop_list', function(){
        var crop_val = $('#crop_list').val();
         $.ajax({
           url:"<?php echo base_url(); ?>vendor/topic_by_crop_ajax",
           method:"POST",
           data:{crop_val:crop_val},
           success:function(data)
           {
             $('#topic_list').html(data);
           }
         });
      });
      $(document).on('change', '#topic_list', function(){
        var topic_val = $('#topic_list').val();
         $.ajax({
           url:"<?php echo base_url(); ?>vendor/subtopic_by_topic_ajax",
           method:"POST",
           data:{topic_val:topic_val},
           success:function(data)
           {
             $('#subtopic_list').html(data);
           }
         });
      });
      //add subtopic
      var subtopic_arr = [];
      $(document).on('click', '#add_subtopic', function(){
        var crop_val = $('#crop_list').val();
        var topic_val = $('#topic_list').val();
        var subtopic_val = $('#subtopic_list').val();
        var subtopic_title = $('#subtopic_list option:selected').html();

        if(jQuery.inArray(subtopic_val, subtopic_arr)!='-1'){ 
          alert("Subtopic is already added!");
        }else{ 
          subtopic_arr.push(subtopic_val);

          var html = "<tr><td>"+subtopic_title+"<input type='hidden' data-i='"+subtopic_val+"' data-title='"+subtopic_title+"'></td><td><button data-i='"+subtopic_val+"' class='btn btn-primary sb_remove_btn'><i class='fa fa-trash'></i></td></tr>";

          $('#all_subtopic_tbl').append(html);
          $("#all_subtopic").attr('style','display:block;');  
        }
      });
      //subtopic remove 
      $(document).on('click', '.sb_remove_btn', function(){
        var subtopic_val = $(this).data('i');
        subtopic_arr.splice( jQuery.inArray(subtopic_val, subtopic_arr), 1 );
        $(this).closest("tr").remove();
      });
      //subtopic add to message
      $(document).on('click', '#add_reference', function(){
        if(subtopic_arr.length == 0)
        {
          alert("You should add at least One SubTopic!");
        }
        else
        {
          var sb_topic_tbl = $('#all_subtopic_tbl').html(); 
          $('#reference_tbl').html(sb_topic_tbl);
          $("#reference").attr('style','display:block;');  
          $("#modalReference").modal('hide');
        }
      });
     
      //end reference

    //end script   
  });
</script>
<!-- START reference MODAL -->
<div class="modal fade in" id="modalReference">
  <div class="modal-dialog modal-lg" >
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Add Reference</h4>
      </div>
      <!-- start body -->
        <div class="modal-body">
          <!-- start -->
          <div class="col-md-12">
            <div class="col-md-6">
              <div class="form-group">
                <label>Select Crop</label>
                <?php $crop=$obj->cropmodel->get_all_crop(); ?>
                <select class="form-control" id="crop_list">
                <option value="">Select Crop</option>
                <?php if(count($crop) > 0){ ?>
                <?php foreach ($crop as $row) { ?>
                  <option value="<?php echo $row->crop_id; ?>"><?php echo $row->en_crop_name ?></option>
                <?php } ?>  
                <?php } ?>
                </select>
              </div>  
            </div>  
            <div class="col-md-6">
              <div class="form-group">
                <label>Select Topic</label>
                <select class="form-control" id="topic_list"></select>
              </div>  
            </div>  
        </div>  
        <!-- start -->
        <div class="col-md-12">
          <div class="col-md-12">
            <div class="form-group">
                <label>Select SubTopic</label>
                <select class="form-control" id="subtopic_list"></select>
            </div> 
          </div>  
        </div>
        <div class="col-md-12">
          <button class="btn btn-primary" id="add_subtopic">Add Subtopic</button>
          <hr>
          <div class="col-md-6">
              <div id="all_subtopic" class="table-responsive" style="display: none">
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr><th>SubTopic</th><th>Action</th></tr>
                  </thead>  
                  <tbody id="all_subtopic_tbl">
                  </tbody>
                </table> 
              </div>
          </div>    
        </div>  
        <!-- end -->
      </div>  
        <div class="modal-footer">
          <button class="btn btn-primary btnclass" id="add_reference">Add to Message</button>
        </div>
      <!-- end body -->
    </div>
  </div>
</div>
<!-- END reference model -->
<!-- START change status MODAL -->
<div class="modal fade in" id="modalStatus">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Change Status</h4>
      </div>
      <form method="post" action="<?php echo base_url('vendor/change-advisory-request-status'); ?>">
        <div class="modal-body">
          <div class="form-group">
            <?php $stat_arr=array('Closed'); ?>
            <select class="form-control" name="status">
              <?php foreach ($stat_arr as $stat_val) { ?>
                <?php if($request_data->advisory_status == $stat_val){$selected = 'selected';} ?>
                <option value="<?php echo $stat_val; ?>" <?php echo $selected; ?> ><?php echo $stat_val; ?></option> 
              <?php } ?>
            </select>
          </div>  
        </div>
        <div class="modal-footer">
          <input type="hidden" name="advisory_id" value="<?php echo $advisory_id; ?>">
          <input type="hidden" name="id" value="">
          <input type="submit" class="btn btn-primary btnclass" value="Change Status">
        </div>
      </form>
    </div>
  </div>
</div>
<!-- END change status model -->
<!-- START change status Follow up -->
<div class="modal fade in" id="modalFollowUp">
  <div class="modal-dialog" >
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Apply Follow Up Date</h4>
      </div>
      <form method="post" action="<?php echo base_url('vendor/change-advisory-followup-status'); ?>">
        <div class="modal-body">
          <div class="form-group">
            <label>Follow Up Date</label>
            <div class="input-group date">
              <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
              <?php if($request_data->follow_up_date == '0000-00-00'){ ?>
                <input type="text" name="follow_up_date" class="form-control" id="follow_up_date" autocomplete="off" required>
              <?php }else{ ?>
                <input type="text" value="<?php echo date('d/m/Y',strtotime($request_data->follow_up_date)); ?>" name="follow_up_date" class="form-control" id="follow_up_date" autocomplete="off" required>
              <?php } ?>
            </div>
          </div>     
        </div>
        <div class="modal-footer">
          <input type="hidden" name="advisory_id" value="<?php echo $advisory_id; ?>">
          <input type="submit" class="btn btn-primary btnclass" value="Follow Up">
        </div>
      </form>
    </div>
  </div>
</div>
<!-- END change status Follow up -->
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
