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
	  <th>Subject</th>
      <th>To</th>  
	  <!--<th>User Type</th>     -->
      <th>Query Type</th>
      <th>Received</th>
      <th>Action</th>
     
	</tr>
	</thead>
	<tbody>  
	<?php 
	if(isset($DataList) && count($DataList)>0  && $DataList !=FALSE):
	$i = (isset($ajaxPagination['s_no']))?$ajaxPagination['s_no']:1;
	foreach($DataList as $row):	
	
/*	if($row->comm_user_type == 11){$user_type = 'Company';}
	elseif($row->comm_user_type == 12){$user_type = 'Individual User';}
	elseif($row->comm_user_type == 13){$user_type = 'Implementation Partner';}	
	else{$user_type = $row->upm_name;}*/
	
	 $this->__id = encrypt_decrypt('encrypt',$row->comm_id);
	?> 
	 <tr>
	  <td><?php echo html_escape($row->comm_subject); ?></td>
	  <td><?php echo html_escape(ucwords($row->to_name)); ?></td>
	 <!-- <td><?php //echo html_escape($user_type); ?></td> -->
	  <td><?php echo html_escape($row->query_name); ?></td>
	  <td><?php echo html_escape($row->comm_add_date); ?></td>
	  <td>
		<a href="<?php echo base_url('user/communication-view/').$this->__id; ?>" class="btn-view" data-toggle="tooltip" title="View"><em class="fa fa-eye"></em></a> 
	 </td>
	 </tr>
	<?php 
	$i = $i+1;
	 endforeach;
	 else:
	 echo '<tr class="text-center"><td colspan="8">'.$this->lang->line('record_not_found').'</td></tr>';
	 endif; 
	?>
	</tbody>
	</table>
</div><!--End table-responsive-->
<?php if(isset($ajaxPagination['output'])){ echo $ajaxPagination['output']; }?>