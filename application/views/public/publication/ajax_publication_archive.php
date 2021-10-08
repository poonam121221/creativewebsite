 <?php // get the data and pass it to your view
 $token_name = $this->security->get_csrf_token_name();
 $token_hash = $this->security->get_csrf_hash();
 echo form_input(array('type'  => 'hidden','id'=>'sysToken','name'=>$token_name,'value'=>$token_hash));

 ?>
 <?php $ajaxPagination = $this->ajax_pagination->create_links(); ?>
 <div class="table-responsive tbl_style">
 <table class="table table-bordered table-hover">
		<thead>
		<tr>
			<th width="5%"><?php echo $this->lang->line('serial_no'); ?></th>
			<th width="85%"><?php echo $this->lang->line('name'); ?></th>
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
		<td><?php echo html_escape($row->title); ?></td>
		<td class="text-center">
		<?php if(trim($row->attachment)!=""): ?>
		<a title="<?php echo html_escape($row->title); ?>" target="_blank" href="<?php echo base_url('uploads/files/').html_escape($row->attachment); ?>"><i class="fa fa-download"></i></a>
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
<div class="clearfix"></div>
<?php if(isset($ajaxPagination['output'])){ echo $ajaxPagination['output']; }?>

<div class="clearfix"><p></p></div>
<hr class="style3"/>
<div class="row">
	<div class="col-sm-12">
		
		<a class="btn btn-primary" href="<?php if(!empty($category_id)) echo base_url('publication/view/'.$category_id); else echo base_url('publication');  ?>">
		<i class="fa fa-hand-o-left"></i> <?php echo $this->lang->line('back'); ?>
		</a>
	</div>
</div>