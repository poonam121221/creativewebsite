<div class="main-content">
 <div class="sec-pad">
  <div class="container">
  
  <h2 class="inner-title"><?php echo $this->lang->line('hospital_details'); ?></h2>
  <div class="row">
    <div class="col-md-12">
    <button type="button" class="btn btn-info btn-sm float-right btn-print" onclick="$('#ele1').print();">
     <span class="mdi mdi-printer"></span> Print</button>
	<!-------------------------Breadcrumbs--------------------------->
	  <?php echo $this->breadcrumbs->show(); ?>
	<!-------------------------End Breadcrumbs------------------------> 
    </div>
  </div>
  
  <div id="ele1" class="text-justify">
  <div class="about inner-page">
  
   <div class="borderdiv">    
        
 <!---------------------------------------------------->
<div id="ele1">
<?php if(isset($DataList)){ ?>
<div class="eventframe">
<?php 
$image = 'assets/img/img-not-found.png';
if(trim($DataList->attachment)!=""){
 $image = 'uploads/events/'.$DataList->attachment;
}
echo img(array('src'=>$image,'title'=>html_escape($DataList->title)));	
?>
    <h3 class="event-title text-left"><?php echo html_escape($DataList->title); ?></h3>
    <p><strong><em class="fa fa-hospital-o"></em> <?php echo $this->lang->line('hospital_type'); ?></strong> : <?php echo html_escape($DataList->cat_title); ?></p>
    <p><strong><em class="fa fa-map-marker"></em> <?php echo $this->lang->line('address'); ?></strong> : <?php echo html_escape($DataList->address); ?></p>
    <?php if(trim($DataList->title)!=""){ ?>
    <a target="_blank" href="<?php echo $DataList->web_url;?>" ><strong><em class="fa fa-globe"></em> <?php echo $this->lang->line('website'); ?></strong></a>	
    <?php } ?>
    <p><?php echo stripslashes2(html_entity_decode($DataList->description)); ?></p>
    <a class="btn btn-primary mt-3" href="<?php echo base_url('hospital');?>" ><?php echo $this->lang->line('back'); ?></a>
</div>
<?php }//end check isset Datalist ?>	      
	  
</div><!--End ele1-->
<!---------------------------------------------------->   
<div class="clearfix"></div>
</div><!--End borderdiv-->
   
</div><!--End about-->
</div><!--End ele1-->
</div><!--End container-->
</div><!--End sec-pad-->
</div><!--End main-content-->