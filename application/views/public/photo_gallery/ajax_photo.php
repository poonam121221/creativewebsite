
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
			<!-- Grid -->
			<div class="row_items col-md-3">
				<div class="product-layout product-grid">
					<div class="product-thumb transition">
						<div class="image">
							<a href="<?php echo $ImagePath; ?>">
								<img src="<?php echo $ImagePath; ?>"
									alt="<?php echo $row->title; ?>"
									title="<?php echo $row->title; ?>"
									class="img-responsive" />
							</a>
						</div><!-- image -->
						<div class="caption">
							<h4 class="product-name"><?php echo $row->title; ?></h4>
							<p class="price">&#x20B9; 100.00</p>
						</div><!-- caption -->
					</div><!-- product-thumb -->
				</div><!-- product-layout -->

			</div>
			<!-- Grid -->         
	<?php 
	   }
	 }else{
	   echo '<div class="col-md-12 text-center">'.$this->lang->line('record_not_found').'</div>';
	 } 
	?>

<?php if(isset($ajaxPagination['output'])){ echo $ajaxPagination['output']; }?>