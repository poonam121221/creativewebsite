<?php 
 /**
 * @param1 slider category value 1 or empty param for top slider ex. getSlider() or getSlider(1)
 * @param1 slider category value 2 for bottom slider ex. getSlider(2)
 * @param2 slider limit default 10 ex getSlider(1,5) :- top slider and limt 5
 **/
 
 $SliderBottomRec = getSlider(2);
 if(count($SliderBottomRec)>0){
?>
<!------------------------Start Photo Gallery-------------------------------->
<div id="storySection">
    <div class="container">
      <div class="col-md-3 left-col text-center">
          <div class="title h3"><?php echo $this->lang->line('photo_gallery');?></div>
          <div class="sub-title"></div>
          <a href="<?php echo base_url('photo-gallery');?>" class="btn btn-main btn-flex"><?php echo $this->lang->line('view_all'); ?></a>
      </div>
        <div class="col-md-9">
         <div id="gallerySlider">
	    <div class="gallery-slider">
	    <?php foreach($SliderBottomRec as $val) { ?>	
	    <div>
	      <a data-fancybox="gallery" href="<?php echo base_url('uploads/slider/').$val->attachment; ?>" title="Gallery 1">
	      <div class="gallery-item">
	        <div class="gallery-img">
	          <img data-lazy="<?php echo base_url('uploads/slider/').$val->attachment; ?>" alt="Gallery 1">
	        </div>
	      </div>
	      </a>
	    </div>
	    <?php } ?> 
	    </div><!--End gallery-slider-->
	</div><!--End gallerySlider-->
        </div>
    </div>
</div>

<?php }//end check record ?>    
<!------------------------End Photo Gallery---------------------------------->
<!-- gallery -->