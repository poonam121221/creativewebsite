<!-- BEGIN PAGE HEADER-->
<div class="row">
<div class="col-md-12">
	<ul class="page-breadcrumb breadcrumb">
		<li><i class="fa fa-home"></i><a href="<?php echo base_url('manage/Dashboard/'); ?>">Home</a><i class="fa fa-angle-right"></i></li>
		<li><a href="<?php echo base_url('manage/Acl/'); ?>">User Access List</a><i class="fa fa-angle-right"></i></li>
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
  <div class="caption">Update User Access List</div>
  <div class="tools"> <a href="javascript:;" class="collapse"> </a></div>
</div><!--End portlet-title-->
<div class="portlet-body">
<!--------------------------------------------------------------------------->
<div class="row"><div class="col-lg-12">
<?php echo AlertMessage($this->session->flashdata('AppMessage'));?>
</div></div>
<!--End Validation message-->
<?php
if((isset($UserPrivilegeList) && is_object($UserPrivilegeList))){
	$button = "Submit";
	$auth_id = encrypt_decrypt('encrypt',$UserPrivilegeList->auth_id);
}else{
	$button = "Update";
	$auth_id = '';
}

$hidden = array('id' => html_escape(isset($UserPrivilegeList->auth_id)? encrypt_decrypt('encrypt',$UserPrivilegeList->auth_id):''));
$atr2 =array('id'=>'frmAcl','name'=>'frmAcl','class'=>'form-horizontal','role'=>'form', 'autocomplete'=>'off');
echo form_open_multipart('manage/Acl/edit',$atr2,$hidden); 

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
		<label class="col-sm-12 ">Function List </label>
		<div class="col-sm-12">
		<div class="form-control">
		<?php
		  $function_acl = "";
		  $acl_array = array();
		  
		  if(isset($DataList->auth_function_name)==TRUE){
		  	
		  	$function_acl = $DataList->auth_function_name;	
		  	$acl_array = explode(',',$function_acl);
		  	$privilegeAclArray = (isset($UserPrivilegeList) && is_object($UserPrivilegeList)) ? explode(',',$UserPrivilegeList->auth_function):array();
		  	
		  	if(count($acl_array)>0){

			  foreach($acl_array as $val){
			  	
			  if(in_array(trim($val),$privilegeAclArray)){
			  	$checked = " checked='checked' ";
			  }else{
			  	$checked = "";
			  }
		?>
			<label><?php echo $val;?> <input type="checkbox" name="function_name[]" <?php echo $checked; ?>  value="<?php echo $val;?>"/></label>   
		<?php	
			  }//end foreach
			}//end if
		  }//end isset
		?>
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
			<button type="submit" class="btn green">Update</button>
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