<!-- BEGIN PAGE HEADER-->
<div class="row">
<div class="col-md-12">
	<ul class="page-breadcrumb breadcrumb">
		<li><i class="fa fa-home"></i><a href="<?php echo base_url('manage/Dashboard/'); ?>">Home</a><i class="fa fa-angle-right"></i></li>
		<li><a href="#<?php echo base_url('manage/User/'); ?>">Change Password</a><i class="fa fa-angle-right"></i></li>
		<li><a href="javascript:void(0);">View</a></li>
	</ul>
	<!-- END PAGE TITLE & BREADCRUMB-->
</div>
</div>
<!-- END PAGE HEADER-->
<!-- BEGIN PAGE CONTENT-->
<div class="row">
<div class="col-md-12">
<!------------------------------------------------------------------- -->
<!-- BEGIN BORDERED TABLE PORTLET-->
<div class="portlet box blue">
<div class="portlet-title">
  <div class="caption">Change Password</div>
  <div class="tools"> <a href="javascript:;" class="collapse"> </a></div>
</div><!--End portlet-title-->
<div class="portlet-body">
<!--------------------------------------------------------------------------->
<div class="row"><div class="col-lg-12">
<?php echo AlertMessage($this->session->flashdata('AppMessage'));?>
</div></div>
<!--End Validation message-->
<?php
$atr2 =array('id'=>'frmUser','name'=>'frmUser','class'=>'form-horizontal','role'=>'form', 'autocomplete'=>'off');
echo form_open('manage/User/changePass',$atr2); 
?>
 <div class="form-body">
 			
 			<div class="form-group">
				<label class="col-sm-4 col-md-3 control-label">Current Password<span class="red">*</span></label>
				<div class="col-sm-8 col-md-9">
				<?php $UPASS = array( 
		        'name'=>'upass','id'=>'upass','class'=> 'form-control input-medium',
		        'placeholder'=>'Enter Current Password');
				echo form_password($UPASS);
			    ?>
				</div>
			</div><!--End form-group-->
			
			<div class="form-group">
				<label class="col-sm-4 col-md-3 control-label">New Password<span class="red">*</span></label>
				<div class="col-sm-8 col-md-9">
				<?php $CON_PASS = array( 
		        'name'=>'new_pass','id'=>'new_pass','class'=> 'form-control input-medium',
		        'placeholder'=>'Enter New Password !');
				echo form_password($CON_PASS);
			    ?>
				</div>
			</div><!--End form-group-->
			
			<div class="form-group">
				<label class="col-sm-4 col-md-3 control-label">Confirm Password<span class="red">*</span></label>
				<div class="col-sm-8 col-md-9">
				<?php $CON_PASS = array( 
		        'name'=>'con_pass','id'=>'password_strength','class'=> 'form-control input-medium',
		        'placeholder'=>'Enter Confirm Password !');
				echo form_password($CON_PASS);
			    ?>
				</div>
			</div><!--End form-group-->
			
			<div class="form-group">
				<label class="col-sm-4 col-md-3 control-label">&nbsp;</label>
				<div class="col-sm-8 col-md-9">
				<label id="recap" class="refreshcap" style="cursor: pointer;">
				<div id="captchaimage" style="display: inline-block"><?php echo reload_captcha(); ?></div> 
				<i class="fa fa-refresh"></i>
				</label>
				</div>
			</div><!--End form-group-->
			
			<div class="form-group">
				<label class="col-sm-4 col-md-3 control-label">Security Code <span class="red">*</span></label>
				<div class="col-sm-8 col-md-9">
				<?php $SECURITY_CODE = array( 
		        'name'=>'captcha','id'=>'captcha','class'=> 'form-control input-medium','placeholder'=>'Enter security code');
				echo form_input($SECURITY_CODE);
			    ?>
				</div>
			</div><!--End form-group-->

	<div class="form-group">
		<label class="col-sm-4 col-md-3 control-label"></label>
		<div class="col-sm-8 col-md-9">
			<button type="submit" class="btn green">Update</button>
			<button type="reset" class="btn blue">Clear</button>
			<a class="btn purple" href="<?php echo base_url('manage/User/'); ?>">Back</a>
		</div>
	</div><!--End form-group-->
 </div><!--End form-body-->
 <?php echo form_close(); ?>
 <!--------------------------------------------------------------------------->
</div><!-- End portlet-body -->
</div><!-- End BORDERED TABLE PORTLET-->
<!------------------------------------------------------------------- -->
</div><!--End column -->
</div><!--End row-->
<div class="row">
	<div class="col-md-12">
		<div class="note note-success">
			<p>Minimum length of Password should be 6 with 1 capital letter, 1 small letter , 1 number.</p>
		</div>
	</div>
</div>
<!-- END PAGE CONTENT-->
<script type="text/javascript" src="<?php echo base_url('webroot/');?>plugins/jquery.validate.min.js"></script>
<script type="text/javascript">
	jQuery(function(){	
		
	jQuery.validator.addMethod("alphanumspace", function(value, element) {
		  return this.optional(element) || /^[a-zA-Z0-9\s]*$/.test(value);
	}, "Please enter character and space only.");
	
	jQuery.validator.addMethod("passwordptr", function(value, element) {
		  return this.optional(element) || /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[0-9a-zA-Z!@#$%^&*?~]{6,}$/.test(value);
	}, "Minimum length of Password should be 6 with 1 capital letter, 1 small letter , 1 number");
	
	jQuery( "#frmUser" ).validate({
		  rules: { 
		  upass: {
		        required: true,
		        maxlength:20
		   },
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
		 message:{
		  	upass:{required:"Current password is required field."}
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
<script type="text/javascript" src="<?php echo base_url('webroot/');?>plugins/jquery-inputmask/jquery.inputmask.bundle.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('webroot/');?>plugins/jquery.pwstrength.bootstrap/src/pwstrength.js"></script>
<script type="text/javascript" src="<?php echo base_url('webroot/');?>scripts/CustomFormTool.js"></script>
<script type="text/javascript">
	jQuery(function(){
	
	CustomFormTool.init();
	});//end dom
</script>		