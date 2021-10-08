<!-- BEGIN PAGE HEADER-->
<div class="row">
<div class="col-md-12">
	<ul class="page-breadcrumb breadcrumb">
		<li><i class="fa fa-home"></i><a href="<?php echo base_url('manage/Dashboard/'); ?>">Home</a><i class="fa fa-angle-right"></i></li>
		<li><a href="<?php echo base_url('manage/Rti/'); ?>">Right to Information</a><i class="fa fa-angle-right"></i></li>
		<li><a href="javascript:void(0);">Recycle</a></li>
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
  <div class="caption">Right to Information List (Recycle)</div>
  <div class="tools"> <a href="javascript:;" class="collapse"> </a></div>
</div><!--End portlet-title-->
<div class="portlet-body">
  <div class="table-responsive">
 

     <table class="table table-striped table-bordered table-hover dataTable">
		<thead>
		<tr>
			<th width="3%">No.</th>
			<!--<th width="10%">Department</th>-->
			<th width="25%">Title</th>
			<th width="5%">File</th>
			<th width="10%">Updated By</th>
			<th width="8%">Created</th>
			<th width="8%">Updated</th>
			<th width="8%">Is Deleted</th>
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
		<!--<td><?php echo html_escape(ucwords($row['dept_title_en'])); ?></td>-->
		<td><?php echo html_escape(ucwords($row['title_en'])); ?></td>
	    <td>
	    <?php if(trim($row['attachment'])!=""): ?>
	    <a target="_blank" href="<?php echo base_url('uploads/files/'.$row['attachment']); ?>"><i class="fa fa-download"></i></a>
	    <?php endif; ?>
	    </td>
	    <td><?php echo html_escape($row['edited_name']); ?></td>
		<td><?php echo get_date($row['added_date']); ?></td>
	    <td><?php echo get_date($row['edit_date']); ?></td>
	    <td><?php echo DeleteStatus(html_escape($row['is_delete'])); ?></td>
	    <td>
	     <a href="<?php echo base_url('manage/Rti/recycle_delete/'.$id.'/1'); ?>" class="btn default btn-xs red tooltips" onclick="return confirm('Are you sure to delete record permanently ?'); " data-placement="top" data-original-title="Permanently Delete">
	    <i class="fa fa-trash-o"></i> Delete</a>
	    <a href="<?php echo base_url('manage/Rti/recycle_delete/'.$id.'/0'); ?>" class="btn default btn-xs green tooltips" onclick="return confirm('Are you sure to restore this record?'); " data-placement="top" data-original-title="Restore">
	    <i class="fa fa-trash-o"></i> Restore</a>
	    </td>
   </tr>
	<?php 
	$i++;
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