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
<div class="col-md-12">
 
<ul class="nav nav-pills blue-pill">
<li><a href="<?php echo base_url('project/information/'.$project_enc_id);?>"><span>1</span> Details</a></li>
<li class="active"><a href="<?php echo base_url('project/document/'.$project_enc_id);?>"><span>2</span> Documents</a></li>
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
   <div class="panel-heading">Add Project Document</div>
   <div class="panel-body">
<!---------------------------------------------------->
<?php
$hidden = array('pid' =>$project_enc_id);
$atr2 =array('id'=>'frmProject','name'=>'frmProject','class'=>'form-horizontal','role'=>'form', 'autocomplete'=>'off');
echo form_open_multipart('user/Userproject/add_document',$atr2,$hidden); 
?>
<div class="row">
 		<div class="col-sm-6">
 		
 		<div class="form-group">
		<label class="col-sm-4 control-label">Document Title <span class="red">*</span></label>
		<div class="col-sm-8">
		<?php $DOC_TITLE = array( 
        'name'=>'doc_title','id'=>'doc_title','class'=> 'form-control','placeholder'=>'Enter document title','tabindex'=>1);
		echo form_input($DOC_TITLE);
	    ?>
		</div>
	    </div><!--End form-group-->
	
 		</div><!--End Column-->
 		<div class="col-sm-6">
 		
 		<div class="form-group">
		<label class="col-sm-4 control-label">Document Type <span class="red">*</span></label>
		<div class="col-sm-8">
		<?php 
		echo form_dropdown(array('name'=>'document_type','id'=>'document_type','class'=>'form-control','tabindex'=>2),
		isset($DocumentTypeList)?$DocumentTypeList:array(''=>'--SELECT DOCUMENT TYPE--'),isset($DataList->document_type) ? ($DataList->document_type):set_value('document_type'));
		?>
		</div>
	    </div><!--End form-group-->
	    
 		</div><!--End Column-->
 	</div><!--End Row--> 
 	<div class="clerafix"><p></p></div>
 	 
 	<div class="row">
 		<div class="col-sm-6">
 		
 		<div class="form-group">
		<label class="col-sm-4 control-label">Attachment <span class="red">*</span></label>
		<div class="col-sm-8">
		<?php echo form_upload(array('name'=>'attachment')); ?>
		</div>
	    </div><!--End form-group-->

 		</div><!--End Column-->
 		<div class="col-sm-6">
 			
 		</div><!--End Column-->
 	</div><!--End row-->
 	
 	<div class="clearfix"><p></p></div>
 	<div class="form-group">
		<label class="col-md-2 col-sm-3 control-label"></label>
		<div class="col-md-10 col-sm-9">
			<button type="submit" class="btn green">Submit</button>
			<button type="reset" id="reset" class="btn blue">Clear</button>
		</div>
	</div><!--End form-group-->
<?php echo form_close(); ?> 	

<!---------------------------------------------------->
</div><!--End panel-body-->
</div><!--End panel-->
</div><!--End column-->
<!---------------------------------------------------->


 <div class="col-md-12">
  <div class="panel panel-primary data-panel">
   <div class="panel-heading">Project Document List</div>
   <div class="panel-body">
   
<!---------------------------------------------------->

<div class="row">
 <div class="col-md-12">
  <?php if(isset($ProjectRecord)){ ?>
  <div class="note note-info">
  <p><strong>Project Name</strong> :- <?php echo html_escape($ProjectRecord->project_title);?></p>
  </div>		
  <?php } ?>
 </div>
</div>

<!---------------------------------------------------->
    <table class="table table-striped table-bordered table-hover dataTable">
		<thead>
		<tr>
			<th width="5%">S.No.</th>
			<th width="15%">Document Type</th>
			<th width="20%">Document Title</th>
			<th width="20%">Uploaded By</th>
			<th width="10%">File</th>
			<th width="10%">Last Modified Date</th>
			<th width="10%">Status</th>
		</tr>
		</thead>
		<tbody> 
	<?php 
	if(isset($DataList) && count($DataList)>0  && $DataList !=FALSE):
	$i = 1;
	foreach($DataList as $row):	
	$id = encrypt_decrypt('encrypt',$row['project_doc_id']);
	$project_id = encrypt_decrypt('encrypt',$row['project_id']);
	?>                                           
	<tr>
		<td><?php echo $i;?></td>
		<td><?php echo html_escape($row['doc_type_title']); ?></td>
		<td><?php echo html_escape($row['project_doc_title']); ?></td>
		<td><?php echo html_escape($row['uploaded_by']); ?></td>
		<td class="text-center">
	    <?php if(trim($row['project_doc_attachment'])!=""): ?>
	    <a target="_blank" href="<?php echo base_url('uploads/project/'.$row['project_doc_attachment']); ?>"><i class="fa fa-download"></i></a>
	    <?php endif; ?>
	    </td>
	    <td><?php echo getModifiedDate($row['added_date'],$row['edit_date']); ?></td>
	    <td><?php echo ProjectDocStatus($row['project_doc_status']); ?></td>
   </tr>
	<?php 
	$i = $i+1;
	 endforeach; endif; 
	?>
	</tbody>
	</table>
	<div class="clearfix"></div>
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

<script type="text/javascript" src="<?php echo base_url('webroot/');?>validation/dist/jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo base_url('webroot/');?>validation/dist/additional-methods.js"></script>
<script type="text/javascript">
	jQuery(function(){
		jQuery('.dataTable').dataTable();
	});
</script>
<script type="text/javascript">
	jQuery(function(){
		
	jQuery.validator.addMethod("alphanumspace", function(value, element) {
		  return this.optional(element) || /^[a-zA-Z0-9\s]*$/.test(value);
	}, "Please enter character, number and space only.");
	
	$.validator.addMethod('filesize', function(value, element, param) {
		    return this.optional(element) || (element.files[0].size <= param) 
	}, $.validator.format("Uploaded file size should be less than or equal to 25 MB)."));
	
	$.validator.addMethod("checkdate", function(value, element) {
        return this.optional(element) || /^(0[1-9]|[1-2][0-9]|3[0-1])-(0[1-9]|1[0-2])-[0-9]{4}$/.test(value);
    }, "Please enter valid date format (DD-MM-YYYY).");

	jQuery("#frmProject").validate({
		  errorElement: 'span', //default input error message container
          errorClass: 'help-block', // default input error message class
          focusInvalid: false, // do not focus the last invalid input
          ignore: "",
		  rules: { 
		   doc_title: {
		     required: true,
		     minlength:2,
		     maxlength:150
		   },
		   document_type: {
             required: true,
             digits: true
           },
		   status: {
             digits: true
           },
           doc_status_comment: {
		     minlength:2,
		     maxlength:1000
		   },
		   attachment:{
		     required: true,
		     extension:'PDF|pdf|doc|docx|xls|xlsx',
			 filesize:26214400 //1024*1024*25
		   }
		 },
		 messages:{
		  	attachment: {extension:"Please upload only pdf,doc,docx,xls,xlsx Format",filesize:"File size must be less than 25 MB"}
		},
	    submitHandler: function (form) {
	        form.submit();
	        $('#ajaxloading').modal('show');
	      }
		});	
	});//end dom
</script>