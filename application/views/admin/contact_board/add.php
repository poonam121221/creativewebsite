<!-- BEGIN PAGE HEADER-->
<div class="row">
<div class="col-md-12">
	<ul class="page-breadcrumb breadcrumb">
		<li><i class="fa fa-home"></i><a href="<?php echo base_url('manage/Dashboard/'); ?>">Home</a><i class="fa fa-angle-right"></i></li>
		<li><a href="<?php echo base_url('manage/Contactboard/'); ?>">Contact Board</a><i class="fa fa-angle-right"></i></li>
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
  <div class="caption">Add Contact Board</div>
  <div class="tools"> <a href="javascript:;" class="collapse"> </a></div>
</div><!--End portlet-title-->
<div class="portlet-body">
<!--------------------------------------------------------------------------->
<div class="row"><div class="col-lg-12">
<?php echo AlertMessage($this->session->flashdata('AppMessage'));?>
</div></div>
<!--End Validation message-->
<?php
$atr2 =array('id'=>'frmContactboard','name'=>'frmContactboard','class'=>'form-horizontal','role'=>'form', 'autocomplete'=>'off');
echo form_open_multipart('manage/Contactboard/add',$atr2); 
?>
 <div class="form-body">
 
 	<div class="form-group">
		<label class="col-sm-4 col-md-3 control-label">Type <span class="red">*</span></label>
		<div class="col-sm-8 col-md-9">
		<?php $OPTIONS = array('1'=>"Who's Who");
		echo form_dropdown('type', $OPTIONS, (isset($DataList->type) && $DataList->type !='' )?
         html_escape($DataList->status):'',array('class'=> 'form-control input-medium'));
	    ?>
		</div>
	</div><!--End form-group-->
 
 	<div class="form-group">
		<label class="col-sm-4 col-md-3 control-label">Category <span class="red">*</span></label>
		<div class="col-sm-8 col-md-9">
		<?php 
			echo form_dropdown(array('name'=>'category','id'=>'category','class'=>'form-control input-medium'),
		    isset($CategoryList)?$CategoryList:array(''=>'--SELECT CATEGORY--'),isset($DataList->cat_id) ? ($DataList->cat_id):'');
		?>
		</div>	
	</div><!--End form-group-->
	
	<div class="form-group">
		<label class="col-sm-4 col-md-3 control-label">Designation <span class="red">*</span></label>
		<div class="col-sm-8 col-md-9">
		<?php $OPTIONS2 = array(''=>'--SELECT DESIGNATION--');
		echo form_dropdown('d_id', $OPTIONS2, (isset($DataList->d_id) && $DataList->d_id !='' )?
         html_escape($DataList->d_id):'',array('class'=> 'form-control input-medium','id'=>'d_id'));
	    ?>
		</div>
	</div><!--End form-group-->
    <div class="form-group">
		<label class="col-sm-4 col-md-3 control-label">Location <span class="red">*</span></label>
		<div class="col-sm-8 col-md-9">
		<?php 
			echo form_dropdown(array('name'=>'location','id'=>'location','class'=>'form-control input-medium'),
		    isset($LocationList)?$LocationList:array(''=>'--SELECT LOCATION--'),isset($DataList->location) ? ($DataList->location):'');
		?>
		</div>	
	</div><!--End form-group-->
 
 	<div class="form-group">
		<label class="col-sm-4 col-md-3 control-label">Name (Hindi) <span class="red">*</span></label>
		<div class="col-sm-8 col-md-9">
		<?php $TITLE_HI = array( 
        'name'=>'title_hi','class'=> 'form-control','placeholder'=>'Enter name in hindi',
        'value' => (isset($DataList->title_hi) && $DataList->title_hi!='' )?
         html_escape($DataList->title_hi):'');
		 echo form_input($TITLE_HI);
	 ?>
		</div>	
	</div><!--End form-group-->
	
	<div class="form-group">
		<label class="col-sm-4 col-md-3 control-label">Name (English) <span class="red">*</span></label>
		<div class="col-sm-8 col-md-9">
		<?php $TITLE_EN = array( 
        'name'=>'title_en','class'=> 'form-control','placeholder'=>'Enter name in english',
        'value' => (isset($DataList->title_en) && $DataList->title_en!='' )?
         html_escape($DataList->title_en):'');
		echo form_input($TITLE_EN);
	 ?>
		</div>	
	</div><!--End form-group-->
	
	<div class="form-group">
		<label class="col-sm-4 col-md-3 control-label">Email Address </label>
		<div class="col-sm-8 col-md-9">
		<?php $EMAIL = array( 
        'name'=>'email_address','class'=> 'form-control','placeholder'=>'Enter email address',
        'value' => (isset($DataList->email_address) && $DataList->email_address!='' )?
         html_escape($DataList->email_address):'');
		echo form_input($EMAIL);
	 ?>
		</div>	
	</div><!--End form-group-->
	
	<div class="form-group">
		<label class="col-sm-4 col-md-3 control-label">Phone Number </label>
		<div class="col-sm-8 col-md-9">
		<?php $PHONE_NO = array( 
        'name'=>'phone_number','class'=> 'form-control','placeholder'=>'Enter phone number',
        'value' => (isset($DataList->phone_number) && $DataList->phone_number!='' )?
         html_escape($DataList->phone_number):'');
		echo form_input($PHONE_NO);
	 ?>
		</div>	
	</div><!--End form-group-->
	
	<div class="form-group">
		<label class="col-sm-4 col-md-3 control-label">Contact Number </label>
		<div class="col-sm-8 col-md-9">
		<?php $CONTACT_NO = array( 
        'name'=>'contact_number','class'=> 'form-control','placeholder'=>'Enter contact number',
        'value' => (isset($DataList->contact_number) && $DataList->contact_number!='' )?
         html_escape($DataList->contact_number):'');
		echo form_input($CONTACT_NO);
	 ?>
		</div>	
	</div><!--End form-group-->
	
	<div class="form-group">
		<label class="col-sm-4 col-md-3 control-label">Residence Phone No. </label>
		<div class="col-sm-8 col-md-9">
		<?php $RES_PHONE_NO = array( 
        'name'=>'res_phone_number','class'=> 'form-control','placeholder'=>'Enter Residence Phone Number',
        'value' => (isset($DataList->res_phone_number) && $DataList->res_phone_number!='' )?
         html_escape($DataList->res_phone_number):'');
		echo form_input($RES_PHONE_NO);
	 ?>
		</div>	
	</div><!--End form-group-->
	
	<div class="form-group">
		<label class="col-sm-4 col-md-3 control-label">Photo </label>
		<div class="col-sm-8 col-md-9">
		<input type="file" name="attachment" id="fileupload"/>	
		</div>	
	</div><!--End form-group-->
	
	<div class="form-group">
		<label class="col-sm-4 col-md-3 control-label">View Image</label>
		<div class="col-sm-8 col-md-9">
		 <?php
 		$image_properties = array(
        'src'   => (isset($DataList->attachment) && trim($DataList->attachment)!="")? 'uploads/gallery/'.html_escape($DataList->attachment):'webroot/img/no_image.png',
        'alt'   => 'Contact Board Image',
        'class' => 'post_images',
        'width' => '100',
        'height'=> '100',
        'title' => 'Contact Board Image'
		);
 		 echo img($image_properties);
 		 ?>
		</div>	
	</div><!--End form-group-->
	
	
	<?php if($optstatus==1){ ?>
	<div class="form-group">
		<label class="col-sm-4 col-md-3 control-label">Status</label>
		<div class="col-sm-8 col-md-7">
		<?php $OPTIONS = array(""=>"--Select Status--",'1'=>'Publish','0'=>'Pending');
		echo form_dropdown('status', $OPTIONS, (isset($DataList->status) && $DataList->status !='' )?
         html_escape($DataList->status):set_value('status'),array('class'=> 'form-control input-medium'));
	    ?>
		</div>
	</div><!--End form-group-->
	<?php }//end check optstatus ?>

	<div class="form-group">
		<label class="col-sm-4 col-md-3 control-label"></label>
		<div class="col-sm-8 col-md-9">
			<button type="submit" class="btn green">Submit</button>
			<button type="reset" class="btn blue">Clear</button>
			<a class="btn purple" href="<?php echo base_url('manage/Contactboard/'); ?>">Back</a>
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
		
		  	$.validator.addMethod("extension", function(value, element, param) {
            	param = typeof param === "string" ? param.replace(/,/g, "|") : "png|jpe?g|gif";
            	return this.optional(element) || value.match(new RegExp(".(" + param + ")$", "i"));
            }, $.validator.format("Please enter a value with a valid extension."));

		    $.validator.addMethod('filesize', function(value, element, param) {
		     return this.optional(element) || (element.files[0].size <= param) 
			}, $.validator.format("Uploaded file size should be less than or equal to 300 kb)."));
				
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
   
	jQuery("#frmContactboard").validate({
		 rules: {
		 	type:{
			 	required:true,
			 	digits:true
			 },
			 category:{
			 		required:true,
			 		digits:true
			 },
			 location:{
			 		required:true,
			 		digits:true
			 },
			 d_id:{
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
			 email_address:{
			        maxlength:100
			 },
			 contact_number:{
			        maxlength:255
			 },
			 phone_number:{
			        maxlength:100
			 },
			 res_phone_number:{
			        maxlength:100
			 },
			
			 attachment:{
			        filesize:307200,
			        maxlength:300,
			        extension:true
			  },
			  status:{
			  	required:true,
			  	digits:true
			  }
		  }
		});	//end validation

		});// end dom
</script>
<script type="text/javascript">
	$(function(){
		
		$('#category').change(function(){
		
		category = 	$('#category').val();
		if(category != 3){

			$("#location").val("1");

			}	else {	$("#location").val("");}
			
			var id = $(this).val();
						
			if(id!=""){
				$('#ajaxloading').modal('show');
				dataString = {'id':id};
				
				$.ajax({
	            type: "POST",
	            url: '<?php echo base_url("Ajaxmaster/getContactDesignationList/"); ?>',
	            data: dataString,
	            cache : false,
	            success: function(data){
				  $('#d_id').html(data);
				  $('#ajaxloading').modal('hide');                 
	            },
	            error: function(xhr, status, error) {
	              //console.log(error);
	              $('#ajaxloading').modal('hide');              
	            }
	           });//end ajax
				
			}//end check id is not empty
			
		});//end category change event
		
	});//end dom
</script>