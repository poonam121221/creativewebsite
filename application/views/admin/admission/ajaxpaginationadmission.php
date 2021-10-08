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
			<th width="10%">User Name</th>
			<th width="20%">Email</th>
			<th width="20%">Enrolment Number</th>
			<th width="20%">Mobile</th>
			<th width="5%">Status</th>
			<th width="10%">View</th>
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
		<td><?php echo $i;?></td>
		<td><?php echo html_escape(ucwords($row['user_fname'].' '.$row['user_lname'])); ?></td>
		<td><?php echo html_escape($row['user_email']); ?></td>
		<td><?php echo html_escape( $row['enrolment_number']); ?></td>
		<td><?php echo html_escape($row['user_mobile']); ?></td>
		<td><?php echo AplicationStatus(html_escape($row['application_status'])); ?></td>
	    <td>
	    <!--<a href="<?php //echo base_url('manage/Circular/edit/'.$id.'/'); ?>" class="btn default btn-xs purple tooltips" data-placement="top" data-original-title="Edit">
	    <i class="fa fa-edit"></i></a>
	    <a href="<?php //echo base_url('manage/Circular/delete/'.$id.'/'); ?>" class="btn default btn-xs red tooltips" onclick="return confirm('Are you sure to delete record?'); " data-placement="top" data-original-title="Delete">
	    <i class="fa fa-trash-o"></i></a>-->
		<a href="<?php echo base_url('manage/Admission/view/'.$id.'/'); ?>" class="btn default btn-xs purple tooltips" data-placement="top" data-original-title="Edit">
	    <i class="fa fa-eye"></i></a>
	    </td>
   </tr>
	<?php 
	$i = $i+1;
	 endforeach;
	 else:
	 echo '<tr class="text-center"><td colspan="9">Record not found</td></tr>';
	 endif; 
	?>
	</tbody>
	</table>
<div class="clearfix"></div>
<?php if(isset($ajaxPagination['output'])){ echo $ajaxPagination['output']; }?>