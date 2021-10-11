<footer class="main-footer sec-padd-top" style="background-image: url(<?php echo base_url('assets/images/background/4.jpg') ?>);">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="about-widget">
                    <figure class="footer-logo"><a href="<?php echo base_url(); ?>"><img src="<?php echo base_url('assets/images/3splogo-footer.png'); ?>" alt="company logo" style="width:30%;"></a></figure>
                    
                    <div class="text">
                        <p>At 3SP Resource, We sincerely believe in rising above through innovative hiring and engaging with the most powerful asset on earth “PEOPLE”</p>
                    </div>
                    <br>
                    <ul class="contact-infos">
                        <li>
                            <div class="icon_box">
                                <i class="icon-location"></i>
                            </div><!-- /.icon-box -->
                            <div class="text-box">
                                <h5>1st Floor, 44 Zone 2 Maharana Pratap Nagar,<br> Bhopal, M.P.</h5>
                            </div><!-- /.text-box -->
                        </li>
                        <li>
                            <div class="icon_box">
                                <i class="icon-technology"></i>
                            </div><!-- /.icon-box -->
                            <div class="text-box">
                                <h5>Call Us Now</h5>
                                <p>+91 755-4915600</p>
                                <p>+91 990-7744599</p>
                            </div><!-- /.text-box -->
                        </li>
                        <li>
                            <div class="icon_box">
                                <i class="icon-multimedia"></i>
                            </div><!-- /.icon-box -->
                            <div class="text-box">
                                <h5>Send Us Mail</h5>
                                <p>info@3spresource.com</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="footer-link-widget">
                    <div class="section-title">
                        <h3>About 3SP Resources</h3>
                    </div>
                    <div class="row">
                       
                        <div class="col-md-12 col-sm-12 col-sx-12">
                            <?php echo buildFrontBottomMenu("list"); ?>
                        </div>
                         
                    </div>
                    
                </div>

                </div> 
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="footer-link-widget">
                    <div class="section-title">
                        <h3>Usefull Links</h3>
                    </div>
                    <div class="row">
                         <div class="col-md-12 col-sm-12 col-sx-12">
                            <?php echo buildFrontMiddleMenu("list"); ?>
                        </div>
                    </div>
                    <br>
                    <div class="opening-hour">
                        <h3>Office Opening Hours</h3>
                        <br>
                        <p>Monday to Saturday:     &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;           09:00 AM To 06:00 PM</p>
                        <p> Sunday:      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;        Closed</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
     
</footer>

<div class="footer-bottom">
    <div class="container">
        <div class="float_left copy-text">
            <p>Copyright © 3SP Resources 2017. All Rights Reserved. <!-- Powered by  <a href="#">Universal.</a>--></p>
            
        </div>
        <div class="float_right">
            <ul class="social">
                <li>
                    <a href="https://www.facebook.com/3SPResources/"><i class="fa fa-facebook"></i></a>                              
                </li>
                <li>
                    <a href="#"><i class="fa fa-skype"></i></a>                             
                </li>
                <li>
                    <a href="#"><i class="fa fa-linkedin"></i></a>                              
                </li>
            </ul>
        </div>

    </div>
</div>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5980a12936e61aaa"></script> 



  <!-- Scroll Top Button -->
  <button class="scroll-top tran3s color2_bg">
		<span class="fa fa-angle-up"></span>
	</button>
	<!-- pre loader  -->
	<div class="preloader"></div>

<?php 


$ip = $this->input->ip_address();
if ($this->input->valid_ip($ip)){
	createVisitor($this->uri->segment(1,"home"),$ip);
}//end check valid ip addresss

$SiteVisitorCounter = getVisitorCount();
?>




<?php echo put_footers(); //call footer js ?>

  
<?php

 echo '</div>';
 echo '</body>'.PHP_EOL;
 echo '</html>';
?>