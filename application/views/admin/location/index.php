<!-- BEGIN PAGE HEADER-->
<div class="row">
<div class="col-md-12">
	<ul class="page-breadcrumb breadcrumb">
		<li><i class="fa fa-home"></i><a href="#">Home</a><i class="fa fa-angle-right"></i></li>
		<li><a href="<?php echo base_url('manage/Location'); ?>">Location</a><i class="fa fa-angle-right"></i></li>
		<li><a href="#">View</a></li>
		<li class="btn-group">
		<button type="button" class="btn blue dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">
		<span>Actions</span><i class="fa fa-angle-down"></i>
		</button>
		<ul class="dropdown-menu pull-right" role="menu">
		<li><a href="<?php echo base_url('manage/Location/add'); ?>"><i class="fa fa-plus"></i> Add</a></li>
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
  <div class="caption">Location List</div>
  <div class="tools"> <a href="javascript:;" class="collapse"> </a></div>
</div><!--End portlet-title-->
<div class="portlet-body">
  <div class="table-responsive">
     <table class="table table-striped table-bordered table-hover dataTable">
		<thead>
		<tr>
			<th width="5%">No.</th>
			<th width="25%">Location Name (Hindi)</th>
			<th width="25%">Location Name (English)</th>
			<th width="12%">Last Modified By</th>
			<th width="13%">Last Modified Date</th>
			<th width="10%">Status</th>
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
		<td><?php echo html_escape($row['location_name_hi']); ?></td>
		<td><?php echo html_escape(ucwords($row['location_name_en'])); ?></td>
		<td><?php echo getModifierName($row['admin_name'],$row['edited_name']); ?></td>
	    <td><?php echo getModifiedDate($row['added_date'],$row['edited_date']); ?></td>
	    <td><?php echo PublishStatus(html_escape($row['status'])); ?></td>
	    <td>
	    <?php 
	    $id = encrypt_decrypt('encrypt',$row['id']);
	    ?>
	    <a href="<?php echo base_url('manage/Location/edit/'.$id.'/'); ?>" class="btn default btn-xs purple tooltips" data-placement="top" data-original-title="Edit">
	    <i class="fa fa-edit"></i></a>
<?php /*?>	    <a href="<?php echo base_url('manage/Location/delete/'.$id.'/'); ?>" class="btn default btn-xs red tooltips" onclick="return confirm('Are you sure to delete record?'); " data-placement="top" data-original-title="Delete">
	    <i class="fa fa-trash-o"></i></a><?php */?>
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
		jQuery('.dataTable').dataTable({
    	   "columnDefs": [{ "targets": [0,3,4,5,6], "searchable": false, "orderable": false, "visible": true }] 
		});
	});
</script>