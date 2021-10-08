<!-- BEGIN PAGE HEADER-->
<div class="row">
<div class="col-md-12">
	<ul class="page-breadcrumb breadcrumb">
		<li><i class="fa fa-home"></i><a href="<?php echo base_url('manage/Dashboard/');?>">Home</a><i class="fa fa-angle-right"></i></li>
		<li><a href="javascript:void(0);">Reports</a><i class="fa fa-angle-right"></i></li>
		<li><a href="javascript:void(0);">CSR Expenditure for Financial Year</a></li>
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
		<?php 
		echo form_dropdown(array('name'=>'f_id','id'=>'f_id','class'=>'form-control','tabindex'=>11),
		isset($FinancialYearList)?$FinancialYearList:array(''=>'--SELECT FINANCIAL YEAR--'),isset($FinancialYearList->f_id) ? ($FinancialYearList->f_id):set_value('f_id'));
		?>	  	</div>
	  	<div class="col-sm-3 form-group">
		<?php 
		echo form_dropdown(array('name'=>'district_id','id'=>'district_id','class'=>'form-control select2me','tabindex'=>11),
		isset($DistrictList)?$DistrictList:array(''=>'--SELECT DISTRICT--'),isset($DataList->district_code) ? ($DataList->district_code):set_value('district_id'));
		?>
		</div>
		<div class="col-sm-3 form-group">
		<?php 
		echo form_dropdown(array('name'=>'department_id','id'=>'department_id','class'=>'form-control select2me','tabindex'=>13),
		isset($DepartmentList)?$DepartmentList:array(''=>'--SELECT DEPARTMENT--'),isset($DataList->department_id) ? ($DataList->department_id):set_value('department_id'));
		?>
		</div>
       
		<div class="col-sm-3 form-group">
		<?php 
	  echo form_dropdown(array('name'=>'project_id','id'=>'project_id','class'=>'form-control select2me','tabindex'=>2),
	  isset($ProjectList)?$ProjectList:array(''=>'--SELECT Project--'),isset($DataList->project_id) ? ($DataList->project_id):set_value('project'));
	    ?>
		</div>

	  </div><!--End row-->
	  
	  <p></p>
	  <div class="row">	  
	  	<div class="col-sm-3 form-group">
			<button class="btn green" onclick="searchFilter();" name="search" id="search"><i class="fa fa-search"></i> Search</button>
			<button class="btn btn-info default-btn" onclick="searchFilter(0,1);" name="search-all" id="search-all">Reset</button>
		</div>
	  </div><!--End row-->
	
	</div><!--End panel-body-->
</div><!--End panel-->
	
<!-- BEGIN BORDERED TABLE PORTLET-->
<div class="portlet box blue">
<div class="portlet-title">
  <div class="caption">Data List</div>
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
	    
	    var sFinancialYear  = "";
	    var sDistrict  = "";
	    var sDepartment  = "";
	    var sProject  = "";
	    
	    if(all==0){
			
			sFinancialYear = $("#f_id option:selected").val();
			sDistrict = $("#district_id option:selected").val();
			sDepartment = $("#department_id option:selected").val();
			sProject = $("#project_id option:selected").val();
			
		}else{
			$("#f_id").val('');
			$('#district_id').val('');
			$('#department_id').val('');
			$('#project_id').val('');
		}  

	    var dataString ={'page':page_num,'sFinancialYear':sFinancialYear,'sDistrict':sDistrict,'sDepartment':sDepartment,'sProject':sProject,
	    	"<?php echo $this->security->get_csrf_token_name();?>":tokenVal};
	    
	    $('#ajaxloading').modal('show');
	    
	    $.ajax({
	        type: 'POST',
	        url: '<?php echo base_url("manage/Companyreport/ajaxPaginationDataEF/"); ?>'+page_num,
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

