<?php 
	$uid = $this->session->userdata[SESSION_VENDOR]['vendor_id'];
  $uri=$this->uri->segment(2);
?>
<ul class="sidebar-menu" data-widget="tree">
	<li class="<?php if($uri=='dashboard'){echo'active';}?>">
		<a href="<?=base_url('vendor/dashboard');?>">
			<i class="fa fa-dashboard" aria-hidden="true"></i> <span>Dashboard</span>
		</a>
	</li>
    <!-- knowledge bank -->
    <?php $role_permission = $this->mastermodel->getPermission_vendor('KnowledgeBank',$uid); ?>
    <?php if($role_permission->is_view == 1){ ?>
    <li class="<?php if(
    $uri=='knowledge-bank-list' || $uri=='knowledge-bank-topic' || $uri == 'knowledge-bank-subtopic' || $uri=='control-measure-list' || $uri=='create-control-measure' || $uri=='edit-control-measure' ){ echo 'active';}?>">
        <a href="<?=base_url('vendor/knowledge-bank-list');?>">  
          <i class="fa fa-university"></i> <span>Knowledge Bank</span>
        </a>
    </li>
    <?php } ?> 
     <!-- Farmer -->
    <?php $role_permission = $this->mastermodel->getPermission_vendor('Farmer',$uid); ?>
    <?php if($role_permission->is_view == 1){ ?>
    <li class="<?php if($uri=='farmer-list'){ echo 'active';}?>">
      <a href="<?=base_url('vendor/farmer-list');?>">
        <i class="fa fa-user"></i> <span>Farmer</span>
      </a>
    </li>
    <?php } ?> 
    <!-- Advisory -->
    <?php $role_permission = $this->mastermodel->getPermission_vendor('Advisory',$uid); ?>
    <?php if($role_permission->is_view == 1){ ?>
    <li class="treeview <?php if($uri=='subvendor-advisory-request-list' || $uri=='today-follow-up-request'){ echo 'active'; }?>">
        <a href="#">
          <i class="fa fa-external-link"></i>
          <span>Expert Advisory</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="<?php if($uri=='subvendor-advisory-request-list'){echo'active';}?>"><a href="<?=base_url('vendor/subvendor-advisory-request-list');?>"><i class="fa fa-list"></i> Advisory Request</a></li>
          <li class="<?php if($uri=='today-follow-up-request'){echo'active';}?>"><a href="<?=base_url('vendor/today-follow-up-request');?>"><i class="fa fa-list"></i>Today's Follow up Request</a></li>
        </ul>
    </li>
    <?php } ?>    
    <!-- END -->
  <!-- END -->
</ul>   