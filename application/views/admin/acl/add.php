<!-- BEGIN PAGE HEADER-->
<div class="row">
<div class="col-md-12">
	<ul class="page-breadcrumb breadcrumb">
		<li><i class="fa fa-home"></i><a href="<?php echo base_url('manage/Dashboard/'); ?>">Home</a><i class="fa fa-angle-right"></i></li>
		<li><a href="<?php echo base_url('manage/Acl/'); ?>">Acl</a><i class="fa fa-angle-right"></i></li>
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
  <div class="caption">User ACL</div>
  <div class="tools"> <a href="javascript:;" class="collapse"> </a></div>
</div><!--End portlet-title-->
<div class="portlet-body">
<!--------------------------------------------------------------------------->
<div class="row"><div class="col-lg-12">
<?php echo AlertMessage($this->session->flashdata('AppMessage'));?>
</div></div>
<!--End Validation message-->
<?php
$atr2 =array('id'=>'frmAcl','name'=>'frmAcl','class'=>'form-horizontal','role'=>'form', 'autocomplete'=>'off');
echo form_open('manage/Acl/add',$atr2); 

?>
 <div class="form-body">
 
 		<div class="form-group">
		<label class="col-sm-12">Privilege Name <span class="red">*</span></label>
		<div class="col-sm-12">
		<?php 
		echo form_dropdown(array('name'=>'pid','id'=>'pid','class'=>'form-control'),
		isset($PrivilegeList)?$PrivilegeList:array(''=>'--SELECT PRIVILEGE--'),isset($UserPrivilegeList->priviledge_id) ? ($UserPrivilegeList->priviledge_id):set_value('pid'));
		?>
		</div>
		</div><!--End form-group-->
 
 		<div class="form-group">
		<label class="col-sm-12 ">Controller <span class="red">*</span></label>
		<div class="col-sm-12">
		<?php 
			echo form_dropdown(array('name'=>'menu_id','id'=>'menu_id','class'=>'form-control'),
			isset($ControllerList)?$ControllerList:array(''=>'--SELECT CONTROLLER--'),isset($UserPrivilegeList->menu_id) ? ($UserPrivilegeList->menu_id):'');
		?>
		</div>
	    </div><!--End form-group-->

 		<div class="form-group">
		<label class="col-sm-12 ">Function List</label>
		<div class="col-sm-12">
		<div class="form-control" id="functionList">	
		</div>		
		</div>
	   </div><!--End form-group-->
	   
	   <div class="form-group">
		<label class="col-sm-12 ">Status <span class="red">*</span></label>
		<div class="col-sm-12">
		<?php $STATUS = array('1'=>'Publish','0'=>'Pending');
		echo form_dropdown('status', $STATUS, (isset($UserPrivilegeList->status) && $UserPrivilegeList->status !='' )?
         html_escape($UserPrivilegeList->status):set_value('status'),array('class'=> 'form-control input-medium'));
	    ?>
		</div>
	   </div><!--End form-group-->

 	 <div class="form-group">
		<label class="col-sm-12 "></label>
		<div class="col-sm-12">
			<button type="submit" class="btn green">Submit</button>
			<button type="reset" class="btn blue">Clear</button>
			<a class="btn purple" href="<?php echo base_url('manage/Acl/'); ?>">Back</a>
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
		
	jQuery.validator.addMethod("alphanumspace", function(value, element) {
		  return this.optional(element) || /^[a-zA-Z0-9\s]*$/.test(value);
	}, "Please enter character, number and space only.");

	jQuery( "#frmAcl" ).validate({
		  rules: { 
		  pid:{
		  		required: true,
		  		digits:true
		  }, 
		  menu_id:{
		  		required: true,
		  		digits:true
		  },
		  status:{
				required: true,
		  		digits:true
		 }
		}
	   });	
	});
</script>

<script type="text/javascript">

	function isNormalInteger(str) {
    	return /^\+?(0|[1-9]\d*)$/.test(str);
	}

	$(function(){
		//Menu Type Change Event
		$('#menu_id').change(function(){
			
			var id = $(this).val();
			var dataString = {'id':id};
				
			   if(id!="" && isNormalInteger(id)==true){

			   	$('#ajaxloading').modal('show');		   	
			   	
				$.ajax({
					type: "POST",
		            url: '<?php echo base_url("Ajaxmaster/getAuthFunctionList/"); ?>',
		            data: dataString,
		            cache : false,
		            success: function(data){
		              $('#functionList').html(data);
		              $('#ajaxloading').modal('hide');
		            },error: function(xhr, status, error) {
		              console.log(error);
		              $('#ajaxloading').modal('hide');
		            }
				});//end ajax
				
			   }//check id

		});//end Menu Type change event
	});//end dom
</script>