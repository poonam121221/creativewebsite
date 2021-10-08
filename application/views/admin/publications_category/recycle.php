<!-- BEGIN PAGE HEADER-->
<div class="row">
<div class="col-md-12">
	<ul class="page-breadcrumb breadcrumb">
		<li><i class="fa fa-home"></i><a href="<?php echo base_url('manage/Dashboard/index');?>">Home</a><i class="fa fa-angle-right"></i></li>
		<li><a href="<?php echo base_url('manage/publicationcategory'); ?>">Publication Category</a><i class="fa fa-angle-right"></i></li>
		<li><a href="javascript:void(0);">Recycle</a></li>
		<li class="btn-group">
		<button type="button" class="btn blue dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">
		<span>Actions</span><i class="fa fa-angle-down"></i>
		</button>
		<ul class="dropdown-menu pull-right" role="menu">
		<li><a href="<?php echo base_url('manage/publicationcategory/add'); ?>"><i class="fa fa-plus"></i> Add</a></li>
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
<!------------------------------------------------------------------- -->
<div class="row"><div class="col-lg-12">
<?php echo AlertMessage($this->session->flashdata('AppMessage'));?>
</div></div>
<!--End Validation message-->
<!-- BEGIN BORDERED TABLE PORTLET-->
<div class="portlet box blue">
<div class="portlet-title">
  <div class="caption">Publication Category List (Recycle)</div>
  <div class="tools"> <a href="javascript:;" class="collapse"> </a></div>
</div><!--End portlet-title-->
<div class="portlet-body">
  <div class="table-responsive">
     <table class="table table-striped table-bordered table-hover dataTable">
		<thead>
		<tr>
			<th width="5%">S.No.</th>
			<th width="40%">Category Name</th>
			<th width="10%">Updated By</th>
			<th width="10%">Created</th>
			<th width="10%">Updated</th>
			<th width="10%">Is Deleted</th>
			<th width="5%">Action</th>
		</tr>
		</thead>
		<tbody> 
	<?php 
	if(isset($DataList) && count($DataList)>0  && $DataList !=FALSE):
	$i = 1;
	foreach($DataList as $row):	
	?>                                           
	<tr>
		<td><?php echo $i; ?></td>
		<td><?php echo html_escape(ucwords($row['cat_title_en'])); ?></td>
	    <td><?php echo html_escape($row['edited_name']); ?></td>
		<td><?php echo get_date($row['added_date']); ?></td>
	    <td><?php echo get_date($row['edit_date']); ?></td>
	    <td><?php echo DeleteStatus(html_escape($row['is_delete'])); ?></td>
	    <td>
	    <?php $id = encrypt_decrypt('encrypt',$row['cat_id']); ?>
	    <a href="<?php echo base_url('manage/Publicationcategory/recycle_delete/'.$id.'/1'); ?>" class="btn default btn-xs red tooltips" onclick="return confirm('Are you sure to delete record permanently ?'); " data-placement="top" data-original-title="Permanently Delete">
	    <i class="fa fa-trash-o"></i> Permanently Delete</a>
	    <a href="<?php echo base_url('manage/Publicationcategory/recycle_delete/'.$id.'/0'); ?>" class="btn default btn-xs green tooltips" onclick="return confirm('Are you sure to restore this record?'); " data-placement="top" data-original-title="Restore">
	    <i class="fa fa-trash-o"></i> Restore</a>

	    </td>
   </tr>
	<?php 
	$i = $i+1;
	 endforeach; endif; 
	?>
	</tbody>
	</table>
	<div class="clearfix"></div>
  </div> <!--End table responsive--> 
</div><!-- End portlet-body -->
</div><!-- End BORDERED TABLE PORTLET-->
<!------------------------------------------------------------------- -->
</div><!--End column -->
</div><!--End row-->
<!-- END PAGE CONTENT-->
<script type="text/javascript">
	jQuery(function(){
		jQuery('.dataTable').dataTable();
	});
</script>