<!-- BEGIN PAGE HEADER-->
<div class="row">
<div class="col-md-12">
	<ul class="page-breadcrumb breadcrumb">
		<li><i class="fa fa-home"></i><a href="<?php echo base_url('manage/Dashboard/'); ?>">Home</a><i class="fa fa-angle-right"></i></li>
		<li><a href="<?php echo base_url('manage/Events/'); ?>">Events</a><i class="fa fa-angle-right"></i></li>
		<li><a href="javascript:void(0);">Edit</a></li>
		<li class="btn-group">
		<button type="button" class="btn blue dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">
		<span>Actions</span><i class="fa fa-angle-down"></i>
		</button>
		<ul class="dropdown-menu pull-right" role="menu">
		<li><a href="<?php echo base_url('manage/Events/add'); ?>"><i class="fa fa-plus"></i> Add</a></li>
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
  <div class="caption">Edit Events</div>
  <div class="tools"> <a href="javascript:;" class="collapse"> </a></div>
</div><!--End portlet-title-->
<div class="portlet-body">

	<?php 
	    $hidden = array('id' => html_escape(isset($DataList->id)? encrypt_decrypt('encrypt',$DataList->id):''));
		$atr2 =array('id'=>'frmEvents','name'=>'frmEvents','role'=>'form', 'autocomplete'=>'off');
   		echo form_open_multipart('manage/Events/edit',$atr2,$hidden); 
	?>
	
    	<div class="form-group clearfix">
		<label class="col-lg-2 col-md-3 control-label">Category<span class="red">*</span></label>
		<div class="col-lg-5 col-md-6">
		<?php 
			echo form_dropdown(array('name'=>'category','class'=>'form-control input-medium'),
		    isset($CategoryList)?$CategoryList:array(''=>'--SELECT CATEGORY--'),isset($DataList->cat_id) ? ($DataList->cat_id):'');
		?>
		</div>	
	</div><!--End form-group-->
    
     <div class="form-group clearfix">
     <label class="col-lg-2 col-md-3 control-label">Title (Hindi) <span class="red">*</span></label>  
     <div class="col-lg-5 col-md-6">
     <?php $TITLE_HI = array(
        'name'          => 'title_hi',
        'id'            => 'title_hi',
        'class'         => 'form-control',
        'value'         =>(isset($DataList->title_hi) && $DataList->title_hi !='' )?
         html_entity_decode($DataList->title_hi):""
		);
		echo form_input($TITLE_HI);
	 ?>
     </div>
     </div><!--End Form-group-->

     <div class="form-group clearfix">
     <label class="col-lg-2 col-md-3 control-label">Description (Hindi) <span class="red">*</span></label>  
     <div class="col-lg-10 col-md-9">
	 <?php 		
		$PAGEDESC_HI = (isset($DataList->description_hi) && $DataList->description_hi !='' )?
        html_entity_decode(stripslashes2($DataList->description_hi)):"";
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
        'value'         => (isset($DataList->title_en) && $DataList->title_en !='' )?
         html_entity_decode($DataList->title_en):"",
		);
		echo form_input($TITLE_EN);
	 ?>
     </div>
     </div><!--End Form-group-->

     <div class="form-group clearfix">
     <label class="col-lg-2 col-md-3 control-label">Description (English) <span class="red">*</span></label>  
     <div class="col-lg-10 col-md-9">
     <?php 		
		$PAGEDESC_EN = (isset($DataList->description_en) && $DataList->description_en !='' )?
        html_entity_decode(stripslashes2($DataList->description_en)):"";
	    echo $this->ckeditor->editor('description_en',@$PAGEDESC_EN);			 					
	  ?>
	 <div id="description_en1"></div>
     </div>
     </div><!--End Form-group-->
  	
  	<div class="form-group clearfix">
		<label class="col-lg-2 col-md-3 control-label">Start Date</label>
		<div class="col-lg-5 col-md-6">
		<?php $START_DATE = array('name'=>'s_date','id'=>'s_date','class'=>'form-control','value'=>(isset($DataList->event_start_date) && !empty($DataList->event_start_date))? get_date($DataList->event_start_date,'d-m-Y h:i'):"");
                echo form_input($START_DATE);
	    ?>
		</div>
	</div><!--End form-group-->
	
	<div class="form-group clearfix">
		<label class="col-lg-2 col-md-3 control-label">End Date</label>
		<div class="col-lg-5 col-md-6">
		<?php $END_DATE = array('name'=>'e_date','id'=>'e_date','class'=>'form-control','value'=>(isset($DataList->event_end_date) && !empty($DataList->event_end_date))? get_date($DataList->event_end_date,'d-m-Y h:i'):"");
		echo form_input($END_DATE);
	    ?>
		</div>
	 </div><!--End form-group-->
	 
	 <div class="form-group clearfix">
		<label class="col-lg-2 col-md-3 control-label">Attachment</label>
		<div class="col-lg-5 col-md-6">
		<input type="file" name="attachment" id="fileupload"/>
		</div>
	 </div><!--End form-group-->
	 
	 <div class="form-group clearfix">
		<label class="col-lg-2 col-md-3 control-label">View Attachment</label>
		<div class="col-lg-5 col-md-6">
		<?php
 		$image_properties = array(
        'src'   => (isset($DataList->attachment) && trim($DataList->attachment)!="")? 'uploads/events/'.html_escape($DataList->attachment):'webroot/img/no_image.png',
        'alt'   => 'Event Image',
        'class' => 'post_images',
        'width' => '100',
        'height'=> '100',
        'title' => 'Event Image'
		);
 		 echo img($image_properties);
 		 ?>
		</div>
	 </div><!--End form-group-->
	     
     <?php if($optstatus==1){ ?>
     <div class="form-group clearfix">
     <label class="col-lg-2 col-md-3 control-label">Status <span class="red">*</span></label>  
     <div class="col-lg-5 col-md-6">
     <?php $STATUS = array(""=>"--Select Status--",'1'=>'Publish','0'=>'Pending');
		echo form_dropdown('status', $STATUS, (isset($DataList->status) && $DataList->status !='' )?
         html_escape($DataList->status):set_value('status'),array('class'=> 'form-control input-medium'));
	    ?>
     </div>
     </div><!--End Form-group-->
     <?php }//end check optstatus ?>
     
     <div class="form-group clearfix">
     <label class="col-lg-2 col-md-3 control-label">&nbsp;</label>  
     <div class="col-lg-4 col-md-5">
     <button type="submit" class="btn btn-info">Submit</button>
	 <button type="reset" id="reset" class="btn btn-primary">Clear</button>
	 <a class="btn purple" href="<?php echo base_url('manage/Events/'); ?>"> Back</a>
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
	
	$('#s_date').datetimepicker({autoclose: true,format: "dd-mm-yyyy hh:ii",startDate:'0d',minuteStep: 5})
	.on('changeDate', function(ev) {
	    if($('#s_date').valid()){
	       $('#s_date').removeClass('help-block');   
	    }
    });
	$('#e_date').datetimepicker({autoclose: true,format: "dd-mm-yyyy hh:ii",startDate:'0d',minuteStep: 5})
	.on('changeDate', function(ev) {
	    if($('#e_date').valid()){
	       $('#e_date').removeClass('help-block');   
	    }
    });
	
	//IMPORTANT: update CKEDITOR textarea with actual content before submit
    $("#frmEvents").on('submit', function() {
       for(var instanceName in CKEDITOR.instances) {
               CKEDITOR.instances[instanceName].updateElement();
       }
     })
	
	// validate signup form on keyup and submit
	jQuery.validator.addMethod("alphanumspace", function(value, element) {
		  return this.optional(element) || /^[a-zA-Z0-9\s]*$/.test(value);
	}, "Please enter character, number and space only.");
	
	jQuery.validator.addMethod("Alphaspacecomma", function(value, element) {
        		return this.optional(element) || /^[a-zA-Z0-1,.\s]*$/.test(value);
    }, "Please enter character,comma,dot and space only.");
    
    $.validator.addMethod('filesize', function(value, element, param) {
		    return this.optional(element) || (element.files[0].size <= param) 
	}, $.validator.format("Uploaded file size should be less than or equal to 2 MB)."));
    
    //for date time pattern (DD-MM-YYY HH:MM)
    jQuery.validator.addMethod("afterBeginDateTime",function(value, element, param){
    	var status = false;
    	if(( $('#'+param[1]).data('datetimepicker').getDate() - $('#'+param[0]).data('datetimepicker').getDate())<0){
			status = false;
		}else{
			status = true;
		}		
		return this.optional(element) || status;
    }, "Please select another date");
    
    //for date pattern (DD-MM-YYY)
    jQuery.validator.addMethod("afterBeginDate",function(value, element, param){
    	var status = false;
    	if(( $('#'+param[1]).data('datepicker').getDate() - $('#'+param[0]).data('datepicker').getDate())<=1){
			status = false;
		}else{
			status = true;
		}		
		return this.optional(element) || status;
    }, "Please select another date");
    
    $.validator.addMethod("checkdate", function(value, element) {
        return this.optional(element) || /^(0[1-9]|[1-2][0-9]|3[0-1])-(0[1-9]|1[0-2])-[0-9]{4}$/.test(value);
    }, "Please enter valid date format (DD-MM-YYYY).");
    
    $.validator.addMethod("checkdatetime", function(value, element) {
        return this.optional(element) || /^(0[1-9]|[1-2][0-9]|3[0-1])-(0[1-9]|1[0-2])-[0-9]{4} ([0-1][0-9]|[2][0-3]):([0-5][0-9])$/.test(value);
    }, "Please enter valid date format (DD-MM-YYYY HH:MM).");
	
        $("#frmEvents").validate({
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
			    attachment:{
			        filesize:2097152,
			        maxlength:200,
			        extension:"jpg|jpeg|JPG|JPEG"
			    },
                s_date: {
					required: true,
					checkdatetime:true
				},
                e_date: {
					required: true,
					checkdatetime:true,
					afterBeginDateTime : ['s_date','e_date']
				},
                status: {
					required: true,
					digits:true
				}
            },
		  messages:{
		  	
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