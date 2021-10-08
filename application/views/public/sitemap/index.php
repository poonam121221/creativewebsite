<!-- banner -->
<div class="inner-header">
    <div class="container">
        <h3><?php echo $this->lang->line('sitemap'); ?></h3>
    </div>
</div>

<div class="fontresize">
    <div class="inner-pages">
        <!-- Breadcrumb -->
        <div class="container">
            <?php $this->load->view('element/inc_breadcrum'); ?>
            <!-- Breadcrumb -->
            <div class="row">
                <div class="col-md-4">
                    <?php $this->load->view('element/inc_sidebar'); ?>                
                </div>
                <div class="col-md-8">
                    <!-- <h4 class="main-inner-heading">Project Management Consultancy</h4> -->
                    <div class="innerpage-block">
                          <div class="row">
                            <div class="col-xs-12 col-sm-4 col-md-4">
                      <?php
                        $rs = customFrontMenu(0, TRUE);
                        if (count($rs) > 0) {
                            echo getSpecificMenuListById($rs, 0,'<i class="fa fa-folder-open"></i>');
                        } else {
                            ?>
                            <ul>
                                <li class="text-center"><?php echo $this->lang->line('record_not_found'); ?></li>
                            </ul>
                            <?php
                        }//end if count      
                        ?>         
                            </div>
                    </div>
                    </div>
                    <span class="last-update"><em class="icon-calendar3"></em> <?php echo isset($LastUpdatedDate)?  '<span class="updateinfo">'.$this->lang->line('last_updated').':'. $LastUpdatedDate.'</span>': ''; ?> </span>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('element/inc_footer_slider'); ?>

