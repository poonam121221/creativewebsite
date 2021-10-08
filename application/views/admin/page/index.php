<!-- BEGIN PAGE HEADER-->
<div class="row">
<div class="col-md-12">
	<ul class="page-breadcrumb breadcrumb">
		<li><i class="fa fa-home"></i><a href="<?php echo base_url('manage/Dashboard/'); ?>">Home</a><i class="fa fa-angle-right"></i></li>
		<li><a href="<?php echo base_url('manage/Page/'); ?>">Page</a><i class="fa fa-angle-right"></i></li>
		<li><a href="javascript:void(0);">View</a></li>
		<li class="btn-group">
		<button type="button" class="btn blue dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">
		<span>Actions</span><i class="fa fa-angle-down"></i>
		</button>
		<ul class="dropdown-menu pull-right" role="menu">
		<li><a href="<?php echo base_url('manage/Page/add'); ?>"><i class="fa fa-plus"></i> Add</a></li>
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
  <div class="caption">View Page</div>
  <div class="tools"> <a href="javascript:;" class="collapse"> </a></div>
</div><!--End portlet-title-->
<div class="portlet-body">

	<div class="table-responsive">
     <table id="datatable" class="table table-bordered">
		<thead>
		<tr>
			<th width="5%">No</th>
			<th width="25%">Title (Hindi)</th>
			<th width="25%">Title (English)</th>
			<th width="10%">Last Updated By</th>
			<th width="10%">Last Updated Date</th>
			<th width="5%">Status</th>
			<th width="5%">Is Delete</th>
			<th width="5%">Is Default</th>
			<th width="10%">Action</th>
		</tr>
		</thead>
		<tbody> 

	<?php 
	if(isset($PageList) && count($PageList)>0  && $PageList !=FALSE):
	$i = 0;
	foreach($PageList as $row):
	$i++;		
	?>                                           

	<tr>
		<td><?php echo $i; ?></td>
	    <td><?php echo html_escape($row['page_title_hi']); ?></td>
	    <td><?php echo html_escape(stripslashes2($row['page_title_en'])); ?></td>
	    <td><?php echo html_escape($row['admin_name']); ?></td>
	    <td><?php echo get_date(html_escape($row['page_added_date'])); ?></td>
	    <td><?php echo PublishStatus(html_escape($row['page_status'])); ?></td>
	    <td><?php echo DefaultStatus(html_escape($row['is_delete'])); ?></td>
	    <td><?php echo DefaultStatus(html_escape($row['is_default'])); ?></td>
	    <td>
	    <?php 
	    $id = encrypt_decrypt('encrypt',$row['page_id']);
	    ?>
	    <a href="<?php echo base_url('manage/Page/edit/'.$id.'/'); ?>" class="btn default btn-xs purple tooltips" data-toggle="tooltip" data-placement="top" title="" data-original-title="Update Data">
	    <i class="fa fa-edit"></i></a>
	    
	    <a href="<?php echo base_url('manage/Page/page_default/'.$id.'/'); ?>" class="btn default btn-xs green tooltips" data-toggle="tooltip" data-placement="top" title="" data-original-title="Update Default Page" onclick="return confirm('Are you sure to update default page ?'); ">
	    <i class="fa fa-thumbs-up"></i></a>
	    
	    <a href="<?php echo base_url('manage/Page/delete/'.$id.'/'); ?>" class="btn default btn-xs red tooltips" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Data" onclick="return confirm('Are you sure to delete record?'); ">
	    <i class="fa fa-trash-o"></i></a>
	    </td>
   </tr>
	<?php 
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
	jQuery('#datatable').dataTable({
	  "columnDefs": [
	    { "width": "5%", "targets": 0 },
	    { "width": "25%", "targets": 1 },
	    { "width": "25%", "targets": 2 },
	    { "width": "10%", "targets": 3 },
	    { "width": "10%", "targets": 4 },
	    { "width": "10%", "targets": 5 },
	    { "width": "5%", "targets": 6 },
	    { "width": "10%", "targets": 7 }
	  ]
	} );
});//end dom
</script>