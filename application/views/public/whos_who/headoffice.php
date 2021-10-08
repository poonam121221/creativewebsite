<?php
  $title = "";
  $description = "";
  
  if(isset($PageList) && $PageList!=false){
  	$title = stripslashes2(html_entity_decode($PageList->title));
  	$description = stripslashes2(html_entity_decode($PageList->description));
  }
?>
<article>
 <section class="page-title">
 	<div class="container">
 	<h1 class="heading">
 	  <span><?php echo $title; ?></span>
 	</h1>
    <!-------------------------Breadcrumbs--------------------------->
    <div class="row">
    <div class="col-sm-12">
    	<?php echo $this->breadcrumbs->show(); ?>
    </div><!--End col-12-->
    </div><!--End row-->
    <!-------------------------End Breadcrumbs------------------------> 
    </div><!--End contianer-->
 </section><!--End page-title section--> 
</article>

<section class="innerContent">
<div class="container">
<div class="row">
<!-----------------------------------------Start Main Content----------------------------------------->
    <div class="col-md-12">
    
	<div id="ele1" class="h_about min-h300">
	
      <h3 class="heading"><span><?php echo $title; ?></span></h3>
      <hr class="style1">
      <div class="top-th-bod"><?php echo $description; ?></div>
      <hr class="style1">
      
      <div class="table-responsive">
       <table class="table top-table">
       <tbody>
		 <tr>
		   <th width="20%" rowspan="2" class="text-center top-th-bod"><?php echo $this->lang->line('designation'); ?></th>
		   <th width="30%" rowspan="2" class="text-center top-th-bod"><?php echo $this->lang->line('name'); ?></th>
		   <th width="50%" colspan="2" class="text-center top-th-bod"><?php echo $this->lang->line('telephone'); ?></th>
		 </tr>
		 <tr>
		   <th width="30%" class="text-center top-th-bod"><?php echo $this->lang->line('office'); ?></th>
		   <th width="20%" class="text-center top-th-bod"><?php echo $this->lang->line('residence'); ?></th>
		 </tr>
		 <?php 

		 if(isset($DataList) && count($DataList)>0){ 	
		 $chkCatId = 0;		 
		  foreach($DataList as $row){
		  	
		  	if(checkLanguage("english")){
			 	$name = html_escape(stripslashes2(html_entity_decode($row['title_en'])));
			 	$category = html_escape(stripslashes2(html_entity_decode($row['category_en'])));
			 	$designation = html_escape(stripslashes2(html_entity_decode($row['designation_en'])));
			 	$work_allocation = html_escape(stripslashes2(html_entity_decode($row['work_allocation_en'])));
			 }else{
			 	$name = html_escape(stripslashes2(html_entity_decode($row['title_hi'])));
			 	$category = html_escape(stripslashes2(html_entity_decode($row['category_hi'])));
			 	$designation = html_escape(stripslashes2(html_entity_decode($row['designation_hi'])));
			 	$work_allocation = html_escape(stripslashes2(html_entity_decode($row['work_allocation_hi'])));
			 }
			 if($chkCatId!=$row['cat_id']){
			 	echo "<tr class='text-center th-bod'><td colspan='4'>".$category."</td></tr>";
			 }
			 $chkCatId = $row['cat_id'];
		 ?>
		  <tr>
		  	<td><?php echo $designation;?></td>
		  	<td><?php echo $name;?></td>
		  	<td>
		  		<?php echo (trim($row['phone_number'])!="") ? $this->lang->line('phone')." : ".$row['phone_number']."<br/>":""; ?>
		  		<?php echo (trim($row['contact_number'])!="") ? $this->lang->line('mobile')." : ".$row['contact_number']."<br/>":""; ?>
		  		<?php echo (trim($row['email_address'])!="") ? $this->lang->line('email')." : ".$row['email_address']."<br/>":""; ?>
		  	</td>
		  	<td>
		  	<?php echo (trim($row['res_phone_number'])!="") ? $this->lang->line('phone')." : ".$row['res_phone_number']."<br/>":""; ?>
		  	</td>
		  </tr>
		 <?php 
		  }//end foreach 
		 }else{
	   	  echo '<tr><td colspan="4" class="text-center">'.$this->lang->line('record_not_found').'</td></tr>';
	 	  }//end if ?>
		</tbody>      
       </table><!--End table-->
      </div><!--End row-->
	  
     </div><!--End h_about-->
    
	</div><!--column-12-->
</div><!--End row-->

</div><!--End container-->
</section><!--End section-->