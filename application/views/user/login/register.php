 <!-- banner -->
 <link href="<?php echo base_url('webroot/'); ?>/plugins/bootstrap-datepicker/css/datepicker.css" rel="Stylesheet"
     type="text/css" />
 <style>
.radio-inline input {
    margin-left: 8px;
    margin-right: 4px;
}

.print-option {
    display: none;
}
 </style>
 <div class="inner-header">
     <div class="container">
         <h3><?php echo $this->lang->line('register'); ?></h3>
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
                     <div class="col-lg-12">
                         <?php echo AlertMessage($this->session->flashdata('AppMessage')); ?>
                     </div>
                     <!-- <h4 class="main-inner-heading">Project Management Consultancy</h4> -->
                     <div class="pagedetail">
                         <div class="col-md-12">
                             <div class="innerpage-block">
                                 <?php
									$atr2 = array('id' => 'frmregister', 'name' => 'frmRegister', 'class' => '', 'role' => 'form', 'autocomplete' => 'off');
									echo form_open('user/Authlocaluser/add_user', $atr2);
									?>
                                 <div class="row mt40">
                                     <div class="col-sm-6">
                                         <div class="form-group">
                                             <label>Name of the Candidate<span class="text-danger">*</span></label>
                                             <input type="text" id="NameoftheCandidate" name="NameoftheCandidate"
                                                 value="" class="form-control" placeholder="Name of the Candidate">
                                         </div>
                                     </div>
                                     <div class="col-sm-6">
                                         <div class="form-group">
                                             <label>Date of Birth<span class="text-danger">*</span></label>
                                             <input type="text" placeholder="dd-mm-yyyy" id="dob" placeholder=""
                                                 name="dob" value="" class="form-control">
                                         </div>
                                     </div>
                                     <div class="col-sm-6">
                                         <div class="form-group">
                                             <label>Email Id<span class="text-danger">*</span></label>
                                             <input type="text" id="emailid" name="emailid" value=""
                                                 class="form-control" placeholder="Email Id">
                                         </div>
                                     </div>
                                     <div class="col-sm-6">
                                         <div class="form-group">
                                             <label>Password<span class="text-danger">*</span></label>
                                             <input type="password" id="passwrd" name="passwrd" value=""
                                                 class="form-control" placeholder="Password">
                                         </div>
                                     </div>
                                     <div class="col-sm-6">
                                         <div class="form-group">
                                             <label>Mobile Number<span class="text-danger">*</span></label>
                                             <input type="number" id="mobileno" name="mobileno" value=""
                                                 class="form-control" placeholder="Mobile Number">
                                         </div>
                                     </div>
                                     <div class="col-sm-6">
                                         <div class="form-group">
                                             <label>Photo Id detail<span class="text-danger">*</span></label>
                                             <input type="text" id="phtoid" name="phtoid" value="" class="form-control"
                                                 placeholder="DL/Voter Id/Passport">
                                         </div>
                                     </div>
                                 </div>
                                 <div class="row">
                                     <div class="col-md-12 text-center">
                                         <button type="submit" class="btn btn-primary">Submit</button>
                                     </div>
                                 </div>
                                 <?php echo form_close(); ?>
                             </div>
                         </div>
                     </div>

                 </div>
             </div>
         </div>
     </div>
 </div>
 <!-- partners -->



 <?php // $this->load->view('element/inc_footer_slider'); ?>

 <!--  <h4 class="main-inner-heading">Project Management Consultancy</h4> -->

 <script type="text/javascript"
     src="<?php echo base_url('webroot/'); ?>/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

 <script type="text/javascript" src="<?php echo base_url('webroot/'); ?>plugins/jquery.validate.min.js"></script>
 <script type="text/javascript">
$(function() {

    jQuery.noConflict();
    jQuery('#dob').datepicker({
        format: "dd-mm-yyyy",
        changeMonth: true,
        changeYear: true,
        startDate:'-60y',
        endDate: '-18y',
        autoclose: true,

    });


    jQuery.validator.addMethod("alphanumspace", function(value, element) {
        return this.optional(element) || /^[a-zA-Z0-9\s]*$/.test(value);
    }, "Please enter character,number and space only.");

    jQuery.validator.addMethod("alphanumspacedot", function(value, element) {
        return this.optional(element) || /^[a-zA-Z0-9.\s]*$/.test(value);
    }, "Please enter character,number,dot(.) and space only.");

    jQuery.validator.addMethod("passwordptr", function(value, element) {
        return this.optional(element) || /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[0-9a-zA-Z!@#$%^&*?~]{6,}$/
            .test(value);
    }, "Minimum length of Password should be 8 with 1 capital letter, 1 small letter , 1 number");

    jQuery("#frmregister").validate({
        rules: {

            emailid: {
                required: true,
                email: true,
                maxlength: 100
            },
            passwrd: {
                required: true,
                minlength: 8,
                maxlength: 20,
                passwordptr: true
            },
            NameoftheCandidate: {
                required: true,
                maxlength: 100
            },
            dob: {
                required: true
            },
            mobileno: {
                required: true,
                digits: true,
                minlength: 10,
                maxlength: 10
            },
            phtoid: {
                required: true,
                alphanumspace: true,
                maxlength: 100
            },

        }
    });
});
 </script>