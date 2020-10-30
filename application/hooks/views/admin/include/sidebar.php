<?php
  $obj=&get_instance();
  $user=$obj->adminmodel->GetUserData();
  $type = $this->session->userdata[SESSION_ADMIN]['type'];
?>
<aside class="main-sidebar">  
  <section class="sidebar">
    <?php  if($type == 'admin'){ ?> 
      <?php $this->load->view('admin/include/sidebar_admin'); ?>
    <?php }else{ ?>
      <?php $this->load->view('admin/include/sidebar_subadmin'); ?>
    <?php }  ?>
  </section>
</aside>