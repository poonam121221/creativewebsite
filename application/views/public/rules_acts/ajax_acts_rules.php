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
			<th width="6%"><?php echo $this->lang->line('serial_no'); ?></th>
			<th width="84%"><?php echo $this->lang->line('title'); ?></th>
			<th width="10%" class="text-center"><?php echo $this->lang->line('download'); ?></th>
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
		<td>
			<div class="noticeboard_posted_on">
			<?php echo html_escape(stripslashes2($row['title'])); ?><br/>
			<span class="font-11"> <?php echo $this->lang->line('published_on')." ".get_date($row['added_date'],'d M, Y'); ?></span></div>
		</td>
		<td class="text-center">
	    <?php if(trim($row['attachment'])!=""): ?>
	    <a target="_blank" href="<?php echo base_url('uploads/files/'.$row['attachment']); ?>"><i class="fa fa-download"></i></a>
	    <?php endif; ?>
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
<?php if(isset($ajaxPagination['output'])){ echo $ajaxPagination['output']; }?>