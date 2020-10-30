<?php $uri=$this->uri->segment(2); ?>
<aside class="main-sidebar">  
  	<section class="sidebar">
		<ul class="sidebar-menu" data-widget="tree">
			<li class="<?php if($uri=='dashboard'){echo'active';}?>">
				<a href="<?=base_url('admin/dashboard');?>">
				  <i class="fa fa-dashboard" aria-hidden="true"></i> <span><?=$this->lang->line('Dashboard');?></span>
				</a>
			</li>
			<li class="treeview <?php if($uri=='city-list' || $uri=='create-city' || $uri=='edit-city'){ echo 'active'; }?>">
			    <a href="#">
			      <i class="fa fa-building-o"></i>
			      <span><?=$this->lang->line('City');?></span>
			      <span class="pull-right-container">
			        <i class="fa fa-angle-left pull-right"></i>
			      </span>
			    </a>
			    <ul class="treeview-menu">
			      <li class="<?php if($uri=='create-city'|| $uri=='add-city'){echo'active';}?>"><a href="<?=base_url('admin/create-city');?>"><i class="fa fa-plus"></i> <?=$this->lang->line('Create');?></a></li>
			      <li class="<?php if($uri=='city-list'){ echo 'active';}?>"><a href="<?=base_url('admin/city-list');?>"><i class="fa fa-list"></i><?=$this->lang->line('View');?></a></li>
			    </ul>
			</li>
		  	<li class="treeview <?php if($uri=='banner-list' || $uri=='create-banner' || $uri=='edit-banner'){ echo 'active'; }?>">
			    <a href="#">
			      <i class="fa fa-image"></i>
			      <span><?=$this->lang->line('Banner');?></span>
			      <span class="pull-right-container">
			        <i class="fa fa-angle-left pull-right"></i>
			      </span>
			    </a>
			    <ul class="treeview-menu">
			      <li class="<?php if($uri=='create-banner'|| $uri=='add-banner'){echo'active';}?>"><a href="<?=base_url('admin/create-banner');?>"><i class="fa fa-plus"></i> <?=$this->lang->line('Create');?></a></li>
			      <li class="<?php if($uri=='banner-list'){ echo 'active';}?>"><a href="<?=base_url('admin/banner-list');?>"><i class="fa fa-list"></i><?=$this->lang->line('View');?></a></li>
			    </ul>
		  	</li>
		  	<li class="treeview <?php if($uri=='store-list' || $uri=='create-store' || $uri=='edit-store'){ echo 'active'; }?>">
			    <a href="#">
			      <i class="fa fa-shopping-cart"></i>
			      <span><?=$this->lang->line('Store');?></span>
			      <span class="pull-right-container">
			        <i class="fa fa-angle-left pull-right"></i>
			      </span>
			    </a>
			    <ul class="treeview-menu">
			      <li class="<?php if($uri=='create-store'|| $uri=='add-store'){echo'active';}?>"><a href="<?=base_url('admin/create-store');?>"><i class="fa fa-plus"></i> <?=$this->lang->line('Create');?></a></li>
			      <li class="<?php if($uri=='store-list'){ echo 'active';}?>"><a href="<?=base_url('admin/store-list');?>"><i class="fa fa-list"></i><?=$this->lang->line('View');?></a></li>
			    </ul>
		  	</li>
		  	<li class="treeview <?php if($uri=='category-list' || $uri=='create-category' || $uri=='edit-category'){ echo 'active'; }?>">
			    <a href="#">
			      <i class="fa fa-tag"></i>
			      <span><?=$this->lang->line('Category');?></span>
			      <span class="pull-right-container">
			        <i class="fa fa-angle-left pull-right"></i>
			      </span>
			    </a>
			    <ul class="treeview-menu">
			      <li class="<?php if($uri=='create-category'|| $uri=='add-category'){echo'active';}?>"><a href="<?=base_url('admin/create-category');?>"><i class="fa fa-plus"></i> <?=$this->lang->line('Create');?></a></li>
			      <li class="<?php if($uri=='category-list'){ echo 'active';}?>"><a href="<?=base_url('admin/category-list');?>"><i class="fa fa-list"></i><?=$this->lang->line('View');?></a></li>
			    </ul>
		  	</li>
		  	<li class="treeview <?php if($uri=='brand-list' || $uri=='create-brand' || $uri=='edit-brand' || $uri=='bulk-brand'){ echo 'active'; }?>">
			    <a href="#">
			      <i class="fa fa-bandcamp"></i>
			      <span><?=$this->lang->line('Brand');?></span>
			      <span class="pull-right-container">
			        <i class="fa fa-angle-left pull-right"></i>
			      </span>
			    </a>
			    <ul class="treeview-menu">
			      <li class="<?php if($uri=='create-brand'|| $uri=='add-brand'){echo'active';}?>"><a href="<?=base_url('admin/create-brand');?>"><i class="fa fa-plus"></i> <?=$this->lang->line('Create');?></a></li>
			      <li class="<?php if($uri=='brand-list'){ echo 'active';}?>"><a href="<?=base_url('admin/brand-list');?>"><i class="fa fa-list"></i><?=$this->lang->line('View');?></a></li>
			    </ul>
		  	</li>
		  	<li class="treeview <?php if($uri=='product-list' || $uri=='create-product' || $uri=='edit-product' || $uri=='bulk-product'){ echo 'active'; }?>">
			    <a href="#">
			      <i class="fa fa-product-hunt"></i>
			      <span><?=$this->lang->line('Product');?></span>
			      <span class="pull-right-container">
			        <i class="fa fa-angle-left pull-right"></i>
			      </span>
			    </a>
			    <ul class="treeview-menu">
			      <li class="<?php if($uri=='create-product'|| $uri=='add-product'){echo'active';}?>"><a href="<?=base_url('admin/create-product');?>"><i class="fa fa-plus"></i> <?=$this->lang->line('Create');?></a></li>
			      <li class="<?php if($uri=='bulk-product'){echo'active';}?>"><a href="<?=base_url('admin/bulk-product');?>"><i class="fa fa-upload"></i> <?=$this->lang->line('Bulk Product');?></a></li>
			      <li class="<?php if($uri=='product-list'){ echo 'active';}?>"><a href="<?=base_url('admin/product-list');?>"><i class="fa fa-list"></i><?=$this->lang->line('View');?></a></li>
			    </ul>
	  		</li>
	
			<li class="treeview <?php if( $uri=='pending-order-list' || $uri=='running-order-list' || $uri=='cancelled-order-list' || $uri=='complete-order-list' ||  $uri=='order-view'){ echo 'active'; }?>">
		        <a href="#">
		          <i class="fa fa-first-order"></i>
		          <span><?=$this->lang->line('Orders');?></span>
		          <span class="pull-right-container">
		            <i class="fa fa-angle-left pull-right"></i>
		          </span>
		        </a>
		        <ul class="treeview-menu">
	              <li class="<?php if($uri=='pending-order-list'){ echo 'active'; }?>" >
	                <a href="<?=base_url('admin/pending-order-list');?>"><i class="fa fa-circle-o"></i><?=$this->lang->line('Pending');?></a>
	              </li>
	              <li class="<?php if($uri=='running-order-list'){ echo 'active'; }?>" >
	                <a href="<?=base_url('admin/running-order-list');?>"><i class="fa fa-circle-o"></i><?=$this->lang->line('Running');?></a>
	              </li>
		          <li class="<?php if($uri=='cancelled-order-list'){ echo 'active'; }?>" >
	                <a href="<?=base_url('admin/cancelled-order-list');?>"><i class="fa fa-circle-o"></i><?=$this->lang->line('Cancelled');?></a>
	              </li>
	               <li class="<?php if($uri=='complete-order-list'){ echo 'active'; }?>" >
	                <a href="<?=base_url('admin/complete-order-list');?>"><i class="fa fa-circle-o"></i><?=$this->lang->line('Completed');?></a>
	              </li>
		        </ul> 
	      	</li>

			<li class="treeview <?php if($uri=='payment-driver-list' || $uri=='payment-txn-list'){ echo 'active'; }?>">
			    <a href="#">
			      <i class="fa fa-credit-card"></i>
			      <span><?=$this->lang->line('Payment');?></span>
			      <span class="pull-right-container">
			        <i class="fa fa-angle-left pull-right"></i>
			      </span>
			    </a>
			    <ul class="treeview-menu">
			      <li class="<?php if($uri=='payment-driver-list'){echo'active';}?>"><a href="<?=base_url('admin/payment-driver-list');?>"><i class="fa fa-circle-o"></i> <?=$this->lang->line('Driver');?></a></li>
			      <li class="<?php if($uri=='payment-txn-list'){ echo 'active';}?>"><a href="<?=base_url('admin/payment-txn-list');?>"><i class="fa fa-circle-o"></i><?=$this->lang->line('Order Transaction');?></a></li>
			    </ul>
		  	</li>

		  	<li class="treeview <?php if($uri=='time-slot-list' || $uri=='create-time-slot' || $uri=='edit-time-slot' || $uri=='bulk-time-slot'){ echo 'active'; }?>">
			    <a href="#">
			      <i class="fa fa-clock-o"></i>
			      <span><?=$this->lang->line('Time Slot');?></span>
			      <span class="pull-right-container">
			        <i class="fa fa-angle-left pull-right"></i>
			      </span>
			    </a>
			    <ul class="treeview-menu">
			      <li class="<?php if($uri=='create-time-slot'|| $uri=='add-time-slot'){echo'active';}?>"><a href="<?=base_url('admin/create-time-slot');?>"><i class="fa fa-plus"></i> <?=$this->lang->line('Create');?></a></li>
			      <li class="<?php if($uri=='time-slot-list'){ echo 'active';}?>"><a href="<?=base_url('admin/time-slot-list');?>"><i class="fa fa-list"></i><?=$this->lang->line('View');?></a></li>
			    </ul>
		  	</li>
		  	<li class="treeview <?php if($uri=='promocode-list' || $uri=='create-promocode' || $uri=='edit-promocode'){ echo 'active'; }?>">
			    <a href="#">
			      <i class="fa fa-gift"></i>
			      <span><?=$this->lang->line('Promocode');?></span>
			      <span class="pull-right-container">
			        <i class="fa fa-angle-left pull-right"></i>
			      </span>
			    </a>
			    <ul class="treeview-menu">
			      <li class="<?php if($uri=='create-promocode'|| $uri=='add-promocode'){echo'active';}?>"><a href="<?=base_url('admin/create-promocode');?>"><i class="fa fa-plus"></i> <?=$this->lang->line('Create');?></a></li>
			      <li class="<?php if($uri=='promocode-list'){ echo 'active';}?>"><a href="<?=base_url('admin/promocode-list');?>"><i class="fa fa-list"></i><?=$this->lang->line('View');?></a></li>
			    </ul>
		  	</li>
		  	<li class="<?php if($uri=='user-list'){echo'active';}?>">
				<a href="<?=base_url('admin/user-list');?>">
				  	<i class="fa fa-users" aria-hidden="true"></i> <span><?=$this->lang->line('User');?></span>
				</a>
			</li>
			<li class="treeview <?php if($uri=='delivery-boy-list' || $uri=='create-delivery-boy' || $uri=='edit-delivery-boy'){ echo 'active'; }?>">
			    <a href="#">
			      <i class="fa fa-users"></i>
			      <span><?=$this->lang->line('Delivery Boy');?></span>
			      <span class="pull-right-container">
			        <i class="fa fa-angle-left pull-right"></i>
			      </span>
			    </a>
			    <ul class="treeview-menu">
			      <li class="<?php if($uri=='create-delivery-boy'|| $uri=='add-delivery-boy'){echo'active';}?>"><a href="<?=base_url('admin/create-delivery-boy');?>"><i class="fa fa-plus"></i> <?=$this->lang->line('Create');?></a></li>
			      <li class="<?php if($uri=='delivery-boy-list'){ echo 'active';}?>"><a href="<?=base_url('admin/delivery-boy-list');?>"><i class="fa fa-list"></i><?=$this->lang->line('View');?></a></li>
			    </ul>
		  	</li>
		  	<li class="treeview <?php if($uri=='notification-user-list' || $uri=='notification-delivery-boy-list'){ echo 'active'; }?>">
			    <a href="#">
			      <i class="fa fa-bell"></i>
			      <span><?=$this->lang->line('Notification');?></span>
			      <span class="pull-right-container">
			        <i class="fa fa-angle-left pull-right"></i>
			      </span>
			    </a>
			    <ul class="treeview-menu">
			      <li class="<?php if($uri=='notification-user-list'){echo'active';}?>"><a href="<?=base_url('admin/notification-user-list');?>"><i class="fa fa-circle-o"></i> <?=$this->lang->line('User');?></a></li>
			      <li class="<?php if($uri=='notification-delivery-boy-list'){ echo 'active';}?>"><a href="<?=base_url('admin/notification-delivery-boy-list');?>"><i class="fa fa-circle-o"></i> <?=$this->lang->line('Delivery Boy');?></a></li>
			    </ul>
		  	</li>
		  	<li class="<?php if($uri=='page-list'){echo'active';}?>">
				<a href="<?=base_url('admin/page-list');?>">
				  	<i class="fa fa-file" aria-hidden="true"></i> <span><?=$this->lang->line('Pages');?></span>
				</a>
			</li>
			<li class="<?php if($uri=='setting'){echo'active';}?>">
				<a href="<?=base_url('admin/setting');?>">
				  	<i class="fa fa-cog" aria-hidden="true"></i> <span><?=$this->lang->line('Setting');?></span>
				</a>
			</li>
		</ul>   
  	</section>
</aside>