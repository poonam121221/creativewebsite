<!-- START BREADCRUMB -->
<div class="row">
<div class="col-lg-12">
<ul class="page-breadcrumb breadcrumb">
		<li><i class="fa fa-home"></i><a href="<?php echo base_url('manage/Dashboard/'); ?>">Home</a><i class="fa fa-angle-right"></i></li>
		<li><a href="<?php echo base_url('manage/Social/'); ?>">Social Link </a><i class="fa fa-angle-right"></i></li>
		<li><a href="javascript:void(0);">View & Add/Update</a></li>
	</ul>
</div><!--End column-->
</div><!--End row-->
<!-- END BREADCRUMB -->
<div class="row">
<div class="col-lg-12">
  <?php if($this->session->flashdata('successUpdate')):?>
			 <div class="alert alert-success fade in">
			 <button type="button" class="close close-sm" data-dismiss="alert">
			 <i class="fa fa-times"></i></button>
			 <?php echo $this->session->flashdata('successUpdate');?>
			 </div><?php endif; ?>
			 <?php echo $this->session->flashdata('errorMsg');?>
   <?php echo validation_errors(); ?>	
</div><!--End column-->
</div><!--End row-->
<!--End Validation message-->
<!-- START RESPONSIVE TABLES -->
<div class="row">
<div class="col-md-12">
<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title">Social Link</h3>
	</div><!--End panel-heading-->
	<div class="panel-body">
	<?php

	$atr =array('id'=>'frmupdatesocial','name'=>'frmupdatesocial','role'=>'form', 'autocomplete'=>'off','class'=>'form-horizontal');

   		echo form_open('manage/Social/updateRecord',$atr); 

 		if(isset($get_Record) && count($get_Record)>0 && $get_Record!=FALSE):
		foreach($get_Record as $get_list) : ?>
         <div class="form-group">
	     <input type="hidden" name="id[]" value="<?php echo $get_list->id;?>"/>
         <label class="col-md-3 col-sm-2"><?php echo html_escape($get_list->name);?></label>
         <div class="col-md-7 col-sm-10">
         <input type="text" name="slink[]" class="form-control" value="<?php echo html_escape($get_list->link);?>" placeholder="Enter your social Link here">
         </div>
         </div>
<?php  
	   endforeach;
	   endif; 
?>
         <div class="form-group">
		 <label class="col-md-3 col-sm-2 ">&nbsp;</label>
         <div class="col-md-7 col-sm-10">
         <input  type="submit" class="btn btn-primary btn-rounded" value="submit" name="Update" />
         </div>
</div>
<?php	   
	   echo form_close();
?>                        
    </div><!--End panel-body-->
</div><!--End panel-info-->                                                
</div><!--End column-->
</div><!--End row-->
<!-- END RESPONSIVE TABLES -->