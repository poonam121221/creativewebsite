<!-- BEGIN PAGE HEADER-->
<div class="row">
<div class="col-md-12">
	<ul class="page-breadcrumb breadcrumb">
		<li><i class="fa fa-home"></i><a href="<?php echo base_url('manage/Dashboard/'); ?>">Home</a><i class="fa fa-angle-right"></i></li>
		<li><a href="<?php echo base_url('manage/Feedback'); ?>">Feedback</a><i class="fa fa-angle-right"></i></li>
		<li><a href="javascript:void(0)">View</a></li>
	</ul>
	<!-- END PAGE TITLE & BREADCRUMB-->
</div>
</div>
<!-- END PAGE HEADER-->
<!-- BEGIN PAGE CONTENT-->
<div class="row">
<div class="col-md-12">
<!------------------------------------------------------------------- -->
<div class="row"><div class="col-lg-12">
<?php echo AlertMessage($this->session->flashdata('AppMessage'));?>
</div></div>
<!--End Validation message-->

<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title">Search Data</h3>
	</div><!--End panel-heading-->
	<div class="panel-body">
	
	  <div class="row">
	  	<div class="col-sm-9">
	  	<?php $TITLE = array('name'=>'title','id'=>'sTitle','class'=> 'form-control','placeholder'=>'Search by Name or Email');
		echo form_input($TITLE);
	    ?>
	  	</div>
		<div class="col-sm-3">
			<button class="btn green" onclick="searchFilter();" name="search" id="search"><i class="fa fa-search"></i> Search</button>
		</div>
	  </div><!--End form-group-->
	
	</div><!--End panel-body-->
</div><!--End panel-->
	
<!-- BEGIN BORDERED TABLE PORTLET-->
<div class="portlet box blue">
<div class="portlet-title">
  <div class="caption">Feedback List</div>
  <div class="tools"> <a href="javascript:;" class="collapse"> </a></div>
</div><!--End portlet-title-->
<div class="portlet-body">
  <div class="table-responsive">
  <div id="ajaxdata">
   <?php // get the data and pass it to your view
	 $token_name = $this->security->get_csrf_token_name();
	 $token_hash = $this->security->get_csrf_hash();
	 echo form_input(array('type'  => 'hidden','id'=>'sysToken','name'=>$token_name,'value'=>$token_hash));
   ?>
   
  </div><!--End ajaxdata-->
  <div class="clearfix"></div>	
	
  </div> <!--End table responsive--> 
</div><!-- End portlet-body -->
</div><!-- End BORDERED TABLE PORTLET-->
<!------------------------------------------------------------------- -->
</div><!--End column -->
</div><!--End row-->
<!-- END PAGE CONTENT-->
<script type="text/javascript">
$(function(){
	
	getAjaxRecord();	
	
	function getAjaxRecord(){
		searchFilter();
	}//end getAjaxRecord function
	
	$(document).on('click','.showMessage',function(){
		var msg  = $(this).next('div.feedbackMsg').html();
		var name = $(this).attr('title');
		$('.modal-title').html(name);
		$('#custom-msg').html(msg);
		$('.custom-msgBox').modal('show');
	});

});//end dom

//Do not use this function in Dom
function searchFilter(page_num) {
	page_num = page_num?page_num:0;
	    
	var tokenVal  =  $(document).find('#sysToken').val();
	sTitle  = $("#sTitle").val();
	var dataString ={'page':page_num,'sTitle':sTitle,"<?php echo $this->security->get_csrf_token_name();?>":tokenVal};
	    
	    $('#ajaxloading').modal('show');
	    
	    $.ajax({
	        type: 'POST',
	        url: '<?php echo base_url("manage/Feedback/ajaxPaginationData/"); ?>'+page_num,
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
