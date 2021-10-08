<?php
defined('BASEPATH') OR exit('No direct script access allowed');
echo doctype('html5');
echo '<html lang="en" class="no-js">';
?>
<head>
<!-- META SECTION -->        
<?php
echo '<title>'.$meta_title.'</title>';
$meta = array(
		array('name' => 'Content-type', 'content' => 'text/html; charset=utf-8', 'type' => 'equiv'),
		array('name' => 'Content-type', 'content' => 'Content-Type: application/x-font-woff'),
		array('name' => 'X-UA-Compatible', 'content' => 'IE=edge', 'type' => 'equiv'),
        array('name' => 'viewport', 'content' => 'width=device-width, initial-scale=1.0, maximum-scale=1.0'),
        array('name' => 'description', 'content' => ''),
        array('name' => 'keywords', 'content' => ''),        
        array('name' => 'robots', 'content' => 'no-cache,noindex,nofollow')        
    );
echo meta($meta);?>  
<link rel="apple-touch-icon" sizes="57x57" href="<?php echo HTTP_IMAGES_PATH_ADMIN; ?>favicon/apple-icon-57x57.png"/>
<link rel="apple-touch-icon" sizes="60x60" href="<?php echo HTTP_IMAGES_PATH_ADMIN; ?>favicon/apple-icon-60x60.png"/>
<link rel="apple-touch-icon" sizes="72x72" href="<?php echo HTTP_IMAGES_PATH_ADMIN; ?>favicon/apple-icon-72x72.png"/>
<link rel="apple-touch-icon" sizes="76x76" href="<?php echo HTTP_IMAGES_PATH_ADMIN; ?>favicon/apple-icon-76x76.png"/>
<link rel="apple-touch-icon" sizes="114x114" href="<?php echo HTTP_IMAGES_PATH_ADMIN; ?>favicon/apple-icon-114x114.png"/>
<link rel="apple-touch-icon" sizes="120x120" href="<?php echo HTTP_IMAGES_PATH_ADMIN; ?>favicon/apple-icon-120x120.png"/>
<link rel="apple-touch-icon" sizes="144x144" href="<?php echo HTTP_IMAGES_PATH_ADMIN; ?>favicon/apple-icon-144x144.png"/>
<link rel="apple-touch-icon" sizes="152x152" href="<?php echo HTTP_IMAGES_PATH_ADMIN; ?>favicon/apple-icon-152x152.png"/>
<link rel="apple-touch-icon" sizes="180x180" href="<?php echo HTTP_IMAGES_PATH_ADMIN; ?>favicon/apple-icon-180x180.png"/>
<link rel="icon" type="image/png" sizes="192x192"  href="<?php echo HTTP_IMAGES_PATH_ADMIN; ?>favicon/android-icon-192x192.png"/>
<link rel="icon" type="image/png" sizes="32x32" href="<?php echo HTTP_IMAGES_PATH_ADMIN; ?>favicon/favicon-32x32.png"/>
<link rel="icon" type="image/png" sizes="96x96" href="<?php echo HTTP_IMAGES_PATH_ADMIN; ?>favicon/favicon-96x96.png"/>
<link rel="icon" type="image/png" sizes="16x16" href="<?php echo HTTP_IMAGES_PATH_ADMIN; ?>favicon/favicon-16x16.png"/>
<link rel="manifest" href="<?php echo HTTP_IMAGES_PATH_ADMIN; ?>favicon/manifest.json"/>
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="<?php echo HTTP_IMAGES_PATH_ADMIN; ?>favicon/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">
<!--<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>-->
<link rel="stylesheet" href="<?php echo base_url();?>webroot/plugins/font-awesome/css/font-awesome.min.css"/>
<link rel="stylesheet" href="<?php echo base_url();?>webroot/plugins/bootstrap/css/bootstrap.min.css"/>
<!--<link rel="stylesheet" href="<?php echo base_url();?>webroot/plugins/uniform/css/uniform.default.css"/>-->
<link rel="stylesheet" href="<?php echo base_url();?>webroot/css/style-color.css"/>
<link rel="stylesheet" href="<?php echo base_url();?>webroot/css/style.css"/>
<link rel="stylesheet" href="<?php echo base_url();?>webroot/css/style-responsive.css"/>
<link rel="stylesheet" href="<?php echo base_url();?>webroot/css/plugins.css"/>
<link rel="stylesheet" href="<?php echo base_url();?>webroot/css/themes/grey.css"/>
<link rel="stylesheet" href="<?php echo base_url();?>webroot/css/custom.css"/>
<link rel="stylesheet" href="<?php echo base_url();?>webroot/css/print.css" media="print"/>
<link rel="stylesheet" href="<?php echo base_url();?>assets/fonts/icomoon/styles.css"/>
<?php 
echo put_admin_headers();
?>
<!-- CSS INCLUDE --> 
</head>
<!--Add page-sidebar-closed-->
<!-- You can add this class here for fixed side bar page-sidebar-fixed-->
<?php echo '<body class="page-header-fixed page-sidebar-fixed">';?><!-- BEGIN HEADER -->