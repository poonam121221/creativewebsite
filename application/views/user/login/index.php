<?php $HashKey = getHash();  ?>
<script src="<?php echo HTTP_JS_PATH_ADMIN; ?>scripts/sha256.js" type="text/javascript"></script>


<script type="text/javascript">
$(function() {

   /* $('#frmLogin').on('submit', function() {
        var u_ps = "";
        var hash = "";
        var seed = "<?php echo $HashKey ; ?>";
        var shaObj1 = new jsSHA("SHA-256", "TEXT", "1");
        var shaObj2 = new jsSHA("SHA-256", "TEXT", "1");
        var shaObj3 = new jsSHA("SHA-256", "TEXT", "1");
        u_ps = document.getElementById("user_ps").value;

        if (u_ps != "") {
            shaObj1.update(seed);
            shaObj2.update(u_ps);
            hash = shaObj1.getHash("HEX") + shaObj2.getHash("HEX");
            shaObj3.update(hash);
            hash = shaObj3.getHash("HEX");
            document.getElementById("user_ps").value = hash;
        }
    });*/ //end click event
}); //end dom
</script>
<article class="min_350 noise_bg">
    <div class="inner-header">
        <div class="container">
            <h3><?php echo $this->lang->line('registration_status'); ?></h3>
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
                        <div class="pagedetail">
                            <div class="col-md-12">
                                <div class="innerpage-block">
                                    <?php
	$atributes = array('class' => 'login-form', 'id' => 'frmLogin', 'autocomplete'=>'off');
	echo form_open('user/checklogin',$atributes);
	echo '<div style="display:none;">'.form_input(array('type'=>'password','name'=>'cust_pass')).'</div>';
?>
                                    <input type="hidden" name="valid" value="<?php echo $HashKey; ?>" />

                                    <div class="row  ">
                                        <div class="col-lg-12">
                                            <?php echo AlertMessage($this->session->flashdata('AppMessage'));?></div>
                                    </div>
                                    <!--End Validation message-->
                                    <div class="row mt40">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control valid" placeholder="Username"
                                                    id="user_name" name="user_name" tabindex="2"
                                                    autofocus="autofocus" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt40">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <input type="password" class="form-control" placeholder="Password"
                                                    id="user_ps" name="user_ps" tabindex="3" />
                                            </div>
                                        </div>
                                        <div class="col-md-12 captcha input-error " style="display: none;">
                                            <div id="captchaimage" style="display: inline-block">
                                                <?php echo reload_captcha(); ?></div>
                                            <span class="help">Can't read?
                                                <a title="Reload security code" id="recap"
                                                    href="javascript:void(0);">click here</a>.
                                            </span>
                                        </div>
                                        <div class="col-md-6 " style="margin-top:10px;display: none;">
                                            <div class="input-error">
                                                <input type="text" class="form-control"  value ="<?php echo  $_SESSION['word'];?>" placeholder="Secutity Code"
                                                    name="captcha" tabindex="4" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row " style="margin-top:20px;">
                                        <div class="col-md-12">
                                            <button id="btnLoginUser" type="submit" class="btn btn-success"
                                                tabindex="5">Sign in</button>
                                        </div>
                                    </div>

                                    <?php echo form_close(); ?>
                                    <!--<div class="row">
 <div class="col-md-6">
  <a title="Forgot Password" href="<?php echo base_url('user/forgot-password'); ?>" tabindex="6">Forgot Password ?</a>
   <a title="Forgot Password" href="<?php echo base_url('user/resend-email'); ?>" tabindex="6">Resend Email</a>
 </div>
</div>-->
                                    <!--End row-->
                                </div>
                                <!--End login-box-->
                            </div>
                            <!--End loginSection-->
                        </div>
                        <!--End container-->
</article>

<script type="text/javascript" src="<?php echo base_url('webroot/');?>validation/dist/jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo base_url('webroot/');?>validation/dist/additional-methods.js"></script>


<script type="text/javascript">
jQuery(document).ready(function() {
	

    jQuery('#frmLogin').validate({

        rules: {
            user_name: {
                required: true
            },
            user_ps: {
                required: true
            },
            captcha: {
                required: true,
            }
        },
        messages: {
            user_name: {
                required: "Username is required field."
            },
            user_ps: {
                required: "Password is required field."
            },
            captcha: {
                required: "Security code is required field."
            }
        },
        highlight: function(element) { // hightlight error inputs
            // set error class to the control group
            jQuery(element).closest('.input-error').addClass('has-error');
        },
        success: function(element) {
            jQuery(element).closest('.input-error').removeClass('has-error');
            element.remove();
        },
        errorPlacement: function(error, element) {
            error.insertAfter(element.closest('.input-error'));
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
});
</script>
<!-- END JAVASCRIPTS -->