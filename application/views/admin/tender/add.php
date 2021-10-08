<!-- BEGIN PAGE HEADER-->

<div class="row">
  <div class="col-md-12">
    <ul class="page-breadcrumb breadcrumb">
      <li><i class="fa fa-home"></i><a href="<?php echo base_url('manage/Dashboard/'); ?>">Home</a><i class="fa fa-angle-right"></i></li>
      <li><a href="<?php echo base_url('manage/Tender/'); ?>">Tender</a><i class="fa fa-angle-right"></i></li>
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
        <div class="caption">Add Tender</div>
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
$atr2 =array('id'=>'frmTender','name'=>'frmTender','class'=>'form-horizontal','role'=>'form', 'autocomplete'=>'off');
echo form_open_multipart('manage/Tender/add',$atr2); 
?>
<div class="form-group">
            <label class="col-sm-3 control-label">NIT No.<span class="red">*</span></label>
            <div class="col-sm-9">
              <?php $NIT = array( 
        'name'=>'nit_no','id'=>'nit_no','class'=> 'form-control','placeholder'=>'Enter NIT No');
		echo form_input($NIT);
	    ?>
            </div>
          </div>
          <div class="form-group clearfix">
            <label class="col-sm-3 control-label">Issue Date <span class="red">*</span></label>
            <div class="col-sm-6">
              <?php $ISSUE_DATE = array('name'=>'issue_date','id'=>'issue_date','class'=>'form-control');
		echo form_input($ISSUE_DATE);
	    ?>
            </div>
          </div>
       
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
        <div class="form-group">
            <label class="col-sm-3 control-label">Remark (Hindi)</label>
            <div class="col-sm-9">
              <?php $REMARK = array( 
        'name'=>'remark_hi','id'=>'remark_hi','class'=> 'form-control','placeholder'=>'Enter remark in hindi');
		echo form_textarea($REMARK);
	    ?>
            </div>
          </div>
          
           <div class="form-group">
            <label class="col-sm-3 control-label">Remark (English)</label>
            <div class="col-sm-9">
              <?php $REMARK = array( 
        'name'=>'remark_en','id'=>'remark_en','class'=> 'form-control','placeholder'=>'Enter remark in english');
		echo form_textarea($REMARK);
	    ?>
            </div>
          </div>
     
          <div class="form-group">
            <label class="col-sm-3 control-label">Apply Link </label>
            <div class="col-sm-9">
              <?php $APPLYLINK = array( 
        'name'=>'applylink','id'=>'applylink','class'=> 'form-control','placeholder'=>'Enter apply link');
		echo form_input($APPLYLINK);
	 ?>
       <p class="notecls">Example: http://www.domain.gov.in/</p>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Attachment/Notice 1</label>
            <div class="col-sm-9 "> <?php echo form_upload(array('name'=>'attachment1')); ?> </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Attachment/Notice 2</label>
            <div class="col-sm-9 "> <?php echo form_upload(array('name'=>'attachment2')); ?> </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Attachment/Notice 3</label>
            <div class="col-sm-9 "> <?php echo form_upload(array('name'=>'attachment3')); ?> </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Attachment/Notice 4</label>
            <div class="col-sm-9 "> <?php echo form_upload(array('name'=>'attachment4')); ?> </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Attachment/Notice 5</label>
            <div class="col-sm-9 "> <?php echo form_upload(array('name'=>'attachment5')); ?> </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Corrigendum / Amendment 1</label>
            <div class="col-sm-9 "> <?php echo form_upload(array('name'=>'corrigendum1')); ?> </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Corrigendum / Amendment 2</label>
            <div class="col-sm-9 "> <?php echo form_upload(array('name'=>'corrigendum2')); ?> </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Corrigendum / Amendment 3</label>
            <div class="col-sm-9 "> <?php echo form_upload(array('name'=>'corrigendum3')); ?> </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Corrigendum / Amendment 4</label>
            <div class="col-sm-9 "> <?php echo form_upload(array('name'=>'corrigendum4')); ?> </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Corrigendum / Amendment 5</label>
            <div class="col-sm-9 "> <?php echo form_upload(array('name'=>'corrigendum5')); ?> </div>
          </div>
          <!--End form-group-->
          
          
          
          <?php /*?><div class="form-group clearfix">
            <label class="col-sm-3 control-label">Last Date <span class="red">*</span></label>
            <div class="col-sm-6">
              <?php $LAST_DATE = array('name'=>'last_date','id'=>'last_date','class'=>'form-control');
		echo form_input($LAST_DATE);
	    ?>
            </div>
          </div><?php */?>
          <div class="form-group clearfix">
            <label class="col-sm-3 control-label">Archive Date <span class="red">*</span></label>
            <div class="col-sm-6">
              <?php $ARCHIVE_DATE = array('name'=>'archive_date','id'=>'archive_date','class'=>'form-control');
		echo form_input($ARCHIVE_DATE);
	    ?>
            </div>
          </div>
          <!--End form-group-->
       	
    <div class="form-group clearfix">
		<label class="col-sm-3 control-label">Is Alert <span class="red">*</span></label>
		<div class="col-sm-9">
		<?php $ALERT = array('0'=>'No','1'=>'Yes');
		echo form_dropdown('is_alert', $ALERT, (isset($DataList->is_alert) && $DataList->is_alert !='' )?
         html_escape($DataList->is_alert):set_value('is_alert'),array('class'=> 'form-control input-medium'));
	    ?>
		</div>
	 </div><!--End form-group-->   
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
              <a class="btn purple" href="<?php echo base_url('manage/Tender/'); ?>">Back</a> </div>
          </div>
        
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
	jQuery(function(){
		
	$('#archive_date').datepicker({format:'dd-mm-yyyy',autoclose: true}).on('changeDate', function(ev) {
	    if($('#archive_date').valid()){ $('#archive_date').removeClass('error'); }
	});
	$('#issue_date').datepicker({format:'dd-mm-yyyy',autoclose: true}).on('changeDate', function(ev) {
	    if($('#issue_date').valid()){ $('#issue_date').removeClass('error'); }
	});
	$('#last_date').datepicker({format:'dd-mm-yyyy',autoclose: true}).on('changeDate', function(ev) {
	    if($('#last_date').valid()){ $('#last_date').removeClass('error'); }
	});
		
	jQuery.validator.addMethod("alphanumspace", function(value, element) {
		  return this.optional(element) || /^[a-zA-Z0-9\s]*$/.test(value);
	}, "Please enter character, number and space only.");
	
	$.validator.addMethod('filesize', function(value, element, param) {
		    return this.optional(element) || (element.files[0].size <= param) 
	}, $.validator.format("Uploaded file size should be less than or equal to 25 MB)."));
	
	$.validator.addMethod("checkdate", function(value, element) {
    	return this.optional(element) || /^(0[1-9]|[1-2][0-9]|3[0-1])-(0[1-9]|1[0-2])-[0-9]{4}$/.test(value);
    }, "Please enter valid date format (DD-MM-YYYY).");

	jQuery( "#frmTender" ).validate({
		  rules: { 
		  nit_no : {
		        required: true,
		        minlength:2,
		        maxlength:255
		    },
		  title_hi: {
		        required: true,
		        minlength:2,
		        maxlength:255
		    },
		   title_en: {
		        required: true,
		        alphanumspace:true,
		        minlength:2,
		        maxlength:255
		    },
		    status:{
				required: true,
		  		digits:true
			},
	  	  applylink: {
		       // required: true,
				url:true,
		        minlength:2,
		        maxlength:500
		    },
			
				attachment1:{
			
				extension:'PDF|pdf|JPEG|jpeg|JPG|jpg|png',
				filesize:26214400
			},
				attachment2:{
			
				extension:'PDF|pdf|JPEG|jpeg|JPG|jpg|png',
				filesize:26214400
			},
				attachment3:{
			
				extension:'PDF|pdf|JPEG|jpeg|JPG|jpg|png',
				filesize:26214400
			},
				attachment4:{
			
				extension:'PDF|pdf|JPEG|jpeg|JPG|jpg|png',
				filesize:26214400
			},
				attachment5:{
			
				extension:'PDF|pdf|JPEG|jpeg|JPG|jpg|png',
				filesize:26214400
			},
			corrigendum1:{
			
				extension:'PDF|pdf|JPEG|jpeg|JPG|jpg|png',
				filesize:26214400
			},
			corrigendum2:{
			
				extension:'PDF|pdf|JPEG|jpeg|JPG|jpg|png',
				filesize:26214400
			},
			corrigendum3:{
			
				extension:'PDF|pdf|JPEG|jpeg|JPG|jpg|png',
				filesize:26214400
			},
			corrigendum4:{
			
				extension:'PDF|pdf|JPEG|jpeg|JPG|jpg|png',
				filesize:26214400
			},
			corrigendum5:{
			
				extension:'PDF|pdf|JPEG|jpeg|JPG|jpg|png',
				filesize:26214400
			},
           archive_date: {
				required: true,
				checkdate:true
		   },
		  issue_date: {
				required: true,
				checkdate:true
		   },
		  last_date: {
				required: true,
				checkdate:true
		   }
		  },
		  message:{
		  	attachment: {extension:"Please upload only JPEG,JPG,PDF Formet",filesize:"File size must be less than 25 MB"}
		  }
		});	
	});
</script>