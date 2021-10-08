<?php $HashKey = getHash(); ?>
<article class="min_350 noise_bg">

<div class="page_title">
 <div class="h2 title_text"><?php echo $this->lang->line('forgot_password'); ?></div>
 <?php echo $this->breadcrumbs->show(); ?>
</div><!--End page_title-->

<div class="container content_box">
    
<div id="loginSection" class="business">
<div class="login-box">
<div class="row brand">
  <div class="col-xs-12 no-padding text-center">
  <div class="logintext">Forgot Password (User)</div>         
  </div>
</div><!--End brand-->

<div class="row">
  <div class="col-lg-12"><?php echo AlertMessage($this->session->flashdata('AppMessage'));?></div>
</div><!--End Validation message-->

<div class="row">
  <div class="col-lg-12">
   <div id="processingAjax" class="hide"><img src="<?php echo base_url('webroot/img/fadingSquares.gif');?>" /></div>
  </div>
</div>

<?php
	$atributes = array('class'=>'forget-form','id'=>'frmlogin','autocomplete'=>'off');
	echo form_open('user/forgot-password',$atributes);
    echo '<div style="display:none;">'.form_input(array('type'=>'password','name'=>'cust_pass')).'</div>';
?>
<input type="hidden" name="valid" value="<?php echo $HashKey; ?>" />
<!-------------------------------------------------------------------->

<div class="input-group input-error">
  <span class="input-group-addon"><em class="fa fa-envelope"></em></span>
  <input type="text" class="form-control" placeholder="Email ID" name="email" tabindex="1" autofocus />
</div>

<div class="row " style="display: none;">
<div class="col-md-6 captcha input-error">
  <div id="captchaimage" style="display: inline-block"><?php echo reload_captcha(); ?></div>
  <span class="help">Can't read?  
   <a id="recap" href="javascript:void(0)">click here</a>.
  </span>
</div>
<div class="col-md-6">
 <div class="input-error">
  <input type="text" class="form-control" placeholder="Secutity Code"  value ="<?php echo  $_SESSION['word'];?>" name="captcha" tabindex="3" />
  </div>
</div>
</div>
<hr />
<button id="btnLoginUser" type="submit" class="btn btn-success" tabindex="3">Submit</button>
 <a class="btn btn-primary" class="btn btn-primary" href="<?php echo base_url('login'); ?>" tabindex="4">Back</a>
<!-------------------------------------------------------------------->
<?php echo form_close(); ?>

</div><!--End login-box-->  
</div><!--End loginSection-->
</div><!--End container-->
</article>
<script src="<?php echo HTTP_JS_PATH_ADMIN; ?>plugins/jquery-validation/dist/jquery.validate.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<script type="text/javascript">
$(document).ready(function(){
		var img_path = "<?php echo site_url().'uploads/captcha/'; ?>";
		
		$('#recap').on('click',function(e){	
		e.preventDefault();
		$.get( "<?php echo site_url('loadcaptcha');?>", function( data ) {
  		     jQuery("#captchaimage").html('<img src="'+ img_path + data +'" height="45px" width="150px">');
		});					
	   });
});
</script>
<script>
$(document).ready(function() {     
	$('.forget-form').validate({
	   errorElement: 'span', //default input error message container
	   errorClass: 'help-block', // default input error message class
	   focusInvalid: false, // do not focus the last invalid input
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
           required: "Email ID is required field.",
           email: "Enter valid email."
	     },
	     captcha:{
	       required: "Security code is required field."
	     }
	   },
	  highlight: function (element) { // hightlight error inputs
	    $(element).closest('.input-error').addClass('has-error');//set error class to the control group
	  },
      success: function (label) {
	    label.closest('.input-error').removeClass('has-error');
	    label.remove();
	  },
	  errorPlacement: function (error, element) {
	    error.insertAfter(element.closest('.input-error'));
	  },
      submitHandler: function (form) {
	    form.submit();
	    $('#processingAjax').removeClass('hide');
	  }
	});//end validation
});//end dom
</script> 
<!-- END JAVASCRIPTS -->