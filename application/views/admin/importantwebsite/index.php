<!-- BEGIN PAGE HEADER-->
<div class="row">
<div class="col-md-12">
	<ul class="page-breadcrumb breadcrumb">
		<li><i class="fa fa-home"></i><a href="<?php echo base_url('manage/Dashboard/'); ?>">Home</a><i class="fa fa-angle-right"></i></li>
		<li><a href="<?php echo base_url('manage/Importantwebsite/'); ?>">Important Website</a><i class="fa fa-angle-right"></i></li>
		<li><a href="javascript:void(0);">View</a></li>
		<li class="btn-group">
		<button type="button" class="btn blue dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">
		<span>Actions</span><i class="fa fa-angle-down"></i>
		</button>
		<ul class="dropdown-menu pull-right" role="menu">
		<li><a href="<?php echo base_url('manage/Importantwebsite/add'); ?>"><i class="fa fa-plus"></i> Add</a></li>
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
  <div class="caption">Important Website List</div>
  <div class="tools"> <a href="javascript:;" class="collapse"> </a></div>
</div><!--End portlet-title-->
<div class="portlet-body">
  <div class="table-responsive">
 

     <table class="table table-striped box-table-a dataTable">
		<thead>
		<tr>
			<th width="4%">No.</th>
			<th width="20%">Title (Hindi)</th>
			<th width="20%">Title (English)</th>
			<th width="5%">Url</th>
			<th width="5%">Image</th>
			<th width="15%">Last Modified By</th>
			<th width="15%">Last Modified Date</th>
			<th width="8%">Status</th>
			<th width="8%">Action</th>
		</tr>
		</thead>
		<tbody> 
	<?php 
	if(isset($DataList) && count($DataList)>0  && $DataList !=FALSE):
	foreach($DataList as $row):
	$id = encrypt_decrypt('encrypt',$row['id']);
	?>                                           
	<tr>
		<td><input class="text-center" name="order_pref[]" type="text" onChange="location.replace('<?php echo base_url('manage/Importantwebsite/updatesrtorder/sid/').$id.'/sorder/'; ?>'+this.value+'')" value="<?php echo $row['order_preference']; ?>" size="1" style="width:25px;" /></td>
		<td><?php echo html_escape($row['title_hi']); ?></td>
		<td><?php echo html_escape(ucwords(stripslashes2($row['title_en']))); ?></td>
	    <td><?php echo anchor(html_escape($row['url']),"<i class='fa fa-link'></i>",array('target'=>'_blank')); ?></td>
	    <td><?php
	    if(trim($row['attachment'])!="" && $row['attachment']!=NULL){
		  echo anchor("uploads/impweb/".html_escape($row['attachment']),"<i class='fa fa-picture-o'></i>",array('target'=>'_blank')); 
		}	     
	    ?></td>
	    <td><?php echo getModifierName($row['admin_name'],$row['edited_name']); ?></td>
	    <td><?php echo getModifiedDate($row['added_date'],$row['edit_date']); ?></td>
	    <td><?php echo PublishStatus(html_escape($row['status'])); ?></td>
	    <td>
	    <a href="<?php echo base_url('manage/Importantwebsite/edit/'.$id.'/'); ?>" class="btn default btn-xs purple tooltips" data-placement="top" data-original-title="Edit">
	    <i class="fa fa-edit"></i></a>
	    <a href="<?php echo base_url('manage/Importantwebsite/delete/'.$id.'/'); ?>" class="btn default btn-xs red tooltips" onclick="return confirm('Are you sure to delete record?'); " data-placement="top" data-original-title="Delete">
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
		jQuery('.dataTable').dataTable({
			"columnDefs": [
			    { "targets": [0,3,4,5,6,7,8], "searchable": false, "orderable": false, "visible": true }
		    ]
		});
	});
</script>