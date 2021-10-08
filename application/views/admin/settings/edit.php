<!-- BEGIN PAGE HEADER-->
<div class="row">
<div class="col-md-12">
	<ul class="page-breadcrumb breadcrumb">
		<li><i class="fa fa-home"></i><a href="<?php echo base_url('manage/Dashboard/'); ?>">Home</a><i class="fa fa-angle-right"></i></li>
		<li><a href="<?php echo base_url('manage/Settings/'); ?>">Website Setting</a><i class="fa fa-angle-right"></i></li>
		<li><a href="javascript:void(0);">View</a></li>
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
  <div class="caption">Edit Website Setting</div>
  <div class="tools"> <a href="javascript:;" class="collapse"> </a></div>
</div><!--End portlet-title-->
<div class="portlet-body">
<!--------------------------------------------------------------------------->
<div class="row"><div class="col-lg-12">
<?php echo AlertMessage($this->session->flashdata('AppMessage'));?>
</div></div>
<!--End Validation message-->
<?php
$hidden = array('id' => html_escape(isset($DataList->id)? encrypt_decrypt('encrypt',$DataList->id):''));
$atr2 =array('id'=>'frmSettings','name'=>'frmSettings','class'=>'form-horizontal','role'=>'form', 'autocomplete'=>'off');
echo form_open_multipart('manage/Settings/edit',$atr2,$hidden); 
?>
 <div class="form-group clearfix">
     <label class="col-lg-2 col-md-3 control-label">Website Name <span class="red">*</span></label>  
     <div class="col-lg-5 col-md-6">
     <?php $WEBSITENAME = array(
        'name'          => 'website_name',
        'id'            => 'website_name',
        'class'         => 'form-control',
        'value'         =>(isset($DataList->website_name) && $DataList->website_name !='' )?
         html_escape($DataList->website_name):""
		);
		echo form_input($WEBSITENAME);
	 ?>
     </div>
     </div><!--End Form-group-->
	<div class="form-group clearfix">
		<label class="col-lg-2 col-md-3 control-label">Tag Line (Hindi)</label>
		<div class="col-lg-5 col-md-6">
		<?php $TAGLINE_HI = array('name'=>'tag_line_hi','id'=>'tag_line_hi','class'=>'form-control','value'=>(isset($DataList->tag_line_hi) && $DataList->tag_line_hi!="")? $DataList->tag_line_hi:"");
		echo form_input($TAGLINE_HI);
	    ?>
		</div>
	</div><!--End form-group-->
	<div class="form-group clearfix">
		<label class="col-lg-2 col-md-3 control-label">Tag Line (English)</label>
		<div class="col-lg-5 col-md-6">
		<?php $TAGLINE_EN = array('name'=>'tag_line_en','id'=>'tag_line_en','class'=>'form-control','value'=>(isset($DataList->tag_line_en) && $DataList->tag_line_en!="")? $DataList->tag_line_en:"");
		echo form_input($TAGLINE_EN);
	    ?>
		</div>
	</div><!--End form-group-->
    <div class="form-group clearfix">
        <label class="col-lg-2 col-md-3 control-label">Logo</label>
        <div class="col-lg-5 col-md-6">
        <input type="file" name="logo" id="fileupload"/>
        </div>
    </div><!--End form-group-->
     
    <div class="form-group clearfix">
        <label class="col-lg-2 col-md-3 control-label">View Logo</label>
        <div class="col-lg-5 col-md-6">
        <?php
        $image_properties = array(
        'src'   => (isset($DataList->logo) && trim($DataList->logo)!="")? 'uploads/logo/'.html_escape($DataList->logo):'webroot/img/no_image.png',
        'alt'   => 'Logo Image',
        'class' => 'post_images',
        'width' => '100',
        'height'=> '100',
        'title' => 'Project Image'
        );
         echo img($image_properties);
         ?>
        </div>
    </div><!--End form-group-->

	<div class="form-group clearfix">
		<label class="col-lg-2 col-md-3 control-label">Favion Icon</label>
		<div class="col-lg-5 col-md-6">
		<?php $START_DATE = array('name'=>'last_updated_on','id'=>'last_updated_on','class'=>'form-control','value'=>(isset($DataList->last_updated_on) && get_date($DataList->last_updated_on)!="")? get_date($DataList->last_updated_on):"");
		echo form_input($START_DATE);
	    ?>
		</div>
	</div><!--End form-group-->

	<div class="form-group clearfix">
                    <label class="col-lg-2 col-md-3 control-label">Bank account Details For Consultancy Form <span
                            class="red">*</span></label>
                    <div class="col-lg-10 col-md-9">
                        <?php 		
		$account_details = (isset($DataList->account_details) && $DataList->account_details !='' )?
        html_entity_decode(stripslashes2($DataList->account_details)):"";
	    echo $this->ckeditor->editor('account_details',@$account_details);
	 ?>
                        <div id="account_details1"></div>
                    </div>
                </div>
                <!--End Form-group-->



	<div class="form-group clearfix">
		<label class="col-lg-2 col-md-3 control-label">Start Date</label>
		<div class="col-lg-5 col-md-6">
		<?php $START_DATE = array('name'=>'last_updated_on','id'=>'last_updated_on','class'=>'form-control','value'=>(isset($DataList->last_updated_on) && get_date($DataList->last_updated_on)!="")? get_date($DataList->last_updated_on):"");
		echo form_input($START_DATE);
	    ?>
		</div>
	</div><!--End form-group-->

 	 <div class="form-group">
		<label class="col-sm-3 control-label"></label>
		<div class="col-sm-9">
			<button type="submit" class="btn green">Update</button>
			<button type="reset" class="btn blue">Clear</button>
			<a class="btn purple" href="<?php echo base_url('manage/Settings/'); ?>">Back</a>
		</div>
	</div><!--End form-group-->
	
 </div><!--End form-body-->
 <?php form_close(); ?>
 <!--------------------------------------------------------------------------->
</div><!-- End portlet-body -->
</div><!-- End BORDERED TABLE PORTLET-->
<!------------------------------------------------------------------- -->
</div><!--End column -->
</div><!--End row-->
<!-- END PAGE CONTENT-->
<script type="text/javascript" src="<?php echo base_url('webroot/');?>plugins/jquery.validate.min.js"></script>
<script type="text/javascript">
	jQuery(function(){

	$("#reset").click(function(){
        $('.post_images').attr('src',"<?php echo base_url('webroot/img/no_image.png');?>");
    });
        
    $("#fileupload").change(function(){
            readURL_photo(this);
    });
        
    function readURL_photo(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('.post_images').attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
    }//end readURL_photo function
		
	$('#last_updated_on').datepicker({'format':'dd-mm-yyyy'});
		
	jQuery.validator.addMethod("alphanumspace", function(value, element) {
		  return this.optional(element) || /^[a-zA-Z0-9\s]*$/.test(value);
	}, "Please enter character, number and space only.");

	jQuery( "#frmSettings" ).validate({
		  rules: { 
		  category_hi: {
		        required: true,
				date:true,
		    }
		  }
		});	
		
	});//end dom
</script>