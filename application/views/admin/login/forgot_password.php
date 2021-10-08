<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<title>Admin Panel</title>  
<link rel="apple-touch-icon" sizes="57x57" href="<?php echo HTTP_IMAGES_PATH_ADMIN; ?>favicon/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="<?php echo HTTP_IMAGES_PATH_ADMIN; ?>favicon/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="<?php echo HTTP_IMAGES_PATH_ADMIN; ?>favicon/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="<?php echo HTTP_IMAGES_PATH_ADMIN; ?>favicon/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="<?php echo HTTP_IMAGES_PATH_ADMIN; ?>favicon/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="<?php echo HTTP_IMAGES_PATH_ADMIN; ?>favicon/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="<?php echo HTTP_IMAGES_PATH_ADMIN; ?>favicon/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="<?php echo HTTP_IMAGES_PATH_ADMIN; ?>favicon/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="<?php echo HTTP_IMAGES_PATH_ADMIN; ?>favicon/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="<?php echo HTTP_IMAGES_PATH_ADMIN; ?>favicon/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="<?php echo HTTP_IMAGES_PATH_ADMIN; ?>favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="<?php echo HTTP_IMAGES_PATH_ADMIN; ?>favicon/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="<?php echo HTTP_IMAGES_PATH_ADMIN; ?>favicon/favicon-16x16.png">
<link rel="manifest" href="/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="<?php echo HTTP_IMAGES_PATH_ADMIN; ?>favicon/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">

<?php 
$meta = array(
		array('name' => 'Content-type', 'content' => 'text/html; charset=utf-8', 'type' => 'equiv'),
		array('name' => 'X-UA-Compatible', 'content' => 'IE=edge', 'type' => 'equiv'),
        array('name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, maximum-scale=1.0'),
        array('name' => 'description', 'content' => $meta_desc),
        array('name' => 'keywords', 'content' => $meta_keyword),        
        array('name' => 'robots', 'content' => 'no-cache,noindex,nofollow')        
    );
echo meta($meta);
echo link_tag(HTTP_JS_PATH_ADMIN.'plugins/font-awesome/css/font-awesome.min.css', 'stylesheet');
echo link_tag(HTTP_JS_PATH_ADMIN.'plugins/bootstrap/css/bootstrap.min.css', 'stylesheet');
echo link_tag(HTTP_JS_PATH_ADMIN.'plugins/uniform/css/uniform.default.css', 'stylesheet');
echo link_tag(HTTP_CSS_PATH_ADMIN.'style.css', 'stylesheet');
echo link_tag(HTTP_CSS_PATH_ADMIN.'style-responsive.css', 'stylesheet');
echo link_tag(HTTP_CSS_PATH_ADMIN.'pages/login-soft.css', 'stylesheet');
?> 
<style type="text/css">
	.msgAlert p{
		color: #b94a48 !important;
	}
</style>
<script src="<?php echo HTTP_JS_PATH_ADMIN; ?>plugins/jquery-3.3.1.min.js" type="text/javascript"></script>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="login">
<!-- BEGIN LOGO -->
<div class="login-brand">
	<a title="Friends of MP" href="<?php echo base_url();?>" style="color:#FFF; font-weight:bold; font-size:16px;">
		<img src="<?php echo base_url('webroot/img/logo_big.png')?>" alt="Friends of MP logo" class="img-login"/>
	</a>
</div>
<!-- END LOGO -->
<!-- BEGIN LOGIN -->
<div class="container">
 <div class="row login-box">
  <div class="col-md-6 col-md-offset-3">
  <!-- BEGIN LOGIN -->
  <div class="start-form">
	<!-- BEGIN FORGOT PASSWORD FORM -->
	<?php
	$atributes = array('class' => 'forget-form', 'id' => 'frmlogin', 'autocomplete'=>'off');
	echo form_open('manage/Authuser/forgot_password',$atributes);
	?>
	 <div class="panel panel-default">
      <div class="panel-heading">Forgot Password (Admin)</div>
        <div class="panel-body">
		
		<div class="row">
			<div class="col-lg-12">
			<?php echo AlertMessage($this->session->flashdata('AppMessage'));?>
			</div>
		</div>
		<!--End Validation message-->
		
		<div class="form-group">
		<label class="control-label">Email</label>
			<div class="input-icon">
				<i class="fa fa-envelope"></i>
				<input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email" tabindex="1" autofocus/>
			</div>
		</div>
		
		<div class="form-group" style="display: none;">				
		<label id="recap" class="refreshcap" style="cursor: pointer;">
		<div id="captchaimage" style="display: inline-block"><?php echo reload_captcha(); ?></div> <i class="fa fa-refresh"></i></label>
		<div class="input-icon">
		<input class="form-control input-block-level" type="text" autocomplete="off" placeholder="Enter security code" name="captcha" value ="<?php echo  $_SESSION['word'];?>"  tabindex="2" autofocus="autofocus"/>
		</div>
		</div>
		
	</div><!--panel body-->
	<div class="panel-footer">
	  <div class="form-group">
	  <button type="submit" class="btn btn-success pull-right" tabindex="3">
			Submit <i class="m-icon-swapright m-icon-white"></i>
	  </button>
	  <a class="btn btn-primary" href="<?php echo base_url('manage'); ?>" tabindex="4">Back</a>
	  </div>

	</div><!--End panel-footer-->
   </div><!--panel close-->
		
	<?php echo form_close(); ?>
	<!-- END FORGOT PASSWORD FORM -->
</div>
</div>
</div>
</div>
<!-- END LOGIN -->

 <!--Ajax Loading model start-->
 	<div class="modal fade" id="ajaxloading" role="basic" aria-hidden="true">
	<div class="page-loading page-loading-boxed">
	<img src="<?php echo base_url('webroot/img/loading.gif'); ?>" alt="" class="loading">
		<span>
			&nbsp;&nbsp;Loading...
		</span>
	</div>
	<div class="modal-dialog">
	<div class="modal-content"></div>
    </div>
    </div>
 <!--Ajax Loading model end-->

<!-- BEGIN COPYRIGHT -->
<div class="copyright">
	 <?php echo $copy_right; ?> | <a href="<?php echo base_url();?>">Home</a>
</div>
<!-- END COPYRIGHT -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
	<script src="<?php echo HTTP_JS_PATH_ADMIN; ?>plugins/respond.min.js"></script>
	<script src="<?php echo HTTP_JS_PATH_ADMIN; ?>plugins/excanvas.min.js"></script> 
	<![endif]-->
<script src="<?php echo HTTP_JS_PATH_ADMIN; ?>plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?php echo HTTP_JS_PATH_ADMIN; ?>plugins/jquery-validation/dist/jquery.validate.min.js" type="text/javascript"></script>

<script type="text/javascript">
jQuery(document).ready(function(){
		var img_path = "<?php echo site_url().'uploads/captcha/'; ?>";
		
		jQuery('#recap').on('click',function(){	
		jQuery.get( "<?php echo site_url('manage/Authuser/loadcaptcha');?>", function( data ) {
  		     jQuery("#captchaimage").html('<img src="'+ img_path + data +'" height="45px" width="150px">');
		});					
	   });
});
</script>
<!-- END PAGE LEVEL SCRIPTS -->
<script type="text/javascript">
jQuery(document).ready(function() {     
        $('.forget-form').validate({
	            errorElement: 'span', //default input error message container
	            errorClass: 'help-block', // default input error message class
	            focusInvalid: false, // do not focus the last invalid input
	            ignore: "",
	            rules: {
	                email: {
	                    required: true,
	                    email: true
	                },
				    captcha:{
						required: true,
					}
	            },

	            messages: {
	                email: {
	                    required: "Email is required."
	                }
	            },

	            invalidHandler: function (event, validator) { //display error alert on form submit   

	            },

	            highlight: function (element) { // hightlight error inputs
	                $(element)
	                    .closest('.form-group').addClass('has-error'); // set error class to the control group
	            },

	            success: function (label) {
	                label.closest('.form-group').removeClass('has-error');
	                label.remove();
	            },

	            errorPlacement: function (error, element) {
	                error.insertAfter(element.closest('.input-icon'));
	            },

	            submitHandler: function (form) {
	                form.submit();
	                $('#ajaxloading').modal('show');
	            }
	        });

	    $('.forget-form input').keypress(function (e) {
	            if (e.which == 13) {
	                if ($('.forget-form').validate().form()) {
	                    $('.forget-form').submit();
	                }
	                return false;
	            }
	        });
});
</script> 
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>