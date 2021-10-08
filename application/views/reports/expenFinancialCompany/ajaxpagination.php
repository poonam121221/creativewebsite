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
			<th width="15%">Project Name</th>			
			<th width="12%">Company</th>
			<th width="12%">Company Category</th>
            <th width="12%">Project Category</th>
			<th width="12%">District</th>
	        <th width="12%">CSR Expenditures(In Crore)</th>
            <th width="12%">Project Duration in Months</th>  
		</tr>
		</thead>
		<tbody> 
	<?php 
	//print_r($DataList);die();  
	if(isset($DataList) && count($DataList)>0  && $DataList !=FALSE):
	$i = (isset($ajaxPagination['s_no']))?$ajaxPagination['s_no']:1;

	$i = 1;
	foreach($DataList as $row):
	
	$ts1 = strtotime($row['planned_start_date']);
	$ts2 = strtotime($row['planned_end_date']);
	$year1 = date('Y', $ts1);
	$year2 = date('Y', $ts2);
	$month1 = date('m', $ts1);
	$month2 = date('m', $ts2);

	$diff = (($year2 - $year1) * 12) + ($month2 - $month1);
	
	?>                                           
	<tr>
		<td><?php echo $i; ?></td>
		<td><?php echo html_escape($row['project_title']); ?></td>
		<td><?php echo html_escape($row['company_name']); ?></td>
		<td><?php echo html_escape($row['company_category']); ?></td>
        <td><?php echo html_escape($row['project_category_name']); ?></td>
		<td><?php echo html_escape($row['district_name']); ?></td>
		<td><?php echo html_escape($row['total']); ?></td>
        <td><?php echo html_escape($diff); ?></td>
        
   </tr>
	<?php
	 $i = $i+1;
	 endforeach;else:
	 echo '<tr class="text-center"><td colspan="8>Record not found</td></tr>';
	 endif;
	?>
	</tbody>
	</table>
<div class="clearfix"></div>
<?php if(isset($ajaxPagination['output'])){ echo $ajaxPagination['output']; }?> 