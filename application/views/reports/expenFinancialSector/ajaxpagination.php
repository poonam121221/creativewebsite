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
			<th width="15%">Sector</th>			
			<th width="12%">CSR Expenditures(In Crore)</th>
			<th width="12%">No.of Projects</th>

		</tr>
		</thead>
		<tbody> 
	<?php 
	//print_r($DataList);die();  
	if(isset($DataList) && count($DataList)>0  && $DataList !=FALSE):
	$i = 1;
	foreach($DataList as $row):
	
	?>                                           
	<tr>
		<td><?php echo $i; ?></td>
		<td><?php echo html_escape($row['project_category_name']); ?></td>
		<td><?php echo html_escape($row['total']); ?></td>
		<td><?php echo html_escape($row['project_count']); ?></td>
        
   </tr>
	<?php
	 $i = $i+1;
	 endforeach;else:
	 echo '<tr class="text-center"><td colspan="4">Record not found</td></tr>';
	 endif;
	?>
	</tbody>
	</table>
<div class="clearfix"></div>
<?php //if(isset($ajaxPagination['output'])){ echo $ajaxPagination['output']; }?>