<?php // get the data and pass it to your view
 $token_name = $this->security->get_csrf_token_name();
 $token_hash = $this->security->get_csrf_hash();
 echo form_input(array('type'  => 'hidden','id'=>'sysToken','name'=>$token_name,'value'=>$token_hash));
 $ajaxPagination = $this->ajax_pagination->create_links(); 
?>
 <table class="table table-striped box-table-a">
		<thead>
		<tr>
			<th width="3%">No.</th>
			<th width="15%">FoMP ID</th>
			<th width="15%">Member Name</th>						
			<th width="10%">Father / Husband</th>
			<th width="10%">Chapter Name</th>
			<th width="15%">Email</th>
			<th width="15%">Mobile</th>
			<th width="10%">Created Date</th>
			<th width="5%">Status</th>
			<th width="5%">Action</th>
		</tr>
		</thead>
		<tbody> 
	<?php 
	if(isset($DataList) && count($DataList)>0  && $DataList !=FALSE):
	$i = (isset($ajaxPagination['s_no']))?$ajaxPagination['s_no']:1;
	foreach($DataList as $row):	
	$id = encrypt_decrypt('encrypt',$row['user_id']);
	?>                                           
	<tr>
		<td><?php echo $i; ?></td>
		<td><?php echo html_escape($row['fomp_id']); ?></td>
		<td><?php echo html_escape($row['user_fname']); ?></td>		
		<td><?php echo html_escape($row['user_father_or_husband']); ?></td>
		<td>
		<?php 
		$chapter_id = encrypt_decrypt('encrypt',$row['chapter_id']);
		if($row['chapter_id']!=0){  ?>
		  <a class="showLink" target="_blank" href="<?php echo base_url('manage/Chapter/edit/'.$chapter_id); ?>">
		  <?php echo html_escape($row['chapter_name']); ?>		  	
		  </a>
		<?php }//end check chapter id ?>
		</td>
		<td><?php echo html_escape($row['user_email']); ?></td>
		<td><?php echo chkEmptyNonZero(html_escape($row['mobile_isd']),TRUE).' '.chkEmptyNonZero(html_escape($row['user_mobile'])); ?></td>
		<td><?php echo get_date($row['add_date']); ?></td>
		<td><?php echo MemberStatus($row['user_step'],$row['user_status']); ?></td>
		<td>
	    <a href="<?php echo base_url('manage/Member/edit/'.$id.'/'); ?>" class="btn default btn-xs purple tooltips" data-placement="top" data-original-title="Edit">
	    <i class="fa fa-edit"></i></a>
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