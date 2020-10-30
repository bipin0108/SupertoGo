<?php 
	$uri=$this->uri->segment(2);
?>
<ul class="sidebar-menu" data-widget="tree">
	<li class="<?php if($uri=='dashboard'){echo'active';}?>">
		<a href="<?=base_url('vendor/dashboard');?>">
		  <i class="fa fa-dashboard" aria-hidden="true"></i> <span>Dashboard</span>
		</a>
	</li>
  <!-- knowledge bank -->
  <li class="<?php if(
  $uri=='knowledge-bank-list' || $uri=='knowledge-bank-topic' || $uri == 'knowledge-bank-subtopic' || $uri=='control-measure-list' || $uri=='create-control-measure' || $uri=='edit-control-measure'){ echo 'active';}?>">
      <a href="<?=base_url('vendor/knowledge-bank-list');?>">  
        <i class="fa fa-university"></i> <span>Knowledge Bank</span>
      </a>
  </li> 
  <!-- Sub Admin -->
  <li class="treeview <?php if($uri=='vendor-subadmin-list'||$uri=='create-vendor-subadmin' || $uri=='edit-vendor-subadmin'){ echo 'active'; }?>">
      <a href="#">
        <i class="fa fa-user-secret"></i>
        <span>Sub Vendor</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li class="<?php if($uri=='create-vendor-ubadmin'|| $uri=='add-vendor-subadmin'){echo'active';}?>"><a href="<?=base_url('vendor/create-vendor-subadmin');?>"><i class="fa fa-plus"></i> Create</a></li>
        <li class="<?php if($uri=='vendor-subadmin-list'){ echo 'active';}?>"><a href="<?=base_url('vendor/vendor-subadmin-list');?>"><i class="fa fa-list"></i>View</a></li>
      </ul>
  </li> 
  <!-- Farmer -->
  <li class="<?php if($uri=='farmer-list'){ echo 'active';}?>">
    <a href="<?=base_url('vendor/farmer-list');?>">
      <i class="fa fa-user"></i> <span>Farmer</span>
    </a>
  </li>
  <!-- Advisory -->
  <li class="treeview <?php if($uri=='advisory-request-list' || $uri=='assigned-advisory-request-list' || $uri=='today-follow-up-request'){ echo 'active'; }?>">
      <a href="#">
        <i class="fa fa-external-link"></i>
        <span>Expert Advisory</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li class="<?php if($uri=='advisory-request-list'){echo'active';}?>"><a href="<?=base_url('vendor/advisory-request-list');?>"><i class="fa fa-list"></i>Advisory Request</a></li>
        <li class="<?php if($uri=='today-follow-up-request'){echo'active';}?>"><a href="<?=base_url('vendor/today-follow-up-request');?>"><i class="fa fa-list"></i>Today's Follow up Request</a></li>
        <li class="<?php if($uri=='assigned-advisory-request-list'){echo'active';}?>"><a href="<?=base_url('vendor/assigned-advisory-request-list');?>"><i class="fa fa-list"></i>Assigned Advisory Request</a></li>
      </ul>
  </li>   
  <!-- END -->
</ul>   