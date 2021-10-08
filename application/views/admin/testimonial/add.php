<!-- BEGIN PAGE HEADER-->
<div class="row">
<div class="col-md-12">
	<ul class="page-breadcrumb breadcrumb">
		<li><i class="fa fa-home"></i><a href="<?php echo base_url('manage/Dashboard/');?>">Home</a><i class="fa fa-angle-right"></i></li>
		<li><a href="<?php echo base_url('manage/Testimonial/'); ?>">Photo Testimonial</a><i class="fa fa-angle-right"></i></li>
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
  <div class="caption">Add Testimonial</div>
  <div class="tools"> <a href="javascript:;" class="collapse"> </a></div>
</div><!--End portlet-title-->
<div class="portlet-body">
<!--------------------------------------------------------------------------->
<div class="row"><div class="col-lg-12">
<?php echo AlertMessage($this->session->flashdata('AppMessage'));?>
</div></div>
<!--End Validation message-->
<?php
$atr2 =array('id'=>'frmTestimonial','name'=>'frmTestimonial','class'=>'form-horizontal','role'=>'form', 'autocomplete'=>'off');
echo form_open_multipart('manage/Testimonial/add',$atr2); 
?>
 <div class="form-body">
 	
 	<div class="form-group">
		<label class="col-sm-4 col-md-3 control-label">Name (Hindi) <span class="red">*</span></label>
		<div class="col-sm-8 col-md-9">
		<?php $TITLE_HI = array( 
        'name'=>'title_hi','class'=> 'form-control','placeholder'=>'Enter name hindi',
        'value' => (isset($DataList->title_hi) && $DataList->title_hi!='' )?
         html_escape($DataList->title_hi):'');
		 echo form_input($TITLE_HI);
	 ?>
		</div>	
	</div><!--End form-group-->
 	
 	<div class="form-group">
		<label class="col-sm-4 col-md-3 control-label">Message (Hindi) <span class="red">*</span></label>
		<div class="col-sm-8 col-md-9">
		<?php $MESSAGE_HI = array( 
        'name'=>'description_hi','class'=> 'form-control','placeholder'=>'Enter message hindi',
        'value' => (isset($DataList->description_hi) && $DataList->description_hi!='' )?
         html_escape($DataList->description_hi):'');
		 echo form_textarea($MESSAGE_HI);
	 ?>
		</div>	
	</div><!--End form-group-->
	
	<div class="form-group">
		<label class="col-sm-4 col-md-3 control-label">Name (English) <span class="red">*</span></label>
		<div class="col-sm-8 col-md-9">
		<?php $TITLE_EN = array( 
        'name'=>'title_en','class'=> 'form-control','placeholder'=>'Enter name english',
        'value' => (isset($DataList->title_en) && $DataList->title_en!='' )?
         html_escape($DataList->title_en):'');
		echo form_input($TITLE_EN);
	 ?>
		</div>	
	</div><!--End form-group-->
	
	<div class="form-group">
		<label class="col-sm-4 col-md-3 control-label">Message (English) <span class="red">*</span></label>
		<div class="col-sm-8 col-md-9">
		<?php $MESSAGE_EN = array( 
        'name'=>'description_en','class'=> 'form-control','placeholder'=>'Enter name english',
        'value' => (isset($DataList->description_en) && $DataList->description_en!='' )?
         html_escape($DataList->description_en):'');
		echo form_textarea($MESSAGE_EN);
	 ?>
		</div>	
	</div><!--End form-group-->
	
	<div class="form-group">
		<label class="col-sm-4 col-md-3 control-label">Image <span class="red">*</span></label>
		<div class="col-sm-8 col-md-9">
		<input type="file" name="attachment" id="fileupload"/>	
		</div>	
	</div><!--End form-group-->
	
	<div class="form-group">
		<label class="col-sm-4 col-md-3 control-label">View Image</label>
		<div class="col-sm-8 col-md-9">
		 <?php
 		$image_properties = array(
        'src'   => (isset($DataList->attachment) && trim($DataList->attachment)!="")? 'uploads/testimonial/'.html_escape($DataList->attachment):'webroot/img/no_image.png',
        'alt'   => 'Testimonial Image',
        'class' => 'post_images',
        'width' => '100',
        'height'=> '100',
        'title' => 'Testimonial Image'
		);
 		 echo img($image_properties);
 		 ?>
		</div>	
	</div><!--End form-group-->
	
	<?php if($optstatus==1){ ?>
	<div class="form-group">
		<label class="col-sm-3 control-label">Status <span class="red">*</span></label>
		<div class="col-sm-9 ">
		<?php $STATUS = array(""=>"--Select Stauts--",'1'=>'Publish','0'=>'Pending');
		echo form_dropdown('status', $STATUS, (isset($DataList->status) && $DataList->status !='' )?
         html_escape($DataList->status):set_value('status'),array('class'=> 'form-control input-medium'));
	    ?>
		</div>
	</div><!--End form-group-->
	<?php }//end check optstatus ?>

	<div class="form-group">
		<label class="col-sm-4 col-md-3 control-label"></label>
		<div class="col-sm-8 col-md-9">
			<button type="submit" class="btn green">Submit</button>
			<button type="reset" id="reset" class="btn blue">Clear</button>
			<a class="btn purple" href="<?php echo base_url('manage/Testimonial/'); ?>">Back</a>
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
		
		$("#reset").click(function(){
			$('.post_images').attr('src',"<?php echo base_url('webroot/img/no_image.png');?>");
		});
		
		$("#fileupload").change(function(){
		    readURL_photo(this);
		});
		
		function readURL_photo(input) {
		    if (input.files && input.files[0]) {
		        var reader = new FileReader();

		        reader.onload = function (e) {
		            $('.post_images').attr('src', e.target.result);
		        };

		        reader.readAsDataURL(input.files[0]);
		    }
		}//end readURL_photo function

		    $.validator.addMethod('filesize', function(value, element, param) {
		     return this.optional(element) || (element.files[0].size <= param) 
			}, $.validator.format("Uploaded file size should be less than or equal to 2 mb)."));
				
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
   
	jQuery("#frmTestimonial").validate({
		 rules: { 
			 title_en:{
			        required: true,
			        maxlength:255,
			        minlength:2
			 },
			 description_en:{
			        required: true,
			        maxlength:10000,
			        minlength:2
			 },
			 title_hi:{
			        required: true,
			        maxlength:255,
			        minlength:2
			 },
			 description_hi:{
			        required: true,
			        maxlength:10000,
			        minlength:2
			 },
			 attachment:{
			        required: true,
			        filesize:2097152,
			        maxlength:300,
			        extension:"jpg|jpeg|JPG|JPEG"
			 },
		    status:{
				required: true,
		  		digits:true
			}
		  },
		  message:{
		  	attachment:{
		  			extension:"Please upload image with jpg or jpeg extension only."
		  	}
		  }
		});	//end validation

		});// end dom
</script>
