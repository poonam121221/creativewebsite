<!-- BEGIN PAGE HEADER-->
<div class="row">
<div class="col-md-12">
	<ul class="page-breadcrumb breadcrumb">
		<li><i class="fa fa-home"></i><a href="#">Home</a><i class="fa fa-angle-right"></i></li>
		<li><a href="#">Contact Location</a><i class="fa fa-angle-right"></i></li>
		<li><a href="<?php echo base_url('manage/Location/'); ?>">View</a></li>
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
  <div class="caption">Edit Location</div>
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
$atr2 =array('id'=>'frmLocation','name'=>'frmLocation','class'=>'form-horizontal','role'=>'form', 'autocomplete'=>'off');
echo form_open('manage/Location/edit',$atr2,$hidden); 
?>
 <div class="form-body">

 		<div class="form-group">
		<label class="col-sm-3 control-label">Location Name (Hindi) <span class="red">*</span></label>
		<div class="col-sm-9">
		<?php $CATEGORY_NAME_HI = array( 
        'name'=>'location_name_hi','id'=>'location_name_hi','class'=> 'form-control','placeholder'=>'Enter Location Name in hindi',
        'value' => (isset($DataList->location_name_hi) && $DataList->location_name_hi !='' )?
         html_escape($DataList->location_name_hi):set_value('location_name_hi'));
		echo form_input($CATEGORY_NAME_HI);
	    ?>
		</div>
	   </div><!--End form-group-->
	   
	   <div class="form-group">
		<label class="col-sm-3 control-label">Location Name (English) <span class="red">*</span></label>
		<div class="col-sm-9">
		<?php $CATEGORY_NAME_EN = array( 
        'name'=>'location_name_en','id'=>'location_name_en','class'=> 'form-control','placeholder'=>'Enter Location Name in english',
        'value' => (isset($DataList->location_name_hi) && $DataList->location_name_hi !='' )?
         html_escape($DataList->location_name_hi):set_value('location_name_hi'));
		echo form_input($CATEGORY_NAME_EN);
	    ?>
		</div>
	   </div><!--End form-group-->
		
		<?php if($optstatus==1){ ?>
 		<div class="form-group">
		<label class="col-sm-3 control-label">Status <span class="red">*</span></label>
		<div class="col-sm-9 ">
		<?php $OPTIONS = array(""=>"--Select Stauts--",'1'=>'Publish','0'=>'Pending');
		echo form_dropdown('status', $OPTIONS, (isset($DataList->status) && $DataList->status !='' )?
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
			<a class="btn purple" href="<?php echo base_url('manage/Location/'); ?>">Back</a>
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
		
	jQuery.validator.addMethod("alphaspace", function(value, element) {
		  return this.optional(element) || /^[a-zA-Z\s]*$/.test(value);
	}, "Please enter character and space only.");

	jQuery.validator.addMethod("alphanumspace", function(value, element) {
		  return this.optional(element) || /^[a-zA-Z0-9\s]*$/.test(value);
	}, "Please enter character, number and space only.");

	jQuery( "#frmLocation" ).validate({
		  rules: { 
		  location_name_hi: {
		        required: true,
		        minlength:2,
		        maxlength:100
		    },
		   location_name_en: {
		        required: true,
		        minlength:2,
		        maxlength:100
		    },
		    status:{
				required:true,
				digits:true
			}
		  }
		});
		
	});//end dom
</script>