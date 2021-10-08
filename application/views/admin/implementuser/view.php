<?php 
$user_enc_id = html_escape(isset($DataList->user_id)? encrypt_decrypt('encrypt',$DataList->user_id):'');
?>
<!-- BEGIN PAGE HEADER-->
<div class="row">
<div class="col-md-12">
	<ul class="page-breadcrumb breadcrumb">
		<li><i class="fa fa-home"></i><a href="<?php echo base_url('manage/Dashboard/'); ?>">Home</a><i class="fa fa-angle-right"></i></li>
		<li><a href="<?php echo base_url('manage/Implementuser/'); ?>"> </a><i class="fa fa-angle-right"></i></li>
		<li><a href="javascript:void(0);">Implementing Partner Details</a></li>
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
  <div class="caption">Implementing Partner Details</div>
  <div class="tools"> <a href="javascript:;" class="collapse"> </a></div>
</div><!--End portlet-title-->
<div class="portlet-body">
<?php if(isset($DataList)){ ?>
	
<!----------------------------------------------------------------------->
<h3 class="form-section">CSR Representative Implementing Agency Details (सीएसआर प्रतिनिधि कार्यान्वयन एजेंसी विवरण)</h3>
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
		
		<div class="col-md-6">
		<label class="control-label">Email Id (ईमेल आईडी)</label>
		<div class="we-control">
	    <?php echo html_escape($DataList->user_email);?>
	    </div>
		</div><!--End column--> 
		
		<div class="col-md-6">
		<label class="control-label">Mobile Number (मोबाइल नंबर)</label>		
		<div class="we-control">
	    <?php echo html_escape($DataList->user_mobile);?>
	    </div>
		</div><!--End column-->
	
  </div><!--End row-->
	<div class="row">
		
		<div class="col-md-12">
		<label class="control-label">Alternate Mobile Number (वैकल्पिक मोबाइल नंबर)</label>
		<div class="we-control">
	    <?php echo html_escape($DataList->user_phone_no);?>
	    </div>
		</div><!--End column--> 
	
  </div><!--End row-->

<h3 class="form-section">Implementing Partner Details (कार्यान्वयन साथी का विवरण)</h3>
 	 
  <div class="row" style="    margin-bottom: 20px;">
 	<div class="col-md-4 thumb">
		<?php 
		$log = (isset($DataList->agency_logo) && trim($DataList->agency_logo)!="")? 'uploads/agency/'.html_escape($DataList->agency_logo):'webroot/img/no-image.png';
		$pancard_img = (isset($DataList->pan_card_attachment) && trim($DataList->pan_card_attachment)!="")? 'uploads/agency/'.html_escape($DataList->pan_card_attachment):'webroot/img/no-image.png';
		$reg_doc_img = (isset($DataList->agency_registration_doc) && trim($DataList->agency_registration_doc)!="")? 'uploads/agency/'.html_escape($DataList->agency_registration_doc):'webroot/img/no-image.png';
	 		
	    ?>
	   <div class="brand-thumb" style="background:url('<?php echo base_url($log); ?>'); "></div>
	   <div class="brand-thumb" style="background:url('<?php echo base_url($pancard_img); ?>'); "></div>
	   <div class="brand-thumb" style="background:url('<?php echo base_url($reg_doc_img); ?>'); "></div>
 	</div>
 	 <div class="col-md-8">
	
	<!--projet detaile-->
	<div class="row">
		
	  <div class="col-md-12">
		<label class="control-label">Agency Name (एजेंसी का नाम) </label>
		<div class="we-control">
		<?php echo html_escape($DataList->agency_name); ?>
		</div>	
	  </div>
		
	 <div class="col-md-4">
	   <label class="control-label">Agency Type (एजेंसी का प्रकार) </label>
	   <div class="we-control">
	   <?php echo html_escape($DataList->agency_type_name);?>
	   </div>
	 </div>
	 
	<div class="col-md-8">
	  <label class="control-label">Agency Registration/Incorporation date (एजेंसी पंजीकरण / शामिल तिथि)</label>
	  <div class="we-control">
	  <?php echo get_date($DataList->agency_registration_date);?>
	  </div>
	 </div><!--End column-->
	 
	 <div class="col-md-6">
		<label class="control-label">PAN Number (स्थायी खाता संख्या)</label>	
		<div class="we-control">
	    <?php echo html_escape($DataList->pan_number);?>
	    </div>
	 </div>
	 
	 <div class="col-md-6">
		<label class="control-label">Registration Number (पंजीकरण संख्या)</label>	
		<div class="we-control">
	    <?php echo html_escape($DataList->agency_registration_number);?>
	    </div>
	 </div>
	    
	 <div class="col-md-8">
		<label class="control-label">Project Interest Category (परियोजना रुचि श्रेणी)</label>
		<div class="we-control">
	    <?php echo html_escape($DataList->project_interest_category);?>
	    </div>
	 </div><!--End column--> 
	 
	 <div class="col-md-4">
		<label class="control-label">Designation (पद)</label>
		<div class="we-control">
	    <?php echo html_escape($DataList->designation);?>
	    </div>
	 </div><!--End column-->
	 
	 <div class="col-md-12">
		<label class="control-label">Webiste URL (वेबसाइट यू.आर.एल)</label>
		<div class="we-control">
	    <?php echo html_escape($DataList->website_url);?>
	    </div>
	 </div><!--End column-->
	 
	<div class="col-md-12">
		<label class="control-label">Description (विवरण)</label>
		<div class="we-control">
	    <?php echo html_escape($DataList->agency_description);?>
	    </div>
	 </div><!--End column-->
		
     </div><!--projet detaile-->	
    </div><!--End column-->	
		
	</div><!--End row company Information-->

<h3 class="form-section">Organization Registered Address (संस्था पंजीकृत पता)</h3>
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
 
 <h3 class="form-section">Organization Local Address (संस्था का स्थानीय पता स्थानीय पता)</h3>
 
 <?php if(isset($AgencyLocalList) && count($AgencyLocalList)>0){ 
 foreach($AgencyLocalList as $row){ 
 ?>
 	
 <div class="row">
		
		<div class="col-md-4">
		<label class="control-label">Area (क्षेत्र) </label>		
		<div class="we-control">
	    <?php echo html_escape($row->local_area_name);?>
	    </div>
		</div><!--End column-->
		
		<div class="col-md-4">
		<label class="control-label">District (जिला)</label>
		<div class="we-control">
	    <?php echo html_escape($row->local_district_name);?>
	    </div>
		</div><!--End column--> 
		
		<div class="col-md-4">
		<label class="control-label">Block (ब्लॉक)</label>		
		<div class="we-control">
	    <?php echo html_escape($row->local_block_name);?>
	    </div>
		</div><!--End column-->
	
  </div><!--End row-->

  <?php if(trim($row->local_area_name)=="rural"){ ?>  	
  <div class="row">
		
		<div class="col-md-6">
		<label class="control-label">Gram Panchayat (ग्राम पंचायत)</label>
		<div class="we-control">
	    <?php echo html_escape($row->local_gram_panchayat_name);?>
	    </div>
		</div><!--End column--> 
		
		<div class="col-md-6">
		<label class="control-label">Village (गाँव)</label>		
		<div class="we-control">
	    <?php echo html_escape($row->local_village_name);?>
	    </div>
		</div><!--End column-->
	
  </div><!--End row-->  
  <?php }//end check area name ?>

  <div class="row">		
		<div class="col-md-9">
		<label class="control-label">Address (पता)</label>
		<div class="we-control">
	    <?php echo html_escape($row->local_address);?>
	    </div>
		</div><!--End column--> 
		<div class="col-md-3">
		<label class="control-label">Pin Code (पिन कोड) </label>		
		<div class="we-control">
	    <?php echo html_escape($row->local_pincode);?>
	    </div>
  </div><!--End column-->	
  </div><!--End row-->
<?php }//end foreach Company Local List
 }//end count Company Local List ?>
 
 <!----------------------------------------------------------------------------------->
 
 <h3 class="form-section">Implementing Partner Financial Details (कंपनी वित्तीय विवरण)</h3>

 <div class="table-responsive">
 <table class="table table-striped box-table-a">
  <thead>
  	 <tr>
 		<th width="20%">Financial Year (वित्तीय वर्ष)</th>
 		<th width="80%"><strong>Turnover (टर्नओवर)</strong></th>
 	 </tr>
  </thead>
  <tbody>
 <?php if(isset($AgencyFinancialList) && count($AgencyFinancialList)>0){ 
 foreach($AgencyFinancialList as $rows){ 
 ?>
  	<tr>
 		<td width="20%"><?php echo html_escape($rows->financial_year);?></td>
 		<td width="80%"><?php echo html_escape($rows->turnover);?> Rs.</td>
 	</tr>
 <?php }//end foreach Company Finanacial List
 }//end count Company Finanacial List ?>
  </tbody>
 </table>
 </div><!--End table-responsive-->
 
<!----------------------------------------------------------------------->

<div class="row">
  <div class="col-md-12">
   <label class="control-label">Whether Implementing Agency blacklisted / debarred by any State or Central Government Organization (क्या कार्यान्वयन एजेंसी किसी भी राज्य या केंद्र सरकार संगठन द्वारा ब्लैकलिस्ट / वंचित किया गया है) :- <?php echo DefaultStatus($DataList->is_blacklisted_state);?></label>		
  </div><!--End column-->
</div>

<?php if($DataList->is_blacklisted_state==1){ ?>

 <h3 class="form-section">List of blacklisted / debarred by any State or Central Government Organization <label>(किसी भी राज्य या केंद्र सरकार संगठन द्वारा ब्लैकलिस्ट / डेबर्ड की सूची)</label></h3>
 
 <div class="table-responsive">
 <table class="table table-striped box-table-a">
  <thead>
  	 <tr>
 		<th width="20%">Govt. Organization name <label>(सरकारी संगठन का नाम)</label></th>
 		<th width="10%">Date of Order <label>(आदेश की तिथि)</label></th>
 		<th width="10%">Start Date <label>(प्रारंभ तिथि)</label></th>
 		<th width="10%">End Date <label>(समाप्ति तिथि)</label></th>
 		<th width="10%">copy of order<label>(आदेश की प्रति)</label></th>
 	 </tr>
  </thead>
  <tbody>
  	<tr>
 		<td width="20%"><?php echo html_escape($DataList->blacklist_govt_org_name);?></td>
 		<td width="10%"><?php echo get_date($DataList->blacklist_order_date);?></td>
 		<td width="10%"><?php echo get_date($DataList->blacklist_start_date);?></td>
 		<td width="10%"><?php echo get_date($DataList->blacklist_end_date);?></td>
 		<td width="10%" class="text-center">
	    <?php if(trim($DataList->blacklist_order_file)!=""): ?>
	    <a target="_blank" href="<?php echo base_url('uploads/agency/'.$DataList->blacklist_order_file); ?>"><i class="fa fa-download"></i></a>
	    <?php endif; ?>
	    </td>
 	</tr>
  </tbody>
 </table>
 </div><!--End table-responsive-->
 <?php }else{ ?>
 <div class="row">
 	<div class="col-md-12">
 	<div class="we-control">
   <?php if(trim($DataList->cacs_certificate_attachment)!=""): ?>
	    <a target="_blank" href="<?php echo base_url('uploads/agency/'.$DataList->cacs_certificate_attachment); ?>"> Download Document<i class="fa fa-download"></i></a>
<?php endif; ?>
    </div>
  </div><!--End column-->
 </div><!--End row-->
 <?php } ?>
<!----------------------------------------------------------------------->

<div class="row">		
 <div class="col-md-12">
  <label class="control-label">Is Implementing Agency registered under FCRA (क्या ये एफसीआरए के तहत पंजीकृत कार्यान्वयन एजेंसी है)</label> :- <?php echo DefaultStatus($DataList->is_agency_fcra_registered);?>
  <div class="we-control">
   <?php if(trim($DataList->fcra_reg_attachment)!=""): ?>
	    <a target="_blank" href="<?php echo base_url('uploads/agency/'.$DataList->fcra_reg_attachment); ?>">Download Document <i class="fa fa-download"></i></a>
<?php endif; ?>
  </div><!--End we-control-->
  </div><!--End column--> 	
</div><!--End row-->
<!----------------------------------------------------------------------->

<div class="row">
  <div class="col-md-12">
   <label class="control-label">Is Implementing Agency registered/ empanelled with any State or Central Government organization (कार्यान्वयन एजेंसी किसी भी राज्य या केंद्र सरकार संगठन के साथ पंजीकृत / सूचीबद्ध है) :- <?php echo DefaultStatus($DataList->is_agency_state_registered);?></label>		
  </div><!--End column-->
</div>

<?php if($DataList->is_agency_state_registered==1){ ?>

 <h3 class="form-section">Details of State or Central Government Organization <label>(राज्य या केंद्र सरकार संगठन का विवरण)</label></h3>
 
 <div class="table-responsive">
 <table class="table table-striped box-table-a">
  <thead>
  	 <tr>
 		<th width="20%">Govt. Organization name <label>(सरकारी संगठन का नाम)</label></th>
 		<th width="10%">Date of Order <label>(आदेश की तिथि)</label></th>
 		<th width="10%">Start Date <label>(प्रारंभ तिथि)</label></th>
 		<th width="10%">End Date <label>(समाप्ति तिथि)</label></th>
 		<th width="10%">copy of order<label>(आदेश की प्रति)</label></th>
 		<th width="10%">Added Date<label>(जोड़ा गया दिनांक)</label></th>
 	 </tr>
  </thead>
  <tbody>
  <?php if(isset($GovtRegListfilter) && count($GovtRegListfilter)>0){ 
     foreach($GovtRegListfilter as $rows){ 
  ?>
  	<tr>
 		<td width="20%"><?php echo html_escape($rows['govt_organization_name']);?></td>
 		<td width="10%"><?php echo get_date($rows['date_of_order']);?></td>
 		<td width="10%"><?php echo get_date($rows['effective_start_date']);?></td>
 		<td width="10%"><?php echo get_date($rows['effective_end_date']);?></td>
 		<td width="10%" class="text-center">
	    <?php if(trim($rows['order_attachment'])!=""): ?>
	    <a target="_blank" href="<?php echo base_url('uploads/files/'.$rows['order_attachment']); ?>"><i class="fa fa-download"></i></a>
	    <?php endif; ?>
	    </td>
 		<td width="10%"><?php echo get_date($rows['added_date']);?></td>
 	</tr>
   <?php }//end foreach List
    }//end count List ?>
  </tbody>
 </table>
 </div><!--End table-responsive-->
 <?php } ?>
<!----------------------------------------------------------------------->

 <h3 class="form-section">List of additional document <label>(अतिरिक्त दस्तावेज़ की सूची)</label></h3>
 
 <div class="table-responsive">
 <table class="table table-striped box-table-a">
  <thead>
  	 <tr>
 		<th width="20%">Document name <label>(दस्तावेज़ का नाम)</label></th>
 		<th width="10%">Document Attachment<label>(दस्तावेज़ अनुलग्नक)</label></th>
 		<th width="10%">Added Date<label>(जोड़ा गया दिनांक)</label></th>
 		<th width="10%">Status<label>(जोड़ा गया दिनांक)</label></th>
 	 </tr>
  </thead>
  <tbody>
  <?php if(isset($AditionalDocList) && count($AditionalDocList)>0){ 

     foreach($AditionalDocList as $rows){ 
  ?>
  	<tr>
 		<td width="20%"><?php echo html_escape($rows['document_name']);?></td>
 		<td width="10%" class="text-center">
	    <?php if(trim($rows['attachment'])!=""): ?>
	    <a target="_blank" href="<?php echo base_url('uploads/files/'.$rows['attachment']); ?>"><i class="fa fa-download"></i></a>
	    <?php endif; ?>
	    </td>
 		<td width="10%"><?php echo get_date($rows['added_date']);?></td>
 		<td width="10%"><?php echo DisplayStatus($rows['doc_status']);?></td>
 	</tr>
   <?php }//end foreach Company Finanacial List
    }else{
    	echo '<tr><td colspan="4" width="20%" class="text-center">Record not found</td>';
    }//end count Company Finanacial List ?>
  </tbody>
 </table>
 </div><!--End table-responsive-->
<!----------------------------------------------------------------------->

<?php }//end check isset DataList  ?>
</div><!-- End portlet-body -->
</div><!-- End BORDERED TABLE PORTLET-->
<!------------------------------------------------------------------- -->

</div><!--End column -->
</div><!--End row-->
<!-- END PAGE CONTENT-->