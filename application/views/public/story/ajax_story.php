 <?php // get the data and pass it to your view
 $token_name = $this->security->get_csrf_token_name();
 $token_hash = $this->security->get_csrf_hash();
 echo form_input(array('type'  => 'hidden','id'=>'sysToken','name'=>$token_name,'value'=>$token_hash));
 ?>
 <?php $ajaxPagination = $this->ajax_pagination->create_links(); ?>
<div class="row">
<?php 	
	if(isset($DataList) && count($DataList)>0  && $DataList !=FALSE):
	$i = (isset($ajaxPagination['s_no']))?$ajaxPagination['s_no']:1;
	foreach($DataList as $row):	
	
	if(trim($row->attachment)==""){
		$photo = base_url().'assets/img/img-not-found.png';
	}else{
		$photo = base_url().'uploads/files/'.$row->attachment;
	}
	?>    
            <div class="col-md-4">
                <div class="event-image" style="background: url('<?php echo $photo; ?>');">
                	
                </div>
	     		<div class="event-title">
	     			<?php echo html_escape($row->title); ?>
	     		</div>
	     		<div class="event-location">
	     			
	     				<span><em class="icon-calendar2"></em> <?php echo get_date($row->added_date); ?>
	     				</span>
	     				<span>
	     					<a href="<?php echo base_url('story/view/').encrypt_decrypt('encrypt',$row->id); ?>" class="event-info"><?php echo $this->lang->line('read_more'); ?> <em class="fa fa-arrow-right"></em>
	     					</a>
	     				</span>
	     			
	     		</div>
	     	</div>
<?php 
	$i = $i+1;
	 endforeach;
	 else:
	 echo '<p class="text-center">'.$this->lang->line('record_not_found').'</p>';
	 endif; ?>
<div class="clearfix"></div>
</div>
<?php if(isset($ajaxPagination['output'])){ echo $ajaxPagination['output']; }?>