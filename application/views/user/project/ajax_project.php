 <?php // get the data and pass it to your view
 $token_name = $this->security->get_csrf_token_name();
 $token_hash = $this->security->get_csrf_hash();
 echo form_input(array('type'  => 'hidden','id'=>'sysToken','name'=>$token_name,'value'=>$token_hash));
 $ajaxPagination = $this->ajax_pagination->create_links();
 ?>
<div class="table-responsive">
   <table class="table table-bordered">
    <thead>
     <tr>
	  <th>S.No.</th>
      <th>Title</th>
      <th>Category</th>
      <th>Estimated Budget</th>
      <th>Duration</th>
      <th>Contact Person Name</th>
      <th>Mobile</th>
      <?php if(isset($IntrestStatus)==TRUE && $IntrestStatus==0){ ?>
      <th>Assigned <br/>To Other</th>
      <?php } ?>
      <th>Action</th>
	</tr>
	</thead>
	<tbody>
	<?php 
	if(isset($DataList) && count($DataList)>0  && $DataList !=FALSE):
	$i = (isset($ajaxPagination['s_no']))?$ajaxPagination['s_no']:1;
	foreach($DataList as $row):	
	$project_enc_id = encrypt_decrypt('encrypt',$row->project_id);
	?> 
	 <tr>
	  <td><?php echo $i; ?></td>
	  <td width="20%"><?php echo html_escape($row->project_title); ?></td>
	  <td><?php echo html_escape($row->project_category_name); ?></td>
	  <td><?php echo html_escape($row->project_estmtd_budget); ?></td>
	  <td width="10%"><?php echo html_escape($row->project_estmtd_duration); ?></td>
	  <td><?php echo html_escape($row->cnt_full_name); ?></td>
	  <td><?php echo html_escape($row->cnt_person_mobile); ?></td>
	  <?php if(isset($IntrestStatus)==TRUE && $IntrestStatus==0){ ?>
	  <td><?php echo DefaultStatus($row->is_assign_other); ?></td>
	  <?php } ?>
	  <td>
	  <?php if(isset($IntrestStatus)==TRUE && $IntrestStatus==1){ ?>
	  	
		<a href="<?php echo base_url('project/document/'.$project_enc_id);?>" class="edit"><em class="nc-icon nc-pencil"></em> Document</a>
		<a href="<?php echo base_url('project/milestone/'.$project_enc_id);?>" class="edit"><em class="nc-icon nc-pencil"></em> Milestone</a>
		<a href="<?php echo base_url('project/information/'.$project_enc_id);?>" class="view"><em class="nc-icon nc-eye-19"></em> Details</a>
		
	  <?php }else{//end check Intrest Status ?>
		
		<a target="_blank" href="<?php echo base_url('project/details/'.$project_enc_id);?>" class="view"><em class="nc-icon nc-eye-19"></em> Details</a>
	  <?php } ?>
	 </td>
	 </tr>
	<?php 
	$i = $i+1;
	 endforeach;
	 else:
	 echo '<tr class="text-center"><td colspan="8">'.$this->lang->line('record_not_found').'</td></tr>';
	 endif; 
	?>
	</tbody>
	</table>
</div><!--End table-responsive-->
<?php if(isset($ajaxPagination['output'])){ echo $ajaxPagination['output']; }?>