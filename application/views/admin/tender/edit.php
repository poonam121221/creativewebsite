<!-- BEGIN PAGE HEADER-->

<div class="row">
  <div class="col-md-12">
    <ul class="page-breadcrumb breadcrumb">
      <li><i class="fa fa-home"></i><a href="<?php echo base_url('manage/Dashboard/'); ?>">Home</a><i class="fa fa-angle-right"></i></li>
      <li><a href="<?php echo base_url('manage/Tender/'); ?>">Tender</a><i class="fa fa-angle-right"></i></li>
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
        <div class="caption">Edit Career</div>
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
			$hidden = array('id' => html_escape(isset($DataList->id)? encrypt_decrypt('encrypt',$DataList->id):''));
			$atr2 =array('id'=>'frmCareer','name'=>'frmCareer','class'=>'form-horizontal','role'=>'form', 'autocomplete'=>'off');
			echo form_open_multipart('manage/Tender/edit',$atr2,$hidden); 
		?>
        <div class="form-body">
        <div class="form-group">
            <label class="col-sm-3 control-label">NIT NO.<span class="red">*</span></label>
            <div class="col-sm-9">
              <?php $NIT = array( 
        'name'=>'nit_no','id'=>'nit_no','class'=> 'form-control','placeholder'=>'Enter NIT No.',
        'value' => (isset($DataList->nit_no) && $DataList->nit_no !='' )?
         html_escape($DataList->nit_no):set_value('nit_no'));
		 echo form_input($NIT);
	    ?>
            </div>
          </div>
          <div class="form-group clearfix">
            <label class="col-sm-3 control-label">Issue Date <span class="red">*</span></label>
            <div class="col-sm-6">
              <?php $date = get_date($DataList->issue_date); $ISSUE_DATE = array('name'=>'issue_date','id'=>'issue_date','class'=>'form-control','value'=>(isset($DataList->issue_date) && !empty($date))? get_date($DataList->issue_date):"");
		echo form_input($ISSUE_DATE);
	    ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Title (Hindi) <span class="red">*</span></label>
            <div class="col-sm-9">
              <?php $TITLE_HI = array( 
        'name'=>'title_hi','id'=>'title_hi','class'=> 'form-control','placeholder'=>'Enter Title in hindi',
        'value' => (isset($DataList->title_hi) && $DataList->title_hi !='' )?
         html_escape($DataList->title_hi):set_value('title_hi'));
		 echo form_input($TITLE_HI);
	    ?>
            </div>
          </div>
          <!--End form-group-->
       <div class="form-group">
            <label class="col-sm-3 control-label">Title (English) <span class="red">*</span></label>
            <div class="col-sm-9">
              <?php $TITLE_EN = array( 
        'name'=>'title_en','id'=>'title_en','class'=> 'form-control','placeholder'=>'Enter Title in english',
        'value' => (isset($DataList->title_en) && $DataList->title_en !='' )?
         html_escape($DataList->title_en):set_value('title_en'));
		echo form_input($TITLE_EN);
	    ?>
            </div>
          </div>
          
           <div class="form-group">
            <label class="col-sm-3 control-label">Remark (Hindi) <span class="red">*</span></label>
            <div class="col-sm-9">
              <?php $REMARK_HI = array( 
        'name'=>'remark_hi','id'=>'remark_hi','class'=> 'form-control','placeholder'=>'Enter Remark in hindi',
        'value' => (isset($DataList->remark_hi) && $DataList->remark_hi !='' )?
         html_escape($DataList->remark_hi):set_value('remark_hi'));
		 echo form_textarea($REMARK_HI);
	    ?>
            </div>
          </div>
          <!--End form-group-->
       <div class="form-group">
            <label class="col-sm-3 control-label">Remark (English) <span class="red">*</span></label>
            <div class="col-sm-9">
              <?php $TITLE_EN = array( 
        'name'=>'remark_en','id'=>'remark_en','class'=> 'form-control','placeholder'=>'Enter Remarks in english',
        'value' => (isset($DataList->remark_en) && $DataList->remark_en !='' )?
         html_escape($DataList->remark_en):set_value('remark_en'));
		echo form_textarea($TITLE_EN);
	    ?>
            </div>
          </div>
          <!--End form-group-->
          
          <div class="form-group">
            <label class="col-sm-3 control-label">Apply Link</label>
            <div class="col-sm-9">
              <?php $TITLE_EN = array( 
        'name'=>'applylink','id'=>'applylink','class'=> 'form-control','placeholder'=>'Enter Apply Link',
        'value' => (isset($DataList->applylink) && $DataList->applylink !='' )?
         html_escape($DataList->applylink):set_value('applylink'));
		echo form_input($TITLE_EN);
	    ?>
          <p class="notecls">Example: http://www.domain.gov.in/</p>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Attachment/Notice 1 </label>
            <div class="col-sm-9 ">
              <p>
                <?php if(isset($DataList->attachment1)==TRUE && trim($DataList->attachment1)!=""): ?>
                View Uploaded File <a target="_blank" href="<?php echo base_url('uploads/files/'.$DataList->attachment1); ?>"><i class="fa fa-download"></i></a>
                <?php endif; ?>
              </p>
              <?php echo form_upload(array('name'=>'attachment1', 'id'=>'attachment1')); ?> </div>
          </div>
          
          <div class="form-group">
            <label class="col-sm-3 control-label">Attachment/Notice 2</label>
            <div class="col-sm-9 ">
              <p>
                <?php if(isset($DataList->attachment2)==TRUE && trim($DataList->attachment2)!=""): ?>
                View Uploaded File <a target="_blank" href="<?php echo base_url('uploads/files/'.$DataList->attachment2); ?>"><i class="fa fa-download"></i></a>
                <?php endif; ?>
              </p>
              <?php echo form_upload(array('name'=>'attachment2', 'id'=>'attachment2')); ?> </div>
          </div>
          
          <div class="form-group">
            <label class="col-sm-3 control-label">Attachment/Notice 3 </label>
            <div class="col-sm-9 ">
              <p>
                <?php if(isset($DataList->attachment3)==TRUE && trim($DataList->attachment3)!=""): ?>
                View Uploaded File <a target="_blank" href="<?php echo base_url('uploads/files/'.$DataList->attachment3); ?>"><i class="fa fa-download"></i></a>
                <?php endif; ?>
              </p>
              <?php echo form_upload(array('name'=>'attachment3', 'id'=>'attachment3')); ?> </div>
          </div>
          
          <div class="form-group">
            <label class="col-sm-3 control-label">Attachment/Notice 4 </label>
            <div class="col-sm-9 ">
              <p>
                <?php if(isset($DataList->attachment4)==TRUE && trim($DataList->attachment4)!=""): ?>
                View Uploaded File <a target="_blank" href="<?php echo base_url('uploads/files/'.$DataList->attachment4); ?>"><i class="fa fa-download"></i></a>
                <?php endif; ?>
              </p>
              <?php echo form_upload(array('name'=>'attachment4', 'id'=>'attachment4')); ?> </div>
          </div>
          
          <div class="form-group">
            <label class="col-sm-3 control-label">Attachment/Notice 5 </label>
            <div class="col-sm-9 ">
              <p>
                <?php if(isset($DataList->attachment5)==TRUE && trim($DataList->attachment5)!=""): ?>
                View Uploaded File <a target="_blank" href="<?php echo base_url('uploads/files/'.$DataList->attachment5); ?>"><i class="fa fa-download"></i></a>
                <?php endif; ?>
              </p>
              <?php echo form_upload(array('name'=>'attachment5', 'id'=>'attachment5')); ?> </div>
          </div>
          
          
          <div class="form-group">
            <label class="col-sm-3 control-label">Corrigendum/Amendment 1</label>
            <div class="col-sm-9 ">
              <p>
                <?php if(isset($DataList->corrigendum1)==TRUE && trim($DataList->corrigendum1)!=""): ?>
                View Uploaded File <a target="_blank" href="<?php echo base_url('uploads/files/'.$DataList->corrigendum1); ?>"><i class="fa fa-download"></i></a>
                <?php endif; ?>
              </p>
              <?php echo form_upload(array('name'=>'corrigendum1', 'id'=>'corrigendum1')); ?> </div>
          </div>
          
          <div class="form-group">
            <label class="col-sm-3 control-label">Corrigendum/Amendment 2</label>
            <div class="col-sm-9 ">
              <p>
                <?php if(isset($DataList->corrigendum2)==TRUE && trim($DataList->corrigendum2)!=""): ?>
                View Uploaded File <a target="_blank" href="<?php echo base_url('uploads/files/'.$DataList->corrigendum2); ?>"><i class="fa fa-download"></i></a>
                <?php endif; ?>
              </p>
              <?php echo form_upload(array('name'=>'corrigendum2', 'id'=>'corrigendum2')); ?> </div>
          </div>
          
          <div class="form-group">
            <label class="col-sm-3 control-label">Corrigendum/Amendment 3</label>
            <div class="col-sm-9 ">
              <p>
                <?php if(isset($DataList->corrigendum3)==TRUE && trim($DataList->corrigendum3)!=""): ?>
                View Uploaded File <a target="_blank" href="<?php echo base_url('uploads/files/'.$DataList->corrigendum3); ?>"><i class="fa fa-download"></i></a>
                <?php endif; ?>
              </p>
              <?php echo form_upload(array('name'=>'corrigendum3', 'id'=>'corrigendum3')); ?> </div>
          </div>
          
          <div class="form-group">
            <label class="col-sm-3 control-label">Corrigendum/Amendment 4</label>
            <div class="col-sm-9 ">
              <p>
                <?php if(isset($DataList->corrigendum4)==TRUE && trim($DataList->corrigendum4)!=""): ?>
                View Uploaded File <a target="_blank" href="<?php echo base_url('uploads/files/'.$DataList->corrigendum4); ?>"><i class="fa fa-download"></i></a>
                <?php endif; ?>
              </p>
              <?php echo form_upload(array('name'=>'corrigendum4', 'id'=>'corrigendum4')); ?> </div>
          </div>
          
          <div class="form-group">
            <label class="col-sm-3 control-label">Corrigendum/Amendment 5</label>
            <div class="col-sm-9 ">
              <p>
                <?php if(isset($DataList->corrigendum5)==TRUE && trim($DataList->corrigendum5)!=""): ?>
                View Uploaded File <a target="_blank" href="<?php echo base_url('uploads/files/'.$DataList->corrigendum5); ?>"><i class="fa fa-download"></i></a>
                <?php endif; ?>
              </p>
              <?php echo form_upload(array('name'=>'corrigendum5', 'id'=>'corrigendum5')); ?> </div>
          </div>
          
          <!--End form-group-->
          <?php /*?><div class="form-group clearfix">
            <label class="col-sm-3 control-label">Last Date <span class="red">*</span></label>
            <div class="col-sm-6">
              <?php $last_date = get_date($DataList->last_date); $LAST_DATE = array('name'=>'last_date','id'=>'last_date','class'=>'form-control','value'=>(isset($DataList->last_date) && !empty($last_date))? get_date($DataList->last_date):"");
		echo form_input($LAST_DATE);
	    ?>
            </div>
          </div><?php */?>
          <div class="form-group clearfix">
            <label class="col-sm-3 control-label">Archive Date <span class="red">*</span></label>
            <div class="col-sm-6">
              <?php $archivee_date = get_date($DataList->archive_exp_date); $ARCHIVE_DATE = array('name'=>'archive_date','id'=>'archive_date','class'=>'form-control','value'=>(isset($DataList->archive_exp_date) && !empty($archivee_date))? get_date($DataList->archive_exp_date):"");
		echo form_input($ARCHIVE_DATE);
	    ?>
            </div>
          </div>
          <!--End form-group-->
           
          <div class="form-group clearfix">
	<label class="col-sm-3 control-label">Is Alert </label>
		<div class="col-sm-6">
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
              <button type="submit" class="btn green">Update</button>
              <button type="reset" class="btn blue">Clear</button>
              <a class="btn purple" href="<?php echo base_url('manage/Career/'); ?>">Back</a> </div>
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

	jQuery( "#frmCareer" ).validate({
		  rules: { 
		 nit_no: {
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
			  applylink: {
		       // required: true,
				url:true,
		        minlength:2,
		        maxlength:500
		    },
           archive_date: {
				required: true,
				checkdate:true
		   },
		  issue_date: {
				required: true,
				checkdate:true
		   }
		/*  last_date: {
				required: true,
				checkdate:true
		   }*/
		  },
		  message:{
		  	attachment: {extension:"Please upload only JPEG,JPG,PDF Formet",filesize:"File size must be less than 25 MB"}
		  }
		});	
	});
</script>