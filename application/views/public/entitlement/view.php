<div class="main-content">
 <div class="sec-pad">
  <div class="container">
  
  <h2 class="inner-title"><?php echo $this->lang->line('check_entitlement'); ?></h2>
  <div class="row">
    <div class="col-md-12">
	<!-------------------------Breadcrumbs--------------------------->
	  <?php echo $this->breadcrumbs->show(); ?>
	<!-------------------------End Breadcrumbs------------------------> 
    </div>
  </div>
  
  <div id="ele1" class="text-justify">
  <div class="about inner-page">
  
   <div class="borderdiv detail-page">    
        
 <!---------------------------------------------------->
	<?php if(isset($DataList)){ ?>
	
		<h3><?php echo html_escape($DataList->title); ?></h3>
        <div class="event-detaile-desc">
         	<p><?php echo stripslashes2(html_entity_decode($DataList->description)); ?></p>
         	<p>
	  	    <a class="btn btn-primary" href="<?php echo base_url('entitlement');?>" >
	  	    <?php echo $this->lang->line('back'); ?>
	  	    </a>
	        </p>
        </div><!--End event-detaile-desc-->
	 <?php }//end check isset Datalist ?>	      
	 
 <!---------------------------------------------------->   
    <div class="clearfix"></div>
   </div><!--End borderdiv-->
   
  </div><!--End about-->
  </div><!--End ele1-->
  </div><!--End container-->
  </div><!--End sec-pad-->
</div><!--End main-content-->