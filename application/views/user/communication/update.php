<article class="min_350 noise_bg">
<div class="container data-container ptb-30">
 <div class="row dashboard-header">
 <div class="col-md-12">
  <?php echo $this->breadcrumbs->show(); ?>
 </div><!--End column-->
 </div><!--End row-->
<div class="row">
 <div class="col-md-2">
  <?php $this->view('company/element/inc_sidebar'); ?>
 </div>
 <div class="col-md-10 profile-container">
 <?php
$atr2 =array('id'=>'frmMember','name'=>'frmMember','class'=>'','role'=>'form', 'autocomplete'=>'off');
echo form_open_multipart('user/Communication/update',$atr2); 
?>
<!----------------------------------------------------------------------------------->

<!----------------------------------------------------Sangam------------------------------------------------------------------------->

<!---------------------------------------------------->
<div class="row mt-20 data-box">
 <div class="col-md-12">
  <div class="panel panel-primary data-panel">
   <div class="panel-heading row top-control">
   		<div class="col-md-6">Communication Reply</div>
   		<div class="col-md-6 text-right">
                 <a href="<?php echo base_url('user/communication-add'); ?>" class="btn btn-default btn-xs"><em class="fa fa-pencil"></em> Compose</a>  
            <a href="<?php echo base_url('user/communication-inbox'); ?>" class="btn btn-default btn-xs"><em class="fa fa-address-book-o"></em> Inbox</a>
            <a href="<?php echo base_url('user/communication-sent'); ?>" class="btn btn-default btn-xs"><em class="fa fa-paper-plane-o"></em> Sent</a>

        </div>
   </div>
   <div class="panel-body">
   <!---------------------------------------------------->
 <div class="row"><div class="col-md-12 grid-box">
 <div class="row">
 <div class="col-md-12 no-padding">
 <!--End form-group-->

	<div class="col-md-6 no-padding">
            			<!--End form-group-->
            			<div class="form-group row grid-content">
				<label class="col-md-3 control-label">Subject</label>
				<div class="col-md-9 text-justify">
								<?php echo html_escape($Data->comm_subject); ?>
				</div>
			</div><!--End form-group-->
            
                </div>
                <div class="col-md-6 no-padding">
			<div class="form-group row grid-content">
				<label class="col-md-3 control-label">Query Type</label>
				<div class="col-md-9">
									<?php echo html_escape($Data->query_name); ?>
				</div>
			</div><!--End form-group-->
            </div>
			<div class="col-md-6 no-padding">
            <div class="form-group row grid-content">
				<label class="col-md-3 control-label">Message</label>
				<div class="col-md-9 text-justify">
							<?php echo stripslashes2(html_entity_decode(html_escape($Data->comm_message))); ?>
				</div>
			</div>
                </div>  <?php if($Data->comm_attachmnet){ ?><div class="col-md-6 no-padding">
            
                          <div class="form-group row grid-content">
                <label class="col-md-3 control-label">Attachment</label>
                <div class="col-md-9">
              				<a href="<?php echo base_url('uploads/communication/'.$Data->comm_attachmnet); ?>" target="_blank"><i class="fa fa-download"></i></a></div>
                </div>
                </div><!--msg atachment-->
                <?php } if(!empty($ReplyData)){ ?>
             <div class="col-md-6 no-padding">
            <div class="form-group row grid-content">
				<label class="col-md-3 control-label">Message</label>
				<div class="col-md-9 text-justify">
							<?php echo stripslashes2(html_entity_decode(html_escape($ReplyData->comm_message))); ?>
				</div>
			</div>
                </div>
                <?php if($ReplyData->comm_attachmnet){ ?>
                <div class="col-md-6 no-padding">
            
                          <div class="form-group row grid-content">
                <label class="col-md-3 control-label">Attachment</label>
                <div class="col-md-9">
              				<a href="<?php echo base_url('uploads/communication/'.$ReplyData->comm_attachmnet); ?>" target="_blank"><i class="fa fa-download"></i></a></div>
                </div>
                </div><!--msg atachment-->
             <?php } } ?>
            </div>
            </div>
			<!--End form-group-->
             <?php if(empty($ReplyData)){ ?>
            <div class="row form-area">
                <div class="form-group row">
                 <label class="col-md-3 control-label">Remark</label>
                 <div class="col-md-9">
                  <?php $REMARK = array('name' => 'remark','id'=> 'remark','value'=> '','rows'=> '5','cols'=> '10','class'=> 'form-control placeholder-no-fix'
		    );
			  echo form_textarea($REMARK); 
			      echo form_hidden('id',encrypt_decrypt('encrypt',$Data->comm_id)); 
     ?>
                 </div>
                </div>
                <div class="form-group row">
                 <label class="col-md-3 control-label">Attachment</label>
                 <div class="col-md-9">
                     <?php echo form_upload(array('name'=>'attachment','tabindex'=>"5")); ?>
                 </div>
                </div>
                <div class="form-group row">
				<label class="col-md-3 control-label">&nbsp;</label>
				<div class="col-md-9">
				<label id="recap" class="refreshcap" style="cursor: pointer;">
				<div id="captchaimage" style="display: inline-block"><?php echo reload_captcha(); ?></div> 
				<i class="fa fa-refresh"></i>
				</label>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-3 control-label">Security Code (सुरक्षा कोड)<span class="red">*</span></label>
				<div class="col-md-9">
				<?php $SECURITY_CODE = array( 
		        'name'=>'captcha','id'=>'captcha','class'=> 'form-control input-medium','placeholder'=>'Enter security code');
				echo form_input($SECURITY_CODE);
			    ?>
				</div>
			</div><!--End form-group-->
                 
                <div class="form-group">
		<label class="col-md-3 control-label"></label>
		<div class="col-md-9 text-right">
			<button type="submit" class="btn green">Submit</button>
			<button type="reset" class="btn blue">Clear</button>
		</div>
	</div>
            </div>
            <?php } ?>
 </div></div>
   <!---------------------------------------------------->  
   
</div><!--End panel-body-->
</div><!--End panel-->
</div><!--End column-->
</div><!--End row data-box-->
<!---------------------------------------------------->
<?php echo form_close(); ?>

<!----------------------------------------------------------------------------------->
</div><!--End column-->
</div><!--End row-->
</div><!--End container-->
</article>		
<script type="text/javascript" src="<?php echo base_url('webroot/');?>plugins/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('webroot/');?>validation/dist/additional-methods.js"></script>
<script type="text/javascript">
	jQuery(function(){	
		
	$.validator.addMethod('filesize', function(value, element, param) {
	return this.optional(element) || (element.files[0].size <= param);
	}, $.validator.format("Uploaded file size should be less than or equal to 200 KB."));
		
	jQuery( "#frmMember" ).validate({
		  rules: { 
		   remark:{ 
		   		required: true,
		   },
		     attachment:{
				extension:"PDF",
				filesize:1048576 //1 mb 1024*1024*1
	  		},
		   captcha:{
		   		required: true
		   }
		  },
		 message:{
		  	user_type:{required:"Please select user type."},
		  	user:{required:"Please select user."},
		  	query_type:{required:"Please select query type."} ,
			attachment:{
				extension:"Uploaded file is not a valid image. Only PDF files are allowed.",
				filesize:"Uploaded attacnment size should be less than or equal to 1 MB."
			  }, 
		  }
		});	
	});
</script>

<style>
.btn-view{
    text-decoration: none !important;
    background: #ffffff;
    color: #5f5f5f!important;
    padding: 4px;
    min-width: 25px;
    height: 25px;
    display: block;
    float: left;
    border-radius: 3px;
    margin: 0px 2px;
    font-size: 18px;
}
.top-control{
	margin: 0px;
	}
.grid-content{
    background: #f5f5f5;
    margin: 7px 5px;
    border: 1px solid #efefef;
	}
	.no-padding{
		padding: 0px;}
		.form-area{
			    background: #f5f5f5;
    padding: 10px;
    margin: 1px -9px;
    border: 1px solid #ececec;}
	.form-area .form-group{
		margin-bottom: 5px;}
</style>