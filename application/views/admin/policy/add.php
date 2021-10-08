<!-- BEGIN PAGE HEADER-->
<div class="row">
<div class="col-md-12">
	<ul class="page-breadcrumb breadcrumb">
		<li><i class="fa fa-home"></i><a href="<?php echo base_url('manage/Dashboard/='); ?>">Home</a><i class="fa fa-angle-right"></i></li>
		<li><a href="<?php echo base_url('manage/Policy/='); ?>">Policy</a><i class="fa fa-angle-right"></i></li>
		<li><a href="javascript:void(0);">Add</a></li>
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
  <div class="caption">Add Policy</div>
  <div class="tools"> <a href="javascript:;" class="collapse"> </a></div>
</div><!--End portlet-title-->
<div class="portlet-body">
<!--------------------------------------------------------------------------->
<div class="row"><div class="col-lg-12">
<?php echo AlertMessage($this->session->flashdata('AppMessage'));?>
</div></div>
<!--End Validation message-->
<?php
$atr2 =array('id'=>'frmPolicy','name'=>'frmPolicy','class'=>'form-horizontal','role'=>'form', 'autocomplete'=>'off');
echo form_open_multipart('manage/Policy/add',$atr2); 
?>
 <div class="form-body">
 
 	<div class="form-group">
		<label class="col-sm-4 col-md-3 control-label">Category </label>
		<div class="col-sm-8 col-md-7">
		<?php 
			echo form_dropdown(array('name'=>'category','id'=>'category','class'=>'form-control select2me'),
		    isset($CategoryList)?$CategoryList:array(''=>'--SELECT CATEGORY--'),isset($DataList->cat_id) ? ($DataList->cat_id):'');
		?>
		</div>	
	</div><!--End form-group-->
 
 	<div class="form-group">
		<label class="col-sm-4 col-md-3 control-label">Title (Hindi) <span class="red">*</span></label>
		<div class="col-sm-8 col-md-7">
		<?php $TITLE_HI = array( 
        'name'=>'title_hi','class'=> 'form-control','placeholder'=>'Enter title hindi',
        'value' => (isset($DataList->title_hi) && $DataList->title_hi!='' )?
         html_escape($DataList->title_hi):'');
		 echo form_input($TITLE_HI);
	 ?>
		</div>	
	</div><!--End form-group-->
	
	<div class="form-group">
		<label class="col-sm-4 col-md-3 control-label">Title (English) <span class="red">*</span></label>
		<div class="col-sm-8 col-md-7">
		<?php $TITLE_EN = array( 
        'name'=>'title_en','class'=> 'form-control','placeholder'=>'Enter title english',
        'value' => (isset($DataList->title_en) && $DataList->title_en!='' )?
         html_escape($DataList->title_en):'');
		echo form_input($TITLE_EN);
	 ?>
		</div>	
	</div><!--End form-group-->
	
	<div class="form-group">
		<label class="col-sm-4 col-md-3 control-label">Attachment <span class="red">*</span></label>
		<div class="col-sm-8 col-md-7">
		<input type="file" name="attachment" id="fileupload"/>	
		</div>	
	</div><!--End form-group-->
	
	<div class="form-group clearfix">
		<label class="col-sm-4 col-md-3 control-label control-label">Archive Date <span class="red">*</span></label>
		<div class="col-sm-8 col-md-7">
		<?php $ARCHIVE_DATE = array('name'=>'archive_date','id'=>'archive_date','class'=>'form-control');
		echo form_input($ARCHIVE_DATE);
	    ?>
		</div>
	</div><!--End form-group-->
	
	<?php if($optstatus==1){ ?>
	<div class="form-group">
		<label class="col-sm-4 col-md-3 control-label">Status <span class="red">*</span></label>
		<div class="col-sm-8 col-md-9">
		<?php $OPTIONS = array(""=>"--Select Status--",'1'=>'Publish','0'=>'Pending');
		echo form_dropdown('status', $OPTIONS, (isset($DataList->status) && $DataList->status !='' )?
         html_escape($DataList->status):set_value('status'),array('class'=> 'form-control input-medium'));
	    ?>
		</div>
	</div><!--End form-group-->
	<?php }//end check optstatus ?> 

	<div class="form-group">
		<label class="col-sm-4 col-md-3 control-label"></label>
		<div class="col-sm-8 col-md-7">
			<button type="submit" class="btn green">Submit</button>
			<button type="reset" class="btn blue">Clear</button>
			<a class="btn purple" href="<?php echo base_url('manage/Policy/'); ?>">Back</a>
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
<script type="text/javascript" src="<?php echo base_url('webroot/');?>validation/dist/additional-methods.js"></script>

<script type="text/javascript">
	jQuery(function(){
		
			$('#archive_date').datepicker({'format':'dd-mm-yyyy',autoclose: true,startDate:'0d'})
			.on('changeDate', function(ev) {
			    if($('#archive_date').valid()){ $('#archive_date').removeClass('error'); }
			});
		
		  	jQuery.validator.addMethod("extension", function(value, element, param) {
            	param = typeof param === "string" ? param.replace(/,/g, "|") : "png|jpe?g|pdf|PDF";
            	return this.optional(element) || value.match(new RegExp(".(" + param + ")$", "i"));
            }, jQuery.validator.format("Please enter a value with a valid extension."));

		    jQuery.validator.addMethod('filesize', function(value, element, param) {
		     return this.optional(element) || (element.files[0].size <= param) 
			}, jQuery.validator.format("Uploaded file size should be less than or equal to 15 mb)."));
				
			jQuery.validator.addMethod("alphaspace", function(value, element) {
				  return this.optional(element) || /^[a-zA-Z\s]*$/.test(value);
			}, "Please enter character and space only.");
	
			jQuery.validator.addMethod("Alphaspacedot", function(value, element) {
      		    return this.optional(element) || /^[a-zA-Z.\s]*$/.test(value);
      		}, "Please enter Letters, dot(.) and space only.");      		
      	
            jQuery.validator.addMethod("Alphaspacecomma", function(value, element) {
        		return this.optional(element) || /^[a-zA-Z0-1,\/\s]*$/.test(value);
        	}, "Please enter Letters,comma,backword salsh and space only.");
            
            jQuery.validator.addMethod("Alphanumspace", function(value, element) {
        		return this.optional(element) || /^[a-zA-Z0-1\s]*$/.test(value);
        	}, "Please enter Letters, numbers and space only.");
        	
        	jQuery.validator.addMethod("checkdate", function(value, element) {
        		return this.optional(element) || /^(0[1-9]|[1-2][0-9]|3[0-1])-(0[1-9]|1[0-2])-[0-9]{4}$/.test(value);
            }, "Please enter valid date format (DD-MM-YYYY).");
   
	jQuery("#frmPolicy").validate({
		 rules: {
			 category:{
			 		digits:true
			 }, 
			 title_en:{
			        required: true,
			        maxlength:255,
			        minlength:2
			    },
			 title_hi:{
			        required: true,
			        maxlength:255,
			        minlength:2
			 },
			 attachment:{
			        required: true,
			        filesize:15728640,
			        maxlength:300,
			        extension:true
			  },
             archive_date: {
					required: true,
					checkdate:true
			 },
		     status:{
				required: true,
		  		digits:true
			 }
		  }
		});	//end validation
		
		$("#category").on("change", function (e) {  
          if($(this).val()!=""){
		  	jQuery('#category').siblings('label.error').remove();
		  } 
        });

		});// end dom
</script>
