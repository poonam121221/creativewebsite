<?php // get the data and pass it to your view
 $token_name = $this->security->get_csrf_token_name();
 $token_hash = $this->security->get_csrf_hash();
 echo form_input(array('type'  => 'hidden','id'=>'sysToken','name'=>$token_name,'value'=>$token_hash));
 $ajaxPagination = $this->ajax_pagination->create_links(); 
?>
     <table id="example" class="table table-striped box-table-a">
		<thead>
		<tr>
			<th width="3%">No.</th>
            <th width="10%">Category</th>
			<th width="15%">Title (Hindi)</th>
			<th width="15%">Title (English)</th>
			<th width="10%">Photo</th>
			<th width="8%">Start Date</th>
			<th width="8%">End Date</th>
			<th width="10%">Last Modified By</th>
			<th width="10%">Last Modified Date</th>
			<th width="6%">Status</th>
			<th width="10%">Action</th>
		</tr>
		</thead>
		<tbody> 

	<?php 
	if(isset($DataList) && count($DataList)>0  && $DataList !=FALSE):
	$i = 0;
	foreach($DataList as $row):		
	$i ++;
	$id = encrypt_decrypt('encrypt',$row->id);
	?>   
	<tr>
		<td><?php echo $i; ?></td>
        <td><?php echo html_escape($row->cat_title_en); ?></td>
	    <td><?php echo html_escape($row->title_hi); ?></td>
	    <td><?php echo html_escape($row->title_en); ?></td>
	    <td><?php 
		
 		$image_properties = array(
        'src'   => 'uploads/events/'.html_escape($row->attachment),
        'alt'   => $row->attachment,
        'class' => 'post_images',
        'width' => '100',
        'height'=> '100',
        'title' => $row->title_en,
        'rel'   => ''
		);
 		 echo img($image_properties);
		
		?></td>
	    <td><?php echo get_date($row->event_start_date,'Y-m-d h:i:s'); ?></td>
	    <td><?php echo get_date($row->event_end_date,'Y-m-d h:i:s'); ?></td>
	    <td><?php echo getModifierName($row->admin_name,$row->edited_name); ?></td>
	    <td><?php echo getModifiedDate($row->added_date,$row->edit_date); ?></td>
	    <td><?php echo PublishStatus(html_escape($row->status)); ?></td>
	    <td>

	    <a href="<?php echo base_url('manage/Events/edit/'.$id.'/'); ?>" class="btn default btn-xs purple tooltips" data-toggle="tooltip" data-placement="top" title="" data-original-title="Update Data">
	    <i class="fa fa-edit"></i></a>
	    <a href="<?php echo base_url('manage/Events/delete/'.$id.'/'); ?>" class="btn default btn-xs red tooltips" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Data" onclick="return confirm('Are you sure to delete record?'); ">
	    <i class="fa fa-trash-o"></i></a>
	    </td>
   </tr>
	<?php 
	 endforeach;
	 else:
	 echo '<tr class="text-center"><td colspan="10">Record not found</td></tr>';
	 endif; 
	?>
	</tbody>
	</table>
	<div class="clearfix"></div>
<?php if(isset($ajaxPagination['output'])){ echo $ajaxPagination['output']; }?>