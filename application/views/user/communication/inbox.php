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
  <?php $this->view('company/element/inc_sidebar'); ?>
 </div>
 <div class="col-md-10">
 
 <div class="row">
   <div class="col-lg-12"><?php echo AlertMessage($this->session->flashdata('AppMessage'));?></div>
  </div><!--End Validation message-->
<!---------------------------------------------------->
<div class="row mt-20 data-box">
 <div class="col-md-12">
  <div class="panel panel-primary data-panel">
   <div class="panel-heading row top-control">
   		<div class="col-md-6">Communication</div>
   		<div class="col-md-6 text-right">
             <a href="<?php echo base_url('user/communication-add'); ?>" class="btn btn-default btn-xs"><em class="fa fa-pencil"></em> Compose</a>  
            <a href="<?php echo base_url('user/communication-inbox'); ?>" class="btn btn-danger btn-xs"><em class="fa fa-address-book-o"></em> Inbox</a>
            <a href="<?php echo base_url('user/communication-sent'); ?>" class="btn btn-default btn-xs"><em class="fa fa-paper-plane-o"></em> Sent</a> 

        </div>
   </div>
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
		
		var dataString ={'page':page_num,'type':1,"<?php echo $this->security->get_csrf_token_name();?>":tokenVal};
	    
	    $('#ajaxloading').modal('show');
	    
	    $.ajax({
	        type: 'POST',
	        url: '<?php echo base_url("user/Communication/ajaxInbox/"); ?>'+page_num,
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
<style>
.top-control{
	margin: 0px;
	}
</style>