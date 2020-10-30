<style type="text/css">.profile-user-img{height: 100px;}</style>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>User Profile</h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-3" >
          <!-- Profile Image -->
          <div class="box box-primary" id="element_overlap">
            <div class="box-body box-profile">
            <?php
              $obj=&get_instance();
              $user=$obj->v_vendormodel->GetVendorData();
            ?>
              <?php if($user['profile_image'] == ''){ ?>
              <img class="profile-user-img img-responsive img-circle profileImgUrl" style="height:100px;width:100px" src="<?php echo DEFAULT_IMG_PATH; ?>">  
              <?php }else{ ?>
              <img class="profile-user-img img-responsive img-circle profileImgUrl" style="height:100px;width:100px" src="<?php echo IMG_PATH.'vendor_profiles/'.$user['profile_image']; ?>">
              <?php } ?>
              <h3 class="profile-username text-center NameEdt"><?=$user['name'];?></h3>
            </div>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom" id="element_overlap1">
            <ul class="nav nav-tabs" id="myTab">
             
              <li class="active">
                <a href="#activity " data-toggle="tab" aria-expanded="">
                General Details</a>
              </li>
               <li class="">
                <a href="#pwd" data-toggle="tab" aria-expanded="">
                Change Password</a>
              </li>
              <li class="">
                <a href="#profileimage" data-toggle="tab" aria-expanded="">Change Profile Image</a>
              </li>
            </ul>
            <div class="tab-content">
              
              <!-- update data -->
              <div class="tab-pane active" id="activity">
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

                <form role="form" class="form-horizontal" method="post" action="<?php  echo base_url('vendor/profile-details-update'); ?>">
                  <div class="form-group">
                    <label for="" class="col-sm-2 control-label">UserID</label>
                     <div class="col-sm-5">
                      <input type="text" class="form-control" value="<?=$user['name']?>" disabled>
                      <input type="hidden" class="form-control" name="vendor_id" value="<?=$user['vendor_id']?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="" class="col-sm-2 control-label">Name</label>
                     <div class="col-sm-5">
                      <input type="text" class="form-control" name="name" value="<?=$user['name']?>" placeholder="Name">
                      <?php echo form_error('name'); ?>
                    </div>

                  </div>
                   <div class="form-group">
                    <label for="" class="col-sm-2 control-label">Email</label>
                     <div class="col-sm-5">
                      <input type="text" class="form-control" name="email" value="<?=$user['email']?>" placeholder="Email">
                      <?php echo form_error('email'); ?>
                    </div>

                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-sm btn-primary profile_update">Update</button>
                      <a href="<?php echo base_url('vendor/profile'); ?>" type=button class="btn btn-sm btn-default">Cancel</a>
                    </div>  
                  </div>
                </form>
              </div>
                 
                
        
              <!-- CHANGE PASSWORD TAB -->
              <div class="tab-pane" id="pwd">
                <?php if(!empty($this->session->flashdata('pwd_success'))): ?>
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <span> <?php echo $this->session->flashdata('pwd_success'); ?> </span>
                </div>
                <?php endif ?>
                <?php if($this->session->flashdata('pwd_error')): ?>
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <span><?php echo $this->session->flashdata('pwd_error') ?></span>
                </div>
                <?php endif ?>
                <form role="form" class="form-horizontal" method="post" action="<?php  echo base_url('vendor/update-password'); ?>">
                    <input type="hidden" name="vendor_id" value="<?php echo $user['vendor_id']; ?>">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Old Password</label>
                        <div class="col-sm-5">
                          <input name="old_pwd" type="password" class="form-control" placeholder="Old Password">
                          <?php echo form_error('old_pwd'); ?> 
                        </div>
                        
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">New Password</label>
                        <div class="col-sm-5">
                          <input name="new_pwd" type="password" class="form-control" placeholder="New Password"> 
                          <?php echo form_error('new_pwd'); ?>
                        </div>  
                        
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Confirm Password</label>
                        <div class="col-sm-5">
                          <input name="confirm_pwd" type="password" class="form-control" placeholder="Confirm Password">
                          <?php echo form_error('confirm_pwd'); ?>
                        </div> 
                        
                    </div>                                                                                        
                    <div class="form-group">
                      <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-sm btn-primary profile_update">Update</button>
                        <a href="<?php echo base_url('vendor/profile'); ?>" type=button class="btn btn-sm btn-default">Cancel</a>
                      </div>  
                    </div>                     
                </form>
              </div>
              <!-- END CHANGE PASSWORD TAB -->

              <!-- update profile image -->
              <div class="tab-pane " id="pwd">
                <?php if(!empty($this->session->flashdata('img_success'))): ?>
                  <div class="alert alert-success">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <span> <?php echo $this->session->flashdata('img_success'); ?> </span>
                  </div>
                  <?php endif ?>
                  <?php if(!empty($this->session->flashdata('img_error'))): ?>
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <span><?php echo $this->session->flashdata('img_error') ?></span>
                    </div>
                  <?php endif ?>
               </div> 
              <div class="tab-pane" id="profileimage">
                  
                  <form role="form" class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php  echo base_url('vendor/upload-profile'); ?>">
                    <input type="hidden" name="vendor_id" value="<?php echo $user['vendor_id']; ?>">
                    <div class="row">
                      <div class="col-sm-4">
                          <?php 
                            $p_img = $user['profile_image'];
                            if($p_img != '' OR $p_img != null)
                            {
                              $img_src = base_url('uploads/vendor_profiles/').$p_img;
                            }
                            else
                            {
                              $img_src = base_url()."public/images/2.png";
                            }
                          ?>
                          <img class="profile-user-img img-responsive img-circle profileImgUrl" style="height:150px;width:150px" src="<?php echo $img_src; ?>">
                      </div>
                      <div class="col-sm-8">
                        <br>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Upload Image</label>
                            <div class="col-sm-8">
                              <input type="file" class="form-control" name="avatar_img" >
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                              <button type="submit" class="btn btn-sm btn-primary profile_update">Update</button>
                              <a href="<?php echo base_url('vendor/profile'); ?>" type=button class="btn btn-sm btn-default">Cancel</a>
                            </div>  
                          </div>   
                      </div>
                    </div>
                  </form>
              </div>
              <!-- END update profile image -->
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
 
  
  </div>
   <!-- /.content-wrapper -->
