<!-- BEGIN PAGE HEADER-->
<div class="row">
<div class="col-md-12">
	<ul class="page-breadcrumb breadcrumb">
		<li><i class="fa fa-home"></i><a href="<?php echo base_url('manage/Dashboard/'); ?>">Home</a><i class="fa fa-angle-right"></i></li>
		<li><a href="<?php echo base_url('manage/Contactdesignation/'); ?>">Contact Designation</a><i class="fa fa-angle-right"></i></li>
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
  <div class="caption">Edit Contact Designation</div>
  <div class="tools"> <a href="javascript:;" class="collapse"> </a></div>
</div><!--End portlet-title-->
<div class="portlet-body">
<!--------------------------------------------------------------------------->
<div class="row"><div class="col-lg-12">
<?php echo AlertMessage($this->session->flashdata('AppMessage'));?>
</div></div>
<!--End Validation message-->
<?php
$hidden = array('id' => html_escape(isset($DataList->d_id)? encrypt_decrypt('encrypt',$DataList->d_id):''));
$atr2 =array('id'=>'frmContactDesignation','name'=>'frmContactDesignation','class'=>'form-horizontal','role'=>'form', 'autocomplete'=>'off');
echo form_open('manage/Contactdesignation/edit',$atr2,$hidden); 
?>
 <div class="form-body">
 
 		<div class="form-group">
		<label class="col-sm-4 col-md-3 control-label">Category<span class="red">*</span></label>
		<div class="col-sm-8 col-md-7">
		<?php 
			echo form_dropdown(array('name'=>'category','class'=>'form-control input-medium'),
		    isset($CategoryList)?$CategoryList:array(''=>'--SELECT CATEGORY--'),isset($DataList->cat_id) ? ($DataList->cat_id):'');
		?>
		</div>	
	    </div><!--End form-group-->

 		<div class="form-group">
		<label class="col-sm-3 control-label">Category Name (Hindi) <span class="red">*</span></label>
		<div class="col-sm-9">
		<?php $CATEGORY_NAME_HI = array( 
        'name'=>'designation_hi','id'=>'designation_hi','class'=> 'form-control','placeholder'=>'Enter Category Name in hindi',
        'value' => (isset($DataList->designation_hi) && $DataList->designation_hi !='' )?
         html_escape($DataList->designation_hi):set_value('designation_hi'));
		echo form_input($CATEGORY_NAME_HI);
	    ?>
		</div>
	   </div><!--End form-group-->
	   
	   <div class="form-group">
		<label class="col-sm-3 control-label">Category Name (English) <span class="red">*</span></label>
		<div class="col-sm-9">
		<?php $CATEGORY_NAME_EN = array( 
        'name'=>'designation_en','id'=>'designation_en','class'=> 'form-control','placeholder'=>'Enter Category Name in english',
        'value' => (isset($DataList->designation_en) && $DataList->designation_en !='' )?
         html_escape($DataList->designation_en):set_value('designation_en'));
		echo form_input($CATEGORY_NAME_EN);
	    ?>
		</div>
	   </div><!--End form-group-->
		
		<?php if($optstatus==1){ ?>
 		<div class="form-group">
		<label class="col-sm-3 control-label">Status <span class="red">*</span></label>
		<div class="col-sm-9 ">
		<?php $OPTIONS = array('1'=>'Active','0'=>'Inactive');
		echo form_dropdown('status', $OPTIONS, (isset($DataList->status) && $DataList->status !='' )?
         html_escape($DataList->status):'',array('class'=> 'form-control input-medium'));
	    ?>
		</div>
	    </div><!--End form-group-->
	    <?php }//end check optstatus ?>

 	 <div class="form-group">
		<label class="col-sm-3 control-label"></label>
		<div class="col-sm-9">
			<button type="submit" class="btn green">Update</button>
			<button type="reset" class="btn blue">Clear</button>
			<a class="btn purple" href="<?php echo base_url('manage/Contactdesignation/'); ?>">Back</a>
		</div>
	</div><!--End form-group-->
	
 </div><!--End form-body-->
 <?php form_close(); ?>
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
		
	jQuery.validator.addMethod("alphaspace", function(value, element) {
		  return this.optional(element) || /^[a-zA-Z\s]*$/.test(value);
	}, "Please enter character and space only.");

	jQuery.validator.addMethod("alphanumspace", function(value, element) {
		  return this.optional(element) || /^[a-zA-Z0-9\s]*$/.test(value);
	}, "Please enter character, number and space only.");

	jQuery( "#frmContactDesignation" ).validate({
		  rules: { 
		   category:{
			 required:true,
			 digits:true
		  },
		  designation_hi: {
		      required: true,
		      minlength:2,
		      maxlength:100
		  },
		  designation_en: {
		      required: true,
		      minlength:2,
		      maxlength:100
		  },
		  status:{
			  required: true,
			  digits: true
		  }
		 }
		});
		
	});//end dom
</script>