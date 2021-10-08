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

<div id="information-information" class="container">
            
            <div class="row">
                <div id="content" class="col-sm-12">
                        <div id="cmsblock-24" class="cmsblock">
                            <div class='description'>
                                <div class="dynamic-about">
                                    <h1> <?php echo $PageTitle; ?></h1>
                                    <img src="<?php echo base_url('assets/img/bg-title-aboutus.png'); ?>" alt="bg title">
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-body">
                            <div class="row">
                                            <div class="col-sm-3"><strong>Website Name </strong><br>
                                <address>
                                Address 1 - Awadhpuri,Bhopal,MP(462021)
                                </address>
                                            </div>
                                <div class="col-sm-3"><strong>Telephone - 545784578</strong><br>
                                123456789<br>
                                <br>
                                            </div>
                                <div class="col-sm-3">
                                                            </div>
                            </div>
                            </div>
                        </div>

                        <?php
                            $atr2 = array('id' => 'frmContact', 'name' => 'frmContact', 'class' => 'form-horizontal', 'role' => 'form', 'autocomplete' => 'off' ,'enctype'=> "multipart/form-data");
                            echo form_open('contact-us/add', $atr2);
                        ?>
                        <fieldset>
                            <legend>Contact Us</legend>
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="uname"><?php echo $this->lang->line('name'); ?></label>
                                <div class="col-sm-10">
                                        <?php
                                        $USER_NAME = array('name' => 'uname', 'id' => 'uname', 'class' => 'form-control', 'placeholder' => $this->lang->line('name'));
                                        echo form_input($USER_NAME);
                                        ?>
                                   
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="email"><?php echo $this->lang->line('email'); ?> </label>
                                <div class="col-sm-10">
                                        <?php
                                        $EMAIL = array('name' => 'email', 'id' => 'email', 'class' => 'form-control', 'placeholder' => $this->lang->line('email'));
                                        echo form_input($EMAIL);
                                        ?>
                                </div>
                            </div>

                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="mobile"><?php echo $this->lang->line('mobile'); ?></label>
                                <div class="col-sm-10">
                                    <?php
                                    $MOBILE = array('name' => 'mobile', 'id' => 'mobile', 'class' => 'form-control', 'placeholder' => $this->lang->line('mobile'));
                                    echo form_input($MOBILE);
                                    ?>
                                </div>
                            </div>

                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="subject"><?php echo $this->lang->line('subject'); ?></label>
                                <div class="col-sm-10">
                                    <?php
                                    $SUBJECT = array('name' => 'subject', 'id' => 'subject', 'class' => 'form-control', 'placeholder' => $this->lang->line('subject'));
                                    echo form_input($SUBJECT);
                                    ?>
                                </div>
                            </div>


                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="message">message</label>
                                <div class="col-sm-10">
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
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label"></label>
                                <div class="col-sm-10">
                                    <div id="captchaimage" style="display: inline-block"><?php echo reload_captcha(); ?></div>
                                    <small><?php echo $this->lang->line('enter_code_here'); ?></small>

                                    <?php
                                    $SECURITY_CODE = array('name' => 'captcha', 'id' => 'captcha', 'class' => 'form-control input-medium', 'placeholder' => $this->lang->line('security_code'));
                                    echo form_input($SECURITY_CODE);
                                    ?>
                                    <small>
                                        <?php echo $this->lang->line('can_not_read_image'); ?>
                                        <a id="recap" href="javascript:void(0)"> <?php echo $this->lang->line('click_here'); ?></a>
                                    </small>
                                </div>
                            </div>
                            
                        
                            <div class="buttons">
                                <div class="pull-right">
                                    <input class="btn btn-primary" type="submit" value="Submit">
                                </div>
                            </div>
                        </fieldset>
                    <?php echo form_close(); ?>

                </div>

            </div>
        </div>


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