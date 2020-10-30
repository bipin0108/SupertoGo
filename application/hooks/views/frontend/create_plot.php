<div class="container">
  <div class="row">
    <div class="br-pagebody" style="width: 100%;margin: 0px;">

      <div class="br-section-wrapper">
        <div class="col-md-6 col-xm-2">
        <h3>Select Crops</h3>
        <select class="form-control" multiple="multiple" name="mcrop[]" data-placeholder="Select Crops" id="mcrop">
          <?php foreach ($crops as $key => $val) { ?>
            <option value="<?php echo $val['crop_id']; ?>"><?php echo $val['en_crop_name']; ?></option>
          <?php } ?>
        </select>
      </div>
      <div id="cropform" style="margin-top: 15px;">
        <h3 class="br-section-text">You can create Plot easily.</h3>
        <form method="post" action="<?php echo base_url(); ?>create-plot" id="frmcrop" enctype="multipart/form-data">
          <div id="wizard2">

          <!--Registration -->
            <h3>Registration Details</h3>
            <section>
              <div class="form-group wd-xs-300">
                <label class="form-control-label">Ploat name: <span class="tx-danger">*</span></label>
                <input id="ploatname" class="form-control" name="ploatname" placeholder="Enter Ploat name" type="text" value="" required>
              </div><!-- form-group -->
              <div class="form-group wd-xs-300">
                <label class="form-control-label">Crops: <span class="tx-danger">*</span></label>
                <select id="crops" name="crops" class="form-control" required>
                  <option value="" disabled selected hidden>Select Crops</option>
                  
                </select>
              </div><!-- form-group -->
              <div class="form-group wd-xs-300">
                <label class="form-control-label">Variety: <span class="tx-danger">*</span></label>
                <select id="variety" name="variety" class="form-control" required>
                  <option value="" disabled selected hidden>Select Variety</option>
                </select>
              </div><!-- form-group -->
              <div class="form-group wd-xs-300">
                <label class="form-control-label">Area of Ploat: <span class="tx-danger">*</span></label>
                <input id="areaofploat" class="form-control" name="areaofploat" placeholder="Enter area of ploat" type="text" value="" required>
              </div><!-- form-group -->
              <div class="form-group wd-xs-300">
                <label class="form-control-label">Area Unit: <span class="tx-danger">*</span></label>
               <select id="areaunit" name="areaunit" class="form-control" required>
                  <option value="" disabled selected hidden>Select Unit</option>
                  <?php foreach ($plot_area_unit as $key => $val) { ?>
                    <option value="<?php echo $val['id']; ?>"><?php echo $val['en_name']; ?></option>
                  <?php } ?>
                </select>
              </div><!-- form-group -->
              <div class="form-group wd-xs-300">
                <label class="form-control-label">Pincode: <span class="tx-danger">*</span></label>
                <input id="pincode" class="form-control" name="pincode" placeholder="Enter Pincode" type="text" value="" required>
                <?php echo form_error('pincode'); ?>
              </div><!-- form-group -->
              <div class="form-group wd-xs-300">
                <label class="form-control-label">State: <span class="tx-danger">*</span></label>
                <input id="state" class="form-control" name="state" placeholder="Enter State" type="text" value="" required>
              </div><!-- form-group -->
              <div class="form-group wd-xs-300">
                <label class="form-control-label">District: <span class="tx-danger">*</span></label>
                <input id="district" class="form-control" name="district" placeholder="Enter District" type="text" value="" required>
              </div><!-- form-group -->
              <div class="form-group wd-xs-300">
                <label class="form-control-label">City: <span class="tx-danger">*</span></label>
                <input id="city" class="form-control" name="city" placeholder="Enter City" type="text" value="" required>
              </div><!-- form-group -->
              <div class="form-group wd-xs-300">
                <label class="form-control-label">Village: <span class="tx-danger">*</span></label>
                <input id="village" class="form-control" name="village" placeholder="Enter Village" type="text" value="" required>
              </div><!-- form-group -->
            </section>

            <!-- Basic Details -->
            <h3>Basic Details</h3>
            <section>
              <div class="form-group wd-xs-300">
                <label class="form-control-label">Row To Row Distance: <span class="tx-danger">*</span></label>
                <input id="row2rowdist" class="form-control" name="row2rowdist" placeholder="Enter Row To Row Distance" type="text" value="" required>
              </div><!-- form-group -->
              <div class="form-group wd-xs-300">
                <label class="form-control-label">Plant To Plant Distance: <span class="tx-danger">*</span></label>
                <input id="plant2plantdist" class="form-control" name="plant2plantdist" placeholder="Enter Plant To Plant Distance" type="text" value="" required>
              </div><!-- form-group -->
              <div class="form-group wd-xs-300">
                <label class="form-control-label">Spacing Unit: <span class="tx-danger">*</span></label>
                <select id="spacingunit" name="spacingunit" class="form-control" required>
                  <option value="" disabled selected hidden>Select Unit</option>
                  <?php foreach ($spacing_unit as $key => $val) { ?>
                    <option value="<?php echo $val['id']; ?>"><?php echo $val['en_name']; ?></option>
                  <?php } ?>
                </select>
              </div><!-- form-group -->
              <div class="form-group wd-xs-300">
                <label class="form-control-label">Total No. of Plants: <span class="tx-danger">*</span></label>
                <input id="no_of_plants" class="form-control" name="no_of_plants" placeholder="Enter Number of Plants" type="number" min="1" value="" required>
              </div><!-- form-group -->
              <div class="form-group wd-xs-300">
                <label class="form-control-label">Planting Date: <span class="tx-danger">*</span></label>
                <input id="planting_date" class="form-control" name="planting_date" placeholder="Enter Planting Date" type="text" value="" required>
              </div><!-- form-group -->
              <div class="form-group wd-xs-300">
                <label class="form-control-label">Age of Plant: <span class="tx-danger">*</span></label>
                <input id="age_of_plant" class="form-control" name="age_of_plant" placeholder="Age of Plant" type="text" value="" required disabled>
              </div><!-- form-group -->
              <div class="form-group wd-xs-300">
                <label class="form-control-label">Planting Method: <span class="tx-danger">*</span></label>
                <select id="plantingmethod" name="plantingmethod" class="form-control" required>
                  <option value="" disabled selected hidden>Select Method</option>
                  <?php foreach ($planting_method as $key => $val) { ?>
                    <option value="<?php echo $val['id']; ?>"><?php echo $val['en_name']; ?></option>
                  <?php } ?>
                </select>
              </div><!-- form-group -->
              <div class="form-group wd-xs-300">
                <label class="form-control-label">Planting Material: <span class="tx-danger">*</span></label>
                <select id="plantingmaterial" name="plantingmaterial" class="form-control" required>
                  <option value="" disabled selected hidden>Select Material</option>
                  <?php foreach ($planting_material as $key => $val) { ?>
                    <option value="<?php echo $val['id']; ?>"><?php echo $val['en_name']; ?></option>
                  <?php } ?>
                </select>
              </div><!-- form-group -->
              <div class="form-group wd-xs-300">
                <label class="form-control-label">Defoliation Date: <span class="tx-danger">*</span></label>
                <input id="defoliation_date" class="form-control" name="defoliation_date" placeholder="Enter Defoliation Date" type="text" value="" required>
              </div><!-- form-group -->
               <div class="form-group wd-xs-300">
                <label class="form-control-label">First Irrigation Date: <span class="tx-danger">*</span></label>
                <input id="first_irrigation_date" class="form-control" name="first_irrigation_date" placeholder="Enter First Irrigation Date" type="text" value="" required>
              </div><!-- form-group -->
              <div class="form-group wd-xs-300">
                <label class="form-control-label">Last Year average yield per plant in KG: <span class="tx-danger">*</span></label>
                <input id="last_year_average_plant_kg" class="form-control" name="last_year_average_plant_kg" placeholder="Enter Last Year average yield per plant in KG" type="number" min="1" value="" required>
              </div><!-- form-group -->
              <div class="form-group wd-xs-300">
                <label class="form-control-label">This Year expected average yield per plant in KG: <span class="tx-danger">*</span></label>
                <input id="this_year_expected_average_plant_kg" class="form-control" name="this_year_expected_average_plant_kg" placeholder="Enter This Year expected average yield per plant in KG" type="number" min="1" value="" required>
              </div><!-- form-group -->
            </section>

            <!-- Irrigation Details -->
            <h3>Irrigation Details</h3>
            <section>
               <div class="form-group wd-xs-300">
                <label class="form-control-label">Irrigation Source: <span class="tx-danger">*</span></label>
                <select class="" multiple name="irrigation_source[]" data-placeholder="Select Irrigation Source" id="irrigation_source" required>
                  <?php foreach ($irrigation_source as $key => $val) { ?>
                    <option value="<?php echo $val['id']; ?>"><?php echo $val['en_name']; ?></option>
                  <?php } ?>
                </select>
              </div><!-- form-group -->
              <div class="form-group wd-xs-300">
                <label class="form-control-label">Irrigation Type: <span class="tx-danger">*</span></label>
                <select id="irrigation_type" name="irrigation_type" class="form-control" required>
                  <option value="" disabled selected hidden>Select Irrigation Type</option>
                  <option value="drip">Drip</option>
                  <option value="flood">Flood</option>
                </select>
              </div><!-- form-group -->
              <div class="form-group wd-xs-300">
                <label class="form-control-label">Number of Laterals per plant: <span class="tx-danger">*</span></label>
                <input id="number_of_laterals_per_plant" class="form-control" name="number_of_laterals_per_plant" placeholder="Enter Number of Laterals per plant" type="number" min="1" value="" required>
              </div><!-- form-group -->
              <div class="form-group wd-xs-300">
                <label class="form-control-label">Lateral Type: <span class="tx-danger">*</span></label>
                <select id="lateral_type" name="lateral_type" class="form-control" required>
                  <option value="" disabled selected hidden>Select Lateral Type</option>
                  <option value="online">Online</option>
                  <option value="inline">Inline</option>
                </select>
              </div><!-- form-group -->
              <div class="form-group wd-xs-300" id="ds" style="display: none">
                <label class="form-control-label">Dripper Spacing (CM): <span class="tx-danger">*</span></label>
                <input id="dripper_spacing" class="form-control" name="dripper_spacing" placeholder="Enter Dripper Spacing" type="text" value="" required>
              </div><!-- form-group -->
              <div class="form-group wd-xs-300" id="no_of_dripper_plants" style="display: none">
                <label class="form-control-label">Number of drippers per plant: <span class="tx-danger">*</span></label>
                <input id="number_of_drippers_per_plant" class="form-control" name="number_of_drippers_per_plant" placeholder="Enter Number of drippers per plant" type="number" min="1" value="" required>
              </div><!-- form-group -->
              
              <div class="form-group wd-xs-300">
                <label class="form-control-label">Dripper Discharge (liter/Hour): <span class="tx-danger">*</span></label>
                <input id="dripper_discharge" class="form-control" name="dripper_discharge" placeholder="Enter Dripper Discharge" type="number" min="1" value="" required>
              </div><!-- form-group -->
              <div class="form-group wd-xs-300">
                <label class="form-control-label">Filtration System: <span class="tx-danger">*</span></label>
                <select class="" multiple name="filtration_system[]" data-placeholder="Select Filtration System" id="filtration_system" required>
                  <?php foreach ($filtration_system as $key => $val) { ?>
                    <option value="<?php echo $val['id']; ?>"><?php echo $val['en_name']; ?></option>
                  <?php } ?>
                </select>
              </div><!-- form-group -->
              <div class="form-group wd-xs-300">
                <label class="form-control-label">Fertigation Equipment: <span class="tx-danger">*</span></label>
                <select class="" multiple name="fertigation_equipment[]" data-placeholder="Select Fertigation Equipment" id="fertigation_equipment" required>
                  <?php foreach ($fertigation_equipment as $key => $val) { ?>
                  <option value="<?php echo $val['id']; ?>"><?php echo $val['en_name']; ?></option>
                  <?php } ?>
                </select>
              </div><!-- form-group -->
            </section>

            <!-- Mulching Details -->
            <h3>Mulching Details</h3>
            <section>
              <div class="form-group wd-xs-300">
                <label class="form-control-label">Mulching Type: <span class="tx-danger">*</span></label>
                <select id="mulching_type" name="mulching_type" class="form-control" required>
                  <option value="" disabled selected hidden>Select Mulching Type</option>
                  <option value="plastic">Plastic</option>
                  <option value="organic">Organic</option>
                  <option value="no_mulch">No Mulch</option>
                </select>
              </div><!-- form-group -->
              <div class="form-group wd-xs-300" style="display: none" id="pw">
                <label class="form-control-label">Paper Width (Meter): <span class="tx-danger">*</span></label>
                <input id="paper_width" class="form-control" name="paper_width" placeholder="Enter Paper Width" type="text" value="" required>
              </div><!-- form-group -->
              <div class="form-group wd-xs-300" style="display: none" id="pt">
                <label class="form-control-label">Paper Thickness (Micron): <span class="tx-danger">*</span></label>
                <input id="paper_thickness" class="form-control" name="paper_thickness" placeholder="Enter Paper Thickness" type="text" value="" required>
              </div><!-- form-group -->
            </section>
            <!-- Soil & Water Details -->
            <h3>Soil & Water Details</h3>
            <section>
              <div class="form-group wd-xs-300">
                <label class="form-control-label">Soil Type: <span class="tx-danger">*</span></label>
                <select id="soiltype" name="soiltype" class="form-control" required>
                  <option value="" disabled selected hidden>Select Soil Type</option>
                  <?php foreach ($soil_type as $key => $val) { ?>
                    <option value="<?php echo $val['id']; ?>"><?php echo $val['en_name']; ?></option>
                  <?php } ?>
                </select>
              </div><!-- form-group -->
              <div class="form-group wd-xs-300">
                <label class="form-control-label">Soil Test Images: <span class="tx-danger">*</span></label>
                <input type="file" name="soil_images[]" class="form-control" id="soil_images" accept=".jpg, .jpeg, .png" multiple required>
              </div><!-- form-group -->
              <div class="form-group wd-xs-300">
                <label class="form-control-label">Soil Test Docs: <span class="tx-danger">*</span></label>
                <input type="file" name="soil_docs[]" class="form-control" id="soil_docs" accept=".docx , .doc" multiple required>
              </div><!-- form-group -->
              <div class="form-group wd-xs-300">
                <label class="form-control-label">Water Source: <span class="tx-danger">*</span></label>
                <select id="water_source" name="water_source" class="form-control" required>
                  <option value="" disabled selected hidden>Select Water Source</option>
                  <?php foreach ($water_source as $key => $val) { ?>
                    <option value="<?php echo $val['id']; ?>"><?php echo $val['en_name']; ?></option>
                  <?php } ?>
                </select>
              </div><!-- form-group -->
              <div class="form-group wd-xs-300">
                <label class="form-control-label">Water Test Images: <span class="tx-danger">*</span></label>
                <input type="file" name="water_images[]" class="form-control" id="water_images" accept=".jpg, .jpeg, .png" multiple required>
              </div><!-- form-group -->
              <div class="form-group wd-xs-300">
                <label class="form-control-label">Water Tests Docs: <span class="tx-danger">*</span></label>
                <input type="file" name="water_docs[]" class="form-control" id="water_docs" accept=".docx , .doc" multiple required>
              </div><!-- form-group -->
            </section>

            <!-- Disease History -->
            <h3>Disease History</h3>
            <section>
              <div class="form-group wd-xs-300">
                <label class="form-control-label">Prevalent Disease: <span class="tx-danger">*</span></label>
                <select id="prevalent_disease" name="prevalent_disease" class="form-control" required>
                  <option value="" disabled selected hidden>Select Prevalent Disease</option>
                  <option value="bacterial_blight">Bacterial Blight</option>
                  <option value="wilt">Wilt</option>
                  <option value="both">Both</option>
                  <option value="none">None</option>
                </select>
              </div><!-- form-group -->
              <div class="form-group wd-xs-300" style="display: none" id="bbi">
                <label class="form-control-label">Bacterial Blight Intensity: <span class="tx-danger">*</span></label>
               <select id="bacterial_blight_intensity_id" name="bacterial_blight_intensity_id" class="form-control" required>
                  <option value="" disabled selected hidden>Select Bacterial Blight Intensity</option>
                  <?php foreach ($bacterial_blight_intensity as $key => $val) { ?>
                    <option value="<?php echo $val['id']; ?>"><?php echo $val['en_name']; ?></option>
                  <?php } ?>
                </select>
              </div><!-- form-group -->
              <div class="form-group wd-xs-300" style="display: none" id="nopa">
                <label class="form-control-label">Number of Plants affected: <span class="tx-danger">*</span></label>
                <input id="num_of_plant_affected" class="form-control" name="num_of_plant_affected" placeholder="Enter Number of Plants affected" type="number" min="1" value="" required>
              </div><!-- form-group -->
            </section>
          </div>
        </form>
      </div>
      </div>
    </div>
  </div>
</div>
  
<script src="<?php echo SITE_URL; ?>assets/js/jquery.js"></script>


  <script type="text/javascript">
    $(document).ready(function(){

          'use strict';
    $('#wizard2').steps({
          headerTag: 'h3',
          bodyTag: 'section',
          autoFocus: true,
          titleTemplate: '<span class="number">#index#</span> <span class="title">#title#</span>',
              onStepChanging: function (event, currentIndex, newIndex) {
                if(currentIndex < newIndex) {
                    // Step 1 form validation
                    if(currentIndex === 0) {
                      var pname = $('#ploatname').parsley();
                      var crops = $('#crops').parsley();
                      var variety = $('#variety').parsley();
                      var aop = $('#areaofploat').parsley();
                      var areaunit = $('#areaunit').parsley();
                      var pincode = $('#pincode').parsley();
                      var state = $('#state').parsley();
                      var district = $('#district').parsley();
                      var city = $('#city').parsley();
                      var village = $('#village').parsley();

                      if(pname.isValid() && crops.isValid() && variety.isValid() && aop.isValid() && areaunit.isValid() && pincode.isValid() && state.isValid() && district.isValid() && city.isValid() && village.isValid()) {
                        return true;
                      } else {
                        pname.validate();
                        crops.validate();
                        variety.validate();
                        aop.validate();
                        areaunit.validate();
                        pincode.validate();
                        state.validate();
                        district.validate();
                        city.validate();
                        village.validate();
                      }
                    }

                    // Step 2 form validation
                    if(currentIndex === 1) {
                      var row2rowdist = $('#row2rowdist').parsley();
                      var plant2plantdist = $('#plant2plantdist').parsley();
                      var spacingunit = $('#spacingunit').parsley();
                      var no_of_plants = $('#no_of_plants').parsley();
                      var planting_date = $('#planting_date').parsley();
                      var age_of_plant = $('#age_of_plant').parsley();
                      var plantingmethod = $('#plantingmethod').parsley();
                      var plantingmaterial = $('#plantingmaterial').parsley();
                      var defoliation_date = $('#defoliation_date').parsley();
                      var first_irrigation_date = $('#first_irrigation_date').parsley();
                      var last_year_average_plant_kg = $('#last_year_average_plant_kg').parsley();
                      var this_year_expected_average_plant_kg = $('#this_year_expected_average_plant_kg').parsley();

                      if(row2rowdist.isValid() && plant2plantdist.isValid() && spacingunit.isValid() && no_of_plants.isValid() && planting_date.isValid() && age_of_plant.isValid() && plantingmethod.isValid() && plantingmaterial.isValid() && defoliation_date.isValid() && first_irrigation_date.isValid() && last_year_average_plant_kg.isValid() && this_year_expected_average_plant_kg.isValid()) {
                         return true;
                      } else {
                        row2rowdist.validate();
                        plant2plantdist.validate();
                        spacingunit.validate();
                        no_of_plants.validate();
                        planting_date.validate();
                        age_of_plant.validate();
                        plantingmethod.validate();
                        plantingmaterial.validate();
                        defoliation_date.validate();
                        first_irrigation_date.validate();
                        last_year_average_plant_kg.validate();
                        this_year_expected_average_plant_kg.validate();
                      }
                    }

                    // Step 3 form validation
                    if(currentIndex === 2) {
                      var irrigation_type_val = $('#irrigation_type').val();

                      if (irrigation_type_val == "drip") {
                        var irrigation_source = $('#irrigation_source').parsley();
                        var number_of_laterals_per_plant = $('#number_of_laterals_per_plant').parsley();
                        var dripper_spacing = $('#dripper_spacing').parsley();
                        var number_of_drippers_per_plant = $('#number_of_drippers_per_plant').parsley();
                        var lateral_type_val = $('#lateral_type').val();

                        if (lateral_type_val == "inline") {
                          var dripper_spacing = $('#dripper_spacing').parsley();
                          var number_of_drippers_per_plant = $('#number_of_drippers_per_plant').parsley();

                          if(dripper_spacing.isValid() && number_of_drippers_per_plant.isValid()) {
                            return true;
                          } else {
                            dripper_spacing.validate();
                            number_of_drippers_per_plant.validate();
                          }
                        }else if (lateral_type_val == "online") {
                          var number_of_drippers_per_plant = $('#number_of_drippers_per_plant').parsley();

                          if(number_of_drippers_per_plant.isValid()) {
                            return true;
                          } else {
                            number_of_drippers_per_plant.validate();
                          }
                        }else{
                         var lateral_type = $('#lateral_type').parsley();

                          if(lateral_type.isValid()) {
                            return true;
                          } else {
                            lateral_type.validate();
                          }
                        }
                        var dripper_discharge = $('#dripper_discharge').parsley();
                        var filtration_system = $('#filtration_system').parsley();
                        var fertigation_equipment = $('#fertigation_equipment').parsley();
                        if(irrigation_source.isValid() && number_of_laterals_per_plant.isValid() && dripper_spacing.isValid() && number_of_drippers_per_plant.isValid() && dripper_discharge.isValid() && filtration_system.isValid() && fertigation_equipment.isValid()) {
                          return true;
                        } else {
                          irrigation_source.validate();
                          number_of_laterals_per_plant.validate();
                          dripper_spacing.validate();
                          number_of_drippers_per_plant.validate();
                          dripper_discharge.validate();
                          filtration_system.validate();
                          fertigation_equipment.validate();
                        }
                      }else if (irrigation_type_val == "flood") {
                        var irrigation_source = $('#irrigation_source').parsley();
                        var irrigation_type = $('#irrigation_type').parsley();
                        if(irrigation_source.isValid() && irrigation_type.isValid()) {
                          return true;
                        } else {
                          irrigation_source.validate();
                          irrigation_type.validate();
                        }
                      }else{
                        var irrigation_source = $('#irrigation_source').parsley();
                        var irrigation_type = $('#irrigation_type').parsley();
                        if(irrigation_source.isValid() && irrigation_type.isValid()) {
                          return true;
                        } else {
                          irrigation_source.validate();
                          irrigation_type.validate();
                        }
                      }
                    }

                    // Step 4 form validation
                    if(currentIndex === 3) {
                      var mulching_type_val = $('#mulching_type').val();

                      if (mulching_type_val == "plastic") {
                        var mulching_type = $('#mulching_type').parsley();
                        var paper_width = $('#paper_width').parsley();
                        var paper_thickness = $('#paper_thickness').parsley();

                        if(mulching_type.isValid() && paper_width.isValid() && paper_thickness.isValid()) {
                          return true;
                        } else {
                          mulching_type.validate();
                          paper_width.validate();
                          paper_thickness.validate();
                        }
                      }else{
                        var mulching_type = $('#mulching_type').parsley();
                    
                        if(mulching_type.isValid()) {
                          return true;
                        } else {
                          mulching_type.validate();
                        }
                      } 
                    }

                    // Step 5 form validation
                    if(currentIndex === 4) {
                      var soiltype = $('#soiltype').parsley();
                      var soil_images = $('#soil_images').parsley();
                      var soil_docs = $('#soil_docs').parsley();
                      var water_source = $('#water_source').parsley();
                      var water_images = $('#water_images').parsley();
                      var water_docs = $('#water_docs').parsley();
                      if(soiltype.isValid() && soil_images.isValid() && soil_docs.isValid() && water_source.isValid() && water_images.isValid() && water_docs.isValid()) {
                        return true;
                      } else {
                        soiltype.validate();
                        soil_images.validate();
                        soil_docs.validate();
                        water_source.validate();
                        water_images.validate();
                        water_docs.validate();
                      }
                    }
                // Always allow step back to the previous step even if the current step is not valid.
                } else { return true; }
              }
          });
  
      $('a[href = "#finish"]').click(function(){
        var prevalent_disease_val = $('#prevalent_disease').val();
        if (prevalent_disease_val == "bacterial_blight") {

          var prevalent_disease = $('#prevalent_disease').parsley();
          var bacterial_blight_intensity_id = $('#bacterial_blight_intensity_id').parsley();

          if(prevalent_disease.isValid() && bacterial_blight_intensity_id.isValid()) {
            $("#frmcrop").trigger('submit');
          } else {
            prevalent_disease.validate();
            bacterial_blight_intensity_id.validate();
          }
        }else if (prevalent_disease_val == "wilt") {

          var prevalent_disease = $('#prevalent_disease').parsley();
          var num_of_plant_affected = $('#num_of_plant_affected').parsley();

          if(prevalent_disease.isValid() && num_of_plant_affected.isValid()) {
            $("#frmcrop").trigger('submit');
          } else {
            prevalent_disease.validate();
            num_of_plant_affected.validate();
          }
        }else if (prevalent_disease_val == "both"){

          var prevalent_disease = $('#prevalent_disease').parsley();
          var bacterial_blight_intensity_id = $('#bacterial_blight_intensity_id').parsley();
          var num_of_plant_affected = $('#num_of_plant_affected').parsley();

          if(prevalent_disease.isValid() && bacterial_blight_intensity_id.isValid() && num_of_plant_affected.isValid()) {
            
            $("#frmcrop").trigger('submit');
          } else {
            prevalent_disease.validate();
            bacterial_blight_intensity_id.validate();
            num_of_plant_affected.validate();
          }
        }else{

          var prevalent_disease = $('#prevalent_disease').parsley();

          if(prevalent_disease.isValid()) {
            $("#frmcrop").trigger('submit');
          } else {
            prevalent_disease.validate();
          }
        }
      });

    });
    </script>
    <script type="text/javascript">
     $(document).ready(function(){

        $('#mcrop').selectpicker();
        $('#irrigation_source').selectpicker();
        $('#filtration_system').selectpicker();
        $('#fertigation_equipment').selectpicker();

        $('#lateral_type').change(function(){
          var type = $('#lateral_type').val();
          if (type == "inline") {
            document.getElementById('ds').style.display= "block";
            document.getElementById('no_of_dripper_plants').style.display= "block";
          }else{
            document.getElementById('ds').style.display= "none";
            document.getElementById('no_of_dripper_plants').style.display= "block";
          }
        });

        $('#mulching_type').change(function(){
          var type = $('#mulching_type').val();
          if (type == "plastic") {
            document.getElementById('pw').style.display= "block";
            document.getElementById('pt').style.display= "block";
          }else{
            document.getElementById('pw').style.display= "none";
            document.getElementById('pt').style.display= "none";
          }
        });

        $('#prevalent_disease').change(function(){
          var type = $('#prevalent_disease').val();
          if (type == "both") {
            document.getElementById('bbi').style.display= "block";
            document.getElementById('nopa').style.display= "block";
          }else if(type == "none"){
            document.getElementById('bbi').style.display= "none";
            document.getElementById('nopa').style.display= "none";
          }else if(type == "bacterial_blight"){
            document.getElementById('bbi').style.display= "block";
            document.getElementById('nopa').style.display= "none";
          }else{
             document.getElementById('bbi').style.display= "none";
            document.getElementById('nopa').style.display= "block";
          }
        });

        $("#irrigation_type").change(function(){ 
          var type = $('#irrigation_type').val();
          if (type == "drip") {
            $("#number_of_laterals_per_plant").prop("disabled", false);
            $("#lateral_type").prop("disabled", false);
            $("#dripper_spacing").prop("disabled", false); 
            $("#number_of_drippers_per_plant").prop("disabled", false);
            $("#dripper_discharge").prop("disabled", false);
            $("#filtration_system").prop("disabled", false);
            $("#fertigation_equipment").prop("disabled", false);
          }else{
            $("#number_of_laterals_per_plant").prop("disabled", true);
            $("#lateral_type").prop("disabled", true);
            $("#dripper_spacing").prop("disabled", true); 
            $("#number_of_drippers_per_plant").prop("disabled", true);
            $("#dripper_discharge").prop("disabled", true);
            $("#filtration_system").prop("disabled", true);
            $("#fertigation_equipment").prop("disabled", true);
          }
        });  

        $("#mcrop").change(function(){ 
          var crop_id = $('#mcrop').val();
          $.ajax({
            type:'post',
            url:"<?php echo base_url(); ?>get-crop",
            data:{crop_id:crop_id},
            success:function(res){
              $('#crops').html(res);
            }
          });
        });  

        $("#crops").change(function(){ 
          var crop_id = $('#crops').val();
          $.ajax({
            type:'post',
            url:"<?php echo base_url(); ?>get-variety",
            data:{crop_id:crop_id},
            success:function(res){
              $('#variety').html(res);
            }
          });
        });

        $("#planting_date").change(function(){ 
          var planting_date = $('#planting_date').val();
          $.ajax({
            type:'post',
            url:"<?php echo base_url(); ?>get-age-of-plant",
            data:{planting_date:planting_date},
            success:function(res){
              $('#age_of_plant').val(res);
            }
          });
        });
        
        $('#planting_date').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd'
        });
        $('#defoliation_date').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd'
        });
        $('#first_irrigation_date').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd'
        });
      });  
    </script>
