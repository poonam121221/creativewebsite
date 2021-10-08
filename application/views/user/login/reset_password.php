<?php $HashKey = getHash(); ?>
<article class="min_350 noise_bg">

<div class="page_title">
 <div class="h2 title_text"><?php echo $this->lang->line('reset_password'); ?></div>
 <?php echo $this->breadcrumbs->show(); ?>
</div><!--End page_title-->

<div class="container content_box">
    
<div id="loginSection" class="business">
<div class="login-box">
<div class="row brand">
  <div class="col-xs-12 no-padding text-center">
  <div class="logintext">Reset Password (User)</div>         
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
	$atributes = array('class'=>'reset-password-form', 'id'=>'frmlogin', 'autocomplete'=>'off');
	echo form_open('user/reset-password',$atributes);
	$data = array('key' => (isset($key))?$key:'','token' =>(isset($token))?$token:'');

    echo form_hidden($data);
    echo '<div style="display:none;">'.form_input(array('type'=>'password','name'=>'cust_pass')).'</div>';
?>
<input type="hidden" name="valid" value="<?php echo $HashKey; ?>" />
<!-------------------------------------------------------------------->

<div class="form-group">
            <label for="new_pass">Password <span class="red">*</span></label>
			<div class="input-icon">
				<input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" id="new_pass" name="new_pass" tabindex="1" autofocus/>
			</div>
		</div>
		
	   <div class="form-group">
		    <label for="con_pass">Confirm Password <span class="red">*</span></label>
			<div class="input-icon">
				<input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Confirm Password" id="con_pass" name="con_pass" tabindex="2"/>
			</div>
		</div>
		
	   <div class="form-group">				
		<label id="recap" class="refreshcap" style="cursor: pointer;">
		<div id="captchaimage" style="display: inline-block"><?php echo reload_captcha(); ?></div> <i class="fa fa-refresh"></i></label>
		<div class="input-icon">
		<input class="form-control input-block-level" type="text" autocomplete="off" placeholder="Enter security code" name="captcha" tabindex="3" autofocus/>
		</div>
		</div>
		
		<button id="btnLoginUser" type="submit" class="btn btn-success" tabindex="4">Submit</button>
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
jQuery(document).ready(function(){
		var img_path = "<?php echo site_url().'uploads/captcha/'; ?>";
		
		jQuery('#recap').on('click',function(e){	
		e.preventDefault();
		jQuery.get( "<?php echo site_url('loadcaptcha');?>", function( data ) {
  		     jQuery("#captchaimage").html('<img src="'+ img_path + data +'" height="45px" width="150px">');
		});					
	   });
	   
});
</script>
<script type="text/javascript">
	$(function(){
		jQuery.validator.addMethod("passwordptr", function(value, element) {
		  return this.optional(element) || /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[0-9a-zA-Z!@#$%^&*?~]{6,}$/.test(value);
	},$.validator.format("Minimum length of Password should be 6 with 1 captal letter, 1 small letter , 1 number and optional following special characters !@#$%^&*?~"));
	   
	   $('.reset-password-form').validate({
	            errorElement: 'span', //default input error message container
	            errorClass: 'help-block', // default input error message class
	            focusInvalid: false, // do not focus the last invalid input
	            ignore: "",
	            rules: {
	                new_pass:{
				   		required: true,
				   		minlength:6,
				   		maxlength:20,
				   		passwordptr:true
				    },
				    con_pass:{
				   		required: true,
				   		equalTo: "#new_pass"
				    },
				    captcha:{
				   		required: true
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
	            }
	        });
	});
</script>
<!-- END JAVASCRIPTS -->