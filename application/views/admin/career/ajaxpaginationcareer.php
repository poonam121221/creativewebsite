 <?php // get the data and pass it to your view
 $token_name = $this->security->get_csrf_token_name();
 $token_hash = $this->security->get_csrf_hash();
 echo form_input(array('type'  => 'hidden','id'=>'sysToken','name'=>$token_name,'value'=>$token_hash));
 ?>
 <?php $ajaxPagination = $this->ajax_pagination->create_links(); ?>
 <table class="table table-striped box-table-a">
		<thead>
		<tr>
			<th width="3%">No.</th>
			<th width="15%">Title (Hindi)</th>
			<th width="15%">Title (English)</th>
          	<th width="15%">Issue Date</th>
			<th width="15%">Last Date</th>
			<th width="4%" class="text-center">File</th>
			<th width="6%">Status</th>
			<th width="8%">Action</th>
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
		<td><?php echo html_escape($row['title_hi']); ?></td>
		<td><?php echo html_escape(stripslashes2($row['title_en'])); ?></td>
  	    <td><?php echo get_date($row['issue_date']); ?></td>
   		<td><?php echo get_date($row['last_date']); ?></td>
	    <td class="text-center">
	    <?php if(trim($row['attachment'])!=""): ?>
	    <a target="_blank" href="<?php echo base_url('uploads/files/'.$row['attachment']); ?>"><i class="fa fa-download"></i></a>
	    <?php endif; ?>
	    </td>
	    <td><?php echo PublishStatus(html_escape($row['status'])); ?></td>
	    <td>
	    <a href="<?php echo base_url('manage/Career/edit/'.$id.'/'); ?>" class="btn default btn-xs purple tooltips" data-placement="top" data-original-title="Edit">
	    <i class="fa fa-edit"></i></a>
	    <a href="<?php echo base_url('manage/Career/delete/'.$id.'/'); ?>" class="btn default btn-xs red tooltips" onclick="return confirm('Are you sure to delete record?'); " data-placement="top" data-original-title="Delete">
	    <i class="fa fa-trash-o"></i></a>
	    </td>
   </tr>
	<?php 
	 endforeach;
	 else:
	 echo '<tr class="text-center"><td colspan="10">Record not found</td></tr>';
	 endif; 
	?>
	</tbody>
	</table>

<div class="clearfix"></div>
<?php if(isset($ajaxPagination['output'])){ echo $ajaxPagination['output']; }?>