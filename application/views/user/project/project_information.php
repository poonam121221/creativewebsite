<article class="min_350 noise_bg">

<div class="container data-container ptb-30">
 <div class="row dashboard-header">
 <div class="col-md-12">
  <?php echo $this->breadcrumbs->show(); ?>
<!--<a href="javascript:void(0);" title="Print Page" class="print"><em class="fa fa-print"></em>Print</a>-->
 </div><!--End column-->
 </div><!--End row-->
<div class="row">
 <div class="col-md-2">
  <?php
  if($this->session->has_userdata('AUTH_LOCAL_USER')==TRUE){
  	if($this->session->userdata['AUTH_LOCAL_USER']['USER_TYPE']==1){
		$this->view('company/element/inc_sidebar'); 
	}else{
		$this->view('individual/element/inc_sidebar'); 
	}   
  }  
  ?>
 </div>
 <div class="col-md-10">
 
 <?php $this->view('user/element/inc_user_info'); ?>
 
<div class="row">
<div class="col-md-12">`

<ul class="nav nav-pills blue-pill">
<li class="active"><a href="<?php echo base_url('project/information/'.$project_enc_id);?>"><span>1</span> Details</a></li>
<li><a href="<?php echo base_url('project/document/'.$project_enc_id);?>"><span>2</span> Documents</a></li>
<li><a href="<?php echo base_url('project/milestone/'.$project_enc_id);?>"><span>3</span> Milestone</a></li>
</ul>

</div><!--End column-->
</div><!--End row-->
 
 <div class="row">
   <div class="col-lg-12"><?php echo AlertMessage($this->session->flashdata('AppMessage'));?></div>
  </div><!--End Validation message-->
<!---------------------------------------------------->
<div class="row mt-20 data-box">

 <div class="col-md-12">
  <div class="panel panel-primary data-panel">
   <div class="panel-heading">Project Details</div>
   <div class="panel-body">
<!---------------------------------------------------->
<?php if(isset($DataList)==TRUE && $DataList!=FALSE){ ?>
<div class="h3 title text-center">Contact Person Details (संपर्क व्यक्ति विवरण)</div>
<div class="row one-box">

	<div class="col-md-12 profile-deatile">
	 <div class="row">
	  <div class="col-md-2 profile-label"> Name (नाम):</div>
	  <div class="col-md-10 label-result">
	  <?php echo html_escape(trim($DataList->cnt_person_fname." ".$DataList->cnt_person_lname));?>
	  </div>
	 </div>
	</div>
	<div class="col-md-6 profile-deatile">
	 <div class="row">
	  <div class="col-md-4 profile-label"> Email (ईमेल):</div>
	  <div class="col-md-8 label-result">
	  <?php echo html_escape($DataList->cnt_person_email);?>
	  </div>
	 </div>
	</div>
	<div class="col-md-6 profile-deatile">
	 <div class="row">
	  <div class="col-md-4 profile-label"> Mobile (मोबाइल):</div>
	  <div class="col-md-8 label-result">
	  <?php echo html_escape($DataList->cnt_person_mobile);?>
	  </div>
	 </div>
	</div>
	
</div><!--End row-box-->

<div class="row ">
			<div class="col-md-9">
				<div class="h3 title text-center">Project Details (परियोजना विवरण)</div>
				<!---->
				<div class="row one-box">
				<div class="col-md-12 profile-deatile">
					<div class="row">
						<div class="col-md-4 profile-label"> Project Title (परियोजना का शीर्षक):</div>
						<div class="col-md-8 label-result"><?php echo html_escape($DataList->project_title); ?></div>
					</div>
				</div>
				<div class="col-md-12 profile-deatile">
					<div class="row">
						<div class="col-md-5 profile-label">Project Category (परियोजना श्रेणी):</div>
						<div class="col-md-7 label-result"><?php echo $DataList->project_category_name;?></div>
					</div>
				</div>
				<div class="col-md-12 profile-deatile">
					<div class="row">
						<div class="col-md-5 profile-label">Project Sub Category (परियोजना उप श्रेणी):</div>
						<div class="col-md-7 label-result"><?php echo html_escape($DataList->project_sub_cat_name);?></div>
					</div>
				</div>
				<div class="col-md-12 profile-deatile">
					<div class="row">
						<div class="col-md-5 profile-label">Project Owner Name (स्थायी खाता संख्या):</div>
						<div class="col-md-7 label-result"><?php echo html_escape($DataList->project_owner_name);?></div>
					</div>
				</div>
			</div>
			<!---->
			</div>
			<div class="col-md-3">
<?php 
$project_img = (isset($DataList->project_image) && trim($DataList->project_image)!="")? 'uploads/project/'.html_escape($DataList->project_image):'assets/img/img-not-found.png';
?>
				<div class="logo-image" style="width: 0px;height:0px; border:0px;"></div>
				<div class="pan-image" style="background: url(<?php echo base_url($project_img); ?>)"></div>
			</div>
</div><!--End row-->
<div class="row one-box">
	<div class="col-md-12 profile-deatile">
		<div class="row">
		 <div class="col-md-3 profile-label">Financial Year (वित्तीय वर्ष):</div>
		 <div class="col-md-9 label-result"><?php echo html_escape($DataList->financial_year);?></div>
		</div>
	</div>
	<div class="col-md-12 profile-deatile">
		<div class="row">
		 <div class="col-md-5 profile-label">Project Planned Start Date (परियोजना नियोजित प्रारंभ तिथि):</div>
		 <div class="col-md-7 label-result"><?php echo get_date($DataList->planned_start_date);?></div>
		</div>
	</div>
	<div class="col-md-12 profile-deatile">
		<div class="row">
		 <div class="col-md-5 profile-label">Project Planned End Date (परियोजना नियोजित समाप्ति तिथि):</div>
		 <div class="col-md-7 label-result"><?php echo get_date($DataList->planned_end_date);?></div>
		</div>
	</div>
	<div class="col-md-12 profile-deatile">
		<div class="row">
		 <div class="col-md-5 profile-label">Project Actual Start Date (परियोजना वास्तविक प्रारंभ तिथि):</div>
		 <div class="col-md-7 label-result"><?php echo get_date($DataList->actual_start_date);?></div>
		</div>
	</div>
	<div class="col-md-12 profile-deatile">
		<div class="row">
		 <div class="col-md-5 profile-label">Project Actual End Date (परियोजना वास्तविक समाप्ति तिथि):</div>
		 <div class="col-md-7 label-result"><?php echo get_date($DataList->actual_end_date);?></div>
		</div>
	</div>
	<div class="col-md-12 profile-deatile">
		<div class="row">
		 <div class="col-md-5 profile-label">Project Estimated Budget (परियोजना अनुमानित बजट):</div>
		 <div class="col-md-7 label-result"><?php echo html_escape($DataList->project_estmtd_budget);?></div>
		</div>
	</div>
	<div class="col-md-12 profile-deatile">
		<div class="row">
		 <div class="col-md-5 profile-label">Project Estimated Duration (Total Days) (परियोजना अनुमानित अवधि (कुल दिन)):</div>
		 <div class="col-md-7 label-result"><?php echo $DataList->project_estmtd_duration;?></div>
		</div>
	</div>
	<div class="col-md-6 profile-deatile">
		<div class="row">
		 <div class="col-md-4 profile-label">Division (संभाग):</div>
		 <div class="col-md-8 label-result"><?php echo html_escape($DataList->divisionNameEn);?></div>
		</div>
	</div>
	<div class="col-md-6 profile-deatile">
		<div class="row">
		 <div class="col-md-4 profile-label">District (जिला):</div>
		 <div class="col-md-8 label-result"><?php echo $DataList->district_name;?></div>
		</div>
	</div>
	<div class="col-md-6 profile-deatile">
		<div class="row">
		 <div class="col-md-4 profile-label">Block (ब्लॉक):</div>
		 <div class="col-md-8 label-result"><?php echo html_escape($DataList->block_name);?></div>
		</div>
	</div>
	<div class="col-md-6 profile-deatile">
		<div class="row">
		 <div class="col-md-4 profile-label">Village (ग्राम):</div>
		 <div class="col-md-8 label-result"><?php echo $DataList->village_name;?></div>
		</div>
	</div>
	<div class="col-md-12 profile-deatile">
		<div class="row">
		 <div class="col-md-4 profile-label">Department (विभाग):</div>
		 <div class="col-md-8 label-result"><?php echo html_escape($DataList->department_name);?></div>
		</div>
	</div>
	<div class="col-md-6 profile-deatile">
		<div class="row">
		 <div class="col-md-9 profile-label">Government/Private Land (सरकार / निजी भूमि):</div>
		 <div class="col-md-3 label-result"><?php echo DefaultStatus($DataList->govt_private_land);?></div>
		</div>
	</div>
	<div class="col-md-6 profile-deatile">
	<?php if($DataList->govt_private_land==1) { ?>
		<div class="row">
		 <div class="col-md-9 profile-label">Land Allocated  (भूमि आवंटित):</div>
		 <div class="col-md-3 label-result"><?php echo DefaultStatus($DataList->land_allocated);?></div>
		</div>
	<?php } ?>
	</div>
	<div class="col-md-12 profile-deatile">
		<div class="row">
		 <div class="col-md-4 profile-label">Project Location (परियोजना स्थल):</div>
		 <div class="col-md-8 label-result">
		 <?php echo html_escape(stripslashes2(html_entity_decode($DataList->project_location)));?>
		 </div>
		</div>
	</div>

	<div class="col-md-12 profile-deatile">
		<div class="row">
		 <div class="col-md-12 profile-label">
		 <hr class="style3"/>Project Description (परियोजना विवरण):<hr class="style3"/>
		 </div>
		 <div class="col-md-12 label-result">
		 <?php echo html_escape(stripslashes2(html_entity_decode($DataList->project_desc)));?>
		 </div>
		</div>
	</div>
	<hr/>
	
	<div class="col-md-12 profile-deatile">
		<div class="row">
		 <div class="col-md-4 profile-label">Project Risk (परियोजना जोखिम):</div>
		 <div class="col-md-8 label-result"><?php echo html_escape($DataList->risk_name);?></div>
		</div>
	</div>
	
	<div class="col-md-12 profile-deatile">
		<div class="row">
		 <div class="col-md-12 profile-label">
		 <hr class="style3"/>Project Risk Description (परियोजना जोखिम विवरण):<hr class="style3"/>
		 </div>
		 <div class="col-md-12 label-result">
		 <?php echo html_escape(stripslashes2(html_entity_decode($DataList->project_risk_desc)));?>
		 </div>
		</div>
	</div>
	<hr/>
	
	<div class="col-md-12 profile-deatile">
		<div class="row">
		 <div class="col-md-12 profile-label">
		 <hr class="style3"/>Expected Project Output (अपेक्षित परियोजना आउटपुट):<hr class="style3"/>
		 </div>
		 <div class="col-md-12 label-result">
		 <?php echo html_escape(stripslashes2(html_entity_decode($DataList->expt_project_output)));?>
		 </div>
		</div>
	</div>
	<hr/>
	
	<div class="col-md-12 profile-deatile">
		<div class="row">
		 <div class="col-md-12 profile-label">
		 <hr class="style3"/>Expected Project Outcomes (अपेक्षित परियोजना परिणाम):<hr class="style3"/>
		 </div>
		 <div class="col-md-12 label-result">
		 <?php echo html_escape(stripslashes2(html_entity_decode($DataList->expt_project_outcome)));?>
		 </div>
		</div>
	</div>
	<hr/>
	
	<div class="col-md-12 profile-deatile">
		<div class="row">
		 <div class="col-md-12 profile-label">
		 <hr class="style3"/>Actual Project Output (After project completion) (वास्तविक परियोजना आउटपुट (परियोजना पूर्ण होने के बाद)):<hr class="style3"/>
		 </div>
		 <div class="col-md-12 label-result">
		 <?php echo html_escape(stripslashes2(html_entity_decode($DataList->actual_project_output)));?>
		 </div>
		</div>
	</div>
	<hr/>
	
	<div class="col-md-12 profile-deatile">
		<div class="row">
		 <div class="col-md-12 profile-label">
		 <hr class="style3"/>Actual Project Outcomes (After project completion) (वास्तविक परियोजना परिणाम (परियोजना पूर्ण होने के बाद)):<hr class="style3"/>
		 </div>
		 <div class="col-md-12 label-result">
		 <?php echo html_escape(stripslashes2(html_entity_decode($DataList->actual_project_outcome)));?>
		 </div>
		</div>
	</div>
	<hr/>
	
	<div class="col-md-12 profile-deatile">
		<div class="row">
		 <div class="col-md-4 profile-label">Project assets created (परियोजना संपत्तियां बनाई गईं):</div>
		 <div class="col-md-8 label-result">
		 <?php echo html_escape(stripslashes2(html_entity_decode($DataList->project_assets)));?>
		 </div>
		</div>
	</div>
	<div class="col-md-12 profile-deatile">
		<div class="row">
		 <div class="col-md-4 profile-label">Outstanding Issues (बकाया मुद्दे):</div>
		 <div class="col-md-8 label-result">
		 <?php echo html_escape(stripslashes2(html_entity_decode($DataList->outstanding_issue)));?>
		 </div>
		</div>
	</div>
	<div class="col-md-12 profile-deatile">
		<div class="row">
		 <div class="col-md-4 profile-label">Outstanding Issues (बकाया मुद्दे):</div>
		 <div class="col-md-8 label-result">
		 <?php echo html_escape(stripslashes2(html_entity_decode($DataList->outstanding_issue)));?>
		 </div>
		</div>
	</div>
	
	<div class="col-md-12 profile-deatile">
		<div class="row">
		 <div class="col-md-12 profile-label">
		 <hr class="style3"/>Project Status Comments (परियोजना की स्थिति टिप्पणियाँ):<hr class="style3"/>
		 </div>
		 <div class="col-md-12 label-result">
		 <?php echo html_escape(stripslashes2(html_entity_decode($DataList->project_status_comment)));?>
		 </div>
		</div>
	</div>
	<hr/>
	
</div><!--End one-box-->

<?php }//end check isset DataList ?>
<!---------------------------------------------------->  
</div><!--End panel-body-->
</div><!--End panel-->
</div><!--End column-->
</div><!--End row data-box-->
<!---------------------------------------------------->

</div><!--End column-->
</div><!--End row-->
</div><!--End container-->
</article>	