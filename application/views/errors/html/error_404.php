<?php 
$ci= new CI_Controller();
$ci=& get_instance();
$ci->load->helper('url');
$meta_title = "404: Page not found";
$meta_desc = "";
$meta_keyword = "";
//include(APPPATH."views/element/inc_head.php");
redirect('Errors');
?>			