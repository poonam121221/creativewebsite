 <?php // get the data and pass it to your view
 $token_name = $this->security->get_csrf_token_name();
 $token_hash = $this->security->get_csrf_hash();
 echo form_input(array('type'  => 'hidden','id'=>'sysToken','name'=>$token_name,'value'=>$token_hash));
 ?>
 <?php $ajaxPagination = $this->ajax_pagination->create_links(); ?>
 <table class="table table-striped table-bordered table-hover dataTable">
		<thead>
		<tr>
			<th width="3%">No.</th>
			<th width="15%">Category</th>
			<th width="15%">Title</th>
			<th width="5%" class="text-center">File</th>
			<th width="10%">Updated By</th>
			<th width="8%">Created</th>
			<th width="8%">Updated</th>
			<th width="4%">Deleted</th>
			<th width="18%">Action</th>
		</tr>
		</thead>
		<tbody> 
	<?php 
	if(isset($DataList) && count($DataList)>0  && $DataList !=FALSE):
	$i = (isset($ajaxPagination['s_no']))?$ajaxPagination['s_no']:1;
	foreach($DataList as $row):	
	$id = encrypt_decrypt('encrypt',$row['id']);
	?>                                           
	<tr>
		<td><?php echo $i; ?></td>
		<td><?php echo html_escape(ucwords($row['cat_title_en'])); ?></td>
		<td><?php echo html_escape(ucwords($row['title_en'])); ?></td>
	    <td class="text-center">
	    <?php if(trim($row['attachment'])!=""): ?>
	    <a target="_blank" href="<?php echo base_url('uploads/files/'.$row['attachment']); ?>"><i class="fa fa-download"></i></a>
	    <?php endif; ?>
	    </td>
	    <td><?php echo html_escape($row['edited_name']); ?></td>
		<td><?php echo get_date($row['added_date']); ?></td>
	    <td><?php echo get_date($row['edit_date']); ?></td>
	    <td><?php echo DeleteStatus(html_escape($row['is_delete'])); ?></td>
	    <td>
	    <a href="<?php echo base_url('manage/Circular/recycle_delete/'.$id.'/1'); ?>" class="btn default btn-xs red tooltips" onclick="return confirm('Are you sure to delete record permanently ?'); " data-placement="top" data-original-title="Permanently Delete">
	    <i class="fa fa-trash-o"></i> Permanently Delete</a>
	    <a href="<?php echo base_url('manage/Circular/recycle_delete/'.$id.'/0'); ?>" class="btn default btn-xs green tooltips" onclick="return confirm('Are you sure to restore this record?'); " data-placement="top" data-original-title="Restore">
	    <i class="fa fa-trash-o"></i> Restore</a>
	    </td>
   </tr>
	<?php 
	$i = $i+1;
	 endforeach;
	 else:
	 echo '<tr class="text-center"><td colspan="10">Record not found</td></tr>';
	 endif; 
	?>
	</tbody>
	</table>

<div class="clearfix"></div>
<?php if(isset($ajaxPagination['output'])){ echo $ajaxPagination['output']; }?>