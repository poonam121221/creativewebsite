<!-- BEGIN PAGE HEADER-->
<div class="row">
<div class="col-md-12">
	<ul class="page-breadcrumb breadcrumb">
		<li><i class="fa fa-home"></i><a href="<?php echo base_url('manage/Dashboard/'); ?>">Home</a><i class="fa fa-angle-right"></i></li>
		<li><a href="<?php echo base_url('manage/News/'); ?>">News</a><i class="fa fa-angle-right"></i></li>
		<li><a href="javascript:void(0);">Add</a></li>
		<li class="btn-group">
		<button type="button" class="btn blue dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">
		<span>Actions</span><i class="fa fa-angle-down"></i>
		</button>
		<ul class="dropdown-menu pull-right" role="menu">
		<li><a href="<?php echo base_url('manage/News/add'); ?>"><i class="fa fa-plus"></i> Add</a></li>
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
  <div class="caption">Add News</div>
  <div class="tools"> <a href="javascript:;" class="collapse"> </a></div>
</div><!--End portlet-title-->
<div class="portlet-body">

	<?php
	    $hidden = array('id' => html_escape(isset($DataList->id)?$DataList->id:''));
		$atr2 =array('id'=>'frmNews','name'=>'frmNews','role'=>'form', 'autocomplete'=>'off');
   		echo form_open_multipart('manage/News/add',$atr2,$hidden); 
	?>

     <div class="form-group clearfix">
     <label class="col-lg-2 col-md-3 control-label">Title (Hindi) <span class="red">*</span></label>  
     <div class="col-lg-5 col-md-6">
     <?php $TITLE_HI = array(
        'name'          => 'title_hi',
        'id'            => 'title_hi',
        'class'         => 'form-control'
		);
		echo form_input($TITLE_HI);
	 ?>
     </div>
     </div><!--End Form-group-->

     <div class="form-group clearfix">
     <label class="col-lg-2 col-md-3 control-label">Description (Hindi) <span class="red">*</span></label>  
     <div class="col-lg-10 col-md-9">
	 <?php 		
		$PAGEDESC_HI = "";
	    echo $this->ckeditor->editor('description_hi',@$PAGEDESC_HI);
	 ?>
	 <div id="description_hi1"></div>
     </div>
     </div><!--End Form-group-->

	 <div class="form-group clearfix">
     <label class="col-lg-2 col-md-3 control-label">Title (English) <span class="red">*</span></label>  
     <div class="col-lg-5 col-md-6">
     <?php $TITLE_EN = array(
        'name'          => 'title_en',
        'id'            => 'title_en',
        'class'         => 'form-control',
        'value'         => '',
		);
		echo form_input($TITLE_EN);
	 ?>
     </div>
     </div><!--End Form-group-->

     <div class="form-group clearfix">
     <label class="col-lg-2 col-md-3 control-label">Description (English) <span class="red">*</span></label>  
     <div class="col-lg-10 col-md-9">
	 <?php 		
		$PAGEDESC_EN = "";
	    echo $this->ckeditor->editor('description_en',@$PAGEDESC_EN);
	 ?>
	 <div id="description_en1"></div>
     </div>
     </div><!--End Form-group-->
     
     <div class="form-group clearfix">
		<label class="col-lg-2 col-md-3 control-label">Attachment</label>
		<div class="col-lg-10 col-md-9">
		<?php echo form_upload(array('name'=>'attachment','id'=>'attachment')); ?>
		</div>
	</div><!--End form-group-->
	
	 <div class="form-group clearfix">
		<label class="col-lg-2 col-sm-3 control-label">Is Alert </label>
		<div class="col-lg-10 col-sm-9 ">
		<?php $ALERT = array('0'=>'No','1'=>'Yes');
		echo form_dropdown('is_alert', $ALERT, (isset($DataList->is_alert) && $DataList->is_alert !='' )?
         html_escape($DataList->is_alert):set_value('is_alert'),array('class'=> 'form-control input-medium'));
	    ?>
		</div>
	 </div><!--End form-group-->
	 
	 <div class="form-group clearfix">
		<label class="col-lg-2 col-md-3 control-label">Archive Date <span class="red">*</span></label>
		<div class="col-lg-10 col-md-9">
		<?php $ARCHIVE_DATE = array('name'=>'archive_date','id'=>'archive_date','class'=>'form-control');
		echo form_input($ARCHIVE_DATE);
	    ?>
		</div>
	</div><!--End form-group-->
     
     <?php if($optstatus==1){ ?>
     <div class="form-group clearfix">
     <label class="col-lg-2 col-md-3 control-label">Status <span class="red">*</span></label>  
     <div class="col-lg-10 col-md-9">
     <?php $STATUS = array(""=>"--Select Status--",'1'=>'Publish','0'=>'Pending');
		echo form_dropdown('status', $STATUS, (isset($DataList->status) && $DataList->status !='' )?
         html_escape($DataList->status):set_value('status'),array('class'=> 'form-control input-medium'));
	    ?>
     </div>
     </div><!--End Form-group-->
     <?php }//end check optstatus ?>


     <div class="form-group clearfix">
     <label class="col-lg-2 col-md-3 control-label">Type <span class="red">*</span></label>  
     <div class="col-lg-10 col-md-9">
     <?php $type = array(""=>"--Select Status--",'1'=>'In the news','0'=>'Press Release');
		echo form_dropdown('type', $type, (isset($DataList->type) && $DataList->type !='' )?
         html_escape($DataList->type):set_value('type'),array('class'=> 'form-control input-medium'));
	    ?>
     </div>
     </div><!--End Form-group-->

     
     <div class="form-group clearfix">
     <label class="col-lg-2 col-md-3 control-label">&nbsp;</label>  
     <div class="col-lg-4 col-md-5">
     <button type="submit" class="btn btn-info">Submit</button>
	 <button type="reset" id="reset" class="btn btn-primary">Clear</button>
	 <a class="btn purple" href="<?php echo base_url('manage/News/'); ?>"> Back</a>
     </div>
     </div><!--End Form-group-->

    <?php echo form_close(); ?> 
    
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
	
        $("#frmNews").validate({
        	errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",
            rules: {
                title_hi: {
                    required: true,
			        minlength:2,
			        maxlength:255
                },
				description_hi: {
                    required: true
                },
				title_en: {
                    required: true,
                    minlength:2,
			        maxlength:255
                },
				description_en: {
                    required: true
                },
	            archive_date: {
					required: true,
					checkdate:true
			    },
				attachment:{
					extension:'PDF|pdf|JPEG|jpeg|JPG|jpg|png',
					filesize:52428800
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