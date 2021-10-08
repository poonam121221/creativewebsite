        <div id="information-information" class="container">
            
            <div class="row">
                <div id="content" class="col-sm-12">
                    <div id="cmsblock-24" class="cmsblock">
                      <div class='description'>
                          <div class="dynamic-about">
                              <h1><?php echo (isset($DataList)) ? stripslashes2(html_entity_decode($DataList->title)) : ""; ?></h1>
                              <img src="<?php echo base_url('assets/img/bg-title-aboutus.png'); ?>" alt="bg title">
                              <p><?php echo (isset($DataList)) ? stripslashes2(html_entity_decode($DataList->description)) : ""; ?></p>
                              <h4>Pallavi - <span>CEO <span></span></span></h4>
                          </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>

       <?php $this->view('element/inc_newsletter'); ?>