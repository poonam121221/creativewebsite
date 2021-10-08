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
	  <th>Subject</th> 
      <th>From</th> 
	 <!-- <th>User Type</th> -->    
      <th>Query Type</th>
      <th>Received</th>
      <th>Action</th>
	</tr>
	</thead>
	<tbody>  
	<?php 
	if(isset($DataList) && count($DataList)>0  && $DataList !=FALSE):
	$i = (isset($ajaxPagination['s_no']))?$ajaxPagination['s_no']:1;
	foreach($DataList as $row):	
	$this->__id = encrypt_decrypt('encrypt',$row->comm_id);
	if($row->comm_parent_id)
		{
			$green = 'green';
		}
		else
		{
			$green = '';
		}
	?> 
	 <tr>
	  <td><?php echo html_escape($row->comm_subject); ?></td>
	  <td><?php echo  html_escape(ucwords($row->from_name)); ?></td>
	  <td><?php echo html_escape($row->query_name); ?></td>
	  <td><?php echo html_escape($row->comm_add_date); ?></td>

	  <td>
	<?php //if($row->comm_message_replay == ''){ 
	if(empty($row->comm_parent_id)){ 
	?>
		<a href="<?php echo base_url('user/communication-reply/').$this->__id; ?>" class="btn-view" data-toggle="tooltip" title="Reply"><em class="fa fa-reply"></em></a>
        <?php } ?>
		<a href="<?php echo base_url('user/communication-view/').$this->__id; ?>" class="btn-view <?php echo $green; ?>" data-toggle="tooltip" title="View"><em class="fa fa-eye"></em></a>    
	 </td>
	 </tr>
	<?php 
	$i = $i+1;
	 endforeach;
	 else:
	 echo '<tr class="text-center"><td colspan="6">'.$this->lang->line('record_not_found').'</td></tr>';
	 endif; 
	?>
	</tbody>
	</table>
</div><!--End table-responsive-->
<?php if(isset($ajaxPagination['output'])){ echo $ajaxPagination['output']; }?>
<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});
</script>
<style>
.btn-view{
    text-decoration: none !important;
    background: #ffffff;
    color: #5f5f5f!important;
    padding: 4px;
    min-width: 25px;
    height: 25px;
    display: block;
    float: left;
    border-radius: 3px;
    margin: 0px 2px;
    font-size: 18px;
}
</style>