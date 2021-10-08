<!-- BEGIN PAGE HEADER-->
<div class="row">
<div class="col-md-12">
	<ul class="page-breadcrumb breadcrumb">
		<li><i class="fa fa-home"></i><a href="<?php echo base_url('manage/Dashboard/'); ?>">Home</a><i class="fa fa-angle-right"></i></li>
		<li><a href="<?php echo base_url('manage/Member/'); ?>">Member</a><i class="fa fa-angle-right"></i></li>
		<li><a href="javascript:void(0);">Edit</a></li>
	</ul>
	<!-- END PAGE TITLE & BREADCRUMB-->
</div>
</div>
<!-- END PAGE HEADER-->
<!-- BEGIN PAGE CONTENT-->
<div class="row">
<div class="col-md-12">
<div class="row"><div class="col-lg-12">
<?php echo AlertMessage($this->session->flashdata('AppMessage'));?>
</div></div>
<!--End Validation message-->
<!--start from layout-->

<div class="row">
<div class="col-md-12">
<div class="portlet box blue">
<div class="portlet-title">
  <div class="caption">Edit Member Status</div>
  <div class="tools"> <a href="javascript:;" class="collapse"> </a></div>
</div><!--End portlet-title-->
<div class="portlet-body">

	<h5><b>Member Details</b></h5>
	<div class="row information">
		<div class="col-md-4 ">
	      <div class="info">
			<p class="question">Full Name</p>
			<p class="answer"><?php echo $DataList->user_fname; ?></p>
		 </div>
		</div>
		<div class="col-md-4">
		<div class="info">
			<p class="question">Father/Husband Name</p>
			<p class="answer"><?php echo $DataList->user_father_or_husband; ?></p>
		</div>
		</div>
		<div class="col-md-4">
 		<div class="info">
			<p class="question">Email</p>
			<p class="answer"><?php echo $DataList->user_email; ?></p>
		</div>
		</div>
		<div class="col-md-4">
		<div class="info">
			<p class="question">FoMP ID</p>
			<p class="answer"><?php echo $DataList->fomp_id; ?></p>
		</div>
		</div>
		<div class="col-md-4">
		<div class="info">
			<p class="question">Date of Birth</p>
			<p class="answer"><?php echo get_date($DataList->dob); ?></p>
		</div>
		</div>
		<div class="col-md-4">
			 <div class="info">
			<p class="question">Is NRI</p>
			<p class="answer"><?php echo DefaultStatus($DataList->is_nri); ?></p>
		</div>
		</div>
		<?php if($DataList->is_nri==1){ ?>
		<div class="col-md-6">
		<div class="info">
			<p class="question">Passport Number</p>
			<p class="answer"><?php echo $DataList->passport_no; ?></p>
		</div>
		</div>
		<div class="col-md-6">
			 <div class="info">
			<p class="question">Country Issue</p>
			<p class="answer"><?php echo $DataList->country_issue_name; ?></p>
		</div>
		</div>
		<div class="col-md-4">
		<div class="info">
			<p class="question">PR Number</p>
			<p class="answer"><?php echo $DataList->pr_no; ?></p>
		</div>
		</div>
		<div class="col-md-4">
		<div class="info">
			<p class="question">Country Issue</p>
			<p class="answer"><?php echo $DataList->pr_country_issue_name; ?></p>
		</div>
		</div>
		<div class="col-md-4">
		<div class="info">
			<p class="question">OCI Number</p>
			<p class="answer"><?php echo $DataList->oci_nrp_no; ?></p>
		</div>
		</div>
		<?php }else{ ?>
		<div class="col-md-4">
		<div class="info">
			<p class="question">ID Card Name</p>
			<p class="answer"><?php echo GetIdentityCard($DataList->identity_proof,FALSE); ?></p>
		</div>
		</div>
		<div class="col-md-4">
		<div class="info">
			<p class="question"><?php echo GetIdentityCard($DataList->identity_proof,FALSE); ?> Number</p>
			<p class="answer"><?php echo $DataList->identity_number; ?></p>
		</div>
		</div>
		<?php }//end check is nri ?>
		<div class="col-md-4">
			 <div class="info">
			<p class="question">Mobile Number</p>
			<p class="answer"><?php echo chkEmptyNonZero($DataList->mobile_isd,TRUE).' '.chkEmptyNonZero($DataList->user_mobile); ?></p>
		</div>
		</div>
		<div class="col-md-4">
			 <div class="info">
			<p class="question">Phone Number</p>
			<p class="answer"><?php echo chkEmptyNonZero($DataList->phone_isd,TRUE).' '.chkEmptyNonZero($DataList->user_phone_no); ?></p>
		</div>
		</div>
    </div>
     
    <hr/>
    <h5><b>Address</b></h5>
	<div class="row information">
		<div class="col-md-4 ">
	      <div class="info">
			<p class="question">Country</p>
			<p class="answer"><?php echo $DataList->country_name; ?></p>
		 </div>
		</div>
		<div class="col-md-4">
		<div class="info">
			<p class="question">State</p>
			<p class="answer"><?php echo $DataList->state_name; ?></p>
		</div>
		</div>
		<div class="col-md-4">
 		<div class="info">
			<p class="question">City</p>
			<p class="answer"><?php echo $DataList->city_name; ?></p>
		</div>
		</div>
		<div class="col-md-4">
			 <div class="info">
			<p class="question">Postal / Zip Code</p>
			<p class="answer"><?php echo $DataList->zipcode; ?></p>
		</div>
		</div>
		<div class="col-md-4">
			 <div class="info">
			<p class="question">Street Address </p>
			<p class="answer"><?php echo $DataList->street_address; ?></p>
		</div>
		</div>
		<div class="col-md-4">
			 <div class="info">
			<p class="question">Street Address Line 2</p>
			<p class="answer"><?php echo $DataList->street_address2; ?></p>
		</div>
		</div>
		
    </div>
	
	<hr/>
	<h5><b>Details of Contact Person in Madhya Pradesh</b></h5>
	<div class="row information">
		<div class="col-md-6">
	      <div class="info">
			<p class="question">Contact Person Name</p>
			<p class="answer"><?php echo $DataList->contact_name; ?></p>
		 </div>
		</div>
		<div class="col-md-6">
		<div class="info">
			<p class="question">Father/Husband Name</p>
			<p class="answer"><?php echo $DataList->contact_father_or_husband; ?></p>
		</div>
		</div>
		<div class="col-md-6">
 		<div class="info">
			<p class="question">Aadhaar Number</p>
			<p class="answer"><?php echo $DataList->contact_aadhaar; ?></p>
		</div>
		</div>
		<div class="col-md-6">
			<div class="info">
			<p class="question">Email</p>
			<p class="answer"><?php echo $DataList->contact_email; ?></p>
		</div>
		</div>		
    </div>
	
	<hr/>
	<h5><b>Professional Profile</b></h5>
	<div class="row information">
		<div class="col-md-6">
	      <div class="info info-large">
			<p class="question">Profile Summary</p>
			<p class="answer"><?php echo $DataList->profile_summary; ?></p>
		 </div>
		</div>
		<div class="col-md-6">
			<div class="info info-large">
			<p class="question">Expert Area</p>
			<p class="answer"><?php echo $DataList->expert_area; ?></p>
		    </div>
		</div>
		<div class="col-md-4">
 		<div class="info">
			<p class="question">Current Organization</p>
			<p class="answer"><?php echo $DataList->current_organization; ?></p>
		</div>
		</div>
		<div class="col-md-4">
		<div class="info">
			<p class="question">Work Experience (Years)</p>
			<p class="answer"><?php echo $DataList->work_experience; ?></p>
		</div>
		</div>
		<div class="col-md-4">
			<div class="info">
			<p class="question">Designation</p>
			<p class="answer"><?php echo $DataList->designation; ?></p>
		</div>
		</div>
				
    </div>
	
	<hr/>
	<h5><b>Educational Details</b></h5>
	<div class="row information">
		<div class="col-md-6 ">
	      <div class="info">
			<p class="question">Degree</p>
			<p class="answer"><?php echo $DataList->degree; ?></p>
		 </div>
		</div>
		<div class="col-md-6">
		<div class="info">
			<p class="question">Institute Name</p>
			<p class="answer"><?php echo $DataList->institute_name; ?></p>
		</div>
		</div>
		<div class="col-md-6">
 		<div class="info info-large">
			<p class="question">Additional Certificates</p>
			<p class="answer"><?php echo $DataList->additional_certificates; ?></p>
		</div>
		</div>
		<div class="col-md-6">
			<div class="info info-large">
			<p class="question">Area of Specialization / Interest</p>
			<p class="answer"><?php echo $DataList->area_of_interest; ?></p>
		</div>
		</div>		
    </div>
	<?php 
	if($DataList->user_step==2){
	    $hidden = array('id' => html_escape(isset($DataList->user_id)? encrypt_decrypt('encrypt',$DataList->user_id):''));
		$atr2 =array('id'=>'frmMember','name'=>'frmMember','role'=>'form', 'autocomplete'=>'off');
   		echo form_open('manage/Member/edit',$atr2,$hidden); 
	?>
     
     <?php if($optstatus==1){ ?>
     <div class="form-group clearfix" style="width: 30%;margin: 0 auto;">
     <label class="col-lg-2 col-md-5 control-label">Status</label>  
     <div class="col-lg-10 col-md-7">
     <?php $STATUS = array(""=>"--Select Status--",'1'=>'Active','0'=>'Inactive');
		echo form_dropdown('status', $STATUS, (isset($DataList->user_status) && $DataList->user_status !='' )?
         html_escape($DataList->user_status):set_value('status'),array('class'=> 'form-control input-medium'));
	    ?>
     </div>
     </div><!--End Form-group-->
     <?php }//end check optstatus ?>
     
     <br/>
     <div class="form-group clearfix" style="width: 30%;margin: 0px auto">
     <label class="col-lg-2 col-md-3 control-label">&nbsp;</label>  
     <div class="col-lg-10 col-md-7">
     <button type="submit" class="btn btn-info" style="display: table;margin: 0px auto;">Submit</button>
     </div>
     </div><!--End Form-group-->

    <?php echo "</form>";
     }// end if of user step
     ?>
      
    <a class="btn purple" href="<?php echo base_url('manage/Member/'); ?>"> Back</a>
    </div><!--End portlet body-->  
</div><!--End portlet box-->
</div><!--End col-md-1-->
</div><!--End row-->
<!--End from layout-->
<!------------------------------------------------------------------- -->
</div><!--End column -->
</div><!--End row-->
<!-- END PAGE CONTENT-->
<script type="text/javascript" src="<?php echo base_url('webroot/');?>validation/dist/jquery.validate.js"></script>
<script type="text/javascript">
$(document).ready(function(){

        $("#frmMember").validate({
            rules: {
               status: {
					required: true,
					digits:true
				}
            },
	        submitHandler: function (form) {
	                form.submit();
	                $('#ajaxloading').modal('show');
	        }
        });//end validation

});//end dom
</script>