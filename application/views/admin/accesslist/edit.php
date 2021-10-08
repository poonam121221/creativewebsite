<!-- BEGIN PAGE HEADER-->
<div class="row">
<div class="col-md-12">
	<ul class="page-breadcrumb breadcrumb">
		<li><i class="fa fa-home"></i><a href="<?php echo base_url('manage/Dashboard/'); ?>">Home</a><i class="fa fa-angle-right"></i></li>
		<li><a href="<?php echo base_url('manage/Accesslist/'); ?>">Accesslist</a><i class="fa fa-angle-right"></i></li>
		<li><a href="javascript:void(0);">Edit</a></li>
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
  <div class="caption">Edit Accesslist</div>
  <div class="tools"> <a href="javascript:;" class="collapse"> </a></div>
</div><!--End portlet-title-->
<div class="portlet-body">
<!--------------------------------------------------------------------------->
<div class="row"><div class="col-lg-12">
<?php echo AlertMessage($this->session->flashdata('AppMessage'));?>
</div></div>
<!--End Validation message-->
<?php
$hidden = array('id' => html_escape(isset($DataList->id)? encrypt_decrypt('encrypt',$DataList->id):''));
$atr2 =array('id'=>'frmAccesslist','name'=>'frmAccesslist','class'=>'form-horizontal','role'=>'form', 'autocomplete'=>'off');
echo form_open_multipart('manage/Accesslist/edit',$atr2,$hidden); 
?>
 <div class="form-body">
 
 	  <div class="form-group">
	  <label class="col-sm-12 ">Title <span class="red">*</span></label>
	  <div class="col-sm-12">
	  <?php $TITLE = array( 
      'name'=>'controller_title','id'=>'controller_title','class'=> 'form-control','placeholder'=>'Enter Title in hindi',
      'value' => (isset($DataList->controller_title) && $DataList->controller_title !='' )?
      html_escape($DataList->controller_title):set_value('controller_title'));
	  echo form_input($TITLE);
	  ?>
	  </div>
	  </div><!--End form-group-->
 
 	  <div class="form-group">
	  <label class="col-sm-12 ">Controller <span class="red">*</span></label>
		<div class="col-sm-12">
		<?php 
			echo form_dropdown(array('name'=>'menu_id','id'=>'menu_id','class'=>'form-control'),
			isset($ControllerList)?$ControllerList:array(''=>'--SELECT CONTROLLER--'),isset($DataList->menu_id) ? ($DataList->menu_id):'');
		?>
	  </div>
	  </div><!--End form-group-->

 		<div class="form-group">
		<label class="col-sm-12 ">Function Name (comma separated values) <span class="red">*</span></label>
		<div class="col-sm-12">
		<?php $FUNCTION_NAME = array( 
        'name'=>'function_name','id'=>'function_name','class'=> 'form-control','placeholder'=>'Enter Title in hindi',
        'value' => (isset($DataList->auth_function_name) && $DataList->auth_function_name !='' )?
         html_escape($DataList->auth_function_name):set_value('function_name'));
		 echo form_input($FUNCTION_NAME);
	    ?>
		</div>
	   </div><!--End form-group-->
	   
	   <div class="form-group">
		<label class="col-sm-12 ">Status <span class="red">*</span></label>
		<div class="col-sm-12">
		<?php $STATUS = array('1'=>'Publish','0'=>'Pending');
		echo form_dropdown('status', $STATUS, (isset($DataList->status) && $DataList->status !='' )?
         html_escape($DataList->status):set_value('status'),array('class'=> 'form-control input-medium'));
	    ?>
		</div>
	   </div><!--End form-group-->

 	 <div class="form-group">
		<label class="col-sm-12 "></label>
		<div class="col-sm-12">
			<button type="submit" class="btn green">Update</button>
			<button type="reset" class="btn blue">Clear</button>
			<a class="btn purple" href="<?php echo base_url('manage/Accesslist/'); ?>">Back</a>
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
<script type="text/javascript" src="<?php echo base_url('webroot/');?>validation/dist/jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo base_url('webroot/');?>validation/dist/additional-methods.js"></script>
<script type="text/javascript">
	jQuery(function(){
		
	jQuery.validator.addMethod("alphanumspace", function(value, element) {
		  return this.optional(element) || /^[a-zA-Z0-9\s]*$/.test(value);
	}, "Please enter character, number and space only.");
	
	jQuery.validator.addMethod("alphaCommadashhyphen", function(value, element) {
		  return this.optional(element) || /^[a-zA-Z,_\-]+$/.test(value);
	}, "Please enter character, comma, dash and hyphen only.");

	jQuery( "#frmAccesslist" ).validate({
		  rules: { 
		  controller_title:{
		  		required: true,
		  		alphanumspace:true
		  },
		  menu_id:{
		  		required: true,
		  		digits:true
		  },
		  function_name: {
		        required: true,
		        minlength:2,
		        maxlength:255,
		        alphaCommadashhyphen:true
		    },
		    status:{
				required: true,
		  		digits:true
			}
		  }
		});	
	});
</script>