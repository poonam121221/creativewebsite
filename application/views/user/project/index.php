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
   <div class="col-lg-12"><?php echo AlertMessage($this->session->flashdata('AppMessage'));?></div>
  </div><!--End Validation message-->
<!---------------------------------------------------->
<div class="row mt-20 data-box">
 <div class="col-md-12">
  <div class="panel panel-primary data-panel">
   <div class="panel-heading">Project List</div>
   <div class="panel-body">
   <!---------------------------------------------------->
   <div id="ajaxdata">
   <?php // get the data and pass it to your view
   $token_name = $this->security->get_csrf_token_name();
   $token_hash = $this->security->get_csrf_hash();
   echo form_input(array('type'=>'hidden','id'=>'sysToken','name'=>$token_name,'value'=>$token_hash));
   ?>
   </div><!--End ajaxdata-->
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
<script type="text/javascript">
$(function(){
	
	getAjaxRecord();	
	
	function getAjaxRecord(){
		searchFilter();
	}
});//end dom

//Do not use this function in Dom
function searchFilter(page_num,all) {
	    page_num = page_num?page_num:0;
	    all = all?all:0;
	   
	    var sTitle  = "";
	    var sStatus  = "<?php echo (isset($interest_status_rec))?$interest_status_rec:0; ?>";
	    if(all==0){
			sTitle  = $("#sTitle").val();
		}else{
			$("#sTitle").val('');
		}	   
		
		var tokenVal  =  $(document).find('#sysToken').val(); 
		
		var dataString ={'page':page_num,'sTitle':sTitle,'sStatus':sStatus,"<?php echo $this->security->get_csrf_token_name();?>":tokenVal};
	    
	    $('#ajaxloading').modal('show');
	    
	    $.ajax({
	        type: 'POST',
	        url: '<?php echo base_url("user/Userproject/ajaxProject/"); ?>'+page_num,
	        data:dataString,
	        success: function (html) {
	            $('#ajaxdata').html(html);
	            $('#ajaxloading').modal('hide');
	        },error: function(jqXHR, textStatus, errorThrown) {
			  console.log(textStatus, errorThrown);
			  $('#ajaxloading').modal('hide');
			}
	    });
	}//end ajax searchFilter
</script>	