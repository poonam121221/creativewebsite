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
    		<th width="15%"><?php echo $this->lang->line('nit_no'); ?></th>
			<th width="30%"><?php echo $this->lang->line('tender_title'); ?></th>
           <th width="10%" class="text-center"><?php echo $this->lang->line('notice'); ?></th>
   			<th width="10%" class="text-center"><?php echo $this->lang->line('corrigendum'); ?></th>
            <th width="10%" class="text-center"><?php echo $this->lang->line('remark'); ?></th>
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
   		<td><?php echo html_escape($row['nit_no']).' '.get_date($row['issue_date'],'d-m-Y'); ?></td>
		<td><?php echo html_escape(stripslashes2($row['title'])); ?></td>
        <td>
	    <?php if(trim($row['attachment1'])!=""): ?>
	    <a target="_blank" href="<?php echo base_url('uploads/files/'.$row['attachment1']); ?>"><?php echo $row['attachment1']; ?></a><br>
	    <?php endif; ?>
         <?php if(trim($row['attachment2'])!=""): ?>
	    <a target="_blank" href="<?php echo base_url('uploads/files/'.$row['attachment2']); ?>"><?php echo $row['attachment2']; ?></a><br>
	    <?php endif; ?>
         <?php if(trim($row['attachment3'])!=""): ?>
	    <a target="_blank" href="<?php echo base_url('uploads/files/'.$row['attachment3']); ?>"><?php echo $row['attachment3']; ?></a><br>
	    <?php endif; ?>
         <?php if(trim($row['attachment4'])!=""): ?>
	    <a target="_blank" href="<?php echo base_url('uploads/files/'.$row['attachment4']); ?>"><?php echo $row['attachment4']; ?></a><br>
	    <?php endif; ?>
         <?php if(trim($row['attachment5'])!=""): ?>
	    <a target="_blank" href="<?php echo base_url('uploads/files/'.$row['attachment5']); ?>"><?php echo $row['attachment5']; ?></a>
	    <?php endif; ?>
	    </td>
        		<td>
	   <?php if(trim($row['corrigendum1'])!=""): ?>
	    <a target="_blank" href="<?php echo base_url('uploads/files/'.$row['corrigendum1']); ?>"><?php echo $row['corrigendum1']; ?></a><br>
	    <?php endif; ?>
        <?php if(trim($row['corrigendum2'])!=""): ?>
	    <a target="_blank" href="<?php echo base_url('uploads/files/'.$row['corrigendum2']); ?>"><?php echo $row['corrigendum2']; ?></a><br>
	    <?php endif; ?>
        <?php if(trim($row['corrigendum3'])!=""): ?>
	    <a target="_blank" href="<?php echo base_url('uploads/files/'.$row['corrigendum3']); ?>"><?php echo $row['corrigendum3']; ?></a><br>
	    <?php endif; ?>
        <?php if(trim($row['corrigendum4'])!=""): ?>
	    <a target="_blank" href="<?php echo base_url('uploads/files/'.$row['corrigendum4']); ?>"><?php echo $row['corrigendum4']; ?></a><br>
	    <?php endif; ?>
        <?php if(trim($row['corrigendum5'])!=""): ?>
	    <a target="_blank" href="<?php echo base_url('uploads/files/'.$row['corrigendum5']); ?>"><?php echo $row['corrigendum5']; ?></a>
	    <?php endif; ?>
	    </td>
         <td>
		  <?php echo $row['remark']; ?>
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
</div><!--End table responsive-->
<div class="clearfix"></div>
<?php if(isset($ajaxPagination['output'])){ echo $ajaxPagination['output']; }?>

<div class="clearfix"><p></p></div>
<hr class="style3"/>
<div class="row">
	<div class="col-sm-12">
		<a class="btn btn-primary" href="<?php echo base_url('tender'); ?>">
		<i class="fa fa-hand-o-left"></i> <?php echo $this->lang->line('back'); ?>
		</a>
	</div>
</div>