 <?php // get the data and pass it to your view
 $token_name = $this->security->get_csrf_token_name();
 $token_hash = $this->security->get_csrf_hash();
 echo form_input(array('type'  => 'hidden','id'=>'sysToken','name'=>$token_name,'value'=>$token_hash));
 ?>
 <?php $ajaxPagination = $this->ajax_pagination->create_links(); ?>
	<?php 	
	if(isset($DataList) && count($DataList)>0  && $DataList !=FALSE){
	$i = (isset($ajaxPagination['s_no']))?$ajaxPagination['s_no']:1;
	foreach($DataList as $row){	
	 $src = "";
	 $img = base_url('assets/img/default.jpg');
     if(trim($row->attachment)!=''){
	  $img = base_url('uploads/files/').trim($row->attachment);
	 }
	?> 

    <div class="col-md-4">
      <div style="border:solid 1px #ccc; border-radius:6px; text-align: center;">
        <div class="gallery-img" style="margin-top:10px;margin-bottom:10px;">
          <img src="<?php echo $img;?>" alt="<?php echo $row->title; ?>" title="<?php echo $row->title; ?>" style="height:100px;">
          <i class="mdi mdi-call-made"></i>
        </div>
        <div class="desp" style="border:solid 1px #ccc;">
          <span class="event-date">
            <h5 style="display: block; background:#424242; color: #fff; padding: 10px;"><?php echo html_escape(stripslashes2(html_entity_decode($row->title))); ?>
                <span class="designation" style="font-size: 14px; display: block;"><?php echo html_escape($row->designation).' - '.html_escape($row->location); ?></span>
            </h5>
          </span>
        <div class="contact-info" style="min-height: 50px;">
          <?php if($row->email_address){ ?>
            <p class="contact-no">                     
              <?php echo html_escape(stripslashes2(html_entity_decode($row->email_address))); ?>
            </p>
          <?php } ?>
          <?php if($row->phone_number){ ?>
            <p class="contact-no">
              <?php echo html_escape(stripslashes2(html_entity_decode($row->phone_number))); ?>
            </p>
          <?php } ?>
        </div>
        </div>           
      </div>
    </div>


	<?php 
	$i = $i+1;
	 }//end foreach
	 }else{
	   echo '<br><div class="col-md-12"><p class="text-center">'.$this->lang->line('record_not_found').'</p></div>';
	 }//end if
	?>
<div class="clearfix"></div>
<div class="col-md-12">
  
  <?php if(isset($ajaxPagination['output'])){ echo $ajaxPagination['output']; }?>
</div>

 