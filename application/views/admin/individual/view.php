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