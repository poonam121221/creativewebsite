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
<link rel="manifest" href="<?php echo HTTP_IMAGES_PATH_ADMIN; ?>favicon/manifest.json"> 
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="<?php echo HTTP_IMAGES_PATH_ADMIN; ?>favicon/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">

<?php 
$meta = array(
		array('name' => 'Content-type', 'content' => 'text/html; charset=utf-8', 'type' => 'equiv'),
		array('name' => 'Content-type', 'content' => 'Content-Type: application/x-font-woff'),
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
$HashKey = getHash(); 
?> 
<style type="text/css">
	.msgAlert p{
		color: #b94a48 !important;
	}
</style>
<script src="<?php echo HTTP_JS_PATH_ADMIN; ?>plugins/jquery-3.3.1.min.js" type="text/javascript"></script>
<script src="<?php echo HTTP_JS_PATH_ADMIN; ?>scripts/sha256.js" type="text/javascript"></script>
<script type="text/javascript"> 
$(function(){
	
	$('#frmlogin').on('submit',function(){
		var u_ps = "";
        var hash = "";
        var seed = "<?php echo $HashKey ; ?>";
        var shaObj1 = new jsSHA("SHA-256","TEXT","1");
        var shaObj2 = new jsSHA("SHA-256","TEXT","1");
        var shaObj3 = new jsSHA("SHA-256","TEXT","1");
        u_ps = document.getElementById("u_ps").value;	    
        
        if(u_ps!="" && $('.login-form').valid()){        	
        	shaObj1.update(seed);
        	shaObj2.update(u_ps);        	
        	hash = shaObj1.getHash("HEX")+shaObj2.getHash("HEX");
        	shaObj3.update(hash);
        	hash = shaObj3.getHash("HEX"); 
        	document.getElementById("u_ps").value=hash; 
        	//u_ps = document.getElementById("u_ps").value;
		}
	});//end click event
});//end dom

</script>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="login">
	<div class="login-brand">
	<a title="Member Registration Icon" href="<?php echo base_url(); ?>" style="color:#FFF; font-weight:bold; font-size:16px;">
		<img src="<?php echo base_url('webroot/img/logo_big.png')?>" alt="" class="img-login">
	</a>
</div>

<!-- BEGIN LOGIN -->
<div class="container">
	<div class="row login-box">
		<div class="col-md-6 col-md-offset-3">

<div class="start-form">
	<!-- BEGIN LOGIN FORM -->
<?php
	$atributes = array('class' => 'login-form', 'id' => 'frmlogin', 'autocomplete'=>'off');
	echo form_open('manage/Authuser/checkLogin',$atributes);
	echo '<div style="display:none;">'.form_input(array('type'=>'password','name'=>'cust_pass')).'</div>';
?>	
<div class="panel panel-default">
	<div class="panel-heading">Login to your account <strong>(Admin Login)</strong></div>
	<div class="panel-body">
		<input type="hidden" name="valid" value="<?php echo $HashKey; ?>" />		
		<div class="row">
			<div class="col-lg-12">
			<?php echo AlertMessage($this->session->flashdata('AppMessage'));?>
			</div>
		</div>
		<!--End Validation message-->
		
		<div class="form-group">
			<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
			<label class="control-label">Username</label>
			<div class="input-icon">
				<i class="fa fa-user"></i>
				<input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Username" name="user_name" tabindex="1" autofocus="autofocus"/>
			</div>
		</div> 
		<div class="form-group">
			<label class="control-label">Password</label>
			<div class="input-icon">
				<i class="fa fa-lock"></i>
				<input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" id="u_ps" name="user_pass" tabindex="2"/>
			</div>
		</div>
		<div class="form-group hidden">				
		<label id="recap" class="refreshcap" style="cursor: pointer;">
		<div id="captchaimage" style="display: inline-block"><?php echo reload_captcha(); ?></div> <i class="fa fa-refresh"></i></label>
		<div class="input-icon">
		<input class="form-control input-block-level" type="text" autocomplete="off" placeholder="Enter security code"  value ="<?php echo  $_SESSION['word'];?>" name="captcha" tabindex="3" autofocus="autofocus"/>
		</div>
		</div>
		</div>
		<div class="panel-footer">
		<div class="form-group">
			<button id="btnLoginUser" type="submit" class="btn btn-success" tabindex="3">
			Login <i class="m-icon-swapright m-icon-white"></i>
			</button>
		</div>
		<div class="forget-password">
			<h4>Forgot your password ?</h4>
			<p>
			no worries,<a href="<?php echo base_url('manage/forgot-pwd'); ?>" id="forget-password">click here</a>
			to reset your password.
			</p>
		</div>
		</div>
		</div>
	<?php echo form_close(); ?>
	<!-- END LOGIN FORM -->
</div>
	</div>
	</div>
</div>
<!-- END LOGIN -->
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
<!-- END PAGE LEVEL PLUGINS -->
<script type="text/javascript">
	$(function(){
		$('.login-form').validate({
	       errorElement: 'span', //default input error message container
	       errorClass: 'help-block', // default input error message class
	       focusInvalid: false, // do not focus the last invalid input
	       rules: {
	         user_name: {
	            required: true
	         },
	         user_pass: {
	            required: true
	         },
	         remember: {
	            required: false
	         },
			 captcha:{
				required: true,
			 }
	       },
           messages: {
	         user_name: {
	           required: "Username is required field."
	         },
	         user_pass: {
	           required: "Password is required field."
	         },
	         captcha:{
	           required: "Security code is required field."
	         }
	       },
		   highlight: function (element) { // hightlight error inputs
	        $(element).closest('.form-group').addClass('has-error'); // set error class to the control group
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
	       }
	      });
	});
</script>
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
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>