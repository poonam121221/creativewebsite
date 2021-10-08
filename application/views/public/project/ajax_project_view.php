 <?php // get the data and pass it to your view
 $token_name = $this->security->get_csrf_token_name();
 $token_hash = $this->security->get_csrf_hash();
 echo form_input(array('type'  => 'hidden','id'=>'sysToken','name'=>$token_name,'value'=>$token_hash));
 ?>
 <?php $ajaxPagination = $this->ajax_pagination->create_links(); ?>
	<div class="row">
	<?php 
	if(isset($DataList) && count($DataList)>0  && $DataList !=FALSE){
	$i = (isset($ajaxPagination['s_no']))?$ajaxPagination['s_no']:1;
	$ImagePath = base_url('assets/img/img-not-found.jpg');
	
	foreach($DataList as $row) {
	
	$enc_id = encrypt_decrypt('encrypt',$row->cat_id);
	if(trim($row->attachment)!=""){
		$ImagePath = base_url('uploads/project/').html_escape($row->attachment);
	}		
	?>
	
		<div class="col-md-4">
        <div class="gallery-item">
          <a href="<?php echo base_url('project/view/') . encrypt_decrypt('encrypt', $row->id); ?>" title="<?php echo $row->title; ?>">
                <div class="gallery-img">
                  <img src="<?php echo $ImagePath; ?>" alt="<?php echo $row->title; ?>">
                  <i class="mdi mdi-call-made"></i>
                </div>
                <div class="desp">                  
                 	 <h4><?php echo word_limiter($row->title,2); ?></h4>
                    <span><?php if($row->project_status == 1){echo $this->lang->line('completed');  ;}else if($row->project_status == 2){echo $this->lang->line('inprogress'); } ?></span>             
                </div>
            </a>
        </div>
    </div>

         
	<?php 
	   };//end foreach DataList
	 }else{
	   echo '<div class="col-md-3 text-center">'.$this->lang->line('record_not_found').'</div>';
	 };//end if check isset DataList 
	?>
</div>
<div class="row">
<div class="col-md-9"><?php if(isset($ajaxPagination['output'])){ echo $ajaxPagination['output']; }?> </div>
<div class="col-md-3 text-right" style="padding-top:15px;"><a class="back-btn" href="javascript:history.back()"><em class="fa fa-angle-double-left"></em> <?php echo $this->lang->line('back');?></a></div>
</div>