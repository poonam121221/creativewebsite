<div id="information-information" class="container">
            
            <div class="row">
                <div id="content" class="col-sm-12">
                    <div id="cmsblock-24" class="cmsblock">
                      <div class='description'>
                          <div class="dynamic-about">
                              <h1><?php echo (isset($DataList)) ? stripslashes2(html_entity_decode($DataList->page_title_hi)) : ""; ?></h1>
                              <img src="<?php echo base_url('assets/img/bg-title-aboutus.png'); ?>" alt="bg title">
                          </div>
                      </div>
                    </div>
                </div>

               
            </div>
        </div>

        <div class="content-wrapper">
            <div id="information-information" class="container">
                <div class="row">
                    <div class="col-sm-offset-1 main-about-section">
                            <img class="profile" src="<?php echo base_url('assets/img/profile.jpeg'); ?>">
                            <div class="about-content">
                                <?php echo (isset($DataList)) ? stripslashes2(html_entity_decode($DataList->page_description_hi)) : ""; ?>
                                <h4>Pallavi - <span>CEO <span></span></span></h4>
                            </div>
                    </div>
                </div>
            </div>

        </div>
        

       <?php $this->view('element/inc_newsletter'); ?>