<!-- BEGIN PAGE HEADER-->
<div class="row">
<div class="col-md-12">
	<ul class="page-breadcrumb breadcrumb">
		<li><i class="fa fa-home"></i><a href="<?php echo base_url('manage/Dashboard/'); ?>">Home</a><i class="fa fa-angle-right"></i></li>
		<li><a href="<?php echo base_url('test/Test/'); ?>">Website Setting</a><i class="fa fa-angle-right"></i></li>
		<li><a href="javascript:void(0);">View</a></li>
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
  <div class="caption">Edit Website Setting</div>
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
$atr2 =array('id'=>'frmSettings','name'=>'frmSettings','class'=>'form-horizontal','role'=>'form', 'autocomplete'=>'off');
echo form_open('test/Test/edit',$atr2,$hidden); 
?>
 <div class="form-body">
	
	<div class="form-group clearfix">
		<label class="col-lg-2 col-md-3 control-label">Start Date</label>
		<div class="col-lg-5 col-md-6">
		<?php $START_DATE = array('name'=>'name','id'=>'name','class'=>'form-control','value'=>(isset($DataList->name) && get_date($DataList->name)!="")? $DataList->name:"");
		echo form_input($START_DATE);
	    ?>
		</div>
	</div><!--End form-group-->
	<div class="form-group clearfix">
		<label class="col-lg-2 col-md-3 control-label">Start Date</label>
		<div class="col-lg-5 col-md-6">
		<?php $START_DATE = array('name'=>'purpose','id'=>'purpose','class'=>'form-control','value'=>(isset($DataList->purpose) && get_date($DataList->purpose)!="")? $DataList->purpose:"");
		echo form_input($START_DATE);
	    ?>
		</div>
	</div><!--End form-group-->

 	 <div class="form-group">
		<label class="col-sm-3 control-label"></label>
		<div class="col-sm-9">
			<button type="submit" class="btn green">Update</button>
			<button type="reset" class="btn blue">Clear</button>
			<a class="btn purple" href="<?php echo base_url('test/Test/'); ?>">Back</a>
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
		
	$('#last_updated_on').datepicker({'format':'dd-mm-yyyy'});
		
	jQuery.validator.addMethod("alphanumspace", function(value, element) {
		  return this.optional(element) || /^[a-zA-Z0-9\s]*$/.test(value);
	}, "Please enter character, number and space only.");

	jQuery( "#frmSettings" ).validate({
		  rules: { 
		  category_hi: {
		        required: true,
				date:true,
		    }
		  }
		});	
		
	});//end dom
</script>