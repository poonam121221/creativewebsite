<!-- BEGIN PAGE HEADER-->
<div class="row">
<div class="col-md-12">
	<ul class="page-breadcrumb breadcrumb">
		<li><i class="fa fa-home"></i><a href="#">Home</a><i class="fa fa-angle-right"></i></li>
		<li><a href="<?php echo base_url('manage/Contactcategory/'); ?>">Contact Category</a><i class="fa fa-angle-right"></i></li>
		<li><a href="#">Add</a></li>
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
  <div class="caption">Add Contact Category</div>
  <div class="tools"> <a href="javascript:;" class="collapse"> </a></div>
</div><!--End portlet-title-->
<div class="portlet-body">
<!--------------------------------------------------------------------------->
<div class="row"><div class="col-lg-12">
<?php echo AlertMessage($this->session->flashdata('AppMessage'));?>
</div></div>
<!--End Validation message-->
<?php
$atr2 =array('id'=>'frmContactcategory','name'=>'frmContactcategory','class'=>'form-horizontal','role'=>'form', 'autocomplete'=>'off');
echo form_open('manage/Contactcategory/add',$atr2); 
?>
 <div class="form-body">
 	<div class="form-group">
		<label class="col-sm-3 control-label">Category Name (Hindi) <span class="red">*</span></label>
		<div class="col-sm-9">
		<?php $CATEGORY_NAME_HI = array( 
        'name'=>'category_hi','id'=>'category_hi','class'=> 'form-control','placeholder'=>'Enter Contact Category in hindi');
		echo form_input($CATEGORY_NAME_HI);
	 ?>
		</div>
	</div><!--End form-group-->
	
	<div class="form-group">
		<label class="col-sm-3 control-label">Category Name (English) <span class="red">*</span></label>
		<div class="col-sm-9">
		<?php $CATEGORY_NAME_EN = array( 
        'name'=>'category_en','id'=>'category_en','class'=> 'form-control','placeholder'=>'Enter Contact Category in english');
		echo form_input($CATEGORY_NAME_EN);
	 ?>
		</div>
	</div><!--End form-group-->
	
	<?php if($optstatus==1){ ?>
	<div class="form-group">
		<label class="col-sm-3 control-label">Status <span class="red">*</span></label>
		<div class="col-sm-9 ">
		<?php $OPTIONS =array(""=>"--Select Stauts--",'1'=>'Publish','0'=>'Pending');
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
			<a class="btn purple" href="<?php echo base_url('manage/Contactcategory/'); ?>">Back</a>
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
		
	jQuery.validator.addMethod("alphanumspace", function(value, element) {
		  return this.optional(element) || /^[a-zA-Z0-9\s]*$/.test(value);
	}, "Please enter character, number and space only.");

	jQuery( "#frmContactcategory" ).validate({
		  rules: { 
		  category_hi: {
		        required: true,
		        minlength:2,
		        maxlength:100
		    },
		   category_en: {
		        required: true,
		        minlength:2,
		        maxlength:100
		    },
		    status:{
				required: true,
				digits:true
			}
		  }
		});	
		
	});//end dom
</script>