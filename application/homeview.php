   <div class="container">
       <div class="home-fixed-slider pr mt-3">
        <?php  $this->view('element/inc_slider'); ?>
        <!-- NEWS -->
		<?php $news = getNews($limit = 2, $view_all = TRUE, $condition = array('is_alert'=>1), $class_name = "newsticker");
		if($news){
		?>
        <div class="container pr">
          <div class="d-flex news-box flex-column col-sm-4 pad0">
            <div class="news-txt">
              <div class="ticker-controls float-left">
                <span class="news-title"><?php echo $this->lang->line('latest_news'); ?></span>&nbsp;
              </div>
              <div class="news-arrow float-right">
                <span class="fa fa-angle-left" id="prev-button"></span>
                <span class="fa fa-play" id="start-button"></span>
                <span class="fa fa-pause" id="stop-button"></span>
                <span class="fa fa-angle-right" id="next-button"></span>
              </div>
              <div class="clearfix"></div>
            </div>
            <div class="news-list">
			 <?php echo $news ?>
              
            </div>
          </div>
        </div>
		<?php } ?>
        <!-- PARTICLE -->
       
      </div>
      <!-- banner end -->
      <div class="fontresize" id="content-section">
      <!-- about -->
      <div class="py-3 about" id="about">
        <div class="container">
          <div class="row">
            <div class="col-md-12 abttxt">
			<?php
                    if ($DataList != FALSE) {
                        if (checkLanguage("english")) {
                            $PageTitle = ucwords(html_escape($DataList->page_title_en));
                            $PageDesc = $DataList->page_description_en;
                        } else {
                            $PageTitle = stripslashes2(html_entity_decode($DataList->page_title_hi));
                            $PageDesc = $DataList->page_description_hi;
                        }//end check language
                    }
                    ?>
                    <div class="text-center">
              <h2 class="title_mid"><?php echo $PageTitle; ?></h2>
              </div>
              <p><?php echo word_limiter($PageDesc,120); ?></p>
              <a href="<?php echo base_url('about-us'); ?>" class="btn btn-main mt-3"><?php echo $this->lang->line('read_more'); ?></a>
            </div>
            
          </div>
        </div>
      </div>
     
      
      <section class="profile-section">
        <div class="container">            
            <div class="">
              <div class="col-xs-12 col-sm-12 col-md-12 no-padding-left text-center">
      <h2 class="title_mid"> <?php echo $this->lang->line('driving_force'); ?> </h2>
    </div>
            <div class="center guidingforce">
               <?php $this->load->view('element/inc_driving_force'); ?>
            </div>
               
                      
                        
            </div>
        </div>
    </section>
      
      <div class="block4 py-3">
        <div class="container">
         <div class="text-center">
              <h2 class="title_mid"><?php echo $this->lang->line('public_utility');; ?></h2>
              </div>
          <div class="content-box">
            <div class="row m-0">
              <div class="col-md-4 p-0">
                <div class="card detail">
                  <h4 class="listheading">
                    <?php echo $this->lang->line('circular').'/'.$this->lang->line('notice'); ?></h4>
                  <div class="card-body eventlist">
                    <?php echo getCirculars(); ?>
                  </div>
                  <div class="card-footer text-right">
                    <a href="<?php echo base_url('circular'); ?>" class="btn btn-main"><?php echo $this->lang->line('read_more'); ?></a>
                  </div>
                </div>
              </div>
              <div class="col-md-4 p-0">
                <div class="card detail">
                  <h4 class="listheading bg-orange">
                    <?php echo $this->lang->line('news_announcements'); ?></h4>
                  <div class="card-body eventlist">
                    <?php $getnews = getNews($limit = 5, $view_all = TRUE, $condition = array(), $class_name = "");
                        if($getnews){
                            echo $getnews;
                        }else{
                           echo $this->lang->line('record_not_found');
                        }
                    ?>
                  </div>
                  <div class="card-footer text-right">
                    <a href="<?php echo base_url('news-details');?>" class="btn btn-main"><?php echo $this->lang->line('read_more'); ?></a>
                  </div>
                </div>
              </div>
			  
              <div class="col-md-4 p-0">
                <div class="card detail">
                  <h4 class="listheading">
                    <?php echo $this->lang->line('useful_links'); ?></h4>
                  <div class="card-body eventlist linklist ">
                    <?php echo getImpLinks(5);?>
                  </div>
                  <div class="card-footer text-right">
                    <a href="<?php echo base_url('important-links');?>" class="btn btn-main"><?php echo $this->lang->line('read_more'); ?></a>
                  </div>
                </div>
              </div>
				
            </div>
          </div>
        </div>
      </div>
      <div class="events container">
       <div class="text-center">
              <h2 class="title_mid"><?php echo $this->lang->line('project'); ?></h2>
              </div>
    <div class="event-box">
    <div class="row">
    <div class="col-xs-12 col-sm-6 col-md-6">
    </div>
        	<div class="col-xs-12 col-sm-6 col-md-6 text-right">
       <a href="<?php echo base_url('project'); ?>" class="btn btn-main mb-3" data-toggle="tooltip" title="<?php echo $this->lang->line('view_all');?>"> <?php echo $this->lang->line('view_all');?> </a>
            </div>
        </div>
    
    <?php /*?>  <div class="sub-title"><?php  if(checkLanguage("english")){ echo  'Events, Schemes & announcement'; }else {echo  'आयोजन, योजनाएं और घोषणां';} ?> </div><?php */?>
      <div class="row mt-20">
      	<div class="col-xs-12 col-sm-12 col-md-12">
        	<div class="article">
                  <?php ?><?php echo getProject(10); ?><?php ?> 
                </div>
            </div>
        </div>
       </div>
     </div>
  </div>
        <?php /*?><div class="block4 pb-5">
        <div class="container">
          <div class="content-box">
            <div class="row m-0">
      <div class="col-md-12">
        <div class="article">
            
                   
                <?php echo getEvent(4); ?>    
                   
                   
                     
              
  </div>
  </div>
  </div>
  </div>
  </div>
  </div><?php */?>
      <!-- gallery -->
	  <?php /* $gallery = getSlider(2); 
	  if($gallery){
	  ?>
      <div class="events-wrapper">
        <div class="container">
          <div class="content-box bgray">
            <h2 class="heading-sm gray"><?php echo $this->lang->line('photo_gallery'); ?></h2>
            <a href="<?php echo base_url('photo-gallery'); ?>" class="btn btn-main btn-sm btn-right">View Galley page</a>
            <div class="gallery-slider">
			<?php foreach($gallery as $g){ ?>
              <div>
                <a data-fancybox="gallery" href="<?php echo base_url('uploads/slider/'.$g->attachment);?>" title="<?php echo $g->title;?>">
                  <div class="gallery-item">
                    <div class="gallery-img">
                      <img src="<?php echo base_url('uploads/slider/'.$g->attachment);?>" alt="<?php echo $g->title;?>">
                      <span class="mdi mdi-plus"></span>
                    </div>
                    <div class="desp"><?php echo $g->title;?></div>
                  </div>
                </a>
              </div>
			<?php } ?>
              
            </div>
          </div>
        </div>
      </div>
	  <?php } */ ?>
      <!-- gallery end -->
        </div>
     </div>
	<!--end main content -->
    <!-- partners -->
    <?php $this->load->view('element/inc_footer_slider'); ?>
    <!-- partners end-->
  