<!-- BEGIN PAGE HEADER-->
<div class="row">
<div class="col-md-12">
	<ul class="page-breadcrumb breadcrumb">
		<li><i class="fa fa-home"></i><a href="<?php echo base_url('manage/Dashboard/'); ?>">Home</a><i class="fa fa-angle-right"></i></li>
		<li><a href="<?php echo base_url('manage/Slider/'); ?>">Image Slider</a><i class="fa fa-angle-right"></i></li>
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
  <div class="caption">Edit Slider</div>
  <div class="tools"> <a href="javascript:;" class="collapse"> </a></div>
</div><!--End portlet-title-->
<div class="portlet-body">
<!--------------------------------------------------------------------------->
<div class="row"><div class="col-lg-12">
<?php echo AlertMessage($this->session->flashdata('AppMessage'));?>
</div></div>
<!--End Validation message-->
<?php
$hidden = array('id' => html_escape(isset($DataList->id)? encrypt_decrypt('encrypt',$DataList->id):''),
				'cid' =>html_escape(isset($DataList->cat_id)? encrypt_decrypt('encrypt',$DataList->cat_id):''));
$atr2 =array('id'=>'frmSlider','name'=>'frmSlider','class'=>'form-horizontal','role'=>'form', 'autocomplete'=>'off');
echo form_open_multipart('manage/Slider/edit',$atr2,$hidden); 
?>
 <div class="form-body">
 
 		<div class="form-group">
		<label class="col-sm-3 control-label">Title (Hindi) <span class="red">*</span></label>
		<div class="col-sm-9">
		<?php $TITLE_HI = array( 
        'name'=>'title_hi','id'=>'title_hi','class'=> 'form-control','placeholder'=>'Enter Title in hindi',
        'value' => (isset($DataList->title_hi) && $DataList->title_hi !='' )?
         html_escape($DataList->title_hi):set_value('title_hi'));
		 echo form_input($TITLE_HI);
	    ?>
		</div>
	   </div><!--End form-group-->
	   
	   <div class="form-group">
		<label class="col-sm-3 control-label">Title (English) <span class="red">*</span></label>
		<div class="col-sm-9">
		<?php $TITLE_EN = array( 
        'name'=>'title_en','id'=>'title_en','class'=> 'form-control','placeholder'=>'Enter Title in hindi',
        'value' => (isset($DataList->title_en) && $DataList->title_en !='' )?
         html_escape($DataList->title_en):set_value('title_en'));
		echo form_input($TITLE_EN);
	    ?>
		</div>
	   </div><!--End form-group-->
	   
	   <div class="form-group" >
		<label class="col-sm-3 control-label">Url </label>
		<div class="col-sm-9">
		<?php $URL = array( 
        'name'=>'url','id'=>'url','class'=> 'form-control','placeholder'=>'Enter url',
        'value' => (isset($DataList->desc_url) && $DataList->desc_url !='' )?
         html_escape($DataList->desc_url):"");
		echo form_input($URL);
	    ?>
	    <p class="notecls">Example: http://www.xyz.com</p>
		</div>
	   </div><!--End form-group-->
	  
	  <div class="form-group">
	   <label class="col-sm-3 control-label"></label>
	   	<div class="col-sm-9"><div class="info">Attachment Size (width=788px, height=381px)</div></div>
	   </div>
	
	  <div class="form-group">
		<label class="col-sm-3 control-label">Attachment</label>
		<div class="col-sm-9">
		<?php echo form_upload(array('name'=>'attachment', 'id'=>'fileupload')); ?>
		</div>
	   </div><!--End form-group-->
	   
	   <div class="form-group">
		<label class="col-sm-4 col-md-3 control-label">View Image</label>
		<div class="col-sm-8 col-md-7">
		<div class="fileinput fileinput-new" data-provides="fileinput">
		<div class="ffileinput-new thumbnail" style="max-width: 200px; max-height: 150px;">
		 <?php
 		$image_properties = array(
        'src'   => (isset($DataList->attachment) && trim($DataList->attachment)!="")? 'uploads/slider/'.html_escape($DataList->attachment):'webroot/img/no-image.png',
        'alt'   => 'Gallery Image',
        'class' => 'post_images',
        'width' => '200',
        'height'=> '100',
        'title' => 'Gallery Image'
		);
 		 echo img($image_properties);
 		 ?>
 		 </div><!--End fileinput-new-->
 		 </div><!--End fileinput-->
		</div><!--End column-->	
	  </div><!--End form-group-->
	   
	   <div class="form-group">
		<label class="col-sm-3 control-label">Status <span class="red">*</span></label>
		<div class="col-sm-9 ">
		<?php $STATUS = array('1'=>'Publish','0'=>'Pending');
		echo form_dropdown('status', $STATUS, (isset($DataList->status) && $DataList->status !='' )?
         html_escape($DataList->status):set_value('status'),array('class'=> 'form-control input-medium'));
	    ?>
		</div>
	   </div><!--End form-group-->
	   
	   <div class="form-group">
		<label class="col-sm-3 control-label">Archive <span class="red">*</span></label>
		<div class="col-sm-9 ">
		<?php $ACHIVE = array('0'=>'No','1'=>'Yes');
		echo form_dropdown('is_archive', $ACHIVE, (isset($DataList->is_archive) && $DataList->is_archive !='' )?
         html_escape($DataList->is_archive):set_value('is_archive'),array('class'=> 'form-control input-medium'));
	    ?>
		</div>
	   </div><!--End form-group-->

 	 <div class="form-group">
		<label class="col-sm-3 control-label"></label>
		<div class="col-sm-9">
			<button type="submit" class="btn green">Update</button>
			<button type="reset" class="btn blue">Clear</button>
			<a class="btn purple" href="<?php echo base_url('manage/Slider/'); ?>">Back</a>
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
		
	jQuery.validator.addMethod("alphanumspace", function(value, element) {
		  return this.optional(element) || /^[a-zA-Z0-9\s]*$/.test(value);
	}, "Please enter character, number and space only.");
	
	$.validator.addMethod('filesize', function(value, element, param) {
		    return this.optional(element) || (element.files[0].size <= param) 
	}, $.validator.format("Uploaded file size should be less than or equal to 1 MB)."));

	jQuery( "#frmSlider" ).validate({
		  rules: { 
		  cat_id:{
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
			url:{
				required:false,
				url:true,
				maxlength:255
			},
		    status:{
				required: true,
		  		digits:true
			},
			attachment:{
				extension:'JPEG|jpeg|JPG|jpg|png',
				filesize:5002000
			}
		  },
		  messages:{
		  	attachment: {extension:"Please upload only JPEG,JPG Formet",filesize:"File size must be less than 500 KB"}
		  }
		});	
	});
</script>