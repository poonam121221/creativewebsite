 <?php // get the data and pass it to your view
 $token_name = $this->security->get_csrf_token_name();
 $token_hash = $this->security->get_csrf_hash();
 echo form_input(array('type'  => 'hidden','id'=>'sysToken','name'=>$token_name,'value'=>$token_hash));
 ?>
 <?php $ajaxPagination = $this->ajax_pagination->create_links(); ?>
 <table class="table table-striped table-bordered table-hover dataTable">
		<thead>
		<tr>
			<th>No.</th>
			<th>Name</th>
			<th>Email Id</th>
			<th>Mobile</th>
			<th>Subject</th>
			<th>Type</th>
			<th>Message</th>
			<th>Created Date</th>
			<th>Action</th>
		</tr>
		</thead>
		<tbody> 
	<?php 
	if(isset($DataList) && count($DataList)>0  && $DataList !=FALSE):
	$i = (isset($ajaxPagination['s_no']))?$ajaxPagination['s_no']:1;
	foreach($DataList as $row):	
	?>                                           
	<tr>
		<td><?php echo $i; ?></td>
		<td><?php echo html_escape(stripslashes2($row['feedback_name'])); ?></td>
		<td><?php echo html_escape($row['feedback_email']); ?></td>
		<td><?php echo html_escape($row['feedback_mobile']); ?></td>
		<td><?php echo html_escape(stripslashes2($row['feedback_subject'])); ?></td>
		<td><?php echo ($row['feedback_type']==1)?'Feedback':'Contact'; ?></td>
		<td><?php echo word_limiter(stripslashes2($row['feedback_message']),5); ?></td>
	    <td><?php echo get_date($row['feedback_date']); ?></td>
	    <td><a title="<?php echo html_escape(stripslashes2($row['feedback_name'])).' ('.get_date($row['feedback_date']).')'; ?>" class="btn btn-sm blue showMessage" href="javascript:void(0)">View Message</a>
	    <div class="hide feedbackMsg"><?php echo html_escape(stripslashes2($row['feedback_message'])); ?></div>
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