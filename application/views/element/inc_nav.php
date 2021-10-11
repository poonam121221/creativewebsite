<?php 
$siteDetails = getSiteDetails();
?>
<header class="header-area">
    <div class="top-bar">
        <div class="container">
            <div class="clearfix">
                <ul class="top-bar-text float_left">
                    <li><i class="fa fa-map-signs"></i>1st Floor, 44 Zone 2 Maharana Pratap Nagar, Bhopal, M.P.</li>
                    <li><i class="fa fa-clock-o"></i>Monday - Saturday 9:00 AM To 6:00 PM </li>
                </ul>
                <ul class="social float_right">


                    <li><a href="https://www.naukri.com/recruiters/mrsameeragrawal-3234404"><i class="fa fa-user"></i></a></li>
                    <li><a href="https://www.facebook.com/3SPResources/"><i class="fa fa-facebook"></i></a></li>

                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                    <li><a href="#"><i class="fa fa-skype"></i></a></li>
                </ul>
        
            </div>
                

        </div>
    </div>
    <div class="header-bottom">
        <div class="container">
            <div class="header-bottom-bg clearfix">
                <div class="main-logo float_left logo-width">
                    <a href="index.php"><img src="<?php echo base_url('assets/images/logo/3splogo.png'); ?>" alt="3SP Logo" class="logo-maxwidth"></a>
                </div>
                <div class="top-info float_right" style="margin-top:2%;">
                    <ul>
                        <li class="single-info-box">
                            <div class="icon-holder">
                                <span class="icon-technology"></span>
                            </div>
                            <div class="text-holder">
                                <p><span>Call Us Now</span><br>+91 0755-4915600</p>
                            </div>
                        </li>
                        <li class="single-info-box">
                            <div class="icon-holder">
                                <span class="icon-multimedia"></span>
                            </div>
                            <div class="text-holder">
                                <p><span>Send Us Mail</span> <br>info@3spresource.com </p>
                            </div>
                        </li>
                        
                    </ul>    
                </div> 

                
            </div>
            
            <div class="clearfix">
            <div class="col-xs-2">
            <a class="thm-btn yellow-bg hot-job">Hot Jobs</a>
            </div>
            <div class="col-xs-10">
            <marquee class="marquee-contain">
            
            <?php //$jobs = $db->getRows("select * from current_opening where status = 1"); 

        // foreach($jobs as $job){  ?>
            
            <!-- <a class="current-openings" target="_blank" href="<?=$job['naukri_link']?>"><?=$job['job_role']?></a> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; -->
            
            <?php // }  ?>

            
            
            </marquee>
            </div>
            
            </div>
        
        </div>
    </div>  
</header>

<!-- Menu ******************************* -->
<section class="theme_menu stricky">
    <div class="container">
        <div class="menu-bg">
            <div class="row">
                <div class="col-md-12 menu-column">
                    <nav class="main-menu">
                        <div class="navbar-header">     
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="navbar-collapse collapse clearfix">

                        <?php
                        $menu = array('menus' => array(), 'parent_menus' => array());
                        $menus = customFrontMenu();
                        if (isset($menus) && !empty($menus)):
                            foreach ($menus as $menu1) {
                                $menu['menus'][$menu1['id']] = $menu1;
                                $menu['parent_menus'][$menu1['p_menu_id']][] = $menu1['id'];
                            }
                            echo buildFrontTopMenu(0, $menu);
                        endif; //End check $menus Variable is set of not
                        ?>


                            <!-- <ul class="navigation clearfix">

                                <li class="home"><a href="index.php"><span class="fa fa-home"></span></a></li>

                               
                                <li class="dropdown"><a href="#">About us</a>
                                    <ul class="submenu">
                                        <li><a href="about.php">Company Profile</a></li>
                                        <li><a href="our-commitment.php">Our Commitment</a></li>
                                        <li><a href="our-focus.php">Mission/Vision/Values</a></li>
                                         <li><a href="team.php">Meet Our Team</a></li>
                                        <li><a href="clients-reviews.php">Client Reviews</a></li>
                                    </ul>
                                </li>



                                <li class="dropdown"><a href="#">Our services</a>
                                    <ul class="submenu">
                                        <li><a href="manpower.php"> Manpower Recruitment Services </a></li>
                                        <li><a href="placement-services.php">Placement Services</a></li>
                                        <li><a href="outsourcing-staffing.php">Temp staffing</a></li>
                                        <li><a href="training.php">Training</a></li>
                                        <li><a href="it-services.php">IT Services</a></li>
                                        
                                     </ul>
                                </li>

                                <li class="dropdown"><a href="#">Job Seeker</a>
                                    <ul class="submenu">
                                        <li><a href="post-resume.php">Post Resume</a></li>
                                          <li><a href="career-article.php">Career Article</a></li>
                                    </ul>
                                </li>

                               


                                  <li><a href="industries-we-serve.php">Industries We Serve</a></li>


                                <li><a href="contact.php">CONTACT US</a></li>

                                 <li><a class="thm-btn yellow-bg" href="current-opening.php" style="padding: 9px 18px 7px;">Current Openings</a></li>
                            </ul> -->

                             <ul class="mobile-menu clearfix">

                                 <li class="home"><a href="index.php"><span class="fa fa-home"></span></a></li>

                               
                                <li class="dropdown"><a href="#">About us</a>
                                    <ul class="submenu">
                                        <li><a href="about.php">Company Profile</a></li>
                                        <li><a href="our-commitment.php">Our Commitment</a></li>
                                        <li><a href="our-focus.php">Mission/Vision/Values</a></li>
                                         <li><a href="team.php">Meet Our Team</a></li>
                                        <li><a href="clients-reviews.php">Client Reviews</a></li>
                                    </ul>
                                </li>



                                <li class="dropdown"><a href="#">Our services</a>
                                    <ul class="submenu">
                                        <li><a href="manpower.php"> Manpower Recruitment Services </a></li>
                                        <li><a href="placement-services.php">Placement Services</a></li>
                                        <li><a href="outsourcing-staffing.php">Temp staffing</a></li>
                                        <li><a href="training.php">Training</a></li>
                                        <li><a href="it-services.php">IT Services</a></li>
                                     </ul>
                                </li>

                                <li class="dropdown"><a href="#">Job Seeker</a>
                                    <ul class="submenu">
                                        <li><a href="post-resume.php">Post Resume</a></li>
                                          <li><a href="career-article.php">Career Article</a></li>
                                  <!--   <li><a href="gallery.php">Our Gallery</a> </li> -->
                                    </ul>
                                </li>

                               


                                  <li><a href="industries-we-serve.php">Industries We Serve</a></li>


                                <li><a href="contact.php">CONTACT US</a></li>

                                 <li><a class="thm-btn yellow-bg" href="current-opening.php" style="padding: 9px 18px 7px;">Current Openings</a></li>
                            </ul>
                        </div>
                    </nav> 
                </div>

             
            
            </div>
        </div>      

   </div> <!-- End of .conatiner -->
</section> <!-- End of .theme_menu -->


