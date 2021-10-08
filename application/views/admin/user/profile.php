<!-- BEGIN PAGE HEADER-->
<div class="row">
<div class="col-md-12">
	<ul class="page-breadcrumb breadcrumb">
		<li><i class="fa fa-home"></i><a href="<?php echo base_url('manage/Dashboard/'); ?>">Home</a><i class="fa fa-angle-right"></i></li>
		<li><a href="<?php echo base_url('manage/User/'); ?>">Profile</a><i class="fa fa-angle-right"></i></li>
		<li><a href="javascript:void(0);">View</a></li>
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
 <?php if(isset($DataList) && $DataList!=FALSE): ?>
 <div class="row">
 	<div class="col-sm-12">
 	<!------------------------------------------------------------------- -->
    <!-- BEGIN BORDERED TABLE PORTLET-->
	<div class="portlet box blue">
	<div class="portlet-title">
	  <div class="caption">Manage Profile Photo</div>
	  <div class="tools"> <a href="javascript:;" class="collapse"> </a></div>
	</div><!--End portlet-title-->
	<div class="portlet-body">
	<!--------------------------------------------------------------------------->
	<?php
	$atr2 =array('id'=>'frmUserProfile','name'=>'frmUserProfile','class'=>'form-horizontal','role'=>'form', 'autocomplete'=>'off','onsubmit'=>"return checkForm()");
	echo form_open_multipart('manage/User/update_photo',$atr2); 
	?>
	 <div class="row">
	 	<div class="col-sm-7">
	 	<div style="width:400px;,overflow: scroll;">
	 	<?php
 		$image_properties = array(
        'src'   => (isset($DataList->admin_image) && trim($DataList->admin_image)!="")? 'uploads/files/'.html_escape($DataList->admin_image):HTTP_IMAGES_PATH_ADMIN.'person.png',
        'alt'   => 'Profile Photo',
        'id'    => 'preview',
        'title' => 'Profile Photo'
		);
 		 echo img($image_properties);
 		 ?>
 		 </div>
	 	</div><!--End column-->

	 	<div class="col-md-5">
	 		<div class="info table-scrollable">
	 		<table class="table">
			<tr>
				<th>File size</th>
				<td><input type="text" readonly id="filesize" name="filesize" /></td>
			</tr>
			<tr>
				<th>Type</th>
				<td><input type="text" readonly id="filetype" name="filetype" /></td>
			</tr>
			<tr>
				<th>Image dimension</th>
				<td><input type="text" readonly id="filedim" name="filedim" /></td>
			</tr>
			<tr>
				<th>Width</th>
				<td><input type="text" readonly id="w" name="w" /></td>
			</tr>
			<tr>
				<th>Height</th>
				<td><input type="text" readonly id="h" name="h" /></td>
			</tr>
		   </table>
            </div><!--End info-->
	 	</div><!--End column-->
	 </div><!--End row-->
	 <div class="clearfix"></div>
	 <hr>	 
	 <div class="row">
	 	<div class="col-sm-12">
	 	    <input type="hidden" id="x1" name="x1" />
	        <input type="hidden" id="y1" name="y1" />
	        <input type="hidden" id="x2" name="x2" />
	        <input type="hidden" id="y2" name="y2" />

	 		<?php echo form_upload(array('name'=>'image_file','id'=>'image_file','onchange'=>"fileSelectHandler()")); ?>
	 		<div id="img-error" class="error red"></div>
	 	</div><!--End column-->
	 </div><!--End row-->
	 <hr>
	 <div class="row">
	 	<div class="col-sm-12">
	 		<input  type="submit" name="submit" value="Upload" class="btn btn-sm blue"/>
	 	</div><!--End column-->
	 </div><!--End row-->
	 
	  <?php echo form_close(); ?>
	 <!--------------------------------------------------------------------------->
	</div><!-- End portlet-body -->
	</div><!-- End BORDERED TABLE PORTLET-->
	<!------------------------------------------------------------------- --> 		
</div><!--End column left-->
<div class="col-sm-12">
 	<!------------------------------------------------------------------- -->
    <!-- BEGIN BORDERED TABLE PORTLET-->
	<div class="portlet box green">
	<div class="portlet-title">
	  <div class="caption">View Profile Details</div>
	  <div class="tools"> <a href="javascript:;" class="collapse"> </a></div>
	</div><!--End portlet-title-->
	<div class="portlet-body font-14">
	 <div class="form-body">
	<!--------------------------------------------------------------------------->
	<?php
	$atr2 =array('id'=>'frmUser','name'=>'frmUser','class'=>'form-horizontal','role'=>'form', 'autocomplete'=>'off');
	echo form_open('manage/User/updateProfile',$atr2); 
	?>
	
	    <div class="row">
 			<div class="col-sm-3"><b>Previlege Name :</b></div>
 			<div class="col-sm-9">
 			<div class="form-group">
 			<?php $PRIVILEGE_NAME = array( 
		     'name'=>'upm_name','id'=>'upm_name','class'=> 'form-control','value'=>html_escape($DataList->upm_name),'disabled'=>'disabled');
		     echo form_input($PRIVILEGE_NAME);
			?>
			</div>
			</div>
 		</div><!--End row-->
 		
 		<div class="row">
 			<div class="col-sm-3"><b>Designation :</b></div>
 			<div class="col-sm-9">
 			<div class="form-group">
 			<?php $DESIGNATION = array( 
		     'name'=>'designation','id'=>'designation','class'=> 'form-control','value'=>html_escape($DataList->admin_designation),'disabled'=>'disabled');
		     echo form_input($DESIGNATION);
			?>
			</div>
			</div>
 		</div><!--End row-->
	
 		<div class="row">
 			<div class="col-sm-3"><b>First Name :</b></div>
 			<div class="col-sm-9">
 			<div class="form-group">
 			<?php $FIRST_NAME = array( 
		     'name'=>'fname','id'=>'fname','class'=> 'form-control','placeholder'=>'Enter First Name','value'=>html_escape($DataList->admin_fname));
		     echo form_input($FIRST_NAME);
			?>
 			</div>
 			</div>
 		</div><!--End row-->
 		
 		<div class="row">
 			<div class="col-sm-3"><b>Last Name :</b></div>
 			<div class="col-sm-9">
 			<div class="form-group">
 			<?php $LAST_NAME = array( 
		     'name'=>'lname','id'=>'lname','class'=> 'form-control','placeholder'=>'Enter Last Name','value'=>html_escape($DataList->admin_lname));
		     echo form_input($LAST_NAME);
			?>
 			</div>
 			</div>
 		</div><!--End row-->
 		
 		<div class="row">
 			<div class="col-sm-3"><b>Email :</b></div>
 			<div class="col-sm-9">
 			<div class="form-group">
 			<?php $EMAIL = array( 
		     'name'=>'email','id'=>'email','class'=> 'form-control','value'=>html_escape($DataList->admin_email));
		     echo form_input($EMAIL);
			?>
 		   </div>
 		   </div>
 		</div><!--End row-->
 		
 		<div class="row">
 			<div class="col-sm-3"><b>Mobile :</b></div>
 			<div class="col-sm-9">
 			<div class="form-group">
 			<?php $MOBILE = array( 
		     'name'=>'mob','id'=>'mob','class'=> 'form-control','value'=>html_escape($DataList->admin_mobile));
		     echo form_input($MOBILE);
			?>
 			</div>
 			</div>
 		</div><!--End row-->
 		
 		<div class="row">
				<div class="col-sm-3 col-md-3">&nbsp;</div>
				<div class="col-sm-9 col-md-9">
				<div class="form-group">
				<label id="recap" class="refreshcap" style="cursor: pointer;">
				<div id="captchaimage" style="display: inline-block"><?php echo reload_captcha(); ?></div> 
				<i class="fa fa-refresh"></i>
				</label>
				</div>
				</div>
		</div><!--End row-->
 		
 		<div class="row">
				<div class="col-sm-3 col-md-3"><b>Security Code</b> <span class="red">*</span></div>
				<div class="col-sm-9 col-md-9">
				<div class="form-group">
				<?php $SECURITY_CODE = array( 
		        'name'=>'captcha','id'=>'captcha','class'=> 'form-control input-medium','placeholder'=>'Enter security code');
				echo form_input($SECURITY_CODE);
			    ?>
				</div>
				</div>
		</div><!--End row-->
 	 
 	 <hr>
	 <div class="row">
	 	<div class="col-sm-12">
	 		<input  type="submit" name="submit" value="submit" class="btn btn-sm green"/>
	 	</div><!--End column-->
	 </div><!--End row-->
 		
 	<?php echo form_close(); ?>
 	<!--------------------------------------------------------------------------->
 	</div>
	</div><!-- End portlet-body -->
	</div><!-- End BORDERED TABLE PORTLET-->
	<!------------------------------------------------------------------- -->	
 	</div><!--End column right-->
 </div><!--End row-->
 <?php endif; ?>

</div><!--End column -->
</div><!--End row-->
<!-- END PAGE CONTENT-->
<script type="text/javascript" src="<?php echo base_url('webroot/');?>plugins/jquery.validate.min.js"></script>
<script type="text/javascript">
  	// convert bytes into friendly format
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
    if (! rFilter.test(oFile.type)) {
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
        oImage.onload = function () { // onload event handler
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
            setTimeout(function(){
                // initialize Jcrop
                $('#preview').Jcrop({
                    //minSize: [85, 125], // min crop size
  					maxSize:[236,295],
                    aspectRatio : 236 / 295, // keep aspect ratio 1:1
                    bgFade: true, // use fade effect
                    bgOpacity: .5, // fade opacity
                    onChange: updateInfo,
                    onSelect: updateInfo,
                    onRelease: clearInfo
                }, function(){
                    // use the Jcrop API to get the real image size
                    var bounds = this.getBounds();
                    boundx = bounds[0]; 
                    boundy = bounds[1];
                    // Store the Jcrop API in the jcrop_api variable
                    jcrop_api = this;
                });
            },500);
        };
    };
    // read selected file as DataURL
    oReader.readAsDataURL(oFile);
}
</script>
<script type="text/javascript">
 $(function(){
 	$("#frmUser").validate({
		  rules: {
		   fname:{
		   		required: true,
				normalizer: function(value) {
        
					return $.trim(value);
				},
		   		maxlength:60
		   },
		   lname:{
		   		required: true,
				normalizer: function(value) {
        
					return $.trim(value);
				},
		   		maxlength:60
		   },
		   designation:{
		   		required: true,
		   		maxlength:100
		   },
		   email:{
		   		required: true,
		        maxlength:60,
		        email:true
		   },
		   mob:{
		   		required: true,
		   		digits:true,
		        minlength:10,
		        maxlength:10
		   },
		   captcha:{
		   		required: true
		   }
		  }
	});	
 });
</script>
<script type="text/javascript">
jQuery(document).ready(function(){
	
		var img_path = "<?php echo site_url().'uploads/captcha/'; ?>";
		
		jQuery('#recap').on('click',function(){
					
		jQuery.get( "<?php echo site_url('manage/Authuser/loadcaptcha');?>", function( data ) {
  		     jQuery("#captchaimage").html('<img src="'+ img_path + data +'" height="45px" width="150px">');
		});					
	   });
});
</script>