<?php
//if($DataList!=FALSE){ 
if (checkLanguage("english")) {
    $PageTitle = ucwords(html_escape($DataList->page_title_en));
    $PageDesc = $DataList->page_description_en;
} else {
    $PageTitle = stripslashes2(html_entity_decode($DataList->page_title_hi));
    $PageDesc = $DataList->page_description_hi;
}//end check language


?>


<div class="inner-banner has-base-color-overlay text-center" style="background: url(images/background/1.jpg);">
    <div class="container">
        <div class="box">
            <h3>Contact Us</h3>
        </div>
    </div>
    <div class="breadcumb-wrapper">
        <div class="container">
            <div class="pull-left">
                <ul class="list-inline link-list">
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        Contact Us
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>


<section class="contact_information sec-padd">
    <div class="container">
        <div class="tabs-outer style-two">
            <!--Tabs Box-->
            <div class="tabs-box tabs-style-one">
             <!--Tabs Content-->
                <div class="tabs-content">
                    <!--Tab / Active Tab-->
                    <div class="tab active-tab" id="Newyork" style="display: block;">
                        <div class="row">
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="item">
                                    <h5>Visit Our Office <span>India</span></h5>
                                    <ul>
                                        <li><span> 1st Floor, 44 Zone 2 </span></li>
                                        <li><span> Maharana Pratap Nagar, Bhopal, India</span></li>
                                    
                                    </ul>
                                    <span class="icon icon-location"></span>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="item">
                                    <h5>24/7 Quick Contact</h5>
                                    <ul>
                                        <li>Phone: <span> +91 0755-491-5600 </span></li>
                                        <li>Email:  <span> info@3spresource.com</span></li>
                                    </ul>
                                    <span class="icon icon-technology"></span>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="item">
                                    <h5>Working Hours</h5>
                                    <ul>
                                        <li>Monday - Saturday: <span> 09:00 AM to 6:00 PM </span></li>
                                        <li>Sunday:  <span> Closed</span></li>
                                    </ul>
                                    <span class="icon icon-square"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                
            </div>
        </div>
    </div>
</section>


<div class="container">
    <div class="border-bottom"></div>
</div>

<section class="contact_us sec-padd">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-12 col-xs-12">
                <div class="section-title">
                    <h3>Send Your Message To Us/Here</h3>
                </div>
                <p style="margin-bottom: 20px;
    color: #FF4500;
    font-family: 'Poppins', sans-serif;
    font-size: 16px;" id="RegisterFeedback"></p>
                <div class="default-form-area">
                    <form  name="contact_form" class="default-form" action="" method="post">
                        <div class="row clearfix">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                
                                <div class="form-group">
                                    <input type="text" name="form_name" id="form_name" class="form-control"  placeholder="Your Name *" required="">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <input type="email" name="form_email" id="form_email" class="form-control required email" placeholder="Your Mail *" required="">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <input type="text" name="form_phone" id="form_phone" class="form-control" placeholder="Phone">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <input type="text" name="form_subject" class="form-control" id="form_subject" placeholder="Subject *" required="">
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <textarea name="form_message" class="form-control textarea required" id="form_message" placeholder="Your Message.... *" required=""></textarea>
                                </div>
                            </div>   
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    
                                    <button class="thm-btn thm-color" name="submit" type="submit" data-loading-text="Please wait...">send message</button>
                                </div>
                            </div>   

                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4 col-sm-8 col-xs-12">
                <div class="section-title">
                    <h3>Your Contact</h3>
                </div>
                <div class="author-details">
                    <div class="item">
                        <h5>Co-Founder</h5>
                        <div class="img-box">
                            <img src="<?php echo base_url('assets/images/team/sameer.png'); ?>" alt="">
                        </div>
                        <div class="content">
                            <h5>Sameer Agrawal</h5>
                            <p><i class="fa fa-phone"></i>+91 9907-744-599</p>
                            <p style="font-size:12px;"><i class="fa fa-envelope"></i>sameer.agrawal@3spresource.com</p>
                        </div>
                    </div>
                    <div class="item">
                        <h5>Co-Founder</h5>
                        <div class="img-box">
                            <img src="<?php echo base_url('assets/images/team/veecas.jpg'); ?>" alt="">
                        </div>
                        <div class="content">
                            <h5>Veecas Jain</h5>
                            <p><i class="fa fa-phone"></i>+91 7566-001-111</p>
                            <p><i class="fa fa-envelope"></i>veecas.jain@3spresource.com</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>



<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14665.340457477852!2d77.4344869!3d23.2308894!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x360c829ffd932b65!2s3SP+Resources!5e0!3m2!1sen!2sin!4v1501648131857" width="100%" height="430" frameborder="0" style="border:0" allowfullscreen></iframe>




<script type="text/javascript" src="<?php echo base_url('webroot/'); ?>plugins/jquery.validate.min.js"></script>
<script type="text/javascript">
                                        $(function () {

                                            jQuery.validator.addMethod("alphanumspace", function (value, element) {
                                                return this.optional(element) || /^[a-zA-Z0-9\s]*$/.test(value);
                                            }, "Please enter character,number and space only.");

                                            jQuery.validator.addMethod("alphanumspacedot", function (value, element) {
                                                return this.optional(element) || /^[a-zA-Z0-9.\s]*$/.test(value);
                                            }, "Please enter character,number,dot(.) and space only.");

                                            jQuery("#frmContact").validate({
                                                rules: {
                                                    uname: {
                                                        required: true,
                                                        alphanumspace: true,
                                                        maxlength: 100
                                                    },
                                                    email: {
                                                        required: true,
                                                        email: true,
                                                        maxlength: 100
                                                    },
                                                    mobile: {
                                                        required: true,
                                                        digits: true,
                                                        minlength: 10,
                                                        maxlength: 10
                                                    },
                                                    subject: {
                                                        required: true,
                                                        alphanumspace: true,
                                                        maxlength: 100
                                                    },
                                                    message: {
                                                        required: true,
                                                        alphanumspacedot: true,
                                                        maxlength: 500
                                                    },
                                                    captcha: {
                                                        required: true
                                                    }
                                                }
                                            });
                                        });
</script>
<script type="text/javascript">
    jQuery(document).ready(function () {
        var img_path = "<?php echo site_url() . 'uploads/captcha/'; ?>";

        jQuery('#recap').on('click', function () {

            jQuery.get("<?php echo site_url('manage/Authuser/loadcaptcha'); ?>", function (data) {
                jQuery("#captchaimage").html('<img src="' + img_path + data + '" height="45px" width="150px">');
            });
        });
    });
</script>