<?php defined('BASEPATH') OR exit('No direct script access allowed');

echo doctype('html5').PHP_EOL;
?>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="de">  <!--<![endif]-->
  

<head>
<title><?php echo $meta_title; ?></title>
<?php
$meta = array(
		      array('name' => 'Content-type', 'content' => 'charset=UTF-8'),
          array('name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no'),		  
          array('name' => 'Content-type', 'content' => 'Content-Type: application/x-font-woff'),
          array('name' => 'X-UA-Compatible', 'content' => 'IE=edge', 'type' => 'equiv'),          
          array('name' => 'description', 'content' => $meta_desc),
          array('name' => 'keywords', 'content' => $meta_keyword),       
       );
echo meta($meta);
?>
<base href="/">
<link rel="shortcut icon" href="<?php echo HTTP_IMAGES_PATH; ?>favicon.ico" type="image/x-icon">
<link rel="icon" href="<?php echo HTTP_IMAGES_PATH; ?>favicon.ico" type="image/x-icon">

<?php echo put_headers(); ?>
<link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300i,400,400i" rel="stylesheet">
	
</head>
<?php 
   echo '<body>'.PHP_EOL; 
   echo '<div class="boxed_wrapper">';
?>
