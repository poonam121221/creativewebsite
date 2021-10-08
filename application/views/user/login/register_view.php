 <!-- banner -->


 <?php //echo"<pre>";print_r($userQualificationInfo);exit;?>
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
         <h3><?php echo $this->lang->line('register_view'); ?></h3>
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
                     <div class="innerpage-block">
                         <div class="pagedetail">
                             <div class="col-md-12">
                                 <div class="innerpage-block">
                                     
                                     <div class="row mt40">
                                         <div class="col-sm-12 profile-img">
                                             <figure>
                                                 <!--img src="<?php //echo base_url('assets/images/user-placeholder.png')?> " /-->
                                                 <label for="file-upload" class="custom-file-upload">
                                                 </label>
                                                 <?php

									if(trim($userDataList->user_image)!=''){
									  $img = base_url('uploads/admision/').trim($userDataList->user_image);
									 } else{
										  $img  = base_url('assets/images/user-placeholder.png');
									 }?>
                                                 <img src="<?php echo  $img ?> " />
                                             </figure>
                                         </div>
                                         <?php //print_r($userDataList); ?>
                                         <div class="col-sm-12">
                                             <div class="form-group">
                                                 <label>Enrolment Number<span class="text-danger">*</span></label>
                                                 <input type="text" name="enrollno"
                                                     value="<?php echo $userDataList->enrolment_number;?>" id="enrollno"
                                                     class="form-control" placeholder="Enrolment Number" disabled>
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
                                                 <input type="text" id="dob" value="<?php echo $userDataList->DOB;?>"
                                                     class="form-control" disabled>
                                             </div>
                                         </div>
                                         <div class="col-sm-6">
                                             <div class="form-group">
                                                 <label>Father’s Name<span class="text-danger">*</span></label>
                                                 <input type="text" name="fathername" id="fathername"
                                                     value="<?php echo  ucfirst($userDataList->father_name);?>"
                                                     class="form-control" placeholder="Father’s Name" disabled>
                                             </div>
                                         </div>
                                         <div class="col-sm-6">
                                             <div class="form-group">
                                                 <label>Mother’s Name<span class="text-danger">*</span></label>
                                                 <input type="text" name="mothername" id="mothername"
                                                     value="<?php echo ucfirst($userDataList->mother_name);?>"
                                                     class="form-control" placeholder="Mother’s Name" disabled>
                                             </div>
                                         </div>
                                         
                                         <div class="col-sm-6">
                                             <div class="form-group">
                                                 <label>Gender<span class="text-danger">*</span></label>
                                                 <div>
                                                     <?php 
										$GenderList = array(''=>'--Select Gender--','1'=>'Male','2'=>'Female');
										echo form_dropdown(array('name'=>'gender','id'=>'gender','class'=>'form-control' ,'disabled'=>'disabled'),isset($GenderList)?$GenderList:array(''=>'--Select Gender--'),isset($userDataList->gender) ? ($userDataList->gender):'');
									
										?>
                                                 </div>
                                             </div>
                                         </div>
                                         <div class="col-sm-6">
                                             <div class="form-group">
                                                 <label>Category<span class="text-danger">*</span></label>
                                                 <div>
                                                     <?php 
										$CastList = array(''=>'--Select Gender--','1'=>'General','2'=>'ST','3'=>'SC','4'=>'OBC');
											echo form_dropdown(array('name'=>'category','id'=>'category','class'=>'form-control' ,'disabled'=>'disabled'),isset($CastList)?$CastList:array(''=>'--Select Category--'),isset($userDataList->category) ? ($userDataList->category):'');
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
                                                 <input type="text" name="landline" id="landline"
                                                     value="<?php echo $userDataList->landline;?>" class="form-control"
                                                     placeholder="Landline" disabled>
                                             </div>
                                         </div>
                                         <div class="col-sm-12">
                                             <div class="form-group">
                                                 <label>Address for Correspondence<span
                                                         class="text-danger">*</span></label>
                                                 <textarea name="cor_address" id="cor_address" class="form-control"
                                                     cols="30" rows="2"
                                                     disabled><?php echo $userDataList->correspond_address;?></textarea>
                                             </div>
                                         </div>
                                         <div class="col-sm-6">
                                             <div class="form-group">
                                                 <label>State<span class="text-danger">*</span></label>
                                                 <?php 
									    $stateList = array(''=>'--Select State--','20'=>'Madhya Pradesh');
									  echo form_dropdown(array('name'=>'state','id'=>'state','class'=>'form-control' ,'disabled'=>'disabled'),isset($stateList)?$stateList:array(''=>'--Select State--'),isset($userDataList->state) ? ($userDataList->state):''); ?>

                                             </div>
                                         </div>
                                         <div class="col-sm-6">
                                             <div class="form-group">
                                                 <label>City<span class="text-danger">*</span></label>
                                                 <?php 
								  echo form_dropdown(array('name'=>'city','id'=>'city','class'=>'form-control' ,'disabled'=>'disabled'),isset($DistrictList)?$DistrictList:array(''=>'--Select City--'),isset($userDataList->city) ? ($userDataList->city):''); ?>
                                             </div>
                                         </div>
                                         <div class="col-sm-6">
                                             <div class="form-group">
                                                 <label>Pin Code<span class="text-danger">*</span></label>
                                                 <input type="text" name="pin_code" id="pin_code"
                                                     value="<?php echo $userDataList->pin_code?>" class="form-control"
                                                     placeholder="Pin Code" disabled>
                                             </div>
                                         </div>
                                         
                                         <div class="col-sm-12">
                                             <h5>Educational Qualification</h5>
                                             <table class="table table-bordered table-striped">
                                                 <thead>
                                                     <tr>
                                                         <th>S. No.</th>
                                                         <th>Qualification</th>
                                                         <th>Board/University</th>
                                                         <th>Subjects</th>
                                                         <th>Year of Passing</th>
                                                         <th>Marks Obtained / Total Marks</th>
                                                         <th>age</th>
                                                     </tr>
                                                 </thead>
                                                 <tbody>
                                                     <?php 
										$i = 1;
										foreach($userQualificationInfo as $qualification){
                                      
							
										?>
                                                     <tr>
                                                         <td><?php echo $i;?></td>
                                                         <td><input type="text" name="subject"
                                                                 value="<?php echo $qualification['title'];?>"
                                                                 class="form-control" disabled></td>
                                                         <td><input type="text" name="board"
                                                                 value="<?php echo $qualification['board'];?>"
                                                                 class="form-control" disabled></td>
                                                         <td><input type="text" name="subject"
                                                                 value="<?php echo $qualification['subject'];?>"
                                                                 class="form-control" disabled></td>
                                                         <td><input type="date" name="passing_year"
                                                                 value="<?php echo $qualification['passing_year'];?>"
                                                                 class="form-control" disabled></td>
                                                         <td><input type="text" name="total_mark"
                                                                 value="<?php echo $qualification['total_mark'];?>"
                                                                 class="form-control" disabled></td>
                                                         <td><input type="text" name="age"
                                                                 value="<?php echo $qualification['age'];?>"
                                                                 class="form-control" disabled></td>
                                                     </tr>
                                                     <?php 
										$i++;
										} ?>

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
                                                         <td><input type="text" name="uname"
                                                                 value="<?php echo $userDataList->name_of_organization;?>"
                                                                 class="form-control" disabled></td>
                                                         <td><input type="text" name="uname"
                                                                 value="<?php echo $userDataList->contact_detail_employer;?>"
                                                                 class="form-control" disabled></td>
                                                         <td><input type="text" name="uname"
                                                                 value="<?php echo $userDataList->desig_of_candidate;?>"
                                                                 class="form-control" disabled></td>
                                                         <td><input type="date" name="uname"
                                                                 value="<?php echo $userDataList->date_of_joining;?>"
                                                                 class="form-control" disabled></td>
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
                                     </div>
                                     <div class="col-sm-12">
                                         <div class="form-group">
                                             <?php 
									if($userDataList->agree_check == 1){
										$checked = 'checked';
									}else{
										$checked = '';
									}
									?>
                                             <label class="checkbox-inline" style="pointer-events: none;"><input
                                                     type="checkbox" name="agree" id="agree"
                                                     value="<?php echo $userDataList->agree_check;?>"
                                                     <?php echo $checked ;?>> I hereby affirm that the above mentioned
                                                 details are true to the best of my knowledge. I undertake that I
                                                 will abide by the rules & regulations of the Institute.</label>

                                                
                                         </div>
                                     </div>
                                 </div>
                             </div>

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


 <script type="text/javascript" src="<?php echo base_url('webroot/'); ?>validation/dist/jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo base_url('webroot/'); ?>validation/dist/additional-methods.js"></script>
 <script type="text/javascript">
$(function() {

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
            agree : {
                required: true,
            },
            'board[]': {
                required: true,
            },
            'subject[]': {
                required: true,
            },
            'passing_year[]': {
                required: true,
            },
            'total_mark[]': {
                required: true,
            },
            'age[]' : {
                required: true,
            },
        }
    });
});
 </script>
 <script type="text/javascript">
jQuery(document).ready(function() {
    var datetime1 =
        <?php echo json_encode(array('1'=>'11-08-2020','2'=>'10-08-2020','3'=>'07-08-2020','4'=>'08-08-2020'));?>;
    jQuery('.entity').on('change', function() {
        $('.individual').css("display", "block");
        $('.manthan').css("display", "none");
        if ($(this).val() == 2 || $(this).val() == 3) {
            $('.company').css("display", "block");
        } else if ($(this).val() == 4 || $(this).val() == 5) {
            $('.individual').css("display", "none");
            $('.company').css("display", "none");
            $('.manthan').css("display", "block");
        } else {
            $('.company').css("display", "none");
        }
    });

    jQuery('#domainid').on('change', function() {
        var domain = $('#domainid').val();
        $('#datetime').html(datetime1[domain]);
    });

    var img_path = "<?php echo site_url().'captcha/'; ?>";
    jQuery('#recap').on('click', function() {
        jQuery.get("<?php echo site_url('manage/Authuser/loadcaptcha');?>", function(data) {
            jQuery("#captchaimage").html('<img src="' + img_path + data +
                '" height="45px" width="150px">');
        });
    });
});

function bytesToSize(bytes) {
    var sizes = ['Bytes', 'KB', 'MB'];
    if (bytes == 0) return 'n/a';
    var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
    return (bytes / Math.pow(1024, i)).toFixed(1) + ' ' + sizes[i];
};
// check for selected crop region
function checkForm() {
    if (parseInt($('#w').val())) return true;
    $('#img-error').html('Please select a crop region and then press Upload').show();
    return false;
};
// update info by cropping (onChange and onSelect events handler)
function updateInfo(e) {
    $('#x1').val(e.x);
    $('#y1').val(e.y);
    $('#x2').val(e.x2);
    $('#y2').val(e.y2);
    $('#w').val(e.w);
    $('#h').val(e.h);
};
// clear info by cropping (onRelease event handler)
function clearInfo() {
    $('.info #w').val('');
    $('.info #h').val('');
};
// Create variables (in this scope) to hold the Jcrop API and image size
var jcrop_api, boundx, boundy;

function fileSelectHandler() {
    // get selected file
    var oFile = $('#image_file')[0].files[0];
    // hide all errors
    $('#img-error').hide();
    // check for image type (jpg and png are allowed)
    var rFilter = /^(image\/jpeg|image\/png)$/i;
    if (!rFilter.test(oFile.type)) {
        $('#img-error').html('Please select a valid image file (jpg and png are allowed)').show();
        return;
    }
    // check for file size
    if (oFile.size > 250 * 1024) {
        $('#img-error').html('You have selected too big file, please select a one smaller image file').show();
        return;
    }
    // preview element
    var oImage = document.getElementById('preview');
    // prepare HTML5 FileReader
    var oReader = new FileReader();
    oReader.onload = function(e) {
        // e.target.result contains the DataURL which we can use as a source of the image
        oImage.src = e.target.result;
        oImage.onload = function() { // onload event handler
            // display step 2
            $('.step2').fadeIn(500);
            // display some basic image info
            var sResultFileSize = bytesToSize(oFile.size);
            $('#filesize').val(sResultFileSize);
            $('#filetype').val(oFile.type);
            $('#filedim').val(oImage.naturalWidth + ' x ' + oImage.naturalHeight);
            // destroy Jcrop if it is existed
            if (typeof jcrop_api != 'undefined') {
                jcrop_api.destroy();
                jcrop_api = null;
                $('#preview').width(oImage.naturalWidth);
                $('#preview').height(oImage.naturalHeight);
            }
            setTimeout(function() {
                // initialize Jcrop
                $('#preview').Jcrop({
                    //minSize: [85, 125], // min crop size
                    maxSize: [236, 295],
                    aspectRatio: 236 / 295, // keep aspect ratio 1:1
                    bgFade: true, // use fade effect
                    bgOpacity: .5, // fade opacity
                    onChange: updateInfo,
                    onSelect: updateInfo,
                    onRelease: clearInfo
                }, function() {
                    // use the Jcrop API to get the real image size
                    var bounds = this.getBounds();
                    boundx = bounds[0];
                    boundy = bounds[1];
                    // Store the Jcrop API in the jcrop_api variable
                    jcrop_api = this;
                });
            }, 500);
        };
    };
    // read selected file as DataURL
    oReader.readAsDataURL(oFile);
}
 </script>