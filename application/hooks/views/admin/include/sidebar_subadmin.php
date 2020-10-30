<?php 
	$uid = $this->session->userdata[SESSION_ADMIN]['admin_id'];
  $type = $this->session->userdata[SESSION_ADMIN]['type'];
  $created_by = $this->session->userdata[SESSION_ADMIN]['created_by'];
	$uri=$this->uri->segment(2);
?>
<ul class="sidebar-menu" data-widget="tree">
	<li class="<?php if($uri=='dashboard'){echo'active';}?>">
		<a href="<?=base_url('admin/dashboard');?>">
			<i class="fa fa-dashboard" aria-hidden="true"></i> <span>Dashboard</span>
		</a>
	</li>
    <!-- knowledge bank -->
    <?php $role_permission = $this->mastermodel->getPermission('KnowledgeBank',$uid); ?>
    <?php if($role_permission->is_view == 1){ ?>
    <li class="<?php if(
    $uri=='knowledge-bank-list' || $uri=='knowledge-bank-topic' || $uri == 'create-knowledge-bank-topic' ||
    $uri=='edit-knowledge-bank-topic' || $uri == 'knowledge-bank-subtopic' || $uri=='create-knowledge-bank-subtopic' || 
    $uri=='edit-knowledge-bank-subtopic' || $uri=='control-measure-list' || $uri=='create-control-measure' || 
    $uri=='edit-control-measure'){ echo 'active'; } ?>">
        <a href="<?=base_url('admin/knowledge-bank-list');?>">  
          <i class="fa fa-university"></i> <span>Knowledge Bank</span>
        </a>
    </li>
    <?php } ?>
    <!-- schedule -->
    <?php $role_permission = $this->mastermodel->getPermission('Schedule',$uid); ?>
    <?php if($role_permission->is_view == 1){ ?>
    <li class="treeview <?php if($uri=='light-soil-schedule-list'|| $uri=='create-light-soil-schedule' || $uri=='edit-light-soil-schedule' || $uri=='medheavy-soil-schedule-list'|| $uri=='create-medheavy-soil-schedule' || $uri=='edit-medheavy-soil-schedule'){ echo 'active'; }?>">
      <a href="#">
        <i class="fa fa-hand-o-right"></i>
        <span>Schedule</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li class="<?php if($uri=='light-soil-schedule-list'|| $uri=='create-light-soil-schedule' || $uri=='edit-light-soil-schedule'){echo 'active';}?>"><a href="<?=base_url('admin/light-soil-schedule-list');?>"><i class="fa fa-list"></i> Light Soil Schedule</a></li>
        <li class="<?php if($uri=='medheavy-soil-schedule-list'|| $uri=='create-medheavy-soil-schedule' || $uri=='edit-medheavy-soil-schedule'){echo 'active';}?>" ><a href="<?=base_url('admin/medheavy-soil-schedule-list');?>"><i class="fa fa-list"></i>Med Heavy Soil Schedule</a></li>
      </ul>
    </li>
    <?php } ?>
    <!-- module -->
    <?php $role_permission = $this->mastermodel->getPermission('Module',$uid); ?>
    <?php if($role_permission->is_view == 1){ ?>
    <!-- start module -->
    <li class="treeview <?php if(
    $uri=='area-unit-list' || $uri=='create-area-unit' || $uri=='edit-area-unit' ||
    $uri=='crop-list'|| $uri=='create-crop' || $uri=='edit-crop' ||
    $uri=='fertigation-equipment-list' || $uri=='create-fertigation-equipment' || $uri=='edit-fertigation-equipment' ||
    $uri=='bacterial-intensity-list' || $uri=='create-bacterial-intensity' || $uri=='edit-bacterial-intensity' ||
    
    $uri=='variety-list'|| $uri=='create-variety' || $uri=='edit-variety' ||
    $uri=='spacing-area-unit-list' || $uri=='create-spacing-area-unit' || $uri=='edit-spacing-area-unit' ||
    $uri=='water-source-list'||$uri=='create-water-source' || $uri=='edit-water-source' ||
    $uri=='soil-type-list'||$uri=='create-soil-type' || $uri=='edit-soil-type' ||
    $uri=='filtration-system-list'||$uri=='create-filtration-system' || $uri=='edit-filtration-system' ||
    $uri=='irrigation-source-list'||$uri=='create-irrigation-source' || $uri=='edit-irrigation-source' ||
    $uri=='planting-method-list'||$uri=='create-planting-method' || $uri=='edit-planting-method' ||
    $uri=='planting-material-list'||$uri=='create-planting-material' || $uri=='edit-planting-material' ||
    $uri=='problem-area-list'||$uri=='create-problem-area' || $uri=='edit-problem-area'
        )
        { echo 'active'; }?>">
        <a href="#">
          <i class="fa fa-first-order"></i>
          <span>Module</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <!-- Plot Area Unit --> 
          <li class="treeview <?php if($uri=='area-unit-list' || $uri=='create-area-unit' || $uri=='edit-area-unit'){ echo 'active'; }?>">
            <a href="#"><i class="fa fa-square-o"></i>Plot Area Unit
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <?php if($role_permission->is_add == 1){ ?>
              <li class="<?php if($uri=='create-area-unit'|| $uri=='add-area-unit'){echo'active';}?>"><a href="<?=base_url('admin/create-area-unit');?>"><i class="fa fa-plus"></i> Create</a></li>
              <?php } ?>
              <li class="<?php if($uri=='area-unit-list'){ echo 'active';}?>"><a href="<?=base_url('admin/area-unit-list');?>"><i class="fa fa-list"></i>View</a></li>
            </ul>
          </li> 
          <!-- Bacterial Blight Intensity -->
          <li class="treeview <?php if($uri=='bacterial-intensity-list' || $uri=='create-bacterial-intensity' || $uri=='edit-bacterial-intensity'){ echo 'active'; }?>">
            <a href="#"><i class="fa fa-bug"></i> Bacterial Blight Intensity
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <?php if($role_permission->is_add == 1){ ?>
              <li class="<?php if($uri=='create-bacterial-intensity'|| $uri=='add-bacterial-intensity'){echo'active';}?>"><a href="<?=base_url('admin/create-bacterial-intensity');?>"><i class="fa fa-plus"></i> Create</a></li>
              <?php } ?>
              <li class="<?php if($uri=='bacterial-intensity-list'){ echo 'active';}?>"><a href="<?=base_url('admin/bacterial-intensity-list');?>"><i class="fa fa-list"></i>View</a></li>
            </ul>
          </li> 
          <!-- Crops -->
          <li class="treeview <?php if($uri=='crop-list' || $uri=='create-crop' || $uri=='edit-crop'){ echo 'active'; }?>">
            <a href="#"><i class="fa fa-envira"></i> Crops
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <?php if($role_permission->is_add == 1){ ?>
              <li class="<?php if($uri=='create-crop'|| $uri=='add-crop'){echo'active';}?>"><a href="<?=base_url('admin/create-crop');?>"><i class="fa fa-plus"></i> Create</a></li>
              <?php } ?>
              <li class="<?php if($uri=='crop-list'){ echo 'active';}?>"><a href="<?=base_url('admin/crop-list');?>"><i class="fa fa-list"></i>View</a></li>
            </ul>
          </li>
          <!-- Fertigation Equipment -->
          <li class="treeview <?php if($uri=='fertigation-equipment-list' || $uri=='create-fertigation-equipment' || $uri=='edit-fertigation-equipment'){ echo 'active'; }?>">
            <a href="#"><i class="fa fa-fire-extinguisher"></i> Fertigation Equipment
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <?php if($role_permission->is_add == 1){ ?>
              <li class="<?php if($uri=='create-fertigation-equipment'|| $uri=='add-fertigation-equipment'){echo'active';}?>"><a href="<?=base_url('admin/create-fertigation-equipment');?>"><i class="fa fa-plus"></i> Create</a></li>
              <?php } ?>
              <li class="<?php if($uri=='fertigation-equipment-list'){ echo 'active';}?>"><a href="<?=base_url('admin/fertigation-equipment-list');?>"><i class="fa fa-list"></i>View</a></li>
            </ul>
          </li>
          <!-- filtration system -->
          <li class="treeview <?php if($uri=='filtration-system-list'||$uri=='create-filtration-system' || $uri=='edit-filtration-system'){ echo 'active'; }?>">
              <a href="#">
                <i class="fa fa-filter"></i>
                <span>Filtration System</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <?php if($role_permission->is_add == 1){ ?>
                <li class="<?php if($uri=='create-filtration-system'|| $uri=='add-filtration-system'){echo'active';}?>"><a href="<?=base_url('admin/create-filtration-system');?>"><i class="fa fa-plus"></i> Create</a></li>
                <?php } ?>
                <li class="<?php if($uri=='filtration-system-list'){ echo 'active';}?>"><a href="<?=base_url('admin/filtration-system-list');?>"><i class="fa fa-list"></i>View</a></li>
              </ul>
          </li> 
          <!-- irrigation source -->
          <li class="treeview <?php if($uri=='irrigation-source-list'||$uri=='create-irrigation-source' || $uri=='edit-irrigation-source'){ echo 'active'; }?>">
              <a href="#">
                <i class="fa fa-snowflake-o"></i>
                <span>Irrigation Source</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <?php if($role_permission->is_add == 1){ ?>
                <li class="<?php if($uri=='create-irrigation-source'|| $uri=='add-irrigation-source'){echo'active';}?>"><a href="<?=base_url('admin/create-irrigation-source');?>"><i class="fa fa-plus"></i> Create</a></li>
                <?php } ?>
                <li class="<?php if($uri=='irrigation-source-list'){ echo 'active';}?>"><a href="<?=base_url('admin/irrigation-source-list');?>"><i class="fa fa-list"></i>View</a></li>
              </ul>
          </li> 
          <!-- planting material -->
          <li class="treeview <?php if($uri=='planting-material-list'||$uri=='create-planting-material' || $uri=='edit-planting-material'){ echo 'active'; }?>">
              <a href="#">
                <i class="fa fa-th"></i>
                <span>Planting Material</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <?php if($role_permission->is_add == 1){ ?>
                <li class="<?php if($uri=='create-planting-material'|| $uri=='add-planting-material'){echo'active';}?>"><a href="<?=base_url('admin/create-planting-material');?>"><i class="fa fa-plus"></i> Create</a></li>
                <?php } ?>
                <li class="<?php if($uri=='planting-material-list'){ echo 'active';}?>"><a href="<?=base_url('admin/planting-material-list');?>"><i class="fa fa-list"></i>View</a></li>
              </ul>
          </li>
          <!-- planting method -->
          <li class="treeview <?php if($uri=='planting-method-list'||$uri=='create-planting-method' || $uri=='edit-planting-method'){ echo 'active'; }?>">
              <a href="#">
                <i class="fa fa-newspaper-o"></i>
                <span>Planting Method</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <?php if($role_permission->is_add == 1){ ?>
                <li class="<?php if($uri=='create-planting-method'|| $uri=='add-planting-method'){echo'active';}?>"><a href="<?=base_url('admin/create-planting-method');?>"><i class="fa fa-plus"></i> Create</a></li>
                <?php } ?>
                <li class="<?php if($uri=='planting-method-list'){ echo 'active';}?>"><a href="<?=base_url('admin/planting-method-list');?>"><i class="fa fa-list"></i>View</a></li>
              </ul>
          </li> 
         <!-- problem area -->
          <li class="treeview <?php if($uri=='problem-area-list'||$uri=='create-problem-area' || $uri=='edit-problem-area'){ echo 'active'; }?>">
              <a href="#">
                <i class="fa fa-question-circle-o"></i>
                <span>Problem Area</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <?php if($role_permission->is_add == 1){ ?>
                <li class="<?php if($uri=='create-problem-area'|| $uri=='add-problem-area'){echo'active';}?>"><a href="<?=base_url('admin/create-problem-area');?>"><i class="fa fa-plus"></i> Create</a></li>
                <?php } ?>
                <li class="<?php if($uri=='problem-area-list'){ echo 'active';}?>"><a href="<?=base_url('admin/problem-area-list');?>"><i class="fa fa-list"></i>View</a></li>
              </ul>
          </li>     
          <!-- soil type -->
          <li class="treeview <?php if($uri=='soil-type-list'||$uri=='create-soil-type' || $uri=='edit-soil-type'){ echo 'active'; }?>">
              <a href="#">
                <i class="fa fa-object-group"></i>
                <span>Soil Type</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <?php if($role_permission->is_add == 1){ ?>
                <li class="<?php if($uri=='create-soil-type'|| $uri=='add-soil-type'){echo'active';}?>"><a href="<?=base_url('admin/create-soil-type');?>"><i class="fa fa-plus"></i> Create</a></li>
                <?php } ?>
                <li class="<?php if($uri=='soil-type-list'){ echo 'active';}?>"><a href="<?=base_url('admin/soil-type-list');?>"><i class="fa fa-list"></i>View</a></li>
              </ul>
          </li>  
          <!-- Spacing Area Unit --> 
          <li class="treeview <?php if($uri=='spacing-area-unit-list' || $uri=='create-spacing-area-unit' || $uri=='edit-spacing-area-unit'){ echo 'active'; }?>">
            <a href="#"><i class="fa fa-square-o"></i>Spacing Area Unit
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <?php if($role_permission->is_add == 1){ ?>
              <li class="<?php if($uri=='create-spacing-area-unit'|| $uri=='add-spacing-area-unit'){echo'active';}?>"><a href="<?=base_url('admin/create-spacing-area-unit');?>"><i class="fa fa-plus"></i> Create</a></li>
              <?php } ?>
              <li class="<?php if($uri=='spacing-area-unit-list'){ echo 'active';}?>"><a href="<?=base_url('admin/spacing-area-unit-list');?>"><i class="fa fa-list"></i>View</a></li>
            </ul>
          </li>
          <!-- water source -->
          <li class="treeview <?php if($uri=='water-source-list'||$uri=='create-water-source' || $uri=='edit-water-source'){ echo 'active'; }?>">
              <a href="#">
                <i class="fa fa-tint"></i>
                <span>Water Source</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <?php if($role_permission->is_add == 1){ ?>
                <li class="<?php if($uri=='create-water-source'|| $uri=='add-water-source'){echo'active';}?>"><a href="<?=base_url('admin/create-water-source');?>"><i class="fa fa-plus"></i> Create</a></li>
                <?php } ?>
                <li class="<?php if($uri=='water-source-list'){ echo 'active';}?>"><a href="<?=base_url('admin/water-source-list');?>"><i class="fa fa-list"></i>View</a></li>
              </ul>
          </li>  
            <!-- end -->
        </ul> 
    </li>
    <!-- end module -->
    <?php } ?>
     <!-- Molecule -->
    <?php $role_permission = $this->mastermodel->getPermission('Molecule',$uid); ?>
    <?php if($role_permission->is_view == 1){ ?>
    <li class="<?php if($uri=='molecule-list'){ echo 'active';}?>">
      <a href="<?=base_url('admin/molecule-list');?>">
        <i class="fa fa-cubes"></i> <span>Molecule</span>
      </a>
    </li>
    <?php } ?>   
    <!-- Webinar -->
    <?php $role_permission = $this->mastermodel->getPermission('Webinar',$uid); ?>
    <?php if($role_permission->is_view == 1){ ?>
    <li class="treeview <?php if($uri=='webinar-list'||$uri=='create-webinar' || $uri=='edit-webinar'){ echo 'active'; }?>">
        <a href="#">
          <i class="fa fa-wpforms"></i>
          <span>Webinar</span>  
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <?php if($role_permission->is_add == 1){ ?>
          <li class="<?php if($uri=='create-webinar'|| $uri=='add-webinar'){echo'active';}?>"><a href="<?=base_url('admin/create-webinar');?>"><i class="fa fa-plus"></i> Create</a></li>
          <?php } ?>
          <li class="<?php if($uri=='webinar-list'){ echo 'active';}?>"><a href="<?=base_url('admin/webinar-list');?>"><i class="fa fa-list"></i>View</a></li>
          <li class="<?php if($uri=='webinar-payment-history'){ echo 'active';}?>"><a href="<?=base_url('admin/webinar-payment-history');?>"><i class="fa fa-list"></i>Wenbinar Payment History</a></li>
        </ul>
    </li>
    <?php } ?> 
     <!-- User -->
    <?php $role_permission = $this->mastermodel->getPermission('User',$uid); ?>
    <?php if($role_permission->is_view == 1){ ?>
    <li class="treeview <?php if($uri=='farmer-list'|| $uri=='buyer-list'){ echo 'active'; }?>">
        <a href="#">
          <i class="fa fa-user"></i>
          <span>User</span>  
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <!-- Farmer -->
          <li class="<?php if($uri=='farmer-list'){ echo 'active';}?>">
            <a href="<?=base_url('admin/farmer-list');?>"><i class="fa fa-list"></i> <span>Farmer</span></a>
          </li>
          <!-- Buyer -->
          <li class="<?php if($uri=='buyer-list'){ echo 'active';}?>">
            <a href="<?=base_url('admin/buyer-list');?>"><i class="fa fa-list"></i> <span>Buyer</span></a>
          </li>   
          <!-- Subscription Payment History -->
          <li class="<?php if($uri=='subscription-payment-history'){ echo 'active';}?>">
            <a href="<?=base_url('admin/subscription-payment-history');?>"><i class="fa fa-list"></i> <span>Subscription Payment History</span></a>
          </li>
        </ul>
    </li>
    <?php } ?> 
    <!-- Service Provider -->
    <?php $role_permission = $this->mastermodel->getPermission('ServiceProvider',$uid); ?>
    <?php if($role_permission->is_view == 1){ ?>
    <li class="treeview <?php if($uri=='service-provider-list' || $uri=='service-provider-category-list' || $uri=='service-provider-suggested-category-list'){ echo 'active'; }?>">
        <a href="#">
          <i class="fa fa-user"></i>
          <span>Service Provider</span>  
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="<?php if($uri=='service-provider-list'){ echo 'active';}?>">
            <a href="<?=base_url('admin/service-provider-list');?>"><i class="fa fa-list"></i> <span>Service Provider</span></a>
          </li>
          <li class="<?php if($uri=='service-provider-category-list'){ echo 'active';}?>">
            <a href="<?=base_url('admin/service-provider-category-list');?>"><i class="fa fa-list"></i> <span>Service Provider Category</span></a>
          </li>   
          <li class="<?php if($uri=='service-provider-suggested-category-list'){ echo 'active';}?>">
            <a href="<?=base_url('admin/service-provider-suggested-category-list');?>"><i class="fa fa-list"></i> <span>Suggested Category</span></a>
          </li>  
        </ul>
    </li>
    <?php } ?>       
	  <!-- News -->
    <?php $role_permission = $this->mastermodel->getPermission('News',$uid); ?>
    <?php if($role_permission->is_view == 1){ ?>
    <li class="treeview <?php if($uri=='news-list'||$uri=='create-news' || $uri=='edit-news'){ echo 'active'; }?>">
        <a href="#">
          <i class="fa fa-newspaper-o"></i>
          <span>News</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <?php if($role_permission->is_add == 1){ ?>
          <li class="<?php if($uri=='create-news'|| $uri=='add-news'){echo'active';}?>"><a href="<?=base_url('admin/create-news');?>"><i class="fa fa-plus"></i> Create</a></li>
          <?php } ?>
          <li class="<?php if($uri=='news-list'){ echo 'active';}?>"><a href="<?=base_url('admin/news-list');?>"><i class="fa fa-list"></i>View</a></li>
        </ul>
    </li>  
  	<?php } ?>
  <!-- Special Alert -->
  <?php $role_permission = $this->mastermodel->getPermission('Specialalert',$uid); ?>
  <?php if($role_permission->is_view == 1){ ?>
  <li class="treeview <?php if($uri=='special-alert-list'||$uri=='create-special-alert' || $uri=='edit-special-alert'){ echo 'active'; }?>">
      <a href="#">
        <i class="fa fa-bell"></i>
        <span>Special Alert</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <?php if($role_permission->is_add == 1){ ?>
        <li class="<?php if($uri=='create-special-alert'|| $uri=='add-special-alert'){echo'active';}?>"><a href="<?=base_url('admin/create-special-alert');?>"><i class="fa fa-plus"></i> Create</a></li>
        <?php } ?>
        <li class="<?php if($uri=='special-alert-list'){ echo 'active';}?>"><a href="<?=base_url('admin/special-alert-list');?>"><i class="fa fa-list"></i>View</a></li>
      </ul>
  </li>
  <?php } ?>  
  <!-- Vendor -->
  <?php $role_permission = $this->mastermodel->getPermission('Vendor',$uid); ?>
  <?php if($role_permission->is_view == 1){ ?>
    <li class="treeview <?php if($uri=='vendor-list'||$uri=='create-vendor' || $uri=='edit-vendor'){ echo 'active'; }?>">
        <a href="#">
          <i class="fa fa-users"></i>
          <span>Vendor</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <?php if($role_permission->is_add == 1){ ?>
          <li class="<?php if($uri=='create-vendor'|| $uri=='add-vendor'){echo'active';}?>"><a href="<?=base_url('admin/create-vendor');?>"><i class="fa fa-plus"></i> Create</a></li>
          <?php } ?>
          <li class="<?php if($uri=='vendor-list'){ echo 'active';}?>"><a href="<?=base_url('admin/vendor-list');?>"><i class="fa fa-list"></i>View</a></li>
        </ul>
    </li> 
  <?php } ?>
  <!-- start Static Pages -->
  <?php $role_permission = $this->mastermodel->getPermission('Staticpage',$uid); ?>
  <?php if($role_permission->is_view == 1){ ?> 
  <li class="<?php if($uri=='list-static-pages' || $uri=='edit-static-pages' ){ echo 'active';}?>">
    <a href="<?=base_url('admin/list-static-pages');?>">
      <i class="fa fa-columns"></i> <span>Static Pages</span>
    </a>
  </li>
  <?php } ?>    
  <!-- END -->
</ul>   