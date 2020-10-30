<style type="text/css">
  .nav-pills .nav-link.active, .nav-pills .show>.nav-link {
    color: #fff;
    background-color: #e84444;
}
</style>
<section class="page-title overlay" style="background-image: url(<?php echo SITE_URL; ?>assets/images/background/page-title.jpg);">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="text-white font-weight-bold">Dashboard</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="<?php echo base_url(); ?>">Home</a>
                    </li>
                    <li>Dashboard</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="section">
  <div class="main">
    <div class="container">
      <!-- BEGIN SIDEBAR & CONTENT -->
      <div class="row margin-bottom-40">
        <!-- BEGIN CONTENT -->
        <div class="col-md-12">
          <h3>Dashboard</h3>
          <div class="content-page">
            <div class="row">
              <div class="col-md-2 mb-3">
                <ul class="nav nav-pills flex-column" id="myTab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profile</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="plot-tab" data-toggle="tab" href="#plot" role="tab" aria-controls="plot" aria-selected="false">Plots</a>
                  </li>
                   <li class="nav-item">
                    <a class="nav-link" id="knowledge-bank-tab" data-toggle="tab" href="#knowledge_bank" role="tab" aria-controls="knowledge-bank" aria-selected="false">Knowledge Bank</a>
                  </li>
                </ul>
              </div>
              <!-- /.col-md-4 -->
              <div class="col-md-10">
                <div class="tab-content" id="myTabContent">
                  <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="form-inline">
                      <h2>Profile</h2>
                      <button class="btn btn-primary btn-sm" type="button" id="edit" style="margin-left: 10px;">Edit</button>
                    </div>
                    <?php if($this->session->flashdata('img_error')): ?>
                      <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?php echo $this->session->flashdata('img_error'); ?>
                      </div>
                    <?php endif ?>
                    <?php if($this->session->flashdata('update_success')): ?>
                        <div class="alert alert-success alert-dismissible">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <?php echo $this->session->flashdata('update_success'); ?>
                        </div>
                    <?php endif ?>
                     <form action="<?php echo base_url(); ?>update-profile" method="post" enctype="multipart/form-data" class="row">
                        <div class="col-lg-12">
                          <input type="hidden" name="id" value="<?php echo $user['user_id']; ?>">
                        </div>
                        <div class="col-lg-4">
                          <?php echo form_error('first_name'); ?>
                          <input type="text" name="first_name" id="first_name" class="form-control" placeholder="First Name" value="<?php echo $user['first_name']; ?>" disabled>
                        </div>
                        <div class="col-lg-4">
                          <?php echo form_error('middle_name'); ?>
                          <input type="text" name="middle_name" id="middle_name" class="form-control" placeholder="Middle Name" value="<?php echo $user['middle_name']; ?>" disabled>
                        </div>
                        <div class="col-lg-4">
                          <?php echo form_error('last_name'); ?>
                          <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Last Name" value="<?php echo $user['last_name']; ?>" disabled>
                        </div>
                        <div class="col-lg-12">
                          <?php echo form_error('profile_image'); ?>
                          <input type="file" name="profile_image" id="profile_image" class="form-control" disabled>
                        </div>
                        <?php if(empty($user['profile_image'])){?>
                          <div class="col-lg-12">
                              <img src="<?php echo base_url('uploads/user_profiles/default.png'); ?>" alt="Profile Image" width="100" height="100" style="margin-bottom: 15px;">
                          </div>
                        <?php }else{ ?>
                          <div class="col-lg-12">
                              <img src="<?php echo base_url('uploads/user_profiles/'.$user['profile_image']); ?>" alt="Profile Image" width="100" height="100" style="margin-bottom: 15px;">
                          </div>
                        <?php } ?>
                        <div class="col-lg-6">
                          <?php echo form_error('birth_date'); ?>
                            <input type="text" name="birth_date" id="birth_date" class="form-control" placeholder="Birth Date" value="<?php echo $user['birth_date']; ?>" disabled>
                        </div>
                        <div class="col-lg-6">
                            <input type="text" name="age" id="age" class="form-control" placeholder="Age" value="<?php echo $age; ?>" disabled>
                        </div>
                        <div class="col-lg-6">
                          <?php echo form_error('gender'); ?>
                            <select id="gender" name="gender" class="form-control" disabled>
                              <option value="">--Select Gender--</option>
                              <option value="male" <?php if($user['gender'] == 'male'){ echo 'selected';} ?>>Male</option>
                              <option value="female" <?php if($user['gender'] == 'female'){ echo 'selected';} ?>>Female</option>
                              <option value="transgender" <?php if($user['gender'] == 'transgender'){ echo 'selected';} ?>>Transgender</option>
                            </select>
                        </div>
                        <div class="col-lg-6">
                          <?php echo form_error('pincode'); ?>
                            <input type="text" name="pincode" id="pincode" class="form-control" placeholder="Pincode" value="<?php echo $user['pincode']; ?>" disabled>
                        </div>
                        <div class="col-lg-6">
                          <?php echo form_error('state'); ?>
                            <input type="text" name="state" id="state" class="form-control" placeholder="State" value="<?php echo $user['state']; ?>" disabled>
                        </div>
                        <div class="col-lg-6">
                          <?php echo form_error('district'); ?>
                            <input type="text" name="district" id="district" class="form-control" placeholder="District" value="<?php echo $user['district']; ?>" disabled>
                        </div>
                        <div class="col-lg-6">
                          <?php echo form_error('city'); ?>
                            <input type="text" name="city" id="city" class="form-control" placeholder="City" value="<?php echo $user['city']; ?>" disabled>
                        </div>
                        <div class="col-lg-6">
                          <?php echo form_error('village'); ?>
                            <input type="text" name="village" id="village" class="form-control" placeholder="Village" value="<?php echo $user['village']; ?>" disabled>
                        </div>
                        <div class="col-lg-12">
                            <button class="btn btn-primary btn-sm" type="submit" id="submit" value="send" style="display: none;">Update</button>
                        </div>
                    </form>
                  </div>
                  <div class="tab-pane fade" id="plot" role="tabpanel" aria-labelledby="plot-tab">
                    <div class="form-inline">
                      <h2>Plots</h2>
                          <a class="btn btn-primary btn-sm" href="<?php echo base_url(); ?>create-plot" style="color: white;margin-left: 10px;">Add</a>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive">
                      <?php if($this->session->flashdata('success')): ?>
                        <div class="alert alert-success alert-dismissible">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <?php echo $this->session->flashdata('success'); ?>
                        </div>
                      <?php endif ?>
                      <table id="plots_table" class="table table-responsive table-bordered table-striped">
                        <thead>
                        <tr>
                          <th>S/R No.</th>
                          <th>Ploats Name</th>
                          <th>Crop</th>
                          <th>Variety</th>
                          <th>Area of Plot</th>
                          <th>Plot Area Unit</th>
                          <th>Pincode</th>
                          <th>State</th>
                          <th>District</th>
                          <th>City</th>
                          <th>Village</th>
                          <th>Row_to_Row Distance</th>
                          <th>Plant_to_Plant Distance</th>
                          <th>Spacing Unit</th>
                          <th>No. of Plant</th>
                          <th>Planting Date</th>
                          <th>Age of Plant</th>
                          <th>Planting Method</th>
                          <th>Planting Material</th>
                          <th>Defoliation Date</th>
                          <th>First Irrigation Date</th>
                          <th>Last Year Average Plant(kg)</th>
                          <th>This Year Expected Average Plant(kg)</th>
                          <th>Irrigation Source</th>
                          <th>Irrigation Type</th>
                          <th>No. of Laterals Per Plant</th>
                          <th>Lateral Type</th>
                          <th>Dripper Spacing(cm)</th>
                          <th>No. of Drippers Per Plant</th>
                          <th>Dripper Discharge Liter Hour</th>
                          <th>Filtration System</th>
                          <th>Fertigation Equipment</th>
                          <th>Mulching Type</th>
                          <th>Paper Width(Meter)</th>
                          <th>Paper Thickness(Micron)</th>
                          <th>Soil_Type</th>
                          <th>Water Source</th>
                          <th>Prevalent Disease</th>
                          <th>Bacterial Blight Intensity</th>
                          <th>No. of Plant Affected</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php 
                          $id = 1;
                          if(!empty($plots) && isset($plots)){ 
                          foreach($plots as $row) {  
                        ?>
                          <tr>
                            <td><?php echo $id++; ?></td>
                            <td><?php echo $row['plot_name']; ?></td>
                            <td><?php echo $row['crop_name']; ?></td>
                            <td><?php echo $row['variety_name']; ?></td>
                            <td><?php echo $row['area_of_plot']; ?></td>
                            <td><?php echo $row['plot_area_unit']; ?></td>
                            <td><?php echo $row['pincode']; ?></td>
                            <td><?php echo $row['state']; ?></td>
                            <td><?php echo $row['district']; ?></td>
                            <td><?php echo $row['city']; ?></td>
                            <td><?php echo $row['village']; ?></td>
                            <td><?php echo $row['row_to_row_distance']; ?></td>
                            <td><?php echo $row['plant_to_plant_distance']; ?></td>
                            <td><?php echo $row['spacing_unit']; ?></td>
                            <td><?php echo $row['num_of_plant']; ?></td>
                            <td><?php echo $row['planting_date']; ?></td>
                            <td><?php echo $row['age_of_plant']; ?></td>
                            <td><?php echo $row['planting_method']; ?></td>
                            <td><?php echo $row['planting_material']; ?></td>
                            <td><?php echo $row['defoliation_date']; ?></td>
                            <td><?php echo $row['first_irrigation_date']; ?></td>
                            <td><?php echo $row['last_year_average_plant_kg']; ?></td>
                            <td><?php echo $row['this_year_expected_average_plant_kg']; ?></td>
                            <td><?php echo $row['irrigation_source_ids']; ?></td>
                            <td><?php echo $row['irrigation_type']; ?></td>
                            <td><?php echo $row['num_of_laterals_per_plant']; ?></td>
                            <td><?php echo $row['lateral_type']; ?></td>
                            <td><?php echo $row['dripper_spacing_cm']; ?></td>
                            <td><?php echo $row['num_of_drippers_per_plant']; ?></td>
                            <td><?php echo $row['dripper_discharge_liter_hour']; ?></td>
                            <td><?php echo $row['filtration_system_ids']; ?></td>
                            <td><?php echo $row['fertigation_equipment_ids']; ?></td>
                            <td><?php echo $row['mulching_type']; ?></td>
                            <td><?php echo $row['paper_width_in_meter']; ?></td>
                            <td><?php echo $row['paper_thickness_in_micro']; ?></td>
                            <td><?php echo $row['soil_type']; ?></td>
                            <td><?php echo $row['water_source']; ?></td>
                            <td><?php echo $row['prevalent_disease']; ?></td>
                            <td><?php echo $row['bacterial_blight_intensity_id']; ?></td>
                            <td><?php echo $row['num_of_plant_affected']; ?></td>
                          </tr>                  
                        <?php } ?>    
                        <?php } ?>
                        </tbody>
                      </table>
                    </div>
                    <!-- /.box-body -->
                  </div>
                  <div class="tab-pane fade" id="knowledge_bank" role="tabpanel" aria-labelledby="knowledge-bank-tab">
                    <h2>Knowledge Bank</h2>                        
                    <div class="col-md-6 col-xm-2">
                     <h3>Select Crops</h3>
                      <select class="form-control select2" name="crop" id="crop">
                        <option value="" hidden>Select Crop</option>
                        <?php foreach ($crops as $key => $val) { ?>
                          <option value="<?php echo $val['crop_id']; ?>"><?php echo $val['en_crop_name']; ?></option>
                        <?php } ?>
                      </select>
                    </div>  
                  </div>
                </div>
              </div>
            <!-- /.col-md-8 -->
            </div>   
          </div>
        </div>
        <!-- END CONTENT -->
      </div>
    </div>
  </div>
</section>
<script src="http://code.jquery.com/jquery-1.6.2.min.js"></script>
<script type="text/javascript">
$(document).ready(function() { 
  // $("#plots_table").DataTable({  
  // });
  // $('#crop').selectpicker();
  $("#edit").click(function(){ 
    $("#first_name").prop("disabled", false);
    $("#middle_name").prop("disabled", false);
    $("#last_name").prop("disabled", false); 
    $("#profile_image").prop("disabled", false);
    $("#birth_date").prop("disabled", false);
    $("#gender").prop("disabled", false);
    $("#pincode").prop("disabled", false);
    $("#state").prop("disabled", false);
    $("#district").prop("disabled", false);
    $("#city").prop("disabled", false);
    $("#village").prop("disabled", false);
    $('#edit').remove();
    document.getElementById('submit').style.display = 'block';
  });  

  $("#birth_date").change(function(){ 
    var birth_date = $('#birth_date').val();
    $.ajax({
      type:'post',
      url:"<?php echo base_url(); ?>get-age-of-user",
      data:{birth_date:birth_date},
      success:function(res){
        $('#age').val(res);
      }
    });
  });
});
</script>