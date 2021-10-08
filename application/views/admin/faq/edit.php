<!-- BEGIN PAGE HEADER-->
<div class="row">
<div class="col-md-12">
	<ul class="page-breadcrumb breadcrumb">
		<li><i class="fa fa-home"></i><a href="<?php echo base_url('manage/Dashboard/');?>">Home</a><i class="fa fa-angle-right"></i></li>
		<li><a href="<?php echo base_url('manage/Faq/'); ?>">FAQ</a><i class="fa fa-angle-right"></i></li>
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
  <div class="caption">Update FAQ</div>
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
$atr2 =array('id'=>'frmFaq','name'=>'frmFaq','class'=>'form-horizontal','role'=>'form', 'autocomplete'=>'off');
echo form_open_multipart('manage/Faq/edit',$atr2,$hidden); 
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
		<label class="col-sm-4 col-md-3 control-label">Question (Hindi)<span class="red">*</span></label>
		<div class="col-sm-8 col-md-7">
		<?php $TITLE_HI = array( 
        'name'=>'title_hi','class'=> 'form-control','placeholder'=>'Enter question hindi',
        'value' => (isset($DataList->title_hi) && $DataList->title_hi!='' )?
         html_escape($DataList->title_hi):set_value('title_hi'));
		 echo form_textarea($TITLE_HI);
	 ?>
		</div>	
	</div><!--End form-group-->
        
        <div class="form-group">
		<label class="col-sm-4 col-md-3 control-label">Answer (Hindi) <span class="red">*</span></label>
		<div class="col-sm-8 col-md-9">
		<?php $answer_hi = array( 
        'name'=>'answer_hi','class'=> 'form-control','placeholder'=>'Enter answer hindi',
        'value' => (isset($DataList->answer_hi) && $DataList->answer_hi!='' )?
         html_escape($DataList->answer_hi):'');
		 echo form_textarea($answer_hi);
	 ?>
		</div>	
	</div><!--End form-group-->
	
	<div class="form-group">
		<label class="col-sm-4 col-md-3 control-label">Question (English)<span class="red">*</span></label>
		<div class="col-sm-8 col-md-7">
		<?php $TITLE_EN = array( 
        'name'=>'title_en','class'=> 'form-control','placeholder'=>'Enter question english',
        'value' => (isset($DataList->title_en) && $DataList->title_en!='' )?
         html_escape($DataList->title_en):set_value('title_en'));
		echo form_textarea($TITLE_EN);
	 ?>
		</div>	
	</div><!--End form-group-->
        <div class="form-group">
		<label class="col-sm-4 col-md-3 control-label">Answer (English) <span class="red">*</span></label>
		<div class="col-sm-8 col-md-9">
		<?php $answer_en = array( 
        'name'=>'answer_en','class'=> 'form-control','placeholder'=>'Enter answer english',
        'value' => (isset($DataList->answer_en) && $DataList->answer_en!='' )?
         html_escape($DataList->answer_en):'');
		echo form_textarea($answer_en);
	 ?>
		</div>	
	</div><!--End form-group-->
	
     <?php if($optstatus==1){ ?>
     <div class="form-group">
		<label class="col-sm-4 col-md-3 control-label">Status</label>
		<div class="col-sm-8 col-md-7">
		<?php $OPTIONS = array(""=>"--Select Stauts--",'1'=>'Publish','0'=>'Pending');
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
			<button type="reset" id="reset" class="btn blue">Clear</button>
			<a class="btn purple" href="<?php echo base_url('manage/Faq/');?>">Back</a>
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
        
        jQuery.validator.addMethod("Alphanumspace", function(value, element) {
        		return this.optional(element) || /^[a-zA-Z0-1\s]*$/.test(value);
         }, "Please enter Letters, numbers and space only.");

	jQuery("#frmFaq").validate({
		 rules: {
			 category:{
			 		required:true,
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
                         answer_en:{
			        required: true,
			       // maxlength:255,
			        minlength:2
			    },
			 answer_hi:{
			        required: true,
			       // maxlength:255,
			        minlength:2
			 }
                         ,
			 
		    status:{
				required: true,
		  		digits:true
			}
		  },
		  messages:{
		  	attachment:{
		  			extension:"Please upload image with jpg or jpeg extension only."
		  	}
		  }
		});	//end validation
		
	});
</script>