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
			<th width="6%"><?php echo $this->lang->line('serial_no'); ?></th>
			<th width="94%"><?php echo $this->lang->line('name'); ?></th>
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
			<div class="noticeboard_posted_on"><a target="_blank" href="<?php echo base_url('uploads/files/').html_escape($row->attachment); ?>">
			<?php echo html_escape($row->title); ?></a><br/>
			<span class="font-11"> <?php echo $this->lang->line('published_on')." ".get_date($row->added_date,'d M, Y'); ?></span></div>
		</td>
   </tr>
	<?php 
	$i = $i+1;
	 endforeach;
	 else:
	 echo '<tr class="text-center"><td colspan="2">'.$this->lang->line('record_not_found').'</td></tr>';
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
		<a class="btn btn-primary" href="<?php echo base_url('notice-board'); ?>">
		<i class="fa fa-hand-o-left"></i> <?php echo $this->lang->line('back'); ?>
		</a>
	</div>
</div>