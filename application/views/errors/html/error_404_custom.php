<!-- banner -->
<div class="inner-header">
    <div class="container">
        <h3><?php echo $this->lang->line('error_page'); ?></h3>
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
                          <div class="text-center">
       <div class="errorcode">4<em class="fa fa-times-circle-o"></em>4</div>
       <p class="errormsg"><?php echo $this->lang->line('page_not_found');?></p>
       <hr/>
       <a href="<?php echo base_url('/');?>" class="btn btn-sm btn-success"><span class="mdi mdi-arrow-left"></span> <?php echo $this->lang->line('back_to_home_page'); ?></a>
      </div>
                    </div>
                    <span class="last-update"><em class="icon-calendar3"></em> <?php echo isset($LastUpdatedDate)?  '<span class="updateinfo">'.$this->lang->line('last_updated').':'. $LastUpdatedDate.'</span>': ''; ?> </span>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('element/inc_footer_slider'); ?>

