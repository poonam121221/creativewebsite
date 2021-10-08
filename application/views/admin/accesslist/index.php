<!-- BEGIN PAGE HEADER-->
<div class="row">
<div class="col-md-12">
	<ul class="page-breadcrumb breadcrumb">
		<li><i class="fa fa-home"></i><a href="<?php echo base_url('manage/Dashboard/'); ?>">Home</a><i class="fa fa-angle-right"></i></li>
		<li><a href="<?php echo base_url('manage/Accesslist/'); ?>">Accesslist</a><i class="fa fa-angle-right"></i></li>
		<li><a href="javascript:void(0);">View</a></li>
		<li class="btn-group">
		<button type="button" class="btn blue dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">
		<span>Actions</span><i class="fa fa-angle-down"></i>
		</button>
		<ul class="dropdown-menu pull-right" role="menu">
		<li><a href="<?php echo base_url('manage/Accesslist/add'); ?>"><i class="fa fa-plus"></i> Add</a></li>
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
	<div class="row">
     <div class="col-lg-12"><?php echo AlertMessage($this->session->flashdata('AppMessage'));?></div>
	</div><!--End Validation message-->
	
<!-- BEGIN BORDERED TABLE PORTLET-->
<div class="portlet box blue">
<div class="portlet-title">
  <div class="caption">Access List</div>
  <div class="tools"> <a href="javascript:;" class="collapse"> </a></div>
</div><!--End portlet-title-->
<div class="portlet-body">
	<!---------------------------------------------------------------------------->
	
	<div class="table-responsive">
     <table class="table table-striped table-bordered table-hover dataTable">
		<thead>
		<tr>
			<th width="5%">No.</th>
			<th width="15%">Title</th>
			<th width="10%">Controller</th>
			<th width="40%">Function</th>
			<th width="10%">Created</th>
			<th width="10%">Status</th>
			<th width="10%">Action</th>
		</tr>
		</thead>
		<tbody> 
	<?php 
	if(isset($DataList) && count($DataList)>0  && $DataList !=FALSE){
	$i= 1;
	foreach($DataList as $row){	
	?>                                           
	<tr>
		<td><?php echo $i; ?></td>
		<td><?php echo html_escape($row['controller_title']); ?></td>
		<td><?php echo html_escape($row['controller_name']); ?></td>
		<td><?php echo html_escape($row['auth_function_name']); ?></td>
		<td><?php echo html_escape(ucwords($row['admin_name'])); ?></td>
		<td><?php echo DisplayStatus(html_escape($row['status'])); ?></td>
		<td>
	    <?php 
	    $id = encrypt_decrypt('encrypt',$row['id']);
	    ?>
	    
	    <a href="<?php echo base_url('manage/Accesslist/edit/'.$id.'/'); ?>" class="btn default btn-xs green tooltips" data-placement="top" data-original-title="Edit">
	    <i class="fa fa-edit"></i></a>
	    <a href="<?php echo base_url('manage/Accesslist/delete/'.$id.'/'); ?>" class="btn default btn-xs red tooltips" onclick="return confirm('Are you sure to delete record?'); " data-placement="top" data-original-title="Delete">
	    <i class="fa fa-trash-o"></i></a>
	    </td>
   </tr>
	<?php 
	$i = $i+1;
	 }//end foreach
	}
	?>
	</tbody>
	</table>
	<div class="clearfix"></div>
	</div><!--table-responsive-->
	
	<!---------------------------------------------------------------------------->
	</div><!-- End portlet-body -->
</div><!-- End BORDERED TABLE PORTLET-->
	
	</div><!--End column12-->
</div><!--End row-->
<!-- END PAGE CONTENT-->
<script type="text/javascript">
	jQuery(function(){
		jQuery('.dataTable').dataTable();
	});
</script>		