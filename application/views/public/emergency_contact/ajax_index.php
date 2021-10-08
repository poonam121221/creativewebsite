 <?php
// get the data and pass it to your view
$token_name = $this->security->get_csrf_token_name();
$token_hash = $this->security->get_csrf_hash();
echo form_input(array('type' =>'hidden', 'id' =>'sysToken', 'name' => $token_name, 'value' => $token_hash));
?>
 <?php $ajaxPagination = $this->ajax_pagination->create_links(); ?>
 <div class="table-responsive tbl_style">
 <table class="table table-bordered table-hover" id="acrylic">
		<thead>
		<tr>
			<th width="5%"><?php echo $this->lang->line('serial_no'); ?></th>
			<th width="8%"><?php echo $this->lang->line('designation'); ?></th>
			<th width="8%" ><?php echo $this->lang->line('contact_office_number'); ?></th>
                        <th width="8%" ><?php echo $this->lang->line('contact_fax_number'); ?></th>
                        <th width="8%" ><?php echo $this->lang->line('contact_mobile_number'); ?></th>
                        <th width="8%" ><?php echo $this->lang->line('email'); ?></th>
                        <th width="8%" ><?php echo $this->lang->line('district'); ?></th>
                        
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
		<td><?php echo html_escape($row['contact_designation']); ?></td>
                <td><?php echo html_escape($row['contact_office_number']); ?></td>
                <td><?php echo html_escape($row['contact_fax_number']); ?></td>
                <td><?php echo html_escape($row['contact_mobile_number']); ?></td>
                <td><?php echo html_escape($row['contact_emailid']); ?></td>
                <td><?php echo html_escape($row['contact_district']); ?></td>
		
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
