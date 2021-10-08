<!-- BEGIN PAGE HEADER-->
<div class="row">
<div class="col-md-12">
	<ul class="page-breadcrumb breadcrumb">
		<li><i class="fa fa-home"></i><a href="<?php echo base_url('manage/Dashboard/'); ?>">Home</a><i class="fa fa-angle-right"></i></li>
		<li><a href="<?php echo base_url('manage/News/'); ?>">News</a><i class="fa fa-angle-right"></i></li>
		<li><a href="javascript:void(0);">Recycle</a></li>
	</ul>
	<!-- END PAGE TITLE & BREADCRUMB-->
</div>
</div>
<!-- END PAGE HEADER-->
<!-- BEGIN PAGE CONTENT-->
<div class="row">
<div class="col-md-12">
<!------------------------------------------------------------------ -->
<div class="row"><div class="col-lg-12">
<?php echo AlertMessage($this->session->flashdata('AppMessage'));?>
</div></div>
<!--End Validation message-->
<!--start from layout-->

<div class="row">
<div class="col-md-12">
<div class="portlet box blue">
<div class="portlet-title">
  <div class="caption">News List (Recycle)</div>
  <div class="tools"> <a href="javascript:;" class="collapse"> </a></div>
</div><!--End portlet-title-->
<div class="portlet-body">

	<div class="table-responsive">
     <table id="example" class="table datatable table-bordered">
		<thead>
		<tr>
			<th width="3%">No</th>
			<th width="25%">Title</th>
			<th width="3%">File</th>
			<th width="10%">Updated By</th>
			<th width="8%">Created</th>
			<th width="8%">Updated</th>
			<th width="10%">Is Deleted</th>
			<th width="13%">Action</th>
		</tr>
		</thead>
		<tbody> 

	<?php 
	if(isset($DataList) && count($DataList)>0  && $DataList !=FALSE):
	$i =1;
	foreach($DataList as $row):	
	$id = encrypt_decrypt('encrypt',$row['id']);
	?>
	<tr>
		<td><?php echo $i; ?></td>
	    <td width="15%"><?php echo html_escape($row['title_en']); ?></td>
	    <td>
	    <?php if(trim($row['attachment'])!=""): ?>
	    <a target="_blank" href="<?php echo base_url('uploads/files/'.$row['attachment']); ?>"><i class="fa fa-download"></i></a>
	    <?php endif; ?>
	    </td>
	    <td><?php echo html_escape($row['edited_name']); ?></td>
		<td><?php echo get_date($row['added_date']); ?></td>
	    <td><?php echo get_date($row['edit_date']); ?></td>
	    <td><?php echo DeleteStatus(html_escape($row['is_delete'])); ?></td>
	    <td width="10%">
	    <a href="<?php echo base_url('manage/News/recycle_delete/'.$id.'/1'); ?>" class="btn default btn-xs red tooltips" onclick="return confirm('Are you sure to delete record permanently ?'); " data-placement="top" data-original-title="Permanently Delete">
	    <i class="fa fa-trash-o"></i> Delete</a>
	    <a href="<?php echo base_url('manage/News/recycle_delete/'.$id.'/0'); ?>" class="btn default btn-xs green tooltips" onclick="return confirm('Are you sure to restore this record?'); " data-placement="top" data-original-title="Restore">
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
    </div><!--End portlet body-->
    
</div>
</div><!--End row-->
<!--End from layout-->
<!------------------------------------------------------------------- -->
</div><!--End column -->
</div><!--End row-->
<!-- END PAGE CONTENT-->
<script type="text/javascript">
$(document).ready(function(){
	jQuery('.datatable').dataTable();
});//end dom
</script>