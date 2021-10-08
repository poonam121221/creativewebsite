<!-- BEGIN PAGE HEADER-->
<div class="row">
<div class="col-md-12">
	<ul class="page-breadcrumb breadcrumb">
		<li><i class="fa fa-home"></i><a href="<?php echo base_url('manage/Dashboard'); ?>">Home</a><i class="fa fa-angle-right"></i></li>
		<li><a href="<?php echo base_url('manage/Financialyear'); ?>">Financial Year</a><i class="fa fa-angle-right"></i></li>
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
  <div class="caption">Edit Financial Year</div>
  <div class="tools"> <a href="javascript:;" class="collapse"> </a></div>
</div><!--End portlet-title-->
<div class="portlet-body">
<!--------------------------------------------------------------------------->
<div class="row"><div class="col-lg-12">
<?php echo AlertMessage($this->session->flashdata('AppMessage'));?>
</div></div>
<!--End Validation message-->
<?php
$hidden = array('id' => html_escape(isset($DataList->f_id)? encrypt_decrypt('encrypt',$DataList->f_id):''));
$atr2 =array('id'=>'frmFinancialyear','name'=>'frmFinancialyear','class'=>'form-horizontal','role'=>'form', 'autocomplete'=>'off');
echo form_open('manage/Financialyear/edit',$atr2,$hidden); 
?>
 <div class="form-body">

 		<div class="form-group">
		<label class="col-sm-3 control-label">Financial Year (Ex.-2018-19) <span class="red">*</span></label>
		<div class="col-sm-9">
		<?php $CATEGORY_NAME_HI = array( 
        'name'=>'financial_year','id'=>'financial_year','class'=> 'form-control','placeholder'=>'Enter financial year',
        'value' => (isset($DataList->financial_year) && $DataList->financial_year !='' )?
         html_escape($DataList->financial_year):set_value('financial_year'));
		echo form_input($CATEGORY_NAME_HI);
	    ?>
		</div>
	   </div><!--End form-group-->
		
		<?php if($optstatus==1){ ?>
 		<div class="form-group">
		<label class="col-sm-3 control-label">Status <span class="red">*</span></label>
		<div class="col-sm-9 ">
		<?php $OPTIONS = array(''=>'--SELECT STATUS--','1'=>'ACTIVE','0'=>'INACTIVE');
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
			<a class="btn purple" href="<?php echo base_url('manage/Financialyear/'); ?>">Back</a>
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
		
	jQuery.validator.addMethod("validFinancialYear", function(value, element) {
		  return this.optional(element) || /^[0-9]{4}-[0-9]{2}$/.test(value);
	}, "Please enter financial year in valid format (Ex.2018-19).");

	jQuery( "#frmFinancialyear" ).validate({
		  rules: { 
		  financial_year: {
		        required: true,
		        validFinancialYear:true,
		        minlength:2,
		        maxlength:100
		    },
		    status:{
				required: true,
				digits: true
			}
		  }
		});	
		
	});//end dom
</script>