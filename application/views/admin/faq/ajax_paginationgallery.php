 <?php // get the data and pass it to your view
 $token_name = $this->security->get_csrf_token_name();
 $token_hash = $this->security->get_csrf_hash();
 echo form_input(array('type'  => 'hidden','id'=>'sysToken','name'=>$token_name,'value'=>$token_hash));
 ?>
 <?php $ajaxPagination = $this->ajax_pagination->create_links(); ?>
     <table class="table table-striped box-table-a">
		<thead>
		<tr>
			<th width="3%">No.</th>
			<th width="10%">Category</th>
			<th width="15%">Title(Hindi)</th>
			<th width="15%">Title(English)</th>			
			<th width="12%">Last Modified By</th>
			<th width="13%">Last Modified Date</th>
			<th width="5%">Status</th>
			<th width="8%">Action</th>
		</tr>
		</thead>
		<tbody> 
	<?php 
	if(isset($DataList) && count($DataList)>0  && $DataList !=FALSE):
	$i = 1;
      
	foreach($DataList as $row):	
	$id = encrypt_decrypt('encrypt',$row->id);
	?>                                           
	<tr>
		<td><input class="text-center" name="order_pref[]" type="text" onChange="location.replace('<?php echo base_url('manage/Faq/updatesrtorder/sid/').$id.'/sorder/'; ?>'+this.value+'')" value="<?php echo $row->order_preference; ?>" size="1" style="width:25px;" /></td>
		<td><?php echo html_escape($row->cat_title_en); ?></td>
		<td><?php echo html_escape($row->title_hi); ?></td>
		<td><?php echo html_escape($row->title_en); ?></td>		
		
		<td><?php echo getModifierName($row->admin_name,$row->edited_name); ?></td>
	    <td><?php echo getModifiedDate($row->added_date,$row->edit_date); ?></td>
	    <td><?php echo PublishStatus(html_escape($row->status)); ?></td>
	    <td>
	    <a href="<?php echo base_url('manage/Faq/edit/'.$id.'/'); ?>" class="btn default btn-xs purple tooltips" data-placement="top" data-original-title="Edit">
	    <i class="fa fa-edit"></i></a>
	    <a href="<?php echo base_url('manage/Faq/delete/'.$id.'/'); ?>" class="btn default btn-xs red tooltips" onclick="return confirm('Are you sure to delete record?'); " data-placement="top" data-original-title="Delete">
	    <i class="fa fa-trash-o"></i></a>
	    </td>
   </tr>
	<?php 
	$i = $i+1;
	 endforeach;else:
	 echo '<tr class="text-center"><td colspan="9">Record not found</td></tr>';
	 endif;
	?>
	</tbody>
	</table>
	<div class="clearfix"></div>
<?php if(isset($ajaxPagination['output'])){ echo $ajaxPagination['output']; }?>