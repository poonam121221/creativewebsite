
 <?php $ajaxPagination = $this->ajax_pagination->create_links(); ?>

	
	<?php 
	
	if(isset($DataList) && count($DataList)>0  && $DataList !=FALSE){
	$i = (isset($ajaxPagination['s_no']))?$ajaxPagination['s_no']:1;
	
	foreach($DataList as $row) {
	$ImagePath = base_url('assets/img/img-not-found.jpg');
	$enc_id = encrypt_decrypt('encrypt',$row->cat_id);
	if(trim($row->attachment)!=""){
		$ImagePath = base_url('uploads/gallery/').html_escape($row->attachment);
	}		
	?>	
		<div class="col-md-4">
			<div class="gallery-item">
				<a  href="<?php echo base_url('photo-gallery-view/'.$enc_id); ?>" class="viewbtn" alt="<?php echo $row->title; ?>">
				<div class="gallery-img">
					<img src="<?php echo $ImagePath; ?>" alt="<?php echo $row->title; ?>">
					<i class="mdi mdi-call-made"></i>
				</div>
				<div class="desp">
					
					<h5><?php echo $row->title; ?></h5>
				</div>
			</a>
			</div>
		</div>
	                      
	<?php 
	   }
	 }else{
	   echo '<div class="col-md-12 text-center">'.$this->lang->line('record_not_found').'</div>';
	 } 
	?>

<?php if(isset($ajaxPagination['output'])){ echo $ajaxPagination['output']; }?>