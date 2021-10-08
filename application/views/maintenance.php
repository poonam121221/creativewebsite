<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE HTML>
<!--[if lt IE 7 ]> <html lang="en" class="ie ie6"> <![endif]--> 
<!--[if IE 7 ]>	<html lang="en" class="ie ie7"> <![endif]--> 
<!--[if IE 8 ]>	<html lang="en" class="ie ie8"> <![endif]--> 
<!--[if IE 9 ]>	<html lang="en" class="ie ie9"> <![endif]--> 
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<head>
<meta charset="utf-8">
<title><?php echo $config['site_name_en']; ?></title>
<meta name="description" content="">
<meta http-equiv="X-UA-Compatible" content="chrome=1">
<link rel="stylesheet" type="text/css" href="<?php echo HTTP_CSS_PATH; ?>bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo HTTP_CSS_PATH; ?>coming-soon.css">
<script type="text/javascript" src="<?php echo HTTP_JS_PATH; ?>jquery.min.js"></script> 
<script type="text/javascript" src="<?php echo HTTP_JS_PATH; ?>jquery.countdown.min.js"></script>
</head>
<body id="home">
<section class="main">
<div id="Content" class="wrapper features">
	<div id="Header">
	<div class="wrapper">
		<div class="logo"><img src="<?php echo HTTP_IMAGES_PATH; ?>logo.png" /></div>
		<div class="top-heading"><h1>UNDER MAINTENANCE</h1> </div>
		</div>
	</div>
	<h3>Sorry for the inconvenience.<br/> To improve our services, we have momentarily shutdown our site!!!</h3>
	
	<div id="clock" class="countdown styled"></div> 
<?php if(isset($config['maintenance_mode_date']) && trim($config['maintenance_mode_date'])!=""){ ?>
	<script type="text/javascript">
     $('#clock').countdown("<?php echo $config['maintenance_mode_date']; ?>", function(event) {
       $(this).html(event.strftime('<div>%D days</div> <div>%H:</div><div>%M:</div><div>%S</div>'));
     });
</script>
<?php }	 ?>
</div><!--End content wrapper-->
</section>
<!--Scripts-->
</body>
</html>