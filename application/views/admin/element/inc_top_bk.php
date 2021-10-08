<!-- BEGIN HEADER -->
<div class="header navbar navbar-fixed-top">
	<!-- BEGIN TOP NAVIGATION BAR -->
	<div class="header-inner">
		<!-- BEGIN LOGO -->
		<a class="navbar-brand" href="<?php echo base_url();?>" target="_blank">
		<img src="<?php echo base_url('webroot/img/logo.png');?>" alt="logo" class="img-responsive">
		</a>
		<!-- END LOGO -->
		<div class="hor-menu hidden-sm hidden-xs">
			<h3 class="menu-user-name">
			<?php
				 if($this->session->has_userdata("AUTH_USER")){
					echo "Welcome : ".$this->session->userdata['AUTH_USER']['USER_NAME']." (".$this->session->userdata['AUTH_USER']['USER_DESIGNATION'].")";
				 }else{
				 	echo "Welcome : User";
				 }
			?>
			</h3>
		</div>
		<!-- BEGIN RESPONSIVE MENU TOGGLER -->
		<a href="javascript:;" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
		<img src="<?php echo base_url('webroot/img/menu-toggler.png');?>" />
		</a>
		<!-- END RESPONSIVE MENU TOGGLER -->
		<!-- BEGIN TOP NAVIGATION MENU -->
		<ul class="nav navbar-nav pull-right">
			<!-- BEGIN USER LOGIN DROPDOWN -->
		<?php //$this->load->view('admin/element/inc_notification'); ?>
		<li class="dropdown user">
			<a class="btn-home" href="<?php echo base_url('/'); ?>" target="_blank"> <i class="fa fa-desktop" aria-hidden="true"></i> Visit Site</a>
		</li>
		<li class="dropdown user">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
					<i class="fa fa-user"></i><span class="username">User</span><i class="fa fa-angle-down"></i>
				</a>
				
				<ul class="dropdown-menu">
					<li><a href="<?php echo base_url('manage/User/profile/'); ?>"><i class="fa fa-user"></i> My Profile</a></li>
					<li><a href="<?php echo base_url('manage/User/changePass/'); ?>"><i class="fa fa-key"></i> Change Password</a></li>
					<li><a href="<?php echo base_url('signout'); ?>"><i class="fa fa-power-off"></i> Log Out</a></li>
					<li class="divider"></li>
					<li><a href="javascript:;" id="trigger_fullscreen"><i class="fa fa-arrows"></i> Full Screen</a></li>
				</ul>
			</li>
			<!-- END USER LOGIN DROPDOWN -->
		</ul>
		<!-- END TOP NAVIGATION MENU -->
	</div>
	<!-- END TOP NAVIGATION BAR -->
</div>
<!-- END HEADER -->
<div class="clearfix"></div>
<!-- END HEADER -->
<!-- BEGIN CONTAINER -->
<?php echo'<div class="page-container">';?>