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
                      <?php 
                      $ImagePath = base_url('assets/img/img-not-found.png');
                      if(trim($DataList->attachment)!=""){
                        $ImagePath = base_url('uploads/project/').html_escape($DataList->attachment);
                      } 
                     ?>
                     <table class="table table-border">
                      <tr>
                        <td><?php echo $this->lang->line('start_date');?> : <?php echo get_date($DataList->event_start_date,'d-m-Y');?></td>
                        <td align="center"> <?php echo $this->lang->line('end_date');?> : <?php echo get_date($DataList->event_end_date,'d-m-Y');?></td>
                         
                      </tr>
                    </table>
                      <div><?php echo html_escape($DataList->title.'('.$DataList->cat_title.')'); ?></div>
                      <div class="single-event-image" style="background-image: url('<?php echo $ImagePath; ?>')" title="<?php echo html_escape($DataList->title); ?>"></div>
                      <div class="event-description"> <?php echo stripslashes2(html_entity_decode($DataList->description)); ?> </div>   
                          <?php
                            $str = '';
                            if(trim($DataList->attachment)){
                               $str .= '<div class="gallery-item">
                                          <a data-fancybox="gallery" href="'.$ImagePath.'" title="View Detail">
                                                <div class="gallery-img">
                                                  <img src="'.$ImagePath.'" alt="vcr-main">
                                                </div>
                                              </a>                                         
                                              </div>';
                            }
                            foreach($mediaList as $row){                                
                                        if(trim($row['attachment'])==""){
                                          $photo = base_url().'assets/img/img-not-found.png';
                                        }else{
                                          $photo = base_url('uploads/projectmedia/').html_escape($row['attachment']);
                                        }

                                      $str .= '<div  class="gallery-item">
                                                <a data-fancybox="gallery" href="'.$photo.'" title="View Detail">
                                                <div class="gallery-img">
                                                  <img src="'.$photo.'" alt="vcr-main">
                                                </div>
                                                </a>                                                
                                              </div>';
                            }
                          ?>        
    
                        <div class=" ">
                            <div class="">
                                <h2 class="heading"><?php echo $this->lang->line('photo_gallery');?></h2>
                                <div class="projectmedia-slider slider1 mt-5">
                                   <?php echo $str; ?>      
                                </div>                
                            </div>
                        </div>
                   
                    </div>

        
                    <span class="last-update"><em class="icon-calendar3"></em> <?php echo getModifiedDate($DataList->added_date,$DataList->edit_date); ?> </span>
                </div>

                          

            </div>
        </div>
    </div>
</div>

