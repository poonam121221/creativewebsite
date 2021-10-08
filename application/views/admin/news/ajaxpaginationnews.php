<?php // get the data and pass it to your view
 $token_name = $this->security->get_csrf_token_name();
 $token_hash = $this->security->get_csrf_hash();
 echo form_input(array('type'  => 'hidden','id'=>'sysToken','name'=>$token_name,'value'=>$token_hash));
 $ajaxPagination = $this->ajax_pagination->create_links(); 
?>
     <table class="table table-striped box-table-a">
		<thead>
		<tr>
			<th width="5%">No</th>
			<th width="15%">Title (Hindi)</th>
			<th width="15%">Title (English)</th>
			<th width="5%">File</th>
			<th width="12%">Last Updated By</th>
			<th width="13%">Last Updated Date</th>
			<th width="5%">Status</th>
			<th width="6%">Is Alert</th>
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
		<td><input class="text-center" name="order_pref[]" type="text" onChange="location.replace('<?php echo base_url('manage/News/updatesrtorder/sid/').$id.'/sorder/'; ?>'+this.value+'')" value="<?php echo $row['order_preference']; ?>" size="1" style="width:25px;" /></td>
	    <td><?php echo html_escape($row['title_hi']); ?></td>
	    <td><?php echo html_escape($row['title_en']); ?></td>
	    <td>
	    <?php if(trim($row['attachment'])!=""): ?>
	    <a target="_blank" href="<?php echo base_url('uploads/files/'.$row['attachment']); ?>">
	    <i class="fa fa-download"></i></a>
	    <?php endif; ?>
	    </td>
	    <td><?php echo html_escape($row['admin_name']); ?></td>
	    <td><?php echo get_date(html_escape($row['added_date'])); ?></td>
	    <td><?php echo PublishStatus(html_escape($row['status'])); ?></td>
	    <td><?php echo ArchiveStatus(html_escape($row['is_alert'])); ?></td>
	    <td>
	    <a href="<?php echo base_url('manage/News/edit/'.$id.'/'); ?>" class="btn default btn-xs purple tooltips" data-toggle="tooltip" data-placement="top" title="" data-original-title="Update Data">
	    <i class="fa fa-edit"></i></a>
	    <a href="<?php echo base_url('manage/News/delete/'.$id.'/'); ?>" class="btn default btn-xs red tooltips" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Data" onclick="return confirm('Are you sure to delete record?'); ">
	    <i class="fa fa-trash-o"></i></a>
	    </td>
   </tr>
	<?php 
	 endforeach;
	 else:
	 echo '<tr class="text-center"><td colspan="9">Record not found</td></tr>';
	 endif; 
	?>
	</tbody>
	</table>
<div class="clearfix"></div>
<?php if(isset($ajaxPagination['output'])){ echo $ajaxPagination['output']; }?>