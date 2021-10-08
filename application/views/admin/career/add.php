<!-- BEGIN PAGE HEADER-->

<div class="row">
    <div class="col-md-12">
        <ul class="page-breadcrumb breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo base_url('manage/Dashboard/'); ?>">Home</a><i
                    class="fa fa-angle-right"></i></li>
            <li><a href="<?php echo base_url('manage/Career/'); ?>">Career</a><i class="fa fa-angle-right"></i></li>
            <li><a href="javascript:void(0);">Add</a></li>
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
                <div class="caption">Add Career</div>
                <div class="tools"> <a href="javascript:;" class="collapse"> </a></div>
            </div>
            <!--End portlet-title-->
            <div class="portlet-body">
                <!--------------------------------------------------------------------------->
                <div class="row">
                    <div class="col-lg-12"> <?php echo AlertMessage($this->session->flashdata('AppMessage'));?> </div>
                </div>
                <!--End Validation message-->
                <?php
$atr2 =array('id'=>'frmCareer','name'=>'frmCareer','class'=>'form-horizontal','role'=>'form', 'autocomplete'=>'off');
echo form_open_multipart('manage/Career/add',$atr2); 
?>
                <div class="form-body">


                    <div class="form-group">
                        <label class="col-sm-3 control-label">Title (Hindi) <span class="red">*</span></label>
                        <div class="col-sm-9">
                            <?php $TITLE_HI = array( 
        'name'=>'title_hi','id'=>'title_hi','class'=> 'form-control','placeholder'=>'Enter title in hindi');
		echo form_input($TITLE_HI);
	    ?>
                        </div>
                    </div>
                    <!--End form-group-->
                    <div class="form-group clearfix">
                        <label class="col-lg-3 col-md-3 control-label">Job Profile (Hindi)</label>
                        <div class="col-lg-9 col-md-9">
                            <?php 		
		$PAGEDESC_HI = "";
	    echo $this->ckeditor->editor('description_hi',@$PAGEDESC_HI);
	 ?>
                            <div id="description_hi1"></div>
                        </div>
                    </div>
                    <!--End form-group-->
                    <div class="form-group clearfix">
                        <label class="col-lg-3 col-md-3 control-label">Qualification and Experience (Hindi)</label>
                        <div class="col-lg-9 col-md-9">
                            <?php     
    $EXP_PAGEDESC_HI = "";
      echo $this->ckeditor->editor('exp_description_hi',@$EXP_PAGEDESC_HI);
   ?>
                            <div id="description_hi1"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Title (English) <span class="red">*</span></label>
                        <div class="col-sm-9">
                            <?php $TITLE_EN = array( 
        'name'=>'title_en','id'=>'title_en','class'=> 'form-control','placeholder'=>'Enter title in english');
		echo form_input($TITLE_EN);
	 ?>
                        </div>
                    </div>
                    <!--End form-group-->
                    <div class="form-group clearfix">
                        <label class="col-lg-3 col-md-3 control-label">Job Profile (English)</label>
                        <div class="col-lg-9 col-md-9">
                            <?php 		
		$PAGEDESC_EN = "";
	    echo $this->ckeditor->editor('description_en',@$PAGEDESC_EN);
	 ?>
                            <div id="description_en1"></div>
                        </div>
                    </div>

                    <div class="form-group clearfix">
                        <label class="col-lg-3 col-md-3 control-label">Qualification and Experience (English)</label>
                        <div class="col-lg-9 col-md-9">
                            <?php     
                $EXPPAGEDESC_EN = "";
                  echo $this->ckeditor->editor('exp_description_en',@$EXPPAGEDESC_EN);
               ?>
                            <div id="description_en1"></div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-sm-3 control-label">Attachment <span class="red">*</span></label>
                        <div class="col-sm-9 "> <?php echo form_upload(array('name'=>'attachment','accept'=>'image/*,.pdf', 'data-msg-accept'=>'Allow only PDF|pdf|JPEG|jpeg|JPG|jpg|png' )); ?> 
                        <br>
                        <small>Allow only PDF|pdf|JPEG|jpeg|JPG|jpg|png</small>
                        </div>
                    </div>
                    <!--End form-group-->

                    <div class="form-group clearfix">
                        <label class="col-sm-3 control-label">Issue Date <span class="red">*</span></label>
                        <div class="col-sm-6">
                            <?php $ISSUE_DATE = array('name'=>'issue_date','id'=>'issue_date','class'=>'form-control');
		echo form_input($ISSUE_DATE);
	    ?>
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <label class="col-sm-3 control-label">Last Date <span class="red">*</span></label>
                        <div class="col-sm-6">
                            <?php $LAST_DATE = array('name'=>'last_date','id'=>'last_date','class'=>'form-control');
		echo form_input($LAST_DATE);
	    ?>
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <label class="col-sm-3 control-label">Archive Date <span class="red">*</span></label>
                        <div class="col-sm-6">
                            <?php $ARCHIVE_DATE = array('name'=>'archive_date','id'=>'archive_date','class'=>'form-control');
		echo form_input($ARCHIVE_DATE);
	    ?>
                        </div>
                    </div>
                    <!--End form-group-->

                    <div class="form-group clearfix hidden">
                        <label class="col-sm-3 control-label control-label">Is in What's New </label>
                        <div class="col-sm-9">
                            <input type="checkbox" name="is_new" id="is_new" value="1">
                        </div>
                    </div>
                    <!--End Form-group-->

                    <?php if($optstatus==1){ ?>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Status <span class="red">*</span></label>
                        <div class="col-sm-9 ">
                            <?php $STATUS = array(""=>"--Select Status--",'1'=>'Publish','0'=>'Pending');
		echo form_dropdown('status', $STATUS, (isset($DataList->status) && $DataList->status !='' )?
         html_escape($DataList->status):set_value('status'),array('class'=> 'form-control input-medium'));
	    ?>
                        </div>
                    </div>
                    <!--End form-group-->
                    <?php }//end check optstatus ?>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"></label>
                        <div class="col-sm-9">
                            <button type="submit" class="btn green">Submit</button>
                            <button type="reset" class="btn blue">Clear</button>
                            <a class="btn purple" href="<?php echo base_url('manage/Career/'); ?>">Back</a>
                        </div>
                    </div>
                    <!--End form-group-->
                </div>
                <!--End form-body-->
                <?php echo form_close(); ?>
                <!--------------------------------------------------------------------------->
            </div>
            <!-- End portlet-body -->
        </div>
        <!-- End BORDERED TABLE PORTLET-->
        <!------------------------------------------------------------------- -->
    </div>
    <!--End column -->
</div>
<!--End row-->
<!-- END PAGE CONTENT-->
<script type="text/javascript" src="<?php echo base_url('webroot/');?>validation/dist/jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo base_url('webroot/');?>validation/dist/additional-methods.js"></script>
<script type="text/javascript">
jQuery(function() {
  $.validator.addMethod('greaterThan', function(value, element) {
        var dateFrom = $("#issue_date").val();
        var dateTo = $('#last_date').val();
        //split into array of strings.
        var from = dateFrom.split("-");
        var to = dateTo.split("-");
        
        var first = from[2]+''+ from[1]+''+ from[0];
        var last = to[2]+''+ to[1]+''+ to[0];
        return last > first;
    }, $.validator.format("Must be greater than Isssue Date."));

    $.validator.addMethod('greaterThanLastdate', function(value, element) {
        var dateFrom = $("#last_date").val();
        var dateTo = $('#archive_date').val();

        //split into array of strings.
        var from = dateFrom.split("-");
        var to = dateTo.split("-");
        
        var first = from[2]+''+ from[1]+''+ from[0];
        var last = to[2]+''+ to[1]+''+ to[0];
        return last > first;
    }, $.validator.format("Must be greater than Last Date."));

    $('#archive_date').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true
    }).on('changeDate', function(ev) {
        if ($('#archive_date').valid()) {
            $('#archive_date').removeClass('error');
        }
    });
    
    $('#issue_date').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true
    }).on('changeDate', function(ev) {
        if ($('#issue_date').valid()) {
            $('#issue_date').removeClass('error');
        }
    });

    $('#last_date').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true
    }).on('changeDate', function(ev) {
        if ($('#last_date').valid()) {
            $('#last_date').removeClass('error');
        }
    });

    jQuery.validator.addMethod("alphanumspace", function(value, element) {
        return this.optional(element) || /^[a-zA-Z0-9\s]*$/.test(value);
    }, "Please enter character, number and space only.");

    $.validator.addMethod('filesize', function(value, element, param) {
        return this.optional(element) || (element.files[0].size <= param)
    }, $.validator.format("Uploaded file size should be less than or equal to 25 MB)."));

    $.validator.addMethod("checkdate", function(value, element) {
        return this.optional(element) || /^(0[1-9]|[1-2][0-9]|3[0-1])-(0[1-9]|1[0-2])-[0-9]{4}$/.test(
            value);
    }, "Please enter valid date format (DD-MM-YYYY).");

    jQuery("#frmCareer").validate({
        rules: {
            title_hi: {
                required: true,
                minlength: 2,
                maxlength: 255
            },
            title_en: {
                required: true,
                alphanumspace: true,
                minlength: 2,
                maxlength: 255
            },
            status: {
                required: true,
                digits: true
            },
            is_new: {
                digits: true
            },
            attachment: {
                required: true,
                extension: 'PDF|pdf|JPEG|jpeg|JPG|jpg|png',
                filesize: 26214400
            },
            issue_date: {
                required: true,
                checkdate: true
            },
            last_date: {
                required: true,
                checkdate: true,
                greaterThan: true
            },
            archive_date: {
                required: true,
                checkdate: true,
                greaterThan: true,
                greaterThanLastdate: true
            }
        },
        message: {
            attachment: {
                extension: "Please upload only JPEG,JPG,PDF Formet",
                filesize: "File size must be less than 25 MB"
            },
            last_date: {
                greaterThan: "Must be greater than Isssue Date"
            },
            archive_date: {
                greaterThanLastdate: "Must be greater than Last Date"
            }
        }
    });
});
</script>