<?php
  $ImagePath = base_url('assets/img/img-not-found.png');
  if(trim($DataList->attachment)!=""){
    $ImagePath = base_url('uploads/testimonial/').html_escape($DataList->attachment);
  } 
 ?>

 <!-- banner -->
<div class="inner-header">
    <div class="container">
        <h3><?php echo html_escape($DataList->title); ?></h3>
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
                    <div class="single-event-image" style="background-image: url('<?php echo $ImagePath; ?>')" title="<?php echo html_escape($DataList->title); ?>"></div>
                                    <p class="quotes">
                                        <?php echo html_escape($DataList->description); ?>
                                    </p>
                                    
                                </div>
                    <span class="last-update"><em class="icon-calendar3"></em> Latest Update on <?php //echo getModifiedDate($DataList->added_date,$DataList->edit_date); ?> </span>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('element/inc_footer_slider'); ?>