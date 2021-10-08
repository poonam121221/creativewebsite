 <!-- banner -->
 <!-- BEGIN PAGE HEADER-->
 <div class="row">
     <div class="col-md-12">
         <ul class="page-breadcrumb breadcrumb">
             <li><i class="fa fa-home"></i><a href="<?php echo base_url('manage/Dashboard/');?>">Home</a><i
                     class="fa fa-angle-right"></i></li>
             <li><a href="<?php echo base_url('manage/Admission/'); ?>">Admission</a><i class="fa fa-angle-right"></i>
             </li>
             <li><a href="javascript:void(0);">View</a></li>
             <!--li class="btn-group">
		<button type="button" class="btn blue dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">
		<span>Actions</span><i class="fa fa-angle-down"></i>
		</button>
		<ul class="dropdown-menu pull-right" role="menu">
		<li><a href="<?php //echo base_url('manage/Circular/add'); ?>"><i class="fa fa-plus"></i> Add</a></li>
		</ul>
		</li-->
         </ul>
         <!-- END PAGE TITLE & BREADCRUMB-->
     </div>
 </div>
 <!-- END PAGE HEADER-->


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

.admission-form input[type="text"] {
    width: 150px;
}

@media print {

    ul.page-breadcrumb.breadcrumb,
    .tools,
    .btn-print {
        display: none;
    }
}
 </style>

 <!-- BEGIN PAGE CONTENT-->
 <div class="row">
     <div class="col-md-12">
         <!------------------------------------------------------------------- -->
         <!-- BEGIN BORDERED TABLE PORTLET-->
         <div class="portlet box blue">
             <div class="portlet-title">
                 <div class="caption"><?php echo $this->lang->line('register_view'); ?>
                     <a href="" class="btn btn-print" onclick="window.print();"> <button type="button"><i
                                 class="fa fa-print"></i> <?php echo $this->lang->line('print'); ?></button></a>
                 </div>

             </div>
             <!--End portlet-title-->
             <div class="portlet-body">
                 <!--------------------------------------------------------------------------->
                 <div class="fontresize">
                     <div class="inner-pages">
                         <!-- Breadcrumb -->
                         <div class="">
                             <?php if( $userDataList->application_status==0) {?>
                             <div class="row">
                                 <div class="col-md-12 ">
                                     <div class="form-group">
                                         <label class="col-sm-4 col-md-3 control-label"></label>
                                         <div class="col-sm-8 col-md-9">
                                             <?php
                                        $atr2 = array('id' => 'frmContactboard', 'name' => 'frmContactboard', 'class' => 'form-horizontal', 'role' => 'form', 'autocomplete' => 'off');
                                        echo form_open_multipart('manage/Admission/updatestatus', $atr2);
                                        ?>
                                             <input type="hidden" name="email"
                                                 value="<?php echo $userDataList->user_email; ?>">
                                             <input type="hidden" name="id"
                                                 value="<?php echo $userDataList->user_id; ?>">
                                             <button type="submit" class="btn green">Approve</button>
                                             <a class="btn red reject_btn">Reject</a>
                                             <a class="btn purple"
                                                 href="<?php echo base_url('manage/Admission/'); ?>">Back</a>
                                             <?php echo form_close(); ?>
                                         </div>
                                     </div>
                                     <!--End form-group-->
                                     <?php
                                    $atr2 = array('id' => 'frmContactboard', 'name' => 'frmContactboard', 'class' => 'form-horizontal', 'role' => 'form', 'autocomplete' => 'off');
                                    echo form_open_multipart('manage/Admission/updaterejstatus', $atr2);
                                ?>
                                     <hr>
                                     <input type="hidden" name="email" value="<?php echo $userDataList->user_email; ?>">
                                     <input type="hidden" name="id" value="<?php echo $userDataList->user_id; ?>">
                                     <div id="reject_form" class="hidden">
                                         <div class="form-group">
                                             <label class="col-sm-4 col-md-3 control-label">Remark </label>
                                             <div class="col-sm-8 col-md-9">
                                                 <?php $Reject_status = array(
                                                'name' => 'reject_region',  'id' => 'reject_region', 'class' => 'form-control', 'placeholder' => 'Enter Remark',
                                                'value' => ''
                                            );
                                            echo form_input($Reject_status);
                                            ?>
                                             </div>
                                         </div>
                                         <!--End form-group-->
                                         <div class="form-group">
                                             <label class="col-sm-4 col-md-3 control-label"></label>
                                             <div class="col-sm-8 col-md-9">
                                                 <button type="submit" class="btn green">Submit</button>
                                                 <a class="btn purple"
                                                     href="<?php echo base_url('manage/Admission/'); ?>">Back</a>
                                             </div>
                                         </div>
                                     </div>
                                     <!--End form-group-->
                                     <?php echo form_close(); ?>
                                 </div>
                             </div>
                             <?php } else {  
                            if( $userDataList->application_status==1) { 
                                echo '<button class="btn green">Approved</button>';
                            }
                            if( $userDataList->application_status==2) { 
                                echo '<p><button class="btn red">Rejected</button> :';
                                echo "<b> ".$userDataList->reject_region."</b></p>";
                            }
                            }?>
                             <!-- Breadcrumb -->
                             <div class="row">
                                 <!--div class="col-md-4">
                    <?php //$this->load->view('element/inc_sidebar'); ?>                
                </div-->
                                 <div class="col-md-12">
                                     <!-- <h4 class="main-inner-heading">Project Management Admission</h4> -->
                                     <div class="">
                                         <div class="pagedetail" id="pagedetail">
                                             <div class="col-md-12">
                                                 <div class="">
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
                                                                 <img class="imgprint" src="<?php echo  $img ?> "
                                                                     style="" />
                                                             </figure>
                                                         </div>
                                                         <div class="col-sm-12">
                                                             <div class="form-group">
                                                                 <label>Enrolment Number<span
                                                                         class="text-danger">*</span></label>
                                                                 <input type="text" name="enrollno"
                                                                     value="<?php echo $userDataList->enrolment_number;?>"
                                                                     id="enrollno" class="form-control"
                                                                     placeholder="Enrolment Number" disabled>
                                                             </div>
                                                         </div>
                                                         <div class="col-sm-6">
                                                             <div class="form-group">
                                                                 <label>Name of the Candidate<span
                                                                         class="text-danger">*</span></label>
                                                                 <input type="text" name="NameoftheCandidate"
                                                                     value="<?php echo $userDataList->user_fname.' '.$userDataList->user_lname;?>"
                                                                     class="form-control"
                                                                     placeholder="Name of the Candidate" disabled>
                                                             </div>
                                                         </div>
                                                         <div class="col-sm-6">
                                                             <div class="form-group">
                                                                 <label>Date of Birth<span
                                                                         class="text-danger">*</span></label>
                                                                 <input type="text"
                                                                     value="<?php echo $userDataList->DOB;?>"
                                                                     class="form-control" disabled>
                                                             </div>
                                                         </div>
                                                         <div class="col-sm-6">
                                                             <div class="form-group">
                                                                 <label>Father’s Name<span
                                                                         class="text-danger">*</span></label>
                                                                 <input type="text" name="fathername"
                                                                     value="<?php echo  ucfirst($userDataList->father_name);?>"
                                                                     class="form-control" placeholder="Father’s Name"
                                                                     disabled>
                                                             </div>
                                                         </div>
                                                         <div class="col-sm-6">
                                                             <div class="form-group">
                                                                 <label>Mother’s Name<span
                                                                         class="text-danger">*</span></label>
                                                                 <input type="text" name="mothername"
                                                                     value="<?php echo ucfirst($userDataList->mother_name);?>"
                                                                     class="form-control" placeholder="Mother’s Name"
                                                                     disabled>
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
                                                                 <label>Category<span
                                                                         class="text-danger">*</span></label>
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
                                                                 <label>Email Id<span
                                                                         class="text-danger">*</span></label>
                                                                 <input type="text" name="emailid"
                                                                     value="<?php echo $userDataList->user_email;?>"
                                                                     class="form-control" placeholder="Email Id"
                                                                     disabled>
                                                             </div>
                                                         </div>
                                                         <div class="col-sm-6">
                                                             <div class="form-group">
                                                                 <label>Mobile<span class="text-danger">*</span></label>
                                                                 <input type="number" name="mobile"
                                                                     value="<?php echo $userDataList->user_mobile;?>"
                                                                     class="form-control" placeholder="Mobile" disabled>
                                                             </div>
                                                         </div>
                                                         <div class="col-sm-6">
                                                             <div class="form-group">
                                                                 <label>Landline<span
                                                                         class="text-danger">*</span></label>
                                                                 <input type="text" name="landline"
                                                                     value="<?php echo $userDataList->landline;?>"
                                                                     class="form-control" placeholder="Landline"
                                                                     disabled>
                                                             </div>
                                                         </div>
                                                         <div class="col-sm-12">
                                                             <div class="form-group">
                                                                 <label>Address for Correspondence<span
                                                                         class="text-danger">*</span></label>
                                                                 <textarea name="cor_address" id="cor_address"
                                                                     class="form-control" cols="30" rows="2"
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
                                                                 <label>Pin Code<span
                                                                         class="text-danger">*</span></label>
                                                                 <input type="text" name="pin_code"
                                                                     value="<?php echo $userDataList->pin_code?>"
                                                                     class="form-control" placeholder="Pin Code"
                                                                     disabled>
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
                                                                         <td><input type="text" name="passing_year"
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
                                                             <h5>Present Assignment (For In-service Candidates only)
                                                             </h5>
                                                             <table class="table table-bordered table-striped">
                                                                 <thead>
                                                                     <tr>
                                                                         <th>Name of Organization </th>
                                                                         <th>Contact Details of Employer(Address, Phone,
                                                                             Email)</th>
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
                                                                         <td><input type="text" name="uname"
                                                                                 value="<?php echo $userDataList->date_of_joining;?>"
                                                                                 class="form-control" disabled></td>
                                                                     </tr>
                                                                 </tbody>
                                                             </table>
                                                         </div>

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
                                                             <label class="checkbox-inline"
                                                                 style="pointer-events: none;"><input type="checkbox"
                                                                     name="agree"
                                                                     value="<?php echo $userDataList->agree_check;?>"
                                                                     <?php echo $checked ;?>> I hereby affirm that the
                                                                 above mentioned details are true to the best of my
                                                                 knowledge. I undertake that I
                                                                 will abide by the rules & regulations of the
                                                                 Institute.</label>
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

 </div>

 </div>
 </div>
 </div>

 <!--  <h4 class="main-inner-heading">Project Management Admission</h4> -->



 <script>
function printDiv(id) {
    var printContents = document.getElementById(id).innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;

    window.print();

    document.body.innerHTML = originalContents;

}
 </script>
 <script type="text/javascript">
$(function() {

    jQuery(".reject_btn").click(function() {
        jQuery("#reject_form").removeClass("hidden");
    });
});
 </script>