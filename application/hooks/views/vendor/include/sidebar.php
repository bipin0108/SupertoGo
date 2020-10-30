<?php
  $obj=&get_instance();
  $user=$obj->v_vendormodel->GetVendorData();
  $type = $this->session->userdata[SESSION_VENDOR]['type'];
?>
<aside class="main-sidebar">  
  <section class="sidebar">
    <?php  if($type == 'vendor'){ ?> 
      <?php $this->load->view('vendor/include/sidebar_vendor'); ?>
    <?php }else{ ?>
      <?php $this->load->view('vendor/include/sidebar_vendor_subadmin'); ?>
    <?php }  ?>
  </section>
</aside>