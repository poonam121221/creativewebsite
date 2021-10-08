<!-- BEGIN PAGE HEADER-->
<div class="row">
<div class="col-md-12">
	<ul class="page-breadcrumb breadcrumb">
		<li><i class="fa fa-home"></i><a href="<?php echo base_url('manage/Dashboard/');?>">Home</a><i class="fa fa-angle-right"></i></li>
		<li><a href="<?php echo base_url('manage/Implementuserother/'); ?>">Other Implementing Partner</a><i class="fa fa-angle-right"></i></li>
		<li><a href="javascript:void(0);">View</a></li>
		<!--<li class="btn-group">
		<a href="javascript:void(0);" class="btn blue"><span class="label"><i class="fa fa-plus"></i> <strong>Add</strong></span></a>
        </li>-->
		
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
	  	<div class="col-sm-3 form-group">
	  	<?php $IMPL_NAME = array('name'=>'impl_name','id'=>'sImpl_name','class'=> 'form-control','placeholder'=>'Implementing partner name');
		echo form_input($IMPL_NAME);
	    ?>
	  	</div>
	  	<div class="col-sm-3 form-group">
	  	<?php $PROJECT_NAME=array('name'=>'project_name','id'=>'sProject','class'=> 'form-control','placeholder'=>'Project Name');
		echo form_input($PROJECT_NAME);
	    ?>
	  	</div>
	  	<div class="col-sm-3 form-group">
		<?php $EMAIL=array('name'=>'email','id'=>'sEmail','class'=> 'form-control','placeholder'=>'Search by user email');
		echo form_input($EMAIL);
	    ?>
		</div>
		<div class="col-sm-3 form-group">
		<?php $MOBILE = array('name'=>'mobile','id'=>'sMobile','class'=> 'form-control','placeholder'=>'Search by user mobile number');
		echo form_input($MOBILE);
	    ?>
		</div>

	  </div><!--End row-->
	  
	  <p></p>
	  <div class="row">	  	  
	  	<div class="col-sm-3 form-group">
		<?php $STATUS = array(''=>'--SELECT STATUS---','0'=>'Pending','1'=>'Approved');
		echo form_dropdown('status', $STATUS,set_value('status'),array('class'=> 'form-control', 'id'=>'sStatus'));
	    ?>
		</div>
		<div class="col-sm-9 form-group">
			<button class="btn green" onclick="searchFilter();" name="search" id="search"><i class="fa fa-search"></i> Search</button>
			<button class="btn btn-info default-btn" onclick="searchFilter(0,1);" name="search-all" id="search-all">Reset</button>
		</div>
	  </div><!--End row-->
	
	</div><!--End panel-body-->
</div><!--End panel-->
	
<!-- BEGIN BORDERED TABLE PORTLET-->
<div class="portlet box blue">
<div class="portlet-title">
  <div class="caption">Implementing Partner List</div>
  <div class="tools"> <a href="javascript:;" class="collapse"> </a></div>
</div><!--End portlet-title-->
<div class="portlet-body">
  <div class="table-responsive">
  <div id="ajaxdata">
   <?php // get the data and pass it to your view
	 $token_name = $this->security->get_csrf_token_name();
	 $token_hash = $this->security->get_csrf_hash();
	 echo form_input(array('type'=>'hidden','id'=>'sysToken','name'=>$token_name,'value'=>$token_hash));
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

});//end dom

//Do not use this function in Dom
function searchFilter(page_num,all) {
	    page_num = page_num?page_num:0;
	    all = all?all:0;
	    
	    var tokenVal  =  $(document).find('#sysToken').val();
	    
	    var sImpl_name  = "";
	    var sProject  = "";
	    var sEmail  = "";
	    var sMobile  = "";
	    var sCompanyType  = "";
	    var sStatus  = "";
	    
	    if(all==0){
			sImpl_name  = $("#sImpl_name").val();
			sProject = $("#sProject").val();
			sEmail  = $("#sEmail").val();
			sMobile  = $("#sMobile").val();
			sStatus = $("#sStatus option:selected").val();
		}else{
			$("#sImpl_name").val('');
			$("#sProject").val('');
			$("#sEmail").val('');
			$("#sMobile").val('');
			$("#sStatus").val('');
		}  
	    
	    var dataString ={'page':page_num,'sImpl_name':sImpl_name,'sProject':sProject,'sEmail':sEmail,'sMobile':sMobile,'sStatus':sStatus,"<?php echo $this->security->get_csrf_token_name();?>":tokenVal};
	    
	    $('#ajaxloading').modal('show');
	    
	    $.ajax({
	        type: 'POST',
	        url: '<?php echo base_url("manage/Implementuserother/ajaxPaginationData/"); ?>'+page_num,
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
