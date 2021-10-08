<!-- BEGIN PAGE HEADER-->
<div class="row">
<div class="col-md-12">
	<ul class="page-breadcrumb breadcrumb">
		<li><i class="fa fa-home"></i><a href="<?php echo base_url('manage/Dashboard/'); ?>">Home</a><i class="fa fa-angle-right"></i></li>
		<li><a href="<?php echo base_url('manage/Noticeboard/'); ?>">Notice Board</a><i class="fa fa-angle-right"></i></li>
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
  <div class="caption">Edit Notice Board</div>
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
$atr2 =array('id'=>'frmNoticeboard','name'=>'frmNoticeboard','class'=>'form-horizontal','role'=>'form', 'autocomplete'=>'off');
echo form_open_multipart('manage/Noticeboard/edit',$atr2,$hidden); 
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
	   
	   <div class="form-group">
		<label class="col-sm-3 control-label">Attachment </label>
		<div class="col-sm-9 ">
		<p>
		<?php if(isset($DataList->attachment)==TRUE && trim($DataList->attachment)!=""): ?>
	    View Uploaded File <a target="_blank" href="<?php echo base_url('uploads/files/'.$DataList->attachment); ?>"><i class="fa fa-download"></i></a>
	    <?php endif; ?></p>
		<?php echo form_upload(array('name'=>'attachment', 'id'=>'attachment')); ?>
		</div>
	   </div><!--End form-group-->
	   
	   <div class="form-group clearfix">
		<label class="col-sm-3 control-label">Archive Date <span class="red">*</span></label>
		<div class="col-sm-6">
		<?php $ARCHIVE_DATE = array('name'=>'archive_date','id'=>'archive_date','class'=>'form-control','value'=>(isset($DataList->archive_exp_date) && !empty(get_date($DataList->archive_exp_date)))? get_date($DataList->archive_exp_date):"");
		echo form_input($ARCHIVE_DATE);
	    ?>
		</div>
	   </div><!--End form-group-->
	   
	   <?php if($optstatus==1){ ?>
	   <div class="form-group">
		<label class="col-sm-3 control-label">Status <span class="red">*</span></label>
		<div class="col-sm-9 ">
		<?php $STATUS = array(""=>"--Select Status--",'1'=>'Publish','0'=>'Pending');
		echo form_dropdown('status', $STATUS, (isset($DataList->status) && $DataList->status !='' )?
         html_escape($DataList->status):set_value('status'),array('class'=> 'form-control input-medium'));
	    ?>
		</div>
	   </div><!--End form-group-->
	   <?php }//end check optstatus ?>

 	 <div class="form-group">
		<label class="col-sm-3 control-label"></label>
		<div class="col-sm-9">
			<button type="submit" class="btn green">Update</button>
			<button type="reset" class="btn blue">Clear</button>
			<a class="btn purple" href="<?php echo base_url('manage/Noticeboard/'); ?>">Back</a>
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
	
	$('#archive_date').datepicker({format:'dd-mm-yyyy',autoclose: true,startDate:'0d'}).on('changeDate', function(ev) {
	    if($('#archive_date').valid()){ $('#archive_date').removeClass('error'); }
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

	jQuery( "#frmNoticeboard" ).validate({
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
			attachment:{
				extension:'PDF|pdf|JPEG|jpeg|JPG|jpg|png',
				filesize:26214400
			},
            archive_date: {
				required: true,
				checkdate:true
		    },
		    status:{
				required: true,
		  		digits:true
			}
		  },
		  message:{
		  	attachment: {extension:"Please upload only JPEG,JPG,PDF Formet",filesize:"File size must be less than 25 MB"}
		  }
		});	
	});
</script>