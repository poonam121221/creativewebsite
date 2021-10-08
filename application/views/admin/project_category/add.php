<!-- BEGIN PAGE HEADER-->
<div class="row">
<div class="col-md-12">
	<ul class="page-breadcrumb breadcrumb">
		<li><i class="fa fa-home"></i><a href="<?php echo base_url('manage/Dashboard/');?>">Home</a><i class="fa fa-angle-right"></i></li>
		<li><a href="<?php echo base_url('manage/Projectcategorymaster/'); ?>">Project Category</a><i class="fa fa-angle-right"></i></li>
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
  <div class="caption">Add Project Category</div>
  <div class="tools"> <a href="javascript:;" class="collapse"> </a></div>
</div><!--End portlet-title-->
<div class="portlet-body">
<!--------------------------------------------------------------------------->
<div class="row"><div class="col-lg-12">
<?php echo AlertMessage($this->session->flashdata('AppMessage'));?>
</div></div>
<!--End Validation message-->
<?php
$atr2 =array('id'=>'frmProjectCategory','name'=>'frmProjectCategory','class'=>'form-horizontal','role'=>'form', 'autocomplete'=>'off');
echo form_open_multipart('manage/Projectcategorymaster/add',$atr2); 
?>
 <div class="form-body">
 	<div class="form-group">
		<label class="col-sm-3 control-label">Category Name (Hindi) <span class="red">*</span></label>
		<div class="col-sm-9">
		<?php $CATEGORY_NAME_HI = array( 
        'name'=>'cat_title_hi','id'=>'cat_title_hi','class'=> 'form-control','placeholder'=>'Enter Project Category in hindi');
		echo form_input($CATEGORY_NAME_HI);
	 ?>
		</div>
	</div><!--End form-group-->
	
	<div class="form-group">
		<label class="col-sm-3 control-label">Category Name (English) <span class="red">*</span></label>
		<div class="col-sm-9">
		<?php $CATEGORY_NAME_EN = array( 
        'name'=>'cat_title_en','id'=>'cat_title_en','class'=> 'form-control','placeholder'=>'Enter Project Category in english');
		echo form_input($CATEGORY_NAME_EN);
	 ?>
		</div>
	</div><!--End form-group-->
	<div class="form-group clearfix">
		<label class="col-sm-3 control-label">Attachment</label>
		<div class="col-sm-9">
		<input type="file" name="attachment" id="fileupload"/>
		</div>
	</div><!--End form-group-->
	
	<div class="form-group clearfix">
		<label class="col-sm-3 control-label">View Attachment</label>
		<div class="col-sm-9">
		<?php
 		$image_properties = array(
        'src'   => (isset($DataList->attachment) && trim($DataList->attachment)!="")? 'uploads/events/'.html_escape($DataList->attachment):'webroot/img/no_image.png',
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
		<?php $OPTIONS = array(""=>"--Select Stauts--",'1'=>'Publish','0'=>'Pending');
		echo form_dropdown('status', $OPTIONS, (isset($DataList->cat_status) && $DataList->cat_status !='' )?
         html_escape($DataList->cat_status):set_value('cat_status'),array('class'=> 'form-control input-medium'));
	    ?>
		</div>
	</div><!--End form-group-->
	<?php }//end check optstatus ?>
	
	<div class="form-group">
		<label class="col-sm-3 control-label"></label>
		<div class="col-sm-9">
			<button type="submit" class="btn green">Submit</button>
			<button type="reset" class="btn blue">Clear</button>
			<a class="btn purple" href="<?php echo base_url('manage/Projectcategorymaster/'); ?>">Back</a>
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
		
		$('#reset').on('click',function(){
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
		
	jQuery.validator.addMethod("alphanumspace", function(value, element) {
		  return this.optional(element) || /^[a-zA-Z0-9\s]*$/.test(value);
	}, "Please enter character, number and space only.");

	jQuery( "#frmProjectCategory" ).validate({
		  rules: { 
		  cat_title_hi: {
		        required: true,
		        minlength:2,
		        maxlength:100
		    },
		   cat_title_en: {
		        required: true,
		        minlength:2,
		        maxlength:100
		    },
			  attachment:{
			        filesize:2097152,
			        maxlength:200,
			        extension:"jpg|jpeg|JPG|JPEG|png|PNG"
			     },
		    status:{
				required: true,
				digits: true
			}
		  }
		});	
		
	});//end dom
</script>