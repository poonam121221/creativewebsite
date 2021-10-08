 <?php // get the data and pass it to your view
 $token_name = $this->security->get_csrf_token_name();
 $token_hash = $this->security->get_csrf_hash();
 echo form_input(array('type'  => 'hidden','id'=>'sysToken','name'=>$token_name,'value'=>$token_hash));
 ?>
 <?php $ajaxPagination = $this->ajax_pagination->create_links(); ?>

  <div class="text-justify">
      <?php
      if(isset($DataList)){
      	$i = (isset($ajaxPagination['s_no']))?$ajaxPagination['s_no']:1;
      ?>
      
      <!--------------------------------------------------------------------->
	 <div class="row">
			<div class="col-sm-9">
				<?php 
				echo "<b>".$this->lang->line('search_results')." : </b>"; 
				if($this->session->has_userdata('post_data')){
			    	echo $this->session->userdata('post_data');
				}
				?>
			</div>
			<div class="col-sm-3">
			<div class="text-right">
				<?php 
				echo $this->lang->line('total')." "; 
			    echo "<b>".$TotalRecord."</b>";
				echo " ".$this->lang->line('results_found');
				?>
			</div>
			</div>
		</div><!--End row-->  
		<hr class="style2">
	 <!--------------------------------------------------------------------->
      
      <?php
       foreach($DataList as $row){ ?>
      <div class="row">
        <div class="col-sm-12">
          <div class="type-page">
		  	 <h3><?php 
		  	 if(checkLanguage("english")){
			 	$title = ucwords($row->title);
			 }else{
			 	$title = $row->title;
			 }
		  	 echo stripslashes2(html_entity_decode($title)); 
		  	 ?></h3>
	      	<?php echo word_limiter(strip_tags(stripslashes2(html_entity_decode($row->description))),40);?> 
	      	<p><a target="_blank" href="<?php echo base_url($row->page_url); ?>" class="txt_link pull-right"><?php echo $this->lang->line('read_more'); ?></a></p>  
      <div class="clearfix padd-bottom-10"></div> 
	      </div> <!--End type-page-->
      	</div>
      </div>	
	  <?php }//end foreach
	   }//end if
	   if(isset($DataList) && count($DataList)==0){
	   	echo '<div class="text-center red">'.$this->lang->line('record_not_found').'</div>';
	   }//end if ?>        
</div><!--End text-justify-->    
 
<div class="clearfix"></div>
<?php if(isset($ajaxPagination['output'])){ echo $ajaxPagination['output']; }?>