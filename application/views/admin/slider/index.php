<!-- BEGIN PAGE HEADER-->
<div class="row">
<div class="col-md-12">
	<ul class="page-breadcrumb breadcrumb">
		<li><i class="fa fa-home"></i><a href="<?php echo base_url('manage/Dashboard/'); ?>">Home</a><i class="fa fa-angle-right"></i></li>
		<li><a href="<?php echo base_url('manage/Slider/'); ?>">Image Slider</a><i class="fa fa-angle-right"></i></li>
		<li><a href="javascript:void(0);">View</a></li>
		<li class="btn-group">
		<button type="button" class="btn blue dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">
		<span>Actions</span><i class="fa fa-angle-down"></i>
		</button>
		<ul class="dropdown-menu pull-right" role="menu">
		<li><a href="<?php echo base_url('manage/Slider/add/cid/').encrypt_decrypt('encrypt',1); ?>"><i class="fa fa-plus"></i> Add Home Slider</a></li>
		<li><a href="<?php echo base_url('manage/Slider/add/cid/').encrypt_decrypt('encrypt',2); ?>"><i class="fa fa-plus"></i> Add Bottom Slider</a></li>
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
  <div class="caption">Image Slider List</div>
  <div class="tools"> <a href="javascript:;" class="collapse"> </a></div>
</div><!--End portlet-title-->
<div class="portlet-body">
  <div class="table-responsive">
 

     <table class="table table-striped table-bordered table-hover dataTable">
		<thead>
		<tr>
			<th width="4%">No.</th>
			<th width="15%">Title (Hindi)</th>
			<th width="15%">Title (English)</th>
			<th width="10%">Attachments</th>
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
	?>                                           
	<tr>
		<td><?php echo $i; ?></td>
		<td><?php echo html_escape($row['title_hi']); ?></td>
		<td><?php echo html_escape(ucwords($row['title_en'])); ?></td>
	    <td>
	    <div class="fileinput fileinput-new" data-provides="fileinput">
		<div class="ffileinput-new thumbnail" style="max-width: 200px; max-height: 150px;">
	    <?php 
 		$image_properties = array(
        'src'   => 'uploads/slider/'.html_escape($row['attachment']),
        'alt'   => $row['attachment'],
        'class' => 'post_images',
        'width' => '100',
        'height'=> '100',
        'title' => $row['title_en'],
        'rel'   => ''
		);
 		 echo img($image_properties);
		?>
		</div><!--End fileinput-new-->
 		</div><!--End fileinput-->	
		</td>
	    <td><?php echo getModifierName($row['admin_name'],$row['edited_name']); ?></td>
	    <td><?php echo getModifiedDate($row['added_date'],$row['edit_date']); ?></td>
	    <td><?php echo PublishStatus(html_escape($row['status'])); ?></td>
	    <td>
	    <?php 
	    $id = encrypt_decrypt('encrypt',$row['id']);
	    ?>
	    <a href="<?php echo base_url('manage/Slider/edit/'.$id.'/'); ?>" class="btn default btn-xs purple tooltips" data-placement="top" data-original-title="Edit">
	    <i class="fa fa-edit"></i></a>
	    <a href="<?php echo base_url('manage/Slider/delete/'.$id.'/'); ?>" class="btn default btn-xs red tooltips" onclick="return confirm('Are you sure to delete record?'); " data-placement="top" data-original-title="Delete">
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