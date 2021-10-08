<?php
$title = "";
$designation = "";
$heading ="";
$message="";
$img = "";
if(isset($DataList) && is_object($DataList)){

if(checkLanguage("english")){
	$title 		 = html_escape(stripslashes2(html_entity_decode($DataList->title_en)));
	$designation = html_escape(stripslashes2(html_entity_decode($DataList->designation_en)));
	$heading 	 = html_escape(stripslashes2(html_entity_decode($DataList->heading_en)));
	$message	 = html_escape(stripslashes2(html_entity_decode($DataList->message_en)));
}else{
	$title 		 = html_escape(stripslashes2(html_entity_decode($DataList->title_hi)));
	$designation = html_escape(stripslashes2(html_entity_decode($DataList->designation_hi)));
	$heading 	 = html_escape(stripslashes2(html_entity_decode($DataList->heading_hi)));
	$message	 = html_escape(stripslashes2(html_entity_decode($DataList->message_hi)));
}

	$img = base_url('assets/img/user_img.jpg');
	if(trim($DataList->attachment)!=''){
		$img = base_url('uploads/files/').$DataList->attachment;
	}

}//end check DataList isset

?>
<div class="row">
<!-----------------------------------------Start Main Content----------------------------------------->
    <div class="col-md-9">
    
    <!-------------------------Breadcrumbs--------------------------->
    <div class="row">
    <div class="col-sm-11">
    	<?php echo $this->breadcrumbs->show(); ?>
    </div><!--End col-9-->
    <div class="col-sm-1">
	    <span class="pull-right cst-printer">
	    <a href="javascript:void(0);" onclick="$('#ele1').print();">
	    <i class="fa fa-print"></i></a>
	    </span>
    </div><!--End col-1-->
    </div><!--End row-->
    <!-------------------------End Breadcrumbs------------------------>
    
	<div id="ele1" class="h_about text-justify min-h300">
	<h3 class="heading"><span><?php echo $this->lang->line('view_message'); ?></span></h3>    
     
     <div class="row">
     	<div class="col-sm-4">
     	
     	<div class="cont_box">
		  <div class="box_content">
		   <img src="<?php echo $img; ?>" alt="<?php echo $title; ?>">
		   <p class="text-center"><b><?php echo $title;?></b></p>
		   <p class="text-center"><?php echo $designation;?></p>
		  </div>
		</div><!--End cont_box-->
     		
     	</div><!--End column 4-->
     	<div class="col-sm-8">
     		<p><?php echo $message;?></p>
     	</div><!--End column 8-->
     </div><!--End row-->
      
    </div><!--End h_about--> 
	</div><!--column-8-->
<!----------------------------------------Start Right Bar------------------------------------------------->
	<div class="col-md-3">
		<?php $this->view('element/inc_rightbar'); ?>
	</div><!--End-col-3-->

</div><!--End row-->