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
<!----------------------------------------------------------------------------------->
<?php
$atr2 =array('id'=>'frmMember','name'=>'frmMember','class'=>'form-horizontal','role'=>'form', 'autocomplete'=>'off');
echo form_open_multipart('user/Communication/add',$atr2); 
?>
<!----------------------------------------------------Sangam------------------------------------------------------------------------->

<!---------------------------------------------------->
<div class="row mt-20 data-box">
 <div class="col-md-12">
  <div class="panel panel-primary data-panel">
   <div class="panel-heading row top-control">
   		<div class="col-md-6">Communication</div>
   		<div class="col-md-6 text-right">
            <a href="<?php echo base_url('user/communication-add'); ?>" class="btn btn-danger btn-xs"><em class="fa fa-pencil"></em> Compose</a>  
            <a href="<?php echo base_url('user/communication-inbox'); ?>" class="btn btn-default btn-xs"><em class="fa fa-address-book-o"></em> Inbox</a>
            <a href="<?php echo base_url('user/communication-sent'); ?>" class="btn btn-default btn-xs"><em class="fa fa-paper-plane-o"></em> Sent</a> 

        </div>
   </div>
   <div class="panel-body">
   <!---------------------------------------------------->
 <div class="alert"><?php echo AlertMessage($this->session->flashdata('AppMessage'));?></div>
 <div class="row">
 <div class="form-group">
				<label class="col-md-4 control-label">User Type<span class="red">*</span></label>
				<div class="col-md-6">
				<?php 
  echo form_dropdown(array('name'=>'user_type','id'=>'user_type','class'=>'form-control','tabindex'=>"21"),isset($UserTypeList)?$UserTypeList:array(''=>'--- SELECT USER TYPE ---'),isset($UserTypeList->user_type) ? ($UserTypeList->user_type):set_value('user_type')); 
  ?>
				</div>
			</div><!--End form-group-->
            		<div id="dd" ></div><!--dd-->

			<div class="form-group">
				<label class="col-md-4 control-label">User<span class="red">*</span></label>
				<div class="col-md-6">
								<?php 
  echo form_dropdown(array('name'=>'user','id'=>'user','class'=>'form-control select2me','tabindex'=>"21"),isset($UserList)?$UserList:array(''=>'--- SELECT USER ---'),isset($UserList->user) ? ($UserList->user):set_value('user'));  
  ?>
				</div>
			</div><!--End form-group-->
			
			<div class="form-group">
				<label class="col-md-4 control-label">Query Type<span class="red">*</span></label>
				<div class="col-md-6">
					<?php 
  echo form_dropdown(array('name'=>'query_type','id'=>'query_type','class'=>'form-control select2me','tabindex'=>"21"),isset($QueryList)?$QueryList:array(''=>'---SELECT QUERY TYPE---'),isset($QueryList->query_type) ? ($QueryList->query_type):set_value('query_type'));   
  ?>
				</div>
			</div><!--End form-group-->
			
			<div class="form-group">
				<label class="col-md-4 control-label">Subject</label>
				<div class="col-md-6">
				 <?php $SUBJECT = array('name'=>'subject','id'=>'subject','class'=> 'form-control placeholder-no-fix','placeholder'=>'Enter Subject','tabindex'=>"17",'autofocus'=>'true','autocomplete'=>'off','value'=>set_value('subject'));
	echo form_input($SUBJECT);
     ?>
				</div>
			</div><!--End form-group-->
            <div class="form-group">
				<label class="col-md-4 control-label">Remark</label>
				<div class="col-md-6">
				 <?php $REMARK = array('name' => 'remark','id'=> 'remark','value'=> '','rows'=> '5','cols'=> '10','class'=> 'form-control placeholder-no-fix'
		    );
			  echo form_textarea($REMARK); 
     ?>
				</div>
			</div>
                <div class="form-group">
                <label class="col-md-4 control-label">Attachment</label>
                <div class="col-md-6">
                <?php echo form_upload(array('name'=>'attachment','tabindex'=>"5")); ?>
             
                </div>
                </div>
			<div class="form-group">
				<label class="col-md-4 control-label">&nbsp;</label>
				<div class="col-md-6">
				<label id="recap" class="refreshcap" style="cursor: pointer;">
				<div id="captchaimage" style="display: inline-block"><?php echo reload_captcha(); ?></div> 
				<i class="fa fa-refresh"></i>
				</label>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-4 control-label">Security Code (सुरक्षा कोड)<span class="red">*</span></label>
				<div class="col-md-6">
				<?php $SECURITY_CODE = array( 
		        'name'=>'captcha','id'=>'captcha','class'=> 'form-control input-medium','placeholder'=>'Enter security code');
				echo form_input($SECURITY_CODE);
			    ?>
				</div>
			</div><!--End form-group-->

	<div class="form-group">
		<label class="col-md-4 control-label"></label>
		<div class="col-md-6">
			<button type="submit" class="btn green">Submit</button>
			<button type="reset" class="btn blue">Clear</button>
		</div>
	</div><!--End form-group-->   
 </div>
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
		  user_type: {
		        required: true,
		   },
		   user:{
		   		required: true,
		   },
		   query_type:{
		   		required: true,
		   },
		    remark:{ 
		   		required: true,
		   },
		   d_id:{ 
		   		required: true,
		   },
		   subject:{
		   		required: true,
		   },
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
<script type="text/javascript">
jQuery(document).ready(function(){
	
   $('#user_type').on('change',function(){
  	var user_type = 0;
  	user_type = $('#user_type option:selected').val();

	 if($.isNumeric(user_type)==true){
		if(user_type == 3 || user_type == 4){
			
			if(user_type == 4){
				id =  20;
				url ="<?php echo base_url("Ajaxmaster/getDistrictByUser/"); ?>"; 
				}
			else if(user_type == 3){ 

				id =  20;
				url ="<?php echo base_url("Ajaxmaster/getDepartmentByUser/"); ?>"; 
				}
	     $('#ajaxloading').modal('show');
		  dataString = {'id':id};
				
		  $.ajax({
	        type: "POST",
	        url: url,
	        data: dataString,
	        cache : false,
	        beforeSend:function(){
			 $('#district_code').val("").removeAttr('disabled');
			},
	        success: function(data){
			$('#user').html("<option value=''>--- SELECT USER ---</option>");	 
			 $('#dd').html(data);
			 $('#ajaxloading').modal('hide');                
	        },
	        error: function(xhr, status, error) {
	         console.log(error);
	         $('#ajaxloading').modal('hide');              
	        }
	      });//end ajax
				
		}else{
	     $('#ajaxloading').modal('show');
		  dataString = {'id':user_type};
				
		  $.ajax({
	        type: "POST",
	        url: '<?php echo base_url("Ajaxmaster/getUserList/"); ?>',
	        data: dataString,
	        cache : false,
	        beforeSend:function(){
			 
			},
	        success: function(data){
			 $('#dd').html(" ");
			 $('#user').html(data);
			 $('#ajaxloading').modal('hide');                
	        },
	        error: function(xhr, status, error) {
	         console.log(error);
	         $('#ajaxloading').modal('hide');              
	        }
	      });//end ajax
				
		}//end check id is not empty
	 }
	
  	
  });//end user_type change event
  $(document).on('change','#d_id',function(){
  // $('#d_id').on('change',function(){
	 
  	var user_type = 0;
  	user_type = $('#user_type option:selected').val();
	if(user_type == 3 ){  	d_id = $('#d_id option:selected').val();}
	else if(user_type == 4 ){d_id = $('#d_id option:selected').val();}

	 if($.isNumeric(user_type)==true){
	
	     $('#ajaxloading').modal('show');
		  dataString = {'id':user_type,'d_id':d_id};
				
		  $.ajax({
	        type: "POST",
	        url: '<?php echo base_url("Ajaxmaster/getUserList/"); ?>',
	        data: dataString,
	        cache : false,
	        beforeSend:function(){
			 
			},
	        success: function(data){
			 $('#user').html(data);
			 $('#ajaxloading').modal('hide');                
	        },
	        error: function(xhr, status, error) {
	         console.log(error);
	         $('#ajaxloading').modal('hide');              
	        }
	      });//end ajax
				
		//end check id is not empty
	 }
	
  	
  });//end dd  change event
  
	
		var img_path = "<?php echo site_url().'uploads/captcha/'; ?>";
		
		jQuery('#recap').on('click',function(){
					
		jQuery.get( "<?php echo site_url('loadcaptcha');?>", function( data ) {
  		     jQuery("#captchaimage").html('<img src="'+ img_path + data +'" height="45px" width="150px">');
		});					
	   });
});
</script>
<script type="text/javascript" src="<?php echo base_url('webroot/');?>plugins/jquery-inputmask/jquery.inputmask.bundle.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('webroot/');?>plugins/jquery.pwstrength.bootstrap/src/pwstrength.js"></script>
<script type="text/javascript" src="<?php echo base_url('webroot/');?>scripts/CustomFormTool.js"></script>
<script type="text/javascript">
	jQuery(function(){	
	CustomFormTool.init();
	});//end dom
</script>		
<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
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
</style>