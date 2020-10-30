<?php
  $obj=&get_instance();
  $user=$obj->adminmodel->GetUserData();
?>
<header class="main-header">
  <a href="<?=base_url('admin/dashboard')?>" class="logo">
    <span class="logo-mini"><img src="<?=base_url('public/images/logo.png');?>" style="width: 25px;"></span>
    <span class="logo-lg"><b>Smart Crop</b></span>
  </a>
  <nav class="navbar navbar-static-top">
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <?php if($user['profile_image'] == ''){ ?>
            <img class="user-image profileImgUrl" style="height:35px;width:35px" src="<?php echo DEFAULT_IMG_PATH; ?>"><?php }else{ ?>
            <img class="user-image profileImgUrl" style="height:35px;width:35px" src="<?php echo IMG_PATH.'profiles/'.$user['profile_image']; ?>">
            <?php } ?>
            <span class="hidden-xs NameEdt"><?= $user['name']; ?></span>
          </a>
          <ul class="dropdown-menu">  
            <li class="user-header">
              <?php if($user['profile_image'] == ''){ ?>
              <img class="img-circle profileImgUrl" style="height:35px;width:35px" src="<?php echo DEFAULT_IMG_PATH; ?>">  
              <?php }else{ ?>
              <img class="img-circle profileImgUrl" style="height:35px;width:35px" src="<?php echo IMG_PATH.'profiles/'.$user['profile_image']; ?>">
              <?php } ?>
              <p>
                <span class="NameEdt"><?= $user['name'];?></span>
              </p>
            </li>
            <!-- Menu Footer -->
            <li class="user-footer">
              <div class="pull-left">
                <a href="<?=base_url('admin/profile');?>" class="btn btn-default btn-flat">Profile</a>
              </div>
              <div class="pull-right">
                <a href="<?=base_url('admin/logout');?>" class="btn btn-default btn-flat">Logout</a>
              </div>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>