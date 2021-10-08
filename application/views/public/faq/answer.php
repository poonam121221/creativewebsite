<div class="about-inner-wrapper">
    <div class="container">
        <div class="row">

            <div class="col-md-9 no-padding">
                <div class="aboutus-midinner-wrapper">
                    <h2><?php echo $DataList->question; ?></h2>
                    
					<div class="clearfix"><p></p></div>
		
		<!---------------------------------------------------->
		<?php ECHO $DataList->answer;?>
		<div class="clearfix"></div>	

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
