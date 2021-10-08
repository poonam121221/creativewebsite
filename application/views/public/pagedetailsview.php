
  <!-- banner -->
<div class="inner-header">
    <div class="container">
        <h3><?php echo $this->lang->line('search'); ?></h3>
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
                    <?php
				  if(isset($DataList)){
				   foreach($DataList as $row){ ?>
				  <div class="row">
					<div class="col-sm-12">
						<h3><u><?php echo stripslashes2(html_entity_decode($row['title'])); ?></u></h3>
						<?php echo stripslashes2(html_entity_decode($row['description']));?> 	      	  
					   <div class="clearfix padd-bottom-10"></div> 
					</div>
				  </div>	
				  <?php }//end foreach
				   }//end if ?> 
                    </div>
                    <span class="last-update"><em class="icon-calendar3"></em> <?php echo isset($LastUpdatedDate)?  '<span class="updateinfo">'.$this->lang->line('last_updated').':'. $LastUpdatedDate.'</span>': ''; ?> </span>
                </div>
            </div>
        </div>
    </div>
</div>      
<?php $this->load->view('element/inc_footer_slider'); ?>