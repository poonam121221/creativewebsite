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
			<th width="20%">Consultancy Name</th>
			<th>Contact Name</th>
			<th width="12%">Email Id </th>
			<th>Phone Number</th>
			<th width="10%">State</th>
			<th>Payment Status</th>
			<th>Transaction Id </th>
			<th width="10%">Date</th>
			<th>Application satus</th>
			<th width="10%">Action</th>
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
		<td><?php echo $i;?></td>
		<td><?php echo html_escape($row['consultancy_name']); ?></td>
		<td><?php echo html_escape($row['contact_name']); ?></td>
		<td><?php echo html_escape($row['emailid']); ?></td>
		<td><?php echo html_escape($row['phone_number']); ?> <?php echo html_escape($row['mobile']); ?></td>
		<td><?php echo html_escape($row['state_name']); ?></td>
		<td><?php echo PayStatus(html_escape($row['payment_status'])); ?></td>
		<td><?php echo $row['tnx_id']; ?></td>
	    <td><?php echo date("d-m-y",strtotime($row['added_date'])); ?></td>
		<td><?php echo AplicationStatus(html_escape($row['application_status'])); ?></td>
	    <td><a href="<?php echo base_url('manage/Consultancy/view/'.$id.'/'); ?>" class="btn default btn-xs purple tooltips" data-placement="top" data-original-title="Edit">
	    <i class="fa fa-eye"></i></a></td>
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