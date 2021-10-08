<!-- BEGIN PAGE HEADER-->
<div class="row">
<div class="col-md-12">
	<ul class="page-breadcrumb breadcrumb">
		<li><i class="fa fa-home"></i><a href="<?php echo base_url('manage/Dashboard/'); ?>">Home</a><i class="fa fa-angle-right"></i></li>
		<li><a href="<?php echo base_url('manage/Messageboard/'); ?>">Message Board</a><i class="fa fa-angle-right"></i></li>
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
  <div class="caption">Message Board List (Recycle)</div>
  <div class="tools"> <a href="javascript:;" class="collapse"> </a></div>
</div><!--End portlet-title-->
<div class="portlet-body">
  <div class="table-responsive">
 

     <table class="table table-striped table-bordered table-hover dataTable">
		<thead>
		<tr>
			<th width="4%">No.</th>
			<th width="16%">Name</th>
			<th width="10%">Photo</th>
			<th>Updated By</th>
			<th>Created</th>
			<th>Updated</th>
			<th>Is Deleted</th>
			<th width="8%">Action</th>
		</tr>
		</thead>
		<tbody> 
	<?php 
	if(isset($DataList) && count($DataList)>0  && $DataList !=FALSE):
	$i = 1;
	foreach($DataList as $row):
	$id = encrypt_decrypt('encrypt',$row['id']);
	?>                                           
	<tr>
		<td><?php echo $i; ?></td>
		<td><?php echo html_escape(ucwords($row['title_en'])); ?></td>
	    <td>
	     <?php
 		$image_properties = array(
        'src'   => (isset($row['attachment']) && trim($row['attachment'])!="")? 'uploads/files/'.html_escape($row['attachment']):'assets/img/user_img.jpg',
        'alt'   => 'Photo',
        'width' => '100',
        'height'=> '100',
        'title' => 'Photo'
		);
 		 echo img($image_properties);
 		 ?>
	    </td>
	    <td><?php echo html_escape($row['edited_name']); ?></td>
		<td><?php echo get_date($row['added_date']); ?></td>
	    <td><?php echo get_date($row['edit_date']); ?></td>
	    <td><?php echo DeleteStatus(html_escape($row['is_delete'])); ?></td>
	    <td>
	     <a href="<?php echo base_url('manage/Messageboard/recycle_delete/'.$id.'/1'); ?>" class="btn default btn-xs red tooltips" onclick="return confirm('Are you sure to delete record permanently ?'); " data-placement="top" data-original-title="Permanently Delete">
	    <i class="fa fa-trash-o"></i> Delete</a>
	    <a href="<?php echo base_url('manage/Messageboard/recycle_delete/'.$id.'/0'); ?>" class="btn default btn-xs green tooltips" onclick="return confirm('Are you sure to restore this record?'); " data-placement="top" data-original-title="Restore">
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