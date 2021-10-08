<!-- BEGIN SIDEBAR -->
<div class="page-sidebar-wrapper">
 <div class="page-sidebar navbar-collapse collapse">
	<!-- add "navbar-no-scroll" class to disable the scrolling of the sidebar menu -->
	<!-- BEGIN SIDEBAR MENU -->
	<?php  
	$menu  = array( 'menus' => array(), 'parent_menus' => array());
	$menus = customMenu();
	$crnt_controller = strtolower("manage/".$this->router->fetch_class());
	$crnt_function = strtolower($this->router->fetch_method());

	if(isset($menus) && !empty($menus)):

	foreach($menus as $menu1) {
		$menu['menus'][$menu1['id']] = $menu1;
		$menu['parent_menus'][$menu1['p_menu_id']][] = $menu1['id']; 
	}
	echo buildMenu(0, $menu,$crnt_controller,$crnt_function);
	endif;//End check $menus Variable is set of not
	?>
	<!-- END SIDEBAR MENU -->
	</div>
</div>
<!-- END SIDEBAR -->
<!-- START PAGE CONTAINT -->
<?php echo'<div class="page-content-wrapper">';?>
<?php echo'<div class="page-content" style="min-height:600px !important">';?>