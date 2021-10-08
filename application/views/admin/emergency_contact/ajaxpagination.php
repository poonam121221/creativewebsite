<?php // get the data and pass it to your view
 $token_name = $this->security->get_csrf_token_name();
 $token_hash = $this->security->get_csrf_hash();
 echo form_input(array('type'  => 'hidden','id'=>'sysToken','name'=>$token_name,'value'=>$token_hash));
 $ajaxPagination = $this->ajax_pagination->create_links(); 
?>
     <table class="table table-striped box-table-a">
		<thead>
		<tr>
			<th width="5%">No</th>
			<th width="10%">Designation</th>
                        <th width="15%">Contact Name</th>
			<th width="10%">Office No.</th>
			<th width="5%">Fax No.</th>
			<th width="10%">Mobile No.</th>
			<th width="12%">Email</th>
			<th width="5%">District</th>
                        <th width="10%">Last Modified By</th>
			<th width="10%">Last Modified Date</th>
                        <th width="8%">Status</th>
			<th width="8%">Action</th>
		</tr>
		</thead>
		<tbody>
	<?php 
	if(isset($DataList) && count($DataList)>0  && $DataList !=FALSE):
        $i = (isset($ajaxPagination['s_no']))?$ajaxPagination['s_no']:1;
	foreach($DataList as $row):	
	$id = encrypt_decrypt('encrypt',$row['contact_id']);
	?>
	<tr>
		<!--<td><input class="text-center" name="order_pref[]" type="text" onChange="location.replace('<?php echo base_url('manage/EmergencyContact/updatesrtorder/sid/').$id.'/sorder/'; ?>'+this.value+'')" value="<?php echo $row['contact_id']; ?>" size="1" style="width:25px;" /></td>-->
            
	    <td><?php echo $i; ?></td>
            <td><?php echo html_escape($row['contact_designation']); ?></td>
	    <td><?php echo html_escape($row['contact_name']); ?></td>
	    <td>
	    <?php echo html_escape($row['contact_office_number']); ?>
	    </td>
            <td>
	    <?php echo html_escape($row['contact_fax_number']); ?>
	    </td>
            <td>
	    <?php echo html_escape($row['contact_mobile_number']); ?>
	    </td>
            <td>
	    <?php echo html_escape($row['contact_emailid']); ?>
	    </td>
            <td>
	    <?php echo ucwords(strtolower(html_escape($row['contact_district']))); ?>
	    </td>
	    <td><?php echo getModifierName($row['admin_name'],$row['edited_name']); ?></td>
	    <td><?php echo getModifiedDate($row['contact_add_date'],$row['contact_edit_date']); ?></td>
	    <td><?php echo PublishStatus(html_escape($row['contact_status'])); ?></td>
	    <td>
	    <a href="<?php echo base_url('manage/EmergencyContact/edit/'.$id.'/'); ?>" class="btn default btn-xs purple tooltips" data-toggle="tooltip" data-placement="top" title="" data-original-title="Update Data">
	    <i class="fa fa-edit"></i></a>
	    <!--<a href="<?php echo base_url('manage/EmergencyContact/delete/'.$id.'/'); ?>" class="btn default btn-xs red tooltips" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Data" onclick="return confirm('Are you sure to delete record?'); ">
	    <i class="fa fa-trash-o"></i></a>-->
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