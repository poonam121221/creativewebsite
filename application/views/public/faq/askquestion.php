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
                    <h2><?php echo $this->lang->line('askquestion'); ?></h2>
                    <?php
                    $atr2 = array('id' => 'frmFeedback', 'name' => 'frmFeedback', 'class' => 'form-horizontal', 'role' => 'form', 'autocomplete' => 'off');
                    echo form_open('Faq/askQuestion', $atr2);
                    ?>  

                    <div class="form-group">
                        <div class="col-xs-12 col-sm-6">
                            <label><?php echo $this->lang->line('name'); ?> <span class="red-star">*</span></label>
                            <?php
                            $USER_NAME = array('name' => 'uname', 'id' => 'uname', 'class' => 'form-control', 'placeholder' => $this->lang->line('name'));
                            echo form_input($USER_NAME);
                            ?>
                        </div>

                        <div class="col-xs-12 col-sm-6">
                            <label><?php echo $this->lang->line('email'); ?> <span class="red-star">*</span></label>

                            <?php
                            $EMAIL = array('name' => 'email', 'id' => 'email', 'class' => 'form-control', 'placeholder' => $this->lang->line('email'));
                            echo form_input($EMAIL);
                            ?>

                        </div>

                    </div><!--End form-group-->  




                    <div class="form-group">
                        <div class="col-xs-12 col-sm-6">
                            <label><?php echo $this->lang->line('mobile'); ?> <span class="red-star">*</span></label>

                            <?php
                            $MOBILE = array('name' => 'mobile', 'id' => 'mobile', 'class' => 'form-control', 'placeholder' => $this->lang->line('mobile'));
                            echo form_input($MOBILE);
                            ?>

                        </div><!--End form-group-->

                        <div class="col-xs-12 col-sm-6">
                            <label><?php echo $this->lang->line('subject'); ?> <span class="red-star">*</span></label>

                            <?php
                            $SUBJECT = array('name' => 'subject', 'id' => 'subject', 'class' => 'form-control', 'placeholder' => $this->lang->line('subject'));
                            echo form_input($SUBJECT);
                            ?>

                        </div><!--End form-group--> 
                    </div><!--End row-->

                    <div class="form-group">
                        <div class="col-sm-12">
                            <label><?php echo $this->lang->line('question'); ?> <span class="red-star">*</span></label>

                            <?php
                            $MESSAGE = array(
                                'name' => 'message',
                                'id' => 'message',
                                'class' => 'form-control',
                                'placeholder' => $this->lang->line('message'),
                                'rows' => 4,
                                'cols' => 20
                            );
                            echo form_textarea($MESSAGE);
                            ?> 

                        </div><!--End form-group--> 
                    </div><!--End row-->

                    <div class="form-group">
                        <div class="col-xs-12 col-sm-12">
                            <label>&nbsp;</label>

                            <div id="captchaimage" style="display: inline-block"><?php echo reload_captcha(); ?></div> 		 
                            <span class="clearfix"><?php echo $this->lang->line('enter_code_here'); ?></span>

                        </div><!--End form-group-->

                        <div class="col-xs-12 col-sm-12">


                            <?php
                            $SECURITY_CODE = array('name' => 'captcha', 'id' => 'captcha', 'class' => 'form-control input-medium', 'placeholder' => $this->lang->line('security_code'));
                            echo form_input($SECURITY_CODE);
                            ?>
                            <span class="clearfix"><?php echo $this->lang->line('can_not_read_image'); ?><a id="recap" href="javascript:void(0)"> <?php echo $this->lang->line('click_here'); ?></a></span>

                        </div><!--End form-group-->
                    </div><!--End row-->

                    <div class="form-group">
                        <div class="col-xs-12 col-sm-12">
                            <label class="control-label">&nbsp;</label>

                            <button type="submit" class="btn btn-primary"><?php echo $this->lang->line('submit'); ?></button>

                        </div><!--End form-group-->    
                    </div><!--End row-->

                    <?php echo form_close(); ?> 
                    <!---------------------------------------------------->   
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
<script type="text/javascript" src="<?php echo base_url('webroot/'); ?>plugins/jquery.validate.min.js"></script>
<script type="text/javascript">
    $(function () {

        jQuery.validator.addMethod("alphanumspace", function (value, element) {
            return this.optional(element) || /^[a-zA-Z0-9\s]*$/.test(value);
        }, "Please enter character,number and space only.");

        jQuery.validator.addMethod("alphanumspacedot", function (value, element) {
            return this.optional(element) || /^[a-zA-Z0-9.\s]*$/.test(value);
        }, "Please enter character,number,dot(.) and space only.");

        jQuery("#frmFeedback").validate({
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