<?php 
$implement_user_enc_id = html_escape(isset($DataList->user_id)? encrypt_decrypt('encrypt',$DataList->other_impl_id):'');
$user_enc_id = html_escape(isset($DataList->fk_user_id)? encrypt_decrypt('encrypt',$DataList->fk_user_id):'');
$project_enc_id = html_escape(isset($DataList->fk_project_id)? encrypt_decrypt('encrypt',$DataList->fk_project_id):'');
?>
<!-- BEGIN PAGE HEADER-->
<div class="row">
<div class="col-md-12">
	<ul class="page-breadcrumb breadcrumb">
		<li><i class="fa fa-home"></i><a href="<?php echo base_url('manage/Dashboard/'); ?>">Home</a><i class="fa fa-angle-right"></i></li>
		<li><a href="<?php echo base_url('manage/Implementuserother/'); ?>"> </a><i class="fa fa-angle-right"></i></li>
		<li><a href="javascript:void(0);">Other Implementing Partner Details</a></li>
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
  <div class="caption">Other Implementing Partner Details</div>
  <div class="tools"> <a href="javascript:;" class="collapse"> </a></div>
</div><!--End portlet-title-->
<div class="portlet-body">
<?php if(isset($DataList) && $DataList!=FALSE){ ?>
	
<!----------------------------------------------------------------------->
<h3 class="form-section">Implementing Partner Details (कार्यान्वयन साथी का विवरण)</h3>
	<div class="row">
		
		<div class="col-md-6">
		<label class="control-label">First Name (पहला नाम)</label>
		<div class="we-control">
	    <?php echo html_escape($DataList->first_name);?>
	    </div>
		</div><!--End column--> 
		
		<div class="col-md-6">
		<label class="control-label">Last Name (सरनेम)</label>		
		<div class="we-control">
	    <?php echo html_escape($DataList->last_name);?>
	    </div>
		</div><!--End column-->
	
   </div><!--End row-->
	<div class="row">
		
		<div class="col-md-6">
		<label class="control-label">Email Id (ईमेल आईडी)</label>
		<div class="we-control">
	    <?php echo html_escape($DataList->email);?>
	    </div>
		</div><!--End column--> 
		
		<div class="col-md-6">
		<label class="control-label">Mobile Number (मोबाइल नंबर)</label>		
		<div class="we-control">
	    <?php echo html_escape($DataList->mobile);?>
	    </div>
		</div><!--End column-->
	
  </div><!--End row-->
  <div class="row">
		
		<div class="col-md-6">
		<label class="control-label">Status (स्थिति)</label>
		<div class="we-control">
	    <?php echo ProjectDocStatus($DataList->status);?>
	    </div>
		</div><!--End column--> 
	
   </div><!--End row-->
<!----------------------------------------------------------------------->
<h3 class="form-section">Project Brief Description (परियोजना संक्षिप्त विवरण)</h3>
	<div class="row">
		
		<div class="col-md-6">
		<label class="control-label">Project Name (परियोजना नाम)</label>
		<div class="we-control">
	    <a target="_blank" href="<?php echo base_url('manage/Project/show/'.$project_enc_id);?>"> <?php echo html_escape($DataList->project_title);?></a>
	    </div>
		</div><!--End column--> 
		
		<div class="col-md-6">
		<label class="control-label">Project Category (परियोजना श्रेणी)</label>		
		<div class="we-control">
	    <?php echo html_escape($DataList->project_category_name);?>
	    </div>
		</div><!--End column-->
	
   </div><!--End row-->
<!----------------------------------------------------------------------->
<h3 class="form-section">Associated Company/Individual Details (सम्बंधित कंपनी / व्यक्तिगत विवरण)</h3>
	<div class="row">
		<div class="col-md-6">
		<label class="control-label">User Type (उपयोगकर्ता का प्रकार)</label>		
		<div class="we-control">
	    <?php echo html_escape($DataList->user_type_name);?>
	    </div>
        </div><!--End column-->
        
		<div class="col-md-6">
		<label class="control-label">Name (नाम)</label>
		<div class="we-control">
		<?php
		$url="javascript:void(0);";
		if($DataList->user_type==1){
			$url=base_url('manage/Company/details/'.$user_enc_id);
		}else if($DataList->user_type==2){
			$url=base_url('manage/Individual/details/'.$user_enc_id);
		}
		?>
		<a target="_blank" href="<?php echo $url;?>">
		<?php echo html_escape(trim($DataList->user_fname." ".$DataList->user_lname));?>
		</a>
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
<!----------------------------------------------------------------------->

<?php }//end check isset DataList  ?>
</div><!-- End portlet-body -->
</div><!-- End BORDERED TABLE PORTLET-->
<!------------------------------------------------------------------- -->

</div><!--End column -->
</div><!--End row-->
<!-- END PAGE CONTENT-->