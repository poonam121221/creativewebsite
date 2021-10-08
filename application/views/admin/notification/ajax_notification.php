 <?php // get the data and pass it to your view
 $token_name = $this->security->get_csrf_token_name();
 $token_hash = $this->security->get_csrf_hash();
 echo form_input(array('type'  => 'hidden','id'=>'sysToken','name'=>$token_name,'value'=>$token_hash));
 $ajaxPagination = $this->ajax_pagination->create_links();
 ?>
<div class="table-responsive">
   <table class="table table-bordered">
    <thead>
     <tr>
	  <th>S.No.</th>
      <th>Message</th>
      <th>Status</th>
      <th>Created Date</th>
	</tr>
	</thead>
	<tbody>
	<?php 
	if(isset($DataList) && count($DataList)>0  && $DataList !=FALSE):
	$i = (isset($ajaxPagination['s_no']))?$ajaxPagination['s_no']:1;
	foreach($DataList as $row):	
	$id_enc = encrypt_decrypt('encrypt',$row->notification_id);
	?> 
	 <tr>
	  <td><?php echo $i; ?></td>
	  <td><?php echo html_escape($row->notification_msg); ?></td>
	  <td><?php echo ReadStatus((int)$row->is_unread); ?></td>
	  <td><?php echo get_date($row->created_date,'d-m-Y h:i:s'); ?></td>
	 </tr>
	<?php 
	$i = $i+1;
	 endforeach;
	 else:
	 echo '<tr class="text-center"><td colspan="6">'.$this->lang->line('record_not_found').'</td></tr>';
	 endif; 
	?>
	</tbody>
	</table>
</div><!--End table-responsive-->
<?php if(isset($ajaxPagination['output'])){ echo $ajaxPagination['output']; }?>