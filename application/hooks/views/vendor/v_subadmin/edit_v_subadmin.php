<?php 
$obj=&get_instance();
$state = $obj->mastermodel->get_all_state();
$role = $obj->mastermodel->get_all_role();
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Edit Subvendor
    </h1>
  </section>
  <!-- start form -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Edit Subvendor</h3>
          </div>
          <?php if(!empty($this->session->flashdata('success'))): ?>
          <div class="alert alert-success">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <span> <?php echo $this->session->flashdata('success'); ?> </span>
          </div>
          <?php endif ?> 
         
          <?php if($this->session->flashdata('error')): ?>
          <div class="alert alert-danger">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <span><?php echo $this->session->flashdata('error') ?></span>
          </div>  
          <?php endif ?>
          <!-- START form -->
          <?php echo form_open_multipart('vendor/update-vendor-subadmin'); ?>
            <div class="box-body">
              <div class="col-xs-6">
                <!-- START -->
                <input type="hidden" name="vendor_id" value="<?php echo $subadmin['vendor_id'] ?>">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" value="<?php echo $subadmin['name'] ?>" class="form-control" placeholder="Name" autocomplete="off">
                    <?php echo form_error('name'); ?>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" name="email" value="<?php echo $subadmin['email'] ?>" class="form-control" placeholder="Email" autocomplete="off">
                    <?php echo form_error('email'); ?>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="text" name="password" value="<?php echo $subadmin['password'] ?>" class="form-control" placeholder="Password" autocomplete="off">
                    <?php echo form_error('password'); ?>
                </div>
                <div class="form-group">
                    <label>Mobile Number</label>
                    <input type="text" name="mobile" value="<?php echo $subadmin['mobile'] ?>" class="form-control" placeholder="Mobile Number" autocomplete="off">
                    <?php echo form_error('mobile'); ?>
                </div>
                <div class="form-group">
                    <label>Pincode</label>
                    <input type="text" id="pincode" name="pincode" value="<?php echo $subadmin['pincode'] ?>" class="form-control" placeholder="Pincode" autocomplete="off">
                    <?php echo form_error('pincode'); ?>
                </div>
                <!-- END -->
              </div>
             <div class="col-xs-6">
                <!-- START -->
                <div class="form-group">
                  <label>Select from here</label>
                  <select id="suggesstion-box" class="form-control">
                  </select>
                </div>
                <div class="row">    
                    <div class="col-xs-6">
                      <div class="form-group">
                        <label>Village</label>
                        <input type="text" name="village" id="village" class="form-control"  value="<?php echo $subadmin['village']; ?>">
                        <?php echo form_error('village'); ?>
                      </div>
                    </div>
                    <div class="col-xs-6">
                      <div class="form-group">
                        <label>District</label>
                        <input type="text" name="district" id="district" class="form-control" value="<?php echo $subadmin['district']; ?>">
                        <?php echo form_error('district'); ?>
                      </div>
                    </div>
                    <div class="col-xs-6" >
                      <div class="form-group">
                        <label>City</label>
                        <input type="text" name="city" id="city" class="form-control" value="<?php echo $subadmin['city']; ?>">
                        <?php echo form_error('city'); ?>
                      </div>
                    </div>
                    <div class="col-xs-6">
                      <div class="form-group">
                        <label>State</label>
                        <input type="text" name="state" id="state" class="form-control" value="<?php echo $subadmin['state']; ?>">
                        <?php echo form_error('state'); ?>
                      </div>
                    </div>
                </div> 
                <div class="form-group">
                    <label>Address</label>
                    <input type="text" name="address" value="<?php echo $subadmin['address'] ?>" class="form-control" placeholder="Address" autocomplete="off">
                    <?php echo form_error('address'); ?>
                </div>
                <!-- END -->
              </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <input type="submit" value="Update Subadmin" class="btn btn-primary">
            </div>
          <?php form_close();  ?>
          <!-- END form -->
        </div>
      </div> 
    </div>
  </section>    
  <!-- end form -->
</div>
<script>
   $(document).ready(function(){
    $("#pincode").keyup(function()
    {
        $.ajax({
          type: "POST",
          url:"<?php echo base_url(); ?>master/get_pincode_ajax",
          data:'keyword='+$(this).val(),

          success: function(data)
          {
          $("#suggesstion-box").show();
          $("#suggesstion-box").html(data);
          $("#pincode").css("background","#FFF");
          }
        });
    }); 
    //
    $(document).on('change', '#suggesstion-box', function() {  
        var val = $(this).val();
        var strArr = val.split(',');
        $("#pincode").val(strArr[0]);
        $("#village").val(strArr[1]);
        $("#city").val(strArr[2]);
        $("#district").val(strArr[3]);
        $("#state").val(strArr[4]);
       // $("#suggesstion-box").hide();
    });
    //end 
   });
</script>
