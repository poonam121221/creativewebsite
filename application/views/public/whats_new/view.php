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

            <div class="col-md-9 no-padding">
                <div class="aboutus-midinner-wrapper">
                    <h2><?php echo (isset($DataList))? stripslashes2(html_entity_decode($DataList->title)):"" ; ?></h2>
                  
                     <?php if(trim($DataList->attachment)!="" && $DataList->attachment!=NULL){?>
	  	<p><a class="btn btn-success" target="_blank" href="<?php echo base_url('uploads/files/').$DataList->attachment;?>"><?php echo $this->lang->line('download_attachment'); ?></a>
	  	
	  	</p>
	  <?php }?>
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