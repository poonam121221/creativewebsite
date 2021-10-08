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
			<th width="12%">Title (Hindi)</th>
			<th width="12%">Title (English)</th>
			<th width="5%">Url</th>
			<th width="12%">Last Modified By</th>
			<th width="13%">Last Modified Date</th>
			<th width="8%">Status</th>
            <th width="5%">Homepage Video</th>
			<th width="8%">Action</th>
		</tr>
		</thead>
		<tbody> 
	<?php 
	if(isset($DataList) && count($DataList)>0  && $DataList !=FALSE):
	$i = 0;
	foreach($DataList as $row):	$i++;
	$id = encrypt_decrypt('encrypt',$row->id);
	?>                                           
	<tr>
		<td><input class="text-center" name="order_pref[]" type="text" onChange="location.replace('<?php echo base_url('manage/Videogallery/updatesrtorder/sid/').$id.'/sorder/'; ?>'+this.value+'')" value="<?php echo $row->order_preference; ?>" size="1" style="width:25px;" /></td>
		<td><?php echo html_escape($row->cat_title_en); ?></td>
		<td><?php echo html_escape($row->title_hi); ?></td>
		<td><?php echo html_escape(ucwords($row->title_en)); ?></td>
	    <td><a target="_blank" href="<?php echo html_escape($row->url); ?>"><i class="fa fa-link"></i></a></td>
	    <td><?php echo getModifierName($row->admin_name,$row->edited_name); ?></td>
	    <td><?php echo getModifiedDate($row->added_date,$row->edit_date); ?></td>
	    <td><?php echo PublishStatus(html_escape($row->status)); ?></td>
        <td><?php echo DefaultStatus(html_escape($row->is_default)); ?></td>
	    <td>
             <a href="<?php echo base_url('manage/Videogallery/edit/'.$id.'/'); ?>" class="btn default btn-xs purple tooltips" title="Edit" data-placement="top" data-original-title="Edit">
	    <i class="fa fa-edit"></i></a>
		<?php if($row->is_default==0){?>
                 <a href="<?php echo base_url('manage/Videogallery/homepage_default/'.$id.'/'); ?>"
                     class="btn default btn-xs green tooltips" data-toggle="tooltip" data-placement="top"
                     title="Update Default Homepage Video" data-original-title="Update Default Homepage Video"
                     onclick="return confirm('Are you sure to update default homepage video?'); ">
                     <i class="fa fa-thumbs-up"></i></a>
                 <?php }else{?>
                 <a href="<?php echo base_url('manage/Videogallery/homepage_defaultdelete/'.$id.'/'); ?>"
                     class="btn default btn-xs blue tooltips" data-toggle="tooltip" data-placement="top"
                     title="Update Default Homepage Video" data-original-title="Update Default Homepage Video"
                     onclick="return confirm('Are you sure to remove default homepage video?'); ">
                     <i class="fa fa-thumbs-down"></i></a>
                 <?php }?>
            <a href="<?php echo base_url('manage/Videogallery/delete/'.$id.'/'); ?>" class="btn default btn-xs red tooltips" title="Delete" onclick="return confirm('Are you sure to delete record?'); " data-placement="top" data-original-title="Delete">
	    <i class="fa fa-trash-o"></i></a>
	    </td>
   </tr>
	<?php 
	$i = $i+1;
	 endforeach;else:
	 echo '<tr class="text-center"><td colspan="10">Record not found</td></tr>';
	 endif;
	?>
	</tbody>
	</table>
    <div class="clearfix"></div>
<?php if(isset($ajaxPagination['output'])){ echo $ajaxPagination['output']; }?>