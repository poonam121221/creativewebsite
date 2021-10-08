<!-- banner -->
<div class="inner-header">
    <div class="container">
        <h3><?php echo $this->lang->line('feedback'); ?></h3>
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

                        <div class="col-md-12">
                            <p class="text-left"><?php echo  $this->lang->line('feedback_note'); ?></p><br>
                            <p class="text-left text-danger"><?php echo  $this->lang->line('feedback_essentials'); ?></p>
                            <?php echo AlertMessage($this->session->flashdata('AppMessage')); ?>
                        </div>
                        <div class="col-md-12 mt40">
                            <?php
                            $atr2 = array('id' => 'frmFeedback', 'name' => 'frmFeedback', 'class' => 'form-horizontal', 'role' => 'form', 'autocomplete' => 'off');
                            echo form_open('Feedback/add', $atr2);
                            ?>

                            <div class="form-group row ">
                                <label class="col-sm-2 col-form-label text-left "><?php echo $this->lang->line('name'); ?><span class="text-danger">*</span></label>
                                <div class="col-sm-6 ">
                                    <?php
                                    $USER_NAME = array('name' => 'uname', 'id' => 'uname', 'class' => 'form-control', 'placeholder' => $this->lang->line('name'));
                                    echo form_input($USER_NAME);
                                    ?>
                                </div>
                            </div>


                            <div class="form-group row ">
                                <label class="col-sm-2 col-form-label text-left "><?php echo $this->lang->line('email'); ?>
                                    <span class="text-danger">*</span></label>
                                <div class="col-sm-6 ">
                                    <?php
                                    $EMAIL = array('name' => 'email', 'id' => 'email', 'class' => 'form-control', 'placeholder' => $this->lang->line('email'));
                                    echo form_input($EMAIL);
                                    ?>
                                </div>
                            </div>

                            <div class="form-group row ">
                                <label class="col-sm-2 col-form-label text-left "><?php echo $this->lang->line('mobile'); ?>
                                    <span class="text-danger">*</span></label>
                                <div class="col-sm-6 ">
                                    <?php
                                    $MOBILE = array('name' => 'mobile', 'id' => 'mobile', 'class' => 'form-control', 'placeholder' => $this->lang->line('mobile'));
                                    echo form_input($MOBILE);
                                    ?>
                                </div>
                            </div>

                            <div class="form-group row ">
                                <label class="col-sm-2 col-form-label text-left "><?php echo $this->lang->line('subject'); ?><span class="text-danger">*</span></label>
                                <div class="col-sm-6 ">
                                    <?php
                                    $SUBJECT = array('name' => 'subject', 'class' => 'form-control', 'placeholder' => $this->lang->line('subject'));
                                    echo form_input($SUBJECT);
                                    ?>
                                </div>
                            </div>

                            <div class="form-group row ">
                                <label class="col-sm-2 col-form-label text-left "><?php echo $this->lang->line('message'); ?><span class="text-danger">*</span></label>
                                <div class="col-sm-6 ">
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
                            <div class="form-group row  " style="display: none;">
                                <label class="col-sm-2 col-form-label text-left "></label>
                                <div class="col-sm-6 ">
                                    <div id="captchaimage" style="display: inline-block"><?php echo reload_captcha(); ?>
                                    </div><small><?php echo $this->lang->line('enter_code_here'); ?></small>
                                    <?php
                                    $SECURITY_CODE = array(
                                        'name' => 'captcha', 'id' => 'captcha',
                                        'class' => 'form-control input-medium',
                                        'placeholder' => $this->lang->line('security_code'),
                                        'value' => $_SESSION['word']
                                    );
                                    echo form_input($SECURITY_CODE);
                                    ?>
                                    <small><?php echo $this->lang->line('can_not_read_image'); ?><a id="recap" href="javascript:void(0)">
                                            <?php echo $this->lang->line('click_here'); ?></a></small>
                                </div>
                            </div>
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary"><?php echo $this->lang->line('submit'); ?></button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                <span class="last-update"><em class="icon-calendar3"></em>
                    <?php echo isset($LastUpdatedDate) ?  '<span class="updateinfo">' . $this->lang->line('last_updated') . ':' . $LastUpdatedDate . '</span>' : ''; ?>
                </span>
            </div>
        </div>
    </div>
</div>
</div>

<?php $this->load->view('element/inc_footer_slider'); ?>
<script type="text/javascript" src="<?php echo base_url('webroot/'); ?>plugins/jquery.validate.min.js"></script>
<script type="text/javascript">
    var jQuery = $.noConflict(true); // <- this
</script>
<script type="text/javascript">
    jQuery(function() {

        /*        $.validator.addMethod("alphanumspace", function (value, element) {
                    return this.optional(element) || /^[a-zA-Z0-9\s]*$/.test(value);
                }, "Please enter character,number and space only.");
                $.validator.addMethod("alphanumspacedot", function (value, element) {
                    return this.optional(element) || /^[a-zA-Z0-9.\s]*$/.test(value);
                }, "Please enter character,number,dot(.) and space only.");*/
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
    jQuery(document).ready(function() {
        var img_path = "<?php echo site_url() . 'uploads/captcha/'; ?>";
        jQuery('#recap').on('click', function() {
            jQuery.get("<?php echo site_url('manage/Authuser/loadcaptcha'); ?>", function(data) {
                jQuery("#captchaimage").html('<img src="' + img_path + data +
                    '" height="45px" width="150px">');
            });
        });
    });
</script>