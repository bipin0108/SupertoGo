<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1><?=lang('Settings');?> </h1>
  </section>
  <!-- Main content -->
  <section class="content">

    <div class="row">
      <!-- /.col -->
      <div class="col-md-12">
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs" id="myTab">
            <li class="active"><a href="#general" data-toggle="tab"><?=lang('General');?></a></li>
            <li><a href="#app_setting" data-toggle="tab"><?=lang('App Setting');?></a></li>
            <li><a href="#payment" data-toggle="tab"><?=lang('Payment (Stripe)');?></a></li>
          </ul>
          <form method="post" action="<?php echo base_url('admin/update-setting'); ?>">
            <div class="tab-content">
              <br>
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
                <div class="active tab-pane" id="general">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label><?=lang('Currency');?></label>
                          <input type="text" name="currency" value="<?php echo $this->m_general->getSetting('currency'); ?>" class="form-control" autocomplete="off" >
                          <?php echo form_error('currency'); ?>
                        </div>
                        <div class="form-group">
                          <label><?=lang('Delivery Charge');?></label>
                          <input type="text" name="delivery_charge" value="<?php echo $this->m_general->getSetting('delivery_charge'); ?>" class="form-control" autocomplete="off" >
                          <?php echo form_error('delivery_charge'); ?>
                        </div>
                        <div class="form-group">
                          <label><?=lang('Min Cart Price');?></label>
                          <input type="text" name="min_cart_price" value="<?php echo $this->m_general->getSetting('min_cart_price'); ?>" class="form-control" autocomplete="off" >
                          <?php echo form_error('min_cart_price'); ?>
                        </div>
                        <div class="form-group">
                          <label><?=lang('Emergency Message');?></label>
                          <textarea name="emergency_message" class="form-control"><?php echo $this->m_general->getSetting('emergency_message'); ?></textarea>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane" id="app_setting">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label><?=lang('Android Version User');?></label>
                          <input type="text" name="android_version_user" value="<?php echo $this->m_general->getSetting('android_version_user'); ?>" class="form-control" autocomplete="off" >
                          <?php echo form_error('android_version_user'); ?>
                        </div>
                        <div class="form-group">
                          <label><?=lang('IOS Version User');?></label>
                          <input type="text" name="ios_version_user" value="<?php echo $this->m_general->getSetting('ios_version_user'); ?>" class="form-control" autocomplete="off" >
                          <?php echo form_error('ios_version_user'); ?>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label><?=lang('Android Version Driver');?></label>
                          <input type="text" name="android_version_driver" value="<?php echo $this->m_general->getSetting('android_version_driver'); ?>" class="form-control" autocomplete="off" >
                          <?php echo form_error('android_version_driver'); ?>
                        </div>
                        <div class="form-group">
                          <label><?=lang('IOS Version Driver');?></label>
                          <input type="text" name="ios_version_driver" value="<?php echo $this->m_general->getSetting('ios_version_driver'); ?>" class="form-control" autocomplete="off" >
                          <?php echo form_error('ios_version_driver'); ?>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane" id="payment">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label><?=lang('Is Stripe');?></label>
                          <select name="is_stripe" id="" class="form-control">
                            <option value="">Select</option>
                            <option <?=($this->m_general->getSetting('is_stripe')=='Test')?'selected':'';?> value="Test">Test</option>
                            <option <?=($this->m_general->getSetting('is_stripe')=='Live')?'selected':'';?> value="Live">Live</option>
                          </select>
                          <?php echo form_error('is_stripe'); ?>
                        </div>
                      </div>
                      <div class="clearfix"></div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label><?=lang('Test Publish Key');?></label>
                          <input type="text" name="stripe_pk_test" value="<?php echo $this->m_general->getSetting('stripe_pk_test'); ?>" class="form-control" autocomplete="off" >
                          <?php echo form_error('stripe_pk_test'); ?>
                        </div>
                        <div class="form-group">
                          <label><?=lang('Test Secret Key');?></label>
                          <input type="text" name="stripe_sk_test" value="<?php echo $this->m_general->getSetting('stripe_sk_test'); ?>" class="form-control" autocomplete="off" >
                          <?php echo form_error('stripe_sk_test'); ?>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label><?=lang('Live Publish Key');?></label>
                          <input type="text" name="stripe_pk_live" value="<?php echo $this->m_general->getSetting('stripe_pk_live'); ?>" class="form-control" autocomplete="off" >
                          <?php echo form_error('stripe_pk_live'); ?>
                        </div>
                        <div class="form-group">
                          <label><?=lang('Live Secret Key');?></label>
                          <input type="text" name="stripe_sk_live" value="<?php echo $this->m_general->getSetting('stripe_sk_live'); ?>" class="form-control" autocomplete="off" >
                          <?php echo form_error('stripe_sk_live'); ?>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="box-footer">
                  <input type="submit" value="<?=lang('Update');?>" class="btn btn-primary">
                </div>
            </div>
          </form>
        </div>
        <!-- /.nav-tabs-custom -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>