 <!-- banner -->
 <style>
.radio-inline input {
    margin-left: 8px;
    margin-right: 4px;
}

.profile-img figure {
    width: 150px;
    height: 150px;
    overflow: hidden;
    margin: 0 auto;
    text-align: center;
    border-radius: 50%;
    border: solid 1px #007bff;
    position: relative;
}

.profile-img figure img {
    max-width: 100%;
}

.profile-img input[type="file"] {
    display: none;
}

.profile-img .custom-file-upload {
    border: 1px solid #007bff;
    background: #007bff;
    color: #fff;
    display: block;
    border-radius: 50%;
    height: 30px;
    width: 30px;
    left: 50%;
    bottom: -8px;
    margin-left: -15px;
    cursor: pointer;
    position: absolute;
}

.admission-form input[type="date"] {
    width: 150px;
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
             <?php $this->load->view('element/inc_breadcrum-user'); ?>
             <!-- Breadcrumb -->
             <div class="row">
                 <!--div class="col-md-4">
                    <?php //$this->load->view('element/inc_sidebar'); ?>                
                </div-->
                 <div class="col-md-12">
                     <!-- <h4 class="main-inner-heading">Project Management Consultancy</h4> -->
                     <div class="col-lg-12">
                         <?php echo AlertMessage($this->session->flashdata('AppMessage'));?>
                     </div>
                     <div class="innerpage-block">
                         <div class="pagedetail">
                             <div class="col-md-12">
                                 <div class="innerpage-block">
                                
                                     <?php
								   $atr2 =array('id'=>'frmregister','name'=>'frmRegister','class'=>'','role'=>'form','autocomplete'=>'off');
								   echo form_open_multipart('user/Authlocaluser/updateuser',$atr2); 
							   ?>
                                     <div class="row mt40">
                                         <div class="col-sm-12 profile-img">
                                             <figure>
                                                 <!--img src="<?php //echo base_url('assets/images/user-placeholder.png')?> " /-->
                                                 <label for="file-upload" class="custom-file-upload">
                                                     <i class="fa fa-cloud-upload"></i></label>
                                                 <span id="image-holder"> </span>
                                                 <input id="file-upload" type="file" name="file" />
                                             </figure>
                                         </div>
                                         <div class="col-sm-12">
                                             <div class="form-group">
                                                 <label>Enrolment Number<span class="text-danger">*</span></label>
                                                 <input type="text" name="enrollno" value="" id="enrollno"
                                                     class="form-control" placeholder="Enrolment Number">
                                             </div>
                                         </div>
                                         <div class="col-sm-6">
                                             <div class="form-group">
                                                 <label>Name of the Candidate<span class="text-danger">*</span></label>
                                                 <input type="text" name="NameoftheCandidate" id="NameoftheCandidate"
                                                     value="<?php echo $userDataList->user_fname.' '.$userDataList->user_lname;?>"
                                                     class="form-control" placeholder="Name of the Candidate" disabled>
                                             </div>
                                         </div>
                                         <div class="col-sm-6">
                                             <div class="form-group">
                                                 <label>Date of Birth<span class="text-danger">*</span></label>
                                                 <input type="text" value="<?php echo $userDataList->DOB;?>"
                                                     class="form-control" disabled>
                                             </div>
                                         </div>
                                         <div class="col-sm-6">
                                             <div class="form-group">
                                                 <label>Father’s Name<span class="text-danger">*</span></label>
                                                 <input type="text" name="fathername" id="fathername" value=""
                                                     class="form-control" placeholder="Father’s Name">
                                             </div>
                                         </div>
                                         <div class="col-sm-6">
                                             <div class="form-group">
                                                 <label>Mother’s Name<span class="text-danger">*</span></label>
                                                 <input type="text" name="mothername" id="mothername" value=""
                                                     class="form-control" placeholder="Mother’s Name">
                                             </div>
                                         </div>
                                        
                                         <div class="col-sm-6">
                                             <div class="form-group">
                                                 <label>Gender<span class="text-danger">*</span></label>
                                                 <div>
                                                     <?php 
										$GenderList = array(''=>'--Select Gender--','1'=>'Male','2'=>'Female');
										echo form_dropdown(array('name'=>'gender','id'=>'gender','class'=>'form-control'),isset($GenderList)?$GenderList:array(''=>'--Select Gender--'),set_value('gender'));
										?>
                                                 </div>
                                             </div>
                                         </div>
                                         <div class="col-sm-6">
                                             <div class="form-group">
                                                 <label>Category<span class="text-danger">*</span></label>
                                                 <div>
                                                     <?php 
										$CastList = array(''=>'--Select Category--','1'=>'General','2'=>'ST','3'=>'SC','4'=>'OBC');
										echo form_dropdown(array('name'=>'category','id'=>'category','class'=>'form-control'),isset($CastList)?$CastList:array(''=>'--Select Category--'),set_value('category'));
										?>
                                                 </div>
                                             </div>
                                         </div>
                                         <div class="col-sm-12">
                                             <div class="form-group">
                                                 <label>Email Id<span class="text-danger">*</span></label>
                                                 <input type="text" name="emailid" id="emailid"
                                                     value="<?php echo $userDataList->user_email;?>"
                                                     class="form-control" placeholder="Email Id" disabled>
                                             </div>
                                         </div>
                                         <div class="col-sm-6">
                                             <div class="form-group">
                                                 <label>Mobile<span class="text-danger">*</span></label>
                                                 <input type="number" name="mobile" id="mobile"
                                                     value="<?php echo $userDataList->user_mobile;?>"
                                                     class="form-control" placeholder="Mobile" disabled>
                                             </div>
                                         </div>
                                         <div class="col-sm-6">
                                             <div class="form-group">
                                                 <label>Landline<span class="text-danger">*</span></label>
                                                 <input type="text" name="landline" id="landline" value=""
                                                     class="form-control" placeholder="Landline">
                                             </div>
                                         </div>
                                         <div class="col-sm-12">
                                             <div class="form-group">
                                                 <label>Address for Correspondence<span
                                                         class="text-danger">*</span></label>
                                                 <textarea name="cor_address" id="cor_address" class="form-control"
                                                     cols="30" rows="2"></textarea>
                                             </div>
                                         </div>
                                         <div class="col-sm-6">
                                             <div class="form-group">
                                                 <label>State<span class="text-danger">*</span></label>
                                                 <select name="state" id="state" class="form-control">
                                                     <option value=" ">state</option>
                                                     <option value=" 20">Madhya Pradesh</option>
                                                 </select>
                                             </div>
                                         </div>
                                         <div class="col-sm-6">
                                             <div class="form-group">
                                                 <label>City<span class="text-danger">*</span></label>
                                                 <?php 
								  	echo form_dropdown(array('name'=>'city','id'=>'city','class'=>'form-control'),isset($DistrictList)?$DistrictList:array(''=>'--Select City--'),set_value('city'));
								?>
                                             </div>
                                         </div>
                                         <div class="col-sm-6">
                                             <div class="form-group">
                                                 <label>Pin Code<span class="text-danger">*</span></label>
                                                 <input type="text" name="pin_code" id="pin_code" value=""
                                                     class="form-control" placeholder="Pin Code">
                                             </div>
                                         </div>
                             
                                         <div class="col-sm-12">
                                             <h5>Educational Qualification</h5>
                                                             <table class="table table-bordered table-striped admission-form">
                                                 <thead>
                                                     <tr>
                                                         <th>S. No.</th>
                                                         <th>Qualification</th>
                                                         <th>Board/University</th>
                                                         <th>Subjects</th>
                                                         <th>Year of Passing</th>
                                                         <th> Total Marks</th>
                                                         <th>Marks Obtained</th>
                                                         <th>age</th>
                                                     </tr>
                                                 </thead>
                                                 <tbody>
                                                     <tr>
                                                         <td>1</td>
                                                         <td>10<sup>th</sup></td>
                                                         <input type="hidden" name="qualification[]" value="1"
                                                             class="form-control">
                                                         <td><input type="text" name="board[]" value=""
                                                                 class="form-control"></td>
                                                         <td><input type="text" name="subject[]" value=""
                                                                 class="form-control"></td>
                                                         <td><input type="text" name="passing_year[]" value=""
                                                                 class="form-control"></td>
                                                         <td><input type="text" name="total_mark[]" value=""
                                                                 class="form-control"></td>
                                                        <td><input type="text" name="out_of_total_mark[]" value=""
                                                                 class="form-control"></td>
                                                         <td><input type="text" name="age[]" value=""
                                                                 class="form-control"></td>
                                                     </tr>
                                                     <tr>
                                                         <td>2</td>
                                                         <td>12<sup>th</sup></td>
                                                         <input type="hidden" name="qualification[]" value="2"
                                                             class="form-control">
                                                         <td><input type="text" name="board[]" value=""
                                                                 class="form-control"></td>
                                                         <td><input type="text" name="subject[]" value=""
                                                                 class="form-control"></td>
                                                         <td><input type="text" name="passing_year[]" value=""
                                                                 class="form-control"></td>
                                                         <td><input type="text" name="total_mark[]" value=""
                                                                 class="form-control"></td>
                                                        <td><input type="text" name="out_of_total_mark[]" value=""
                                                                 class="form-control"></td>
                                                         <td><input type="text" name="age[]" value=""
                                                                 class="form-control"></td>
                                                     </tr>
                                                     <tr>
                                                         <td>3</td>
                                                         <td>Graduation</td>
                                                         <input type="hidden" name="qualification[]" value="3"
                                                             class="form-control">
                                                         <td><input type="text" name="board[]" value=""
                                                                 class="form-control"></td>
                                                         <td><input type="text" name="subject[]" value=""
                                                                 class="form-control"></td>
                                                         <td><input type="text" name="passing_year[]" value=""
                                                                 class="form-control"></td>
                                                         <td><input type="text" name="total_mark[]" value=""
                                                                 class="form-control"></td>
                                                                 <td><input type="text" name="out_of_total_mark[]" value=""
                                                                 class="form-control"></td>
                                                         <td><input type="text" name="age[]" value=""
                                                                 class="form-control"></td>
                                                     </tr>
                                                     <tr>
                                                         <td>4</td>
                                                         <td>Post Graduation</td>
                                                         <input type="hidden" name="qualification[]" value="4"
                                                             class="form-control">
                                                         <td><input type="text" name="board[]" value=""
                                                                 class="form-control"></td>
                                                         <td><input type="text" name="subject[]" value=""
                                                                 class="form-control"></td>
                                                         <td><input type="text" name="passing_year[]" value=""
                                                                 class="form-control"></td>
                                                         <td><input type="text" name="total_mark[]" value=""
                                                                 class="form-control"></td>
                                                                 <td><input type="text" name="out_of_total_mark[]" value=""
                                                                 class="form-control"></td>
                                                         <td><input type="text" name="age[]" value=""
                                                                 class="form-control"></td>
                                                     </tr>
                                                     <tr>
                                                         <td>5</td>
                                                         <td>M.Phil</td>
                                                         <input type="hidden" name="qualification[]" value="5"
                                                             class="form-control">
                                                         <td><input type="text" name="board[]" value=""
                                                                 class="form-control"></td>
                                                         <td><input type="text" name="subject[]" value=""
                                                                 class="form-control"></td>
                                                         <td><input type="text" name="passing_year[]" value=""
                                                                 class="form-control"></td>
                                                         <td><input type="text" name="total_mark[]" value=""
                                                                 class="form-control"></td>
                                                                 <td><input type="text" name="out_of_total_mark[]" value=""
                                                                 class="form-control"></td>
                                                         <td><input type="text" name="age[]" value=""
                                                                 class="form-control"></td>
                                                     </tr>
                                                     <tr>
                                                          <td>6</td>
                                                             <td>Ph.D</td>
                                                             <input type="hidden" name="qualification[]" value="6"
                                                                 class="form-control">
                                                             <td><input type="text" name="board[]" value=""
                                                                     class="form-control"></td>
                                                             <td><input type="text" name="subject[]" value=""
                                                                     class="form-control"></td>
                                                             <td><input type="text" name="passing_year[]" value=""
                                                                     class="form-control"></td>
                                                             <td><input type="text" name="total_mark[]" value=""
                                                                     class="form-control"></td>
                                                                     <td><input type="text" name="out_of_total_mark[]" value=""
                                                                 class="form-control"></td>
                                                             <td><input type="text" name="age[]" value=""
                                                                     class="form-control"></td>
                                                     </tr>
                                                     <tr>
                                                         <td>7</td>
                                                         <td>Research Papers</td>
                                                         <input type="hidden" name="qualification[]" value="7"
                                                             class="form-control">
                                                         <td><input type="text" name="board[]" value=""
                                                                 class="form-control"></td>
                                                         <td><input type="text" name="subject[]" value=""
                                                                 class="form-control"></td>
                                                         <td><input type="text" name="passing_year[]" value=""
                                                                 class="form-control"></td>
                                                         <td><input type="text" name="total_mark[]" value=""
                                                                 class="form-control"></td>
                                                                 <td><input type="text" name="out_of_total_mark[]" value=""
                                                                 class="form-control"></td>
                                                         <td><input type="text" name="age[]" value=""
                                                                 class="form-control"></td>
                                                     </tr>
                                                 </tbody>
                                             </table>
                                         </div>
                                         <div class="col-sm-12">
                                             <h5>Present Assignment (For In-service Candidates only)</h5>
                                             <table class="table table-bordered table-striped">
                                                 <thead>
                                                     <tr>
                                                         <th>Name of Organization </th>
                                                         <th>Contact Details of Employer(Address, Phone, Email)</th>
                                                         <th>Designation of Candidate</th>
                                                         <th>Date of Joining</th>
                                                     </tr>
                                                 </thead>
                                                 <tbody>
                                                     <tr>
                                                         <td><input type="text" name="name_of_organization" value=""
                                                                 class="form-control"></td>
                                                         <td><input type="text" name="contact_detail_employer" value=""
                                                                 class="form-control"></td>
                                                         <td><input type="text" name="desig_of_candidate" value=""
                                                                 class="form-control"></td>
                                                         <td><input type="date" name="cand_date_of_joining" value=""
                                                                 class="form-control"></td>
                                                     </tr>
                                                 </tbody>
                                             </table>
                                         </div>
                                         <!--div class="col-sm-12">
                                    <h5>Application Fee Details</h5>
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th colspan="6" class="text-center">Application Fee Details (Clearly specify mode of payment)</th>
                                            </tr>
                                            <tr>
                                                <th colspan="2" class="text-center">Cash</th>
                                                <th colspan="2" class="text-center">Demand Draft</th>
                                                <th colspan="2" class="text-center">Net Banking</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Amount</td>
                                                <td>Rs. 500/-</td>
                                                <td>Amount</td>
                                                <td>Rs. 500/-</td>
                                                <td>Account Name</td>
                                                <td>EPCO Institute of Environmental Studies</td>
                                            </tr>
                                             <tr>
                                                <td>MR No.</td>
                                                <td>--</td>
                                                <td>No. </td>
                                                <td>--</td>
                                                <td>Amount</td>
                                                <td>Rs. 500/-</td>
                                            </tr>
                                            <tr>
                                                <td>Date</td>
                                                <td>--</td>
                                                <td>Date</td>
                                                <td>--</td>
                                                <td>Account No.</td>
                                                <td>6310001100000028</td>
                                            </tr>
                                            <tr>
                                                <td>--</td>
                                                <td>--</td>
                                                <td>Issuing Bank & Branch</td>
                                                <td>--</td>
                                                <td>IFSC Code </td>
                                                <td>PUNB0631000</td>
                                            </tr>
                                             <tr>
                                                <td>--</td>
                                                <td>--</td>
                                                <td>in favour of</td>
                                                <td>EPCO Institute of Environmental Studies, Bhopal</td>
                                                <td>Bank Name & Branch</td>
                                                <td>Punjab National Bank, EPCO Branch, Bhopal</td>
                                            </tr>                  
                                        </tbody>
                                    </table>
                                </div-->
                                         <div class="col-sm-12">
                                             <div class="form-group">
                                                 <label class="checkbox-inline"><input type="checkbox" name="agree"
                                                         value="1"> I hereby affirm that the above mentioned details are
                                                     true to the best of my knowledge. I undertake that I
                                                     will abide by the rules & regulations of the Institute.</label>
                                             </div>
                                         </div>
                                     </div>

                                     <div class="row">
                                         <div class="col-md-12 text-center">
                                             
                                             <button type="submit" class="btn btn-primary">Submit</button>
                                         </div>
                                     </div>
                                 </div>

                                 <?php echo form_close(); ?>
                             </div>
                             <span class="last-update"><em class="icon-calendar3"></em> Last Updated : 25 Aug,
                                 2020</span>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <!-- partners -->

 </div>
 </div>
 <span class="last-update"><em class="icon-calendar3"></em>
     <?php echo isset($LastUpdatedDate)?  '<span class="updateinfo">'.$this->lang->line('last_updated').':'. $LastUpdatedDate.'</span>': ''; ?>
 </span>
 </div>
 </div>
 </div>
 </div>
 </div>


 <?php $this->load->view('element/inc_footer_slider'); ?>

 <!--  <h4 class="main-inner-heading">Project Management Consultancy</h4> -->

<script type="text/javascript"
     src="<?php echo base_url('webroot/'); ?>/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>


 <script type="text/javascript" src="<?php echo base_url('webroot/');?>validation/dist/jquery.validate.js"></script>

 <script type="text/javascript">
$(function() {

    jQuery("input[name$='passing_year[]'").datepicker({  format: "yy-m-d",
        changeMonth: true,
        changeYear: true,
        //yearRange: '-1y:c+nn',
        //startDate:'-1m',
        //	startDate:'-0y',
        autoclose: true,});



    jQuery.validator.addMethod("alphanumspace", function(value, element) {
        return this.optional(element) || /^[a-zA-Z0-9\s]*$/.test(value);
    }, "Please enter character,number and space only.");

    jQuery.validator.addMethod("alphanumspacedot", function(value, element) {
        return this.optional(element) || /^[a-zA-Z0-9.\s]*$/.test(value);
    }, "Please enter character,number,dot(.) and space only.");

    jQuery.validator.addMethod("passwordptr", function(value, element) {
            return this.optional(element) ||
                /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[0-9a-zA-Z!@#$%^&*?~]{6,}$/.test(value);
        },
        "Minimum length of Password should be 8 with 1 capital letter, 1 small letter , 1 number"
    );

    jQuery("#frmregister").validate({
        rules: {
            enrollno: {
                required: true,
                maxlength: 100
            },
            NameoftheCandidate: {
                required: true,
                maxlength: 100
            },
            fathername: {
                required: true,
                maxlength: 100
            },
            mothername: {
                required: true,
            },
            dob: {
                required: true,
            },
            gender: {
                required: true,
            },
            category: {
                required: true,
            },
            cor_address: {
                required: true,
            },
            state: {
                required: true,
            },
            city: {
                required: true,
            },
            pin_code: {
                required: true,
            },
            emailid: {
                required: true,
            },
            mobile: {
                required: true,
                digits: true,
                minlength: 10,
                maxlength: 10
            },
            landline: {
                required: true,
            },
            agree: {
                required: true,
            },
            'board[]': {
                //required: true,
                minlength: 1
                
            },
            'subject[]': {
              //  required: true,
                minlength: 1
            },
            'passing_year[]': {
               // required: true,
                minlength: 1
            },
            'total_mark[]': {
               // required: true,
                minlength: 1
            },
            'out_of_total_mark[]': {
               // required: true,
                minlength: 1
            },
            'age[]': {
             //   required: true,  
                digits: true,
                minlength: 1
            },
        },
        checkForm: function() {
    this.prepareForm();
    for (var i = 0, elements = (this.currentElements = this.elements()); elements[i]; i++) {
        if (this.findByName(elements[i].name).length != undefined && this.findByName(elements[i].name).length >= 1) {
            for (var cnt = 0; cnt < this.findByName(elements[i].name).length; cnt++) {
                this.check(this.findByName(elements[i].name)[cnt]);
            }
        } else {
            this.check(elements[i]);
        }
    }
    return this.valid();
}

    });
});
 </script>
 <script type="text/javascript">
$(document).ready(function() {
    $("#file-upload").on('change', function() {
        //Get count of selected files
        var countFiles = $(this)[0].files.length;
        var imgPath = $(this)[0].value;

        var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
        var image_holder = $("#image-holder");
        image_holder.empty();
        if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
            if (typeof(FileReader) != "undefined") {
                //loop for each file selected for uploaded.
                for (var i = 0; i < countFiles; i++) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $("<img />", {
                            "src": e.target.result,
                            "class": "thumb-image"
                        }).appendTo(image_holder);
                    }
                    image_holder.show();
                    reader.readAsDataURL($(this)[0].files[i]);
                }
            } else {
                echo(image_holder);
            }
        } else {
            //alert ("Pls select only images");
        }
    });
});
 </script>