 <?php // get the data and pass it to your view
 $token_name = $this->security->get_csrf_token_name();
 $token_hash = $this->security->get_csrf_hash();
 echo form_input(array('type'  => 'hidden','id'=>'sysToken','name'=>$token_name,'value'=>$token_hash));
 ?>
 <?php $ajaxPagination = $this->ajax_pagination->create_links(); ?>
	
	<?php 
	if(isset($DataList) && count($DataList)>0  && $DataList !=FALSE){
	$i = (isset($ajaxPagination['s_no']))?$ajaxPagination['s_no']:1;
	$ImagePath = base_url('assets/img/img-not-found.jpg');
	
	foreach($DataList as $row) {
	
	$enc_id = encrypt_decrypt('encrypt',$row->cat_id);
	if(trim($row->attachment)!=""){
		$ImagePath = base_url('uploads/gallery/').html_escape($row->attachment);
	}		
	?>
	
	
        <div class="col-lg-3 col-md-6 col-sm-6 p-1">
		<a data-fancybox="gallery" href="<?php echo $ImagePath; ?>" title="<?php echo $row->title; ?>">
			<div class="gallery-item">
				<div class="gallery-img">
					<img src="<?php echo $ImagePath; ?>" alt="<?php echo $row->title; ?>">
					<span class="mdi mdi-image-area"></span>
				</div>
				<div class="desp">
					<h5><?php echo $row->title; ?></h5>
				</div>
			</div>
		</a>
	</div>          
	<?php 
	   };//end foreach DataList
	 }else{
	   echo '<div class="col-md-3 text-center">'.$this->lang->line('record_not_found').'</div>';
	 };//end if check isset DataList 
	?>

<?php if(isset($ajaxPagination['output'])){ echo $ajaxPagination['output']; }?>