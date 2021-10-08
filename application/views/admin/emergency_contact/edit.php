<!-- BEGIN PAGE HEADER-->
<div class="row">
<div class="col-md-12">
	<ul class="page-breadcrumb breadcrumb">
		<li><i class="fa fa-home"></i><a href="<?php echo base_url('manage/Dashboard/'); ?>">Home</a><i class="fa fa-angle-right"></i></li>
		<li><a href="<?php echo base_url('manage/EmergencyContact/'); ?>">Emergency Contact</a><i class="fa fa-angle-right"></i></li>
		<li><a href="javascript:void(0);">Edit</a></li>
		<li class="btn-group">
		<button type="button" class="btn blue dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">
		<span>Actions</span><i class="fa fa-angle-down"></i>
		</button>
		<ul class="dropdown-menu pull-right" role="menu">
		<li><a href="<?php echo base_url('manage/EmergencyContact/add'); ?>"><i class="fa fa-plus"></i> Add</a></li>
		</ul>
		</li>
	</ul>
	<!-- END PAGE TITLE & BREADCRUMB-->
</div>
</div>
<!-- END PAGE HEADER-->
<!-- BEGIN PAGE CONTENT-->
<div class="row">
<div class="col-md-12">
<div class="row"><div class="col-lg-12">
<?php echo AlertMessage($this->session->flashdata('AppMessage'));?>
</div></div>
<!--End Validation message-->
<!--start from layout-->

<div class="row">
<div class="col-md-12">
<div class="portlet box blue">
<div class="portlet-title">
  <div class="caption">Edit Emergency Contact</div>
  <div class="tools"> <a href="javascript:;" class="collapse"> </a></div>
</div><!--End portlet-title-->
<div class="portlet-body">

	<?php 
	    $hidden = array('id' => html_escape(isset($DataList->contact_id)? encrypt_decrypt('encrypt',$DataList->contact_id):''));
		$atr2 =array('id'=>'frmEmergencyContact','name'=>'frmEmergencyContact','role'=>'form', 'autocomplete'=>'off');
   		echo form_open_multipart('manage/EmergencyContact/edit',$atr2,$hidden); 
	?>

     <div class="form-group clearfix">
     <label class="col-lg-2 col-md-3 control-label">District <span class="red">*</span></label>  
     <div class="col-lg-5 col-md-6">
     <?php 
		echo form_dropdown('contact_district', $district, (isset($DataList->contact_district) && $DataList->contact_district !='' )?
         html_escape(strtoupper($DataList->contact_district)):set_value('contact_district'),array('class'=> 'form-control'));
	 ?>
     </div>
     </div><!--End Form-group-->

     <div class="form-group clearfix">
     <label class="col-lg-2 col-md-3 control-label">Designation<span class="red">*</span></label>  
     <div class="col-lg-5 col-md-6">
	 <?php 		
		$designation = array(
        'name'          => 'contact_designation',
        'id'            => 'designation',
        'class'         => 'form-control',
        'value'         => (isset($DataList->contact_designation) && $DataList->contact_designation !='' )?
         html_escape($DataList->contact_designation):"",
		);
		echo form_input($designation);
	 ?>
	 <div id="description_hi1"></div>
     </div>
     </div><!--End Form-group-->

	 <div class="form-group clearfix">
     <label class="col-lg-2 col-md-3 control-label">Contact Name <span class="red">*</span></label>  
     <div class="col-lg-5 col-md-6">
     <?php $contact_name = array(
        'name'          => 'contact_name',
        'id'            => 'contact_name',
        'class'         => 'form-control',
        'value'         => (isset($DataList->contact_name) && $DataList->contact_name !='' )?
         html_escape($DataList->contact_name):"",
		);
		echo form_input($contact_name);
	 ?>
     </div>
     </div><!--End Form-group-->

     <div class="form-group clearfix">
     <label class="col-lg-2 col-md-3 control-label">Office Number <span class="red">*</span></label>  
     <div class="col-lg-5 col-md-6">
	 <?php 		
		$office_number = array(
        'name'          => 'contact_office_number',
        'id'            => 'contact_office_number',
        'class'         => 'form-control',
        'value'         => (isset($DataList->contact_office_number) && $DataList->contact_office_number !='' )?
         html_escape($DataList->contact_office_number):"",
		);
		echo form_input($office_number);
	 ?>
	 <div id="description_en1"></div>
     </div>
     </div><!--End Form-group-->
     
     <div class="form-group clearfix">
		<label class="col-lg-2 col-md-3 control-label">Mobile Number</label>
		<div class="col-lg-5 col-md-6">
		<?php 		
		$mobile_number = array(
        'name'          => 'contact_mobile_number',
        'id'            => 'contact_mobile_number',
        'class'         => 'form-control',
        'value'         => (isset($DataList->contact_mobile_number) && $DataList->contact_mobile_number !='' )?
         html_escape($DataList->contact_mobile_number):"",
		);
		echo form_input($mobile_number);
	 ?>
		</div>
	</div><!--End form-group-->
	
	 <div class="form-group clearfix">
		<label class="col-lg-2 col-sm-3 control-label">FAX Number</label>
		<div class="col-lg-5 col-sm-6 ">
		<?php		
		$fax_number = array(
        'name'          => 'contact_fax_number',
        'id'            => 'contact_fax_number',
        'class'         => 'form-control',
        'value'         => (isset($DataList->contact_fax_number) && $DataList->contact_fax_number !='' )?
         html_escape($DataList->contact_fax_number):"",
		);
		echo form_input($fax_number);
	 ?>
	    
		</div>
	 </div><!--End form-group-->
	 
	 <div class="form-group clearfix">
		<label class="col-lg-2 col-md-3 control-label">Email ID<span class="red">*</span></label>
		<div class="col-lg-5 col-md-6">
		<?php 		
		$email = array(
        'name'          => 'contact_emailid',
        'id'            => 'contact_emailid',
        'class'         => 'form-control',
        'value'         => (isset($DataList->contact_emailid) && $DataList->contact_emailid !='' )?
         html_escape($DataList->contact_emailid):"",
		);
		echo form_input($email);
	 ?>
		</div>
	</div><!--End form-group-->
     
     <?php if($optstatus==1){ ?>
     <div class="form-group clearfix">
     <label class="col-lg-2 col-md-3 control-label">Status <span class="red">*</span></label>  
     <div class="col-lg-5 col-md-6">
     <?php $STATUS = array(""=>"--Select Status--",'1'=>'Publish','0'=>'Pending');
		echo form_dropdown('status', $STATUS, (isset($DataList->contact_status) && $DataList->contact_status !='' )?
         html_escape($DataList->contact_status):set_value('status'),array('class'=> 'form-control input-medium'));
	    ?>
     </div>
     </div><!--End Form-group-->
     <?php }//end check optstatus ?>
     
     <div class="form-group clearfix">
     <label class="col-lg-2 col-md-3 control-label">&nbsp;</label>  
     <div class="col-lg-4 col-md-5">
     <button type="submit" class="btn btn-info">Submit</button>
	 <button type="reset" id="reset" class="btn btn-primary">Clear</button>
	 <a class="btn purple" href="<?php echo base_url('manage/EmergencyContact/'); ?>"> Back</a>
     </div>
     </div><!--End Form-group-->

    <?php echo "</form>"; ?> 
    
    </div><!--End portlet body-->
    
</div>
</div><!--End row-->
<!--End from layout-->
<!------------------------------------------------------------------- -->
</div><!--End column -->
</div><!--End row-->
<!-- END PAGE CONTENT-->
<script type="text/javascript" src="<?php echo base_url('webroot/');?>validation/dist/jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo base_url('webroot/');?>validation/dist/additional-methods.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	
	//IMPORTANT: update CKEDITOR textarea with actual content before submit
    $("#frmNews").on('submit', function() {
       for(var instanceName in CKEDITOR.instances) {
               CKEDITOR.instances[instanceName].updateElement();
       }
     });
		
	$('#archive_date').datepicker({format:'dd-mm-yyyy',autoclose: true,startDate:'0d'})
	.on('changeDate', function(ev) {
	    if($('#archive_date').valid()){ $('#archive_date').removeClass('has-error'); }
	});
	
	// validate signup form on keyup and submit
	jQuery.validator.addMethod("alphanumspace", function(value, element) {
		  return this.optional(element) || /^[a-zA-Z0-9\s]*$/.test(value);
	}, "Please enter character, number and space only.");
	
	jQuery.validator.addMethod("Alphaspacecomma", function(value, element) {
        		return this.optional(element) || /^[a-zA-Z0-1,.\s]*$/.test(value);
    }, "Please enter character,comma,dot and space only.");
    
    $.validator.addMethod('filesize', function(value, element, param) {
		    return this.optional(element) || (element.files[0].size <= param) 
	}, $.validator.format("Uploaded file size should be less than or equal to 50 MB)."));
	
	$.validator.addMethod("checkdate", function(value, element) {
        return this.optional(element) || /^(0[1-9]|[1-2][0-9]|3[0-1])-(0[1-9]|1[0-2])-[0-9]{4}$/.test(value);
    }, "Please enter valid date format (DD-MM-YYYY).");
	
        $("#frmEmergencyContact").validate({
        	errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",
            rules: {
                contact_district: {
                    required: true,
                },
				contact_designation: {
                    required: true,
                     minlength:2
                },
				contact_name: {
                    required: true,
                    minlength:2,
			        maxlength:255
                },
				contact_office_number: {
                    required: true,
                    digits:true
                },
	            contact_mobile_number: {
					
					digits:true
			    },contact_mobile_number: {
					
					digits:true
			    },
				contact_emailid:{
					 required: true,
                    email: true
				},
                status: {
					required: true,
					digits:true
				}
            },
		  message:{
		  	attachment: {extension:"Please upload only JPEG,JPG,PDF Formet",filesize:"File size must be less than 50 MB"}
		  },
          highlight: function (element) { // hightlight error inputs
                    $(element).closest('.form-group').addClass('has-error'); // set error class to the control group
          },
		  unhighlight: function (element) { // revert the change done by hightlight
                    $(element).closest('.form-group').removeClass('has-error'); // set error class to the control group
          },
          errorPlacement: function (error, element) { // render error placement for each input type
                    if (element.attr("data-error-container")) { 
                        error.appendTo(element.attr("data-error-container"));
                    }else {
                        error.insertAfter(element); // for other inputs, just perform default behavior
                    }
          },
        });//end validation

});//end dom
</script>