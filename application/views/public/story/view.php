<article id="fontSize" class="min_350 noise_bg">
 <div class="page_title">
 	<div class="h2 title_text"><?php echo $this->lang->line('success_story'); ?></div>
    <!-------------------------Breadcrumbs--------------------------->
    	<?php echo $this->breadcrumbs->show(); ?>
    <!-------------------------End Breadcrumbs------------------------> 
 </div><!--End page-title--> 

<div class="container content_box">

	<div id="ele1">
	<?php if(isset($DataList)){ ?>
	
	    <?php if(trim($DataList->attachment)!=""){ ?>
			<img title="<?php echo html_escape($DataList->title); ?>" src="<?php echo base_url('uploads/files/'.$DataList->attachment); ?>" class="img-responsive event-detaile-thumb center-block" />
		<?php } ?>
		<h3><?php echo html_escape($DataList->title); ?></h3>
		<div class="event-detaile-control">
         	<span><i class=" icon-calendar2"></i> <?php echo get_date($DataList->added_date,'d-m-Y');?></span>
        </div><!--End event-detaile-control-->
        <div class="event-detaile-desc">
         	<p><?php echo stripslashes2(html_entity_decode($DataList->description)); ?></p>
         	<p>
	  	    <a class="btn btn-primary" href="<?php echo base_url('story');?>" >
	  	    <?php echo $this->lang->line('back'); ?>
	  	    </a>
	        </p>
        </div><!--End event-detaile-desc-->
	 <?php }//end check isset Datalist ?>	      
	  
     </div><!--End ele1-->

</div><!--End container-->
</article>