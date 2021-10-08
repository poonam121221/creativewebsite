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
	
      <h3 class="heading"><span><?php echo $this->lang->line('schemes_detail'); ?></span></h3>
      <div class="noticeboard_posted_on">
      <?php if(isset($DataList)){ ?>
      
	  <h3 class="font-18"><?php echo stripslashes2(html_entity_decode($DataList->title)); ?></h3>
      </div><!--End noticeboard_posted_on-->
      <?php echo stripslashes2(html_entity_decode($DataList->description)); ?>
      
      
      <?php if(trim($DataList->attachment)!=""){ ?>
	 	<a href="<?php echo base_url('uploads/files/').$DataList->attachment; ?>" target="_blank" class="btn btn-success">Download</a>
	 <?php  	
	  }//end check attachement
	  }//end check DataList is empty or not
	?>
	<div class="clearfix"><p></p></div>
	<hr class="style1"/>
      <p>
	  	<a class="btn btn-primary" href="<?php echo base_url('schemes');?>" ><?php echo $this->lang->line('back'); ?></a>
	  </p>
	  
     </div><!--End h_about-->
    
	</div><!--column-8-->
<!----------------------------------------Start Right Bar------------------------------------------------->
	<div class="col-md-3">
		<?php $this->view('element/inc_rightbar'); ?>
	</div><!--End-col-3-->

</div><!--End row-->