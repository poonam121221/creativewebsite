<!-- banner -->
<div class="inner-header">
    <div class="container">
        <h3><?php echo (isset($DataList))? stripslashes2(html_entity_decode($DataList->title)):"" ; ?></h3>
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
                        <div class="pagedetail">
                            <?php echo (isset($DataList))? stripslashes2(html_entity_decode($DataList->description)):""; ?> 
                            <br>
                            <?php if(trim($DataList->attachment)!="" && $DataList->attachment!=NULL){?>
                            <p><a class="btn btnmore" target="_blank" href="<?php echo base_url('uploads/files/').$DataList->attachment;?>"><?php echo $this->lang->line('download_attachment'); ?></a>

                            </p>
                            <?php }?>

                        </div>
                    </div>
                    <span class="last-update"><em class="icon-calendar3"></em> <?php echo isset($LastUpdatedDate)?  '<span class="updateinfo">'.$this->lang->line('last_updated').':'. $LastUpdatedDate.'</span>': ''; ?> </span>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('element/inc_footer_slider'); ?>