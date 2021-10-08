<?php 
$user_enc_id = html_escape(isset($DataList->user_id)? encrypt_decrypt('encrypt',$DataList->user_id):'');
?>
<!-- BEGIN PAGE HEADER-->
<div class="row">
<div class="col-md-12">
	<ul class="page-breadcrumb breadcrumb">
		<li><i class="fa fa-home"></i><a href="<?php echo base_url('manage/Dashboard/'); ?>">Home</a><i class="fa fa-angle-right"></i></li>
		<li><a href="<?php echo base_url('manage/Individual/'); ?>">Individual User </a><i class="fa fa-angle-right"></i></li>
		<li><a href="javascript:void(0);">Individual User Details</a></li>
	</ul>
	<!-- END PAGE TITLE & BREADCRUMB-->
</div>
</div>
<!-- END PAGE HEADER-->
<!-- BEGIN PAGE CONTENT-->

 <?php if($allowStatus==1){ ?>
<!-- BEGIN BORDERED TABLE PORTLET-->
<div class="portlet box blue">
<div class="portlet-title">
  <div class="caption">Update Individual User Status</div>
  <div class="tools"> <a href="javascript:;" class="collapse"> </a></div>
</div><!--End portlet-title-->
<div class="portlet-body">

<div class="row"><div class="col-lg-12">
<?php echo AlertMessage($this->session->flashdata('AppMessage'));?>
</div></div>
<!--End Validation message-->
 <!--------------------------------------------------------------------->
  <?php
  //check email status
  if($DataList->email_verify_status==1){
  
  $hidden = array('id' =>$user_enc_id);
  $atr2 =array('id'=>'frmIndividual','name'=>'frmIndividual','class'=>'horizontal-form','role'=>'form', 'autocomplete'=>'off');
  echo form_open('manage/Individual/update_status',$atr2,$hidden); 
  ?>
  
  <div class="row">
	 <div class="col-sm-6"> 
	 <div class="form-group">
     <label class="control-label">Individual User Status <span class="red">*</span></label>  
     <?php $STATUS = array(''=>'--SELECT STATUS---','1'=>'Approved','2'=>'Reject');
		echo form_dropdown('p_status', $STATUS, (isset($DataList->user_status) && $DataList->user_status !='' )?html_escape($DataList->user_status):set_value('p_status'),array('class'=> 'form-control','id'=>'p_status'));
	    ?>
	 </div><!--End Form-group-->
     </div><!--End column-->
     
    </div><!--end row--> 
    <div class="row">
     
     <div class="col-sm-12"> 
	 <div class="form-group">
     <label class="control-label">Comment <span class="red">*</span></label>  
     <?php $PROJECT_STATUS_COMMENT = array( 
      'name'=>'p_comment','id'=>'p_comment','class'=> 'form-control','rows'=>4,'maxlength'=>255,'placeholder'=>'Please enter comment','tabindex'=>7,'value'=>(isset($DataList->comment) && $DataList->comment !='' )?html_escape($DataList->comment):set_value('p_status'));
	 echo form_textarea($PROJECT_STATUS_COMMENT);
	 ?>
	 </div><!--End Form-group-->
     </div><!--End column-->
     
    </div><!--end row--> 
    <div class="row">
     <div class="col-sm-12">
			<button type="submit" tabindex="18" class="btn green">Submit</button>
			<button type="reset" tabindex="19" id="reset" class="btn blue">Clear</button>
			<a class="btn purple" tabindex="20" href="<?php echo base_url('manage/Individual/'); ?>">Back</a>
		</div>
  </div><!--End row-->
 
  <?php echo form_close();
   }else{?>
   
   <div class="row">
  	<div class="col-sm-12">
  	  <div class="alert alert-info">
        <strong>Note!</strong> This user did not verify email status.
      </div><!--End alert-->
  	</div><!--End column-->
  </div>
   
   <?php } ?>
 
 <!-------------------------------------------------------------------->
</div><!-- End portlet-body -->
</div><!-- End BORDERED TABLE PORTLET-->
<!--------------------------------------------------------------------->
 <?php }//end check access ?>

<div class="row">
<div class="col-md-12">
<!------------------------------------------------------------------- -->
<!-- BEGIN BORDERED TABLE PORTLET-->
<div class="portlet box blue">
<div class="portlet-title">
  <div class="caption">Individual User Details</div>
  <div class="tools"> <a href="javascript:;" class="collapse"> </a></div>
</div><!--End portlet-title-->
<div class="portlet-body">
<?php if(isset($DataList)){ ?>
	
<!----------------------------------------------------------------------->
<h3 class="form-section">Individual User Details (व्यक्तिगत उपयोगकर्ता विवरण)</h3>
 	 
  <div class="row" style=" margin-bottom: 20px;">
 	<div class="col-md-4 thumb">
		<?php 
		$pancard_img = (isset($DataList->pan_card_attachment) && trim($DataList->pan_card_attachment)!="")? 'uploads/individual/'.html_escape($DataList->pan_card_attachment):'webroot/img/no-image.png';
	 		
	    ?>
	   <div class="brand-thumb" style="background:url('<?php echo base_url($pancard_img); ?>'); "></div>
 	</div>
	<div class="col-md-8">
	
	<div class="row">
		
		<div class="col-md-6">
		<label class="control-label">First Name (पहला नाम)</label>
		<div class="we-control">
	    <?php echo html_escape($DataList->user_fname);?>
	    </div>
		</div><!--End column--> 
		
		<div class="col-md-6">
		<label class="control-label">Last Name (सरनेम)</label>		
		<div class="we-control">
	    <?php echo html_escape($DataList->user_lname);?>
	    </div>
		</div><!--End column-->
	
  </div><!--End row-->
  <div class="row">
  	<div class="col-md-12">
		<label class="control-label">Email Id (ईमेल आईडी)</label>
		<div class="we-control">
	    <?php echo html_escape($DataList->user_email);?>
	    </div>
		</div><!--End column--> 
  </div>
	<div class="row">		
		<div class="col-md-6">
		<label class="control-label">Mobile Number (मोबाइल नंबर)</label>		
		<div class="we-control">
	    <?php echo html_escape($DataList->user_mobile);?>
	    </div>
		</div><!--End column-->
		
		<div class="col-md-6">
		<label class="control-label">Alternate Mobile Number (वैकल्पिक मोबाइल नंबर)</label>
		<div class="we-control">
	    <?php echo html_escape($DataList->user_phone_no);?>
	    </div>
		</div><!--End column--> 
	
  </div><!--End row-->
	<div class="row">
			
		<div class="col-md-6">
		<label class="control-label">PAN Number (स्थायी खाता संख्या)</label>
		<div class="we-control">
	    <?php echo html_escape($DataList->pan_number);?>
	    </div>
		</div><!--End column-->
		
		<div class="col-md-6">
		<label class="control-label">Aadhar Number (आधार संख्या)</label>
		<div class="we-control">
	    <?php
		$aadhar_no = encrypt_decrypt('decrypt',$DataList->aadhar_no);
		echo "XXXX XXXX ".html_escape(substr($aadhar_no,8,4));
		?>
	    </div>
		</div><!--End column--> 
	
  </div><!--End row-->
	
	</div>
 </div><!--End row individual Information-->

<h3 class="form-section">Individual User Address (व्यक्तिगत उपयोगकर्ता पता)</h3>
  <div class="row">
		
		<div class="col-md-6">
		<label class="control-label">State (राज्य)</label>
		<div class="we-control">
	    <?php echo html_escape($DataList->state_name);?>
	    </div>
		</div><!--End column--> 
		
		<div class="col-md-6">
		<label class="control-label">Area (क्षेत्र) </label>		
		<div class="we-control">
	    <?php echo html_escape($DataList->area_name);?>
	    </div>
		</div><!--End column-->
	
  </div><!--End row-->

  <div class="row">
		
		<div class="col-md-6">
		<label class="control-label">District (जिला)</label>
		<div class="we-control">
	    <?php echo html_escape($DataList->district_name);?>
	    </div>
		</div><!--End column--> 
		
		<div class="col-md-6">
		<label class="control-label">Block (ब्लॉक)</label>		
		<div class="we-control">
	    <?php echo html_escape($DataList->block_name);?>
	    </div>
		</div><!--End column-->
	
  </div><!--End row-->

  <?php if(trim($DataList->area_name)=="rural"){ ?>  	
  <div class="row">
		
		<div class="col-md-6">
		<label class="control-label">Gram Panchayat (ग्राम पंचायत)</label>
		<div class="we-control">
	    <?php echo html_escape($DataList->gram_panchayat_name);?>
	    </div>
		</div><!--End column--> 
		
		<div class="col-md-6">
		<label class="control-label">Village (गाँव)</label>		
		<div class="we-control">
	    <?php echo html_escape($DataList->village_name);?>
	    </div>
		</div><!--End column-->
	
  </div><!--End row-->  
  <?php }//end check area name ?>

  <div class="row">		
		<div class="col-md-9">
		<label class="control-label">Address (पता)</label>
		<div class="we-control">
	    <?php echo html_escape($DataList->address);?>
	    </div>
		</div><!--End column--> 
		<div class="col-md-3">
		<label class="control-label">Pincode (पिन कोड) </label>		
		<div class="we-control">
	    <?php echo html_escape($DataList->pincode);?>
	    </div>
  </div><!--End column-->	
  </div><!--End row-->
 
<!----------------------------------------------------------------------->
<?php }//end check isset DataList  ?>
</div><!-- End portlet-body -->
</div><!-- End BORDERED TABLE PORTLET-->
<!------------------------------------------------------------------- -->

</div><!--End column -->
</div><!--End row-->
<!-- END PAGE CONTENT-->
<script type="text/javascript" src="<?php echo base_url('webroot/');?>validation/dist/jquery.validate.js"></script>
<script type="text/javascript">
	jQuery(function(){
		
	jQuery.validator.addMethod("alphanumspace", function(value, element) {
		  return this.optional(element) || /^[a-zA-Z0-9\s]*$/.test(value);
	}, "Please enter character, number and space only.");

	$("#frmIndividual").validate({
		  rules: { 
		      p_status:{
				required: true,
			  	digits:true
		      },
		      p_comment:{
				required: true,
			  	minlength:2,
		        maxlength:1000
		      }			  
		  },
	      submitHandler: function (form) {
	        form.submit();
	        $('#ajaxloading').modal('show');
	      }
		});
			
	});
</script>