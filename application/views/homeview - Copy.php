
      <!-- banner -->
      <div class="home-fixed-slider pr">
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
        <div id="particles-js"></div>

      </div>
      <!-- banner end -->
      <div class="fontresize" id="content-section">
      <!-- about -->
      <div class="py-3 about" id="about">
        <div class="container">
          <div class="row">
            <div class="col-md-7 abttxt">
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
              <h2 class="title"><?php echo $PageTitle; ?></h2>
              <p><?php echo word_limiter(strip_tags($PageDesc),90); ?></p>
              <a href="<?php echo base_url('about-us'); ?>" class="btn btn-main mt-3"><?php echo $this->lang->line('read_more'); ?></a>
            </div>
            <div class="col-md-5">
              <div class="cm-corner  text-center d-flex pt-1">
			  <?php if(isset($header_message[0])){ ?>
			  <div>
                <div class="img-holder">
                    <img src="<?php echo $header_message[0]->attachment ? base_url('uploads/files/').$header_message[0]->attachment :base_url('assets/img/default.jpg');?>" alt="<?php echo $header_message[0]->designation;?>">
                </div>
                <div class="msg">
                  <p class="name">
                   <?php echo $header_message[0]->title;?>
                    <br>
                    <small> <?php echo $header_message[0]->designation;?></small>
                  </p>
                </div>
				</div>
			  <?php } ?>
				<?php if(isset($header_message[1])){ ?>
				<div>
                <div class="img-holder">
                    <img src="<?php echo $header_message[1]->attachment ? base_url('uploads/files/').$header_message[1]->attachment :base_url('assets/img/default.jpg');?>" alt="<?php echo $header_message[1]->designation;?>">
                </div>
                <div class="msg">
                  <p class="name">
                   <?php echo $header_message[1]->title;?>
                    <br>
                    <small> <?php echo $header_message[1]->designation;?></small>
                  </p>
                </div>
				</div>
				<?php } ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--<div class="quicklinks">
	<div class="container">
          <div class="content-box bgreen pb-4">
            <h2 class="heading-sm"><?php echo $this->lang->line('useful_links'); ?></h2>
            <div class="link-slider">
                <?php  foreach($quickLinks as $link){ ?>
                    <div>
                      <a href="<?php echo $link['url'];?>" class="sphere">
                        <span class="link-icon">
                          <span class="<?php echo $link['class'];?>"></span>
                        </span>
                        <span class="linktxt"><?php echo checkLanguage("english")?$link['title_en']:$link['title_hi'];?></span>
                      </a>
                    </div>
               <?php  } ?>
              
            </div>
          </div>
        </div>
      </div>-->
      <!-- about end -->
      <div class="block4 pb-5">
        <div class="container">
          <div class="content-box">
            <div class="row m-0">
              <div class="col-md-3 p-0">
                <div class="card detail">
                  <h4 class="listheading">
                    <?php echo $this->lang->line('circular'); ?></h4>
                  <div class="card-body eventlist">
                    <?php echo getCirculars(); ?>
                  </div>
                  <div class="card-footer text-right">
                    <a href="<?php echo base_url('notice-board'); ?>" class="btn btn-main"><?php echo $this->lang->line('read_more'); ?></a>
                  </div>
                </div>
              </div>
              <div class="col-md-6 p-0">
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
			  
              <div class="col-md-3 p-0">
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
      
        <div class="block4 pb-5">
        <div class="container">
          <div class="content-box">
            <div class="row m-0">
      <div class="col-md-12">
        <div class="article">
        <div>
     <div class="item-box-blog">
                          <div class="item-box-blog-image">
                          
                            <!--Image-->
                            <figure> <img alt="" src="https://cdn.pixabay.com/photo/2017/02/08/14/25/computer-2048983_960_720.jpg"> </figure>
                          </div>
                          <div class="item-box-blog-body">
                            <!--Heading-->
                            <div class="item-box-blog-heading">
                              <a href="#" tabindex="0">
                                <h2>News Title</h2>
                              </a>
                            </div>
                            
                            <!--Text-->
                            <div class="item-box-blog-text">
                              <p>Lorem ipsum dolor sit amet, adipiscing. Lorem ipsum dolor sit amet, consectetuer adipiscing. Lorem ipsum dolor sit amet, adipiscing. Lorem ipsum dolor sit amet, adipiscing. Lorem ipsum dolor sit amet, consectetuer adipiscing. Lorem ipsum dolor.</p>
                            </div>
                            <div class="mt"> <a href="#" tabindex="0" class="btn btn-main mt-3">read more</a> </div>
                            <!--Read More Button-->
                          </div>
                        </div>
             </div>    
               <div>
     <div class="item-box-blog">
                          <div class="item-box-blog-image">
                          
                            <!--Image-->
                            <figure> <img alt="" src="https://cdn.pixabay.com/photo/2017/02/08/14/25/computer-2048983_960_720.jpg"> </figure>
                          </div>
                          <div class="item-box-blog-body">
                            <!--Heading-->
                            <div class="item-box-blog-heading">
                              <a href="#" tabindex="0">
                                <h2>News Title</h2>
                              </a>
                            </div>
                            
                            <!--Text-->
                            <div class="item-box-blog-text">
                              <p>Lorem ipsum dolor sit amet, adipiscing. Lorem ipsum dolor sit amet, consectetuer adipiscing. Lorem ipsum dolor sit amet, adipiscing. Lorem ipsum dolor sit amet, adipiscing. Lorem ipsum dolor sit amet, consectetuer adipiscing. Lorem ipsum dolor.</p>
                            </div>
                            <div class="mt"> <a href="#" tabindex="0" class="btn btn-main mt-3">read more</a> </div>
                            <!--Read More Button-->
                          </div>
                        </div>
             </div>    
               <div>
     <div class="item-box-blog">
                          <div class="item-box-blog-image">
                          
                            <!--Image-->
                            <figure> <img alt="" src="https://cdn.pixabay.com/photo/2017/02/08/14/25/computer-2048983_960_720.jpg"> </figure>
                          </div>
                          <div class="item-box-blog-body">
                            <!--Heading-->
                            <div class="item-box-blog-heading">
                              <a href="#" tabindex="0">
                                <h2>News Title</h2>
                              </a>
                            </div>
                            
                            <!--Text-->
                            <div class="item-box-blog-text">
                              <p>Lorem ipsum dolor sit amet, adipiscing. Lorem ipsum dolor sit amet, consectetuer adipiscing. Lorem ipsum dolor sit amet, adipiscing. Lorem ipsum dolor sit amet, adipiscing. Lorem ipsum dolor sit amet, consectetuer adipiscing. Lorem ipsum dolor.</p>
                            </div>
                            <div class="mt"> <a href="#" tabindex="0" class="btn btn-main mt-3">read more</a> </div>
                            <!--Read More Button-->
                          </div>
                        </div>
             </div>    
               <div>
     <div class="item-box-blog">
                          <div class="item-box-blog-image">
                          
                            <!--Image-->
                            <figure> <img alt="" src="https://cdn.pixabay.com/photo/2017/02/08/14/25/computer-2048983_960_720.jpg"> </figure>
                          </div>
                          <div class="item-box-blog-body">
                            <!--Heading-->
                            <div class="item-box-blog-heading">
                              <a href="#" tabindex="0">
                                <h2>News Title</h2>
                              </a>
                            </div>
                            
                            <!--Text-->
                            <div class="item-box-blog-text">
                              <p>Lorem ipsum dolor sit amet, adipiscing. Lorem ipsum dolor sit amet, consectetuer adipiscing. Lorem ipsum dolor sit amet, adipiscing. Lorem ipsum dolor sit amet, adipiscing. Lorem ipsum dolor sit amet, consectetuer adipiscing. Lorem ipsum dolor.</p>
                            </div>
                            <div class="mt"> <a href="#" tabindex="0" class="btn btn-main mt-3">read more</a> </div>
                            <!--Read More Button-->
                          </div>
                        </div>
             </div>    
               <div>
     <div class="item-box-blog">
                          <div class="item-box-blog-image">
                          
                            <!--Image-->
                            <figure> <img alt="" src="https://cdn.pixabay.com/photo/2017/02/08/14/25/computer-2048983_960_720.jpg"> </figure>
                          </div>
                          <div class="item-box-blog-body">
                            <!--Heading-->
                            <div class="item-box-blog-heading">
                              <a href="#" tabindex="0">
                                <h2>News Title</h2>
                              </a>
                            </div>
                            
                            <!--Text-->
                            <div class="item-box-blog-text">
                              <p>Lorem ipsum dolor sit amet, adipiscing. Lorem ipsum dolor sit amet, consectetuer adipiscing. Lorem ipsum dolor sit amet, adipiscing. Lorem ipsum dolor sit amet, adipiscing. Lorem ipsum dolor sit amet, consectetuer adipiscing. Lorem ipsum dolor.</p>
                            </div>
                            <div class="mt"> <a href="#" tabindex="0" class="btn btn-main mt-3">read more</a> </div>
                            <!--Read More Button-->
                          </div>
                        </div>
             </div>    
                 <div>
     <div class="item-box-blog">
                          <div class="item-box-blog-image">
                          
                            <!--Image-->
                            <figure> <img alt="" src="https://cdn.pixabay.com/photo/2017/02/08/14/25/computer-2048983_960_720.jpg"> </figure>
                          </div>
                          <div class="item-box-blog-body">
                            <!--Heading-->
                            <div class="item-box-blog-heading">
                              <a href="#" tabindex="0">
                                <h2>News Title</h2>
                              </a>
                            </div>
                            
                            <!--Text-->
                            <div class="item-box-blog-text">
                              <p>Lorem ipsum dolor sit amet, adipiscing. Lorem ipsum dolor sit amet, consectetuer adipiscing. Lorem ipsum dolor sit amet, adipiscing. Lorem ipsum dolor sit amet, adipiscing. Lorem ipsum dolor sit amet, consectetuer adipiscing. Lorem ipsum dolor.</p>
                            </div>
                            <div class="mt"> <a href="#" tabindex="0" class="btn btn-main mt-3">read more</a> </div>
                            <!--Read More Button-->
                          </div>
                        </div>
             </div>    
              
  </div>
  </div>
  </div>
  </div>
  </div>
  </div>
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
  