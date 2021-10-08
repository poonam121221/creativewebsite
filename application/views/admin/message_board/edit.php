<!-- BEGIN PAGE HEADER-->
<div class="row">
	<div class="col-md-12">
		<ul class="page-breadcrumb breadcrumb">
			<li><i class="fa fa-home"></i><a href="<?php echo base_url('manage/Dashboard/'); ?>">Home</a><i class="fa fa-angle-right"></i></li>
			<li><a href="<?php echo base_url('manage/Messageboard/'); ?>">Message Board</a><i class="fa fa-angle-right"></i></li>
			<li><a href="javascript:void(0);">Edit</a></li>
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
				<div class="caption">Edit Message Board</div>
				<div class="tools"> <a href="javascript:;" class="collapse"> </a></div>
			</div>
			<!--End portlet-title-->
			<div class="portlet-body">
				<!--------------------------------------------------------------------------->
				<div class="row">
					<div class="col-lg-12">
						<?php echo AlertMessage($this->session->flashdata('AppMessage')); ?>
					</div>
				</div>
				<!--End Validation message-->
				<?php
				$hidden = array('id' => html_escape(isset($DataList->id) ? encrypt_decrypt('encrypt', $DataList->id) : ''));
				$atr2 = array('id' => 'frmMessageboard', 'name' => 'frmMessageboard', 'class' => 'form-horizontal', 'role' => 'form', 'autocomplete' => 'off');
				echo form_open_multipart('manage/Messageboard/edit', $atr2, $hidden);
				?>
				<div class="form-body">

					<div class="form-group">
						<label class="col-sm-3 control-label">Title (Hindi) <span class="red">*</span></label>
						<div class="col-sm-9">
							<?php $TITLE_HI = array(
								'name' => 'title_hi', 'id' => 'title_hi', 'class' => 'form-control', 'placeholder' => 'Enter Title in hindi',
								'value' => (isset($DataList->title_hi) && $DataList->title_hi != '') ? stripslashes2(html_entity_decode($DataList->title_hi)) : ''
							);
							echo form_input($TITLE_HI);
							?>
						</div>
					</div>
					<!--End form-group-->

					<div class="form-group">
						<label class="col-sm-3 control-label">Title (English) <span class="red">*</span></label>
						<div class="col-sm-9">
							<?php $TITLE_EN = array(
								'name' => 'title_en', 'id' => 'title_en', 'class' => 'form-control', 'placeholder' => 'Enter Title in hindi',
								'value' => (isset($DataList->title_en) && $DataList->title_en != '') ? stripslashes2(html_entity_decode($DataList->title_en)) : ''
							);
							echo form_input($TITLE_EN);
							?>
						</div>
					</div>
					<!--End form-group-->

					<div class="form-group">
						<label class="col-sm-3 control-label">Designation (Hindi) <span class="red">*</span></label>
						<div class="col-sm-9">
							<?php $DESIG_HI = array(
								'name' => 'designation_hi', 'id' => 'designation_hi', 'class' => 'form-control', 'placeholder' => 'Enter Designation in hindi',
								'value' => (isset($DataList->designation_hi) && $DataList->designation_hi != '') ?  stripslashes2(html_entity_decode($DataList->designation_hi)) : ''
							);
							echo form_input($DESIG_HI);
							?>
						</div>
					</div>
					<!--End form-group-->

					<div class="form-group">
						<label class="col-sm-3 control-label">Designation (English) <span class="red">*</span></label>
						<div class="col-sm-9">
							<?php $DESIG_EN = array(
								'name' => 'designation_en', 'id' => 'designation_en', 'class' => 'form-control', 'placeholder' => 'Enter Designation in english',
								'value' => (isset($DataList->designation_en) && $DataList->designation_en != '') ?  stripslashes2(html_entity_decode($DataList->designation_en)) : ''
							);
							echo form_input($DESIG_EN);
							?>
						</div>
					</div>
					<!--End form-group-->

					<div class="form-group">
						<label class="col-sm-3 control-label">Heading (Hindi) <span class="red">*</span></label>
						<div class="col-sm-9">
							<?php $heading_hi = array(
								'name' => 'heading_hi',
								'id' => 'heading_hi',
								'class' => 'form-control',
								'placeholder' => 'Heading in hindi',
								'value' => (isset($DataList->heading_hi) && $DataList->heading_hi != '') ?  stripslashes2(html_entity_decode($DataList->heading_hi)) : ''
							);
							echo form_input($heading_hi);
							?>
						</div>
					</div>
					<!--End form-group-->

					<div class="form-group">
						<label class="col-sm-3 control-label">Heading (English) <span class="red">*</span></label>
						<div class="col-sm-9">
							<?php $heading_en = array(
								'name' => 'heading_en', 'id' => 'heading_en', 'class' => 'form-control', 'placeholder' => 'Heading in english', 'value' => (isset($DataList->heading_en) && $DataList->heading_en != '') ?  stripslashes2(html_entity_decode($DataList->heading_en)) : ''
							);
							echo form_input($heading_en);
							?>
						</div>
					</div>
					<!--End form-group-->

					<div class="form-group">
						<label class="col-sm-3 control-label">Message (Hindi)</label>
						<div class="col-sm-9">
							<?php $MSG_HI = array(
								'name'          => 'message_hi',
								'id'            => 'message_hi',
								'class'         => 'form-control',
								'rows'          => 4,
								'cols'          => 50,
								'placeholder'   => 'Enter Message in hindi',
								'value' => (isset($DataList->message_hi) && $DataList->message_hi != '') ?  stripslashes2(html_entity_decode($DataList->message_hi)) : ''
							);
							echo form_textarea($MSG_HI);
							?>
						</div>
					</div>
					<!--End form-group-->

					<div class="form-group">
						<label class="col-sm-3 control-label">Message (English)</label>
						<div class="col-sm-9">
							<?php $MSG_EN = array(
								'name'          => 'message_en',
								'id'            => 'message_en',
								'class'         => 'form-control',
								'rows'          => 4,
								'cols'          => 50,
								'placeholder'   => 'Enter Message in english',
								'value' => (isset($DataList->message_en) && $DataList->message_en != '') ?  stripslashes2(html_entity_decode($DataList->message_en)) : ''
							);
							echo form_textarea($MSG_EN);
							?>
						</div>
					</div>
					<!--End form-group-->

					<div class="form-group">
						<label class="col-sm-3 control-label">Photo </label>
						<div class="col-sm-9 ">
							<p>
								<?php if (isset($DataList->attachment) == TRUE && trim($DataList->attachment) != "") : ?>
									View Uploaded File <a target="_blank" href="<?php echo base_url('uploads/files/' . $DataList->attachment); ?>"><i class="fa fa-download"></i></a>
								<?php endif; ?></p>
							<?php echo form_upload(array('name' => 'attachment', 'id' => 'fileupload')); ?>
						</div>
					</div>
					<!--End form-group-->

					<div class="form-group">
						<label class="col-sm-4 col-md-3 control-label">View Photo</label>
						<div class="col-sm-8 col-md-7">
							<div class="fileinput fileinput-new" data-provides="fileinput">
								<div class="ffileinput-new thumbnail" style="max-width: 200px; max-height: 150px;">
									<?php
									$image_properties = array(
										'src'   => (isset($DataList->attachment) && trim($DataList->attachment) != "") ? 'uploads/files/' . html_escape($DataList->attachment) : 'webroot/img/no-image.png',
										'alt'   => 'Photo',
										'class' => 'post_images',
										'width' => '100',
										'height' => '100',
										'title' => 'Photo'
									);
									echo img($image_properties);
									?>
								</div>
								<!--End fileinput-new-->
							</div>
							<!--End fileinput-->
						</div>
					</div>
					<!--End form-group-->

					<div class="form-group">
						<label class="col-sm-3 control-label">Status <span class="red">*</span></label>
						<div class="col-sm-9 ">
							<?php $STATUS = array("" => "--Select Stauts--", '1' => 'Publish', '0' => 'Pending');
							echo form_dropdown('status', $STATUS, (isset($DataList->status) && $DataList->status != '') ?
								html_escape($DataList->status) : set_value('status'), array('class' => 'form-control input-medium'));
							?>
						</div>
					</div>
					<!--End form-group-->
					<div class="form-group">
						<label class="col-sm-3 control-label">Flag <span class="red">*</span></label>
						<div class="col-sm-9 ">
							<?php $flag = array("" => "--Select Stauts--", '1' => 'Left', '0' => 'Right');
							echo form_dropdown('flag', $flag, (isset($DataList->flag) && $DataList->flag != '') ?
								html_escape($DataList->flag) : set_value('flag'), array('class' => 'form-control input-medium'));
							?>
						</div>
					</div>
					<!--End form-group-->
					<div class="form-group">
						<label class="col-sm-3 control-label"></label>
						<div class="col-sm-9">
							<button type="submit" class="btn green">Update</button>
							<button type="reset" class="btn blue">Clear</button>
							<a class="btn purple" href="<?php echo base_url('manage/Messageboard/'); ?>">Back</a>
						</div>
					</div>
					<!--End form-group-->

				</div>
				<!--End form-body-->
				<?php echo form_close(); ?>
				<!--------------------------------------------------------------------------->
			</div><!-- End portlet-body -->
		</div><!-- End BORDERED TABLE PORTLET-->
		<!------------------------------------------------------------------- -->
	</div>
	<!--End column -->
</div>
<!--End row-->
<!-- END PAGE CONTENT-->
<script type="text/javascript" src="<?php echo base_url('webroot/'); ?>validation/dist/jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo base_url('webroot/'); ?>validation/dist/additional-methods.js"></script>
<script type="text/javascript">
	jQuery(function() {

		$("#fileupload").change(function() {
			readURL_photo(this);
		});

		function readURL_photo(input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();

				reader.onload = function(e) {
					$('.post_images').attr('src', e.target.result);
				};

				reader.readAsDataURL(input.files[0]);
			}
		} //end readURL_photo function	

		jQuery.validator.addMethod("alphanumspace", function(value, element) {
			return this.optional(element) || /^[a-zA-Z0-9\s]*$/.test(value);
		}, "Please enter character, number and space only.");

		$.validator.addMethod('filesize', function(value, element, param) {
			return this.optional(element) || (element.files[0].size <= param)
		}, $.validator.format("Uploaded file size should be less than or equal to 2 MB)."));

		jQuery("#frmMessageboard").validate({
			rules: {
				title_hi: {
					required: true,
					minlength: 2,
					maxlength: 255
				},
				title_en: {
					required: true,
					minlength: 2,
					maxlength: 255
				},
				designation_hi: {
					required: true,
					minlength: 2,
					maxlength: 255
				},
				designation_en: {
					required: true,
					minlength: 2,
					maxlength: 255
				},
				message_hi: {
					minlength: 2,
					maxlength: 250
				},
				message_en: {
					minlength: 2,
					maxlength: 250
				},
				attachment: {
					extension: 'JPEG|jpeg|JPG|jpg|png',
					filesize: 2097152
				},
				status: {
					required: true,
					digits: true
				}
			},
			message: {
				attachment: {
					extension: "Please upload only JPEG,JPG,PDF Formet",
					filesize: "File size must be less than 2 MB"
				}
			}
		});
	});
</script>