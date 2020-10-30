<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Settings
    </h1>
  </section>
  <!-- start add category form -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Settings</h3>
          </div>

          <!-- START add Gallery form -->
          <?php echo form_open_multipart('admin/update-settings'); ?>
            <div class="box-body">
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
              <div class="col-md-6">
                <div class="form-group">
                    <label>FCM Api Key</label>
                    <input type="text" name="fcm_api_key" value="<?php echo $this->mastermodel->getSetting('fcm_api_key'); ?>" class="form-control" autocomplete="off" >
                    <?php echo form_error('fcm_api_key'); ?>
                </div>
                <div class="form-group">
                    <label>SMS Sender ID</label>
                    <input type="text" name="msg91_senderid" value="<?php echo $this->mastermodel->getSetting('msg91_senderid'); ?>" class="form-control" autocomplete="off" >
                    <?php echo form_error('msg91_senderid'); ?>
                </div>
                <div class="form-group">
                    <label>SMS Auth Key</label>
                    <input type="text" name="msg91_authkey" value="<?php echo $this->mastermodel->getSetting('msg91_authkey'); ?>" class="form-control" autocomplete="off" >
                    <?php echo form_error('msg91_authkey'); ?>
                </div>
                <div class="form-group">
                    <label>Plot Activation Fee</label>
                    <input type="text" name="plot_subscription_price" value="<?php echo $this->mastermodel->getSetting('plot_subscription_price'); ?>" class="form-control" autocomplete="off" >
                    <?php echo form_error('plot_subscription_price'); ?>
                </div>
                <div class="form-group">
                    <label>Buyer Subscription Fee</label>
                    <input type="text" name="buyer_subscription_price" value="<?php echo $this->mastermodel->getSetting('buyer_subscription_price'); ?>" class="form-control" autocomplete="off" >
                    <?php echo form_error('buyer_subscription_price'); ?>
                </div>
              </div> 
              <div class="col-md-6">
              </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <input type="submit" value="Update" class="btn btn-primary">
            </div>
          <?php form_close();  ?>
          <!-- END add Gallery form -->
        </div>
      </div> 
    </div>
  </section>    
  <!-- end add category form -->
</div>