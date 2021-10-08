 <?php // get the data and pass it to your view
 $token_name = $this->security->get_csrf_token_name();
 $token_hash = $this->security->get_csrf_hash();
 echo form_input(array('type'  => 'hidden','id'=>'sysToken','name'=>$token_name,'value'=>$token_hash));
 ?>
 <?php $ajaxPagination = $this->ajax_pagination->create_links(); ?>
 <div class="table-responsive tbl_style">
 <table class="table table-striped table-bordered table-hover">
		<thead class="thead-default">
		<tr>
			<th width="5%"><?php echo $this->lang->line('serial_no'); ?></th>
			<th width="15%"><?php echo $this->lang->line('hospital_type'); ?></th>
			<th width="30%"><?php echo $this->lang->line('hospital_name'); ?></th>
			<th width="30%"><?php echo $this->lang->line('address'); ?></th>
			<th width="20%" class="text-center"><?php echo $this->lang->line('link'); ?></th>
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
		<td><?php echo html_escape($row->cat_title); ?></td>
		<td class="text-left"><?php echo html_escape($row->title); ?></td>
		<td class="text-left"><?php echo html_escape($row->address); ?></td>
		<td class="text-center">
		<?php if(trim($row->web_url)!=""): ?>
		<a class="btn btn-xs btn-primary" target="_blank" href="<?php echo html_escape($row->web_url); ?>">Website</a>
		<?php endif; ?>
		<a class="btn btn-xs btn-info" target="_blank" href="<?php echo base_url('hospital/view/').encrypt_decrypt('encrypt',$row->id); ?>"><?php echo $this->lang->line('read_more'); ?></a>
		</td>
   </tr>
	<?php 
	$i = $i+1;
	 endforeach;
	 else:
	 echo '<tr class="text-center"><td colspan="3">'.$this->lang->line('record_not_found').'</td></tr>';
	 endif; 
	?>
	</tbody>
	</table>
</div><!--End table responsive-->
<div class="clearfix"></div>
<?php if(isset($ajaxPagination['output'])){ echo $ajaxPagination['output']; }?>

<div class="clearfix"><p></p></div>