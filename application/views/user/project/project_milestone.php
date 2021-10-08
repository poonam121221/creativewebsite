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
<li><a href="<?php echo base_url('project/document/'.$project_enc_id);?>"><span>2</span> Documents</a></li>
<li class="active"><a href="<?php echo base_url('project/milestone/'.$project_enc_id);?>"><span>3</span> Milestone</a></li>
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
   <div class="panel-heading">Project Milestone List</div>
   <div class="panel-body">
<!---------------------------------------------------->
     <table class="table table-striped table-bordered table-hover dataTable">
		<thead>
		<tr>
			<th width="5%">S.No.</th>
			<th width="20%">Title</th>
			<th width="10%">Payment</th>
			<th width="10%">Percentage</th>
			<th width="10%">Start Date</th>
			<th width="10%">End Date</th>
			<th width="15%">Last Modified Date</th>
			<th width="10%">Status</th>
			<th width="10%">Action</th>
		</tr>
		</thead>
		<tbody> 
	<?php 
	if(isset($DataList) && count($DataList)>0  && $DataList !=FALSE):
	$i = 1;
	$totalPayment = 0;
	$totalPercentage = 0;
	foreach($DataList as $row):	
	$id = encrypt_decrypt('encrypt',$row['milestone_id']);
	$project_enc_id = encrypt_decrypt('encrypt',$row['project_id']);
	$totalPayment=$totalPayment+$row['milestone_payment'];
	$totalPercentage=$totalPercentage+$row['milestone_percentage'];
	?>                                           
	<tr>
		<td><?php echo $i; ?></td>
		<td><?php echo html_escape($row['milestone_title']); ?></td>
		<td><?php echo html_escape($row['milestone_payment']); ?> Rs.</td>
		<td><?php echo html_escape($row['milestone_percentage']); ?>%</td>
		<td><?php echo get_date($row['milestone_start_date']); ?></td>
		<td><?php echo get_date($row['milestone_end_date']); ?></td>
	    <td><?php echo getModifiedDate($row['added_date'],$row['edit_date']); ?></td>
	    <td><?php echo MilestoneStatus(html_escape($row['milestone_status'])); ?></td>
	    <td>
	    <?php 
	    //0=Not Started Yet,1=Started,2=Completed
	    if(in_array($row['milestone_status'],array(0,1,2))) {
	    ?>
	    <a href="javascript:void(0);" class="btn btn-xs btn-info tooltips docModel" data-placement="top" data-original-title="Edit" data-project-id="<?php echo $project_enc_id;?>" data-doc-id="<?php echo $id;?>" data-status="<?php echo $row['milestone_status'];?>">
	    <i class="fa fa-edit"></i> Update</a>
	    <p class="milestoneCommentDsp hide"><?php echo $row['milestone_comment'];?></p>
	    <?php }//end check status ?>
	    </td>
   </tr>  
	<?php 
	$i = $i+1;
	 endforeach; endif; 
	?>
	</tbody>
	<?php if(isset($DataList) && count($DataList)>0  && $DataList !=FALSE){ ?>
	<tfoot>
	 <tr>
   	  <td colspan="2"><strong>Total</strong></td>
   	  <td><strong><?php echo $totalPayment;?> Rs.</strong></td>
   	  <td colspan="6"><strong><?php echo $totalPercentage;?>%</strong></td>
     </tr>	
	</tfoot>
	<?php } ?>
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

<!--Model for milestone status and remark update-->
<div id="docModelShow" class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
 <div class="modal-dialog modal-lg">
	  <div class="modal-content">
	  <div class="modal-header bg-green">
	   <h4 class="modal-title">Update Milestone Status</h4>
	  </div>
	  <div class="modal-body">
      <?php
	  $atr2 =array('id'=>'frmMilestoneStatus','name'=>'frmMilestoneStatus','class'=>'form-horizontal','role'=>'form', 'autocomplete'=>'off');
	  echo form_open('user/Userproject/milestone_status',$atr2); 
      ?>
       <input type="hidden" name="project_id" id="m_project_id" value=""/>
       <input type="hidden" name="milestone_id" id="m_milestone_id" value=""/>
      
       <div class="form-group">
		<label class="col-sm-3 control-label">Milestone Status <span class="red">*</span></label>
		<div class="col-sm-9">
		<?php $STATUS = MilestoneStatusList();
		$STATUS = array_diff_key($STATUS,array('3'=>'Reject','4'=>'Completed & Approved'));
		echo form_dropdown('status', $STATUS,'',array('class'=> 'form-control','id'=>'status','tabindex'=>6));
	    ?>
		</div>
	    </div><!--End form-group-->	

	   <div class="form-group">
		 <label class="col-sm-3 control-label">Milestone Status Comment </label>
		 <div class="col-sm-9">
		 <?php $PROJECT_STATUS_COMMENT = array( 
         'name'=>'milestone_comment','id'=>'milestone_comment','class'=> 'form-control','rows'=>4,'maxlength'=>255,'placeholder'=>'Please enter milestone status comment','tabindex'=>7,'value'=>set_value('milestone_comment'));
		 echo form_textarea($PROJECT_STATUS_COMMENT);
	     ?>
		 </div>
	     </div><!--End form-group-->
	    
	  <?php echo form_close(); ?>
	  </div>
	  <div class="modal-footer">	  	  
	  <button id="submitStatus" class="btn blue">Save</button>
	  <button id="clearStatus" class="btn default" data-dismiss="modal" aria-hidden="true">Close</button>	  
	  </div>
	
	  </div>
  </div>
</div>
<!-- /.modal milestone status and remark update -->

<script type="text/javascript" src="<?php echo base_url('webroot/');?>validation/dist/jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo base_url('webroot/');?>validation/dist/additional-methods.js"></script>
<script type="text/javascript">
	jQuery(function(){
		jQuery('.dataTable').dataTable();
	});
</script>
<script type="text/javascript">
jQuery(function(){
	
  $('.docModel').on('click',function(){
   	 var project_id =0;
   	 var milestone_id =0;
   	 var milestone_status = 0;
   	 var milestone_status_comment ="";
   	 
   	 project_id = $(this).attr('data-project-id');
   	 milestone_id = $(this).attr('data-doc-id');
   	 doc_status = parseInt($(this).attr('data-status'));
   	 milestone_comment = $(this).siblings('p.milestoneCommentDsp').html();
   	 
   	 if($.isNumeric(doc_status)==true){
	 	$('#status').val(doc_status);
	 }else{
	 	$('#status').val('');
	 }
	 
	 if($.trim(milestone_comment)!=""){
	 	$('#milestone_comment').text(milestone_comment);
	 }else{
	 	$('#milestone_comment').text('');
	 }
   	 
   	 if($.trim(project_id)!='' && $.trim(milestone_id)!=''){
   	 	$('#m_project_id').val(project_id);
   	 	$('#m_milestone_id').val(milestone_id);
	 	$("#docModelShow").modal({backdrop: 'static',keyboard: false,show: true});
	 }else{
	 	$('#m_project_id').val('');
   	 	$('#m_milestone_id').val('');
	 	alert('Either project details or milestone details not found');
	 }
   	 
   });
   
   $("#frmMilestoneStatus").validate({
	  errorElement: 'span', //default input error message container
      errorClass: 'help-block', // default input error message class
      focusInvalid: false, // do not focus the last invalid input
      ignore: "",
	  rules: { 
		status: {
		   required: true,
           digits: true
        },
        milestone_comment: {
           required: function(element){
           	var status_val =0;
           	status_val = $('#status option:selected').val();
           	if(status_val=='3' || status_val== '4'){
				return true;
			}else{
				return false;
			}
           	},
		   minlength:2,
		   maxlength:255
		}
	   },
	   submitHandler: function (form) {
	     form.submit();
	     $('#ajaxloading').modal('show');
	   }
	});
		
   $('#submitStatus').on('click',function(){
   	
   	if($("#frmMilestoneStatus").valid()){
		$("#frmMilestoneStatus").submit();
	}
   });//end submitStatus
   
   $('#clearStatus').on('click',function(){
   	$('#m_project_id').val('');
    $('#m_milestone_id').val('');
   	$('#status').val('');
   	$('#milestone_comment').text('');
   });//end clearStatus
	
});//end dom
</script>