<div class="about-inner-wrapper">
    <div class="container">
        <div class="row">
             <div class="col-xs-12 col-sm-6 col-md-6">
                <div class="brudcrum-wrapper"><?php echo $this->breadcrumbs->show(); ?></div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 printbtn-wrapper">
                <button type="button" class="btn btn-warning btn-print" onclick="$('#ele1').print();">
     <span class="fa fa-print"></span> Print</button>
            </div>
        </div>
        <div class="row">

            <div class="col-md-9 no-padding" id="ele1">
                <div class="aboutus-midinner-wrapper">
                    <h2><?php echo (isset($DataList)) ? stripslashes2(html_entity_decode($DataList->heading)) : ""; ?></h2>
                    <div class="img-container-wrap">
                      <!-- <img src="<?php echo base_url('assets/images/user_img.jpg'); ?>" class="img-responsive center-block" alt="Photo" />   -->
                        <img src="<?php echo base_url('uploads/files/' . $DataList->attachment); ?>" class="img-responsive center-block" alt="CM-Photo" />-->
                    </div>
                    <div><p><?php echo (isset($DataList)) ? stripslashes2(html_entity_decode($DataList->message)) : ""; ?></p>
                        <p><strong><?php echo (isset($DataList)) ? stripslashes2(html_entity_decode($DataList->designation)) : ""; ?></strong></p>
                    </div>
<div class="last-update-text"><p><?php echo isset($LastUpdatedDate)?  $this->lang->line('last_updated').':'. $LastUpdatedDate: ''; ?></p></div>
                </div>
            </div>

            <div class="col-md-3 no-padding">

                <?php echo getWhatsNew(); ?>

                <?php echo EmergencyContact(); ?>

            </div>

        </div> 
    </div>

</div>
<?php $this->load->view('element/inc_footer_slider'); ?>