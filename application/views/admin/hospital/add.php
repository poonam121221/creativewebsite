<!-- BEGIN PAGE HEADER-->
<div class="row">
<div class="col-md-12">
	<ul class="page-breadcrumb breadcrumb">
		<li><i class="fa fa-home"></i><a href="<?php echo base_url('manage/Dashboard/'); ?>">Home</a><i class="fa fa-angle-right"></i></li>
		<li><a href="<?php echo base_url('manage/Hospital/'); ?>">Hospital </a><i class="fa fa-angle-right"></i></li>
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
  <div class="caption">Add Hospital</div>
  <div class="tools"> <a href="javascript:;" class="collapse"> </a></div>
</div><!--End portlet-title-->
<div class="portlet-body">
<!--------------------------------------------------------------------------->
<div class="row"><div class="col-lg-12">
<?php echo AlertMessage($this->session->flashdata('AppMessage'));?>
</div></div>
<!--End Validation message-->
<?php
$atr2 =array('id'=>'frmHospital','name'=>'frmHospital','class'=>'form-horizontal','role'=>'form', 'autocomplete'=>'off');
echo form_open_multipart('manage/Hospital/add',$atr2); 
?>
 <div class="form-body">
 	
 	<div class="form-group">
		<label class="col-sm-3 col-md-2 control-label">Category <span class="red">*</span></label>
		<div class="col-sm-9 col-md-6">
		<?php 
			echo form_dropdown(array('name'=>'category','id'=>'category','class'=>'form-control select2me'),
		    isset($CategoryList)?$CategoryList:array(''=>'--SELECT CATEGORY--'),isset($DataList->cat_id) ? ($DataList->cat_id):set_value('category'));
		?>
		</div>	
	</div><!--End form-group-->
 
 	<div class="form-group">
		<label class="col-sm-3 col-md-2 control-label">Hospital Name (Hindi) <span class="red">*</span></label>
		<div class="col-sm-9 col-md-10">
		<?php $TITLE_HI = array( 
        'name'=>'title_hi','id'=>'title_hi','class'=> 'form-control','placeholder'=>'Enter hospital name in hindi','value'=>set_value('title_hi'));
		echo form_input($TITLE_HI);
	    ?>
		</div>
	</div><!--End form-group-->
	
	<div class="form-group">
		<label class="col-sm-3 col-md-2 control-label">Hospital Name (English) <span class="red">*</span></label>
		<div class="col-sm-9 col-md-10">
		<?php $TITLE_EN = array( 
        'name'=>'title_en','id'=>'title_en','class'=> 'form-control','placeholder'=>'Enter hospital name in english','value'=>set_value('title_en'));
		echo form_input($TITLE_EN);
	    ?>
		</div>
	</div><!--End form-group-->
	
	   <div class="form-group clearfix">
		<label class="col-sm-3 col-md-2 control-label">Address (Hindi) <span class="red">*</span></label>
		<div class="col-sm-9 col-md-10">
		<?php $ADDRESS_HI = array( 
        'name'=>'address_hi','id'=>'address_hi','class'=> 'form-control','rows'=>'4','placeholder'=>'Enter address in hindi',
        'value' => (isset($DataList->address_hi) && $DataList->address_hi !='' )?
         html_escape($DataList->address_hi):set_value('address_hi'));
		 echo form_textarea($ADDRESS_HI);
	    ?>
		</div>
	   </div><!--End form-group-->
	   
	   <div class="form-group clearfix">
		<label class="col-sm-3 col-md-2 control-label">Address (English) <span class="red">*</span></label>
		<div class="col-sm-9 col-md-10">
		<?php $ADDRESS_EN = array( 
        'name'=>'address_en','id'=>'address_en','class'=> 'form-control','rows'=>'4','placeholder'=>'Enter address in english',
        'value' => (isset($DataList->address_en) && $DataList->address_en !='' )?
         html_escape($DataList->address_en):set_value('address_en'));
		 echo form_textarea($ADDRESS_EN);
	    ?>
		</div>
	   </div><!--End form-group-->
	   
	   <div class="form-group clearfix">
		<label class="col-sm-3 col-md-2 control-label">Description (Hindi)</label>
		<div class="col-sm-9 col-md-10">
		<?php 		
		$PAGEDESC_HI = (isset($DataList->description_hi) && $DataList->description_hi !='' )?
        html_entity_decode(stripslashes2($DataList->description_hi)):"";
	    echo $this->ckeditor->editor('description_hi',@$PAGEDESC_HI);
	    ?>
		</div>
	   </div><!--End form-group-->
	   
	   <div class="form-group clearfix">
		<label class="col-sm-3 col-md-2 control-label">Description (English)</label>
		<div class="col-sm-9 col-md-10">
		<?php 		
		$PAGEDESC_EN = (isset($DataList->description_en) && $DataList->description_en !='' )?
        html_entity_decode(stripslashes2($DataList->description_en)):"";
	    echo $this->ckeditor->editor('description_en',@$PAGEDESC_EN);			 					
	  ?>
		</div>
	   </div><!--End form-group-->
	   
	   <div class="form-group clearfix">
		<label class="col-sm-3 col-md-2 control-label">Website URL </label>
		<div class="col-sm-6 col-md-10">
		<?php $WEB_URL = array( 
        'name'=>'web_url','id'=>'web_url','class'=> 'form-control','placeholder'=>'Enter website url',
        'value' => (isset($DataList->web_url) && $DataList->web_url !='' )?
         html_escape($DataList->web_url):set_value('web_url'));
		echo form_input($WEB_URL);
	    ?>
	    <p class="notecls">Example: http://www.domain.gov.in/</p>
		</div>
	   </div><!--End form-group-->
	
	<div class="form-group">
		<label class="col-sm-3 col-md-2 control-label">Attachment </label>
		<div class="col-sm-9 col-md-10">
		<?php echo form_upload(array('name'=>'attachment')); ?>
		</div>
	</div><!--End form-group-->
	
	<?php if($optstatus==1){ ?>
	<div class="form-group">
		<label class="col-sm-3 col-md-2 control-label">Status <span class="red">*</span></label>
		<div class="col-sm-9 col-md-10">
		<?php $STATUS = array(""=>"--Select Status--",'1'=>'Publish','0'=>'Pending');
		echo form_dropdown('status', $STATUS, (isset($DataList->status) && $DataList->status !='' )?
         html_escape($DataList->status):set_value('status'),array('class'=> 'form-control input-medium'));
	    ?>
		</div>
	</div><!--End form-group-->
	<?php }//end check optstatus ?>
	
	<div class="form-group">
		<label class="col-sm-3 col-md-2 control-label"></label>
		<div class="col-sm-9 col-md-10">
			<button type="submit" class="btn green">Submit</button>
			<button type="reset" id="reset" class="btn blue">Clear</button>
			<a class="btn purple" href="<?php echo base_url('manage/Hospital/'); ?>">Back</a>
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
		
	//IMPORTANT: update CKEDITOR textarea with actual content before submit
    $("#frmcreatepage").on('submit', function() {
       for(var instanceName in CKEDITOR.instances) {
               CKEDITOR.instances[instanceName].updateElement();
       }
     })
		
	$('#reset').on('click',function(){
		$('#category').val('').trigger("change");
	});
		
	jQuery.validator.addMethod("alphanumspace", function(value, element) {
		  return this.optional(element) || /^[a-zA-Z0-9\s]*$/.test(value);
	}, "Please enter character, number and space only.");
	
	$.validator.addMethod('filesize', function(value, element, param) {
		    return this.optional(element) || (element.files[0].size <= param) 
	}, $.validator.format("Uploaded file size should be less than or equal to 25 MB)."));
	
	$.validator.addMethod("checkdate", function(value, element) {
        return this.optional(element) || /^(0[1-9]|[1-2][0-9]|3[0-1])-(0[1-9]|1[0-2])-[0-9]{4}$/.test(value);
    }, "Please enter valid date format (DD-MM-YYYY).");

	jQuery( "#frmHospital" ).validate({
		  rules: { 
		  category:{
		  	    required: true,
		  		digits:true
		  },
		  title_hi: {
		        required: true,
		        minlength:2,
		        maxlength:255
		  },
		  title_en: {
		        required: true,
		        minlength:2,
		        maxlength:255
		  },
		  address_hi: {
		        required: true,
		        minlength:2,
		        maxlength:255
		  },
		  address_en: {
		        required: true,
		        minlength:2,
		        maxlength:255
		  },
		  description_hi: {
		        minlength:5
		  },
		  description_en: {
		        minlength:5
		  },
		  attachment:{
				extension:'JPEG|jpeg|JPG|jpg|png',
				filesize:26214400
		  },
		  web_url:{
				url:true,
				maxlength:255
		  },
		  status:{
				required: true,
		  		digits:true
		  }
		  },
		  messages:{
		  	attachment: {extension:"Please upload only JPEG,JPG,PDF Formet",filesize:"File size must be less than 25 MB"}
		  }
		});	
		
	});//end dom
</script>