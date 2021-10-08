<!-- BEGIN PAGE HEADER-->
<div class="row">
<div class="col-md-12">
	<ul class="page-breadcrumb breadcrumb">
		<li><i class="fa fa-home"></i><a href="<?php echo base_url('manage/Dashboard/'); ?>">Home</a><i class="fa fa-angle-right"></i></li>
		<li><a href="<?php echo base_url('manage/Menumodule/'); ?>">Menu Module</a><i class="fa fa-angle-right"></i></li>
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
  <div class="caption">Edit Menu Module</div>
  <div class="tools"> <a href="javascript:;" class="collapse"> </a></div>
</div><!--End portlet-title-->
<div class="portlet-body">
<!--------------------------------------------------------------------------->
<div class="row"><div class="col-lg-12">
<?php echo AlertMessage($this->session->flashdata('AppMessage'));?>
</div></div>
<!--End Validation message-->
<?php
$hidden = array('id' => html_escape(isset($DataList->module_id)? encrypt_decrypt('encrypt',$DataList->module_id):''));
$atr2 =array('id'=>'frmMenumodule','name'=>'frmMenumodule','class'=>'form-horizontal','role'=>'form', 'autocomplete'=>'off');
echo form_open('manage/Menumodule/edit',$atr2,$hidden); 
?>
 <div class="form-body">
 
 		<div class="form-group">
		<label class="col-sm-3 control-label">Module Name <span class="red">*</span></label>
		<div class="col-sm-9">
		<?php $MODULE_NAME = array( 
        'name'=>'module_name','id'=>'module_name','class'=> 'form-control','placeholder'=>'Enter module name',
        'value' => (isset($DataList->module_name) && $DataList->module_name !='' )?
         stripslashes2($DataList->module_name):"");
		 echo form_input($MODULE_NAME);
	    ?>
		</div>
	   </div><!--End form-group-->
	   
	   <div class="form-group">
		<label class="col-sm-3 control-label">URL <span class="red">*</span></label>
		<div class="col-sm-9 ">
		<?php $MODUE_URL = array( 
        'name'=>'module_url','id'=>'module_url','class'=> 'form-control','placeholder'=>'Enter module_url',
        'value' => (isset($DataList->module_url) && $DataList->module_url !='' )?
         html_escape($DataList->module_url):"");
		echo form_input($MODUE_URL);
	    ?>
		</div>
	   </div><!--End form-group-->

 	 <div class="form-group">
		<label class="col-sm-3 control-label"></label>
		<div class="col-sm-9">
			<button type="submit" class="btn green">Update</button>
			<button type="reset" class="btn blue">Clear</button>
			<a class="btn purple" href="<?php echo base_url('manage/Menumodule/'); ?>">Back</a>
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
<script type="text/javascript">
	jQuery(function(){
		
	jQuery.validator.addMethod("alphanumspace", function(value, element) {
		  return this.optional(element) || /^[a-zA-Z0-9\s]*$/.test(value);
	}, "Please enter character, number and space only.");
	
	jQuery( "#frmMenumodule" ).validate({
		  rules: {
		  module_name: {
		        required: true,
		        minlength:2,
		        maxlength:100
		    },
			module_url:{
				required: true,
				maxlength:100
			}
		  }
		});	
	});
</script>