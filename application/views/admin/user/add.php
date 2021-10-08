<!-- BEGIN PAGE HEADER-->
<div class="row">
<div class="col-md-12">
	<ul class="page-breadcrumb breadcrumb">
		<li><i class="fa fa-home"></i><a href="<?php echo base_url('manage/Dashboard/'); ?>">Home</a><i class="fa fa-angle-right"></i></li>
		<li><a href="<?php echo base_url('manage/User/'); ?>">User</a><i class="fa fa-angle-right"></i></li>
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
  <div class="caption">Add User</div>
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
echo form_open('manage/User/add',$atr2); 
?>
 <div class="form-body">
 
 			<div class="form-group">
				<label class="col-sm-4 col-md-3 control-label">Privilege Name <span class="red">*</span></label>
				<div class="col-sm-8 col-md-9">
				<?php 
				  echo form_dropdown(array('name'=>'pid','id'=>'pid','class'=>'form-control input-medium'),
				  isset($PrivilegeList)?$PrivilegeList:array(''=>'--SELECT PRIVILEGE--'),isset($DataList->upm_id) ? ($DataList->upm_id):set_value('pid'));
				?>
				</div>
			</div><!--End form-group-->
 		
 			<div class="form-group">
				<label class="col-sm-4 col-md-3 control-label">User Name <span class="red">*</span></label>
				<div class="col-sm-8 col-md-9">
				<?php $USER_NAME = array( 
		        'name'=>'uname','id'=>'uname','class'=> 'form-control input-medium','placeholder'=>'Enter User Name','value'=>set_value('uname'));
				echo form_input($USER_NAME);
			    ?>
				</div>
			</div><!--End form-group-->
 		
 			<div class="form-group">
				<label class="col-sm-4 col-md-3 control-label">Designation <span class="red">*</span></label>
				<div class="col-sm-8 col-md-9">
				<?php $DESGINATION = array( 
		        'name'=>'designation','id'=>'designation','class'=> 'form-control input-medium','placeholder'=>'Enter Designation','value'=>set_value('designation'));
				echo form_input($DESGINATION);
			    ?>
				</div>
			</div><!--End form-group-->
			
			<div class="form-group">
				<label class="col-sm-4 col-md-3 control-label">First Name <span class="red">*</span></label>
				<div class="col-sm-8 col-md-9">
				<?php $FIRST_NAME = array( 
		        'name'=>'fname','id'=>'fname','class'=> 'form-control input-medium','placeholder'=>'Enter User Name','value'=>set_value('fname'));
				echo form_input($FIRST_NAME);
			    ?>
				</div>
			</div><!--End form-group-->
			
			<div class="form-group">
				<label class="col-sm-4 col-md-3 control-label">Last Name <span class="red">*</span></label>
				<div class="col-sm-8 col-md-9">
				<?php $LAST_NAME = array( 
		        'name'=>'lname','id'=>'lname','class'=> 'form-control input-medium','placeholder'=>'Enter Last Name','value'=>set_value('lname'));
				echo form_input($LAST_NAME);
			    ?>
				</div>
			</div><!--End form-group-->
			
			<div class="form-group">
				<label class="col-sm-4 col-md-3 control-label">Email <span class="red">*</span></label>
				<div class="col-sm-8 col-md-9">
				<?php $EMAIL = array( 
		        'name'=>'email','id'=>'email','class'=> 'form-control input-medium','placeholder'=>'Enter Email','value'=>set_value('email'));
				echo form_input($EMAIL);
			    ?>
				</div>
			</div><!--End form-group-->
			
			<div class="form-group">
				<label class="col-sm-4 col-md-3 control-label">Mobile Number <span class="red">*</span></label>
				<div class="col-sm-8 col-md-9">
				<?php $MOBILE = array( 
		        'name'=>'mob','id'=>'mob','class'=> 'form-control input-medium','placeholder'=>'Enter Mobile Number','value'=>set_value('mob'));
				echo form_input($MOBILE);
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
				<label class="col-sm-2 col-md-3 control-label"></label>
				<div class="col-sm-10 col-md-9">
					<button type="submit" class="btn green">Submit</button>
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
<!-- END PAGE CONTENT-->
<script type="text/javascript" src="<?php echo base_url('webroot/');?>plugins/jquery.validate.min.js"></script>
<script type="text/javascript">
	jQuery(function(){
		
	jQuery.validator.addMethod("alphanumspace", function(value, element) {
		  return this.optional(element) || /^[a-zA-Z0-9\s]*$/.test(value);
	}, "Please enter character,number and space only.");
	
	jQuery.validator.addMethod("alphanumunderscore", function(value, element) {
		  return this.optional(element) || /^[a-zA-Z0-9_]*$/.test(value);
	}, "Please enter character and underscore only.");
	
	jQuery.validator.addMethod("email", function(value, element) {
      		    return this.optional(element) || /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(value);
    }, "Please enter Vaild Email.");
            

	jQuery( "#frmUser" ).validate({
		  rules: {
		  pid:{
		  		required: true,
		  		digits:true
		  },
		  uname: {
		        required: true,
		        alphanumunderscore:true,
		        minlength:6,
		        maxlength:20
		  },
		  upass: {
		        required: true,
		        maxlength:120
		   },
		   con_pass:{
		   		required: true,
		   		equalTo: "#upass"
		   },
		   fname:{
		   		required: true,
		   		maxlength:60
		   },
		   lname:{
		   		required: true,
		   		maxlength:60
		   },
		   designation:{
		   		required: true,
		   		alphanumspace:true,
		   		maxlength:100
		   },
		   email:{
		   		required: true,
		        maxlength:60,
		        email:true
		   },
		   mob:{
		   		required: true,
		   		digits:true,
		        minlength:10,
		        maxlength:10
		   },
		   captcha:{
		   		required: true
		   }
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