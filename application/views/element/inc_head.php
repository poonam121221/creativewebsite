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
<link
		href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i,900,900i&amp;subset=cyrillic,hebrew,latin-ext"
		rel="stylesheet">
	<link
		href="https://fonts.googleapis.com/css?family=Oswald:200,300,400,500,600,700&amp;subset=cyrillic,latin-ext,vietnamese"
		rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Karla:400,400i,700,700i&amp;subset=latin-ext" rel="stylesheet">
	<link
		href="https://fonts.googleapis.com/css?family=Playfair+Display:400,400i,700,700i,900,900i&amp;subset=cyrillic,latin-ext"
		rel="stylesheet">

</head>
<?php 
$nothomepage =  $this->uri->segment(1); 

if($nothomepage){
	echo '<body class="information-information-4 home4 group2">'.PHP_EOL;
} else{
	echo '<body class="common-home home4 group2">'.PHP_EOL; 
}

echo '<div class="wrapper">';
 ?>
