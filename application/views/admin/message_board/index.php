<!-- BEGIN PAGE HEADER-->
<div class="row">
<div class="col-md-12">
	<ul class="page-breadcrumb breadcrumb">
		<li><i class="fa fa-home"></i><a href="<?php echo base_url('manage/Dashboard/'); ?>">Home</a><i class="fa fa-angle-right"></i></li>
		<li><a href="<?php echo base_url('manage/Messageboard/'); ?>">Message Board</a><i class="fa fa-angle-right"></i></li>
		<li><a href="javascript:void(0);">View</a></li>
		<li class="btn-group">
		<button type="button" class="btn blue dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">
		<span>Actions</span><i class="fa fa-angle-down"></i>
		</button>
		<ul class="dropdown-menu pull-right" role="menu">
		<li><a href="<?php echo base_url('manage/Messageboard/add'); ?>"><i class="fa fa-plus"></i> Add</a></li>
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
  <div class="caption">Message Board List</div>
  <div class="tools"> <a href="javascript:;" class="collapse"> </a></div>
</div><!--End portlet-title-->
<div class="portlet-body">
  <div class="table-responsive">
 

     <table class="table table-striped table-bordered table-hover dataTable">
		<thead>
		<tr>
			<th width="4%">No.</th>
			<th width="16%">Name (Hindi)</th>
			<th width="16%">Name (English)</th>
			<th width="10%">Photo</th>
			<th width="12%">Last Modified By</th>
			<th width="12%">Last Modified Date</th>
			<th width="8%">Status</th>
			<th width="8%">Action</th>
		</tr>
		</thead>
		<tbody> 
	<?php 
	if(isset($DataList) && count($DataList)>0  && $DataList !=FALSE):
	$i = 0;
	foreach($DataList as $row):	$i++;
	$id = encrypt_decrypt('encrypt',$row['id']);
	?>                                           
	<tr>
	<td><input class="text-center" name="order_pref[]" type="text" onChange="location.replace('<?php echo base_url('manage/Messageboard/updatesrtorder/sid/').$id.'/sorder/'; ?>'+this.value+'')" value="<?php echo $row['order_preference']; ?>" size="1" style="width:25px;" /></td>
		<td><?php echo html_escape($row['title_hi']); ?></td>
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
	    <td><?php echo getModifierName($row['admin_name'],$row['edited_name']); ?></td>
	    <td><?php echo getModifiedDate($row['added_date'],$row['edit_date']); ?></td>
	    <td><?php echo PublishStatus(html_escape($row['status'])); ?></td>
	    <td>
	    <?php 
	    $id = encrypt_decrypt('encrypt',$row['id']);
	    ?>
	    <a href="<?php echo base_url('manage/Messageboard/edit/'.$id.'/'); ?>" class="btn default btn-xs purple tooltips" data-placement="top" data-original-title="Edit">
	    <i class="fa fa-edit"></i></a>
	    <a href="<?php echo base_url('manage/Messageboard/delete/'.$id.'/'); ?>" class="btn default btn-xs red tooltips" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Data" onclick="return confirm('Are you sure to delete record?'); ">
	    <i class="fa fa-trash-o"></i></a>
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